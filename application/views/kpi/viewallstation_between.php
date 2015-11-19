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
                        $startdate = date('d/m/Y', strtotime($startdate));
                        $enddate = date('d/m/Y', strtotime($enddate));
                        echo $startdate." - ".$enddate;
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
                        &nbsp;&nbsp;
                        <a href="<?php echo site_url("kpi/viewmain"); ?>" class="btn btn-primary">ล่าสุด</a>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><a href="<?php echo site_url("kpi/viewstation/9"); ?>">ติดแชล็ก</a></h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="box-body">
                      <?php $sum=0; foreach($station4_array as $loop) { $sum+=$loop->sum1; }?>   
                      <table class="table no-margin">
                          <thead><tr><th>ชื่อ-สกุล</th><th>จำนวน</th><th>% Percent</th></tr></thead>
                          <tbody>
                        <?php foreach($station4_array as $loop) { ?>     
                          <tr><td><?php echo $loop->firstname." ".$loop->lastname; ?></td>
                          <td><?php echo $loop->sum1; ?></td>
                          <td><?php echo number_format($loop->sum1/$sum*100, 2, '.', ''); ?></td></tr>
                        <?php } ?>
                          <tr><th>Total</th><th><?php echo $sum; ?></th><td> </td></tr></tbody>
                      </table>
                </div><!-- /.box-body -->
              </div>
                </div> 
                        
            </div>  
            <div class="col-md-3">
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><a href="<?php echo site_url("kpi/viewstation/9"); ?>">บล็อกรูปร่าง</a></h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="box-body">
                      <?php $sum=0; foreach($station5_array as $loop) { $sum+=$loop->sum1; }?>   
                      <table class="table no-margin">
                          <thead><tr><th>ชื่อ-สกุล</th><th>จำนวน</th><th>% Percent</th></tr></thead>
                          <tbody>
                        <?php foreach($station5_array as $loop) { ?>     
                          <tr><td><?php echo $loop->firstname." ".$loop->lastname; ?></td>
                          <td><?php echo $loop->sum1; ?></td>
                          <td><?php echo number_format($loop->sum1/$sum*100, 2, '.', ''); ?></td></tr>
                        <?php } ?>
                          <tr><th>Total</th><th><?php echo $sum; ?></th><td> </td></tr></tbody>
                      </table>
                </div><!-- /.box-body -->
              </div>
                </div> 
                        
            </div>  
            <div class="col-md-3">
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><a href="<?php echo site_url("kpi/viewstation/9"); ?>">กดหน้ากระดาน</a></h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="box-body">
                      <?php $sum=0; foreach($station3_array as $loop) { $sum+=$loop->sum1; }?>   
                      <table class="table no-margin">
                          <thead><tr><th>ชื่อ-สกุล</th><th>จำนวน</th><th>% Percent</th></tr></thead>
                          <tbody>
                        <?php foreach($station3_array as $loop) { ?>     
                          <tr><td><?php echo $loop->firstname." ".$loop->lastname; ?></td>
                          <td><?php echo $loop->sum1; ?></td>
                          <td><?php echo number_format($loop->sum1/$sum*100, 2, '.', ''); ?></td></tr>
                        <?php } ?>
                          <tr><th>Total</th><th><?php echo $sum; ?></th><td> </td></tr></tbody>
                      </table>
                </div><!-- /.box-body -->
              </div>
                </div> 
                        
            </div>  
                
            <div class="col-md-3">
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><a href="<?php echo site_url("kpi/viewstation/9"); ?>">เจียรหน้า</a></h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="box-body">
                      <?php $sum=0; foreach($station6_array as $loop) { $sum+=$loop->sum1; }?>   
                      <table class="table no-margin">
                          <thead><tr><th>ชื่อ-สกุล</th><th>จำนวน</th><th>% Percent</th></tr></thead>
                          <tbody>
                        <?php foreach($station6_array as $loop) { ?>     
                          <tr><td><?php echo $loop->firstname." ".$loop->lastname; ?></td>
                          <td><?php echo $loop->sum1; ?></td>
                          <td><?php echo number_format($loop->sum1/$sum*100, 2, '.', ''); ?></td></tr>
                        <?php } ?>
                          <tr><th>Total</th><th><?php echo $sum; ?></th><td> </td></tr></tbody>
                      </table>
                </div>
              </div>
                </div> 
                </div>
            </div>  <!-- /div row -->
            
            <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><a href="<?php echo site_url("kpi/viewstation/9"); ?>">QC หน้า</a></h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="box-body">
                      <?php $sum=0; foreach($station12_array as $loop) { $sum+=$loop->sum1; }?>   
                      <table class="table no-margin">
                          <thead><tr><th>ชื่อ-สกุล</th><th>จำนวน</th><th>% Percent</th></tr></thead>
                          <tbody>
                        <?php foreach($station12_array as $loop) { ?>     
                          <tr><td><?php echo $loop->firstname." ".$loop->lastname; ?></td>
                          <td><?php echo $loop->sum1; ?></td>
                          <td><?php echo number_format($loop->sum1/$sum*100, 2, '.', ''); ?></td></tr>
                        <?php } ?>
                          <tr><th>Total</th><th><?php echo $sum; ?></th><td> </td></tr></tbody>
                      </table>
                </div><!-- /.box-body -->
              </div>
                </div> 
                        
            </div>  
            <div class="col-md-3">
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><a href="<?php echo site_url("kpi/viewstation/9"); ?>">กลับติดก้นแชล็ก</a></h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="box-body">
                      <?php $sum=0; foreach($station7_array as $loop) { $sum+=$loop->sum1; }?>   
                      <table class="table no-margin">
                          <thead><tr><th>ชื่อ-สกุล</th><th>จำนวน</th><th>% Percent</th></tr></thead>
                          <tbody>
                        <?php foreach($station7_array as $loop) { ?>     
                          <tr><td><?php echo $loop->firstname." ".$loop->lastname; ?></td>
                          <td><?php echo $loop->sum1; ?></td>
                          <td><?php echo number_format($loop->sum1/$sum*100, 2, '.', ''); ?></td></tr>
                        <?php } ?>
                          <tr><th>Total</th><th><?php echo $sum; ?></th><td> </td></tr></tbody>
                      </table>
                </div><!-- /.box-body -->
              </div>
                </div> 
                        
            </div>  
            <div class="col-md-3">
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><a href="<?php echo site_url("kpi/viewstation/9"); ?>">บล็อกก้น</a></h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="box-body">
                      <?php $sum=0; foreach($station8_array as $loop) { $sum+=$loop->sum1; }?>   
                      <table class="table no-margin">
                          <thead><tr><th>ชื่อ-สกุล</th><th>จำนวน</th><th>% Percent</th></tr></thead>
                          <tbody>
                        <?php foreach($station8_array as $loop) { ?>     
                          <tr><td><?php echo $loop->firstname." ".$loop->lastname; ?></td>
                          <td><?php echo $loop->sum1; ?></td>
                          <td><?php echo number_format($loop->sum1/$sum*100, 2, '.', ''); ?></td></tr>
                        <?php } ?>
                          <tr><th>Total</th><th><?php echo $sum; ?></th><td> </td></tr></tbody>
                      </table>
                </div><!-- /.box-body -->
              </div>
                </div> 
                        
            </div>  
                
            <div class="col-md-3">
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><a href="<?php echo site_url("kpi/viewstation/9"); ?>">เจียรก้น</a></h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="box-body">
                      <?php $sum=0; foreach($station9_array as $loop) { $sum+=$loop->sum1; }?>   
                      <table class="table no-margin">
                          <thead><tr><th>ชื่อ-สกุล</th><th>จำนวน</th><th>% Percent</th></tr></thead>
                          <tbody>
                        <?php foreach($station9_array as $loop) { ?>     
                          <tr><td><?php echo $loop->firstname." ".$loop->lastname; ?></td>
                          <td><?php echo $loop->sum1; ?></td>
                          <td><?php echo number_format($loop->sum1/$sum*100, 2, '.', ''); ?></td></tr>
                        <?php } ?>
                          <tr><th>Total</th><th><?php echo $sum; ?></th><td> </td></tr></tbody>
                      </table>
                </div>
              </div>
                </div> 
                </div>
            </div>  <!-- /div row -->

            <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><a href="<?php echo site_url("kpi/viewstation/9"); ?>">QC ก้น</a></h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="box-body">
                      <?php $sum=0; foreach($station13_array as $loop) { $sum+=$loop->sum1; }?>   
                      <table class="table no-margin">
                          <thead><tr><th>ชื่อ-สกุล</th><th>จำนวน</th><th>% Percent</th></tr></thead>
                          <tbody>
                        <?php foreach($station13_array as $loop) { ?>     
                          <tr><tr><td><?php echo $loop->firstname." ".$loop->lastname; ?></td>
                          <td><?php echo $loop->sum1; ?></td>
                          <td><?php echo number_format($loop->sum1/$sum*100, 2, '.', ''); ?></td></tr>
                        <?php } ?>
                          <tr><th>Total</th><th><?php echo $sum; ?></th><td> </td></tr></tbody>
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