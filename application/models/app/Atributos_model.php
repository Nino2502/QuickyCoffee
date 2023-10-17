<?php

class Atributos_model extends CI_Model{


    public function ver_atributos(){

        $this->db->select("*");
        $this->db->where("estatus",1);
        $this->db->or_where("estatus",0);
        $rs = $this->db->get("atributos");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function vista_previaC($id){
        $cmd =
        'SELECT *  FROM atributosCategoria JOIN categoriasServicios USING(idCS) where idAtr ='. $id ;

        $query = $this->db->query($cmd);
        return $query->num_rows() > 0 ? $query->result() : null;

    }

    public function get_atributos_de_servicio($id){

        $this->db->select("*");
        $this->db->where("idS",$id);
        $rs = $this->db->get("servicioAtributo");
        return $rs->num_rows() >=1 ? $rs->result(): NULL;

    }



    public function vista_previaATR($id){
        
        $this->db->select("*");
        $this->db->where("idAtr", $id);
        $rs = $this->db->get("detalleAtributo");
        return $rs->num_rows() > 0 ? $rs->result() : null;

    }
	
	public function modal_borrar($id){

		$this->db->where('idDAtr', $id);
		$this->db->delete('detalleAtributo');
        
		return $this->db->affected_rows() >=1;
		
	
	
	
	}


    public function vista_previa_atributos_de_categoria2($id){
        
        $this->db->select("atributos.idAtr, atributos.nombreAtr");
        
		$this->db->join("detalleAtributo", "detalleAtributo.idDAtr = servicioAtributo.idDAtr");
		$this->db->join("atributos", "atributos.idAtr = detalleAtributo.idAtr");
        $this->db->where("idS", $id);
		$this->db->distinct("atributos.nombreAtr");
        $rs = $this->db->get("servicioAtributo");

        return $rs->num_rows() > 0 ? $rs->result() : null;

    }
	
	
	  public function vista_previa_atributos_de_categoria($id){
        
        $this->db->select("*");
        $this->db->join("atributos", "atributosCategoria.idAtr = atributos.idAtr");
        $this->db->where("idCS", $id);
        $rs = $this->db->get("atributosCategoria");

        return $rs->num_rows() > 0 ? $rs->result() : null;

    }







    public function inserta_nombre_atributos($data){ 
        $this->db->insert("atributos",$data);
        return $this->db->affected_rows() >=1 ? $this->db->insert_id(): "false";
    }

    public function inserta_categorias_atributos($data){
        $rs = $this->db->insert("atributosCategoria", $data);
        return $this->db->affected_rows() >=1 ? "true": "false";
    }

    public function inserta_detalle_atributo($data){
        $rs = $this->db->insert("detalleAtributo", $data);
        return $this->db->affected_rows() >=1 ? "true": "false";
    }


    public function borra_detalle_atributo($id){

        $this->db->where('idAtr', $id);
        $this->db->delete('detalleAtributo');
        return $this->db->affected_rows() >=1;

    }

    public function borra_atributo_categoria($id){

        $this->db->where('idAtr', $id);
        $this->db->delete('atributosCategoria');
        return $this->db->affected_rows() >=1;
    }



    public function update_atributos($data, $id){
        
        $this->db->where("idAtr",$id);
        $this->db->update("atributos", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function estatus_atributos($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("idAtr", $id);
        $this->db->update("atributos");
        return $this->db->affected_rows() >0;

    }

    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idAtr",$id);
        $this->db->update("atributos");
        return $this->db->affected_rows() >0;

    }
	
	public function update_atributos_model($data, $id){

        $this->db->where("idDAtr",$id);
        $this->db->update("detalleAtributo", $data);
        return $this->db->affected_rows() >=1 ;

    }

} //termina modelo


?>