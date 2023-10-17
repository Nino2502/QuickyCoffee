<?php
defined('BASEPATH') or exit('no direct script acces allowed');

class Servicios_api_model extends CI_Model
{

    public function get_servicios($estatus){
      $this->db->select("idS, nombreS, desS, precioS, image_url ");
      $this->db->where("estatus", $estatus);
   
      $rs = $this->db->get("servicios");
      
      return $rs->num_rows() >= 1 ? $rs->result(): NULL;
      
    }
    
     public function get_detalle_servicio($idS){
      $this->db->select("idS, nombreS, desS, precioS, idFormD, idCS, estatus, image_url");
      $this->db->where("idS", $idS);
      $rs = $this->db->get("servicios");
      
      return $rs->num_rows() >= 1 ? $rs->result(): NULL;
      
    }
  
}