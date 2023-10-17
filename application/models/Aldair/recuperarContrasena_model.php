<?php

class RecuperarContrasena_model extends CI_Model{

    public function verifica_correo($correo){
        $this->db->select("*");
        $this->db->from("usuarios");
        $this->db->where("correo", $correo);

        $query = $this->db->get();
        return $query->num_rows() >= 1 ? $query->row() : null;
    }

    public function verificarToken(){
        $this->db->select("*");
        $this->db->from("recuperarContrasena");
        $query = $this->db->get();
        return $query->result();
    }

    public function recuperarUsuario($correo){
        $this->db->select("*");
        $this->db->from("usuarios");
        $this->db->where("correo", $correo);
        $query = $this->db->get();
        return $query->num_rows() >= 1 ? $query->row() : null;
    }

    public function saveToken($arrData){
        $this->db->insert("recuperarContrasena", $arrData);
        return $this->db->insert_id();
    }
    public function consultaToken($idU){
        $this->db->select("*");
        $this->db->from("recuperarContrasena");
        $this->db->where("status", 0);
        $this->db->where("idU",$idU);
        $query = $this->db->get();
        return $query->num_rows() >= 1 ? $query->row() : false;
    }

    public function validar_token($token,$idCliente){
        $this->db->select("*");
        $this->db->from("recuperarContrasena");
        $this->db->where("status", 0);
        $this->db->where("tokenRecuperacion", $token);
        $this->db->where("idU", $idCliente);
        $query = $this->db->get();
        return $query->num_rows() >= 1 ? $query->row() : false;
    }

    public function UpdateContrasena($idCliente,$arr){
        $this->db->where('idU', $idCliente);
        $result = $this->db->update('usuarios', $arr);

    if ($result) {
        
        return true;
    } else {
        // Query failed
        return false;
    }
    }

    public function UpdateToken($token){
        $this->db->set('status', 1);
        $this->db->where('tokenRecuperacion',$token);
        $result = $this->db->update('recuperarContrasena');
        return $result;
    }

}
?>
