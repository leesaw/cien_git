<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
<link href="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
</head>

<body class="skin-blue sidebar-collapse fixed">
	<div class="wrapper">
    <?php $url = site_url("gemstone/deletegem"); ?>
	
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            แสดงงาน
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> แสดงงาน</a></li>
        </ol>
    </section>
	
    <?php
        $barcodeid = "";
        $barcodeshow = "";
        if(isset($gem_array)) { foreach($gem_array as $loop) { 
            $barcodeid = $loop->gemid;
            $barcodeshow = $loop->gembarcode;
        } }
    ?>
  
	<section class="content">
		<div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
					<div class="box-header"><h4 class="box-title">งานทั้งหมดของ <?php echo $barcodeid."-".$barcodeshow; ?></h4></div>

                        
        <div class="box-body">
                        
        <div class="row">
			<div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                            <table class="table table-striped" id="tablebarcode">
                                <thead>
                                    <tr>
                                        <th width="230">งาน</th>
                                        <th>ผู้เบิก</th>
                                        <th width="150">วันที่เบิก</th>
                                        <th width="150">วันที่คืน</th>
                                    </tr>
                                </thead>
								<tbody>
								<?php if(isset($progress_array)) { foreach($progress_array as $loop) { 
                                    
								?>
									<tr><td><?php echo $loop->status; ?></a></td>
                                    <td><?php echo $loop->firstname." ".$loop->lastname; ?></td>
                                    <td><?php echo $loop->dateadd; ?></td>
									</tr>
								<?php } }?>
								</tbody>
							</table>
					</div>
				</div>
			</div>	
		</div>
                        
                        
                        
                        
					</div>
                    <div class="box-footer">

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