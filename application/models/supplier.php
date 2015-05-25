<?php
Class Supplier extends CI_Model
{
 function getSupplier()
 {
	$this->db->select("id, name, barcode");
	$this->db->order_by("id", "asc");
	$this->db->from('supplier');	
	$query = $this->db->get();		
	return $query->result();
 }

 function addSupplier($supplier=NULL)
 {		
	$this->db->insert('supplier', $supplier);
	return $this->db->insert_id();			
 }
 
 function delSupplier($id=NULL)
 {
	$this->db->where('id', $id);
	$this->db->delete('supplier'); 
 }
 
 function editSupplier($supplier=NULL)
 {
	$this->db->where('id', $supplier['id']);
	unset($supplier['id']);
	$query = $this->db->update('supplier', $supplier); 	
	return $query;
 }
 
 function checkName($name)
 {
    $this->db->select("id");
	$this->db->from('supplier');		
	$this->db->where('name', $name);
	$query = $this->db->get();		
	return $query->num_rows();
 }
    

}
?>

