<?php

class Especialidad_colaborador_model extends CI_Model{


    public function verEspecialidades(){

      
        $this->db->select("*");
        $this->db->where("estatus",1);
        $this->db->where("idEsp !=", "1");
        $this->db->or_where("estatus",0);
        $rs = $this->db->get("especialidades");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function inserta_Especialidad_Colaborador($data){
        $this->db->insert("especialidades", $data);
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function update_Especialidad_Colaborador($data, $id){
        $this->db->where("idEsp", $id);
        $this->db->update("especialidades", $data);
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function changeStatus1($changeData){
        $status           = $changeData['status'];
        $idEsp             = $changeData['idEsp']; 
    
        $cmd = $this->db->query(
        "UPDATE especialidades
             SET estatus = 0

             WHERE estatus       = $status AND
             idEsp          = $idEsp      
                    
             ");
            return $cmd;
    }
    public function changeStatus0($changeData){
        $status           = $changeData['status'];
        $idEsp             = $changeData['idEsp']; 
    
        $cmd = $this->db->query(
        "UPDATE especialidades
             SET estatus = 1

             WHERE estatus       = $status AND
             idEsp          = $idEsp      
                    
             ");
            return $cmd;
    }
    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idEsp",$id);
        $this->db->update("especialidades");
        return $this->db->affected_rows() >0;

    }




}


?>
