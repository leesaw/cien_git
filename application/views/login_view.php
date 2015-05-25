<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
</head>
<body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <b>Cien | </b>Gemstone Tracking System
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">เข้าสู่ระบบ</p>
          
        <?php echo validation_errors(); ?>
          
        <?php echo form_open('verifylogin'); ?>
        <div class="form-group has-feedback">
            <input class="form-control" placeholder="Username" name="username" type="username" autofocus>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input class="form-control" placeholder="Password" name="password" type="password" value="">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
          <div class="row">
            <div class="col-xs-4 col-xs-offset-8">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

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