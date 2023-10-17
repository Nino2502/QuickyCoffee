<?php
defined('BASEPATH') or exit('no direct script acces allowed');

class Pedidos_model extends CI_Model
{
    // public function get_ventas($idU){
    //     $this->db->select('v.tokenVenta, e.color, v.estatus AS status,  v.idVenta, v.FechaVentaG, v.idVenta, v.TotalVenta, s.nombreSuc, e.estatus');
    //     $this->db->from('Ventas AS v');
    //     $this->db->join('sucursales AS s', 's.idSuc = v.idSuc');
    //     $this->db->join('estatus_venta AS e', 'v.estatus = e.id');
    //     $this->db->where('v.idCliente', $idU);
    //     $query = $this->db->get();
    //     return $query->result();
    // }
    public function get_ventas($idU){
        $this->db->select('v.tokenVenta, e.color, v.estatus AS status,  v.idVenta, v.FechaVentaG, v.idVenta, v.TotalVenta, s.nombreSuc, e.estatus');
        $this->db->from('Ventas AS v');
        $this->db->join('sucursales AS s', 's.idSuc = v.idSuc');
        $this->db->join('estatus_venta AS e', 'v.estatus = e.id');
        $this->db->where('v.idCliente', $idU);
        $this->db->order_by('v.idVenta', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    


    public function get_detalle($idVenta){
        $this->db->select('p.nombreS, p.image_url, d.Cantidad, d.PrecioUnitario, s.nombreSuc, (d.Cantidad * d.PrecioUnitario) AS subtotal');
        $this->db->from('DetalleVentas AS d');
        $this->db->join('servicios AS p', 'p.idS = d.idServicio');
        $this->db->join('sucursales as s', 's.idSuc = d.idSuc');
        $this->db->where('idVenta', $idVenta);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_sucursales(){
        $this->db->select('s.idSuc, s.nombreSuc, s.calleSuc, s.numSuc, s.coloniaSuc, s.cpSuc, e.nombre_estado, m.nombre_municipio');
        $this->db->from('sucursales AS s');
        $this->db->join('estados AS e', 's.estadoSuc = e.estado_id');
        $this->db->join('municipios AS m', 's.munisipioSuc = m.municipio_id');
        $this->db->where('s.estatus', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function insert_venta($idU, $total, $idSuc, $comentario){
         // Obtener la fecha actual
        $fechaActual = date('Y-m-d H:i:s');
        // Concatenar el $idU con la fecha actual
        $tokenVenta = $idU . $fechaActual;
        // Calcular el MD5 del tokenVenta
        $tokenVenta = md5($tokenVenta);
        $data = array(
            'tokenVenta' => $tokenVenta,
            'idCliente' => $idU,
            'idEmpleado' => 2,
            'idFP' => 1,
            //idEP estatus pago, 1= pagado, 3=pendiente
            'idEP' => 1,
            'Factura' => null,
            'FechaVentaG' => $fechaActual,
            'FechaVentaCierre' => $fechaActual,
            'TotalVenta' => $fechaActual,
            'TotalVenta' => $total,
            'idSuc' => $idSuc,
            'idRC' => null,
            //estatus 2= preparando pedido
            'estatus' => 2,
            'Comentario' => $comentario,
        );
        $result= $this->db->insert('Ventas', $data);
        $insert_id = $this->db->insert_id();
        $this->db->where('idVenta', $insert_id);
        $query = $this->db->get('Ventas');
        $row= $query->row();
        $idVenta=$row->idVenta;
        return $idVenta;
    }
  
    public function insert_detalle($carrito_id, $idVenta) {
        // Query de inserción con marcadores de posición
        $sql = "INSERT INTO DetalleVentas (idVenta, idServicio, Cantidad, PrecioUnitario, idSuc, subtotal, impreso, ProductoComentario)
                SELECT ? AS idVenta, idServicio, cantidad, precio, idSuc, subtotal, impreso, comentario
                FROM carrito_detalle
                WHERE carrito_id = ?";  // Marcadores de posición

        // Ejecutar la consulta con las variables enlazadas a los marcadores
        $result = $this->db->query($sql, array($idVenta, $carrito_id)); // Enlazar las variables

        // Verificar si la inserción se realizó correctamente
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function borrar_carrito($idC){
        $this->db->where('carrito_id', $idC);
        $this->db->delete('carrito_detalle');
        return $this->db->affected_rows() > 0 ? true : false;
    }
        


}