<?php

class Luis_model extends CI_Model{


    public function ver_BLuis(){

        $this->db->select("*");
        $this->db->where("estatus",1);
        $this->db->or_where("estatus",0);
        $rs = $this->db->get("becario");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function inserta_BLuis($data){
        
        $this->db->insert("becario",$data);
        return $this->db->affected_rows() >=1;

    }

    public function update_BLuis($data, $id){
        
        $this->db->where("idBe",$id);
        $this->db->update("becario", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function estatus_BLuis($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("idBe", $id);
        $this->db->update("becario");
        return $this->db->affected_rows() >0;

    }

    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idBe",$id);
        $this->db->update("becario");
        return $this->db->affected_rows() >0;

    }

} //termina modelo


?>