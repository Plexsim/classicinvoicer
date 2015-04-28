<?php
 class Staffs_model extends CI_Model 
{
	
/*---------------------------------------------------------------------------------------------------------
| Function to check if email exists
|----------------------------------------------------------------------------------------------------------*/
	function delete_staff($staff_id = 0)
	{		
		//delete invoices
		$this->db->where('staff_id', $staff_id);
		$this->db->delete('ci_cash_vouchers');
		//delete client
		$this->db->where('staff_id', $staff_id);
		$this->db->delete('ci_clients');
	}
}
