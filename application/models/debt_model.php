<?php
 class Debt_model extends CI_Model 
{

	function get_debt($from_date = '', $to_date = '', $client_id = '', $status = 'all')
	{					
		$this->db->select('*');
		$this->db->from('ci_debt');
		$this->db->join('ci_clients', 'ci_clients.client_id = ci_debt.client_id');
		if($from_date != '' && $to_date != '')
		{
			$this->db->where('ci_debt.debt_date_created >=', date('Y-m-d', strtotime($from_date)));
			$this->db->where('ci_debt.debt_date_created <=', date('Y-m-d', strtotime($to_date)));
		}
		
		if($status != 'all')
		{
			$this->db->where('ci_debt.debt_status', $status);
		}
		
		if($client_id != '' && $client_id != 'all'){
			$this->db->where('ci_debt.client_id', $client_id);
		}
		$this->db->order_by('debt_id', 'DESC');
		$debts = $this->db->get()->result_array();
		return $debts;
		
	}
	function debt_stats()
	{
		$stats = array();
		//Get unpaid amount
		$stats['unpaid_amount'] = $this->get_total_unpaid_amount();
		$stats['overdue_amount'] = $this->get_total_overdue_amount();
		//Get all debt
		$this->db->select('*');
		$this->db->from('ci_debt');
		$stats['all_debt'] = $this->db->count_all_results();
		//Get all Paid debt
		$this->db->select('*');
		$this->db->from('ci_debt');
		$this->db->where('debt_status', 'paid');
		$stats['paid_debt'] = $this->db->count_all_results();
		//Get all unpaid debt
		$this->db->select('*');
		$this->db->from('ci_debt');
		$this->db->where('debt_status', 'unpaid');
		$stats['unpaid_debt'] = $this->db->count_all_results();
		//Get all cancelled debt
		$this->db->select('*');
		$this->db->from('ci_debt');
		$this->db->where('debt_status', 'cancelled');
		$stats['cancelled_debt'] = $this->db->count_all_results();
		return $stats;
	}
	function recent_debt()
	{
		$this->db->select('*');
		$this->db->from('ci_debt');
		$this->db->join('ci_clients', 'ci_clients.client_id = ci_debt.client_id');
		$this->db->limit(5);
		$this->db->order_by('ci_debt.debt_id', 'DESC');
		$debt = $this->db->get()->result_array();
		foreach($debt as $debt_count=>$debt)
		{
			//$debt_totals = $this->get_debt_total_amount($debt['debt_id']);
			//$debt[$debt_count]['debt_amount'] = $debt_totals['item_total'] + $debt_totals['tax_total']-$debt['debt_discount'];
			//$debt[$debt_count]['total_paid'] = $this->get_debt_paid_amount($debt['debt_id']);
		}
		return $debt;
	}

	function validate_debt_num($debt_number, $debt_id = 0){

			if($debt_id != 0){
				$this->db->where('debt_number', $debt_number);
				$this->db->from('ci_debt');
				$records = $this->db->get();
				if($records->num_rows() == 1){
					$row = $records->row();
					if($row->debt_id == $debt_id)
					{
						return true;
					}
					else{
						return false;
					}
				}
				elseif($records->num_rows() == 0){
					return true;
				}
			}
			else{
				$this->db->where('debt_number', $debt_number);
				$this->db->from('ci_debt');
				$records = $this->db->get();
				if($records->num_rows() == 0){
					return true;
				}
				else{
					return false;
				}
			}
	}
	
	function get_debt_details($debt_id = 0)
	{
		$this->db->select('*');
		$this->db->from('ci_debt');
		$this->db->join('ci_clients', 'ci_clients.client_id = ci_debt.client_id');
		$this->db->where('ci_debt.debt_id', $debt_id);
		return $this->db->get()->row();
	}
	
	function get_debt_data($debt_id = 0)
	{
		$this->db->select('*');
		$this->db->from('ci_debt');
		$this->db->join('ci_clients', 'ci_clients.client_id = ci_debt.client_id');
		$this->db->where('ci_debt.debt_id', $debt_id);
		$debt_details = $this->db->get()->row();
		
		return $debt_details;
	}

	function delete_debt($debt_id = 0)
	{		
		$this->db->where('debt_id', $debt_id);
		$this->db->delete('ci_debt');
	}
	function previewdebt($debt_id = 0)
	{
		$invoice_data = array();
		$this->db->select('*');
		$this->db->where('ci_debt.debt_id', $debt_id);
		$this->db->from('ci_debt');
		$this->db->join('ci_clients', 'ci_clients.client_id = ci_debt.client_id');
		$invoice_data['debt_details'] = $this->db->get()->row();				
		//return details
		return $invoice_data;
	}




		
}
 