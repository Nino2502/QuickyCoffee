<?php

class Atributos_adicionales_model extends CI_Model{


    public function ver_lista_atributos(){

      
        $cmd = $this->db->query('SELECT * FROM atributos_adicionales WHERE estatus != 3');
    
      
        return $cmd->num_rows() >0 ? $cmd->result() : null;

    }

    public function inserta_nuevo_colaborador($NuevaData){
        $this->db->insert("atributos_adicionales", $NuevaData);
        return $this->db->affected_rows() > 0 ? true : false;
        
    }

    public function update_Tipo_Contratacion($data, $id){
        $this->db->where("idAtrD", $id);
        $this->db->update("atributos_adicionales", $data);
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
        $estatus           = $changeData['estatus'];
        $idAtrD             = $changeData['idAtrD']; 
    
        $cmd = $this->db->query(
        "UPDATE atributos_adicionales
             SET estatus = 0

             WHERE estatus       = $estatus AND
                   idAtrD          = $idAtrD      
                    
             ");
            return $cmd;
    }
    public function changeStatus0($changeData){
        $estatus           = $changeData['estatus'];
        $idAtrD             = $changeData['idAtrD']; 
    
    
        $cmd = $this->db->query(
        "UPDATE atributos_adicionales
             SET estatus = 1

             WHERE estatus       = $estatus AND
                   idAtrD          = $idAtrD     
                    
             ");
            return $cmd;
    }
    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idAtrD",$id);
        $this->db->update("atributos_adicionales");
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
