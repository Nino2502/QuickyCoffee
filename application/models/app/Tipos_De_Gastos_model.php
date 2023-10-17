<?php

class Tipos_De_Gastos_model extends CI_Model{


    public function ver_Tipos_De_Gastos(){

        $this->db->select("*");
        $this->db->where("estatus",1);
        $this->db->or_where("estatus",0);
        $rs = $this->db->get("tiposDeGastos");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function inserta_Tipos_De_Gastos($data){
        
        $this->db->insert("tiposDeGastos",$data);
        return $this->db->affected_rows() >=1;

    }

    public function update_Tipos_De_Gastos($data, $id){
        
        $this->db->where("idTG",$id);
        $this->db->update("tiposDeGastos", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function estatus_Tipos_De_Gastos($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("idTG", $id);
        $this->db->update("tiposDeGastos");
        return $this->db->affected_rows() >0;

    }

    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idTG",$id);
        $this->db->update("tiposDeGastos");
        return $this->db->affected_rows() >0;

    }

} //termina modelo


?>