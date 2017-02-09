<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gemstone_status extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('gemstone_status_model','',TRUE);
    $this->load->model('gemstone_model','',TRUE);
	}
	function form_new_status()
	{
    $data['status_array'] = $this->gemstone_status_model->get_status_list();

    $data['title'] = "Cien|Gemstone Tracking System - New Gemstone Status";
    $this->load->view('gemstone_status/form_new_status',$data);
	}

	function save_new_status()
	{
		$gemid_array = $this->input->post('gemid');
		$status_in = $this->input->post('status');

		$count = 0;

		for($i=0; $i < count($gemid_array); $i++) {
				$gem = array(
								"id" => $gemid_array[$i]["id"],
								"gsl_status" => $status_in
							);
				$query = $this->gemstone_status_model->edit_gemstone_status($gem);
				if ($query) $count++;
		}
		$result = array("a" => $count);
    echo json_encode($result);
    exit();
	}

	function check_barcode()
	{
		$barcodeid= $this->input->post('barcode');
		$barcodeid = ltrim($barcodeid, '0');

		$result = $this->gemstone_model->getBarcode($barcodeid);

    $output = "";
    foreach ($result as $loop) {
        $output .= "<td><input type='hidden' name='gemid' id='gemid' value='".$loop->gemid."'>".$loop->gemid."-".$loop->supname.$loop->lot."-".$loop->number."(#".$loop->no.")"." ".$loop->typename."</td>";

    }
    echo $output;

	}


}
