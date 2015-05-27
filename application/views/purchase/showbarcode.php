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
                $barcode_print = $loop->gembarcode;
                //$barcode_print = $loop->gemid;
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
                    <div class="box-header"><h4 class="box-title"> Barcode : <?php echo $barcode_print; ?></h4></div>
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
                            <div class="col-md-3">
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
                    <button type="button" class="btn btn-lg btn-primary" onClick="sendPrinter()"><i class="fa fa-print"></i> &nbsp; Print<br><h5>พิมพ์ใบส่งโรงงาน</h5></button>
                    &nbsp; &nbsp; &nbsp; &nbsp; 
                    <a href="<?php echo site_url("purchase/deleteparcel/".$gid); ?>"><button type="button" class="btn btn-lg btn-danger"> ลบข้อมูลนี้ </button></a>
                    </div>
                </div> 
					
				</div>
			</section>
		</div>
	</div>


<?php $this->load->view('js_footer'); ?>

<script src="<?php echo base_url(); ?>plugins/jquery-barcode.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/bootbox.min.js"></script>
<script type='text/javascript'>
$(document).ready(function() {
	$("#bcTarget").barcode("<?php echo $barcode_print; ?>", "code39" ,{barWidth:2, barHeight:80});
});
function sendPrinter() {
	window.open("<?php echo site_url("purchase/printbarcode/".$gid."/".$barcode_print); ?>");
}

</script>
</body>
</html>