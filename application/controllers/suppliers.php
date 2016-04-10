<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Suppliers extends MY_Controller {

	protected $title 		= 'Suppliers';
	protected $activemenu 	= 'suppliers';
	
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('suppliers_model');
	}
/*---------------------------------------------------------------------------------------------------------
| Function to display suppliers
|----------------------------------------------------------------------------------------------------------*/
	public function index()
	{
		$data = array();
		$data['title'] 			= $this->title;
		$data['activemenu'] 	= $this->activemenu;
		$data['suppliers']		= $this->common_model->db_select('ci_suppliers');
		$data['pagecontent'] 	= 'suppliers/suppliers';
		$this->load->view('common/holder', $data);
	}
/*---------------------------------------------------------------------------------------------------------
| Function to delete suppliers
|----------------------------------------------------------------------------------------------------------*/
	public function delete($supplier_id = 0)
	{
		$data = array();
		$this->suppliers_model->delete_supplier($supplier_id);
		$this->session->set_flashdata('success', 'Supplier has been deleted successfully !!');
		redirect('suppliers');
	}
/*---------------------------------------------------------------------------------------------------------
 | Function to delete suppliers *Customisation*
|----------------------------------------------------------------------------------------------------------*/
public function delete_tax_supplier($supplier_id = 0)
{
	$data = array();
	$this->suppliers_model->delete_tax_supplier($supplier_id);
	$this->session->set_flashdata('success', 'Supplier has been deleted successfully !!');
	redirect('suppliers');
}	
	
/*---------------------------------------------------------------------------------------------------------
| Function to create new supplier
|----------------------------------------------------------------------------------------------------------*/
	function createsupplier()
	{
		$data = array();
		if($this->input->post('createsupplierbtn'))
		{
			$this->form_validation->set_rules('supplier_name', 'name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('supplier_address', 'address', 'trim|required|xss_clean');
			$this->form_validation->set_rules('supplier_gst', 'gst', 'trim|xss_clean');
			$this->form_validation->set_rules('supplier_ssm', 'ssm', 'trim|xss_clean');
			$this->form_validation->set_rules('supplier_postalcode', 'address', 'trim|xss_clean');
			$this->form_validation->set_rules('supplier_email', 'email', 'trim|valid_email|callback_email_exists|xss_clean');
			$this->form_validation->set_rules('supplier_city', 'city', 'trim|required|xss_clean');
			$this->form_validation->set_rules('supplier_country', 'country', 'trim|required|xss_clean');
			$this->form_validation->set_rules('supplier_telephone', 'telephone', 'trim|required|xss_clean');
			$this->form_validation->set_rules('supplier_fax', 'fax', 'trim|xss_clean');
			$this->form_validation->set_error_delimiters('<p class="has-error"><label class="control-label">', '</label></p>');
			if($this->form_validation->run())
			{
				$supplier_details = array('supplier_name'		=> $this->input->post('supplier_name'),
									  'supplier_ssm'			=> $this->input->post('supplier_ssm'),
									  'supplier_address'		=> $this->input->post('supplier_address'),
									  'postal_code'			=> $this->input->post('supplier_postalcode'),
									  'supplier_city'			=> $this->input->post('supplier_city'),
									  'supplier_country'		=> $this->input->post('supplier_country'),
									  'supplier_phone'		=> $this->input->post('supplier_telephone'),
									  'supplier_fax'			=> $this->input->post('supplier_fax'),
									  'supplier_email'		=> $this->input->post('supplier_email'),
									  'supplier_gst'			=> $this->input->post('supplier_gst'),
									  'supplier_date_created'	=> date('Y-m-d', time()),
									 );
				$this->common_model->dbinsert('ci_suppliers', $supplier_details);
				$this->session->set_flashdata('success', 'Supplier has been added successfully !!');
				redirect('suppliers/createsupplier');
			}
		}
		$data['title'] 			= $this->title;
		$data['activemenu'] 	= $this->activemenu;
		$data['pagecontent'] 	= 'suppliers/newsupplier';
		$this->load->view('common/holder', $data);
	}
/*---------------------------------------------------------------------------------------------------------
| Function to edit supplier
|----------------------------------------------------------------------------------------------------------*/
	function editsupplier($supplier_id = 0)
	{
		$data = array();
		if($this->input->post('editsupplierbtn'))
		{
					
			$supplier_id = $this->input->post('supplier_id');
			$this->form_validation->set_rules('supplier_name', 'name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('supplier_ssm', 'ssm', 'trim|xss_clean');
			$this->form_validation->set_rules('supplier_address', 'address', 'trim|required|xss_clean');
			$this->form_validation->set_rules('supplier_postalcode', 'address', 'trim|xss_clean');
			$this->form_validation->set_rules('supplier_email', 'email', 'trim|valid_email|xss_clean');
			$this->form_validation->set_rules('supplier_gst', 'gst', 'trim|xss_clean');
			$this->form_validation->set_rules('supplier_city', 'city', 'trim|required|xss_clean');
			$this->form_validation->set_rules('supplier_country', 'country', 'trim|required|xss_clean');
			$this->form_validation->set_rules('supplier_telephone', 'telephone', 'trim|required|xss_clean');
			$this->form_validation->set_rules('supplier_fax', 'fax', 'trim|xss_clean');
			$this->form_validation->set_error_delimiters('<p class="has-error"><label class="control-label">', '</label></p>');
			if($this->form_validation->run())
			{
				/* if(!$this->email_exists($this->input->post('supplier_email'), $supplier_id))
				{
					$data['email_exists_error'] = 'Email already exists, please choose another email address.';
				}
				else
				{ */
				$supplier_details = array('supplier_name'		=> $this->input->post('supplier_name'),
									  'supplier_ssm'			=> $this->input->post('supplier_ssm'),
									  'supplier_address'		=> $this->input->post('supplier_address'),
									  'postal_code'		=> $this->input->post('supplier_postalcode'),
									  'supplier_city'			=> $this->input->post('supplier_city'),
									  'supplier_country'		=> $this->input->post('supplier_country'),
									  'supplier_phone'		=> $this->input->post('supplier_telephone'),
									  'supplier_fax'			=> $this->input->post('supplier_fax'),
									  'supplier_email'		=> $this->input->post('supplier_email'),
									  'supplier_gst'			=> $this->input->post('supplier_gst'),
									 );
				$this->common_model->update_records('ci_suppliers', 'supplier_id', $supplier_id, $supplier_details);
				$this->session->set_flashdata('success', 'Supplier has been updated successfully !!');
				redirect('suppliers');
				/* } */
			}
		}
		$data['title'] 			= $this->title;
		$data['activemenu'] 	= $this->activemenu;
		$data['supplier'] 		= $this->common_model->select_record('ci_suppliers', 'supplier_id', $supplier_id);
		$data['pagecontent'] 	= 'suppliers/editsupplier';
		$this->load->view('common/holder', $data);
	}
/*---------------------------------------------------------------------------------------------------------
| Function to check if email exists
|----------------------------------------------------------------------------------------------------------*/
	function email_exists($email = '', $supplier_id = '')
	{
		$email_exists = $this->suppliers_model->email_exists($email, $supplier_id);
		
		if($email_exists)
		{
			$this->form_validation->set_message('email_exists', 'Email already exists, please choose another email address.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}