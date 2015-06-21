<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
<link href="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
</head>

<body class="skin-blue">
	<div class="wrapper">
	<?php $this->load->view('menu'); ?>
    <?php $url = site_url("gemstone/deletetemp_qc"); ?>
	
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            QC -> <?php switch($taskid) {
                                    case 1: $process = "ผ่าน (OK)"; break;
                                    case 2: $process = "ไม่ผ่าน (Not Pass)"; break;
                                    case 3: $process = "ซ่อม"; break;
                                    case 4: $process = "วัตถุดิบไม่เหมาะสม"; break;
                                    case 5: $process = "คืนวัตถุดิบ"; break;
                                    default: $process = "";
                                  }
                                echo $process;
                            ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>QC <?php echo $process; ?></a></li>
            <li class="active">Scan Barcode</li>
        </ol>
    </section>
	
	<section class="content">
		<div class="row">
            <div class="col-lg-8">
                <div class="box box-primary">
				<?php if ($this->session->flashdata('showresult') == 'success') echo '<div class="alert-message alert alert-success"> ระบบทำการเพิ่มข้อมูลเรียบร้อยแล้ว</div>'; 
						  else if ($this->session->flashdata('showresult') == 'fail1') echo '<div class="alert-message alert alert-danger"> ไม่มี Barcode นี้ในระบบ</div>';
                          else if ($this->session->flashdata('showresult') == 'fail2') echo '<div class="alert-message alert alert-danger"> Barcode ซ้ำ</div>';
                          else if ($this->session->flashdata('showresult') == 'fail3') echo '<div class="alert-message alert alert-danger"> กรุณาสแกนผู้เบิกของ</div>';
					
					?>
					<div class="box-header">
                        <h4 class="box-title">กรุณาสแกน Barcode</h4></div>
					<form method="post" action="<?php echo site_url('gemstone/qctemp/'.$taskid); ?>">                        
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Barcode *</label>
                                        <input type="text" class="form-control" name="barcode" id="barcode" value="" placeholder="Scan Barcode">
										<p class="help-block"><?php echo form_error('barcode'); ?></p>	
										<button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-barcode"></span> <b> &nbsp; เพิ่มรายการ</b>  </button>
                    </form>
                                    </div>
							</div>
						</div>   
                        
        <div class="row">
			<div class="col-lg-12">
                <div class="panel panel-default">
					<div class="panel-heading"><h3>รวมทั้งหมด <?php echo $count; ?> รายการ</h3></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped row-border table-hover" id="tablebarcode" width="100%">
                                <thead>
                                    <tr>
										<th>No.</th>
                                        <th>Barcode</th>
										<th>Delete</th>
                                    </tr>
                                </thead>
								<tbody>
								<?php if(isset($temp_array)) { $i = 1; foreach($temp_array as $loop) { 
                                    
								?>
									<td><?php echo $i; ?></td>
									<td><?php echo $loop->tbarcode."-".$loop->supname.$loop->lot."-".$loop->number."(#".$loop->no.")"." ".$loop->typename; ?></td>
									<td width="50">
									<button type="button" class="btnDelete btn btn-danger btn-xs" onclick="del_confirm(<?php echo $loop->tempid; ?>,<?php echo $taskid; ?>)" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip" title="ลบข้อมูล"><span class="glyphicon glyphicon-remove"></span></button>
									</td>
									</tr>
								<?php $i++; } }?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>	
		</div>
                <?php if ($taskid==1) { ?>
                    <form method="post" action="<?php echo site_url('gemstone/saveTemptoQC/'.$taskid); ?>">
                <?php } else if ($taskid==2) { ?>
                    <div class="row">
                        <div class="col-md-5">
                                    <div class="form-group">
                                        <label>เพราะ (ต้องระบุอาการในข้อต่อไปนี้)</label>
                                        <form method="post" action="<?php echo site_url('gemstone/saveTemptoQC/'.$taskid); ?>" onSubmit="return chk_error()">
                                        <select class="form-control" name="error" id="error">
                                        <option value=""></option>
										<?php 	if(is_array($error_array)) {
												foreach($error_array as $loop){
													echo "<option value='".$loop->name."'>".$loop->name."</option>";
										 } } ?>
                                        </select>
                                    </div>
							</div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>รายละเอียด</label>
                                <input type="text" class="form-control" name="detail" id="detail" value="<?php echo set_value('lot'); ?>">
                            </div>
                        </div>
                    </div>    
                <?php }else if ($taskid==3) { ?>  
                    <div class="row">
                        <div class="col-md-5">
                                    <div class="form-group">
                                        <label>ขั้นตอนที่ซ่อม</label>
                                        <form method="post" action="<?php echo site_url('gemstone/saveTemptoQC/'.$taskid); ?>" onSubmit="return chk_error()">
                                        <select class="form-control" name="error" id="error">
                                        <option value=""></option>
                                        <option value="กดหน้ากระดาน(เงาหน้า 100%)">กดหน้ากระดาน(เงาหน้า 100%)</option>
										<option value="ติดแชล็ก">ติดแชล็ก</option>
                                        <option value="บล็อกรูปร่าง">บล็อกรูปร่าง</option>
                                        <option value="เจียหน้า">เจียหน้า</option>
                                        <option value="กลับติดก้นแชล็ก">กลับติดก้นแชล็ก</option>
                                        <option value="บล็อกก้น">บล็อกก้น</option>
                                        <option value="เจียก้น">เจียก้น</option>
                                        <option value="เช็คขนาดเครื่องมือ">เช็คขนาดเครื่องมือ</option>
                                        </select>
                                    </div>
							</div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>รายละเอียด</label>
                                <input type="text" class="form-control" name="detail" id="detail" value="<?php echo set_value('lot'); ?>">
                            </div>
                        </div>
                    </div> 
                <?php }else if (($taskid==4) || ($taskid==5)) { ?>  
                    <div class="row">
                        <div class="col-md-5">
                                    <div class="form-group">
                                        <label>รายละเอียด</label>
                                        <form method="post" action="<?php echo site_url('gemstone/saveTemptoQC/'.$taskid); ?>" onSubmit="return chk_error()">
                                        <input type="text" class="form-control" name="detail" id="detail" value="">
                                    </div>
				        </div>
                    </div> 
                <?php } ?>
					</div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-thumbs-up"></span>&nbsp; <b>ยืนยันรายการทั้งหมด</b>  </button>
                        </form>
                        &nbsp; &nbsp; &nbsp; &nbsp; 
                        <button type="button" class="btn btn-danger btn-lg" onClick="window.location.href='<?php echo site_url("gemstone/cleartemp_QC/".$taskid); ?>'"><span class="glyphicon glyphicon-repeat"></span>&nbsp;<b> เริ่มต้นใหม่ทั้งหมด </b></button>
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
<script type="text/javascript">
    $(document).ready(function()
    {
		$("#barcode").focus();

		
    });
    
function del_confirm(val1,val2) {
	bootbox.confirm("ต้องการลบข้อมูลที่เลือกไว้ใช่หรือไม่ ?", function(result) {
				var currentForm = this;
				var myurl = <?php echo json_encode($url); ?>;
            	if (result) {
				
					window.location.replace(myurl+"/"+val1+"/"+val2);
				}

		});

}
    
function chk_error()
{
    var error=$('#error').val();
    if(error==""){
        alert('กรุณาระบุอาการ');
        $('#error').focus();
        return false;
    }
}


$(".alert").alert();
window.setTimeout(function() { $(".alert").alert('close'); }, 4000);

</script>
</body>
</html>