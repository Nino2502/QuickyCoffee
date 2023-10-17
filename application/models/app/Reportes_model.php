<?php

class Reportes_model extends CI_Model{
	
	/*    $("#datatable").find("tbody").append(`
                        <tr id="tr-`+ o.idVenta+`">
                            <td>`+ c +`</td>
							<td class="text-wrap" style="width: 3rem;">`+(o.nombreSuc == null ? " Venta En Línea": o.nombreSuc)+`</td>
							<td>`+ o.idVenta+`</td>
                            <td>`+ o.FechaVentaG+`</td>
 							<td>`+ o.NombreCliente+`</td>
                            <td>`+(o.Factura == null ? "sin factura": o.Factura)+`</td>
                            <td>`+o.nombreEmpleado+`</td>
                            <td>`+o.TotalVenta+`</td>
                            <td><a href="#" onclick="VistaPrevia(` + o.idVenta + `,'` + o.tokenVenta + `','` + o.FechaVentaCierre + `')">
                                <i class="fa-solid fa-eye fa-2x"></i>
                            </a></td>
						   
                        </tr>`
                    );
					
					
				totalPagar += parseFloat(o.TotalVenta);*/
	
	
	
		
	public function reporte_de_ventas($selectSucursal = null, $selectCaja = null,  $selectFactura = null, $selectClientes = null, $selectTipoDePago = null, $fechaInicio = null, $fechaFin = null ){
		
		$query = '
			 select  idVenta,  FechaVentaG, SoloFecha, SoloTiempo,tokenVenta, 
			 Factura, TotalVenta,nombreSuc, 
			 c1.idFP, nombreFP,
			 u1.idSuc as idSucVendedor, u1.idU as idVendedor, u1.nombreU as nombreEmpleado,
			 u2.idU as idCliente, u2.nombreU as NombreCliente, FechaVentaCierre from
			 (select *, DATE_FORMAT(fechaVentaG, "%Y-%m-%d") as SoloFecha,
			 DATE_FORMAT(fechaVentaG, "%H:%i:%S" ) as SoloTiempo from Ventas) as c1 
			 inner join usuarios as u1 on u1.idU = c1.idEmpleado 
			 inner join usuarios as u2 on u2.idU = c1.idCliente 
			 left join sucursales as suc on suc.idSuc = u1.idSuc
			 inner join formaDePago as fp on fp.idFP = c1.idFP
			';
		
		$busqueda= "";
		
		
		//echo "dato de factura".   $selectFactura;
		//die();
		
		
		if($selectSucursal != null || $selectCaja != null  || $selectFactura != null || $selectClientes != null ||$selectTipoDePago != null ||  $fechaInicio != null || $fechaFin != null ){
			
			$query .= " where";
			
			
			if($selectSucursal != null){
				
				if($selectSucursal == "999"){
					$busqueda = " u1.idSuc IS NULL";
					
				}else{
					$busqueda = " u1.idSuc = $selectSucursal";
					
				}
				
				
			}
			
			
			if($selectCaja != null){
				if($busqueda != "")
					$busqueda .= " AND";
				$busqueda = " u1.idU = $selectCaja";
			}

			
			if($selectFactura != "" ){
				if($busqueda != "")
					$busqueda .= " AND";
				$busqueda .= ($selectFactura == 1 ? " Factura  IS NULL" : " Factura IS NOT NULL");
			}
			
			if($selectTipoDePago != null){
				if($busqueda != null)
					$busqueda .= " AND";
				$busqueda .= (" fp.idFP =  $selectTipoDePago");
			}
			
			if($selectClientes != null){
				if($busqueda != null)
					$busqueda .= " AND";
				$busqueda .= (" u2.idU =  $selectClientes");
			}

			
			if($fechaInicio != null ){
				if($busqueda != "")
					$busqueda .= " AND";
				$busqueda .= " SoloFecha BETWEEN '$fechaInicio'";	
				
			}
			
			
			if($fechaFin != null ){
				
				if($busqueda != "")
					$busqueda .= " AND";
					
				if($fechaInicio == null){
					
					$busqueda .= " SoloFecha <= '$fechaFin'";

				}else{
					$busqueda .= " '$fechaFin'";

				}	
			}
			
			
		}
		
		$query .= $busqueda . " ORDER BY FechaVentaG DESC";
		
		
		$rs = $this->db->query($query);
		
		return $rs->num_rows() >=1 ? $rs->result() : NULL;
		
		
	}
	
	
	
	
	
	
	// segundo reporte 
	
	
	public function reporte_de_gastos($selectTipoDeGasto = null,$selectSucursal = null,  $fechaInicio2 = null, $fechaFin2 = null ){
		
		$query = 'select cs.*, nombreTG, nombreProv, nombreSuc  from compras as cs left join proveedores as prov on prov.idProv = cs.idProv inner join tiposDeGastos as tdg on tdg.idTG = cs.idTG inner join sucursales as suc on suc.idSuc = cs.idSuc';
		
		$busqueda= "";
		
		
		//echo "dato de factura".   $selectFactura;
		//die();
		
		
		if($selectTipoDeGasto != null  || $selectSucursal != null|| $fechaInicio2 != null || $fechaFin2 != null ){
			
			$query .= " where";
			
			if($selectTipoDeGasto != null){
				$busqueda = " cs.idTG = $selectTipoDeGasto";
			}

			
			if($selectSucursal != null){
				$busqueda = " cs.idSuc = $selectSucursal";
			}
			
		

			
			if($fechaInicio2 != null ){
				if($busqueda != "")
					$busqueda .= " AND";
				$busqueda .= " fecha BETWEEN '$fechaInicio2'";	
				
			}
			
			
			if($fechaFin2 != null ){
				
				if($busqueda != "")
					$busqueda .= " AND";
					
				if($fechaInicio2 == null){
					
					$busqueda .= " fecha <= '$fechaFin2'";

				}else{
					$busqueda .= " '$fechaFin2'";

				}	
			}
			
			
		}
		
		$query .= $busqueda . " ORDER BY fecha DESC";
		
		
		$rs = $this->db->query($query);
		
		return $rs->num_rows() >=1 ? $rs->result() : NULL;
		
		
	}
	
	
	
	
	public function ventasVS($selectSucursal = null,  $selectFactura = null, $fechaInicio = null, $fechaFin = null ){
		
		
		//echo "<pre>";
		//echo $selectSucursal . " ". $selectFactura . " ". $fechaInicio . " ". $fechaFin ;
		
		
		
		
		
		$query = 'select  SUM(totalVenta) as sumaVentas, SoloFecha, Factura from
			 (select *, DATE_FORMAT(fechaVentaG, "%Y-%m-%d") as SoloFecha,
			  DATE_FORMAT(fechaVentaG, "%H:%i:%S" ) as SoloTiempo from Ventas) as c1 
			  inner join usuarios as u1 on u1.idU = c1.idEmpleado 
			  left join sucursales as suc on suc.idSuc = u1.idSuc';
	
		$busqueda= "";
		
		
		//echo "dato de factura".   $selectFactura;
		//die();
		
		
		if($selectSucursal != null   || $selectFactura != null  ||  $fechaInicio != null || $fechaFin != null ){
			
			$query .= " where";
			
			
			if($selectSucursal != null){
				
				if($selectSucursal == "999"){
					$busqueda = " u1.idSuc IS NULL";
					
				}else{
					$busqueda = " u1.idSuc = $selectSucursal";
					
				}
				
				
			}
			
			if($selectFactura != "" ){
				if($busqueda != "")
					$busqueda .= " AND";
				$busqueda .= ($selectFactura == 1 ? " Factura  IS NULL" : " Factura IS NOT NULL");
			}
			
			
			
			if($fechaInicio != null ){
				if($busqueda != "")
					$busqueda .= " AND";
				$busqueda .= " SoloFecha BETWEEN '$fechaInicio'";	
				
			}
			
			
			if($fechaFin != null ){
				
				if($busqueda != "")
					$busqueda .= " AND";
					
				if($fechaInicio == null){
					
					$busqueda .= " SoloFecha <= '$fechaFin'";

				}else{
					$busqueda .= " '$fechaFin'";

				}	
			}
			
			
		}
		
		
		
		$query .= $busqueda . " AND TipCambio IS NULL";
		
		$rs = $this->db->query($query);
		
		
		//echo $this->db->last_query();
		//die();
		
		return $rs->num_rows() >=1 ? $rs->result() : NULL;
		
		
		

	}
	
	
	
	
	public function gastosVS($selectSucursal = null,  $fechaInicio2 = null, $fechaFin2 = null ){
		
		$query = 'select cs.idSuc, SUM(total) as sumaGastos from compras as cs  inner join sucursales as suc on suc.idSuc = cs.idSuc';
		
		$busqueda= "";
		
		
		//echo "dato de factura".   $selectFactura;
		//die();
		
		
		if($selectSucursal != null|| $fechaInicio2 != null || $fechaFin2 != null ){
			
			$query .= " where";
			
			
			
			if($selectSucursal != null){
				$busqueda = " cs.idSuc = $selectSucursal";
			}
			
		

			
			if($fechaInicio2 != null ){
				if($busqueda != "")
					$busqueda .= " AND";
				$busqueda .= " fecha BETWEEN '$fechaInicio2'";	
				
			}
			
			
			if($fechaFin2 != null ){
				
				if($busqueda != "")
					$busqueda .= " AND";
					
				if($fechaInicio2 == null){
					
					$busqueda .= " fecha <= '$fechaFin2'";

				}else{
					$busqueda .= " '$fechaFin2'";

				}	
			}
			
			
		}
		
		
		$query .= $busqueda ;
		
		$rs = $this->db->query($query);
		
		return $rs->num_rows() >=1 ? $rs->result() : NULL;
		
		
	}

	public function get_Sucursal($id) {
        $this->db->select('*');
        $this->db->where('idSuc', $id);
    
        $rs2 = $this->db->get('sucursales');
        return $rs2->num_rows() > 0 ? $rs2->row() : null;
    }

	
	
	
	


  
	
	

} //termina modelo


?>