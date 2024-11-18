<!DOCTYPE html>
<html>
<head>
	<title>Add New Product</title>
</head>
<body>
<h1>Add New Product</h1>
<a href="<?php echo base_url('inventory'); ?>">Back to Inventory</a>

<?php if (validation_errors()): ?>
	<div style="color: red;">
		<?php echo validation_errors(); ?>
	</div>
<?php endif; ?>

<form action="<?php echo base_url('inventory/save'); ?>" method="post">
	<label for="name">Product Name:</label>
	<input type="text" id="name" name="name" value="<?php echo set_value('name'); ?>" required><br><br>

	<label for="category">Category:</label>
	<input type="text" id="category" name="category" value="<?php echo set_value('category'); ?>"><br><br>

	<label for="price">Price:</label>
	<input type="number" id="price" name="price" step="0.01" value="<?php echo set_value('price'); ?>" required><br><br>

	<label for="stock">Stock:</label>
	<input type="number" id="stock" name="stock" value="<?php echo set_value('stock'); ?>" required><br><br>

	<label for="low_stock_threshold">Low Stock Threshold:</label>
	<input type="number" id="low_stock_threshold" name="low_stock_threshold" value="<?php echo set_value('low_stock_threshold', 10); ?>" required><br><br>

	<button type="submit">Add Product</button>
</form>
</body>
</html>
