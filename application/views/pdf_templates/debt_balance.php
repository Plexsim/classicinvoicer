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
			 $class = ($debt_details['debt_details']->debt_status == 'UNPAID') ? 'debt_status_cancelled' : 'debt_status_paid';
			?>
			<div class="<?php echo $class; ?>"> <?php echo $debt_details['debt_details']->debt_status; ?></div>
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
		<td colspan=2 align="center"><h1>STATEMENT OF ACCOUNT</h1></td>
	</tr>	
	<tr>
		<td colspan=2 align="center"><h2>As At <?php echo $debt_details['date_to']?></h2></td>
	</tr>	
	
	
	<tr>
		<td width="70%">					
			<span style="font-size:12px;font-weight: bold"><?php echo $debt_details['client_name'] ?> </span><span style="font-size:6px;"><?php echo isset($debt_details['client_ssm']) && !empty($debt_details['client_ssm']) ? '<span style="font-size:8px;">('.$debt_details['client_ssm'].')</span>' : ''; ?></span>			
			<p><?php echo $debt_details['client_address']; ?></p>								
			<p>TEL: <?php echo isset($debt_details['client_phone']) && !empty($debt_details['client_phone']) ? $debt_details['client_phone'] : '-'; ?>  FAX: <?php echo isset($debt_details['client_fax'])&&!empty($debt_details['client_fax']) ? $debt_details['client_fax'] : '-'; ?> </p>
			<p><span style="font-weight: bold">GST ID No: <?php echo isset($debt_details['client_gst']) && !empty($debt_details['client_gst']) ? $debt_details['client_gst'] : '-'; ?></span></p>
			<p>Attn:</p>
		</td>				
		<td>
			<!--p>Invoice No. : <?php echo $debt_details['debt_id']; ?></p-->
			<p>Month : <?php echo format_date_month($debt_details['date_to']); ?></p>			
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
		<th>DATE</th>
		<th>REFERENCE</th>
		<th>DESCRIPTION</th>
		<th class="text-right">DEBIT</th>
		<th class="text-right">CREDIT</th>
		<th class="text-right">BALANCE</th>
	  </tr>
	</thead>
	<tbody>
	<tr>
		<td><?php echo format_date($debt_details['date_from']);?></td>
		<td>&nbsp;</td>
		<td>Balance B/F</td>
		<td></td>
		<td></td>
		<td class="text-right" style="width: 14%"><?php echo number_format($balance_bring_forward, 2);?></td>
	</tr>
	<?php
	$row_balance = 0;
	$balance = $balance_bring_forward;
	foreach ($debt_details['debt_details'] as $count=>$item){
	?>
	<tr class="transaction-row">
	<td><?php echo format_date($item['debt_date_created']);?></td>
	<td><?php echo $item['debt_reference'];?></td>
	<td><?php echo $item['debt_description'];?></td>	
	<td class="text-right" style="width: 13%"><?php echo number_format($item['debt_amount_unpaid'], 2); ?></td>
	<td class="text-right" style="width: 10%"><?php echo number_format($item['debt_amount_paid'], 2); ?></td>
	<?php 
		$row_balance = $item['debt_amount_unpaid'] - $item['debt_amount_paid'];
		$balance += $row_balance;
		//$row_balance += $item['debt_amount_unpaid'] - $item['debt_amount_paid'];
	?>
	<td class="text-right" style="width: 14%"><?php echo number_format($balance, 2) ?></td>	
	</tr>
	<?php
	}
	?>	
	<tr><td colspan="5" class="text-right">AMOUNT: </td><td class="text-right"><label><?php echo number_format($balance, 2);?></label></td></tr>
		
	<tr class="table_header"><td colspan="7"></td></tr>
</table>
	
	
	<!--h4>Invoice Terms </h4>
	<i><?php echo $debt_details['debt_details']->debt_terms; ?></i>
	<br/><br/-->
	
	<!--table>
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
	</table-->
	
	<!--table width="100%">
	<tr>
		<td width="70%">
		<label class="control-label">This is computer generated document,</label>
		<br/><br/>
		no signature required<br/>
		................................................<br/>
		<i>Authorised Signature</i>				
		</td>
		
		<td width="30%">
			<label class="control-label">Client : <?php echo $debt_details['client_name']; ?></label>
			<br/><br/><br/>
			................................................<br/>
			<i>Signature &amp; Stamp</i>		
		</td>
	</tr>
	</table-->
		
</div>
</div>

