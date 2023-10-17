<?php

class Clientes_model extends CI_Model{

    public function get_Clientes(){  
        
        $this->db->select('*');
        $this->db->where('idTU', 4);

        $rs = $this->db->get("usuarios");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function get_Clientes_con_Ventas() {
        $subquery = $this->db->select('idCliente')->from('Ventas')->get_compiled_select();
        $this->db->select('*');
        $this->db->where('idTU', 4);
        $this->db->where("idU IN ($subquery)", NULL, FALSE);
        $rs = $this->db->get("usuarios");
        return $rs->num_rows() >0 ? $rs->result() : null;
    }

    public function get_Ventas($id){  
        
        $this->db->select('*');
        $this->db->where('idCliente', $id);

        $rs = $this->db->get("ventas");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function estatus_Cliente($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("idU", $id);
        $this->db->update("usuarios");
        return $this->db->affected_rows() >0;

    }

    public function update_usuario_colaborador($data, $id){
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
        $cmd = $this->db->query('SELECT d.*, s.*, u.nombreU FROM `domicilios` as d INNER JOIN sucursales as s on d.idD = s.idD INNER JOIN usuarios as u on u.idU = d.idU where d.estatus != 3 ');
    
      
        return $cmd->num_rows() >0 ? $cmd->result() : null;

    }   
    public function registerAddress ($AddressData){
        $this->db->insert("domicilios", $AddressData);
        return $this->db->insert_id();
        
    }

    public function updateDomFiscal($idU){
        $cmd = $this->db->query("UPDATE domicilios set domFiscal = 0 where idU IN ($idU)");
        return $cmd;
    }
    public function ve_my_sucursal($arrData){
       
        $idSuc = $arrData['idSuc'];

        $cmd = $this->db->query("SELECT u.nombreU,u.apellidos,u.rfc, s.* FROM usuarios as u INNER JOIN sucursales as s on u.idU = s.idU WHERE  s.idSuc = $idSuc");

        return $cmd->num_rows() >0 ? $cmd->row() : null;
    } 
    public function updateSucursal($arrData){
        $idU            = $arrData['idU'];
        $calle          = $arrData['calle'];
        $numeroExterior = $arrData['numeroExterior'];
        $numeroInterior = $arrData['numeroInterior'];
        $codigoPostal   = $arrData['codigoPostal'];
        $municipio      = $arrData['municipio'];
        $estado         = $arrData['estado'];
        $descripcion    = $arrData['descripcion'];
        $domFiscal      = $arrData['domFiscal'];
        $idD            = $arrData['idD'];
        $nombreSuc      = $arrData['nombreSuc'];

        $cmd = $this->db->query("UPDATE domicilios as d INNER JOIN  sucursales as s ON s.idD = d.idD set  d.idU = $idU ,d.calle  = '$calle', 
        d.numeroExterior = '$numeroExterior' ,d.numeroInterior = '$numeroInterior'  , 
        d.codigoPostal   = '$codigoPostal'   ,d.municipio      = '$municipio'       , d.estado = '$estado',
        d.descripcion    = '$descripcion'    ,d.domFiscal      = $domFiscal       , s.idU = $idU,
        s.nombreSuc      =  '$nombreSuc'
        
        where d.idD = $idD");
       
       return $cmd;
    }
    public function SuCchangeStatus1($arrData){
    
        $idD             = $arrData['idD']; 
    
        $cmd = $this->db->query(
        "UPDATE domicilios
             SET estatus = 0
             WHERE 
                idD          = $idD      
                    
             ");
            return $cmd;
    }
    public function SuCchangeStatus0($arrData){
   
        $idD             = $arrData['idD']; 

        $cmd = $this->db->query(
        "UPDATE domicilios
             SET estatus = 1

             WHERE
             idD          = $idD      
                    
             ");
            return $cmd;
    }
    public function registroSuc($nombreSuc, $rs, $idU){
       
        $cmd = $this->db->query("INSERT INTO sucursales (nombreSuc,idU, idD) VALUES ('$nombreSuc',$idU,$rs)");
        return $cmd;
        

    }
    public function borradoLogicoSuc($idD){
        
        $this->db->set("estatus","3");
        $this->db->where("idD",$idD);
        $this->db->update("domicilios");
        return $this->db->affected_rows() >0;

    }

} //termina modelo
