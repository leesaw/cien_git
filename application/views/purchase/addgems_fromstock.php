<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
</head>

<body class="skin-blue">
	<div id="wrapper">
	<?php $this->load->view('menu'); ?>

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
				<?php if ($this->session->flashdata('showresult') == 'fail') {
					    echo '<div class="box-heading"><div class="alert alert-danger"> Barcode ซ้ำกับที่มีอยู่ในระบบ</div>';
						?> </div> <?php
					  }
				?>
					<div class="box-header"><h4 class="box-title">* Please fill in all fields</h4> </div>
					<form method="post" action="<?php echo site_url('purchase/savegems_fromstock'); ?>" onSubmit="return chk_add_gems()">
                    <div class="box-body">
                        <div class="row">
                            <?php
                                $remain_amount=0;
                                $remain_carat=0;
                                if(is_array($stone_array)) {
				                    foreach($stone_array as $loop){

                            ?>
                            <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Supplier *</label>
                                        <input type="hidden" name="remain_amount" id="remain_amount" value="<?php echo $loop->remain; ?>">
                                        <input type="hidden" name="remain_carat" id="remain_carat" value="<?php echo $loop->remaincarat; ?>">
                                        <input type="hidden" name="stockid" value="<?php echo $stockid; ?>">
                                        <input type="hidden" name="supplierid" value="<?php echo $loop->supid; ?>">
                                        <input type="text" class="form-control" name="supname" id="supname" value="<?php echo $loop->supname; ?>" readonly>
                                    </div>
							</div>

							<div class="col-md-3">
                                    <div class="form-group">
                                            <label>Lot</label>
                                            <input type="hidden" name="color" value="<?php echo $loop->color; ?>">
                                            <input type="text" class="form-control" name="lot" id="lot" value="<?php echo $loop->lot; ?>" readonly>
                                    </div>
							</div>
                            <div class="col-md-3">
                                    <div class="form-group">
                                            <label>Color *</label>
                                            <input type="hidden" name="typeid" value="<?php echo $loop->typeid; ?>">
                                            <input type="hidden" name="typebarcode" value="<?php echo $loop->typebarcode; ?>">
                                            <input type="text" class="form-control" name="type" id="type" value="<?php echo $loop->gemtype; ?>" readonly>
                                    </div>
							</div>
                            <div class="col-md-3">
                                    <div class="form-group">
                                            <label>Size เข้า *</label>
                                            <input type="text" class="form-control" name="sizein" id="sizein" value="<?php echo $loop->gemsize; ?>" readonly>
                                    </div>
							</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Quantity *</label>
                                    <input type="text" class="form-control" name="amount" id="amount" value="<?php echo set_value('amount'); ?>">
                                </div>
							</div>
                            <div class="col-md-2">
                                    <div class="form-group">
                                            <label>Carat *</label>
                                            <input type="text" class="form-control" name="carat" id="carat" value="<?php echo set_value('carat'); ?>">
                                    </div>
							</div>
                            <div class="col-md-4">
                                        <label>Size ออก *</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="sizeout" id="sizeout">
                                            <div class="input-group-btn">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">เลือก <span class="fa fa-caret-down"></span></button>
                      <ul class="dropdown-menu">
                        <?php 	if(is_array($size_array)) {
												foreach($size_array as $loop){
													echo "<li><a href='#' id='size".$loop->id."' title='".$loop->name."' onclick='addsizeout(".$loop->id.")'>".$loop->name."</a></li>";
				                } } ?>
                      </ul>
                    </div><!-- /btn-group -->

                  </div>

							</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label>ประเภทงาน *</label> <button type="button" class="btn btn-primary btn-xs" onClick="add_processtype();"> <i class="fa fa-plus"></i> เพิ่มประเภทงาน</button>
                                        <select class="form-control" name="process_id" id="process_id">
										<?php 	if(is_array($process_array)) {
												foreach($process_array as $loop){
													echo "<option value='".$loop->id."'>".$loop->name."</option>";
										 } } ?>
                                        </select>
                                    </div>
							</div>
                            <div class="col-md-5">
                                    <div class="form-group">
                                        <label>รายละเอียดงาน</label>
                                        <input type="text" class="form-control" name="process_detail" id="process_detail" value="<?php echo set_value('process_detail'); ?>">
								        <p class="help-block"><?php echo form_error('process_detail'); ?></p>
                                    </div>
							</div>
							<div class="col-md-3">
									<div class="checkbox">
										<br>
											<label>
												<input type="checkbox" name="sesto_status" id="sesto_status" value="1"> งานเสสโต
											</label>
									</div>
							</div>
                            <?php } } ?>
						</div>
					</div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-lg">  <i class="fa fa-floppy-o"></i> &nbsp;&nbsp; <b>Save</b>  &nbsp; &nbsp; </button>&nbsp; &nbsp; &nbsp; &nbsp;
                        <button type="button" class="btn btn-warning btn-lg" onClick="window.location.href='<?php echo site_url("purchase/addstock"); ?>'"> <i class="fa fa-reply"></i> &nbsp;&nbsp; <b>Back</b> </button>
                    </div>
                        </form>
            </div>
			</section>
		</div>
	</div>


<?php $this->load->view('js_footer'); ?>
<script src="<?php echo base_url(); ?>plugins/bootbox.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });

        $(".alert").alert();
        window.setTimeout(function() { $(".alert").alert('close'); }, 4000);

        function chk_add_gems()
		{

            var remain_amount = parseInt($('#remain_amount').val());
            var remain_carat = parseFloat($('#remain_carat').val());
            remain_carat = remain_carat.toFixed(2);
            remain_carat = parseFloat(remain_carat);

            var amount=$('#amount').val();
			if(amount==0){
				alert('กรุณาป้อนจำนวน');
				$('#amount').focus();
				return false;
			}else{
                if (isNaN(amount))
                {
                    alert("กรุณาใส่เฉพาะตัวเลข");
                    $('#amount').focus();
                    return false;
                }
            }

            var carat=$('#carat').val();
			if(carat==0){
				alert('กรุณาป้อนกะรัต');
				$('#carat').focus();
				return false;
			}else{
                if (isNaN(carat))
                {
                    alert("กรุณาใส่เฉพาะตัวเลข");
                    $('#carat').focus();
                    return false;
                }
            }
			var sizeout=$('#sizeout').val();
			if(sizeout==0){
				alert('กรุณาป้อน size ออก');
				$('#sizeout').focus();
				return false;
			}
            /*
            if(amount > remain_amount) {
                alert('จำนวนในสต๊อกมีไม่เพียงพอ');
				$('#amount').focus();
				return false;
            }else if(carat > remain_carat) {
                alert('จำนวนในสต๊อกมีไม่เพียงพอ');
				$('#carat').focus();
				return false;
            }
            */
			if(!ok) {return false;}
		}

        function addsizeout(val1)
        {
            var id = 'size'+val1;
            document.getElementById('sizeout').value = document.getElementById(id).title;;
        }

        function add_supplier() {
            bootbox.prompt("ป้อนชื่อ Supplier ใหม่", function(result) {
                if (result != null && result !="") {
                    var name = result;
                    $.ajax({
                            'url' : '<?php echo site_url('suppliers/addNewSupplier'); ?>',
                            'type':'post',
                            'data': { supplier:name },
                            'success' : function(data){
                                window.location.reload();
                            }
                        });

                }else if (result =="") {
                    alert('ไม่สามารถเพิ่มข้อมูลได้');
                }
            });
        }

        function add_gemtype() {
            bootbox.prompt("ป้อนชื่อ Type ใหม่", function(result) {
                if (result != null && result !="") {
                    var name = result;
                    $.ajax({
                            'url' : '<?php echo site_url('gemstone/addNewGemtype'); ?>',
                            'type':'post',
                            'data': { type:name },
                            'success' : function(data){
                                window.location.reload();
                            }
                        });

                }else if (result =="") {
                    alert('ไม่สามารถเพิ่มข้อมูลได้');
                }
            });
        }

        function add_processtype() {
            bootbox.prompt("ป้อนชื่อประเภทงานใหม่", function(result) {
                if (result != null && result !="") {
                    var name = result;
                    $.ajax({
                            'url' : '<?php echo site_url('gemstone/addNewProcesstype'); ?>',
                            'type':'post',
                            'data': { process:name },
                            'success' : function(data){
                                window.location.reload();
                            }
                        });

                }else if (result =="") {
                    alert('ไม่สามารถเพิ่มข้อมูลได้');
                }
            });
        }
    </script>
</body>
</html>
