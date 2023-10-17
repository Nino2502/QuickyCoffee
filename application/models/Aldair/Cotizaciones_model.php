<?php

class Cotizaciones_model extends CI_Model{



      function VerificaUsuario(){
        $this->db->select("*");
        $this->db->from("usuarios");
        $this->db->where("estatus",1);
        $this->db->where("idTU",4);
       
        $query = $this->db->get();
        return $query->result();
      }

      function getProductos(){
        $valor = 'SDI-';


        $this->db->select('*');
        $this->db->from('servicios');
        $this->db->where("estatus",1);
        $this->db->like("idS", $valor, 'after');
        $resultados = $this->db->get()->result_array();
        return $resultados;
      }

      public function ver_Servicios(){
        $this->db->select("servicios.*, categoriasServicios.nombreCS, unidades.nombreUni, politicas.nombrePol, inventario.*,sucursales.nombreSuc" );
        $this->db->where("servicios.estatus",1);
        $this->db->where("sucursales.idSuc",9);
        $this->db->where("inventario.inventario >=", 1);
        $this->db->or_where("servicios.estatus",0);
        $this->db->join("categoriasServicios", "categoriasServicios.idCS = servicios.idCS ");
        $this->db->join("unidades", "unidades.idUni = servicios.idUnidad", 'left');
        $this->db->join("politicas", "politicas.idPol = servicios.idPolImpre", 'left');
        $this->db->join("inventario", "inventario.idS = servicios.idS", 'left');
        $this->db->join("sucursales", "sucursales.idSuc = inventario.idSuc", 'left');
        $rs = $this->db->get("servicios");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }


    public function ver_Servicio($id){

      $this->db->select("servicios.*, categoriasServicios.nombreCS,inventario.*");
      $this->db->where("servicios.idS", $id);
      $this->db->where("inventario.idSuc",9);
      $this->db->join("categoriasServicios", "categoriasServicios.idCS = servicios.idCS ");
      $this->db->join("inventario", "inventario.idS = servicios.idS", 'left');
      $rs = $this->db->get("servicios");
      return $rs->num_rows() >0 ? $rs->result() : null;
    }
    
    public function consultarProducto($idProducto){
      $this->db->select('s.idS, s.nombreS, i.inventario, i.idSuc, suc.nombreSuc, s.estatus');
      $this->db->from('servicios as s');
      $this->db->join('inventario as i', 'i.idS = s.idS');
      $this->db->join('sucursales as suc', 'suc.idSuc = i.idSuc');
      $this->db->where('s.idS', $idProducto);
      $this->db->where('s.estatus', 1);
      $query = $this->db->get();
      return $query->result();
    }

    public function TiposPagos(){
        $this->db->select("*");
        $this->db->from("formaDePago");
        $this->db->where("estatus",1);
        $this->db->where_in("idFP",array(2,3,5));
        $query = $this->db->get();
        return $query->result();
    }

    public function getUser($iUser){
        $this->db->select("*");
        $this->db->from("usuarios");
        $this->db->where("estatus",1);
        $this->db->where("idU", $iUser);
        $query = $this->db->get();
        return $query->num_rows() >= 1 ? $query->row() : null;
    }

    public function VerificaUsuarioExist($correo,$telefono){
        $this->db->select("*");
        $this->db->from("usuarios");
        $this->db->or_where("correo",$correo);
        $this->db->or_where("telefono",$telefono);
        $query = $this->db->get();
        return $query->num_rows() >= 1 ? $query->row() : null;
    }

    public function InsertarUsuario($data){
        $this->db->insert("usuarios", $data);
        return $this->db->insert_id();
    }

    public function getSucursalEmpleado($idEmpleado){
        $this->db->select("idSuc, nombreU");
        $this->db->from("usuarios");
        $this->db->where("idU",$idEmpleado);
        $query = $this->db->get();
        return $query->num_rows() >= 1 ? $query->row() : null;
    }

    public function GenerarVenta($arrData){
       $this->db->insert("Ventas", $arrData);
       return $this->db->insert_id();
    }

    public function InsertarDetalleVenta($carritoFinal) {
      $valores = array();
      foreach ($carritoFinal as $venta) {
          $idServicio = $venta['idServicio'];
          $cantidad = floatval($venta['Cantidad']);
          $precioUnitario = $venta['PrecioUnitario'];
          $idVenta = $venta['idVenta'];
          $idSuc = $venta['idSuc'];
          $productoComentario = isset($venta['ProductoComentario']) ? $venta['ProductoComentario'] : '';
          $subtotal = $venta['subtotal'];
          // Escapar caracteres especiales en los valores y agregarlos al arreglo de valores
          $valores[] = sprintf("('%s', %s, '%s', '%s', '%s', '%s', '%s')", $idServicio, floatval($cantidad), $precioUnitario, $idVenta, $idSuc, $productoComentario, $subtotal);
      }
     
     

      // Unir los valores con comas para crear una cadena de valores para la sentencia SQL
      $valores_str = implode(',', $valores);
  
      // Ejecutar la sentencia SQL de inserción múltiple
      $sql = "INSERT INTO DetalleVentas (idServicio, Cantidad, PrecioUnitario, idVenta, idSuc, ProductoComentario, subtotal ) VALUES $valores_str";
      $this->db->query($sql);

      if ($this->db->affected_rows() > 0) {
        return true; // Se insertaron los detalles de la venta correctamente
    } else {
        return false; // No se insertaron los detalles de la venta correctamente
    }
  }
    public function getDayCorte($empleado,$fechaActual){
      $this->db->select("*");
      $this->db->from("Ventas");
      $this->db->where("idEmpleado",$empleado);
      $this->db->where("fechaCorteCons",$fechaActual);
      $query = $this->db->get();
      return $query->num_rows() >= 1 ? $query->row() : null;
    }
    
    public function verificaCorte($empleado){
      $this->db->select("*");
      $this->db->from("Ventas");
      $this->db->where("idEmpleado",$empleado);
      $this->db->where('idRC IS NULL');
 
      $query = $this->db->get();
      return $query->num_rows() >= 1 ? $query->row() : null;
    }

    public function registraCambio($arr){
      $this->db->insert("Ventas", $arr);
      return $this->db->insert_id();
    }

    public function getTM(){
      $this->db->select("*");
      $this->db->from("TipoMovimiento");
      $this->db->where("estatus",1);
      $query = $this->db->get();
      return $query->result();
    }

    public function getClave($Clave){
      $this->db->select("*");
      $this->db->from("accesoMovimiento");
      $this->db->where("ClaveAcceso", md5($Clave));
      $query = $this->db->get();
      return $query->num_rows() >= 1 ? $query->row() : null;
    }
    public function registrarCotizacion($arr){
      $this->db->insert("cotizaciones", $arr);
      return $this->db->insert_id();
    }

    public function verificarToken(){
      $this->db->select("claveAcceso");
      $this->db->from("accesoMovimiento");
      $query = $this->db->get();
      return $query->result();
    }

    public function registrarDetalleCotizacion($idCotizacion){
      $this->db->select("*");
      $this->db->from("cotizaciones");
      $this->db->where("idCotizacion", $idCotizacion);
      $query = $this->db->get();
      return $query->num_rows() >= 1 ? $query->row() : null;

    }
    public function getCotizacion($idCaja,$fecha){
      $this->db->select("co.*,u.nombreU,apellidos,telefono,correo");
      $this->db->from("cotizaciones as co");
      $this->db->join("usuarios as u","co.idCliente = u.idU");
      $this->db->where("co.idCaja", $idCaja);
      $this->db->where("co.fechaCotizacion >= ", $fecha . " 00:00:00");
      $this->db->where("co.fechaCotizacion <= ", $fecha . " 23:59:59");
      $query = $this->db->get();
      return $query->result();
    }

    public function detalleCotizacion($idCotizacion){
      $this->db->select("co.*");
      $this->db->from("cotizaciones as co");
   
      $this->db->where("co.idCotizacion", $idCotizacion);
      $query = $this->db->get();
      return $query->num_rows() >= 1 ? $query->row() : null;
    }

    public function verCliente($idU){
      $this->db->select("*");
      $this->db->from("usuarios");
      $this->db->where("idU", $idU);
      $query = $this->db->get();
      return $query->num_rows() >= 1 ? $query->row() : null;
      
    }

    public function getDetalleProductos($idServicioArray){
      $this->db->select('idS,nombreS,desS,image_url');
      $this->db->from('servicios');
      $this->db->where_in('idS', $idServicioArray);

      $query = $this->db->get();
      $results = $query->result_array();
      return $results;
    }
    
    public function verSucursal($idSuc){
      $this->db->select("nombreSuc");
      $this->db->from("sucursales");
      $this->db->where("idSuc", $idSuc);
      $query = $this->db->get();
      return $query->num_rows() >= 1 ? $query->row() : null;
      
    }

    public function verCorreoCliente($idU){
      $this->db->select("correo");
      $this->db->from("usuarios");
      $this->db->where("idU", $idU);
      $query = $this->db->get();
      return $query->num_rows() >= 1 ? $query->row() : null;

    }

}   
?>
