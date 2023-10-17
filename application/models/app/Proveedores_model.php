<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Proveedores_model extends CI_Model 
{
    public function ver_Proveedores(){

        $this->db->select("proveedores.*, estados.nombre_estado as estado, municipios.nombre_municipio as municipio");
        $this->db->join("estados","estados.estado_id = proveedores.estadoId");
        $this->db->join("municipios","municipios.municipio_id = proveedores.municipioId");
        $this->db->where("estatus",1);
        $this->db->or_where("estatus",0);
        $rs = $this->db->get("proveedores");
        return $rs->num_rows() >0 ? $rs->result() : null;

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


    public function inserta_Proveedores($data){
        
        $this->db->insert("proveedores",$data);
        return $this->db->affected_rows() >=1;

    }

    public function update_Proveedores($data, $id){
        
        $this->db->where("idProv",$id);
        $this->db->update("proveedores", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function estatus_Proveedores($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("idProv", $id);
        $this->db->update("proveedores");
        return $this->db->affected_rows() >0;

    }

    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idProv",$id);
        $this->db->update("proveedores");
        return $this->db->affected_rows() >0;

    }                     
                        
}


/* End of file Proveedores_model.php and path /application/models/app/Proveedores_model.php */
