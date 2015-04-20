<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tax_invoices extends MY_Controller {

	protected $title 		= 'Tax Invoices';
	protected $activemenu 	= 'tax_invoices';
	
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('tax_invoice_model');
	}
/*---------------------------------------------------------------------------------------------------------
| Function to list tax invoices
|----------------------------------------------------------------------------------------------------------*/
	public function index($status = 'all')
	{
		$data = array();
		$data['title'] 			= $this->title;
		$data['activemenu'] 	= $this->activemenu;
		$data['invoices']		= $this->tax_invoice_model->get_invoices($status);
		$data['status']			= $status;
		$data['pagecontent'] 	= 'tax_invoices/invoices';
		$this->load->view('common/holder', $data);
	}
/*---------------------------------------------------------------------------------------------------------
| Function to create new invoice
|----------------------------------------------------------------------------------------------------------*/
	public function newinvoice()
	{
		$data = array();
		$data['title'] 			= $this->title;
		$data['activemenu'] 	= $this->activemenu;
		$data['clients'] 		= $this->common_model->get_select_option('ci_clients', 'client_id', 'client_name');
		$data['taxrates'] 		= $this->common_model->get_select_option('ci_tax_rates', 'tax_rate_id', 'tax_rate_name', 1);
		$data['invoice_number']	= $this->generate_invoice_number();
		$data['pagecontent'] 	= 'tax_invoices/newinvoice';
		$this->load->view('common/holder', $data);
	}
/*---------------------------------------------------------------------------------------------------------
| Function to display overdue tax_invoices
|----------------------------------------------------------------------------------------------------------*/
	public function overdue()
	{
		$data = array();
		$this->activemenu 			= 'overdue';
		$data['title'] 				= $this->title;
		$data['activemenu'] 		= $this->activemenu;
		$data['overdue_invoices']	= $this->tax_invoice_model->overdue_invoices();
		$data['pagecontent'] 		= 'tax_invoices/overdue_invoices';
		$this->load->view('common/holder', $data);
	}
/*---------------------------------------------------------------------------------------------------------
| Function to calculate invoice totals
|----------------------------------------------------------------------------------------------------------*/
	function ajax_calculate_totals()
	{
		$items = json_decode($this->input->post('items'));
		$items_total_cost = 0;
		$invoice_total_tax = 0;
		$items_total_discount = 0;
		$invoice_discount_amount = $this->input->post('invoice_discount_amount');
		$invoice_id = $this->input->post('invoice_id');
		foreach ($items as $item) 
		{
			if($item->item_quantity != '' && $item->item_price != '')
			{
				$item_total 	=	$item->item_quantity * $item->item_price - $item->item_discount;
				$items_total_cost = $items_total_cost + $item_total;
				$sub_total1 = $items_total_cost - $invoice_discount_amount;
				
				$tax_percent = $this->common_model->get_tax($item->tax_rate_id);
				$invoice_total_tax = $sub_total1 * $tax_percent;
				
				$items_total_discount += $item->item_discount;  
			}
		}
		$invoice_amount_paid = $this->tax_invoice_model->get_invoice_paid_amount($invoice_id);
		$amount_due = $items_total_cost - $invoice_discount_amount + $invoice_total_tax - $invoice_amount_paid;
		$response = array(
                'success'           => 1,
                'items_total_cost'  => number_format($items_total_cost, 2),
				'items_sub_total1'  => number_format($sub_total1, 2),
				'invoice_total_tax'	=> number_format($invoice_total_tax, 2),
				'invoice_sub_total2' => number_format($items_total_cost - $invoice_discount_amount + $invoice_total_tax, 2),
				'invoice_discount_amount' => number_format($invoice_discount_amount, 2),
				'invoice_amount_due' => number_format($amount_due, 2)
				
            );
		echo json_encode($response);
	}
/*---------------------------------------------------------------------------------------------------------
| Function to save new invoice
|----------------------------------------------------------------------------------------------------------*/
	function ajax_save_invoice()
	{
		$items = json_decode($this->input->post('items'));
		$invoice_number = $this->input->post('invoice_number');
		$invoice_id = $this->input->post('invoice_id');
		$save_type = $this->input->post('save_type');

		$invoice_items = 0;
		foreach ($items as $item) 
		{
			if($item->item_quantity != '' && $item->item_price != '')
			{
				$invoice_items++;
			}
		}
		if($invoice_items > 0)
		{
			$valid = $this->tax_invoice_model->validate_invoice_num($invoice_number, $invoice_id);

			if($valid){

				if($save_type == 'new'){
						$invoice_details = array('user_id' 				=> $this->session->userdata('user_id'),
												 'client_id' 			=> $this->input->post('invoice_client'),
												 'invoice_number' 		=> $invoice_number,
												 'invoice_terms' 		=> $this->input->post('invoice_terms'),
												 'invoice_discount'		=> $this->input->post('invoice_discount_amount'),
												 'invoice_due_date' 	=> date('Y-m-d', strtotime($this->input->post('invoice_due_date'))),
												 'invoice_date_created' => date('Y-m-d', strtotime($this->input->post('invoice_date'))),
												);
						$invoice_id = $this->common_model->saverecord('ci_tax_invoices', $invoice_details);
				}
				else
				{
						$invoice_details = array('client_id' 			=> $this->input->post('invoice_client'),
												 'invoice_terms' 		=> $this->input->post('invoice_terms'),
												 'invoice_number' 		=> $invoice_number,
												 'invoice_status' 		=> $this->input->post('invoice_status'),
												 'invoice_discount'		=> $this->input->post('invoice_discount_amount'),
												 'invoice_due_date' 	=> date('Y-m-d', strtotime($this->input->post('invoice_due_date'))),
												 'invoice_date_created' => date('Y-m-d', strtotime($this->input->post('invoice_date'))),
											);
						$this->common_model->update_records('ci_tax_invoices', 'invoice_id', $invoice_id, $invoice_details);
				}				
				
				foreach ($items as $item) 
				{
					if($item->item_quantity != '' && $item->item_price != '')
					{
						$item_id = $item->item_id;
						$item_details = array ('invoice_id'			=> $invoice_id,
											   'item_name'			=> $item->item_name,
											   'item_quantity'		=> $item->item_quantity,
											   'item_description'	=> $item->item_description,
											   'item_taxrate_id'	=> $item->tax_rate_id,
											   'item_order'			=> $item->item_order,
											   'item_price'			=> $item->item_price,
											   'item_discount'		=> $item->item_discount,
											  );
						if($item_id != '')
						{
							$this->common_model->update_records('ci_tax_invoice_items', 'item_id', $item_id, $item_details);
							$this->session->set_flashdata('success', 'The invoice has been edited successfully !!');
						}
						else
						{
							$this->common_model->saverecord ('ci_tax_invoice_items', $item_details);
							$this->session->set_flashdata('success', 'The invoice has been created successfully !!');
						}
					}
				}
				
				$response = array(
	                'success'           => 1,
					'item' => $items,
	            );
			}
			else{
				$response = array(
	                'success'           => 0,
	                'error'  			=> 'The invoice number already exists for another invoice',
            	);
			}

		}
		else
		{
			$response = array(
                'success'           => 0,
                'error'  			=> 'Please enter atleast one item',
            );
		}
		echo json_encode($response);	
	}
/*---------------------------------------------------------------------------------------------------------
| Function to generate invoice numbers
|----------------------------------------------------------------------------------------------------------*/
	function generate_invoice_number()
	{
		$last_invoice_id = $this->common_model->get_last_id('ci_tax_invoices', 'invoice_id') + 1;
		return $last_invoice_id;
	}
/*---------------------------------------------------------------------------------------------------------
| Function to filter tax_invoices
|----------------------------------------------------------------------------------------------------------*/
	function ajax_filter_invoices()
	{
		$data = array();
		$invoice_status 	= $this->input->post('status');
		$data['invoices']	= $this->tax_invoice_model->get_invoices($invoice_status);
		$data['status']		= ($invoice_status != 'all' ) ? $invoice_status : '';	
		$invoice_results 	= $this->load->view('tax_invoices/filtered_invoices', $data, true);
		echo $invoice_results;
	}
/*---------------------------------------------------------------------------------------------------------
| Function to edit invoice
|----------------------------------------------------------------------------------------------------------*/
	function edit($invoice_id = 0)
	{
		$data = array();
		$data['title'] 			= $this->title;
		$data['activemenu'] 	= $this->activemenu;
		$data['invoice_details']= $this->tax_invoice_model->get_invoice_data($invoice_id);
		$data['invoice_items']	= $this->tax_invoice_model->get_invoice_items($invoice_id);
		$data['invoice_payments']= $this->tax_invoice_model->get_invoice_payments($invoice_id);
		$data['clients'] 		= $this->common_model->get_select_option('ci_clients', 'client_id', 'client_name', $data['invoice_details']->client_id);
		$data['taxrates'] 		= $this->common_model->get_select_option('ci_tax_rates', 'tax_rate_id', 'tax_rate_name', 1);
		$data['pagecontent'] 	= 'tax_invoices/editinvoice';
		$this->load->view('common/holder', $data);
	}
/*---------------------------------------------------------------------------------------------------------
| Function to edit invoice
|----------------------------------------------------------------------------------------------------------*/
	function delete_item($invoice_id=0, $item_id=0)
	{
		$this->common_model->deleterecord('ci_tax_invoice_items', 'item_id', $item_id);
		$this->session->set_flashdata('success', 'The item has been deleted successfully !!');
		redirect('tax_invoices/edit/'.$invoice_id);
	}
/*---------------------------------------------------------------------------------------------------------
| Function to display products to be added in invoice 
|----------------------------------------------------------------------------------------------------------*/	
	function items_from_products()
	{
		$data = array();
		$data['products'] = $this->common_model->db_select('ci_products');
		$this->load->view('tax_invoices/products_modal', $data);
	}
/*---------------------------------------------------------------------------------------------------------
| Function to delete an invoice 
|----------------------------------------------------------------------------------------------------------*/	
	function delete_invoice($invoice_id = 0)
	{
		$this->tax_invoice_model->delete_invoice($invoice_id);
		$this->session->set_flashdata('success', 'The invoice has been deleted successfully !!');
		redirect('tax_invoices');
	}
/*---------------------------------------------------------------------------------------------------------
| Function to enter payment for an invoice 
|----------------------------------------------------------------------------------------------------------*/	
	function enter_payment($invoice_id = 0)
	{
		$data = array();
		$data['invoice'] 			= $this->tax_invoice_model->get_invoice_details($invoice_id);
		$data['payment_methods'] 	= $this->common_model->get_select_option('ci_payment_methods', 'payment_method_id', 'payment_method_name');
		$this->load->view('tax_invoices/enter_payment_modal', $data);
	}
	function addpayment()
	{
		$this->form_validation->set_rules('payment_amount', 'amount', 'trim|required|numeric|callback_amount_check|xss_clean');
		$this->form_validation->set_rules('payment_method_id', 'payment method', 'trim|required|xss_clean');
		$this->form_validation->set_rules('payment_date', 'payment date', 'trim|required|xss_clean');
		$this->form_validation->set_rules('payment_note', 'payment note', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<p class="has-error"><label class="control-label">', '</label></p>');
		if($this->form_validation->run())
		{
			if($this->input->post('payment_amount') <= 0){
				$this->form_validation->set_message('required', 'amount');
			}
			else{
			$invoice_id = $this->input->post('invoice_id');
			$payment_details = array('invoice_id'		=> $this->input->post('invoice_id'),
								  'payment_amount'		=> $this->input->post('payment_amount'),
								  'payment_method_id'	=> $this->input->post('payment_method_id'),
								  'payment_date'		=> date('Y-m-d', strtotime($this->input->post('payment_date'))),
								  'payment_note'		=> $this->input->post('payment_note'),
								 );
			$this->tax_invoice_model->addpayment($invoice_id, $payment_details);
			$this->session->set_flashdata('success', 'Payment has been added successfully !!');
			$response = array(
					'success'           => 1
				);
				}
		}
		else
		{
		$this->load->helper('json_error');
				$response = array(
					'success'           => 0,
					'validation_errors' => json_errors()
				);
			
		}
		echo json_encode($response);	
	}
	function amount_check($str)
	{
		if ($str <= 0)
		{
			$this->form_validation->set_message('amount_check', 'The %s field can not be 0');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
/*---------------------------------------------------------------------------------------------------------
| Function to preview an invoice
|----------------------------------------------------------------------------------------------------------*/	
	function previewinvoice($invoice_id = 0)
	{
		$data 						= array();
		$data['title'] 				= $this->title;
		$data['invoice_details']	= $this->tax_invoice_model->previewinvoice($invoice_id);
		$this->load->view('tax_invoices/previewinvoice', $data);
	}
/*---------------------------------------------------------------------------------------------------------
| Function to send invoice to client
|----------------------------------------------------------------------------------------------------------*/	
	function emailclient($invoice_id = 0)
	{
		$data 						= array();
		$data['title'] 				= $this->title;
		$data['invoice_details']	= $this->tax_invoice_model->get_invoice_details($invoice_id);
		$data['email_templates'] 	= $this->common_model->get_select_option('ci_email_templates', 'template_id', 'template_title');
		$this->load->view('tax_invoices/emailclient', $data);
	}

	function ajax_send_email()
	{
		$this->form_validation->set_rules('client_name', 'client name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email_subject', 'email subject', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email_template', 'email template', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email_body', 'email body', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<p class="has-error"><label class="control-label">', '</label></p>');
		if($this->form_validation->run())
		{
			$this->load->helper('template');
			$invoice_id 	= $this->input->post('invoice_id');
			$email_subject 	= $this->input->post('email_subject');
			$email_body 	= $this->input->post('email_body');
			
			$invoice_data = $this->tax_invoice_model->get_invoice_data($invoice_id);
			$message_body = parse_template($invoice_data, $email_body);
			$invoice_details = $this->tax_invoice_model->previewinvoice($invoice_id);
			$this->load->helper('pdf');
			$pdf_invoice = generate_pdf_invoice($invoice_details, false, NULL);
			$to = $invoice_data->client_email;
			
			if(send_email($email_subject, $to,  $message_body, $pdf_invoice)){
				$this->session->set_flashdata('success', 'The invoice has been emailed successfully !!');
				$response = array(
					'success'           => 1,
				);
			}
			else{
				$response = array(
					'success'           => 0,
					'errormsg'          => 'Please set the company name and the company email in system settings first !!',
				);
			}
		}
		else
		{
			$this->load->helper('json_error');
				$response = array(
					'success'           => 0,
					'validation_errors' => json_errors()
				);
			
		}
		echo json_encode($response);
	}
	function viewpdf($invoice_id)
	{
		$data 		  = array();
		$data['title'] 	 = $this->title;
		
		$invoice_details = $this->tax_invoice_model->previewinvoice($invoice_id);
		$this->load->helper('pdf');
		$pdf_invoice = generate_pdf_tax_invoice($invoice_details, true, NULL);
	}
	function view_full_report_pdf($client_id, $from_date, $to_date, $status)
	{
		$data 		  = array();
		$data['title'] 	 = $this->title;	
		$full_report_details = $this->tax_reports_model->invoices_full_report($client_id, $from_date, $to_date, $status);
				
		$this->load->helper('pdf');
		$pdf_invoice = generate_pdf_full_report($full_report_details, true, NULL);
	}
}
