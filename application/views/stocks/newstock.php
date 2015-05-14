 <script type="text/javascript">
	    $(function() {
        <?php if (!isset($items)) { ?>
            $('#new_item').clone().appendTo('#item_table').removeAttr('id').addClass('item').show();
        <?php } ?>
		});
 </script>
 <div class="loading"></div>
<div class="row">
	<div class="col-lg-12">
		<div class="well invoice_menu navbar navbar-fixed-top">
			<!--a href="javascript: void(0);" class="btn btn-large btn-primary" id="bttn_add_item"><i class="fa fa-plus"></i> Add Item</a>
			<a href="javascript: void(0);" class="btn btn-large btn-info" id="bttn_add_tax_product"><i class="fa fa-plus"></i> Add Item From Products</a-->
			<a href="javascript: void(0);" onclick="javascript: ajax_save_stock();" class="btn btn-large btn-success pull-right" id="bttn_save_invoice"><i class="fa fa-check"></i> Save Stock Record</a>
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
              	<h1>Stock Form</h1>
                <div class="table-responsive">
					<div class="row">
						<div class="col-lg-6">
							<div class="panel panel-default col-lg-10">
							  <div class="panel-body">
							  <!--input type="hidden" id="stock_status" name="stock_status" value="unpaid"/-->
							  <input type="hidden" name="save_type" value="new" id="save_type" />

							  <div class="form-group">
								<label>Stock Number </label>
								 <input type="text" id="stock_number" class="form-control" name="stock_number" value="<?php echo $stock_number; ?>"/>
							  </div>

								
								<label>Stock Date </label>
								<div class="form-group input-group" style="margin-left:0;">
								   <input class="date form-control" size="16" type="text" name="stock_date" id="stock_date"/>
									<span class="input-group-addon add-on"><i class="fa fa-calendar" style="display: inline"></i></span>
								</div>
								
								<label>Stock Amount</label>
								<div class="form-group input-group" style="margin-left:0;">
								   <input class="form-control text-right" name="stock_amount" id="stock_amount" value=""/>
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
									<option value="STOCK_IN"> STOCK IN </option>
									<option value="STOCK_OUT"> STOCK OUT </option>
									</select>
								</div>
							  </div>							  
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-12">
							<div class="table-responsive">
							  <div class="form-group">
							  <h4> Stock Terms </h4> 
								<textarea name="stock_terms" class="form-control" id="stock_terms"></textarea>
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