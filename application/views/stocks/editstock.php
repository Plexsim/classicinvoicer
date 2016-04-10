 <div class="loading"></div>
<div class="row">
	<div class="col-lg-12">
		<div class="well stock_menu navbar navbar-fixed-top">
			<a href="javascript: void(0);" class="btn btn-large btn-primary" id="bttn_add_item"><i class="fa fa-plus"></i> Add Item</a>
			<a href="javascript: void(0);" class="btn btn-large btn-info" id="bttn_add_tax_product"><i class="fa fa-plus"></i> Add Item From Products</a>
			<a href="javascript: void(0);" onclick="delete_stock('<?php echo $stock_details->stock_id; ?>');" class="btn btn-large btn-danger pull-right" id="bttn_delete_invoice" ><i class="fa fa-times"></i> Delete Stock</a> 
			<a href="javascript: void(0);" onclick="javascript: ajax_save_stock();" class="btn btn-large btn-success pull-right"  style="margin-right:10px" id="bttn_save_invoice"><i class="fa fa-check"></i> Save Changes</a>
			
		</div>
	</div>
</div>
 <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-primary" style="margin-top:70px">
              <div class="panel-body">
              	<h1>Edit Stock Form</h1>
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
						<h3> Stock Number : # <?php echo $stock_details->stock_number; ?> </h3>
							<div class="panel panel-default col-lg-10">
							  <div class="panel-body">
							  	<input type="hidden" name="save_type" value="edit" id="save_type" />
							  	<div class="form-group">
								<label>Stock Number </label>
								 <input type="text" id="stock_number" class="form-control" name="stock_number" value="<?php echo $stock_details->stock_number; ?>"/>
								</div>
							
								<label>Stock Date </label>
								<div class="form-group input-group" style="margin-left:0;">
								   <input class="form-control" size="16" type="text" value="<?php echo (isset($stock_details->stock_date_created)) ?  date('d-m-Y', strtotime($stock_details->stock_date_created)) : ''; ?>" name="stock_date" id="stock_date"/>
								   <span class="input-group-addon add-on"><i class="fa fa-calendar" style="display: inline"></i></span>
								   <input id="date_alt" type="hidden" name="issue_date" />
								</div>

								<div class="form-group">
								<label>Supplier </label>
								<select name="supplier" id="supplier" class="form-control"><?php echo $suppliers; ?></select>
								</div>
								
								<label>Stock Amount</label>
								<div class="form-group input-group" style="margin-left:0;">
								   <input class="form-control text-right" name="stock_amount" id="stock_amount" value="<?php echo $stock_details->stock_amount; ?>"/>
								</div>
								
								<!--label>Stock Due Date </label>
								<div class="form-group input-group date" style="margin-left:0;">
								   <input class="form-control" size="16" type="text" name="stock_due_date" value="<?php echo (isset($stock_details->stock_due_date)) ? date('d-m-Y', strtotime($stock_details->stock_due_date)) : ''; ?>" readonly id="stock_due_date" />
									<span class="input-group-addon add-on"><i class="fa fa-calendar" style="display: inline"></i></span>
								</div-->
								<div class="form-group">
								<a href="javascript: void(0);" onclick="emailtaxclient('<?php echo $stock_details->stock_id; ?>')" class="btn btn-large btn-success pull-right"  style="margin-right:10px"><i class="fa fa-envelope"></i> Email Stock to Client </a>
								</div>
							  </div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="panel-default col-lg-12">
							<div class="panel-body">
								<div style="clear: both"></div>
								<div class="form-group stock_change_status pull-right">
								<label>Change Status : </label>
									<select class="form-control" name="stock_status" id="stock_status">
									<option value="STOCK_IN" <?php echo ($stock_details->stock_status == 'STOCK_IN') ? 'selected' : ''; ?>> STOCK IN </option>
									<option value="STOCK_OUT" <?php echo ($stock_details->stock_status == 'STOCK_OUT') ? 'selected' : ''; ?>> STOCK OUT </option>
									<option value="OTHER_IN" <?php echo ($stock_details->stock_status == 'OTHER_IN') ? 'selected' : ''; ?>> OTHER IN </option>
									<option value="OTHER_OUT" <?php echo ($stock_details->stock_status == 'OTHER_OUT') ? 'selected' : ''; ?>> OTHER OUT </option>
									</select>
								</div>
							  </div>							  
							</div>
						</div>
						
					</div>
		<div class="row">
			<input type="hidden" name="stock_id" value="<?php echo $stock_details->stock_id; ?>" id="stock_id">
			<div class="col-lg-12">				
			<div class="table-responsive">			
              			  			   
			  <div class="form-group">
			  <h4> Stock Terms </h4> 
				<textarea name="stock_terms" class="form-control" id="stock_terms"><?php echo $stock_details->stock_terms; ?></textarea>
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

$('#stock_date').datepicker({dateFormat:'dd-mm-yy', altField: '#date_alt', altFormat: 'yy-mm-dd'});

//$('#select_dateto').datepicker({dateFormat:'dd-mm-yy', altField: '#date_to_alt', altFormat: 'yy-mm-dd'});

</script>