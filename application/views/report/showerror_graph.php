<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
<link href="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>plugins/fancybox/jquery.fancybox.css" >
<link href="<?php echo base_url(); ?>plugins/morris/morris.css" rel="stylesheet" type="text/css" />
</head>

<body class="skin-blue sidebar-collapse fixed">

<?php 
    $dataset_error = array();
    $num = 0;
    foreach($error as $loop) {
        //echo $loop['date']."/".$loop['in']."/".$loop['outgood']."/".$loop['outfail']."<br>";
        $dataset_error[] = array($loop['id'], $loop['name'], $loop['count']);
        $num++;
    }
?>
	
	<section class="content">
		<div class="row">
            <div class="col-md-6">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <?php if ($start == 1) { ?>
                            <h3 class="box-title">แสดง QC ไม่ผ่านทั้งหมด </h3>
                            <?php }else{ ?>
                             <h3 class="box-title">แสดง QC ไม่ผ่านตั้งแต่วันที่ <?php echo $start; ?> ถึง <?php echo $end; ?> </h3>
                            <?php } ?>
                        </div>
                        <div class="box-body chart-responsive">
                            <div class="chart" id="bar-error" style="height: 500px;"></div>
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
					<div class="panel-heading"><form action="<?php echo site_url("report/exportErrorQC_inventory_excel"); ?>" method="post"><input type="hidden" name="start" value="<?php echo $start; ?>"><input type="hidden" name="end" value="<?php echo $end; ?>"><button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span> Excel</button></form></div>
                    <div class="panel-body">
                            <table class="table table-bordered table-striped" id="tablebarcode" width="100%">
                                <thead>
                                    <tr>
                                        <th width="150">Barcode</th>
                                        <th>เลขที่ ลำดับ</th>
                                        <th>ชนิด</th>
                                        <th width="300">สาเหตุ</th>
										<th width="50"> </th>
                                    </tr>
                                </thead>
                                
								<tbody>
                                    <?php  foreach($table as $loop) { ?>
                                    <tr>
                                        <td><?php echo $loop['barcodeid']; ?></td>
                                        <td><?php echo $loop['supname'].$loop['lot']."-".$loop['number']."#".$loop['no']; ?></td>
                                        <td><?php echo $loop['gemtype']; ?></td>
                                        <td><?php echo $loop['errordetail']; ?></td>
                                        <td><div class="tooltip-demo"><a href="<?php echo site_url("gemstone/showdetail_barcode/".$loop['barcodeid']); ?>" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a></div></td>
                                    </tr>
                                    <?php } ?>
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
              { "bSearchable": false },
            ],
            "bDeferRender": true,
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
    
$(function () {
      //BAR CHART
        var bar = new Morris.Bar({
          element: 'bar-error',
          resize: true,
          data: [
            {y: <?php echo json_encode($dataset_error[0][1]); ?>, a: <?php echo json_encode($dataset_error[0][2]); ?>},
            {y: <?php echo json_encode($dataset_error[1][1]); ?>, a: <?php echo json_encode($dataset_error[1][2]); ?>},
            {y: <?php echo json_encode($dataset_error[2][1]); ?>, a: <?php echo json_encode($dataset_error[2][2]); ?>},
            {y: <?php echo json_encode($dataset_error[3][1]); ?>, a: <?php echo json_encode($dataset_error[3][2]); ?>},
            {y: <?php echo json_encode($dataset_error[4][1]); ?>, a: <?php echo json_encode($dataset_error[4][2]); ?>},
            {y: <?php echo json_encode($dataset_error[5][1]); ?>, a: <?php echo json_encode($dataset_error[5][2]); ?>},
            {y: <?php echo json_encode($dataset_error[6][1]); ?>, a: <?php echo json_encode($dataset_error[6][2]); ?>}
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