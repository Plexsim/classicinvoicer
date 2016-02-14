 <div class="loading"></div>
<div class="row">
	<div class="col-lg-12">
		<div class="well invoice_menu navbar navbar-fixed-top">		
		<div class="col-lg-6">
			<h3>Edit Debt</h3>
		</div>
		<div class="col-lg-6">
			<a href="javascript: void(0);" onclick="delete_debt('<?php echo $debt_details->debt_id; ?>');" class="btn btn-large btn-danger pull-right" id="bttn_delete_debt" ><i class="fa fa-times"></i> Delete Debt</a> 
			<a href="javascript: void(0);" onclick="javascript: ajax_save_debt();" class="btn btn-large btn-success pull-right"  style="margin-right:10px" id="bttn_save_debt"><i class="fa fa-check"></i> Save Changes</a>
		</div>								
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
							<div class="panel panel-default col-lg-10">
							  <div class="panel-body">
							  	<input type="hidden" name="save_type" value="edit" id="save_type" />
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
								   <input class="form-control" size="16" type="text" value="<?php echo (isset($debt_details->debt_date_created)) ?  date('d-m-Y', strtotime($debt_details->debt_date_created)) : ''; ?>" name="debt_date" id="debt_date"/>
								   <span class="input-group-addon add-on"><i class="fa fa-calendar" style="display: inline"></i></span>
								   <input id="date_alt" type="hidden" name="issue_date" />
								</div>
								
								<label>Adjustment :</label>
									<select class="form-control" name="debt_status" id="debt_status">
									<option value="unpaid" <?php echo $debt_details->debt_status == 'UNPAID' ? 'selected' : '' ?>> UNPAID </option>									
									<option value="paid" <?php echo $debt_details->debt_status == 'PAID' ? 'selected' : ''?> > PAID </option>
									<!--option value="cancelled"> CANCELLED </option-->
									</select>
									
								<div class="form-group">
									<label>Amount </label>
									<input class="form-control" name="debt_amount" id="debt_amount" value="<?php echo $debt_details->debt_status == 'UNPAID' ? $debt_details->debt_amount_unpaid : $debt_details->debt_amount_paid; ?>"/>
								</div>
								
								  <div class="form-group">
								  <h4>Debt Description </h4> 
									<textarea name="debt_description" class="form-control" id="debt_description"><?php echo $debt_details->debt_description; ?></textarea>
								  </div>	
									
								</div>	
								
								
								
								  <input type="hidden" name="debt_id" value="<?php echo $debt_details->debt_id; ?>" id="debt_id">
								
								<!--div class="form-group">
									<a href="javascript: void(0);" onclick="emailclient('<?php echo $debt_details->debt_id; ?>')" class="btn btn-large btn-success pull-right"  style="margin-right:10px"><i class="fa fa-envelope"></i> Email Debt to Client </a>
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

$('#debt_date').datepicker({dateFormat:'dd-mm-yy', altField: '#date_alt', altFormat: 'yy-mm-dd'});

//$('#select_dateto').datepicker({dateFormat:'dd-mm-yy', altField: '#date_to_alt', altFormat: 'yy-mm-dd'});

</script>