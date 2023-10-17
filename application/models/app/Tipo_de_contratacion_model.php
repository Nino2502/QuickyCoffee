<?php

class Tipo_de_contratacion_model extends CI_Model{


    public function ver_tipo_contratacion(){

      
        $this->db->select("*");
        $this->db->where("estatus",1);
        $this->db->or_where("estatus",0);
        $rs = $this->db->get("tipoDeContratacion");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function inserta_Tipo_De_Contratacion($data){
        $this->db->insert("tipoDeContratacion", $data);
        return $this->db->affected_rows() > 0 ? true : false;
    }
    public function update_Tipo_Contratacion($data, $id){
        $this->db->where("idTC", $id);
        $this->db->update("tipoDeContratacion", $data);
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function changeStatus1($changeData){
        $status           = $changeData['status'];
        $idTC             = $changeData['idTC']; 
    
        $cmd = $this->db->query(
        "UPDATE tipoDeContratacion
             SET estatus = 0

             WHERE estatus       = $status AND
                   idTC          = $idTC      
                    
             ");
            return $cmd;
    }
    public function changeStatus0($changeData){
        $status           = $changeData['status'];
        $idTC             = $changeData['idTC']; 
    
        $cmd = $this->db->query(
        "UPDATE tipoDeContratacion
             SET estatus = 1

             WHERE estatus       = $status AND
                   idTC          = $idTC      
                    
             ");
            return $cmd;
    }
    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idTC",$id);
        $this->db->update("tipoDeContratacion");
        return $this->db->affected_rows() >0;

    }




}


?>
