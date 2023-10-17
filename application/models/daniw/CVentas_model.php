<?php

class CVentas_model extends CI_Model{

    // Ventas asociadas a un cliente
    public function get_Ventas($id){  
        
        $this->db->select('*');
        $this->db->where('idCliente', $id);

        $rs = $this->db->get("Ventas");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function ver_Detalle($id) {
        $this->db->select('DV.*, s.nombreS, s.image_url');
        $this->db->where('idVenta', $id);

        $this->db->JOIN("servicios AS s","s.idS = DV.idServicio", "left");
        $rs = $this->db->get('DetalleVentas AS DV');
        return $rs->num_rows() > 0 ? $rs->result() : null;
    }

} //termina modelo
