<?php

class Inventario_pizza_model extends CI_Model{


    public function ver_lista_inventario(){

      
        $cmd = $this->db->query('SELECT * FROM Inventario_pizzas WHERE estatus != 3');
    
      
        return $cmd->num_rows() >0 ? $cmd->result() : null;

    }
	
	public function ver_promos(){
		$this->db->select("*");
		$this->db->where("cat",3);
		$this->db->where("estatus",1);
		$rs = $this->db->get("atributos_adicionales");
		return $rs->num_rows() > 0 ? $rs->result() : null;
		
	}

    public function inserta_nuevo_ingrediente($NuevaData){
        $this->db->insert("Inventario_pizzas", $NuevaData);
        return $this->db->affected_rows() > 0 ? true : false;
        
    }

    public function update_ingrediente($data, $id_inventario){
        $this->db->where("id_inventario", $id_inventario);
        $this->db->update("Inventario_pizzas", $data);
        return $this->db->affected_rows() > 0 ? true : false;
    }
    public function validarCorreo($correo){
      
        $this->db->select("*");
        $this->db->where("correo",$correo);
        $rs = $this->db->get("usuarios");
       
         return $rs->num_rows() >= 1 ? $rs->row() : null;

    }

    public function validarTelefono($telefono){
      
        $this->db->select("*");
        $this->db->where("telefono",$telefono);
        $rs = $this->db->get("usuarios");
       
         return $rs->num_rows() >= 1 ? $rs->row() : null;

    }
    public function changeStatus1($changeData){
        $estatus           = $changeData['estatus'];
        $id_inventario             = $changeData['id_inventario']; 
    
        $cmd = $this->db->query(
        "UPDATE Inventario_pizzas
             SET estatus = 0

             WHERE estatus       = $estatus AND
             id_inventario          = $id_inventario      
                    
             ");
            return $cmd;
    }
    public function changeStatus0($changeData){
        $estatus           = $changeData['estatus'];
        $id_inventario             = $changeData['id_inventario']; 
    
    
        $cmd = $this->db->query(
        "UPDATE Inventario_pizzas
             SET estatus = 1

             WHERE estatus       = $estatus AND
                   id_inventario          = $id_inventario     
                    
             ");
            return $cmd;
    }
    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("id_inventario",$id);
        $this->db->update("Inventario_pizzas");
        return $this->db->affected_rows() >0;

    }

    public function ver_lista_tipoUsuario(){
        $this->db->select("*");
        $this->db->where("estatus",1);    
        $rs = $this->db->get("tipoUsuario");
                     return $rs->num_rows() >0 ? $rs->result() : null;
    }
   
    public function ver_lista_sucursales(){
        $cmd = $this->db->query('SELECT d.*, s.* FROM `domicilios` as d INNER JOIN sucursales as s on d.idU = s.idU');
    
      
        return $cmd->num_rows() >0 ? $cmd->result() : null;

    }   
    public function registerAddress ($AddressData){
        $this->db->insert("domicilios", $AddressData);
        return $this->db->affected_rows() > 0 ? true : false;
        
    }

    public function updateDomFiscal($idU){
        $cmd = $this->db->query("UPDATE domicilios set domFiscal = 0 where idU IN ($idU)");
        return $cmd;
    }

    public function sumar_precio(){
        $this->db->select_sum('precio');
        $rs = $this->db->get("Inventario_pizzas");

        return $rs->num_rows() > 0 ? $rs->row() : null;

    }

    public function precio_total_pizzas(){

        $this->db->select_sum("subtotal");     
        $rs = $this->db->get("detalleventas");
        return $rs->num_rows() >0 ? $rs->result() : null;
        
    }

    public function coffes_dia($fecha_actual) {
        // Seleccionar la suma de Cantidad y cualquier otra columna relevante
        $this->db->select("SUM(detalleventas.Cantidad) as total_cantidad, DATE(ventas.FechaVentaG) as fecha");
        
        // Realizar el JOIN entre las tablas
        $this->db->join("ventas", "ventas.idVenta = detalleventas.idVenta");
        
        // Filtrar por la fecha específica
        $this->db->where("DATE(ventas.FechaVentaG)", $fecha_actual);
        
        // Ejecutar la consulta en la tabla detalleventas
        $rs = $this->db->get("detalleventas");
    
        // Retornar el resultado si existe, o null si no hay registros
        return $rs->num_rows() > 0 ? $rs->row() : null;
    }
    
    

  



}


?>
