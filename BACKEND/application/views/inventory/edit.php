<!DOCTYPE html>
<html>
<head>
	<title>Edit Product</title>
</head>
<body>
<h1>Edit Product</h1>
<a href="<?php echo base_url('inventory'); ?>">Back to Inventory</a>

<?php if (validation_errors()): ?>
	<div style="color: red;">
		<?php echo validation_errors(); ?>
	</div>
<?php endif; ?>

<form action="<?php echo base_url('inventory/update/' . $product->product_id); ?>" method="post">
	<label for="name">Product Name:</label>
	<input type="text" id="name" name="name" value="<?php echo set_value('name', $product->name); ?>" required><br><br>

	<label for="category">Category:</label>
	<input type="text" id="category" name="category" value="<?php echo set_value('category', $product->category); ?>"><br><br>

	<label for="price">Price:</label>
	<input type="number" id="price" name="price" step="0.01" value="<?php echo set_value('price', $product->price); ?>" required><br><br>

	<label for="stock">Stock:</label>
	<input type="number" id="stock" name="stock" value="<?php echo set_value('stock', $product->stock); ?>" required><br><br>

	<label for="low_stock_threshold">Low Stock Threshold:</label>
	<input type="number" id="low_stock_threshold" name="low_stock_threshold" value="<?php echo set_value('low_stock_threshold', $product->low_stock_threshold); ?>" required><br><br>

	<button type="submit">Update Product</button>
</form>
</body>
</html>
