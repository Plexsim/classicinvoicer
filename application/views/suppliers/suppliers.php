      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h3 class="pull-left">Suppliers</h3>
			<a href="<?php echo site_url('suppliers/createsupplier'); ?>" class="btn btn-large btn-success pull-right"><i class="fa fa-plus"> Create Supplier </i></a>
          </div>
        </div><!-- /.row -->

        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> List of Suppliers</h3>
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
                        <th>Supplier Name <i class="fa fa-sort"></i></th>
                        <th>SSM <i class="fa fa-sort"></i></th>
                        <th>Address <i class="fa fa-sort"></i></th>                        
						<th>Telephone <i class="fa fa-sort"></i></th>
                        <th>GST <i class="fa fa-sort"></i></th>
						<th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
					if( isset($suppliers) && $suppliers->num_rows() > 0 )
					{
						$countries = config_item('country_list');
						foreach ($suppliers->result_array() as $count => $supplier)
						{
						?>
						<tr>
                        <td><?php echo ucwords($supplier['supplier_name']); ?></td>
                        <td><?php echo isset($supplier['supplier_ssm']) && !empty($supplier['supplier_ssm']) ? $supplier['supplier_ssm'] : '-'; ?></td>
                        <td><?php echo $supplier['supplier_address']; ?></td>                        
						<td><?php echo $supplier['supplier_phone']; ?></td>
                        <td><?php echo isset($supplier['supplier_gst']) && !empty($supplier['supplier_gst']) ? $supplier['supplier_gst'] : '-';  ?></td>
						<td>
						<a href="<?php echo site_url('suppliers/editsupplier/'.$supplier['supplier_id']); ?>" class="btn btn-xs btn-success"><i class="fa fa-check"> Edit </i></a>
						<a href="<?php echo site_url('suppliers/delete_tax_supplier/'.$supplier['supplier_id']);?>" onclick="return confirm('If you delete this supplier you will also delete all their invoices and payments and you will not be able to recover the data later. Are you sure you want to permanently delete this supplier?');" class="btn btn-danger btn-xs"><i class="fa fa-times"> Delete </i></a>
						</td>
						</tr>
						<?php
						}
					}
					else
					{
					?>
					<tr class="no-cell-border"><td> There are no suppliers available at the moment.</td>
					<td></td>
					<td></td>
					<td></td>
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