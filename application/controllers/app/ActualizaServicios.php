<?php 

class ActualizaServicios extends CI_Controller{
	
	private $idusuario;
    private $rol_id;
	private $idP;
	private $estatus;
	private $permiso_id;
	


    public function __construct(){

        parent::__construct();
		
		verifica_token();
		
		update_user_estatus($this->session->userdata('idusuario'));
		
		
		
        
        
		$this->idusuario = $this->session->userdata('idusuario');
        $this->rol_id = $this->session->userdata('idTipoUsuario');
		$this->idP = $this->session->userdata('idPerfilUsuario');
		$this->estatus = $this->session->userdata('estatus');
       
    
        $this->load ->model('app/Servicios_model');
        $this->load ->model('app/Categorias_servicios_model');
		$this->load ->model('app/Agrupaciones_Servicios_model');
        
       
       
    }



    public function actualiza($idS =0, $accion=""){
		
		//($idS =0,$sku="",$nombreS="",$desS="",$precioS=0,$noImpreso=0,$impresion=0,$precioImpresion=0,$idPolImpre=0,$cantidadMayoreo=0,$precioMayoreo=0,$inventarioMin=0,$image_url="",$tags="",$estatus=0)

        
		$this->permiso_id = get_permiso_modulo_seccion(
            $this->estatus,
            $this->rol_id,
			$this->idP,
            $modulo = 5,
            $seccion_id = 3
        );
		
		
		if (!is_null($this->permiso_id)) {
		
		
		
		$data['datosServicio'] = $this->Servicios_model->get_Servicio($idS);
		
	
		
		

		
	
		$data['preciosDinamicosProductos'] = $this->Servicios_model->get_PreciosDinamicosProducto($idS);	
		$data['preciosDinamicosImpresion'] = $this->Servicios_model->get_PreciosDinamicosImpresion($idS);	
			
		/*
		echo "productos: <pre>"; var_dump($data['preciosDinamicosProductos']);
			
		echo "impresos: <pre>"; var_dump($data['preciosDinamicosImpresion']);
			
		die();	
			*/
		
		//var_dump($this->db->last_query());
		//echo "<pre>";
		//echo "id: " . $idS . " accion" . $accion . " ";
        //var_dump($data['datosServicio']);
        //die();
		$data['agrupacion'] = $this->Agrupaciones_Servicios_model->ver_agrupaciones_servicios();
        $data['categorias'] = $this->Categorias_servicios_model->ver_CategoriasServicios();
		
        /*$data['idS'] = $idS;
        $data['sku'] = $sku;
        $data['nombreS'] = urldecode($nombreS);
        $data['desS'] = urldecode($desS);
        $data['precioS'] = $precioS;
        $data['noImpreso'] = $noImpreso;
        $data['impresion'] = $impresion;
        $data['precioImpresion'] = $precioImpresion;
        $data['idPolImpre'] = $idPolImpre;
        $data['cantidadMayoreo'] = $cantidadMayoreo;
        $data['precioMayoreo'] = $precioMayoreo;
        $data['inventarioMin'] = $inventarioMin;
        $data['image_url'] = $image_url;
        $data['tags'] = urldecode($tags);
        $data['estatus'] = $estatus;*/
		
		$data['titulo'] = $accion;


        $data['_APP_TITLE']              = "Actualiza Servicios";        
        $data['_APP_VIEW_NAME']          = "Servicios";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 5, 3);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Actualiza Servicios");



        //echo "<pre>";
        //var_dump($data);
        //die();
        $data['styles'][] = 'vendor/bootstrap-tagsinput';


        $data['styles'][] = 'vendor/select2.min';
        $data['styles'][] = 'vendor/select2-bootstrap.min';
		
		
		

        $data['scripts'][] = 'plantilla/js/dore-plugins/select.from.library';
        $data['scripts'][] = 'plantilla/js/vendor/select2.full';

      
        $data['scripts'][] = 'plantilla/js/vendor/bootstrap-tagsinput.min';

        
        $data['scripts'][] = 'propiosScripts/ActualizaServicios';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
       $data['modals'][]  = $this->load->view('private/fragments/AgrupacionesServicios/modalAgrupacionesServicios', $data, TRUE);
        
        
        
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/Servicios/ActualizaServiciosView', $data, TRUE);

        $this->load->view("default",$data,FALSE);
		

		
		
			
			
			
		 }else{
				redirect(base_url()."web");
		}
	
			
			
			
        
    }


    public function insertaServicios(){

        //$json = file_get_contents('php://input');
        //$data = (array)json_decode($json);
        //$accion = $data['accion']; 

        $ajax_data = $this->input->post();
        $dato1 = $ajax_data['atributos'];
        //$arrayAtributos = explode(",", $dato1);

        $contador = 0;
		
		$imagen = false;
		$mensajeImagen = "";

        $arrayAtributos = json_decode($dato1);

        //echo "<pre>";
        //var_dump($ajax_data);
        //echo "<pre>";
        //var_dump($arrayAtributos);
        //die();

		
		$preciosImpresion = json_decode($ajax_data['preciosImpresion']); 
		$preciosProductos = json_decode($ajax_data['preciosProducto']); 
		
		

		
		/*
		echo "<pre>";
		var_dump($preciosImpresion);
		var_dump($preciosProductos);
		
		die();
		
		*/
		
		
		unset($ajax_data['preciosImpresion']);
		unset($ajax_data['preciosProducto']);

        if (isset($_FILES["image_url"]["name"])) {
            $config['upload_path'] = APPPATH . '../static/imgServicios/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '1000';
            // $config['max_width'] = '1024';
            // $config['max_height'] = '768';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload("image_url")) {
				
                $mensajeImagen = " , La imágen no se actualizo, el formato debe ser: gif|jpg|png  y no debe pesar más de 1 mb";
				$imagen = true;
				
            } else {
                $edit_id = $this->input->post('idS');
                if ($post = $this->Servicios_model->single_entry($edit_id)) {
                    unlink(APPPATH . '../static/imgServicios/' . $post->image_url);
                    $ajax_data['image_url'] = $this->upload->data('file_name');
                }
            }
        }
		
		
		
	
        $id = $this->input->post('idS');

         
                    $accion = $ajax_data['accion']; 
		

                    unset($ajax_data['accion']); 
                    unset($ajax_data['atributos']); 
					
					$preciosBases_impresion = $ajax_data['preciosBases'];
					
					
					$preciosArray = explode(",", $preciosBases_impresion);
					
					

					
					
					
				
					$Atributos_mas = $ajax_data['Atributos_mas'];
					
					$Atributos_mas_array = explode(",", $Atributos_mas);
					
					
				
	
					$array_combinado = array_merge($preciosArray,$Atributos_mas_array);
					
					
					$id_Servicio = $ajax_data['idS'];
					
					
					$borrar_log = $this->Servicios_model->delete_servicio($id_Servicio);
					
					if( $borrar_log != false){

						
						if(count($array_combinado) >= 1){

							foreach($array_combinado as $adicional){

								$dataCosasAdicional = ["idS" => $ajax_data['idS'], "idAtributo" => $adicional];
								
								
								$array[] = $dataCosasAdicional;

							}

							
							$inserta_mas_atributos = $this->Servicios_model->inserta_atributos_mas($array);

						}
						$insertado_atributos_mas = $inserta_mas_atributos != false ? $insertado = true : $insertado = false;

					}
					
					

                    $rs = $this->Servicios_model->update_Servicios($ajax_data, $id);
		
		/* carga precios dinamicos*/
		
		$respuestaPrecios = false;
		
		$this->Servicios_model->borra_PreciosDinamicos($ajax_data['idS']);
						
						$mensajeUno= "";
						$mensajeDos= "";
						
						
						/*Inicia carga precios dinamicos*/
						
							foreach ( $preciosImpresion as $valor ) {

								$valor->idS = $ajax_data['idS'];

							}



							if ( count( $preciosImpresion ) >= 1 ) {

								$rsImpre = $this->Servicios_model->insertaPreciosServicios( $preciosImpresion );

								if ( $rsImpre ) {
									$mensajeUno = " precios de impresion dinamicos agregados correctamente";
								} else {
									$mensajeUno = " error, no agregaron los precios dinamicos de impresion, intenta actualizando el producto";
								}

							}
							
							



							foreach ( $preciosProductos as $valor ) {

								$valor->idS = $ajax_data['idS'];

							}


							if ( count( $preciosProductos ) >= 1 ) {

								$rsPro = $this->Servicios_model->insertaPreciosServicios( $preciosProductos );

								if ( $rsPro ) {
										$mensajeDos = " precios dinamicos de producto agregados correctamente";
								} else {
									$mensajeDos = " eroor, no agregaron los precios dinamicos de producto, intenta actualizando el producto";
								}
								
								$respuestaPrecios = $rsPro;



							}
		
						
						
						
						/*Termina carga de precios dinamicos*/
						
		
		/*Termina carga precios dinamicos*/

                    

                    $this->Servicios_model->borra_servicioAtributos($id);

                    if(count($arrayAtributos) >=1){

                        foreach($arrayAtributos as $atributo){

                            $dataDetalleAtributo = ["idS"=>$ajax_data['idS'],"idAtr"=>$atributo[0], "idDatr"=>$atributo[1]];
                            $atributo = $this->Servicios_model->inserta_servicioAtributos($dataDetalleAtributo);

                            $atributo ?  $contador ++ : "";
                        }/* Termina for each  atributos*/
						
					
						

                    }/*termina if */
                    


                    $data["resultado"]= $rs != NULL || $contador != 0 || $respuestaPrecios || $insertado_atributos_mas != false ;
                    $data["mensaje"] = $data["resultado"] ? "Se actuzalizó correctamente" . ($imagen == true ? $mensajeImagen : "") : ($rs == NULL ? "No se actualizaron los datos" : "") . " " . ($contador == 0 ? "No se actualizaron los atributos": "")  . ($imagen == true ? $mensajeImagen : "") ;
                
		
			
            echo json_encode($data);
		
        //--------------------------------------------------------------------------------------------------
       /* if($data['accion']== "Agregar"){

            unset($data['accion']); 
            $rs = $this->Servicios_model->inserta_Servicios($data);

        }else if($data['accion']== "editar"){

            unset($data['accion']); 
            $rs = $this->Servicios_model->update_Servicios($data, $data['idS']);
        }

        if($accion== "Agregar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se inserto  correctamente" : "No se inserto prueba nuevamente";
        }else if($accion == "editar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se actualizo  correctamente" : "No se actualizo prueba nuevamente";
        }

        echo json_encode($data);*/

    }

    




}//termina clase


?>