<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database(); // Load the database library
		$this->load->model('UserModel'); // Load the UserModel
		$this->load->library('session'); // Load session library
		$this->load->helper('url'); // Load URL helper for redirects if needed
	}

	/**
	 * Login method to authenticate users.
	 */
	public function login() {
		$model = new UserModel;

		// Fetch input values
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		// Validate inputs
		if (empty($username) || empty($password)) {
			echo json_encode(['status' => 'error', 'message' => 'Username and password are required']);
			return;
		}

		// Authenticate user
		$user = $model->login($username, $password);

		if ($user) {
			// Set session data on successful login
			$this->session->set_userdata([
				'user_id' => $user->user_id,
				'role' => $user->role,
				'username' => $user->username,
				'logged_in' => TRUE
			]);

			echo json_encode(['status' => 'success', 'message' => 'Login successful']);
		} else {
			// Invalid credentials
			echo json_encode(['status' => 'error', 'message' => 'Invalid username or password']);
		}
	}

	/**
	 * Logout method to destroy user session.
	 */
	public function logout() {
		$this->session->sess_destroy();
		redirect('users/show_login'); // Redirect to login page
	}


	public function show_login() {
		$this->load->view('login');
	}

// Check if a user is logged in
//	private function is_logged_in() {
//		return $this->session->userdata('user_id') !== null;
//	}

// Restrict access by roles
//	private function restrict_access($role) {
//		if (!$this->is_logged_in() || $this->session->userdata('role') !== $role) {
//			redirect('users/access_denied');
//		}
//	}

	public function access_denied() {
		echo "Access Denied: You do not have permission to access this page.";
	}

	private function is_logged_in() {
		return $this->session->userdata('logged_in') === TRUE;
	}

	private function restrict_access($required_role = NULL) {
		if (!$this->is_logged_in()) {
			redirect('users/show_login'); // Redirect to login if not logged in
		}

		if ($required_role && $this->session->userdata('role') !== $required_role) {
			redirect('users/access_denied'); // Redirect if the role does not match
		}
	}
//	public function access_denied() {
//		$this->load->view('access_denied'); // Create a view file named `access_denied.php`
//	}

	public function dashboard() {
		if (!$this->is_logged_in()) {
			redirect('users/show_login'); // Redirect to login if not logged in
		}

		// Load different views based on roles
		if ($this->session->userdata('role') === 'admin') {
			$this->load->view('admin_dashboard');
		} else {
			$this->load->view('user_dashboard');
		}
	}

	public function admin_area() {
		$this->restrict_access('admin'); // Only allow users with 'admin' role
		$this->load->view('admin_dashboard');
	}

	public function admin_dashboard() {
		$this->restrict_access('admin'); // Only admin can access this page
		$this->load->view('admin_dashboard');
	}
}
