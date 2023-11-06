<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

    function __construct(){
        parent::__construct(); 

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, OPTIONS");
	}

    public function hola() {
        echo "Hola mundo";
      }
    
        public function ver_impresos()
        {
            json_header();
            $data = array();
            $this->load->model('abdiel/productos_model');
            $impresos = $this->productos_model->get_servicios_impresos();
			
			$sin_agrupacion = $this->productos_model->get_servicios_sin_agrupa();
			
			$data = array_merge($impresos,$sin_agrupacion);
			

			
            
			
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
            $no_impreso = $this->productos_model->get_servicios_noimpresos();
			$sin_agrupacion_no = $this->productos_model->no_impresos_productos();
			
			$data = array_merge($no_impreso,$sin_agrupacion_no);
			
			
            $response= array();
            if ($data!= null){
                $response['data'] = $data;
            }else{
               // echo "No existe la cuenta o los datos son incorrectos";
               $response['data'] = "No hay por el momento.";
            }
            echo json_encode($response);
        }
		
		
		public function ver_sin_agrupacion(){
			json_header();
			$data = array();
			
			$this->load->model('abdiel/productos_model');
			$data = $this->productos_model->get_servicios_sin_agrupa();
			$response = array();
			
			if($data!= null){
				$response['mensaje'] = "Los productos son ".count($data);
				$response['data'] = $data;
			
			}else{
				
				$response['data'] = "No hay datos por el momento".count($data);
			
			
			}
			echo json_encode($response);
				
		
		
		}
		

//El 10 es porque visualiza solo 10 productos, es para la vista principal // 

        public function ver_impresos10()
        {
            json_header();
            $data = array();
            $this->load->model('abdiel/productos_model');
            $data = $this->productos_model->get_randos_impresos();
			
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
            $data = $this->productos_model->get_randos_noimpresos();
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
			//$idCS = 30;
			
			
			
			//$impreso = true;
			
			//$idCS = 28;
			
			
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