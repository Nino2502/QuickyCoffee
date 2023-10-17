<?php 



class Modulos extends CI_Controller{





	private $idusuario;
    private $rol_id;

	private $idP;
	
	private $idSuc;
	private $estatus;
	private $permiso_id;






    public function __construct(){



        parent::__construct();

		

		verifica_token();

        $this->load ->model('daniw/Modulos_model');
		
		
		$this->idusuario = $this->session->userdata('idusuario');

        $this->rol_id = $this->session->userdata('idTipoUsuario');

		$this->idP = $this->session->userdata('idPerfilUsuario');
		
		$this->idSuc        = $this->session->userdata('sucursal');
		$this->idP = $this->session->userdata('idPerfilUsuario');
		$this->estatus = $this->session->userdata('estatus');

       

    }







    public function index(){
		
								
		$this->permiso_id = get_permiso_modulo_seccion(
            $this->estatus,
            $this->rol_id,
			$this->idP,
            $modulo =11,
            $seccion_id = 39
        );
		
		
		if (!is_null($this->permiso_id)) {



        $data['_APP_TITLE']              = "Modulos";        

        $data['_APP_VIEW_NAME']          = "Modulos";

        $data['_APP_MENU']               = get_role_menu($this->rol_id,11, 39);// menu lateral

        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     

        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);

        $data['_APP_BREADCRUMBS']        = array("Modulos");

        $data['scripts'][] = 'daniw/Modulos';

        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';

		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';

		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';

		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';

        $data['modals'][]  = $this->load->view('daniw/Modulos/modalModulos', $data, TRUE);

        $data['_APP_FRAGMENT'] = $this->load->view('daniw/Modulos/Modulos_view', $data, TRUE);



        $this->load->view("default",$data,FALSE);
		
				
					
		}else{
			redirect(base_url()."web");
		}
		
		



    }



    public function verModulos(){



           $rs = $this->Modulos_model->ver_Modulos();

           $data['resultado'] = $rs != null;

           $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." secciones" : "no se encontraron secciones";

           $data["Secciones"] = $rs;

           echo JSON_ENCODE($data); 



    }





    public function insertaModulos(){



        $json = file_get_contents('php://input');

        $data = (array)json_decode($json);

        $accion = $data['accion']; 

        //$data['seccion_id']= $data["seccion_id"];



        if($data['accion']== "Agregar"){



            unset($data['accion']); 

            $rs = $this->Modulos_model->inserta_Modulos($data);



        }else if($data['accion']== "editar"){



            unset($data['accion']); 

            $rs = $this->Modulos_model->update_Modulos($data, $data['modulo_id']);

        }



        if($accion== "Agregar"){

            $data["resultado"]= $rs != false;

            $data["mensaje"] = $data["resultado"] ? "Se inserto el módulo correctamente" : "No se inserto prueba nuevamente";

        }else if($accion == "editar"){

            $data["resultado"]= $rs != false;

            $data["mensaje"] = $data["resultado"] ? "Se actualizo el módulo correctamente" : "No se actualizo prueba nuevamente";

        }



        echo json_encode($data);



    }



    public function cambioEstatus(){



        $id = $this->input->post("id");

        $rs = $this->Modulos_model->estatus_Modulos($id);



        $data["resultado"] = $rs !=false;

        $data["mensaje"] = $data["resultado"] ? "Se cambio el estatus correctamente": "No se pudo cambiar el estatus intenta de nuevo";



        echo json_encode($data);



    }





    public function bajaLogica(){



        $id = $this->input->post("id");

        $rs = $this->Modulos_model->borradoLogico($id);



        $data["resultado"] = $rs !=false;

        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";



        echo json_encode($data);



    }















}//termina clase





?>