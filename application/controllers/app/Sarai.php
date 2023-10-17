<?php 

class Sarai extends CI_Controller{


    private $rol_id;
	private $idP;

	//becario idBe

    public function __construct(){

        parent::__construct();
		
		verifica_token();
        $this->load ->model('app/Sarai_model');
        $this->rol_id = $this->session->userdata('idTipoUsuario');
		$this->idP = $this->session->userdata('idPerfilUsuario');
       
    }



    public function index(){

        $data['_APP_TITLE']              = "Sarai";        
        $data['_APP_VIEW_NAME']          = "Administracion";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 3, 7);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Sarai");
        $data['scripts'][] = 'propiosScripts/Sarai';
		
		
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
		
        $data['modals'][]  = $this->load->view('private/fragments/Sarai/modalSarai', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/Sarai/Sarai_view', $data, TRUE);

        $this->load->view("default",$data,FALSE);

    }

    public function verSarai(){

           $rs = $this->Sarai_model->ver_sarai();
           $data['resultado'] = $rs != null;
           $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." tipos de pago" : "no se econtraron categorias";
           $data["Sarai"] = $rs;
           echo JSON_ENCODE($data);

    }


    public function insertaSarai(){

        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        $accion = $data['accion']; 

        if($data['accion']== "Agregar"){

            unset($data['accion']); 
            $rs = $this->Sarai_model->inserta_sarai($data);

        }else if($data['accion']== "editar"){

            unset($data['accion']); 
            $rs = $this->Sarai_model->update_sarai($data, $data['idSara']);
        }

        if($accion== "Agregar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se inserto un usuario" : "No se inserto prueba nuevamente";
        }else if($accion == "editar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se actualizo el usuario correctamente" : "No se actualizo prueba nuevamente";
        }

        echo json_encode($data);

    }


    public function cambioEstatus(){

        $id = $this->input->post("id");
        $rs = $this->Sarai_model->estatus_sarai($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se cambio el estatus correctamente": "No se pudo cambiar el estatus intenta de nuevo";

        echo json_encode($data);

    }


    public function bajaLogica(){

        $id = $this->input->post("id");
        $rs = $this->Sarai_model->borradoLogico($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";

        echo json_encode($data);

    }


}//termina clase


?>