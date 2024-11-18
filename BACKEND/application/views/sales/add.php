<!DOCTYPE html>
<html>
<head>
	<title>Add Sale</title>
	<style>
		/* General Styling */
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 20px;
			background-color: #f9f9f9;
		}

		h1 {
			text-align: center;
			color: #333;
			margin-bottom: 20px;
		}

		/* Form Container */
		.form-container {
			max-width: 600px;
			margin: 0 auto;
			background: #fff;
			padding: 20px;
			border-radius: 8px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		}

		/* Back Button */
		.back-button {
			display: inline-block;
			margin-bottom: 20px;
			padding: 10px 15px;
			font-size: 14px;
			font-weight: bold;
			color: #fff;
			background-color: #6c757d;
			text-decoration: none;
			border-radius: 4px;
		}

		.back-button:hover {
			background-color: #5a6268;
		}

		/* Input and Select */
		label {
			display: block;
			font-weight: bold;
			margin-bottom: 8px;
			color: #555;
		}

		input[type="text"],
		input[type="number"],
		select {
			width: 100%;
			padding: 10px;
			margin-bottom: 20px;
			border: 1px solid #ddd;
			border-radius: 4px;
			font-size: 14px;
		}

		input:focus,
		select:focus {
			border-color: #007bff;
			outline: none;
		}

		/* Buttons */
		.btn {
			display: inline-block;
			width: 100%;
			padding: 10px;
			font-size: 16px;
			font-weight: bold;
			text-align: center;
			color: #fff;
			background-color: #007bff;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			box-shadow: 0 4px 6px rgba(0, 123, 255, 0.3);
		}

		.btn:hover {
			background-color: #0056b3;
		}

		/* Error Messages */
		.error-message {
			color: red;
			font-weight: bold;
			margin-bottom: 20px;
		}
	</style>
</head>
<body>
<h1>Add Sale</h1>
<div class="form-container">
	<a class="back-button" href="<?php echo base_url('sales'); ?>">Back to Sales List</a>

	<?php if (validation_errors()): ?>
		<div class="error-message">
			<?php echo validation_errors(); ?>
		</div>
	<?php endif; ?>

	<form action="<?php echo base_url('sales/save'); ?>" method="post">
		<label for="product_id">Product:</label>
		<select id="product_id" name="product_id" required>
			<option value="">Select Product</option>
			<?php foreach ($products as $product): ?>
				<option value="<?php echo $product->product_id; ?>">
					<?php echo $product->name; ?>
				</option>
			<?php endforeach; ?>
		</select>

		<label for="quantity">Quantity:</label>
		<input type="number" id="quantity" name="quantity" min="1" required>

		<label for="customer_name">Customer Name (Optional):</label>
		<input type="text" id="customer_name" name="customer_name">

		<button type="submit" class="btn">Record Sale</button>
	</form>
</div>
</body>
</html>
