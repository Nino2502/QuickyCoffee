<?php

class Aviso_De_Privacidad_model extends CI_Model{


    public function ver_Aviso_De_Privacidad(){

        $this->db->select("*");
        $this->db->where("estatus",1);
        $this->db->or_where("estatus",0);
        $rs = $this->db->get("avisoDePrivacidad");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function inserta_Aviso_De_Privacidad($data){
        
        $this->db->insert("avisoDePrivacidad",$data);
        return $this->db->affected_rows() >=1;

    }

    public function update_Aviso_De_Privacidad($data, $id){
        
        $this->db->where("idFP",$id);
        $this->db->update("avisoDePrivacidad", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function estatus_Aviso_De_Privacidad($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("idFP", $id);
        $this->db->update("avisoDePrivacidad");
        return $this->db->affected_rows() >0;

    }

    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idFP",$id);
        $this->db->update("avisoDePrivacidad");
        return $this->db->affected_rows() >0;

    }

} //termina modelo


?>