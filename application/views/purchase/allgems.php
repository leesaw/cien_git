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
                    <div class="panel-heading"><a data-toggle="modal" data-target="#myModal" class="btn btn-primary" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="" data-backdrop="static" data-keyboard="false"><i class="fa fa-table"></i> แสดงชุดวัตถุดิบที่ส่งโรงงาน</a></div>
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


                        <!-- datepicker modal for error -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						
						  <div class="modal-dialog modal-md">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title">	                 	
										<strong>เลือกช่วงวันที่ต้องการ</strong> 
									</h4>
								</div>            <!-- /modal-header -->
								<div class="modal-body">
									<form class="form-inline" role="form" action="<?php echo site_url("report/viewSendFactoryBetween"); ?>" method="POST" target="_blank">
									<div class="form-group">
										<label for="">เริ่ม: </label>
										<input type="text" class="form-control" id="startdate" name="startdate" />
									</div>
									<div class="form-group">
										<label for=""> สิ้นสุด :</label>
										<input type="text" class="form-control" id="enddate" name="enddate" />
									</div>
										
								</div>            <!-- /modal-body -->
							
								<div class="modal-footer">
                                    <a class="btn btn-success pull-left" href="<?php echo site_url("report/viewSendFactoryBetween/1"); ?>" target="_blank"><span class="glyphicon glyphicon-play"></span> แสดงทั้งหมด</a>
										<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> ตกลง</button>			
										<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> ปิด</button>
								</div> 	
								</form>								
							</div>
						</div>
					</div>
						
                    </div>
                    <!-- close modal -->


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
    get_datepicker("#startdate");
    get_datepicker("#enddate");
    
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
    
function get_datepicker(id)
{

	$(id).datepicker({ language:'th-th',format:'dd/mm/yyyy'
		    });

}
    // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[rel=tooltip]",
        container: "body"
    })

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