<?php
Class Gemstone_model extends CI_Model
{
 function getGemstoneType()
 {
	$this->db->select("id, name, barcode");
	$this->db->order_by("name", "asc");
	$this->db->from('gemstone_type');	
	$query = $this->db->get();		
	return $query->result();
 }
    
 function getProcessType()
 {
	$this->db->select("id, name");
	$this->db->order_by("name", "asc");
	$this->db->from('process_type');	
	$query = $this->db->get();		
	return $query->result();
 }
    
 function getGemstoneSize()
 {
	$this->db->select("id, name, barcode");
	$this->db->order_by("id", "asc");
	$this->db->from('gemstone_size');	
	$query = $this->db->get();		
	return $query->result();
 }
    
 function getGemstoneError()
 {
	$this->db->select("id, name");
	$this->db->order_by("id", "asc");
	$this->db->from('gemstone_error');	
	$query = $this->db->get();		
	return $query->result();
 }
    
 function addGemstone($gemstone=NULL)
 {		
	$this->db->insert('gemstone', $gemstone);
	return $this->db->insert_id();			
 }
    
 function addGemstone_barcode($gemstone)
 {
    $this->db->insert('gemstone_barcode',$gemstone);
    return $this->db->insert_id();	
 }
    
 function addGemstone_barcode_array($gemstone)
 {
    $this->db->insert_batch('gemstone_barcode',$gemstone);
    return $this->db->insert_id();	
 }
    
 function getAllGemstone()
 {
    $this->db->select("gemstone_barcode.id as barcodeid, gemstone.id as gemid, gemstone.barcode as gembarcode, supplier.name as supname, number, lot, color, gemstone.dateadd as gemdate, gemstone_type.name as gemtype, gemstone.size_out as gemsize, no");
	$this->db->order_by("gemstone.dateadd", "desc");
	$this->db->from('gemstone_barcode');
    $this->db->join('gemstone', 'gemstone.id = gemstone_barcode.gemstone_id', 'left');
    $this->db->join('supplier', 'gemstone.supplier=supplier.id','left');
    $this->db->join('gemstone_type', 'gemstone_type.id=gemstone.type','left');
    //$this->db->join('gemstone_size', 'gemstone_size.id=gemstone.size_out','left');
    $this->db->where('disable',0);
    $query = $this->db->get();		
	return $query->result();
 }
    
 function getAllParcel()
 {
    $this->db->select('gemstone.id as gemid, supplier.name as supname, number, lot, color, gemstone_type.name as gemtype, gemstone.size_out as size_out, size_in, carat, amount, gemstone.dateadd as dateadd, min(no) as _min, max(no) as _max, process_type.name as process_name, process_detail');
    $this->db->from('gemstone');
    $this->db->join('supplier', 'gemstone.supplier=supplier.id','left');
    $this->db->join('gemstone_type', 'gemstone_type.id=gemstone.type','left');
    $this->db->join('gemstone_barcode', 'gemstone_barcode.gemstone_id=gemstone.id', 'left');
    $this->db->join('process_type', 'process_type.id = gemstone.process_type', 'left');
    $this->db->group_by('gemstone.id');
    //$this->db->join('gemstone_size', 'gemstone_size.id=gemstone.size_out','left');
    $this->db->where('disable',0);
    $query = $this->db->get();
	return $query->result();
 }
    
 function getAllParcel_purchase()
 {
    $this->db->select('gemstone.id as gemid, supplier.name as supname, number, lot, color, gemstone_type.name as gemtype, gemstone.size_out as size_out, size_in, carat, amount, gemstone.datepurchase as dateadd, min(no) as _min, max(no) as _max, process_type.name as process_name, process_detail, gemstone.barcode as barcode');
    $this->db->from('gemstone');
    $this->db->join('supplier', 'gemstone.supplier=supplier.id','left');
    $this->db->join('gemstone_type', 'gemstone_type.id=gemstone.type','left');
    $this->db->join('gemstone_barcode', 'gemstone_barcode.gemstone_id=gemstone.id', 'left');
    $this->db->join('process_type', 'process_type.id = gemstone.process_type', 'left');
    $this->db->group_by('gemstone.id');
    //$this->db->join('gemstone_size', 'gemstone_size.id=gemstone.size_out','left');
    $this->db->where('disable',2);
    $query = $this->db->get();
	return $query->result();
 }
    
 function getGemstone($id)
 {
    $this->db->select("gemstone.id as gemid, gemstone.barcode as gembarcode, supplier.name as supname, number, lot, color, gemstone.dateadd as gemdate, gemstone.datepurchase as datepurchase, gemstone_type.name as gemtype, gemstone.size_out as gemsize, size_in, amount, carat, process_type.name as process_name, process_detail");
    $this->db->from("gemstone");
    $this->db->join('supplier', 'gemstone.supplier=supplier.id','left');
    $this->db->join('gemstone_type', 'gemstone_type.id=gemstone.type','left');
    $this->db->join('process_type', 'gemstone.process_type=process_type.id','left');
    $this->db->where("gemstone.id", $id);
    $this->db->where('disable', 0);
    $query = $this->db->get();		
	return $query->result();
 }
    
 function getGemstone_purchase($id)
 {
    $this->db->select("gemstone.id as gemid, gemstone.barcode as gembarcode, supplier.name as supname, number, lot, color, gemstone.dateadd as gemdate, gemstone.datepurchase as datepurchase, gemstone_type.name as gemtype, gemstone.size_out as gemsize, size_in, amount, carat, process_type.name as process_name, process_detail, disable");
    $this->db->from("gemstone");
    $this->db->join('supplier', 'gemstone.supplier=supplier.id','left');
    $this->db->join('gemstone_type', 'gemstone_type.id=gemstone.type','left');
    $this->db->join('process_type', 'gemstone.process_type=process_type.id','left');
    $this->db->where("gemstone.id", $id);
    $this->db->where('disable != ',1);
    $query = $this->db->get();		
	return $query->result();
 }
    
 function getGemstone_frombarcode($barcode)
 {
    $this->db->select("gemstone.id as gemid, gemstone.barcode as gembarcode, supplier.name as supname, number, lot, color, gemstone.dateadd as gemdate, gemstone.datepurchase as datepurchase, gemstone_type.name as gemtype, gemstone.size_out as gemsize, size_in, amount, carat, process_type.name as process_name, process_detail");
    $this->db->from("gemstone");
    $this->db->join('supplier', 'gemstone.supplier=supplier.id','left');
    $this->db->join('gemstone_type', 'gemstone_type.id=gemstone.type','left');
    $this->db->join('process_type', 'gemstone.process_type=process_type.id','left');
    $this->db->where("gemstone.barcode", $barcode);
    $this->db->where('disable != ', 1);
    $query = $this->db->get();		
	return $query->result();
 }
    
 function getBarcode($id)
 {
    //$this->db->select("gemstone_barcode.id as gemid, no, supplier.name as supname, gemstone_type.name as typename, lot, number, gemstone.dateadd as _dateadd, no, task3, task4, task5, task6, task7, task8, task9, task10, qc1, qc2, edit, pass, gemstone_barcode.gemstone_id as parcel");
    $this->db->select('gemstone_barcode.id as gemid, no, supplier.name as supname, gemstone_type.name as typename, lot, number, gemstone.dateadd as _dateadd, no, task3, task4, task5, task6, task7, task8, task9, task10, qc1, qc2, edit, pass, gemstone_barcode.gemstone_id as parcel, process_type.name as process_name, process_detail, gemstone.process_type as ptype, size_out');
    $this->db->from('gemstone_barcode');
    $this->db->join('gemstone','gemstone.id = gemstone_barcode.gemstone_id','left');
    $this->db->join('supplier', 'supplier.id = gemstone.supplier', 'left');
    $this->db->join('gemstone_type', 'gemstone_type.id = gemstone.type', 'left');
    $this->db->join('process_type', 'gemstone.process_type = process_type.id', 'left');
    $this->db->where("gemstone_barcode.id", $id);
    $this->db->where('disable', 0);
    $query = $this->db->get();		
	return $query->result();
 }
    
 function getNumber($supplier, $lot)
 {
    $this->db->select('count(*) as _count, sum(amount) as _sum');
    $this->db->from("gemstone");
    $this->db->where('supplier', $supplier);
    $this->db->where('lot', $lot);
    $this->db->where('disable', 0);
    $query = $this->db->get();		
	return $query->result();
 }
    
 function getNumber_month($start, $end, $typeid)
 {
    $end = $end." 23:59:59";
    $this->db->select('max(number) as _count, sum(amount) as _sum');
    $this->db->from("gemstone");
    $this->db->where('dateadd >=', $start);
    $this->db->where('dateadd <=', $end);
    $this->db->where('type', $typeid);
    $this->db->where('disable != ', 1);
    $query = $this->db->get();		
	return $query->result();
 }
    
 function getNumber_month_purchase($start, $end, $typeid)
 {
    $end = $end." 23:59:59";
    $this->db->select('max(number) as _count, sum(amount) as _sum');
    $this->db->from("gemstone");
    $this->db->where('datepurchase >=', $start);
    $this->db->where('datepurchase <=', $end);
    $this->db->where('type', $typeid);
    $this->db->where('disable != ', 1);
    $query = $this->db->get();		
	return $query->result();
 }
    
 function getNumberRange($gemid)
 {
    $this->db->select('min(no) as _min, max(no) as _max');
    $this->db->from("gemstone_barcode");
    $this->db->where('gemstone_id', $gemid);
    $query = $this->db->get();		
	return $query->result();
 }
    
 function checkBarcode($barcode)
 {
    $this->db->select("gemstone_barcode.id as id");
	$this->db->from('gemstone_barcode');		
    $this->db->join('gemstone','gemstone.id=gemstone_barcode.gemstone_id','left');
	$this->db->where('gemstone_barcode.id', $barcode);
    $this->db->where('disable',0);
	$query = $this->db->get();		
	return $query->num_rows();
 }
    
 function checkBarcode_center($id)
 {
    $this->db->select('id');
    $this->db->from('gemstone_barcode');
    $this->db->where('id', $id);
    $this->db->where("(task3=0 OR task3=2 OR task4=0 OR task4=2 OR task5=0 OR task5=2 OR task6=0 OR task6=2 OR task7=0 OR task7=2 OR task8=0 OR task8=2 OR task9=0 OR task9=2 OR task10=0 OR task10=2 OR qc1=0 OR qc1=2 OR qc2=0 OR qc2=2)", NULL, FALSE);
    $query = $this->db->get();		
	$count_back = $query->num_rows();
    
    $this->db->select('id');
    $this->db->from('gemstone_barcode');
    $this->db->where('id', $id);
    $this->db->where("(task3=1 OR task4=1 OR task5=1 OR task6=1 OR task7=1 OR task8=1 OR task9=1 OR task10=1 OR qc1=1 OR qc2=1)", NULL, FALSE);
    $query = $this->db->get();		
	$count_task = $query->num_rows();
     
    /*
    $this->db->select('id');
    $this->db->from('gemstone_task');
    $this->db->where('barcode', $id);
    $query = $this->db->get();		
	$count_task = $query->num_rows();
     
    $this->db->select('id');
    $this->db->from('gemstone_back');
    $this->db->where('barcode', $id);
    $query = $this->db->get();		
	$count_back = $query->num_rows();
    
    return $count_task-$count_back;
    */
     
    if ($count_task > 0) return 1;
    else if ($count_back > 0) return 0;
     
    
 }
    
 function checkBarcode_out($id)
 {
    $this->db->select('id');
    $this->db->from('gemstone_barcode');
    $this->db->where('id', $id);
    $this->db->where('pass != ',1);
    $this->db->where('pass != ',2);
    $query = $this->db->get();		
	return $query->num_rows();
 }
    
 function checkTask_status($id)
 {
    $this->db->select('task3,task4,task5,task6,task7,task8,task9,task10,qc1,qc2,pass');
    $this->db->from('gemstone_barcode');
    $this->db->where('id', $id);
    $query = $this->db->get();		
	return $query->result();
 }
    
 function checkPreTask_status($barcodeid, $next)
 {
    switch($next) 
    {
        case 5: $column = "(task4 = 2 or pass = 3 or task10 = 2)"; break;
        case 3: $column = "(task5 = 2 or pass = 3 or task10 = 2)"; break;
        case 6: $column = "(task3 = 2 or pass = 3 or task10 = 2)"; break;
        case 12: $column = "(task6 = 2 or pass = 3 or task10 = 2)"; break;
        case 7: $column = "(qc1 = 2 or pass = 3 or task10 = 2)"; break;
        case 8: $column = "(task7 = 2 or pass = 3 or task10 = 2)"; break;
        case 9: $column = "(task8 = 2 or pass = 3 or task10 = 2)"; break;
        case 13: $column = "(task9 = 2 or pass = 3 or task10 = 2)"; break;
        default: $column = "";
    }
     
    $this->db->select("id");
    $this->db->from("gemstone_barcode");
    $this->db->where("id", $barcodeid);
    if ($column!="") $this->db->where($column);
    $query = $this->db->get();		
	return $query->num_rows();
 }
    
 function checkBarcode_Temp($barcode, $status)
 {
    $this->db->select("tempid");
	$this->db->from('gemstone_task_temp');		
	$this->db->where('barcode', $barcode);
    $this->db->where('status', $status);
	$query = $this->db->get();		
	return $query->num_rows();
 }
    
 function checkBarcode_Temp_back($barcode, $status)
 {
    $this->db->select("tempid");
	$this->db->from('gemstone_back_temp');		
	$this->db->where('barcode', $barcode);
    //$this->db->where('status', $status);
	$query = $this->db->get();		
	return $query->num_rows();
 }
    
 function checkBarcode_Temp_QC($barcode, $status)
 {
    $this->db->select("tempid");
	$this->db->from('gemstone_qc_temp');		
	$this->db->where('barcode', $barcode);
    $this->db->where('status', $status);
	$query = $this->db->get();		
	return $query->num_rows();
 }
    
 function checkBarcode_Worker($barcode)
 {
    $this->db->select("id");
	$this->db->from('worker');		
	$this->db->where('worker_id', $barcode);
	$query = $this->db->get();		
	return $query->num_rows();
 }
    
 function getTempID()
 {
	$this->db->select("tempid");
	$this->db->order_by("tempid", "desc");
	$this->db->from('gemstone_task_temp');		
	$this->db->limit(1);
	$query = $this->db->get();		
	return $query->result();
 }
    
 function getTempID_back()
 {
	$this->db->select("tempid");
	$this->db->order_by("tempid", "desc");
	$this->db->from('gemstone_back_temp');		
	$this->db->limit(1);
	$query = $this->db->get();		
	return $query->result();
 }
    
 function getTempID_QC()
 {
	$this->db->select("tempid");
	$this->db->order_by("tempid", "desc");
	$this->db->from('gemstone_qc_temp');		
	$this->db->limit(1);
	$query = $this->db->get();		
	return $query->result();
 }
    
 function addBarcodeTemp($barcode=NULL)
 {
	$this->db->insert('gemstone_task_temp', $barcode);
	return $this->db->insert_id();	
 }

 function addBarcodeTemp_back($barcode=NULL)
 {
	$this->db->insert('gemstone_back_temp', $barcode);
	return $this->db->insert_id();	
 }
    
 function addBarcodeTemp_QC($barcode=NULL)
 {
	$this->db->insert('gemstone_qc_temp', $barcode);
	return $this->db->insert_id();	
 }
    
 function addBarcodeTask($barcode,$edit)
 {
	$this->db->insert_batch('gemstone_task', $barcode);
    //$this->db->insert_id();	
    
    //$this->db->where('id', $edit['id']);
	//unset($edit['id']);
	$query = $this->db->update_batch('gemstone_barcode', $edit, 'id'); 	
	return $query;
 }

 function addBarcodeBack($barcode,$edit)
 {
	$this->db->insert_batch('gemstone_back', $barcode);
	//return $this->db->insert_id();
    //$this->db->where('id', $edit['id']);
	//unset($edit['id']);
	$query = $this->db->update_batch('gemstone_barcode', $edit,'id'); 	
	return $query;
 }
    
 function addBarcodeQC($barcode=NULL,$edit)
 {
	$this->db->insert('gemstone_qc', $barcode);
	//return $this->db->insert_id();	
    $this->db->where('id', $edit['id']);
	unset($edit['id']);
	$query = $this->db->update('gemstone_barcode', $edit); 	
	return $query;
 }
    
 function getTempCount($status=NULL,$userid=null)
 {
	$this->db->select("tempid");
	$this->db->from('gemstone_task_temp');		
	$this->db->where('status', $status);
    $this->db->where('userid',$userid);
	$query = $this->db->get();		
	return $query->num_rows();
 }
    
 function getTempCount_back($status=NULL,$userid=null)
 {
	$this->db->select("tempid");
	$this->db->from('gemstone_back_temp');		
	//$this->db->where('status', $status);
    $this->db->where('userid',$userid);
	$query = $this->db->get();		
	return $query->num_rows();
 }
    
 function getTempCount_QC($status=NULL,$userid=null)
 {
	$this->db->select("tempid");
	$this->db->from('gemstone_qc_temp');		
	$this->db->where('status', $status);
    $this->db->where('userid',$userid);
	$query = $this->db->get();		
	return $query->num_rows();
 }
    
 function getTaskTemp($status=NULL,$userid=null)
 {
	$this->db->select("tempid, gemstone_task_temp.barcode as tbarcode, no, status, gemstone_task_temp.userid as tuserid, worker, gemstone_task_temp.dateadd as tdateadd, supplier.name as supname, gemstone_type.name as typename, lot, number, gemstone.id as gemid");
	$this->db->from('gemstone_task_temp');
    $this->db->join('gemstone_barcode', 'gemstone_barcode.id = gemstone_task_temp.barcode','left');
    $this->db->join('gemstone', 'gemstone.id = gemstone_barcode.gemstone_id','left');
    $this->db->join('supplier', 'gemstone.supplier=supplier.id','left');
    $this->db->join('gemstone_type', 'gemstone_type.id=gemstone.type','left');
	$this->db->where('status', $status);
    $this->db->where('userid',$userid);
	$query = $this->db->get();		
	return $query->result();
 }
    
 function getBackTemp($status=NULL,$userid=null)
 {
	$this->db->select("tempid, gemstone_back_temp.barcode as tbarcode, no, status, gemstone_back_temp.userid as tuserid, worker, gemstone_back_temp.dateadd as tdateadd, supplier.name as supname, gemstone_type.name as typename, lot, number, task4, gemstone.id as gemid");
	$this->db->from('gemstone_back_temp');
    $this->db->join('gemstone_barcode', 'gemstone_barcode.id = gemstone_back_temp.barcode','left');
    $this->db->join('gemstone', 'gemstone.id = gemstone_barcode.gemstone_id','left');
    $this->db->join('supplier', 'gemstone.supplier=supplier.id','left');
    $this->db->join('gemstone_type', 'gemstone_type.id=gemstone.type','left');
	//$this->db->where('status', $status);
    $this->db->where('userid',$userid);
	$query = $this->db->get();		
	return $query->result();
 }
    
 function getQCTemp($status=NULL,$userid=null)
 {
	$this->db->select("tempid, gemstone_qc_temp.barcode as tbarcode, no, status, gemstone_qc_temp.userid as tuserid, gemstone_qc_temp.dateadd as tdateadd, supplier.name as supname, gemstone_type.name as typename, lot, number");
	$this->db->from('gemstone_qc_temp');
    $this->db->join('gemstone_barcode', 'gemstone_barcode.id = gemstone_qc_temp.barcode','left');
    $this->db->join('gemstone', 'gemstone.id = gemstone_barcode.gemstone_id','left');
    $this->db->join('supplier', 'gemstone.supplier=supplier.id','left');
    $this->db->join('gemstone_type', 'gemstone_type.id=gemstone.type','left');
	$this->db->where('status', $status);
    $this->db->where('userid',$userid);
	$query = $this->db->get();		
	return $query->result();
 }
    
 function delTaskTemp($id=NULL)
 {
	$this->db->where('tempid', $id);
	$this->db->delete('gemstone_task_temp'); 
 }
    
 function delAllTaskTemp($status=NULL,$userid=null)
 {
	$this->db->where('status', $status);
    $this->db->where('userid',$userid);
	$this->db->delete('gemstone_task_temp'); 
 }
    
 function delBackTemp($id=NULL)
 {
	$this->db->where('tempid', $id);
	$this->db->delete('gemstone_back_temp'); 
 }
    
 function delAllBackTemp($status=NULL,$userid=null)
 {
	//$this->db->where('status', $status);
    $this->db->where('userid',$userid);
	$this->db->delete('gemstone_back_temp'); 
 }
    
 function delQCTemp($id=NULL)
 {
	$this->db->where('tempid', $id);
	$this->db->delete('gemstone_qc_temp'); 
 }
    
 function delAllQCTemp($status=NULL,$userid=null)
 {
	$this->db->where('status', $status);
    $this->db->where('userid',$userid);
	$this->db->delete('gemstone_qc_temp'); 
 }
    
 function editTaskWorkerTemp($temp=NULL)
 {
	$this->db->where('status', $temp['status']);
    $this->db->where('userid', $temp['userid']);
	unset($temp['status']);
    unset($temp['userid']);
	$query = $this->db->update('gemstone_task_temp', $temp); 	
	return $query;
 }
    
 function editBackWorkerTemp($temp=NULL)
 {
	//$this->db->where('status', $temp['status']);
    $this->db->where('userid', $temp['userid']);
	//unset($temp['status']);
    unset($temp['userid']);
	$query = $this->db->update('gemstone_back_temp', $temp); 	
	return $query;
 }
    
 function getWorkerTemp($status, $userid)
 {
	$this->db->select("worker.id as workid ,worker_id, firstname, lastname");
	$this->db->order_by("gemstone_task_temp.tempid", "asc");
	$this->db->from('gemstone_task_temp');
    $this->db->join('worker', 'gemstone_task_temp.worker=worker.id','left');
    $this->db->where('status', $status);
    $this->db->where('userid', $userid);
    $this->db->limit(1);
	$query = $this->db->get();		
	return $query->result();
 }
    
 function getWorkerTemp_back($status, $userid)
 {
	$this->db->select("worker.id as workid ,worker_id, firstname, lastname");
	$this->db->order_by("gemstone_back_temp.tempid", "asc");
	$this->db->from('gemstone_back_temp');
    $this->db->join('worker', 'gemstone_back_temp.worker=worker.id','left');
    //$this->db->where('status', $status);
    $this->db->where('userid', $userid);
    $this->db->limit(1);
	$query = $this->db->get();		
	return $query->result();
 }
    
 function delGem($id=NULL)
 {
	$this->db->where('id', $id);
	$this->db->delete('gemstone_barcode'); 
 }
    
 function delGemstone($id=NULL)
 {
	$this->db->where('id', $id);
	$this->db->delete('gemstone'); 
 }
    
 function delParcel($id=NULL)
 {
	$gem = array('disable'=>1);
    $this->db->where('id',$id);
    $query = $this->db->update('gemstone', $gem); 
 }
    
 function getProgress_task($id,$task)
 {
    $this->db->select('gemstone_task.barcode as gemid, worker.firstname as fname, worker.lastname as lname , gemstone_task.dateadd as date');
    $this->db->from('gemstone_task');
    $this->db->join('worker', 'worker.id=gemstone_task.worker','left');
    $this->db->where('gemstone_task.barcode', $id);
    $this->db->where('gemstone_task.status', $task);
    $query = $this->db->get();		
	return $query->result();
 }
    
 function getProgress_back($id,$task)
 {
    $this->db->select('gemstone_back.barcode as gemid, worker.firstname as fname, worker.lastname as lname, gemstone_back.dateadd as date');
    $this->db->from('gemstone_back');
    $this->db->join('worker', 'worker.id=gemstone_back.worker','left');
    $this->db->where('gemstone_back.barcode', $id);
    $this->db->where('gemstone_back.status', $task);
    $query = $this->db->get();		
	return $query->result();
 }
    
 function getQC_detail($id)
 {
    $this->db->select('status, dateadd, detail');
    $this->db->from('gemstone_qc');
    $this->db->where('barcode', $id);
    $query = $this->db->get();		
	return $query->result();
 }
    
 function getAllBarcode($gemid)
 {
    $this->db->select('gemstone_barcode.id as gemid, no, supplier.name as supname, gemstone_type.name as typename, lot, number, gemstone.dateadd as _dateadd, no, task3, task4, task5, task6, task7, task8, task9, task10, qc1, qc2, edit, pass, process_type.name as process_name, process_detail, gemstone.process_type as ptype, size_out');
    $this->db->from('gemstone_barcode');
    $this->db->join('gemstone','gemstone.id = gemstone_barcode.gemstone_id','left');
    $this->db->join('supplier', 'supplier.id = gemstone.supplier', 'left');
    $this->db->join('gemstone_type', 'gemstone_type.id = gemstone.type', 'left');
    $this->db->join('process_type', 'gemstone.process_type = process_type.id', 'left');
    $this->db->where('gemstone_barcode.gemstone_id', $gemid);
    $query = $this->db->get();		
	return $query->result();
 }
    
 function getRangeBarcode($gemid,$start,$end)
 {
    $this->db->select('gemstone_barcode.id as gemid, no, supplier.name as supname, gemstone_type.name as typename, lot, number, gemstone.dateadd as _dateadd, no, task3, task4, task5, task6, task7, task8, task9, task10, qc1, qc2, edit, pass, process_type.name as process_name, process_detail, gemstone.process_type as ptype');
    $this->db->from('gemstone_barcode');
    $this->db->where('gemstone_id', $gemid);
    $this->db->join('gemstone','gemstone.id = gemstone_barcode.gemstone_id','left');
    $this->db->join('supplier', 'supplier.id = gemstone.supplier', 'left');
    $this->db->join('gemstone_type', 'gemstone_type.id = gemstone.type', 'left');
    $this->db->join('process_type', 'gemstone.process_type = process_type.id', 'left');
    $this->db->where('no >=',$start);
    $this->db->where('no <=',$end);
    $query = $this->db->get();		
	return $query->result();
 }
    
 function getCountQC($id,$status)
 {
	$this->db->select("gemstone_barcode.id");
    $this->db->from('gemstone_barcode');
    $this->db->join('gemstone','gemstone.id=gemstone_barcode.gemstone_id','left');
	$this->db->where('gemstone_barcode.pass', $status);
    $this->db->where('gemstone.id',$id);
	$query = $this->db->get();		
	return $query->num_rows();
 }
    
 function checkProcessName($name)
 {
    $this->db->select("id");
	$this->db->from('process_type');		
	$this->db->where('name', $name);
	$query = $this->db->get();		
	return $query->num_rows();
 }
    
 function addProcess($process=NULL)
 {		
	$this->db->insert('process_type', $process);
	return $this->db->insert_id();			
 }
    
 function edit_datefactory($edit=NULL)
 {
    $this->db->where('id', $edit['id']);
	unset($edit['id']);
	$query = $this->db->update('gemstone', $edit); 	
	return $query;
 }
    
 function checkBarcode_purchase($barcode=NULL)
 {
    $this->db->select("id");
	$this->db->from('gemstone');		
	$this->db->where('barcode', $barcode);
    $this->db->where('disable != ', 1);
	$query = $this->db->get();		
	return $query->num_rows();
 }
    
}
?>