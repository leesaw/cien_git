<?php
Class Stock_model extends CI_Model
{
    function addStock($gemstone)
    {
        $this->db->insert('gemstone_stock', $gemstone);
        return $this->db->insert_id();	
    }
    
    function addStockCut($gemstone)
    {
        $this->db->insert('stock_cut', $gemstone);
        return $this->db->insert_id();	
    }
    
    function addStockSplit($gemstone)
    {
        $this->db->insert('stock_split', $gemstone);
        return $this->db->insert_id();	
    }
    
    function editStock($temp)
    {
        $this->db->where('id', $temp['id']);
        unset($temp['id']);
        $query = $this->db->update('gemstone_stock', $temp); 	
        return $query;   
    }
    
    function delGem($id=NULL)
    {
        $gem = array('disable'=>1);
        $this->db->where('id',$id);
        $query = $this->db->update('gemstone_stock', $gem); 
    }
    
    function delSplitStock($id=NULL)
    {
        $gem = array('disable'=>1);
        $this->db->where('id',$id);
        $query = $this->db->update('stock_split', $gem); 
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
        $this->db->select("gemstone_stock.stone_type as stonetype, supplier.name as supname,supplier.id as supid,color,lot,carat,gemstone_type.name as gemtype, gemstone_type.id as typeid, gemstone_type.barcode as typebarcode, gemstone_stock.size as gemsize, order_type, gemstone_stock.amount as stockamount, gemstone_stock.carat as gemcarat, gemstone_stock.kilogram as gemkilogram, (gemstone_stock.amount - gemstone_stock.amount_out) as remain,(gemstone_stock.carat - gemstone_stock.carat_out) as remaincarat, gemstone_stock.id as bid, date_format(gemstone_stock.datein,'%d/%m/%Y') as datein", FALSE);
        $this->db->from('gemstone_stock');
        $this->db->join('supplier', 'gemstone_stock.supplier=supplier.id','left');
        $this->db->join('gemstone_type', 'gemstone_type.id=gemstone_stock.type','left');
        $this->db->where('gemstone_stock.id', $id);
        $query = $this->db->get();	
        return $query->result();
    }
    
    function editAmountCaratOut($stock, $condition)
    {
        if ($condition=='plus') {
            $sql = "update gemstone_stock set amount_out=amount_out+".$stock['amount_out'].", carat_out=carat_out+".$stock['carat_out']." where id='".$stock['id']."'";
        }elseif ($condition=='minus') {
            $sql = "update gemstone_stock set amount_out=amount_out-".$stock['amount_out'].", carat_out=carat_out-".$stock['carat_out']." where id='".$stock['id']."'";
        }
        $query = $this->db->query($sql); 	
        return $query;
    }
    
    function editAmountCaratSplit($stock, $reason, $condition)
    {
        $reason = str_replace(" ", "", $reason);
        $reason = strtolower($reason);
        
        if ($condition=='plus') {
            $sql = "update gemstone_stock set amount_".$reason."=amount_".$reason."+".$stock['amount_out'].", carat_".$reason."=carat_".$reason."+".$stock['carat_out']." where id='".$stock['id']."'";
        }elseif ($condition=='minus') {
            $sql = "update gemstone_stock set amount_".$reason."=amount_".$reason."-".$stock['amount_out'].", carat_".$reason."=carat_".$reason."-".$stock['carat_out']." where id='".$stock['id']."'";
        }
        $query = $this->db->query($sql); 	
        return $query;
    }
    
    function getAmountCaratOut($gemid)
    {
        $this->db->select("stockid,amount,carat");
        $this->db->from("gemstone");
        $this->db->where("id", $gemid);
        $query = $this->db->get();	
        return $query->result();
    }
    
    function getStockOutList($stockid)
    {
        $this->db->select('gemstone.id as gemid, supplier.name as supname, number, lot, color, gemstone_type.name as gemtype, gemstone.size_out as size_out, size_in, carat, amount, gemstone.datepurchase as dateadd, min(no) as _min, max(no) as _max, process_type.name as process_name, process_detail, gemstone.barcode as barcode');
        $this->db->from('gemstone');
        $this->db->join('supplier', 'gemstone.supplier=supplier.id','left');
        $this->db->join('gemstone_type', 'gemstone_type.id=gemstone.type','left');
        $this->db->join('gemstone_barcode', 'gemstone_barcode.gemstone_id=gemstone.id', 'left');
        $this->db->join('process_type', 'process_type.id = gemstone.process_type', 'left');
        $this->db->group_by('gemstone.id');
        $this->db->where('disable != ',1);
        $this->db->where('stockid',$stockid);
        $query = $this->db->get();
        return $query->result();
    }
    
    function getStockCutList($stockid)
    {
        $this->db->select('dateadd, reason, detail, amount, carat');
        $this->db->from('stock_cut');
        $this->db->where('gemstone_stock_id',$stockid);
        $query = $this->db->get();
        return $query->result();
    }
    
    function getStockSplitList($stockid)
    {
        $this->db->select('id, dateadd, reason, detail, amount, carat');
        $this->db->from('stock_split');
        $this->db->where('disable', 0);
        $this->db->where('gemstone_stock_id',$stockid);
        $query = $this->db->get();
        return $query->result();
    }
    
    function getStockSplitOne($id)
    {
        $this->db->select('id, dateadd, reason, detail, amount, carat');
        $this->db->from('stock_split');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->result();
    }
    
    function getOut_reason()
    {
        $this->db->select("id, name");
        $this->db->from("stock_cut_reason");
        $query = $this->db->get();	
        return $query->result();
    }
    
    function getSplit_reason()
    {
        $this->db->select("id, name");
        $this->db->from("stock_split_reason");
        $query = $this->db->get();	
        return $query->result();
    }

}
?>