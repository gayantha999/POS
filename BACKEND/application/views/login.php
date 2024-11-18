<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<style>
		/* General Styles */
		body {
			font-family: Arial, sans-serif;
			background-color: #f4f6f9;
			margin: 0;
			padding: 0;
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
		}

		/* Form Container */
		.login-container {
			background: #ffffff;
			padding: 30px;
			border-radius: 8px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			width: 100%;
			max-width: 400px;
		}

		h2 {
			text-align: center;
			color: #333;
			margin-bottom: 20px;
		}

		/* Form Styles */
		form {
			display: flex;
			flex-direction: column;
		}

		label {
			font-weight: bold;
			margin-bottom: 5px;
			color: #555;
		}

		input {
			padding: 10px;
			margin-bottom: 15px;
			border: 1px solid #ddd;
			border-radius: 5px;
			font-size: 16px;
		}

		input:focus {
			outline: none;
			border-color: #007bff;
			box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
		}

		/* Button Styles */
		button {
			padding: 12px;
			font-size: 16px;
			font-weight: bold;
			color: #fff;
			background-color: #007bff;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			transition: all 0.3s ease;
		}

		button:hover {
			background-color: #0056b3;
		}

		/* Message Styles */
		#message {
			margin-top: 10px;
			text-align: center;
		}
	</style>
</head>
<body>
<div class="login-container">
	<h2>Login</h2>
	<form id="loginForm">
		<label for="username">Username:</label>
		<input type="text" id="username" name="username" required>

		<label for="password">Password:</label>
		<input type="password" id="password" name="password" required>

		<button type="submit">Login</button>
	</form>

	<p id="message"></p>
</div>

<script>
	// Handle the form submission using JavaScript
	document.getElementById('loginForm').addEventListener('submit', function(event) {
		event.preventDefault(); // Prevent the default form submission

		const username = document.getElementById('username').value;
		const password = document.getElementById('password').value;

		// Send a POST request using Fetch API
		fetch('<?php echo base_url("Users/login"); ?>', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			body: `username=${username}&password=${password}`
		})
			.then(response => response.json())
			.then(data => {
				const messageElement = document.getElementById('message');
				if (data.status === 'success') {
					messageElement.style.color = 'green';
					messageElement.textContent = data.message;
					// Redirect to a dashboard or another page on successful login
					setTimeout(() => {
						window.location.href = '<?php echo base_url("dashboard"); ?>';
					}, 1000);
				} else {
					messageElement.style.color = 'red';
					messageElement.textContent = data.message;
				}
			})
			.catch(error => {
				console.error('Error:', error);
				document.getElementById('message').textContent = 'An error occurred while logging in.';
			});
	});
</script>
</body>
</html>
