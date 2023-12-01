<?php
defined('BASEPATH') or exit('no direct script acces allowed');

class Carrito_model extends CI_Model
{

public function items_carrito($idC) {
    $this->db->select('c.id, c.prom, c.cantidad, s.nombreS, c.impreso, c.idSuc, c.precio AS PrecioCarrito, 
        c.subtotal AS subtotalCarrito, s.precioS, s.idS,
        s.image_url, suc.nombreSuc, s.cantidadMedioMayoreo, 
        s.precioMedioMayoreo, s.cantidadMayoreo, s.precioMayoreo, c.comentario, atr.nombreAtrD, atr.desAtrD');
    $this->db->from('carrito_detalle AS c');
    $this->db->where("carrito_id", $idC);
    $this->db->join('servicios AS s', 's.idS = c.idServicio');
    $this->db->join('sucursales AS suc', 'suc.idSuc = c.idSuc');
    $this->db->join('atributos_adicionales AS atr', 'atr.idAtrD = c.prom','left');  // Utiliza 'left' si 'promo' puede ser NULL
    $rs = $this->db->get();
    return $rs->num_rows() >= 1 ? $rs->result() : null;
}
    
     public function agregar( $idC, $idS, $count, $idSuc, $precio, $impreso, $comentario, $promocionales){
        $data = array(
            'carrito_id' => $idC,
            'idServicio' => $idS,
            'cantidad'   => $count,
            'precio'     => $precio,
            'subtotal'   => $count * $precio,
            'idSuc'      => $idSuc,
            'impreso'    => $impreso,
            'comentario'    => $comentario,
			'prom'			=> $promocionales
        );
		

		
        $result= $this->db->insert('carrito_detalle', $data);
		
        return $result;        
    }
    
        public function borrar($id){
        $this->db->where('id', $id);
        $this->db->delete('carrito_detalle');
        $result = $this->db->affected_rows();
        return $result > 0;       
    }

    public function total_carrito($idC){
        $this->db->select('SUM(d.subtotal) AS TOTAL');
        $this->db->from('carrito_detalle AS d');
        $this->db->where('carrito_id', $idC);
        $this->db->join('carrito AS c', 'd.carrito_id = c.id');
        $query = $this->db->get();
        $result = $query->row_array();
        return $result['TOTAL'];

    }
}