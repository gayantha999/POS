<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SalesModel extends CI_Model {
	public function add_sale($data) {
		return $this->db->insert('sales', $data);
	}

	public function get_all_sales() {
		$this->db->select('sales.*, products.name as product_name');
		$this->db->from('sales');
		$this->db->join('products', 'sales.product_id = products.id');
		$this->db->order_by('sale_date', 'DESC');
		return $this->db->get()->result();
	}
}
