<?php 

class Permisos extends CI_Controller{

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
       
        $this->load ->model('daniw/Permisos_model');
       
       
    }



    public function index(){
		
		
		
		$this->permiso_id = get_permiso_modulo_seccion(
            $this->estatus,
            $this->rol_id,
			$this->idP,
            $modulo = 8,
            $seccion_id = 46
        );
		
		
		if (!is_null($this->permiso_id)) {
		
		

        $data['_APP_TITLE']              = "Permisos";        
        $data['_APP_VIEW_NAME']          = "Permisos";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 8, 46);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Permisos");
        $data['scripts'][] = 'daniw/Permisos';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['modals'][]  = $this->load->view('daniw/Permisos/modalPermisos', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('daniw/Permisos/Permisos_view', $data, TRUE);

        $this->load->view("default",$data,FALSE);
			
			
		 }else{
			redirect(base_url()."web");
	}	
			
			
			

    }

    public function verUsuario() {
        $idTU = $this->rol_id;

        if($idTU != 2) {
            $rs = $this->Permisos_model->ver_tipoUsuario();
            
        }else {
            //$idFiltro = array(1, 2);
            $idFiltro = 3;
            $rs = $this->Permisos_model->ver_tipoUsuarioPorId($idFiltro);
        }

        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." usuarios permisos" : "no se encontraron usuarios";
        $data["Permisos"] = $rs;

        echo JSON_ENCODE($data); 
        
    }

    public function getPermisos() {
		$idTU   = $this->input->post("idTU") != NULL ? $this->input->post("idTU") : 0;
		$data = $this->Permisos_model->get_Permisos($idTU);
		$obj["resultado"] = $data != NULL;
		if ($obj["resultado"]) {
			$obj["mensaje"] = "Se encontraron " . count($data) . " permisos";
			$obj["Permisos"]   = $data;
		} else {
			$obj["mensaje"] = "No se encontraron permisos";
		}
		echo json_encode($obj);
	}

    // ------------------------------------- Select -------------------------------------
    public function getUsuarios() {
        $idTU = $this->rol_id;

        if($idTU != 2) {
            $rs = $this->Permisos_model->get_Usuario();
            
        }else {
            //$idFiltro = array(1, 2);
            $idFiltro = 3;
            $rs = $this->Permisos_model->get_UsuarioPorId($idFiltro);
        }
        
        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." usuarios" : "no se encontraron usuarios";
        $data["Usuarios"] = $rs;
        echo JSON_ENCODE($data); 
    }

    public function getPerfil() {
        $rs = $this->Permisos_model->get_Perfil();
        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." perfiles" : "no se encontraron perfiles";
        $data["Perfil"] = $rs;
        echo JSON_ENCODE($data); 
    }

    // Módulos para el select
    public function getModulos(){
        $rs = $this->Permisos_model->get_Modulos();
        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." módulos" : "no se encontraron módulos";
        $data["Modulos"] = $rs;
        echo JSON_ENCODE($data); 
    }

    public function getSecciones() {

        $modulo_id = $this->input->post("modulo_id") != NULL ? $this->input->post("modulo_id") : 0;
		$data = $this->Permisos_model->get_Secciones($modulo_id);
		$obj["resultado"] = $data != NULL;
		if ($obj["resultado"]) {
			$obj["mensaje"] = "Se encontraron " . count($data) . " secciones";
			$obj["Secciones"]   = $data;
		} else {
			$obj["mensaje"] = "No se encontraron secciones";
		}
		echo json_encode($obj);

    }
    // ------------------------------------- Fin del select -------------------------------------
    // public function verListaPermisos(){ 

    //     $rs = $this->Permisos_model->ver_Permisos();
    //     $data['resultado'] = $rs != null;
    //     $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." permisos" : "no se econtraron permisos";
    //     $data["Permisos"] = $rs;
    //     echo JSON_ENCODE($data); 

    // }

    // public function verModulo() {
    //     $rs = $this->Permisos_model->ver_ModuloAs();
    //     $data['resultado'] = $rs != null;
    //     $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." modulos" : "no se econtraron modulos";
    //     $data["Permisos"] = $rs;
    //     echo JSON_ENCODE($data); 
    // }


    // public function insertaPermisos() {

    //     $json = file_get_contents('php://input');
    //     $data = (array)json_decode($json);
    //     $accion = $data['accion']; 
    //     $data['idTU']= $data["idTU"];

    //     if($data['accion']== "Agregar"){

    //         unset($data['accion']); 
    //         if ($this->db->error()['code'] == 1062) {
    //             $error = "Los datos ya existen en la base de datos.";
    //             $this->session->set_flashdata('error', $error);
    //         }else 
    //             $rs = $this->Permisos_model->inserta_Permisos($data);
    //         }

    //     }else if($data['accion']== "editar"){

    //         unset($data['accion']); 
    //         $rs = $this->Permisos_model->update_Permisos($data, $data['idTU']);
    //     }

    //     if($accion == "Agregar"){
    //         $data["resultado"]= $rs != false;
    //         $data["mensaje"] = $data["resultado"] ? "Se inserto el permiso correctamente" : "No se inserto el permiso";
    //     }else if($accion == "editar"){
    //         $data["resultado"]= $rs != false;
    //         $data["mensaje"] = $data["resultado"] ? "Se actualizo el permiso correctamente" : "No se actualizo prueba nuevamente";
    //     }

    //     echo json_encode($data);

    // }

    public function insertaPermisos() {
        $json = file_get_contents('php://input');
        $data = (array) json_decode($json);
        $accion = $data['accion']; 
        $data['idTU'] = $data["idTU"];
    
        if ($accion == "Agregar") {
            unset($data['accion']); 
            $rs = $this->Permisos_model->inserta_Permisos($data);
            
            if (!$rs) {
                $error = "Los datos ya existen en la base de datos";
                $data["mensaje"] = $error;
                $data["resultado"] = false;
            } else {
                $data["resultado"] = true;
                $data["mensaje"] = "Se insertó el permiso correctamente";
            }
        } else if ($accion == "editar") {
            unset($data['accion']); 
            $rs = $this->Permisos_model->update_Permisos($data, $data['idTU']);
            $data["resultado"] = $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se actualizó el permiso correctamente" : "No se actualizó el permiso, prueba nuevamente";
        }
    
        echo json_encode($data);
    }

    public function getSelect(){
        $id= $this->input->post("id");

        $rs = $this->Secciones_model->sel_Modulos($id);

        $data["resultado"] = $rs != null;
        $data["mensaje"]= $data["resultado"] ? "Se encontro el modulo ": "No se obtuvieron módulos";
        $data["selectMod"]= $rs;

        echo json_encode($data);

    }

    public function eliminaPermisos(){
        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        $idTU = $data['idTU']; 
        $idP = $data['idP']; 
        $mod_id = $data['modulo_id'];
        $secc_id = $data['seccion_id'];  


        $rs = $this->Permisos_model->elimina_Permisos($idTU, $idP, $mod_id, $secc_id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";

        echo json_encode($data);

    }







}//termina clase


?>