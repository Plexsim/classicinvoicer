<?php
	$countries = config_item('country_list');
?>
<script type="text/javascript">
$(function()
{
$('#modal-view-invoice').modal('show');
$('html').click(function() {
    $('#modal-view-invoice').modal('hide');
});
});
</script>
<div class="modal" id="modal-view-invoice" style="width:1000px;left:40%;font-size:11px">
<div class="modal-header">
	<a data-dismiss="modal" class="close">&times;</a>
	<label class="control-ccclabel">Tax Invoice Preview : #<?php echo $invoice_details['invoice_details']->invoice_number; ?> </label>
</div>
<div class="modal-body">
<div class="row">
<div class="col-lg-12">
	<div class="col-lg-6">
		<?php $logo = get_siteconfig('logo');
		if($logo != ''){
		?>
		<img src="<?php echo base_url().UPLOADSDIR.$logo;?>" width="50%"/>
		<?php
		}
		?>
	</div>
	<div class="col-lg-6">
		<h2> Tax Invoice # <?php echo $invoice_details['invoice_details']->invoice_number; ?></h2>
		<p><?php echo get_siteconfig('name'); ?> <span style="font-size:9px;">(<?php echo get_siteconfig('ssm'); ?>)</span></p>
		<p><?php echo get_siteconfig('address'); ?></p>
		<p><b>(GST ID No: <?php echo get_siteconfig('gst'); ?>)</b></p>		
		<p><?php echo get_siteconfig('phone'); ?></p>
		<p><?php echo get_siteconfig('email'); ?></p>
		
	</div>
</div>
</div>
<hr/>
<div class="row">
	<div class="col-lg-12">
	<div class="client-details">
		<div class="row">
			<div class="col-lg-12">
			<span style="font-size:14px;font-weight: bold;">Client : <?php echo $invoice_details['invoice_details']->client_name; ?></span>  <span style="font-size:6px;"><?php echo isset($invoice_details['invoice_details']->client_ssm) && !empty($invoice_details['invoice_details']->client_ssm) ? '<span style="font-size:9px;">('.$invoice_details['invoice_details']->client_ssm.')</span>' : ''; ?></span>	
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<h5>Address&nbsp;&nbsp; : <?php echo $invoice_details['invoice_details']->client_address; ?></h5>
				<h5>Phone &nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $invoice_details['invoice_details']->client_phone; ?></h5>					
				<h5>Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $invoice_details['invoice_details']->client_email; ?></h5>	
				<h5>GST &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo isset($invoice_details['invoice_details']->client_gst) && !empty($invoice_details['invoice_details']->client_gst) ? $invoice_details['invoice_details']->client_gst : '-'; ?></h5>	
			</div>
			<div class="col-lg-6 text-right">
			<h4><label> Total Amount Due </label></h4>
			<h4 class="invoice_amount_due"><label>
			<?php echo format_amount($invoice_details['invoice_totals']['amount_due']); ?>
			</label></h4>
			</div>
		</div>
		</div>
	</div>
</div>
<hr/>
<div class="row">
<div class="col-lg-12">
<table class="table">
	<thead>
	  <tr class="table_header">
		<th>ITEM</th>
		<th>DESCRIPTION</th>
		<!--th>TAX </th-->
		<th>QUANTITY</th>
		<th class="text-right">UNIT PRICE</th>
		<th class="text-right">DISCOUNT</th>
		<th class="text-right">SUB TOTAL</th>
	  </tr>
	</thead>
	<tbody>
	<?php
	foreach ($invoice_details['invoice_items'] as $count=>$item)
	{?>
	<tr class="transaction-row">
	<td><?php echo $item['item_name'];?></td>
	<td style="width: 30%"><?php echo $item['item_description'];?></td>
	<!--td><?php echo ($item['item_taxrate_id'] !=0 ) ? $item['tax_rate_name'].' - '.$item['tax_rate_percent'].'%' : '0.00%';?></td-->
	<td><?php echo $item['item_quantity'];?></td>
	<td class="text-right" style="width: 10%"><?php echo format_amount($item['item_price']); ?></td>
	<td class="text-right" style="width: 10%"><?php echo format_amount($item['item_discount']); ?></td>
	<td class="text-right" style="width: 10%"><?php echo format_amount($item['item_price']*$item['item_quantity']-$item['item_discount']); ?></td>
	</tr>
	<?php
	}
	?>
	<tr><td colspan="5" class="text-right">ITEMS TOTAL COST : </td><td class="text-right"><label><?php echo format_amount($invoice_details['invoice_totals']['item_total']);?></label></td></tr>
	<tr><td colspan="5" class="text-right no-border">INVOICE DISCOUNT : </td><td class="text-right no-border"><label><?php echo format_amount($invoice_details['invoice_details']->invoice_discount);?></label></td></tr>
	<tr><td colspan="5" class="text-right no-border">TOTAL BEFORE @ 6% : </td><td class="text-right"><label><?php echo format_amount($invoice_details['invoice_totals']['item_total'] - $invoice_details['invoice_details']->invoice_discount);?></label></td></tr>		
	<tr><td colspan="5" class="text-right no-border">ADD GST @ 6% : </td><td class="text-right no-border"><label><?php echo format_amount($invoice_details['invoice_totals']['tax_total']);?></label></td></tr>	
	<tr><td colspan="5" class="text-right no-border">TOTAL SALES : </td><td class="text-right invoice_amount_due"><label><?php echo format_amount($invoice_details['invoice_totals']['item_total'] - $invoice_details['invoice_details']->invoice_discount + $invoice_details['invoice_totals']['tax_total'] );?></label></td></tr>	
	</tr>
<tr class="table_header"><td colspan="6"></td></tr>
<tr><td colspan="6">
<h4>Invoice Terms </h4>
<?php echo $invoice_details['invoice_details']->invoice_terms; ?>
<hr/>
</td></tr>
</div>
</div>
</div>
</div>

<style>
.client-details {
border: 1px dotted #CCC;
font-size: 12px;
background-color: #d9edf7;
padding: 10px 15px;
}
</style>
