<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
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
		.img_class {
			width: 200px; /* Set your desired width */
			height: auto; /* Maintain aspect ratio */
			display: block;
			margin: 0 auto;
		}
	</style>
</head>
<body>
<div class="container">
	<div class="header">
<!--		<h1>K.D. Mobile</h1>-->
		<img class="imgclass" src="assets/IMG_6574.PNG" alt="K.D. Mobile Logo">
		<div class="contact-info">
			<span>0704619736 | 0723101699</span>
			<span>No/33, New Shopping Complex, Mirigama</span>
		</div>
	</div>

	<div class="details">
		<h2>Invoice Details</h2>
		<p><strong>Invoice :</strong> <?php echo $invoice->invoice_number; ?></p>
		<p><strong>Date:</strong> <?php echo $invoice->sale_date; ?></p>
		<p><strong>Customer Name:</strong> <?php echo $invoice->customer_name ?: 'Not Provided'; ?></p>
	</div>

	<div class="details">
		<h2>Product Details</h2>
		<table>
			<thead>
			<tr>
				<th>Product</th>
				<th>Quantity</th>
				<th>Warranty</th>
				<th>Selling Price</th>
				<th>Discount_price</th>
				<th>Total</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($products as $product): ?>
				<tr>
					<td><?php echo $product->product_name; ?></td>
					<td><?php echo $product->quantity; ?></td>
					<td><?php echo $product->warranty; ?></td>
					<td><?php echo $product->selling_price; ?></td>
					<td><?php echo $product->discount_price; ?></td>
					<td><?php echo number_format($product->total_price, 2); ?> LKR</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>

		<div class="total">
			<p>Grand Total: <?php echo number_format($invoice->grand_total, 2); ?> LKR</p>
		</div>
	</div>

	<div class="footer">
		<p>This is a computer-generated invoice; no signature is required.</p>
		<p>Thank you for shopping at KD Mobile!</p>
	</div>
</div>
</body>
</html>
