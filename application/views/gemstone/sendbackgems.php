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
            เบิก/คืนของ
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> เบิก/คืนของ</a></li>
        </ol>
    </section>
	
	<section class="content">
		<div class="row">
            <div class="col-lg-8">
                <div class="box box-primary">
					<div class="box-heading"><h4 class="box-title"> </h4></div>
                    <div class="box-body">
                        <?php   if ($this->session->flashdata('showresult') == 'success')
					    echo '<div class="alert alert-success"> <i class="icon fa fa-check"></i> บันทึกข้อมูลในระบบเรียบร้อยแล้ว</div>';
						?>
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <a href="<?php echo site_url("gemstone/sendgems"); ?>"><button type="button" class="btn bg-purple btn-lg btn-block"><b>เบิกของ</b> </button></a>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <a href="<?php echo site_url("gemstone/sendgems_back_temp"); ?>"><button type="button" class="btn btn-danger btn-lg btn-block"><b>คืนของ</b>  </button></a>
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
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <a href="<?php echo site_url("gemstone/sendgems_back_temp/10"); ?>"><button type="button" class="btn btn-success btn-lg btn-block">  <span class="glyphicon glyphicon-repeat"></span><br><b>รับคืนจากโคราช</b>  </button></a>
                                    </div>
                            </div>
                        </div>
                        <hr><br>
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <a href="<?php echo site_url("gemstone/sendgems_task_temp/0"); ?>"><button type="button" class="btn bg-orange btn-lg btn-block">  <span class="glyphicon glyphicon-user"></span><br><b>รับวัตถุไม่เหมาะสมเข้าส่วนกลาง</b>  </button></a>
                                    </div>
                            </div>
                        </div>
					</div>
                    <div class="box-footer">
                        
                    </div>
                </div>
			</section>
		</div>
	</div>


<?php $this->load->view('js_footer'); ?>
<script>

        $(".alert").alert();
        window.setTimeout(function() { $(".alert").alert('close'); }, 4000);
        

</script>
</body>
</html>