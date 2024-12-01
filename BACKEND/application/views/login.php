<!DOCTYPE html>
<html>
<head>
	<title>Login - InfinityPOS</title>
	<style>
		/* General Styles */
		body {
			font-family: 'Arial', sans-serif;
			margin: 0;
			padding: 0;
			background: linear-gradient(135deg, #f8f9fa, #e9ecef);
			color: #333;
			height: 100vh;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		/* Login Container */
		.login-container {
			background: #ffffff;
			padding: 40px;
			border-radius: 15px;
			box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
			width: 100%;
			max-width: 400px;
			text-align: center;
		}

		/* Title */
		h2 {
			font-size: 28px;
			font-weight: bold;
			color: #007bff;
			margin-bottom: 10px;
		}

		h2 span {
			color: #6c63ff; /* Accent color for InfinityPOS */
		}

		p.subtitle {
			font-size: 14px;
			color: #666;
			margin-bottom: 25px;
		}

		/* Form Styles */
		form {
			display: flex;
			flex-direction: column;
			align-items: center;
		}

		label {
			font-size: 14px;
			margin-bottom: 5px;
			color: #555;
			text-align: left;
			width: 100%;
		}

		input {
			width: 100%;
			padding: 12px 15px;
			margin-bottom: 20px;
			border: 1px solid #ced4da;
			border-radius: 8px;
			font-size: 16px;
			background: #f8f9fa;
			color: #495057;
			transition: all 0.3s ease;
		}

		input:focus {
			outline: none;
			border-color: #007bff;
			box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
			background: #fff;
		}

		/* Button Styles */
		button {
			width: 100%;
			padding: 14px;
			font-size: 16px;
			font-weight: bold;
			color: #fff;
			background: linear-gradient(135deg, #007bff, #0056b3);
			border: none;
			border-radius: 8px;
			cursor: pointer;
			transition: transform 0.3s ease, box-shadow 0.3s ease;
		}

		button:hover {
			transform: translateY(-3px);
			box-shadow: 0 8px 15px rgba(0, 123, 255, 0.3);
		}

		button:active {
			transform: translateY(1px);
			box-shadow: none;
		}

		/* Message Styles */
		#message {
			margin-top: 10px;
			font-size: 14px;
			color: #e74c3c;
		}

		/* Footer */
		.footer {
			margin-top: 20px;
			font-size: 12px;
			color: #aaa;
		}
	</style>
</head>
<body>
<div class="login-container">
	<h2>Welcome to <span>InfinityPOS</span></h2>
	<p class="subtitle">Please login to access your dashboard</p>
	<form id="loginForm">
		<label for="username">Username</label>
		<input type="text" id="username" name="username" placeholder="Enter your username" required>

		<label for="password">Password</label>
		<input type="password" id="password" name="password" placeholder="Enter your password" required>

		<button type="submit">Login</button>
	</form>

	<p id="message"></p>
	<div class="footer">
		<p>© 2024 InfinityPOS. All rights reserved.</p>
	</div>
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
