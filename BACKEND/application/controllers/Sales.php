<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('SalesModel');
		$this->load->model('ProductModel');
	}

	public function index() {
		$data['sales'] = $this->SalesModel->get_all_sales();
		$this->load->view('sales/list', $data);
	}

	public function add() {
		$data['products'] = $this->ProductModel->get_all_products();
		$this->load->view('sales/add', $data);
	}

	public function save() {
		$this->form_validation->set_rules('product_id', 'Product', 'required');
		$this->form_validation->set_rules('quantity', 'Quantity', 'required|integer|greater_than[0]');

		if ($this->form_validation->run() === FALSE) {
			$this->add();
		} else {
			$product = $this->ProductModel->get_product_by_id($this->input->post('product_id'));
			$total_price = $product->price * $this->input->post('quantity');

			$data = [
				'product_id' => $this->input->post('product_id'),
				'quantity' => $this->input->post('quantity'),
				'total_price' => $total_price,
				'customer_name' => $this->input->post('customer_name'),
			];

			$this->SalesModel->add_sale($data);

			$this->session->set_flashdata('message', 'Sale recorded successfully!');
			redirect('sales');
		}
	}
}
