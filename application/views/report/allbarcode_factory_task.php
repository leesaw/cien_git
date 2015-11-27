<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
<link href="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>plugins/fancybox/jquery.fancybox.css" >
<link href="<?php echo base_url(); ?>plugins/morris/morris.css" rel="stylesheet" type="text/css" />
</head>

<body class="skin-blue">
	<div class="wrapper">
	<?php $this->load->view('menu'); ?>

<?php 
    $dataset_color = array();
    $num = 0;

    foreach($gemtype as $alltype) {
        $checkcolor = 0;
        foreach($countcolor as $loop) {
            if ($alltype->id == $loop->typeid) { 
                $checkcolor++;
                $dataset_color[] = array($loop->typename, $loop->count);
                break;
            }
        }
        if($checkcolor==0) {
            $dataset_color[] = array($alltype->name, 0);
        }
        $num++;
    }
?>
	
        
        
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <?php 
            switch($task) {
            case '16' : $column = "ส่วนกลาง"; break;
            case '3' : $column = "หน้ากระดาน"; break;
            case '4' : $column = "ติดแชล็ก"; break;
            case '5' : $column = "บล็อกรูปร่าง"; break;
            case '6' : $column = "เจียหน้า"; break;
            case '7' : $column = "กลับติดก้นแชล็ก"; break;
            case '8' : $column = "บล็อกก้น"; break;
            case '9' : $column = "เจียก้น"; break;
            case '12' : $column = "QC หน้า"; break;
            case '13' : $column = "QC ก้น"; break;
            case '10' : $column = "โคราช"; break;
            default : $column = "";
        }
        ?>
        <h1>
            แสดงบาร์โค้ดใน Station : <B><U><?php echo $column; ?></U></B>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> แสดงบาร์โค้ดที่อยู่ใน Station : <?php echo $column; ?></a></li>
        </ol>
    </section>
	
	<section class="content">
        <div class="row">
            <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-body chart-responsive">
                            <div class="chart" id="bar-color" style="height: 300px;"></div>
                            <br>
                        </div>
                    </div>
                </div>
        </div>
		<div class="row">
            <div class="col-md-12">
                <div class="box box-danger">

                        
        <div class="box-body">
            
        <div class="row">
			<div class="col-xs-10">
                <div class="panel panel-default">
					<div class="panel-heading"></div>
                    <div class="panel-body">
                            <table class="table table-bordered table-striped" id="tablebarcode" width="100%">
                                <thead>
                                    <tr>
                                        <th width="150">Barcode</th>
                                        <th>เลขที่ ลำดับ</th>
                                        <th>ชนิด</th>
                                        <th>ประเภทงาน</th>
                                        <th>Size ออก</th>
                                        <th>ผู้เบิก</th>
                                        <th>วันที่เบิก</th>
                                        <th width="50">Manage</th>
                                    </tr>
                                </thead>
                                
								<tbody>

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
		</div>
    
    
	</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
          <iframe src="/user/dashboard" width="300" height="380" frameborder="0" allowtransparency="true"></iframe>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<?php $this->load->view('js_footer'); ?>
<script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables2.js"></script>
<script src="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>plugins/bootbox.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/fancybox/jquery.fancybox.js"></script>
<script src="<?php echo base_url(); ?>plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>plugins/flot/jquery.flot.pie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>plugins/flot/jquery.flot.barnumbers.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>plugins/morris/raphael-min.js"></script>
<script src="<?php echo base_url(); ?>plugins/morris/morris.min.js" type="text/javascript"></script>
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
              { "bSearchable": false },
            ],
            "bDeferRender": true,
            'sAjaxSource'    : '<?php echo site_url("report/ajaxGetAllBarcodeFactory_Task/".$task); ?>',
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
    'width': '60%',
    'height': '60%', 
    'autoScale':false,
    'transitionIn':'none', 
    'transitionOut':'none', 
    'type':'iframe'}); 
    
    var bar_type = {
          data: <?php echo json_encode($dataset_color); ?>,
          color: "#0174DF"
        };
        $.plot("#bar-color", [bar_type], {
          grid: {
            borderWidth: 1,
            borderColor: "#f3f3f3",
            tickColor: "#f3f3f3"
          },
          bars: {
              show: true,
              showNumbers: true,
              barWidth: 0.5,
              align: "center",
              numbers : {
                    yAlign: function(y) { return y/2; }
                }
          },
          xaxis: {
            mode: "categories",
            tickLength: 10
          }
          
        });
    
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