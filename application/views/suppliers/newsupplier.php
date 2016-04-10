      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h3 class="pull-left">Create Supplier</h3>
			<a href="<?php echo site_url('suppliers'); ?>" class="btn btn-large btn-success pull-right"><i class="fa fa-chevron-left"> Back to Suppliers List </i></a>
          </div>
        </div><!-- /.row -->

        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> Create a new supplier </h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
           <div class="col-lg-6"> 
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
			<form role="form" method="POST" action="<?php echo site_url('suppliers/createsupplier'); ?>">
              <div class="form-group">
                <label>Supplier Name</label>
                <input class="form-control" name="supplier_name" value="<?php echo set_value('supplier_name');?>"/>
				<?php echo form_error('supplier_name'); ?>
              </div>
              
        <div class="form-group">
                <label>Supplier SSM</label>
                <input class="form-control" name="supplier_ssm" value="<?php echo set_value('supplier_ssm');?>"/>
				<?php echo form_error('supplier_ssm'); ?>
         </div>      

        <div class="form-group">
          <label>Supplier Address</label>
          <input class="form-control" name="supplier_address" value="<?php echo set_value('supplier_address');?>"/>
	        <?php echo form_error('supplier_address'); ?>
        </div>

         <div class="form-group">
            <label>Postal / Zip Code</label>
            <input class="form-control" name="supplier_postalcode" value="<?php echo set_value('supplier_postalcode');?>"/>
            <?php echo form_error('supplier_postalcode'); ?>
          </div>
			  
	       <div class="form-group">
            <label>Supplier City</label>
            <input class="form-control" name="supplier_city" value="<?php echo set_value('supplier_city');?>"/>
		        <?php echo form_error('supplier_city'); ?>
          </div>
			  
			  <div class="form-group">
              <label>Supplier Country</label>
      				<?php echo country_dropdown('supplier_country', 'supplier_country', 'form-control', set_value('supplier_country') ? set_value('supplier_country') : 'MY' , array(), ''); ?>
      				<?php echo form_error('supplier_country'); ?>
              </div>
			  
			  <div class="form-group">
                <label>Supplier Telephone</label>
                <input class="form-control" name="supplier_telephone" value="<?php echo set_value('supplier_telephone');?>"/>
				        <?php echo form_error('supplier_telephone'); ?>
        </div>
			  
			   <div class="form-group">
                <label>Supplier Fax</label>
                <input class="form-control" name="supplier_fax" value="<?php echo set_value('supplier_fax');?>"/>
				        <?php echo form_error('supplier_fax'); ?>
        </div>
			  
			   <div class="form-group">
                <label>Supplier Email</label>
                <input class="form-control" name="supplier_email" value="<?php echo set_value('supplier_email');?>"/>
				        <?php echo form_error('supplier_email'); ?>
         </div>
         
         <div class="form-group">
                <label>Supplier GST</label>
                <input class="form-control" name="supplier_gst" value="<?php echo set_value('supplier_gst');?>"/>
				<?php echo form_error('supplier_gst'); ?>
         </div>

              <button type="submit" class="btn btn-large btn-success" name="createsupplierbtn" value="New Supplier">Create Supplier</button>
              <button type="reset" class="btn btn-large btn-danger">Reset Form</button>  

            </form>
				  
				 </div>  
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.row -->


      </div><!-- /#page-wrapper -->