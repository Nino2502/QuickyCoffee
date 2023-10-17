<?php

class Unidades_model extends CI_Model{


    public function ver_Unidades(){

        $this->db->select("*");
        $this->db->where("estatus",1);
        $this->db->or_where("estatus",0);
        $rs = $this->db->get("unidades");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function inserta_Unidades($data){
        
        $this->db->insert("unidades",$data);
        return $this->db->affected_rows() >=1;

    }

    public function update_Unidades($data, $id){
        
        $this->db->where("idUni",$id);
        $this->db->update("unidades", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function estatus_Unidades($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("idUni", $id);
        $this->db->update("unidades");
        return $this->db->affected_rows() >0;

    }

    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idUni",$id);
        $this->db->update("unidades");
        return $this->db->affected_rows() >0;

    }

} //termina modelo


?>