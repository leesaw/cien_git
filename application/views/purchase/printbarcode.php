<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
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
<div class='barcodecell' align="center"><barcode code='<?php echo $barcode_print; ?>' type="C39" size="1" text='1' height="1" class='barcode' /></div>
<table border="1">

</table>

<?php $this->load->view('js_footer2'); ?>

<script src="<?php echo base_url(); ?>plugins/jquery-barcode.min.js"></script>
</body>
</html>