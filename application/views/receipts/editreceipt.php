 <div class="loading"></div>
<div class="row">
	<div class="col-lg-12">
		<div class="well invoice_menu navbar navbar-fixed-top">
			<a href="javascript: void(0);" onclick="delete_receipt('<?php echo $receipt_details->receipt_id; ?>');" class="btn btn-large btn-danger pull-right" id="bttn_delete_receipt" ><i class="fa fa-times"></i> Delete Receipt</a> 
			<a href="javascript: void(0);" onclick="javascript: ajax_save_receipt();" class="btn btn-large btn-success pull-right"  style="margin-right:10px" id="bttn_save_receipt"><i class="fa fa-check"></i> Save Changes</a>			
		</div>
	</div>
</div>
 <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-primary" style="margin-top:70px">
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
					<div class="row">
						<div class="col-lg-6">
						<h3> Receipt Number : # <?php echo $receipt_details->receipt_number; ?> </h3>
							<div class="panel panel-default col-lg-10">
							  <div class="panel-body">
							  	<input type="hidden" name="save_type" value="edit" id="save_type" />
							  	<div class="form-group">
								<label>Receipt Number </label>
								 <input type="text" id="receipt_number" class="form-control" name="receipt_number" value="<?php echo $receipt_details->receipt_number; ?>"/>
								</div>

								<div class="form-group">
								<label>Client </label>
									<select name="client_to_receipt" id="client_to_receipt" class="form-control"><?php echo $clients; ?></select>
								</div>
								
								<label>Receipt Date </label>
								<div class="form-group input-group" style="margin-left:0;">
								   <input class="form-control" size="16" type="text" value="<?php echo (isset($receipt_details->receipt_date_created)) ?  date('d-m-Y', strtotime($receipt_details->receipt_date_created)) : ''; ?>" name="receipt_date" id="receipt_date"/>
								   <span class="input-group-addon add-on"><i class="fa fa-calendar" style="display: inline"></i></span>
								   <input id="date_alt" type="hidden" name="issue_date" />
								</div>
								
								<div class="form-group">
									<label>Amount </label>
									<input class="form-control" name="receipt_amount" id="receipt_amount" value="<?php echo $receipt_details->receipt_amount; ?>"/>
								</div>
								
								  <div class="form-group">
								  <h4>Receipt Description </h4> 
									<textarea name="receipt_terms" class="form-control" id="receipt_terms"><?php echo $receipt_details->receipt_terms; ?></textarea>
								  </div>
								
								  <input type="hidden" name="receipt_id" value="<?php echo $receipt_details->receipt_id; ?>" id="receipt_id">
								
								<!--div class="form-group">
									<a href="javascript: void(0);" onclick="emailclient('<?php echo $receipt_details->receipt_id; ?>')" class="btn btn-large btn-success pull-right"  style="margin-right:10px"><i class="fa fa-envelope"></i> Email Receipt to Client </a>
								</div-->
							  </div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="panel-default col-lg-12">
							<div class="panel-body">
							  	<?php echo invoice_status($receipt_details->receipt_status); ?>
								<div style="clear: both"></div>
								<div class="form-group invoice_change_status pull-right">
								<label>Change Status : </label>
									<select class="form-control" name="receipt_status" id="receipt_status">
									<option value="paid" <?php echo ($receipt_details->receipt_status == 'PAID') ? 'selected' : ''; ?>> PAID </option>
									<option value="unpaid" <?php echo ($receipt_details->receipt_status == 'UNPAID') ? 'selected' : ''; ?>> UNPAID </option>
									<option value="cancelled" <?php echo ($receipt_details->receipt_status == 'CANCELLED') ? 'selected' : ''; ?>> CANCELLED </option>
									</select>
								</div>
							  </div>
							  <div class="invoice_actions pull-right">
							  <!--div class="form-group">
							  	<a href="javascript: void(0);" class="btn btn-large btn-info" id="bttn_view_pdf" onclick="viewReceipt('<?php echo $receipt_details->receipt_id; ?>')"><i class="fa fa-search"></i> Preview Receipt </a>
							  </div-->
							
							  </div>
							</div>
						</div>
						
					</div>
					
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.row -->
</div><!-- /#page-wrapper -->
			
<script>

$('#receipt_date').datepicker({dateFormat:'dd-mm-yy', altField: '#date_alt', altFormat: 'yy-mm-dd'});

//$('#select_dateto').datepicker({dateFormat:'dd-mm-yy', altField: '#date_to_alt', altFormat: 'yy-mm-dd'});

</script>