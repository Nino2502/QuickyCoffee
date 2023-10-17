<?php
class Especialidad_colaborador extends CI_Controller{
    
	private $idusuario;
	private $rol_id;
	private $idP;
	private $estatus;
	private $permiso_id;

    public  function __construct(){
        parent::__construct();

        verifica_token();
		
		
		update_user_estatus($this->session->userdata('idusuario'));
		
		
        $this->load->model('app/Especialidad_colaborador_model');
		
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
            $seccion_id = 4
        );
		if (!is_null($this->permiso_id)) {
		
		
		
        $data['_APP_TITLE']              = "Especialidad perfiles de emleados";        
        $data['_APP_VIEW_NAME']          = "Administración";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 3, 4);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Especialidad perfiles de emleados");
        $data['scripts'][] = 'propiosScripts/EspecialidadColaborador';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['modals'][]  = $this->load->view('private/fragments/Especialidades/modalEspecialidad', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/Especialidades/Especialidades_View', $data, TRUE);
        $this->load->view("default",$data,FALSE);
		
		}else{
			redirect(base_url()."web");
		}
			
			
    }

    public function verTipoEspecialidadesColaboradores(){

        $rs = $this->Especialidad_colaborador_model->verEspecialidades();

        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." tipos de especialidad" : "no se encontraron especialidades";
        $data["tipoEspecialidadC"] = $rs;

        echo JSON_ENCODE($data);
    }
    public function insertarEspecialidadColaborador(){
        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        $accion = $data['accion']; 


        if($data['accion'] == "agregar"){

            unset($data['accion']); //sacamos la accion del array
            $rs = $this->Especialidad_colaborador_model->inserta_Especialidad_Colaborador($data);

        }else if($data['accion'] == "editar"){

            unset($data['accion']); 
            $rs = $this->Especialidad_colaborador_model->update_Especialidad_Colaborador($data, $data['idEsp']);
        }
        else if($data['accion'] == "CambiarEstatus"){
            if($data['estatus'] == 1){
                $status =  $data['estatus'];
                $idEsp   =  $data['idEsp'];
                unset($data['accion']); 
                $changeData = array(
                    "status"        => $status,
                    "idEsp"          => $idEsp,
                );
                $rs = $this->Especialidad_colaborador_model->changeStatus1($changeData);
            }else if($data['estatus'] == 0) {
                $status =  $data['estatus'];
                $idEsp   =  $data['idEsp'];

                unset($data['accion']); 

                $changeData = array(
                    "status"        => $status,
                    "idEsp"          => $idEsp,
                   
                );
                $rs = $this->Especialidad_colaborador_model->changeStatus0($changeData);
            }
              
        }


        if($accion == "agregar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se inserto especialidad correctamente" : "No se inserto, prueba nuevamente";
        }else if($accion == "editar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se actualizo especialidad correctamente" : "No se actualizo prueba nuevamente";
        }
        else if($accion == "eliminar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se ha eliminado especialidad correctamente" : "Error en eliminar, prueba nuevamente";
        }
        else if($accion == "CambiarEstatus"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se ha cambiado el status" : "Error en cambiar estatus, prueba nuevamente";
        }


        echo json_encode($data);

    }
    public function bajaLogica(){

        $id = $this->input->post("id");
        $rs = $this->Especialidad_colaborador_model->borradoLogico($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";

        echo json_encode($data);

    }



}
?>
