<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
	<style>
		/* General Styles */
		body {
			font-family: 'Inter', Arial, sans-serif;
			margin: 0;
			padding: 0;
			background: #1c1f26; /* Dark background */
			color: #fff;
		}

		h1 {
			text-align: center;
			margin-top: 20px;
			color: #00d4ff; /* Bright accent color */
			font-size: 2.5rem;
			font-weight: 600;
		}

		/* Dashboard Container */
		.dashboard-container {
			max-width: 1200px;
			margin: 250px auto;
			padding: 30px;
			background: #282c34; /* Dark card background */
			border-radius: 15px;
			box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
		}

		/* Buttons Container */
		.button-container {
			display: flex;
			flex-wrap: wrap;
			justify-content: space-around;
			margin-top: 30px;
		}

		/* Buttons */
		.button {
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			width: 180px;
			height: 150px;
			padding: 20px;
			font-size: 16px;
			color: #fff;
			background: linear-gradient(135deg, #3a3dff, #6c63ff); /* Gradient background */
			border: none;
			border-radius: 15px;
			cursor: pointer;
			text-align: center;
			transition: all 0.3s ease;
			box-shadow: 0 6px 15px rgba(0, 0, 0, 0.5);
		}

		.button:hover {
			transform: translateY(-5px);
			box-shadow: 0 10px 25px rgba(0, 0, 0, 0.7);
		}

		.button i {
			font-size: 2.5rem;
			margin-bottom: 10px;
			color: #00d4ff; /* Icon color */
		}

		.button span {
			font-weight: 600;
			color: #ddd; /* Text color */
		}

		/* Footer */
		.footer {
			text-align: center;
			margin-top: 20px;
			color: #aaa;
			font-size: 0.9rem;
		}

		/* Responsive Design */
		@media (max-width: 768px) {
			.button-container {
				flex-direction: column;
				align-items: center;
			}

			.button {
				width: 100%;
				margin-bottom: 15px;
			}
		}
	</style>
</head>
<body>
<div class="dashboard-container">
	<h1>Welcome to the Dashboard!</h1>

	<div class="button-container">
		<!-- View Product List -->
		<a href="<?php echo base_url('inventory'); ?>" class="button">
			<i class="fas fa-boxes"></i>
			<span>View Product List</span>
		</a>

		<!-- Add Sale -->
		<a href="<?php echo base_url('sales/add'); ?>" class="button">
			<i class="fas fa-shopping-cart"></i>
			<span>Add Sale</span>
		</a>

		<!-- View Sales -->
		<a href="<?php echo base_url('sales'); ?>" class="button">
			<i class="fas fa-receipt"></i>
			<span>View Sales</span>
		</a>

		<!-- View Reports -->
		<a href="<?php echo base_url('sales/reports'); ?>" class="button">
			<i class="fas fa-chart-line"></i>
			<span>View Reports</span>
		</a>
	</div>
</div>

<div class="footer">
	<p>&copy; <?php echo date('Y'); ?> InfinityPOS System | +94765573107</p>

</div>

<!-- FontAwesome Icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
