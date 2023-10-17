<?php

class Agrupaciones_Servicios_model extends CI_Model{


    public function ver_agrupaciones_servicios(){

        $this->db->select("*");
        $this->db->where("estatus",1);
        $this->db->or_where("estatus",0);
        $rs = $this->db->get("agrupacionServicio");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function inserta_agrupaciones_servicios($data){
        
        $this->db->insert("agrupacionServicio",$data);
        return $this->db->affected_rows() >=1;

    }

    public function update_agrupaciones_servicios($data, $id){
        
        $this->db->where("idAgrupacionS",$id);
        $this->db->update("agrupacionServicio", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function estatus_agrupaciones_servicios($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("idAgrupacionS", $id);
        $this->db->update("agrupacionServicio");
        return $this->db->affected_rows() >0;

    }

    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idAgrupacionS",$id);
        $this->db->update("agrupacionServicio");
        return $this->db->affected_rows() >0;

    }

} //termina modelo


?>