<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class SucursalesGet_model extends CI_Model 
{
    public function get_Sucursales(){
        $this->db->Select("*");
        $this->db->from("sucursales as suc");
        $this->db->where("suc.estatus", 1);
        $this->db->where("suc.estadoSuc", 22);
        $query = $this->db->get();
        return $query->result();
    }

                        
}

