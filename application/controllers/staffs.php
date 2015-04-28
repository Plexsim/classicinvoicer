<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staffs extends MY_Controller {

	protected $title 		= 'Staffs';
	protected $activemenu 	= 'staffs';
	
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('staffs_model');
	}
/*---------------------------------------------------------------------------------------------------------
| Function to display staffs
|----------------------------------------------------------------------------------------------------------*/
	public function index()
	{
		$data = array();
		$data['title'] 			= $this->title;
		$data['activemenu'] 	= $this->activemenu;
		$data['staffs']		= $this->common_model->db_select('ci_staffs');
		$data['pagecontent'] 	= 'staffs/staffs';
		$this->load->view('common/holder', $data);
	}
/*---------------------------------------------------------------------------------------------------------
| Function to delete staffs
|----------------------------------------------------------------------------------------------------------*/
	public function delete($staff_id = 0)
	{
		$data = array();
		$this->staffs_model->delete_staff($staff_id);
		$this->session->set_flashdata('success', 'Staff has been deleted successfully !!');
		redirect('staffs');
	}
/*---------------------------------------------------------------------------------------------------------
| Function to create new staff
|----------------------------------------------------------------------------------------------------------*/
	function createstaff()
	{
		$data = array();
		if($this->input->post('createstaffbtn'))
		{
			$this->form_validation->set_rules('staff_name', 'name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('staff_telephone', 'telephone', 'trim|xss_clean');
			$this->form_validation->set_error_delimiters('<p class="has-error"><label class="control-label">', '</label></p>');
			if($this->form_validation->run())
			{
				$staff_details = array('staff_name'		=> $this->input->post('staff_name'),
									  'staff_phone'		=> $this->input->post('staff_telephone'),
									  'staff_date_created'	=> date('Y-m-d', time()),
									 );
				$this->common_model->dbinsert('ci_staffs', $staff_details);
				$this->session->set_flashdata('success', 'Staff has been added successfully !!');
				redirect('staffs/createstaff');
			}
		}
		$data['title'] 			= $this->title;
		$data['activemenu'] 	= $this->activemenu;
		$data['pagecontent'] 	= 'staffs/newstaff';
		$this->load->view('common/holder', $data);
	}
/*---------------------------------------------------------------------------------------------------------
| Function to edit staff
|----------------------------------------------------------------------------------------------------------*/
	function editstaff($staff_id = 0)
	{
		$data = array();
		if($this->input->post('editstaffbtn'))
		{
					
			$staff_id = $this->input->post('staff_id');
			$this->form_validation->set_rules('staff_name', 'name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('staff_telephone', 'telephone', 'trim|xss_clean');
			$this->form_validation->set_error_delimiters('<p class="has-error"><label class="control-label">', '</label></p>');
			if($this->form_validation->run())
			{
				/* if(!$this->email_exists($this->input->post('staff_email'), $staff_id))
				{
					$data['email_exists_error'] = 'Email already exists, please choose another email address.';
				}
				else
				{ */
				$staff_details = array('staff_name'		=> $this->input->post('staff_name'),
									  'staff_phone'		=> $this->input->post('staff_telephone'),									  
									 );
				$this->common_model->update_records('ci_staffs', 'staff_id', $staff_id, $staff_details);
				$this->session->set_flashdata('success', 'Staff has been updated successfully !!');
				redirect('staffs');
				/* } */
			}
		}
		$data['title'] 			= $this->title;
		$data['activemenu'] 	= $this->activemenu;
		$data['staff'] 		= $this->common_model->select_record('ci_staffs', 'staff_id', $staff_id);
		$data['pagecontent'] 	= 'staffs/editstaff';
		$this->load->view('common/holder', $data);
	}

}