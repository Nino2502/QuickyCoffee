<?php 

class TiposDeCampos extends CI_Controller{


    private $rol_id;
	private $idP;


    public function __construct(){

        parent::__construct();
		
		verifica_token();
        $this->load ->model('app/Tipo_de_campos_model');
        $this->rol_id = $this->session->userdata('idTipoUsuario');
		$this->idP = $this->session->userdata('idPerfilUsuario');
       
    }



    public function index(){

        $data['_APP_TITLE']              = "Tipos de campo";        
        $data['_APP_VIEW_NAME']          = "Cuestionarios";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 6, 14 );// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Tipos de Campos");
        $data['scripts'][] = 'propiosScripts/tiposDeCampos';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['modals'][]  = $this->load->view('private/fragments/TiposDeCampos/modalTiposDeCampos', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/TiposDeCampos/tiposDeCampo_view', $data, TRUE);

        $this->load->view("default",$data,FALSE);

    }

    public function verTiposDeCampos(){

           $rs = $this->Tipo_de_campos_model->ver_tipos_de_campos();
           $data['resultado'] = $rs != null;
           $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." tipos de pago" : "no se econtraron categorias";
           $data["tiposDeCampos"] = $rs;
           echo JSON_ENCODE($data);

    }

    public function verTipoDeCampo(){

        $id = $this->input->post("id");
        $row = $this->Tipo_de_campos_model->ver_tipo_de_campo($id);

        $data["resultado"]= $row != null;
        $data["tipoDeCampo"] = $row;

        echo json_encode($data);

    }






    public function insertaTiposDeCampos(){

        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        $accion = $data['accion']; 

        if($data['accion']== "Agregar"){

            unset($data['accion']); 
            $rs = $this->Tipo_de_campos_model->inserta_tipos_de_campos($data);

        }else if($data['accion']== "editar"){

            unset($data['accion']); 
            $rs = $this->Tipo_de_campos_model->update_tipos_de_campos($data, $data['idTCampos']);
        }

        if($accion== "Agregar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se inserto la categoria correctamente" : "No se inserto prueba nuevamente";
        }else if($accion == "editar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se actualizo la categoria correctamente" : "No se actualizo prueba nuevamente";
        }

        echo json_encode($data);

    }


    public function cambioEstatus(){

        $id = $this->input->post("id");
        $rs = $this->Tipo_de_campos_model->estatus_tipos_de_campos($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se cambio el estatus correctamente": "No se pudo cambiar el estatus intenta de nuevo";

        echo json_encode($data);

    }


    public function bajaLogica(){

        $id = $this->input->post("id");
        $rs = $this->Tipo_de_campos_model->borradoLogico($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";

        echo json_encode($data);

    }







}//termina clase


?>