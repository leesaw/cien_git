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
            แสดงบาร์โค้ด
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> แสดงบาร์โค้ด</a></li>
        </ol>
    </section>
	
	<section class="content">
		<div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">

                        
        <div class="box-body">
            
        <div class="row">
			<div class="col-xs-10">
                <div class="panel panel-default">
					<div class="panel-heading"></div>
                    <div class="panel-body">
                            <table class="table table-bordered table-striped" id="tablebarcode" width="100%">
                                <thead>
                                    <tr>
                                        <th width="150">Barcode</th>
                                        <th>เลขที่ ลำดับ</th>
                                        <th>ชนิด</th>
                                        <th width="150">วันที่เข้า</th>
										<th width="100">Manage</th>
                                    </tr>
                                </thead>
                                
								<tbody>
								<?php /* if(isset($gem_array)) { foreach($gem_array as $loop) { 
                                    
								?>
									<!--<tr><td><a id="fancyboxall" href="<?php echo site_url("gemstone/viewtask/".$loop->barcodeid);  ?>"><?php echo $loop->barcodeid."-".$loop->gembarcode."(#".$loop->no.")"; ?></a></td> -->
                                    <tr><td><?php echo $loop->barcodeid; ?></td>
                                    <td><?php echo $loop->supname.$loop->lot."-".$loop->number."#".$loop->no; ?>
                                    <td><?php echo $loop->gemtype; ?></td>
                                    <td><?php echo date('d/m/Y',strtotime($loop->gemdate)); ?></td>
									<td width="50">
                                    <a href="<?php echo site_url("gemstone/showdetail_parcel/".$loop->gemid); ?>" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="View"><span class="glyphicon glyphicon-search"></span></a>
                                    <a href="<?php echo site_url("gemstone/printbarcode_one/".$loop->barcodeid."/".$loop->gembarcode); ?>" class="btn btn-primary btn-xs" target="_blank" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="Print"><span class="glyphicon glyphicon-print"></span></a>
	</div>
									<button type="button" class="btnDelete btn btn-danger btn-xs" onclick="del_confirm(<?php echo $loop->barcodeid; ?>)" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip" title="ลบข้อมูล"><span class="glyphicon glyphicon-remove"></span></button>
                                        
									</td>
									</tr>
								<?php } } */ ?>
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
<script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables2.js"></script>
<script src="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>plugins/bootbox.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/fancybox/jquery.fancybox.js"></script>
<script type="text/javascript">
$(document).ready(function()
{    
    var oTable = $('#tablebarcode').dataTable
        ({
            "bJQueryUI": false,
            "bProcessing": true,
            "sPaginationType": "simple_numbers",
            'bServerSide'    : false,
            "bDeferRender": true,
            'sAjaxSource'    : '<?php echo site_url("gemstone/ajaxGetAllBarcode"); ?>',
            "fnServerData": function ( sSource, aoData, fnCallback ) {
                $.ajax( {
                    "dataType": 'json',
                    "type": "POST",
                    "url": sSource,
                    "data": aoData,
                    "success":fnCallback
                
                });
            }
        });
    
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