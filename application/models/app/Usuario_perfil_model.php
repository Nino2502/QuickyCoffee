<?php

class Usuario_perfil_model extends CI_Model{


    public function InformacionUsuario_perfil($idUsuario){

      
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

}


?>
