<?php

class Modulos_model extends CI_Model{


    public function ver_Modulos(){

        $this->db->select("*");
        $this->db->where("estatus",1);
        $this->db->or_where("estatus",0);
        $this->db->order_by("orden");
        $rs = $this->db->get("modulos");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function inserta_Modulos($data){ 
        
        $this->db->insert("modulos",$data);
        return $this->db->affected_rows() >=1;

    }

    public function update_Modulos($data, $id){
        
        $this->db->where("modulo_id",$id);
        $this->db->update("modulos", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function estatus_Modulos($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("modulo_id", $id);
        $this->db->update("modulos");
        return $this->db->affected_rows() >0;

    }

    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("modulo_id",$id);
        $this->db->update("modulos");
        return $this->db->affected_rows() >0;

    }

} //termina modelo
