<script type="text/javascript">
$(function() {
	$('.loading').fadeIn('slow');
	$('.report-header').html('Payment Summary');
	$.post("<?php echo site_url('tax_reports/payment_summary'); ?>", {
			client: 'all',
			from_date: '',
			to_date: '',
		},
		function(data) {
		   $('#report-body').html(data);
		   $('.loading').fadeOut('slow');
		});
});

//function to generate payments summary report
function payments_summary()
{
	var client 		= $('#client_id').val();
	var from_date 	= $('#from_date').val();
	var to_date 	= $('#to_date').val();
	
	if(client == '')
	{
		client 		= 'all';
	}
	$('.loading').fadeIn('slow');
	$.post("<?php echo site_url('tax_reports/payment_summary'); ?>", {
			client		: client,
			from_date	: from_date,
			to_date		: to_date,
		},
		function(data) {
		   	$('#report-body').html(data);
		    $('.loading').fadeOut('slow');
		    $('#from_date').val(from_date);
		    $('#to_date').val(to_date);
		});
}

//function to generate client statement
function client_statement()
{
	$('.loading').fadeIn('slow');
	var client 		= $('#client_id').val();
	$.post("<?php echo site_url('tax_reports/client_statement'); ?>", {
		client_id : client,
		},
		function(data) {
		   $('#report-body').html(data);
		    $('.loading').fadeOut('slow');
		});
}
//function to generate invoice report
function invoices_report()
{
	$('.loading').fadeIn('slow');
	var client 		= $('#client_id').val();
	$.post("<?php echo site_url('tax_reports/invoices_report'); ?>", {
		client_id : client,
		},
		function(data) {
		   $('#report-body').html(data);
		    $('.loading').fadeOut('slow');
		});
}
//function to generate invoice full report
function invoices_full_report()
{
	$('.loading').fadeIn('slow');
	var client 		= $('#client_id').val();
	var from_date 		= $('#from_date').val();
	var to_date 		= $('#to_date').val();
	var status 			= $('#status').val();
	$.post("<?php echo site_url('tax_reports/invoices_full_report'); ?>", {
		client_id : client,
		from_date : from_date,
		to_date : to_date,
		status : status,
		},
		function(data) {
		    $('#report-body').html(data);
		    $('.loading').fadeOut('slow');
		    $('#from_date').val(from_date);
		    $('#to_date').val(to_date);
		    $('#status').val(status);
		});
}


//function to generate invoice full report
function print_full_report()
{
	$('.loading').fadeIn('slow');
	var client 		= $('#client_id').val();
	console.log(client);	
	var from_date 		= $('#from_date').val();
	console.log(from_date);
	var to_date 		= $('#to_date').val();
	console.log(to_date);
	var status 			= $('#status').val();
	console.log(status);
	$.post("<?php echo site_url('tax_invoices/view_full_report_pdf'); ?>", {
		client_id : client,
		from_date : from_date,
		to_date : to_date,
		status : status,
		},
		function(data) {
		    //$('#report-body').html(data);
		    $('.loading').fadeOut('slow');		   
		});
}

//function to generate invoice full report
function print_full_report_button()
{
	var client_id = document.getElementById("client_id");
	var from_date = document.getElementById("from_date");
	var to_date = document.getElementById("to_date");
	var status = document.getElementById("status");
	var bttn_save_invoice = document.getElementById("bttn_save_invoice");
	var bttn_print_invoice = document.getElementById("bttn_print_invoice");
	var allButton = $("[type='button']");
	var view_button = document.getElementById("view_button");
	
	//client_id.style.visibility = "hidden";
	//from_date.style.visibility = "hidden";
	//to_date.style.visibility = "hidden";
	//status.style.visibility = "hidden";
	//bttn_save_invoice.style.visibility = "hidden";
	//bttn_print_invoice.style.visibility = "hidden";
	//allButton.style.visibility = "hidden";
	//view_button.style.visibility = "hidden";
	
	window.print();

	//client_id.style.visibility = "visible";
	//from_date.style.visibility = "visible";
	//to_date.style.visibility = "visible";
	//status.style.visibility = "visible";
	//bttn_save_invoice.style.visibility = "visible";
	//bttn_print_invoice.style.visibility = "visible";
	//allButton.style.visibility = "visible";
	//view_button.style.visibility = "visible";
}


//function to display clients contact list
function clients_contact_list()
{
	$('.loading').fadeIn('slow');
	$.post("<?php echo site_url('tax_reports/clients_contact_list'); ?>", {},
		function(data) {
		   $('#report-body').html(data);
		    $('.loading').fadeOut('slow');
		});
}
</script>
<div class="loading"></div>
<div id="page-wrapper">
	<div class="row no-print">
		<div class="col-lg-12">
			<button type="button" class="btn btn-primary btn-lg reports-button" onclick="javascript: payments_summary();">Payments Summary</button> 
			<button type="button" class="btn btn-info btn-lg reports-button" onclick="javascript: client_statement();">Client Statement</button>
			<button type="button" class="btn btn-success btn-lg reports-button" onclick="javascript: invoices_report();">Invoices Report</button>
			<button type="button" class="btn btn-warning btn-lg reports-button" onclick="javascript: clients_contact_list();">Client Contact List</button>
		</div> 
	</div>

		
	 <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="table-responsive">
				<div id="report-body"></div>
				</div>
              </div>
            </div>
          </div>
        </div><!-- /.row -->
</div> 