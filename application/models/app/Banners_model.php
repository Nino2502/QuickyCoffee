<?php

class Banners_model extends CI_Model{


    public function ver_Banners(){

        $this->db->select("*");
        $this->db->where("estatus",1);
        $this->db->or_where("estatus",0);
        $rs = $this->db->get("banners");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function inserta_Banners($data){
        
        $this->db->insert("banners",$data);
        return $this->db->affected_rows() >=1;

    }

    public function update_Banners($data, $id){
        
        $this->db->where("idBan",$id);
        $this->db->update("banners", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function estatus_Banners($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("idBan", $id);
        $this->db->update("banners");
        return $this->db->affected_rows() >0;

    }

    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idBan",$id);
        $this->db->update("banners");
        return $this->db->affected_rows() >0;

    }
	
	
	 public function single_entry($id)
    {
        $this->db->select('*');
        $this->db->from('banners');
        $this->db->where('idBan', $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }
	
	
		 public function numero_Max_Banner()
    {
        $this->db->select_max('orden');
        $rs = $this->db->get("banners");
        return $rs->num_rows() >0 ? $rs->result() : null;
    }
	
	
	public function ver_BannersPublic(){

        $this->db->select("*");
        $this->db->where("estatus",1);
        $this->db->order_by('orden', 'ASC');
        $rs = $this->db->get("banners");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }
	
	
	
	

} //termina modelo


?>