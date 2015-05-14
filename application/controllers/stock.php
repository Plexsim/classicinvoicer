<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock extends MY_Controller {

	protected $title 		= 'Stock';
	protected $activemenu 	= 'stock';
	
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('stock_model');
	}
/*---------------------------------------------------------------------------------------------------------
| Function to list tax stocks
|----------------------------------------------------------------------------------------------------------*/
	public function index($status = 'all')
	{
		$data = array();
		$data['title'] 			= $this->title;
		$data['activemenu'] 	= $this->activemenu;
		$data['stocks']		= $this->stock_model->get_stocks($status);
		$data['status']			= $status;
		$data['pagecontent'] 	= 'stocks/lists';
		$this->load->view('common/holder', $data);
	}
/*---------------------------------------------------------------------------------------------------------
| Function to create new stock
|----------------------------------------------------------------------------------------------------------*/
	public function newstock()
	{
		$data = array();
		$data['title'] 			= $this->title;
		$data['activemenu'] 	= $this->activemenu;
		$data['stock_number']	= $this->generate_stock_number();
		$data['pagecontent'] 	= 'stocks/newstock';
		$this->load->view('common/holder', $data);
	}


/*---------------------------------------------------------------------------------------------------------
| Function to generate stock numbers
|----------------------------------------------------------------------------------------------------------*/
	function generate_stock_number()
	{
		$last_stock_id = $this->common_model->get_last_id('ci_stocks', 'stock_id') + 1;
		return $last_stock_id;
	}
/*---------------------------------------------------------------------------------------------------------
| Function to filter stocks
|----------------------------------------------------------------------------------------------------------*/
	function ajax_filter_stocks()
	{
		$data = array();
		$stock_status 	= $this->input->post('status');
		$data['stocks']	= $this->stock_model->get_stocks($stock_status);
		$data['status']		= ($stock_status != 'all' ) ? $stock_status : '';	
		$stock_results 	= $this->load->view('stocks/filtered_stocks', $data, true);
		echo $stock_results;
	}
/*---------------------------------------------------------------------------------------------------------
| Function to edit stock
|----------------------------------------------------------------------------------------------------------*/
	function edit($stock_id = 0)
	{
		$data = array();
		$data['title'] 			= $this->title;
		$data['activemenu'] 	= $this->activemenu;
		$data['stock_details']= $this->stock_model->get_stock_data($stock_id);
		$data['pagecontent'] 	= 'stocks/editstock';
		$this->load->view('common/holder', $data);
	}
/*---------------------------------------------------------------------------------------------------------
| Function to delete an stock 
|----------------------------------------------------------------------------------------------------------*/	
	function delete_stock($stock_id = 0)
	{
		$this->stock_model->delete_stock($stock_id);
		$this->session->set_flashdata('success', 'The stock has been deleted successfully !!');
		redirect('stock');
	}
/*---------------------------------------------------------------------------------------------------------
| Function to send stock to client
|----------------------------------------------------------------------------------------------------------*/	
	
	function viewpdf($stock_id)
	{
		$data 		  = array();
		$data['title'] 	 = $this->title;
		
		$stock_details = $this->stock_model->previewstock($stock_id);
		$this->load->helper('pdf');
		$pdf_stock = generate_pdf_stock($stock_details, true, NULL);
	}
	
	/*---------------------------------------------------------------------------------------------------------
	 | Function to save new stock
	|----------------------------------------------------------------------------------------------------------*/
	function ajax_save_stock()
	{
		$stock_number = $this->input->post('stock_number');
		$stock_id = $this->input->post('stock_id');
		$save_type = $this->input->post('save_type');

		$valid = $this->stock_model->validate_stock_num($stock_number, $stock_id);

		if($valid){

			if($save_type == 'new'){
				$stock_details = array(
						'user_id' 				=> $this->session->userdata('user_id'),
						'stock_number' 		=> $stock_number,
						'stock_amount' 		=> $this->input->post('stock_amount'),
						'stock_terms' 		=> $this->input->post('stock_terms'),
						'stock_status' 		=> $this->input->post('stock_status'),
						'stock_date_created' => date('Y-m-d', strtotime($this->input->post('stock_date'))),
				);
				$stock_id = $this->common_model->saverecord('ci_stocks', $stock_details);
			}
			else
			{
				$stock_details = array(
						'stock_terms' 		=> $this->input->post('stock_terms'),
						'stock_number' 		=> $stock_number,
						'stock_amount' 		=> $this->input->post('stock_amount'),
						'stock_status' 		=> $this->input->post('stock_status'),							
						'stock_date_created' => date('Y-m-d', strtotime($this->input->post('stock_date'))),
				);
				$this->common_model->update_records('ci_stocks', 'stock_id', $stock_id, $stock_details);
			}


			$response = array(
					'success'           => 1,
			);
		}
		else{
			$response = array(
					'success'           => 0,
					'error'  			=> 'The stock number already exists for another stock',
			);
		}
	
		
		echo json_encode($response);
	}

}
