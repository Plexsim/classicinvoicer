<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cash_vouchers extends MY_Controller {

	protected $title 		= 'Cash Vouchers';
	protected $activemenu 	= 'cash_vouchers';
	
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('cash_voucher_model');
	}
/*---------------------------------------------------------------------------------------------------------
| Function to list cash voucher
|----------------------------------------------------------------------------------------------------------*/
	public function index($status = 'all')
	{
		$data = array();
		$data['title'] 			= $this->title;
		$data['activemenu'] 	= $this->activemenu;
		$data['cashs']			= $this->cash_voucher_model->get_cashs($status);
		$data['status']			= $status;
		$data['pagecontent'] 	= 'cash_vouchers/cashs';
		$this->load->view('common/holder', $data);
	}
/*---------------------------------------------------------------------------------------------------------
| Function to create new invoice
|----------------------------------------------------------------------------------------------------------*/
	public function newcash()
	{
		$data = array();
		$data['title'] 			= $this->title;
		$data['activemenu'] 	= $this->activemenu;
		$data['staffs'] 		= $this->common_model->get_select_option('ci_staffs', 'staff_id', 'staff_name');
		$data['cash_number']	= $this->generate_cash_number();
		$data['pagecontent'] 	= 'cash_vouchers/newcash';
		$this->load->view('common/holder', $data);
	}

/*---------------------------------------------------------------------------------------------------------
| Function to save new invoice
|----------------------------------------------------------------------------------------------------------*/
	function ajax_save_cash()
	{		
		$cash_number = $this->input->post('cash_number');
		$cash_id = $this->input->post('cash_id');
		$save_type = $this->input->post('save_type');
		
			$valid = $this->cash_voucher_model->validate_cash_num($cash_number, $cash_id);
			
			if($valid){

				if($save_type == 'new'){
						$cash_details = array('user_id' 				=> $this->session->userdata('user_id'),
												 'staff_id' 			=> $this->input->post('cash_staff'),
												 'cash_amount' 			=> $this->input->post('cash_amount'),
												 'cash_number' 		=> $cash_number,
												 'cash_terms' 		=> $this->input->post('cash_terms'),
												 'cash_date_created' => date('Y-m-d', strtotime($this->input->post('cash_date'))),
												);
						$cash_id = $this->common_model->saverecord('ci_cash_vouchers', $cash_details);
				}
				else
				{
						$cash_details = array('staff_id' 			=> $this->input->post('cash_staff'),
												 'cash_terms' 		=> $this->input->post('cash_terms'),
												 'cash_amount' 			=> $this->input->post('cash_amount'),
												 'cash_number' 		=> $cash_number,
												 'cash_status' 		=> $this->input->post('cash_status'),
												 'cash_date_created' => date('Y-m-d', strtotime($this->input->post('cash_date'))),
											);
						$this->common_model->update_records('ci_cash_vouchers', 'cash_id', $cash_id, $cash_details);
				}
				
				$response = array(
	                'success'           => 1,
	            );
			}
			else{
				$response = array(
	                'success'           => 0,
	                'error'  			=> 'The cash number already exists for another cash',
            	);
			}

		

		echo json_encode($response);	
	}
/*---------------------------------------------------------------------------------------------------------
| Function to generate cash numbers
|----------------------------------------------------------------------------------------------------------*/
	function generate_cash_number()
	{
		$last_cash_id = $this->common_model->get_last_id('ci_cash_vouchers', 'cash_id') + 1;
		return $last_cash_id;
	}
/*---------------------------------------------------------------------------------------------------------
| Function to filter cash_vouchers
|----------------------------------------------------------------------------------------------------------*/
	function ajax_filter_cashs()
	{
		$data = array();
		$cash_status 	= $this->input->post('status');
		$data['cashs']	= $this->cash_voucher_model->get_cashs($cash_status);
		$data['status']		= ($cash_status != 'all' ) ? $cash_status : '';	
		$cash_results 	= $this->load->view('cash_vouchers/filtered_cashs', $data, true);
		echo $cash_results;
	}
/*---------------------------------------------------------------------------------------------------------
| Function to edit cash
|----------------------------------------------------------------------------------------------------------*/
	function edit($cash_id = 0)
	{
		$data = array();
		$data['title'] 			= $this->title;
		$data['activemenu'] 	= $this->activemenu;
		$data['cash_details']= $this->cash_voucher_model->get_cash_data($cash_id);
		$data['staffs'] 		= $this->common_model->get_select_option('ci_staffs', 'staff_id', 'staff_name', $data['cash_details']->staff_id);
		$data['pagecontent'] 	= 'cash_vouchers/editcash';
		$this->load->view('common/holder', $data);
	}
/*---------------------------------------------------------------------------------------------------------
| Function to edit cash
|----------------------------------------------------------------------------------------------------------*/
	function delete_item($cash_id=0, $item_id=0)
	{
		$this->common_model->deleterecord('ci_tax_cash_items', 'item_id', $item_id);
		$this->session->set_flashdata('success', 'The item has been deleted successfully !!');
		redirect('cash_vouchers/edit/'.$cash_id);
	}
/*---------------------------------------------------------------------------------------------------------
| Function to display products to be added in cash 
|----------------------------------------------------------------------------------------------------------*/	
	function items_from_products()
	{
		$data = array();
		$data['products'] = $this->common_model->db_select('ci_products');
		$this->load->view('cash_vouchers/products_modal', $data);
	}
/*---------------------------------------------------------------------------------------------------------
| Function to delete an cash 
|----------------------------------------------------------------------------------------------------------*/	
	function delete_cash($cash_id = 0)
	{
		$this->cash_voucher_model->delete_cash($cash_id);
		$this->session->set_flashdata('success', 'The cash has been deleted successfully !!');
		redirect('cash_vouchers');
	}
/*---------------------------------------------------------------------------------------------------------
| Function to enter payment for an cash 
|----------------------------------------------------------------------------------------------------------*/	
	function enter_payment($cash_id = 0)
	{
		$data = array();
		$data['cash'] 			= $this->cash_voucher_model->get_cash_details($cash_id);
		$data['payment_methods'] 	= $this->common_model->get_select_option('ci_payment_methods', 'payment_method_id', 'payment_method_name');
		$this->load->view('cash_vouchers/enter_payment_modal', $data);
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
			$cash_id = $this->input->post('cash_id');
			$payment_details = array('cash_id'		=> $this->input->post('cash_id'),
								  'payment_amount'		=> $this->input->post('payment_amount'),
								  'payment_method_id'	=> $this->input->post('payment_method_id'),
								  'payment_date'		=> date('Y-m-d', strtotime($this->input->post('payment_date'))),
								  'payment_note'		=> $this->input->post('payment_note'),
								 );
			$this->cash_voucher_model->addpayment($cash_id, $payment_details);
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
| Function to preview an cash
|----------------------------------------------------------------------------------------------------------*/	
	function previewcash($cash_id = 0)
	{
		$data 						= array();
		$data['title'] 				= $this->title;
		$data['cash_details']	= $this->cash_voucher_model->previewcash($cash_id);
		$this->load->view('cash_vouchers/previewcash', $data);
	}
/*---------------------------------------------------------------------------------------------------------
| Function to send cash to client
|----------------------------------------------------------------------------------------------------------*/	
	function emailclient($cash_id = 0)
	{
		$data 						= array();
		$data['title'] 				= $this->title;
		$data['cash_details']	= $this->cash_voucher_model->get_cash_details($cash_id);
		$data['email_templates'] 	= $this->common_model->get_select_option('ci_email_templates', 'template_id', 'template_title');
		$this->load->view('cash_vouchers/emailclient', $data);
	}

	
	function viewpdf($cash_id, $company)
	{
		$data 		  = array();
		$data['title'] 	 = $this->title;
		
		$cash_details = $this->cash_voucher_model->previewcash($cash_id);
		$this->load->helper('pdf');
		$pdf_cash = generate_pdf_cash_voucher($cash_details, true, $company);
	}

}
