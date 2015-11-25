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
	
<?php
    $dataset_seven = array();
    foreach($date_array as $loop) {
        //echo $loop['date']."/".$loop['in']."/".$loop['outgood']."/".$loop['outfail']."<br>";
        $day1 = explode('-', $loop->day1);
        $day1= $day1[2]."/".$day1[1]."/".$day1[0];
        if ($point_status == 0) $dataset_seven[] = array($day1, $loop->sum1);
        else $dataset_seven[] = array($day1, $loop->sum2);
    }
        
        
?>
    <?php if ($between_status == 1) { ?>
    <form style="display: hidden" action="<?php echo site_url("kpi/viewstation_between")."/".$taskid; ?>" method="POST" id="form1">
      <input type="hidden" id="startdate_kpi" name="startdate_kpi" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>"/>
      <input type="hidden" id="enddate_kpi" name="enddate_kpi" value="<?php echo date('d/m/Y', strtotime($end_date)); ?>"/>
    </form>
    <form style="display: hidden" action="<?php echo site_url("kpi/viewstation_point_between")."/".$taskid; ?>" method="POST" id="form2">
      <input type="hidden" id="startdate_kpi" name="startdate_kpi" value="<?php echo date('d/m/Y', strtotime($start_date)); ?>"/>
      <input type="hidden" id="enddate_kpi" name="enddate_kpi" value="<?php echo date('d/m/Y', strtotime($end_date)); ?>"/>
    </form>
    <?php } ?>
	
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> KPI</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                    <div class="box-header with-border">
                    <h3 class="box-title">รายงาน <?php switch($taskid) {
                                    
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
                        ประจำวันที่ 
                        <?php 
                        if ($between_status==0) {
                            $current= date('Y-m-d');
                            $current = date('d/m/Y', strtotime('-1 day', strtotime($current)));
                            echo $current;
                        }elseif ($between_status==1) {
                            $start = date('d/m/Y', strtotime($start_date));
                            $end = date('d/m/Y', strtotime($end_date));
                            echo $start." ถึง ".$end;
                        }
                        ?>
                    </h3>
                        </div>
                    <div class="box-body">
                        <form class="form-inline" role="form" action="<?php echo site_url("kpi/viewstation_between")."/".$taskid; ?>" method="POST">
                        เลือกช่วงเวลา : &nbsp; &nbsp;&nbsp; &nbsp;
                        
				        <div class="form-group">
				        เริ่ม
						<input type="text" class="form-control" id="startdate" name="startdate_kpi" />
						</div>
						<div class="form-group">
						&nbsp; &nbsp; สิ้นสุด 
						<input type="text" class="form-control" id="enddate" name="enddate_kpi" />
				        </div>
                        &nbsp;&nbsp;
                        <button type="submit" class="btn btn-success">Filter</button>
                        &nbsp;&nbsp;
                        <a href="<?php echo site_url("kpi/viewstation")."/".$taskid; ?>" class="btn btn-primary">ล่าสุด</a>
                        </form>
                        
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-success">
                        <div class="row">
                        <div class="col-xs-12">
                        <div class="box-header with-border">
                            <h3 class="box-title">แสดงจำนวน <?php echo count($dataset_seven); ?> วันล่าสุด</h3> &nbsp; &nbsp;&nbsp; &nbsp;
                            <input type="radio" name="empty" id="rawdata" value="0" <?php if($point_status==0) echo "checked"; ?>> <label class="text-green"> ข้อมูลดิบ (จำนวนเม็ด)</label>&nbsp; &nbsp;
            <input type="radio" name="empty" id="calculate" value="1" <?php if($point_status==1) echo "checked"; ?>> <label class="text-red" > คำนวณตามประเภทงาน (คะแนน)</label>
                        </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-xs-8">
                        <div class="box-body chart-responsive">
                            <div class="chart" id="graph_sevenday" style="height: 300px;"></div>
                        </div>
                        </div>
                        <div class="col-xs-4">
                            
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">จำนวนแยกตามประเภทงาน</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="box-body">   
                      <table class="table table-bordered">
                          <thead><tr><th>ชื่อ-สกุล</th>
                        <?php
                              $column_no = array();
                              $j = 0;
                              foreach($process_list as $loop => $process_result) {
                                  for($i=0; $i<count($table_array); $i++) {
                                      if ($process_result->id==$table_array[$i]['pid']) {
                                          echo "<th>".$process_result->name."</th>";
                                          $column_no[$j] = $process_result->id;
                                          $j++;
                                          unset($process_list[$loop]);
                                          break;
                                      }
                                  }
                              }
                        ?>
                              <th>รวม</th>
                              </tr></thead>
                          <tbody>
                        <?php 
                            $worker_id = 0;
                            $collect_column = array();
                            $sum_row = 0;
                            $sum_total = 0;
                            $sum_col = array();
                            for($i=0; $i<count($table_array); $i++) { 
                                if($worker_id == 0) {
                                    echo "<tr><td><a class='text-green' href='". site_url("kpi/viewworker/")."/".$table_array[$i]['workerid']."'>".$table_array[$i]['worker']."</a></td>";
                                    for($j=0; $j<count($column_no); $j++) {
                                        $collect_column[$j] = "<td> </td>";
                                        $sum_col[$j] = 0;
                                    }
                                    
                                    $worker_id = $table_array[$i]['workerid'];
                                }elseif ($worker_id!=$table_array[$i]['workerid']) {
                                    $worker_id = $table_array[$i]['workerid'];
                                    for($j=0; $j<count($column_no); $j++) {
                                        echo $collect_column[$j];
                                        $collect_column[$j] = "<td> </td>";
                                    }
                                    echo "<th>".$sum_row."</th>";
                                    //$sum_total += $sum_row;
                                    $sum_row = 0;
                                    echo "<tr><td><a class='text-green' href='". site_url("kpi/viewworker/")."/".$table_array[$i]['workerid']."'>".$table_array[$i]['worker']."</a></td>";
                                }
                                
                                
                                

                                for($j=0; $j<count($column_no); $j++) { 
                                    if ($column_no[$j]==$table_array[$i]['pid']) {
                                        $collect_column[$j] = "<td>".$table_array[$i]['sum1']."</td>";
                                        $sum_row += $table_array[$i]['sum1'];
                                        $sum_total += $table_array[$i]['sum1'];
                                        $sum_col[$j] += $table_array[$i]['sum1'];
                                    }
                                }
                                
                                          
                        ?>
                        <?php }  for($j=0; $j<count($column_no); $j++) {
                                        echo $collect_column[$j];
                                    }
                                    echo "<th>".$sum_row."</th>";
                                    echo "</tr>"; ?>
                              <tr><th>รวม</th>
                              <?php for($j=0; $j<count($sum_col); $j++) { 
                                        echo "<th>".$sum_col[$j]."</th>";
                                    }
                                    echo "<th>".$sum_total."</th>";
                              ?>
                              </tr>
                          </tbody>
                      </table>
                </div><!-- /.box-body -->
              </div>
                </div> 
                        
            </div>  
            </div>  <!-- /div row -->


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
    
    Morris.Line({
      element: 'graph_sevenday',
      data: [
        <?php for($i=0; $i<count($dataset_seven); $i++) { ?>
        { y: <?php echo json_encode($dataset_seven[$i][0]); ?>, a: <?php echo json_encode($dataset_seven[$i][1]); ?> },
        <?php } ?>
      ],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['จำนวนที่ได้','จำนวนที่ต้องทำเพิ่ม'],
      parseTime: false,
      goals: [<?php echo json_encode($kpi_max); ?>, <?php echo json_encode($kpi_mean); ?>],
      goalStrokeWidth: 2.0,
      goalLineColors: ['green', 'red']
    });
    
    $('#rawdata').on('click', function(){            
        <?php if ($between_status==0) echo 'window.location.replace("'.site_url("kpi/viewstation")."/".$taskid.'");'; else echo '$("#form1").submit();'; ?>
    });

    $('#calculate').on('click', function(){            
        <?php if ($between_status==0) echo 'window.location.replace("'.site_url("kpi/viewstation_point")."/".$taskid.'");'; else echo '$("#form2").submit();'; ?>
    });
    
});
    

function get_datepicker(id)
{
    $(id).datepicker({ language:'th-th',format: "dd/mm/yyyy" }).on('changeDate', function(ev){
    $(this).datepicker('hide'); });

}
    // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[rel=tooltip]",
        container: "body"
    })
</script>
</body>
</html>