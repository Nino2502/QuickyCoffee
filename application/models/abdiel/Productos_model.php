<?php
defined('BASEPATH') or exit('no direct script acces allowed');

class Productos_model extends CI_Model
{

    public function get_servicios_impresos(){
      $this->db->select('s.idCS, s.precioS AS precio, s.idS, 
      s.precioImpresion , (s.precioS + s.precioImpresion) AS precioS , s.desS, s.noImpreso, 
      s.image_url, s.impresion, s.idAS , a.nombreAgrupaS as nombreS');
      $this->db->from('servicios as s');
      $this->db->join('agrupacionServicio as a', 'a.idAgrupacionS = s.idAS');
      $this->db->where('s.impresion', 1);
      $this->db->where('s.estatus', 1);
      $this->db->where('a.estatus', 1);
      $this->db->group_by('a.idAgrupacionS');
	  $this->db->limit(18);

      $rs = $this->db->get();

      return $rs->num_rows() >= 1 ? $rs->result(): NULL;
      
    }
	
	
	public function get_servicios_sin_agrupa(){
		  $this->db->select('s.idCS, s.precioS AS precio, s.idS,
		  s.precioImpresion, (s.precioS + s.precioImpresion) AS precioS, s.desS, s.noImpreso, s.impresion,
		  s.image_url, s.impresion, s.idAS , s.nombreS');
		  $this->db->from('servicios as s');
		  $this->db->where('s.idAS',0);
		  $this->db->where('s.impresion', 1);
		  //$this->db->where('s.noImpreso',1);
		  $this->db->where('s.estatus', 1);
		  $this->db->group_by('s.idS');
		
		  $rs = $this->db->get();    
		  return $rs->num_rows() >= 1 ? $rs->result() : NULL;
		}
		
	
	public function no_impresos_productos(){
		  $this->db->select('s.idCS, s.precioS AS precio, s.idS,
		  s.precioImpresion, (s.precioS + s.precioImpresion) AS precioS, s.desS, s.noImpreso, s.impresion,
		  s.image_url, s.impresion, s.idAS , s.nombreS');
		  $this->db->from('servicios as s');
		  $this->db->where('s.idAS',0);
		  //$this->db->where('s.impresion', 1);
		  $this->db->where('s.impresion',0);
		  $this->db->where('s.noImpreso',1);
		  $this->db->where('s.estatus', 1);
		  $this->db->group_by('s.idS');
		
		  $rs = $this->db->get();    
		  return $rs->num_rows() >= 1 ? $rs->result() : NULL;
		}
		

    public function get_servicios_impresos10r(){
      $this->db->select('s.idCS, s.precioS AS precio,
      s.precioImpresion , (s.precioS + s.precioImpresion) AS precioS , s.desS, s.noImpreso, 
      s.image_url, s.impresion, s.idAS , a.nombreAgrupaS as nombreS');
      $this->db->from('servicios as s');
      $this->db->join('agrupacionServicio as a', 'a.idAgrupacionS = s.idAS');
      $this->db->where('s.impresion', 1);
	  $this->db->where('s.estatus', 1);
      $this->db->where('a.estatus', 1);
      $this->db->group_by('a.idAgrupacionS');
      $this->db->limit(10); // Limitar a un máximo de 10 registros
      $this->db->order_by('RAND()');// Ordenar los resultados de forma
      $rs = $this->db->get();
     
      
      return $rs->num_rows() >= 1 ? $rs->result(): NULL;
      
    }
    public function get_servicios_noimpresos(){
      $this->db->select('s.idS, s.desS, s.idCS, s.precioS, s.image_url, s.noImpreso, s.impresion, s.idAS, a.nombreAgrupaS as nombreS');
      $this->db->from('servicios as s');
      $this->db->join('agrupacionServicio as a', 'a.idAgrupacionS = s.idAS');
      $this->db->where('s.noImpreso', 1);
	  $this->db->where('s.impresion',0);
	  $this->db->where('s.estatus', 1);
      $this->db->where('a.estatus', 1);
      $this->db->group_by('a.idAgrupacionS');
      //$this->db->limit(10); // Limitar a un máximo de 10 registros
      //$this->db->order_by('RAND()');// Ordenar los resultados de forma aleatoria
      $rs = $this->db->get();

      return $rs->num_rows() >= 1 ? $rs->result(): NULL;
        
      }
        public function get_servicios_noimpresos10r(){
      $this->db->select('s.idS, s.desS, s.idCS, s.precioS, s.image_url, s.noImpreso, s.impresion, s.idAS, a.nombreAgrupaS as nombreS');
      $this->db->from('servicios as s');
      $this->db->join('agrupacionServicio as a', 'a.idAgrupacionS = s.idAS');
      $this->db->where('s.noImpreso', 1);
      $this->db->where('a.estatus', 1);
      $this->db->group_by('a.idAgrupacionS');
      $this->db->limit(10); // Limitar a un máximo de 10 registros
      $this->db->order_by('RAND()');// Ordenar los resultados de forma aleatoria
      $rs = $this->db->get();
     
      
      return $rs->num_rows() >= 1 ? $rs->result(): NULL;
        
      }
   
        
        // public function search($q) {
        //     $this->db->or_like(array(
        //         'nombreS' => $q,
        //         'desS' => $q
        //     ));
            
        //     $query = $this->db->get('servicios');
        //     return $query->result_array();
        // }


              
        public function search($q) {
          $this->db->or_like(array(
              'nombreS' => $q,
              'desS' => $q,
              'nombreAgrupaS' => $q,
			  'nombreS' => $q
          ));
          $this->db->select('s.idS, s.nombreS as nombreServicio, s.precioS, a.idAgrupacionS AS idAS, s.desS, s.image_url, s.noImpreso, s.impresion,  a.nombreAgrupaS as nombreS ');
          $this->db->from('servicios as s');
          $this->db->join('agrupacionServicio as a', 'a.idAgrupacionS = s.idAS');
          $this->db->where('s.noImpreso', 1);
          $this->db->where('a.estatus', 1);
          $this->db->group_by('a.idAgrupacionS');
          $query = $this->db->get();
          return $query->result();
      }
  

        public function get_categorias(){
          $this->db->select("idCS, nombreCS, desCS, imagen ");
          $this->db->where("estatus", 1);
         
          
          $rs = $this->db->get("categoriasServicios");
          
          return $rs->num_rows() >= 1 ? $rs->result(): NULL;
        }



      public function get_servicios_impresos10(){
$this->db->select('s.idS, s.desS, s.idCS, s.precioS AS precio, s.precioImpresion,
            (s.precioS + s.precioImpresion) AS precioS, s.noImpreso,
            s.image_url, s.impresion, s.idAS, a.nombreAgrupaS, SUM(d.Cantidad) AS TotalVentas');
        $this->db->from('DetalleVentas AS d');
        $this->db->join('servicios AS s', 'd.idServicio = s.idS');
        $this->db->join('agrupacionServicio AS a', 'a.idAgrupacionS = s.idAS');
        $this->db->where('s.impresion', 1);
		$this->db->where('s.estatus', 1);
        $this->db->where('a.estatus', 1);
        $this->db->group_by('s.idAS');
        $this->db->order_by('TotalVentas', 'DESC');
        $this->db->limit(25);
        $rs = $this->db->get();
        return $rs->num_rows() >= 1 ? $rs->result(): NULL;
        
      }
	 
	 
	 public function get_randos(){
		$this->db->select('s.idS, s.desS, s.idCS, s.precioS AS precio, s.precioImpresion,
            (s.precioS + s.precioImpresion) AS precioS, s.noImpreso,
            s.image_url, s.impresion, s.idAS, d.Cantidad AS TotalVentas');
        
		$this->db->from('servicios AS s');
        
		$this->db->join('DetalleVentas AS d', 's.idS = d.idServicio');
		//$this->db->join('agrupacionServicio AS a', 'a.idAgrupacionS = s.idAS');
		$this->db->where('s.noImpreso', 1);
		$this->db->where('s.estatus', 1);
		//$this->db->where('a.estatus', 1);
		$this->db->order_by('TotalVentas', 'DESC');
		//$this->db->order_by('RAND()');
        $this->db->limit(10);
        $rs = $this->db->get();
        return $rs->num_rows() >= 1 ? $rs->result(): NULL;
        
      }
	  public function get_randos_impresos(){
		$this->db->select('s.idS, s.desS, s.idCS, s.precioS as precio, s.precioImpresion, (s.precioS + precioImpresion) AS precioS, s.noImpreso, s.image_url, s.idAS, a.nombreAgrupaS');
		
		$this->db->from('servicios AS s');
		
		$this->db->join('agrupacionServicio AS a','a.idAgrupacionS = s.idAS');
		$this->db->join("inventario", "inventario.idS = s.idS", 'left');
		
		$this->db->where("inventario.inventario >=", 1);
		
		$this->db->where('s.impresion',1);
		
		$this->db->where('s.estatus',1);
		$this->db->where('a.estatus', 1);
		
		//$this->db->order_by('RAND()');
		
		//$this->db->limit(5);
		
		$rs = $this->db->get();
		
		return $rs->num_rows() >= 1 ? $rs->result() : NULL; 
		 
		 
		 
	}
	
	public function get_randos_noimpresos(){
		$this->db->select('s.idS, s.desS, s.idCS, s.precioS as precio, s.precioImpresion, (s.precioS + precioImpresion) AS precioS, s.noImpreso, s.image_url, s.idAS, a.nombreAgrupaS');
		
		$this->db->from('servicios AS s');
		
		$this->db->join('agrupacionServicio AS a','a.idAgrupacionS = s.idAS');
		$this->db->join("inventario", "inventario.idS = s.idS", 'left');
		
		$this->db->where("inventario.inventario >=", 1);
		
		$this->db->where('s.noImpreso',1);
		
		$this->db->where('s.estatus',1);
		
		$this->db->where('a.estatus', 1);
		
		$this->db->order_by('RAND()');
		
		$this->db->limit(10);
		
		$rs = $this->db->get();
		
		return $rs->num_rows() >= 1 ? $rs->result() : NULL; 
		 
		 
		 
	}
	  

      public function mas_vendidos_impresos(){
        $this->db->select('idS, nombreS, SUM(cantidad) as TotalVentas, idSuc, image_url, desS, impresion, precioS, precioImpresion, idAS, nombreAgrupaS, precio');
        $this->db->from('(SELECT dv.idDV, dv.idVenta, cantidad, idServicio, nombreS, fechaVentaG, idEmpleado, us.idSuc, s.image_url
            FROM DetalleVentas as dv
            INNER JOIN Ventas as v ON v.idVenta = dv.idVenta
            INNER JOIN servicios as s ON s.idS = dv.idServicio
            INNER JOIN usuarios as us ON us.idU = v.idEmpleado
            WHERE s.estatus = 1 AND s.impresion = 1) as t1');
        $this->db->group_by('idServicio');
        $this->db->order_by('sumaCantidad', 'DESC');
        $this->db->limit(18);

        $rs = $this->db->get();
       
        
        return $rs->num_rows() >= 1 ? $rs->result(): NULL;
        
      }	  
      
    public function get_servicios_noimpresos10(){
    $this->db->select('s.idS, s.desS, s.idCS, s.precioS, s.precioImpresion, s.image_url, s.noImpreso,
    s.impresion, s.idAS, a.nombreAgrupaS, SUM(d.Cantidad) AS TotalVentas');
            $this->db->from('DetalleVentas AS d');
            $this->db->join('servicios AS s', 'd.idServicio = s.idS');
            $this->db->join('agrupacionServicio AS a', 'a.idAgrupacionS = s.idAS');
            $this->db->where('s.impresion', 1);
			$this->db->where('s.estatus', 1);
            $this->db->where('a.estatus', 1);
            $this->db->group_by('s.idAS');
            $this->db->order_by('TotalVentas', 'DESC');
            $this->db->limit(25);
            $rs = $this->db->get();
          
            
            return $rs->num_rows() >= 1 ? $rs->result(): NULL;
            
          }
        

        public function get_servicios_categoria_impresos($idCS){
      	$this->db->select('s.idS, s.desS, s.nombreS, s.image_url , s.idCS,
          s.precioS AS precio, s.precioImpresion , (s.precioS + s.precioImpresion) AS precioS ,
           s.noImpreso, s.impresion, s.idAS, a.nombreAgrupaS,s.estatus');
          $this->db->from('servicios s');
          $this->db->join('agrupacionServicio a', 'a.idAgrupacionS = s.idAS');
          $this->db->where('s.impresion', 1);
          $this->db->where('a.estatus', 1);
		  $this->db->where('s.estatus', 1);
		  $this->db->where('s.idAS !=', 0);
          $this->db->where('s.idCS', $idCS);
          $this->db->group_by('a.idAgrupacionS');
          $rs = $this->db->get();
          return $rs->num_rows() >= 1 ? $rs->result() : NULL;
      }



      public function get_servicios_categoria_noimpresos($idCS){
        $this->db->select('s.idS, s.desS, s.nombreS, s.image_url , s.idCS, s.precioS, s.noImpreso, s.impresion, s.idAS, a.nombreAgrupaS');
        $this->db->from('servicios s');
        $this->db->join('agrupacionServicio a', 'a.idAgrupacionS = s.idAS');
        $this->db->where('s.noImpreso', 1);
		$this->db->where('s.estatus', 1);
        $this->db->where('a.estatus', 1);
		$this->db->where('s.idAS !=', 0);
        $this->db->where('s.idCS', $idCS);
        $this->db->group_by('a.idAgrupacionS');
        $rs = $this->db->get();
        return $rs->num_rows() >= 1 ? $rs->result() : NULL;
      }

}
