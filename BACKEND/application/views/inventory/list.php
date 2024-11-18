<!DOCTYPE html>
<html>
<head>
	<title>Product Inventory</title>
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

		/* Table Styles */
		table {
			width: 100%;
			border-collapse: collapse;
			margin: 20px 0;
			background: #fff;
			border-radius: 8px;
			overflow: hidden;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		}

		th, td {
			padding: 12px 15px;
			text-align: left;
		}

		th {
			background-color: #007bff;
			color: white;
			text-transform: uppercase;
			font-size: 14px;
		}

		tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		tr:hover {
			background-color: #d4e3ff;
		}

		td a {
			text-decoration: none;
			padding: 8px 12px;
			color: #fff;
			background-color: #28a745;
			border-radius: 5px;
			font-size: 14px;
			margin-right: 5px;
		}

		td a:hover {
			background-color: #218838;
		}

		.delete {
			background-color: #dc3545;
		}

		.delete:hover {
			background-color: #c82333;
		}

		/* Add Button */
		.add-button {
			display: inline-block;
			padding: 10px 20px;
			font-size: 16px;
			font-weight: bold;
			color: #fff;
			background-color: #007bff;
			text-align: center;
			border-radius: 5px;
			text-decoration: none;
			margin-bottom: 20px;
			box-shadow: 0 4px 6px rgba(0, 123, 255, 0.3);
		}

		.add-button:hover {
			background-color: #0056b3;
		}

		/* Flash Message */
		.flash-message {
			color: green;
			font-weight: bold;
			text-align: center;
			margin-bottom: 20px;
		}
	</style>
</head>
<body>
<h1>Product Inventory</h1>

<!-- Add New Product Button -->
<a class="add-button" href="<?php echo base_url('inventory/add'); ?>">Add New Product</a>

<!-- Flash Message -->
<?php if ($this->session->flashdata('message')): ?>
	<div class="flash-message">
		<?php echo $this->session->flashdata('message'); ?>
	</div>
<?php endif; ?>

<!-- Inventory Table -->
<table>
	<thead>
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Category</th>
		<th>Price</th>
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
			<td><?php echo $product->stock; ?></td>
			<td>
				<a href="<?php echo base_url('inventory/edit/'.$product->product_id); ?>">Edit</a>
				<a href="<?php echo base_url('inventory/delete/'.$product->product_id); ?>"
				   class="delete"
				   onclick="return confirm('Delete this product?')">Delete</a>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
</body>
</html>
