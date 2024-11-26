<head>
	<title>Sales Entry</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f9f9f9;
			margin: 0;
			padding: 0;
			display: flex;
			justify-content: center;
			align-items: center;
			min-height: 100vh;
		}
		.sales-form {
			background-color: #ffffff;
			border: 1px solid #ccc;
			border-radius: 8px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			padding: 20px;
			width: 800px;
			max-width: 100%;
		}
		.form-group {
			margin-bottom: 15px;
		}
		.form-group label {
			display: block;
			font-weight: bold;
			margin-bottom: 5px;
		}
		.form-group input,
		.form-group select {
			width: 100%;
			padding: 8px;
			border: 1px solid #ccc;
			border-radius: 4px;
		}
		.form-group .remove-row {
			color: red;
			cursor: pointer;
			font-size: 14px;
		}
		.btn {
			display: inline-block;
			background-color: #28a745;
			color: white;
			padding: 10px 15px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			text-align: center;
			margin-top: 15px;
		}
		.btn:hover {
			background-color: #218838;
		}
		.button-container {
			margin-top: 20px;
			text-align: center;
		}
		.button-container a {
			color: #007bff;
			text-decoration: none;
			margin: 0 10px;
		}
		.button-container a:hover {
			text-decoration: underline;
		}

		a.back-link,
		a.add-button {
			display: inline-block;
			padding: 10px 20px;
			font-size: 16px;
			color: #fff;
			text-decoration: none;
			border-radius: 5px;
			transition: all 0.3s ease;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
		}

		/* Specific styles for Back to Inventory button */
		a.back-link {
			background-color: #007bff; /* Red color */
		}

		a.back-link:hover {
			background-color: #007bff; /* Darker red on hover */
			box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
		}
	</style>
</head>
<body>
<form id="sales-form" class="sales-form">
	<div id="sales-entries">
		<div class="sales-entry">
			<div class="form-group">
				<label for="product_id">Product:</label>
				<select name="product_id[]" class="product_id select2" required>
					<option value="">Select Product</option>
					<?php foreach ($products as $product): ?>
						<option value="<?php echo $product->product_id; ?>" data-price="<?php echo $product->price; ?>" data-selling_price="<?php echo $product->selling_price; ?>">
							<?php echo $product->name; ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label for="price">Price:</label>
				<input type="text" class="price" name="price[]" readonly>
			</div>
			<div class="form-group">
				<label for="selling_price">Selling Price:</label>
				<input type="number" class="selling_price" name="selling_price[]" step="0.01" readonly>
			</div>
			<div class="form-group">
				<label for="discount_price">Discount Price:</label>
				<input type="number" class="discount_price" name="discount_price[]" step="0.01" required>
			</div>
			<div class="form-group">
				<label for="quantity">Quantity:</label>
				<input type="number" class="quantity" name="quantity[]" min="1" required>
			</div>
			<div class="form-group">
				<label for="total_price">Total Price:</label>
				<input type="text" class="total_price" name="total_price[]" readonly>
			</div>
			<div class="form-group">
				<label for="customer_name">Customer Name (Optional):</label>
				<input type="text" class="customer_name" name="customer_name[]">
			</div>
			<div class="form-group">
				<label for="description">Description:</label>
				<input type="text" class="description" name="description[]">
			</div>
			<div class="form-group">
				<label for="mobile_number">Mobile Number:</label>
				<input type="number" class="mobile_number" name="mobile_number[]">
			</div>
			<div class="form-group">
				<label for="warranty">Warranty:</label>
				<input type="text" class="warranty" name="warranty[]">
			</div>
			<div class="form-group">
				<label for="payment_method">Payment Method:</label>
				<select class="payment_method" name="payment_method[]" required>
					<option value="">Select Payment Method</option>
					<option value="cash">Cash</option>
					<option value="card">Card</option>
				</select>
			</div>
			<button type="button" class="remove-row btn">Remove</button>
		</div>
	</div>
	<button type="button" id="add-row" class="btn">Add Row</button>
	<button type="button" id="submit-sales" class="btn">Record Sales</button>
	<div class="button-container">
		<a class="back-link" href="<?php echo base_url('inventory'); ?>">Back to Inventory</a>
		<a class="back-link" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
	</div>
</form>

<script>
	document.addEventListener("DOMContentLoaded", function () {
		
		const salesEntries = document.getElementById('sales-entries');
		const addRowButton = document.getElementById('add-row');
		const submitSalesButton = document.getElementById('submit-sales');

		// Function to calculate total price
		function calculateTotal(row) {
			const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
			const sellingPrice = parseFloat(row.querySelector('.discount_price').value) || 0;
			row.querySelector('.total_price').value = (quantity * sellingPrice).toFixed(2);
		}

		// Event delegation for dynamically added rows
		salesEntries.addEventListener('input', function (e) {
			const row = e.target.closest('.sales-entry');
			if (row) {
				calculateTotal(row);
			}
		});

		salesEntries.addEventListener('change', function (e) {
			const row = e.target.closest('.sales-entry');
			if (e.target.classList.contains('product_id')) {
				const selectedOption = e.target.options[e.target.selectedIndex];
				const price = selectedOption.getAttribute('data-price');
				const selling_price = selectedOption.getAttribute('data-selling_price');
				row.querySelector('.price').value = price || '';
				row.querySelector('.selling_price').value = selling_price || '';
				calculateTotal(row);
			}
		});

		// Add new row
		addRowButton.addEventListener('click', function () {
			const firstRow = salesEntries.querySelector('.sales-entry');
			const newRow = firstRow.cloneNode(true);
			newRow.querySelectorAll('input').forEach(input => input.value = '');
			salesEntries.appendChild(newRow);
		});

		// Remove a row
		salesEntries.addEventListener('click', function (e) {
			if (e.target.classList.contains('remove-row')) {
				const row = e.target.closest('.sales-entry');
				if (salesEntries.querySelectorAll('.sales-entry').length > 1) {
					row.remove();
				} else {
					alert("At least one row is required!");
				}
			}
		});

		// Submit sales data
		submitSalesButton.addEventListener('click', function () {
			const salesData = [];
			const rows = salesEntries.querySelectorAll('.sales-entry');

			rows.forEach(row => {
				const product_id = row.querySelector('.product_id').value;
				const price = row.querySelector('.price').value;
				const selling_price = row.querySelector('.selling_price').value;
				const discount_price = row.querySelector('.discount_price').value;
				const quantity = row.querySelector('.quantity').value;
				const payment_type =row.querySelector('.payment_method').value;
				const customer_name =row.querySelector('.customer_name').value;
				const description =row.querySelector('.description').value;
				const mobile_number =row.querySelector('.mobile_number').value;
				const warranty =row.querySelector('.warranty').value;
				const total_price = row.querySelector('.total_price').value;

				if (product_id && selling_price && quantity) {
					salesData.push({
						product_id,
						price,
						selling_price,
						discount_price,
						quantity,
						payment_type,
						customer_name,
						description,
						mobile_number,
						warranty,
						total_price,
					});
				}
			});

			if (salesData.length > 0) {
				// Send data via AJAX
				fetch('<?php echo base_url("sales/save"); ?>', {
					method: 'POST',
					headers: { 'Content-Type': 'application/json' },
					body: JSON.stringify({ sales: salesData }),
				})
					.then(response => {
						if (!response.ok) {
							throw new Error('Network response was not ok');
						}
						return response.json(); // Parse JSON response
					})
					.then(data => {
						alert(data.message);
						if (data.success) {
							window.location.reload();
						}
					})
					.catch(error => {
						console.error('Error:', error);
						alert('Failed to record sales.');
					});
			} else {
				alert('Please fill out all required fields before submitting.');
			}
		});
	});
</script>
</body>
