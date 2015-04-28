<?php
 class Cash_voucher_model extends CI_Model 
{

	function get_cashs($status = 'all')
	{
		$this->db->select('*');
		$this->db->from('ci_cash_vouchers');
		$this->db->join('ci_staffs', 'ci_staffs.staff_id = ci_cash_vouchers.staff_id');
		if($status != 'all')
		{
			$this->db->where('ci_cash_vouchers.cash_status', $status);
		}		
		$this->db->order_by('cash_id', 'DESC');
		$invoices = $this->db->get()->result_array();
		
		return $invoices;
	}
	function cash_stats()
	{
		$stats = array();
		//Get unpaid amount
		$stats['unpaid_amount'] = $this->get_total_unpaid_amount();
		$stats['overdue_amount'] = $this->get_total_overdue_amount();
		//Get all cashs
		$this->db->select('*');
		$this->db->from('ci_cash_vouchers');
		$stats['all_cashs'] = $this->db->count_all_results();
		//Get all Paid cashs
		$this->db->select('*');
		$this->db->from('ci_cash_vouchers');
		$this->db->where('cash_status', 'paid');
		$stats['paid_cashs'] = $this->db->count_all_results();
		//Get all unpaid cashs
		$this->db->select('*');
		$this->db->from('ci_cash_vouchers');
		$this->db->where('cash_status', 'unpaid');
		$stats['unpaid_cashs'] = $this->db->count_all_results();
		//Get all cancelled cashs
		$this->db->select('*');
		$this->db->from('ci_cash_vouchers');
		$this->db->where('cash_status', 'cancelled');
		$stats['cancelled_cashs'] = $this->db->count_all_results();
		return $stats;
	}
	function recent_cashs()
	{
		$this->db->select('*');
		$this->db->from('ci_cash_vouchers');
		$this->db->join('ci_staffs', 'ci_staffs.staff_id = ci_cash_vouchers.staff_id');
		$this->db->limit(5);
		$this->db->order_by('ci_cash_vouchers.cash_id', 'DESC');
		$cashs = $this->db->get()->result_array();
		foreach($cashs as $cash_count=>$cash)
		{
			$cash_totals = $this->get_cash_total_amount($cash['cash_id']);
			$cashs[$cash_count]['cash_amount'] = $cash_totals['item_total'] + $cash_totals['tax_total']-$cash['cash_discount'];
			$cashs[$cash_count]['total_paid'] = $this->get_cash_paid_amount($cash['cash_id']);
		}
		return $cashs;
	}

	function validate_cash_num($cash_number, $cash_id = 0){

			if($cash_id != 0){
				$this->db->where('cash_number', $cash_number);
				$this->db->from('ci_cash_vouchers');
				$records = $this->db->get();
				if($records->num_rows() == 1){
					$row = $records->row();
					if($row->cash_id == $cash_id)
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
				$this->db->where('cash_number', $cash_number);
				$this->db->from('ci_cash_vouchers');
				$records = $this->db->get();
				if($records->num_rows() == 0){
					return true;
				}
				else{
					return false;
				}
			}
	}
	
	function get_cash_details($cash_id = 0)
	{
		$this->db->select('*');
		$this->db->from('ci_cash_vouchers');
		$this->db->join('ci_staffs', 'ci_staffs.staff_id = ci_cash_vouchers.staff_id');
		$this->db->where('ci_cash_vouchers.cash_id', $cash_id);
		return $this->db->get()->row();
	}
	function get_cash_data($cash_id = 0)
	{
		$this->db->select('*');
		$this->db->from('ci_cash_vouchers');
		$this->db->join('ci_staffs', 'ci_staffs.staff_id = ci_cash_vouchers.staff_id');
		$this->db->where('ci_cash_vouchers.cash_id', $cash_id);
		$cash_details = $this->db->get()->row();
		
		return $cash_details;
	}

	function delete_cash($cash_id = 0)
	{		
		$this->db->where('cash_id', $cash_id);
		$this->db->delete('ci_cash_vouchers');
	}
	function previewcash($cash_id = 0)
	{
		$invoice_data = array();
		$this->db->select('*');
		$this->db->where('ci_cash_vouchers.cash_id', $cash_id);
		$this->db->from('ci_cash_vouchers');
		$this->db->join('ci_staffs', 'ci_staffs.staff_id = ci_cash_vouchers.staff_id');
		$invoice_data['cash_details'] = $this->db->get()->row();				
		//return details
		return $invoice_data;
	}




		
}
 