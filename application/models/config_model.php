<?php
Class Config_model extends CI_Model
{
    function getConfig($config)
    {
        $this->db->select("value");
        $this->db->from("config");
        $this->db->where("config", $config);
        $query = $this->db->get();		
        return $query->result();
    }
    
    function editConfig($temp)
    {
        $this->db->where('config', $temp['config']);
        unset($temp['config']);
        $query = $this->db->update('config', $temp); 	
        return $query;
    }
    
    function getAllconfig()
    {
        $this->db->select("config,value");
        $this->db->from("config");
        $query = $this->db->get();		
        return $query->result();
    }

}
?>