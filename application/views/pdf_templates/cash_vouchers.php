<?php $countries = config_item('country_list');  ?>
<link href="<?php echo base_url().CSSFOLDER; ?>style.css" rel="stylesheet"/>
<style>
table {
	border-collapse: collapse;
	border-spacing: 0;
	width:100%;
}
.table-title{
	padding:0;	
}
.table-bordered td, .table-bordered th{
	border: 1px solid #ddd;
	padding: 8px;
	border-collapse: collapse;	
}
.table-bordered th{
	color: #000;
}
body {
	font-size: 75%;
}
</style>

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

<div class="row">
	<div class="col-lg-12">
	<table width="100%">
	<tr>
		<td align="center" cellpadding="0" cellspacing="0" style="padding:0px">
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
		<!--td>
			<?php
			 $class = ($cash_details['cash_details']->cash_status == 'UNPAID') ? 'cash_status_cancelled' : 'cash_status_paid';
			  ?>
			<div class="<?php echo $class; ?>"> <?php echo $cash_details['cash_details']->cash_status; ?></div>
		</td-->
	</tr>	
	<tr>			
		<td align="center" cellpadding="0" cellspacing="0" style="padding:0px; font-size:16px;"><?php echo $name ?> <span style="font-size:8px;">(<?php echo $ssm?>)</span></td>
	</tr>
	<tr>
		<td align="center" cellpadding="0" cellspacing="0" style="padding:0px; font-size:13px; font-weight: bold;">GST ID No: <?php echo $gst ?></td>
	</tr>
	<tr>
		<td align="center" cellpadding="0" cellspacing="0" style="padding:0px; font-size:10px;"><span style="font-size:10px;"><?php echo $address ?></span></td>
	</tr>
	<tr>
		<td align="center" cellpadding="0" cellspacing="0" style="padding:0px; font-size:10px;"><span style="font-size:10px;">H/P: <?php echo isset($phone)&&!empty($phone) ? $phone : '-' ?></span> <!--span style="font-size:10px;">FAX: <?php echo isset($fax) && !empty($fax) ? $fax : '-' ?></span--> </td>
	</tr>					
	</table>
	</div>	
</div>
<hr/>
<div class="row">
	<div class="col-lg-12">
	<table width="100%">
	<tr>
		<td colspan=2 align="center"><h1>General Cash Voucher</h1></td>
	</tr>	
	<tr>
		<td width="70%">	
			<p>Date : <?php echo format_date($cash_details['cash_details']->cash_date_created); ?> </p>
			<p>Cash Voucher No : <?php echo $cash_details['cash_details']->cash_number; ?></p>
			<p>Receiver Name : <?php echo $cash_details['cash_details']->staff_name; ?></p>												
		</td>								
	</tr>
	</table>
	</div>
</div>
<div class="row">
<div class="col-lg-12">
<table class="table table-bordered">
	<thead>
	  <tr class="table_header">
		<th width="70%">DESCRIPTION</th>
		<th class="text-right">AMOUNT</th>
	  </tr>
	</thead>
	<tbody>
	<tr class="transaction-row">
	<td><?php echo $cash_details['cash_details']->cash_terms; ?></td>
	<td class="text-right" style="width: 13%"><?php echo format_amount($cash_details['cash_details']->cash_amount, 2); ?></td>	
	</tr>	
	<tr><td colspan="1" class="text-right no-border">Total </td><td class="text-right invoice_amount_paid"><label><?php echo format_amount($cash_details['cash_details']->cash_amount);?></label></td></tr>			
	<tr class="table_header"><td colspan="1"></td></tr>
</table>
		
<br/>
	
		
<table width="100%">
<tr>
	<td width="70%">
	<label class="control-label">This is computer generated document,</label>
	<br/><br/>
	no signature required<br/>
	................................................<br/>
	<i>Authorised Signature</i>				
	</td>
	
	<td width="30%">
		<label class="control-label">Staff : <?php echo $cash_details['cash_details']->staff_name; ?></label>
		<br/><br/><br/>
		................................................<br/>
		<i>Signature &amp; Stamp</i>		
	</td>
</tr>
</table>
		
</div>
</div>

