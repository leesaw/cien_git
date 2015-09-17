<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('stock_model','',TRUE);
        $this->load->model('gemstone_model','',TRUE);
		$this->load->library('form_validation');
		if (!($this->session->userdata('sessusername'))) redirect('login', 'refresh');
	}
    
	function index()
	{

	}
    
    function addstock()
    {
        $this->load->helper(array('form'));
        
        $this->load->model('supplier','',TRUE);
		$query = $this->supplier->getSupplier();
		if($query){
			$data['supplier_array'] =  $query;
		}else{
			$data['supplier_array'] = array();
		}
        
        //$this->load->model('gemstone_model','',TRUE);
		$query = $this->gemstone_model->getGemstoneType();
		if($query){
			$data['type_array'] =  $query;
		}else{
			$data['type_array'] = array();
		}
        
        $query = $this->gemstone_model->getProcessType();
		if($query){
			$data['process_array'] =  $query;
		}else{
			$data['process_array'] = array();
		}
        
		$data['title'] = "Cien|Gemstone Tracking System - New Stone";
		$this->load->view('stock/addstock',$data);
    }
    
    function savestock()
	{
        $rough = $this->input->post("roughtype");
        $datein = $this->input->post("datein");
        if ($datein != "") {
            $datein = explode('/', $datein);
            $datein= $datein[2]."-".$datein[1]."-".$datein[0];
        }else{
            $datein= explode('/',date("d/m/y"));
            $datein= $datein[0].$datein[1].$datein[2];
        }
        
        $supplier = explode("_",$this->input->post('supplierid'));
        $supplier_id = $supplier[0];
        $supplier_barcode = $supplier[1];
        
        $lot = $this->input->post('lot');
        $amount = $this->input->post('amount');
        $carat = $this->input->post('carat');
        $kilogram = $this->input->post('kilogram');

        $type = explode("_",$this->input->post('typeid'));
        $type_id = $type[0];
        $type_barcode = $type[1];
        
        $order = $this->input->post('order');
        $size = $this->input->post('size');
        $color = $this->input->post('color');
        $datetime = date('Y-m-d H:i:s');

        $gemstone = array(
            'stone_type' => $rough,
            'supplier' => $supplier_id,
            'lot' => $lot,
            'order_type' => $order,
            'type' => $type_id,
            'color' => $color,
            'datein' => $datein,
            'dateadd' => $datetime,
            'carat' => $carat,
            'amount' => $amount,
            'kilogram' => $kilogram,
            'size' => $size
        );
            
        $result = $this->stock_model->addStock($gemstone);

        
        if ($result){
            $this->session->set_flashdata('showresult', 'true');
        }else{
            $this->session->set_flashdata('showresult', 'fail');
        }

		
        $this->load->model('supplier','',TRUE);
        $query = $this->supplier->getSupplier();
        if($query){
            $data['supplier_array'] =  $query;
        }else{
            $data['supplier_array'] = array();
        }

        $query = $this->gemstone_model->getGemstoneType();
        if($query){
            $data['type_array'] =  $query;
        }else{
            $data['type_array'] = array();
        }
        
                
        $query = $this->gemstone_model->getProcessType();
		if($query){
			$data['process_array'] =  $query;
		}else{
			$data['process_array'] = array();
		}


        $data['title'] = "Cien|Gemstone Tracking System - Add Stock";
        redirect('stock/addstock', 'refresh');


	}
    
    function editstock()
	{
        $stockid = $this->input->post("stoneid");
        $rough = $this->input->post("roughtype");
        $datein = $this->input->post("datein");
        if ($datein != "") {
            $datein = explode('/', $datein);
            $datein= $datein[2]."-".$datein[1]."-".$datein[0];
        }else{
            $datein= explode('/',date("d/m/y"));
            $datein= $datein[0].$datein[1].$datein[2];
        }
        
        $supplier = explode("_",$this->input->post('supplierid'));
        $supplier_id = $supplier[0];
        $supplier_barcode = $supplier[1];
        
        $lot = $this->input->post('lot');
        $amount = $this->input->post('amount');
        $carat = $this->input->post('carat');
        $kilogram = $this->input->post('kilogram');

        $type = explode("_",$this->input->post('typeid'));
        $type_id = $type[0];
        $type_barcode = $type[1];
        
        $order = $this->input->post('order');
        $size = $this->input->post('size');
        $color = $this->input->post('color');
        $datetime = date('Y-m-d H:i:s');

        $gemstone = array(
            'id' => $stockid,
            'stone_type' => $rough,
            'supplier' => $supplier_id,
            'lot' => $lot,
            'order_type' => $order,
            'type' => $type_id,
            'color' => $color,
            'datein' => $datein,
            'dateadd' => $datetime,
            'carat' => $carat,
            'amount' => $amount,
            'kilogram' => $kilogram,
            'size' => $size
        );
            
        $result = $this->stock_model->editStock($gemstone);

        
        if ($result){
            $this->session->set_flashdata('showresult', 'true');
        }else{
            $this->session->set_flashdata('showresult', 'fail');
        }

		
        $this->load->model('supplier','',TRUE);
        $query = $this->supplier->getSupplier();
        if($query){
            $data['supplier_array'] =  $query;
        }else{
            $data['supplier_array'] = array();
        }

        $query = $this->gemstone_model->getGemstoneType();
        if($query){
            $data['type_array'] =  $query;
        }else{
            $data['type_array'] = array();
        }
        
                
        $query = $this->gemstone_model->getProcessType();
		if($query){
			$data['process_array'] =  $query;
		}else{
			$data['process_array'] = array();
		}

        $query = $this->stock_model->getStone_purchase($stockid);
        $data['stone_array'] = $query;
        
        $data['stoneid'] = $stockid;
        $data['title'] = "Cien|Gemstone Tracking System - Edit Stone";
        redirect('stock/edit_stone', 'refresh');


	}
    
    function editstock_out()
	{
        $stockid = $this->input->post("stoneid");
        $reason = $this->input->post('reason');
        $detail = $this->input->post('detail');
        $amount = $this->input->post('amount');
        $carat = $this->input->post('carat');
        $datetime = date('Y-m-d H:i:s');

        $gemstone = array(
            'gemstone_stock_id' => $stockid,
            'reason' => $reason,
            'detail' => $detail,
            'carat' => $carat,
            'amount' => $amount,
            'dateadd' => $datetime,
            'userid' => $this->session->userdata('sessid')
        );
            
        $result = $this->stock_model->addStockCut($gemstone);
        
        // update amount_out and carat_out
        $stock = array('carat_out' => $carat, 'amount_out' => $amount, 'id' => $stockid);
        $this->stock_model->editAmountCaratOut($stock,'plus');
        
        if ($result){
            $this->session->set_flashdata('showresult', 'true');
        }else{
            $this->session->set_flashdata('showresult', 'fail');
        }

        $query = $this->stock_model->getStone_purchase($stockid);
        $data['stone_array'] = $query;
        
        $data['stockid'] = $stockid;
        $data['title'] = "Cien|Gemstone Tracking System - Edit Stone";
        redirect('stock/out_stone', 'refresh');

	}
    
    function editstock_split()
	{
        $stockid = $this->input->post("stoneid");
        $reason = $this->input->post('reason');
        $detail = $this->input->post('detail');
        $amount = $this->input->post('amount');
        $carat = $this->input->post('carat');
        $datetime = date('Y-m-d H:i:s');

        $gemstone = array(
            'gemstone_stock_id' => $stockid,
            'reason' => $reason,
            'detail' => $detail,
            'carat' => $carat,
            'amount' => $amount,
            'dateadd' => $datetime,
            'userid' => $this->session->userdata('sessid')
        );
            
        $result = $this->stock_model->addStockSplit($gemstone);
        
        // update amount_out and carat_out
        $stock = array('carat_out' => $carat, 'amount_out' => $amount, 'id' => $stockid);
        $this->stock_model->editAmountCaratSplit($stock, $reason, 'plus');
        
        if ($result){
            $this->session->set_flashdata('showresult', 'true');
        }else{
            $this->session->set_flashdata('showresult', 'fail');
        }

        $data['title'] = "Cien|Gemstone Tracking System - Edit Stone";
        redirect('stock/split_stone', 'refresh');

	}
    
    function liststock()
    {
        $query = $this->gemstone_model->getGemstoneType();
		if($query){
			$data['type_array'] =  $query;
		}else{
			$data['type_array'] = array();
		}
        
        $this->load->model('supplier','',TRUE);
        $query = $this->supplier->getSupplier();
        if($query){
            $data['supplier_array'] =  $query;
        }else{
            $data['supplier_array'] = array();
        }
        
        $data['colorid'] = 0;
        $data['stoneid'] = 0;
        $data['supplierid'] = 0;
        $data['month'] = "";
        $data['stock'] = 2;  // 2=show all , 0=instock, 1=outstock
        $data['title'] = "Cien|Gemstone Tracking System - List Inventory";
        $this->load->view('stock/liststock',$data);
    }
    
    function liststock_search()
    {
        $query = $this->gemstone_model->getGemstoneType();
		if($query){
			$data['type_array'] =  $query;
		}else{
			$data['type_array'] = array();
		}
        
        $this->load->model('supplier','',TRUE);
        $query = $this->supplier->getSupplier();
        if($query){
            $data['supplier_array'] =  $query;
        }else{
            $data['supplier_array'] = array();
        }
        
        $data['colorid'] = $this->input->get('typeid');
        $data['stoneid'] = $this->input->get('stoneid');
        $data['supplierid'] = $this->input->get('supplierid');
        $data['month'] = $this->input->get('month');
        $data['stock'] = $this->input->get('stock');
        $data['title'] = "Cien|Gemstone Tracking System - List Inventory";
        $this->load->view('stock/liststock',$data);
    }
    
    function liststock_color()
    {
        $data['colorid'] = $this->uri->segment(3);
        $data['stoneid'] = $this->uri->segment(4);
        $data['stock'] = $this->uri->segment(5);
        $query = $this->gemstone_model->getGemstoneType();
		if($query){
			$data['type_array'] =  $query;
		}else{
			$data['type_array'] = array();
		}
        
        $data['title'] = "Cien|Gemstone Tracking System - List Inventory";
        $this->load->view('stock/liststock_color',$data);
    }
    
    function view_stone()
    {
        $id = $this->uri->segment(3);
        
        $query = $this->stock_model->getStockOutList($id);
        $data['parcel_array'] = $query;
        
        $query = $this->stock_model->getStockCutList($id);
        $data['cut_array'] = $query;
        
        $query = $this->stock_model->getStockSplitList($id);
        $data['split_array'] = $query;
        
        $data['id'] = $id;
        if ($this->uri->segment(4) > 0) 
            $data['nodelete'] = $this->uri->segment(4);
        else
            $data['nodelete'] = 0;
        
        $data['title'] = "Cien|Gemstone Tracking System - View Stone";
        $this->load->view('stock/view_stone',$data);
    }
    
    function edit_stone()
    {
        $id = $this->uri->segment(3);
        
        $query = $this->stock_model->getStone_purchase($id);
        $data['stone_array'] = $query;
        
        $this->load->model('supplier','',TRUE);
		$query = $this->supplier->getSupplier();
		if($query){
			$data['supplier_array'] =  $query;
		}else{
			$data['supplier_array'] = array();
		}
        
        //$this->load->model('gemstone_model','',TRUE);
		$query = $this->gemstone_model->getGemstoneType();
		if($query){
			$data['type_array'] =  $query;
		}else{
			$data['type_array'] = array();
		}
        
        $query = $this->gemstone_model->getProcessType();
		if($query){
			$data['process_array'] =  $query;
		}else{
			$data['process_array'] = array();
		}
        $data['stoneid'] = $id;
        $data['title'] = "Cien|Gemstone Tracking System - Edit Stone";
        $this->load->view('stock/edit_stone',$data);
    }
    
    function ajaxGetListInventory()
	{
        $stock = $this->uri->segment(3);
        $colorid = $this->uri->segment(4);
        $stoneid = $this->uri->segment(5);
        $supplierid = $this->uri->segment(6);
        $month = $this->uri->segment(7);
        if(($stock=="") || ($stock=="2")) {
            $column = "gemstone_stock.amount > -1";
        }elseif($stock=="0") {
            $column = "((gemstone_stock.amount > gemstone_stock.amount_out) OR (gemstone_stock.carat - gemstone_stock.carat_out > 0.01) OR (gemstone_stock.carat=0 AND gemstone_stock.amount=0 AND gemstone_stock.kilogram>0 AND (gemstone_stock.kilogram*1000>gemstone_stock.carat_out*0.2)))";
        }elseif($stock=="1") {
            $column = "((gemstone_stock.amount <= gemstone_stock.amount_out) AND (gemstone_stock.carat <= gemstone_stock.carat_out) AND (gemstone_stock.carat!=0 OR gemstone_stock.amount!=0 OR gemstone_stock.kilogram=0 OR (gemstone_stock.kilogram*1000<=gemstone_stock.carat_out*0.2)))";
        }
        
        if ($colorid > 0) {
            $column .= " AND gemstone_stock.type = '".$colorid."'";
        }
        
        if ($supplierid > 0) {
            $column .= " AND gemstone_stock.supplier = '".$supplierid."'";   
        }
        
        switch($stoneid){
            case 1: $column .= " AND gemstone_stock.stone_type = 'พลอยก้อน'"; break;
            case 2: $column .= " AND gemstone_stock.stone_type = 'พลอยสำเร็จ'"; break;
        }
        
        if ($month !="") {
            $month = explode('-',$month);
            $start = $month[1].'-'.$month[0].'-01';
            $end = $month[1].'-'.$month[0].'-31 23:59:59';
            $column .= " AND gemstone_stock.datein >= '".$start."' AND gemstone_stock.datein <= '".$end."'";
        }
        
        $this->load->library('Datatables');
		$this->datatables
		->select("CONCAT('<span class=hide>',date_format(gemstone_stock.datein,'%Y/%m/%d'),'</span>',date_format(gemstone_stock.datein,'%d/%m/%Y')) as datein, CONCAT(supplier.name,lot) as detail, gemstone_stock.stone_type as stonetype, gemstone_type.name as gemtype, gemstone_stock.size as gemsize, order_type, gemstone_stock.amount as stockamount, gemstone_stock.carat as gemcarat, gemstone_stock.kilogram as kg , CONCAT('<code><b>',(gemstone_stock.amount - gemstone_stock.amount_out - gemstone_stock.amount_fullcolor - gemstone_stock.amount_cleansize - gemstone_stock.amount_notclean),'</b></code>') as remainamount,CONCAT('<code><b>',FORMAT(gemstone_stock.carat - gemstone_stock.carat_out - gemstone_stock.carat_fullcolor - gemstone_stock.carat_cleansize - gemstone_stock.carat_notclean,2),'</b></code>') as remaincarat, gemstone_stock.id as bid", FALSE)
		->from('gemstone_stock')
        ->join('supplier', 'gemstone_stock.supplier=supplier.id','left')
        ->join('gemstone_type', 'gemstone_type.id=gemstone_stock.type','left')
        ->where('disable',0)
        ->where($column)
		->edit_column("bid",'<div class="tooltip-demo">
    <a id="fancyboxall" href="'.site_url("stock/view_stone/$1").'" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-fullscreen"></span></a> &nbsp;&nbsp;
    <a id="fancyboxout" href="'.site_url("stock/split_stone/$1").'" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></a> &nbsp;&nbsp;
    <a id="fancyboxout" href="'.site_url("stock/out_stone/$1").'" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-export"></span></a> &nbsp;&nbsp;
	<button href="'.site_url("stock/delete_stone/$1").'" class="btn btn-danger btn-xs" data-title="Delete" data-toggle="tooltip" data-target="#delete" data-placement="top" rel="tooltip" title="ลบข้อมูล" onClick="del_confirm($1)"><span class="glyphicon glyphicon-remove"></span></button></div>',"bid");
		echo $this->datatables->generate();
        
        //    <a id="fancyboxedit" href="'.site_url("stock/edit_stone/$1").'" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
	}
    
    function ajaxGetListInventory_view()
	{
        $colorid = $this->uri->segment(3);

        $column = "((gemstone_stock.amount > gemstone_stock.amount_out) OR (gemstone_stock.carat - gemstone_stock.carat_out > 0.01) OR (gemstone_stock.carat=0 AND gemstone_stock.amount=0 AND gemstone_stock.kilogram>0 AND (gemstone_stock.kilogram*1000>gemstone_stock.carat_out*0.2)))";
        
        if ($colorid > 0) {
            $column .= " AND gemstone_stock.type = '".$colorid."'";
        }
        
        $this->load->library('Datatables');
		$this->datatables
		->select("CONCAT('<span class=hide>',date_format(gemstone_stock.datein,'%Y/%m/%d'),'</span>',date_format(gemstone_stock.datein,'%d/%m/%Y')) as datein, CONCAT(supplier.name,lot) as detail, gemstone_stock.stone_type as stonetype, gemstone_type.name as gemtype, gemstone_stock.size as gemsize, order_type, gemstone_stock.amount as stockamount, gemstone_stock.carat as gemcarat, gemstone_stock.kilogram as kg , CONCAT('<code><b>',(gemstone_stock.amount - gemstone_stock.amount_out - gemstone_stock.amount_fullcolor - gemstone_stock.amount_cleansize - gemstone_stock.amount_notclean),'</b></code>') as remainamount,CONCAT('<code><b>',FORMAT(gemstone_stock.carat - gemstone_stock.carat_out - gemstone_stock.carat_fullcolor - gemstone_stock.carat_cleansize - gemstone_stock.carat_notclean,2),'</b></code>') as remaincarat, gemstone_stock.id as bid", FALSE)
		->from('gemstone_stock')
        ->join('supplier', 'gemstone_stock.supplier=supplier.id','left')
        ->join('gemstone_type', 'gemstone_type.id=gemstone_stock.type','left')
        ->where('disable',0)
        ->where($column)
		->edit_column("bid",'<div class="tooltip-demo">
    <a id="fancyboxall" href="'.site_url("stock/view_stone/$1/1").'" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-fullscreen"></span></a> &nbsp;&nbsp;</div>',"bid");
		echo $this->datatables->generate();
	}
    
    function ajaxGetListInventory_stone()
	{
        $stoneid = $this->uri->segment(3);
        $stock = $this->uri->segment(4);
        if(($stock=="") || ($stock=="allstock")) {
            $column = "gemstone_stock.amount > -1";
        }elseif($stock=="instock") {
            $column = "((gemstone_stock.amount > gemstone_stock.amount_out) OR (gemstone_stock.carat - gemstone_stock.carat_out > 0.01) OR (gemstone_stock.carat=0 AND gemstone_stock.amount=0 AND gemstone_stock.kilogram>0 AND (gemstone_stock.kilogram*1000>gemstone_stock.carat_out*0.2)))";
        }elseif($stock=="outstock") {
            $column = "((gemstone_stock.amount <= gemstone_stock.amount_out) AND (gemstone_stock.carat <= gemstone_stock.carat_out) AND (gemstone_stock.carat!=0 OR gemstone_stock.amount!=0 OR gemstone_stock.kilogram=0 OR (gemstone_stock.kilogram*1000<=gemstone_stock.carat_out*0.2)))";
        }
        switch($stoneid){
            case 1: $stoneid = "พลอยก้อน"; break;
            case 2: $stoneid = "พลอยสำเร็จ"; break;
        }
        $this->load->library('Datatables');
		$this->datatables
		->select("CONCAT('<span class=hide>',date_format(gemstone_stock.datein,'%Y/%m/%d'),'</span>',date_format(gemstone_stock.datein,'%d/%m/%Y')) as datein, CONCAT(supplier.name,lot) as detail, gemstone_stock.stone_type as stonetype, gemstone_type.name as gemtype, gemstone_stock.size as gemsize, order_type, gemstone_stock.amount as stockamount, gemstone_stock.carat as gemcarat, gemstone_stock.kilogram as kg , CONCAT('<code><b>',(gemstone_stock.amount - gemstone_stock.amount_out),'</b></code>') as remainamount,CONCAT('<code><b>',FORMAT(gemstone_stock.carat - gemstone_stock.carat_out,2),'</b></code>') as remaincarat, gemstone_stock.id as bid", FALSE)
		->from('gemstone_stock')
        ->join('supplier', 'gemstone_stock.supplier=supplier.id','left')
        ->join('gemstone_type', 'gemstone_type.id=gemstone_stock.type','left')
        ->where('disable',0)
        ->where('gemstone_stock.stone_type',$stoneid)
        ->where($column)
		->edit_column("bid",'<div class="tooltip-demo">
    <a id="fancyboxall" href="'.site_url("stock/view_stone/$1").'" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-fullscreen"></span></a> &nbsp;&nbsp;
    <a id="fancyboxout" href="'.site_url("stock/out_stone/$1").'" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-export"></span></a> &nbsp;&nbsp;
	<button href="'.site_url("stock/delete_stone/$1").'" class="btn btn-danger btn-xs" data-title="Delete" data-toggle="tooltip" data-target="#delete" data-placement="top" rel="tooltip" title="ลบข้อมูล" onClick="del_confirm($1)"><span class="glyphicon glyphicon-remove"></span></button></div>',"bid");
		echo $this->datatables->generate();
	}
    
    function ajaxGetListInventory_color()
	{
        $colorid = $this->uri->segment(3);
        $stock = $this->uri->segment(4);
        if(($stock=="") || ($stock=="allstock")) {
            $column = "gemstone_stock.amount > -1";
        }elseif($stock=="instock") {
            $column = "((gemstone_stock.amount > gemstone_stock.amount_out) OR (gemstone_stock.carat - gemstone_stock.carat_out > 0.01) OR (gemstone_stock.carat=0 AND gemstone_stock.amount=0 AND gemstone_stock.kilogram>0 AND (gemstone_stock.kilogram*1000>gemstone_stock.carat_out*0.2)))";
        }elseif($stock=="outstock") {
            $column = "((gemstone_stock.amount <= gemstone_stock.amount_out) AND (gemstone_stock.carat <= gemstone_stock.carat_out) AND (gemstone_stock.carat!=0 OR gemstone_stock.amount!=0 OR gemstone_stock.kilogram=0 OR (gemstone_stock.kilogram*1000<=gemstone_stock.carat_out*0.2)))";
        }
        $this->load->library('Datatables');
		$this->datatables
		->select("CONCAT('<span class=hide>',date_format(gemstone_stock.datein,'%Y/%m/%d'),'</span>',date_format(gemstone_stock.datein,'%d/%m/%Y')) as datein, CONCAT(supplier.name,lot) as detail, gemstone_stock.stone_type as stonetype, gemstone_type.name as gemtype, gemstone_stock.size as gemsize, order_type, gemstone_stock.amount as stockamount, gemstone_stock.carat as gemcarat, gemstone_stock.kilogram as kg , CONCAT('<code><b>',(gemstone_stock.amount - gemstone_stock.amount_out),'</b></code>') as remainamount,CONCAT('<code><b>',FORMAT(gemstone_stock.carat - gemstone_stock.carat_out,2),'</b></code>') as remaincarat, gemstone_stock.id as bid", FALSE)
		->from('gemstone_stock')
        ->join('supplier', 'gemstone_stock.supplier=supplier.id','left')
        ->join('gemstone_type', 'gemstone_type.id=gemstone_stock.type','left')
        ->where('disable',0)
        ->where('gemstone_stock.type',$colorid)
        ->where($column)
		->edit_column("bid",'<div class="tooltip-demo">
    <a id="fancyboxall" href="'.site_url("stock/view_stone/$1").'" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-fullscreen"></span></a> &nbsp;&nbsp;
    <a id="fancyboxout" href="'.site_url("stock/out_stone/$1").'" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-export"></span></a> &nbsp;&nbsp;
	<button href="'.site_url("stock/delete_stone/$1").'" class="btn btn-danger btn-xs" data-title="Delete" data-toggle="tooltip" data-target="#delete" data-placement="top" rel="tooltip" title="ลบข้อมูล" onClick="del_confirm($1)"><span class="glyphicon glyphicon-remove"></span></button></div>',"bid");
		echo $this->datatables->generate();
	}
    
    function ajaxGetListInventory_color_stone()
	{
        $stoneid = $this->uri->segment(4);
        $colorid = $this->uri->segment(3);
        $stock = $this->uri->segment(5);
        if(($stock=="") || ($stock=="allstock")) {
            $column = "gemstone_stock.amount > -1";
        }elseif($stock=="instock") {
            $column = "((gemstone_stock.amount > gemstone_stock.amount_out) OR (gemstone_stock.carat - gemstone_stock.carat_out > 0.01) OR (gemstone_stock.carat=0 AND gemstone_stock.amount=0 AND gemstone_stock.kilogram>0 AND (gemstone_stock.kilogram*1000>gemstone_stock.carat_out*0.2)))";
        }elseif($stock=="outstock") {
            $column = "((gemstone_stock.amount <= gemstone_stock.amount_out) AND (gemstone_stock.carat <= gemstone_stock.carat_out) AND (gemstone_stock.carat!=0 OR gemstone_stock.amount!=0 OR gemstone_stock.kilogram=0 OR (gemstone_stock.kilogram*1000<=gemstone_stock.carat_out*0.2)))";
        }
        switch($stoneid){
            case 1: $stoneid = "พลอยก้อน"; break;
            case 2: $stoneid = "พลอยสำเร็จ"; break;
        }
        $this->load->library('Datatables');
		$this->datatables
		->select("CONCAT('<span class=hide>',date_format(gemstone_stock.datein,'%Y/%m/%d'),'</span>',date_format(gemstone_stock.datein,'%d/%m/%Y')) as datein, CONCAT(supplier.name,lot) as detail, gemstone_stock.stone_type as stonetype, gemstone_type.name as gemtype, gemstone_stock.size as gemsize, order_type, gemstone_stock.amount as stockamount, gemstone_stock.carat as gemcarat, gemstone_stock.kilogram as kg , CONCAT('<code><b>',(gemstone_stock.amount - gemstone_stock.amount_out),'</b></code>') as remainamount,CONCAT('<code><b>',FORMAT(gemstone_stock.carat - gemstone_stock.carat_out,2),'</b></code>') as remaincarat, gemstone_stock.id as bid", FALSE)
		->from('gemstone_stock')
        ->join('supplier', 'gemstone_stock.supplier=supplier.id','left')
        ->join('gemstone_type', 'gemstone_type.id=gemstone_stock.type','left')
        ->where('disable',0)
        ->where('gemstone_stock.stone_type',$stoneid)
        ->where('gemstone_stock.type',$colorid)
        ->where($column)
		->edit_column("bid",'<div class="tooltip-demo">
    <a id="fancyboxall" href="'.site_url("stock/view_stone/$1").'" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-fullscreen"></span></a> &nbsp;&nbsp;
    <a id="fancyboxout" href="'.site_url("stock/out_stone/$1").'" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-export"></span></a> &nbsp;&nbsp;
	<button href="'.site_url("stock/delete_stone/$1").'" class="btn btn-danger btn-xs" data-title="Delete" data-toggle="tooltip" data-target="#delete" data-placement="top" rel="tooltip" title="ลบข้อมูล" onClick="del_confirm($1)"><span class="glyphicon glyphicon-remove"></span></button></div>',"bid");
		echo $this->datatables->generate();
	}
    
    //  when need to print out delivery form 
    
    function ajaxGetListInventory_select()
	{
        $stock = $this->uri->segment(3);
        if($stock=="allstock") {
            $column = "gemstone_stock.amount > -1";
        }elseif(($stock=="") || ($stock=="instock")) {
            $column = "((gemstone_stock.amount > gemstone_stock.amount_out) OR (gemstone_stock.carat - gemstone_stock.carat_out > 0.01) OR (gemstone_stock.carat=0 AND gemstone_stock.amount=0 AND gemstone_stock.kilogram>0 AND (gemstone_stock.kilogram*1000>gemstone_stock.carat_out*0.2)))";
        }
        
        $this->load->library('Datatables');
		$this->datatables
		->select("date_format(gemstone_stock.datein,'%d/%m/%y') as datein, CONCAT(supplier.name,lot,' Lot ',carat) as detail,gemstone_stock.stone_type as stonetype,gemstone_type.name as gemtype, gemstone_stock.size as gemsize, order_type, gemstone_stock.amount as stockamount, gemstone_stock.carat as gemcarat, gemstone_stock.kilogram as kg ,CONCAT('<code><b>',(gemstone_stock.amount - gemstone_stock.amount_out),'</b></code>') as remain,CONCAT('<code><b>',FORMAT(gemstone_stock.carat - gemstone_stock.carat_out,2),'</b></code>') as remaincarat, gemstone_stock.id as bid", FALSE)
		->from('gemstone_stock')
        ->join('supplier', 'gemstone_stock.supplier=supplier.id','left')
        ->join('gemstone_type', 'gemstone_type.id=gemstone_stock.type','left')
        ->where('disable',0)
        ->where($column)
		->edit_column("bid",'<div class="tooltip-demo">
    <a href="'.site_url("stock/select_stock/$1").'" class="btn btn-primary btn-xs" data-title="Select" data-toggle="tooltip" data-target="#select" data-placement="top" rel="tooltip" title="เลือก"><span class="glyphicon glyphicon-shopping-cart"></span> &nbsp;&nbsp;Select</a></div>',"bid");
		echo $this->datatables->generate(); 
	}
    
    function ajaxGetListInventory_select_stone()
	{
        $stoneid = $this->uri->segment(3);
        $stock = $this->uri->segment(4);
        
        if($stock=="allstock") {
            $column = "gemstone_stock.amount > -1";
        }elseif(($stock=="") || ($stock=="instock")) {
            $column = "((gemstone_stock.amount > gemstone_stock.amount_out) OR (gemstone_stock.carat - gemstone_stock.carat_out > 0.01) OR (gemstone_stock.carat=0 AND gemstone_stock.amount=0 AND gemstone_stock.kilogram>0 AND (gemstone_stock.kilogram*1000>gemstone_stock.carat_out*0.2)))";
        }
        
        switch($stoneid){
            case 1: $stoneid = "พลอยก้อน"; break;
            case 2: $stoneid = "พลอยสำเร็จ"; break;
        }
        
        $this->load->library('Datatables');
		$this->datatables
		->select("date_format(gemstone_stock.datein,'%d/%m/%y') as datein, CONCAT(supplier.name,lot,' Lot ',carat) as detail,gemstone_stock.stone_type as stonetype,gemstone_type.name as gemtype, gemstone_stock.size as gemsize, order_type, gemstone_stock.amount as stockamount, gemstone_stock.carat as gemcarat, gemstone_stock.kilogram as kg ,CONCAT('<code><b>',(gemstone_stock.amount - gemstone_stock.amount_out),'</b></code>') as remain,CONCAT('<code><b>',FORMAT(gemstone_stock.carat - gemstone_stock.carat_out,2),'</b></code>') as remaincarat, gemstone_stock.id as bid", FALSE)
		->from('gemstone_stock')
        ->join('supplier', 'gemstone_stock.supplier=supplier.id','left')
        ->join('gemstone_type', 'gemstone_type.id=gemstone_stock.type','left')
        ->where('disable',0)
        ->where('gemstone_stock.stone_type',$stoneid)
        ->where($column)
		->edit_column("bid",'<div class="tooltip-demo">
    <a href="'.site_url("stock/select_stock/$1").'" class="btn btn-primary btn-xs" data-title="Select" data-toggle="tooltip" data-target="#select" data-placement="top" rel="tooltip" title="เลือก"><span class="glyphicon glyphicon-shopping-cart"></span> &nbsp;&nbsp;Select</a></div>',"bid");
		echo $this->datatables->generate(); 
	}
    
    function ajaxGetListInventory_select_color()
	{
        $colorid = $this->uri->segment(3);
        $stock = $this->uri->segment(4);
        
        if($stock=="allstock") {
            $column = "gemstone_stock.amount > -1";
        }elseif(($stock=="") || ($stock=="instock")) {
            $column = "((gemstone_stock.amount > gemstone_stock.amount_out) OR (gemstone_stock.carat - gemstone_stock.carat_out > 0.01) OR (gemstone_stock.carat=0 AND gemstone_stock.amount=0 AND gemstone_stock.kilogram>0 AND (gemstone_stock.kilogram*1000>gemstone_stock.carat_out*0.2)))";
        }
        
        $this->load->library('Datatables');
		$this->datatables
		->select("date_format(gemstone_stock.datein,'%d/%m/%y') as datein, CONCAT(supplier.name,lot,' Lot ',carat) as detail,gemstone_stock.stone_type as stonetype,gemstone_type.name as gemtype, gemstone_stock.size as gemsize, order_type, gemstone_stock.amount as stockamount, gemstone_stock.carat as gemcarat, gemstone_stock.kilogram as kg ,CONCAT('<code><b>',(gemstone_stock.amount - gemstone_stock.amount_out),'</b></code>') as remain,CONCAT('<code><b>',FORMAT(gemstone_stock.carat - gemstone_stock.carat_out,2),'</b></code>') as remaincarat, gemstone_stock.id as bid", FALSE)
		->from('gemstone_stock')
        ->join('supplier', 'gemstone_stock.supplier=supplier.id','left')
        ->join('gemstone_type', 'gemstone_type.id=gemstone_stock.type','left')
        ->where('disable',0)
        ->where('gemstone_stock.type',$colorid)
        ->where($column)
		->edit_column("bid",'<div class="tooltip-demo">
    <a href="'.site_url("stock/select_stock/$1").'" class="btn btn-primary btn-xs" data-title="Select" data-toggle="tooltip" data-target="#select" data-placement="top" rel="tooltip" title="เลือก"><span class="glyphicon glyphicon-shopping-cart"></span> &nbsp;&nbsp;Select</a></div>',"bid");
		echo $this->datatables->generate(); 
	}
    
    function ajaxGetListInventory_select_color_stone()
	{
        $stoneid = $this->uri->segment(4);
        $colorid = $this->uri->segment(3);
        $stock = $this->uri->segment(5);
        
        if($stock=="allstock") {
            $column = "gemstone_stock.amount > -1";
        }elseif(($stock=="") || ($stock=="instock")) {
            $column = "((gemstone_stock.amount > gemstone_stock.amount_out) OR (gemstone_stock.carat - gemstone_stock.carat_out > 0.01) OR (gemstone_stock.carat=0 AND gemstone_stock.amount=0 AND gemstone_stock.kilogram>0 AND (gemstone_stock.kilogram*1000>gemstone_stock.carat_out*0.2)))";
        }
        
        switch($stoneid){
            case 1: $stoneid = "พลอยก้อน"; break;
            case 2: $stoneid = "พลอยสำเร็จ"; break;
        }
        
        $this->load->library('Datatables');
		$this->datatables
		->select("date_format(gemstone_stock.datein,'%d/%m/%y') as datein, CONCAT(supplier.name,lot,' Lot ',carat) as detail,gemstone_stock.stone_type as stonetype,gemstone_type.name as gemtype, gemstone_stock.size as gemsize, order_type, gemstone_stock.amount as stockamount, gemstone_stock.carat as gemcarat, gemstone_stock.kilogram as kg ,CONCAT('<code><b>',(gemstone_stock.amount - gemstone_stock.amount_out),'</b></code>') as remain,CONCAT('<code><b>',FORMAT(gemstone_stock.carat - gemstone_stock.carat_out,2),'</b></code>') as remaincarat, gemstone_stock.id as bid", FALSE)
		->from('gemstone_stock')
        ->join('supplier', 'gemstone_stock.supplier=supplier.id','left')
        ->join('gemstone_type', 'gemstone_type.id=gemstone_stock.type','left')
        ->where('disable',0)
        ->where('gemstone_stock.stone_type',$stoneid)
        ->where('gemstone_stock.type',$colorid)
        ->where($column)
		->edit_column("bid",'<div class="tooltip-demo">
    <a href="'.site_url("stock/select_stock/$1").'" class="btn btn-primary btn-xs" data-title="Select" data-toggle="tooltip" data-target="#select" data-placement="top" rel="tooltip" title="เลือก"><span class="glyphicon glyphicon-shopping-cart"></span> &nbsp;&nbsp;Select</a></div>',"bid");
		echo $this->datatables->generate(); 
	}
    
    function delete_stone()
    {
        $id = $this->uri->segment(3);

		$result = $this->stock_model->delGem($id);
		redirect('stock/liststock', 'refresh');
    }
    
    function delete_splitstock()
    {
        $id = $this->uri->segment(3);
        $stockid = $this->uri->segment(4);
        $result = $this->stock_model->getStockSplitOne($id);
        foreach($result as $loop) { 
            $stock = array('carat_out' => $loop->carat, 'amount_out' => $loop->amount, 'id' => $stockid);
            $reason = $loop->reason;
        }

		$result = $this->stock_model->delSplitStock($id);
        $this->stock_model->editAmountCaratSplit($stock, $reason, 'minus');
        
		redirect('stock/view_stone/'.$stockid, 'refresh');
    }
    
    function liststock_select()
    {
        $query = $this->gemstone_model->getGemstoneType();
		if($query){
			$data['type_array'] =  $query;
		}else{
			$data['type_array'] = array();
		}
        
        $data['colorid'] = 0;
        $data['stoneid'] = 0;
        $data['stock'] = $this->uri->segment(3);
        $data['title'] = "Cien|Gemstone Tracking System - List Inventory";
        $this->load->view('stock/liststock_select',$data);
    }
    
    function liststock_select_color()
    {
        $data['colorid'] = $this->uri->segment(3);
        $data['stoneid'] = $this->uri->segment(4);
        $data['stock'] = $this->uri->segment(5);
        $query = $this->gemstone_model->getGemstoneType();
		if($query){
			$data['type_array'] =  $query;
		}else{
			$data['type_array'] = array();
		}
        
        $data['title'] = "Cien|Gemstone Tracking System - List Inventory";
        $this->load->view('stock/liststock_select_color',$data);
    }
    
    function select_stock()
    {
        $id = $this->uri->segment(3);
        
        $query = $this->stock_model->getStone_purchase($id);
        $data['stone_array'] = $query;
        
        $data['stockid'] = $id;
		$data['title'] = "Cien|Gemstone Tracking System - Add Stone in Inventory";
		$this->load->view('purchase/addstock',$data);
    }
    
    function out_stone()
    {
        $data['stockid'] = $this->uri->segment(3);
        
        $query = $this->stock_model->getOut_reason();
        $data['reason_array'] = $query;
        
        $data['title'] = "Cien|Gemstone Tracking System - Out stone";
        $this->load->view('stock/out_stone',$data);
    }
    
    function split_stone()
    {
        $data['stockid'] = $this->uri->segment(3);
        
        $query = $this->stock_model->getSplit_reason();
        $data['reason_array'] = $query;
        
        $data['title'] = "Cien|Gemstone Tracking System - Out stone";
        $this->load->view('stock/split_stone',$data);
    }
    
}