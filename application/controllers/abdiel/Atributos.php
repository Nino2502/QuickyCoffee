<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Atributos extends CI_Controller {


    public function get_atributos(){
        json_header();
        $idAS = $this-> input -> post('idAS');
        $this->load->model('abdiel/Atributos_model');
        $data = $this->Atributos_model->ver_atributos( $idAS);
        $response= array();
        if ($data!= null){
            $response['atributos'] = $data;
        }else{
           // echo "No existe la cuenta o los datos son incorrectos";
           //$response['data'] = [];
           $response= null;
        }
        echo json_encode($response);
    }

    public function get_detalle(){
        json_header();
        $idAtr = $this-> input -> post('idAtr');
        $this->load->model('abdiel/Atributos_model');
        $data = $this->Atributos_model->detalle_atributo( $idAtr);
        $response= array();
        if ($data!= null){
            $response['atributos'] = $data;
        }else{
           // echo "No existe la cuenta o los datos son incorrectos";
           //$response['data'] = [];
           $response= null;
        }
        echo json_encode($response);
    }

    public function get_producto(){
        json_header();
        $idAS = $this-> input -> post("idAS");
        $array[] = $this-> input -> post("array");
        $count = count($array);
        $this->load->model('abdiel/Atributos_model');
        $data = $this->Atributos_model->producto( $array, $count, $idAS);
        $response= array();
        if ($data!= null){
            $response= $data;
        }else{
           // echo "No existe la cuenta o los datos son incorrectos";
           //$response['data'] = [];
           $response= null;
        }
        echo json_encode($response);
       //echo json_encode($count);
    }


    public function get_producto_atributos(){
        json_header();
        $idAS = $this-> input -> post("idAS"); 
		$idS  = $this-> input -> post("idS");
		
		//$idAS = 18;
		
		//$idS = "SDI-Sub-Bot-115426";
		



        $this->load->model('abdiel/Atributos_model');

		if($idAS == 0 || $idAS == null || $idAS == "" ){

			
			
			 $data = $this->Atributos_model->get_servicios_by_sku_impresos($idS);
			 
			 
				$response= array();
			
			
				if ($data!= null){
					$response= $data;
				}else{
				   // echo "No existe la cuenta o los datos son incorrectos";
				   //$response['data'] = [];
				   $response= null;
				}
				echo json_encode($response);

		}else{
			

			$data = $this->Atributos_model->productos_atributos( $idAS);
			
			
			

			
			echo json_encode($data);
			
			die();
			
        	$response= array();
        
		
			if ($data!= null){
            
				$response= $data;
        	
			}else{
           // echo "No existe la cuenta o los datos son incorrectos";
           //$response['data'] = [];
           		$response= null;
        	}
       
	   
	   		 echo json_encode($response);

		}

    }
	
	 
	 public function get_producto_sin_agrupa(){
        json_header();
        
		//$idAS = $this-> input -> post("idAS");
		
		$idS = $this->input->post("idS");
		
		//$idS = "SDI-Sub-Bot-115426";
		
        $this->load->model('abdiel/Atributos_model');
       
       //echo json_encode($count);
       
    }


    public function get_producto_detalle(){
        
		
		json_header();
        
		$idS = $this-> input -> post("idS");
        //$idS = "SDI-Sel-Lap-11262";
		
		$impreso = $this-> input -> post("impreso");
		
		//$impreso = true;
        
		
		
		$this->load->model('abdiel/Atributos_model');
        
		$response= array();
        
		
		if ($impreso ==false){
            $response["mensaje"]= "IMPRESO ES FALSE";
            $data       = $this->Atributos_model->get_servicios_by_sku($idS);
        }else{
			
            $response["mensaje"]= "IMPRESO ES TRUE";
            $data       = $this->Atributos_model->get_servicios_by_sku_impresos($idS);
			
         
		 
		 
		 }
       
        $inventario = $this->Atributos_model->get_inventario_by_ids($idS);
		
		
        
        if ($data!= null){
            $response["producto"]= $data;
            $response["inventario"]=$inventario;
        }else{

           $response= null;
        }
        
		
		echo json_encode($response);
		
       //echo json_encode($count);
       
    }
	
	
    public function get_producto_detalle_sin_agrupar(){
        
		
		json_header();
        
		$idS = $this-> input -> post("idS");
        //$idS = "SDI-Sel-Lap-11262";

		
		$impreso = $this-> input -> post("impreso");
		
		//$impreso = true;
        
		
		
		$this->load->model('abdiel/Atributos_model');
        
		$response= array();
        
		
		if ($impreso ==false){
            $response["mensaje"]= "IMPRESO ES FALSE";
            $data       = $this->Atributos_model->get_servicios_by_sku($idS);
        }else{
			
            $response["mensaje"]= "IMPRESO ES TRUE";
            $data       = $this->Atributos_model->get_servicios_by_sku_impresos($idS);
			
         
		 
		 
		 }
		 
		 
       
        $inventario = $this->Atributos_model->get_inventario_by_ids($idS);
		

		
		
		
		
        
        if ($data!= null){
            $response["producto"]= $data;
            $response["inventario"]=$inventario;
        }else{

           $response= null;
        }
        
		
		echo json_encode($response);
		
       //echo json_encode($count);
       
    }


}
