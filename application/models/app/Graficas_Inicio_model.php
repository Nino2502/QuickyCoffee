<?php

class Graficas_Inicio_model extends CI_Model{


    public function ver_Graficas_Inicio_major($idSuc, $idAnio, $idMes){
		
		
		
		
		
		
		$query = "SELECT 
    idServicio, 
    nombreS, 
    SUM(cantidad) AS sumaCantidad, 
    idSuc, 
    MAX(fechaVentaG) AS ultimaFechaVenta
FROM (
    SELECT 
        dv.idDV, 
        dv.idVenta, 
        cantidad, 
        idServicio,  
        nombreS, 
        fechaVentaG, 
        idEmpleado, 
        us.idSuc  
    FROM DetalleVentas AS dv 
    INNER JOIN Ventas AS v ON v.idVenta = dv.idVenta
    INNER JOIN servicios AS s ON s.idS = dv.idServicio
    INNER JOIN usuarios AS us ON us.idU = v.idEmpleado 
    WHERE us.idSuc  ". ($idSuc == 999 ? "IS NULL" : " = " .$idSuc) ." 
    AND fechaVentaG BETWEEN '".$idAnio."-".$idMes."-1' AND '".$idAnio."-".$idMes."-31'
) AS t1  
GROUP BY idServicio 
ORDER BY sumaCantidad DESC 
LIMIT 10;";


        $rs = $this->db->query($query);
		
		return $rs->num_rows() >=1 ? $rs->result() : NULL;
		

    }
	
	
	
	
	   public function ver_mas_vendido(){
		
		
		
		
		
		
		$query = "SELECT idServicio, nombreS, SUM(cantidad) sumaCantidad, idSuc, image_url FROM(
				  select dv.idDV, dv.idVenta,cantidad, idServicio,  nombreS, fechaVentaG, idEmpleado, us.idSuc, s.image_url  from
				   DetalleVentas as dv 
				   inner join Ventas as v on v.idVenta = dv.idVenta
				   inner join servicios as s on s.idS = dv.idServicio
				   inner join usuarios as us on us.idU = v.idEmpleado 
				    where s.estatus = 1 
				  ) as t1  GROUP BY idServicio ORDER BY sumaCantidad DESC limit 18
				";

        $rs = $this->db->query($query);
		
		return $rs->num_rows() >=1 ? $rs->result() : NULL;
		

    }
	
	
	

    

} //termina modelo


?>