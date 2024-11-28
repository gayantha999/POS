<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<style>
		/* General Styling */
		body {
			font-family: 'Arial', sans-serif;
			margin: 0;
			padding: 0;
			background-color: #f5f5f5;
			color: #333;
		}

		.container {
			max-width: 800px;
			margin: 20px auto;
			background: #ffffff;
			border: 1px solid #ddd;
			border-radius: 8px;
			padding: 20px;
			box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
		}

		.header {
			display: flex;
			align-items: center;
			justify-content: space-between;
			border-bottom: 2px solid #007bff;
			padding-bottom: 10px;
			margin-bottom: 20px;
		}

		.header .logo {
			width: 150px;
			height: auto;
		}

		.header .contact-info {
			text-align: right;
			font-size: 14px;
			color: #555;
		}

		.header .contact-info span {
			display: block;
		}

		.details h2 {
			font-size: 18px;
			color: #007bff;
			border-bottom: 1px solid #ddd;
			padding-bottom: 5px;
			margin-bottom: 10px;
		}

		.details p {
			margin: 5px 0;
			font-size: 14px;
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
			background-color: #f8f9fa;
			color: #333;
			text-align: center;
		}

		table td {
			color: #555;
		}

		.total {
			text-align: right;
			font-size: 16px;
			font-weight: bold;
			color: #333;
			margin-top: 10px;
		}

		.footer {
			text-align: center;
			margin-top: 20px;
			padding-top: 10px;
			border-top: 1px solid #ddd;
			font-size: 12px;
			color: #777;
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
		}
	</style>
</head>
<body>
<div class="container">
	<!-- Header Section -->
	<div class="header">
<!--		<img class="logo" src="http://localhost/POS/POS/BACKEND/assets/IMG_6574.PNG" alt="K.D. Mobile Logo">-->
		<div class="contact-info">
			<span><strong>Contact:</strong> 0704619736 | 0723101699</span>
			<span><strong>Address:</strong> No/33, New Shopping Complex, Mirigama</span>
		</div>
	</div>

	<!-- Invoice Details Section -->
	<div class="details">
		<h2>Invoice Details</h2>
		<p><strong>Invoice Number:</strong> <?php echo $invoice->invoice_number; ?></p>
		<p><strong>Date:</strong> <?php echo $invoice->sale_date; ?></p>
		<p><strong>Customer Name:</strong> <?php echo $invoice->customer_name ?: 'Not Provided'; ?></p>
	</div>

	<!-- Product Details Section -->
	<div class="details">
		<h2>Product Details</h2>
		<table>
			<thead>
			<tr>
				<th>Product</th>
				<th>Quantity</th>
				<th>Warranty</th>
				<th>Selling Price</th>
				<th>Discount Price</th>
				<th>Total</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($products as $product): ?>
				<tr>
					<td><?php echo $product->product_name; ?></td>
					<td style="text-align: center;"><?php echo $product->quantity; ?></td>
					<td style="text-align: center;"><?php echo $product->warranty; ?></td>
					<td><?php echo number_format($product->selling_price, 2); ?> LKR</td>
					<td><?php echo number_format($product->discount_price, 2); ?> LKR</td>
					<td><?php echo number_format($product->total_price, 2); ?> LKR</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		<div class="total">
			<p>Grand Total: <?php echo number_format($invoice->grand_total, 2); ?> LKR</p>
		</div>
	</div>

	<!-- Footer Section -->
	<div class="footer">
		<p>This is a computer-generated invoice; no signature is required.</p>
		<p>Thank you for shopping at KD Mobile!</p>
	</div>
</div>
</body>
</html>
