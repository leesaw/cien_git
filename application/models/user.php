<?php
Class User extends CI_Model
{
 function login($username, $password)
 {
   $this -> db -> select('id, username, password, firstname, lastname, status');
   $this -> db -> from('users');
   $this -> db -> where('username', $username);
   $this -> db -> where('password', MD5($password));
   $this -> db -> limit(1);

   $query = $this -> db -> get();

   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }
 
function checkpass($id, $password)
 {
   $this -> db -> select('username');
   $this -> db -> from('users');
   $this -> db -> where('id', $id);
   $this -> db -> where('password', $password);
   $this -> db -> limit(1);

   $query = $this -> db -> get();

   if($query -> num_rows() == 1)
   {
     return true;
   }
   else
   {
     return false;
   }
 }
 
 function getUsers()
 {
	$this->db->select("id, username, firstname, lastname, status");
	$this->db->order_by("id", "asc");
	$this->db->from('users');	
	$this->db->where('status >', 0);
	$query = $this->db->get();		
	return $query->result();
 }
 
 function getOneUser($id=NULL)
 {
	$this->db->select("id, username, firstname, lastname, status");
	$this->db->order_by("id", "asc");
	$this->db->from('users');			
	$this->db->where('id', $id);	
	$query = $this->db->get();		
	return $query->result();
 }
 
 function addUser($user=NULL)
 {		
	$this->db->insert('users', $user);
	return $this->db->insert_id();			
 }
 
 function delUser($id=NULL)
 {
	$this->db->where('id', $id);
	$this->db->delete('users'); 
 }
 
 function editUser($user=NULL)
 {
	$this->db->where('id', $user['id']);
	unset($user['id']);
	$query = $this->db->update('users', $user); 	
	return $query;
 }
 
 function banUser($id=NULL)
 {
	$this->db->where('id', $id);
	$user = array(
				'username' => "",
				'status' => 0
			);
	$query = $this->db->update('users', $user); 	
	return $query;
 }

}
?>

