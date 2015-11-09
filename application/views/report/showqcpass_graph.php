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
    $i=0;
    foreach($color_count as $loop) {
        $dataset_color[] = array($loop['typename'], $loop['count']);
        $i++;
    }
?>
	
        
        
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php if ($start == 1) { ?>
            แสดง QC ผ่านทั้งหมด
        <?php }else{ ?>
            แสดง QC ผ่านตั้งแต่วันที่ <?php echo $start; ?> ถึง <?php echo $end; ?>
        <?php } ?>
        </h1>
    </section>
	
	<section class="content">
        <div class="row">
            <div class="col-md-8">
                    <div class="box box-primary">
                        <div class="box-body chart-responsive">
                            <?php if($i>0) { ?>
                            <div class="chart" id="bar-color" style="height: 500px;"></div>
                            <?php }else{ ?>
                            <label>ไม่มีข้อมูล</label>
                            <?php } ?>
                            <br>
                        </div>
                    </div>
                </div>
        </div>
		<div class="row">
            <div class="col-md-8">
                <div class="box box-danger">

                        
        <div class="box-body">
            
        <div class="row">
			<div class="col-xs-12">
                <div class="panel panel-default">
					<div class="panel-heading"></div>
                    <div class="panel-body">
                            <table class="table table-bordered table-striped" id="tablebarcode" width="100%">
                                <thead>
                                    <tr>
                                        <th width="150">Barcode</th>
                                        <th>เลขที่ ลำดับ</th>
                                        <th>ชนิด</th>
										<th width="50"> </th>
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



<?php $this->load->view('js_footer'); ?>
<script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables2.js"></script>
<script src="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>plugins/bootbox.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/fancybox/jquery.fancybox.js"></script>
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
              { "bSearchable": false },
            ],
            "bDeferRender": true,
            'sAjaxSource'    : '<?php echo site_url("report/ajaxGetAllBarcodeQCpass_color/".$start."/".$end); ?>',
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
    

    
});
    
$(function () {
      //BAR CHART
        var bar = new Morris.Bar({
          element: 'bar-color',
          resize: true,
          data: [
            <?php for($i=0; $i<count($dataset_color); $i++) { ?>
            {y: <?php echo json_encode($dataset_color[$i][0]); ?>, a: <?php echo json_encode($dataset_color[$i][1]); ?>},
            <?php } ?>
          ],
          barColors: ['#FF0000'],
          xkey: 'y',
          padding: 80,
          ykeys: ['a'],
          labels: ['จำนวน'],
          hideHover: 'auto',
          xLabelAngle: 30
        });
});

</script>
</body>
</html>