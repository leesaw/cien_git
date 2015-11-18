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
        
        $data['startdate'] = $start;
        $data['enddate'] = $end;
        
        $data['title'] = "Cien|Gemstone Tracking System - Show KPI";
		$this->load->view('kpi/viewallstation_between',$data);
    }
    
    function viewstation()
    {
        $status = $this->uri->segment(3);
        
        $current= date('Y-m');
        $start = $current."-01";
        $end = $current."-31";
        
        // per person
        $result = array();
        $query = $this->kpi_model->getAllstaff_station($status, $start, $end);
        foreach($query as $loop) {
            $query_temp = $this->kpi_model->getStation_process_worker($loop->workerid, $start, $end);
            foreach($query_temp as $loop2) {
                $result[] = array("worker" => $loop->firstname." ".$loop->lastname, 
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
        $query = $this->kpi_model->getAllstaff_station($status, $start, $end);
        if($query){
			$data['process_array'] =  $query;
		}else{
			$data['process_array'] = array();
		}
        
        $data['title'] = "Cien|Gemstone Tracking System - Show KPI";
		$this->load->view('kpi/viewstation',$data);
    }
    
}