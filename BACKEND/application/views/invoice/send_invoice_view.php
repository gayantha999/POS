<!DOCTYPE html>
<html>
<head>
	<title>Send Invoice</title>
</head>
<body>
<p>Click the button below to send the invoice via WhatsApp:</p>
<button id="sendWhatsApp">Open WhatsApp</button>

<script>
	document.getElementById('sendWhatsApp').addEventListener('click', function() {
		// Replace with the WhatsApp URL passed from PHP
		const whatsappUrl = "<?php echo $whatsapp_url; ?>";
		window.open(whatsappUrl, '_blank');
	});
</script>
</body>
</html>
