<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase extends CI_Controller {

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
    

}