<?php 



class Secciones extends CI_Controller{




	private $idusuario;
    private $rol_id;

	private $idP;
	
	private $idSuc;
	private $estatus;
	private $permiso_id;





    public function __construct(){



        parent::__construct();

		

		verifica_token();

        $this->load ->model('daniw/Secciones_model');
				
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
            $seccion_id = 30
        );
		
		
		if (!is_null($this->permiso_id)) {



        $data['_APP_TITLE']              = "Secciones";        

        $data['_APP_VIEW_NAME']          = "Secciones";

        $data['_APP_MENU']               = get_role_menu($this->rol_id,11, 30);// menu lateral

        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     

        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);

        $data['_APP_BREADCRUMBS']        = array("Secciones");

        $data['scripts'][] = 'daniw/Secciones';

        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';

		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';

		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';

		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';

        $data['modals'][]  = $this->load->view('daniw/Secciones/modalSecciones', $data, TRUE);

        $data['_APP_FRAGMENT'] = $this->load->view('daniw/Secciones/Secciones_view', $data, TRUE);



        $this->load->view("default",$data,FALSE);
		
						
					
		}else{
			redirect(base_url()."web");
		}
		



    }



    public function verSecciones(){



           $rs = $this->Secciones_model->ver_Secciones();

           $data['resultado'] = $rs != null;

           $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." secciones" : "no se encontraron secciones";

           $data["Secciones"] = $rs;

           echo JSON_ENCODE($data); 



    }





    public function insertaSecciones(){



        $json = file_get_contents('php://input');

        $data = (array)json_decode($json);

        $accion = $data['accion']; 

        //$data['seccion_id']= $data["seccion_id"];



        if($data['accion']== "Agregar"){



            unset($data['accion']); 

            $rs = $this->Secciones_model->inserta_Secciones($data);



        }else if($data['accion']== "editar"){



            unset($data['accion']); 

            $rs = $this->Secciones_model->update_Secciones($data, $data['seccion_id']);

        }



        if($accion== "Agregar"){

            $data["resultado"]= $rs != false;

            $data["mensaje"] = $data["resultado"] ? "Se inserto la sección correctamente" : "No se inserto prueba nuevamente";

        }else if($accion == "editar"){

            $data["resultado"]= $rs != false;

            $data["mensaje"] = $data["resultado"] ? "Se actualizo la sección correctamente" : "No se actualizo prueba nuevamente";

        }



        echo json_encode($data);



    }





    // Módulos para el select

    public function getModulos(){

        $rs = $this->Secciones_model->ver_Modulos();

        $data['resultado'] = $rs != null;

        $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." módulos" : "no se econtraron módulos";

        $data["Modulos"] = $rs;

        echo JSON_ENCODE($data); 

    }



    public function getSelect(){

        $id= $this->input->post("id");



        $rs = $this->Secciones_model->sel_Modulos($id);



        $data["resultado"] = $rs != null;

        $data["mensaje"]= $data["resultado"] ? "Se encontro el modulo ": "No se obtuvieron módulos";

        $data["selectMod"]= $rs;



        echo json_encode($data);



    }





    public function cambioEstatus(){



        $id = $this->input->post("id");

        $rs = $this->Secciones_model->estatus_Secciones($id);



        $data["resultado"] = $rs !=false;

        $data["mensaje"] = $data["resultado"] ? "Se cambio el estatus correctamente": "No se pudo cambiar el estatus intenta de nuevo";



        echo json_encode($data);



    }





    public function bajaLogica(){



        $id = $this->input->post("id");

        $rs = $this->Secciones_model->borradoLogico($id);



        $data["resultado"] = $rs !=false;

        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";



        echo json_encode($data);



    }















}//termina clase





?>