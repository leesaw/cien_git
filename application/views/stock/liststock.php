<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header_view'); ?>
<link href="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>plugins/fancybox/jquery.fancybox.css" >
</head>

<body class="skin-blue">
	<div class="wrapper">
	<?php $this->load->view('menu'); ?>
    <?php $url = site_url("stock/delete_stone"); ?>
	
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            List Inventory
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> List Inventory</a></li>
        </ol>
    </section>
	
	<section class="content">
		<div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">

             
        <div class="box-body">   
        <div class="row">
			<div class="col-md-12">
                <div class="panel panel-default">
					<div class="panel-heading">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>เลือกสี</label>
                                        <select class="form-control" name="typeid" id="typeid" onChange="listColor(this)">
                                            <option value="0" selected>All Color</option>
                                            <?php 	if(is_array($type_array)) {
                                                        foreach($type_array as $loop){
                                                            echo "<option value='".$loop->id."'>".$loop->name."</option>";
                                                    } } ?>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>เลือกประเภทวัตถุดิบ</label>
                                    <select class="form-control" name="stoneid" id="stoneid" onChange="listType(this)">
                                        <option value="0" <?php if ($stoneid==0) echo "selected"; ?>>ทั้งหมด</option>
                                        <option value="1" <?php if ($stoneid==1) echo "selected"; ?>>พลอยก้อน</option>
                                        <option value="2" <?php if ($stoneid==2) echo "selected"; ?>>พลอยสำเร็จ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                        <input type="radio" name="empty" id="instock" value="0" <?php if($stock=="instock") echo "checked"; ?>> <label class="text-green"> In Stock</label>&nbsp; &nbsp;
                                        <input type="radio" name="empty" id="outstock" value="1" <?php if($stock=="outstock") echo "checked"; ?>> <label class="text-red"> Out of Stock</label>&nbsp; &nbsp;
                                        <input type="radio" name="empty" id="allstock" value="2" <?php if(($stock=="allstock") || ($stock=="")) echo "checked"; ?>> <label class="text-blue"> Show All</label>&nbsp; &nbsp;
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="panel-body">
                            <table class="table table-bordered table-striped" id="tablebarcode" width="100%">
                                <thead>
                                    <tr>
                                        <th width="100" rowspan="2">Date In</th>
                                        <th rowspan="2">Supplier and Lot</th>
                                        <th rowspan="2">Rough</th>
                                        <th rowspan="2">Color</th>
                                        <th rowspan="2">Size</th>
                                        <th rowspan="2">Order</th>
                                        <th width="60" rowspan="2">Quantity</th>
                                        <th width="80" rowspan="2">Carat</th>
                                        <th width="80" rowspan="2">Kilogram (kg.)</th>
                                        <th colspan="2" style="text-align:center">In Stock</th>
										<th width="120" rowspan="2"> </th>
                                    </tr>
                                    <tr>
                                        <th width="60">Quantity</th>
                                        <th width="60">Carat</th>
                                    </tr>
                                </thead>
                                
								<tbody>

								</tbody>
                                
							</table>
					</div>
				</div>
			</div>	
		</div>
                        
                        
                        
                        
					</div>
                </div>
            </div>
        </div>
        </section>
		</div>
    
    
	</div>



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
            "bDeferRender": true,
            'sAjaxSource'    : '<?php echo site_url("stock/ajaxGetListInventory/".$stock); ?>',
            "fnServerData": function ( sSource, aoData, fnCallback ) {
                $.ajax( {
                    "dataType": 'json',
                    "type": "POST",
                    "url": sSource,
                    "data": aoData,
                    "success":fnCallback
                
                });
            }
        });
    
    $('#fancyboxall').fancybox({ 
    'width': '85%',
    'height': '100%', 
    'autoScale':false,
    'transitionIn':'none', 
    'transitionOut':'none', 
    'type':'iframe'
    }); 
    
    $('#fancyboxedit').fancybox({ 
    'width': '85%',
    'height': '100%', 
    'autoScale':false,
    'transitionIn':'none', 
    'transitionOut':'none', 
    'type':'iframe',
    'afterClose': function () { // USE THIS IT IS YOUR ANSWER THE KEY WORD IS "afterClose"
                parent.location.reload(true);
            }
    }); 
    
    $('#fancyboxout').fancybox({ 
    'width': '50%',
    'height': '100%', 
    'autoScale':false,
    'transitionIn':'none', 
    'transitionOut':'none', 
    'type':'iframe',
    'afterClose': function () { // USE THIS IT IS YOUR ANSWER THE KEY WORD IS "afterClose"
                parent.location.reload(true);
            }
    }); 
    
    $('#instock').on('click', function(){            
        window.location.replace("<?php echo site_url("stock/liststock/instock"); ?>");
    });
          
    $('#outstock').on('click', function(){            
        window.location.replace("<?php echo site_url("stock/liststock/outstock"); ?>");
    });
    
    $('#allstock').on('click', function(){            
        window.location.replace("<?php echo site_url("stock/liststock/allstock"); ?>");
    });
});
    
function del_confirm(val1) {
	bootbox.confirm("ต้องการลบข้อมูลที่เลือกไว้ใช่หรือไม่ ?", function(result) {
				var currentForm = this;
				var myurl = <?php echo json_encode($url); ?>;
            	if (result) {
				
					window.location.replace(myurl+"/"+val1);
				}

		});

}
    
function listColor(sel) {
    var var1 = sel.value;
    var stone_type = <?php echo $stoneid; ?>;
    if (var1 == 0) {
        if (stone_type==0) window.location.replace("<?php echo site_url("stock/liststock"); ?>");
        else window.location.replace("<?php echo site_url("stock/liststock_color/0/".$stoneid); ?>");
    }else{
        window.location.replace("<?php echo site_url("stock/liststock_color"); ?>"+"/"+var1+"/"+stone_type);
    }
}
    
function listType(sel) {
    var var1 = sel.value;
    var colorid = <?php echo $colorid; ?>;
    if (var1 == 0) {
        if (colorid==0) window.location.replace("<?php echo site_url("stock/liststock"); ?>");
        else window.location.replace("<?php echo site_url("stock/liststock_color/".$colorid."/0"); ?>");
    }else{
        window.location.replace("<?php echo site_url("stock/liststock_color"); ?>"+"/"+colorid+"/"+var1);
    }
}


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