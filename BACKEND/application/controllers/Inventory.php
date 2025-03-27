<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once FCPATH . 'vendor/autoload.php';


class Inventory extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('ProductModel');
	}

	public function index() {
		// Get filter criteria from input
		$search = $this->input->get('search');
		$category = $this->input->get('category');

		// Fetch filtered products
		$data['products'] = $this->ProductModel->get_filtered_products($search, $category);

		// Load the view with data
		$this->load->view('inventory/list', $data);
	}

	public function add_new() {
		// Load the Add New Product view
		$this->load->view('inventory/add');
	}

//	public function print_barcode($barcode) {
//		$this->load->helper('barcode');
//
//		// Generate the barcode
//		$barcode_image = generate_barcode($barcode);
//
//		if (!$barcode_image) {
//			show_error("Failed to generate barcode.", 500);
//			return;
//		}
//
//		// Set header and output the image
//		header('Content-Type: image/png');
//		echo $barcode_image;
//		exit;
//	}
	public function print_barcode($barcode) {
		$this->load->helper('barcode');

		// Generate barcode with text
		$barcode_image = generate_barcode_with_text($barcode);

		if (!$barcode_image) {
			show_error("Failed to generate barcode.", 500);
			return;
		}

		// Set header and output the image
		header('Content-Type: image/png');
		imagepng($barcode_image);
		imagedestroy($barcode_image); // Free memory
		exit;
	}




	public function save() {
		// Validate input
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('price', 'Price', 'required|numeric');
		$this->form_validation->set_rules('selling_price', 'Selling Price', 'required|numeric');
		$this->form_validation->set_rules('stock', 'Stock', 'required|integer');
		$this->form_validation->set_rules('low_stock_threshold', 'Low Stock Threshold', 'required|integer');
//		$this->form_validation->set_rules('barcode', 'Barcode', 'required|alpha_numeric');
		$newBarCodeNumber = rand(1,999999999).time().date("Ymd");




		if ($this->form_validation->run() === FALSE) {
			// Reload the form with validation errors
			$this->load->view('inventory/add');
		} else {
			// Collect product data
			$data = [
				'name' => $this->input->post('name'),
				'category' => $this->input->post('category'),
				'price' => $this->input->post('price'),
				'selling_price' => $this->input->post('selling_price'),
				'stock' => $this->input->post('stock'),
				'low_stock_threshold' => $this->input->post('low_stock_threshold'),
				'barcode' => $newBarCodeNumber,
			];

			// Save the product
			$this->ProductModel->add_product($data);

			// Redirect to inventory list with success message
			$this->session->set_flashdata('message', 'New product added successfully!');
			redirect('inventory');
		}
	}


	public function edit($id) {
		// Fetch product details by ID
		$data['product'] = $this->ProductModel->get_product_by_id($id);

		if (!$data['product']) {
			// Handle non-existent product
			show_404();
		}

		$this->load->view('inventory/edit', $data);
	}

	public function update($id) {
		// Validate input
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('price', 'Price', 'required|numeric');
		$this->form_validation->set_rules('selling_price', 'Selling Price', 'required|numeric');
		$this->form_validation->set_rules('stock', 'Stock', 'required|integer');
		$this->form_validation->set_rules('low_stock_threshold', 'Low Stock Threshold', 'required|integer');

		if ($this->form_validation->run() === FALSE) {
			// Reload the edit form with validation errors
			$data['product'] = $this->ProductModel->get_product_by_id($id);
			$this->load->view('inventory/edit', $data);
		} else {
			// Update product
			$data = [
				'name' => $this->input->post('name'),
				'category' => $this->input->post('category'),
				'price' => $this->input->post('price'),
				'selling_price' => $this->input->post('selling_price'),
				'stock' => $this->input->post('stock'),
				'low_stock_threshold' => $this->input->post('low_stock_threshold')
			];

			$this->ProductModel->update_product($id, $data);

			// Redirect to inventory list with a success message
			$this->session->set_flashdata('message', 'Product updated successfully!');
			redirect('inventory');
		}
	}


	public function delete($id) {
		$this->ProductModel->delete_product($id);
		redirect('inventory');
	}


}
