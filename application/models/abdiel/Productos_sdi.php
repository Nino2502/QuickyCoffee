<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_sdi extends CI_Controller {

    function __construct(){
        parent::__construct(); 

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, OPTIONS");
	}

    public function index() {
        echo "Hola mundo";
      }
    
        public function ver_impresos()
        {
            json_header();
            $data = array();
            $this->load->model('abdiel/productos_model');
            $data = $this->productos_model->get_servicios_impresos();
            $response= array();
            if ($data!= null){
                $response['data'] = $data;
            }else{
               // echo "No existe la cuenta o los datos son incorrectos";
               $response['data'] = "No hay por el momento.";
            }
            echo json_encode($response);
        }
        

        public function ver_noimpresos()
        {
            json_header();
            $data = array();
            $this->load->model('abdiel/productos_model');
            $data = $this->productos_model->get_servicios_noimpresos();
            $response= array();
            if ($data!= null){
                $response['data'] = $data;
            }else{
               // echo "No existe la cuenta o los datos son incorrectos";
               $response['data'] = "No hay por el momento.";
            }
            echo json_encode($response);
        }

//El 10 es porque visualiza solo 10 productos, es para la vista principal // 

        public function ver_impresos10()
        {
            json_header();
            $data = array();
            $this->load->model('abdiel/productos_model');
            $data = $this->productos_model->get_servicios_impresos10();
			
			//$rand = $this->productos_model->get_randos();
									
			

            $response= array();
            if ($data!= null){
                $response['data'] = $data;
            }else{
               // echo "No existe la cuenta o los datos son incorrectos";
               //$response['data'] = "No hay por el momento.";
               
               $data2 = $this->productos_model->get_servicios_impresos10r();
               if ($data2 != null){
                   $response['data'] = $data2;
               }else{
                   $response['data'] = "No hay por el momento.";
               }
            }
            echo json_encode($response);
        }
        

        public function ver_noimpresos10()
        {
            json_header();
            $data = array();
            $this->load->model('abdiel/productos_model');
            $data = $this->productos_model->get_servicios_noimpresos10();
            $response= array();
            if ($data!= null){
                $response['data'] = $data;
           }else{
               // echo "No existe la cuenta o los datos son incorrectos";
               //$response['data'] = "No hay por el momento.";
               
               $data2 = $this->productos_model->get_servicios_noimpresos10r();
               if ($data2 != null){
                   $response['data'] = $data2;
               }else{
                   $response['data'] = "No hay por el momento.";
               }
            }
            echo json_encode($response);
        }
   

        public function buscar() {
            $q = $this->input->get('q');
            $this->load->model('abdiel/productos_model');
            $results = $this->productos_model->search($q);
            echo json_encode($results);
        }


        public function categorias(){
            json_header();
            $data = array();
            $this->load->model('abdiel/productos_model');
            $data = $this->productos_model->get_categorias();
            $response= array();
            if ($data!= null){
                $response['data'] = $data;
            }else{
               // echo "No existe la cuenta o los datos son incorrectos";
               $response['data'] = [];
            }
            echo json_encode($response);
        }


        public function servicios_categoria()
        {
            json_header();
            $impreso = $this->input->post('impreso');
            $idCS = $this->input->post('idCS');
			
			
			
			//$impreso = true;
			
			//$idCS = 32;
			
			
            $data = array();
            $this->load->model('abdiel/productos_model');
            if( $impreso== true){
				
                $data = $this->productos_model->get_servicios_categoria_impresos($idCS);
				

				
				

            }else{
                $data = $this->productos_model->get_servicios_categoria_noimpresos($idCS);
            }
            
            $response= array();
			
			
            if ($data!= null){
                $response['data'] = $data;
                $response['status'] = $impreso;

            }else{
               // echo "No existe la cuenta o los datos son incorrectos";
               $response['data'] = [];
            }
            echo json_encode($response);
        }
}