<!DOCTYPE html>
<html>
<head>
	<title>Add Sale</title>
</head>
<body>
<h1>Add Sale</h1>
<a href="<?php echo base_url('sales'); ?>">Back to Sales List</a>

<?php if (validation_errors()): ?>
	<div style="color: red;">
		<?php echo validation_errors(); ?>
	</div>
<?php endif; ?>

<form action="<?php echo base_url('sales/save'); ?>" method="post">
	<label for="product_id">Product:</label>
	<select id="product_id" name="product_id" required>
		<option value="">Select Product</option>
		<?php foreach ($products as $product): ?>
			<option value="<?php echo $product->id; ?>">
				<?php echo $product->name; ?>
			</option>
		<?php endforeach; ?>
	</select><br><br>

	<label for="quantity">Quantity:</label>
	<input type="number" id="quantity" name="quantity" min="1" required><br><br>

	<label for="customer_name">Customer Name (Optional):</label>
	<input type="text" id="customer_name" name="customer_name"><br><br>

	<button type="submit">Record Sale</button>
</form>
</body>
</html>
