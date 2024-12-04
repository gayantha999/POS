<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SalesModel extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
	public function add_sale($data) {
		return $this->db->insert('sales', $data);
	}

	public function get_all_sales() {
		$this->db->select('sales.invoice_number, products.name as product_name,sales.price,sales.selling_price,sales.discount_price,sales.total_price');
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

//	public function get_sale_by_invoice_number($invoice_number) {
//		$this->db->select('sales.*, products.name as product_name');
//		$this->db->from('sales');
//		$this->db->join('products', 'sales.product_id = products.product_id', 'left');
//		$this->db->where('sales.invoice_number', $invoice_number);
//
//		return $this->db->get()->result();
//	}
	public function get_invoice_data($invoice_number) {

		// Get invoice details
		$this->db->select('sales.id as invoice_id, sales.invoice_number, sales.sale_date, sales.customer_name, SUM(sales.total_price) as grand_total,sales.mobile_number');
		$this->db->from('sales');
		$this->db->where('sales.invoice_number', $invoice_number);
		$invoice = $this->db->get()->row();

		if (!$invoice) {
			return false;
		}

		// Get products linked to the invoice
		$this->db->select('products.name as product_name, sales.quantity, sales.warranty, sales.total_price,,sales.selling_price,sales.discount_price');
		$this->db->from('sales');
		$this->db->join('products', 'sales.product_id = products.product_id', 'left');
		$this->db->where('sales.invoice_number', $invoice_number);
		$products = $this->db->get()->result();


		return [
			'invoice' => $invoice,
			'products' => $products
		];
	}

	public function get_items()
	{
		$query = $this->db->get('products');
		return $query->result();
	}

	public function get_daily_sales($item_id = null, $month = null)
	{
		$this->db->select('SUM(amount) as total, COUNT(*) as sales_count');
		$this->db->from('sales');
		$this->db->where('DATE(date)', date('Y-m-d'));

		if ($item_id) {
			$this->db->where('item_id', $item_id);
		}

		if ($month) {
			$this->db->where('MONTH(date)', $month);
		}

		return $this->db->get()->row();
	}

	public function get_weekly_sales($item_id = null, $month = null)
	{
		$this->db->select('SUM(amount) as total, COUNT(*) as sales_count');
		$this->db->from('sales');
		$this->db->where('YEARWEEK(date, 1)', date('YW'));

		if ($item_id) {
			$this->db->where('item_id', $item_id);
		}

		if ($month) {
			$this->db->where('MONTH(date)', $month);
		}

		return $this->db->get()->row();
	}

	public function get_monthly_sales($item_id = null, $month = null)
	{
		$this->db->select('SUM(amount) as total, COUNT(*) as sales_count');
		$this->db->from('sales');
		$this->db->where('MONTH(date)', $month ?: date('m'));

		if ($item_id) {
			$this->db->where('item_id', $item_id);
		}

		return $this->db->get()->row();
	}

	public function get_total_revenue_reports($item_id = null, $month = null)
	{
		$this->db->select('SUM(amount) as total_revenue');
		$this->db->from('sales');

		if ($item_id) {
			$this->db->where('item_id', $item_id);
		}

		if ($month) {
			$this->db->where('MONTH(date)', $month);
		}

		return $this->db->get()->row()->total_revenue;
	}

	public function get_top_products($item_id = null, $month = null)
	{
		$this->db->select('items.name, SUM(sales.quantity) as total_sold');
		$this->db->from('sales');
		$this->db->join('items', 'sales.item_id = items.id');
		$this->db->group_by('items.name');
		$this->db->order_by('total_sold', 'DESC');
		$this->db->limit(5);

		if ($item_id) {
			$this->db->where('sales.item_id', $item_id);
		}

		if ($month) {
			$this->db->where('MONTH(sales.date)', $month);
		}

		return $this->db->get()->result();
	}





	public function QuantityManage($id,$quantity){

		// Retrieve the current quantity of the product
		$this->db->select('stock,low_stock_threshold');
		$this->db->from('products');
		$this->db->where('product_id', $id);
		$product = $this->db->get()->row();


		// Calculate the new quantity
		$newQuantity = $product->stock - $quantity;


		if ($newQuantity <= $product->low_stock_threshold) {
			 // Insufficient stock
			$this->db->where('product_id', $id);
			$this->db->update('products', ['stock' => $newQuantity]);
			return false;
		}

		// Update the product quantity in the database
		$this->db->where('product_id', $id);
		$this->db->update('products', ['stock' => $newQuantity]);

		return $this->db->affected_rows() > 0;
	}

	public function getLastInvoiceNumber()
	{
		$this->db->select_max('invoice_number');
		$query = $this->db->get('sales');
		$result = $query->row();
		return $result->invoice_number ?? null;
	}

}
