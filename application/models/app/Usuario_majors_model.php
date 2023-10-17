<?php

class Usuario_majors_model extends CI_Model{


    public function ver_lista_majors(){

      
        $cmd = $this->db->query('SELECT * FROM usuarios WHERE idTU = 2 AND idP = 1  AND estatus != 3');
    
      
        return $cmd->num_rows() >0 ? $cmd->result() : null;

    }

    public function inserta_usuario_colaborador($NuevaData){
        $this->db->insert("usuarios", $NuevaData);
        return $this->db->affected_rows() > 0 ? true : false;
        
    }
    public function update_Tipo_Contratacion($data, $id){
        $this->db->where("idU", $id);
        $this->db->update("usuarios", $data);
        return $this->db->affected_rows() > 0 ? true : false;
    }
    public function validarCorreo($correo){
      
        $this->db->select("*");
        $this->db->where("correo",$correo);
        $rs = $this->db->get("usuarios");
       
         return $rs->num_rows() >= 1 ? $rs->row() : null;

    }

    public function validarTelefono($telefono){
      
        $this->db->select("*");
        $this->db->where("telefono",$telefono);
        $rs = $this->db->get("usuarios");
       
         return $rs->num_rows() >= 1 ? $rs->row() : null;

    }
    public function changeStatus1($changeData){
        $status           = $changeData['status'];
        $idU             = $changeData['idU']; 
    
        $cmd = $this->db->query(
        "UPDATE usuarios
             SET estatus = 0

             WHERE estatus       = $status AND
                   idU          = $idU      
                    
             ");
            return $cmd;
    }
    public function changeStatus0($changeData){
        $status           = $changeData['status'];
        $idU             = $changeData['idU']; 
    
        $cmd = $this->db->query(
        "UPDATE usuarios
             SET estatus = 1

             WHERE estatus       = $status AND
                   idU          = $idU      
                    
             ");
            return $cmd;
    }
    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idU",$id);
        $this->db->update("usuarios");
        return $this->db->affected_rows() >0;

    }

    public function ver_lista_tipoUsuario(){
        $this->db->select("*");
        $this->db->where("estatus",1);    
        $rs = $this->db->get("tipoUsuario");
                     return $rs->num_rows() >0 ? $rs->result() : null;
    }
   
    public function ver_lista_sucursales(){
        $cmd = $this->db->query('SELECT d.*, s.* FROM `domicilios` as d INNER JOIN sucursales as s on d.idU = s.idU');
    
      
        return $cmd->num_rows() >0 ? $cmd->result() : null;

    }   
    public function registerAddress ($AddressData){
        $this->db->insert("domicilios", $AddressData);
        return $this->db->affected_rows() > 0 ? true : false;
        
    }

    public function updateDomFiscal($idU){
        $cmd = $this->db->query("UPDATE domicilios set domFiscal = 0 where idU IN ($idU)");
        return $cmd;
    }

}


?>
