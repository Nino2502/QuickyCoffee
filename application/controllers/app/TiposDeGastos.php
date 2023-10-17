<?php 

class TiposDeGastos extends CI_Controller{

	private $idusuario;
    private $rol_id;
	private $idP;
	private $estatus;
	private $permiso_id;


    public function __construct(){

        parent::__construct();
		
		verifica_token();
		
		
		update_user_estatus($this->session->userdata('idusuario'));
		
		
        $this->load ->model('app/Tipos_De_Gastos_model');
		
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
            $modulo = 9,
            $seccion_id = 52
        );
		
		
		if (!is_null($this->permiso_id)) {

        $data['_APP_TITLE']              = "Tipo de pago";        
        $data['_APP_VIEW_NAME']          = "Administracion";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 9, 52);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Formas de pago");
        $data['scripts'][] = 'propiosScripts/TiposDeGastos';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['modals'][]  = $this->load->view('private/fragments/TiposDeGastos/modalTiposDeGastos', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/TiposDeGastos/TiposDeGastos_view', $data, TRUE);

        $this->load->view("default",$data,FALSE);
			
			
		}else{
			redirect(base_url()."web");
		}

    }

    public function verTiposDeGastos(){

           $rs = $this->Tipos_De_Gastos_model->ver_Tipos_De_Gastos();
           $data['resultado'] = $rs != null;
           $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." tipos de pago" : "no se econtraron categorias";
           $data["TiposDeGastos"] = $rs;
           echo JSON_ENCODE($data);

    }


    public function insertaTiposDeGastos(){

        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        $accion = $data['accion']; 

        if($data['accion']== "Agregar"){

            unset($data['accion']); 
            $rs = $this->Tipos_De_Gastos_model->inserta_Tipos_De_Gastos($data);

        }else if($data['accion']== "editar"){

            unset($data['accion']); 
            $rs = $this->Tipos_De_Gastos_model->update_Tipos_De_Gastos($data, $data['idTG']);
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
        $rs = $this->Tipos_De_Gastos_model->estatus_Tipos_De_Gastos($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se cambio el estatus correctamente": "No se pudo cambiar el estatus intenta de nuevo";

        echo json_encode($data);

    }


    public function bajaLogica(){

        $id = $this->input->post("id");
        $rs = $this->Tipos_De_Gastos_model->borradoLogico($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";

        echo json_encode($data);

    }







}//termina clase


?>