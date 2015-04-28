 <?php
	if( isset($cashs) && !empty($cashs))
	{
		foreach ($cashs as $count => $cash)
		{
		
		?>
		<tr>
		<td>
		<?php echo status_label($cash['cash_status']);?>
		</td>
		<td><a href="<?php echo site_url('cash_vouchers/edit/'.$cash['cash_id']);?>"><?php echo $cash['cash_number']; ?></a></td>
		<td><?php echo format_date($cash['cash_date_created']); ?></td>
		<td><a href="<?php echo site_url('staffs/editstaff/'.$cash['staff_id']); ?>"><?php echo ucwords($cash['staff_name']); ?></a></td>
		<td class="text-right invoice_amt"><?php echo format_amount($cash['cash_amount']); ?></td>
        <td style="width:32%">
		<a href="<?php echo site_url('cash_vouchers/edit/'.$cash['cash_id']);?>" class="btn btn-xs btn-primary"><i class="fa fa-check"> Edit </i></a>
		<!--a href="javascript:;" class="btn btn-info btn-xs" onclick="viewInvoice('<?php echo $cash['cash_id']; ?>')"><i class="fa fa-search"> Preview </i></a-->
		<a href="<?php echo site_url('cash_vouchers/viewpdf/'.$cash['cash_id']);?>" class="btn btn-warning btn-xs">Download pdf </a>
		</td>
		</tr>
		<?php
		}
	}
	else
	{
	?>
	<tr class="no-cell-border">
	<td colspan="7"> There are no <?php echo $status; ?> cash vouchers at the moment.</td>
	</tr>
	<?php
	}
	?>