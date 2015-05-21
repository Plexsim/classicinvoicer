<?php
 class Receipt_model extends CI_Model 
{

	function get_receipts($status = 'all')
	{
				
		$this->db->select('*');
		$this->db->from('ci_receipts');
		$this->db->join('ci_clients', 'ci_clients.client_id = ci_receipts.client_id');
		if($status != 'all')
		{
			$this->db->where('ci_receipts.receipt_status', $status);
		}		
		$this->db->order_by('receipt_id', 'DESC');
		$invoices = $this->db->get()->result_array();
		
		return $invoices;
	}
	function receipt_stats()
	{
		$stats = array();
		//Get unpaid amount
		$stats['unpaid_amount'] = $this->get_total_unpaid_amount();
		$stats['overdue_amount'] = $this->get_total_overdue_amount();
		//Get all receipts
		$this->db->select('*');
		$this->db->from('ci_receipts');
		$stats['all_receipts'] = $this->db->count_all_results();
		//Get all Paid receipts
		$this->db->select('*');
		$this->db->from('ci_receipts');
		$this->db->where('receipt_status', 'paid');
		$stats['paid_receipts'] = $this->db->count_all_results();
		//Get all unpaid receipts
		$this->db->select('*');
		$this->db->from('ci_receipts');
		$this->db->where('receipt_status', 'unpaid');
		$stats['unpaid_receipts'] = $this->db->count_all_results();
		//Get all cancelled receipts
		$this->db->select('*');
		$this->db->from('ci_receipts');
		$this->db->where('receipt_status', 'cancelled');
		$stats['cancelled_receipts'] = $this->db->count_all_results();
		return $stats;
	}
	function recent_receipts()
	{
		$this->db->select('*');
		$this->db->from('ci_receipts');
		$this->db->join('ci_clients', 'ci_clients.client_id = ci_receipts.client_id');
		$this->db->limit(5);
		$this->db->order_by('ci_receipts.receipt_id', 'DESC');
		$receipts = $this->db->get()->result_array();
		foreach($receipts as $receipt_count=>$receipt)
		{
			$receipt_totals = $this->get_receipt_total_amount($receipt['receipt_id']);
			$receipts[$receipt_count]['receipt_amount'] = $receipt_totals['item_total'] + $receipt_totals['tax_total']-$receipt['receipt_discount'];
			$receipts[$receipt_count]['total_paid'] = $this->get_receipt_paid_amount($receipt['receipt_id']);
		}
		return $receipts;
	}

	function validate_receipt_num($receipt_number, $receipt_id = 0){

			if($receipt_id != 0){
				$this->db->where('receipt_number', $receipt_number);
				$this->db->from('ci_receipts');
				$records = $this->db->get();
				if($records->num_rows() == 1){
					$row = $records->row();
					if($row->receipt_id == $receipt_id)
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
				$this->db->where('receipt_number', $receipt_number);
				$this->db->from('ci_receipts');
				$records = $this->db->get();
				if($records->num_rows() == 0){
					return true;
				}
				else{
					return false;
				}
			}
	}
	
	function get_receipt_details($receipt_id = 0)
	{
		$this->db->select('*');
		$this->db->from('ci_receipts');
		$this->db->join('ci_clients', 'ci_clients.client_id = ci_receipts.client_id');
		$this->db->where('ci_receipts.receipt_id', $receipt_id);
		return $this->db->get()->row();
	}
	function get_receipt_data($receipt_id = 0)
	{
		$this->db->select('*');
		$this->db->from('ci_receipts');
		$this->db->join('ci_clients', 'ci_clients.client_id = ci_receipts.client_id');
		$this->db->where('ci_receipts.receipt_id', $receipt_id);
		$receipt_details = $this->db->get()->row();
		
		return $receipt_details;
	}

	function delete_receipt($receipt_id = 0)
	{		
		$this->db->where('receipt_id', $receipt_id);
		$this->db->delete('ci_receipts');
	}
	function previewreceipt($receipt_id = 0)
	{
		$invoice_data = array();
		$this->db->select('*');
		$this->db->where('ci_receipts.receipt_id', $receipt_id);
		$this->db->from('ci_receipts');
		$this->db->join('ci_clients', 'ci_clients.client_id = ci_receipts.client_id');
		$invoice_data['receipt_details'] = $this->db->get()->row();				
		//return details
		return $invoice_data;
	}




		
}
 