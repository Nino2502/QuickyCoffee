<?php

class Compras_model extends CI_Model{


    public function ver_Compras(){

        $this->db->select("compras.*, nombreSuc, nombreProv, CONCAT(nombreU, ' ', apellidos) AS nombreC ");
        $this->db->from("compras");
        $this->db->join("proveedores","proveedores.idProv = compras.idProv");
		$this->db->join("sucursales","sucursales.idSuc = compras.idSuc");
		$this->db->join("usuarios","usuarios.idU = compras.idU"); 
		$this->db->where("idTG =", null);
        $rs = $this->db->get();
        return $rs->num_rows() >0 ? $rs->result() : null;

    }
	
	
	 public function vista_previa($id){
        
		 $this->db->select("*");
		 $this->db->from("detalleCompras");
		 $this->db->where("idCom", $id);
		 $rs = $this->db->get();
		 return $rs->num_rows() >0 ? $rs->result() : null;

    }
	
	
	


    /*public function vista_previa($id){
        $cmd =
        'SELECT *  FROM detalleAgrupaServicio JOIN servicios USING(idS) where idCom ='. $id ;

        $query = $this->db->query($cmd);
        return $query->num_rows() > 0 ? $query->result() : null;

    }*/

    public function inserta_nueva_Compra($data){
        
        $this->db->insert("compras",$data);
        return $this->db->insert_id();

    }


    public function inserta_Compras($data){
        
        $this->db->insert("detalleCompras",$data);
        return $this->db->affected_rows() >=1 ;

    }
	
	
	
	public function update_ultimo_precio_compra($data, $idS){
		
		$this->db->where("idS",$idS);
		$this->db->update("servicios", $data);
		return $this->db->affected_rows() >=1;
			
		
	}


    public function update_Compras($data, $id){
        
        $this->db->where("idCom",$id);
        $this->db->update("compras", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function borra_Compras($id){

        $this->db->where('idCom', $id);
        $this->db->delete('detalleCompras');
        return $this->db->affected_rows() >=1;
        
    }





    public function estatus_Compras($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("idCom", $id);
        $this->db->update("compras");
        return $this->db->affected_rows() >0;

    }

    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idCom",$id);
        $this->db->update("compras");
        return $this->db->affected_rows() >0;

    }

} //termina modelo


?>