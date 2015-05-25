<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
</head>

<body class="skin-blue">
	<div id="wrapper">
	<?php $this->load->view('menu'); ?>
	
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            เปลี่ยนรหัสผ่าน
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Change Password</a></li>
        </ol>
    </section>
	
	<section class="content">
		<div class="row">
            <div class="col-lg-6">
                <div class="box box-primary">
				<?php if ($this->session->flashdata('showresult') == 'success') {
						echo '<div class="box-heading"><div class="alert alert-success"> ระบบทำการเปลี่ยนรหัสผ่านเรียบร้อยแล้ว</div>'; 
						?> <button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("main"); ?>'"> กลับไปหน้าแรก </button></div> <?php
					  } else if ($this->session->flashdata('showresult') == 'fail') {
					    echo '<div class="box-heading"><div class="alert alert-danger"> ระบบไม่สามารถเปลี่ยนรหัสผ่านได้</div>';
						?> <button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("main"); ?>'"> กลับไปหน้าแรก </button></div> <?php
					  } else { 
				?>
					<div class="box-heading"><h4 class="box-title">* กรุณาใส่ข้อมูลให้ครบทุกช่อง</h4></div>
					
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php echo form_open('main/updatepass'); ?>
								<?php if ($this->session->flashdata('showresult') == 'failpass') {
										echo '<div class="alert-message alert alert-danger"> รหัสผ่านไม่ถูกต้อง</div>'; }
								?> 
                                    <div class="form-group">
											<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                                            <label>Old Password *</label>
                                            <input type="password" class="form-control" name="opassword" id="opassword">
											<p class="help-block"><?php echo form_error('opassword'); ?></p>
                                    </div>
									<div class="form-group">
                                            <label>New Password *</label>
                                            <input type="password" class="form-control" name="npassword" id="npassword">
											<p class="help-block"><?php echo form_error('npassword'); ?></p>
                                    </div>
									<div class="form-group">
                                            <label>Confirm Password *</label>
                                            <input type="password" class="form-control" name="passconf" id="passconf">
											<p class="help-block"><?php echo form_error('passconf'); ?></p>
                                    </div>

							</div>
						</div>
					</div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">  เปลี่ยนรหัสผ่าน  </button>
				        <button type="button" class="btn btn-warning" onClick="window.location.href='<?php echo site_url("main"); ?>'"> ยกเลิก </button>
                    </div>
				<?php } ?>
				</div>
			</section>
		</div>
	</div>
</form>

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