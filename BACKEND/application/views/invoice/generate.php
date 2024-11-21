<!DOCTYPE html>
<html>
<head>
	<title>Invoice #<?php echo $sale->id; ?></title>
	<style>
		/* General Styling */
		body {
			font-family: 'Roboto', Arial, sans-serif;
			margin: 0;
			padding: 20px;
			background-color: #f9f9f9;
			color: #333;
		}

		.container {
			max-width: 800px;
			margin: 0 auto;
			background: #ffffff;
			border: 1px solid #ddd;
			border-radius: 8px;
			padding: 20px;
			box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
		}

		.header {
			text-align: center;
			border-bottom: 2px solid #007bff;
			padding-bottom: 10px;
			margin-bottom: 20px;
		}

		.header h1 {
			margin: 0;
			font-size: 24px;
			color: #007bff;
		}

		.header .subtitle {
			margin-top: 5px;
			font-size: 14px;
			color: #555;
			font-style: italic;
		}

		.details {
			margin-bottom: 20px;
		}

		.details h2 {
			font-size: 20px;
			color: #333;
			border-bottom: 1px solid #ddd;
			padding-bottom: 5px;
			margin-bottom: 10px;
		}

		.details p {
			margin: 5px 0;
			font-size: 14px;
			color: #555;
		}

		/* Table Styling */
		table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 20px;
		}

		table th, table td {
			border: 1px solid #ddd;
			padding: 10px;
			text-align: left;
			font-size: 14px;
		}

		table th {
			background-color: #f4f4f4;
			color: #333;
		}

		table td {
			color: #555;
		}

		.total {
			text-align: right;
			font-size: 18px;
			font-weight: bold;
			color: #333;
		}

		.footer {
			text-align: center;
			margin-top: 20px;
			padding-top: 10px;
			border-top: 1px solid #ddd;
			font-size: 12px;
			color: #777;
		}

		.footer p {
			margin: 5px 0;
		}

		/* Print Styling */
		@media print {
			body {
				background: none;
			}

			.container {
				border: none;
				box-shadow: none;
			}

			.header, .footer {
				color: black;
			}
		}
	</style>
</head>
<body>
<div class="container">
	<div class="header">
		<h1>KD Mobile</h1>
		<p class="subtitle">Computer-Generated Invoice</p>
	</div>

	<div class="details">
		<h2>Invoice Details</h2>
		<p><strong>Invoice #:</strong> <?php echo $sale->id; ?></p>
		<p><strong>Date:</strong> <?php echo $sale->sale_date; ?></p>
		<p><strong>Customer Name:</strong> <?php echo $sale->customer_name ?: 'Not Provided'; ?></p>
	</div>

	<div class="details">
		<h2>Product Details</h2>
		<table>
			<thead>
			<tr>
				<th>Product</th>
				<th>Quantity</th>
				<th>Warranty</th>
<!--				<th>Unit Price</th>-->
				<th>Total</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td><?php echo $sale->product_name; ?></td>
				<td><?php echo $sale->quantity; ?></td>
				<td><?php echo $sale->warranty; ?></td>

				<td><?php echo number_format($sale->total_price, 2); ?> LKR</td>
			</tr>
			</tbody>
		</table>

		<div class="total">
			<p>Total: <?php echo number_format($sale->total_price, 2); ?> LKR</p>
		</div>
	</div>

	<div class="footer">
		<p>This is a computer-generated invoice; no signature is required.</p>
		<p>Thank you for shopping at KD Mobile!</p>
	</div>
</div>
</body>
</html>
