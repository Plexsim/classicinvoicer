      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h3 class="pull-left">Staffs</h3>
			<a href="<?php echo site_url('staffs/createstaff'); ?>" class="btn btn-large btn-success pull-right"><i class="fa fa-plus"> Create Staff </i></a>
          </div>
        </div><!-- /.row -->

        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> List of Staffs</h3>
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
                  <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                      <tr class="table_header">
                        <th>Staff Name <i class="fa fa-sort"></i></th>                        
                        <th>Telephone <i class="fa fa-sort"></i></th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					if( isset($staffs) && $staffs->num_rows() > 0 )
					{
						$countries = config_item('country_list');
						foreach ($staffs->result_array() as $count => $staff)
						{
						?>
						<tr>
                        <td><?php echo ucwords($staff['staff_name']); ?></td>
                        <td><?php echo $staff['staff_phone']; ?></td>
                        <td>
						<a href="<?php echo site_url('staffs/editstaff/'.$staff['staff_id']); ?>" class="btn btn-xs btn-success"><i class="fa fa-check"> Edit </i></a>
						<a href="<?php echo site_url('staffs/delete_staff/'.$staff['staff_id']);?>" onclick="return confirm('If you delete this staff you will also delete all their invoices and payments and you will not be able to recover the data later. Are you sure you want to permanently delete this staff?');" class="btn btn-danger btn-xs"><i class="fa fa-times"> Delete </i></a>
						</td>
						</tr>
						<?php
						}
					}
					else
					{
					?>
					<tr class="no-cell-border"><td> There are no staffs available at the moment.</td>
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