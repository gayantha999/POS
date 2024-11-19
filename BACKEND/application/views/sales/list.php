<!DOCTYPE html>
<html>
<head>
	<title>Sales List</title>
	<style>
		/* General Styles */
		body {
			font-family: Arial, sans-serif;
			margin: 20px;
			background-color: #f9f9f9;
		}

		h1 {
			text-align: center;
			color: #333;
			margin-bottom: 20px;
		}

		/* Form Styles */
		form {
			display: flex;
			justify-content: space-between;
			flex-wrap: wrap;
			gap: 10px;
			margin-bottom: 20px;
			padding: 10px;
			background: #fff;
			border: 1px solid #ddd;
			border-radius: 8px;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
		}

		form label {
			font-weight: bold;
			margin-right: 5px;
		}

		form input[type="text"],
		form input[type="date"] {
			padding: 8px;
			border: 1px solid #ccc;
			border-radius: 4px;
			width: 180px;
		}

		form .btn {
			padding: 10px 15px;
			font-size: 14px;
			font-weight: bold;
			color: #fff;
			background-color: #4CAF50;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			text-decoration: none;
		}

		form .btn:hover {
			background-color: #45a049;
		}

		/* Table Styles */
		table {
			width: 100%;
			border-collapse: collapse;
			background: #fff;
			margin-bottom: 20px;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
		}

		table, th, td {
			border: 1px solid #ddd;
		}

		th {
			background-color: #f2f2f2;
			font-weight: bold;
			text-align: left;
		}

		th, td {
			padding: 10px;
		}

		td {
			text-align: left;
		}

		/* Button Styles in Table */
		.action-btn {
			display: inline-block;
			padding: 5px 10px;
			font-size: 12px;
			font-weight: bold;
			color: #fff;
			text-decoration: none;
			border-radius: 5px;
		}

		.view-btn {
			background-color: #007bff;
		}

		.view-btn:hover {
			background-color: #0056b3;
		}

		.download-btn {
			background-color: #28a745;
		}

		.download-btn:hover {
			background-color: #218838;
		}

		/* No Sales Message */
		.no-sales {
			text-align: center;
			color: #555;
			font-size: 16px;
		}
		/* General button styles */
		a.back-link,
		a.add-button {
			display: inline-block;
			padding: 10px 20px;
			font-size: 16px;
			color: #fff;
			text-decoration: none;
			border-radius: 5px;
			transition: all 0.3s ease;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
		}

		/* Specific styles for Back to Inventory button */
		a.back-link {
			background-color: #007bff; /* Red color */
		}

		a.back-link:hover {
			background-color: #007bff; /* Darker red on hover */
			box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
		}

		/* Specific styles for Dashboard button */
		a.add-button {
			background-color: #4caf50; /* Green color */
		}

		a.add-button:hover {
			background-color: #388e3c; /* Darker green on hover */
			box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
		}

		/* Optional: Container for alignment */
		.button-container {
			display: flex;
			justify-content: center;
			gap: 20px; /* Space between buttons */
			margin-top: 20px;
		}
	</style>
</head>
<body>

<h1>Sales List</h1>

<!-- Filter Form -->
<form method="get" action="<?php echo base_url('sales'); ?>">
	<div>
		<label for="product_name">Product Name:</label>
		<input type="text" name="product_name" id="product_name" value="<?php echo $this->input->get('product_name'); ?>" placeholder="Enter product name">
	</div>
	<div>
		<label for="start_date">Start Date:</label>
		<input type="date" name="start_date" id="start_date" value="<?php echo $this->input->get('start_date'); ?>">
	</div>
	<div>
		<label for="end_date">End Date:</label>
		<input type="date" name="end_date" id="end_date" value="<?php echo $this->input->get('end_date'); ?>">
	</div>
	<div>
		<button type="submit" class="btn">Filter</button>
		<a href="<?php echo base_url('sales'); ?>" class="btn" style="background-color: #6c757d;">Reset</a>
	</div>
</form>

<!-- Sales Table -->
<?php if (!empty($sales)): ?>
	<table>
		<thead>
		<tr>
			<th>ID</th>
			<th>Product</th>
			<th>Price</th>
			<th>Selling Price</th>
			<th>Quantity</th>
			<th>Total Price</th>
			<th>Payment Type</th>
			<th>Customer Name</th>
			<th>Date</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($sales as $sale): ?>
			<tr>
				<td><?php echo $sale->id; ?></td>
				<td><?php echo $sale->product_name; ?></td>
				<td><?php echo $sale->price; ?></td>
				<td><?php echo $sale->selling_price; ?></td>
				<td><?php echo $sale->quantity; ?></td>
				<td><?php echo $sale->total_price; ?></td>
				<td><?php echo $sale->payment_type; ?></td>
				<td><?php echo $sale->customer_name ?: 'N/A'; ?></td>
				<td><?php echo $sale->sale_date; ?></td>
				<td>
					<a href="<?php echo base_url('invoice/generate/' . $sale->id); ?>" class="action-btn view-btn">View</a>
					<a href="<?php echo base_url('invoice/download/' . $sale->id); ?>" class="action-btn download-btn">Download</a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php else: ?>
	<p class="no-sales">No sales found for the selected filters.</p>
<?php endif; ?>

<div class="button-container">
	<a class="back-link" href="<?php echo base_url('inventory'); ?>">Back to Inventory</a>
	<a class="back-link" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
</div>

</body>
</html>
