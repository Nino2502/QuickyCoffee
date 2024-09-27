<?php

class Inventario_pizza_model extends CI_Model{


    public function ver_lista_inventario(){

      
        $cmd = $this->db->query('SELECT * FROM inventario_pizzas WHERE estatus != 3');
    
      
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
        $this->db->insert("inventario_pizzas", $NuevaData);
        return $this->db->affected_rows() > 0 ? true : false;
        
    }

    public function update_ingrediente($data, $id_inventario){
        $this->db->where("id_inventario", $id_inventario);
        $this->db->update("inventario_pizzas", $data);
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
        "UPDATE inventario_pizzas
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
        "UPDATE inventario_pizzas
             SET estatus = 1

             WHERE estatus       = $estatus AND
                   id_inventario          = $id_inventario     
                    
             ");
            return $cmd;
    }
    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("id_inventario",$id);
        $this->db->update("inventario_pizzas");
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
        $rs = $this->db->get("inventario_pizzas");

        return $rs->num_rows() > 0 ? $rs->row() : null;

    }

    public function precio_total_pizzas(){

        $this->db->select_sum("subtotal");     
        $rs = $this->db->get("detalleventas");
        return $rs->num_rows() >0 ? $rs->result() : null;
        
    }

}


?>
