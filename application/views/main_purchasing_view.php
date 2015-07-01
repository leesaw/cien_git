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
            Dashboard &nbsp; &nbsp;<small><input type="radio" name="empty" id="factory" value="0"> <label class="text-green"> Factory</label>&nbsp; &nbsp;
              <input type="radio" name="empty" id="purchasing" value="1" checked> <label class="text-red"> Purchasing</label></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          </ol>
        </section>

        <!-- Main content -->
          	<section class="content">

            
<?php 
    

    $count1 = 0;
    foreach($rough1_array as $loop) { 
        $count1++;
        $dataset_rough1[] = array($loop->typename, $loop->amount, $loop->carat);
    }

    $count2 = 0;
    foreach($rough2_array as $loop) { 
        $count2++;
        $dataset_rough2[] = array($loop->typename, $loop->carat);
    }


?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-10">
                    <div class="box box-success">
                        <div class="box-header with-border">
                             <h3 class="box-title">แสดงพลอยสำเร็จทั้งหมดในคลัง</h3>
                        </div>
                        <div class="box-body chart-responsive">
                            <div class="chart" id="bar-rough1" style="height: 300px;"></div>
                        </div>
                        

                
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="box box-success">
                        <div class="box-header with-border">
                             <h3 class="box-title">แสดงพลอยก้อนทั้งหมดในคลัง</h3>
                        </div>
                        <div class="box-body chart-responsive">
                            <div class="chart" id="bar-rough2" style="height: 300px;"></div>
                        </div>

                
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
          
        //BAR CHART finish
        if ($('#bar-rough1').length > 0)
        var morris1 = Morris.Bar({
          element: 'bar-rough1',
          resize: true,
          data: [
              <?php for($i=0; $i<$count1; $i++) { ?>
            {y: <?php echo json_encode($dataset_rough1[$i][0]); ?>, a: <?php echo json_encode($dataset_rough1[$i][1], JSON_NUMERIC_CHECK); ?>, b: <?php echo json_encode($dataset_rough1[$i][2], JSON_NUMERIC_CHECK); ?>},
              <?php } ?>
          ],
          barColors: ['#00a65a', '#5555FF'],
          xkey: 'y',
          ykeys: ['a', 'b'],
          labels: ['จำนวนเม็ด', 'Carat'],
          hideHover: 'auto',
          xLabelAngle: 30
        });
          
        //BAR CHART rough
        if ($('#bar-rough2').length > 0)
        var morris2 = Morris.Bar({
          element: 'bar-rough2',
          resize: true,
          data: [
              <?php for($i=0; $i<$count2; $i++) { ?>
            {y: <?php echo json_encode($dataset_rough2[$i][0]); ?>, a: <?php echo str_replace( ',', '', json_encode($dataset_rough2[$i][1], JSON_NUMERIC_CHECK)); ?>},
              <?php } ?>
          ],
          barColors: ['#AC58FA'],
          xkey: 'y',
          ykeys: ['a'],
          labels: ['Carat'],
          hideHover: 'auto',
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