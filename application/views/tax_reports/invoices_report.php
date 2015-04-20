<?php 
	$logo = get_siteconfig('logo');
	$name = get_siteconfig('name');
	$gst = get_siteconfig('gst');
	$ssm = get_siteconfig('ssm');	
	$address = get_siteconfig('address');
	$postal_code = get_siteconfig('postal_code');
	$phone = get_siteconfig('phone');
	$fax = get_siteconfig('fax');	
	$email = get_siteconfig('email');
	$website = get_siteconfig('website');
?>

<table class="print-display logo_table" width="100%">
	<tr>
		<td class="column_logo" align="center" cellpadding="0" cellspacing="0" style="padding:0px;">
			<?php 																					
				if($logo != ''){
				?>
					<img src="<?php echo base_url().UPLOADSDIR.$logo;?>" width="25%"/>
				<?php
				}
			?>
		</td>
	</tr>
	<tr>			
		<td class="column_logo" align="center" cellpadding="0" cellspacing="0" style="padding:0px; font-size:16px;"><?php echo $name ?> <span style="font-size:8px;">(<?php echo $ssm?>)</span></td>
	</tr>
	<tr>
		<td class="column_logo" align="center" cellpadding="0" cellspacing="0" style="padding:0px; font-size:13px; font-weight: bold;">GST ID No: <?php echo $gst ?></td>
	</tr>
	<tr>
		<td class="column_logo" align="center" cellpadding="0" cellspacing="0" style="padding:0px; font-size:10px;"><span style="font-size:10px;"><?php echo $address ?></span></td>
	</tr>
	<tr>
		<td class="column_logo" align="center" cellpadding="0" cellspacing="0" style="padding-bottom:5px; font-size:10px;"><span style="font-size:10px;">H/P: <?php echo isset($phone)&&!empty($phone) ? $phone : '-' ?></span> <!--span style="font-size:10px;">FAX: <?php echo isset($fax) && !empty($fax) ? $fax : '-' ?></span--> </td>
	</tr>	
	
</table>	
<hr class="print-display" style="padding:0px;margin:0px;">
<div class="row print-display">
	<div class="col-lg-12">
	<table width="100%">
	<tr>
		<td class="column_statement" colspan=2 align="center"><h4>STATEMENT OF ACCOUNT</h4></td>
	</tr>	
	<tr>
		<td class="column_statement"  width="70%">		
			<p style="font-size:12px; line-height:0px;">Billed To : </p>
			<span style="font-size:12px;font-weight: bold"><?php echo $invoices_report[0]['invoice_client']; ?> </span><span style="font-size:6px;"><?php echo isset($invoices_report[0]['client_ssm']) && !empty($invoices_report[0]['client_ssm']) ? '<span style="font-size:8px;">('.$invoices_report[0]['client_ssm'].')</span>' : ''; ?></span>			
			<p style="font-size:11px;"><?php echo $invoices_report[0]['invoice_client_address']; ?></p>								
			<p style="font-size:11px;line-height:5px;">TEL: <?php echo isset($invoices_report[0]['invoice_client_phone']) && !empty($invoices_report[0]['invoice_client_phone']) ? $invoices_report[0]['invoice_client_phone'] : '-'; ?>  FAX: <?php echo isset($invoices_report[0]['invoice_client_fax'])&&!empty($invoices_report[0]['invoice_client_fax']) ? $invoices_report[0]['invoice_client_fax'] : '-'; ?> </p>
			<p style="font-size:11px;line-height:5px;"><span style="font-weight: bold">GST ID No: <?php echo isset($invoices_report[0]['invoice_client_gst']) && !empty($invoices_report[0]['invoice_client_gst']) ? $invoices_report[0]['invoice_client_gst'] : '-'; ?></span></p>
			<p style="font-size:11px;line-height:5px;">Attn:</p>																
		</td>				
		<td class="column_statement" >		
			<p style="font-size:11px;line-height:5px;">Invoice No. : <?php echo $invoices_report[0]['invoice_id']; ?></p>
			<p style="font-size:11px;line-height:5px;">Date : <?php echo format_date($invoices_report[0]['invoice_date']); ?></p>			
			<!--p>Page: of 1</p-->								
		</td>		
	</tr>
	</table>
	</div>
</div>

<div class="row no-print">
<div class="col-lg-2">
	<div class="form-group">
		<label>Client : </label>
		<select name="client_id" id="client_id" class="form-control">
		<?php echo $clients; ?>
		</select>
	</div>
</div>
<div class="col-lg-2">
	<label>From : </label>
	<div class="form-group input-group " style="margin-left:0;">
	   <input class="form-control" size="16" type="text" name="from_date" id="from_date"/>
		<span class="input-group-addon add-on"><i class="fa fa-calendar" style="display: inline"></i></span>
	</div>
</div>
<div class="col-lg-2">
	<label>To : </label>
	<div class="form-group input-group" style="margin-left:0;">
	   <input class="form-control" size="16" type="text" name="to_date" id="to_date"/>
		<span class="input-group-addon add-on"><i class="fa fa-calendar" style="display: inline"></i></span>
	</div>
</div>
<div class="col-lg-2">
	<div class="form-group">
		<label>Status : </label>
		<select name="status" id="status" class="form-control">
			<option value="">ALL</option>
			<option value="UNPAID">UNPAID</option>
			<option value="PAID">PAID</option>
			<option value="CANCELLED">CANCELLED</option>
		</select>
	</div>
</div>
<div class="col-lg-2">
	<label> </label>
	<div class="form-group input-group" style="margin-left:0;">
	<a href="javascript: void(0);" onclick="javascript: invoices_full_report();" class="btn btn-large btn-success pull-right"  style="margin-right:10px" id="bttn_save_invoice"><i class="fa fa-check"></i> Generate Report </a>
	</div>
</div>

<div class="col-lg-2">
	<label> </label>
	<div class="form-group input-group" style="margin-left:0;">
		<a href="javascript: void(0);" onclick="javascript: print_full_report_button();" class="btn btn-large btn-danger pull-right" id="bttn_print_invoice">Print This Page</a>	
	</div>
</div>

</div>


	<table class="table table-hover table-bordered ">
	<thead>	 
	  <tr class="table_header">
		<th>STATUS</th>
		<th>INVOICE NUMBER</th>
		<th>DATE </th>
		<th>CLIENT</th>
		<th class="text-right">AMOUNT</th>
		<th class="no-print"></th>
	  </tr>
	</thead>
	<tbody>
<?php
if( isset($invoices_report) && !empty($invoices_report))
{
?>
	<?php
	$amount = 0;
	foreach ($invoices_report as $count => $invoice)
	{
	?>
	  <tr class="transaction-row">
		<td><?php echo status_label($invoice['invoice_status']);?></td>
		<td>
			<div class="no-print">
				<a href="<?php echo site_url('tax_invoices/edit/');?>/<?php echo $invoice['invoice_id'];?>"><?php echo $invoice['invoice_number'];?></a>
			</div>
			<div class="print-display">
				<?php echo $invoice['invoice_number'];?>
			</div>			
			
		</td>
		<td><?php echo format_date($invoice['invoice_date']);?></td>
		<td><?php echo ucwords($invoice['invoice_client']);?></td>
		<?php 
			$amount += $invoice['invoice_amount']; 		
		?>
		<td class="text-right"><?php echo format_amount($invoice['invoice_amount']); ?></td>
		<td class="no-print">
		<a id="view_button" href="<?php echo site_url('tax_invoices/edit/'.$invoice['invoice_id']);?>" class="btn btn-xs btn-primary"><i class="fa fa-check"> View / Edit </i></a>
		</td>
	  </tr>
	
	<?php
	}
	?>
	  <tr class="transaction-row">
	  	<td colspan=3></td>
	  	<td class="text-right">Total:</td>
	  	<td class="text-right"><?php echo format_amount($amount) ?></td>
	  </tr>
	
<?php 	
}
else
{
?>
<tr class="no-cell-border transaction-row">
<td colspan="7"> There are no records to display at the moment.</td>
</tr>
<?php
}
?>
</tbody>
</table>

<script>

$('#from_date').datepicker({dateFormat:'dd-mm-yy', altField: '#date_alt', altFormat: 'yy-mm-dd'});
$('#to_date').datepicker({dateFormat:'dd-mm-yy', altField: '#date_alt', altFormat: 'yy-mm-dd'});

//$('#select_dateto').datepicker({dateFormat:'dd-mm-yy', altField: '#date_to_alt', altFormat: 'yy-mm-dd'});

</script>