 <?php
	if( isset($receipts) && !empty($receipts))
	{
		foreach ($receipts as $count => $receipt)
		{
		
		?>
		<tr>
		<td>
		<?php echo status_label($receipt['receipt_status']);?>
		</td>
		<td><a href="<?php echo site_url('receipts/edit/'.$receipt['receipt_id']);?>"><?php echo $receipt['receipt_number']; ?></a></td>
		<td><?php echo format_date($receipt['receipt_date_created']); ?></td>
		<td><a href="<?php echo site_url('clients/editclient/'.$receipt['client_id']); ?>"><?php echo ucwords($receipt['client_name']); ?></a></td>
		<td class="text-right invoice_amt"><?php echo format_amount($receipt['receipt_amount']); ?></td>
        <td style="width:32%">
		<a href="<?php echo site_url('receipts/edit/'.$receipt['receipt_id']);?>" class="btn btn-xs btn-primary"><i class="fa fa-check"> Edit </i></a>
		<!--a href="javascript:;" class="btn btn-info btn-xs" onclick="viewInvoice('<?php echo $receipt['receipt_id']; ?>')"><i class="fa fa-search"> Preview </i></a-->
		<a href="<?php echo site_url('receipts/viewpdf/'.$receipt['receipt_id']);?>" class="btn btn-warning btn-xs">Download pdf </a>
		</td>
		</tr>
		<?php
		}
	}
	else
	{
	?>
	<tr class="no-cell-border">
	<td colspan="7"> There are no <?php echo $status; ?> receipts at the moment.</td>
	</tr>
	<?php
	}
	?>