<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kpi_time extends CI_Controller {

function __construct()
{
 parent::__construct();
 $this->load->model('kpi_time_model','',TRUE);
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
  $query = $this->kpi_time_model->getAllstaff_station(3,$yesterday,$yesterday);
  if($query){
    $data['station3_array'] =  $query;
  }else{
    $data['station3_array'] = array();
  }

  $data['between_status'] = 0;
  $data['point_status'] = 0;

  $data['title'] = "Cien|Gemstone Tracking System - Show KPI";
  $this->load->view('kpi_time/viewmain',$data);
}

}

?>
