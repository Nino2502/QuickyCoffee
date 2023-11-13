<?php
defined('BASEPATH') or exit('no direct script access allowed');

class Atributos_model extends CI_Model {


    public function ver_atributos( $idAS){
        $this->db->select('at.nombreAtr, at.idAtr');
        $this->db->from('servicios AS s');
        $this->db->join('agrupacionServicio AS a', 'a.idAgrupacionS = s.idAS');
        $this->db->join('servicioAtributo AS sa', 's.idS = sa.idS');
        $this->db->join('detalleAtributo AS d', 'sa.idDAtr = d.idDAtr');
        $this->db->join('atributos AS at', 'at.idAtr = sa.idAtr');
        $this->db->where('a.estatus', 1);
        $this->db->where('s.idAS', $idAS);
        $this->db->where('at.estatus', 1);
        $this->db->group_by('at.idAtr');
        
        $query = $this->db->get();
        return $query->result();
      }

      public function detalle_atributo($idAtr){
        $this->db->select('idDAtr, nombreDAtr');
        $this->db->from('detalleAtributo');
        $this->db->where('idAtr', $idAtr);

        $query = $this->db->get();
        return $query->result();
      }

      public function producto($array, $count, $idAS){
        $this->db->select('s.idS, s.nombreS');
        $this->db->from('servicios AS s');
        $this->db->join('servicioAtributo AS st', 's.idS = st.idS');
        $this->db->join('detalleAtributo AS da', 'st.idDAtr = da.idDAtr');
        $this->db->where_in('da.idDAtr', $array);
        $this->db->where('s.idAS', $idAS);
        $this->db->group_by('s.idS');
        $this->db->having('COUNT(DISTINCT da.idDAtr) =', $count);

        $query = $this->db->get();
        return $query->result();
        
      }

      public function productos_atributos($idAS){
        $this->db->select('s.sku, s.idS, s.nombreS, GROUP_CONCAT(at.nombreAtr, ": ", d.nombreDAtr) AS atributos');
        $this->db->from('servicios AS s');
        $this->db->join('agrupacionServicio AS a', 'a.idAgrupacionS = s.idAS');
        $this->db->join('servicioAtributo AS sa', 's.idS = sa.idS');
        $this->db->join('detalleAtributo AS d', 'sa.idDAtr = d.idDAtr');
        $this->db->join('atributos AS at', 'at.idAtr = sa.idAtr');
        $this->db->where('a.estatus', 1);
		$this->db->where('s.estatus', 1);
        $this->db->where('s.idAS', $idAS);
        $this->db->group_by('s.sku');

        $query = $this->db->get();
        return $query->result();

      }
          /* Obtiene datos del producto desun SKU*/

          public function get_servicios_by_sku($idS) {
            $this->db->select('s.idS, s.sku, s.nombreS, s.desS, s.precioS, s.noImpreso, s.impresion, 
            s.precioImpresion, s.areaImpresion, s.idPolImpre, s.image_url, s.cantidadMedioMayoreo, 
            s.precioMedioMayoreo, s.cantidadMayoreo, s.precioMayoreo, u.nombreUni, s.idUnidad');
            $this->db->from('servicios AS s');
            $this->db->join('unidades AS u', 'u.idUni = s.idUnidad');
            $this->db->where('s.idS', $idS);
    
            $query = $this->db->get();
            return $query->result();
        }


        public function get_servicios_by_sku_impresos($idS) {
			
          $this->db->select('s.idS, s.sku, s.nombreS, s.desS, 
          s.precioS AS precio, s.precioImpresion, (s.precioS + s.precioImpresion) AS precioS,
          s.noImpreso, s.impresion,  s.areaImpresion, s.idPolImpre, s.image_url, s.cantidadMedioMayoreo, 
          s.precioMedioMayoreo AS precioMedio, (s.precioMedioMayoreo + s.precioImpresion) AS precioMedioMayoreo, 
           s.cantidadMayoreo, u.nombreUni, s.idUnidad,
           s.precioMayoreo AS precioM, (s.precioMayoreo + s.precioImpresion) AS precioMayoreo ');
          $this->db->from('servicios AS s');
		  $this->db->where('s.estatus', 1);
          $this->db->join('unidades AS u', 'u.idUni = s.idUnidad');
          $this->db->where('s.idS', $idS);
  
          $query = $this->db->get();
          return $query->result();
      }

        public function get_inventario_by_ids($idS) {
          $this->db->select('p.idS, p.sku, p.nombreS, i.inventario, s.nombreSuc, s.idSuc');
          $this->db->from('inventario AS i');
          $this->db->join('servicios AS p', 'i.idS = p.idS');
          $this->db->join('sucursales AS s', 'i.idSuc = s.idSuc');
		  $this->db->where('s.estatus', 1);
          $this->db->where('p.idS', $idS);
  
          $query = $this->db->get();
          return $query->result();
      }
	  
		public function get_Servicio($id){
		
			$query = 'SELECT servicios.*, categoriasServicios.nombreCS, unidades.nombreUni FROM servicios JOIN categoriasServicios ON categoriasServicios.idCS = servicios.idCS LEFT JOIN unidades ON unidades.idUni = servicios.idUnidad WHERE servicios.idS like "'.$id.'" AND (servicios.estatus = 1 OR servicios.estatus = 0)';
			
			$rs = $this->db->query($query);
			return $rs->num_rows() >0 ? $rs->result() : null;
		
			}
			
	
		public function atributos_adicionales_mas($arr){

			
	
			$this->db->select("idAtrD,nombreAtrD,precio");
			$this->db->where("atributos_adicionales.estatus",1);
			$this->db->where("atributos_adicionales.cat",1);
			$this->db->where_in('idAtrD', $arr);
			$rs = $this->db->get("atributos_adicionales");
			return $rs->num_rows() >0 ? $rs->result() : null;
	
		}	
		
		public function atributos_adicionales_mas_2($arr){

			$this->db->select("idAtrD,nombreAtrD,precio");
			$this->db->where("atributos_adicionales.estatus",1);
			$this->db->where("atributos_adicionales.cat",2);
			$this->db->where_in('idAtrD', $arr);
			$rs = $this->db->get("atributos_adicionales");
			return $rs->num_rows() >0 ? $rs->result() : null;
	
		}	

    

}