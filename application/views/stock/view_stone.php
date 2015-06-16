<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
<link href="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
</head>

<body class="skin-blue sidebar-collapse fixed">
	<section class="content">
		<div class="row">
            <div class="col-md-12">
                <div class="box box-primary">

                        
        <div class="box-body">
                        
        <div class="row">
			<div class="col-lg-12">
                <div class="panel panel-default">
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



<?php $this->load->view('js_footer'); ?>
<script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>plugins/bootbox.min.js"></script>
<script type="text/javascript" class="init">
$(document).ready(function()
{
    
});
    


$(".alert").alert();
window.setTimeout(function() { $(".alert").alert('close'); }, 4000);
        
</script>
</body>
</html>