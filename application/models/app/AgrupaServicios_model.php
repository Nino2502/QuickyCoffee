<?php

class AgrupaServicios_model extends CI_Model{


    public function ver_agrupa_servicios(){

        $this->db->select("*");
        $this->db->from("agrupaServicios");
        $this->db->join("tipoDeContratacion","tipoDeContratacion.idTC = agrupaServicios.idTC");
        $this->db->where("agrupaServicios.estatus",1);
        $this->db->or_where("agrupaServicios.estatus",0);
        
        $rs = $this->db->get();
        return $rs->num_rows() >0 ? $rs->result() : null;

    }


    public function vista_previa($id){
        $cmd =
        'SELECT *  FROM detalleAgrupaServicio JOIN servicios USING(idS) where idAS ='. $id ;

        $query = $this->db->query($cmd);
        return $query->num_rows() > 0 ? $query->result() : null;

    }

    public function inserta_nombre_agrupacion($data){
        
        $this->db->insert("agrupaServicios",$data);
        return $this->db->insert_id();

    }


    public function inserta_agrupa_servicios($data){
        
        $this->db->insert("detalleAgrupaServicio",$data);
        return $this->db->affected_rows() >=1 ;

    }


    public function update_agrupa_servicios($data, $id){
        
        $this->db->where("idAS",$id);
        $this->db->update("agrupaServicios", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function borra_agrupa_servicios($id){

        $this->db->where('idAS', $id);
        $this->db->delete('detalleAgrupaServicio');
        return $this->db->affected_rows() >=1;
        
    }





    public function estatus_agrupa_servicios($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("idAS", $id);
        $this->db->update("agrupaServicios");
        return $this->db->affected_rows() >0;

    }

    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idAS",$id);
        $this->db->update("agrupaServicios");
        return $this->db->affected_rows() >0;

    }

} //termina modelo


?>