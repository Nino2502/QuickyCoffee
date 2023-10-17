<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Favoritos extends CI_Controller {

public function OrdenCompra(){
        $idEmpleado     = $this->idUsuario;
        $total          = $this->input->post("total");
        $Carrito        = $this->input->post("Array");
        $idCliente      = $this->input->post("idCliente");
        $idFP           = $this->input->post("idFP");

        $idSucursal     = $this->LevantarOrden_model->getSucursalEmpleado($idEmpleado); //Obtenemos la sucursal del empleado y nombre de la sucursal
          
        

        if($idSucursal != null){

            /**Genera token venta */
            $nombreCliente = $idSucursal->nombreU;
            $uniqid = uniqid("", true);
            $timestamp = time();
            $combined_string = $nombreCliente . $uniqid . $timestamp;
            $token = md5($combined_string);
            /**termina tokenVenta */


                
                $res = json_decode($Carrito);
                $new_array = array();

                foreach ($res[0] as $item) {
                $obj_data = array();
                    for ($i = 0; $i < count($item); $i+=2) {
                        if ($item[$i] == "idServicio" || $item[$i] == "PrecioUnitario" || $item[$i] == "Cantidad") {
                        $obj_data[$item[$i]] = $item[$i+1];
                        }
                    }
                $new_array[] = $obj_data;
                }
                $carritoFinal = array();
                $carritoFinal[] = $new_array;

                
            
                //Generamos la venta y obtenemos el id de la venta
                $arrData = array(
                   
                    'tokenVenta' => $token,
                    'idCliente' => $idCliente,
                    'idEmpleado' => $idEmpleado,
                    'idFP'       => $idFP,
                    'idEP'       => 1,
                    'Factura'    =>  'TEST, this will change',
                    'FechaVentaG' => date('Y-m-d H:i:s'),
                    'CierreCliente' => 1,
                    'CierreEmpleado' => 1,
                    'FechaVentaCierre' => date('Y-m-d H:i:s'),
                    'TotalVenta' => $total,
                

                );

                $idVenta = $this->LevantarOrden_model->GenerarVenta($arrData);

                if($idVenta != null){
                    foreach ($carritoFinal[0] as &$venta) {
                        $venta["idVenta"] = $idVenta;
                        $venta["idSuc"] = $idSucursal->idSuc;
                    }

                    $data["Registro"] = $this->LevantarOrden_model->InsertarDetalleVenta($carritoFinal[0]);
    
                   
                }else{
                    $data["resultado"]  = false;
                    $data["mensaje"]    = "Error al registrar venta";
                    $data["Registro"]   = null;
                }

                 
                $data["resultado"]  = $data["Registro"] != false  ? true : false;
                $data["mensaje"]    = $data["resultado"] ? "Compra registrada" : "ERROR en realizar la compra";


        }else{
            $data["resultado"]  = false;
            $data["mensaje"]    = "Error al obtener sucursal del empleado";
            $data["Registro"]   = null;

        }

         echo JSON_encode($data);
    }
}