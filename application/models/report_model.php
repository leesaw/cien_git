<?php
Class Report_model extends CI_Model
{
 function getAllParcelColor_string($color, $start, $end)
 {
    $this->db->select('gemstone.id as gemid, supplier.name as supname, number, lot, color, gemstone_type.name as gemtype, gemstone.size_out as size_out, size_in, carat, amount, gemstone.dateadd as dateadd, min(no) as _min, max(no) as _max, process_type.name as process_name, process_detail');
    $this->db->from('gemstone');
    $this->db->join('supplier', 'gemstone.supplier=supplier.id','left');
    $this->db->join('gemstone_type', 'gemstone_type.id=gemstone.type','left');
    $this->db->join('gemstone_barcode', 'gemstone_barcode.gemstone_id=gemstone.id', 'left');
    $this->db->join('process_type', 'process_type.id=gemstone.process_type', 'left');
    $this->db->group_by('gemstone.id');
    //$this->db->join('gemstone_size', 'gemstone_size.id=gemstone.size_out','left');
    $this->db->where('gemstone_type.name', $color);
    $this->db->where('disable',0);
    $this->db->where('gemstone.dateadd >=', $start);
    $this->db->where('gemstone.dateadd <=', $end);
    $query = $this->db->get();
	return $query->result();
 }
    
 function getAllGemstoneInFactory()
 {
    $query = $this->db->query('SELECT gemstone_type.id as typeid, gemstone_type.name as typename,count(*) as count FROM gemstone_barcode,gemstone,gemstone_type WHERE gemstone_barcode.gemstone_id=gemstone.id and  gemstone.type=gemstone_type.id and disable=0 and (pass=0 or pass=3) group by gemstone.type');
    return $query->result();
 }
    
 function getAllGemstoneInDay($date)
 {
    $query = $this->db->query('SELECT gemstone_type.name,count(*) FROM gemstone_barcode,gemstone,gemstone_type WHERE gemstone_barcode.gemstone_id=gemstone.id and gemstone.type=gemstone_type.id and disable=0 and (pass=0 or pass=3) group by gemstone.type'); 
    return $query->result();
 }
    
 function getColorGemstoneInFactory($color)
 {
    $query = $this->db->query("SELECT process_type.name as processname,count(*) as count FROM gemstone_barcode,gemstone,gemstone_type,process_type WHERE gemstone_barcode.gemstone_id=gemstone.id and gemstone.type=gemstone_type.id and gemstone.process_type=process_type.id and disable=0 and (pass=0 or pass=3) and gemstone_type.name = '".$color."' group by process_type.name"); 
    return $query->result();
 }
    
 function getColorGemstoneInFactory_id($color)
 {
    $query = $this->db->query("SELECT process_type.id as processid,process_type.name as processname,count(*) as count FROM gemstone_barcode,gemstone,gemstone_type,process_type WHERE gemstone_barcode.gemstone_id=gemstone.id and gemstone.type=gemstone_type.id and gemstone.process_type=process_type.id and disable=0 and (pass=0 or pass=3) and gemstone_type.id = '".$color."' group by process_type.name"); 
    return $query->result();
 }
    
 function getAllStationInFactory()
 {
    $query = $this->db->query('select * from (    
    select 16 as number,count(*) as count from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and task3!=1 and task4!=1 and task5!=1 and task6!=1 and task7!=1 and task8!=1 and task9!=1 and task10!=1 and qc1!=1 and qc2!=1 and pass !=1 and pass!=2 and disable=0
    union all
    select 4,count(task4) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  task4=1 and pass=0 and disable=0
    union all
    select 5,count(task5) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  task5=1 and pass=0 and disable=0
    union all
    select 3,count(task3) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  task3=1 and pass=0 and disable=0
    union all
    select 6,count(task6) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  task6=1 and pass=0 and disable=0
    union all
    select 12,count(qc1) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and qc1=1 and pass=0 and disable=0
    union all
    select 7,count(task7) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  task7=1 and pass=0 and disable=0
    union all
    select 8,count(task8) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  task8=1 and pass=0 and disable=0
    union all
    select 9,count(task9) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  task9=1 and pass=0 and disable=0
    union all
    select 13,count(qc2) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  qc2=1 and pass=0 and disable=0
    ) s');
    return $query->result();
     
    //    select 10,count(task10) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  task10=1 and pass=0 and disable=0 union all select 14,count(pass) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  pass=1 and disable=0 union all select 15,count(pass) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  pass=2 and disable=0 union all
 }
    
 function getAllGemstone_factory(){
    $this->db->select("gemstone_barcode.id as barcodeid, gemstone.id as gemid, gemstone.barcode as gembarcode, supplier.name as supname, number, lot, color, gemstone.dateadd as gemdate, gemstone_type.name as gemtype, gemstone.size_out as gemsize, no");
	$this->db->order_by("gemstone.dateadd", "desc");
	$this->db->from('gemstone_barcode');
    $this->db->join('gemstone', 'gemstone.id = gemstone_barcode.gemstone_id', 'left');
    $this->db->join('supplier', 'gemstone.supplier=supplier.id','left');
    $this->db->join('gemstone_type', 'gemstone_type.id=gemstone.type','left');
    //$this->db->join('gemstone_size', 'gemstone_size.id=gemstone.size_out','left');
    $this->db->where('disable',0);
    $this->db->where("(pass =0 OR pass =3)", NULL, FALSE);
    $query = $this->db->get();		
	return $query->result();
  
 }
    
 function getTask_worker_station($task){
    $this->db->select('worker.firstname as fname, worker.lastname as lname , count(*) as count');
    $this->db->from('gemstone_task');
    $this->db->join('worker', 'worker.id=gemstone_task.worker','left');
    $this->db->join('gemstone_barcode', 'gemstone_barcode.id=gemstone_task.barcode', 'left');
    $this->db->group_by('gemstone_task.worker');
    $this->db->where('gemstone_task.status', $task);
    $this->db->where('(gemstone_barcode.pass=0 OR gemstone_barcode.pass=3)', NULL, FALSE);
    $query = $this->db->get();		
	return $query->result();
 }
    
 function getInOutSevenDay($day) {
    $result = array();
    foreach ($day as $loop) {
        $where = "DATE(dateadd) = '".$loop."'";
        $query = $this->db->query("select aa.date as d,aa.cc as ac,bb.cc as bc, ee.cc as ec from (SELECT IFNULL(CAST(dateadd AS DATE),'".$loop."') as date,IFNULL(count(*),0) as cc FROM gemstone_qc where status=1 and ".$where.") as aa, (SELECT IFNULL(CAST(dateadd AS DATE),'".$loop."') as date,IFNULL(count(*),0) as cc FROM gemstone_qc where status=2 and ".$where.") as bb, (SELECT IFNULL(CAST(dateadd AS DATE),'".$loop."') as date,IFNULL(sum(amount),0) as cc FROM gemstone where ".$where.") as ee");
        foreach ($query->result() as $row)
        {
           $result[] = array("date" => $row->d, "in" => $row->ec, "outgood" => $row->ac, "outfail" => $row->bc);
        }
    }
     
    return $result;
 }
    
 function getErrorBetween($error, $start, $end)
 {
    $this->db->select('count(*) as count');
    $this->db->from('gemstone_qc');
    $this->db->where('status', 2);
    $this->db->like('detail', $error);
    $this->db->where("dateadd between '".$start."' AND '".$end."'", NULL, FALSE);
    $query = $this->db->get();		
	return $query->result(); 
 }
    
 function getErrorAll($error)
 {
    $this->db->select('count(*) as count');
    $this->db->from('gemstone_qc');
    $this->db->where('status', 2);
    $this->db->like('detail', $error);
    $query = $this->db->get();		
	return $query->result();
 }
    
 function getErrorAll_barcode($error)
 {
    $this->db->select("gemstone_barcode.id as barcodeid, gemstone.id as gemid, gemstone.barcode as gembarcode, supplier.name as supname, number, lot, color, gemstone.dateadd as gemdate, gemstone_type.name as gemtype, gemstone.size_out as gemsize, no, gemstone_qc.detail as errordetail");
    $this->db->from('gemstone_qc');
    $this->db->join('gemstone_barcode', 'gemstone_qc.barcode=gemstone_barcode.id', 'left');
    $this->db->join('gemstone', 'gemstone.id = gemstone_barcode.gemstone_id', 'left');
    $this->db->join('supplier', 'gemstone.supplier=supplier.id','left');
    $this->db->join('gemstone_type', 'gemstone_type.id=gemstone.type','left');
    $this->db->where('gemstone_qc.status', 2);
    $this->db->like('gemstone_qc.detail', $error);
    $query = $this->db->get();
	return $query->result();
 }

 function getErrorBetween_barcode($error, $start, $end)
 {
    $this->db->select("gemstone_barcode.id as barcodeid, gemstone.id as gemid, gemstone.barcode as gembarcode, supplier.name as supname, number, lot, color, gemstone.dateadd as gemdate, gemstone_type.name as gemtype, gemstone.size_out as gemsize, no, gemstone_qc.detail as errordetail");
    $this->db->from('gemstone_qc');
    $this->db->join('gemstone_barcode', 'gemstone_qc.barcode=gemstone_barcode.id', 'left');
    $this->db->join('gemstone', 'gemstone.id = gemstone_barcode.gemstone_id', 'left');
    $this->db->join('supplier', 'gemstone.supplier=supplier.id','left');
    $this->db->join('gemstone_type', 'gemstone_type.id=gemstone.type','left');
    $this->db->where('gemstone_qc.status', 2);
    $this->db->like('gemstone_qc.detail', $error);
    $this->db->where("gemstone_qc.dateadd between '".$start."' AND '".$end."'", NULL, FALSE);
    $query = $this->db->get();
	return $query->result();
 }

}
?>