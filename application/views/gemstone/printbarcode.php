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
    <tr><td width="50">&nbsp;</td><td><font style="font-size:12px;"><?php echo $date." ".$loop->supname.$loop->lot."-".$loop->number."(#".$loop->no.") ".$loop->typename; //echo $loop->id."-".$label."(#".$loop->no.")"; ?></font></td></tr>
<?php if($loop->ptype>1) { ?>
    <tr><td width="50">&nbsp;</td><td><font style="font-size:12px;"><?php echo $loop->process_name." ".$loop->process_detail; //echo $loop->id."-".$label."(#".$loop->no.")"; ?></font></td></tr>
<?php } ?>
</table>
<?php 
$i++;
if ($i < $count) echo "<pagebreak />";
                                  
} ?>

<?php $this->load->view('js_footer2'); ?>

<script src="<?php echo base_url(); ?>plugins/jquery-barcode.min.js"></script>
</body>
</html>