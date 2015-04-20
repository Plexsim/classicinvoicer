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
	
	// statement name and month file
	$filename = 'invoice_'.strtolower(trim(preg_replace('#\W+#', '_', $full_report_data['invoice_details']->invoice_number), '_'));

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