<?php

class Ordenes_De_Servicios_model extends CI_Model{


    public function ver_Ordenes_De_Servicios(){

        $this->db->select("*");
        $this->db->where("estatus",1);
        $this->db->or_where("estatus",0);
        $rs = $this->db->get("venta");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function inserta_Ordenes_De_Servicios($data){
        
        $this->db->insert("Ordenes_De_Servicios",$data);
        return $this->db->affected_rows() >=1;

    }

    public function update_Ordenes_De_Servicios($data, $id){
        
        $this->db->where("idVenta",$id);
        $this->db->update("venta", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function estatus_Ordenes_De_Servicios($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("idVenta", $id);
        $this->db->update("venta");
        return $this->db->affected_rows() >0;

    }

    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idVenta",$id);
        $this->db->update("venta");
        return $this->db->affected_rows() >0;

    }

} //termina modelo


?>