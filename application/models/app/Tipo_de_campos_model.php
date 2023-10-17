<?php

class Tipo_de_campos_model extends CI_Model{


    public function ver_tipos_de_campos(){

        $this->db->select("*");
        $this->db->where("estatus",1);
        $this->db->or_where("estatus",0);
        $rs = $this->db->get("tiposCampos");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }


    public function ver_tipo_de_campo($id){

        $this->db->select("*");
        $this->db->where("idTCampos",$id);
        $this->db->where("estatus",1);
        $this->db->or_where("estatus",0);
        $rs = $this->db->get("tiposCampos");
        return $rs->num_rows() >0 ? $rs->row() : null;

    }


    public function inserta_tipos_de_campos($data){
        
        $this->db->insert("tiposCampos",$data);
        return $this->db->affected_rows() >=1;

    }

    public function update_tipos_de_campos($data, $id){
        
        $this->db->where("idTCampos",$id);
        $this->db->update("tiposCampos", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function estatus_tipos_de_campos($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("idTCampos", $id);
        $this->db->update("tiposCampos");
        return $this->db->affected_rows() >0;

    }

    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idTCampos",$id);
        $this->db->update("tiposCampos");
        return $this->db->affected_rows() >0;

    }

} //termina modelo


?>