<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('UserModel');
	}

	public function login() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$user = $this->UserModel->login($username, $password);

		if ($user) {
			$this->session->set_userdata('user_id', $user->user_id);
			$this->session->set_userdata('role', $user->role);
			$this->session->set_userdata('username', $user->username);

			echo json_encode(['status' => 'success', 'message' => 'Login successful']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Invalid username or password']);
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		echo json_encode(['status' => 'success', 'message' => 'Logged out successfully']);
	}
}
