<!DOCTYPE html>
<html>
<head>
	<title>Invoice #<?php echo $sale->id; ?></title>
	<style>
		/* General Styling */
		body {
			font-family: Arial, sans-serif;
			margin: 20px;
			color: #333;
		}

		.header, .footer {
			text-align: center;
			margin-bottom: 20px;
		}

		.header h1 {
			margin: 0;
			color: #007bff;
		}

		.header p {
			margin: 5px 0;
			font-size: 14px;
			color: #666;
		}

		.content {
			margin: 20px 0;
		}

		.content h2 {
			margin-bottom: 10px;
			color: #555;
		}

		/* Table Styling */
		.content table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 20px;
		}

		.content table th, .content table td {
			border: 1px solid #ddd;
			padding: 10px;
			text-align: left;
		}

		.content table th {
			background-color: #f4f4f4;
			font-weight: bold;
		}

		.content table td {
			font-size: 14px;
		}

		.total {
			text-align: right;
			font-size: 18px;
			font-weight: bold;
			margin-top: 20px;
		}

		/* Footer */
		.footer p {
			font-size: 14px;
			color: #777;
		}

		/* Print Styling */
		@media print {
			body {
				margin: 0;
			}

			.header, .footer {
				color: black;
			}
		}
	</style>
</head>
<body>
<div class="header">
	<h1>Mobile Shop</h1>
	<p><strong>Invoice #<?php echo $sale->id; ?></strong></p>
	<p>Date: <?php echo $sale->sale_date; ?></p>
</div>

<div class="content">
	<!-- Customer Details -->
	<h2>Customer Details</h2>
	<p><strong>Name:</strong> <?php echo $sale->customer_name ?: 'Not Provided'; ?></p>

	<!-- Product Details -->
	<h2>Product Details</h2>
	<table>
		<thead>
		<tr>
			<th>Product</th>
			<th>Quantity</th>
			<th>Unit Price</th>
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

	<!-- Total -->
	<div class="total">
		<p>Total: <?php echo number_format($sale->total_price, 2); ?> LKR</p>
	</div>
</div>

<div class="footer">
	<p>Thank you for your purchase!</p>
	<p>If you have any questions, contact us at support@mobileshop.com.</p>
</div>
</body>
</html>
