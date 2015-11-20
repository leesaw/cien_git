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
        $dataset_seven[] = array($day1, $loop->sum1);
    }
        
        
?>
	
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
                    <h3 class="box-title">รายงาน <?php echo $workername; ?>
                    </h3>
                        </div>
                    <div class="box-body">
                        <form class="form-inline" role="form" action="<?php echo site_url("kpi/viewworker_between")."/".$workerid; ?>" method="POST">
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
                        <a href="<?php echo site_url("kpi/viewworker")."/".$workerid; ?>" class="btn btn-primary">ล่าสุด</a>
                        </form>
                        
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                             <h3 class="box-title">แสดงจำนวน <?php echo count($dataset_seven); ?> วันล่าสุด</h3>
                        </div>
                        <div class="box-body chart-responsive">
                            <div class="chart" id="graph_sevenday" style="height: 300px;"></div>
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
                          <thead><tr><th>วันที่</th>
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
                                    $day1 = explode('-', $table_array[$i]['day1']);
                                    $day1= $day1[2]."/".$day1[1]."/".$day1[0];
                                    echo "<tr><td>".$day1."</td>";
                                    for($j=0; $j<count($column_no); $j++) {
                                        $collect_column[$j] = "<td> </td>";
                                        $sum_col[$j] = 0;
                                    }
                                    
                                    $worker_id = $table_array[$i]['day1'];
                                }elseif ($worker_id!=$table_array[$i]['day1']) {
                                    $worker_id = $table_array[$i]['day1'];
                                    for($j=0; $j<count($column_no); $j++) {
                                        echo $collect_column[$j];
                                        $collect_column[$j] = "<td> </td>";
                                    }
                                    echo "<th>".$sum_row."</th>";
                                    //$sum_total += $sum_row;
                                    $sum_row = 0;
                                    $day1 = explode('-', $table_array[$i]['day1']);
                                    $day1= $day1[2]."/".$day1[1]."/".$day1[0];
                                    echo "</tr><tr><td>".$day1."</td>";
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
      labels: ['จำนวนที่ได้'],
      parseTime: false,
      goals: [<?php echo json_encode($kpi_max); ?>, <?php echo json_encode($kpi_mean); ?>],
      goalStrokeWidth: 2.0,
      goalLineColors: ['green', 'red']
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