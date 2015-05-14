<?php
class Stock_model extends CI_Model 
{

	function get_stocks($status = 'all')
	{
		$this->db->select('*');
		$this->db->from('ci_stocks');
		if($status != 'all')
		{
			$this->db->where('ci_stocks.stock_status', $status);
		}		
		$this->db->order_by('stock_id', 'DESC');
		$stocks = $this->db->get()->result_array();

		return $stocks;
	}
	function stock_stats()
	{
		$stats = array();
		//Get unpaid amount
		//Get all stocks
		$this->db->select('*');
		$this->db->from('ci_stocks');
		$stats['all_stocks'] = $this->db->count_all_results();
		//Get all Paid stocks
		$this->db->select('*');
		$this->db->from('ci_stocks');
		$this->db->where('stock_status', 'paid');
		$stats['paid_stocks'] = $this->db->count_all_results();
		//Get all unpaid stocks
		$this->db->select('*');
		$this->db->from('ci_stocks');
		$this->db->where('stock_status', 'unpaid');
		$stats['unpaid_stocks'] = $this->db->count_all_results();
		//Get all cancelled stocks
		$this->db->select('*');
		$this->db->from('ci_stocks');
		$this->db->where('stock_status', 'cancelled');
		$stats['cancelled_stocks'] = $this->db->count_all_results();
		return $stats;
	}
	function recent_stocks()
	{
		$this->db->select('*');
		$this->db->from('ci_stocks');
		$this->db->join('ci_clients', 'ci_clients.client_id = ci_stocks.client_id');
		$this->db->limit(5);
		$this->db->order_by('ci_stocks.stock_id', 'DESC');
		$stocks = $this->db->get()->result_array();
		foreach($stocks as $stock_count=>$stock)
		{
			$stock_totals = $this->get_stock_total_amount($stock['stock_id']);
			$stocks[$stock_count]['stock_amount'] = $stock_totals['item_total'] + $stock_totals['tax_total']-$stock['stock_discount'];
			$stocks[$stock_count]['total_paid'] = $this->get_stock_paid_amount($stock['stock_id']);
		}
		return $stocks;
	}

	function validate_stock_num($stock_number, $stock_id = 0){			
		
			if($stock_id != 0){
				$this->db->where('stock_number', $stock_number);
				$this->db->from('ci_stocks');
				$records = $this->db->get();
				if($records->num_rows() == 1){
					$row = $records->row();
					if($row->stock_id == $stock_id)
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
				$this->db->where('stock_number', $stock_number);
				$this->db->from('ci_stocks');
				$records = $this->db->get();
				if($records->num_rows() == 0){
					return true;
				}
				else{
					return false;
				}
			}
	}
	
	function get_stock_details($stock_id = 0)
	{
		$this->db->select('*');
		$this->db->from('ci_stocks');
		$this->db->join('ci_clients', 'ci_clients.client_id = ci_stocks.client_id');
		$this->db->where('ci_stocks.stock_id', $stock_id);
		return $this->db->get()->row();
	}
	function get_stock_data($stock_id = 0)
	{
		$this->db->select('*');
		$this->db->from('ci_stocks');
		$this->db->where('ci_stocks.stock_id', $stock_id);
		$stock_details = $this->db->get()->row();
				
		return $stock_details;
	}


	function delete_stock($stock_id = 0)
	{		
		//delete stocks
		$this->db->where('stock_id', $stock_id);
		$this->db->delete('ci_stocks');
	}



		
}
 