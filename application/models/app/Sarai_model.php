<?php

class Sarai_model extends CI_Model{

//becario  idBe
    public function ver_Sarai(){

        $this->db->select("*");
        $this->db->where("estatus",1);
        $this->db->or_where("estatus",0);
        $rs = $this->db->get("sarai");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function inserta_Sarai($data){
        
        $this->db->insert("sarai",$data);
        return $this->db->affected_rows() >=1;

    }

    public function update_Sarai($data, $id){
        
        $this->db->where("idSara",$id);
        $this->db->update("sarai", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function estatus_Sarai($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("idSara", $id);
        $this->db->update("sarai");
        return $this->db->affected_rows() >0;

    }

    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idSara",$id);
        $this->db->update("sarai");
        return $this->db->affected_rows() >0;

    }

} //termina modelo


?>