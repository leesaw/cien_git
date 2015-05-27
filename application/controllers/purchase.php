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
		$this->load->view('purchase/addgems',$data);
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
        
            $current= explode('/',date("d/m/Y"));
            //$current= $current[0].$current[1].$current[2];
            $year_barcode = $current[2];
            $month_barcode = $current[1];
        
            $amount = $this->input->post('amount');
            $carat = $this->input->post('carat');
            $sizein = $this->input->post('sizein');
                
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
            $new_number_barcode = str_pad(($last_number), 5, "0", STR_PAD_LEFT);
        
            //$barcode = $barcode . $new_number;
        
            $process_type = $this->input->post('process_id');
            $process_detail = $this->input->post('process_detail');
        
            //$barcode = $supplier_barcode . $lot . $type_barcode . $color_barcode . $sizeout_barcode . $current;
            $barcode = $month_barcode.$year_barcode.$type_barcode.$new_number_barcode;
        
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
            
            /*
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
            */
            if ($result){
                redirect('purchase/print_stone_barcode/'.$gemid);
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
            redirect('purchase/addgems', 'refresh');


	}
    
    function print_stone_barcode() {
        $id = $this->uri->segment(3);
        $query = $this->gemstone_model->getGemstone($id);
        if($query){
			$data['barcode_array'] =  $query;
		}else{
			$data['barcode_array'] = array();
		}
        
        //$query = $this->gemstone_model->getNumberRange($id);
        //foreach ($query as $loop) { $data['minno'] = $loop->_min; $data['maxno'] = $loop->_max; }
        $data['gid'] = $id;
        $data['title'] = "Cien|Gemstone Tracking System - Print Barcode";
		$this->load->view('purchase/showbarcode',$data);
    }
    
    function deleteParcel()
    {
        $id = $this->uri->segment(3);

		$result = $this->gemstone_model->delParcel($id);
		redirect('purchase/addgems', 'refresh');
    }
    
    function printbarcode() 
    {
        $id = $this->uri->segment(3);
        $label = $this->uri->segment(4);
		
		$this->load->library('mpdf/mpdf');                
        $mpdf = new mPDF('th','A4'); 
		$stylesheet = file_get_contents('application/libraries/mpdf/css/style.css');

		$query = $this->gemstone_model->getGemstone($id);
        if($query){
			$data['barcode_array'] =  $query;
		}else{
			$data['barcode_array'] = array();
		}
        
        $data['label'] = $label;
        
		//echo $html;
        $mpdf->SetJS('this.print();');
		//$mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($this->load->view("purchase/printbarcode", $data, TRUE));
        $mpdf->Output();
    }
}