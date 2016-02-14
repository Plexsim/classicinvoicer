<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function generate_pdf_invoice($invoice_data, $stream = TRUE)
{
    $CI = & get_instance();

    $data = array(
        'invoice_details'   => $invoice_data,
        'output_type'       => 'pdf'
    );

    $html = $CI->load->view('pdf_templates/invoices', $data, TRUE);

    $CI->load->helper('mpdf');

    $filename = 'invoice_'.strtolower(trim(preg_replace('#\W+#', '_', $invoice_data['invoice_details']->invoice_number), '_'));

    return pdf_create($html, $filename , $stream);
}
function generate_pdf_tax_invoice($invoice_data, $stream = TRUE)
{
	$CI = & get_instance();

	$data = array(
			'invoice_details'   => $invoice_data,
			'output_type'       => 'pdf'
	);

	$html = $CI->load->view('pdf_templates/tax_invoices', $data, TRUE);

	$CI->load->helper('mpdf');

	$filename = 'invoice_'.strtolower(trim(preg_replace('#\W+#', '_', $invoice_data['invoice_details']->invoice_number), '_'));

	return pdf_create($html, $filename , $stream);
}

function generate_pdf_full_report($full_report_data, $stream = TRUE)
{
	$CI = & get_instance();

	$data = array(
			'report_details'   => $full_report_data,
			'output_type'       => 'pdf'
	);

	$html = $CI->load->view('pdf_templates/full_report', $data, TRUE);

	$CI->load->helper('mpdf');
	
	$client_name = isset($full_report_data[0]['invoice_client']) && !empty($full_report_data[0]['invoice_client']) ? $full_report_data[0]['invoice_client'] : 'EMPTY_CLIENT';
	$client_date = isset($full_report_data[0]['invoice_date']) && !empty($full_report_data[0]['invoice_date']) ? $full_report_data[0]['invoice_date'] : 'NO_DATE';
	$client_status = isset($full_report_data[0]['invoice_status']) && !empty($full_report_data[0]['invoice_status']) ? $full_report_data[0]['invoice_status'] : 'NO_STATUS';
		
	// statement name and month file
	$filename = 'invoice_'.strtolower(trim(preg_replace('#\W+#', '_', $client_name.'_'.$client_date.'_'.$client_status) , '_'));

	return pdf_create($html, $filename , $stream);
}

function generate_pdf_quote($quote_data, $stream = TRUE)
{
    $CI = & get_instance();

    $data = array(
        'quote_details'   => $quote_data,
        'output_type'       => 'pdf'
    );

    $html = $CI->load->view('pdf_templates/quotes', $data, TRUE);

    $CI->load->helper('mpdf');

    $filename = 'quote_'.strtolower(trim(preg_replace('#\W+#', '_', $quote_data['quote_details']->quote_id), '_'));

    return pdf_create($html, $filename, $stream);
}

function generate_pdf_cash_voucher($cash_data, $stream = TRUE, $company = '')
{
	$CI = & get_instance();

	$data = array(
			'cash_details'   => $cash_data,
			'output_type'       => 'pdf',
			'company'		=> $company
	);

	$html = $CI->load->view('pdf_templates/cash_vouchers', $data, TRUE);

	$CI->load->helper('mpdf');

	$filename = 'cash_'.strtolower(trim(preg_replace('#\W+#', '_', $cash_data['cash_details']->cash_number), '_'));

	return pdf_create($html, $filename , $stream);
}

function generate_pdf_receipt($receipt_data, $stream = TRUE, $company = '')
{
	$CI = & get_instance();

	$data = array(
			'receipt_details'   => $receipt_data,
			'output_type'       => 'pdf',
			'company'		=> $company
	);

	$html = $CI->load->view('pdf_templates/receipts', $data, TRUE);

	$CI->load->helper('mpdf');

	$filename = 'receipt_'.strtolower(trim(preg_replace('#\W+#', '_', $receipt_data['receipt_details']->receipt_number), '_'));

	return pdf_create($html, $filename , $stream);
}

function generate_pdf_debt($debt_data, $balance_bring_forward, $stream = TRUE)
{
	$CI = & get_instance();

	$data = array(
			'debt_details'   			=> $debt_data,
			'balance_bring_forward'		=> $balance_bring_forward,
			'output_type'       		=> 'pdf'
	);

	$html = $CI->load->view('pdf_templates/debt_balance', $data, TRUE);

	$CI->load->helper('mpdf');

	$filename = 'statement_'.strtolower(trim(preg_replace('#\W+#', '_', $debt_data['client_name'].'_'.format_date_month($debt_data['date_to'])), '_'));

	return pdf_create($html, $filename , $stream);
}
