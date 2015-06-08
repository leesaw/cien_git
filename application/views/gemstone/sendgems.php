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
            เบิกของ
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> เบิกของ</a></li>
        </ol>
    </section>
	
	<section class="content">
		<div class="row">
            <div class="col-lg-8">
                <div class="box box-primary">
					<div class="box-heading"><h4 class="box-title"> </h4></div>
                    <div class="box-body">
                        <?php   if ($this->session->flashdata('showresult') == 'success')
					    echo '<div class="alert alert-success"> บันทึกข้อมูลในระบบเรียบร้อยแล้ว</div>';
						?>
                        <div class="row">
                            <!--
                            <div class="col-md-5">
                                    <div class="form-group">
                                        <a href="<?php echo site_url("gemstone/sendgems_task_temp/1"); ?>"><button type="button" class="btn btn-primary btn-lg btn-block"><b>1. เลือกก้อนเช็ค+เช็คพลอย+<br>เช็คสีของพลอย</b>  </button></a>
                                    </div>
                            </div>
                            <div class="col-md-5">
                                    <div class="form-group">
                                        <a href="<?php echo site_url("gemstone/sendgems_task_temp/2"); ?>"><button type="button" class="btn btn-success btn-lg btn-block"><b>2. เช็คความสะอาดของพลอย</b> </button></a>
                                    </div>
                            </div>
                            -->
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <a href="<?php echo site_url("gemstone/sendgems_task_temp/4"); ?>"><button type="button" class="btn bg-primary btn-lg btn-block"><b>3. ติดแชล็ก</b>  </button></a>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <a href="<?php echo site_url("gemstone/sendgems_task_temp/5"); ?>"><button type="button" class="btn bg-olive btn-lg btn-block">  <b>4. บล็อกรูปร่าง</b>   </button></a>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <a href="<?php echo site_url("gemstone/sendgems_task_temp/3"); ?>"><button type="button" class="btn btn-info btn-lg btn-block"><b>5. กดหน้ากระดาน(เงาหน้า 100%)</b> </button></a>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <a href="<?php echo site_url("gemstone/sendgems_task_temp/6"); ?>"><button type="button" class="btn bg-purple btn-lg btn-block">  <b>6. เจียหน้า</b>   </button></a>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <a href="<?php echo site_url("gemstone/sendgems_task_temp/7"); ?>"><button type="button" class="btn bg-maroon btn-lg btn-block"> <b>7. กลับติดก้นแชล็ก</b>  </button></a>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <a href="<?php echo site_url("gemstone/sendgems_task_temp/8"); ?>"><button type="button" class="btn bg-navy btn-lg btn-block">  <b>8. บล็อกก้น</b>   </button></a>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <a href="<?php echo site_url("gemstone/sendgems_task_temp/9"); ?>"><button type="button" class="btn btn-danger btn-lg btn-block">  <b>9. เจียก้น</b>  </button></a>
                                    </div>
                            </div>

						</div>
					</div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <a href="<?php echo site_url("gemstone/sendgems_task_temp/12"); ?>"><button type="button" class="btn btn-success btn-lg btn-block"> <b>QC หน้า</b></button></a>
                                    </div>
							</div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <a href="<?php echo site_url("gemstone/sendgems_task_temp/13"); ?>"><button type="button" class="btn btn-warning btn-lg btn-block"> <b>QC ก้น</b></button></a>
                                    </div>
				            </div>
                        </div>
                        <hr><br>
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <a href="<?php echo site_url("gemstone/sendgems_task_temp/10"); ?>"><button type="button" class="btn btn-primary btn-lg btn-block">  <span class="glyphicon glyphicon-send"></span><br><b>ส่งไปโคราช</b>  </button></a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
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
        window.setTimeout(function() { $(".alert").alert('close'); }, 4000);
        

    </script>
</body>
</html>