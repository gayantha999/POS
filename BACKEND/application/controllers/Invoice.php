<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('SalesModel');
		$this->load->library('pdf');
	}

	// Generate an invoice for a specific sale
	public function generate($invoice_number) {

		$invoice_data = $this->SalesModel->get_invoice_data($invoice_number);


		if (!$invoice_data) {
			show_404();
		}

		$data['invoice'] = $invoice_data['invoice'];
		$data['products'] = $invoice_data['products'];
		$this->load->view('invoice/generate', $data);
	}

	// Download invoice as PDF
	public function download($invoice_number) {
		$invoice_data = $this->SalesModel->get_invoice_data($invoice_number);

		if (!$invoice_data) {
			show_404();
		}

		$data['invoice'] = $invoice_data['invoice'];
		$data['products'] = $invoice_data['products'];

		// Generate PDF content
		$html_content = $this->load->view('invoice/generate', $data, true);

		// Load the PDF library
		$this->pdf->loadHtml($html_content);
		$this->pdf->setPaper('A4', 'portrait');
		$this->pdf->render();


		// Download the file
		$this->pdf->stream('invoice_' . $invoice_number . '.pdf', array("Attachment" => 1));
	}

	public function sendInvoice($invoice_number)
	{
		// Fetch invoice data
		$invoice_data = $this->SalesModel->get_invoice_data($invoice_number);

		if (!$invoice_data) {
			show_404(); // Handle error if the invoice doesn't exist
		}

		// Generate WhatsApp URL
		$whatsapp_url = "https://wa.me/" . $invoice_data['invoice']->mobile_number;

		// Redirect to WhatsApp URL
		redirect($whatsapp_url);
	}
}
