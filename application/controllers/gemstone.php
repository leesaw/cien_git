<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gemstone extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('gemstone_model','',TRUE);
		$this->load->library('form_validation');
		if (!($this->session->userdata('sessusername'))) redirect('login', 'refresh');
	}
	function index()
	{

	}
		
	function addgems()
	{
		$this->load->helper(array('form'));
        
        $this->load->model('supplier','',TRUE);
		$query = $this->supplier->getSupplier();
		if($query){
			$data['supplier_array'] =  $query;
		}else{
			$data['supplier_array'] = array();
		}
        
        //$this->load->model('gemstone_model','',TRUE);
		$query = $this->gemstone_model->getGemstoneType();
		if($query){
			$data['type_array'] =  $query;
		}else{
			$data['type_array'] = array();
		}
        
        $query = $this->gemstone_model->getProcessType();
		if($query){
			$data['process_array'] =  $query;
		}else{
			$data['process_array'] = array();
		}
        
        $query = $this->gemstone_model->getGemstoneSize();
		if($query){
			$data['size_array'] =  $query;
		}else{
			$data['size_array'] = array();
		}
        
		$data['title'] = "Cien|Gemstone Tracking System - Add Gemstone";
		$this->load->view('gemstone/addgems',$data);
	}
    
    function savegems()
	{

            $supplier = explode("_",$this->input->post('supplierid'));
            $supplier_id = $supplier[0];
            $supplier_barcode = $supplier[1];
            
			if ($this->input->post('lot')!="") $lot= str_pad($this->input->post('lot'), 3, "0", STR_PAD_LEFT);
            else $lot= $this->input->post('lot');

            $type = explode("_",$this->input->post('typeid'));
            $type_id = $type[0];
            $type_barcode = $type[1];
            
            if ($this->input->post('color')>0) {
                $color= number_format($this->input->post('color'),1);
            }else{
                $color="";   
            }
            $color_barcode= str_replace(".", "", $color);
            
            /*
            $sizeout = explode("_",$this->input->post('sizeout'));
            $sizeout_id = $sizeout[0];
            $sizeout_barcode = $sizeout[1];
			*/
            $sizeout_id = $this->input->post('sizeout');
            $sizeout_barcode = $sizeout_id;
        
            $current= explode('/',date("d/m/y"));
            $current= $current[0].$current[1].$current[2];
        
            $amount = $this->input->post('amount');
            $carat = $this->input->post('carat');
            $sizein = $this->input->post('sizein');
		    
            $barcode = $supplier_barcode . $lot . $type_barcode . $color_barcode . $sizeout_barcode . $current;
                
            $datetime = date('Y-m-d H:i:s');
            $start = date('Y-m-01');
            $end = date('Y-m-31');
            
        // Get last number for increment = new number
            $no = 0;
            $last_number = 0;
            //$temp = $this->gemstone_model->getNumber($supplier_id, $lot);
            
            $temp = $this->gemstone_model->getNumber_month($start, $end, $type_id);
            foreach ($temp as $loop) {
                $last_number = $loop->_count;
                $no = $loop->_sum;
            }
        
            $new_number = str_pad((++$last_number), 3, "0", STR_PAD_LEFT);
        
            $barcode = $barcode . $new_number;
        
            $process_type = $this->input->post('process_id');
            $process_detail = $this->input->post('process_detail');
        
        // lot from supplier , number from counting
            $gemstone = array(
				'supplier' => $supplier_id,
				'lot' => $lot,
                'number' => $new_number,
				'type' => $type_id,
				'color' => $color,
                'carat' => $carat,
                'amount' => $amount,
                'size_in' => $sizein,
				'size_out' => $sizeout_id,
				'dateadd' => $datetime,
                'barcode' => $barcode,
                'process_type' => $process_type,
                'process_detail' => $process_detail
                
			);
            
            $result = $this->gemstone_model->addGemstone($gemstone);
            $gemid = $this->db->insert_id();
            
        
            // add all barcode of gemtone parcel
            $no++;
            $i = 0;
            while ($amount>0) {
                $barcode_array[$i] = array(
                    'gemstone_id' => $gemid,
                    'no' => $no
                );
                //$this->gemstone_model->addGemstone_barcode($barcode_array);
                $amount--;
                $no++;
                $i++;
            }
        
            $this->gemstone_model->addGemstone_barcode_array($barcode_array);
        
            if ($result){
                redirect('gemstone/viewbarcode/'.$gemid);
            }else{
                $this->session->set_flashdata('showresult', 'fail');
            }

		
            $this->load->model('supplier','',TRUE);
            $query = $this->supplier->getSupplier();
            if($query){
                $data['supplier_array'] =  $query;
            }else{
                $data['supplier_array'] = array();
            }

            //$this->load->model('gemstone_model','',TRUE);
            $query = $this->gemstone_model->getGemstoneType();
            if($query){
                $data['type_array'] =  $query;
            }else{
                $data['type_array'] = array();
            }

            $query = $this->gemstone_model->getGemstoneSize();
            if($query){
                $data['size_array'] =  $query;
            }else{
                $data['size_array'] = array();
            }

            $data['title'] = "Cien|Gemstone Tracking System - Add Gemstone";
            redirect('gemstone/addgems', 'refresh');


	}
    
    function viewbarcode() {
        $id = $this->uri->segment(3);
        $query = $this->gemstone_model->getGemstone($id);
        if($query){
			$data['barcode_array'] =  $query;
		}else{
			$data['barcode_array'] = array();
		}
        
        $query = $this->gemstone_model->getNumberRange($id);
        foreach ($query as $loop) { $data['minno'] = $loop->_min; $data['maxno'] = $loop->_max; }
        $data['gid'] = $id;
        $data['title'] = "Cien|Gemstone Tracking System - Print Barcode";
		$this->load->view('gemstone/showbarcode',$data);
    }

	
	function barcode_validate($barcode)
    {
        $this->db->where('barcode', $barcode);
        $query = $this->db->get('gemstone');
        return $query->num_rows();
    }
	
    function printbarcode() 
    {
        $id = $this->uri->segment(3);
        $label = $this->uri->segment(4);
		
		$this->load->library('mpdf/mpdf');                
        $mpdf = new mPDF('th','A6','','' , 1 , 0 , 3 , 0 , 0 , 0); 
		$stylesheet = file_get_contents('application/libraries/mpdf/css/stylebarcode.css');

		$query = $this->gemstone_model->getAllBarcode($id);
        if($query){
			$data['barcode_array'] =  $query;
		}else{
			$data['barcode_array'] = array();
		}
        
        $data['label'] = $label;
        
		//echo $html;
        $mpdf->SetJS('this.print();');
		//$mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($this->load->view("gemstone/printbarcode", $data, TRUE));
        $mpdf->Output();
    }
    
    function printbarcode_range() 
    {
        $gemid = $this->input->post('gemid');
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $data['label'] = $this->input->post('label');
		
		$this->load->library('mpdf/mpdf');                
        $mpdf = new mPDF('th','A6','','' , 1 , 0 , 3 , 0 , 0 , 0); 
		$stylesheet = file_get_contents('application/libraries/mpdf/css/stylebarcode.css');

		$query = $this->gemstone_model->getRangeBarcode($gemid,$start,$end);
        if($query){
			$data['barcode_array'] =  $query;
		}else{
			$data['barcode_array'] = array();
		}
        
		//echo $html;
        $mpdf->SetJS('this.print();');
		//$mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($this->load->view("gemstone/printbarcode", $data, TRUE));
        $mpdf->Output();
    } 
    
    function printbarcode_one() 
    {
        $barcodeid = $this->uri->segment(3);
        $data['label'] = $this->uri->segment(4);
		
		$this->load->library('mpdf/mpdf');                
        $mpdf = new mPDF('th','A6','','' , 1 , 0 , 3 , 0 , 0 , 0); 
		$stylesheet = file_get_contents('application/libraries/mpdf/css/stylebarcode.css');

		$query = $this->gemstone_model->getBarcode($barcodeid);
        if($query){
			$data['barcode_array'] =  $query;
		}else{
			$data['barcode_array'] = array();
		}
        
		//echo $html;
        $mpdf->SetJS('this.print();');
		//$mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($this->load->view("gemstone/printbarcode", $data, TRUE));
        $mpdf->Output();
    } 
    
    function sendbackgems()
    {
        $data['title'] = "Cien|Gemstone Tracking System - Task List";
		$this->load->view('gemstone/sendbackgems',$data);
    }
    
	function sendgems()
	{   
		$data['title'] = "Cien|Gemstone Tracking System - Task List";
		$this->load->view('gemstone/sendgems',$data);
	}

    function sendgems_task_temp()
	{
		$this->form_validation->set_rules('barcode', 'barcode', 'trim|xss_clean|required');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
        
        $status = $this->uri->segment(3);
		
		if($this->form_validation->run() == TRUE) {
			
			$barcodeid= ($this->input->post('barcode'));
            $barcodeid = ltrim($barcodeid, '0');
            $workerid= ($this->input->post('workerid'));
            
            if ($barcodeid =="*OK*") {
                if ($workerid > 0) {
                    return $this->saveTemptoTask(); 
                }else{
                    $this->session->set_flashdata('showresult', 'fail3');
                    redirect(current_url());
                }
                
            }else if ($barcodeid =="*RESET*") {
                return $this->cleartemp();
            }

			$row = $this->gemstone_model->checkBarcode($barcodeid);
            $query = $this->gemstone_model->getBarcode($barcodeid);
            $center = $this->gemstone_model->checkBarcode_center($barcodeid);
            $insystem = $this->gemstone_model->checkBarcode_out($barcodeid);
            $nogood = $this->gemstone_model->checkBarcode_nogood($barcodeid);
            /*
            foreach ($query as $loop) {
                $barcode = $loop->gemsbarcode;
            }
            */
            
            $row_temp = $this->gemstone_model->checkBarcode_Temp($barcodeid, $status);
            
            $this->load->model('worker_model','',TRUE);
            $row_worker = $this->worker_model->checkBarcode_Worker($barcodeid);
            if ($row_worker>0) {
                $result = $this->worker_model->getWorker($barcodeid);
                foreach ($result as $loop)
                {
                    $workerid = $loop->id;
                }
                $worker_array = array(
                        'worker' => $workerid,
                        'status' => $status,
                        'userid' => $this->session->userdata('sessid')
                    );
                //$data['getall'] = 1;
                $result2 = $this->gemstone_model->editTaskWorkerTemp($worker_array);
                redirect(current_url());
            }
            
            //$row_temp = 0;
			if ($row>0)	{
                if ($row_temp>0) { 
                    $this->session->set_flashdata('showresult', 'fail2');
                    redirect(current_url());
                }else{
                    if ($center ==0) {
                        if ($insystem >0) {
                            if (($status==0)&&($nogood==0)) { 
                                $this->session->set_flashdata('showresult', 'fail6');
                                redirect(current_url());
                            }else{
                                // check previous task
                                $this->load->model('config_model','',TRUE);
                                $query = $this->config_model->getConfig('LOCK_SEQ_TASK');
                                foreach($query as $loop) { $config_value = $loop->value; }

                                if ($config_value==1) {
                                    $pretask = $this->gemstone_model->checkPreTask_status($barcodeid, $status);
                                }else{
                                    $pretask = 1;   
                                }

                                if ($pretask>0) {
                                    // get max tempid and increment for new tempid
                                    $result = $this->gemstone_model->getTempID();
                                    foreach ($result as $loop)
                                    {
                                        $tempid = $loop->tempid;
                                    }
                                    $tempid++;

                                    $datetime = date('Y-m-d H:i:s');

                                    $barcode = array(
                                        'barcode' => $barcodeid,
                                        'tempid' => $tempid,
                                        'status' => $status,
                                        'dateadd' => $datetime,
                                        'worker' => $workerid,
                                        'userid' => $this->session->userdata('sessid')
                                    );
                                    $result2 = $this->gemstone_model->addBarcodeTemp($barcode);
                                    redirect(current_url());
                                }else{
                                    $this->session->set_flashdata('showresult', 'fail_seq'.$status);
                                    redirect(current_url());
                                }
                            }
                        }else{
                            $this->session->set_flashdata('showresult', 'fail5');
                            redirect(current_url());
                        }
                    }else{
                        $this->session->set_flashdata('showresult', 'fail4');
                        redirect(current_url());
                    }
                }
			}else{
				$this->session->set_flashdata('showresult', 'fail1');
				redirect(current_url());
			}
		}
		
		$data['count'] = $this->gemstone_model->getTempCount($status,$this->session->userdata('sessid'));
		$query = $this->gemstone_model->getTaskTemp($status,$this->session->userdata('sessid'));
		if($query){
			$data['temp_array'] =  $query;
		}else{
			$data['temp_array'] = array();
		}
        $query = $this->gemstone_model->getWorkerTemp($status,$this->session->userdata('sessid'));
		if($query){
			$data['worker_array'] =  $query;
		}else{
			$data['worker_array'] = array();
		}
		$data['title'] = "Cien|Gemstone Tracking System - Scan Barcode";
        $data['taskid'] = $status;
        $data['getall'] = 0;
		$this->load->view("gemstone/sendgems_task_temp", $data);
	}
    
    function sendgems_task_temp_shlek()
    {
        $status = $this->uri->segment(3);
        $workerid = $this->uri->segment(4);
        
        $query = $this->gemstone_model->getTaskTemp($status,$this->session->userdata('sessid'));
        $gemid=0;
        $i = 0;
        foreach ($query as $loop) {
            $i++;
            if ($i>1) break;
            $gemid = $loop->gemid;
            $barcodeid = $loop->tbarcode;
            
        }
        
        
        if (($gemid >0)&&($i < 2)) {
            $task4 = 0;
            $query2 = $this->gemstone_model->checkTask_status($barcodeid);
            foreach ($query2 as $loopstatus) {
                $task4 = $loopstatus->task4;
            }
            
            if (($task4 ==0) || ($task4 == 2)) {
                $all = $this->gemstone_model->getAllBarcode($gemid);

                foreach ($all as $loopall) {
                    if ($loopall->gemid==$barcodeid) continue;
                    $result = $this->gemstone_model->getTempID();
                    foreach ($result as $loop)
                    {
                        $tempid = $loop->tempid;
                    }
                        $tempid++;

                        $datetime = date('Y-m-d H:i:s');

                        $barcode = array(
                            'barcode' => $loopall->gemid,
                            'tempid' => $tempid,
                            'status' => $status,
                            'dateadd' => $datetime,
                            'worker' => $workerid,
                            'userid' => $this->session->userdata('sessid')
                        );
                    $result2 = $this->gemstone_model->addBarcodeTemp($barcode);
                }
            }
            //redirect(current_url());
        }
        
        $data['count'] = $this->gemstone_model->getTempCount($status,$this->session->userdata('sessid'));
		$query = $this->gemstone_model->getTaskTemp($status,$this->session->userdata('sessid'));
		if($query){
			$data['temp_array'] =  $query;
		}else{
			$data['temp_array'] = array();
		}
        $query = $this->gemstone_model->getWorkerTemp($status,$this->session->userdata('sessid'));
		if($query){
			$data['worker_array'] =  $query;
		}else{
			$data['worker_array'] = array();
		}
		$data['title'] = "Cien|Gemstone Tracking System - Scan Barcode";
        $data['taskid'] = $status;
        $data['getall'] = 1;
		$this->load->view("gemstone/sendgems_task_temp", $data);
        
    }
    
    function showtemptotask()
    {
        $data['title'] = "Cien|Gemstone Tracking System - Add Receiver";
		$this->load->view("gemstone/sendgems_task_worker", $data);
    }
    
    function deletetemp_task()
	{
		$id = $this->uri->segment(3);
        $taskid = $this->uri->segment(4);
		$result = $this->gemstone_model->delTaskTemp($id);
		redirect('gemstone/sendgems_task_temp/'.$taskid, 'refresh');
	}
    
    function cleartemp()
	{
		$taskid = $this->uri->segment(3);
		$result = $this->gemstone_model->delAllTaskTemp($taskid,$this->session->userdata('sessid'));
		redirect('gemstone/sendgems_task_temp/'.$taskid, 'refresh');
	}
    
    function saveTemptoTask()
    {
        $taskid = $this->uri->segment(3);
        $query = $this->gemstone_model->getTaskTemp($taskid,$this->session->userdata('sessid'));
        
        $count = $this->gemstone_model->getTempCount($taskid,$this->session->userdata('sessid'));
        $this->gemstone_model->delAllTaskTemp($taskid,$this->session->userdata('sessid'));
        $i=0;
        $barcode = array();
        $editbarcode = array();
        foreach ($query as $row) {
            if ($i>$count) break;
            
            $barcode[$i] = array(
                        'barcode' => $row->tbarcode,
                        'status' => $row->status,
                        'dateadd' => $row->tdateadd,
                        'worker' => $row->worker,
                        'userid' => $row->tuserid
                );
            
            // edit gemstone_barcode
            if ($row->status <=10) $col = 'task'.$row->status;
            else if ($row->status == 12) $col = 'qc1';
            else if ($row->status == 13) $col = 'qc2';
            if ($row->gempass==4) {
                if ($row->status>0) {
                    $editbarcode[$i] = array(
                            'id' => $row->tbarcode,
                            'pass' => 0,
                            $col => 1
                    );
                }else{
                    $editbarcode[$i] = array(
                            'id' => $row->tbarcode,
                            'pass' => 0
                    );
                }
            }else{
                $editbarcode[$i] = array(
                            'id' => $row->tbarcode,
                            $col => 1
                    );
            }
            
            $i++;
            //$result2 = $this->gemstone_model->addBarcodeTask($barcode, $editbarcode);
            
            
        }
        $this->gemstone_model->addBarcodeTask($barcode, $editbarcode);
        
        $this->session->set_flashdata('showresult', 'success');
        
        $data['title'] = "Cien|Gemstone Tracking System - Task List";
		redirect('gemstone/sendbackgems','refresh');
    }
    
    function backgems()
	{   
		$data['title'] = "Cien|Gemstone Tracking System - Task List";
		$this->load->view('gemstone/backgems',$data);
	}

    function sendgems_back_temp()
	{
		$this->form_validation->set_rules('barcode', 'barcode', 'trim|xss_clean|required');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
        
        $status = $this->uri->segment(3);
        if ($status !=10) { 
            $status = 0;
        }else{
            $data['taskid'] = $status;   
        }
		
		if($this->form_validation->run() == TRUE) {
			
			$barcodeid= ($this->input->post('barcode'));
            $barcodeid = ltrim($barcodeid, '0');
            $workerid= ($this->input->post('workerid'));
            
            if ($barcodeid =="*OK*") {
                if ($workerid > 0) {
                    return $this->saveTemptoBack();
                }else{
                    $this->session->set_flashdata('showresult', 'fail3');
                    redirect(current_url());
                }
                
            }else if ($barcodeid =="*RESET*") {
                return $this->cleartemp_back();
            }

			$row = $this->gemstone_model->checkBarcode($barcodeid);
            $row_temp = $this->gemstone_model->checkBarcode_Temp_back($barcodeid, $status);
            $center = $this->gemstone_model->checkBarcode_center($barcodeid);
            
            $query = $this->gemstone_model->checkTask_status($barcodeid);
            
            foreach ($query as $loop) {
                if ($loop->task3 == 1) $status = 3;
                else if ($loop->task4 == 1) $status = 4;
                else if ($loop->task5 == 1) $status = 5;
                else if ($loop->task6 == 1) $status = 6;
                else if ($loop->task7 == 1) $status = 7;
                else if ($loop->task8 == 1) $status = 8;
                else if ($loop->task9 == 1) $status = 9;
                else if ($loop->task10 == 1) $status = 10;
                else if ($loop->qc1 == 1) $status = 12;
                else if ($loop->qc2 == 1) $status = 13;
            }
            
            $this->load->model('worker_model','',TRUE);
            $row_worker = $this->worker_model->checkBarcode_Worker($barcodeid);
            if ($row_worker>0) {
                $result = $this->worker_model->getWorker($barcodeid);
                foreach ($result as $loop)
                {
                    $workerid = $loop->id;
                }
                $worker_array = array(
                        'worker' => $workerid,
                        //'status' => $status,
                        'userid' => $this->session->userdata('sessid')
                    );
                $result2 = $this->gemstone_model->editBackWorkerTemp($worker_array);
                redirect(current_url());
            }
            
            //$row_temp = 0;
			if ($row>0)	{
                if ($row_temp>0) { 
                    $this->session->set_flashdata('showresult', 'fail2');
                    redirect(current_url());
                }else{
                    if (($center > 0)&&($status>0)) {
                        // get max tempid and increment for new tempid
                        $result = $this->gemstone_model->getTempID_back();
                        foreach ($result as $loop)
                        {
                            $tempid = $loop->tempid;
                        }
                        $tempid++;

                        $datetime = date('Y-m-d H:i:s');

                        $barcode = array(
                            'barcode' => $barcodeid,
                            'tempid' => $tempid,
                            'status' => $status,
                            'dateadd' => $datetime,
                            'worker' => $workerid,
                            'userid' => $this->session->userdata('sessid')
                        );
                        $result2 = $this->gemstone_model->addBarcodeTemp_back($barcode);
                        redirect(current_url());
                    }else{
                        $this->session->set_flashdata('showresult', 'fail4');
                        redirect(current_url());
                    }
                }
			}else{
				$this->session->set_flashdata('showresult', 'fail1');
				redirect(current_url());
			}
		}
		
		$data['count'] = $this->gemstone_model->getTempCount_back($status,$this->session->userdata('sessid'));
		$query = $this->gemstone_model->getBackTemp($status,$this->session->userdata('sessid'));
		if($query){
			$data['temp_array'] =  $query;
		}else{
			$data['temp_array'] = array();
		}
        $query = $this->gemstone_model->getWorkerTemp_back($status,$this->session->userdata('sessid'));
		if($query){
			$data['worker_array'] =  $query;
		}else{
			$data['worker_array'] = array();
		}
		$data['title'] = "Cien|Gemstone Tracking System - Scan Barcode";
        $data['taskid'] = $status;
        $data['getall'] = 0;
		$this->load->view("gemstone/sendgems_back_temp", $data);
	}
    
    function sendgems_back_temp_shlek()
    {
        $status = 4;
        $workerid = $this->uri->segment(3);
        
        $query = $this->gemstone_model->getBackTemp($status,$this->session->userdata('sessid'));
        $gemid=0;
        $i = 0;
        foreach ($query as $loop) {
            $i++;
            if ($i>1) break;
            $gemid = $loop->gemid;
            $barcodeid = $loop->tbarcode;
            
        }
        
        
        if (($gemid >0)&&($i < 2)) {
            $task4 = 0;
            $query2 = $this->gemstone_model->checkTask_status($barcodeid);
            foreach ($query2 as $loopstatus) {
                $task4 = $loopstatus->task4;
                
                $pass = $loopstatus->pass;
            }
            
            if (($task4 ==1) && ($pass!=1) && ($pass!=2)) {
                $all = $this->gemstone_model->getAllBarcode($gemid);

                foreach ($all as $loopall) {
                    if ($loopall->gemid==$barcodeid) continue;
                    $result = $this->gemstone_model->getTempID_back();
                    foreach ($result as $loop)
                    {
                        $tempid = $loop->tempid;
                    }
                        $tempid++;

                        $datetime = date('Y-m-d H:i:s');

                        $barcode = array(
                            'barcode' => $loopall->gemid,
                            'tempid' => $tempid,
                            'status' => $status,
                            'dateadd' => $datetime,
                            'worker' => $workerid,
                            'userid' => $this->session->userdata('sessid')
                        );
                        $result2 = $this->gemstone_model->addBarcodeTemp_back($barcode);
                }
            }
            //redirect(current_url());
        }
        
        $data['count'] = $this->gemstone_model->getTempCount_back($status,$this->session->userdata('sessid'));
		$query = $this->gemstone_model->getBackTemp($status,$this->session->userdata('sessid'));
		if($query){
			$data['temp_array'] =  $query;
		}else{
			$data['temp_array'] = array();
		}
        $query = $this->gemstone_model->getWorkerTemp_back($status,$this->session->userdata('sessid'));
		if($query){
			$data['worker_array'] =  $query;
		}else{
			$data['worker_array'] = array();
		}
		$data['title'] = "Cien|Gemstone Tracking System - Scan Barcode";
        $data['taskid'] = $status;
        $data['getall'] = 1;
		$this->load->view("gemstone/sendgems_back_temp", $data);
        
        
    }
    
    function showtemptoback()
    {
        $data['title'] = "Cien|Gemstone Tracking System - Add Receiver";
		$this->load->view("gemstone/sendgems_back_worker", $data);
    }
    
    function deletetemp_back()
	{
		$id = $this->uri->segment(3);
        $taskid = $this->uri->segment(4);
		$result = $this->gemstone_model->delBackTemp($id);
		redirect('gemstone/sendgems_back_temp/'.$taskid, 'refresh');
	}
    
    function cleartemp_back()
	{
		$taskid = $this->uri->segment(3);
		$result = $this->gemstone_model->delAllBackTemp($taskid,$this->session->userdata('sessid'));
		redirect('gemstone/sendgems_back_temp/'.$taskid, 'refresh');
	}
    
    function saveTemptoBack()
    {
        $taskid = $this->uri->segment(3);
        $query = $this->gemstone_model->getBackTemp($taskid,$this->session->userdata('sessid'));
        
        $count = $this->gemstone_model->getTempCount_back($taskid,$this->session->userdata('sessid'));
        $this->gemstone_model->delAllBackTemp($taskid,$this->session->userdata('sessid'));
        $i=0;
        $barcode = array();
        $editbarcode = array();
        foreach ($query as $row) {
            $barcode[$i] = array(
                        'barcode' => $row->tbarcode,
                        'status' => $row->status,
                        'dateadd' => $row->tdateadd,
                        'worker' => $row->worker,
                        'userid' => $row->tuserid
                );
            
            // edit gemstone_barcode
            if ($row->status <=10) $col = 'task'.$row->status;
            else if ($row->status == 12) $col = 'qc1';
            else if ($row->status == 13) $col = 'qc2';
            $editbarcode[$i] = array(
                        'id' => $row->tbarcode,
                        $col => 2
                );
            $i++;
            //$result2 = $this->gemstone_model->addBarcodeBack($barcode, $editbarcode);
        }
        //$this->gemstone_model->delAllBackTemp($taskid,$this->session->userdata('sessid'));
        $result2 = $this->gemstone_model->addBarcodeBack($barcode, $editbarcode);
        
        $this->session->set_flashdata('showresult', 'success');
        
        $data['title'] = "Cien|Gemstone Tracking System - Task List";
		redirect('gemstone/sendbackgems','refresh');
    }
    
    function showgems()
    {
        $query = $this->gemstone_model->getAllGemstone();
		if($query){
			$data['gem_array'] =  $query;
		}else{
			$data['gem_array'] = array();
		}
        
        $data['title'] = "Cien|Gemstone Tracking System - Show Gems";
		$this->load->view('gemstone/showgems',$data);
    }
    
    function deletegem()
	{
		$id = $this->uri->segment(3);

		$result = $this->gemstone_model->delGem($id);
		redirect('gemstone/showgems', 'refresh');
	}
    
    function viewtask()
    {
        $id = $this->uri->segment(3);
        
        $query = $this->gemstone_model->getProgress($id);
		if($query){
			$data['progress_array'] =  $query;
		}else{
			$data['progress_array'] = array();
		}
        
        $query = $this->gemstone_model->getGemstone($id);
		if($query){
			$data['gem_array'] =  $query;
		}else{
			$data['gem_array'] = array();
		}
        
        $data['title'] = "Cien|Gemstone Tracking System - Show Tasks";
		$this->load->view('gemstone/showtask',$data);
    }

    function viewtask_number()
    {
        $id = $this->uri->segment(3);
        $task = $this->uri->segment(4);
        
        $query = $this->gemstone_model->getProgress_task($id,$task);
		if($query){
			$data['task_array'] =  $query;
		}else{
			$data['task_array'] = array();
		}
        $query = $this->gemstone_model->getProgress_back($id,$task);
		if($query){
			$data['back_array'] =  $query;
		}else{
			$data['back_array'] = array();
		}
        
        $data['title'] = "Cien|Gemstone Tracking System - Show Tasks";
		$this->load->view('gemstone/showtask_number',$data);
    }
    
    function viewqc_number()
    {
        $id = $this->uri->segment(3);
        
        $query = $this->gemstone_model->getQC_detail($id);
		if($query){
			$data['task_array'] =  $query;
		}else{
			$data['task_array'] = array();
		}
        
        $data['title'] = "Cien|Gemstone Tracking System - Show QC";
		$this->load->view('gemstone/showqc_number',$data);
    }
    
    function getBarcode_no()
    {
        $no=$this->input->post('no');
        $gemstone_id=$this->input->post('gemstone_id');
        
    }
    
    function qcgems()
    {
        $data['title'] = "Cien|Gemstone Tracking System - QC";
		$this->load->view("gemstone/qcgems", $data);  
    }
    
    function qctemp()
    {
        $this->form_validation->set_rules('barcode', 'barcode', 'trim|xss_clean|required');
		$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
		$this->form_validation->set_error_delimiters('<code>', '</code>');
        
        $status = $this->uri->segment(3);
		
		if($this->form_validation->run() == TRUE) {
			
			$barcodeid= ($this->input->post('barcode'));
            $barcodeid = ltrim($barcodeid, '0');
            
            if ($barcodeid =="*OK*") {
                return $this->saveTemptoQC(); 
                
            }else if ($barcodeid =="*RESET*") {
                return $this->cleartemp_qc();
            }

			$row = $this->gemstone_model->checkBarcode($barcodeid);
            $query = $this->gemstone_model->getBarcode($barcodeid);
            foreach ($query as $loop) {
                $barcode = $loop->gemsbarcode;
            }
            
            $row_temp = $this->gemstone_model->checkBarcode_Temp_QC($barcodeid, $status);
            
            //$row_temp = 0;
			if ($row>0)	{
                if ($row_temp>0) { 
                    $this->session->set_flashdata('showresult', 'fail2');
                    redirect(current_url());
                }else{
                    // get max tempid and increment for new tempid
                    $result = $this->gemstone_model->getTempID_QC();
                    foreach ($result as $loop)
                    {
                        $tempid = $loop->tempid;
                    }
                    $tempid++;

                    $datetime = date('Y-m-d H:i:s');

                    $barcode = array(
                        'barcode' => $barcodeid,
                        'tempid' => $tempid,
                        'status' => $status,
                        'dateadd' => $datetime,
                        'userid' => $this->session->userdata('sessid')
                    );
                    $result2 = $this->gemstone_model->addBarcodeTemp_QC($barcode);
                    redirect(current_url());
                }
			}else{
				$this->session->set_flashdata('showresult', 'fail1');
				redirect(current_url());
			}
		}
		
		$data['count'] = $this->gemstone_model->getTempCount_QC($status,$this->session->userdata('sessid'));
		$query = $this->gemstone_model->getQCTemp($status,$this->session->userdata('sessid'));
		if($query){
			$data['temp_array'] =  $query;
		}else{
			$data['temp_array'] = array();
		}
        $query = $this->gemstone_model->getGemstoneError();
		if($query){
			$data['error_array'] =  $query;
		}else{
			$data['error_array'] = array();
		}
		$data['title'] = "Cien|Gemstone Tracking System - Scan Barcode";
        $data['taskid'] = $status;
		$this->load->view("gemstone/qctemp", $data);
    }
    
    function deletetemp_qc()
	{
		$id = $this->uri->segment(3);
        $taskid = $this->uri->segment(4);
		$result = $this->gemstone_model->delQCTemp($id);
		redirect('gemstone/qctemp/'.$taskid, 'refresh');
	}
    
    function cleartemp_qc()
	{
		$taskid = $this->uri->segment(3);
		$result = $this->gemstone_model->delAllQCTemp($taskid,$this->session->userdata('sessid'));
		redirect('gemstone/qctemp/'.$taskid, 'refresh');
	}
    
    function saveTemptoQC()
    {
        $taskid = $this->uri->segment(3);
        $detail = $this->input->post('error')." ".$this->input->post('detail');
        $query = $this->gemstone_model->getQCTemp($taskid,$this->session->userdata('sessid'));
        foreach ($query as $row) {
            $barcode = array(
                        'barcode' => $row->tbarcode,
                        'status' => $row->status,
                        'dateadd' => $row->tdateadd,
                        'userid' => $row->tuserid,
                        'detail' => $detail
                );
            // edit gemstone_barcode
            $editbarcode = array(
                        'id' => $row->tbarcode,
                        'pass' => $row->status
                );
                
            $result2 = $this->gemstone_model->addBarcodeQC($barcode, $editbarcode);
        }
        
        $this->gemstone_model->delAllQCTemp($taskid,$this->session->userdata('sessid'));
        
        $this->session->set_flashdata('showresult', 'success');
        
        $data['title'] = "Cien|Gemstone Tracking System - QC";
		redirect('gemstone/qcgems','refresh');
    }
    
    function deleteParcel()
    {
        $id = $this->uri->segment(3);

		$result = $this->gemstone_model->delParcel($id);
		redirect('gemstone/addgems', 'refresh');
    }
    
    function showparcel()
    {
        $query = $this->gemstone_model->getAllParcel();
		if($query){
			$data['parcel_array'] =  $query;
		}else{
			$data['parcel_array'] = array();
		}
        
        $data['title'] = "Cien|Gemstone Tracking System - Show Parcel";
		$this->load->view('gemstone/showparcel',$data);
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
		$this->load->view('gemstone/showdetail_parcel',$data);
    }
    
    function showdetail_gem()
    {
        $id = $this->uri->segment(3);
        
        $this->load->helper('new_helper');
        
        $query = $this->gemstone_model->getBarcode($id);
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
		$this->load->view('gemstone/showdetail_parcel',$data);
    }
    
    function ajaxGetAllBarcode()
	{
        $this->load->library('Datatables');
		$this->datatables
		->select("gemstone_barcode.id as barcodeid,CONCAT(supplier.name,lot,'-',number,'#',no) as detail,gemstone_type.name as gemtype, gemstone.dateadd as gemdate, gemstone_barcode.id as bid", FALSE)
		->from('gemstone_barcode')
        ->join('gemstone', 'gemstone.id = gemstone_barcode.gemstone_id', 'left')
        ->join('supplier', 'gemstone.supplier=supplier.id','left')
        ->join('gemstone_type', 'gemstone_type.id=gemstone.type','left')
        ->where('disable',0)
		//->edit_column("pid","$1","pid");
		
		->edit_column("bid",'<div class="tooltip-demo">
	<a href="'.site_url("gemstone/showdetail_barcode/$1").'" class="btn btn-success btn-xs" data-title="View" data-toggle="tooltip" data-target="#view" data-placement="top" rel="tooltip" title="ดูรายละเอียด"><span class="glyphicon glyphicon-fullscreen"></span></a>
	<a href="'.site_url("gemstone/printbarcode_one/$1").'" class="btn btn-primary btn-xs" data-title="Edit" data-toggle="tooltip" data-target="#edit" data-placement="top" rel="tooltip" title="Print"><span class="glyphicon glyphicon-print"></span></a>
	</div>',"bid");

        
		echo $this->datatables->generate(); 
	}
    
    function showdetail_barcode()
    {
        $id = $this->uri->segment(3);
        
        $this->load->helper('new_helper');
        
        $query = $this->gemstone_model->getBarcode($id);
		if($query){
			$data['gem_array'] =  $query;
		}else{
			$data['gem_array'] = array();
		}
        
        foreach($query as $loop) {
            $gemid = $loop->parcel;
        }
        
        $query = $this->gemstone_model->getGemstone($gemid);
        if($query){
			$data['barcode_array'] =  $query;
		}else{
			$data['barcode_array'] = array();
		}
        
        $query = $this->gemstone_model->getNumberRange($gemid);
        foreach ($query as $loop) { $data['minno'] = $loop->_min; $data['maxno'] = $loop->_max; }
        $data['gid'] = $gemid;
        $data['barcode'] = $id;
        
        $data['title'] = "Cien|Gemstone Tracking System - Show Barcode Detail";
		$this->load->view('gemstone/showdetail_barcode',$data);
    }
    
    function addNewProcesstype()
    {
        $name = $this->input->post('process');
        //return false;
        $count = $this->gemstone_model->checkProcessName($name);
        //return false;
        if ($count<=0) {
            $process = array('name' => $name);
            $query = $this->gemstone_model->addProcess($process);
            echo 1;
        }else{
            echo 0;
        }
    }
}