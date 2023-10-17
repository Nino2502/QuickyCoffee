<?php

class GastoVariado_model extends CI_Model{


    public function ver_GastoVariado(){

        $this->db->select("compras.*, nombreSuc, nombreTG, CONCAT(nombreU, ' ', apellidos) AS nombreC ");
        $this->db->from("compras");
        $this->db->join("tiposDeGastos","tiposDeGastos.idTG = compras.idTG");
		$this->db->join("sucursales","sucursales.idSuc = compras.idSuc");
		$this->db->join("usuarios","usuarios.idU = compras.idU"); 
		$this->db->where("compras.idTG !=", 1);
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

    public function inserta_nueva_GastoVariado($data){
        
        $this->db->insert("compras",$data);
        return $this->db->insert_id();

    }


    public function inserta_GastoVariado($data){
        
        $this->db->insert("detalleCompras",$data);
        return $this->db->affected_rows() >=1 ;

    }


    public function update_GastoVariado($data, $id){
        
        $this->db->where("idCom",$id);
        $this->db->update("compras", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function borra_GastoVariado($id){

        $this->db->where('idCom', $id);
        $this->db->delete('detalleCompras');
        return $this->db->affected_rows() >=1;
        
    }





    public function estatus_GastoVariado($id){

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