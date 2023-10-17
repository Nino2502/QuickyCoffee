<?php

class Editar_perfil_model extends CI_Model{


    public function ver_Editar_perfil(){

        $this->db->select("*");
        $this->db->where("estatus",1);
        $this->db->or_where("estatus",0);
        $rs = $this->db->get("formaDePago");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function inserta_Editar_perfil($data){
        
        $this->db->insert("formaDePago",$data);
        return $this->db->affected_rows() >=1;

    }

    public function update_Editar_perfil($data, $id){
        
        $this->db->where("idFP",$id);
        $this->db->update("formaDePago", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function estatus_Editar_perfil($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("idFP", $id);
        $this->db->update("formaDePago");
        return $this->db->affected_rows() >0;

    }

    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idFP",$id);
        $this->db->update("formaDePago");
        return $this->db->affected_rows() >0;

    }

} //termina modelo


?>