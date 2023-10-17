<?php

class Jesus_model extends CI_Model{


    public function ver_Jesus(){

        $this->db->select("*");
        $this->db->where("Estatus",1);
        $this->db->or_where("Estatus",0);
        $rs = $this->db->get("jesus");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function inserta_Jesus($data){
        
        $this->db->insert("jesus",$data);
        return $this->db->affected_rows() >=1;

    }

	
    public function update_Jesus($data, $id){
        
        $this->db->where("idjesus",$id);
        $this->db->update("jesus", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function estatus_Jesus($id){

        $this->db->set("Estatus", "1 - Estatus", false);
        $this->db->where("idjesus", $id);
        $this->db->update("jesus");
        return $this->db->affected_rows() >0;

    }

    public function borradoLogico($id){

        $this->db->set("Estatus", "3");
        $this->db->where("idjesus",$id);
        $this->db->update("jesus");
        return $this->db->affected_rows() >0;

    }

} //termina modelo


?>