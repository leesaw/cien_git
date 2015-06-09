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
        
        $query = $this->gemstone_model->getAllParcel();
		if($query){
			$data['parcel_array'] =  $query;
		}else{
			$data['parcel_array'] = array();
		}
        
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
        
        $month = explode('-',$month);
        $start = $month[1].'-'.$month[0].'-01';
        $end = $month[1].'-'.$month[0].'-31';
        
        $query = $this->report_model->getAllParcelColor_string($color, $start, $end);
		if($query){
			$data['parcel_array'] =  $query;
		}else{
			$data['parcel_array'] = array();
		}
        
        $data['color'] = $color;
        $data['month'] = $start;
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
            ->select("aa.barcodeid as barcodeid, CONCAT(aa.sname, lot, '-', number, '#', no) as detail, aa.gemtype as gemtype, aa.processname as processname, CONCAT(aa.firstname,' ', aa.lastname) as workername, gemdate, aa.bid as bid", FALSE)
            ->from("(SELECT gemstone_barcode.id as barcodeid, supplier.name as sname, lot, number, no, gemstone_type.name as gemtype, gemstone_task.dateadd as gemdate, gemstone_barcode.id as bid, firstname, lastname, process_type.name as processname FROM (`gemstone_barcode`) LEFT JOIN `gemstone` ON `gemstone`.`id` = `gemstone_barcode`.`gemstone_id` LEFT JOIN `supplier` ON `gemstone`.`supplier`=`supplier`.`id` LEFT JOIN `gemstone_type` ON `gemstone_type`.`id`=`gemstone`.`type` LEFT JOIN `gemstone_task` ON `gemstone_barcode`.`id`=`gemstone_task`.`barcode` LEFT JOIN `worker` ON `worker`.`id`=`gemstone_task`.`worker` LEFT JOIN `process_type` ON `process_type`.`id`=`gemstone`.`process_type` WHERE `disable` = 0 AND (pass=0 OR pass=3) AND ".$column." order by gemstone_task.dateadd desc) as aa")
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
    
    function showgems_edit()
    {
        $query = $this->report_model->getAllGemstone_edit();
        
        $data['title'] = "Cien|Gemstone Tracking System - Show Gems";
		$this->load->view('report/showgems_edit',$data);
    }
    
    function showgems_editing()
    {
        $query = $this->report_model->getAllGemstone_edit();
        
        $data['title'] = "Cien|Gemstone Tracking System - Show Gems";
		$this->load->view('report/showgems_editing',$data);
    }
    
    function ajaxGetAllBarcode_edit()
	{
        $this->load->library('Datatables');
		$this->datatables
		->select("gemstone_barcode.id as barcodeid,CONCAT(supplier.name,lot,'-',number,'#',no) as detail,gemstone_type.name as gemtype, gemstone_qc.detail as qcdetail, date_format(gemstone_qc.dateadd,'%d/%m/%y') as editdate, (CASE WHEN pass=1 THEN 'ผ่าน' WHEN pass=2 THEN 'ไม่ผ่าน' WHEN pass=3 THEN 'กำลังซ่อม' END) as statusnow, gemstone_barcode.id as bid", FALSE)
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
		->select("gemstone_barcode.id as barcodeid,CONCAT(supplier.name,lot,'-',number,'#',no) as detail,gemstone_type.name as gemtype, gemstone_qc.detail as qcdetail, date_format(gemstone_qc.dateadd,'%d/%m/%y') as editdate, (CASE WHEN pass=1 THEN 'ผ่าน' WHEN pass=2 THEN 'ไม่ผ่าน' WHEN pass=3 THEN 'กำลังซ่อม' END) as statusnow, gemstone_barcode.id as bid", FALSE)
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
}