<!DOCTYPE html>
<html>
<head>
	<title>Inventory</title>
</head>
<body>
<h1>Product Inventory</h1>
<a href="<?php echo base_url('inventory/add'); ?>">Add New Product</a>
<table border="1">
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Category</th>
		<th>Price</th>
		<th>Stock</th>
		<th>Actions</th>
	</tr>
	<?php foreach ($products as $product): ?>
		<tr>
			<td><?php echo $product->product_id; ?></td>
			<td><?php echo $product->name; ?></td>
			<td><?php echo $product->category; ?></td>
			<td><?php echo $product->price; ?></td>
			<td><?php echo $product->stock; ?></td>
			<td>
				<a href="<?php echo base_url('inventory/edit/'.$product->product_id); ?>">Edit</a>
				<a href="<?php echo base_url('inventory/delete/'.$product->product_id); ?>" onclick="return confirm('Delete this product?')">Delete</a>
			</td>
		</tr>
	<?php endforeach; ?>

	<?php if ($this->session->flashdata('message')): ?>
		<div style="color: green;">
			<?php echo $this->session->flashdata('message'); ?>
		</div>
	<?php endif; ?>


</table>
</body>
</html>
