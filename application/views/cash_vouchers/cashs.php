 <script type="text/javascript">
	    $(function() {
			$('input:radio[name="cash_status"]').change(function(){
			$('.loading').fadeIn('slow');
			var status = $(this).val();
			$.post("<?php echo site_url('cash_vouchers/ajax_filter_cashs'); ?>", {
                status: status,
            },
            function(data) {
               $('#cash_table_body').html(data);
			   $('.loading').fadeOut('slow');
            });
				
			});
			
		});
</script>
<div class="loading"></div>
<div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="pull-left">Cash Vouchers</h3>
			<a href="<?php echo $this->config->item('nav_base_url'); ?>cash_vouchers/newcash" class="btn btn-large btn-success pull-right"><i class="fa fa-plus"> New Cash Voucher </i></a>
          </div>
        </div><!-- /.row -->

        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> List of Cash Vouchers</h3>
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
					<label class="radio-inline"><input type="radio" name="cash_status" <?php echo ($status == 'all') ? 'checked' : ''; ?> id="allcashs" value="all"> All Cashs</label>
					<label class="radio-inline"><input type="radio" name="cash_status" <?php echo ($status == 'paid') ? 'checked' : ''; ?> id="paidcashs" value="paid"> Paid</label>
					<label class="radio-inline"><input type="radio" name="cash_status" <?php echo ($status == 'unpaid') ? 'checked' : ''; ?> id="unpaidcashs" value="unpaid"> Unpaid</label>
					<label class="radio-inline"><input type="radio" name="cash_status" <?php echo ($status == 'cancelled') ? 'checked' : ''; ?> id="cancelledcashs" value="cancelled"> Cancelled</label>
					</div>
				</div>
				
				<div class="well" style="background-color: #d9edf7;border-color: #bce8f1;color: #31708f;">
										
					<div class="form-group" style="margin-bottom:0px">
					<label> Company : </label> &nbsp;&nbsp;
					<select class="form-control" name="company" id="company">
						<option value="nick_fertilizer"> Nick Fertilizer </option>
						<option value="home_grown"> Home Grown </option>						
					</select>
					</div>
					
				</div>
				
				
                  <table class="table table-bordered table-striped tablesorter">
                    <thead>
                      <tr class="table_header">
						<th>Status</th>
                        <th>Cash No.</i></th>
                        <th>Date Issued</th>
						<th>Staff Name</th>
                        <th class="text-right">Amount </th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody id="cash_table_body">
					<?php
					if( isset($cashs) && !empty($cashs))
					{
						foreach ($cashs as $count => $cash)
						{
						?>
						<tr>
						<td><?php echo status_label($cash['cash_status']);?></td>
                        <td><a href="<?php echo site_url('cash_vouchers/edit/'.$cash['cash_id']);?>"><?php echo $cash['cash_number']; ?></a></td>
                        <td><?php echo format_date($cash['cash_date_created']); ?></td>
                        <td><a href="<?php echo site_url('clients/editclient/'.$cash['staff_id']); ?>"><?php echo ucwords($cash['staff_name']); ?></a></td>
                        <td class="text-right invoice_amt"><?php echo format_amount($cash['cash_amount']); ?></td>
                        <td style="width:32%">
						<a href="<?php echo site_url('cash_vouchers/edit/'.$cash['cash_id']);?>" class="btn btn-xs btn-primary"><i class="fa fa-check"> Edit </i></a>
						<!--a href="javascript:;" class="btn btn-info btn-xs" onclick="viewCash('<?php echo $cash['cash_id']; ?>')"><i class="fa fa-search"> Preview </i></a-->
						<!--a href="<?php echo site_url('cash_vouchers/viewpdf/'.$cash['cash_id']);?>" class="btn btn-warning btn-xs">Download pdf </a-->												
						<a href="javascript: void(0);" onclick="javascript: ajax_print_cash_voucher('<?php echo $cash['cash_id']?>');" class="btn btn-warning pull-xs" id="bttn_print_cash">Download as PDF</a>
						</td>
						</tr>
						<?php
						}
					}
					else
					{
					?>
					<tr class="no-cell-border">
					<td> There are no cashs available at the moment.</td>
					<td></td>
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