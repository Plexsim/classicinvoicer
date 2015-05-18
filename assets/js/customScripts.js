$(function() {
	$(":file").filestyle({classButton: "btn btn-primary"});
	$('.date').datepicker( {autoclose: true, format: 'dd-mm-yyyy'} );
	//$(".date").datepicker("setDate", new Date());
	$(".edit_invoice_date").datepicker({autoclose: true, format: 'dd-mm-yyyy'});
			
	$('#bttn_add_product').click(function() {
		$('#modal-placeholder').load(site_url+"invoices/items_from_products/" + Math.floor(Math.random()*1000));
	});
	
	$('#bttn_add_tax_product').click(function() {
		$('#modal-placeholder').load(site_url+"tax_invoices/items_from_products/" + Math.floor(Math.random()*1000));
	});
	
	$('#bttn_quote_add_product').click(function() {
		$('#modal-placeholder').load(site_url+"quotes/items_from_products/" + Math.floor(Math.random()*1000));
	});

	$('#bttn_add_item').click(function() 
	{
		$('#new_item').clone().appendTo('#item_table').removeAttr('id').addClass('item').show();
	});
	//email tags insertion
	$('.text-tag').bind('click', function () {
        var Tag = this.getAttribute("data-tag");
        insertTag('template_body', Tag);
        return false;
    });
});

//function to display the payament modal

function enterPayment(invoice_id)
{
	$('#modal-placeholder').load(site_url+"invoices/enter_payment/" + invoice_id);
}
function viewInvoice(invoice_id)
{
	$('#modal-placeholder').load(site_url+"invoices/previewinvoice/" + invoice_id);
}
function enterTaxPayment(invoice_id)
{
	$('#modal-placeholder').load(site_url+"tax_invoices/enter_payment/" + invoice_id);
}
function viewTaxInvoice(invoice_id)
{
	$('#modal-placeholder').load(site_url+"tax_invoices/previewinvoice/" + invoice_id);
}
function viewCash(cash_id)
{
	$('#modal-placeholder').load(site_url+"cash_vouchers/previewcash/" + cash_id);
}

function viewQuote(quote_id)
{
	$('#modal-placeholder').load(site_url+"quotes/previewquote/" + quote_id);
}
function convertQuote(quote_id){
	if(confirm("Are you sure you want to generate an invoice and delete the quote, you will not be able to undo this action"))
	{
		window.location = site_url+"quotes/convert_quote/"+quote_id;
	}
}
function emailclient(invoice_id)
{
	$('#modal-placeholder').load(site_url+"invoices/emailclient/" + invoice_id);
}
function emailtaxclient(invoice_id)
{
	$('#modal-placeholder').load(site_url+"tax_invoices/emailclient/" + invoice_id);
}
function emailclientquote(quote_id)
{
	$('#modal-placeholder').load(site_url+"quotes/emailclient/" + quote_id);
}

function calculateInvoiceAmounts()
{
	var items = [];
	var item_order = 1;
	$('.loading').fadeIn('slow');
	$('table tr.item').each(function() {
		var row = {};
		var quantity = $(this).find("input[name=item_quantity]").val();
		var unit_price = $(this).find("input[name=item_price]").val();
		var discount = $(this).find("input[name=item_discount]").val();
		$(this).find("input[name=item_sub_total]").val(quantity*unit_price-discount);
		
		$(this).find('input,select,textarea').each(function() 
		{
			row[$(this).attr('name')] = $(this).val();
		});
		items.push(row);
	});
	  $.post(site_url+"invoices/ajax_calculate_totals", {
		items: JSON.stringify(items),'invoice_discount_amount' : $('#invoice_discount_amount').val(), 'invoice_id' : $('#invoice_id').val()
	},
	function(data) {
		var response = JSON.parse(data);
		if (response.success == '1') 
		{
			$('#items_total_cost').html(response.items_total_cost);
			$('#invoice_total_tax').html(response.invoice_total_tax);
			$('#invoice_sub_total1').html(response.items_sub_total1);
			$('#invoice_sub_total2').html(response.invoice_sub_total2);
			$('#invoice_discount_amount').html(response.invoice_discount_amount);
			$('#invoice_amount_due').html(response.invoice_amount_due);
		}
		else {
			$('.control-group').removeClass('error');
			for (var key in response.validation_errors) {
				$('#' + key).parent().parent().addClass('error');
			}
		}
		$('.loading').fadeOut('slow');
	});
}
function calculateTaxInvoiceAmounts()
{
	var items = [];
	var item_order = 1;
	$('.loading').fadeIn('slow');
	$('table tr.item').each(function() {
		var row = {};
		var quantity = $(this).find("input[name=item_quantity]").val();
		var unit_price = $(this).find("input[name=item_price]").val();
		var discount = $(this).find("input[name=item_discount]").val();
		$(this).find("input[name=item_sub_total]").val(quantity*unit_price-discount);
		
		$(this).find('input,select,textarea').each(function() 
		{
			row[$(this).attr('name')] = $(this).val();			
		});
		items.push(row);
	});
	  $.post(site_url+"tax_invoices/ajax_calculate_totals", {
		items: JSON.stringify(items),'invoice_discount_amount' : $('#invoice_discount_amount').val(), 'invoice_id' : $('#invoice_id').val()
	},
	function(data) {
		var response = JSON.parse(data);
		if (response.success == '1') 
		{
			$('#items_total_cost').html(response.items_total_cost);
			$('#invoice_total_tax').html(response.invoice_total_tax);
			$('#invoice_sub_total1').html(response.items_sub_total1);
			$('#invoice_sub_total2').html(response.invoice_sub_total2);
			$('#invoice_discount_amount').html(response.invoice_discount_amount);
			$('#invoice_amount_due').html(response.invoice_amount_due);
		}
		else {
			$('.control-group').removeClass('error');
			for (var key in response.validation_errors) {
				$('#' + key).parent().parent().addClass('error');
			}
		}
		$('.loading').fadeOut('slow');
	});
}

function ajax_save_invoice()
{
	var client = $('#client_to_invoice').val();
	var invoice_date = $('#invoice_date').val();
	var due_date = $('#invoice_due_date').val();
	var invoice_terms = $('#invoice_terms').val();
	var invoice_status = $('#invoice_status').val();
	var invoice_number = $('#invoice_number').val();
	var invoice_id = $('#invoice_id').val();
	var save_type  = $('#save_type').val();
	var invoice_discount_amount = $('#invoice_discount_amount').val();
	$('.loading').fadeIn('slow');

	if(client == '')
	{
		alert('Please select a client to invoice');
		$('.loading').fadeOut('slow');
	}
	else if(invoice_date == '' )
	{
		alert('Please enter the invoice date');
		$('.loading').fadeOut('slow');
	}
	else if(due_date == '' )
	{
		alert('Please enter the invoice due date');
		$('.loading').fadeOut('slow');
	}
	else
	{
	var items = [];
	var item_order = 1;
	$('table tr.item').each(function() {
		var row = {};
		$(this).find('input,select,textarea').each(function() {
			row[$(this).attr('name')] = $(this).val();
		});
		row['item_order'] = item_order;
		item_order++;
		items.push(row);
	});
	  $.post(site_url+"invoices/ajax_save_invoice", {
	  invoice_client : client,
	  invoice_date : invoice_date,
	  invoice_due_date : due_date,
	  invoice_terms : invoice_terms,
	  invoice_status : invoice_status,
	  invoice_number : invoice_number,
	  invoice_id 	: invoice_id,
	  save_type		: save_type,
	  invoice_discount_amount : invoice_discount_amount,
	  items: JSON.stringify(items)
	},
	function(data_response) {
		var response = JSON.parse(data_response);
		if (response.success == '1') 
		{
			window.location = site_url+"invoices";
		}
		else {
			alert(response.error);
		}
		$('.loading').fadeOut('slow');
	});
	}
}

function objToString (obj) {
    var str = '';
    for (var p in obj) {
        if (obj.hasOwnProperty(p)) {
        	
        	for (var sub in obj[p]) {
        		str += sub + '::' + obj[p][sub] + '\n';
        	}
        	
            
        }
    }
    return str;
}

function ajax_save_tax_invoice()
{
	var client = $('#client_to_invoice').val();
	var invoice_date = $('#invoice_date').val();
	var due_date = $('#invoice_due_date').val();
	var invoice_terms = $('#invoice_terms').val();
	var invoice_status = $('#invoice_status').val();
	var invoice_number = $('#invoice_number').val();
	var invoice_id = $('#invoice_id').val();
	var save_type  = $('#save_type').val();
	var invoice_discount_amount = $('#invoice_discount_amount').val();
	
	var filter_from_date = $('#search_from_date').val();
	var filter_to_date = $('#search_to_date').val();
	var filter_client_id = $('#search_client_id').val();
	var filter_status = $('#search_status').val();
	
	$('.loading').fadeIn('slow');

	if(client == '')
	{
		alert('Please select a client to invoice');
		$('.loading').fadeOut('slow');
	}
	else if(invoice_date == '' )
	{
		alert('Please enter the invoice date');
		$('.loading').fadeOut('slow');
	}
	else if(due_date == '' )
	{
		alert('Please enter the invoice due date');
		$('.loading').fadeOut('slow');
	}
	else
	{
	var items = [];
	var item_order = 1;
	$('table tr.item').each(function() {
		var row = {};
		$(this).find('input,select,textarea').each(function() {
			row[$(this).attr('name')] = $(this).val();
		});
		row['item_order'] = item_order;
		item_order++;
		items.push(row);
	});
	  $.post(site_url+"tax_invoices/ajax_save_invoice", {
	  invoice_client : client,
	  invoice_date : invoice_date,
	  invoice_due_date : due_date,
	  invoice_terms : invoice_terms,
	  invoice_status : invoice_status,
	  invoice_number : invoice_number,
	  invoice_id 	: invoice_id,
	  save_type		: save_type,
	  invoice_discount_amount : invoice_discount_amount,
	  items: JSON.stringify(items)
	},
	function(data_response) {
		var response = JSON.parse(data_response);
		if (response.success == '1') 
		{
			window.location = site_url+"tax_invoices" + "/index/" + filter_status + "/" + filter_client_id + "/" + filter_from_date + "/" + filter_to_date;
			//alert(objToString(response.item));
		}
		else {
			alert(response.error);
		}
		$('.loading').fadeOut('slow');
	});
	}
}

function ajax_save_cash_voucher()
{
	var staff = $('#staff_to_cash').val();
	var cash_date = $('#cash_date').val();
	var cash_amount = $('#cash_amount').val();
	var cash_terms = $('#cash_terms').val();
	var cash_status = $('#cash_status').val();
	var cash_number = $('#cash_number').val();
	var cash_id = $('#cash_id').val();
	var save_type  = $('#save_type').val();
	$('.loading').fadeIn('slow');

	if(staff == '')
	{
		alert('Please select a client to invoice');
		$('.loading').fadeOut('slow');
	}
	else if(cash_date == '' )
	{
		alert('Please enter the cash date');
		$('.loading').fadeOut('slow');
	}	
	else
	{	
	  $.post(site_url+"cash_vouchers/ajax_save_cash", {
	  cash_staff : staff,
	  cash_date : cash_date,
	  cash_amount : cash_amount,
	  cash_terms : cash_terms,
	  cash_status : cash_status,
	  cash_number : cash_number,
	  cash_id 	: cash_id,
	  save_type		: save_type	  
	},
	function(data_response) {
		var response = JSON.parse(data_response);
		if (response.success == '1') 
		{
			window.location = site_url+"cash_vouchers";
			//alert(objToString(response.item));
		}
		else {
			alert(response.error);
		}
		$('.loading').fadeOut('slow');
	});
	}
}

function ajax_save_stock()
{
	var stock_date = $('#stock_date').val();
	var stock_terms = $('#stock_terms').val();
	var stock_status = $('#stock_status').val();
	var stock_number = $('#stock_number').val();
	var stock_amount = $('#stock_amount').val();
	var stock_id = $('#stock_id').val();
	var save_type  = $('#save_type').val();
	
	$('.loading').fadeIn('slow');

	if(stock_date == '')
	{
		alert('Please enter the stock date');
		$('.loading').fadeOut('slow');
	}
	else
	{	
	  $.post(site_url+"stock/ajax_save_stock", {	  
	  stock_date : stock_date,
	  stock_terms : stock_terms,
	  stock_status : stock_status,
	  stock_number : stock_number,
	  stock_amount : stock_amount,
	  stock_id 	: stock_id,
	  save_type		: save_type
	},
	function(data_response) {
		var response = JSON.parse(data_response);
		if (response.success == '1') 
		{
			window.location = site_url+"stock";
			//alert(objToString(response.item));
		}
		else {
			alert(response.error);
		}
		$('.loading').fadeOut('slow');
	});
	}
}

// function to save quotes
function ajax_save_quote()
{
	var client 				= $('#quote_client').val();
	var quote_date 			= $('#quote_date').val();
	var valid_until_date 	= $('#valid_until_date').val();
	var quote_terms 		= $('#quote_terms').val();
	var quote_status 		= $('#quote_status').val();
	var quote_number 		= $('#quote_number').val();
	var quote_subject		= $('#quote_subject').val();
	var quote_discount_amount = $('#quote_discount_amount').val();
	$('.loading').fadeIn('slow');
	
	if(client == '')
	{
		alert('Please select a client to quote');
		$('.loading').fadeOut('slow');
	}
	else if(quote_date == '' )
	{
		alert('Please enter the quote date');
		$('.loading').fadeOut('slow');
	}
	else if(valid_until_date == '' )
	{
		alert('Please enter the quote valid until date');
		$('.loading').fadeOut('slow');
	}
	else if(quote_subject =='')
	{
		alert('Please enter the quote subject');
		$('.loading').fadeOut('slow');
	}
	else
	{
	var items = [];
	var item_order = 1;
	$('table tr.item').each(function() {
		var row = {};
		$(this).find('input,select,textarea').each(function() {
			row[$(this).attr('name')] = $(this).val();
		});
		row['item_order'] = item_order;
		item_order++;
		items.push(row);
	});
	  $.post(site_url+"quotes/ajax_save_quote", {
	  quote_client 	: client,
	  quote_date 	: quote_date,
	  quote_valid_until_date : valid_until_date,
	  quote_subject : quote_subject,
	  quote_terms 	: quote_terms,
	  quote_status 	: quote_status,
	  quote_number 	: quote_number,
	  quote_discount_amount : quote_discount_amount,
	  items: JSON.stringify(items)
	},
	function(data_response) {
		var response = JSON.parse(data_response);
		if (response.success == '1') 
		{
			window.location = site_url+"quotes";
		}
		else {
			alert(response.error);
		}
		$('.loading').fadeOut('slow');
	});
	}
}

//function to claculate quote amounts
function calculatequoteAmounts()
{
	var items = [];
	var item_order = 1;
	$('.loading').fadeIn('slow');
	$('table tr.item').each(function() {
		var row = {};
		var quantity = $(this).find("input[name=item_quantity]").val();
		var unit_price = $(this).find("input[name=item_price]").val();
		var discount = $(this).find("input[name=item_discount]").val();
		$(this).find("input[name=item_sub_total]").val(quantity*unit_price-discount);
		
		$(this).find('input,select,textarea').each(function() 
		{
			row[$(this).attr('name')] = $(this).val();
		});
		items.push(row);
	});
	  $.post(site_url+"quotes/ajax_calculate_totals", {
		items: JSON.stringify(items),'quote_discount_amount' : $('#quote_discount_amount').val()
	},
	function(data) {
		var response = JSON.parse(data);
		if (response.success == '1') 
		{
			$('#items_total_cost').html(response.items_total_cost);
			$('#quote_total_tax').html(response.quote_total_tax);
			$('#quote_sub_total').html(response.quote_sub_total);
			$('#items_total_discount').html(response.items_total_discount);
			$('#quote_discount_amount').html(response.quote_discount_amount);
			$('#quote_amount_due').html(response.quote_amount_due);
		}
		else {
			$('.control-group').removeClass('error');
			for (var key in response.validation_errors) {
				$('#' + key).parent().parent().addClass('error');
			}
		}
		$('.loading').fadeOut('slow');
	});
}


//function to delete an invoice
function delete_invoice (invoice_id)
{
	if(confirm("Are you sure you want to permanently delete this invoice, you will not be able to undo this action"))
	{
		window.location = site_url+"invoices/delete_invoice/"+invoice_id;
	}
}
//function to delete an tax invoice
function delete_tax_invoice (invoice_id)
{
	if(confirm("Are you sure you want to permanently delete this tax invoice, you will not be able to undo this action"))
	{
		window.location = site_url+"tax_invoices/delete_invoice/"+invoice_id;
	}
}
//function to delete an invoice
function delete_stock(stock_id)
{
	if(confirm("Are you sure you want to permanently delete this stock, you will not be able to undo this action"))
	{
		window.location = site_url+"stock/delete_stock/"+stock_id;
	}
}
//function to delete an invoice
function delete_quote (quote_id)
{
	if(confirm("Are you sure you want to permanently delete this quote, you will not be able to undo this action"))
	{
		window.location = site_url+"quotes/delete_quote/"+quote_id;
	}
}
//function to display email templates
function get_template(template_id)
{
	if(template_id != ''){
	$('.loading').fadeIn('slow');
	$.post(site_url+"email_templates/get_template", {template_id : template_id},
		function(data_response) {
		var response = JSON.parse(data_response);
		   $('#email_body').val(response.template);
		    $('.loading').fadeOut('slow');
		});
	}
}
//function to send email to client
function ajax_send_email()
{
	var client_name 	= $('#client_name').val();
	var email_subject 	= $('#email_subject').val();
	var email_template 	= $('#email_template').val();
	var email_body 		= $('#email_body').val();
	var invoice_id 		= $('#invoice_id').val();

	$('.loading').fadeIn('slow');
	$.post(site_url+"invoices/ajax_send_email", {
		client_name 	: client_name,
		email_subject 	: email_subject,
		email_template 	: email_template,
		email_body 		: email_body,
		invoice_id		: invoice_id
	},
	function(data_response) {
	var response = JSON.parse(data_response);
		if (response.success == '1') 
		{
			window.location = site_url+"invoices/edit/"+invoice_id;
		}
		else {

			if(response.errormsg != ''){
				alert(response.errormsg);
			}

			$('.control-group').removeClass('has-error');
			for (var key in response.validation_errors) {
				$('#' + key).parent().parent().addClass('has-error');
			}
		}
		$('.loading').fadeOut('slow');
	});
}
//function to send email quote to client
function ajax_email_quote()
{
	var client_name 	= $('#client_name').val();
	var email_subject 	= $('#email_subject').val();
	var email_template 	= $('#email_template').val();
	var email_body 		= $('#email_body').val();
	var quote_id 		= $('#quote_id').val();

	$('.loading').fadeIn('slow');
	$.post(site_url+"quotes/ajax_send_email", {
		client_name 	: client_name,
		email_subject 	: email_subject,
		email_template 	: email_template,
		email_body 		: email_body,
		quote_id		: quote_id
	},
	function(data_response) {
	var response = JSON.parse(data_response);
		if (response.success == '1') 
		{
			window.location = site_url+"quotes/edit/"+quote_id;
		}
		else {
			if(response.errormsg != ''){
				alert(response.errormsg);
			}
			$('.control-group').removeClass('has-error');
			for (var key in response.validation_errors) {
				$('#' + key).parent().parent().addClass('has-error');
			}
		}
		$('.loading').fadeOut('slow');
	});
}
//function to insert tags into a template body
function insertTag(inputId, text) {
    var txtarea = document.getElementById(inputId);
    var scrollPos = txtarea.scrollTop;
    var strPos = 0;
    var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ?
        "ff" : (document.selection ? "ie" : false));
    if(br == "ie") {
        txtarea.focus();
        var range = document.selection.createRange();
        range.moveStart('character', -txtarea.value.length);
        strPos = range.text.length;
    } else if(br == "ff") strPos = txtarea.selectionStart;

    var front = (txtarea.value).substring(0, strPos);
    var back = (txtarea.value).substring(strPos, txtarea.value.length);
    txtarea.value = front + text + back;
    strPos = strPos + text.length;
    if(br == "ie") {
        txtarea.focus();
        var range = document.selection.createRange();
        range.moveStart('character', -txtarea.value.length);
        range.moveStart('character', strPos);
        range.moveEnd('character', 0);
        range.select();
    } else if(br == "ff") {
        txtarea.selectionStart = strPos;
        txtarea.selectionEnd = strPos;
        txtarea.focus();
    }
    txtarea.scrollTop = scrollPos;
}

function ajax_print_full_report()
{
	var client = $('#client_id').val();
	var from_date = $('#from_date').val();
	var to_date = $('#to_date').val();
	var status = $('#status').val();
		
	$('.loading').fadeIn('slow');

	if(client == '')
	{
		alert('Please select a client to full report');
		$('.loading').fadeOut('slow');
	}
	else if(from_date == '' && to_date == '')
	{
		alert('Please enter the date from and date to');
		$('.loading').fadeOut('slow');
	}
	else if(status == '' )
	{
		alert('Please select status');
		$('.loading').fadeOut('slow');
	}
	else
	{
		$('.loading').fadeOut('slow');
		window.location.replace(site_url+"tax_reports/view_full_report_pdf?client_id="+ client + "&from_date="+from_date + "&to_date="+to_date+"&status="+status);
	}
}

function ajax_print_cash_voucher(cash_id)
{
	var company = $('#company').val();	
			
	$('.loading').fadeIn('slow');
	$('.loading').fadeOut('slow');
	window.location.replace(site_url+"cash_vouchers/viewpdf/"+cash_id+"/"+company);
	
}
