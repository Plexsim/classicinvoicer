 <script type="text/javascript">
	    $(function() {

    		$('.loading').fadeIn('slow');
    		//$('.report-header').html('Payment Summary');
    		$.post("<?php echo site_url('stock/ajax_filter_stocks'); ?>", {
    				stock_status: 'all',
    				from_date: '',
    				to_date: '',
    			},
    			function(data) {
    			   $('#stock-body').html(data);
    			   $('.loading').fadeOut('slow');
    			});

			$('input:radio[name="stock_status"]').change(function(){
				$('.loading').fadeIn('slow');
					var from_date 		= $('#from_date').val();
		    		var to_date 		= $('#to_date').val();
					var stock_status = $(this).val();					
					$.post("<?php echo site_url('stock/ajax_filter_stocks'); ?>", {
						from_date : from_date,
			    		to_date : to_date,
						stock_status: stock_status,
		            },
		            function(data) {
		               $('#stock-body').html(data);
					   $('.loading').fadeOut('slow');
					   $('#from_date').val(from_date);
		    		   $('#to_date').val(to_date);
		    		   $('#stock_status').val(stock_status);
		            });
					
				});			
			});

	    function ajax_print_stock_list()
	    {
	    	$('.loading').fadeIn('slow');
	    	var from_date 		= $('#from_date').val();
	    	var to_date 		= $('#to_date').val();
	    	var stock_status 	= $('#stock_status').val();
	    	
	    	$.post("<?php echo site_url('stock/ajax_filter_stocks'); ?>", {		
	    		from_date : from_date,
	    		to_date : to_date,
	    		stock_status : stock_status,
	    		},
	    		function(data) {
	    		    $('#stock-body').html(data);
	    		    $('.loading').fadeOut('slow');
	    		    $('#from_date').val(from_date);
	    		    $('#to_date').val(to_date);
	    		    $('#stock_status').val(stock_status);
	    		});
	     }
</script>
 
 
 
<div class="loading"></div>
<div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="pull-left">Stocks</h3>
			<a href="<?php echo $this->config->item('nav_base_url'); ?>stock/newstock" class="btn btn-large btn-success pull-right"><i class="fa fa-plus"> New Stock </i></a>
          </div>
        </div><!-- /.row -->
        
        <div class="well" style="background-color: #d9edf7;border-color: #bce8f1;color: #31708f;">
			<div class="form-group" style="margin-bottom:0px">
			<label> Filter : </label> &nbsp;&nbsp;
			<label class="radio-inline"><input type="radio" name="stock_status" <?php echo ($status == 'all') ? 'checked' : ''; ?> id="stock_status" value="all"> All</label>
			<label class="radio-inline"><input type="radio" name="stock_status" <?php echo ($status == 'stock_in') ? 'checked' : ''; ?> id="stock_status" value="stock_in"> Stock In</label>
			<label class="radio-inline"><input type="radio" name="stock_status" <?php echo ($status == 'stock_out') ? 'checked' : ''; ?> id="stock_status" value="stock_out"> Stock Out</label>					
			</div>
		</div>
		
		<div class="row no-print">
			<div class="col-lg-2">
				<label>From : </label>
				<div class="form-group input-group " style="margin-left:0;">
				   <input class="form-control" size="16" type="text" name="from_date" id="from_date"/>
					<span class="input-group-addon add-on"><i class="fa fa-calendar" style="display: inline"></i></span>
				</div>
			</div>
			<div class="col-lg-2">
				<label>To : </label>
				<div class="form-group input-group" style="margin-left:0;">
				   <input class="form-control" size="16" type="text" name="to_date" id="to_date"/>
					<span class="input-group-addon add-on"><i class="fa fa-calendar" style="display: inline"></i></span>
				</div>
			</div>
			
			<div class="col-lg-2">
				<label> </label>
				<div class="form-group input-group" style="margin-left:0;">
				<a href="javascript: void(0);" onclick="javascript: ajax_print_stock_list();" class="btn btn-large btn-success pull-right"  style="margin-right:10px" id="bttn_save_invoice"><i class="fa fa-check"></i> Generate Stock List </a>
						</div>
					</div>										
					
					</div>
												                 
          </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <!--div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> List of Stocks</h3>
              </div-->
              <div class="panel-body">

               	<div class="table-responsive">
				<div id="stock-body"></div>
				</div>
                
              </div>
            </div>
          </div>
        </div><!-- /.row -->
</div><!-- /#page-wrapper -->
					
<script>
//function to generate invoice full report


$('#from_date').datepicker({dateFormat:'dd-mm-yy', altField: '#date_alt', altFormat: 'yy-mm-dd'});
$('#to_date').datepicker({dateFormat:'dd-mm-yy', altField: '#date_alt', altFormat: 'yy-mm-dd'});

</script>