<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Public_all extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('kpi_model','',TRUE);
	}
	function index()
	{
	    $this->viewstation();
	}
    
    function viewmain()
    {
        $current= date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day', strtotime($current)));
        
        // station press front lastest
        $query = $this->kpi_model->getAllstaff_station(3,$yesterday,$yesterday);
		if($query){
			$data['station3_array'] =  $query;
		}else{
			$data['station3_array'] = array();
		}
        
        // station schelk today lastest
        $query = $this->kpi_model->getAllstaff_station(4,$yesterday,$yesterday);
		if($query){
			$data['station4_array'] =  $query;
		}else{
			$data['station4_array'] = array();
		}
        
        // station block today lastest
        $query = $this->kpi_model->getAllstaff_station(5,$yesterday,$yesterday);
		if($query){
			$data['station5_array'] =  $query;
		}else{
			$data['station5_array'] = array();
		}
        
        // station block today lastest
        $query = $this->kpi_model->getAllstaff_station(6,$yesterday,$yesterday);
		if($query){
			$data['station6_array'] =  $query;
		}else{
			$data['station6_array'] = array();
		}
        
        // station block today lastest
        $query = $this->kpi_model->getAllstaff_station(7,$yesterday,$yesterday);
		if($query){
			$data['station7_array'] =  $query;
		}else{
			$data['station7_array'] = array();
		}
        
        // station block today lastest
        $query = $this->kpi_model->getAllstaff_station(8,$yesterday,$yesterday);
		if($query){
			$data['station8_array'] =  $query;
		}else{
			$data['station8_array'] = array();
		}
        
        // station block today lastest
        $query = $this->kpi_model->getAllstaff_station(9,$yesterday,$yesterday);
		if($query){
			$data['station9_array'] =  $query;
		}else{
			$data['station9_array'] = array();
		}
        
        // station block today lastest
        $query = $this->kpi_model->getAllstaff_station(12,$yesterday,$yesterday);
		if($query){
			$data['station12_array'] =  $query;
		}else{
			$data['station12_array'] = array();
		}
        
        // station block today lastest
        $query = $this->kpi_model->getAllstaff_station(13,$yesterday,$yesterday);
		if($query){
			$data['station13_array'] =  $query;
		}else{
			$data['station13_array'] = array();
		}
        
        // korat
        $query = $this->kpi_model->getStation_date(10,$yesterday,$yesterday);
		if($query){
			$data['station10_array'] =  $query;
		}else{
			$data['station10_array'] = array();
		}
        
        $data['between_status'] = 0;
        $data['point_status'] = 0;
        
        $data['title'] = "Cien|Gemstone Tracking System - Show KPI";
		$this->load->view('kpi/viewmain',$data);
    }
    
    function viewworker()
    {
        $worker = $this->uri->segment(3);
        
        $this->load->model('worker_model','',TRUE);
        $query = $this->worker_model->getOneWorker($worker);
        foreach($query as $loop) {
            $data['workername'] = $loop->firstname." ".$loop->lastname;
        }
        
        
        $current= date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day', strtotime($current)));
        $lastseven = date('Y-m-d', strtotime('-7 day', strtotime($current)));
        $lastmonth = date('Y-m-d', strtotime('-30 day', strtotime($current)));
        /*
        $current= date('Y-m');
        $start = $current."-01";
        $end = $current."-31";
        */
        
        // per person
        $result = array();
        
        // get real station of that worker
        $query = $this->kpi_model->getAllstation_worker($worker, $lastmonth, $yesterday);
        $maxvalue = 0;
        $worker_status = 0;
        foreach($query as $loop) {
            if ($maxvalue < $loop->sum1) {
                $maxvalue = $loop->sum1;
                $worker_status = $loop->status;
            }
        }
        
        for($i=-1; $i>-9; $i--) {
            $current= date('Y-m-d');
            $day1 = date('Y-m-d', strtotime($i.' day', strtotime($current)));
            
            $query_temp = $this->kpi_model->getStation_process_worker($worker_status, $worker, $day1, $day1);
            foreach($query_temp as $loop2) {
                $result[] = array("day1" => $day1,
                                  "pid" => $loop2->pid,
                                  "pname" => $loop2->pname,
                                  "sum1" => $loop2->sum1
                                     );   
            }
        }
        
        $this->load->model('gemstone_model','',TRUE);
        $data['process_list'] = $this->gemstone_model->getProcessType();
        
        $data['table_array'] = $result;
        // per process type
        $query = $this->kpi_model->getWorker_date($worker, $lastseven, $yesterday);
        if($query){
			$data['date_array'] =  $query;
		}else{
			$data['date_array'] = array();
		}
        
        $this->load->model('config_model','',TRUE);
        $temp = "KPI_WORKER".$worker_status;
        $query = $this->config_model->getConfig($temp);
        foreach($query as $loop) {
            $data['kpi_max'] = $loop->value;
        }
        
        $temp = "MEAN_WORKER".$worker_status;
        $query = $this->config_model->getConfig($temp);
        foreach($query as $loop) {
            $data['kpi_mean'] = $loop->value;
        }
        
        $data['workerid'] = $worker;
        $data['between_status'] = 0;
        $data['point_status'] = 0;
        
        $data['title'] = "Cien|Gemstone Tracking System - Show KPI";
		$this->load->view('kpi/viewworker',$data);
    }
    
    function viewstation()
    {
        $status = $this->uri->segment(3);
        
        if ($status<1) $status=3;
        
        $current= date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day', strtotime($current)));
        $lastseven = date('Y-m-d', strtotime('-14 day', strtotime($current)));
        
        // last month
        $lastmonth = explode('-', $current);
        $lastmonth = $lastmonth[2]."-".$lastmonth[1]."-01";
        
        // per person
        $result = array();
        if ($status==10) {
            $query_temp = $this->kpi_model->getStation_process_worker($status, 0, $yesterday, $yesterday);
            foreach($query_temp as $loop2) {
                $result[] = array("pid" => $loop2->pid,
                                  "pname" => $loop2->pname,
                                  "sum1" => $loop2->sum1
                                 );
            }
        }else{
            $query = $this->kpi_model->getAllstaff_station($status, $yesterday, $yesterday);
            foreach($query as $loop) {
                $query_temp = $this->kpi_model->getStation_process_worker($status, $loop->workerid, $yesterday, $yesterday);
                foreach($query_temp as $loop2) {
                    $result[] = array("worker" => $loop->firstname." ".$loop->lastname, 
                                      "workerid" => $loop->workerid,
                                      "pid" => $loop2->pid,
                                      "pname" => $loop2->pname,
                                      "sum1" => $loop2->sum1
                                     );
                }

            }
        }
        
        $this->load->model('gemstone_model','',TRUE);
        $data['process_list'] = $this->gemstone_model->getProcessType();
        
        $data['table_array'] = $result;
        // per process type
        $query = $this->kpi_model->getStation_date($status, $lastseven, $yesterday);
        if($query){
			$data['date_array'] =  $query;
		}else{
			$data['date_array'] = array();
		}
        
        $this->load->model('config_model','',TRUE);
        $temp = "KPI_STATION".$status;
        $query = $this->config_model->getConfig($temp);
        foreach($query as $loop) {
            $data['kpi_max'] = $loop->value;
        }
        
        $temp = "MEAN_STATION".$status;
        $query = $this->config_model->getConfig($temp);
        foreach($query as $loop) {
            $data['kpi_mean'] = $loop->value;
        }
        
        // last month view
        $query = $this->kpi_model->getAllstaff_station($status,$lastseven,$yesterday);
        if($query){
            $data['month_array'] =  $query;
        }else{
            $data['month_array'] = array();
        }
        
        $data['taskid'] = $status;
        $data['between_status'] = 0;
        $data['point_status'] = 0;
        
        
        
        $data['title'] = "Cien|Gemstone Tracking System - Show KPI";
		$this->load->view('kpi/public_station_lastday',$data);
    }

    
}