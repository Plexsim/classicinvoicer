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
			 $class = ($report_details['report_details']->invoice_status == 'UNPAID') ? 'invoice_status_cancelled' : 'invoice_status_paid';
			  ?>
			<div class="<?php echo $class; ?>"> <?php echo $report_details['report_details']->invoice_status; ?></div>
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
		<td colspan=2 align="center"><h1>Tax Invoice</h1></td>
	</tr>	
	<tr>
		<td width="70%">		
			<p>Billed To : </p>
			<span style="font-size:12px;font-weight: bold"><?php echo $report_details['report_details']->client_name; ?> </span><span style="font-size:6px;"><?php echo isset($report_details['report_details']->client_ssm) && !empty($report_details['report_details']->client_ssm) ? '<span style="font-size:8px;">('.$report_details['report_details']->client_ssm.')</span>' : ''; ?></span>			
			<p><?php echo $report_details['report_details']->client_address; ?></p>								
			<p>TEL: <?php echo isset($report_details['report_details']->client_phone) && !empty($report_details['report_details']->client_phone) ? $report_details['report_details']->client_phone : '-'; ?>  FAX: <?php echo isset($report_details['report_details']->client_fax)&&!empty($report_details['report_details']->client_fax) ? $report_details['report_details']->client_fax : '-'; ?> </p>
			<p><span style="font-weight: bold">GST ID No: <?php echo isset($report_details['report_details']->client_gst) && !empty($report_details['report_details']->client_gst) ? $report_details['report_details']->client_gst : '-'; ?></span></p>
			<p>Attn:</p>																
		</td>				
		<td>		
			<p>Invoice No. : <?php echo $report_details['report_details']->invoice_number; ?></p>
			<p>Date : <?php echo format_date($report_details['report_details']->invoice_date_created); ?></p>			
			<!--p>Page: of 1</p-->								
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
		<th>ITEM</th>
		<th>DESCRIPTION</th>
		<th>TAX </th>
		<th>QUANTITY</th>
		<th class="text-right">UNIT PRICE</th>
		<th class="text-right">DISCOUNT</th>
		<th class="text-right">SUB TOTAL</th>
	  </tr>
	</thead>
	<tbody>
	<?php
	foreach ($report_details['invoice_items'] as $count=>$item)
	{?>
	<tr class="transaction-row">
	<td><?php echo $item['item_name'];?></td>
	<td><?php echo $item['item_description'];?></td>
	<td><?php echo ($item['item_taxrate_id'] !=0 ) ? $item['tax_rate_name'].' - '.$item['tax_rate_percent'].'%' : '0.00%';?></td>
	<td style="text-align:center"><?php echo $item['item_quantity'];?></td>
	<td class="text-right" style="width: 13%"><?php echo number_format($item['item_price'], 2); ?></td>
	<td class="text-right" style="width: 10%"><?php echo number_format($item['item_discount'], 2); ?></td>
	<td class="text-right" style="width: 14%"><?php echo number_format($item['item_price']*$item['item_quantity']-$item['item_discount'], 2); ?></td>
	</tr>
	<?php
	}
	?>
	
	<tr><td colspan="6" class="text-right">SUB TOTAL : </td><td class="text-right"><label><?php echo format_amount($report_details['invoice_totals']['item_total']);?></label></td></tr>
	<tr><td colspan="6" class="text-right no-border">INVOICE DISCOUNT : </td><td class="text-right no-border"><label><?php echo format_amount($report_details['report_details']->invoice_discount);?></label></td></tr>
	<tr><td colspan="6" class="text-right no-border">Total before @ 6% : </td><td class="text-right invoice_amount_paid"><label><?php echo format_amount($report_details['invoice_totals']['sub_total']);?></label></td></tr>		
	<tr><td colspan="6" class="text-right no-border">Add GST @ 6% : </td><td class="text-right no-border"><label><?php echo format_amount($report_details['invoice_totals']['tax_total']);?></label></td></tr>	
	<tr><td colspan="6" class="text-right no-border">Total Sales : </td><td class="text-right no-border invoice_amount_due"><label><?php echo format_amount( $report_details['invoice_totals']['item_total'] - $report_details['report_details']->invoice_discount + $report_details['invoice_totals']['tax_total']); ?></label></td></tr>
		
	<tr class="table_header"><td colspan="7"></td></tr>
</table>
	
	
	<h4>Invoice Terms </h4>
	<i><?php echo $report_details['report_details']->invoice_terms; ?></i>
	<br/><br/>
	
	<table>
		<tr>
			<td>
				Notes:
			</td>
			<td>
				<li>
					<p>All cheque should be crossed and made payable to </p>
					<p><?php echo $name ?></p>				
				</li>
				<li>Goods sold are neither returnable nor refundable. Otherwise a cancellation fee of 20% on purchase price will be imposed.</li>
			</td>
		</tr>		
	</table>
	
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
			<label class="control-label">Client : <?php echo $report_details['report_details']->client_name; ?></label>
			<br/><br/><br/>
			................................................<br/>
			<i>Signature &amp; Stamp</i>		
		</td>
	</tr>
	</table>
		
</div>
</div>

