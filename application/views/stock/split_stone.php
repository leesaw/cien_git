<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
<link href="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>plugins/datepicker/datepicker3.css" >
</head>

<body class="skin-blue sidebar-collapse fixed">
	<section class="content">
        <h1>
            แยกสต๊อก
        </h1>
		<div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">

                        
        <div class="box-body">
                        
        <div class="row">
			<div class="col-xs-10">
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
					<form method="post" action="<?php echo site_url('stock/editstock_split'); ?>" onSubmit="return chk_add_gems()">
                    <input type="hidden" name="stoneid" value="<?php echo $stockid; ?>">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group">
								    <label>Reason * </label>
								    <select class="form-control" name="reason" id="reason">
                                        <?php 	if(is_array($reason_array)) {
												foreach($reason_array as $loop){
													echo "<option value='".$loop->name."' ";
                                                    echo ">".$loop->name."</option>";
										 } } ?>
                                    </select>
								</div>
                            </div>
                            
							<div class="col-xs-8">
                                    <div class="form-group">
                                            <label>Detail *</label>
                                            <input type="text" class="form-control" name="detail" id="detail">
                                    </div>
							</div>
                            
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                    <div class="form-group">
                                        <label>Quantity *</label>
                                        <input type="text" class="form-control" name="amount" id="amount">
                                    </div>
							</div>
                            <div class="col-xs-4">
                                    <div class="form-group">
                                        <label>Carat *</label>
                                        <input type="text" class="form-control" name="carat" id="carat">
                                    </div>
							</div>
                        </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success btn-lg">  <i class="fa fa-floppy-o"></i> &nbsp;&nbsp; <b>Save</b>  &nbsp; &nbsp; </button>&nbsp; &nbsp; &nbsp; &nbsp; 
                        <button type="button" class="btn btn-warning btn-lg" onclick="javascript:parent.jQuery.fancybox.close();"> <i class="fa fa-reply"></i> &nbsp;&nbsp; <b>Cancel</b> </button>
                    </div>
            </form>
        </div>

		</div>
                        
                        
                        
                        
					</div>
                </div>
            </div>
        </div>
        </section>
<br><br><br><br><br><br><br>


<?php $this->load->view('js_footer'); ?>
<script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>plugins/bootbox.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/datepicker/locales/bootstrap-datepicker.th.js"></script>
<script type="text/javascript" class="init">
$(document).ready(function()
{
    get_datepicker("#datein");
          
    $('#datein').on('change', function(){
        $('.datepicker').hide();
    });
    

});
    
        function chk_add_gems()
		{
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

		}

$(".alert").alert();
window.setTimeout(function() { $(".alert").alert('close'); }, 4000);

function addsizeout(val1) 
{
    var id = 'order'+val1;
    document.getElementById('order').value = document.getElementById(id).title;;
}
function get_datepicker(id)
{

	$(id).datepicker({ language:'th-th',format:'dd/mm/yyyy'
		    }).datepicker();

}
</script>
</body>
</html>