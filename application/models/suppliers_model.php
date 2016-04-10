<?php
 class Suppliers_model extends CI_Model 
{
	
/*---------------------------------------------------------------------------------------------------------
| Function to check if email exists
|----------------------------------------------------------------------------------------------------------*/
	function email_exists($email = '', $supplier_id = '')
	{
		$this->db->select('supplier_email');
		if($supplier_id != '')
		{
		$this->db->where('supplier_id != ', $supplier_id);
		}
		$this->db->where('supplier_email', $email);
		$this->db->from('ci_suppliers');
		$query = $this->db->get();
		if($query->num_rows() > 0) 
		return true;
		else
		return false;
	}
	function delete_supplier($supplier_id = 0)
	{
		//delete invoices
		$this->db->select('invoice_id');
		$this->db->where('supplier_id', $supplier_id);
		$invoices = $this->db->get('ci_tax_invoices');
		foreach($invoices->result_array() as $count=>$invoice){
		//delete items
		$this->db->where('invoice_id', $invoice['invoice_id']);
		$this->db->delete('ci_invoice_items');
		//delete payments
		$this->db->where('invoice_id', $invoice['invoice_id']);
		$this->db->delete('ci_payments');
		}
		//delete invoices
		$this->db->where('supplier_id', $supplier_id);
		$this->db->delete('ci_tax_invoices');
		//delete supplier
		$this->db->where('supplier_id', $supplier_id);
		$this->db->delete('ci_suppliers');
	}
	
	function delete_tax_supplier($supplier_id = 0)
	{
		//delete invoices
		$this->db->select('invoice_id');
		$this->db->where('supplier_id', $supplier_id);
		$invoices = $this->db->get('ci_tax_invoices');
		foreach($invoices->result_array() as $count=>$invoice){
			//delete items
			$this->db->where('invoice_id', $invoice['invoice_id']);
			$this->db->delete('ci_invoice_items');
			//delete payments
			$this->db->where('invoice_id', $invoice['invoice_id']);
			$this->db->delete('ci_payments');
		}
		//delete invoices
		$this->db->where('supplier_id', $supplier_id);
		$this->db->delete('ci_tax_invoices');
		//delete supplier
		$this->db->where('supplier_id', $supplier_id);
		$this->db->delete('ci_suppliers');
	}
}
