<?php 

class CategoriasServicios extends CI_Controller{

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


        $this->load ->model('app/Categorias_servicios_model');
        
    }



    public function index(){
		
		$this->permiso_id = get_permiso_modulo_seccion(
            $this->estatus,
            $this->rol_id,
			$this->idP,
            $modulo = 5,
            $seccion_id = 9
        );
		
		
		if (!is_null($this->permiso_id)) {
		
		
		
		

        $data['_APP_TITLE']              = "Categorias de Servicios";        
        $data['_APP_VIEW_NAME']          = "Administracion";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 5, 9);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Categorias de Servicios");
        $data['scripts'][] = 'propiosScripts/categoriasServicios';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['modals'][]  = $this->load->view('private/fragments/categoriasServicios/modalcategoriasServicios', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/categoriasServicios/categoriasServicios_view.php', $data, TRUE);

        $this->load->view("default",$data,FALSE);
			
					
	 }else{
			redirect(base_url()."web");
	}	
			
			
			

    }

    public function verCategoriasServicios(){

           $rs = $this->Categorias_servicios_model->ver_CategoriasServicios();
           $data['resultado'] = $rs != null;
           $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." categorias" : "no se econtraron categorias";
           $data["categorias"] = $rs;
           echo JSON_ENCODE($data);

    }


    public function insertaCategoriasServicios(){

        //$json = file_get_contents('php://input');
        //$data = (array)json_decode($json);
        
		$ajax_data = $this->input->post();
		$accion = $ajax_data['accion']; 
		
		
		 if($ajax_data['accion']== "Agregar"){
			 
			 $rs = false;

            	unset($ajax_data['accion']); 
            
		
				$config['upload_path'] = APPPATH . '../static/img/categoriasServ';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '1000';
				// $config['max_width'] = '1024';
				// $config['max_height'] = '768';
				$this->load->library('upload', $config);
				// Upload.php line - 1097 public function display_errors($open = '<p>', $close = '</p>')

				if (!$this->upload->do_upload("imagen")) {
					//$data = array('resultado' => "error", 'mensaje' => $this->upload->display_errors());
				
				$data["resultado"]=  false;
              	$data["mensaje"] =  "El formato de la imagen debe ser: gif|jpg|png  y no debe pesar más de 1mb";
				$data["imagenError"] = $this->upload->display_errors();
				
				
				} else {
					//$ajax_data = $this->input->post();

                    //$accion = $ajax_data['accion']; 

                    //unset($ajax_data['accion']); 
					$ajax_data['imagen'] = $this->upload->data('file_name');

                    //unset($ajax_data['atributos']); 

                    $rs = $this->Categorias_servicios_model->inserta_Categorias_servicios($ajax_data);
					
					$data["resultado"]= $rs != false;
              
					$data["mensaje"] = $data["resultado"] ? "Se inserto la categoria correctamente" : "No se inserto";
					
				
				}
			 
			  
			 
			 echo json_encode($data);
		 
			 
		 }else if($ajax_data['accion']== "editar"){
			 
			 $rs= false;
			 $imagen = false;
			 $mensajeImagen = "";


					  if (isset($_FILES["imagen"]["name"])) {
							$config['upload_path'] = APPPATH . '../static/img/categoriasServ/';
							$config['allowed_types'] = 'gif|jpg|png';
							$config['max_size']     = '1000';
							// $config['max_width'] = '1024';
							// $config['max_height'] = '768';
							$this->load->library('upload', $config);

							if (!$this->upload->do_upload("imagen")) {
								//$data = array('resultado' => "error", 'message' => $this->upload->display_errors());
								
								
								$mensajeImagen = " , La imágen no se actualizo, el formato debe ser: gif|jpg|png  y no debe pesar más de 1 mb";
								$imagen = true;
								
								
							} else {
								$edit_id = $this->input->post('idCS');
								if ($post = $this->Categorias_servicios_model->single_entry($edit_id)) {
									unlink(APPPATH . '../static/img/categoriasServ/' . $post->imagen);
									$ajax_data['imagen'] = $this->upload->data('file_name');
								}
							}
						}
						
			 			$id = $this->input->post('idCS');


							$accion = $ajax_data['accion']; 

							unset($ajax_data['accion']);  

							$rs = $this->Categorias_servicios_model->update_Categorias_servicios($ajax_data, $id);
			 
			 
			 

							$data["resultado"]= $rs !=false;
							$data["mensaje"] = $data["resultado"] ? "Los datos se actualizarón correctamente" . ($imagen == true ? $mensajeImagen : "") : "No se actualizo correctamente" . ($imagen == true ? $mensajeImagen : "");
			 				
			 
			 				$imagen == true ? $data["imagenError"] = $this->upload->display_errors() : "";
			 
			 
			 
			 				

					echo json_encode($data);

				}
		
		
		
		
		

        /*if($accion== "Agregar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se inserto la categoria correctamente" : "No se inserto prueba nuevamente";
        }else if($accion == "editar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se actualizo la categoria correctamente" : "No se actualizo prueba nuevamente";
        }




        echo json_encode($data);*/

    }


    public function cambioEstatus(){

        $id = $this->input->post("id");
        $rs = $this->Categorias_servicios_model->estatus_Categorias_servicios($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se cambio el estatus correctamente": "No se pudo cambiar el estatus intenta de nuevo";

        echo json_encode($data);

    }


    public function bajaLogica(){

        $id = $this->input->post("id");
        $rs = $this->Categorias_servicios_model->borradoLogico($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";

        echo json_encode($data);

    }







}//termina clase


?>