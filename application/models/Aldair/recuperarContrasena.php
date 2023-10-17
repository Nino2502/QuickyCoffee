<?php

class recuperarContrasena extends CI_Model{

    public function verifica_correo($correo){
        $this->db->select("*");
        $this->db->from("usuario");
        $this->db->where("correo", $correo);

        $query = $this->db->get();
        return $query->num_rows() >= 1 ? $query->row() : null;
    }

    public function verificarToken($token){
        $this->db->select("*");
        $this->db->from("recuperarContrasena");
        $this->db->where("tokenRecuperacion",$token);
        $this->db->where("status", 0);
        $query = $this->db->get();
        return $query->num_rows() >= 1 ? $query->row() : null;
    }

    
}
?>
