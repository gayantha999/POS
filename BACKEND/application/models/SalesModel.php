<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SalesModel extends CI_Model {
	public function add_sale($data) {
		return $this->db->insert('sales', $data);
	}

	public function get_all_sales() {
		$this->db->select('sales.*, products.name as product_name');
		$this->db->from('sales');
		$this->db->join('products', 'sales.product_id = products.product_id');
		$this->db->order_by('sale_date', 'DESC');
		return $this->db->get()->result();
	}

	public function get_filtered_sales($product_name = '', $start_date = '', $end_date = '') {
		$this->db->select('sales.*,sales.id, products.name as product_name, sales.quantity, sales.total_price, sales.customer_name, sales.sale_date');
		$this->db->from('sales');
		$this->db->join('products', 'sales.product_id = products.product_id', 'left');

		// Apply filters
		if (!empty($product_name)) {
			$this->db->like('products.name', $product_name);
		}
		if (!empty($start_date) && !empty($end_date)) {
			$this->db->where('sales.sale_date >=', $start_date);
			$this->db->where('sales.sale_date <=', $end_date);
		}

		$query = $this->db->get();
		return $query->result();
	}

	public function get_sales_summary($type) {
		$this->db->select('SUM(total_price) as total, COUNT(id) as sales_count');
		$this->db->from('sales');

		if ($type === 'daily') {
			$this->db->where('DATE(sale_date)', date('Y-m-d'));
		} elseif ($type === 'weekly') {
			$this->db->where('WEEK(sale_date)', date('W'));
		} elseif ($type === 'monthly') {
			$this->db->where('MONTH(sale_date)', date('m'));
		}

		return $this->db->get()->row();
	}

	public function get_top_selling_products() {
		$this->db->select('products.name, SUM(sales.quantity) as total_sold');
		$this->db->from('sales');
		$this->db->join('products', 'sales.product_id = products.product_id', 'left');
		$this->db->group_by('sales.product_id');
		$this->db->order_by('total_sold', 'DESC');
		$this->db->limit(5);

		return $this->db->get()->result();
	}

	public function get_total_revenue() {
		$this->db->select('SUM(total_price) as total_revenue');
		$this->db->from('sales');

		return $this->db->get()->row()->total_revenue;
	}


	public function get_all_sales_pdf() {
		$this->db->select('sales.*,sales.id, products.name as product_name, sales.quantity, sales.total_price, sales.customer_name, sales.sale_date');
		$this->db->from('sales');
		$this->db->join('products', 'sales.product_id = products.product_id', 'left');

		return $this->db->get()->result();
	}

	public function get_sale_by_id($sale_id) {
		$this->db->select('sales.*, products.name as product_name');
		$this->db->from('sales');
		$this->db->join('products', 'sales.product_id = products.id', 'left');
		$this->db->where('sales.id', $sale_id);

		return $this->db->get()->row();
	}


}
