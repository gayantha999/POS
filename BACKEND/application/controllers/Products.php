<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('auth'); // Load the auth helper
		check_session($this); // Validate session
	}

	public function index() {
		echo "Welcome to Product Management";
	}
}
