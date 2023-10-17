<?php 





class Facturacion_model extends CI_Model{
	
	
	
	
	public function verificaFactura($idVenta = 0, $token = "", $FechaVentaG = "", $TotalVenta=0){
		
		
		$query = 'select * from Ventas where idVenta = '.$idVenta.' and tokenVenta = "'.$token.'" and FechaVentaG BETWEEN "'.$FechaVentaG.' 00:00:00" and "'.$FechaVentaG.' 23:59:59" and TotalVenta = '. $TotalVenta ;
		
		
		
		$rs = $this->db->query($query);
		return $rs->num_rows() >= 1 ? $rs->result() : null;
		
	}
	
	
	
	
	public function valida_Venta($idVenta = 0){
		
		
		$query = 'select Factura from Ventas where idVenta = '.$idVenta;
		
		
		
		$rs = $this->db->query($query);
		return $rs->num_rows() >= 1 ? $rs->result() : null;
		
	}
	
	
	
		
	public function conceptos_Venta($idVenta = 0){
		
		
		$query = 'select V.idVenta, V.idFP, V.fechaVentaG, V.TotalVenta, 
					DV.idServicio, S.claveSat, S.sku, S.nombreS, S.desS,U.Clave, U.nombreUni, DV.Cantidad, 
					DV.PrecioUnitario, DV.subtotal  from Ventas as V 
					inner join DetalleVentas as DV on DV.idVenta = V.idVenta
					inner join servicios as S on S.idS = DV.idServicio
					inner join unidades as U on U.idUni = S.idUnidad
					where V.idVenta ='.$idVenta;
		
		
		
		$rs = $this->db->query($query);
		return $rs->num_rows() >= 1 ? $rs->result() : null;
		
	}
	
	
	public function actualizaVentaFactura($fecha, $folio, $idFiscal, $idVenta){
		
		$query = 'update Ventas set fechaFactura = "'.$fecha.'", factura = "'.$folio.'", idFiscales = "'.$idFiscal.'" where  idVenta ='. $idVenta;
        
        $this->db->query($query);
        return $this->db->affected_rows() >=1 ;
		
	}
	
	//update Ventas set fechaFactura = , factura = , idFiscales = where idVenta =


	
	
	public function insertaFactura($data){
		
		$this->db->insert("factura",$data);
        return $this->db->affected_rows() >=1;
		
	}
	
	
}


?>