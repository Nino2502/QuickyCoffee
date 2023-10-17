<?php

class Corte_model extends CI_Model{



  public function corteCaja($empleado,$fecha){
    $this->db->select("sum(TotalVenta) as total_venta_caja, idEmpleado as CAJA");
    $this->db->from("Ventas");
    // $this->db->where("DATE(FechaVentaG)", $fecha);
    // $this->db->where("DATE(FechaVentaCierre)", $fecha);
    //$this->db->or_where("CierreCliente", 1);
    $this->db->where("estatus", 4);
   
    $this->db->where("idEmpleado", $empleado);
    $this->db->where("idRC IS NULL");
    $query = $this->db->get();
    return $query->row();

  }

  public function getUsuario($empleado){

    $this->db->select("*");
    $this->db->from("usuarios");
    $this->db->where("idU", $empleado);
    $query = $this->db->get();
    return $query->row();
  }
 
  public function registrarCorte($arr){
    $this->db->insert("registrosCortes", $arr);
    return $this->db->insert_id();
  }
  
  public function checkCorte($empleado,$fechaCorteCons){
    $this->db->select("*");
    $this->db->from("registrosCortes");
    $this->db->where("idEmpleado", $empleado);
    $this->db->where("fechaCorteCons", $fechaCorteCons);
    $this->db->order_by("fechaCorteReali", "desc"); // Ordenar por fecha de forma descendente
    $this->db->limit(1); // Obtener solo el primer resultado
    $query = $this->db->get();
    return $query->row();
  }
  

  // corte para ventas modulo

  public function getVentaCorte($empleado){
    $this->db->select("r.*,u.nombreU, u.apellidos");
    $this->db->from("registrosCortes as r");
    $this->db->JOIN("usuarios as u", "u.idU = r.idEmpleado");
    $this->db->where("r.idEmpleado",$empleado);
    $this->db->order_by('r.idRC', 'desc');
    $query = $this->db->get();
    return $query->num_rows() > 0 ? $query->result() : null;
  
  }
   
  // obtenemos las ventas sin Id de corte

  public function getVentasSinICV($empleado){
    $this->db->select('*');
    $this->db->from('Ventas');
    $this->db->where('idEmpleado', $empleado);
    $this->db->where('CierreCliente', 1);
    $this->db->where('CierreEmpleado', 1);
    $this->db->where('idRC IS NULL');
    $query = $this->db->get();
    return $query->result();
  }

  public function UpdateVentasCorte($empleado, $R){
  

    $this->db->where('idEmpleado', $empleado);
    $this->db->where('idRC', null);
    $this->db->where('estatus', 4);
 
    $this->db->update('Ventas', $R);
    return $this->db->affected_rows();
  }

  public function getCortes($empleado,$idRC){
    $this->db->select("dv.*, s.image_url,v.*, s.nombreS, fp.nombreFP");
    $this->db->from("Ventas as v");
    $this->db->join("DetalleVentas as dv", "dv.idVenta = v.idVenta");
    $this->db->join("servicios as s", "s.idS = dv.idServicio");
    $this->db->join("formaDePago as fp","fp.idFP = v.idFP");
    $this->db->where("v.idEmpleado", $empleado);
    $this->db->where("v.idRC",$idRC);
  
    $query = $this->db->get();
    return $query->result();
  }

  public function  getCambios($empleado,$idRC){
    $this->db->select('v.*,tp.*');
    $this->db->from('Ventas as v');
    $this->db->join('TipoMovimiento as tp', 'tp.idTM = v.TipCambio');
    $this->db->where('v.idEmpleado', $empleado);
    $this->db->where('v.idRC', $idRC);
    $this->db->where_in('v.TipCambio', array(1, 2));
    $query = $this->db->get();
    return $query->result();
  }
    
}
?>
