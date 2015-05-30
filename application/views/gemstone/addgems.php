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
					<form method="post" action="<?php echo site_url('gemstone/savegems'); ?>" onSubmit="return chk_add_gems()">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Supplier *</label> <button type="button" class="btn btn-primary btn-xs" onClick="add_supplier();"> <i class="fa fa-plus"></i> เพิ่ม Supplier</button>
                                        <select class="form-control" name="supplierid" id="supplierid">
										<?php 	if(is_array($supplier_array)) {
												foreach($supplier_array as $loop){
													echo "<option value='".$loop->id."_".$loop->barcode."'>".$loop->name."</option>";
										 } } ?>
                                        </select>
                                    </div>
							</div>
                            
							<div class="col-md-3">
                                    <div class="form-group">
                                            <label>Lot</label>
                                            <input type="text" class="form-control" name="lot" id="lot" value="<?php echo set_value('lot'); ?>">
                                    </div>
							</div>
                            <div class="col-md-3">
                                    <div class="form-group">
                                            <label>จำนวน *</label>
                                            <input type="text" class="form-control" name="amount" id="amount" value="<?php echo set_value('amount'); ?>">
                                    </div>
							</div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Type *</label>
                                        <select class="form-control" name="typeid" id="typeid">
										<?php 	if(is_array($type_array)) {
												foreach($type_array as $loop){
													echo "<option value='".$loop->id."_".$loop->barcode."'>".$loop->name."</option>";
										 } } ?>
                                        </select>
                                    </div>
							</div>
                            <div class="col-md-2">
                                    <div class="form-group">
                                            <label>Color</label>
                                            <input type="text" class="form-control" name="color" id="color" value="<?php echo set_value('color'); ?>" maxlength="3">
											<p class="help-block"><?php echo form_error('color'); ?></p>
                                    </div>
							</div>
                            <div class="col-md-3">
                                    <div class="form-group">
                                            <label>Carat *</label>
                                            <input type="text" class="form-control" name="carat" id="carat" value="<?php echo set_value('carat'); ?>">
											<p class="help-block"><?php echo form_error('carat'); ?></p>
                                    </div>
							</div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                            <label>Size เข้า *</label>
                                            <input type="text" class="form-control" name="sizein" id="sizein" value="<?php echo set_value('sizein'); ?>">
											<p class="help-block"><?php echo form_error('sizein'); ?></p>
                                    </div>
							</div>
                            <div class="col-md-5">
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
                                        <label>ประเภทงาน *</label> <button type="button" class="btn btn-success btn-xs" onClick="add_processtype();"> <i class="fa fa-plus"></i> เพิ่มประเภทงาน</button>
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
                            
						</div>
					</div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-lg">  <i class="fa fa-floppy-o"></i> &nbsp;&nbsp; <b>Save</b>  &nbsp; &nbsp; </button>&nbsp; &nbsp; &nbsp; &nbsp; 
                        <button type="button" class="btn btn-warning btn-lg" onClick="window.location.href='<?php echo site_url("main"); ?>'"> <i class="fa fa-reply"></i> &nbsp;&nbsp; <b>Cancel</b> </button>
                    </div>
                </div>
			</section>
		</div>
	</div>
</form>

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
            /*
            var color=$('#color').val();
			if(color==0){
				alert('กรุณาป้อนสี');
				$('#color').focus();
				return false;
			}else{
                if (isNaN(color)) 
                {
                    alert("กรุณาใส่เฉพาะตัวเลข");
                    $('#color').focus();
                    return false;
                }
            }
            */
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
			var sizein=$('#sizein').val();
			if(sizein==0){
				alert('กรุณาป้อน size เข้า');
				$('#sizein').focus();
				return false;
			}
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