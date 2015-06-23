<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>plugins/datepicker/datepicker3.css" >
</head>

<body class="skin-blue">
	<div id="wrapper">
	<?php $this->load->view('menu'); ?>
	
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           New Stone
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> New Stone</a></li>
        </ol>
    </section>
	
	<section class="content">
		<div class="row">
            <div class="col-lg-8">
                <div class="box box-primary">
                <?php 
                        if ($this->session->flashdata('showresult') == 'true') {
					       echo '<div class="box-heading"><div class="alert alert-success"> Adding completed</div>';
						?> </div>
                
                <?php   }else if ($this->session->flashdata('showresult') == 'fail') {
					    echo '<div class="box-heading"><div class="alert alert-danger"> Error !!!</div>';
						?> </div> <?php
					  } 
				?>
					<div class="box-header"><h4 class="box-title">* Please fill in all fields</h4> </div>
					<form method="post" action="<?php echo site_url('stock/savestock'); ?>" onSubmit="return chk_add_gems()">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Rough * </label>
                                    <input type="radio" name="roughtype" id="rough1" value="พลอยสำเร็จ" checked> พลอยสำเร็จ
                                    <input type="radio" name="roughtype" id="rough2" value="พลอยก้อน"> พลอยก้อน
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
								    <label>Date In * </label>
								    <input type="text" class="form-control" id="datein" name="datein" />
								</div>
                            </div>
                            <div class="col-md-3">
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
                            
							<div class="col-md-2">
                                    <div class="form-group">
                                            <label>Lot</label>
                                            <input type="text" class="form-control" name="lot" id="lot" value="<?php echo set_value('lot'); ?>">
                                    </div>
							</div>
                            <div class="col-md-3">
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
                                            <input type="text" class="form-control" name="color" id="color" value="<?php echo set_value('color'); ?>">
                                    </div>
							</div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Order</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="order" id="order" value="<?php echo set_value('order'); ?>">
				                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">เลือก <span class="fa fa-caret-down"></span></button>
                                            <ul class="dropdown-menu">
                                            <?php 	if(is_array($process_array)) {
                                                        foreach($process_array as $loop){
                                                            echo "<li><a href='#' id='order".$loop->id."' title='".$loop->name."' onclick='addsizeout(".$loop->id.")'>".$loop->name."</a></li>";
                                                    } } ?>
                                            </ul>
                                        </div><!-- /btn-group -->
                                    </div>
							</div>
                            <div class="col-md-3">
                                    <div class="form-group">
                                            <label>Size *</label>
                                            <input type="text" class="form-control" name="size" id="size" value="<?php echo set_value('size'); ?>">
											<p class="help-block"><?php echo form_error('size'); ?></p>
                                    </div>
							</div>
                        <!-- 
                        </div>
                        <div class="row"> -->
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
											<p class="help-block"><?php echo form_error('carat'); ?></p>
                                    </div>
							</div>
                            <div class="col-md-2" id="kg" style="display:none">
                                    <div class="form-group">
                                            <label>Kilogram *</label>
                                            <input type="text" class="form-control" name="kilogram" id="kilogram" value="<?php echo set_value('kilogram'); ?>">
                                    </div>
							</div>
                        </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-success btn-lg">  <i class="fa fa-floppy-o"></i> &nbsp;&nbsp; <b>Save</b>  &nbsp; &nbsp; </button>&nbsp; &nbsp; &nbsp; &nbsp; 
                        <button type="button" class="btn btn-warning btn-lg" onClick="window.location.href='<?php echo site_url("main"); ?>'"> <i class="fa fa-reply"></i> &nbsp;&nbsp; <b>Cancel</b> </button>
                    </div>
                </div>
            </form>
        </div></div>
			</section>
		</div>
	</div>

<?php $this->load->view('js_footer'); ?>
<script src="<?php echo base_url(); ?>plugins/bootbox.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>plugins/datepicker/bootstrap-datepicker-thai.js"></script>
<script src="<?php echo base_url(); ?>plugins/datepicker/locales/bootstrap-datepicker.th.js"></script>
    <script>
      $(function () {
        get_datepicker("#datein");
          
        $('#datein').on('change', function(){
            $('.datepicker').hide();
        });
          
        $('#rough1').on('click', function(){            
            document.getElementById('kg').style.display = 'none';
        });
          
        $('#rough2').on('click', function(){            
            document.getElementById('kg').style.display = 'block';
        });
          
        roughCheck();

      });


        $(".alert").alert();
        window.setTimeout(function() { $(".alert").alert('close'); }, 4000);
        
        function chk_add_gems()
		{
            if (document.getElementById('rough1').checked) {
                var amount=$('#amount').val();
                if (isNaN(amount)) 
                {
                    alert("กรุณาใส่เฉพาะตัวเลข");
                    $('#amount').focus();
                    return false;
                }else if(amount==""){
                    alert('กรุณาป้อนจำนวน');
                    $('#amount').focus();
                    return false;
                }else if(amount<0){
                    alert('กรุณาป้อนจำนวนที่ไม่ติดลบ');
                    $('#amount').focus();
                    return false;
                }

                var carat=$('#carat').val();
                if (isNaN(carat)) 
                {
                    alert("กรุณาใส่เฉพาะตัวเลข");
                    $('#carat').focus();
                    return false;
                }else if(carat==""){
                    alert('กรุณาป้อนกะรัต');
                    $('#carat').focus();
                    return false;
                }else if(carat<0){
                    alert('กรุณาป้อนจำนวนที่ไม่ติดลบ');
                    $('#carat').focus();
                    return false;
                }
            }else{
                var kilogram=$('#kilogram').val();
                if (isNaN(kilogram)) 
                {
                    alert("กรุณาใส่เฉพาะตัวเลข");
                    $('#kilogram').focus();
                    return false;
                }else if(kilogram==""){
                    alert('กรุณาป้อนน้ำหนัก Kilogram');
                    $('#kilogram').focus();
                    return false;
                }else if(kilogram<0){
                    alert('กรุณาป้อนจำนวนที่ไม่ติดลบ');
                    $('#kilogram').focus();
                    return false;
                }   
            }

            
			var size=$('#size').val();
			if(size==0){
				alert('กรุณาป้อน size');
				$('#size').focus();
				return false;
			}
			if(!ok) {return false;}
		}
        
        function addsizeout(val1) 
        {
            var id = 'order'+val1;
            document.getElementById('order').value = document.getElementById(id).title;;
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
function roughCheck() {
    if (document.getElementById('rough1').checked) {
        document.getElementById('kg').style.display = 'none';
    }
    else document.getElementById('kg').style.display = 'block';

}       
        
function get_datepicker(id)
{

	$(id).datepicker({ language:'th-th',format:'dd/mm/yyyy', defaultDate: new Date()
		    }).datepicker("setDate", new Date());

}
    </script>
</body>
</html>