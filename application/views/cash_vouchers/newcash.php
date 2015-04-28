 <div class="loading"></div>
<div class="row">
	<div class="col-lg-12">
		<div class="well invoice_menu navbar navbar-fixed-top">
			<a href="javascript: void(0);" onclick="javascript: ajax_save_cash_voucher();" class="btn btn-large btn-success pull-right" id="bttn_save_cash"><i class="fa fa-check"></i>Save Cash Voucher</a>
		</div>
	</div>
</div>

 <div id="page-wrapper">
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
          <div class="col-lg-12">
            <div class="panel panel-primary" style="margin-top:70px">
              <div class="panel-body">
                <div class="table-responsive">
					<div class="row">
						<div class="col-lg-6">
							<div class="panel panel-default col-lg-10">
							  <div class="panel-body">
							  <input type="hidden" id="cash_status" name="cash_status" value="unpaid"/>
							  <input type="hidden" name="save_type" value="new" id="save_type" />

								<div class="form-group">
									 <label>Cash Voucher Number </label>
									 <input type="text" id="cash_number" class="form-control" name="cash_number" value="<?php echo $cash_number; ?>"/>
								</div>

								<div class="form-group">
								<label>Staff </label>
								<select name="staff_to_cash" id="staff_to_cash" class="form-control"><?php echo $staffs; ?></select>
								</div>
								
								<label>Cash Date </label>
								<div class="form-group input-group" style="margin-left:0;">
								   <input class="date form-control" size="16" type="text" name="cash_date" id="cash_date"/>
								   <span class="input-group-addon add-on"><i class="fa fa-calendar" style="display: inline"></i></span>
								</div>	
								
								<div class="form-group">
									<label>Amount </label>
									<input class="form-control" name="cash_amount" id="cash_amount" value=""/>
								</div>
								
								<div class="form-group">
									<label> Cash Voucher Description </label>
									<textarea name="cash_terms" class="form-control" id="cash_terms"></textarea>
								</div>
								<input type="hidden" name="cash_id" value="" id="cash_id">																							
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

$('#cash_date').datepicker({dateFormat:'dd-mm-yy', altField: '#date_alt', altFormat: 'yy-mm-dd'});

//$('#select_dateto').datepicker({dateFormat:'dd-mm-yy', altField: '#date_to_alt', altFormat: 'yy-mm-dd'});

</script>