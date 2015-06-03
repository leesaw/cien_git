<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
<link href="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
</head>

<body class="skin-blue">
	<div class="wrapper">
	<?php $this->load->view('menu'); ?>
	
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>สร้างบาร์โค้ด</a></li>
        </ol>
    </section>
	
	<section class="content">
		<div class="row">
            <div class="col-lg-8">
                <div class="box box-primary">
				<?php if ($this->session->flashdata('showresult') == 'success') echo '<div class="alert-message alert alert-success"> ระบบทำการเพิ่มข้อมูลเรียบร้อยแล้ว</div>'; 
						  else if ($this->session->flashdata('showresult') == 'fail1') echo '<div class="alert-message alert alert-danger"> ไม่มี Barcode นี้ในระบบ</div>';
                          else if ($this->session->flashdata('showresult') == 'fail2') echo '<div class="alert-message alert alert-danger"> Barcode ซ้ำ</div>';
                          else if ($this->session->flashdata('showresult') == 'fail3') echo '<div class="alert-message alert alert-danger"> กรุณาสแกนผู้เบิกของ</div>';
                          else if ($this->session->flashdata('showresult') == 'fail4') echo '<div class="alert-message alert alert-danger"> Barcode นี้ยังไม่ได้รับคืน</div>';
					
					?>
					<div class="box-header">
                        <h4 class="box-title">กรุณาสแกน Barcode</h4></div>
					<form method="post" action="<?php echo site_url('purchase/add_gemstone_barcode'); ?>">
                        
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Barcode *</label>
                                        <input type="text" class="form-control" name="barcode" id="barcode" value="" placeholder="Scan Barcode">
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
				        <button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-barcode"></span> <b> &nbsp; เพิ่มรายการ</b>  </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
    
    
	</div>


<?php $this->load->view('js_footer'); ?>
<script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>plugins/bootbox.min.js"></script>
<script type="text/javascript">
    $(document).ready(function()
    {
		$("#barcode").focus();

		
    });



$(".alert").alert();
window.setTimeout(function() { $(".alert").alert('close'); }, 4000);

        function chk_add_worker()
		{
			var worker_name=$('#worker_name').val();
			if(worker_name==0){
				alert('กรุณาสแกนผู้เบิกของ');
				$('#worker_name').focus();
				return false;
			}
		}

</script>
</body>
</html>