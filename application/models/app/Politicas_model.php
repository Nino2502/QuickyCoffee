<?php

class Politicas_model extends CI_Model{


    public function ver_Politicas(){

        $this->db->select("*");
        $this->db->where("estatus",1);
        $this->db->or_where("estatus",0);
        $rs = $this->db->get("politicas");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function inserta_Politicas($data){
        
        $this->db->insert("politicas",$data);
        return $this->db->affected_rows() >=1;

    }

    public function update_Politicas($data, $id){
        
        $this->db->where("idPol",$id);
        $this->db->update("politicas", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function estatus_Politicas($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("idPol", $id);
        $this->db->update("politicas");
        return $this->db->affected_rows() >0;

    }

    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idPol",$id);
        $this->db->update("politicas");
        return $this->db->affected_rows() >0;

    }

} //termina modelo


?>