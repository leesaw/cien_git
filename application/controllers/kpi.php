<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kpi extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('kpi_model','',TRUE);
		if (!($this->session->userdata('sessusername'))) redirect('login', 'refresh');
	}
	function index()
	{
	 
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
        
        $data['between_status'] = 0;
        $data['point_status'] = 0;
        
        $data['title'] = "Cien|Gemstone Tracking System - Show KPI";
		$this->load->view('kpi/viewmain',$data);
    }
    
    function viewmain_point()
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
        
        $data['between_status'] = 0;
        $data['point_status'] = 1;
        
        $data['title'] = "Cien|Gemstone Tracking System - Show KPI";
		$this->load->view('kpi/viewmain',$data);
    }
    
    function viewallstation_between()
    {
        $start = $this->input->post("startdate_kpi");
        if ($start != "") {
            $start = explode('/', $start);
            $start= $start[2]."-".$start[1]."-".$start[0];
        }else{
            $start = "1970-01-01";
        }
        $end = $this->input->post("enddate_kpi");
        if ($end != "") {
            $end = explode('/', $end);
            $end= $end[2]."-".$end[1]."-".$end[0];
        }else{
            $end = date('Y-m-d');
        }
        
        // station press front lastest
        $query = $this->kpi_model->getAllstaff_station(3,$start,$end);
		if($query){
			$data['station3_array'] =  $query;
		}else{
			$data['station3_array'] = array();
		}
        
        // station schelk today lastest
        $query = $this->kpi_model->getAllstaff_station(4,$start,$end);
		if($query){
			$data['station4_array'] =  $query;
		}else{
			$data['station4_array'] = array();
		}
        
        // station block today lastest
        $query = $this->kpi_model->getAllstaff_station(5,$start,$end);
		if($query){
			$data['station5_array'] =  $query;
		}else{
			$data['station5_array'] = array();
		}
        
        // station block today lastest
        $query = $this->kpi_model->getAllstaff_station(6,$start,$end);
		if($query){
			$data['station6_array'] =  $query;
		}else{
			$data['station6_array'] = array();
		}
        
        // station block today lastest
        $query = $this->kpi_model->getAllstaff_station(7,$start,$end);
		if($query){
			$data['station7_array'] =  $query;
		}else{
			$data['station7_array'] = array();
		}
        
        // station block today lastest
        $query = $this->kpi_model->getAllstaff_station(8,$start,$end);
		if($query){
			$data['station8_array'] =  $query;
		}else{
			$data['station8_array'] = array();
		}
        
        // station block today lastest
        $query = $this->kpi_model->getAllstaff_station(9,$start,$end);
		if($query){
			$data['station9_array'] =  $query;
		}else{
			$data['station9_array'] = array();
		}
        
        // station block today lastest
        $query = $this->kpi_model->getAllstaff_station(12,$start,$end);
		if($query){
			$data['station12_array'] =  $query;
		}else{
			$data['station12_array'] = array();
		}
        
        // station block today lastest
        $query = $this->kpi_model->getAllstaff_station(13,$start,$end);
		if($query){
			$data['station13_array'] =  $query;
		}else{
			$data['station13_array'] = array();
		}
        
        $data['between_status'] = 1;
        $data['point_status'] = 0;
        $data['start_date'] = $start;
        $data['end_date'] = $end;
        
        $data['startdate'] = $start;
        $data['enddate'] = $end;
        
        $data['title'] = "Cien|Gemstone Tracking System - Show KPI";
		$this->load->view('kpi/viewallstation_between',$data);
    }
    
    function viewallstation_point_between()
    {
        $start = $this->input->post("startdate_kpi");
        if ($start != "") {
            $start = explode('/', $start);
            $start= $start[2]."-".$start[1]."-".$start[0];
        }else{
            $start = "1970-01-01";
        }
        $end = $this->input->post("enddate_kpi");
        if ($end != "") {
            $end = explode('/', $end);
            $end= $end[2]."-".$end[1]."-".$end[0];
        }else{
            $end = date('Y-m-d');
        }
        
        // station press front lastest
        $query = $this->kpi_model->getAllstaff_station(3,$start,$end);
		if($query){
			$data['station3_array'] =  $query;
		}else{
			$data['station3_array'] = array();
		}
        
        // station schelk today lastest
        $query = $this->kpi_model->getAllstaff_station(4,$start,$end);
		if($query){
			$data['station4_array'] =  $query;
		}else{
			$data['station4_array'] = array();
		}
        
        // station block today lastest
        $query = $this->kpi_model->getAllstaff_station(5,$start,$end);
		if($query){
			$data['station5_array'] =  $query;
		}else{
			$data['station5_array'] = array();
		}
        
        // station block today lastest
        $query = $this->kpi_model->getAllstaff_station(6,$start,$end);
		if($query){
			$data['station6_array'] =  $query;
		}else{
			$data['station6_array'] = array();
		}
        
        // station block today lastest
        $query = $this->kpi_model->getAllstaff_station(7,$start,$end);
		if($query){
			$data['station7_array'] =  $query;
		}else{
			$data['station7_array'] = array();
		}
        
        // station block today lastest
        $query = $this->kpi_model->getAllstaff_station(8,$start,$end);
		if($query){
			$data['station8_array'] =  $query;
		}else{
			$data['station8_array'] = array();
		}
        
        // station block today lastest
        $query = $this->kpi_model->getAllstaff_station(9,$start,$end);
		if($query){
			$data['station9_array'] =  $query;
		}else{
			$data['station9_array'] = array();
		}
        
        // station block today lastest
        $query = $this->kpi_model->getAllstaff_station(12,$start,$end);
		if($query){
			$data['station12_array'] =  $query;
		}else{
			$data['station12_array'] = array();
		}
        
        // station block today lastest
        $query = $this->kpi_model->getAllstaff_station(13,$start,$end);
		if($query){
			$data['station13_array'] =  $query;
		}else{
			$data['station13_array'] = array();
		}
        
        $data['between_status'] = 1;
        $data['point_status'] = 1;
        $data['start_date'] = $start;
        $data['end_date'] = $end;
        
        $data['startdate'] = $start;
        $data['enddate'] = $end;
        
        $data['title'] = "Cien|Gemstone Tracking System - Show KPI";
		$this->load->view('kpi/viewallstation_between',$data);
    }
    
    function viewstation()
    {
        $status = $this->uri->segment(3);
        
        $current= date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day', strtotime($current)));
        $lastseven = date('Y-m-d', strtotime('-7 day', strtotime($current)));
        /*
        $current= date('Y-m');
        $start = $current."-01";
        $end = $current."-31";
        */
        
        // per person
        $result = array();
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
        
        $this->load->model('gemstone_model','',TRUE);
        $data['process_list'] = $this->gemstone_model->getProcessType();
        
        $data['table_array'] = $result;
        // per process type
        /*
        $d = 0;
        $sevenday = array();
        $seven_query = array();
        for ($d=0; $d > -7; $d--) {
            $current= date('Y-m-d');
            $current = date('Y-m-d', strtotime('-1 day', strtotime($current)));
            $date = strtotime($current);
            $date = strtotime($d." day", $date);
            $sevenday[] = date('Y-m-d',$date);
        }
        
        foreach($sevenday as $loop) {
            $query = $this->kpi_model->getStation_date($status, $loop, $loop);
            if ($query) {
                foreach($query as $loop2) {
                    $seven_query[] = array("day1" => $loop, "sum1" => $loop2->sum1);
                }
            }else{
                $seven_query[] = array("day1" => $loop, "sum1" => 0);
            }
        }
        */
        $query = $this->kpi_model->getStation_date($status, $lastseven, $yesterday);
        if($query){
			$data['date_array'] =  $query;
		}else{
			$data['date_array'] = array();
		}
        
        //$data['date_array'] = $seven_query;
        
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
        
        $data['taskid'] = $status;
        $data['between_status'] = 0;
        $data['point_status'] = 0;
        
        $data['title'] = "Cien|Gemstone Tracking System - Show KPI";
		$this->load->view('kpi/viewstation',$data);
    }
    
    function viewstation_between()
    {
        $status = $this->uri->segment(3);
        
        $start = $this->input->post("startdate_kpi");
        if ($start != "") {
            $start = explode('/', $start);
            $start= $start[2]."-".$start[1]."-".$start[0];
        }else{
            $start = "1970-01-01";
        }
        $end = $this->input->post("enddate_kpi");
        if ($end != "") {
            $end = explode('/', $end);
            $end= $end[2]."-".$end[1]."-".$end[0];
        }else{
            $end = date('Y-m-d');
        }
        /*
        $current= date('Y-m');
        $start = $current."-01";
        $end = $current."-31";
        */
        
        // per person
        $result = array();
        $query = $this->kpi_model->getAllstaff_station($status, $start, $end);
        foreach($query as $loop) {
            $query_temp = $this->kpi_model->getStation_process_worker($status, $loop->workerid, $start, $end);
            foreach($query_temp as $loop2) {
                $result[] = array("worker" => $loop->firstname." ".$loop->lastname, 
                                  "workerid" => $loop->workerid,
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
        $query = $this->kpi_model->getStation_date($status, $start, $end);
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
        
        $data['taskid'] = $status;
        $data['between_status'] = 1;
        $data['point_status'] = 0;
        $data['start_date'] = $start;
        $data['end_date'] = $end;
        
        $data['title'] = "Cien|Gemstone Tracking System - Show KPI";
		$this->load->view('kpi/viewstation',$data);
    }
    
    function viewstation_point()
    {
        $status = $this->uri->segment(3);
        
        $current= date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day', strtotime($current)));
        $lastseven = date('Y-m-d', strtotime('-7 day', strtotime($current)));
        /*
        $current= date('Y-m');
        $start = $current."-01";
        $end = $current."-31";
        */
        
        // per person
        $result = array();
        $query = $this->kpi_model->getAllstaff_station($status, $yesterday, $yesterday);
        foreach($query as $loop) {
            $query_temp = $this->kpi_model->getStation_process_worker($status, $loop->workerid, $yesterday, $yesterday);
            foreach($query_temp as $loop2) {
                $result[] = array("worker" => $loop->firstname." ".$loop->lastname, 
                                  "workerid" => $loop->workerid,
                                  "pid" => $loop2->pid,
                                  "pname" => $loop2->pname,
                                  "sum1" => $loop2->sum2
                                 );
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
        
        $data['taskid'] = $status;
        $data['between_status'] = 0;
        $data['point_status'] = 1;
        
        $data['title'] = "Cien|Gemstone Tracking System - Show KPI";
		$this->load->view('kpi/viewstation',$data);
    }
    
    function viewstation_point_between()
    {
        $status = $this->uri->segment(3);
        
        $start = $this->input->post("startdate_kpi");
        if ($start != "") {
            $start = explode('/', $start);
            $start= $start[2]."-".$start[1]."-".$start[0];
        }else{
            $start = "1970-01-01";
        }
        $end = $this->input->post("enddate_kpi");
        if ($end != "") {
            $end = explode('/', $end);
            $end= $end[2]."-".$end[1]."-".$end[0];
        }else{
            $end = date('Y-m-d');
        }
        /*
        $current= date('Y-m');
        $start = $current."-01";
        $end = $current."-31";
        */
        
        // per person
        $result = array();
        $query = $this->kpi_model->getAllstaff_station($status, $start, $end);
        foreach($query as $loop) {
            $query_temp = $this->kpi_model->getStation_process_worker($status, $loop->workerid, $start, $end);
            foreach($query_temp as $loop2) {
                $result[] = array("worker" => $loop->firstname." ".$loop->lastname, 
                                  "workerid" => $loop->workerid,
                                  "pid" => $loop2->pid,
                                  "pname" => $loop2->pname,
                                  "sum1" => $loop2->sum2
                                 );
            }
            
        }
        
        $this->load->model('gemstone_model','',TRUE);
        $data['process_list'] = $this->gemstone_model->getProcessType();
        
        $data['table_array'] = $result;
        // per process type
        $query = $this->kpi_model->getStation_date($status, $start, $end);
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
        
        $data['taskid'] = $status;
        $data['between_status'] = 1;
        $data['point_status'] = 1;
        $data['start_date'] = $start;
        $data['end_date'] = $end;
        
        $data['title'] = "Cien|Gemstone Tracking System - Show KPI";
		$this->load->view('kpi/viewstation',$data);
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
    
    function viewworker_point()
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
                                  "sum1" => $loop2->sum2
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
        $data['point_status'] = 1;
        
        $data['title'] = "Cien|Gemstone Tracking System - Show KPI";
		$this->load->view('kpi/viewworker',$data);
    }
    
    function viewworker_between()
    {
        $worker = $this->uri->segment(3);
        
        $start = $this->input->post("startdate_kpi");
        if ($start != "") {
            $start = explode('/', $start);
            $start= $start[2]."-".$start[1]."-".$start[0];
        }else{
            $start = "1970-01-01";
        }
        $end = $this->input->post("enddate_kpi");
        if ($end != "") {
            $end = explode('/', $end);
            $end= $end[2]."-".$end[1]."-".$end[0];
        }else{
            $end = date('Y-m-d');
        }
        
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
        
        // per process type
        $query = $this->kpi_model->getWorker_date($worker, $start, $end);
        if($query){
			$data['date_array'] =  $query;
		}else{
			$data['date_array'] = array();
		}
        
        $datediff = strtotime($end) - strtotime($start);
        $datediff = floor($datediff/(60*60*24));
        
        
        
        $count_day = -$datediff;
        
        for($i=0; $i>=$count_day; $i--) {
            //$current= date('Y-m-d');
            $day1 = date('Y-m-d', strtotime($i.' day', strtotime($end)));
            
            
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
        $data['between_status'] = 1;
        $data['point_status'] = 0;
        $data['start_date'] = $start;
        $data['end_date'] = $end;
        
        $data['title'] = "Cien|Gemstone Tracking System - Show KPI";
		$this->load->view('kpi/viewworker',$data);
    }
    
    function viewworker_point_between()
    {
        $worker = $this->uri->segment(3);
        
        $start = $this->input->post("startdate_kpi");
        if ($start != "") {
            $start = explode('/', $start);
            $start= $start[2]."-".$start[1]."-".$start[0];
        }else{
            $start = "1970-01-01";
        }
        $end = $this->input->post("enddate_kpi");
        if ($end != "") {
            $end = explode('/', $end);
            $end= $end[2]."-".$end[1]."-".$end[0];
        }else{
            $end = date('Y-m-d');
        }
        
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
        
        // per process type
        $query = $this->kpi_model->getWorker_date($worker, $start, $end);
        if($query){
			$data['date_array'] =  $query;
		}else{
			$data['date_array'] = array();
		}
        
        $datediff = strtotime($end) - strtotime($start);
        $datediff = floor($datediff/(60*60*24));
        
        
        
        $count_day = -$datediff;
        
        for($i=0; $i>=$count_day; $i--) {
            $day1 = date('Y-m-d', strtotime($i.' day', strtotime($end)));
            
            $query_temp = $this->kpi_model->getStation_process_worker($worker_status, $worker, $day1, $day1);
            foreach($query_temp as $loop2) {
                $result[] = array("day1" => $day1,
                                  "pid" => $loop2->pid,
                                  "pname" => $loop2->pname,
                                  "sum1" => $loop2->sum2
                                     );   
            }
        }
        
        $this->load->model('gemstone_model','',TRUE);
        $data['process_list'] = $this->gemstone_model->getProcessType();
        
        $data['table_array'] = $result;
        
        
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
        $data['between_status'] = 1;
        $data['point_status'] = 1;
        $data['start_date'] = $start;
        $data['end_date'] = $end;
        
        $data['title'] = "Cien|Gemstone Tracking System - Show KPI";
		$this->load->view('kpi/viewworker',$data);
    }
    
}