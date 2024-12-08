<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
	<style>
		/* General Styles */
		body {
			font-family: 'Inter', Arial, sans-serif;
			background: #f8f9fa; /* Light background */
			color: #212529; /* Text color */
		}

		h1 {
			margin-top: 20px;
			color: #0d6efd; /* Primary accent color */
			font-size: 2.5rem;
			font-weight: 600;
		}

		/* Dashboard Container */
		.dashboard-container {
			margin: auto;
			padding: 40px;
			background: #ffffff; /* White card background */
			border-radius: 15px;
			box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Soft shadow */
		}

		/* Buttons */
		.card {
			background: #ffffff; /* White card */
			color: #212529;
			border: none;
			border-radius: 15px;
			transition: all 0.3s ease;
			box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
		}

		.card:hover {
			transform: translateY(-5px);
			box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); /* Slightly darker shadow */
		}

		.card i {
			font-size: 3rem;
			margin-bottom: 10px;
			color: #0d6efd; /* Primary color for icons */
		}

		.card-title {
			font-weight: 600;
			font-size: 1.2rem;
		}

		/* Footer */
		.footer {
			text-align: center;
			margin-top: 20px;
			color: #6c757d;
			font-size: 0.9rem;
		}
	</style>
</head>
<body>
<div class="container py-5">
	<div class="dashboard-container text-center">
		<h1>Welcome to the Dashboard!</h1>
		<div class="row mt-4 g-4">
			<!-- View Product List -->
			<div class="col-lg-3 col-md-6">
				<a href="<?php echo base_url('inventory'); ?>" class="card text-center p-4 text-decoration-none">
					<i class="fas fa-boxes"></i>
					<h5 class="card-title">View Product List</h5>
				</a>
			</div>

			<!-- Add Sale -->
			<div class="col-lg-3 col-md-6">
				<a href="<?php echo base_url('sales/add'); ?>" class="card text-center p-4 text-decoration-none">
					<i class="fas fa-shopping-cart"></i>
					<h5 class="card-title">Add Sale</h5>
				</a>
			</div>

			<!-- View Sales -->
			<div class="col-lg-3 col-md-6">
				<a href="<?php echo base_url('sales'); ?>" class="card text-center p-4 text-decoration-none">
					<i class="fas fa-receipt"></i>
					<h5 class="card-title">View Sales</h5>
				</a>
			</div>

			<!-- View Reports -->
			<div class="col-lg-3 col-md-6">
				<a href="<?php echo base_url('sales/reports'); ?>" class="card text-center p-4 text-decoration-none">
					<i class="fas fa-chart-line"></i>
					<h5 class="card-title">View Reports</h5>
				</a>
			</div>
		</div>
	</div>

	<div class="footer mt-5">
		<p>&copy; <?php echo date('Y'); ?> InfinityPOS System | +94765573107</p>
	</div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
