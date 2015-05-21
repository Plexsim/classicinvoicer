 <script type="text/javascript">
	    $(function() {
			$('input:radio[name="receipt_status"]').change(function(){
			$('.loading').fadeIn('slow');
			var status = $(this).val();
			$.post("<?php echo site_url('receipts/ajax_filter_receipts'); ?>", {
                status: status,
            },
            function(data) {
               $('#receipt_table_body').html(data);
			   $('.loading').fadeOut('slow');
            });
				
			});
			
		});
</script>
<div class="loading"></div>
<div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="pull-left">Receipts</h3>
			<a href="<?php echo $this->config->item('nav_base_url'); ?>receipts/newreceipt" class="btn btn-large btn-success pull-right"><i class="fa fa-plus"> New Receipt </i></a>
          </div>
        </div><!-- /.row -->

        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> List of Receipts</h3>
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
					<label class="radio-inline"><input type="radio" name="receipt_status" <?php echo ($status == 'all') ? 'checked' : ''; ?> id="allreceipts" value="all"> All receipts</label>
					<label class="radio-inline"><input type="radio" name="receipt_status" <?php echo ($status == 'paid') ? 'checked' : ''; ?> id="paidreceipts" value="paid"> Paid</label>
					<label class="radio-inline"><input type="radio" name="receipt_status" <?php echo ($status == 'unpaid') ? 'checked' : ''; ?> id="unpaidreceipts" value="unpaid"> Unpaid</label>
					<label class="radio-inline"><input type="radio" name="receipt_status" <?php echo ($status == 'cancelled') ? 'checked' : ''; ?> id="cancelledreceipts" value="cancelled"> Cancelled</label>
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
                        <th>Receipt No.</i></th>
                        <th>Date Issued</th>
						<th>Client Name</th>
                        <th class="text-right">Amount </th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody id="receipt_table_body">
					<?php
					if( isset($receipts) && !empty($receipts))
					{
						foreach ($receipts as $count => $receipt)
						{
						?>
						<tr>
						<td><?php echo status_label($receipt['receipt_status']);?></td>
                        <td><a href="<?php echo site_url('receipts/edit/'.$receipt['receipt_id']);?>"><?php echo $receipt['receipt_number']; ?></a></td>
                        <td><?php echo format_date($receipt['receipt_date_created']); ?></td>
                        <td><a href="<?php echo site_url('clients/editclient/'.$receipt['client_id']); ?>"><?php echo ucwords($receipt['client_name']); ?></a></td>
                        <td class="text-right invoice_amt"><?php echo format_amount($receipt['receipt_amount']); ?></td>
                        <td style="width:32%">
						<a href="<?php echo site_url('receipts/edit/'.$receipt['receipt_id']);?>" class="btn btn-xs btn-primary"><i class="fa fa-check"> Edit </i></a>
						<!--a href="javascript:;" class="btn btn-info btn-xs" onclick="viewreceipt('<?php echo $receipt['receipt_id']; ?>')"><i class="fa fa-search"> Preview </i></a-->
						<!--a href="<?php echo site_url('receipts/viewpdf/'.$receipt['receipt_id']);?>" class="btn btn-warning btn-xs">Download pdf </a-->												
						<a href="javascript: void(0);" onclick="javascript: ajax_print_receipt('<?php echo $receipt['receipt_id']?>');" class="btn btn-warning pull-xs" id="bttn_print_receipt">Download as PDF</a>
						</td>
						</tr>
						<?php
						}
					}
					else
					{
					?>
					<tr class="no-cell-border">
					<td> There are no receipts available at the moment.</td>
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