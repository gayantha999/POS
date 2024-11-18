<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductModel extends CI_Model {

	public function get_all_products() {
		return $this->db->get('Products')->result();
	}

	public function add_product($data) {
		return $this->db->insert('Products', $data);
	}

	public function update_product($id, $data) {
		$this->db->where('product_id', $id);
		return $this->db->update('Products', $data);
	}

	public function delete_product($id) {
		$this->db->where('product_id', $id);
		return $this->db->delete('Products');
	}

	public function get_product_by_id($id) {
		$this->db->where('product_id', $id);
		return $this->db->get('Products')->row();
	}
}
