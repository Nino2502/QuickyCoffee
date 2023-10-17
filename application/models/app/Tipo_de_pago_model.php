<?php

class Tipo_de_pago_model extends CI_Model{


    public function ver_tipo_de_pago(){

        $this->db->select("*");
        $this->db->where("estatus",1);
        $this->db->or_where("estatus",0);
        $rs = $this->db->get("formaDePago");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function inserta_Tipo_De_Pago($data){
        
        $this->db->insert("formaDePago",$data);
        return $this->db->affected_rows() >=1;

    }

    public function update_Tipo_De_Pago($data, $id){
        
        $this->db->where("idFP",$id);
        $this->db->update("formaDePago", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function estatus_Tipo_De_pago($id){

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