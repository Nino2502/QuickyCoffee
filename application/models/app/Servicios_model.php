<?php class Servicios_model extends CI_Model{


    public function ver_Servicios(){

        $this->db->select("servicios.*, categoriasServicios.nombreCS, unidades.nombreUni, politicas.nombrePol, atributos_adicionales.nombreAtrD");
        $this->db->where("servicios.estatus",1);
        $this->db->or_where("servicios.estatus",0);
        $this->db->join("categoriasServicios", "categoriasServicios.idCS = servicios.idCS ");
        $this->db->join("unidades", "unidades.idUni = servicios.idUnidad", 'left');
        $this->db->join("politicas", "politicas.idPol = servicios.idPolImpre", 'left');
		$this->db->join("atributos_adicionales","atributos_adicionales.idAtrD = servicios.PM", 'left');
        $rs = $this->db->get("servicios");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }
	
  public function ver_CatServicios(){

        $this->db->select("categoriasServicios.idCS, nombreCS");
	  	$this->db->distinct("nombreCS");
        $this->db->where("servicios.estatus",1);
        $this->db->or_where("servicios.estatus",0);
        $this->db->join("categoriasServicios", "categoriasServicios.idCS = servicios.idCS ");
        $rs = $this->db->get("servicios");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }
	
	public function ver_atributos_adicionales(){
		$this->db->select("*");
		$this->db->where('estatus',1);
		$this->db->where("cat",2);
		$rs = $this->db->get("atributos_adicionales");
		return $rs->num_rows() > 0 ? $rs->result() : null;
		
	
	}

    public function ver_ingredientes(){
		$this->db->select("*");
		$this->db->where('estatus',1);
		$rs = $this->db->get("inventario_pizzas");
		return $rs->num_rows() > 0 ? $rs->result() : null;
		
	
	}
	
	public function ver_promocionales(){
		$this->db->select("*");
		$this->db->where("estatus",1);
		$this->db->where('cat',3);
		$rs = $this->db->get("atributos_adicionales");
		return $rs->num_rows() > 0 ? $rs->result() : null;
		
	
	
	}
	
	
	
	public function inserta_atributos_mas($data){

        $this->db->insert_batch("log_atributos_mas",$data);
        return $this->db->affected_rows() >=1 ;

    }
	public function delete_servicio($idS){
		$this->db->where("idS",$idS);
		$this->db->delete('log_atributos_mas');
		return $this->db->affected_rows() >=1 ;
	
	}

	
	public function ver_precios_bases(){
		$this->db->select("*");
		$this->db->where('estatus',1);
		$this->db->where("cat",1);
		$rs = $this->db->get("atributos_adicionales");
		return $rs->num_rows() > 0 ? $rs->result() : null;
		
	
	}
	
	
	public function buscarDuplicado($idS){
		$this->db->where("idS", $idS);
		$rs = $this->db->get("servicios");
		return $rs->num_rows() >=1 ; 
	}
	
	

    public function get_Servicio($id){

		$query = 'SELECT servicios.*, categoriasServicios.nombreCS, unidades.nombreUni FROM servicios JOIN categoriasServicios ON categoriasServicios.idCS = servicios.idCS LEFT JOIN unidades ON unidades.idUni = servicios.idUnidad WHERE servicios.idS like "'.$id.'" AND (servicios.estatus = 1 OR servicios.estatus = 0)';
	
        $rs = $this->db->query($query);
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function inserta_Servicios($data){
        
         $this->db->insert("servicios",$data);
        return $this->db->affected_rows() >=1 ;

    }

    public function update_Servicios($data, $id){
        
        $this->db->where("idS",$id);
        $this->db->update("servicios", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function single_entry($id){
		
        $this->db->select('*');
        $this->db->from('servicios');
        $this->db->where('idS', $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    public function inserta_servicioAtributos($data){
		
       $this->db->insert("servicioAtributo",$data);
       return $this->db->affected_rows() >=1;
    }

   public function borra_servicioAtributos($id){

        $this->db->where('idS', $id);
        $this->db->delete('servicioAtributo');
        return $this->db->affected_rows() >=1;

   }
	
	
	  public function borra_PreciosDinamicos($id){

        $this->db->where('idS', $id);
        $this->db->delete('preciosServicios');
        return $this->db->affected_rows() >=1;

   }
   
		public function precio_adicionales_mas($arr){

			
	
			$this->db->select("idAtrD,nombreAtrD");
			$this->db->where("atributos_adicionales.estatus",1);
			$this->db->where("atributos_adicionales.cat",1);
			$this->db->where_in('idAtrD', $arr);
			$rs = $this->db->get("atributos_adicionales");
			return $rs->num_rows() >0 ? $rs->result() : null;
	
		}
	
	public function atributos_adicionales_mas($arr){

			
	
			$this->db->select("idAtrD,nombreAtrD");
			$this->db->where("atributos_adicionales.estatus",1);
			$this->db->where("atributos_adicionales.cat",2);
			$this->db->where_in('idAtrD', $arr);
			$rs = $this->db->get("atributos_adicionales");
			return $rs->num_rows() >0 ? $rs->result() : null;
	
		}
	
	
	public function servop(){

        $this->db->select("*");//,atencion_servicio.id_as as idat,atencion_servicio.nombre as nat
        $this->db->where("atributos_adicionales.estatus",1);
		$this->db->where("atributos_adicionales.cat",1);
        $rs = $this->db->get("atributos_adicionales");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }
	
	public function servop2(){

        $this->db->select("*");//,atencion_servicio.id_as as idat,atencion_servicio.nombre as nat
        $this->db->where("atributos_adicionales.estatus",1);
		$this->db->where("atributos_adicionales.cat",2);
        $rs = $this->db->get("atributos_adicionales");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }


    

    public function estatus_Servicios($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("idS", $id);
        $this->db->update("servicios");
        return $this->db->affected_rows() >0;

    }

    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idS",$id);
        $this->db->update("servicios");
        return $this->db->affected_rows() >0;

    }
	
	
	 public function ver_Servicio($id){

        $this->db->select("servicios.*, categoriasServicios.nombreCS ");
		$this->db->where("idS", $id);
        $this->db->join("categoriasServicios", "categoriasServicios.idCS = servicios.idCS ");
        $rs = $this->db->get("servicios");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }
	
	
	public function insertaPreciosServicios($data){
		$this->db->insert_batch('preciosServicios', $data);
		return $this->db->affected_rows() >=1 ;
		
	}
	
	
	
	
	
	
	 public function get_PreciosDinamicosProducto($id){

		$query = 'select * from  preciosServicios where idS like "'.$id.'"  and categoria = 2';
	
        $rs = $this->db->query($query);
        return $rs->num_rows() >0 ? $rs->result() : null;

    }
	
	
	 public function get_PreciosDinamicosImpresion($id){

		$query = 'select * from  preciosServicios where idS like "'.$id.'" and categoria = 1';
	
        $rs = $this->db->query($query);
        return $rs->num_rows() >0 ? $rs->result() : null;

    }
	
	
	
	
	
	
	
    


}
?>