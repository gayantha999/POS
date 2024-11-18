<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('check_session')) {
	function check_session($ci, $role = null) {
		$user_id = $ci->session->userdata('user_id');
		if (!$user_id) {
			redirect('users/login_view'); // Redirect to login view if not logged in
		}

		if ($role && $ci->session->userdata('role') !== $role) {
			redirect('users/access_denied'); // Restrict access for specific roles
		}
	}
}
