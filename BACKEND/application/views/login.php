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
			background: linear-gradient(135deg, #1e1e2f, #27293d);
			color: #fff;
			height: 100vh;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		/* Login Container */
		.login-container {
			background: #2c2f4a;
			padding: 30px 40px;
			border-radius: 12px;
			box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
			width: 100%;
			max-width: 400px;
		}

		h2 {
			text-align: center;
			color: #00d4ff;
			margin-bottom: 25px;
			font-weight: bold;
		}

		h2 span {
			color: #6c63ff; /* Accent color for InfinityPOS */
		}

		/* Form Styles */
		form {
			display: flex;
			flex-direction: column;
		}

		label {
			font-size: 14px;
			margin-bottom: 5px;
			color: #aaa;
		}

		input {
			padding: 12px;
			margin-bottom: 20px;
			border: none;
			border-radius: 6px;
			font-size: 16px;
			background: #44465e;
			color: #fff;
		}

		input:focus {
			outline: none;
			box-shadow: 0 0 8px #00d4ff;
			background: #3b3d56;
		}

		/* Button Styles */
		button {
			padding: 12px;
			font-size: 16px;
			font-weight: bold;
			color: #fff;
			background: linear-gradient(135deg, #3a3dff, #6c63ff);
			border: none;
			border-radius: 8px;
			cursor: pointer;
			transition: transform 0.3s ease, box-shadow 0.3s ease;
		}

		button:hover {
			transform: translateY(-3px);
			box-shadow: 0 10px 20px rgba(0, 123, 255, 0.4);
		}

		/* Message Styles */
		#message {
			margin-top: 10px;
			text-align: center;
			font-size: 14px;
		}
	</style>
</head>
<body>
<div class="login-container">
	<h2>Welcome to <span>InfinityPOS</span></h2>
	<form id="loginForm">
		<label for="username">Username:</label>
		<input type="text" id="username" name="username" placeholder="Enter your username" required>

		<label for="password">Password:</label>
		<input type="password" id="password" name="password" placeholder="Enter your password" required>

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
					messageElement.style.color = 'lightgreen';
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
