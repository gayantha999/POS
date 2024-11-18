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

<!-- Filter Form -->
<form method="get" action="<?php echo base_url('sales'); ?>">
	<label for="product_name">Product Name:</label>
	<input type="text" name="product_name" id="product_name" value="<?php echo $this->input->get('product_name'); ?>" placeholder="Enter product name">

	<label for="start_date">Start Date:</label>
	<input type="date" name="start_date" id="start_date" value="<?php echo $this->input->get('start_date'); ?>">

	<label for="end_date">End Date:</label>
	<input type="date" name="end_date" id="end_date" value="<?php echo $this->input->get('end_date'); ?>">

	<button type="submit" class="btn">Filter</button>
	<a href="<?php echo base_url('sales'); ?>" class="btn">Reset</a>
</form>


<!-- Sales Table -->
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
	<p>No sales found for the selected filters.</p>
<?php endif; ?>

<td>
	<a href="<?php echo base_url('invoice/generate/' . $sale->id); ?>" class="btn">View Invoice</a>
	<a href="<?php echo base_url('invoice/download/' . $sale->id); ?>" class="btn">Download Invoice</a>
</td>

</body>
</html>
