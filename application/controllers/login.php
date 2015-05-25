<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

 function __construct()
 {
   parent::__construct();
 }

 function index()
 {
	$data['title'] = "Cien|Gemstone Tracking System";
    $this->load->helper(array('form'));
    $this->load->view('login_view',$data);
 }

}

?>