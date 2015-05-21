 <div class="loading"></div>
<div class="row">
	<div class="col-lg-12">
		<div class="well invoice_menu navbar navbar-fixed-top">
			<a href="javascript: void(0);" onclick="javascript: ajax_save_receipt();" class="btn btn-large btn-success pull-right" id="bttn_save_receipt"><i class="fa fa-check"></i>Save Receipt</a>
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
							  <input type="hidden" id="receipt_status" name="receipt_status" value="unpaid"/>
							  <input type="hidden" name="save_type" value="new" id="save_type" />

								<div class="form-group">
									 <label>Receipt Number </label>
									 <input type="text" id="receipt_number" class="form-control" name="receipt_number" value="<?php echo $receipt_number; ?>"/>
								</div>

								<div class="form-group">
								<label>Client </label>
								<select name="client_to_receipt" id="client_to_receipt" class="form-control"><?php echo $clients; ?></select>
								</div>
								
								<label>Receipt Date </label>
								<div class="form-group input-group" style="margin-left:0;">
								   <input class="date form-control" size="16" type="text" name="receipt_date" id="receipt_date"/>
								   <span class="input-group-addon add-on"><i class="fa fa-calendar" style="display: inline"></i></span>
								</div>	
								
								<div class="form-group">
									<label>Amount </label>
									<input class="form-control" name="receipt_amount" id="receipt_amount" value=""/>
								</div>
								
								<div class="form-group">
									<label> Receipt Description </label>
									<textarea name="receipt_terms" class="form-control" id="receipt_terms"></textarea>
								</div>
								<input type="hidden" name="receipt_id" value="" id="receipt_id">																							
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