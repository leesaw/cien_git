<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
<link href="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>plugins/fancybox/jquery.fancybox.css" >
</head>

<body class="skin-blue sidebar-collapse fixed">
	
	<section class="content">  
        <div class="row">
			<div class="col-xs-10">
                <div class="panel panel-primary">
					<div class="panel-heading">
                        <h4>แสดงจำนวนชุดวัตถุดิบ 
                        <?php if ($start != '1970-01-01') echo "ตั้งแต่ ".$start." ";
                              echo "จนถึง ".$end;
                              if ($gemtype>0) foreach ($type_array as $loop) if ($loop->id==$gemtype) echo " สี ".$loop->name;
                              if ($processtype>0) foreach ($process_array as $loop) if ($loop->id==$processtype) echo " ประเภทงาน ".$loop->name;
                        ?>
                        </h4></div>
                    <div class="panel-body">
                            <table class="table table-bordered table-striped" id="tablebarcode" width="100%">
                                <thead>
                                    <tr>
                                        <th width="60" rowspan="2" style="text-align:center">วันที่เข้า</th>
                                        <th width="120" rowspan="2" style="text-align:center">เลขที่</th>
                                        <th width="80" rowspan="2" style="text-align:center">ชนิด</th>
                                        <th width="100" rowspan="2" style="text-align:center">ประเภทงาน</th>
                                        <th colspan="2" style="text-align:center">ส่งเข้าโรงงาน</th>
                                        <th colspan="3" style="text-align:center">ออกจากโรงงาน</th>
                                        <th width="40" rowspan="2" style="text-align:center">เหลือในโรงงาน</th>
                                        <th width="40" rowspan="2" style="text-align:center">จัดการ</th>
                                    </tr>
                                    <tr><th width="60" style="text-align:center">กะรัต</th><th width="60" style="text-align:center">เม็ด</th><th width="40" style="text-align:center">QC ผ่าน</th><th width="40" style="text-align:center">QC ไม่ผ่าน</th><th width="40" style="text-align:center">ไม่เหมาะสม</th></tr>
                                </thead>
                                
								<tbody>

								</tbody>
                                
							</table>
					</div>
				</div>
			</div>	
		</div>
        </section>



<?php $this->load->view('js_footer'); ?>
<script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables2.js"></script>
<script src="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>plugins/bootbox.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/fancybox/jquery.fancybox.js"></script>
<script type="text/javascript">
$(document).ready(function()
{    
    var oTable = $('#tablebarcode').dataTable
        ({
            "bJQueryUI": false,
            "bProcessing": true,
            "sPaginationType": "simple_numbers",
            'bServerSide'    : false,
            "aoColumns": [
              null,
              null,
              null,
              null,
              null,
              null,
              null,
              null,
              null,
              null,
              { "bSearchable": false },
            ],
            "bDeferRender": true,
            'sAjaxSource'    : '<?php echo site_url("report/ajaxGetParcelInOut_Process/".$start."/".$end."/".$gemtype."/".$processtype); ?>',
            "fnServerData": function ( sSource, aoData, fnCallback ) {
                $.ajax( {
                    "dataType": 'json',
                    "type": "POST",
                    "url": sSource,
                    "data": aoData,
                    "success":fnCallback
                
                });
            }
        });
    
    $('#fancyboxall').fancybox({ 
    'width': '85%',
    'height': '100%', 
    'autoScale':false,
    'transitionIn':'none', 
    'transitionOut':'none', 
    'type':'iframe'}); 
});


$(".alert").alert();
window.setTimeout(function() { $(".alert").alert('close'); }, 4000);

$('.testModal').on('click', function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    $(".modal-body").html('<iframe width="100%" height="100%" frameborder="0" scrolling="no" allowtransparency="true" src="'+url+'"></iframe>');
}); 
</script>
</body>
</html>