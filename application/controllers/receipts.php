<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Receipts extends MY_Controller {

	protected $title 		= 'Receipts';
	protected $activemenu 	= 'receipts';
	
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('receipt_model');
	}
/*---------------------------------------------------------------------------------------------------------
| Function to list receipt
|----------------------------------------------------------------------------------------------------------*/
	public function index($status = 'all')
	{
		$data = array();
		$data['title'] 			= $this->title;
		$data['activemenu'] 	= $this->activemenu;
		$data['receipts']			= $this->receipt_model->get_receipts($status);
		$data['status']			= $status;
		$data['pagecontent'] 	= 'receipts/receipts';
		$this->load->view('common/holder', $data);
	}
/*---------------------------------------------------------------------------------------------------------
| Function to create new invoice
|----------------------------------------------------------------------------------------------------------*/
	public function newreceipt()
	{
		$data = array();
		$data['title'] 			= $this->title;
		$data['activemenu'] 	= $this->activemenu;
		$data['clients'] 		= $this->common_model->get_select_option('ci_clients', 'client_id', 'client_name');
		$data['receipt_number']	= $this->generate_receipt_number();
		$data['pagecontent'] 	= 'receipts/newreceipt';
		$this->load->view('common/holder', $data);
	}

/*---------------------------------------------------------------------------------------------------------
| Function to save new invoice
|----------------------------------------------------------------------------------------------------------*/
	function ajax_save_receipt()
	{		
		$receipt_number = $this->input->post('receipt_number');
		$receipt_id = $this->input->post('receipt_id');
		$save_type = $this->input->post('save_type');
		
			$valid = $this->receipt_model->validate_receipt_num($receipt_number, $receipt_id);
			
			if($valid){

				if($save_type == 'new'){
						$receipt_details = array('user_id' 				=> $this->session->userdata('user_id'),
												 'client_id' 			=> $this->input->post('receipt_client'),
												 'receipt_amount' 		=> $this->input->post('receipt_amount'),
												 'receipt_number' 		=> $receipt_number,
												 'receipt_terms' 		=> $this->input->post('receipt_terms'),
												 'receipt_date_created' => date('Y-m-d', strtotime($this->input->post('receipt_date'))),
												);
						$receipt_id = $this->common_model->saverecord('ci_receipts', $receipt_details);
						
						// add new for DEBT function aumatically it to record it is paid...
						$debt_details = array('user_id' 				=> $this->session->userdata('user_id'),
								'client_id' 			=> $this->input->post('receipt_client'),
								'receipt_id'			=> $receipt_id,
								'debt_reference' 		=> 'Receipt No: '.$receipt_number,
								'debt_description' 		=> $this->input->post('receipt_terms'),
								'debt_amount_paid' 		=> $this->input->post('receipt_amount'),
								'debt_date_updated' 	=> date('Y-m-d'),
								'debt_date_created' 	=> date('Y-m-d', strtotime($this->input->post('receipt_date'))),
								'debt_status'			=> 'PAID'
						);
						$debt_id = $this->common_model->saverecord('ci_debt', $debt_details);												
				}
				else
				{
						$receipt_details = array('client_id' 			=> $this->input->post('receipt_client'),
												 'receipt_terms' 		=> $this->input->post('receipt_terms'),
												 'receipt_amount' 			=> $this->input->post('receipt_amount'),
												 'receipt_number' 		=> $receipt_number,
												 'receipt_status' 		=> $this->input->post('receipt_status'),
												 'receipt_date_created' => date('Y-m-d', strtotime($this->input->post('receipt_date'))),
											);
						$this->common_model->update_records('ci_receipts', 'receipt_id', $receipt_id, $receipt_details);
						
						$debt_record = $this->common_model->select_record('ci_debt', 'receipt_id', $receipt_id);
						
						if($debt_record):
						
							$debt_details = array(
									'user_id' 				=> $this->session->userdata('user_id'),
									'client_id' 			=> $this->input->post('receipt_client'),
									'debt_reference' 		=> 'Receipt No: '.$receipt_number,
									'debt_description' 		=> $this->input->post('receipt_terms'),
									'debt_amount_paid' 		=> $this->input->post('receipt_amount'),
									'debt_date_created' 	=> date('Y-m-d', strtotime($this->input->post('receipt_date'))),
									'debt_date_updated' 	=> date('Y-m-d'),
									'debt_status'			=> 'PAID'
							);
								
							$this->common_model->update_records('ci_debt', 'receipt_id', $receipt_id, $debt_details);
						
						else:
						
							$debt_details = array(
									'user_id' 				=> $this->session->userdata('user_id'),
									'client_id' 			=> $this->input->post('receipt_client'),
									'receipt_id'			=> $receipt_id,
									'debt_reference' 		=> 'Receipt No: '.$receipt_number,
									'debt_description' 		=> $this->input->post('receipt_terms'),
									'debt_amount_paid' 		=> $this->input->post('receipt_amount'),
									'debt_date_updated' 	=> date('Y-m-d'),
									'debt_date_created' 	=> date('Y-m-d', strtotime($this->input->post('receipt_date'))),
									'debt_status'			=> 'PAID'
							);
							
							$debt_id = $this->common_model->saverecord('ci_debt', $debt_details);
						
						endif;
							
				}
				
				$response = array(
	                'success'           => 1,
	            );
			}
			else{
				$response = array(
	                'success'           => 0,
	                'error'  			=> 'The receipt number already exists for another receipt',
            	);
			}

		

		echo json_encode($response);	
	}
/*---------------------------------------------------------------------------------------------------------
| Function to generate receipt numbers
|----------------------------------------------------------------------------------------------------------*/
	function generate_receipt_number()
	{
		$last_receipt_id = $this->common_model->get_last_id('ci_receipts', 'receipt_id') + 1;
		return $last_receipt_id;
	}
/*---------------------------------------------------------------------------------------------------------
| Function to filter receipts
|----------------------------------------------------------------------------------------------------------*/
	function ajax_filter_receipts()
	{
		$data = array();
		$receipt_status 	= $this->input->post('status');
		$data['receipts']	= $this->receipt_model->get_receipts($receipt_status);
		$data['status']		= ($receipt_status != 'all' ) ? $receipt_status : '';	
		$receipt_results 	= $this->load->view('receipts/filtered_receipts', $data, true);
		echo $receipt_results;
	}
/*---------------------------------------------------------------------------------------------------------
| Function to edit receipt
|----------------------------------------------------------------------------------------------------------*/
	function edit($receipt_id = 0)
	{
		$data = array();
		$data['title'] 			= $this->title;
		$data['activemenu'] 	= $this->activemenu;
		$data['receipt_details']= $this->receipt_model->get_receipt_data($receipt_id);
		$data['clients'] 		= $this->common_model->get_select_option('ci_clients', 'client_id', 'client_name', $data['receipt_details']->client_id);
		$data['pagecontent'] 	= 'receipts/editreceipt';
		$this->load->view('common/holder', $data);
	}
/*---------------------------------------------------------------------------------------------------------
| Function to display products to be added in receipt 
|----------------------------------------------------------------------------------------------------------*/	
	function items_from_products()
	{
		$data = array();
		$data['products'] = $this->common_model->db_select('ci_products');
		$this->load->view('receipts/products_modal', $data);
	}
/*---------------------------------------------------------------------------------------------------------
| Function to delete an receipt 
|----------------------------------------------------------------------------------------------------------*/	
	function delete_receipt($receipt_id = 0)
	{
		$this->receipt_model->delete_receipt($receipt_id);
		$this->session->set_flashdata('success', 'The receipt has been deleted successfully !!');
		redirect('receipts');
	}
/*---------------------------------------------------------------------------------------------------------
| Function to enter payment for an receipt 
|----------------------------------------------------------------------------------------------------------*/	
	function enter_payment($receipt_id = 0)
	{
		$data = array();
		$data['receipt'] 			= $this->receipt_model->get_receipt_details($receipt_id);
		$data['payment_methods'] 	= $this->common_model->get_select_option('ci_payment_methods', 'payment_method_id', 'payment_method_name');
		$this->load->view('receipts/enter_payment_modal', $data);
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
			$receipt_id = $this->input->post('receipt_id');
			$payment_details = array('receipt_id'		=> $this->input->post('receipt_id'),
								  'payment_amount'		=> $this->input->post('payment_amount'),
								  'payment_method_id'	=> $this->input->post('payment_method_id'),
								  'payment_date'		=> date('Y-m-d', strtotime($this->input->post('payment_date'))),
								  'payment_note'		=> $this->input->post('payment_note'),
								 );
			$this->receipt_model->addpayment($receipt_id, $payment_details);
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
| Function to preview an receipt
|----------------------------------------------------------------------------------------------------------*/	
	function previewreceipt($receipt_id = 0)
	{
		$data 						= array();
		$data['title'] 				= $this->title;
		$data['receipt_details']	= $this->receipt_model->previewreceipt($receipt_id);
		$this->load->view('receipts/previewreceipt', $data);
	}
/*---------------------------------------------------------------------------------------------------------
| Function to send receipt to client
|----------------------------------------------------------------------------------------------------------*/	
	function emailclient($receipt_id = 0)
	{
		$data 						= array();
		$data['title'] 				= $this->title;
		$data['receipt_details']	= $this->receipt_model->get_receipt_details($receipt_id);
		$data['email_templates'] 	= $this->common_model->get_select_option('ci_email_templates', 'template_id', 'template_title');
		$this->load->view('receipts/emailclient', $data);
	}

	
	function viewpdf($receipt_id, $company)
	{
		$data 		  = array();
		$data['title'] 	 = $this->title;
		
		$receipt_details = $this->receipt_model->previewreceipt($receipt_id);
		$this->load->helper('pdf');
		$pdf_receipt = generate_pdf_receipt($receipt_details, true, $company);
	}

}
