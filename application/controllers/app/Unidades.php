<?php 

class Unidades extends CI_Controller{

	private $idusuario;
    private $rol_id;
	private $idP;
	private $estatus;
	private $permiso_id;
	
	


    public function __construct(){

        parent::__construct();
		
		verifica_token();
		
		update_user_estatus($this->session->userdata('idusuario'));
		
        $this->load ->model('app/Unidades_model');
		
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
            $modulo = 3,
            $seccion_id = 26
        );
		
		if (!is_null($this->permiso_id)) {
		
		

        $data['_APP_TITLE']              = "Unidades";        
        $data['_APP_VIEW_NAME']          = "Administracion";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 3, 26);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Unidades");
        $data['scripts'][] = 'propiosScripts/Unidades';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['modals'][]  = $this->load->view('private/fragments/Unidades/modalUnidades', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/Unidades/Unidades_view', $data, TRUE);

        $this->load->view("default",$data,FALSE);
			
		}else{
			redirect(base_url()."web");
		}
			
			

    }

    public function verUnidades(){

           $rs = $this->Unidades_model->ver_Unidades();
           $data['resultado'] = $rs != null;
           $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." Unidades" : "no se econtraron Unidades";
           $data["Unidades"] = $rs;
           echo JSON_ENCODE($data);

    }


    public function insertaUnidades(){

        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        $accion = $data['accion']; 

        if($data['accion']== "Agregar"){

            unset($data['accion']); 
            $rs = $this->Unidades_model->inserta_Unidades($data);

        }else if($data['accion']== "editar"){

            unset($data['accion']); 
            $rs = $this->Unidades_model->update_Unidades($data, $data['idUni']);
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
        $rs = $this->Unidades_model->estatus_Unidades($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se cambio el estatus correctamente": "No se pudo cambiar el estatus intenta de nuevo";

        echo json_encode($data);

    }


    public function bajaLogica(){

        $id = $this->input->post("id");
        $rs = $this->Unidades_model->borradoLogico($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";

        echo json_encode($data);

    }







}//termina clase


?>