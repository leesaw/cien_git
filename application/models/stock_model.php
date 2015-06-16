<?php
Class Stock_model extends CI_Model
{
    function addStock($gemstone)
    {
        $this->db->insert('gemstone_stock', $gemstone);
        return $this->db->insert_id();	
    }
    
    function delGem($id=NULL)
    {
        $gem = array('disable'=>1);
        $this->db->where('id',$id);
        $query = $this->db->update('gemstone_stock', $gem); 
    }
    
    function getStone_out($id=NULL)
    {
        $this->db->select('');
        $this->db->from('gemstone');
        $this->db->join('gemstone_stock', 'gemstone_stock.id=gemstone.stockid','left');
        $query = $this->db->get();		
        return $query->result();
    }
    
    function getStone_purchase($id)
    {
        $this->db->select("supplier.name as supname,supplier.id as supid,lot,carat,gemstone_type.name as gemtype, gemstone_type.id as typeid, gemstone_type.barcode as typebarcode, gemstone_stock.size as gemsize, order_type, gemstone_stock.amount as stockamount, gemstone_stock.carat as gemcarat,(gemstone_stock.amount - gemstone_stock.amount_out) as remain, gemstone_stock.id as bid, date_format(gemstone_stock.datein,'%d/%m/%y') as datein", FALSE);
        $this->db->from('gemstone_stock');
        $this->db->join('supplier', 'gemstone_stock.supplier=supplier.id','left');
        $this->db->join('gemstone_type', 'gemstone_type.id=gemstone_stock.type','left');
        $this->db->where('gemstone_stock.id', $id);
        $query = $this->db->get();		
        return $query->result();
    }
    
    function editAmountCaratOut($stock=NULL)
    {
        $this->db->where('id', $stock['id']);
        unset($stock['id']);
        $query = $this->db->update('gemstone_stock', $stock); 	
        return $query;
    }
}
?>