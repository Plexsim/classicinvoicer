<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statement extends MY_Controller {

	protected $title 		= 'Statement';
	protected $activemenu 	= 'statement';
	
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('statement_model');
	}
	public function index()
	{
		$data = array();
		$data['title'] 			= $this->title;
		$data['activemenu'] 	= $this->activemenu;
		$data['pagecontent'] 	= 'statement/reports';
		
		$client 	= $this->input->post('client_id');
		$from_date 	= $this->input->post('from_date');
		$to_date 	= $this->input->post('to_date');
		$selected = ($client != '') ? $client : 0;
		$data['clients'] 	= $this->common_model->get_select_option('ci_clients', 'client_id', 'client_name',$selected);
		$data['statement_details']	= $this->statement_model->client_statement($client, $from_date, $to_date);
		
		
		$this->load->view('common/holder', $data);
	}
/*---------------------------------------------------------------------------------------------------------
| Function to display client statement
|----------------------------------------------------------------------------------------------------------*/	
	function client_statement()
	{
		$data 		= array();
		$client 	= $this->input->post('client_id');
		$from_date 	= $this->input->post('from_date');
		$to_date 	= $this->input->post('to_date');
		
		$selected = ($client != '') ? $client : 0;
		$data['clients'] 	= $this->common_model->get_select_option('ci_clients', 'client_id', 'client_name', $selected);
		$data['statement_details']	= $this->statement_model->client_statement($client, $from_date, $to_date);
		$client_statement 	= $this->load->view('statement/client_statement', $data, true);
		echo $client_statement;
	}

}