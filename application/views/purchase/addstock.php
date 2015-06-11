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
            Stone Details
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Stone details</a></li>
        </ol>
    </section>
	
	<section class="content">
		<div class="row">
            <div class="col-lg-8">
                <div class="box box-primary">
				<?php if ($this->session->flashdata('showresult') == 'fail') {
					    echo '<div class="box-heading"><div class="alert alert-danger"> Barcode ซ้ำกับที่มีอยู่ในระบบ</div>';
						?> </div> <?php
					  } 
				?>
					<div class="box-header"><h4 class="box-title">* Please fill in all fields</h4> </div>
                    <form method="post" action="<?php echo site_url('purchase/addgems'); ?> " onSubmit="return chk_add_gems()">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Inventory *</label> 
                                        <div class="input-group">
                                            <input type="hidden" name="stockid" value="<?php if(isset($stockid)) echo $stockid; else echo 0; ?>">
                                            <input type="text" class="form-control" name="stock" id="stock" value="
                                            <?php if(isset($stone_array)) { 
                                                    foreach($stone_array as $loop) {
                                                        echo $loop->detail." ";
                                                    }
                                                }
                                            ?>                              
                                            " disabled>
                                            <div class="input-group-btn">
                                                <a class="btn btn-primary" href="<?php echo site_url('stock/liststock_select'); ?>"> <i class="fa fa-search"></i></a>
                                            </div>
                                        </div>
                                    </div>
							</div>
                        </div>
					</div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-lg">  <i class="fa fa-floppy-o"></i> &nbsp;&nbsp; <b>Next</b>  &nbsp; &nbsp; </button>&nbsp; &nbsp; &nbsp; &nbsp; 
                        <button type="button" class="btn btn-warning btn-lg" onClick="window.location.href='<?php echo site_url("main"); ?>'"> <i class="fa fa-reply"></i> &nbsp;&nbsp; <b>Cancel</b> </button>
                    </div>
                </form>
                </div>
                </div>
			</section>
		</div>
	</div>


<?php $this->load->view('js_footer'); ?>
<script src="<?php echo base_url(); ?>plugins/bootbox.min.js"></script>
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
        
        function chk_add_gems()
		{
			var stock=$('#stock').val();
			if(stock==0){
				alert('กรุณาป้อนเลือกของใน Inventory');
				$('#stock').focus();
				return false;
			}
            if(!ok) {return false;}
		}
        
    </script>
</body>
</html>