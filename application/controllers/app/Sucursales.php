<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Sucursales extends CI_Controller {

   private $idusuario;
    private $rol_id;
	private $idP;
	private $estatus;
	private $permiso_id;
	


    public function __construct(){

        parent::__construct();
		
		verifica_token();
		
		update_user_estatus($this->session->userdata('idusuario'));
		
		
        $this->load->model('app/Sucursales_model');
		
       	$this->idusuario = $this->session->userdata('idusuario');
        $this->rol_id = $this->session->userdata('idTipoUsuario');
		$this->idP = $this->session->userdata('idPerfilUsuario');
		$this->estatus = $this->session->userdata('estatus');
    }

    public function index()
		
    {
		
		
		$this->permiso_id = get_permiso_modulo_seccion(
            $this->estatus,
            $this->rol_id,
			$this->idP,
            $modulo = 6,
            $seccion_id = 28
        );
		
		
		if (!is_null($this->permiso_id)) {
		
		
        $data['_APP_TITLE']              = "Sucursales";        
        $data['_APP_VIEW_NAME']          = "Sucursales";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 6, 28);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Lista Sucursales");
        $data['scripts'][] = 'propiosScripts/sucursales';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['modals'][]  = $this->load->view('private/fragments/sucursales/modalsucursales', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/sucursales/sucursales_view', $data, TRUE);

        $this->load->view("default",$data,FALSE);
			
			
		}else{
			redirect(base_url()."web");
	}	
			
			
			
    }

    public function verSucursales(){

        $rs = $this->Sucursales_model->ver_Sucursales();
        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." tipos de pago" : "no se econtraron sucursales";
        $data["sucursales"] = $rs;
        echo JSON_ENCODE($data);
    }

    public function verEstados()
    {
        $estados = $this->Sucursales_model->ver_estados();
        $data['resultado'] = $estados != null;
        $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($estados)." estados" : "no se econtraron estados";
        $data["estados"] = $estados;
        echo JSON_ENCODE($data);
    }

    public function verMunicipios()
    {
        $estado_id = $this->input->post("estado_id");
        $municipios = $this->Sucursales_model->ver_municipios($estado_id);
        $data['resultado'] = $municipios != null;
        $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($municipios)." municipios" : "no se econtraron municipios";
        $data["municipios"] = $municipios;
        echo JSON_ENCODE($data);
    }

    public function insertaSucursales(){

        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        $accion = $data['accion']; 

        if($data['accion']== "Agregar"){

            unset($data['accion']); 
            $rs = $this->Sucursales_model->inserta_Sucursales($data);

        }else if($data['accion']== "editar"){

            unset($data['accion']); 
            $rs = $this->Sucursales_model->update_Sucursales($data, $data['idSuc']);
        }

        if($accion== "Agregar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se inserto la sucursal correctamente" : "No se inserto prueba nuevamente";
        }else if($accion == "editar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se actualizo la sucural correctamente" : "No se actualizo prueba nuevamente";
        }

        echo json_encode($data);

    }

    public function cambioEstatus(){

        $id = $this->input->post("id");
        $rs = $this->Sucursales_model->estatus_Sucursales($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se cambio el estatus correctamente": "No se pudo cambiar el estatus intenta de nuevo";

        echo json_encode($data);

    }

    public function bajaLogica(){

        $id = $this->input->post("id");
        $rs = $this->Sucursales_model->borradoLogico($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";

        echo json_encode($data);

    }

}

/* End of file Sucursales.php and path /application/controllers/app/Sucursales.php */