<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Suppliers extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('supplier','',TRUE);
		//$this->load->library('form_validation');
		if (!($this->session->userdata('sessusername'))) redirect('login', 'refresh');
	}
	function index()
	{
	 
	}
    
    function addNewSupplier()
    {
        $name = $this->input->post('supplier');
        //return false;
        $count = $this->supplier->checkName($name);
        //return false;
        if ($count<=0) {
            $supplier = array('name' => $name);
            $query = $this->supplier->addSupplier($supplier);
            echo 1;
        }else{
            echo 0;
        }
    }
		

}