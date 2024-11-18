<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
</head>
<body>
<h1>Welcome to the Dashboard!</h1>

<a href="<?php echo base_url('inventory'); ?>">
	<button style="padding: 10px 20px; font-size: 16px;">View Product List</button>
</a>

<!-- Add Sales Button -->
<a href="<?php echo base_url('sales/add'); ?>">
	<button style="padding: 10px 20px; font-size: 16px;">Add Sale</button>
</a>

<a href="<?php echo base_url('sales'); ?>">
	<button style="padding: 10px 20px; font-size: 16px;">View Sales</button>
</a>
</body>
</html>
