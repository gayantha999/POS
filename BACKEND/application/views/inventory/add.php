<!DOCTYPE html>
<html>
<head>
	<title>Add New Product</title>
	<style>
		/* General Styles */
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			background: linear-gradient(135deg, #e0e0e0, #f4f4f4);
			min-height: 100vh;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		/* Container Styles */
		.container {
			background: #fff;
			padding: 30px 40px;
			border-radius: 12px;
			box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
			width: 100%;
			max-width: 500px;
		}

		h1 {
			text-align: center;
			color: #333;
			margin-bottom: 20px;
			font-size: 24px;
			font-weight: bold;
		}

		/* Form Styles */
		form {
			display: flex;
			flex-direction: column;
		}

		label {
			font-weight: bold;
			margin-bottom: 5px;
			color: #555;
		}

		input {
			padding: 12px;
			margin-bottom: 15px;
			border: 1px solid #ccc;
			border-radius: 6px;
			font-size: 16px;
		}

		input:focus {
			outline: none;
			border-color: #007bff;
			box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
		}

		button {
			padding: 12px;
			font-size: 16px;
			font-weight: bold;
			color: #fff;
			background-color: #007bff;
			border: none;
			border-radius: 6px;
			cursor: pointer;
			transition: all 0.3s ease;
		}

		button:hover {
			background-color: #0056b3;
		}

		/* Button Links Styles */
		.link-button {
			display: inline-block;
			text-align: center;
			padding: 10px 20px;
			font-size: 14px;
			font-weight: bold;
			text-decoration: none;
			border-radius: 6px;
			margin-bottom: 20px;
			transition: all 0.3s ease;
			color: #fff;
		}

		.link-button.back {
			background-color: #f44336;
		}

		.link-button.back:hover {
			background-color: #d32f2f;
		}

		.link-button.dashboard {
			background-color: #4caf50;
		}

		.link-button.dashboard:hover {
			background-color: #388e3c;
		}

		/* Button Group */
		.button-container {
			display: flex;
			justify-content: space-between;
			margin-bottom: 20px;
		}

		/* Error Messages */
		.error-message {
			color: red;
			font-size: 14px;
			margin-bottom: 15px;
		}
	</style>
</head>
<body>
<div class="container">
	<h1>Add New Product</h1>

	<!-- Button Links -->
	<div class="button-container">
		<a class="link-button back" href="<?php echo base_url('inventory'); ?>">Back to Inventory</a>
		<a class="link-button dashboard" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
	</div>

	<!-- Error Messages -->
	<?php if (validation_errors()): ?>
		<div class="error-message">
			<?php echo validation_errors(); ?>
		</div>
	<?php endif; ?>

	<!-- Add Product Form -->
	<form action="<?php echo base_url('inventory/save'); ?>" method="post">
		<label for="name">Product Name:</label>
		<input type="text" id="name" name="name" value="<?php echo set_value('name'); ?>" required>

		<label for="category">Category:</label>
		<input type="text" id="category" name="category" value="<?php echo set_value('category'); ?>">

		<label for="price">Price:</label>
		<input type="number" id="price" name="price" step="0.01" value="<?php echo set_value('price'); ?>" required>

		<label for="selling_price">Selling Price:</label>
		<input type="number" id="selling_price" name="selling_price" step="0.01" value="<?php echo set_value('selling_price'); ?>" required>

		<label for="stock">Stock:</label>
		<input type="number" id="stock" name="stock" value="<?php echo set_value('stock'); ?>" required>

		<label for="low_stock_threshold">Low Stock Threshold:</label>
		<input type="number" id="low_stock_threshold" name="low_stock_threshold" value="<?php echo set_value('low_stock_threshold', 10); ?>" required>

		<button type="submit">Add Product</button>
	</form>
</div>
</body>
</html>
