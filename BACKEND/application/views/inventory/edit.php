<!DOCTYPE html>
<html>
<head>
	<title>Edit Product</title>
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: #f8f9fa;">
<div class="container mt-5">
	<div class="card shadow">
		<div class="card-header bg-primary text-white text-center">
			<h1>Edit Product</h1>
		</div>
		<div class="card-body">
			<!-- Back Button -->
			<div class="mb-4">
				<a class="btn btn-secondary" href="<?php echo base_url('inventory'); ?>">Back to Inventory</a>
			</div>

			<!-- Error Messages -->
			<?php if (validation_errors()): ?>
				<div class="alert alert-danger">
					<?php echo validation_errors(); ?>
				</div>
			<?php endif; ?>

			<!-- Edit Product Form -->
			<form action="<?php echo base_url('inventory/update/' . $product->product_id); ?>" method="post">
				<div class="mb-3">
					<label for="name" class="form-label">Product Name:</label>
					<input type="text" id="name" name="name" class="form-control" value="<?php echo set_value('name', $product->name); ?>" required>
				</div>

				<div class="mb-3">
					<label for="category" class="form-label">Category:</label>
					<input type="text" id="category" name="category" class="form-control" value="<?php echo set_value('category', $product->category); ?>">
				</div>

				<div class="mb-3">
					<label for="price" class="form-label">Price:</label>
					<input type="number" id="price" name="price" class="form-control" step="0.01" value="<?php echo set_value('price', $product->price); ?>" required>
				</div>

				<div class="mb-3">
					<label for="selling_price" class="form-label">Selling Price:</label>
					<input type="number" id="selling_price" name="selling_price" class="form-control" step="0.01" value="<?php echo set_value('selling_price', $product->selling_price); ?>" required>
				</div>

				<div class="mb-3">
					<label for="stock" class="form-label">Stock:</label>
					<input type="number" id="stock" name="stock" class="form-control" value="<?php echo set_value('stock', $product->stock); ?>" required>
				</div>

				<div class="mb-3">
					<label for="low_stock_threshold" class="form-label">Low Stock Threshold:</label>
					<input type="number" id="low_stock_threshold" name="low_stock_threshold" class="form-control" value="<?php echo set_value('low_stock_threshold', $product->low_stock_threshold); ?>" required>
				</div>

				<button type="submit" class="btn btn-primary w-100">Update Product</button>
			</form>
		</div>
	</div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
