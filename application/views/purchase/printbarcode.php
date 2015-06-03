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
	}
	
	#bottom {
		bottom: 0;
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
                $phpdate = strtotime($loop->gemdate);
                $date = date( 'j M Y', $phpdate );
            }
        }
?>
<div id="top">
    <table><tr><td width="300">ส่วนสำหรับจัดซื้อ</td><td style="text-align:center"><barcode code='<?php echo $barcode_print; ?>' type="C39" size="1" text='1' height="1" class='barcode' /><br><?php echo $barcode_print; ?>  </td></tr>
    </table>

<hr>
<table>
    <tr><td width="200">Supplier/Lot : <?php echo $supplier.$lot."-".$number; ?></td><td width="180">Date : <?php echo $date; ?></td><td width="120">Quantity : <?php echo $amount; ?></td><td width="120">Carat : <?php echo $carat; ?></td>
    </tr>
</table>
<table>    
    <tr><td width="200" height="40">Type : <?php echo $gemtype; ?></td><td width="225">Size in : <?php echo $size_in ?></td><td width="225">Size out : <?php echo $size_out; ?></td>
    </tr>
    <tr><td>ประเภทงาน : <?php echo $process_name; ?></td><td colspan="2">รายละเอียด : <?php echo $process_detail; ?></td></tr>
</table>
<hr><br><br><br>
<table style="text-align:center">
    <tr><td width="350" height="40" >...............................................</td><td width="350" style="text-align:center">...............................................</td></tr>
    <tr><td height="40">( ณรงค์กช  คมภาสกร )</td><td>( ฝ่ายจัดซื้อ )</td></tr>
    <tr><td height="30">&nbsp; </td><td>&nbsp; </td></tr>
    <tr><td height="40">...............................................</td><td>&nbsp; </td></tr>
    <tr><td height="40">( ฝ่ายโรงงาน )</td><td>&nbsp; </td></tr>
</table>
</div>
<div id="bottom">
<br><br>
    <table><tr><td width="300">ส่วนสำหรับโรงงาน</td><td style="text-align:center"><barcode code='<?php echo $barcode_print; ?>' type="C39" size="1" text='1' height="1" class='barcode' /><br><?php echo $barcode_print; ?>  </td></tr>
    </table>

<hr>
<table>
    <tr><td width="200">Supplier/Lot : <?php echo $supplier.$lot."-".$number; ?></td><td width="180">Date : <?php echo $date; ?></td><td width="120">Quantity : <?php echo $amount; ?></td><td width="120">Carat : <?php echo $carat; ?></td>
    </tr>
</table>
<table>    
    <tr><td width="200" height="40">Type : <?php echo $gemtype; ?></td><td width="225">Size in : <?php echo $size_in ?></td><td width="225">Size out : <?php echo $size_out; ?></td>
    </tr>
    <tr><td>ประเภทงาน : <?php echo $process_name; ?></td><td colspan="2">รายละเอียด : <?php echo $process_detail; ?></td></tr>
</table>
<hr><br><br><br>
<table style="text-align:center">
    <tr><td width="350" height="40" >...............................................</td><td width="350" style="text-align:center">...............................................</td></tr>
    <tr><td height="40">( ณรงค์กช  คมภาสกร )</td><td>( ฝ่ายจัดซื้อ )</td></tr>
    <tr><td height="30">&nbsp; </td><td>&nbsp; </td></tr>
    <tr><td height="40">...............................................</td><td>&nbsp; </td></tr>
    <tr><td height="40">( ฝ่ายโรงงาน )</td><td>&nbsp; </td></tr>
</table>
</div>
<?php $this->load->view('js_footer2'); ?>

<script src="<?php echo base_url(); ?>plugins/jquery-barcode.min.js"></script>
</body>
</html>