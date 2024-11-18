<!DOCTYPE html>
<html>
<head>
	<title>Sales List</title>
</head>
<body>
<h1>Sales List</h1>
<a href="<?php echo base_url('sales/add'); ?>">Add Sale</a>

<?php if ($this->session->flashdata('message')): ?>
	<div style="color: green;">
		<?php echo $this->session->flashdata('message'); ?>
	</div>
<?php endif; ?>

<table border="1">
	<thead>
	<tr>
		<th>Sale ID</th>
		<th>Product</th>
		<th>Quantity</th>
		<th>Total Price</th>
		<th>Customer Name</th>
		<th>Sale Date</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($sales as $sale): ?>
		<tr>
			<td><?php echo $sale->id; ?></td>
			<td><?php echo $sale->product_name; ?></td>
			<td><?php echo $sale->quantity; ?></td>
			<td><?php echo $sale->total_price; ?></td>
			<td><?php echo $sale->customer_name ?: 'N/A'; ?></td>
			<td><?php echo $sale->sale_date; ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
</body>
</html>
