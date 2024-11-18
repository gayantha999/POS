<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function login($username, $password) {
		$query = $this->db->get_where('users', [
			'username' => $username,
			'password' => md5($password)
		]);

		return $query->row();
	}
}
