 <?php
	if( isset($debt) && !empty($debt))
	{
?>
		<?php if(!empty($debt['from_date']) && !empty($debt['to_date']) && !empty($debt['client_id'])){?>
			<tr>
				<td colspan=7><center><a href="<?php echo site_url('debt/viewpdf/'.$debt['from_date'].'/'.$debt['to_date'].'/'.$debt['client_id']);?>" class="btn btn-danger btn-large">Download statement</a></center></td>
			</tr>
		<?php }?>
		
<?php		
		foreach ($debt['debt_details'] as $count => $debt)
		{
		
		?>
		<tr>				
		<td style="width:20%"><?php echo format_date($debt['debt_date_created']); ?></td>
		<td><?php echo $debt['debt_reference']; ?></td>
        <td><?php echo $debt['debt_description']; ?></td>
		<td><a href="<?php echo site_url('clients/editclient/'.$debt['client_id']); ?>"><?php echo ucwords($debt['client_name']); ?></a></td>
		<td class="text-right invoice_amt"><?php echo format_amount($debt['debt_amount_unpaid']); ?></td>
        <td class="text-right invoice_amt"><?php echo format_amount($debt['debt_amount_paid']); ?></td>
        <td>
		<a href="<?php echo site_url('debt/edit/'.$debt['debt_id']);?>" class="btn btn-xs btn-primary"><i class="fa fa-check"> Edit </i></a>
		<!--a href="javascript:;" class="btn btn-info btn-xs" onclick="viewInvoice('<?php echo $debt['debt_id']; ?>')"><i class="fa fa-search"> Preview </i></a-->
		<!--a href="<?php echo site_url('debt/viewpdf/'.$debt['debt_id']);?>" class="btn btn-warning btn-xs">Download pdf </a-->
		</td>
		</tr>
		<?php
		}
	}
	else
	{
	?>
	<tr class="no-cell-border">
	<td colspan="7"> There are no <?php echo $status; ?> debt at the moment.</td>
	</tr>
	<?php
	}
	?>