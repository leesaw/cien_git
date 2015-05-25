<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
<link href="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
</head>

<body class="skin-blue sidebar-collapse fixed">
	<section class="content">
		<div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
					<div class="box-header"><h4 class="box-title">แสดง QC</h4></div>

                        
        <div class="box-body">
                        
        <div class="row">
			<div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                            <table class="table table-striped" id="tablebarcode">
                                <thead>
                                    <tr>
                                        <th>QC</th>
                                        <th>รายละเอียด</th>
                                        <th width="150">วันที่</th>
                                    </tr>
                                </thead>
								<tbody>
								<?php if(isset($task_array)) { foreach($task_array as $loop) { 
                                    
								?>
									<tr><td><?php 
                                        if ($loop->status == 1) echo "QC ผ่าน";
                                        else if ($loop->status == 2) echo "QC ไม่ผ่าน";
                                        else if ($loop->status == 3) echo "ซ่อม";
                                    ?></a></td>
                                    <td><?php echo $loop->detail; ?></td>
                                    <td><?php echo $loop->dateadd; ?></td>
                                    </tr>
                                <?php } } ?>
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



<?php $this->load->view('js_footer'); ?>
<script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>plugins/bootbox.min.js"></script>
<script type="text/javascript" class="init">
$(document).ready(function()
{
    
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
        
</script>
</body>
</html>