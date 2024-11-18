<!DOCTYPE html>
<html>
<head>
	<title>Sales Reports</title>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<style>
		/* General Styles */
		body {
			font-family: Arial, sans-serif;
			background-color: #f9f9f9;
			margin: 0;
			padding: 0;
		}

		.container {
			width: 80%;
			margin: 30px auto;
		}

		h1 {
			text-align: center;
			color: #333;
		}

		/* Card Styles */
		.card {
			background: #fff;
			padding: 20px;
			margin: 20px 0;
			border: 1px solid #ddd;
			border-radius: 8px;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
		}

		h2 {
			color: #555;
		}

		p {
			font-size: 16px;
			color: #666;
		}

		/* Button Styles */
		.btn {
			display: inline-block;
			padding: 10px 15px;
			font-size: 14px;
			font-weight: bold;
			color: #fff;
			background-color: #007bff;
			text-decoration: none;
			border-radius: 5px;
			margin-right: 10px;
		}

		.btn:hover {
			background-color: #0056b3;
		}

		/* Chart Container */
		.chart-container {
			width: 100%;
			height: 400px;
		}

		/* Responsive Design */
		@media (max-width: 768px) {
			.container {
				width: 95%;
			}

			.card {
				padding: 15px;
			}

			p {
				font-size: 14px;
			}
		}
	</style>
</head>
<body>
<div class="container">
	<h1>Sales Reports</h1>

	<!-- Sales Summary -->
	<div class="card">
		<h2>Summary</h2>
		<p><strong>Daily Sales:</strong> <?php echo $daily_sales->total ?: 0; ?> (<?php echo $daily_sales->sales_count; ?> transactions)</p>
		<p><strong>Weekly Sales:</strong> <?php echo $weekly_sales->total ?: 0; ?> (<?php echo $weekly_sales->sales_count; ?> transactions)</p>
		<p><strong>Monthly Sales:</strong> <?php echo $monthly_sales->total ?: 0; ?> (<?php echo $monthly_sales->sales_count; ?> transactions)</p>
		<p><strong>Total Revenue:</strong> <?php echo $total_revenue; ?></p>
	</div>

	<!-- Top Products Chart -->
	<div class="card">
		<h2>Top-Selling Products</h2>
		<div class="chart-container">
			<canvas id="topProductsChart"></canvas>
		</div>
	</div>

	<!-- Export Options -->
	<div class="card">
		<h2>Export Options</h2>
		<a href="<?php echo base_url('sales/export_csv'); ?>" class="btn">Export to CSV</a>
		<a href="<?php echo base_url('sales/export_pdf'); ?>" class="btn" style="background-color: #28a745;">Export to PDF</a>
	</div>
</div>

<script>
	// Fetch the chart context
	const ctx = document.getElementById('topProductsChart').getContext('2d');

	// Top-Selling Products Chart
	const topProductsChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: [<?php foreach ($top_products as $product) echo "'" . $product->name . "',"; ?>],
			datasets: [{
				label: 'Units Sold',
				data: [<?php foreach ($top_products as $product) echo $product->total_sold . ","; ?>],
				backgroundColor: 'rgba(54, 162, 235, 0.6)',
				borderColor: 'rgba(54, 162, 235, 1)',
				borderWidth: 1
			}]
		},
		options: {
			responsive: true,
			plugins: {
				legend: {
					display: true,
					position: 'top'
				}
			},
			scales: {
				x: {
					title: {
						display: true,
						text: 'Products',
						color: '#555',
						font: {
							size: 14
						}
					}
				},
				y: {
					title: {
						display: true,
						text: 'Units Sold',
						color: '#555',
						font: {
							size: 14
						}
					},
					beginAtZero: true
				}
			}
		}
	});
</script>
</body>
</html>
