<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
<link href="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>plugins/fancybox/jquery.fancybox.css" >
</head>

<body class="skin-blue">
	<div class="wrapper">
	<?php $this->load->view('menu'); ?>
    <?php $url = site_url("purchase/deletegem"); ?>
	
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            แสดงชุดวัตถุดิบทั้งหมด <u> ที่ยังไม่ได้ส่งไปโรงงาน </u>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> แสดงชุดวัตถุดิบทั้งหมด</a></li>
        </ol>
    </section>
	
	<section class="content">
		<div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">

                        
        <div class="box-body">
            
        <div class="row">
			<div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                            <table class="table table-bordered table-striped" id="tablebarcode" width="100%">
                                <thead>
                                    <tr>
                                        <th width="60" rowspan="2" style="text-align:center">Created on</th>
                                        <th width="120" rowspan="2" style="text-align:center">Barcode</th>
                                        <th width="120" rowspan="2" style="text-align:center">Code</th>
                                        <th width="100" rowspan="2" style="text-align:center">Number</th>
                                        <th width="80" rowspan="2" style="text-align:center">Type</th>
                                        <th colspan="2" style="text-align:center">Stone</th>
										<th width="100" rowspan="2" style="text-align:center">Size-in</th>
                                        <th width="100" rowspan="2" style="text-align:center">Size-out</th>
                                        <th width="100" rowspan="2" style="text-align:center">Task category</th>
                                        <th width="40" rowspan="2" style="text-align:center"> </th>
                                    </tr>
                                    <tr><th width="50" style="text-align:center">Quantity</th><th width="50" style="text-align:center">Carat</th></tr>
                                </thead>
								<tbody>
								<?php if(isset($parcel_array)) { foreach($parcel_array as $loop) { 
                                    $phpdate = strtotime($loop->dateadd);
                                    $date = date( 'd/m/Y', $phpdate );
                                    $datehidden = date('Y/m/d', $phpdate);
                                    
								?>

                                    <tr><td><span class="hide"><?php echo $datehidden; ?></span><?php echo $date; ?></td>
                                    <td><?php echo $loop->barcode; ?></td>
                                    <td><?php echo $loop->supname.$loop->lot."-".$loop->number; ?></td>
                                    <td><?php echo $loop->_min."-".$loop->_max; ?></td>
                                    <td><?php echo $loop->gemtype; ?></td>
                                    <td><?php echo $loop->amount; ?></td>
                                    <td><?php echo $loop->carat; ?></td>
                                    <td><?php echo $loop->size_in; ?></td>
                                    <td><?php echo $loop->size_out; ?></td>
                                    <td><?php echo $loop->process_name." ".$loop->process_detail; ?></td>
									<td width="50">
                                    <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="tooltip" data-target="#delete" data-placement="top" rel="tooltip" title="Delete" onClick="del_confirm(<?php echo $loop->gemid; ?>)"><span class="glyphicon glyphicon-remove"></span></button>
                                        
									</td>
									</tr>
								<?php } }?>
								</tbody>
							</table>
					</div>
				</div>
			</div>	
		</div>
                        
                        
                        
                        
					</div>
                </div>
            </div>
        </div>
        </section>
		</div>
    
    
	</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
          <iframe src="/user/dashboard" width="300" height="380" frameborder="0" allowtransparency="true"></iframe>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<?php $this->load->view('js_footer'); ?>
<script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>js/date-uk.js"></script>
<script src="<?php echo base_url(); ?>plugins/bootbox.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/fancybox/jquery.fancybox.js"></script>
<script type="text/javascript">
$(function() {
    $('#tablebarcode').dataTable();
    
    $("#datepicker").datepicker( {
        format: "mm-yyyy",
        viewMode: "months", 
        minViewMode: "months"
    });
});
$(document).ready(function()
{
    
    
    $('#fancyboxall').fancybox({ 
    'width': '85%',
    'height': '100%', 
    'autoScale':false,
    'transitionIn':'none', 
    'transitionOut':'none', 
    'type':'iframe'}); 
});
    
function del_confirm(val1) {
	bootbox.confirm("Are you sure you want to permanently delete ?", function(result) {
				var currentForm = this;
				var myurl = <?php echo json_encode($url); ?>;
            	if (result) {
				
					window.location.replace(myurl+"/"+val1);
				}

		});

}


$(".alert").alert();
window.setTimeout(function() { $(".alert").alert('close'); }, 4000);

$('.testModal').on('click', function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    $(".modal-body").html('<iframe width="100%" height="100%" frameborder="0" scrolling="no" allowtransparency="true" src="'+url+'"></iframe>');
}); 
</script>
</body>
</html>