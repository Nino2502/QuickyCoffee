<?php

class Categorias_servicios_model extends CI_Model{


    public function ver_CategoriasServicios(){

        $this->db->select("*");
        $this->db->where("estatus",1);
        $this->db->or_where("estatus",0);
        $rs = $this->db->get("categoriasServicios");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function inserta_Categorias_servicios($data){
        
        $this->db->insert("categoriasServicios",$data);
        return $this->db->affected_rows() >=1;

    }

    public function update_Categorias_servicios($data, $id){
        
        $this->db->where("idCS",$id);
        $this->db->update("categoriasServicios", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function estatus_Categorias_servicios($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("idCS", $id);
        $this->db->update("categoriasServicios");
        return $this->db->affected_rows() >0;

    }

    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idCS",$id);
        $this->db->update("categoriasServicios");
        return $this->db->affected_rows() >0;

    }
	
	
	 public function single_entry($id)
    {
        $this->db->select('*');
        $this->db->from('categoriasServicios');
        $this->db->where('idCS', $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }
	
	

} //termina modelo


?>