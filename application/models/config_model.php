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
    
    function editConfig($config)
    {
        $this->db->where('config', $user['config']);
        unset($config['config']);
        $query = $this->db->update('config', $config); 	
        return $query;
    }

}
?>