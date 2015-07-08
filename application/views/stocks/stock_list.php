<table class="table table-bordered table-striped tablesorter">
      <thead>
                      <tr class="table_header">
						<th>Status</th>
                        <th>Stock No.</i></th>
                        <th>Date Created</i></th>
                        <th class="text-right">Amount </th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody id="invoice_table_body">
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
	<td><?php echo stock_status_label($stock['stock_status']);?></td>
                        <td><a href="<?php echo site_url('stock/edit/'.$stock['stock_id']);?>"><?php echo $stock['stock_number']; ?></a></td>
                        <td><?php echo format_date($stock['stock_date_created']); ?></td>
                        <td class="text-right invoice_amt"><?php echo format_amount($stock['stock_amount']); ?></td>
                        <td style="width:32%">
	<a href="<?php echo site_url('stock/edit/'.$stock['stock_id']);?>" class="btn btn-xs btn-primary"><i class="fa fa-check"> Edit </i></a>
	</td>
	</tr>						
	<?php
	}?>
	
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
<td> There are no stocks available at the moment.</td>
<td></td>
<td></td>
<td></td>
<td></td>

</tr>
<?php
}
?>
    </tbody>
</table>

