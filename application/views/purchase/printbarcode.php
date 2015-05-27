<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
<style type='text/css'>
    #top,
	#bottom {
		position: fixed;
		left: 0;
		right: 0;
		height: 50%;
	}
	
	#top {
		top: 0;
		background-color: orange;
	}
	
	#bottom {
		bottom: 0;
		background-color: green;
	}
</style>
</head>

<body>
<?php
        if(is_array($barcode_array)) {
            foreach($barcode_array as $loop) {
                $barcode_print = $loop->gembarcode;
                //$barcode_print = $loop->gemid;
                $supplier = $loop->supname;
                $number = $loop->number;
                $lot = $loop->lot;
                $color = $loop->color;
                $gemtype = $loop->gemtype;
                $size_out = $loop->gemsize;
                $size_in = $loop->size_in;
                $amount = $loop->amount;
                $carat = $loop->carat;
                $process_name = $loop->process_name;
                $process_detail = $loop->process_detail;
            }
        }
?>
<div id="top">
	
<div class='barcodecell' align="left"><barcode code='<?php echo $barcode_print; ?>' type="C39" size="1" text='1' height="1" class='barcode' /></div>
<table border="1">

</table>
</div>
<div id="bottom">
<div class='barcodecell' align="left"><barcode code='<?php echo $barcode_print; ?>' type="C39" size="1" text='1' height="1" class='barcode' /></div>
<table border="1">

</table>
</div>
<?php $this->load->view('js_footer2'); ?>

<script src="<?php echo base_url(); ?>plugins/jquery-barcode.min.js"></script>
</body>
</html>