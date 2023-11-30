<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carrito extends CI_Controller {



    
     public function contenido_carrito(){
            json_header();
            $idC = $this-> input -> post('idC');
			
			//$idC = 38;
           // $idU = $this-> input -> post('idU');
            $this->load->model('abdiel/Carrito_model');
            $data = $this->Carrito_model->items_carrito( $idC);
            $total = $this->Carrito_model->total_carrito( $idC);
            $response= array();
            if ($data!== null){
                $response['data'] = $data;
                $response['total'] = $total;
            }else{
               // echo "No existe la cuenta o los datos son incorrectos";
               $response['data'] = [];
               $response['total'] = null;

            }
            echo json_encode($response);
        }
    
    public function add_item(){
        json_header();
        //idC - idCarrito, idS - Servicio, cout -cantidad, idSuc - sucursal
        $idC = $this-> input -> post('idC');
        $idS = $this-> input -> post('idS');
        $count = $this-> input -> post('count');
        $idSuc = $this-> input -> post('idSuc');
        $precio = $this-> input -> post('precio');
        $impreso = $this-> input -> post('impreso');
        $comentario = $this-> input -> post('comentario');
		$promocionales = $this-> input -> post('promocionales');
		
        $this->load->model('abdiel/Carrito_model');
        $data = $this->Carrito_model->agregar( $idC, $idS, $count, $idSuc, $precio, $impreso, $comentario, $promocionales);
        echo json_encode($data);
    }
    
    public function delete_item(){
        json_header();
        $id = $this-> input -> post('id');
        
        
        $this->load->model('abdiel/Carrito_model');
        $data = $this->Carrito_model->borrar( $id);
        echo json_encode($data);
    }
    
    public function get_total(){
        json_header();
        $idC = $this-> input -> post('idC');
        $this->load->model('abdiel/Carrito_model');
        $data = $this->Carrito_model->total_carrito( $idC);
        echo json_encode($data);
    }
    
}