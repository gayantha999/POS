<!DOCTYPE html>
<html>
<head>
	<title>Edit Product</title>
	<style>
		/* General Styles */
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 20px;
			background-color: #f4f6f9;
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

		/* Labels and Inputs */
		label {
			display: block;
			font-weight: bold;
			margin-bottom: 8px;
			color: #555;
		}

		input[type="text"],
		input[type="number"] {
			width: 100%;
			padding: 10px;
			margin-bottom: 20px;
			border: 1px solid #ddd;
			border-radius: 4px;
			font-size: 14px;
		}

		input[type="number"]::-webkit-inner-spin-button {
			margin: 0;
		}

		input:focus {
			border-color: #007bff;
			outline: none;
		}

		/* Buttons */
		.btn {
			display: inline-block;
			padding: 10px 20px;
			font-size: 16px;
			font-weight: bold;
			text-align: center;
			text-decoration: none;
			color: #fff;
			border-radius: 5px;
			background-color: #007bff;
			box-shadow: 0 4px 6px rgba(0, 123, 255, 0.3);
			cursor: pointer;
		}

		.btn:hover {
			background-color: #0056b3;
		}

		.btn-secondary {
			background-color: #6c757d;
		}

		.btn-secondary:hover {
			background-color: #5a6268;
		}

		/* Error Message */
		.error-message {
			color: red;
			font-weight: bold;
			margin-bottom: 20px;
		}
	</style>
</head>
<body>
<h1>Edit Product</h1>
<div class="form-container">
	<a class="btn btn-secondary" href="<?php echo base_url('inventory'); ?>">Back to Inventory</a>

	<?php if (validation_errors()): ?>
		<div class="error-message">
			<?php echo validation_errors(); ?>
		</div>
	<?php endif; ?>

	<form action="<?php echo base_url('inventory/update/' . $product->product_id); ?>" method="post">
		<label for="name">Product Name:</label>
		<input type="text" id="name" name="name" value="<?php echo set_value('name', $product->name); ?>" required>

		<label for="category">Category:</label>
		<input type="text" id="category" name="category" value="<?php echo set_value('category', $product->category); ?>">

		<label for="price">Price:</label>
		<input type="number" id="price" name="price" step="0.01" value="<?php echo set_value('price', $product->price); ?>" required>

		<label for="stock">Stock:</label>
		<input type="number" id="stock" name="stock" value="<?php echo set_value('stock', $product->stock); ?>" required>

		<label for="low_stock_threshold">Low Stock Threshold:</label>
		<input type="number" id="low_stock_threshold" name="low_stock_threshold" value="<?php echo set_value('low_stock_threshold', $product->low_stock_threshold); ?>" required>

		<button type="submit" class="btn">Update Product</button>
	</form>
</div>
</body>
</html>
