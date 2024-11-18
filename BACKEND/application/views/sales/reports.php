<!DOCTYPE html>
<html>
<head>
	<title>Sales Reports</title>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<style>
		.container {
			width: 80%;
			margin: auto;
		}
		.card {
			padding: 20px;
			margin: 20px 0;
			border: 1px solid #ccc;
			border-radius: 5px;
		}
		.chart-container {
			width: 100%;
			height: 400px;
		}
	</style>
</head>
<body>
<div class="container">
	<h1>Sales Reports</h1>

	<!-- Sales Summary -->
	<div class="card">
		<h2>Summary</h2>
		<p>Daily Sales: <?php echo $daily_sales->total ?: 0; ?> (<?php echo $daily_sales->sales_count; ?> transactions)</p>
		<p>Weekly Sales: <?php echo $weekly_sales->total ?: 0; ?> (<?php echo $weekly_sales->sales_count; ?> transactions)</p>
		<p>Monthly Sales: <?php echo $monthly_sales->total ?: 0; ?> (<?php echo $monthly_sales->sales_count; ?> transactions)</p>
		<p>Total Revenue: <?php echo $total_revenue; ?></p>
	</div>

	<!-- Top Products Chart -->
	<div class="card">
		<h2>Top-Selling Products</h2>
		<canvas id="topProductsChart"></canvas>
	</div>
</div>

<div class="card">
	<h2>Export Options</h2>
	<a href="<?php echo base_url('sales/export_csv'); ?>" class="btn">Export to CSV</a>
	<a href="<?php echo base_url('sales/export_pdf'); ?>" class="btn">Export to PDF</a>
</div>


<script>
	const ctx = document.getElementById('topProductsChart').getContext('2d');
	const topProductsChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: [<?php foreach ($top_products as $product) echo "'" . $product->name . "',"; ?>],
			datasets: [{
				label: 'Units Sold',
				data: [<?php foreach ($top_products as $product) echo $product->total_sold . ","; ?>],
				backgroundColor: 'rgba(75, 192, 192, 0.2)',
				borderColor: 'rgba(75, 192, 192, 1)',
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				y: {
					beginAtZero: true
				}
			}
		}
	});
</script>
</body>
</html>
