<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); 

class Main extends CI_Controller {
	function __construct()
	{
	   parent::__construct();
	   $this->load->model('user','',TRUE);
	}
	function index()
	{
		if($this->session->userdata('sessid'))
		{
            $color = $this->uri->segment(3); 
            $this->load->model('gemstone_model','',TRUE);
            $this->load->model('report_model','',TRUE);
            
            $query = $this->report_model->getAllGemstoneInFactory();
            $data['gem_array'] = $query;
            /*
            $color = array();
            $i=0;
            foreach ($query as $loop) {
                $typename = str_replace(" ", "", $loop->typename);
                $data['color_'.$typename] = $this->report_model->getColorGemstoneInFactory($loop->typename);
                $color[$i] = $typename;
                $i++;
            }
            $data['color'] = $color;
            */
            if ($color>0) { $data['color'] = $this->report_model->getColorGemstoneInFactory_id($color); }
            else { $color = 1; $data['color'] = $this->report_model->getColorGemstoneInFactory_id($color); }
            
            $data['colorgraph'] = $color;
            $query = $this->report_model->getAllStationInFactory();
            $data['station_array'] = $query;
            
            $query = $this->report_model->getAllStationInFactory_edit();
            $data['edit_array'] = $query;
            
            $query = $this->gemstone_model->getProcessType();
            $data['process_array'] = $query;
            
            $d = 0;
            $sevenday = array();
            for ($d=0; $d > -7; $d--) {
                $current= date('Y-m-d');
                $current = date('Y-m-d', strtotime('-1 day', strtotime($current)));
                $date = strtotime($current);
                $date = strtotime($d." day", $date);
                $sevenday[] = date('Y-m-d',$date);
            }
            $data['ss'] = $sevenday;
            $query = $this->report_model->getInOutSevenDay($sevenday);
            $data['sevenday'] = $query;
            
			$data['title'] = "Cien|Gemstone Tracking System - Main";
			$this->load->view('main_view',$data);
        }
	   else
	   {
		 //If no session, redirect to login page
		 redirect('login', 'refresh');
	   }
	}
	
	function logout()
	{
	   $this->session->unset_userdata('sessid');
	   $this->session->unset_userdata('sessusername');
	   $this->session->unset_userdata('sessfirstname');
	   $this->session->unset_userdata('sesslastname');
	   $this->session->unset_userdata('sessstatus');
	   session_destroy();
	   redirect('main', 'refresh');
	}
	
	function changepass()
	{
		$this->load->helper(array('form'));
		
		$data['id'] = $this->session->userdata('sessid');
		
		$data['title'] = "Cien|Gemstone Tracking System - Change Password";
		
		$this->load->view('changepass_view',$data);
	}
	
	function updatepass()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('opassword', 'old password', 'trim|xss_clean|required|md5');
		$this->form_validation->set_rules('npassword', 'new password', 'trim|xss_clean|required|md5');
		$this->form_validation->set_rules('passconf', 'Password confirmation', 'trim|xss_clean|required|matches[npassword]');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_message('matches', 'กรุณาใส่รหัสให้ตรงกัน');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
		
		if($this->form_validation->run() == TRUE) {
			$newpass= ($this->input->post('npassword'));
			$oldpass= ($this->input->post('opassword'));
			$id= ($this->input->post('id'));

			if ($this->user->checkpass($id,$oldpass)) {
					
				$user = array(
					'id' => $id,
					'password' => $newpass
				);

				$result = $this->user->editUser($user);
				if ($result)
					$this->session->set_flashdata('showresult', 'success');
				else
					$this->session->set_flashdata('showresult', 'fail');

			}else{
				$this->session->set_flashdata('showresult', 'failpass');
			}
			redirect(current_url());
		}
            $data['id'] = $this->session->userdata('sessid');
			$data['title'] = "Cien|Gemstone Tracking System - Change Password";
			
			$this->load->view('changepass_view',$data);
	}
    
    function config()
    {
        $this->load->model('config_model','',TRUE);
        $data["config_array"] = $this->config_model->getAllconfig();
		
		$data['title'] = "Cien|Gemstone Tracking System - Configuration";
		$this->load->view('config',$data);
    }
    
    function saveconfig()
    {
        $lock_seq_task = $this->input->post('LOCK_SEQ_TASK');
        $config_array = array("config" => "LOCK_SEQ_TASK", "value" => $lock_seq_task);
        $this->load->model('config_model','',TRUE);
        $result = $this->config_model->editConfig($config_array);
        if ($result){
            $this->session->set_flashdata('showresult', 'true');
        }else{
            $this->session->set_flashdata('showresult', 'fail');
        }
        $data["config_array"] = $this->config_model->getAllconfig();
        $data['title'] = "Cien|Gemstone Tracking System - Configuration";
        redirect('main/config', 'refresh');
    }
}