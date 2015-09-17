<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
<link href="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>plugins/fancybox/jquery.fancybox.css" >
</head>

<body class="skin-blue sidebar-collapse fixed">
	
	<section class="content">  
        <div class="row">
			<div class="col-xs-12">
                <div class="panel panel-primary">
					<div class="panel-heading">
                        <h4>แสดง Inventory In/Out 
                        <?php if ($start != '1970-01-01') echo "ตั้งแต่ ".$start." ";
                              echo "จนถึง ".$end;
                              if ($gemtype>0) foreach ($type_array as $loop) if ($loop->id==$gemtype) echo " สี ".$loop->name;
                              if ($processtype>0) foreach ($process_array as $loop) if ($loop->id==$processtype) echo " ประเภทงาน ".$loop->name;
                              if ($supplier>0) foreach ($supplier_array as $loop) if ($loop->id==$supplier) echo " Supplier ".$loop->name;
                        ?>
                        </h4>
                    </div>
                    <div class="panel-body">
                    <p>
                        <a href="<?php echo site_url("report/exportInOut_inventory_excel/".$start."/".$end."/".$gemtype."/".$processtype."/".$supplier); ?>" class="btn btn-success"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span> Excel </a>
                    </p>
                            <table class="table table-bordered table-striped" id="tablebarcode" width="100%">
                                <thead>
                                    <tr>
                                        <th width="60" rowspan="2" style="text-align:center">วันที่เข้า</th>
                                        <th width="120" rowspan="2" style="text-align:center">เลขที่</th>
                                        <th width="80" rowspan="2" style="text-align:center">ชนิด</th>
                                        <th width="100" rowspan="2" style="text-align:center">ประเภทงาน</th>
                                        <th colspan="2" style="text-align:center">ส่งเข้าโรงงาน</th>
                                        <th colspan="3" style="text-align:center">ออกจากโรงงาน</th>
                                        <th width="40" rowspan="2" style="text-align:center">เหลือในโรงงาน</th>
                                        <th width="40" rowspan="2" style="text-align:center">จัดการ</th>
                                    </tr>
                                    <tr><th width="60" style="text-align:center">กะรัต</th><th width="60" style="text-align:center">เม็ด</th><th width="60" style="text-align:center">QC ผ่าน</th><th width="60" style="text-align:center">QC ไม่ผ่าน</th><th width="60" style="text-align:center">ไม่เหมาะสม</th></tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th colspan="4" style="text-align:right">รวมทั้งหมด :</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
				        </table>
					</div>
				</div>
			</div>	
		</div>
        </section>



<?php $this->load->view('js_footer'); ?>
<script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables2.js"></script>
<script src="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>plugins/bootbox.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/fancybox/jquery.fancybox.js"></script>
<script type="text/javascript">
$(document).ready(function()
{    
    var oTable = $('#tablebarcode').dataTable
        ({
            "bJQueryUI": false,
            "bProcessing": true,
            "sPaginationType": "simple_numbers",
            'bServerSide'    : false,
            "aoColumns": [
              null,
              null,
              null,
              null,
              null,
              null,
              null,
              null,
              null,
              null,
              { "bSearchable": false },
            ],
            "bDeferRender": true,
            'sAjaxSource'    : '<?php echo site_url("report/ajaxGetParcelInOut_Process/".$start."/".$end."/".$gemtype."/".$processtype); ?>',
            "fnServerData": function ( sSource, aoData, fnCallback ) {
                $.ajax( {
                    "dataType": 'json',
                    "type": "POST",
                    "url": sSource,
                    "data": aoData,
                    "success":fnCallback
                
                });
            },
            "fnFooterCallback": function ( nRow, aaData, iStart, iEnd, aiDisplay ) {
                    /*
                     * Calculate the total market share for all browsers in this table (ie inc. outside
                     * the pagination)
                     */
                    var total1 = 0;
                    var total2 = 0;
                    var total3 = 0;
                    var total4 = 0;
                    var total5 = 0;
                    var total6 = 0;
                    for ( var i=0 ; i<aaData.length ; i++ )
                    {
                        total1 += parseFloat(aaData[i][4]);
                        total2 += parseInt(aaData[i][5]);
                        total3 += parseInt(aaData[i][6]);
                        total4 += parseInt(aaData[i][7]);
                        total5 += parseInt(aaData[i][8]);
                        total6 += parseInt(aaData[i][9]);
                    }

                    /* Calculate the market share for browsers on this page */
                    var page1 = 0;
                    var page2 = 0;
                    var page3 = 0;
                    var page4 = 0;
                    var page5 = 0;
                    var page6 = 0;
                    for ( var i=iStart ; i<iEnd ; i++ )
                    {
                        page1 += parseFloat(aaData[ aiDisplay[i] ][4]);
                        page2 += parseInt(aaData[ aiDisplay[i] ][5]);
                        page3 += parseInt(aaData[ aiDisplay[i] ][6]);
                        page4 += parseInt(aaData[ aiDisplay[i] ][7]);
                        page5 += parseInt(aaData[ aiDisplay[i] ][8]);
                        page6 += parseInt(aaData[ aiDisplay[i] ][9]);
                    }

                    /* Modify the footer row to match what we want */
                    var nCells = nRow.getElementsByTagName('th');
                    //nCells[1].innerHTML = page1 +'<br>'+ total1;
                    nCells[1].innerHTML = total1.toFixed(2);
                    nCells[2].innerHTML = total2;
                    nCells[3].innerHTML = total3;
                    nCells[4].innerHTML = total4;
                    nCells[5].innerHTML = total5;
                    nCells[6].innerHTML = total6;
                }
            
        });
    
    $('#fancyboxall').fancybox({ 
    'width': '85%',
    'height': '100%', 
    'autoScale':false,
    'transitionIn':'none', 
    'transitionOut':'none', 
    'type':'iframe'}); 
});


$(".alert").alert();
window.setTimeout(function() { $(".alert").alert('close'); }, 4000);

$('.testModal').on('click', function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    $(".modal-body").html('<iframe width="100%" height="100%" frameborder="0" scrolling="no" allowtransparency="true" src="'+url+'"></iframe>');
}); 
</script>
</body>
</html>