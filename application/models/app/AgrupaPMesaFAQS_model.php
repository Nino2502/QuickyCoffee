<?php

class AgrupaPMesaFAQS_model extends CI_Model{


    public function ver_agrupa_preguntas_mesaFAQS(){

        $this->db->select("*");
        $this->db->where("estatus",1);
        $this->db->or_where("estatus",0);
        $rs = $this->db->get("ayudaTecnica");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }


    public function vista_previa($id){
        $cmd =
        'SELECT *  FROM detalleAT JOIN preguntaRespuestaAT USING(idPRAT) where idAT ='. $id ;

        $query = $this->db->query($cmd);
        return $query->num_rows() > 0 ? $query->result() : null;

    }

    public function inserta_nombre_agrupacion($data){
        
        $this->db->insert("ayudaTecnica",$data);
        return $this->db->insert_id();

    }


    public function inserta_agrupa_preguntas_mesaFAQS($data){
        
        $this->db->insert("detalleAT",$data);
        return $this->db->affected_rows() >=1 ;

    }


    public function update_agrupa_preguntas_mesaFAQS($data, $id){
        
        $this->db->where("idAT",$id);
        $this->db->update("ayudaTecnica", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function borra_agrupa_preguntas_mesaFAQS($id){

        $this->db->where('idAT', $id);
        $this->db->delete('detalleAT');
        return $this->db->affected_rows() >=1;
        
    }





    public function estatus_agrupa_preguntas_mesaFAQS($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("idAT", $id);
        $this->db->update("ayudaTecnica");
        return $this->db->affected_rows() >0;

    }

    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idAT",$id);
        $this->db->update("ayudaTecnica");
        return $this->db->affected_rows() >0;

    }

} //termina modelo


?>