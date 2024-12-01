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

//	public function save() {
//		$product = $this->ProductModel->get_product_by_id($this->input->post('product_id'));
//		$quantity = $this->input->post('quantity');
//		$selling_price = $this->input->post('selling_price');
//		$total_price = $quantity * $selling_price;
//
//		$data = [
//			'product_id' => $this->input->post('product_id'),
//			'price' => $product->price,
//			'quantity' => $quantity,
//			'selling_price' => $selling_price,
//			'total_price' => $total_price,
//			'payment_type' =>$this->input->post('payment_method'),
//			'customer_name' => $this->input->post('customer_name'),
//			'description' => $this->input->post('description'),
//			'warranty' => $this->input->post('warranty'),
//		];
//		$id = $this->input->post('product_id');
//		$this->SalesModel->add_sale($data);
//		$this->SalesModel->QuantityManage($id,$quantity);
//
//		$this->session->set_flashdata('message', 'Sale recorded successfully!');
//
//	}

//	public function save() {
//		// Retrieve form data
//		$product_ids = $this->input->post('product_id');
//		$prices = $this->input->post('price');
//		$quantities = $this->input->post('quantity');
//		$selling_prices = $this->input->post('selling_price');
//		$total_prices = $this->input->post('total_price');
//		$payment_type = $this->input->post('payment_method');
//		$customer_name = $this->input->post('customer_name');
//		$description = $this->input->post('description');
//		$warranty = $this->input->post('warranty');
//
//		// Ensure required fields are not empty
//
//		// Load the model
//		$this->load->model('SalesModel');
//
//var_dump($product_ids);die();
//		try {
//			// Loop through each product entry
//			foreach ($product_ids as $index => $product_id) {
//				// Prepare data for insertion
//				$data = [
//					'product_id' => $product_id,
//					'price' => $prices[$index],
//					'quantity' => $quantities[$index],
//					'selling_price' => $selling_prices[$index],
//					'total_price' => $total_prices[$index],
//					'payment_type' => $payment_type,
//					'customer_name' => $customer_name,
//					'description' => $description,
//					'warranty' => $warranty,
//					'created_at' => date('Y-m-d H:i:s') // Add timestamp
//				];
//
//
//				// Save each sale
//				$this->SalesModel->add_sale($data);
//
//				// Update inventory quantity
//				$this->SalesModel->QuantityManage($product_id, $quantities[$index]);
//			}
//
//			// Commit transaction
//			$this->db->trans_complete();
//
//			// Check transaction status
//			if ($this->db->trans_status() === FALSE) {
//				throw new Exception('Database transaction failed.');
//			}
//
//			// Set success message and redirect
//			$this->session->set_flashdata('success', 'Sales recorded successfully!');
//			redirect('sales');
//
//		} catch (Exception $e) {
//			// Rollback transaction and set error message
//			$this->db->trans_rollback();
//			$this->session->set_flashdata('error', 'An error occurred: ' . $e->getMessage());
//			redirect('sales/add');
//		}
//	}

//	public function save() {
//		$salesData = json_decode(file_get_contents('php://input'), true);
//		var_dump($salesData['sales']);die();
//		if (!isset($salesData['sales']) || empty($salesData['sales'])) {
//			echo json_encode(['success' => false, 'message' => 'Invalid data submitted.']);
//			return;
//		}
//
//		foreach ($salesData['sales'] as $sale) {
//			// Save each sale and update inventory as needed
//			$this->SalesModel->add_sale($sale);
//			$this->SalesModel->QuantityManage($sale['product_id'], $sale['quantity']);
//		}
//
//		echo json_encode(['success' => true, 'message' => 'Sales recorded successfully!']);
//	}

	public function save()
	{
		// Get JSON input
		$input = json_decode(file_get_contents('php://input'), true);

		$last_invoice = $this->SalesModel->getLastInvoiceNumber();
		$last_two_digits = intval(substr($last_invoice, -2)); // Get the last two digits
//		print_r($last_two_digits); die();
		$new_invoice_number = $last_invoice ? 'Invoice-' . str_pad(($last_two_digits + 1), 2, '0', STR_PAD_LEFT) : 'Invoice-01';
		// Process sales data (simplified example)
		foreach ($input['sales'] as $sale) {

			if (empty($sale['product_id']) || empty($sale['selling_price']) || empty($sale['quantity'])) {
				echo json_encode(['success' => false, 'message' => 'Invalid sales data.']);
				return;
			}

			// Save to the database
			// Assuming $this->db is the database instance
			$data =  [
				'invoice_number' => $new_invoice_number,
				'product_id' => $sale['product_id'],
				'price' => $sale['price'],
				'selling_price' => $sale['selling_price'],
				'discount_price' => $sale['discount_price'],
				'quantity' => $sale['quantity'],
				'payment_type' => $sale['payment_type'],
				'customer_name' => $sale['customer_name'],
				'description' => $sale['description'],
				'mobile_number' => $sale['mobile_number'],
				'warranty' => $sale['warranty'],
				'total_price' => $sale['total_price'],
				'sale_date' => date('Y-m-d H:i:s')
			];

			$this->SalesModel->add_sale($data);
			$stock = $this->SalesModel->QuantityManage($sale['product_id'], $sale['quantity']);
//			if($stock === false){
//				print_r('refill');
//				$this->load->library('email');
//
//				// Email configuration
//				$config = array(
//					'protocol'  => 'smtp',
//					'smtp_host' => 'your_smtp_host', // Replace with your SMTP host
//					'smtp_user' => 'your_email@example.com', // Replace with your email
//					'smtp_pass' => 'your_password', // Replace with your email password
//					'smtp_port' => 587, // Replace with your SMTP port (usually 587 for TLS)
//					'mailtype'  => 'html',
//					'charset'   => 'utf-8',
//					'wordwrap'  => true
//				);
//				$this->email->initialize($config);
//
//				// Set email parameters
//				$this->email->from('your_email@example.com', 'Your Company'); // Replace with your email and name
//				$this->email->to('stock_manager@example.com'); // Replace with the recipient email
//				$this->email->subject('Stock Limit Alert');
//				$this->email->message('The stock for Product ID: ' . $sale['product_id'] . ' is below the required limit. Please refill.');
//
//				// Send the email
//				if ($this->email->send()) {
//					log_message('info', 'Stock alert email sent successfully.');
//				} else {
//					log_message('error', 'Failed to send stock alert email.');
//				}
//			}


		}

		// Send success response
		echo json_encode(['success' => true, 'message' => 'Sales recorded successfully.']);

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

		// Calculate totals
		$total_price = 0;
		$total_discount_price = 0;

		foreach ($sales_data as $line) {
			$total_price += $line->price;
			$total_discount_price += $line->discount_price;
		}

		// File name
		$filename = 'sales_report_' . date('Ymd') . '.csv';
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/csv;");

		// File creation
		$file = fopen('php://output', 'w');
		$header = ['Invoice Number', 'Product', 'Price', 'Selling Price', 'Discount Price', 'Total Price'];
		fputcsv($file, $header);

		foreach ($sales_data as $line) {
			fputcsv($file, (array) $line);
		}

		// Add totals row
		$totals_row = ['Totals', '', $total_price, '', '', $total_discount_price, '', '', '', ''];
		
		fputcsv($file, $totals_row);

		fclose($file);
		exit;
	}

	public function export_pdf() {
		$this->load->library('pdf');
		$this->load->model('SalesModel');
		$sales_data = $this->SalesModel->get_all_sales_pdf();

		// Calculate totals
		$total_price = 0;
		$total_discount_price = 0;

		foreach ($sales_data as $line) {
			$total_price += $line->price;
			$total_discount_price += $line->discount_price;
		}

		// Generate PDF content
		$html_content = '<h1>Sales Report</h1>';
		$html_content .= '<table border="1" width="100%" style="border-collapse: collapse;">';
		$html_content .= '<thead>
                        <tr>
                            <th>Sale ID</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Selling Price</th>
                            <th>Discount Price</th>
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
			$html_content .= '<td>' . $line->price . '</td>';
			$html_content .= '<td>' . $line->selling_price . '</td>';
			$html_content .= '<td>' . $line->discount_price . '</td>';
			$html_content .= '<td>' . $line->total_price . '</td>';
			$html_content .= '<td>' . $line->customer_name . '</td>';
			$html_content .= '<td>' . $line->sale_date . '</td>';
			$html_content .= '</tr>';
		}
		$html_content .= '</tbody>';
		$html_content .= '</table>';

		// Append totals
		$html_content .= '<h3>Total Price: ' . $total_price . '</h3>';
		$html_content .= '<h3>Total Discount Price: ' . $total_discount_price . '</h3>';
		$profit = $total_discount_price -$total_price;
		$html_content .= '<h3>Profit: ' . $profit . '</h3>';

		// Load PDF library and render
		$this->pdf->loadHtml($html_content);
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->render();
		$this->pdf->stream('sales_report_' . date('Ymd') . '.pdf', array("Attachment" => 1));
	}

	public function filter_report()
	{
		$item_id = $this->input->get('item_id');
		$month = $this->input->get('month');

		$data['products'] = $this->Sales_model->get_items();
		$data['months'] = $this->get_months();
		$data['daily_sales'] = $this->Sales_model->get_daily_sales($item_id, $month);
		$data['weekly_sales'] = $this->Sales_model->get_weekly_sales($item_id, $month);
		$data['monthly_sales'] = $this->Sales_model->get_monthly_sales($item_id, $month);
		$data['total_revenue'] = $this->Sales_model->get_total_revenue_reports($item_id, $month);
		$data['top_products'] = $this->Sales_model->get_top_products($item_id, $month);

		$this->load->view('sales/reports', $data);
	}

	private function get_months()
	{
		return [
			'01' => 'January',
			'02' => 'February',
			'03' => 'March',
			'04' => 'April',
			'05' => 'May',
			'06' => 'June',
			'07' => 'July',
			'08' => 'August',
			'09' => 'September',
			'10' => 'October',
			'11' => 'November',
			'12' => 'December',
		];
	}

}
