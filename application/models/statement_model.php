<?php
 class Statement_model extends CI_Model 
{
	function client_statement($client_id = 'all', $from_date = '', $to_date = '')
	{		
		$this->db->select('*');
		$this->db->from('ci_tax_invoices');
		$this->db->join('ci_tax_invoice_items', 'ci_tax_invoice_items.invoice_id = ci_tax_invoices.invoice_id', 'LEFT');
		//$this->db->where('client_id', $client_id);
		$this->db->order_by('ci_tax_invoices.invoice_date_created', 'ASC');		
		if($client_id != 'all')
		{
			$this->db->where('ci_tax_invoices.client_id', $client_id);
		}
		if($from_date != '' && $to_date != '')
		{
			$this->db->where('invoice_date_created >=', date('Y-m-d', strtotime($from_date)));
			$this->db->where('invoice_date_created <=', date('Y-m-d', strtotime($to_date)));
		}
		
		$statement = $this->db->get();
		return $statement->result_array();
	}	
}
