<form action="<?php echo base_url('sales/save'); ?>" method="post" class="sales-form">
	<div class="form-group">
		<label for="product_id">Product:</label>
		<select id="product_id" name="product_id" required>
			<option value="">Select Product</option>
			<?php foreach ($products as $product): ?>
				<option value="<?php echo $product->product_id; ?>" data-price="<?php echo $product->price; ?>">
					<?php echo $product->name; ?>
				</option>
			<?php endforeach; ?>
		</select>
	</div>

	<div class="form-group">
		<label for="price">Price:</label>
		<input type="text" id="price" name="price" readonly>
	</div>

	<div class="form-group">
		<label for="selling_price">Selling Price:</label>
		<input type="number" id="selling_price" name="selling_price" step="0.01" required>
	</div>

	<div class="form-group">
		<label for="quantity">Quantity:</label>
		<input type="number" id="quantity" name="quantity" min="1" required>
	</div>

	<div class="form-group">
		<label for="customer_name">Customer Name (Optional):</label>
		<input type="text" id="customer_name" name="customer_name">
	</div>

	<div class="form-group">
		<label for="description">Description:</label>
		<input type="text" id="description" name="description">
	</div>

	<div class="form-group">
		<label for="warranty">Warranty:</label>
		<input type="text" id="warranty" name="warranty">
	</div>

	<div class="form-group">
		<label for="payment_method">Payment Method:</label>
		<select id="payment_method" name="payment_method" required>
			<option value="">Select Payment Method</option>
			<option value="cash">Cash</option>
			<option value="card">Card</option>
		</select>
	</div>

	<div class="form-group">
		<label for="total_price">Total Price:</label>
		<input type="text" id="total_price" name="total_price" readonly>
	</div>

	<button type="submit" class="btn">Record Sale</button>
	<div class="button-container">
		<a class="back-link" href="<?php echo base_url('inventory'); ?>">Back to Inventory</a>
		<a class="back-link" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
	</div>
</form>

<script>
	// Update price and total dynamically
	document.getElementById('product_id').addEventListener('change', function () {
		const selectedOption = this.options[this.selectedIndex];
		const price = selectedOption.getAttribute('data-price');
		document.getElementById('price').value = price || '';
		calculateTotal();
	});

	document.getElementById('quantity').addEventListener('input', calculateTotal);
	document.getElementById('selling_price').addEventListener('input', calculateTotal);

	function calculateTotal() {
		const quantity = parseFloat(document.getElementById('quantity').value) || 0;
		const sellingPrice = parseFloat(document.getElementById('selling_price').value) || 0;
		document.getElementById('total_price').value = (quantity * sellingPrice).toFixed(2);
	}
</script>

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
		width: 400px;
		max-width: 100%;
	}

	.form-group {
		margin-bottom: 15px;
	}

	label {
		display: block;
		font-weight: bold;
		margin-bottom: 5px;
	}

	input, select, button {
		width: 100%;
		padding: 10px;
		font-size: 14px;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
	}

	button {
		background-color: #28a745;
		color: #ffffff;
		border: none;
		cursor: pointer;
		font-weight: bold;
		margin-top: 10px;
	}

	button:hover {
		background-color: #218838;
	}

	input[readonly] {
		background-color: #f5f5f5;
	}

	.form-group:last-child {
		margin-bottom: 0;
	}

	/* General button styles */
	a.back-link {
		display: inline-block;
		padding: 10px 20px;
		font-size: 16px;
		color: #fff;
		text-decoration: none;
		border-radius: 5px;
		background-color: #f44336; /* Red */
		transition: all 0.3s ease;
	}

	a.back-link:hover {
		background-color: #d32f2f; /* Darker red */
	}

	.button-container {
		display: flex;
		justify-content: center;
		gap: 20px;
		margin-top: 20px;
	}
</style>
