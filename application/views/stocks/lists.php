 <script type="text/javascript">
	    $(function() {
			$('input:radio[name="stock_status"]').change(function(){
			$('.loading').fadeIn('slow');
			var status = $(this).val();
			$.post("<?php echo site_url('stock/ajax_filter_stocks'); ?>", {
                status: status,
            },
            function(data) {
               $('#invoice_table_body').html(data);
			   $('.loading').fadeOut('slow');
            });
				
			});
			
		});
</script>
<div class="loading"></div>
<div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="pull-left">Stocks</h3>
			<a href="<?php echo $this->config->item('nav_base_url'); ?>stock/newstock" class="btn btn-large btn-success pull-right"><i class="fa fa-plus"> New Stock </i></a>
          </div>
        </div><!-- /.row -->

        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> List of Stocks</h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
				<?php
				if($this->session->flashdata('success')){
				?>
				<div class="alert alert-dismissable alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Success !</strong> <?php echo $this->session->flashdata('success');?>
				</div>
				<?php
				}
				?>
				<div class="well" style="background-color: #d9edf7;border-color: #bce8f1;color: #31708f;">
					<div class="form-group" style="margin-bottom:0px">
					<label> Filter : </label> &nbsp;&nbsp;
					<label class="radio-inline"><input type="radio" name="stock_status" <?php echo ($status == 'all') ? 'checked' : ''; ?> id="allstocks" value="all"> All</label>
					<label class="radio-inline"><input type="radio" name="stock_status" <?php echo ($status == 'stock_in') ? 'checked' : ''; ?> id="instocks" value="stock_in"> Stock In</label>
					<label class="radio-inline"><input type="radio" name="stock_status" <?php echo ($status == 'stock_out') ? 'checked' : ''; ?> id="outstocks" value="stock_out"> Stock Out</label>					
					</div>
				</div>
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
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.row -->
</div><!-- /#page-wrapper -->