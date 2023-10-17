<?php 
Class Pedidos_model extends CI_Model{
    public function get_Pedidos($id) {
        $this->db->select('*');
        $this->db->from('Ventas as v');
        $this->db->join('estatus_venta as EV', 'EV.id = v.estatus');
        $this->db->JOIN("usuarios AS U","U.idU = v.idCliente");
        $this->db->where('v.idSuc', $id);
        $this->db->where_in('v.estatus', array(2,3));
        $query = $this->db->get();
        return $query->result();
    }

    public function get_PedidosVen($id) {
        $this->db->select('*');
        $this->db->from('Ventas as v');
        $this->db->join('estatus_venta as EV', 'EV.id = v.estatus');
        $this->db->JOIN("usuarios AS U","U.idU = v.idCliente");
        $this->db->where('v.idVenta', $id);
        $this->db->where_in('v.estatus', array(2,3));
        $query = $this->db->get();
        return $query->result();
    }

    public function get_PedidosVen2($id) {
        $this->db->select('*');
        $this->db->from('Ventas as v');
        $this->db->join('estatus_venta as EV', 'EV.id = v.estatus');
        $this->db->JOIN("usuarios AS U","U.idU = v.idCliente");
        $this->db->where('v.idVenta', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_Estatus() {
        $this->db->select('*');
        $this->db->where_in('id', array(3,2,4));
        $query = $this->db->get('estatus_venta');
        return $query->result();
    }

    public function update_Pedidos($estatus, $token) {

        $this->db->where("tokenVenta", $token);
        $this->db->update("Ventas", array('estatus' => $estatus));
        return $this->db->affected_rows() > 0;
    }

    public function get_Detalle($id){
        $this->db->select('DV.*, s.nombreS, s.image_url, Suc.nombreSuc'); 
        $this->db->JOIN("servicios AS s","s.idS = DV.idServicio", 'left');
        $this->db->JOIN("sucursales AS Suc","Suc.idSuc = DV.idSuc", 'left');
        $this->db->where('idVenta', $id);

        $rs = $this->db->get('DetalleVentas AS DV');
        return $rs->num_rows() > 0 ? $rs->result() : null;
    }

    public function get_Historial($id) {
        $this->db->select('*');
        $this->db->from('Ventas as v');
        $this->db->join('estatus_venta as EV', 'EV.id = v.estatus');
        $this->db->JOIN("usuarios AS U","U.idU = v.idCliente");
        $this->db->where('v.idSuc', $id);
        $this->db->where_in('v.estatus', array(4));
        $query = $this->db->get();
        return $query->result();
    }

    public function get_Sucursal($id) {
        $this->db->select('*');
        $this->db->where('idSuc', $id);
    
        $rs2 = $this->db->get('sucursales');
        return $rs2->num_rows() > 0 ? $rs2->row() : null;
    }

    public function getStatusToken($token,$status){
        $this->db->select("*");
        $this->db->from("Ventas");
        $this->db->where("tokenVenta",$token);
        $this->db->where("estatus",$status);
        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->row() : null;
        
    }
}
?>