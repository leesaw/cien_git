<?php
Class Worker_model extends CI_Model
{
 function getWorker($barcode)
 {
	$this->db->select("id");
	$this->db->from('worker');	
    $this->db->where('worker_id', $barcode);
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
    
 function addGemstone($gemstone=NULL)
 {		
	$this->db->insert('gemstone', $gemstone);
	return $this->db->insert_id();			
 }
    
 function checkBarcode_Worker($barcode)
 {
    $this->db->select("id");
	$this->db->from('worker');		
	$this->db->where('worker_id', $barcode);
	$query = $this->db->get();		
	return $query->num_rows();
 }
    


}
?>