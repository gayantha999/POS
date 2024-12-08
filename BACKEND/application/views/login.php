<!DOCTYPE html>
<html>
<head>
	<title>Login - InfinityPOS</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
			color: #6c63ff;
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
			margin-bottom: 15px;
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

		/* Password Toggle */
		.password-container {
			position: relative;
			width: 100%;
		}

		.password-toggle {
			position: absolute;
			right: 10px;
			top: 50%;
			transform: translateY(-50%);
			cursor: pointer;
			color: #007bff;
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

		button:disabled {
			background: #6c757d;
			cursor: not-allowed;
		}

		/* Loading Spinner */
		.spinner {
			display: inline-block;
			width: 18px;
			height: 18px;
			border: 3px solid transparent;
			border-top: 3px solid #fff;
			border-radius: 50%;
			animation: spin 1s linear infinite;
			margin-left: 10px;
		}

		@keyframes spin {
			from { transform: rotate(0deg); }
			to { transform: rotate(360deg); }
		}

		/* Message Styles */
		#message {
			margin-top: 10px;
			font-size: 14px;
		}

		#message.error {
			color: #e74c3c;
		}

		#message.success {
			color: green;
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
<!--		<div class="password-container">-->
			<input type="password" id="password" name="password" placeholder="Enter your password" required>
<!--			<span class="password-toggle" onclick="togglePassword()">👁️</span>-->
<!--		</div>-->

		<button type="submit" id="loginButton">Login</button>
	</form>

	<p id="message"></p>
	<div class="footer">
		<p>© 2024 InfinityPOS. All rights reserved.</p>
	</div>
</div>

<script>
	// Toggle Password Visibility
	function togglePassword() {
		const passwordField = document.getElementById('password');
		const toggleIcon = document.querySelector('.password-toggle');
		if (passwordField.type === 'password') {
			passwordField.type = 'text';
			toggleIcon.textContent = '🙈';
		} else {
			passwordField.type = 'password';
			toggleIcon.textContent = '👁️';
		}
	}

	// Handle Form Submission
	document.getElementById('loginForm').addEventListener('submit', function(event) {
		event.preventDefault();

		const username = document.getElementById('username').value;
		const password = document.getElementById('password').value;
		const loginButton = document.getElementById('loginButton');
		const messageElement = document.getElementById('message');

		// Disable button and show spinner
		loginButton.disabled = true;
		loginButton.innerHTML = 'Logging in... <span class="spinner"></span>';

		// Send POST request
		fetch('<?php echo base_url("Users/login"); ?>', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`
		})
			.then(response => response.json())
			.then(data => {
				if (data.status === 'success') {
					messageElement.className = 'success';
					messageElement.textContent = data.message;

					// Redirect to dashboard
					setTimeout(() => {
						window.location.href = '<?php echo base_url("dashboard"); ?>';
					}, 1000);
				} else {
					messageElement.className = 'error';
					messageElement.textContent = data.message;
					loginButton.disabled = false;
					loginButton.textContent = 'Login';
				}
			})
			.catch(error => {
				console.error('Error:', error);
				messageElement.className = 'error';
				messageElement.textContent = 'An error occurred. Please try again later.';
				loginButton.disabled = false;
				loginButton.textContent = 'Login';
			});
	});
</script>
</body>
</html>
