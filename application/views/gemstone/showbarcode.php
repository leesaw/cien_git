<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
</head>

<body class="skin-blue">
	<div class="wrapper">
	<?php $this->load->view('menu'); ?>
	
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
            }
        }
    ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Stone Details
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Stone details</a></li>
        </ol>
    </section>
	
	<section class="content">
		<div class="row">
            <div class="col-lg-8">
                <div class="box box-primary">
                    <div class="box-header"><h4 class="box-title"> Barcode : <?php echo str_pad($barcode_print, 15, "0", STR_PAD_LEFT); ?></h4></div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div id="bcTarget"></div>
                            </div>
                        </div>
                        <div class="row">
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
                                            <label class="control-label" for="inputSuccess">จำนวน</label>
                                            <input type="text" class="form-control" name="amount" id="amount" value="<?php echo $amount; ?>" readonly>
                                    </div>
							</div>
                            <div class="col-md-2">
                                    <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">ลำดับ</label>
                                            <input type="text" class="form-control" name="amount" id="amount" value="<?php echo $minno."-".$maxno; ?>" readonly>
                                    </div>
							</div>
                            <div class="col-md-5">
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
                            <div class="col-md-3">
                                    <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">Carat</label>
                                            <input type="text" class="form-control" name="carat" id="carat" value="<?php echo $carat; ?>" readonly>
                                    </div>
							</div>
                            <div class="col-md-4">
                                    <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">Size เข้า</label>
                                            <input type="text" class="form-control" name="sizein" id="sizein" value="<?php echo $size_in; ?>" readonly>
                                    </div>
							</div>
                            <div class="col-md-4">
                                    <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess">Size ออก</label>
                                        <input type="text" class="form-control" name="sizeout" id="sizeout" value="<?php echo $size_out; ?>" readonly>
                                    </div>
							</div>
                        
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                    <div class="form-group has-success">
                                            <label class="control-label" for="inputSuccess">ประเภทงาน</label>
                                            <input type="text" class="form-control" name="process_name" id="process_name" value="<?php echo $process_name; ?>" readonly>
                                    </div>
							</div>
                            <div class="col-md-5">
                                    <div class="form-group has-success">
                                        <label class="control-label" for="inputSuccess">รายละเอียดงาน</label>
                                        <input type="text" class="form-control" name="process_detail" id="process_detail" value="<?php echo $process_detail; ?>" readonly>
                                    </div>
							</div>
                        </div>
                    </div>
                    <div class="box-footer">
                    <button type="button" class="btn btn-lg btn-success" onClick="sendPrinter()"> พิมพ์ Barcode<br/>ทั้งหมด</button>
                    &nbsp; &nbsp; &nbsp; &nbsp; 
                    <a data-toggle="modal" data-target="#myModal" class="btn btn-lg btn-primary" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="เลือกช่วงลำดับ" data-backdrop="static" data-keyboard="false"> พิมพ์ Barcode<br/>เฉพาะลำดับที่ต้องการ</a>
                    &nbsp; &nbsp; &nbsp; &nbsp; 
                    <a href="<?php echo site_url("gemstone/deleteparcel/".$gid); ?>"><button type="button" class="btn btn-lg btn-danger"> ลบข้อมูลนี้ </button></a>
                    </div>
                </div> 
					
				</div>
			</section>
		</div>
	</div>

        
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						
						  <div class="modal-dialog modal-md">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title">	                 	
										<strong>เลือกช่วงลำดับต้องการพิมพ์ Barcode</strong> 
									</h4>
								</div>            <!-- /modal-header -->
								<div class="modal-body">
									<form class="form-inline" role="form" action="<?php echo site_url("gemstone/printbarcode_range"); ?>" method="POST" target="_blank">
                                    <input type="hidden" name="gemid" value="<?php echo $barcode_print; ?>">
                                    <input type="hidden" name="label" value="<?php echo $barcodeid; ?>">
									<div class="form-group">
										<label for="">เริ่ม: </label>
										<input type="text" class="form-control" id="start" name="start" />
									</div>
									<div class="form-group">
										<label for=""> สิ้นสุด :</label>
										<input type="text" class="form-control" id="end" name="end" />
									</div>
										
								</div>            <!-- /modal-body -->
							
								<div class="modal-footer">
										<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save"></span> ตกลง</button>			
										<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> ปิด</button>
								</div> 	
								</form>		
							</div>
						</div>
					</div>

<?php $this->load->view('js_footer'); ?>

<script src="<?php echo base_url(); ?>plugins/jquery-barcode.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/bootbox.min.js"></script>
<script type='text/javascript'>
$(document).ready(function() {
	$("#bcTarget").barcode("<?php echo str_pad($barcode_print, 15, "0", STR_PAD_LEFT); ?>", "code39" ,{barWidth:2, barHeight:80});
});
function sendPrinter() {
	window.open("<?php echo site_url("gemstone/printbarcode/".$barcode_print."/".$barcodeid); ?>");
}

</script>
</body>
</html>