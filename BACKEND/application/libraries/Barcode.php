<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once FCPATH.'vendor/autoload.php'; // Composer autoload

use Picqer\Barcode\BarcodeGeneratorPNG;

class Barcode {

	public function generate($barcode) {
		$generator = new BarcodeGeneratorPNG();
		return $generator->getBarcode($barcode, $generator::TYPE_CODE_128); // You can change the barcode type as needed
	}
}
