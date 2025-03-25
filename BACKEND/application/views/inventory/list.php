<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Product Inventory</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
	<style>
		/* Additional Styles */
		body {
			font-family: 'Inter', Arial, sans-serif;
			background-color: #f8f9fa;
		}

		h1 {
			margin: 20px 0;
			color: #0d6efd;
			text-align: center;
		}

		.table-container {
			background: #fff;
			padding: 20px;
			border-radius: 10px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		}

		.btn-custom {
			border-radius: 50px;
			transition: all 0.3s ease;
		}

		.btn-custom:hover {
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
		}

		.table th {
			background-color: #0d6efd;
			color: white;
			text-transform: uppercase;
		}

		.table tr:hover {
			background-color: #e9f5ff;
		}

		.flash-message {
			font-weight: bold;
			text-align: center;
			color: green;
		}
	</style>
</head>
<body>

<div class="container my-5">
	<!-- Heading -->
	<h1>Product Inventory</h1>

	<!-- Add Product and Back to Dashboard Buttons -->
	<div class="d-flex justify-content-between mb-4">
		<a href="<?php echo base_url('inventory/add'); ?>" class="btn btn-primary btn-custom">Add New Product</a>
		<a href="<?php echo base_url('dashboard'); ?>" class="btn btn-secondary btn-custom">Dashboard</a>
	</div>

	<!-- Search and Filter -->
	<form method="get" action="<?php echo base_url('inventory'); ?>" class="d-flex mb-4">
		<input type="text" name="search" placeholder="Search by name" value="<?php echo $this->input->get('search'); ?>" class="form-control me-2">
		<button type="submit" class="btn btn-primary btn-custom me-2">Filter</button>
		<a href="<?php echo base_url('inventory'); ?>" class="btn btn-secondary btn-custom">Reset</a>
	</form>

	<!-- Flash Message -->
	<?php if ($this->session->flashdata('message')): ?>
		<div class="alert alert-success text-center">
			<?php echo $this->session->flashdata('message'); ?>
		</div>
	<?php endif; ?>

	<!-- Inventory Table -->
	<div class="table-container">
		<table class="table table-hover table-striped align-middle">
			<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Category</th>
				<th>Price</th>
				<th>Selling Price</th>
				<th>Stock</th>
				<th>Actions</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($products as $product): ?>
				<tr>
					<td><?php echo $product->product_id; ?></td>
					<td><?php echo $product->name; ?></td>
					<td><?php echo $product->category; ?></td>
					<td><?php echo number_format($product->price, 2); ?></td>
					<td><?php echo number_format($product->selling_price, 2); ?></td>
					<td><?php echo $product->stock; ?></td>
					<td>
						<a href="<?php echo base_url('inventory/edit/'.$product->product_id); ?>" class="btn btn-success btn-sm btn-custom">Edit</a>
						<a href="<?php echo base_url('inventory/delete/'.$product->product_id); ?>" class="btn btn-danger btn-sm btn-custom"
						   onclick="return confirm('Delete this product?')">Delete</a>
						<a href="<?php echo base_url('inventory/print_barcode/'.$product->barcode); ?>" class="btn btn-info btn-sm btn-custom">Print Barcode</a>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
