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
                    <h3 class="box-title">รายงานประจำวันที่ 
                        <?php 
                        $current= date('Y-m-d');
                        $current = date('d/m/Y', strtotime('-1 day', strtotime($current)));
                        echo $current;
                        ?>
                    </h3>
                        </div>
                    <div class="box-body">
                        <form class="form-inline" role="form" action="<?php echo site_url("kpi/viewallstation_between"); ?>" method="POST">
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
                        </form>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">ติดแชล็ก</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="box-body">   
                      <table class="table no-margin">
                          <thead><tr><th>ชื่อ-สกุล</th>
                        <?php
                              foreach($process_list as $loop => $process_result) {
                                  for($i=0; $i<count($table_array); $i++) {
                                      if ($process_result->id==$table_array[$i]['pid']) {
                                          echo "<th>".$process_result->name."</th>";
                                          unset($process_list[$loop]);
                                          break;
                                      }
                                  }
                              }
                        ?>
                              </tr></thead>
                          <tbody>
                        <?php 
                                for($i=0; $i<count($table_array); $i++) { 
                                    echo "<tr><td>".$table_array[$i]['worker']."</td>";
                                    foreach($process_list as $loop) { 
                                        
                                    }
                        ?>
                        <?php } ?>
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