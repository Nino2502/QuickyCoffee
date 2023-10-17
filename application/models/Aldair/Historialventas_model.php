<?php

class Historialventas_model extends CI_Model{


    public function getHistorial($caja,$fecha){
        $this->db->select('v.*, tm.*, u.nombreU, u.apellidos');
        $this->db->from('Ventas v');
        $this->db->join('TipoMovimiento tm', 'tm.idTM = v.TipCambio', 'left');
        $this->db->join("usuarios as u", "u.idU = v.idCliente", "left");
        $this->db->where('v.idEmpleado', $caja);
        $this->db->where('DATE(v.FechaVentaG)', $fecha);
        $this->db->group_start();
        $this->db->where('v.TipCambio IS NULL');
        $this->db->or_where('v.TipCambio !=', '');
        $this->db->group_end();
        $this->db->order_by('v.idVenta', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getVentas($idVenta){
        $this->db->select("*");
        $this->db->from("DetalleVentas");
        $this->db->where("idVenta", $idVenta);
        $query = $this->db->get();
        return $query->result();
    }

    public function getCliente($idVenta){
        $this->db->select("u.telefono, u.correo, u.nombreU, u.apellidos");
        $this->db->from("Ventas as v");
        $this->db->join("usuarios as u", "u.idU = v.idCliente");
        $this->db->where("v.idVenta", $idVenta);
        $query = $this->db->get();
        return $query->row();
    }
}
?>