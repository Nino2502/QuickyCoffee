<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidos extends CI_Controller {

    public function ver_pedidos(){
        json_header();
        $idU = $this-> input -> post('idU');
        $this->load->model('abdiel/Pedidos_model');
        $data = $this->Pedidos_model->get_ventas( $idU );
        echo json_encode($data);
    } 


    public function detalle_venta(){
        json_header();
        $idVenta = $this-> input -> post('idVenta');
        $this->load->model('abdiel/Pedidos_model');
        $data = $this->Pedidos_model->get_detalle( $idVenta );
        echo json_encode($data);
    }

    public function sucursales(){
        json_header();
        $this->load->model('abdiel/Pedidos_model');
        $data = $this->Pedidos_model->get_sucursales();
        echo json_encode($data);
    }

    public function nuevo_pedido(){
        json_header();
        //creamos una venta
        $idU        = $this-> input -> post('idU');
        $total      = $this-> input -> post('total');
        $idSuc      = $this-> input -> post('idSuc');
        $comentario = $this-> input -> post('comentario');
        //idCarrito
        $idC = $this-> input -> post('idC');
        $this->load->model('abdiel/Pedidos_model');
        $idVenta = $this->Pedidos_model->insert_venta($idU, $total, $idSuc, $comentario);
         
        $insertDetalle = $this->Pedidos_model->insert_detalle($idC, $idVenta);
        //$response =  array();
        if ($insertDetalle != true){
            echo "Error al insertar datos";
        } else {
          $borrarCarrito = $this->Pedidos_model->borrar_carrito($idC);  
          if ($borrarCarrito ==1){
            $response  = true;
          }  else {
            $response = false;
          }
         
        }
        
        echo json_encode($response);

    }
}