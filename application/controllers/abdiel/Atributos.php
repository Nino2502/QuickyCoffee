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
		


		
		



        $this->load->model('abdiel/Atributos_model');

		if($idAS == 0 || $idAS == null || $idAS == "" || $idAS == "undefined" ){

			
			
			 $data = $this->Atributos_model->get_servicios_by_sku_impresos($idS);


			 
		

			 
				$response= array();
			
			
				if ($data!= null){
					$response["productos"] = $data;

					
				}else{
				   // echo "No existe la cuenta o los datos son incorrectos";
				   //$response['data'] = [];
				   $response= null;
				}
				echo json_encode($response);

		}else{
			

			$data = $this->Atributos_model->productos_atributos( $idAS);

        	$response= array();
        
		
			if ($data!= null){
            
				$response["productos"]= $data;
        	
			}else{
           // echo "No existe la cuenta o los datos son incorrectos";
           //$response['data'] = [];
           		$response= null;
        	}
       
	   
	   		 echo json_encode($response);

		}

    }
	
	 

	public function atributos_seleccionados(){


		//ULTIMA MODIFICACION : 13/11/2023
		// AUTOR : JESUS GONZALEZ LEAL *(Nino :3)*
		
		
		//Mira aqui recibimos el id del servicio por post que este se manda desde la aplicacion movil
		//Que se manda de fd.append
		$idS = $this -> input -> post("idS");
		
		//$idS = "SDI-Sub-Taz-163840";
		
	
		
		//$idS = "SDI-Sub-Tor-192452";
		
		
		//Aqui se carga el modelo
		$this->load->model('abdiel/Atributos_model');
		
		//Aqui guardamos la respuesta de la variable idS
		//que recibimos de la consulta del modelo
		
		$rs = $this->Atributos_model->get_Servicio($idS);
		
		//echo json_encode($rs);
		//die();
		
		
		//Aqui accedemos a la posicion del arreglo que se obtuvo
		//y se guardo en el variable , se va a guardar se esta manera:
		//1,2,3
		$preciosbases_mas = $rs[0]->preciosBases;

		$Atributos_mas = $rs[0]->Atributos_mas;

		//El array_map va como a recorrer el tipo arreglo y con el intval convierte
		// cada uno de los elementos en un entero
		//Y con explode devuelve un array con los datos que se guardaron el la varible y le indicamos
		//que con la , se tenia que separar.
		$array_precios = array_map('intval',explode(",",$preciosbases_mas));
		
		$array_atributos = array_map('intval',explode(",",$Atributos_mas));
		

		//Vamos a obtener los atributos relacionados que obtuvimos en la variable $array_precios
		$data = $this->Atributos_model->atributos_adicionales_mas($array_precios);
		

	
		$response = array();
		
		
		
		if ($data!= null){
			

			//Guardamos adentro del arreglo response
			//y dentro de la posicion ["precios_bases"] guardamos la repuesta de $data;
            $response["precios_bases"]= $data;
			

        }else{
			
			//Hice esto porque tenia 2 variables y de una manera tenia que separarlas por que hay muchos
			//productos que no tiene atributos y tambiem lo hice por que en uno estoy cargando los precios 
			//adicionales de impresion y en otros guardo los atributos adicionales para venil que se le va 
			// a sumar al precio final del productoo

			$data = $this->Atributos_model->atributos_adicionales_mas_2($array_atributos);
			
			
			//Guardamos adentro del arreglo response
			//y dentro de la posicion ["precios_bases"] guardamos la repuesta de $data;
			
			//Lo guarde dentro del mismo arreglo y dentro de la misma posicion
			//Por que en la aplicacion movil se desarrollo de esa misma manera
			//Yo solo busce la manera de poder adecuarlos.
			
			


           $response["precios_bases"]= $data;
        }

		 echo json_encode($response);

		

	
	}



    public function get_producto_detalle(){
 		json_header();
        
		$idS = $this-> input -> post("idS");

		$impreso = $this-> input -> post("impreso");
		
		$this->load->model('abdiel/Atributos_model');
        
		$response= array();
        
		
		if ($impreso ==false){

            $response["mensaje"]= "IMPRESO ES FALSE";
            $data       = $this->Atributos_model->get_servicios_by_sku($idS);
			$getPrecios = $this->Atributos_model->consulta_precios_Noimpresos($idS);

		}else{
	
            $response["mensaje"]= "IMPRESO ES TRUE";
            $data       = $this->Atributos_model->get_servicios_by_sku_impresos($idS);
			$getPrecios = $this->Atributos_model->consulta_precios_impresos($idS);

		 }
       
        $inventario = $this->Atributos_model->get_inventario_by_ids($idS);

        if ($data!= null){
			
			$response["precios"] = $getPrecios;

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
	
	
	public function getPrecios_Dinamicos() {
		
		
			
			//AUTOR : JESUS GONZALEZ LEAL ((Nino :3))
			//FECHA : 21/11/2023
	
			
			
		//$idS = $this-> input ->post("idS");
		

		$idS = "SDI-Sel-vin-14332";

		//$contador = $this-> input -> post("count");
		$contador = 49;
		
		//$impreso = $this-> input -> post("impreso");
		$impreso = TRUE;
		

		$this->load->model('abdiel/Atributos_model');

		if ($impreso ==false){
           
		   
            $producto       = $this->Atributos_model->get_servicios_by_sku($idS);
			
	
			$getPrecios = $this->Atributos_model->consulta_precios_Noimpresos($idS);
			
	
			

			$categorias2 = array_filter($getPrecios, function($producto_no_impreso){
				return $producto_no_impreso->categoria === "2";

			});


			$ultima_posicion_2 = $categorias2[array_key_last($categorias2)];
			

				
			
				for($i = 0; $i < count($categorias2); $i++){

					$elementoActual = $categorias2[$i];

					if(($contador >= $elementoActual->cantidad || ($contador == $elementoActual->cantidad))){
						
						
					
						if($contador < $categorias2[$i + 1]->cantidad){
							

							$data = $elementoActual;
							

							$subtotal = floatval($data->precio);
							
							$total = floatval($data->precio) * $contador;

							

							

						
							break;
						
						
						
						}
						
						if($contador >= $ultima_posicion_2->cantidad){
							
									

								$data = $ultima_posicion_2;
								
								
								$total = floatval($data->precio) * $contador;
								
								$subtotal = floatval($data->precio);
							
								break;
						
						
						}
						
					
					
					}else{
						
						
							$data = $producto[0];
							
						
							$total = floatval($producto[0]->precioS) * $contador;
							$subtotal = floatval($producto[0]->precioS);

					
					
					}
				
				
				
				
				}
				
					
					if($data != null){
					
						$response["precios"] = $data;
						$response["total"] = $total;
						$response["subtotal"] = $subtotal;

	
					
					}else{
						
						
						$response = null;
		
					}
					
					echo json_encode($response);
			 
				
			
			
			}else{			

					$producto       = $this->Atributos_model->get_servicios_by_sku_impresos($idS);
					
				
					$getPrecios = $this->Atributos_model->consulta_precios_impresos($idS);
					

					

					
					
		
					
						$categorias2 = array_filter($getPrecios, function($producto_impreso){
							return $producto_impreso->categoria === "2";
			
						});

						$categorias1 = array_filter($getPrecios, function($producto_impresos_2){
							
							return $producto_impresos_2->categoria === "1";
						
						});
						
	
			
						
						$categorias1 = array_values($categorias1);
						
						$categorias2 = array_values($categorias2);
						
						
				
	

						$ultima_posicion_1 = $categorias2[array_key_last($categorias2)];
						
						$ultima_posicion_impresos = $categorias1[array_key_last($categorias1)];
						
		
					

			
						for ($i = 0; $i < count($categorias2); $i++) {
							
							$elementoActual = $categorias2[$i];
				
						if (($contador >= $elementoActual->cantidad || ($contador == $elementoActual->cantidad))){
							

							
					
					
							
								if($contador <= $categorias2[$i + 1]->cantidad){
									

							
		
									
			
	
									$data = $elementoActual;
				
									
									$subtotal = floatval($data->precio) + floatval($producto[0]->precioImpresion);
									
									$total = (floatval($data->precio) + floatval($producto[0]->precioImpresion) * $contador);
					
									
									
									break;
								
								
								
								}
								if($contador >= $ultima_posicion_1->cantidad){

										for($i = 0; $i < count($categorias1); $i++){
											
											$elementoActual2 = $categorias1[$i];
											
											if($contador >= $elementoActual2->cantidad || ($contador == $elementoActual2->cantidad)){
												
												

												$data = $elementoActual2;
					
			
												$subtotal = floatval($ultima_posicion_1->precio) + floatval($elementoActual2->precio);
												
												$total = (floatval($ultima_posicion_1->precio) + floatval($elementoActual2->precio) * $contador);

												
												break;
											
											
											}
											if($contador >= $ultima_posicion_impresos->cantidad ){
												
										
												
												$data = $ultima_posicion_impresos;
												
												$total = (floatval($data->precio) + floatval($ultima_posicion_1->precio) * $contador);
												
												$subtotal = floatval($data->precio) + floatval($ultima_posicion_1->precio);
												
												break;
											
											
											
											}
										
										
										
										
										}
							
								
								}
							
							
							
						
						}else{
							
							

							
								
							$data = $producto[0];
							$total = floatval($producto[0]->precioS * $contador);
							$subtotal = floatval($producto[0]->precioS);
		
						}
					}
					
					if($data != null){
						$response["precios"] = $data;
						$response["total"] = $total;
						$response["subtotal"] = $subtotal;
					
					
					
					}else{
						
						$response = null;
		
					}
					
					echo json_encode($response);


		 }
		 
		 
		 	
	}
	
	public function get_promocionales(){
		
		$this->load->model('abdiel/Atributos_model');
		$data = $this->Atributos_model->promocionales_adicional();
		
		


		$response = array();
		
		
		if($data != null){
			
			$response["promocionales"] = $data;
		
		}else{
			
			$response = null;
		}
		
		echo json_encode($response);
			
	
	
	}
		 
		
		
		
	
	
	
	
	



}
