<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
<link href="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
</head>

<body class="skin-blue">
	<div class="wrapper">
	<?php $this->load->view('menu'); ?>
    <?php $url = site_url("gemstone/deletetemp_back"); ?>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            คืนของ <?php switch($taskid) {

                                    case 1: $process = "<label class='text-green'>ผ่าน</label>";
                                            //$process = "เลือกก้อนเช็ค+เช็คพลอย+เช็คสีของพลอย";
                                            break;
                                    case 2: $process = "เช็คความสะอาดของพลอย"; break;
                                    case 3: $process = "กดหน้ากระดาน(เงาหน้า 100%)"; break;
                                    case 4: $process = "ติดแชล็ก"; break;
                                    case 5: $process = "บล็อกรูปร่าง"; break;
                                    case 6: $process = "เจียหน้า"; break;
                                    case 7: $process = "กลับติดก้นแชล็ก"; break;
                                    case 8: $process = "บล็อกก้น"; break;
                                    case 9: $process = "เจียก้น"; break;
                                    case 10: $process = "รับคืนจากโคราช"; break;
                                    case 11: $process = "ตรวจ QA"; break;
                                    case 12: $process = "QC หน้า"; break;
                                    case 13: $process = "QC ก้น"; break;
                                    default: $process = "<label class='text-red'>ไม่ผ่าน</label>";
                                  }
                                echo $process;
                            ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> คืนของ</a></li>
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
                          else if ($this->session->flashdata('showresult') == 'fail3') echo '<div class="alert-message alert alert-danger"> กรุณาสแกนผู้คืนของ</div>';
                          else if ($this->session->flashdata('showresult') == 'fail4') echo '<div class="alert-message alert alert-danger"> Barcode นี้ยังไม่ได้เบิก</div>';

					?>
					<div class="box-header"><h4 class="box-title">กรุณาสแกน Barcode</h4></div>
					<form method="post" name="frmBarcode" id="frmBarcode" action="<?php echo site_url('gemstone/sendgems_back_temp/'.$taskid); ?>">

                    <?php $workername = ""; $worker_id = 0;
                            foreach($worker_array as $loop) {
                              $worker_id = $loop->workid;
                              $workername = $loop->worker_id." ".$loop->firstname." ".$loop->lastname; } ?>

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Barcode *</label>
                                        <input type="hidden" name="taskid" value="<?php //echo $taskid; ?>" />
                                        <input type="hidden" name="workerid" value="<?php echo $worker_id; ?>" />
                                        <input type="text" class="form-control" name="barcode" id="barcode" value="" placeholder="Scan Barcode" autocomplete="off">
										<p class="help-block"><?php echo form_error('barcode'); ?></p>
										<button type="submit" class="btn btn-success btn-lg" onclick="return check_barcode()"><span class="glyphicon glyphicon-barcode"></span> <b> &nbsp; เพิ่มรายการ</b>  </button>
                    </form>

                        <?php if($count == 1) { foreach($temp_array as $loop) {
                                    $task4 = $loop->task4;
                                }
                                               if(($task4==1) && ($getall == 0)) {

                                ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='<?php echo site_url('gemstone/sendgems_back_temp_shlek/'.$taskid."/".$worker_id); ?>'><button type="button" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-barcode"></span> <b> &nbsp; เพิ่มทั้งชุด</b>  </button></a> <?php } } ?>

                                    </div>
							</div>
						</div>


                        <?php if($taskid!=10) { ?>
                        <div class="row">
                            <div class="col-md-8">
                                    <div class="form-group has-error">
                                        <label for="inputError">ผู้คืนของ *</label>
                                        <input type="text" class="form-control input-lg" name="worker_name" id="worker_name" value="<?php echo $workername; ?>" placeholder="ยังไม่พบข้อมูล" readonly>
										<p class="help-block"><?php echo form_error('barcode'); ?></p>
                                    </div>
							</div>
						</div>
                        <?php } ?>
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
                                        <th>ผู้เบิกของ</th>
										<th>Delete</th>
                                    </tr>
                                </thead>
								<tbody>
								<?php
                                    $error_worker = 0;
                                    if(isset($temp_array)) { $i = 1; foreach($temp_array as $loop_index => $loop) { if ($loop->taken_workerid != $loop->worker) { $error_worker++;

								?>
									<td><?php echo $i; ?></td>
									<td><?php echo "<b class='text-red'><u>".$loop->tbarcode."</u></b>-".$loop->supname.$loop->lot."-".$loop->number."(#".$loop->no.")"." ".$loop->typename; ?></td>
                                    <td><?php
                                    if ($loop->taken_workerid != $loop->worker)
                                        echo "<b class='text-red'><u>".$loop->firstname." ".$loop->lastname."</u></b>";
                                    else
                                        echo $loop->firstname." ".$loop->lastname; ?>
                                    </td>
									<td width="50">
									<button type="button" class="btnDelete btn btn-danger btn-xs" onclick="del_confirm(<?php echo $loop->tempid; ?>,<?php echo $taskid; ?>)" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip" title="ลบข้อมูล"><span class="glyphicon glyphicon-remove"></span></button>
									</td>
									</tr>
								<?php $i++; unset($temp_array[$loop_index]); } } }?>

                                <?php if(isset($temp_array)) { foreach($temp_array as $loop) {

								?>
									<td><?php echo $i; ?></td>
									<td><?php echo $loop->tbarcode."-".$loop->supname.$loop->lot."-".$loop->number."(#".$loop->no.")"." ".$loop->typename; ?></td>
                                    <td><?php
                                    if ($loop->taken_workerid != $loop->worker)
                                        echo "<b class='text-red'>".$loop->firstname." ".$loop->lastname."</b>";
                                    else
                                        echo $loop->firstname." ".$loop->lastname; ?>
                                    </td>
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




					</div>
                    <div class="box-footer">
                        <a href="<?php echo site_url("gemstone/saveTemptoBack/".$taskid);  ?>" onClick="return chk_add_worker()"><button type="button" name="submitbtn" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-thumbs-up"></span>&nbsp; <b>ยืนยันรายการทั้งหมด</b>  </button></a>
                        &nbsp; &nbsp; &nbsp; &nbsp;
                        <button type="button" class="btn btn-danger btn-lg" onClick="window.location.href='<?php echo site_url("gemstone/cleartemp_back/".$taskid); ?>'"><span class="glyphicon glyphicon-repeat"></span>&nbsp;<b> เริ่มต้นใหม่ทั้งหมด </b></button>
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

      // $('#barcode').keyup(function(e){ //enter next
      //     if(e.keyCode == 13) {
      //         var barcode =  document.getElementById("barcode").value;
      //         var error_worker = <?php echo $error_worker; ?>;
      //         if (barcode == "*OK*") {
      //             if (error_worker>0) {
      //                 alert("ชื่อผู้คืนของไม่ตรงกับของที่มาคืน !!! \n\nกรุณาตรวจสอบรายการที่มีแสดงเป็นสีแดงด้านบน");
      //                 return false;
      //             }
      //         }
      //         document.getElementById("frmBarcode").submit();
      //     }
      // });

    });

function del_confirm(val1, val2) {
	bootbox.confirm("ต้องการลบข้อมูลที่เลือกไว้ใช่หรือไม่ ?", function(result) {
				var currentForm = this;
				var myurl = <?php echo json_encode($url); ?>;
            	if (result) {

					window.location.replace(myurl+"/"+val1+"/"+val2);
				}

		});

}


$(".alert").alert();
window.setTimeout(function() { $(".alert").alert('close'); }, 4000);

function chk_add_worker()
{
    var worker_name=$('#worker_name').val();
    var error_worker = <?php echo $error_worker; ?>;
    if(worker_name==0){
        alert('กรุณาสแกนผู้คืนของ');
        $('#worker_name').focus();
        return false;
    }else if (error_worker>0) {
        alert("ชื่อผู้คืนของไม่ตรงกับของที่มาคืน !!! \n\nกรุณาตรวจสอบรายการที่มีแสดงเป็นสีแดงด้านบน");
        return false;
    }else{
        form.submitbtn.disabled = true;
        form.submitbtn.value = "Please wait...";
        return true;
    }
}

function check_barcode()
{
    var barcode =  document.getElementById("barcode").value;
    var error_worker = <?php echo $error_worker; ?>;
    if (barcode == "*OK*") {
        if (error_worker>0) {
            alert("ชื่อผู้คืนของไม่ตรงกับของที่มาคืน !!! \n\nกรุณาตรวจสอบรายการที่มีแสดงเป็นสีแดงด้านบน");
            return false;
        }
    }
    document.getElementById("frmBarcode").submit();
}
</script>
</body>
</html>
