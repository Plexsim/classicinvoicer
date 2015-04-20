<script type="text/javascript">
$(function() {
	$('.loading').fadeIn('slow');
	$('.report-header').html('Client Statement');
	$.post("<?php echo site_url('statement/client_statement'); ?>", {
			client: 'all',
			from_date: '',
			to_date: '',
		},
		function(data) {
		   $('#report-body').html(data);
		   $('.loading').fadeOut('slow');
		});
});

//function to generate client statement
function client_statement()
{
	$('.loading').fadeIn('slow');
	var client 		= $('#client_id').val();
	$.post("<?php echo site_url('statement/client_statement'); ?>", {
		client_id : client,
		},
		function(data) {
		   $('#report-body').html(data);
		    $('.loading').fadeOut('slow');
		});
}
</script>
<div class="loading"></div>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<button type="button" class="btn btn-info btn-lg reports-button" onclick="javascript: client_statement();">Client Statement</button>			
		</div> 
	</div>

		
	 <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="table-responsive">
				<div id="report-body"></div>
				</div>
              </div>
            </div>
          </div>
        </div><!-- /.row -->
</div> 