<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Check if the user is logged in
		if (!is_logged_in()) {
			redirect('users/login'); // Redirect to login page if not logged in
		}
	}

	public function index() {
		// Load dashboard view
		$this->load->view('dashboard');
	}
}
