<?php class Servicios extends CI_Controller{

	private $idusuario;
    private $rol_id;
	private $idP;
	private $estatus;
	private $permiso_id;
	


    public function __construct(){

        parent::__construct();
		
		verifica_token();
		
		update_user_estatus($this->session->userdata('idusuario'));
		
		
		
        $this->load ->model('app/Servicios_model');
        $this->load ->model('app/Categorias_servicios_model');
        
		$this->idusuario = $this->session->userdata('idusuario');
        $this->rol_id = $this->session->userdata('idTipoUsuario');
		$this->idP = $this->session->userdata('idPerfilUsuario');
		$this->estatus = $this->session->userdata('estatus');
       
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
		

        $data['_APP_TITLE']              = "Servicios";        
        $data['_APP_VIEW_NAME']          = "Servicios";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 5, 3);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Servicios");


        $data['styles'][] = 'vendor/bootstrap-tagsinput';


        $data['styles'][] = 'vendor/select2.min';
        $data['styles'][] = 'vendor/select2-bootstrap.min';

        $data['scripts'][] = 'plantilla/js/dore-plugins/select.from.library';
        $data['scripts'][] = 'plantilla/js/vendor/select2.full';

      
        $data['scripts'][] = 'plantilla/js/vendor/bootstrap-tagsinput.min';

        
        $data['scripts'][] = 'propiosScripts/Servicios';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['modals'][]  = $this->load->view('private/fragments/Servicios/modalServicios', $data, TRUE);
        
        
        
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/Servicios/Servicios_view', $data, TRUE);

        $this->load->view("default",$data,FALSE);
			
		 }else{
				redirect(base_url()."web");
		}

    }

    public function verServicios(){

           $rs = $this->Servicios_model->ver_Servicios();
           $data['resultado'] = $rs != null;
           $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." tipos de pago" : "no se econtraron servicios";
			$data["Servicios"] = $rs;
           echo JSON_ENCODE($data);

    }
		
		 public function verCatServicios(){

           $rs = $this->Servicios_model->ver_CatServicios();
           $data['resultado'] = $rs != null;
           $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." tipos de pago" : "no se econtraron servicios";
           $data["catServicios"] = $rs;
           echo JSON_ENCODE($data);

    }

	
	 public function verServicio(){
		 
		 	$id = $this->input->post("id");
		 
		 
		 
			 

           $rs = $this->Servicios_model->ver_Servicio($id);
		 
		
		 
           $data['resultado'] = $rs != null;
           $data['mensaje'] = $data['resultado'] ? "Se econtro ". count($rs)." servicio" : "no se econtraron servicios";
           $data["Servicio"] = $rs;
           echo JSON_ENCODE($data);
		
    }

    public function insertaServicios(){

        //$json = file_get_contents('php://input');
        //$data = (array)json_decode($json);
        //$accion = $data['accion']; 

         
				$config['upload_path'] = APPPATH . '../static/imgServicios/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '1000';
				// $config['max_width'] = '1024';
				// $config['max_height'] = '768';
				$this->load->library('upload', $config);
				// Upload.php line - 1097 public function display_errors($open = '<p>', $close = '</p>')

				if (!$this->upload->do_upload("image_url")) {
					$data = array('resultado' => "error", 'mensaje' => $this->upload->display_errors());
				} else {
					$ajax_data = $this->input->post();

                    $accion = $ajax_data['accion']; 

                    unset($ajax_data['accion']); 
					$ajax_data['image_url'] = $this->upload->data('file_name');

                    $rs = $this->Servicios_model->inserta_Servicios($ajax_data);

                    if($accion== "Agregar"){
                        $data["resultado"]= $rs != false;
                        $data["mensaje"] = $data["resultado"] ? "Se inserto  correctamente" : "No se inserto prueba nuevamente";
                    }else if($accion == "editar"){
                        $data["resultado"]= $rs != false;
                        $data["mensaje"] = $data["resultado"] ? "Se actualizo  correctamente" : "No se actualizo prueba nuevamente";
                    }

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


    public function cambioEstatus(){

        $id = $this->input->post("id");
        $rs = $this->Servicios_model->estatus_Servicios($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se cambio el estatus correctamente": "No se pudo cambiar el estatus intenta de nuevo";

        echo json_encode($data);

    }

    public function bajaLogica(){

        $id = $this->input->post("id");
        $rs = $this->Servicios_model->borradoLogico($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";

        echo json_encode($data);

    }


    public function listaCategorias(){

        $rs = $this->Categorias_servicios_model->ver_CategoriasServicios();

        $data['resultado']= $rs != null;
        $data['categorias']= $rs;

        echo json_encode($data);



    }

    public function listaFormDiagnosticos(){

    }







}//termina clase


?>