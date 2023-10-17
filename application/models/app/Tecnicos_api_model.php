<?php
defined('BASEPATH') or exit('no direct script acces allowed');

class Tecnicos_api_model extends CI_Model
{

    public function get_tecnicos($idTU, $idP){
      $this->db->select("idU, nombreU, apellidos, telefono, correo, image_url ");
      $this->db->where("idTU", $idTU);
      $this->db->where("idP", $idP);
      $rs = $this->db->get("usuarios");
      
      return $rs->num_rows() >= 1 ? $rs->result(): NULL;
      
    }

    public function get_detalle_tecnico($idS){
      $this->db->select("idU, nombreU, apellidos, telefono, correo, image_url, rfc, idTU, idP, estatus, fecha_creacion");
      $this->db->where("idS", $idS);
      $rs = $this->db->get("servicios");
      
      return $rs->num_rows() >= 1 ? $rs->result(): NULL;
      
    }
  
}