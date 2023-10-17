<?php

class Secciones_model extends CI_Model{


    public function ver_Secciones(){

        $this->db->select("secciones.*, modulos.nombre_mod");
        $this->db->where("secciones.estatus",1);
        $this->db->or_where("secciones.estatus",0);
		$this->db->JOIN("modulos","modulos.modulo_id = secciones.modulo_id");
        $this->db->order_by("orden");
        $rs = $this->db->get("secciones");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function ver_Modulos(){

        $this->db->select("modulo_id, nombre_mod, estatus");
        $rs = $this->db->get("modulos");
        return $rs->num_rows() >0 ? $rs->result() : null;
        
    }

    public function sel_Modulos($id){

        $this->db->select('S.estatus, m.nombre_mod');
        $this->db->from('secciones as S');
        $this->db->join('modulos as m', 'S.modulo_id = m.modulo_id');
        $this->db->where('S.seccion_id', $id);
        
        $query = $this->db->get("secciones");
        return $query->num_rows() >= 1 ? $query->row() : null;
    }

    public function inserta_Secciones($data){ 
        
        $this->db->insert("secciones",$data);
        return $this->db->affected_rows() >=1;

    }

    public function update_Secciones($data, $id){
        
        $this->db->where("seccion_id",$id);
        $this->db->update("secciones", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function estatus_Secciones($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("seccion_id", $id);
        $this->db->update("secciones");
        return $this->db->affected_rows() >0;

    }

    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("seccion_id",$id);
        $this->db->update("secciones");
        return $this->db->affected_rows() >0;

    }

} //termina modelo
