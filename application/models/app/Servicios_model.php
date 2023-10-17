<?php class Servicios_model extends CI_Model{


    public function ver_Servicios(){

        $this->db->select("servicios.*, categoriasServicios.nombreCS, unidades.nombreUni, politicas.nombrePol ");
        $this->db->where("servicios.estatus",1);
        $this->db->or_where("servicios.estatus",0);
        $this->db->join("categoriasServicios", "categoriasServicios.idCS = servicios.idCS ");
        $this->db->join("unidades", "unidades.idUni = servicios.idUnidad", 'left');
        $this->db->join("politicas", "politicas.idPol = servicios.idPolImpre", 'left');
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