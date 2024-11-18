<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function login($username, $password) {
		$this->db->where('username', $username);
		$this->db->where('password', hash('sha256', $password));
		$query = $this->db->get('Users');

		return $query->row(); // Return user data if found
	}
}
