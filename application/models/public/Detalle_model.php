<?php 




class Detalle_model extends CI_Model{
	
	
	

	
	
	
	 public function get_Servicio($id){
		
		
		
		$query = 'SELECT servicios.idCS, noImpreso,impresion, precioImpresion, servicios.image_url, servicios.nombreS, servicios.sku, servicios.precioS, servicios.desS,  categoriasServicios.nombreCS, unidades.nombreUni FROM servicios JOIN categoriasServicios ON categoriasServicios.idCS = servicios.idCS LEFT JOIN unidades ON unidades.idUni = servicios.idUnidad WHERE servicios.idS like "'.$id.'" AND (servicios.estatus = 1 OR servicios.estatus = 0)';
	
        $rs = $this->db->query($query);
        return $rs->num_rows() >0 ? $rs->result() : null;

    }
	
	
	
	 public function get_Servicios_impresos($idCS){
		
		
		
		$query = 'SELECT t1.idS, image_url, nombreS FROM (SELECT * FROM servicios where impresion = 1 and idCS = '.$idCS.') t1  inner join inventario as i on i.idS = t1.idS where t1.estatus = 1 and i.inventario >= 1 GROUP BY idS';
	
        $rs = $this->db->query($query);
        return $rs->num_rows() >0 ? $rs->result() : null;

    }
	
	
	
	 public function get_categorias_impresos(){
		
		
		
		$query = 'select  DISTINCT nombreCS, s.idCS, imagen from inventario as i
inner join servicios as s on s.idS = i.idS
inner join categoriasServicios as cs on cs.idCS = s.idCS
where inventario >= 1 and impresion = 1  and nombreCS not Like "Ventas rapidas"';
	
        $rs = $this->db->query($query);
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

	 public function get_categorias_Noimpresos(){
		
		
		
		$query = 'select  DISTINCT nombreCS, s.idCS, imagen from inventario as i
inner join servicios as s on s.idS = i.idS
inner join categoriasServicios as cs on cs.idCS = s.idCS
where inventario >= 1 and noImpreso = 1  and nombreCS not Like "Ventas rapidas"';
	
        $rs = $this->db->query($query);
        return $rs->num_rows() >0 ? $rs->result() : null;

    }
	
	
	
	 public function get_Servicios_noImpresos($idCS){
		
		
		
		$query = 'SELECT t1.idS, image_url, nombreS FROM (SELECT * FROM servicios where noImpreso = 1 and idCS = '.$idCS.') t1  inner join inventario as i on i.idS = t1.idS where t1.estatus = 1 and i.inventario >= 1 GROUP BY idS';
	
        $rs = $this->db->query($query);
        return $rs->num_rows() >0 ? $rs->result() : null;

    }
	
	
	
	
	
	
	
	
}





?>