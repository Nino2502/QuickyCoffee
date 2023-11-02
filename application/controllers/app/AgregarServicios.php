<?php 

class AgregarServicios extends CI_Controller{

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
        
       
    }



    public function index(){
		
			
		$this->permiso_id = get_permiso_modulo_seccion(
            $this->estatus,
            $this->rol_id,
			$this->idP,
            $modulo = 5,
            $seccion_id = 3
        );
		
		
		if (!is_null($this->permiso_id)) {

        $data['_APP_TITLE']              = "Agregar Servicios";        
        $data['_APP_VIEW_NAME']          = "Servicios";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 5, 3);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Agregar Servicios");


        $data['styles'][] = 'vendor/bootstrap-tagsinput';


        $data['styles'][] = 'vendor/select2.min';
        $data['styles'][] = 'vendor/select2-bootstrap.min';

        $data['scripts'][] = 'plantilla/js/dore-plugins/select.from.library';
        $data['scripts'][] = 'plantilla/js/vendor/select2.full';

      
        $data['scripts'][] = 'plantilla/js/vendor/bootstrap-tagsinput.min';

        
        $data['scripts'][] = 'propiosScripts/AgregarServicios';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        //$data['modals'][]  = $this->load->view('private/fragments/Servicios/modalServicios', $data, TRUE);
		$data['modals'][]  = $this->load->view('private/fragments/AgrupacionesServicios/modalAgrupacionesServicios', $data, TRUE);
        
        
        
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/Servicios/AgregarServiciosView', $data, TRUE);

        $this->load->view("default",$data,FALSE);

 		}else{
				redirect(base_url()."web");
		}



        
    }
	
	public function atributos_adicionales(){
		$rs = $this->Servicios_model->ver_atributos_adicionales();
		
		$data['resultado'] = $rs != null;
		$data['mensaje'] = $data['resultado'] ? "Se encontraron  ".count($rs)."  atributos" : "No se encontraron ningun atributo";
		
		$data["Atributos_adicionales"] = $rs;
		
		echo json_encode($data);

	}
	public function precios_bases(){
	
		$rs = $this->Servicios_model->ver_precios_bases();
		
		$data['resultado'] = $rs != null;
		$data['mensaje'] = $data['resultado'] ? "Se encontraron  ".count($rs)." precios bases" : "No hay precios";
		
		$data["Precios_bases"] = $rs;
		
		echo json_encode($data);
		
	
	}


    public function insertaServicios(){

        //$json = file_get_contents('php://input');
        //$data = (array)json_decode($json);
        //$accion = $data['accion']; 

        $ajax_data = $this->input->post();

		
        $dato1 = $ajax_data['atributos'];
        //$arrayAtributos = explode(",", $dato1);
		
		$contador = 0;
		
		
		$arrayAtributos = json_decode($dato1);
		
		
		$preciosImpresion = json_decode($ajax_data['preciosImpresion']); 
		$preciosProductos = json_decode($ajax_data['preciosProducto']); 
		
		
	
		
		/*
		$cantidad = count($arrayAtributos);
		
		echo $cantidad . "</br>";
			
		foreach($arrayAtributos as $atributo){	
			echo "atr ". $atributo[0] . " datr" . $atributo[1];			
		}
		die();*/

		//echo "<pre>";
		//var_dump($dd);
        //echo "<pre>";
        //var_dump($ajax_data);
		//echo "<pre>";
        //var_dump(json_decode($dato1));
        //echo "<pre>";
        //var_dump($arrayAtributos);
        //die();	
		//echo "<pre>";	
		//var_dump($ajax_data['idS']);
        //die();	
			
		
		$duplicado = $this->Servicios_model->buscarDuplicado($ajax_data['idS']);
		
		unset($ajax_data['preciosImpresion']);
		unset($ajax_data['preciosProducto']);
		
		if($duplicado != true){
			
	
				$config['upload_path'] = APPPATH . '../static/imgServicios/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']     = '5000';
				// $config['max_width'] = '1024';
				// $config['max_height'] = '768';
				$this->load->library('upload', $config);
				// Upload.php line - 1097 public function display_errors($open = '<p>', $close = '</p>')

				if (!$this->upload->do_upload("image_url")) {
					
					$data["resultado"]=  false;
					$data["mensaje"] =  "El formato de la imagen debe ser: gif|jpg|png  y no debe pesar más de 5mb";
					$data["imagenError"] = $this->upload->display_errors();
					
					
				} else {
					$ajax_data = $this->input->post();
					
					unset($ajax_data['preciosImpresion']);
					unset($ajax_data['preciosProducto']);

                    $accion = $ajax_data['accion']; 

                    unset($ajax_data['accion']); 
					$ajax_data['image_url'] = $this->upload->data('file_name');

                    unset($ajax_data['atributos']); 

                    $rs = $this->Servicios_model->inserta_Servicios($ajax_data);

                    if($rs != false){

                        $this->Servicios_model->borra_servicioAtributos($ajax_data['idS']);

                        if(count($arrayAtributos) >=1){

                            foreach($arrayAtributos as $atributo){

                                $dataDetalleAtributo = ["idS"=>$ajax_data['idS'],"idAtr"=>$atributo[0], "idDatr"=>$atributo[1]];
                                $atributo = $this->Servicios_model->inserta_servicioAtributos($dataDetalleAtributo);

                                $atributo ?  $contador ++ : "";
                            }

                        }
						
						
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



							}
		
						
						
						
						/*Termina carga de precios dinamicos*/
                    }/*Termina if*/
					
					
					
					


                    if($accion== "Agregar" || $accion== "duplicar"){
                        $data["resultado"]= $rs != false || $contador != 0 ;
                        $data["mensaje"] = $data["resultado"] ? "Se inserto  correctamente " . $mensajeUno ." , " . $mensajeDos  : ($rs == NULL ? "No se insertaron los datos " . $mensajeUno ." , " . $mensajeDos : "") . " " . ($contador == 0 ? "No se insertaron atributos" . $mensajeUno ." , " . $mensajeDos: "") ;
                    }else if($accion == "editar"){
                        $data["resultado"]= $rs != false;
                        $data["mensaje"] = $data["resultado"] ? "Se actualizo  correctamente"  : "No se actualizo prueba nuevamente";
                    }

				}
		
		
	}else{
			
		$data["resultado"]= false ;
		$data["mensaje"] = "Ya existe un producto registrado con ese codigo intenta de nuevo" ;
		
	}
			
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