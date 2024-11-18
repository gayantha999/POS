<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('SalesModel');
		$this->load->library('pdf');
	}

	// Generate an invoice for a specific sale
	public function generate($sale_id) {
		$sale = $this->SalesModel->get_sale_by_id($sale_id);

		if (!$sale) {
			show_404();
		}

		$data['sale'] = $sale;
		$this->load->view('invoice/generate', $data);
	}

	// Download invoice as PDF
	public function download($sale_id) {
		$sale = $this->SalesModel->get_sale_by_id($sale_id);

		if (!$sale) {
			show_404();
		}

		// Generate PDF content
		$html_content = $this->load->view('invoice/generate', ['sale' => $sale], true);

		// Load the PDF library
		$this->pdf->loadHtml($html_content);
		$this->pdf->setPaper('A4', 'portrait');
		$this->pdf->render();

		// Download the file
		$this->pdf->stream('invoice_' . $sale_id . '.pdf', array("Attachment" => 1));
	}
}
