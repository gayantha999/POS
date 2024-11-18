<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
<h2>Login</h2>
<form id="loginForm">
	<label for="username">Username:</label>
	<input type="text" id="username" name="username" required>
	<br><br>
	<label for="password">Password:</label>
	<input type="password" id="password" name="password" required>
	<br><br>
	<button type="submit">Login</button>
</form>

<p id="message" style="color: red;"></p>

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
