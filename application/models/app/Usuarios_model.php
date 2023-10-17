<?php

class Usuarios_model extends CI_Model{


    public function ver_lista_colaboradores(){

        $this->db->select("*");
        $this->db->where("idTU",3);
        $this->db->where_in('estatus', array(1,0));
        $cmd = $this->db->get("usuarios");
          
        return $cmd->num_rows() >0 ? $cmd->result() : null;

    }

    public function ver_colavorador($id) {
        $this->db->select("usuarios.*, especialidades.nombreEsp as especialidad, tipoPerfil.nombreTP as perfil, sucursales.nombreSuc as sucursal");
        $this->db->join("tipoPerfil", "tipoPerfil.idTP = usuarios.idP");
        $this->db->join("especialidades", "especialidades.idEsp = usuarios.idEsp");
        /*
            La unión con la tabla sucursales se realiza con la cláusula left, lo que significa que los datos 
            de la tabla usuarios se mostrarán aunque no haya una coincidencia en la tabla sucursales.
        */
        $this->db->join("sucursales", "sucursales.idSuc = usuarios.idSuc", 'left');
        $this->db->where('usuarios.idU', $id);
        $rs = $this->db->get("usuarios");

        return $rs->num_rows() >0 ? $rs->result() : null;
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
        $this->db->where("correo IS NOT NULL"); // agregue esta línea para excluir valores nulos
        $rs = $this->db->get("usuarios");
       
         return $rs->num_rows() >= 1 ? $rs->row() : null;


    }

    public function validarTelefono($telefono){
      
        $this->db->select("*");
        $this->db->where("telefono",$telefono);
        $this->db->where("telefono IS NOT NULL"); // agregue esta línea para excluir valores nulos
        $rs = $this->db->get("usuarios");
        
        return !empty($rs->result()) ? true : false;

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
	
	public function ver_lista_colaboradores_caja(){

		$cmd = $this->db->query('SELECT * FROM usuarios WHERE  idP = 999  AND estatus != 3');
		return $cmd->num_rows() >0 ? $cmd->result() : null;

    }
	
	public function ver_lista_clientes(){
		
		$cmd = $this->db->query('SELECT * FROM usuarios WHERE idTU = 4 AND estatus != 3');
		return $cmd->num_rows() >0 ? $cmd->result() : null;

    }

}


?>
