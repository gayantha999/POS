<!DOCTYPE html>
<html>
<head>
	<title>Sales List</title>
	<style>
		table {
			width: 100%;
			border-collapse: collapse;
		}
		table, th, td {
			border: 1px solid black;
		}
		th, td {
			padding: 10px;
			text-align: left;
		}
		th {
			background-color: #f2f2f2;
		}
		.btn {
			padding: 10px 20px;
			background-color: #4CAF50;
			color: white;
			text-decoration: none;
			border-radius: 5px;
		}
		.btn:hover {
			background-color: #45a049;
		}
	</style>
</head>
<body>
<h1>Sales List</h1>
<a class="btn" href="<?php echo base_url('sales/add'); ?>">Add Sale</a>

<?php if (!empty($sales)): ?>
	<table>
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
<?php else: ?>
	<p>No sales have been recorded yet.</p>
<?php endif; ?>
</body>
</html>
