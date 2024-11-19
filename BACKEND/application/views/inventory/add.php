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
			background-color: #f4f6f9;
			display: flex;
			justify-content: center;
			align-items: center;
			min-height: 100vh;
		}

		/* Container Styles */
		.container {
			background: #ffffff;
			padding: 20px 30px;
			border-radius: 8px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			width: 100%;
			max-width: 500px;
		}

		h1 {
			text-align: center;
			color: #333;
			margin-bottom: 20px;
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
			padding: 10px;
			margin-bottom: 15px;
			border: 1px solid #ddd;
			border-radius: 5px;
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
			border-radius: 5px;
			cursor: pointer;
			transition: all 0.3s ease;
		}

		button:hover {
			background-color: #0056b3;
		}

		.back-link {
			display: inline-block;
			margin-bottom: 20px;
			font-size: 14px;
			color: #007bff;
			text-decoration: none;
		}

		.back-link:hover {
			text-decoration: underline;
		}

		.error-message {
			color: red;
			margin-bottom: 15px;
			font-size: 14px;
		}

		/* General button styles */
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
			background-color: #f44336; /* Red color */
		}

		a.back-link:hover {
			background-color: #d32f2f; /* Darker red on hover */
			box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
		}

		/* Specific styles for Dashboard button */
		a.add-button {
			background-color: #4caf50; /* Green color */
		}

		a.add-button:hover {
			background-color: #388e3c; /* Darker green on hover */
			box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
		}

		/* Optional: Container for alignment */
		.button-container {
			display: flex;
			justify-content: center;
			gap: 20px; /* Space between buttons */
			margin-top: 20px;
		}
	</style>
</head>
<body>
<div class="container">
	<h1>Add New Product</h1>
	<div class="button-container">
		<a class="back-link" href="<?php echo base_url('inventory'); ?>">Back to Inventory</a>
		<a class="back-link" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
	</div>

	<?php if (validation_errors()): ?>
		<div class="error-message">
			<?php echo validation_errors(); ?>
		</div>
	<?php endif; ?>

	<form action="<?php echo base_url('inventory/save'); ?>" method="post">
		<label for="name">Product Name:</label>
		<input type="text" id="name" name="name" value="<?php echo set_value('name'); ?>" required>

		<label for="category">Category:</label>
		<input type="text" id="category" name="category" value="<?php echo set_value('category'); ?>">

		<label for="price">Price:</label>
		<input type="number" id="price" name="price" step="0.01" value="<?php echo set_value('price'); ?>" required>

		<label for="stock">Stock:</label>
		<input type="number" id="stock" name="stock" value="<?php echo set_value('stock'); ?>" required>

		<label for="low_stock_threshold">Low Stock Threshold:</label>
		<input type="number" id="low_stock_threshold" name="low_stock_threshold" value="<?php echo set_value('low_stock_threshold', 10); ?>" required>

		<button type="submit">Add Product</button>
	</form>
</div>
</body>
</html>
