<?php

class Perfil_colaboradores_model extends CI_Model{


    public function ver_tipo_colaboradores(){

      
        $this->db->select("*");
        $this->db->where("estatus",1);
        $this->db->or_where("estatus",0);
        $rs = $this->db->get("tipoPerfil");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function inserta_Perfil_Colaborador($data){
        $this->db->insert("tipoPerfil", $data);
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function update_Perfil_Colaborador($data, $id){
        $this->db->where("idTP", $id);
        $this->db->update("tipoPerfil", $data);
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function changeStatus1($changeData){
        $status           = $changeData['status'];
        $idTP             = $changeData['idTP']; 
    
        $cmd = $this->db->query(
        "UPDATE tipoPerfil
             SET estatus = 0

             WHERE estatus       = $status AND
             idTP          = $idTP      
                    
             ");
            return $cmd;
    }
    public function changeStatus0($changeData){
        $status           = $changeData['status'];
        $idTP             = $changeData['idTP']; 
    
        $cmd = $this->db->query(
        "UPDATE tipoPerfil
             SET estatus = 1

             WHERE estatus       = $status AND
             idTP          = $idTP      
                    
             ");
            return $cmd;
    }
    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idTP",$id);
        $this->db->update("tipoPerfil");
        return $this->db->affected_rows() >0;

    }




}


?>
