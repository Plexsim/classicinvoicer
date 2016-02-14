<div class="loading"></div>
<div class="row">
	<div class="col-lg-12">
		<div class="well invoice_menu navbar navbar-fixed-top">
			<div class="col-lg-6">
			<h3>Add New Debt</h3>
			</div>
			<div class="col-lg-6">
			<a href="javascript: void(0);" onclick="javascript: ajax_save_debt();" class="btn btn-large btn-success pull-right" id="bttn_save_debt"><i class="fa fa-check"></i>Save Debt</a>
			</div>
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
							  <input type="hidden" name="save_type" value="new" id="save_type" />
							  <input type="hidden" value="" name="search_from_date" id="search_from_date">
							  <input type="hidden" value="" name="search_to_date" id="search_to_date">					
							  <input type="hidden" value="" name="search_client_id" id="search_client_id">
							  <input type="hidden" value="all" name="search_status" id="search_status">
								

								<div class="form-group">								
								<label>Client </label>
								<select name="debt_client" id="client_to_debt" class="form-control"><?php echo $clients; ?></select>
								</div>
								
								<label>Debt Date </label>
								<div class="form-group input-group" style="margin-left:0;">
								   <input class="date form-control" size="16" type="text" name="debt_date" id="debt_date"/>
								   <span class="input-group-addon add-on"><i class="fa fa-calendar" style="display: inline"></i></span>
								</div>
								
								<label>Adjustment </label>
									<select class="form-control" name="debt_status" id="debt_status">
									<option value="unpaid"> UNPAID </option>									
									<option value="paid"> PAID </option>
									<!--option value="cancelled"> CANCELLED </option-->
									</select>
								
								<div class="form-group">
								<label>Amount </label>
								<input class="form-control" name="debt_amount" id="debt_amount" value=""/>
								</div>
								
								<div class="form-group">
								<label>Debt Description </label>
								<textarea name="debt_description" class="form-control" id="debt_description"></textarea>
								</div>
									
									
								</div>	

							  
								<input type="hidden" name="debt_id" value="" id="debt_id">																							
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

$('#debt_date').datepicker({dateFormat:'dd-mm-yy', altField: '#date_alt', altFormat: 'yy-mm-dd'});

//$('#select_dateto').datepicker({dateFormat:'dd-mm-yy', altField: '#date_to_alt', altFormat: 'yy-mm-dd'});

</script>