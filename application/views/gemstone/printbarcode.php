<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
</head>

<body>
<?php 

$count = count($barcode_array);
$i = 0;
foreach($barcode_array as $loop) { 
    $phpdate = strtotime($loop->_dateadd);
    $date = date( 'j M Y', $phpdate );

?>    
<div class='barcodecell' align="center"><barcode code='<?php echo str_pad($loop->gemid, 15, "0", STR_PAD_LEFT); ?>' type="C39" size="0.8" text='1' height="0.6" class='barcode' /></div>
<table>
    <tr><td width="50">&nbsp;</td><td width="320"><font style="font-size:10px;"><?php echo $loop->gemid; ?></font></td></tr> 
    <tr><td width="50">&nbsp;</td><td><font style="font-size:12px;"><?php echo $date." &nbsp; &nbsp;".$loop->supname.$loop->lot."-".$loop->number."(#".$loop->no.") &nbsp; &nbsp;".$loop->typename; //echo $loop->id."-".$label."(#".$loop->no.")"; ?></font></td></tr>
    <tr><td width="50">&nbsp;</td><td><font style="font-size:12px;font-weight:bold;"><?php if ($loop->process_name=="Degrade") echo strtoupper($loop->process_name); else echo $loop->process_name; ?></font><font style="font-size:12px;"><?php echo " ".$loop->process_detail; //echo $loop->id."-".$label."(#".$loop->no.")"; ?></font></td></tr>
    <tr><td width="50">&nbsp;</td><td><font style="font-size:12px;font-weight:bold;">Size : <?php echo $loop->size_out; ?></font></td></tr>
</table>
<?php 
$i++;
if ($i < $count) echo "<pagebreak />";
                                  
} ?>

<?php $this->load->view('js_footer2'); ?>

<script src="<?php echo base_url(); ?>plugins/jquery-barcode.min.js"></script>
</body>
</html>