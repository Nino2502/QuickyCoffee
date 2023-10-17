<?php

class Home_model extends CI_Model{

    public function get_Compras($id) {
        $this->db->select('*');
        $this->db->from('Ventas as v');
        $this->db->join('estatus_venta as EV', 'EV.id = v.estatus');
        $this->db->join('sucursales as Suc', 'Suc.idSuc = v.idSuc');
		$this->db->join('estatus_venta as ET','v.estatus = ET.id');
        $this->db->where('v.idCliente', $id);
        $this->db->where_in('v.estatus', array(1,2,3,4));
        $query = $this->db->get();
        return $query->result();
    }

    public function get_Detalle($id) {
        $this->db->select('DV.*, s.nombreS, s.image_url, Suc.nombreSuc');
        $this->db->JOIN("servicios AS s","s.idS = DV.idServicio");
        $this->db->JOIN("sucursales AS Suc","Suc.idSuc = DV.idSuc");
        $this->db->where('idVenta', $id);

        $rs = $this->db->get('DetalleVentas AS DV');
        return $rs->num_rows() > 0 ? $rs->result() : null;
    }
	
	
	public function get_DetalleFactura($id) {
        $query = '
				select V.idVenta, V.tokenVEnta, V.idSuc, V.idCliente,
				V.Factura, V.FechaVentaG, V.TotalVenta, DV.idServicio,
				S.nombreS, Suc.nombreSuc,
				DV.cantidad, DV.precioUnitario, DV.ProductoComentario, DV.Subtotal

				from Ventas as V
				inner join DetalleVentas as DV on DV.idVenta = V.idVenta
				inner join servicios as S on DV.idServicio = S.idS
				inner join sucursales as Suc on Suc.idSuc = V.idSuc
				where V.idVenta ='.$id;

        $rs = $this->db->query($query);
		return $rs->num_rows() >=1 ? $rs->result() : NULL;
		
		
    }
	
	
	public function get_datos_factura($idCliente,$idVenta,$idToken){
		$query = 'Select V.Factura, V.idFiscales, F.Fecha, Serie, FormaPago,  DomicilioFiscalReceptor, 
					NoCertificado, rfcReceptor, razonSocial, RegimenFiscalReceptor, UsoCFDI, PDF, XML, Sello from Ventas as V
					inner join factura as F on F.Folio = V.Factura
					where V.idCliente = '.$idCliente.'  and V.idVenta = '.$idVenta.' and V.tokenVenta = "'.$idToken. '"';
		$rs = $this->db->query($query);
		return $rs->num_rows() >=1 ? $rs->row() : NULL;
		
	}
	
	
	
	
	public function get_DetalleVentaPublico($idCliente, $idVenta, $idToken) {
        $query = '
				select V.idVenta, V.tokenVEnta, V.idSuc, V.idCliente,
				V.Factura, V.FechaVentaG, V.TotalVenta, DV.idServicio,
				S.nombreS, Suc.nombreSuc,
				DV.cantidad, DV.precioUnitario, DV.ProductoComentario, DV.Subtotal

				from Ventas as V
				inner join DetalleVentas as DV on DV.idVenta = V.idVenta
				inner join servicios as S on DV.idServicio = S.idS
				inner join sucursales as Suc on Suc.idSuc = V.idSuc
				where V.idCliente = '.$idCliente.'  and V.idVenta = '.$idVenta.' and V.tokenVenta = "'.$idToken. '"';

        $rs = $this->db->query($query);
		return $rs->num_rows() >=1 ? $rs->result() : NULL;
		
		
    }
	
	
	public function datoFactura($idFactura){
		
		$this->db->select("*");
		$this->db->where("idFactura", $idFactura);
		$rs = $this->db->get("factura");
		return $rs->num_rows() >=1 ? $rs->row() : NULL;
		
	}
	
	
	
	
	
	public function detalleVentaParaFactura($idVenta){
		
		$this->db->select("idVenta, DATE_FORMAT(FechaVentaG, '%Y-%m-%d') as fechaCompra, TotalVenta, tokenVEnta");
		$this->db->where("idVenta", $idVenta);
		$rs = $this->db->get("Ventas");
		return $rs->num_rows() >0 ? $rs->result(): NULL;
		
	}
	
	
	
	
}