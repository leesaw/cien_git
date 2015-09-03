<?php
Class Report_model extends CI_Model
{
 function getAllParcelColor_string($color, $start, $end)
 {
    $this->db->select('gemstone.id as gemid, supplier.name as supname, number, lot, color, gemstone_type.name as gemtype, gemstone.size_out as size_out, size_in, carat, amount, gemstone.dateadd as dateadd, mmin as _min, mmax as _max, process_type.name as process_name, process_detail');
    $this->db->from('gemstone');
    $this->db->join('supplier', 'gemstone.supplier=supplier.id','left');
    $this->db->join('gemstone_type', 'gemstone_type.id=gemstone.type','left');
    $this->db->join('(select gemstone_id, min(no) as mmin,max(no) as mmax from gemstone_barcode GROUP BY gemstone_id) as aa', 'aa.gemstone_id=gemstone.id', 'left');
    $this->db->join('process_type', 'process_type.id=gemstone.process_type', 'left');
    //$this->db->group_by('gemstone.id');
    //$this->db->join('gemstone_size', 'gemstone_size.id=gemstone.size_out','left');
    if ($color != "0") {
        $this->db->where('gemstone_type.name', $color);
    }
    $this->db->where('disable',0);
     if (($start!=0) or ($end!=0)) {
        $this->db->where('gemstone.dateadd >=', $start);
        $this->db->where('gemstone.dateadd <=', $end);
     }
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
    select 16 as number,count(*) as count from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and task3!=1 and task4!=1 and task5!=1 and task6!=1 and task7!=1 and task8!=1 and task9!=1 and task10!=1 and qc1!=1 and qc2!=1 and (pass=0 or pass=3) and disable=0
    union all
    select 4,count(task4) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  task4=1 and (pass=0 or pass=3) and disable=0
    union all
    select 5,count(task5) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  task5=1 and (pass=0 or pass=3) and disable=0
    union all
    select 3,count(task3) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  task3=1 and (pass=0 or pass=3) and disable=0
    union all
    select 6,count(task6) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  task6=1 and (pass=0 or pass=3) and disable=0
    union all
    select 12,count(qc1) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and qc1=1 and (pass=0 or pass=3) and disable=0
    union all
    select 7,count(task7) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  task7=1 and (pass=0 or pass=3) and disable=0
    union all
    select 8,count(task8) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  task8=1 and (pass=0 or pass=3) and disable=0
    union all
    select 9,count(task9) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  task9=1 and (pass=0 or pass=3) and disable=0
    union all
    select 13,count(qc2) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  qc2=1 and (pass=0 or pass=3) and disable=0
    union all
    select 10,count(task10) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  task10=1 and (pass=0 or pass=3) and disable=0
    ) s');
    return $query->result();
     
    //    select 10,count(task10) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  task10=1 and pass=0 and disable=0 union all select 14,count(pass) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  pass=1 and disable=0 union all select 15,count(pass) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  pass=2 and disable=0 union all
 }
    
 function getAllGemCenter_task()
 {
    $query = $this->db->query('select * from (
    select 1 as number,count(*) as count from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and task3=0 and task4=0 and task5=0 and task6=0 and task7=0 and task8=0 and task9=0 and task10=0 and qc1=0 and qc2=0 and (pass=0 or pass=3) and disable=0 
    union all 
    select 2 as number,count(*) as count from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and task3=0 and task4=2 and task5=0 and task6=0 and task7=0 and task8=0 and task9=0 and task10=0 and qc1=0 and qc2=0 and (pass=0 or pass=3) and disable=0
    union all 
    select 3 as number,count(*) as count from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and task3=0 and task4!=1 and task5=2 and task6=0 and task7=0 and task8=0 and task9=0 and task10=0 and qc1=0 and qc2=0 and (pass=0 or pass=3) and disable=0 
    union all 
    select 4 as number,count(*) as count from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and task3=2 and task4!=1 and task5!=1 and task6=0 and task7=0 and task8=0 and task9=0 and task10=0 and qc1=0 and qc2=0 and (pass=0 or pass=3) and disable=0 
    union all 
    select 5 as number,count(*) as count from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and task3!=1 and task4!=1 and task5!=1 and task6=2 and task7=0 and task8=0 and task9=0 and task10=0 and qc1=0 and qc2=0 and (pass=0 or pass=3) and disable=0 
    union all 
    select 6 as number,count(*) as count from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and task3!=1 and task4!=1 and task5!=1 and task6!=1 and task7=0 and task8=0 and task9=0 and task10=0 and qc1=2 and qc2=0 and (pass=0 or pass=3) and disable=0 
    union all 
    select 7 as number,count(*) as count from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and task3!=1 and task4!=1 and task5!=1 and task6!=1 and task7=2 and task8=0 and task9=0 and task10=0 and qc1!=1 and qc2=0 and (pass=0 or pass=3) and disable=0
    union all 
    select 8 as number,count(*) as count from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and task3!=1 and task4!=1 and task5!=1 and task6!=1 and task7!=1 and task8=2 and task9=0 and task10=0 and qc1!=1 and qc2=0 and (pass=0 or pass=3) and disable=0 
    union all 
    select 9 as number,count(*) as count from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and task3!=1 and task4!=1 and task5!=1 and task6!=1 and task7!=1 and task8!=1 and task9=2 and task10=0 and qc1!=1 and qc2=0 and (pass=0 or pass=3) and disable=0 
    union all 
    select 10 as number,count(*) as count from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and task3!=1 and task4!=1 and task5!=1 and task6!=1 and task7!=1 and task8!=1 and task9!=1 and task10=0 and qc1!=1 and qc2=2 and (pass=0 or pass=3) and disable=0 
    union all 
    select 11 as number,count(*) as count from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and task3!=1 and task4!=1 and task5!=1 and task6!=1 and task7!=1 and task8!=1 and task9!=1 and task10=2 and qc1!=1 and qc2!=1 and (pass=0 or pass=3) and disable=0 
    ) s');
    return $query->result();
 }
    
 function getAllStationInFactory_edit()
 {
    $query = $this->db->query('select * from (    
    select 16 as number,count(*) as count from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and task3!=1 and task4!=1 and task5!=1 and task6!=1 and task7!=1 and task8!=1 and task9!=1 and task10!=1 and qc1!=1 and qc2!=1 and pass=3 and disable=0
    union all
    select 4,count(task4) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  task4=1 and pass=3 and disable=0
    union all
    select 5,count(task5) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  task5=1 and pass=3 and disable=0
    union all
    select 3,count(task3) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  task3=1 and pass=3 and disable=0
    union all
    select 6,count(task6) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  task6=1 and pass=3 and disable=0
    union all
    select 12,count(qc1) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and qc1=1 and pass=3 and disable=0
    union all
    select 7,count(task7) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  task7=1 and pass=3 and disable=0
    union all
    select 8,count(task8) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  task8=1 and pass=3 and disable=0
    union all
    select 9,count(task9) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  task9=1 and pass=3 and disable=0
    union all
    select 13,count(qc2) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  qc2=1 and pass=3 and disable=0
    union all
    select 10,count(task10) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  task10=1 and pass=3 and disable=0
    ) s');
    return $query->result();
     
    //    select 10,count(task10) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  task10=1 and pass=0 and disable=0 union all select 14,count(pass) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  pass=1 and disable=0 union all select 15,count(pass) from gemstone_barcode,gemstone where gemstone_barcode.gemstone_id=gemstone.id and  pass=2 and disable=0 union all
 }
    
 function getCountColorStation($task, $status)
 {
    switch($task) {
            case '16' : $column = "(task3!=1 and task4!=1 and task5!=1 and task6!=1 and task7!=1 and task8!=1 and task9!=1 and task10!=1 and qc1!=1 and qc2!=1)"; break;
            case '3' : $column = "(task3=1)"; break;
            case '4' : $column = "(task4=1)"; break;
            case '5' : $column = "(task5=1)"; break;
            case '6' : $column = "(task6=1)"; break;
            case '7' : $column = "(task7=1)"; break;
            case '8' : $column = "(task8=1)"; break;
            case '9' : $column = "(task9=1)"; break;
            case '10' : $column = "(task10=1)"; break;
            case '12' : $column = "(qc1=1)"; break;
            case '13' : $column = "(qc2=1)"; break;
    } 
     
    $this->db->select("gemstone_type.id as typeid, gemstone_type.name as typename, count(*) as count");
    $this->db->from("gemstone_barcode");
    $this->db->join("gemstone", "gemstone.id = gemstone_barcode.gemstone_id", "left");
    $this->db->join("gemstone_type", "gemstone_type.id=gemstone.type", "left");
    $this->db->group_by('gemstone.type');
    $this->db->where('disable',0);
    if ($status==0) $this->db->where('(pass=0 OR pass=3)');
    else if ($status==1) $this->db->where('(pass=3)');
    $this->db->where($column);
    $query = $this->db->get();		
	return $query->result();
 }
    
 function getCountColorCenter_task($task)
 {
    switch($task) {
            case '1' : $column = "(gemstone_barcode.gemstone_id=gemstone.id and task3=0 and task4=0 and task5=0 and task6=0 and task7=0 and task8=0 and task9=0 and task10=0 and qc1=0 and qc2=0)"; break;
            case '2' : $column = "(gemstone_barcode.gemstone_id=gemstone.id and task3=0 and task4=2 and task5=0 and task6=0 and task7=0 and task8=0 and task9=0 and task10=0 and qc1=0 and qc2=0)"; break;
            case '3' : $column = "(gemstone_barcode.gemstone_id=gemstone.id and task3=0 and task4!=1 and task5=2 and task6=0 and task7=0 and task8=0 and task9=0 and task10=0 and qc1=0 and qc2=0)"; break;
            case '4' : $column = "(gemstone_barcode.gemstone_id=gemstone.id and task3=2 and task4!=1 and task5!=1 and task6=0 and task7=0 and task8=0 and task9=0 and task10=0 and qc1=0 and qc2=0)"; break;
            case '5' : $column = "(gemstone_barcode.gemstone_id=gemstone.id and task3!=1 and task4!=1 and task5!=1 and task6=2 and task7=0 and task8=0 and task9=0 and task10=0 and qc1=0 and qc2=0)"; break;
            case '6' : $column = "(gemstone_barcode.gemstone_id=gemstone.id and task3!=1 and task4!=1 and task5!=1 and task6!=1 and task7=0 and task8=0 and task9=0 and task10=0 and qc1=2 and qc2=0)"; break;
            case '7' : $column = "(gemstone_barcode.gemstone_id=gemstone.id and task3!=1 and task4!=1 and task5!=1 and task6!=1 and task7=2 and task8=0 and task9=0 and task10=0 and qc1!=1 and qc2=0)"; break;
            case '8' : $column = "(gemstone_barcode.gemstone_id=gemstone.id and task3!=1 and task4!=1 and task5!=1 and task6!=1 and task7!=1 and task8=2 and task9=0 and task10=0 and qc1!=1 and qc2=0)"; break;
            case '9' : $column = "(gemstone_barcode.gemstone_id=gemstone.id and task3!=1 and task4!=1 and task5!=1 and task6!=1 and task7!=1 and task8!=1 and task9=2 and task10=0 and qc1!=1 and qc2=0)"; break;
            case '10' : $column = "(gemstone_barcode.gemstone_id=gemstone.id and task3!=1 and task4!=1 and task5!=1 and task6!=1 and task7!=1 and task8!=1 and task9!=1 and task10=0 and qc1!=1 and qc2=2)"; break;
            case '11' : $column = "(gemstone_barcode.gemstone_id=gemstone.id and task3!=1 and task4!=1 and task5!=1 and task6!=1 and task7!=1 and task8!=1 and task9!=1 and task10=2 and qc1!=1 and qc2!=1)"; break;
    } 
     
    $this->db->select("gemstone_type.id as typeid, gemstone_type.name as typename, count(*) as count");
    $this->db->from("gemstone_barcode");
    $this->db->join("gemstone", "gemstone.id = gemstone_barcode.gemstone_id", "left");
    $this->db->join("gemstone_type", "gemstone_type.id=gemstone.type", "left");
    $this->db->group_by('gemstone.type');
    $this->db->where('disable',0);
    $this->db->where('(pass=0 OR pass=3)');
    $this->db->where($column);
    $query = $this->db->get();		
	return $query->result();
 }
    
 function getCountStation_colorProcess($color,$process,$task)
 {
    switch($task) {
        case '0' : $column = "(task3!=1 and task4!=1 and task5!=1 and task6!=1 and task7!=1 and task8!=1 and task9!=1 and task10!=1 and qc1!=1 and qc2!=1)"; $select="ส่วนกลาง"; break;
        case '1' : $column = "(task3=1)"; $select="กดหน้ากระดาน"; break;
        case '2' : $column = "(task4=1)"; $select="ติดแชล็ก"; break;
        case '3' : $column = "(task5=1)"; $select="บล็อกรูปร่าง"; break;
        case '4' : $column = "(task6=1)"; $select="เจียรหน้า"; break;
        case '5' : $column = "(task7=1)"; $select="กลับติดก้นแชล็ก"; break;
        case '6' : $column = "(task8=1)"; $select="บล็อกก้น"; break;
        case '7' : $column = "(task9=1)"; $select="เจียก้น"; break;
        case '8' : $column = "(task10=1)"; $select=""; break;
        case '9' : $column = "(qc1=1)"; $select="QC หน้า"; break;
        case '10' : $column = "(qc2=1)"; $select="QC ก้น"; break;
    } 
     
    $this->db->select("'".$select."' as one, count(*) as count", FALSE);
    $this->db->from("gemstone_barcode");
    $this->db->join("gemstone", "gemstone.id = gemstone_barcode.gemstone_id", "left");
    $this->db->join("gemstone_type", "gemstone_type.id=gemstone.type", "left");
    $this->db->where('disable',0);
    $this->db->where('(pass=0 OR pass=3)');
    $this->db->where('gemstone.type',$color);
    if ($process>0) {
        $this->db->where('gemstone.process_type',$process);
    }
    $this->db->where($column);
    $query = $this->db->get();		
	return $query->result();
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
        $query = $this->db->query("select aa.date as d,aa.cc as ac,bb.cc as bc, ee.cc as ec, ff.cc as fc from (SELECT IFNULL(CAST(dateadd AS DATE),'".$loop."') as date,IFNULL(count(*),0) as cc FROM gemstone_qc where status=1 and ".$where.") as aa, (SELECT IFNULL(CAST(dateadd AS DATE),'".$loop."') as date,IFNULL(count(*),0) as cc FROM gemstone_qc where status=2 and ".$where.") as bb, (SELECT IFNULL(CAST(dateadd AS DATE),'".$loop."') as date,IFNULL(count(*),0) as cc FROM gemstone_qc where status=4 and ".$where.") as ff, (SELECT IFNULL(CAST(dateadd AS DATE),'".$loop."') as date,IFNULL(sum(amount),0) as cc FROM gemstone where ".$where.") as ee");
        foreach ($query->result() as $row)
        {
           $result[] = array("date" => $row->d, "in" => $row->ec, "outgood" => $row->ac, "outfail" => $row->bc, "outreturn" => $row->fc);
        }
    }
     
    return $result;
 }
    
 function getErrorBetween($error, $start, $end)
 {
    $this->db->select('count(*) as count');
    $this->db->from('gemstone_qc');
    $this->db->where('status', 2);
    $this->db->like('detail', $error, 'after');
    $this->db->where("dateadd between '".$start." 00:00:00' AND '".$end." 23:59:59'", NULL, FALSE);
    $query = $this->db->get();		
	return $query->result(); 
 }
    
 function getErrorAll($error)
 {
    $this->db->select('count(*) as count');
    $this->db->from('gemstone_qc');
    $this->db->where('status', 2);
    $this->db->like('detail', $error, 'after');
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
    $this->db->like('gemstone_qc.detail', $error, 'after');
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
    $this->db->like('gemstone_qc.detail', $error, 'after');
    $this->db->where("gemstone_qc.dateadd between '".$start." 00:00:00' AND '".$end." 23:59:59'", NULL, FALSE);
    $query = $this->db->get();
	return $query->result();
 }
    
 function getAllParcel_factory()
 {
    $this->db->select('gemstone.id as gemid, supplier.name as supname, number, lot, color, gemstone_type.name as gemtype, gemstone.size_out as size_out, size_in, carat, amount, gemstone.dateadd as dateadd, min(no) as _min, max(no) as _max, process_type.name as process_name, process_detail, count(gemstone_barcode.id) as waiting');
    $this->db->from('gemstone');
    $this->db->join('supplier', 'gemstone.supplier=supplier.id','left');
    $this->db->join('gemstone_type', 'gemstone_type.id=gemstone.type','left');
    $this->db->join('gemstone_barcode', 'gemstone_barcode.gemstone_id=gemstone.id', 'left');
    $this->db->join('process_type', 'process_type.id = gemstone.process_type', 'left');
    $this->db->group_by('gemstone.id');
    $this->db->where('disable',0);
    $this->db->where("(pass =0 OR pass =3)", NULL, FALSE);
    $query = $this->db->get();
	return $query->result();
 }
    
 function getAllGemstoneInventory_instock($rough)
 {
     if ($rough == "พลอยสำเร็จ") {
        $this->db->select("gemstone_type.name as typename,SUM((gemstone_stock.amount-gemstone_stock.amount_out)) as amount, FORMAT(SUM(gemstone_stock.carat - gemstone_stock.carat_out),2) as carat", FALSE);
     }else{
        $this->db->select("gemstone_type.name as typename,FORMAT(SUM(gemstone_stock.kilogram*1000*5-gemstone_stock.carat_out),2) as carat", FALSE);
     }
    $this->db->from("gemstone_stock");
    $this->db->join("gemstone_type", "gemstone_type.id=gemstone_stock.type", "left");
    $this->db->where("stone_type", $rough);
    $this->db->where("disable",0);
    if ($rough == "พลอยสำเร็จ") {
        $this->db->where("((gemstone_stock.amount-gemstone_stock.amount_out > 0.01) OR (gemstone_stock.carat-gemstone_stock.carat_out > 0.01))");
    }else{
        $this->db->where("(gemstone_stock.kilogram>0 AND (gemstone_stock.kilogram*1000>gemstone_stock.carat_out*0.2))");   
    }
    $this->db->group_by("gemstone_stock.type");
    $query = $this->db->get();
    return $query->result();
 }
    
 function searchBarcode($barcode)
 {
    $this->db->select("gemstone_barcode.id as barcodeid, gemstone.id as gemid, gemstone.barcode as gembarcode, supplier.name as supname, number, lot, color, gemstone.dateadd as gemdate, gemstone_type.name as gemtype, gemstone.size_out as gemsize, no");
	$this->db->from('gemstone_barcode');
    $this->db->join('gemstone', 'gemstone.id = gemstone_barcode.gemstone_id', 'left');
    $this->db->join('supplier', 'gemstone.supplier=supplier.id','left');
    $this->db->join('gemstone_type', 'gemstone_type.id=gemstone.type','left');
    $this->db->where('gemstone_barcode.id', $barcode);
    $this->db->where('disable',0);
    $query = $this->db->get();
	return $query->result();
 }
    
 function getParcelInOut_process($start, $end, $gemtype, $process)
 {
     $start = $start. " 00:00:00";
     $end = $end." 23:59:59";
        
     $column = "(gemstone.dateadd >='".$start."' and gemstone.dateadd <='".$end."'";
     if (($gemtype>0) && ($process>0)) $column .= " and gemstone.type = '".$gemtype."' and gemstone.process_type = '".$process."')";
     elseif ($gemtype>0) $column .= " and gemstone.type = '".$gemtype."')";
     elseif ($process>0) $column .= " and gemstone.process_type = '".$process."')";
     else $column .= ")";
     
     $this->db->select("date_format(gemstone.dateadd,'%d/%m/%Y') as showdate, CONCAT(supplier.name,lot,'-',number,'#',no) as detail, gemstone_type.name as gemtype, process_type.name as process_name, carat, amount, sum(CASE WHEN pass = 1 THEN 1 ELSE 0 END) as okout, sum(CASE WHEN pass = 2 THEN 1 ELSE 0 END) as nookout, sum(CASE WHEN pass = 4 THEN 1 ELSE 0 END) as outout, (amount - count(gemstone_barcode.id)) as ok, gemstone.id as gemid", FALSE);
     $this->db->from("gemstone");
     $this->db->join('supplier', 'gemstone.supplier=supplier.id','left');
     $this->db->join('gemstone_type', 'gemstone_type.id=gemstone.type','left');
     $this->db->join('gemstone_barcode', 'gemstone_barcode.gemstone_id=gemstone.id', 'left');
     $this->db->join('process_type', 'process_type.id = gemstone.process_type', 'left');
     $this->db->where('disable',0);
     $this->db->where("(pass != 0 AND pass != 3)", NULL, FALSE);
     $this->db->where($column);
     $this->db->group_by('gemstone.id');
     
     $query = $this->db->get();		
	 return $query->result();
 }
    
}
?>