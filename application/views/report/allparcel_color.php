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
    <?php $url = site_url("gemstone/deletegem"); ?>
	
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            แสดงชุดวัตถุดิบสี <?php echo $color." เดือน ".date('F Y'); ?> 
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> แสดงชุดวัตถุดิบตามสี</a></li>
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
                            <table class="table table-bordered table-striped" id="tablebarcode">
                                <thead>
                                    <tr>
                                        <th width="60" rowspan="2" style="text-align:center">วันที่เข้า</th>
                                        <th width="120" rowspan="2" style="text-align:center">เลขที่</th>
                                        <th width="100" rowspan="2" style="text-align:center">ลำดับที่</th>
                                        <th width="80" rowspan="2" style="text-align:center">ชนิด</th>
                                        <th colspan="2" style="text-align:center">ส่งเข้าโรงงาน</th>
										<th width="100" rowspan="2" style="text-align:center">Size เข้า</th>
                                        <th width="100" rowspan="2" style="text-align:center">Size ออก</th>
                                        <th width="100" rowspan="2" style="text-align:center">ประเภทงาน</th>
                                        <th width="60" rowspan="2" style="text-align:center">จัดการ</th>
                                    </tr>
                                    <tr><th width="60" style="text-align:center">เม็ด</th><th width="60" style="text-align:center">กะรัต</th></tr>
                                </thead>
								<tbody>
								<?php if(isset($parcel_array)) { foreach($parcel_array as $loop) { 
                                    $phpdate = strtotime($loop->dateadd);
                                    $date = date( 'd/m/Y', $phpdate );
                                    
								?>
                                    <tr><td><?php echo $date; ?></td>
                                    <td><?php echo $loop->supname.$loop->lot."-".$loop->number; ?></td>
                                    <td><?php echo $loop->_min."-".$loop->_max; ?></td>
                                    <td><?php echo $loop->gemtype; ?></td>
                                    <td><?php echo $loop->amount; ?></td>
                                    <td><?php echo $loop->carat; ?></td>
                                    <td><?php echo $loop->size_in; ?></td>
                                    <td><?php echo $loop->size_out; ?></td>
                                    <td><?php echo $loop->process_name." ".$loop->process_detail; ?></td>
									<td width="50">
                                    <a href="<?php echo site_url("report/showdetail_parcel/".$loop->gemid); ?>" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="View"><span class="glyphicon glyphicon-search"></span></a>
                                        
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
<script src="<?php echo base_url(); ?>plugins/bootbox.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/fancybox/jquery.fancybox.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
    $("#tablebarcode").dataTable( {
        "order": [[ 2, "desc" ]]
    } );
    
    $('#fancyboxall').fancybox({ 
    'width': '85%',
    'height': '100%', 
    'autoScale':false,
    'transitionIn':'none', 
    'transitionOut':'none', 
    'type':'iframe'}); 
});
    
function del_confirm(val1) {
	bootbox.confirm("ต้องการลบข้อมูลที่เลือกไว้ใช่หรือไม่ ?", function(result) {
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