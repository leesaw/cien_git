<?php
Class Kpi_model extends CI_Model
{
 function getAllstaff_station($status, $start, $end)
 {
     $start = $start. " 00:00:00";
     $end = $end." 23:59:59";

     $this->db->select("worker.id as workerid, firstname, lastname, COUNT(*) as sum1, (COUNT(*)*factor) as sum2");
     $this->db->from('gemstone_back');
     $this->db->join('gemstone_barcode', 'gemstone_barcode.id=gemstone_back.barcode','left');
     $this->db->join('gemstone', 'gemstone.id=gemstone_barcode.gemstone_id','left');
     $this->db->join('worker', 'worker.id=gemstone_back.worker','left');
     $this->db->join('process_type','process_type.id=gemstone.process_type','left');
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
     $datediff = strtotime($end) - strtotime($start);
     $datediff = -(floor($datediff/(60*60*24)));
     
     if ($datediff==0) {
         $string_select = "(select date('".$end."') as thedate) d";
     }else{
         $string_select = "(select date('".$end."') as thedate union all ";
         for ($i = -1; $i > $datediff; $i--) {
            $thedate = date('Y-m-d', strtotime($i.' day', strtotime($end)));
            $string_select .= "select date('".$thedate."') union all ";
         }
         $string_select .= "select date('".$start."')) d";
     }
     
     $start = $start. " 00:00:00";
     $end = $end." 23:59:59";
     
     $sql = "select d.thedate as day1,coalesce(sum1, 0) as sum1,coalesce(sum2,0) as sum2 from ";
     $sql .= $string_select;
     $sql .= " left outer join ";
     
     $sql .= "(SELECT date(gemstone_back.dateadd) as day1, COUNT(*) as sum1, (COUNT(*)*factor) as sum2 FROM (`gemstone_back`) LEFT JOIN `gemstone_barcode` ON `gemstone_barcode`.`id`=`gemstone_back`.`barcode` LEFT JOIN `gemstone` ON `gemstone`.`id`=`gemstone_barcode`.`gemstone_id` LEFT JOIN `worker` ON `worker`.`id`=`gemstone_back`.`worker` LEFT JOIN `process_type` ON `process_type`.`id`=`gemstone`.`process_type` WHERE `gemstone_back`.`status` = '".$status."' AND `gemstone`.`disable` = 0 AND `gemstone_back`.`pass` = 1 AND gemstone_back.dateadd between '".$start."' AND '".$end."' GROUP BY date(gemstone_back.dateadd) ORDER BY `day1` asc) f";
     
     $sql .= " on d.thedate=f.day1 order by d.thedate";
     
     $this->db->select("date(gemstone_back.dateadd) as day1, coalesce(COUNT(*), 0) as sum1,  coalesce((COUNT(*)*factor), 0) as sum2", false);
     $this->db->from('gemstone_back', false);
     //$this->db->join('gemstone_back','gemstone_back.dateadd = thedate','left outer');
     $this->db->join('gemstone_barcode', 'gemstone_barcode.id=gemstone_back.barcode','left');
     $this->db->join('gemstone', 'gemstone.id=gemstone_barcode.gemstone_id','left');
     $this->db->join('worker', 'worker.id=gemstone_back.worker','left');
     $this->db->join('process_type','process_type.id=gemstone.process_type','left');
     //$this->db->join($string_select,'gemstone_back.dateadd = thedate','left outer');
     $this->db->where('gemstone_back.status', $status);
     $this->db->where('gemstone.disable',0);
     $this->db->where('gemstone_back.pass',1);
     $this->db->where("gemstone_back.dateadd between '".$start."' AND '".$end."'", NULL, FALSE);
     //$this->db->group_by('date(d.thedate)');
     $this->db->group_by('date(gemstone_back.dateadd)');
     $this->db->order_by('day1', 'asc');
     
     //$query = $this->db->get();
     $query = $this->db->query($sql);
     return $query->result();
 }
    
 function getWorker_date($worker, $start, $end)
 {
     $start = $start. " 00:00:00";
     $end = $end." 23:59:59";
     
     $this->db->select("date(gemstone_back.dateadd) as day1, COUNT(*) as sum1, (COUNT(*)*factor) as sum2");
     $this->db->from('gemstone_back');
     $this->db->join('gemstone_barcode', 'gemstone_barcode.id=gemstone_back.barcode','left');
     $this->db->join('gemstone', 'gemstone.id=gemstone_barcode.gemstone_id','left');
     $this->db->join('worker', 'worker.id=gemstone_back.worker','left');
     $this->db->join('process_type','process_type.id=gemstone.process_type','left');
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
     
     $this->db->select("process_type.id as pid, process_type.name as pname, COUNT(*) as sum1, (COUNT(*)*factor) as sum2");
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

     $this->db->select("status, COUNT(*) as sum1, (COUNT(*)*factor) as sum2");
     $this->db->from('gemstone_back');
     $this->db->join('gemstone_barcode', 'gemstone_barcode.id=gemstone_back.barcode','left');
     $this->db->join('gemstone', 'gemstone.id=gemstone_barcode.gemstone_id','left');
     $this->db->join('worker', 'worker.id=gemstone_back.worker','left');
     $this->db->join('process_type','process_type.id=gemstone.process_type','left');
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