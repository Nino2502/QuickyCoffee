<?php

class Preguntas_diagnosticas_model extends CI_Model{


    public function ver_preguntas_diagnosticas(){

        $this->db->select("*");
        $this->db->where("preguntasDiagnostico.estatus",1);
        $this->db->or_where("preguntasDiagnostico.estatus",0);
        $this->db->join('tiposCampos', 'tiposCampos.idTCampos = preguntasDiagnostico.idTCampos');
        $rs = $this->db->get("preguntasDiagnostico");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function inserta_preguntas_diagnosticas($data){
        
        $this->db->insert("preguntasDiagnostico",$data);
        return $this->db->affected_rows() >=1;

    }

    public function update_preguntas_diagnosticas($data, $id){
        
        $this->db->where("idPD",$id);
        $this->db->update("preguntasDiagnostico", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function estatus_preguntas_diagnosticas($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("idPD", $id);
        $this->db->update("preguntasDiagnostico");
        return $this->db->affected_rows() >0;

    }

    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idPD",$id);
        $this->db->update("preguntasDiagnostico");
        return $this->db->affected_rows() >0;

    }

} //termina modelo


?>