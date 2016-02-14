<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Debt extends MY_Controller {

	protected $title 		= 'Debt';
	protected $activemenu 	= 'debt';
	
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('debt_model');
	}
/*---------------------------------------------------------------------------------------------------------
| Function to list debt
|----------------------------------------------------------------------------------------------------------*/
	public function index($status = 'all')
	{
				
		$data = array();
		
		$from_date = $this->input->get('from_date');
		$to_date = $this->input->get('to_date');
		$client_id = $this->input->get('client_id');
		$status = $this->input->get('status');
		
		$data['title'] 			= $this->title;
		$data['activemenu'] 	= $this->activemenu;
		$data['debt']			= $this->debt_model->get_debt($from_date, $to_date, $client_id, $status);
		$data['clients'] 		= $this->common_model->get_select_option('ci_clients', 'client_id', 'client_name', (isset($client_id) && !empty($client_id)) ? $client_id : '' );
		
		$data['status']			= $status;
		$data['from_date'] 		= $from_date;
		$data['to_date'] 		= $to_date;
		$data['client_id'] 		= $client_id;
		
		
		$data['pagecontent'] 	= 'debt/debts';
		$this->load->view('common/holder', $data);
	}
	
	/*---------------------------------------------------------------------------------------------------------
	 | Function to create new invoice
	 |----------------------------------------------------------------------------------------------------------*/
	public function newdebt()
	{
		$data = array();
		$data['title'] 			= $this->title;
		$data['activemenu'] 	= $this->activemenu;
		$data['clients'] 		= $this->common_model->get_select_option('ci_clients', 'client_id', 'client_name');
		$data['pagecontent'] 	= 'debt/newdebt';
		$this->load->view('common/holder', $data);
	}
	/*---------------------------------------------------------------------------------------------------------
	 | Function to filter debt
	 |----------------------------------------------------------------------------------------------------------*/
	function ajax_filter_debt()
	{
		$data = array();
		$from_date 		= $this->input->post('from_date');
		$to_date 		= $this->input->post('to_date');
		$debt_status = $this->input->post('status');
		$client_id 		= $this->input->post('client_id');
	
		$data['debt']	= $this->debt_model->get_debt($from_date, $to_date, $client_id, $debt_status);
		$data['status']	= ($debt_status != 'all' ) ? $debt_status : '';
		$debt_results 	= $this->load->view('debt/filtered_debt', $data, true);
		echo $debt_results;
	}

	/*---------------------------------------------------------------------------------------------------------
	 | Function to edit debt
	 |----------------------------------------------------------------------------------------------------------*/
	function edit($debt_id = 0)
	{
		$data = array();
		$data['title'] 			= $this->title;
		$data['activemenu'] 	= $this->activemenu;
		$data['debt_details']= $this->debt_model->get_debt_data($debt_id);
		$data['clients'] 		= $this->common_model->get_select_option('ci_clients', 'client_id', 'client_name', $data['debt_details']->client_id);
		$data['pagecontent'] 	= 'debt/editdebt';
		$this->load->view('common/holder', $data);
	}
	/*---------------------------------------------------------------------------------------------------------
	 | Function to delete an debt
	 |----------------------------------------------------------------------------------------------------------*/
	function delete_debt($debt_id = 0)
	{
		$this->debt_model->delete_debt($debt_id);
		$this->session->set_flashdata('success', 'The debt has been deleted successfully !!');
		redirect('debt');
	}

	/*---------------------------------------------------------------------------------------------------------
	 | Function to save new debt
	 |----------------------------------------------------------------------------------------------------------*/
	
	/*---------------------------------------------------------------------------------------------------------
	 | Function to save new invoice
	 |----------------------------------------------------------------------------------------------------------*/
	function ajax_save_debt()
	{
		$debt_number = $this->input->post('debt_number');
		$debt_id = $this->input->post('debt_id');
		$save_type = $this->input->post('save_type');
		$valid = true;
	
		if(!is_numeric($this->input->post('debt_amount'))){
			$response = array(
					'success'           => 0,
					'error'  			=> 'Please enter number in amount'
			);
			$valid = false;
		}
		
		if(!$this->input->post('debt_date')){
			$response = array(
					'success'           => 0,
					'error'  			=> 'Please enter Date'
			);
			$valid = false;
		}
		
			
		if($valid){
			if($save_type == 'new'){
				$debt_details = array('user_id' 				=> $this->session->userdata('user_id'),
						'client_id' 			=> $this->input->post('debt_client'),
						'debt_amount_unpaid' 	=> $this->input->post('debt_status') == 'unpaid' ? $this->input->post('debt_amount') : 0.00,
						'debt_amount_paid' 	=> $this->input->post('debt_status') == 'paid' ? $this->input->post('debt_amount') : 0.00,
						'debt_description' 	=> $this->input->post('debt_description'),
						'debt_date_created' 	=> date('Y-m-d', strtotime($this->input->post('debt_date'))),
						'debt_date_updated' 	=> date('Y-m-d'),
						'debt_status'			=> $this->input->post('debt_status')
				);
				$debt_id = $this->common_model->saverecord('ci_debt', $debt_details);
			}
			else
			{
				$debt_details = array('client_id' 			=> $this->input->post('debt_client'),
						'debt_amount_unpaid' 	=> $this->input->post('debt_status') == 'unpaid' ? $this->input->post('debt_amount') : 0.00,
						'debt_amount_paid' 	=> $this->input->post('debt_status') == 'paid' ? $this->input->post('debt_amount') : 0.00,
						'debt_description' 		=> $this->input->post('debt_description'),
						'debt_date_created' => date('Y-m-d', strtotime($this->input->post('debt_date'))),
						'debt_date_updated' 	=> date('Y-m-d'),
						'debt_status' 		=> $this->input->post('debt_status')
				);
				$this->common_model->update_records('ci_debt', 'debt_id', $debt_id, $debt_details);
			}
	
			$response = array(
					'success'           => 1,
			);
		}
	
		echo json_encode($response);
	}
	
	



}
