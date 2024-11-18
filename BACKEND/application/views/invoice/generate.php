<!DOCTYPE html>
<html>
<head>
	<title>Invoice #<?php echo $sale->id; ?></title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 20px;
		}
		.header, .footer {
			text-align: center;
			margin-bottom: 20px;
		}
		.content {
			margin: 20px 0;
		}
		.content table {
			width: 100%;
			border-collapse: collapse;
		}
		.content table th, .content table td {
			border: 1px solid #ddd;
			padding: 10px;
		}
		.content table th {
			background-color: #f4f4f4;
		}
		.total {
			text-align: right;
			margin-top: 20px;
		}
	</style>
</head>
<body>
<div class="header">
	<h1>Mobile Shop</h1>
	<p>Invoice #<?php echo $sale->id; ?></p>
	<p>Date: <?php echo $sale->sale_date; ?></p>
</div>

<div class="content">
	<h2>Customer Details</h2>
	<p>Name: <?php echo $sale->customer_name; ?></p>

	<h2>Product Details</h2>
	<table>
		<thead>
		<tr>
			<th>Product</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Total</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><?php echo $sale->product_name; ?></td>
			<td><?php echo $sale->quantity; ?></td>
			<td><?php echo number_format($sale->price, 2); ?></td>
			<td><?php echo number_format($sale->total_price, 2); ?></td>
		</tr>
		</tbody>
	</table>

	<div class="total">
		<h3>Total: <?php echo number_format($sale->total_price, 2); ?></h3>
	</div>
</div>

<div class="footer">
	<p>Thank you for your purchase!</p>
</div>
</body>
</html>
