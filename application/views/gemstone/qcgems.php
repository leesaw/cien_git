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
            QC
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> QC</a></li>
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
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <a href="<?php echo site_url("gemstone/qctemp/1"); ?>"><button type="button" class="btn btn-primary btn-lg btn-block"><b>ผ่าน(OK)</b> </button></a>
                                    </div>
                            </div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <a href="<?php echo site_url("gemstone/qctemp/2"); ?>"><button type="button" class="btn btn-danger btn-lg btn-block"><b>ไม่ผ่าน(Not pass)</b>  </button></a>
                                    </div>
                            </div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <a href="<?php echo site_url("gemstone/qctemp/3"); ?>"><button type="button" class="btn btn-warning btn-lg btn-block"><b>ซ่อม</b>  </button></a>
                                    </div>
                            </div>


						</div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <a href="<?php echo site_url("gemstone/qctemp/4"); ?>"><button type="button" class="btn bg-purple btn-lg btn-block"><b>วัตถุดิบไม่เหมาะสม</b> </button></a>
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