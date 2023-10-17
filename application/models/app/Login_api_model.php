<?php
defined('BASEPATH') or exit('no direct script acces allowed');

class Login_api_model extends CI_Model{
    
    function __construct(){
        parent::__construct(); 
        } 

    public function get_user($correo, $contrasenia){
        $this->db->select("nombreU, apellidos, idU");
        $this->db->where("correo", $correo);
        $this->db->where("contrasenia", $contrasenia);
        $rs = $this->db->get("usuarios");
      
        return $rs->num_rows() == 1 ? $rs->row(): NULL; 
        
      }




}