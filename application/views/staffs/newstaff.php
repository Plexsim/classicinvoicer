      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h3 class="pull-left">Create Staff</h3>
			<a href="<?php echo site_url('staffs'); ?>" class="btn btn-large btn-success pull-right"><i class="fa fa-chevron-left"> Back to Staffs List </i></a>
          </div>
        </div><!-- /.row -->

        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> Create a new staff </h3>
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
			<form role="form" method="POST" action="<?php echo site_url('staffs/createstaff'); ?>">
              <div class="form-group">
                <label>Staff Name</label>
                <input class="form-control" name="staff_name" value="<?php echo set_value('staff_name');?>"/>
				<?php echo form_error('staff_name'); ?>
              </div>
 
			  <div class="form-group">
                <label>Staff Telephone</label>
                <input class="form-control" name="staff_telephone" value="<?php echo set_value('staff_telephone');?>"/>
				        <?php echo form_error('staff_telephone'); ?>
        </div>
			  
		
			  
		

              <button type="submit" class="btn btn-large btn-success" name="createstaffbtn" value="New Staff">Create Staff</button>
              <button type="reset" class="btn btn-large btn-danger">Reset Form</button>  

            </form>
				  
				 </div>  
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.row -->


      </div><!-- /#page-wrapper -->