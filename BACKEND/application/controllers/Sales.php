<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('SalesModel');
		$this->load->model('ProductModel');
	}

	public function index() {
		$product_name = $this->input->get('product_name'); // Get product filter
		$start_date = $this->input->get('start_date'); // Get start date filter
		$end_date = $this->input->get('end_date'); // Get end date filter

		// Fetch filtered sales data
		$data['sales'] = $this->SalesModel->get_filtered_sales($product_name, $start_date, $end_date);
		$this->load->view('sales/list', $data); // Load the sales list view
	}


	public function add() {
		$data['products'] = $this->ProductModel->get_all_products();
		$this->load->view('sales/add', $data);
	}

	public function save() {
		$product = $this->ProductModel->get_product_by_id($this->input->post('product_id'));
		$quantity = $this->input->post('quantity');
		$selling_price = $this->input->post('selling_price');
		$total_price = $quantity * $selling_price;

		$data = [
			'product_id' => $this->input->post('product_id'),
			'price' => $product->price,
			'quantity' => $quantity,
			'selling_price' => $selling_price,
			'total_price' => $total_price,
			'customer_name' => $this->input->post('customer_name'),
		];

		$this->SalesModel->add_sale($data);

		$this->session->set_flashdata('message', 'Sale recorded successfully!');
		redirect('sales');
	}
	public function reports() {
		// Load required models
		$this->load->model('SalesModel');

		// Fetch report data
		$data['daily_sales'] = $this->SalesModel->get_sales_summary('daily');
		$data['weekly_sales'] = $this->SalesModel->get_sales_summary('weekly');
		$data['monthly_sales'] = $this->SalesModel->get_sales_summary('monthly');
		$data['top_products'] = $this->SalesModel->get_top_selling_products();
		$data['total_revenue'] = $this->SalesModel->get_total_revenue();

		// Load the reports view
		$this->load->view('sales/reports', $data);
	}


	public function export_csv() {
		$this->load->model('SalesModel');
		$sales_data = $this->SalesModel->get_all_sales();

		// File name
		$filename = 'sales_report_' . date('Ymd') . '.csv';
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/csv;");

		// File creation
		$file = fopen('php://output', 'w');
		$header = ['Sale ID', 'Product Name', 'Quantity','price','selling_price', 'Total Price', 'Customer Name', 'Sale Date'];
		fputcsv($file, $header);

		foreach ($sales_data as $line) {
			fputcsv($file, (array) $line);
		}
		fclose($file);
		exit;
	}

	public function export_pdf() {
		$this->load->library('pdf');
		$this->load->model('SalesModel');
		$sales_data = $this->SalesModel->get_all_sales_pdf();

		// Generate PDF content
		$html_content = '<h1>Sales Report</h1>';
		$html_content .= '<table border="1" width="100%" style="border-collapse: collapse;">';
		$html_content .= '<thead>
                        <tr>
                            <th>Sale ID</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Customer Name</th>
                            <th>Sale Date</th>
                        </tr>
                      </thead>';
		$html_content .= '<tbody>';
		foreach ($sales_data as $line) {
			$html_content .= '<tr>';
			$html_content .= '<td>' . $line->id . '</td>';
			$html_content .= '<td>' . $line->product_name . '</td>';
			$html_content .= '<td>' . $line->quantity . '</td>';
			$html_content .= '<td>' . $line->total_price . '</td>';
			$html_content .= '<td>' . $line->customer_name . '</td>';
			$html_content .= '<td>' . $line->sale_date . '</td>';
			$html_content .= '</tr>';
		}
		$html_content .= '</tbody>';
		$html_content .= '</table>';

		// Load PDF library and render
		$this->pdf->loadHtml($html_content);
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->render();
		$this->pdf->stream('sales_report_' . date('Ymd') . '.pdf', array("Attachment" => 1));
	}

}
