<?php

class PreguntasMesaFAQS_model extends CI_Model{


    public function ver_preguntas_MesaFAQS(){

        $this->db->select("*");
        $this->db->where("estatus",1);
        $this->db->or_where("estatus",0);
        $rs = $this->db->get("preguntaRespuestaAT");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function inserta_preguntas_MesaFAQS($data){
        
        $this->db->insert("preguntaRespuestaAT",$data);
        return $this->db->affected_rows() >=1;

    }

    public function update_preguntas_MesaFAQS($data, $id){
        
        $this->db->where("idPRAT",$id);
        $this->db->update("preguntaRespuestaAT", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function estatus_preguntas_MesaFAQS($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("idPRAT", $id);
        $this->db->update("preguntaRespuestaAT");
        return $this->db->affected_rows() >0;

    }

    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idPRAT",$id);
        $this->db->update("preguntaRespuestaAT");
        return $this->db->affected_rows() >0;

    }

} //termina modelo


?>