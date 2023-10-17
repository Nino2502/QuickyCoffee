<?php

class AgrupaPreguntasDiagnosticas_model extends CI_Model{


    public function ver_agrupa_preguntas_diagnosticas(){

        $this->db->select("*");
        $this->db->where("estatus",1);
        $this->db->or_where("estatus",0);
        $rs = $this->db->get("formDiagnostico");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }


    public function vista_previa($id){
        $cmd =
        'SELECT *  FROM formDiagPregDiag JOIN preguntasDiagnostico USING(idPD) where idFormD ='. $id ;

        $query = $this->db->query($cmd);
        return $query->num_rows() > 0 ? $query->result() : null;

    }

    public function inserta_nombre_agrupacion($data){
        
        $this->db->insert("formDiagnostico",$data);
        return $this->db->insert_id();

    }


    public function inserta_agrupa_preguntas_diagnosticas($data){
        
        $this->db->insert("formDiagPregDiag",$data);
        return $this->db->affected_rows() >=1 ;

    }


    public function update_agrupa_preguntas_diagnosticas($data, $id){
        
        $this->db->where("idFormD",$id);
        $this->db->update("formDiagnostico", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function eliminaAgrupacion($id){
        $this->db->where('idFormD', $id);
        $this->db->delete('formDiagPregDiag');
        return $this->db->affected_rows() >0;

    }




    public function estatus_agrupa_preguntas_diagnosticas($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("idFormD", $id);
        $this->db->update("formDiagnostico");
        return $this->db->affected_rows() >0;

    }

    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idFormD",$id);
        $this->db->update("formDiagnostico");
        return $this->db->affected_rows() >0;

    }

} //termina modelo


?>