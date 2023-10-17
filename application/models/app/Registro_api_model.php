<?php
defined('BASEPATH') or exit('no direct script acces allowed');

class Registro_api_model extends CI_Model
{

    public function get_usuario($correo, $telefono){
      $this->db->select("correo, telefono");
      $this->db->where("correo", $correo);
      $this->db->where("telefono", $telefono);
      $rs = $this->db->get("usuarios");
      
      return $rs->num_rows() == 1 ? $rs->row(): NULL;
      
    }

    public function insert_usuario($arrayName){
      $this->db->insert('usuarios', $arrayName);
      return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

}