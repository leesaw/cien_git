<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
<link href="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
</head>

<body class="skin-blue">
	<div class="wrapper">
	<?php $this->load->view('menu'); ?>
    <?php $url = site_url("gemstone/deletegem"); ?>
	
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            แสดงสินค้าทั้งหมด
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> แสดงสินค้าทั้งหมด</a></li>
        </ol>
    </section>
	
	<section class="content">
		<div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
					<div class="box-header"><h4 class="box-title">สินค้าทั้งหมด</h4></div>

                        
        <div class="box-body">
                        
        <div class="row">
			<div class="col-lg-12">
                <div class="panel panel-default">
					<div class="panel-heading"></div>
                    <div class="panel-body">
                            <table class="table table-bordered table-striped" id="tablebarcode">
                                <thead>
                                    <tr>
                                        <th width="230">Barcode</th>
                                        <th>Detail</th>
                                        <th width="150">Datetime</th>
										<th width="100">Manage</th>
                                    </tr>
                                </thead>
								<tbody>
								<?php if(isset($gem_array)) { foreach($gem_array as $loop) { 
                                    
								?>
									<tr><td><a href="<?php echo site_url("gemstone/viewtask/".$loop->gemid); ?>"><?php echo $loop->gembarcode; ?></a></td>
                                    <td><?php echo $loop->supname." Lot".$loop->lot." / ".$loop->gemtype." / ".$loop->color." / ".$loop->gemsize." / ".$loop->number; ?></td>
                                    <td><?php echo $loop->gemdate; ?></td>
									<td width="50">
                                    <a href="<?php echo site_url("gemstone/printbarcode/".$loop->gemid."/".$loop->gembarcode); ?>" class="btn btn-primary btn-xs" target="_blank" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="Print"><span class="glyphicon glyphicon-print"></span></a>
	</div>
									<button type="button" class="btnDelete btn btn-danger btn-xs" onclick="del_confirm(<?php echo $loop->gemid; ?>)" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip" title="ลบข้อมูล"><span class="glyphicon glyphicon-remove"></span></button>
                                        
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
                    <div class="box-footer">

                    </div>
                </div>
            </div>
        </div>
        </section>
		</div>
    
    
	</div>


<?php $this->load->view('js_footer'); ?>
<script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>plugins/bootbox.min.js"></script>
<script type="text/javascript" class="init">
$(document).ready(function()
{
    $("#tablebarcode").dataTable( {
        "order": [[ 2, "desc" ]]
    } );
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
        
</script>
</body>
</html>