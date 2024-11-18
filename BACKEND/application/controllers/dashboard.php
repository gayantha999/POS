<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index() {
		// Sample data or view load
		$this->load->view('dashboard');
	}
}
