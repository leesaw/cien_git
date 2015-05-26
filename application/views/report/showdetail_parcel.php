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
            แสดงชุดวัตถุดิบ
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> แสดงชุดวัตถุดิบ</a></li>
        </ol>
    </section>
	
    <?php
        if(is_array($barcode_array)) {
            foreach($barcode_array as $loop) {
                $barcodeid = $loop->gembarcode;
                $barcode_print = $loop->gemid;
                $supplier = $loop->supname;
                $number = $loop->number;
                $lot = $loop->lot;
                $color = $loop->color;
                $gemtype = $loop->gemtype;
                $size_out = $loop->gemsize;
                $size_in = $loop->size_in;
                $amount = $loop->amount;
                $carat = $loop->carat;
                $process_name = $loop->process_name;
                $process_detail = $loop->process_detail;
                $phpdate = strtotime($loop->gemdate);
                $dateadd = date( 'd/m/Y', $phpdate );
            }
        }
    ?>    
        
	<section class="content">
		<div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">

                        
        <div class="box-body">
                <div class="row">
                    <div class="col-lg-10">
                            <div class="col-md-3">
                                <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess">วันที่เข้า</label>
                                        <input type="text" class="form-control" name="dateadd" id="dateadd" value="<?php echo $dateadd; ?>" readonly>
                                    </div>
                            </div>
                            <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess">Supplier/Lot</label>
                                        <input type="text" class="form-control" name="supplier" id="supplier" value="<?php echo $supplier.$lot; ?>" readonly>
                                    </div>
							</div>
							<div class="col-md-2">
                                    <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">Number</label>
                                            <input type="text" class="form-control" name="number" id="number" value="<?php echo $number; ?>" readonly>
                                    </div>
							</div>
                            <div class="col-md-2">
                                    <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">ลำดับ</label>
                                            <input type="text" class="form-control" name="amount" id="amount" value="<?php echo $minno."-".$maxno; ?>" readonly>
                                    </div>
							</div>
                            <div class="col-md-2">
                                    <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess">Type</label>
                                        <input type="text" class="form-control" name="type" id="type" value="<?php echo $gemtype; ?>" readonly>
                                    </div>
							</div>
                            <div class="col-md-2">
                                    <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">Color</label>
                                            <input type="text" class="form-control" name="color" id="color" value="<?php echo $color; ?>" readonly>
                                    </div>
							</div>
                            <div class="col-md-2">
                                    <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">Carat</label>
                                            <input type="text" class="form-control" name="carat" id="carat" value="<?php echo $carat; ?>" readonly>
                                    </div>
							</div>
                            <div class="col-md-3">
                                    <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">Size เข้า</label>
                                            <input type="text" class="form-control" name="sizein" id="sizein" value="<?php echo $size_in; ?>" readonly>
                                    </div>
							</div>
                            <div class="col-md-3">
                                    <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess">Size ออก</label>
                                        <input type="text" class="form-control" name="sizeout" id="sizeout" value="<?php echo $size_out; ?>" readonly>
                                    </div>
							</div>
                        
                        </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="col-md-3">
                        <div class="form-group has-success">
                            <label class="control-label" for="inputSuccess">ประเภทงาน</label>
                            <input type="text" class="form-control" name="processname" id="processname" value="<?php echo $process_name; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-success">
                            <label class="control-label" for="inputSuccess">รายละเอียดงาน</label>
                            <input type="text" class="form-control" name="processdetail" id="processdetail" value="<?php echo $process_detail; ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
        <div class="row">
                    <div class="col-sm-2 col-xs-3 bg-blue">
                      <div class="description-block border-right">
                        <h3 class="description-header"><?php echo $amount; ?> เม็ด</h3>
                        <span class="description-text">ส่งเข้าโรงงาน</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-2 col-xs-3 bg-green">
                      <div class="description-block border-right">
                        <h3 class="description-header"><?php echo $qc_ok; ?> เม็ด</h3>
                        <span class="description-text">รับจากโรงงาน (ใช้ได้)</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-2 col-xs-3 bg-red">
                      <div class="description-block border-right">
                        <h3 class="description-header"><?php echo $qc_not; ?> เม็ด</h3>
                        <span class="description-text">จำนวนที่ใช้ไม่ได้</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-2 col-xs-3 bg-purple">
                      <div class="description-block border-right">
                        <h3 class="description-header"><?php echo $qc_return; ?> เม็ด</h3>
                        <span class="description-text">จำนวนที่วัตถุดิบไม่เหมาะสม</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-2 col-xs-3 bg-orange">
                      <div class="description-block">
                        <h3 class="description-header"><?php echo $amount-$qc_ok-$qc_not-$qc_return; ?> เม็ด</h3>
                        <span class="description-text">จำนวนที่เหลือ</span>
                      </div><!-- /.description-block -->
                    </div>
        </div>       
        <div class="row">
			<div class="col-md-12">
                <div class="panel panel-default">
					<div class="panel-heading">บาร์โค้ดทั้งหมด</div>
                    <div class="panel-body">
                            <table class="table table-bordered table-striped" id="tablebarcode" width="100%">
                                <thead>
                                    <tr>
                                        <th width="60" rowspan="2" style="text-align:center">ลำดับ</th>
                                        <th colspan="9" style="text-align:center">ขั้นตอน</th>
                                        <th rowspan="2" width="60" style="text-align:center">ออกจากโรงงาน</th>
                                    </tr>
                                    <tr>
                                        <th width="60" style="text-align:center">ติดแชล็ก</th>
                                        <th width="60" style="text-align:center">บล็อกรูปร่าง</th>
                                        <th width="60" style="text-align:center">กดหน้า</th>
                                        <th width="60" style="text-align:center">เจียรหน้า</th>
                                        <th width="60" style="text-align:center">QC หน้า</th>
                                        <th width="60" style="text-align:center">ติดแชล็กก้น</th>
                                        <th width="60" style="text-align:center">บล็อกก้น</th>
                                        <th width="60" style="text-align:center">เจียรก้น</th>
                                        <th width="60" style="text-align:center">QC ก้น</th>
                                    </tr>
                                </thead>
								<tbody>
								<?php if(isset($gem_array)) { foreach($gem_array as $loop) { 
                                    
								?>
                                    <tr style="text-align:center"><td><?php echo $loop->no; ?></td>
                                    <td><a id="fancyboxall" href="<?php echo site_url("gemstone/viewtask_number/".$loop->gemid."/4");  ?>"><?php echo check_task($loop->task4);  ?></a></td>
                                    <td><a id="fancyboxall" href="<?php echo site_url("gemstone/viewtask_number/".$loop->gemid."/5");  ?>"><?php echo check_task($loop->task5);  ?></a></td>
                                    <td><a id="fancyboxall" href="<?php echo site_url("gemstone/viewtask_number/".$loop->gemid."/3");  ?>"><?php echo check_task($loop->task3);  ?></a></td>
                                    <td><a id="fancyboxall" href="<?php echo site_url("gemstone/viewtask_number/".$loop->gemid."/6");  ?>"><?php echo check_task($loop->task6);  ?></a></td>
                                    <td><a id="fancyboxall" href="<?php echo site_url("gemstone/viewtask_number/".$loop->gemid."/12");  ?>"><?php echo check_task($loop->qc1);  ?></a></td>
                                    <td><a id="fancyboxall" href="<?php echo site_url("gemstone/viewtask_number/".$loop->gemid."/7");  ?>"><?php echo check_task($loop->task7);  ?></a></td>
                                    <td><a id="fancyboxall" href="<?php echo site_url("gemstone/viewtask_number/".$loop->gemid."/8");  ?>"><?php echo check_task($loop->task8);  ?></a></td>
                                    <td><a id="fancyboxall" href="<?php echo site_url("gemstone/viewtask_number/".$loop->gemid."/9");  ?>"><?php echo check_task($loop->task9);  ?></a></td>
                                    <td><a id="fancyboxall" href="<?php echo site_url("gemstone/viewtask_number/".$loop->gemid."/13");  ?>"><?php echo check_task($loop->qc2);  ?></a></td>
                                    <td><a id="fancyboxall" href="<?php echo site_url("gemstone/viewqc_number/".$loop->gemid);  ?>"><?php echo check_out($loop->pass);  ?></a></td>
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




<?php $this->load->view('js_footer'); ?>
<script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>plugins/bootbox.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/fancybox/jquery.fancybox.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
    $("#tablebarcode").DataTable( {
        responsive: true
    } );
    
    $('#fancyboxall').fancybox({ 
    'width': '60%',
    'height': '60%', 
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