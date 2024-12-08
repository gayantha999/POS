<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sales Entry</title>

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
	<!-- Select2 CSS -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

	<style>
		body {
			background-color: #f8f9fa;
			font-family: 'Arial', sans-serif;
			margin: 0;
			padding: 0;
		}

		.sales-form {
			background-color: #ffffff;
			border-radius: 8px;
			padding: 20px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		}

		.form-header {
			background-color: #007bff;
			color: white;
			padding: 15px;
			border-radius: 8px 8px 0 0;
		}

		.form-header h1 {
			font-size: 1.5rem;
			margin: 0;
		}

		.remove-row {
			color: #ece5e5;
			cursor: pointer;
		}

		.btn-add {
			background-color: #28a745;
			color: white;
		}

		.btn-add:hover {
			background-color: #218838;
		}

		.btn-submit {
			background-color: #007bff;
			color: white;
		}

		.btn-submit:hover {
			background-color: #0056b3;
		}

		.button-container a {
			text-decoration: none;
			color: white;
		}

		.button-container a:hover {
			color: #d4d4d4;
		}
	</style>
</head>
<body>
<div class="container my-5">
	<div class="sales-form">
		<div class="form-header text-center">
			<h1>Sales Entry</h1>
		</div>
		<form id="sales-form" class="mt-4">
			<div id="sales-entries">
				<div class="row sales-entry gy-3">
					<div class="col-md-6">
						<label for="product_id" class="form-label">Product:</label>
						<select name="product_id[]" class="form-control product_id select2" required>
							<option value="">Select Product</option>
							<?php foreach ($products as $product): ?>
								<option value="<?php echo $product->product_id; ?>" data-price="<?php echo $product->price; ?>" data-selling_price="<?php echo $product->selling_price; ?>">
									<?php echo $product->name; ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-3">
						<label for="price" class="form-label">Price:</label>
						<input type="text" class="form-control price" name="price[]" readonly>
					</div>
					<div class="col-md-3">
						<label for="selling_price" class="form-label">Selling Price:</label>
						<input type="text" class="form-control selling_price" name="selling_price[]" readonly>
					</div>
					<div class="col-md-3">
						<label for="discount_price" class="form-label">Discount Price:</label>
						<input type="number" class="form-control discount_price" name="discount_price[]" step="0.01" required>
					</div>
					<div class="col-md-3">
						<label for="quantity" class="form-label">Quantity:</label>
						<input type="number" class="form-control quantity" name="quantity[]" min="1" required>
					</div>
					<div class="col-md-3">
						<label for="total_price" class="form-label">Total Price:</label>
						<input type="text" class="form-control total_price" name="total_price[]" readonly>
					</div>
					<div class="col-md-3">
						<label for="customer_name" class="form-label">Customer Name:</label>
						<input type="text" class="form-control customer_name" name="customer_name[]">
					</div>
					<div class="col-md-3">
						<label for="description" class="form-label">Description:</label>
						<input type="text" class="form-control description" name="description[]">
					</div>
					<div class="col-md-3">
						<label for="mobile_number" class="form-label">Mobile Number:</label>
						<input type="text" class="form-control mobile_number" name="mobile_number[]">
					</div>
					<div class="col-md-3">
						<label for="warranty" class="form-label">Warranty:</label>
						<input type="text" class="form-control warranty" name="warranty[]">
					</div>
					<div class="col-md-3">
						<label for="payment_method" class="form-label">Payment Method:</label>
						<select class="form-control payment_method" name="payment_method[]" required>
							<option value="">Select Payment Method</option>
							<option value="cash">Cash</option>
							<option value="card">Card</option>
						</select>
					</div>
					<div class="col-12">
						<button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
					</div>
				</div>
			</div>

			<div class="text-end mt-3">
				<button type="button" id="add-row" class="btn btn-add">Add Row</button>
			</div>
			<div class="text-center mt-4">
				<button type="button" id="submit-sales" class="btn btn-submit">Record Sales</button>
			</div>
			<div class="button-container text-center mt-4">
				<a class="btn btn-secondary mx-2" href="<?php echo base_url('inventory'); ?>">Back to Inventory</a>
				<a class="btn btn-secondary mx-2" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
			</div>
		</form>
	</div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
</html>
