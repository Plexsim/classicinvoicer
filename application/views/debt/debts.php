 <script type="text/javascript">
	    $(function() {

	    	debt_onload();
		    
			$('input:radio[name="debt_status"]').change(function(){
			$('.loading').fadeIn('slow');
			var status = $(this).val();
			$.post("<?php echo site_url('debt/ajax_filter_debt'); ?>", {
                status: status,
            },
            function(data) {
               $('#debt_table_body').html(data);
			   $('.loading').fadeOut('slow');
            });
				
			});
			
		});

	    function filter_debts(){

			var from_date = $('#from_date').val();
	    	var to_date = $('#to_date').val();
	    	var client_id = $('#client_id').val();
	    	//var status = $('input:radio[name="debt_status"]:checked').val();	   
			var status = $('#status').val();
		
	    	$('.loading').fadeIn('slow');

    		$.post("<?php echo site_url('debt/ajax_filter_debt'); ?>", {
    			from_date: from_date,
    			to_date: to_date,
    			status: status,
    			client_id: client_id,
            },
            function(data) {
	           console.log(data);
               $('#debt_table_body').html(data);

               
			   $('.loading').fadeOut('slow');
            });
	    		
	    	

	    }

		// when startup first load, so no any checking empty criteria
	    function debt_onload(){

			var from_date = $('#search_from_date').val();
	    	var to_date = $('#search_to_date').val();
	    	var client_id = $('#search_client_id').val();
	    	//var status = $('input:radio[name="debt_status"]:checked').val();	   
			var status = $('#search_status').val();	    				
			
	    	$('.loading').fadeIn('slow');

	    	
    		$('.loading').fadeOut('slow');

    		$.post("<?php echo site_url('debt/ajax_filter_debt'); ?>", {
    			from_date: from_date,
    			to_date: to_date,
    			status: status,
    			client_id: client_id,
            },
            function(data) {
	            console.log(data);
               $('#debt_table_body').html(data);
               //var dataTable; //reference to your dataTable
               //dataTable.fnReloadAjax("<?php echo site_url('debt/ajax_filter_debt'); ?>");     
               
			   $('.loading').fadeOut('slow');
            });
	    		
	    	

	    }

	 // when startup first load, so no any checking empty criteria
	    function reset(){

			var from_date = '';
	    	var to_date = '';
	    	var client_id = '';
	    	var status = 'all';	  

	    	$('#from_date').val("");
	    	$('#to_date').val("");
	    	$('#client_id').val("");
	    	$('#status').val("all");  				
			
	    	$('.loading').fadeIn('slow');

	    	
    		$('.loading').fadeOut('slow');

    		$.post("<?php echo site_url('debt/ajax_filter_debt'); ?>", {
    			from_date: from_date,
    			to_date: to_date,
    			status: status,
    			client_id: client_id,
            },
            function(data) {
	            
               $('#debt_table_body').html(data);
               //var dataTable; //reference to your dataTable
               //dataTable.fnReloadAjax("<?php echo site_url('debt/ajax_filter_debt'); ?>");     
               
			   $('.loading').fadeOut('slow');
            });

	    }	
</script>
<div class="loading"></div>
<div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="pull-left">Debt</h3>
			<a href="<?php echo site_url('debt/newdebt');?>" class="btn btn-large btn-success pull-right"><i class="fa fa-plus"> New Debt </i></a>
          </div>
        </div><!-- /.row -->

        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> List of Debt</h3>
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

				<div class="well" style="background-color: #d9edf7;border-color: #bce8f1;color: #31708f;">
										
					<div class="row">
					
							<div class="col-lg-6">
								<label>Date From : </label>
								<div class="form-group input-group " style="margin-left:0;">
									<input class="form-control" size="16" type="text" name="from_date" id="from_date" placeholder="From" value="<?php echo (isset($from_date) && !empty($from_date)) ? $from_date : ''?>"/>
									<span class="input-group-addon add-on"><i class="fa fa-calendar" style="display: inline"></i></span>
								</div>
							</div>
													
							
							<div class="col-lg-6">
								<label>Date To : </label>
								<div class="form-group input-group " style="margin-left:0;">
									<input class="form-control" size="16" type="text" name="to_date" id="to_date" placeholder="To" value="<?php echo (isset($to_date) && !empty($to_date)) ? $to_date : ''?>"/>
									<span class="input-group-addon add-on"><i class="fa fa-calendar" style="display: inline"></i></span>
								</div>
							</div>															
							
					</div>
					
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Client : </label>
								<select name="client_id" id="client_id" class="form-control">
								<?php echo $clients; ?>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Status : </label>
								<select name="status" id="status" class="form-control">
									<option value="all" <?php echo ($status == '' || $status == 'all') ? 'selected' : ''; ?>>ALL</option>
									<option value="UNPAID" <?php echo ($status == 'UNPAID') ? 'selected' : ''; ?>>UNPAID</option>
									<option value="PAID" <?php echo ($status == 'PAID') ? 'selected' : ''; ?>>PAID</option>
									<option value="CANCELLED" <?php echo ($status == 'CANCELLED') ? 'selected' : ''; ?>>CANCELLED</option>
								</select>
							</div>
						</div>
					</div>
					
					<div class="form-group input-group" style="margin-left:0;">
					<a href="javascript: void(0);" onclick="javascript: reset();" class="btn btn-large btn-warning pull-right"  style="margin-right:10px" id="bttn_save_debt"><i class="fa fa-check"></i> Reset </a>					
					<a href="javascript: void(0);" onclick="javascript: filter_debts();" class="btn btn-large btn-success pull-right"  style="margin-right:10px" id="bttn_save_debt"><i class="fa fa-check"></i> Generate Listing </a>
					</div>
								
					<input type="hidden" value="<?php echo $from_date;?>" name="search_from_date" id="search_from_date">
					<input type="hidden" value="<?php echo $to_date;?>" name="search_to_date" id="search_to_date">
					<input type="hidden" value="<?php echo $client_id;?>" name="search_client_id" id="search_client_id">
					<input type="hidden" value="<?php echo $status == '' ? 'all' : $status;?>" name="search_status" id="search_status">
						
								
					
				</div>
				
				
                  <table class="table table-bordered table-striped tablesorter">
                    <thead>
                      <tr class="table_header">
						<th>Status</th>                       
                        <th>Transaction Date</th>
						<th>Client Name</th>
                        <th class="text-right">Amount UNPAID</th>                        
                        <th class="text-right">Amount PAID</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody id="debt_table_body">
					<?php
					if( isset($debt) && !empty($debt))
					{
						foreach ($debt as $count => $debt)
						{
						?>
						<tr>
						<td><?php echo status_label($debt['debt_status']);?></td>
                        <td><?php echo format_date($debt['debt_date_created']); ?></td>
                        <td><a href="<?php echo site_url('clients/editclient/'.$debt['client_id']); ?>"><?php echo ucwords($debt['client_name']); ?></a></td>
                        <td class="text-right invoice_amt"><?php echo format_amount($debt['debt_amount_unpaid']); ?></td>
                        <td class="text-right invoice_amt"><?php echo format_amount($debt['debt_amount_paid']); ?></td>
                        <td style="width:32%">
						<a href="<?php echo site_url('debt/edit/'.$debt['debt_id']);?>" class="btn btn-xs btn-primary"><i class="fa fa-check"> Edit </i></a>
						<!--a href="javascript:;" class="btn btn-info btn-xs" onclick="viewdebt('<?php echo $debt['debt_id']; ?>')"><i class="fa fa-search"> Preview </i></a-->
						<!--a href="<?php echo site_url('debt/viewpdf/'.$debt['debt_id']);?>" class="btn btn-warning btn-xs">Download pdf </a-->												
						<!--a href="javascript: void(0);" onclick="javascript: ajax_print_debt('<?php echo $debt['debt_id']?>');" class="btn btn-warning pull-xs" id="bttn_print_debt">Download as PDF</a-->
						</td>
						</tr>
						<?php
						}
					}
					else
					{
					?>
					<tr class="no-cell-border">
					<td> There are no debt available at the moment.</td>
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

<script>

$('#from_date').datepicker({dateFormat:'dd-mm-yy', altField: '#date_alt', altFormat: 'yy-mm-dd'});
$('#to_date').datepicker({dateFormat:'dd-mm-yy', altField: '#date_alt', altFormat: 'yy-mm-dd'});

//$('#select_dateto').datepicker({dateFormat:'dd-mm-yy', altField: '#date_to_alt', altFormat: 'yy-mm-dd'});

</script>