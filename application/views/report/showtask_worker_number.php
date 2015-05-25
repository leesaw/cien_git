<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
<link href="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
</head>

<body class="skin-blue sidebar-collapse fixed">
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
					<div class="box-header"><h4 class="box-title">แสดงผู้ทำ</h4></div>

                        
        <div class="box-body">
                        
        <div class="row">
			<div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                            <table class="table table-striped" id="tablebarcode">
                                <thead>
                                    <tr>
                                        <th>ผู้เบิก</th>
                                        <th width="150">วันที่เบิก</th>
                                        <th>ผู้คืน</th>
                                        <th width="150">วันที่คืน</th>
                                    </tr>
                                </thead>
								<tbody>
								<?php if(isset($task_array)) { foreach($task_array as $loop) { 
                                    
								?>
									<tr><td><?php echo $loop->fname." ".$loop->lname; ?></a></td>
                                    <td><?php echo $loop->date ?></td></tr>
                        
                                <?php } }else{ ?>
                                <tr><td> </td>
                                    <td> </td></tr>
                                
                                <?php  }  ?>
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


$(".alert").alert();
window.setTimeout(function() { $(".alert").alert('close'); }, 4000);
        
</script>
</body>
</html>