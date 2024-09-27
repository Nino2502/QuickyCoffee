<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Sucursales_model extends CI_Model 
{
    public function ver_Sucursales(){

        $this->db->select("sucursales.*, estados.nombre_estado as estado, municipios.nombre_municipio as municipio");
        $this->db->join("estados","estados.estado_id = sucursales.estadoSuc");
        $this->db->join("municipios","municipios.municipio_id = sucursales.munisipioSuc");
        $this->db->where("estatus",1);
        $this->db->or_where("estatus",0);
        $rs = $this->db->get("sucursales");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }
	
	
	
	public function ver_Sucursal($id){

        $this->db->select("idSuc, nombreSuc");
        $this->db->where("idSuc",$id);
        $this->db->where("estatus",1);
        $this->db->or_where("estatus",0);
        $rs = $this->db->get("sucursales");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }
	
	public function ver_lista_cajas_sucursal($idSucursal){
		
		$this->db->select("idU, nombreU");
        $this->db->where("idSuc",$idSucursal);
		$this->db->where("idP","999");
        $this->db->where("estatus",1);
        $this->db->or_where("estatus",0);
        $rs = $this->db->get("usuarios");
        return $rs->num_rows() >0 ? $rs->result() : null;
		
		
	}


    public function ver_ingredientes(){
        return $this->db->get("inventario_pizzas")->result_array();
    }
	
	

    public function ver_estados()
    {
        $this->db->select("*");
        $rs = $this->db->get("estados");
        return $rs->num_rows() >0 ? $rs->result() : null;
    }

    public function ver_municipios($estado_id)
    {
        $this->db->select("*");
        $this->db->where("estado_id",$estado_id);
        $rs = $this->db->get("municipios");
        return $rs->num_rows() >0 ? $rs->result() : null;
    }


    public function inserta_Sucursales($data){
        
        $this->db->insert("sucursales",$data);
        return $this->db->affected_rows() >=1;

    }

    public function update_Sucursales($data, $id){
        
        $this->db->where("idSuc",$id);
        $this->db->update("sucursales", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function estatus_Sucursales($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("idSuc", $id);
        $this->db->update("sucursales");
        return $this->db->affected_rows() >0;

    }

    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idSuc",$id);
        $this->db->update("sucursales");
        return $this->db->affected_rows() >0;

    }                     
                        
}


/* End of file Sucursales_model.php and path /application/models/app/Sucursales_model.php */
