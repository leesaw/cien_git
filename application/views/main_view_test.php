<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
</head>

<body class="skin-blue">
	<div class="wrapper">
	<?php $this->load->view('menu'); ?>
	
	
	
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Home
            <small>it all starts here</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          </ol>
        </section>

        <!-- Main content -->
          	<section class="content">
		<div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
					<div class="box-header"><h4 class="box-title">Cien | Gemstone Tracking System </h4></div>

                        
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">จำนวนของในโรงงานทั้งหมด</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                        <tr>
                          <th>ชนิดพลอย</th>
                          <th>จำนวน</th>
                        </tr>
                      </thead>
                      <tbody>
                    <?php

                        $sum = 0;
                        foreach($gem_array as $loop) { 
                            echo "<tr><td>".$loop->typename."</td><td>".$loop->count."</td></tr>";
                            $sum += $loop->count;
                        }
                        echo "<tr><th>รวมทั้งหมด</th><th>".$sum."</th></tr>";
                    ?>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
              </div>
                </div>
            
            </div>
            
<?php 
    $dataset1 = array();
    $dataset_type = array();

    $sum = 0;
    foreach($gem_array as $loop) { 
        /*
        switch ($loop->typename) {
            case 'Ruby': $color = '#FF0000'; break;
            case 'Blue': $color = '#58ACFA'; break;
            case 'Green': $color = '#31B404'; break;
            case 'Yellow': $color = '#F4FA58'; break;
            case 'Orange': $color = '#FE9A2E'; break;
            case 'Purple': $color = '#AC58FA'; break;
            case 'Pink': $color = '#F781D8'; break;
            case 'Light Blue': $color = '#CEE3F6'; break;
            case 'Bangacha': $color = '#31B404'; break;
        }
        $dataset_type[] = array('label' => $loop->typename, 'data' => $loop->count, 'color' => $color );
        */
        $dataset_type[] = array($loop->typename, $loop->count);
        $sum += $loop->count;
    }
    foreach($station_array as $loop) { 
        switch ($loop->number) {
            case 3: $station = "บล็อกรูปร่าง"; break;
            case 4: $station = "หน้ากระดาน"; break;
            case 5: $station = "ติดแชล็ก"; break;
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


?>
                
            <div class="col-md-3">
                <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">จำนวนของในแต่ละ Station</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="box-body">
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
                                case 3: echo "บล็อกรูปร่าง"; break;
                                case 4: echo "หน้ากระดาน"; break;
                                case 5: echo "ติดแชล็ก"; break;
                                case 6: echo "เจียหน้า"; break;
                                case 7: echo "กลับติดก้นแชล็ก"; break;
                                case 8: echo "บล็อกก้น"; break;
                                case 9: echo "เจียก้น"; break;
                                case 11: echo "QC หน้า"; break;
                                case 12: echo "QC หลัง"; break;
                                case 16: echo "ส่วนกลาง"; break;
                            }
                            echo "</td><td>".$loop->count."</td></tr>";
                            $sum += $loop->count;
                        }
                        //echo "<tr><th>รวมทั้งหมด</th><th>".$sum."</th></tr>";
                    ?>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
              </div>
                </div>
                        
					</div>
                </div>
            
            <div class="row">
                <div class="col-md-6">
                  <!-- Bar chart -->
                  <div class="box box-primary">
                    <div class="box-header">
                      <i class="fa fa-bar-chart-o"></i>
                      <h3 class="box-title">จำนวนของในโรงงานทั้งหมด <?php echo $sum; ?> ชิ้น</h3>
                    </div>
                    <div class="box-body">
                      <div id="bar-type" style="height: 300px;"></div>
                    </div><!-- /.box-body-->
                  </div>
                </div>
                
                <div class="col-md-3">
                <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">จำนวนของในแต่ละ Station</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="box-body">
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
                                case 3: echo "บล็อกรูปร่าง"; break;
                                case 4: echo "หน้ากระดาน"; break;
                                case 5: echo "ติดแชล็ก"; break;
                                case 6: echo "เจียหน้า"; break;
                                case 7: echo "กลับติดก้นแชล็ก"; break;
                                case 8: echo "บล็อกก้น"; break;
                                case 9: echo "เจียก้น"; break;
                                case 11: echo "QC หน้า"; break;
                                case 12: echo "QC หลัง"; break;
                                case 16: echo "ส่วนกลาง"; break;
                            }
                            echo "</td><td>".$loop->count."</td></tr>";
                            $sum += $loop->count;
                        }
                        //echo "<tr><th>รวมทั้งหมด</th><th>".$sum."</th></tr>";
                    ?>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
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
<script src="<?php echo base_url(); ?>plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>plugins/flot/jquery.flot.pie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>plugins/flot/jquery.flot.barnumbers.js" type="text/javascript"></script>
<script type="text/javascript">

      $(function () {
          /*
        var bar_data = {
          data: <?php echo json_encode($dataset1); ?>,
          color: "#3c8dbc"
        };
        $.plot("#bar-chart", [bar_data], {
          grid: {
            borderWidth: 1,
            borderColor: "#f3f3f3",
            tickColor: "#f3f3f3"
          },
          bars: {
              show: true,
              showNumbers: true,
              barWidth: 0.3,
              align: "center",
              numbers : {
                    yAlign: function(y) { return y+50; }
                }
          },
          xaxis: {
            mode: "categories",
            tickLength: 0
          }
        });
          */
        var bar_type = {
          data: <?php echo json_encode($dataset_type); ?>,
          color: "#FF0000"
        };
        $.plot("#bar-type", [bar_type], {
          grid: {
            borderWidth: 1,
            borderColor: "#f3f3f3",
            tickColor: "#f3f3f3"
          },
          bars: {
              show: true,
              showNumbers: true,
              barWidth: 0.3,
              align: "center",
              numbers : {
                    yAlign: function(y) { return y+50; }
                }
          },
          xaxis: {
            mode: "categories",
            tickLength: 0
          }
        });

    });
        /*
        var donutData = <?php echo json_encode($dataset_type); ?>;
        $.plot("#donut-chart", donutData, {
          series: {
            pie: {
              show: true,
              radius: 1,
              innerRadius: 0.5,
              label: {
                show: true,
                radius: 2 / 3,
                formatter: labelFormatter,
                threshold: 0.1
              }

            }
          },
          legend: {
            show: false
          }
        });

      });
    
    function labelFormatter(label, series) {
        return "<div style='font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;'>"
                + label
                + "<br/>"
                + Math.round(series.percent) + "%</div>";
      }
      */

</script>
</body>
</html>