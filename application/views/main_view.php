<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>plugins/fancybox/jquery.fancybox.css" >
<link href="<?php echo base_url(); ?>plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>plugins/datepicker/datepicker3.css" >
<style type="text/css">
.datepicker {z-index: 1151 !important;}
</style>
</head>

<body class="skin-blue">
	<div class="wrapper">
	<?php $this->load->view('menu'); ?>
	
	
	
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard &nbsp; &nbsp;<small><input type="radio" name="empty" id="factory" value="0" checked> <label class="text-green"> Factory</label>&nbsp; &nbsp;
              <?php  if ($this->session->userdata('sessstatus') != 2) { ?><input type="radio" name="empty" id="purchasing" value="1"> <label class="text-red"> Purchasing</label><?php } ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          </ol>
        </section>

        <!-- Main content -->
          	<section class="content">

            
<?php 
    
    $dataset_seven = array();
    foreach($sevenday as $loop) {
        //echo $loop['date']."/".$loop['in']."/".$loop['outgood']."/".$loop['outfail']."<br>";
        $dataset_seven[] = array($loop['date'], $loop['in'], $loop['outgood'], $loop['outfail'], $loop['outreturn']);
    }

    //print_r($dataset_seven);

    $dataset1 = array();
    $dataset_type = array();

    $sum = 0;
    $count = 0;
    foreach($gem_array as $loop) { 
        $dataset_type[] = array($loop->typename, $loop->count, $loop->typeid);
        $count++;
        $sum += $loop->count;
    }

    foreach($station_array as $loop) { 
        switch ($loop->number) {
            case 5: $station = "บล็อกรูปร่าง"; break;
            case 3: $station = "หน้ากระดาน"; break;
            case 4: $station = "ติดแชล็ก"; break;
            case 6: $station = "เจียหน้า"; break;
            case 7: $station = "กลับติดก้นแชล็ก"; break;
            case 8: $station = "บล็อกก้น"; break;
            case 9: $station = "เจียก้น"; break;
            case 11: $station = "QC หน้า"; break;
            case 12: $station = "QC หลัง"; break;
            case 16: $station = "ส่วนกลาง"; break;
        }
        $dataset1[] = array($station, $loop->count);
    }

if ($colorgraph>0) {
    $dataset_color = array();
    $sumcolor = 0;
    foreach($process_array as $loop2) {
        $x = 0;
        foreach($color as $loop) {
            if ($loop2->name == $loop->processname) {
                $dataset_color[] = array($loop->processname, $loop->count, $loop->processid);
                $x++;
                $sumcolor += $loop->count;
            }
        }
        //if ($x<1) $dataset_color[] = array($loop2->name, 0, $loop2->id);
    }
}else{
    $dataset_color = array();
}


?>
        <div class="box-body">
            <div class="row">
                <section class="col-md-8 connectedSortable">
                        <div class="nav-tabs-custom">
                            <div class="tab-content">
                              <div class="tab-pane active" id="tab_1-1">
                                <h4 class="pull-right header">จำนวนของในโรงงานทั้งหมด <u><?php echo $sum; ?></u> ชิ้น</h4><br><br>
                                <div id="bar-type" style="height: 300px;"></div><!--<div id="bar-type" style="height: 300px;"></div> -->
                                  <hr>
                                <button type="button" class="btn btn-success" onClick="window.location.href='<?php echo site_url("report/allBarcode_factory"); ?>'"> <i class="fa fa-barcode"></i> &nbsp;&nbsp; แสดงบาร์โค้ดในโรงงาน </button> &nbsp;&nbsp;
                                <button type="button" class="btn bg-navy" onClick="window.location.href='<?php echo site_url("report/allParcel_factory"); ?>'"> <i class="fa fa-archive"></i> &nbsp;&nbsp; แสดงชุดวัตถุดิบในโรงงาน </button>
                              </div><!-- /.tab-pane -->
                            </div><!-- /.tab-content -->
                          </div><!-- nav-tabs-custom -->
                        </section>
                
                
                        <section class="col-md-3 connectedSortable">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs pull-right">
                              <li class="pull-left header">ของในแต่ละ Station</li>
                            </ul>
                            <div class="tab-content">
                              <div class="tab-pane active" id="tab_1-2">
                                  <div class="table-responsive">
                                    <table class="table no-margin">
                                      <thead>
                                        <tr>
                                          <th>สถานี</th>
                                          <th>จำนวน</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                    <?php

                                        $sum = 0;
                                        foreach($station_array as $loop) { 
                                            echo "<tr><td>";
                                            switch ($loop->number) {
                                                case 5: echo "บล็อกรูปร่าง"; break;
                                                case 3: echo "หน้ากระดาน"; break;
                                                case 4: echo "ติดแชล็ก"; break;
                                                case 6: echo "เจียหน้า"; break;
                                                case 7: echo "กลับติดก้นแชล็ก"; break;
                                                case 8: echo "บล็อกก้น"; break;
                                                case 9: echo "เจียก้น"; break;
                                                case 10: echo "โรงงานโคราช"; break;
                                                case 12: echo "QC หน้า"; break;
                                                case 13: echo "QC ก้น"; break;
                                                case 16: echo "ส่วนกลาง"; break;
                                            }
                                            echo "</td><td>";
                                                echo "<a href='".site_url('report/allBarcode_factory_task/'.$loop->number)."'>";
                                                echo $loop->count;
                                                echo "</a>";

                                            echo "</td></tr>";
                                            $sum += $loop->count;
                                        }
                                        //echo "<tr><th>รวมทั้งหมด</th><th>".$sum."</th></tr>";
                                    ?>
                                      </tbody>
                                    </table>
                                  </div><!-- /.table-responsive -->
                              </div><!-- /.tab-pane -->
                            </div><!-- /.tab-content -->
                          </div><!-- nav-tabs-custom -->
                        </section>
                
                
                

                
                </div>
            <div class="row">
            <div class="col-xs-12">
            
                <div class="box box-primary">
                    <div class="box-body no-padding">
                      <div class="row">
                    <div class="col-xs-12">
                <?php 
                    foreach($center_array as $loop) { 
                        switch ($loop->number) {
                            case 2: $stname= "บล็อกรูปร่าง"; break;
                            case 3: $stname= "หน้ากระดาน"; break;
                            case 1: $stname= "ติดแชล็ก"; break;
                            case 4: $stname= "เจียหน้า"; break;
                            case 6: $stname= "กลับติดก้นแชล็ก"; break;
                            case 7: $stname= "บล็อกก้น"; break;
                            case 8: $stname= "เจียก้น"; break;
                            case 5: $stname= "QC หน้า"; break;
                            case 9: $stname= "QC ก้น"; break;
                            case 10: $stname= "QC ออกจากโรงงาน"; break;
                        }
                ?>
                    <div class="col-xs-1 col-sm-2">
                      <div class="description-block border-right">
                        <h5 class="description-header text-red"><?php echo $loop->count;  ?></h5>
                        <span class="description-text"><?php echo $stname;  ?></span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                <?php
                    }        
                ?>
                    </div>
                  </div> 
                        </div></div></div><!-- /.row -->
                </div>
            <div class="row">
            <?php if ($colorgraph > 0) { ?>
            
            <div class="col-md-3">
                <div class="box box-primary" id="bar-color">
                <div class="box-header with-border">
                    เลือกสี <select onChange="window.location.href=this.value" class="form-control">

                <?php
                    $newline = 0;
                    foreach($gem_array as $loop) { 
                        //echo '&nbsp;&nbsp;&nbsp;<a href="'. site_url("main/index/".$loop->typeid).'#bar-color"><span>'.$loop->typename.'</span></a>&nbsp;&nbsp;&nbsp;|';
                        if ($colorgraph==$loop->typeid) { 
                            $colorname = $loop->typename;
                            echo "<option value='".site_url("main/index/".$loop->typeid."#bar-color")."' selected>".$loop->typename."</option>";
                        } else echo "<option value='".site_url("main/index/".$loop->typeid."#bar-color")."'>".$loop->typename."</option>";
                        $newline++;
                        //if ($newline % 3 == 0) echo "<br>";
                    }
                                  
                ?></select><br>
                  <h3 class="box-title">แสดงประเภทงานสี <?php echo $colorname; ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="box-body">
<?php
    for ($i=0; $i<count($dataset_color); $i++) {
?>
    <div class="progress-group">
        <span class="progress-text"><a href="<?php echo site_url('report/allBarcode_factory_processcolor/'.$colorgraph.'/'.$dataset_color[$i][2]); ?>"><?php echo $dataset_color[$i][0]; ?></a></span>
        <span class="progress-number"><?php echo "<b>".$dataset_color[$i][1]."</b> / ".$sumcolor; ?></span>
        <div class="progress sm">
            <div class="progress-bar progress-bar-blue" style="width: <?php echo $dataset_color[$i][1]*100/$sumcolor; ?>%"></div>
        </div>
    </div><!-- /.progress-group -->
<?php           
    }
?>                      
                </div><!-- /.box-body -->
              </div>
                </div> 
                        
            </div>  <!-- /div row -->
            
            <?php } ?>
                <div class="col-md-8">
                    <div class="box box-success">
                        <div class="box-header with-border">
                             <h3 class="box-title">แสดงของเข้า-ออก 7 วันล่าสุด</h3>
                        </div>
                        <div class="box-body chart-responsive">
                            <div class="chart" id="bar-seven" style="height: 300px;"></div>
                        </div>
                        <div class="box-footer">
                            <a data-toggle="modal" data-target="#myModal" class="btn btn-danger" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="" data-backdrop="static" data-keyboard="false"><i class="fa fa-bar-chart"></i> แสดงเหตุผล QC ไม่ผ่าน</a> &nbsp;&nbsp;
                            <a class="btn bg-purple" href="<?php echo site_url("report/allBarcode_return"); ?>"><i class="fa fa-table"></i> แสดงวัตถุดิบไม่เหมาะสม</a> &nbsp;&nbsp;
                            <a class="btn bg-navy" href="<?php echo site_url("report/allBarcode_return_ok"); ?>"><i class="fa fa-rotate-left"></i> แสดงคืนวัตถุดิบ</a>
                        </div>
                        
                        <!-- datepicker modal for error -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						
						  <div class="modal-dialog modal-md">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title">	                 	
										<strong>เลือกช่วงวันที่ต้องการ</strong> 
									</h4>
								</div>            <!-- /modal-header -->
								<div class="modal-body">
									<form class="form-inline" role="form" action="<?php echo site_url("report/viewErrorBetween"); ?>" method="POST" target="_blank">
									<div class="form-group">
										<label for="">เริ่ม: </label>
										<input type="text" class="form-control" id="startdate" name="startdate" />
									</div>
									<div class="form-group">
										<label for=""> สิ้นสุด :</label>
										<input type="text" class="form-control" id="enddate" name="enddate" />
									</div>
										
								</div>            <!-- /modal-body -->
							
								<div class="modal-footer">
                                    <a class="btn btn-success pull-left" href="<?php echo site_url("report/viewErrorBetween/1"); ?>" target="_blank"><span class="glyphicon glyphicon-play"></span> แสดงทั้งหมด</a>
										<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> ตกลง</button>			
										<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> ปิด</button>
								</div> 	
								</form>								
							</div>
						</div>
					</div>
						
                    </div>
                    <!-- close modal -->

                
                    </div>
                </div>
                </div>
                

            </div>  <!-- div body -->
        </section>
          
          
          
      </div>
	</div>

<?php $this->load->view('js_footer'); ?>
<script src="<?php echo base_url(); ?>plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>plugins/flot/jquery.flot.pie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>plugins/flot/jquery.flot.barnumbers.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>plugins/fancybox/jquery.fancybox.js"></script>
<script src="<?php echo base_url(); ?>plugins/morris/raphael-min.js"></script>
<script src="<?php echo base_url(); ?>plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>plugins/datepicker/bootstrap-datepicker-thai.js"></script>
<script src="<?php echo base_url(); ?>plugins/datepicker/locales/bootstrap-datepicker.th.js"></script>
<script type="text/javascript">

      $(function () {
        "use strict";

          
        //BAR CHART color type
        if ($('#bar-type').length > 0)
        var morris2 = Morris.Bar({
          element: 'bar-type',
          resize: true,
          data: [
              <?php for($i=0; $i<$count; $i++) { ?>
            {y: <?php echo json_encode($dataset_type[$i][0]); ?>, a: <?php echo str_replace( ',', '', json_encode($dataset_type[$i][1], JSON_NUMERIC_CHECK)); ?>, b: <?php echo json_encode($dataset_type[$i][2]); ?>},
              <?php } ?>
          ],
          barColors: ['#FE2E64'],
          xkey: 'y',
          ykeys: ['a'],
          labels: ['เม็ด'],
          hideHover: 'auto',
          xLabelAngle: 30
        }).on('click', function(i, row){
            window.location.replace("<?php echo site_url('report/allBarcode_factory_processcolor'); ?>"+"/"+row.b+"/0");
            //alert("OK"+row.b);
            //console.log(i, row);
        });
          
        //BAR CHART 7days
        if ($('#bar-seven').length > 0)
        var morris2 = Morris.Bar({
          element: 'bar-seven',
          resize: true,
          data: [
            {y: <?php echo json_encode($dataset_seven[6][0]); ?>, a: <?php echo json_encode($dataset_seven[6][1], JSON_NUMERIC_CHECK); ?>, b: <?php echo json_encode($dataset_seven[6][2], JSON_NUMERIC_CHECK); ?>, c: <?php echo json_encode($dataset_seven[6][3], JSON_NUMERIC_CHECK); ?>, d: <?php echo json_encode($dataset_seven[6][4], JSON_NUMERIC_CHECK); ?>},
            {y: <?php echo json_encode($dataset_seven[5][0]); ?>, a: <?php echo json_encode($dataset_seven[5][1], JSON_NUMERIC_CHECK); ?>, b: <?php echo json_encode($dataset_seven[5][2], JSON_NUMERIC_CHECK); ?>, c: <?php echo json_encode($dataset_seven[5][3], JSON_NUMERIC_CHECK); ?>, d: <?php echo json_encode($dataset_seven[5][4], JSON_NUMERIC_CHECK); ?>},
            {y: <?php echo json_encode($dataset_seven[4][0]); ?>, a: <?php echo json_encode($dataset_seven[4][1], JSON_NUMERIC_CHECK); ?>, b: <?php echo json_encode($dataset_seven[4][2], JSON_NUMERIC_CHECK); ?>, c: <?php echo json_encode($dataset_seven[4][3], JSON_NUMERIC_CHECK); ?>, d: <?php echo json_encode($dataset_seven[4][4], JSON_NUMERIC_CHECK); ?>},
            {y: <?php echo json_encode($dataset_seven[3][0]); ?>, a: <?php echo json_encode($dataset_seven[3][1], JSON_NUMERIC_CHECK); ?>, b: <?php echo json_encode($dataset_seven[3][2], JSON_NUMERIC_CHECK); ?>, c: <?php echo json_encode($dataset_seven[3][3], JSON_NUMERIC_CHECK); ?>, d: <?php echo json_encode($dataset_seven[3][4], JSON_NUMERIC_CHECK); ?>},
            {y: <?php echo json_encode($dataset_seven[2][0]); ?>, a: <?php echo json_encode($dataset_seven[2][1], JSON_NUMERIC_CHECK); ?>, b: <?php echo json_encode($dataset_seven[2][2], JSON_NUMERIC_CHECK); ?>, c: <?php echo json_encode($dataset_seven[2][3], JSON_NUMERIC_CHECK); ?>, d: <?php echo json_encode($dataset_seven[2][4], JSON_NUMERIC_CHECK); ?>},
            {y: <?php echo json_encode($dataset_seven[1][0]); ?>, a: <?php echo json_encode($dataset_seven[1][1], JSON_NUMERIC_CHECK); ?>, b: <?php echo json_encode($dataset_seven[1][2], JSON_NUMERIC_CHECK); ?>, c: <?php echo json_encode($dataset_seven[1][3], JSON_NUMERIC_CHECK); ?>, d: <?php echo json_encode($dataset_seven[1][4], JSON_NUMERIC_CHECK); ?>},
            {y: <?php echo json_encode($dataset_seven[0][0]); ?>, a: <?php echo json_encode($dataset_seven[0][1], JSON_NUMERIC_CHECK); ?>, b: <?php echo json_encode($dataset_seven[0][2], JSON_NUMERIC_CHECK); ?>, c: <?php echo json_encode($dataset_seven[0][3], JSON_NUMERIC_CHECK); ?>, d: <?php echo json_encode($dataset_seven[0][4], JSON_NUMERIC_CHECK); ?>}
          ],
          barColors: ['#00a65a', '#5555FF','#FF0000', '#AC58FA'],
          xkey: 'y',
          ykeys: ['a', 'b', 'c', 'd'],
          labels: ['ของเข้า', 'QC ผ่าน', 'QC ไม่ผ่าน', 'วัตถุดิบไม่เหมาะสม'],
          hideHover: 'auto',
          parseTime: false,
          xLabelAngle: 30
        });
          
        $('#factory').on('click', function(){            
            window.location.replace("<?php echo site_url("main/index"); ?>");
        });

        $('#purchasing').on('click', function(){            
            window.location.replace("<?php echo site_url("main/dashboard_purchasing"); ?>");
        });
    });
    
$(document).ready(function()
{
    get_datepicker("#startdate");
    get_datepicker("#enddate");
    
    $('#fancyboxall').fancybox({ 
    'width': '60%',
    'height': '60%', 
    'autoScale':false,
    'transitionIn':'none', 
    'transitionOut':'none', 
    'type':'iframe'}); 
});

function get_datepicker(id)
{

	$(id).datepicker({ language:'th-th',format:'dd/mm/yyyy'
		    });

}
    // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[rel=tooltip]",
        container: "body"
    })
</script>
</body>
</html>