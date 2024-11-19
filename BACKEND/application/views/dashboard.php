<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<style>
		/* General Styles */
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			background-image: url('application/assets/background.jpg');
			background-size: cover;
			background-position: center;
			background-attachment: fixed;
			background-repeat: no-repeat;
		}

		h1 {
			text-align: center;
			margin-top: 20px;
			color: #333;
		}

		/* Dashboard Container */
		.dashboard-container {
			max-width: 1200px;
			margin: 20px auto;
			padding: 20px;
			background: rgba(255, 255, 255, 0.9); /* Semi-transparent background */
			border-radius: 8px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		}

		/* Buttons Container */
		.button-container {
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
			gap: 20px;
			margin-top: 30px;
		}

		/* Buttons */
		button {
			padding: 15px 25px;
			font-size: 16px;
			color: #fff;
			background-color: #007bff;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			transition: all 0.3s ease;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
		}

		button:hover {
			background-color: #0056b3;
			box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
		}

		a {
			text-decoration: none;
		}

		/* Footer */
		.footer {
			text-align: center;
			margin-top: 40px;
			color: #777;
		}
	</style>
</head>
<body>
<div class="dashboard-container">
	<h1>Welcome to the Dashboard!</h1>

	<div class="button-container">
		<!-- View Product List -->
		<a href="<?php echo base_url('inventory'); ?>">
			<button>View Product List</button>
		</a>

		<!-- Add Sale -->
		<a href="<?php echo base_url('sales/add'); ?>">
			<button>Add Sale</button>
		</a>

		<!-- View Sales -->
		<a href="<?php echo base_url('sales'); ?>">
			<button>View Sales</button>
		</a>

		<!-- View Reports -->
		<a href="<?php echo base_url('sales/reports'); ?>">
			<button>View Reports</button>
		</a>
	</div>
</div>

<div class="footer">
	<p>&copy; <?php echo date('Y'); ?> Mobile Shop POS System</p>
</div>
</body>
</html>
