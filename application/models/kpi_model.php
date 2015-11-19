<?php
Class Kpi_model extends CI_Model
{
 function getAllstaff_station($status, $start, $end)
 {
     $start = $start. " 00:00:00";
     $end = $end." 23:59:59";

     $this->db->select("worker.id as workerid, firstname, lastname, COUNT(*) as sum1");
     $this->db->from('gemstone_back');
     $this->db->join('gemstone_barcode', 'gemstone_barcode.id=gemstone_back.barcode','left');
     $this->db->join('gemstone', 'gemstone.id=gemstone_barcode.gemstone_id','left');
     $this->db->join('worker', 'worker.id=gemstone_back.worker','left');
     $this->db->where('gemstone_back.status', $status);
     $this->db->where('gemstone.disable',0);
     $this->db->where('gemstone_back.pass',1);
     $this->db->where("gemstone_back.dateadd between '".$start."' AND '".$end."'", NULL, FALSE);
     $this->db->group_by('gemstone_back.worker');
     $this->db->order_by('sum1', 'desc');
     
     $query = $this->db->get();
     return $query->result();
 }
    
 function getStation_date($status, $start, $end)
 {
     $start = $start. " 00:00:00";
     $end = $end." 23:59:59";
     
     $this->db->select("date(gemstone_back.dateadd) as day1, COUNT(*) as sum1");
     $this->db->from('gemstone_back');
     $this->db->join('gemstone_barcode', 'gemstone_barcode.id=gemstone_back.barcode','left');
     $this->db->join('gemstone', 'gemstone.id=gemstone_barcode.gemstone_id','left');
     $this->db->join('worker', 'worker.id=gemstone_back.worker','left');
     $this->db->where('gemstone_back.status', $status);
     $this->db->where('gemstone.disable',0);
     $this->db->where('gemstone_back.pass',1);
     $this->db->where("gemstone_back.dateadd between '".$start."' AND '".$end."'", NULL, FALSE);
     $this->db->group_by('date(gemstone_back.dateadd)');
     $this->db->order_by('day1', 'asc');
     
     $query = $this->db->get();
     return $query->result();
 }
    
 function getWorker_date($worker, $start, $end)
 {
     $start = $start. " 00:00:00";
     $end = $end." 23:59:59";
     
     $this->db->select("date(gemstone_back.dateadd) as day1, COUNT(*) as sum1");
     $this->db->from('gemstone_back');
     $this->db->join('gemstone_barcode', 'gemstone_barcode.id=gemstone_back.barcode','left');
     $this->db->join('gemstone', 'gemstone.id=gemstone_barcode.gemstone_id','left');
     $this->db->join('worker', 'worker.id=gemstone_back.worker','left');
     $this->db->where('gemstone_back.worker', $worker);
     $this->db->where('gemstone.disable',0);
     $this->db->where('gemstone_back.pass',1);
     $this->db->where("gemstone_back.dateadd between '".$start."' AND '".$end."'", NULL, FALSE);
     $this->db->group_by('date(gemstone_back.dateadd)');
     $this->db->order_by('day1', 'asc');
     
     $query = $this->db->get();
     return $query->result();
 }
    
 function getStation_process_worker($status, $worker, $start, $end)
 {
     $start = $start. " 00:00:00";
     $end = $end." 23:59:59";
     
     $this->db->select("process_type.id as pid, process_type.name as pname, COUNT(*) as sum1");
     $this->db->from('gemstone_back');
     $this->db->join('gemstone_barcode', 'gemstone_barcode.id=gemstone_back.barcode','left');
     $this->db->join('gemstone', 'gemstone.id=gemstone_barcode.gemstone_id','left');
     $this->db->join('worker', 'worker.id=gemstone_back.worker','left');
     $this->db->join('process_type','process_type.id=gemstone.process_type','left');
     $this->db->where('gemstone_back.worker', $worker);
     $this->db->where('gemstone_back.status', $status);
     $this->db->where('gemstone.disable',0);
     $this->db->where('gemstone_back.pass',1);
     $this->db->where("gemstone_back.dateadd between '".$start."' AND '".$end."'", NULL, FALSE);
     $this->db->group_by('process_type.id');
     $this->db->order_by('process_type.id');
     
     $query = $this->db->get();
     return $query->result();
 }
    
 function getAllstation_worker($worker, $start, $end)
 {
     $start = $start. " 00:00:00";
     $end = $end." 23:59:59";

     $this->db->select("status, COUNT(*) as sum1");
     $this->db->from('gemstone_back');
     $this->db->join('gemstone_barcode', 'gemstone_barcode.id=gemstone_back.barcode','left');
     $this->db->join('gemstone', 'gemstone.id=gemstone_barcode.gemstone_id','left');
     $this->db->join('worker', 'worker.id=gemstone_back.worker','left');
     $this->db->where('gemstone_back.worker', $worker);
     $this->db->where('gemstone.disable',0);
     $this->db->where('gemstone_back.pass',1);
     $this->db->where("gemstone_back.dateadd between '".$start."' AND '".$end."'", NULL, FALSE);
     $this->db->group_by('status');
     $this->db->order_by('sum1', 'desc');
     
     $query = $this->db->get();
     return $query->result();
 }

}
?>