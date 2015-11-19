<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
<style type="text/css">
.datepicker {z-index: 1151 !important;}
</style>
</head>

<body class="skin-blue">
	<div id="wrapper">
	<?php $this->load->view('menu'); ?>
	
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            ตั้งค่า
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> ตั้งค่า</a></li>
        </ol>
    </section>
	
	<section class="content">
        <div class="box-body">
		<div class="row">
            <div class="col-xs-6">
                <div class="box box-primary">
                <?php 
                        if ($this->session->flashdata('showresult') == 'true') {
					       echo '<div class="box-heading"><div class="alert alert-success"> ระบบทำการตั้งค่าใหม่เรียบร้อยแล้ว</div>';
						?> </div>
                
                <?php   }else if ($this->session->flashdata('showresult') == 'fail') {
					    echo '<div class="box-heading"><div class="alert alert-danger"> ระบบไม่สามารถตั้งค่าใหม่ได้</div>';
						?> </div> <?php
					  } 
				?>

					<div class="box-header"><h4 class="box-title">* กรุณาใส่ข้อมูลให้ครบทุกช่อง</h4></div>
					
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                <form method="post" action="<?php echo site_url('main/saveconfig'); ?>">
                <?php foreach($config_array as $loop) { 
                    switch($loop->config) {
                        case "LOCK_SEQ_TASK": $text = "บังคับให้เบิกวัตถุดิบตามขั้นตอน <text class='text-red'>( 0 = ข้ามขั้นตอนได้, 1 = บังคับ)</text>"; break;
                        case "KPI_STATION3": $text = "จำนวนเป้าหมาย กดหน้ากระดาน"; break;
                        case "KPI_STATION4": $text = "จำนวนเป้าหมาย ติดแชล็ก"; break;
                        case "KPI_STATION5": $text = "จำนวนเป้าหมาย บล็อกรูปร่าง"; break;
                        case "KPI_STATION6": $text = "จำนวนเป้าหมาย เจียหน้า"; break;
                        case "KPI_STATION7": $text = "จำนวนเป้าหมาย กลับติดก้นแชล็ก"; break;
                        case "KPI_STATION8": $text = "จำนวนเป้าหมาย บล็อกก้น"; break;
                        case "KPI_STATION9": $text = "จำนวนเป้าหมาย เจียก้น"; break;
                        case "KPI_STATION12": $text = "จำนวนเป้าหมาย QC หน้า"; break;
                        case "KPI_STATION13": $text = "จำนวนเป้าหมาย QC ก้น"; break;
                        case "MEAN_STATION3": $text = "จำนวนเฉลี่ย กดหน้ากระดาน"; break;
                        case "MEAN_STATION4": $text = "จำนวนเฉลี่ย ติดแชล็ก"; break;
                        case "MEAN_STATION5": $text = "จำนวนเฉลี่ย บล็อกรูปร่าง"; break;
                        case "MEAN_STATION6": $text = "จำนวนเฉลี่ย เจียหน้า"; break;
                        case "MEAN_STATION7": $text = "จำนวนเฉลี่ย กลับติดก้นแชล็ก"; break;
                        case "MEAN_STATION8": $text = "จำนวนเฉลี่ย บล็อกก้น"; break;
                        case "MEAN_STATION9": $text = "จำนวนเฉลี่ย เจียก้น"; break;
                        case "MEAN_STATION12": $text = "จำนวนเฉลี่ย QC หน้า"; break;
                        case "MEAN_STATION13": $text = "จำนวนเฉลี่ย QC ก้น"; break;
                        default: $text = "ไม่สามารถแสดงข้อความได้";
                    }
                ?>
                                    <div class="form-group">
                                            <label><?php echo $text; ?></label>
                                            <input type="text" class="form-control" name="<?php echo $loop->config; ?>" value="<?php echo $loop->value; ?>">
                                    </div>
                <?php } ?>
                                
							</div>
						</div>
					</div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">  ตั้งค่าใหม่  </button>
				        <button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("main"); ?>'"> ยกเลิก </button>
                        </form>
                    </div>
				</div></div>
			</section>
		</div>
	</div>


<?php $this->load->view('js_footer'); ?>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });

        $(".alert").alert();
        window.setTimeout(function() { $(".alert").alert('close'); }, 2000);
    </script>
</body>
</html>