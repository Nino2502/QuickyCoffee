<?php
defined('BASEPATH') or exit('no direct script acces allowed');

class Login_model extends CI_Model{
    
    function __construct(){
        parent::__construct(); 
        } 

    public function get_user($correo, $contrasenia){
        $this->db->select("nombreU, apellidos, idU, idSuc");
        $this->db->where("correo", $correo);
        $this->db->where("contrasenia", $contrasenia);
		$this->db->where("estatus",1);
        $rs = $this->db->get("usuarios");
      
        return $rs->num_rows() == 1 ? $rs->row(): NULL; 
        
      }
      public function check_carrito($idU, $idSuc) {
        $this->db->where('idU', $idU);
        $query = $this->db->get('carrito');
        
        if ($query->num_rows() > 0) {
            // Si hay registros, se devuelve la fila encontrada
            return $query->row();
        } else {
            // Si no hay registros, se hace un insert en la tabla con el valor dado
            $data = array(
                'idU' => $idU,
                'idSuc' => $idSuc
            );
            $this->db->insert('carrito', $data);
            
            // Se obtiene la fila insertada y se devuelve
            $query = $this->db->get_where('carrito', array('idU' => $idU));
            return $query->row();
        }
    }

 


}