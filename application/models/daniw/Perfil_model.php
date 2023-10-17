<?php

class Perfil_model extends CI_Model{


    public function get_perfil($idUsuario){

        $this->db->select("*");
        $this->db->where("idU",$idUsuario);
        $rs = $this->db->get("usuarios");
        return $rs->num_rows() >= 1 ? $rs->row() : null;

    }

    public function infoShort($idUsuario){

      
        $this->db->select("nombreU, apellidos, telefono");
        $this->db->where("idU",$idUsuario);
        $rs = $this->db->get("usuarios");
        return $rs->num_rows() >= 1 ? $rs->row() : null;

    }
     
    // Query de datos fiscales
    public function get_DF($id){
  
        $this->db->select('*');
        $this->db->join('domicilios as d', 'df.idD = d.idD');
        $this->db->join('rFiscal as rf', 'rf.idRegimen = df.idRegimen1', "left");
        $this->db->join('usosCFDI as drf', 'drf.idUsoCFDI = df.idUsoCFDI', "left");
        $this->db->where('df.idU', $id);
        $this->db->where_in('df.estatus', array(0,1));
        $rs = $this->db->get("datosFiscales as df");
        return $rs->num_rows() > 0 ? $rs->result() : null;
        

    }
	
	
		//solo datos fiscales
	
	public function get_datosParaFactura($idU, $idRfc){
  
        $this->db->select('rSocial, RFC, correo, codigoPostal');
        
        $this->db->where('df.idU', $idU);
        $this->db->where('df.idFiscales', $idRfc);
		$this->db->JOIN('domicilios as d', 'df.idD = d.idD');
        $rs = $this->db->get("datosFiscales as df");
        return $rs->num_rows() > 0 ? $rs->result() : null;
        

    }
	
	
	
	
	
	

    // Query para insertar Datos Fiscales
    // public function insert_Fiscal($data){ 
        
    //     $this->db->insert("datosFiscales",$data);
    //     return $this->db->affected_rows() >= 1;

    // }
    public function insert_Fiscal($data){ 
        
        $this->db->insert("datosFiscales",$data);
        return $this->db->affected_rows() >= 1;

    }

    public function insert_Fiscal2($data, $idU){ 

        $this->db->set('orden', 0); 
        $this->db->where('idU', $idU); 
        $this->db->update('datosFiscales'); 
        
        $this->db->insert("datosFiscales",$data); 
        return $this->db->affected_rows() >= 1; 

    } 

    // Query para actualizar Datos Fiscales
    public function update_Fiscal($data, $id){
        
        $this->db->where("idFiscales",$id);
        $this->db->update("datosFiscales", $data);
        return $this->db->affected_rows() >=1 ;

    }
    public function update_Fiscal2($data, $id, $idU) {
        $this->db->set('orden', 0); 
        $this->db->where('idU', $idU); 
        $this->db->update('datosFiscales'); 

        $this->db->where("idFiscales",$id);
        $this->db->update("datosFiscales", $data);
    
        return $this->db->affected_rows() >= 1;
    } 

    public function get_Principal($id){ 

        $this->db->select("orden");
        $this->db->where("idU", $id);
        $this->db->where("orden", 1);
        $rs1 = $this->db->get("datosFiscales");

        return $rs1->num_rows() > 0 ? $rs1->result() : null;

    }

    // Query de datos Domicilio
    public function get_Domicilio($id){ 

        $this->db->select("*");
        $this->db->where("idU", $id);
        $this->db->where("estatus", 1);
        $rs = $this->db->get("domicilios");
        return $rs->num_rows() > 0 ? $rs->result() : null;

    }

    // Query de datos Regimen Fiscal
    public function get_rFiscal(){ 

        $this->db->select("*");
        $this->db->where("estatus", 1);
        $rs = $this->db->get("rFiscal"); 
        return $rs->num_rows() > 0 ? $rs->result() : null;

    }

    public function get_Detalle(){ 

        $this->db->select("*");

        $rs = $this->db->get("usosCFDI");
        return $rs->num_rows() > 0 ? $rs->result() : null;

    }
	
	
	 public function get_UsoCDFI(){ 

        $this->db->select("*");
        $rs = $this->db->get("usosCFDI");
        return $rs->num_rows() > 0 ? $rs->result() : null;

    }
	
	

    public function get_DFiscales($idU){

        $this->db->select("*");
        $this->db->where("idU",$idU);
        $this->db->where("estatus", 1);
        $this->db->or_where("estatus", 0);
        $rs = $this->db->get("domicilios");
        return $rs->num_rows() > 0 ? $rs->result() : null;

    }

    public function get_Municipio($id){ 

        $this->db->select("*");

        if ( $id != 0 ){
            $this->db->where( "estado_id", $id );
        }

        $rs = $this->db->get("municipios");
        return $rs->num_rows() > 0 ? $rs->result() : null;

    }

    public function get_Estados(){ 

        $this->db->select("*");
        $rs = $this->db->get("estados");
        return $rs->num_rows() > 0 ? $rs->result() : null;

    }

    public function insert_Domicilio($data){ 
        
        $this->db->insert("domicilios",$data);
        return $this->db->affected_rows() >=1;

    }

    public function update_Domicilio($data, $id){
        
        $this->db->where("idU",$id);
        $this->db->update("domicilios", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function get_Card($idU){

        $this->db->select("*");
        $this->db->where("idU",$idU);
        $this->db->where("estatus", 1);
        $this->db->or_where("estatus", 0);
        $rs = $this->db->get("detalleTarjeta");
        return $rs->num_rows() > 0 ? $rs->result() : null;

    }

    public function VerificaPass_usuario_perfil($UpdateData){
        $idUsuario = $UpdateData['idU'];
        $pass = $UpdateData['pass'];

        $cmd = $this->db->query(
            "SELECT *
             FROM   usuarios
             WHERE  idU = $idUsuario
             AND    contrasenia = md5('$pass') "
        );
        return $cmd->num_rows() >= 1 ? true : null;
    }

    public function UpdatePass_usuario_perfil($UpdateData){
        $idUsuario = $UpdateData['idU'];
        $pass = $UpdateData['passN'];

        $cmd = $this->db->query(
            "UPDATE usuarios
             SET    contrasenia = md5('$pass')
             WHERE idU          = $idUsuario "
        );
        return $cmd;
    }
    public function telSame($data){
        $idU = $data['idU'];
        $telefono = $data['telefono'];

        $this->db->select("*");
        $this->db->where("telefono",$telefono);
        $this->db->where("idU",$idU);
        $rs = $this->db->get("usuarios");
       
         return $rs->num_rows() >= 1 ? true : false;

    }

    public function telSameDiferente($data){
        $idU = $data['idU'];
        $telefono = $data['telefono'];

        $cmd = $this->db->query(
            "SELECT *
             FROM   usuarios
             WHERE  telefono = $telefono
             AND    idU     != $idU "
        
        );
       
         return $cmd->num_rows() >= 1 ? true : false;
    }
    public function UpdatePerfil_usuario_perfil($UpdateData){
        $idUsuario = $UpdateData['idU'];
        $nombreU = $UpdateData['nombreU'];
        $apellidos = $UpdateData['apellidos'];
        $telefono = $UpdateData['telefono'];

        $cmd = $this->db->query(
            "UPDATE usuarios
             SET    nombreU     = '$nombreU',
                    apellidos   = '$apellidos',
                    telefono    = '$telefono'
             WHERE idU          = $idUsuario "
        );
        return $cmd;
    }

    public function logo_user($data, $usuario_id) {
        $avatar = $data['avatar_usuario'];

        $cmd = $this->db->query(
            "UPDATE usuarios
             SET    image_url = '$avatar'
             WHERE idU  = $usuario_id "
        );
        return $cmd; 

    }

    public function update_Estatus($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("idD", $id);
        $this->db->update("domicilios");
        return $this->db->affected_rows() > 0;

    }

    public function borradoLogico($id){

        $this->db->set("estatus", "3"); 
        $this->db->where("idD",$id);
        $this->db->update("domicilios");
        return $this->db->affected_rows() >0; 

    }

}


?>
