<?php

    Class Notificacion_model extends CI_Model{

        public function getStatus($idS){
            $this->db->select("*");
            $this->db->from("estatus_venta");
            $this->db->where("id",$idS);
            $query = $this->db->get();
            return $query->num_rows() > 0 ? $query->row() : null;
        }
        public function getCliente($venta){
            $this->db->select("v.idVenta, u.nombreU, u.deviceToken");
            $this->db->from("Ventas as v");
            $this->db->JOIN("usuarios as u","u.idU = v.idCliente");
            $this->db->where("v.idVenta", $venta);
            $query = $this->db->get();
            return $query->num_rows() > 0 ? $query->row() : null;
        }
    } 

?>