<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('gemstone_model','',TRUE);
        $this->load->model('report_model','',TRUE);
		//$this->load->library('form_validation');
		if (!($this->session->userdata('sessusername'))) redirect('login', 'refresh');
	}
	function index()
	{
	 
	}
    
    function allparcel()
    {
        $query = $this->gemstone_model->getGemstoneType();
		if($query){
			$data['type_array'] =  $query;
		}else{
			$data['type_array'] = array();
		}
        
        /*$query = $this->gemstone_model->getAllParcel();
		if($query){
			$data['parcel_array'] =  $query;
		}else{
			
		}
        */
        $data['parcel_array'] = array();
        
        $data['title'] = "Cien|Gemstone Tracking System - Show Parcel";
		$this->load->view('report/allparcel',$data);
    }
    
    function allParcel_factory()
    {
        $query = $this->gemstone_model->getGemstoneType();
		if($query){
			$data['type_array'] =  $query;
		}else{
			$data['type_array'] = array();
		}
        
        $query = $this->report_model->getAllParcel_factory();
		if($query){
			$data['parcel_array'] =  $query;
		}else{
			$data['parcel_array'] = array();
		}
        
        $data['title'] = "Cien|Gemstone Tracking System - Show Parcel";
		$this->load->view('report/allparcel_factory',$data);
    }
    
    function allparcel_color()
    {
        $color = $this->uri->segment(3);
        $color = str_replace('_',' ',$color);
        
        $data['color'] = $color;
        
        $query = $this->gemstone_model->getGemstoneType();
		if($query){
			$data['type_array'] =  $query;
		}else{
			$data['type_array'] = array();
		}
        
        $start = date('Y-m-01');
        $end = date('Y-m-31');
        
        $query = $this->report_model->getAllParcelColor_string($color, $start, $end);
		if($query){
			$data['parcel_array'] =  $query;
		}else{
			$data['parcel_array'] = array();
		}
        
        $data['title'] = "Cien|Gemstone Tracking System - Show Parcel";
		$this->load->view('report/allparcel_color',$data);
    }

    function showdetail_parcel()
    {
        $id = $this->uri->segment(3);
        
        $this->load->helper('new_helper');
        
        $query = $this->gemstone_model->getAllBarcode($id);
		if($query){
			$data['gem_array'] =  $query;
		}else{
			$data['gem_array'] = array();
		}
        
        $query = $this->gemstone_model->getGemstone($id);
        if($query){
			$data['barcode_array'] =  $query;
		}else{
			$data['barcode_array'] = array();
		}
        
        $data['qc_ok'] = $this->gemstone_model->getCountQC($id,1);
        $data['qc_not'] = $this->gemstone_model->getCountQC($id,2);
        $data['qc_return'] = $this->gemstone_model->getCountQC($id,4);
        $data['qc_return_ok'] = $this->gemstone_model->getCountQC($id,5);
        
        $query = $this->gemstone_model->getNumberRange($id);
        foreach ($query as $loop) { $data['minno'] = $loop->_min; $data['maxno'] = $loop->_max; }
        $data['gid'] = $id;
        
        $data['title'] = "Cien|Gemstone Tracking System - Show Parcel Detail";
		$this->load->view('report/showdetail_parcel',$data);
    }
    
    function allParcel_color_month()
    {
        $query = $this->gemstone_model->getGemstoneType();
		if($query){
			$data['type_array'] =  $query;
		}else{
			$data['type_array'] = array();
		}
        
        $color = $this->input->post('typeid');
        $month = $this->input->post('month');
        
        if ($month !="") {
            $month = explode('-',$month);
            $start = $month[1].'-'.$month[0].'-01';
            $end = $month[1].'-'.$month[0].'-31';
            $selectmonth = $month[0]."-".$month[1];
        }else{
            $selectmonth = "";
            $start = 0;
            $end = 0;
        }
        
        $query = $this->report_model->getAllParcelColor_string($color, $start, $end);
		if($query){
			$data['parcel_array'] =  $query;
		}else{
			$data['parcel_array'] = array();
		}
        
        $data['color'] = $color;
        $data['month'] = $start;
        $data['selectmonth'] = $this->input->post('month');
        $data['title'] = "Cien|Gemstone Tracking System - Show Parcel";
		$this->load->view('report/allparcel_color_month',$data);
    }
    
    function allBarcode_factory()
    {
        
        $data['title'] = "Cien|Gemstone Tracking System - Show Gems";
		$this->load->view('report/allbarcode_factory',$data);
    }
    
    function allBarcode_factory_task()
    {
        $task = $this->uri->segment(3);
        
        $query = $this->report_model->getCountColorStation($task,0);
        $data['countcolor'] = $query;
        
        $query = $this->gemstone_model->getGemstoneType();
        $data['gemtype'] = $query;
        
        $data['task'] = $task;
        $data['title'] = "Cien|Gemstone Tracking System - Show Gems";
		$this->load->view('report/allbarcode_factory_task',$data);
    }
    
    function allBarcode_center_task()
    {
        $task = $this->uri->segment(3);
        
        $query = $this->report_model->getCountColorCenter_task($task);
        $data['countcolor'] = $query;
        
        $query = $this->gemstone_model->getGemstoneType();
        $data['gemtype'] = $query;
        
        $data['task'] = $task;
        $data['title'] = "Cien|Gemstone Tracking System - Show Gems";
		$this->load->view('report/allbarcode_center_task',$data);
    }
    
    function allBarcode_factory_task_edit()
    {
        $task = $this->uri->segment(3);
        
        $query = $this->report_model->getCountColorStation($task,1);
        $data['countcolor'] = $query;
        
        $query = $this->gemstone_model->getGemstoneType();
        $data['gemtype'] = $query;
        
        $data['task'] = $task;
        $data['title'] = "Cien|Gemstone Tracking System - Show Gems";
		$this->load->view('report/allbarcode_factory_task_edit',$data);
    }
    
    function allBarcode_factory_processcolor()
    {
        $color = $this->uri->segment(3);
        $process = $this->uri->segment(4);
        
        $data['color'] = $color;
        $data['process'] = $process;
        
        $station_array = array();
        
        for($i=0; $i<=10; $i++) {
            if ($i==8) continue;
            $query = $this->report_model->getCountStation_colorProcess($color, $process, $i);
            $station_array[] = $query;
        }
        
        $data['station_array'] = $station_array;
        
        $query = $this->gemstone_model->getProcessType();
        $data['process_array'] = $query;
        
        $query = $this->gemstone_model->getGemstoneType();
        $data['color_array'] = $query;
        
        
        $data['title'] = "Cien|Gemstone Tracking System - Show Gems";
		$this->load->view('report/allbarcode_factory_processcolor',$data);
    }
    
    function allBarcode_stock_balance()
    {
        $data['colorid'] = $this->uri->segment(3);
        
        $result = $this->gemstone_model->getOneGemstoneType($this->uri->segment(3));
        foreach($result as $loop) $data['colorname'] = $loop->name;
        
        $data['title'] = "Cien|Gemstone Tracking System - Show Stock Balance";
		$this->load->view('report/allbarcode_stock_balance',$data);
    }
    
    function ajaxGetAllBarcodeFactory()
	{
        $this->load->library('Datatables');
		$this->datatables
		->select("gemstone_barcode.id as barcodeid,CONCAT(supplier.name,lot,'-',number,'#',no) as detail,gemstone_type.name as gemtype, gemstone.dateadd as gemdate, gemstone_barcode.id as bid", FALSE)
		->from('gemstone_barcode')
        ->join('gemstone', 'gemstone.id = gemstone_barcode.gemstone_id', 'left')
        ->join('supplier', 'gemstone.supplier=supplier.id','left')
        ->join('gemstone_type', 'gemstone_type.id=gemstone.type','left')
        ->where('disable',0)
        ->where('(pass=0 OR pass=3)')
		->edit_column("bid",'<div class="tooltip-demo">
	<a href="'.site_url("gemstone/showdetail_barcode/$1").'" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a>
	</div>',"bid");
		/* ->edit_column("bid",'<div class="tooltip-demo">
	<a href="'.site_url("gemstone/showdetail_barcode/$1").'" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a>
	<a href="'.site_url("gemstone/printbarcode_one/$1").'" class="btn btn-primary btn-xs" data-title="Edit" data-toggle="tooltip" data-target="#edit" data-placement="top" rel="tooltip" title="Print"><span class="glyphicon glyphicon-print"></span></a>
	</div>',"bid"); */

        
		echo $this->datatables->generate(); 
	}
    
    function ajaxGetAllBarcodeReturn()
	{
        $this->load->library('Datatables');
		$this->datatables
		->select("gemstone_barcode.id as barcodeid,CONCAT(supplier.name,lot,'-',number,'#',no) as detail,gemstone_type.name as gemtype, gemstone.dateadd as gemdate, gemstone_qc.detail as gemdetail, gemstone_barcode.id as bid", FALSE)
		->from('gemstone_barcode')
        ->join('gemstone', 'gemstone.id = gemstone_barcode.gemstone_id', 'left')
        ->join('supplier', 'gemstone.supplier=supplier.id','left')
        ->join('gemstone_type', 'gemstone_type.id=gemstone.type','left')
        ->join('gemstone_qc', 'gemstone_qc.barcode=gemstone_barcode.id', 'left')
        ->where('disable',0)
        ->where('pass', 4)
		->edit_column("bid",'<div class="tooltip-demo">
	<a href="'.site_url("gemstone/showdetail_barcode/$1").'" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a>
	</div>',"bid");
		/* ->edit_column("bid",'<div class="tooltip-demo">
	<a href="'.site_url("gemstone/showdetail_barcode/$1").'" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a>
	<a href="'.site_url("gemstone/printbarcode_one/$1").'" class="btn btn-primary btn-xs" data-title="Edit" data-toggle="tooltip" data-target="#edit" data-placement="top" rel="tooltip" title="Print"><span class="glyphicon glyphicon-print"></span></a>
	</div>',"bid"); */

        
		echo $this->datatables->generate(); 
	}
    
    function ajaxGetAllBarcodeReturn_ok()
	{
        $this->load->library('Datatables');
		$this->datatables
		->select("gemstone_barcode.id as barcodeid,CONCAT(supplier.name,lot,'-',number,'#',no) as detail,gemstone_type.name as gemtype, gemstone.dateadd as gemdate, gemstone_qc.detail as gemdetail, gemstone_barcode.id as bid", FALSE)
		->from('gemstone_barcode')
        ->join('gemstone', 'gemstone.id = gemstone_barcode.gemstone_id', 'left')
        ->join('supplier', 'gemstone.supplier=supplier.id','left')
        ->join('gemstone_type', 'gemstone_type.id=gemstone.type','left')
        ->join('gemstone_qc', 'gemstone_qc.barcode=gemstone_barcode.id', 'left')
        ->where('disable',0)
        ->where('pass', 5)
		->edit_column("bid",'<div class="tooltip-demo">
	<a href="'.site_url("gemstone/showdetail_barcode/$1").'" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a>
	</div>',"bid");
		echo $this->datatables->generate(); 
	}
    
    function ajaxGetAllBarcodeFactory_Task()
	{
        $task = $this->uri->segment(3);   
        switch($task) {
            case '16' : $column = "(task3!=1 and task4!=1 and task5!=1 and task6!=1 and task7!=1 and task8!=1 and task9!=1 and task10!=1 and qc1!=1 and qc2!=1)"; break;
            case '3' : $column = "(task3=1)"; break;
            case '4' : $column = "(task4=1)"; break;
            case '5' : $column = "(task5=1)"; break;
            case '6' : $column = "(task6=1)"; break;
            case '7' : $column = "(task7=1)"; break;
            case '8' : $column = "(task8=1)"; break;
            case '9' : $column = "(task9=1)"; break;
            case '10' : $column = "(task10=1)"; break;
            case '12' : $column = "(qc1=1)"; break;
            case '13' : $column = "(qc2=1)"; break;
            
        }
        
        $this->load->library('Datatables');
        if ($task !=16) {
            $this->datatables
            ->select("cc.barcodeid as barcodeid, CONCAT(cc.sname, lot, '-', number, '#', no) as detail, cc.gemtype as gemtype, cc.processname as processname,CONCAT(cc.firstname,' ', cc.lastname) as workername, gemdate, cc.bid as bid", FALSE)
            ->from("(select * from (SELECT gemstone_barcode.id as barcodeid, supplier.name as sname, lot, number, no, gemstone_type.name as gemtype, gemstone_barcode.id as bid, process_type.name as processname FROM (`gemstone_barcode`) LEFT JOIN `gemstone` ON `gemstone`.`id` = `gemstone_barcode`.`gemstone_id` LEFT JOIN `supplier` ON `gemstone`.`supplier`=`supplier`.`id` LEFT JOIN `gemstone_type` ON `gemstone_type`.`id`=`gemstone`.`type` LEFT JOIN `process_type` ON `process_type`.`id`=`gemstone`.`process_type` WHERE `disable` = 0 AND (pass=0 OR pass=3) AND ".$column." ) as aa left join (SELECT gemstone_task.barcode as gbarcode, firstname,lastname, gemstone_task.dateadd as gemdate FROM `gemstone_task` LEFT JOIN `worker` ON `worker`.`id`=`gemstone_task`.`worker` where gemstone_task.status=".$task.") as bb on aa.barcodeid = bb.gbarcode order by gemdate desc) as cc")
            ->group_by('barcodeid')
            ->edit_column("bid",'<div class="tooltip-demo">
        <a href="'.site_url("gemstone/showdetail_barcode/$1").'" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a>
        </div>',"bid");
        }else{                  // center
            $this->datatables
            ->select("gemstone_barcode.id as barcodeid,CONCAT(supplier.name,lot,'-',number,'#',no) as detail,gemstone_type.name as gemtype, process_type.name, 'ส่วนกลาง',' ' , gemstone_barcode.id as bid", FALSE)
            ->from('gemstone_barcode')
            ->join('gemstone', 'gemstone.id = gemstone_barcode.gemstone_id', 'left')
            ->join('supplier', 'gemstone.supplier=supplier.id','left')
            ->join('gemstone_type', 'gemstone_type.id=gemstone.type','left')
            ->join('process_type', 'process_type.id=gemstone.process_type', 'left')
            ->where('disable',0)
            ->where('(pass=0 OR pass=3)')
            ->where($column)
            ->edit_column("bid",'<div class="tooltip-demo">
        <a href="'.site_url("gemstone/showdetail_barcode/$1").'" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a>
        </div>',"bid");
        }
        /*
		->select("gemstone_barcode.id as barcodeid,CONCAT(supplier.name,lot,'-',number,'#',no) as detail,gemstone_type.name as gemtype, gemstone.dateadd as gemdate, gemstone_barcode.id as bid", FALSE)
		->from('gemstone_barcode')
        ->join('gemstone', 'gemstone.id = gemstone_barcode.gemstone_id', 'left')
        ->join('supplier', 'gemstone.supplier=supplier.id','left')
        ->join('gemstone_type', 'gemstone_type.id=gemstone.type','left')
        ->where('disable',0)
        ->where('(pass=0 OR pass=3)')
        ->where($column)
        */
		//->edit_column("pid","$1","pid");
		//->edit_column("bid",'<a id="fancyboxall" href="'.site_url("gemstone/viewtask_number/$1/".$task).'" class="btn btn-primary btn-xs" data-toggle="tooltip" data-target="#view" data-placement="top"><span class="glyphicon glyphicon-user"></span></a>',"bid");

        
		echo $this->datatables->generate(); 
	}
    
    function ajaxGetAllBarcodeCenter_Task()
	{
        $task = $this->uri->segment(3);   
        switch($task) {
            case '1' : $column = "(gemstone_barcode.gemstone_id=gemstone.id and task3=0 and task4=0 and task5=0 and task6=0 and task7=0 and task8=0 and task9=0 and task10=0 and qc1=0 and qc2=0)"; break;
            case '2' : $column = "(gemstone_barcode.gemstone_id=gemstone.id and task3=0 and task4=2 and task5=0 and task6=0 and task7=0 and task8=0 and task9=0 and task10=0 and qc1=0 and qc2=0)"; break;
            case '3' : $column = "(gemstone_barcode.gemstone_id=gemstone.id and task3=0 and task4!=1 and task5=2 and task6=0 and task7=0 and task8=0 and task9=0 and task10=0 and qc1=0 and qc2=0)"; break;
            case '4' : $column = "(gemstone_barcode.gemstone_id=gemstone.id and task3=2 and task4!=1 and task5!=1 and task6=0 and task7=0 and task8=0 and task9=0 and task10=0 and qc1=0 and qc2=0)"; break;
            case '5' : $column = "(gemstone_barcode.gemstone_id=gemstone.id and task3!=1 and task4!=1 and task5!=1 and task6=2 and task7=0 and task8=0 and task9=0 and task10=0 and qc1=0 and qc2=0)"; break;
            case '6' : $column = "(gemstone_barcode.gemstone_id=gemstone.id and task3!=1 and task4!=1 and task5!=1 and task6!=1 and task7=0 and task8=0 and task9=0 and task10=0 and qc1=2 and qc2=0)"; break;
            case '7' : $column = "(gemstone_barcode.gemstone_id=gemstone.id and task3!=1 and task4!=1 and task5!=1 and task6!=1 and task7=2 and task8=0 and task9=0 and task10=0 and qc1!=1 and qc2=0)"; break;
            case '8' : $column = "(gemstone_barcode.gemstone_id=gemstone.id and task3!=1 and task4!=1 and task5!=1 and task6!=1 and task7!=1 and task8=2 and task9=0 and task10=0 and qc1!=1 and qc2=0)"; break;
            case '9' : $column = "(gemstone_barcode.gemstone_id=gemstone.id and task3!=1 and task4!=1 and task5!=1 and task6!=1 and task7!=1 and task8!=1 and task9=2 and task10=0 and qc1!=1 and qc2=0)"; break;
            case '10' : $column = "(gemstone_barcode.gemstone_id=gemstone.id and task3!=1 and task4!=1 and task5!=1 and task6!=1 and task7!=1 and task8!=1 and task9!=1 and task10=0 and qc1!=1 and qc2=2)"; break;
            case '11' : $column = "(gemstone_barcode.gemstone_id=gemstone.id and task3!=1 and task4!=1 and task5!=1 and task6!=1 and task7!=1 and task8!=1 and task9!=1 and task10=2 and qc1!=1 and qc2!=1)"; break;
        } 
        
        $this->load->library('Datatables');

        $this->datatables
            ->select("gemstone_barcode.id as barcodeid,CONCAT(supplier.name,lot,'-',number,'#',no) as detail,gemstone_type.name as gemtype, process_type.name, 'ส่วนกลาง',' ' , gemstone_barcode.id as bid", FALSE)
            ->from('gemstone_barcode')
            ->join('gemstone', 'gemstone.id = gemstone_barcode.gemstone_id', 'left')
            ->join('supplier', 'gemstone.supplier=supplier.id','left')
            ->join('gemstone_type', 'gemstone_type.id=gemstone.type','left')
            ->join('process_type', 'process_type.id=gemstone.process_type', 'left')
            ->where('disable',0)
            ->where('(pass=0 OR pass=3)')
            ->where($column)
            ->edit_column("bid",'<div class="tooltip-demo">
        <a href="'.site_url("gemstone/showdetail_barcode/$1").'" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a>
        </div>',"bid");
        

        
		echo $this->datatables->generate(); 
	}
    
    function ajaxGetAllBarcodeFactory_Task_edit()
	{
        $task = $this->uri->segment(3);   
        switch($task) {
            case '16' : $column = "(task3!=1 and task4!=1 and task5!=1 and task6!=1 and task7!=1 and task8!=1 and task9!=1 and task10!=1 and qc1!=1 and qc2!=1)"; break;
            case '3' : $column = "(task3=1)"; break;
            case '4' : $column = "(task4=1)"; break;
            case '5' : $column = "(task5=1)"; break;
            case '6' : $column = "(task6=1)"; break;
            case '7' : $column = "(task7=1)"; break;
            case '8' : $column = "(task8=1)"; break;
            case '9' : $column = "(task9=1)"; break;
            case '10' : $column = "(task10=1)"; break;
            case '12' : $column = "(qc1=1)"; break;
            case '13' : $column = "(qc2=1)"; break;
            
        }
        
        $this->load->library('Datatables');
        if ($task !=16) {
            $this->datatables
            ->select("aa.barcodeid as barcodeid, CONCAT(aa.sname, lot, '-', number, '#', no) as detail, aa.gemtype as gemtype, aa.processname as processname, CONCAT(aa.firstname,' ', aa.lastname) as workername, gemdate, aa.bid as bid", FALSE)
            ->from("(SELECT gemstone_barcode.id as barcodeid, supplier.name as sname, lot, number, no, gemstone_type.name as gemtype, gemstone_task.dateadd as gemdate, gemstone_barcode.id as bid, firstname, lastname, process_type.name as processname FROM (`gemstone_barcode`) LEFT JOIN `gemstone` ON `gemstone`.`id` = `gemstone_barcode`.`gemstone_id` LEFT JOIN `supplier` ON `gemstone`.`supplier`=`supplier`.`id` LEFT JOIN `gemstone_type` ON `gemstone_type`.`id`=`gemstone`.`type` LEFT JOIN `gemstone_task` ON `gemstone_barcode`.`id`=`gemstone_task`.`barcode` LEFT JOIN `worker` ON `worker`.`id`=`gemstone_task`.`worker` LEFT JOIN `process_type` ON `process_type`.`id`=`gemstone`.`process_type` WHERE `disable` = 0 AND pass = 3 AND ".$column." order by gemstone_task.dateadd desc) as aa")
            ->group_by('barcodeid')
            ->edit_column("bid",'<div class="tooltip-demo">
        <a href="'.site_url("gemstone/showdetail_barcode/$1").'" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a>
        </div>',"bid");
        }else{
            $this->datatables
            ->select("gemstone_barcode.id as barcodeid,CONCAT(supplier.name,lot,'-',number,'#',no) as detail,gemstone_type.name as gemtype, process_type.name, 'ส่วนกลาง',' ' , gemstone_barcode.id as bid", FALSE)
            ->from('gemstone_barcode')
            ->join('gemstone', 'gemstone.id = gemstone_barcode.gemstone_id', 'left')
            ->join('supplier', 'gemstone.supplier=supplier.id','left')
            ->join('gemstone_type', 'gemstone_type.id=gemstone.type','left')
            ->join('process_type', 'process_type.id=gemstone.process_type', 'left')
            ->where('disable',0)
            ->where('pass',3)
            ->where($column)
            ->edit_column("bid",'<div class="tooltip-demo">
        <a href="'.site_url("gemstone/showdetail_barcode/$1").'" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a>
        </div>',"bid");
        }
        /*
		->select("gemstone_barcode.id as barcodeid,CONCAT(supplier.name,lot,'-',number,'#',no) as detail,gemstone_type.name as gemtype, gemstone.dateadd as gemdate, gemstone_barcode.id as bid", FALSE)
		->from('gemstone_barcode')
        ->join('gemstone', 'gemstone.id = gemstone_barcode.gemstone_id', 'left')
        ->join('supplier', 'gemstone.supplier=supplier.id','left')
        ->join('gemstone_type', 'gemstone_type.id=gemstone.type','left')
        ->where('disable',0)
        ->where('(pass=0 OR pass=3)')
        ->where($column)
        */
		//->edit_column("pid","$1","pid");
		//->edit_column("bid",'<a id="fancyboxall" href="'.site_url("gemstone/viewtask_number/$1/".$task).'" class="btn btn-primary btn-xs" data-toggle="tooltip" data-target="#view" data-placement="top"><span class="glyphicon glyphicon-user"></span></a>',"bid");

        
		echo $this->datatables->generate(); 
	}
    
    function ajaxGetAllBarcodeFactory_Processcolor()
	{
        $color = $this->uri->segment(3);
        $process = $this->uri->segment(4);
        /*
        $this->load->library('Datatables');
        $this->datatables
            ->select("aa.barcodeid as barcodeid, CONCAT(aa.sname, lot, '-', number, '#', no) as detail, aa.gemtype as gemtype, gemstone.dateadd as gemdate, aa.bid as bid", FALSE)
            ->from("(SELECT gemstone_barcode.id as barcodeid, supplier.name as sname, lot, number, no, gemstone_type.name as gemtype, gemstone_task.dateadd as gemtaskdate, gemstone_barcode.id as bid, firstname, lastname FROM (`gemstone_barcode`) LEFT JOIN `gemstone` ON `gemstone`.`id` = `gemstone_barcode`.`gemstone_id` LEFT JOIN `supplier` ON `gemstone`.`supplier`=`supplier`.`id` LEFT JOIN `gemstone_type` ON `gemstone_type`.`id`=`gemstone`.`type` LEFT JOIN `gemstone_task` ON `gemstone_barcode`.`id`=`gemstone_task`.`barcode` LEFT JOIN `worker` ON `worker`.`id`=`gemstone_task`.`worker` WHERE `disable` = 0 AND (pass=0 OR pass=3) AND gemstone_type.id='".$color."' AND gemstone.process_type='".$process."' order by gemstone_task.dateadd desc) as aa")
            ->group_by('barcodeid')
            ->edit_column("bid",'<div class="tooltip-demo">
        <a href="'.site_url("gemstone/showdetail_barcode/$1").'" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a>
        </div>',"bid");
        */
        
        $this->load->library('Datatables');
		$this->datatables
		->select("gemstone_barcode.id as barcodeid,CONCAT(supplier.name,lot,'-',number,'#',no) as detail,gemstone_type.name as gemtype, gemstone.dateadd as gemdate, gemstone_barcode.id as bid", FALSE)
		->from('gemstone_barcode')
        ->join('gemstone', 'gemstone.id = gemstone_barcode.gemstone_id', 'left')
        ->join('supplier', 'gemstone.supplier=supplier.id','left')
        ->join('gemstone_type', 'gemstone_type.id=gemstone.type','left')
        ->where('disable',0)
        ->where('(pass=0 OR pass=3)')
        ->where('gemstone_type.id',$color)
        ->where('gemstone.process_type',$process)
		//->edit_column("pid","$1","pid");
		
		->edit_column("bid",'<div class="tooltip-demo">
	<a href="'.site_url("gemstone/showdetail_barcode/$1").'" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a>
	</div>',"bid");
    

		echo $this->datatables->generate(); 
	}
    
    function ajaxGetAllBarcodeFactory_Processcolor_0()
	{
        $color = $this->uri->segment(3);
        /*
        $this->load->library('Datatables');
        $this->datatables
            ->select("aa.barcodeid as barcodeid, CONCAT(aa.sname, lot, '-', number, '#', no) as detail, aa.gemtype as gemtype, gemstone.dateadd as gemdate, aa.bid as bid", FALSE)
            ->from("(SELECT gemstone_barcode.id as barcodeid, supplier.name as sname, lot, number, no, gemstone_type.name as gemtype, gemstone_task.dateadd as gemtaskdate, gemstone_barcode.id as bid, firstname, lastname FROM (`gemstone_barcode`) LEFT JOIN `gemstone` ON `gemstone`.`id` = `gemstone_barcode`.`gemstone_id` LEFT JOIN `supplier` ON `gemstone`.`supplier`=`supplier`.`id` LEFT JOIN `gemstone_type` ON `gemstone_type`.`id`=`gemstone`.`type` LEFT JOIN `gemstone_task` ON `gemstone_barcode`.`id`=`gemstone_task`.`barcode` LEFT JOIN `worker` ON `worker`.`id`=`gemstone_task`.`worker` WHERE `disable` = 0 AND (pass=0 OR pass=3) AND gemstone_type.id='".$color."' AND gemstone.process_type='".$process."' order by gemstone_task.dateadd desc) as aa")
            ->group_by('barcodeid')
            ->edit_column("bid",'<div class="tooltip-demo">
        <a href="'.site_url("gemstone/showdetail_barcode/$1").'" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a>
        </div>',"bid");
        */
        
        $this->load->library('Datatables');
		$this->datatables
		->select("gemstone_barcode.id as barcodeid,CONCAT(supplier.name,lot,'-',number,'#',no) as detail,gemstone_type.name as gemtype, gemstone.dateadd as gemdate, gemstone_barcode.id as bid", FALSE)
		->from('gemstone_barcode')
        ->join('gemstone', 'gemstone.id = gemstone_barcode.gemstone_id', 'left')
        ->join('supplier', 'gemstone.supplier=supplier.id','left')
        ->join('gemstone_type', 'gemstone_type.id=gemstone.type','left')
        ->where('disable',0)
        ->where('(pass=0 OR pass=3)')
        ->where('gemstone_type.id',$color)
		//->edit_column("pid","$1","pid");
		
		->edit_column("bid",'<div class="tooltip-demo">
	<a href="'.site_url("gemstone/showdetail_barcode/$1").'" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a>
	</div>',"bid");
    

		echo $this->datatables->generate(); 
	}
    
    function viewStation_worker()
    {
        $task = $this->uri->segment(3);
        
        $query = $this->report_model->getTask_worker_station($task);
		if($query){
			$data['task_array'] =  $query;
		}else{
			$data['task_array'] = array();
		}
        
        $data['title'] = "Cien|Gemstone Tracking System - Show Tasks";
		$this->load->view('report/showtask_worker_number',$data);
    }
    
    function viewErrorBetween()
    {
        $all = $this->uri->segment(3);
        
        $error_query = $this->gemstone_model->getGemstoneError();
        $error = array();
        $table = array();
        $i = 0;
        
        if ($all>0) {
            foreach($error_query as $loop) {
                $query = $this->report_model->getErrorAll($loop->name);
                foreach($query as $loop2) {
                    $error[$i] = array("id" => $loop->id, "name" => $loop->name, "count" => $loop2->count);
                }
                $query = $this->report_model->getErrorAll_barcode($loop->name);
                foreach($query as $loop2) {
                    $table[] = array("barcodeid" => $loop2->barcodeid,
                                       "supname" => $loop2->supname,
                                       "number" => $loop2->number,
                                       "lot" => $loop2->lot,
                                       "no" => $loop2->no,
                                       "gemtype" => $loop2->gemtype,
                                       "errordetail" => $loop2->errordetail
                                      );
                }
                $i++;
            }
            $data['start'] = 1;
        }else{
            $start = $this->input->post("startdate");
            if ($start != "") {
                $start = explode('/', $start);
                $start= $start[2]."-".$start[1]."-".$start[0];
            }
            $end = $this->input->post("enddate");
            if ($end != "") {
                $end = explode('/', $end);
                $end= $end[2]."-".$end[1]."-".$end[0];
            }
            
            foreach($error_query as $loop) {
                $query = $this->report_model->getErrorBetween($loop->name, $start, $end);
                foreach($query as $loop2) {
                    $error[$i] = array("id" => $loop->id, "name" => $loop->name, "count" => $loop2->count);
                }
                $query = $this->report_model->getErrorBetween_barcode($loop->name, $start, $end);
                foreach($query as $loop2) {
                    $table[] = array("barcodeid" => $loop2->barcodeid,
                                       "supname" => $loop2->supname,
                                       "number" => $loop2->number,
                                       "lot" => $loop2->lot,
                                       "no" => $loop2->no,
                                       "gemtype" => $loop2->gemtype,
                                       "errordetail" => $loop2->errordetail
                                      );
                }
                $i++;
            }
            
            $data['start'] = $start;
            $data['end'] = $end;
        }
        
        $data['error'] = $error;
        $data['table'] = $table;
        $data['title'] = "Cien|Gemstone Tracking System - Show Errors";
		$this->load->view('report/showerror_graph',$data);
    }
    
    function allBarcode_return() {
        $data['title'] = "Cien|Gemstone Tracking System - Show Gems";
		$this->load->view('report/allbarcode_return',$data);
    }
    
    function allBarcode_return_ok() {
        $data['title'] = "Cien|Gemstone Tracking System - Show Gems";
		$this->load->view('report/allbarcode_return_ok',$data);
    }
    
    function showgems_edit()
    {
        //$query = $this->report_model->getAllGemstone_edit();
        
        $data['title'] = "Cien|Gemstone Tracking System - Show Gems";
		$this->load->view('report/showgems_edit',$data);
    }
    
    function showgems_editing()
    {
        //$query = $this->report_model->getAllGemstone_editing();
        
        $data['title'] = "Cien|Gemstone Tracking System - Show Gems";
		$this->load->view('report/showgems_editing',$data);
    }
    
    function ajaxGetAllBarcode_edit()
	{
        $this->load->library('Datatables');
		$this->datatables
		->select("gemstone_barcode.id as barcodeid,CONCAT(supplier.name,lot,'-',number,'#',no) as detail,gemstone_type.name as gemtype, gemstone_qc.detail as qcdetail,CONCAT('<span class=hide>',date_format(gemstone_qc.dateadd,'%Y/%m/%d'),'</span>',date_format(gemstone_qc.dateadd,'%d/%m/%Y')) as editdate, (CASE WHEN pass=1 THEN 'ผ่าน' WHEN pass=2 THEN 'ไม่ผ่าน' WHEN pass=3 THEN 'กำลังซ่อม' END) as statusnow, gemstone_barcode.id as bid", FALSE)
		->from('gemstone_qc')
        ->join('gemstone_barcode','gemstone_qc.barcode = gemstone_barcode.id', 'left')
        ->join('gemstone', 'gemstone.id = gemstone_barcode.gemstone_id', 'left')
        ->join('supplier', 'gemstone.supplier=supplier.id','left')
        ->join('gemstone_type', 'gemstone_type.id=gemstone.type','left')
        ->where('disable',0)
        ->where('gemstone_qc.status',3)
		//->edit_column("pid","$1","pid");
		
		->edit_column("bid",'<div class="tooltip-demo">
	<a href="'.site_url("gemstone/showdetail_barcode/$1").'" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a></div>',"bid");

        
		echo $this->datatables->generate(); 
	}
    
    function ajaxGetAllBarcode_editing()
	{
        $this->load->library('Datatables');
		$this->datatables
		->select("gemstone_barcode.id as barcodeid,CONCAT(supplier.name,lot,'-',number,'#',no) as detail,gemstone_type.name as gemtype, gemstone_qc.detail as qcdetail, CONCAT('<span class=hide>',date_format(gemstone_qc.dateadd,'%Y/%m/%d'),'</span>',date_format(gemstone_qc.dateadd,'%d/%m/%Y')) as editdate, (CASE WHEN pass=1 THEN 'ผ่าน' WHEN pass=2 THEN 'ไม่ผ่าน' WHEN pass=3 THEN 'กำลังซ่อม' END) as statusnow, gemstone_barcode.id as bid", FALSE)
		->from('gemstone_qc')
        ->join('gemstone_barcode','gemstone_qc.barcode = gemstone_barcode.id', 'left')
        ->join('gemstone', 'gemstone.id = gemstone_barcode.gemstone_id', 'left')
        ->join('supplier', 'gemstone.supplier=supplier.id','left')
        ->join('gemstone_type', 'gemstone_type.id=gemstone.type','left')
        ->where('disable',0)
        ->where('gemstone_qc.status',3)
        ->where('pass',3)
		//->edit_column("pid","$1","pid");
		
		->edit_column("bid",'<div class="tooltip-demo">
	<a href="'.site_url("gemstone/showdetail_barcode/$1").'" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a></div>',"bid");

        
		echo $this->datatables->generate(); 
	}
    
    function searchbarcode()
    {
        $data['title'] = "Cien|Gemstone Tracking System - Search Barcode";
		$this->load->view('report/searchbarcode',$data);
    }
    
    function viewbarcode()
    {
        $barcodeid = $this->input->post("barcodeid");
        
        $query = $this->report_model->searchBarcode($barcodeid);
        $data["barcode_array"] = $query;
        
        $data['title'] = "Cien|Gemstone Tracking System - Search Barcode";
		$this->load->view('report/viewbarcode',$data);
    }
    
    function showworker_barcode()
    {
        $id = $this->uri->segment(3);
        
        $query = $this->stock_model->getStockOutList($id);
        $data['parcel_array'] = $query;
        
        $data['title'] = "Cien|Gemstone Tracking System - View Worker";
        $this->load->view('report/showworker_barcode',$data);
    }
    
    function viewInOut_process()
    {
        $query = $this->gemstone_model->getProcessType();
        $data['process_array'] = $query;
            
        $query = $this->gemstone_model->getGemstoneType();
        $data['type_array'] =  $query;
        
        $start = $this->input->post("startdate_process");
        if ($start != "") {
            $start = explode('/', $start);
            $start= $start[2]."-".$start[1]."-".$start[0];
        }else{
            $start = "1970-01-01";
        }
        $end = $this->input->post("enddate_process");
        if ($end != "") {
            $end = explode('/', $end);
            $end= $end[2]."-".$end[1]."-".$end[0];
        }else{
            $end = date('Y-m-d');
        }
        
        $data['start'] = $start;
        $data['end'] = $end;
        $data['gemtype'] = $this->input->post("gemtype_process");
        $data['processtype'] = $this->input->post("processtype_process");
        
        $data['title'] = "Cien|Gemstone Tracking System - View In/Out Parcel";
        $this->load->view('report/showinoutparcel_process',$data);
        
    }
    
    function viewInOut_inventory()
    {
        $query = $this->gemstone_model->getProcessType();
        $data['process_array'] = $query;
            
        $query = $this->gemstone_model->getGemstoneType();
        $data['type_array'] =  $query;
        
        $this->load->model('supplier','',TRUE);
        $query = $this->supplier->getSupplier();
        $data['supplier_array'] =  $query;
        
        $start = $this->input->post("startdate_process");
        if ($start != "") {
            $start = explode('/', $start);
            $start= $start[2]."-".$start[1]."-".$start[0];
        }else{
            $start = "1970-01-01";
        }
        $end = $this->input->post("enddate_process");
        if ($end != "") {
            $end = explode('/', $end);
            $end= $end[2]."-".$end[1]."-".$end[0];
        }else{
            $end = date('Y-m-d');
        }
        
        $data['start'] = $start;
        $data['end'] = $end;
        $data['gemtype'] = $this->input->post("gemtype");
        $data['processtype'] = $this->input->post("processtype");
        $data['supplier'] = $this->input->post("supplier");
        
        $data['title'] = "Cien|Gemstone Tracking System - View In/Out Inventory";
        $this->load->view('report/showinout_inventory',$data);
        
    }
    
    function ajaxGetParcelInOut_Process()
    {
        $start = $this->uri->segment(3);
        $end = $this->uri->segment(4);
        $gemtype = $this->uri->segment(5);
        $process = $this->uri->segment(6);
        
        $start = $start. " 00:00:00";
        $end = $end." 23:59:59";
        
        $column = "(gemstone.dateadd >='".$start."' and gemstone.dateadd <='".$end."'";
        if (($gemtype>0) && ($process>0)) $column .= " and gemstone.type = '".$gemtype."' and gemstone.process_type = '".$process."')";
        elseif ($gemtype>0) $column .= " and gemstone.type = '".$gemtype."')";
        elseif ($process>0) $column .= " and gemstone.process_type = '".$process."')";
        else $column .= ")";
        
        $this->load->library('Datatables');
		$this->datatables
		->select("CONCAT('<span class=hide>',date_format(gemstone.dateadd,'%Y/%m/%d'),'</span>',date_format(gemstone.dateadd,'%d/%m/%Y')) as showdate, CONCAT(supplier.name,lot,'-',number,'#',no) as detail, gemstone_type.name as gemtype, process_type.name as process_name, carat, amount, sum(CASE WHEN pass = 1 THEN 1 ELSE 0 END) as okout, sum(CASE WHEN pass = 2 THEN 1 ELSE 0 END) as nookout, sum(CASE WHEN pass = 4 THEN 1 ELSE 0 END) as outout, (amount - count(gemstone_barcode.id)) as ok, gemstone.id as gemid", FALSE)
        ->from('gemstone')
        ->join('supplier', 'gemstone.supplier=supplier.id','left')
        ->join('gemstone_type', 'gemstone_type.id=gemstone.type','left')
        ->join('gemstone_barcode', 'gemstone_barcode.gemstone_id=gemstone.id', 'left')
        ->join('process_type', 'process_type.id = gemstone.process_type', 'left')
        ->where('disable',0)
        ->where("(pass != 0 AND pass != 3)", NULL, FALSE)
        ->where($column)
        ->group_by('gemstone.id')
		->edit_column("gemid",'<div class="tooltip-demo">
	<a href="'.site_url("report/showdetail_parcel/$1").'" class="btn btn-success btn-xs" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a></div>',"gemid");

        
		echo $this->datatables->generate(); 
    }
    
    function exportParcelInOut_excel()
    {
        $start = $this->uri->segment(3);
        $end = $this->uri->segment(4);
        $gemtype = $this->uri->segment(5);
        $process = $this->uri->segment(6);
        
        $result_array = $this->report_model->getParcelInOut_process($start,$end,$gemtype,$process);

        //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Parcel');

        //$this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, "ทองคำแท่ง (96.5)");
        $this->excel->getActiveSheet()->setCellValue('A1', 'วันที่เข้า');
        $this->excel->getActiveSheet()->setCellValue('B1', 'เลขที่');
        $this->excel->getActiveSheet()->setCellValue('C1', 'ชนิด');
        $this->excel->getActiveSheet()->setCellValue('D1', 'ประเภทงาน');
        $this->excel->getActiveSheet()->setCellValue('E1', 'ส่งเข้าโรงงาน');
        $this->excel->getActiveSheet()->setCellValue('G1', 'ออกจากโรงงาน');
        $this->excel->getActiveSheet()->setCellValue('J1', 'เหลือในโรงงาน');
        $this->excel->getActiveSheet()->setCellValue('E2', 'กะรัต');
        $this->excel->getActiveSheet()->setCellValue('F2', 'เม็ด');
        $this->excel->getActiveSheet()->setCellValue('G2', 'QC ผ่าน (เม็ด)');
        $this->excel->getActiveSheet()->setCellValue('H2', 'QC ไม่ผ่าน (เม็ด)');
        $this->excel->getActiveSheet()->setCellValue('I2', 'ไม่เหมาะสม (เม็ด)');
        $this->excel->getActiveSheet()->mergeCells('E1:F1');
        $this->excel->getActiveSheet()->mergeCells('G1:I1');
        $this->excel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);

        // Fetching the table data

        $row = 3;
        foreach($result_array as $loop)
        {
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $loop->showdate);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $loop->detail);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $loop->gemtype);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $loop->process_name);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $loop->carat);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $loop->amount);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $loop->okout);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $loop->nookout);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $loop->outout);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $row, $loop->ok);
            $row++;
        }

        $filename='cien_parcel.xlsx'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
    
    function exportInOut_inventory_excel()
    {
        $start = $this->input->post('startdate');
        $end = $this->input->post('enddate');
        $gemtype = $this->input->post('gemtype');
        $supplier = $this->input->post('supplier');
        
        $start = $this->input->post("startdate");
        if ($start != "") {
            $start = explode('/', $start);
            $start= $start[2]."-".$start[1]."-".$start[0];
        }else{
            $start = "1970-01-01";
        }
        $end = $this->input->post("enddate");
        if ($end != "") {
            $end = explode('/', $end);
            $end= $end[2]."-".$end[1]."-".$end[0];
        }else{
            $end = date('Y-m-d');
        }
        
        $result_process = $this->report_model->getInOut_process($start,$end,$gemtype,$supplier);
        $result_array = $this->report_model->getInOut_inventory_number($start,$end,$gemtype,$supplier,$result_process);
        
        
            

        //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Parcel');

        //$this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, "ทองคำแท่ง (96.5)");
        $this->excel->getActiveSheet()->setCellValue('A1', 'Date รับเข้า');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Supplier');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Order');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Color');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Size');
        $this->excel->getActiveSheet()->setCellValue('F1', 'รับเข้า (In)');
        $this->excel->getActiveSheet()->setCellValue('F2', 'จำนวน (Pcs.)');
        $this->excel->getActiveSheet()->setCellValue('G2', 'น้ำหนัก (Cts.)');
        $this->excel->getActiveSheet()->mergeCells('F1:G1');
        $char = 'F';
        foreach($result_process as $loop) {
            if ($loop->pid!="") {
                $char++;
                $char2 = ++$char;
                $char2++;
                $this->excel->getActiveSheet()->setCellValue($char.'1', $loop->pname);
                $this->excel->getActiveSheet()->setCellValue($char.'2', 'จำนวน (Pcs.)');
                $this->excel->getActiveSheet()->setCellValue($char2.'2', 'น้ำหนัก (Cts.)');
                $this->excel->getActiveSheet()->mergeCells($char.'1:'.$char2.'1');
                $this->excel->getActiveSheet()->getStyle($char.'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            }
        }
        
        $char++;
        $char2 = ++$char;
        $char2++;
        $this->excel->getActiveSheet()->setCellValue($char.'1', 'Full Color');
        $this->excel->getActiveSheet()->setCellValue($char.'2', 'จำนวน (Pcs.)');
        $this->excel->getActiveSheet()->setCellValue($char2.'2', 'น้ำหนัก (Cts.)');
        $this->excel->getActiveSheet()->mergeCells($char.'1:'.$char2.'1');
        $this->excel->getActiveSheet()->getStyle($char.'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $char++;
        $char2 = ++$char;
        $char2++;
        $this->excel->getActiveSheet()->setCellValue($char.'1', 'Clean Size');
        $this->excel->getActiveSheet()->setCellValue($char.'2', 'จำนวน (Pcs.)');
        $this->excel->getActiveSheet()->setCellValue($char2.'2', 'น้ำหนัก (Cts.)');
        $this->excel->getActiveSheet()->mergeCells($char.'1:'.$char2.'1');
        $this->excel->getActiveSheet()->getStyle($char.'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $char++;
        $char2 = ++$char;
        $char2++;
        $this->excel->getActiveSheet()->setCellValue($char.'1', 'Not Clean');
        $this->excel->getActiveSheet()->setCellValue($char.'2', 'จำนวน (Pcs.)');
        $this->excel->getActiveSheet()->setCellValue($char2.'2', 'น้ำหนัก (Cts.)');
        $this->excel->getActiveSheet()->mergeCells($char.'1:'.$char2.'1');
        $this->excel->getActiveSheet()->getStyle($char.'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
        $char++;
        $char2 = ++$char;
        $char2++;
        $this->excel->getActiveSheet()->setCellValue($char.'1', 'Balance');
        $this->excel->getActiveSheet()->setCellValue($char.'2', 'จำนวน (Pcs.)');
        $this->excel->getActiveSheet()->setCellValue($char2.'2', 'น้ำหนัก (Cts.)');
        $this->excel->getActiveSheet()->mergeCells($char.'1:'.$char2.'1');
        $this->excel->getActiveSheet()->getStyle($char.'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        
        // Fetching the table data
        $row = 3;
        foreach($result_array as $loop)
        {
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $loop->showdate);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $loop->detail);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $loop->order_type);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $loop->gemtype);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $loop->gemsize);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $loop->stockamount);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $loop->gemcarat);
            $i = 7;
            $amount = "amount";
            $carat = "carat";
            foreach($result_process as $loop2) {
                if ($loop2->pid!="") {
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i++, $row, $loop->{$amount.$loop2->pid});
                    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i++, $row, $loop->{$carat.$loop2->pid});
                }
            }
            
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i++, $row, $loop->amountfull);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i++, $row, $loop->caratfull);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i++, $row, $loop->amountclean);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i++, $row, $loop->caratclean);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i++, $row, $loop->amountnot);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i++, $row, $loop->caratnot);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i++, $row, $loop->remainamount);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i++, $row, $loop->remaincarat);

            $row++;
        }

        $filename='cien_stock.xlsx'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
    
}