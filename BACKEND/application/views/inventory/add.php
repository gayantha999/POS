<!DOCTYPE html>
<html>
<head>
	<title>Add New Product</title>
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: #f8f9fa;">
<div class="container mt-5">
	<div class="card shadow">
		<div class="card-header bg-primary text-white text-center">
			<h1>Add New Product</h1>
		</div>
		<div class="card-body">
			<!-- Button Links -->
			<div class="d-flex justify-content-between mb-4">
				<a class="btn btn-danger" href="<?php echo base_url('inventory'); ?>">Back to Inventory</a>
				<a class="btn btn-success" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
			</div>

			<!-- Error Messages -->
			<?php if (validation_errors()): ?>
				<div class="alert alert-danger">
					<?php echo validation_errors(); ?>
				</div>
			<?php endif; ?>

			<!-- Add Product Form -->
			<form action="<?php echo base_url('inventory/save'); ?>" method="post">
				<div class="mb-3">
					<label for="name" class="form-label">Product Name:</label>
					<input type="text" id="name" name="name" class="form-control" value="<?php echo set_value('name'); ?>" required>
				</div>

				<div class="mb-3">
					<label for="category" class="form-label">Category:</label>
					<input type="text" id="category" name="category" class="form-control" value="<?php echo set_value('category'); ?>">
				</div>

				<div class="mb-3">
					<label for="price" class="form-label">Price:</label>
					<input type="number" id="price" name="price" class="form-control" step="0.01" value="<?php echo set_value('price'); ?>" required>
				</div>

				<div class="mb-3">
					<label for="selling_price" class="form-label">Selling Price:</label>
					<input type="number" id="selling_price" name="selling_price" class="form-control" step="0.01" value="<?php echo set_value('selling_price'); ?>" required>
				</div>

				<div class="mb-3">
					<label for="stock" class="form-label">Stock:</label>
					<input type="number" id="stock" name="stock" class="form-control" value="<?php echo set_value('stock'); ?>" required>
				</div>

				<div class="mb-3">
					<label for="low_stock_threshold" class="form-label">Low Stock Threshold:</label>
					<input type="number" id="low_stock_threshold" name="low_stock_threshold" class="form-control" value="<?php echo set_value('low_stock_threshold', 10); ?>" required>
				</div>

				<button type="submit" class="btn btn-primary w-100">Add Product</button>
			</form>
		</div>
	</div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
