<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tax_reports extends MY_Controller {

	protected $title 		= 'Tax Reports';
	protected $activemenu 	= 'tax_reports';
	
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('tax_reports_model');
	}
	public function index()
	{
		$data = array();
		$data['title'] 			= $this->title;
		$data['activemenu'] 	= $this->activemenu;
		$data['pagecontent'] 	= 'tax_reports/reports';
		$this->load->view('common/holder', $data);
	}
/*---------------------------------------------------------------------------------------------------------
| Function to display payment summary
|----------------------------------------------------------------------------------------------------------*/	
	function payment_summary()
	{
		$data 		= array();
		$client 	= $this->input->post('client');
		$from_date 	= $this->input->post('from_date');
		$to_date 	= $this->input->post('to_date');
		
		$selected = ($client != '') ? $client : 0;
		$data['clients'] 	= $this->common_model->get_select_option('ci_clients', 'client_id', 'client_name', $selected);
		$data['payments']	= $this->tax_reports_model->payments_summary($client, $from_date, $to_date);
		$payments_results 	= $this->load->view('tax_reports/payments_summary', $data, true);
		echo $payments_results;
	}
/*---------------------------------------------------------------------------------------------------------
| Function to display client statement
|----------------------------------------------------------------------------------------------------------*/	
	function client_statement()
	{
		$data = array();
		$selected = ($this->input->post('client_id')) ? $this->input->post('client_id') : 0;
		if($this->input->post('client_id'))
		{
		$data['statement_details'] 	= $this->tax_reports_model->client_statement($this->input->post('client_id'));
		$data['stats'] 				= $this->tax_reports_model->client_stats($this->input->post('client_id'));
		}
		$data['clients'] 			= $this->common_model->get_select_option('ci_clients', 'client_id', 'client_name', $selected);
		$client_statement 	= $this->load->view('tax_reports/client_statement', $data, true);
		echo $client_statement;
	}
/*---------------------------------------------------------------------------------------------------------
| Function to display invoices report
|----------------------------------------------------------------------------------------------------------*/	
	function invoices_report()
	{
		$data = array();
		$selected = ($this->input->post('client_id')) ? $this->input->post('client_id') : 0;
		$data['invoices_report'] 	= $this->tax_reports_model->invoices_report($this->input->post('client_id'));
		$data['clients'] 			= $this->common_model->get_select_option('ci_clients', 'client_id', 'client_name', $selected);
		$invoices_report 	= $this->load->view('tax_reports/invoices_report', $data, true);
		echo $invoices_report;
	}
/*---------------------------------------------------------------------------------------------------------
| Function to display invoices report
|----------------------------------------------------------------------------------------------------------*/
	function invoices_full_report()
	{
		$data = array();
		$selected = ($this->input->post('client_id')) ? $this->input->post('client_id') : 0;
		$data['invoices_report'] 	= $this->tax_reports_model->invoices_full_report($this->input->post('client_id'), $this->input->post('from_date'), $this->input->post('to_date'), $this->input->post('status'));		
		
		$data['clients'] 			= $this->common_model->get_select_option('ci_clients', 'client_id', 'client_name', $selected);
		$invoices_report 	= $this->load->view('tax_reports/invoices_report', $data, true);
		echo $invoices_report;
	}	
/*---------------------------------------------------------------------------------------------------------
| Function to display clients contact list
|----------------------------------------------------------------------------------------------------------*/	
	function clients_contact_list()
	{
		$data = array();
		$data['clients'] 			= $this->common_model->db_select('ci_clients');
		$clients_contact_list 		= $this->load->view('tax_reports/clients_contact_list', $data, true);
		echo $clients_contact_list;
	}
/*----------------------------------------------------------------------------------------------------------
| Function to display clients contact list
|----------------------------------------------------------------------------------------------------------*/	
	function view_full_report_pdf()
	{	
		$client_id 	= $this->input->get('client_id');
		$from_date 	= $this->input->get('from_date');
		$to_date 	= $this->input->get('to_date');
		$status		= $this->input->get('status');
	
		$data 		  = array();
		$data['title'] 	 = $this->title;
		$full_report_details = $this->tax_reports_model->invoices_full_report($client_id, $from_date, $to_date, $status);
	
		//return var_dump($full_report_details);
		$this->load->helper('pdf');
		$pdf_invoice = generate_pdf_full_report($full_report_details, true, NULL);
	}
	
	
}