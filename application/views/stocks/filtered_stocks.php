 <?php
	if( isset($stocks) && !empty($stocks))
	{
		$total_amount = 0;
		foreach ($stocks as $count => $stock)
		{
			if($stock['stock_status'] == 'STOCK_IN')
				$total_amount += $stock['stock_amount'];
			else
				$total_amount -= $stock['stock_amount'];
		?>
		<tr>
		<td>
		<?php echo stock_status_label($stock['stock_status']);?>
		</td>
		<td><a href="<?php echo site_url('stocks/edit/'.$stock['stock_id']);?>"><?php echo $stock['stock_number']; ?></a></td>
		<td><?php echo format_date($stock['stock_date_created']); ?></td>
		<td class="text-right stock_amt"><?php echo format_amount($stock['stock_amount']); ?></td>
        <td style="width:32%">
		<a href="<?php echo site_url('stocks/edit/'.$stock['stock_id']);?>" class="btn btn-xs btn-primary"><i class="fa fa-check"> Edit </i></a>
		</td>
		</tr>
		<?php
		}
		?>		
		<tr class="no-cell-border">
			<td></td>
			<td></td>
			<td class="text-right invoice_amt">TOTAL:</td>
			<td class="text-right invoice_amt"><?php echo format_amount($total_amount)?></td>
			<td></td>
		</tr>		
	<?php 	
	}
	else
	{
	?>
	<tr class="no-cell-border">
	<td colspan="7"> There are no <?php echo $status; ?> tax stocks at the moment.</td>
	</tr>
	<?php
	}
	?>