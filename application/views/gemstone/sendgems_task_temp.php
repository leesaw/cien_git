<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
<link href="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
</head>

<body class="skin-blue">
	<div class="wrapper">
	<?php $this->load->view('menu'); ?>
    <?php $url = site_url("gemstone/deletetemp_task"); ?>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php switch($taskid) {
                        case 0: $process = "รับวัตถุไม่เหมาะสมเข้าส่วนกลาง"; break;
                        case 1: $process = "เลือกก้อนเช็ค+เช็คพลอย+เช็คสีของพลอย"; break;
                        case 2: $process = "เช็คความสะอาดของพลอย"; break;
                        case 3: $process = "กดหน้ากระดาน(เงาหน้า 100%)"; break;
                        case 4: $process = "ติดแชล็ก"; break;
                        case 5: $process = "บล็อกรูปร่าง"; break;
                        case 6: $process = "เจียหน้า"; break;
                        case 7: $process = "กลับติดก้นแชล็ก"; break;
                        case 8: $process = "บล็อกก้น"; break;
                        case 9: $process = "เจียก้น"; break;
                        case 10: $process = "ส่งไปโคราช"; break;
                        case 11: $process = "ตรวจ QA"; break;
                        case 12: $process = "QC หน้า"; break;
                        case 13: $process = "QC ก้น"; break;
                        default: $process = "";
                    }
                    if($taskid > 0) echo "เบิกของ > ".$process;
                    else echo $process;
                ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>เบิกของ</a></li>
            <li class="active">Scan Barcode</li>
        </ol>
    </section>

	<section class="content">
		<div class="row">
            <div class="col-lg-8">
                <div class="box box-primary"><div id="alert_block"></div>

				<!-- <?php if ($this->session->flashdata('showresult') == 'success') echo '<div class="alert-message alert alert-success"> ระบบทำการเพิ่มข้อมูลเรียบร้อยแล้ว</div>';
						  else if ($this->session->flashdata('showresult') == 'fail1') echo '<div class="alert-message alert alert-danger"> ไม่มี Barcode นี้ในระบบ</div>';
                          else if ($this->session->flashdata('showresult') == 'fail2') echo '<div class="alert-message alert alert-danger"> Barcode ซ้ำ</div>';
                          else if ($this->session->flashdata('showresult') == 'fail3') echo '<div class="alert-message alert alert-danger"> กรุณาสแกนผู้เบิกของ</div>';
                          else if ($this->session->flashdata('showresult') == 'fail4') echo '<div class="alert-message alert alert-danger"> Barcode นี้ยังไม่ได้รับคืน</div>';
                          else if ($this->session->flashdata('showresult') == 'fail5') echo '<div class="alert-message alert alert-danger"> Barcode นี้ออกจากโรงงานแล้ว</div>';
                          else if ($this->session->flashdata('showresult') == 'fail6') echo '<div class="alert-message alert alert-danger"> Barcode นี้ไม่ใช่วัตถุดิบไม่เหมาะสม</div>';
					      else if ($this->session->flashdata('showresult') == 'fail_seq5') echo '<div class="alert-message alert alert-danger"> Barcode นี้ ไม่ได้ผ่าน 3 ติดแชล็ก</div>';
                          else if ($this->session->flashdata('showresult') == 'fail_seq3') echo '<div class="alert-message alert alert-danger"> Barcode นี้ ไม่ได้ผ่าน 4 บล็อกรูปร่าง</div>';
                          else if ($this->session->flashdata('showresult') == 'fail_seq6') echo '<div class="alert-message alert alert-danger"> Barcode นี้ ไม่ได้ผ่าน 5 กดหน้ากระดาน</div>';
                          else if ($this->session->flashdata('showresult') == 'fail_seq12') echo '<div class="alert-message alert alert-danger"> Barcode นี้ ไม่ได้ผ่าน 6 เจียหน้า</div>';
                          else if ($this->session->flashdata('showresult') == 'fail_seq7') echo '<div class="alert-message alert alert-danger"> Barcode นี้ ไม่ได้ผ่าน QC หน้า</div>';
                          else if ($this->session->flashdata('showresult') == 'fail_seq8') echo '<div class="alert-message alert alert-danger"> Barcode นี้ ไม่ได้ผ่าน 7 กลับติดก้นแชล็ก</div>';
                          else if ($this->session->flashdata('showresult') == 'fail_seq9') echo '<div class="alert-message alert alert-danger"> Barcode นี้ ไม่ได้ผ่าน 8 บล็อกก้น</div>';
                          else if ($this->session->flashdata('showresult') == 'fail_seq13') echo '<div class="alert-message alert alert-danger"> Barcode นี้ ไม่ได้ผ่าน 9 เจียก้น</div>';
					?> -->
					<div class="box-header">
                        <h4 class="box-title">กรุณาสแกน Barcode</h4></div>


                    <?php $workername = ""; $worker_id = 0;
                            foreach($worker_array as $loop) {
                              $worker_id = $loop->workid;
                              $workername = $loop->worker_id." ".$loop->firstname." ".$loop->lastname; } ?>

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Barcode *</label>
                                        <input type="hidden" name="taskid" id="taskid" value="<?php echo $taskid; ?>" />
                                        <input type="hidden" name="workerid" id="workerid" value="<?php echo $worker_id; ?>" />
                                        <input type="text" class="form-control" name="barcode" id="barcode" value="" placeholder="Scan Barcode" autocomplete="off">
										<p class="help-block"><?php echo form_error('barcode'); ?></p>
										<button type="button" class="btn btn-success btn-lg" onclick="return check_barcode()"><span class="glyphicon glyphicon-barcode"></span> <b> &nbsp; เพิ่มรายการ</b>  </button>

                        <?php if (($taskid == 4) && ($getall == 0)) { ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='<?php echo site_url('gemstone/sendgems_task_temp_shlek/'.$taskid.'/'.$worker_id); ?>'><button type="button" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-barcode"></span> <b> &nbsp; เพิ่มทั้งชุด</b>  </button></a> <?php } ?>
                                    </div>
							</div>
						</div>


                        <?php if(($taskid!=10)&&($taskid!=0)) { ?>
                        <div class="row">
                            <div class="col-md-8">
                                    <div class="form-group has-error">
                                        <label for="inputError">ผู้รับของ *</label>
                                        <input type="text" class="form-control input-lg" name="worker_name" id="worker_name" value="<?php echo $workername; ?>" placeholder="ยังไม่พบข้อมูล" readonly>
										<p class="help-block"><?php echo form_error('barcode'); ?></p>
                                    </div>
							</div>
						</div>
                        <?php } ?>
        <div class="row">
			<div class="col-lg-12">
                <div class="panel panel-default">
					<div class="panel-heading" id="count_show"><h3>รวมทั้งหมด <?php echo $count; ?> รายการ</h3></div>
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
								<?php $i = 1; if(isset($temp_array)) { foreach($temp_array as $loop) {

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




					</div>
                    <div class="box-footer">
                        <a href="<?php echo site_url("gemstone/saveTemptoTask/".$taskid);  ?>" onClick="return chk_add_worker()"><button type="button" name="savebtn" id="savebtn" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-thumbs-up"></span>&nbsp; <b>ยืนยันรายการทั้งหมด</b>  </button></a>
                        &nbsp; &nbsp; &nbsp; &nbsp;
                        <button type="button" class="btn btn-danger btn-lg" onClick="window.location.href='<?php echo site_url("gemstone/cleartemp/".$taskid); ?>'"><span class="glyphicon glyphicon-repeat"></span>&nbsp;<b> เริ่มต้นใหม่ทั้งหมด </b></button>
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
var count_list = <?php echo $i; ?>;
    $(document).ready(function()
    {
			$("#barcode").focus();

			document.getElementById("savebtn").disabled = false;

			$('#barcode').keyup(function(e){ //enter next
        if(e.keyCode == 13) {
          var barcode = $.trim($(this).val());
          if(barcode != "")
					{
		        check_barcode();
					}
		      $(this).val('');

				}
			});
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


// $(".alert").alert();
// window.setTimeout(function() { $(".alert").alert('close'); }, 4000);

        function chk_add_worker()
		{
			var worker_name=$('#worker_name').val();
			if(worker_name==0){
				alert('กรุณาสแกนผู้เบิกของ');
				$('#barcode').focus();
				return false;
			}
			document.getElementById("savebtn").disabled = true;
		}

function check_barcode()
{
  var barcode =  document.getElementById("barcode").value;
	var taskid =  document.getElementById("taskid").value;
	var workerid =  document.getElementById("workerid").value;

  if (barcode != "") {
		$.ajax({
			type : "POST",
			url : "<?php echo site_url('gemstone/sendgems_task_temp_ajax'); ?>" ,
			data : {barcode: barcode, taskid: taskid, workerid: workerid, count_list: count_list},
			dataType: 'json',
			success : function(data) {
				if(data.alert == 0)
				{
	          var element = data.barcode;
	          $('table > tbody').append(element);
	          document.getElementById("count_show").innerHTML = "<h3>รวมทั้งหมด "+data.count+" รายการ</h3>";
						// document.getElementById("alert_block").innerHTML = '<div class="alert-message alert alert-success"> ระบบทำการเพิ่มข้อมูลเรียบร้อยแล้ว</div>';
						// window.setTimeout(function() { $(".alert").alert('close'); }, 2000);
	      }else if(data.alert == 1){
					switch(parseInt(data.error_no)) {
						case 11: document.getElementById("alert_block").innerHTML = "<div class='alert-message alert alert-danger'> ไม่มี Barcode นี้ในระบบ</div>"; break;
						case 22: document.getElementById("alert_block").innerHTML = "<div class='alert-message alert alert-danger'> Barcode ซ้ำ</div>"; break;
						case 33: document.getElementById("alert_block").innerHTML = "<div class='alert-message alert alert-danger'> กรุณาสแกนผู้เบิกของ</div>"; break;
						case 44: document.getElementById("alert_block").innerHTML = "<div class='alert-message alert alert-danger'> Barcode นี้ยังไม่ได้รับคืน</div>"; break;
						case 55: document.getElementById("alert_block").innerHTML = "<div class='alert-message alert alert-danger'> Barcode นี้ออกจากโรงงานแล้ว</div>"; break;
						case 66: document.getElementById("alert_block").innerHTML = "<div class='alert-message alert alert-danger'> Barcode นี้ไม่ใช่วัตถุดิบไม่เหมาะสม</div>"; break;
						// not sequence error
						case 3: document.getElementById("alert_block").innerHTML = "<div class='alert-message alert alert-danger'> Barcode นี้ ไม่ได้ผ่าน 4 บล็อกรูปร่าง</div>"; break;
						case 5: document.getElementById("alert_block").innerHTML = "<div class='alert-message alert alert-danger'> Barcode นี้ ไม่ได้ผ่าน 3 ติดแชล็ก</div>"; break;
						case 6: document.getElementById("alert_block").innerHTML = "<div class='alert-message alert alert-danger'> Barcode นี้ ไม่ได้ผ่าน 5 กดหน้ากระดาน</div>"; break;
						case 7: document.getElementById("alert_block").innerHTML = "<div class='alert-message alert alert-danger'> Barcode นี้ ไม่ได้ผ่าน QC หน้า</div>"; break;
						case 8: document.getElementById("alert_block").innerHTML = "<div class='alert-message alert alert-danger'> Barcode นี้ ไม่ได้ผ่าน 7 กลับติดก้นแชล็ก</div>"; break;
						case 9: document.getElementById("alert_block").innerHTML = "<div class='alert-message alert alert-danger'> Barcode นี้ ไม่ได้ผ่าน 8 บล็อกก้น</div>"; break;
						case 12: document.getElementById("alert_block").innerHTML = "<div class='alert-message alert alert-danger'> Barcode นี้ ไม่ได้ผ่าน 6 เจียหน้า</div>"; break;
						case 13: document.getElementById("alert_block").innerHTML = "<div class='alert-message alert alert-danger'> Barcode นี้ ไม่ได้ผ่าน 9 เจียก้น</div>"; break;

					}
					window.setTimeout(function() { $(".alert").alert('close'); }, 4000);
				}else if(data.alert == 2) {
					document.getElementById("worker_name").value = data.worker;
					document.getElementById("workerid").value = data.worker_id;
				}else if(data.alert == 3) {
					window.location.replace("<?php echo site_url("gemstone/saveTemptoTask/".$taskid); ?>");
				}else if(data.alert == 4) {
					window.location.replace("<?php echo site_url("gemstone/cleartemp/".$taskid); ?>");
				}

			},
          error: function (textStatus, errorThrown) {
          alert("เกิดความผิดพลาด !!!");

      }
		});
  }

	document.getElementById("barcode").value = "";
	$("#barcode").focus();
  // document.getElementById("frmBarcode").submit();
}
</script>
</body>
</html>
