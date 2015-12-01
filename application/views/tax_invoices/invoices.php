 <script type="text/javascript">
	    $(function() {

	    	invoice_onload();
		    
			$('input:radio[name="invoice_status"]').change(function(){
			$('.loading').fadeIn('slow');
			var status = $(this).val();
			$.post("<?php echo site_url('tax_invoices/ajax_filter_invoices'); ?>", {
                status: status,
            },
            function(data) {
               $('#invoice_table_body').html(data);
			   $('.loading').fadeOut('slow');
            });
				
			});
			
		});
	    
	    function filter_tax_invoices(){

			var from_date = $('#from_date').val();
	    	var to_date = $('#to_date').val();
	    	var client_id = $('#client_id').val();
	    	//var status = $('input:radio[name="invoice_status"]:checked').val();	   
			var status = $('#status').val();
		
	    	$('.loading').fadeIn('slow');

    		$.post("<?php echo site_url('tax_invoices/ajax_filter_invoices_date'); ?>", {
    			from_date: from_date,
    			to_date: to_date,
    			status: status,
    			client_id: client_id,
            },
            function(data) {
	            
               $('#invoice_table_body').html(data);

               
			   $('.loading').fadeOut('slow');
            });
	    		
	    	

	    }

		// when startup first load, so no any checking empty criteria
	    function invoice_onload(){

			var from_date = $('#search_from_date').val();
	    	var to_date = $('#search_to_date').val();
	    	var client_id = $('#search_client_id').val();
	    	//var status = $('input:radio[name="invoice_status"]:checked').val();	   
			var status = $('#search_status').val();	    				
			
	    	$('.loading').fadeIn('slow');

	    	
    		$('.loading').fadeOut('slow');

    		$.post("<?php echo site_url('tax_invoices/ajax_filter_invoices_date'); ?>", {
    			from_date: from_date,
    			to_date: to_date,
    			status: status,
    			client_id: client_id,
            },
            function(data) {
	            
               $('#invoice_table_body').html(data);
               //var dataTable; //reference to your dataTable
               //dataTable.fnReloadAjax("<?php echo site_url('tax_invoices/ajax_filter_invoices_date'); ?>");     
               
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

    		$.post("<?php echo site_url('tax_invoices/ajax_filter_invoices_date'); ?>", {
    			from_date: from_date,
    			to_date: to_date,
    			status: status,
    			client_id: client_id,
            },
            function(data) {
	            
               $('#invoice_table_body').html(data);
               //var dataTable; //reference to your dataTable
               //dataTable.fnReloadAjax("<?php echo site_url('tax_invoices/ajax_filter_invoices_date'); ?>");     
               
			   $('.loading').fadeOut('slow');
            });

	    }		   
	        	    

		
</script>
<div class="loading"></div>
<div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="pull-left">Tax Invoices</h3>
            <a href="<?php echo site_url('tax_invoices/newinvoice');?>" class="btn btn-large btn-success pull-right"><i class="fa fa-plus"> New Tax Invoice </i></a>
          </div>
        </div><!-- /.row -->

        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> List of Tax Invoices</h3>
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
				<!--div class="well" style="background-color: #d9edf7;border-color: #bce8f1;color: #31708f;">
					<div class="form-group" style="margin-bottom:0px">
					<label> Filter : </label> &nbsp;&nbsp;
					<label class="radio-inline"><input type="radio" name="invoice_status" <?php echo ($status == 'all') ? 'checked' : ''; ?> id="allinvoices" value="all"> All Invoices</label>
					<label class="radio-inline"><input type="radio" name="invoice_status" <?php echo ($status == 'paid') ? 'checked' : ''; ?> id="paidinvoices" value="paid"> Paid</label>
					<label class="radio-inline"><input type="radio" name="invoice_status" <?php echo ($status == 'unpaid') ? 'checked' : ''; ?> id="unpaidinvoices" value="unpaid"> Unpaid</label>
					<label class="radio-inline"><input type="radio" name="invoice_status" <?php echo ($status == 'cancelled') ? 'checked' : ''; ?> id="cancelledinvoices" value="cancelled"> Cancelled</label>
					</div>
				</div-->
				<label> Filter : </label> &nbsp;&nbsp;			
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
					<a href="javascript: void(0);" onclick="javascript: reset();" class="btn btn-large btn-warning pull-right"  style="margin-right:10px" id="bttn_save_invoice"><i class="fa fa-check"></i> Reset </a>					
					<a href="javascript: void(0);" onclick="javascript: filter_tax_invoices();" class="btn btn-large btn-success pull-right"  style="margin-right:10px" id="bttn_save_invoice"><i class="fa fa-check"></i> Generate Listing </a>
					</div>
								
					<input type="hidden" value="<?php echo $from_date;?>" name="search_from_date" id="search_from_date">
					<input type="hidden" value="<?php echo $to_date;?>" name="search_to_date" id="search_to_date">
					<input type="hidden" value="<?php echo $client_id;?>" name="search_client_id" id="search_client_id">
					<input type="hidden" value="<?php echo $status == '' ? 'all' : $status;?>" name="search_status" id="search_status">
						
																							
				</div>
				
																				
                  <table class="table table-bordered table-striped tablesorter" id="tax_invoice_table">
                    <thead>
                      <tr class="table_header">
						<th>Status</th>
                        <th>Invoice No.</i></th>
                        <th>Date Issued</th>
						<th>Client Name</th>
                        <th class="text-right">Amount </th>
                        <th class="text-right">Paid</th>
						<th>Actions</th>
                      </tr>
                    </thead>
                    <tbody id="invoice_table_body">
					<?php
					if( isset($invoices) && !empty($invoices))
					{
						foreach ($invoices as $count => $invoice)
						{
						?>
						<tr>
						<td><?php echo status_label($invoice['invoice_status']);?></td>
                        <td><a href="<?php echo site_url('tax_invoices/edit/?invoice_id='.$invoice['invoice_id']);?>"><?php echo $invoice['invoice_number']; ?></a></td>
                        <td><?php echo format_date($invoice['invoice_date_created']); ?></td>
                        <td><a href="<?php echo site_url('clients/editclient/'.$invoice['client_id']); ?>"><?php echo ucwords($invoice['client_name']); ?></a></td>
                        <td class="text-right invoice_amt"><?php echo format_amount($invoice['invoice_amount']); ?></td>
                        <td class="text-right amt_paid"><?php echo format_amount($invoice['total_paid']); ?></td>
						<td style="width:32%">
						<a href="<?php echo site_url('tax_invoices/edit/?invoice_id='.$invoice['invoice_id']);?>" class="btn btn-xs btn-primary"><i class="fa fa-check"> Edit </i></a>
						<a href="javascript:;" onclick="enterTaxPayment('<?php echo $invoice['invoice_id']; ?>')" class="btn btn-success btn-xs"><i class="fa fa-usd"> Enter Payment </i></a>
						<a href="javascript:;" class="btn btn-info btn-xs" onclick="viewTaxInvoice('<?php echo $invoice['invoice_id']; ?>')"><i class="fa fa-search"> Preview </i></a>
						<a href="<?php echo site_url('tax_invoices/viewpdf/'.$invoice['invoice_id']);?>" class="btn btn-warning btn-xs">Download pdf </a>
						</td>
						</tr>
						<?php
						}
					}
					else
					{
					?>
					<tr class="no-cell-border">
					<td> There are no tax invoices available at the moment.</td>
					<td></td>
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
