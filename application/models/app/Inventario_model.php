<?php

class Inventario_model extends CI_Model{

/*
    public function ver_Inventario(){

        $this->db->select("idInv, sku, servicios.idS, nombreS, desS,precioS,inventario,nombreSuc" );
        $this->db->join("sucursales", "sucursales.idSuc = inventario.idSuc ");
        $this->db->join("servicios", "servicios.idS = inventario.idS ");
        $this->db->where("inventario.estatus",1);
        $rs = $this->db->get("inventario");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }
	*/
	
	
    public function ver_Inventario($idSuc){

        $this->db->select("sku, servicios.idS, nombreS, desS,precioS,inventario,nombreSuc, inventario.idSuc" );
        $this->db->join("sucursales", "sucursales.idSuc = inventario.idSuc ");
        $this->db->join("servicios", "servicios.idS = inventario.idS ");
		$this->db->where("inventario.idSuc",$idSuc);
      
        $rs = $this->db->get("inventario");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }
	
	
	


    public function comprueba_Inventario_Inicial($idSuc, $idS){

        $this->db->select("inventario.idInv, idSuc, idS, idAtr, idDatr " );
        $this->db->join("detalleInventario", "detalleInventario.idInv = inventario.idInv ");
		$this->db->where("idSuc",$idSuc);
		$this->db->where("idS",$idS);
        $rs = $this->db->get("inventario");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }
	
	
	/*nueva funcion */
	
	public function comprueba_Inventario($idS, $idSuc){

        $this->db->select("idS, idSuc, inventario" );
		
		$this->db->where("idS",$idS);
		$this->db->where("idSuc",$idSuc);
        $rs = $this->db->get("inventario");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }
	
	public function update_sumaCompra_Inventario($data, $idS, $idSuc){
        
        $this->db->where("idS",$idS);
		$this->db->where("idSuc",$idSuc);
        $this->db->update("inventario", $data);
        return $this->db->affected_rows() >=1 ;

    }
	
	
	public function update_restaTranspasoInventario($data, $idS, $idSuc){
        
        $this->db->where("idS",$idS);
		$this->db->where("idSuc",$idSuc);
        $this->db->update("inventario", $data);
        return $this->db->affected_rows() >=1 ;

    }
	
	
	
	
	
	public function inserta_Inventario($data){
        
        $this->db->insert("inventario",$data);
        return $this->db->affected_rows() >=1;

    }
	
	
	public function inserta_historico_Inventario($data){
        
        $this->db->insert("historicoInventario",$data);
        return $this->db->affected_rows() >=1;

    }
	
	
	
	
	


	
	
	/* termina nueva funcion */
	
	
	
	
	 public function prInveIn($idSuc, $idS){

        $this->db->select("inventario.idInv " );
        $this->db->join("detalleInventario", "detalleInventario.idInv = inventario.idInv ");
		$this->db->where("idSuc",$idSuc);
		$this->db->where("idS",$idS);
		$this->db->distinct("inventario.idInv");
        $rs = $this->db->get("inventario");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

/*
    public function ver_Atr_Inventario($id){

        $this->db->select("nombreAtr, nombreDAtr");
        $this->db->join("detalleAtributo", "detalleAtributo.idDAtr = detalleInventario.idDAtr");
        $this->db->join("atributos", "atributos.idAtr = detalleInventario.idAtr ");
        $this->db->where("idInv",$id);
        $rs = $this->db->get("detalleInventario");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }*/
	
	
	
	public function ver_Atr_Inventario2($id){

        $this->db->select("*");
        $this->db->join("detalleAtributo", "detalleAtributo.idDAtr = servicioAtributo.idDAtr");
        $this->db->where("idS",$id);
        $rs = $this->db->get("servicioAtributo");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

 
   

    

    public function inserta_inventarioAtributos($data){
        $this->db->insert("servicioAtributo",$data);
       return $this->db->affected_rows() >=1;
    }

   public function borra_inventarioAtributos($id){

        $this->db->where('idS', $id);
        $this->db->delete('servicioAtributo');
        return $this->db->affected_rows() >=1;

   }






    public function update_Inventario($data, $id){
        
        $this->db->where("idS",$id);
        $this->db->update("inventario", $data);
        return $this->db->affected_rows() >=1 ;

    }

    public function estatus_Inventario($id){

        $this->db->set("estatus", "1 - estatus", false);
        $this->db->where("idS", $id);
        $this->db->update("inventario");
        return $this->db->affected_rows() >0;

    }

    public function borradoLogico($id){

        $this->db->set("estatus", "3");
        $this->db->where("idS",$id);
        $this->db->update("inventario");
        return $this->db->affected_rows() >0;

    }
	
	
	 public function ver_Servicio($id){

        $this->db->select("inventario.*, categoriasinventario.nombreCS ");
		$this->db->where("idS", $id);
        $this->db->join("categoriasinventario", "categoriasinventario.idCS = inventario.idCS ");
        $rs = $this->db->get("inventario");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }
    






} //termina modelo


?>