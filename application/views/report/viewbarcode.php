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
								<?php if(isset($barcode_array)) { foreach($barcode_array as $loop) { 
                                    
								?>
                                    <tr><td><?php echo $loop->barcodeid; ?></td>
                                    <td><?php echo $loop->supname.$loop->lot."-".$loop->number."#".$loop->no; ?>
                                    <td><?php echo $loop->gemtype; ?></td>
                                    <td><?php echo date('d/m/Y',strtotime($loop->gemdate)); ?></td>
									<td width="50">
                                    <a href="<?php echo site_url("gemstone/showdetail_barcode/".$loop->barcodeid); ?>" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="View"><span class="glyphicon glyphicon-search"></span></a>
                                    <a href="<?php echo site_url("gemstone/printbarcode_one/".$loop->barcodeid."/".$loop->gembarcode); ?>" class="btn btn-primary btn-xs" target="_blank" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="Print"><span class="glyphicon glyphicon-print"></span></a>
	</div>
                                        
									</td>
									</tr>
								<?php } }  ?>
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


<?php $this->load->view('js_footer'); ?>
<script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables2.js"></script>
<script src="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>plugins/bootbox.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/fancybox/jquery.fancybox.js"></script>
<script type="text/javascript">
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



</script>
</body>
</html>