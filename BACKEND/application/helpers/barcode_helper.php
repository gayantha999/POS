<?php
use Picqer\Barcode\BarcodeGeneratorPNG;

function generate_barcode_with_text($code) {
	$generator = new BarcodeGeneratorPNG();
	$barcode = $generator->getBarcode($code, $generator::TYPE_CODE_128);

	// Set the standard sticker size in pixels (2.5 x 1 inches at 300 DPI)
	$barcode_width = 500;  // 2.5 inches x 300 DPI
	$barcode_height = 200; // 1 inch x 300 DPI
	$text_height = 50;     // Space for text below the barcode (adjust if needed)

	// Create an image with enough space for barcode and text
	$image = imagecreatetruecolor($barcode_width, $barcode_height + $text_height);

	// Set colors (white background, black text)
	$white = imagecolorallocate($image, 255, 255, 255);  // Background color: white
	$black = imagecolorallocate($image, 0, 0, 0);        // Text color: black

	// Fill background with white
	imagefilledrectangle($image, 0, 0, $barcode_width, $barcode_height + $text_height, $white);

	// Convert barcode data to an image
	$barcode_image = imagecreatefromstring($barcode);
	imagecopyresampled($image, $barcode_image, 0, 0, 0, 0, $barcode_width, $barcode_height, imagesx($barcode_image), imagesy($barcode_image));

	// Set font path (change this if necessary)
	$font_path = FCPATH . 'assets/fonts/Arial.ttf';

	// Check if the font path exists
	if (!file_exists($font_path)) {
		show_error('Font file not found at: ' . $font_path);
		return;
	}

	// Add text (barcode number) below the barcode, with black color
	imagettftext($image, 12, 0, 10, $barcode_height + 25, $black, $font_path, $code);

	return $image;
}
?>
