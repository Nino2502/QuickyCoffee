<?php
class Perfiles_colaboradores extends CI_Controller{
    private $idusuario;
	private $rol_id;
	private $idP;
	private $estatus;
	private $permiso_id;
	
	

    public  function __construct(){
        parent::__construct();

        verifica_token();
		
		
		update_user_estatus($this->session->userdata('idusuario'));
		
        $this->load->model('app/Perfil_colaboradores_model');
		
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
            $seccion_id = 17
        );
		
		if (!is_null($this->permiso_id)) {
		
		
		
		
        $data['_APP_TITLE']              = "Perfil Colaboradores";        
        $data['_APP_VIEW_NAME']          = "Administracion";
        $data['_APP_MENU']               = get_role_menu($this->rol_id ,3 ,17 );// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Perfiles de colaboradores");
        $data['scripts'][] = 'propiosScripts/PerfilColaboradores';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['modals'][]  = $this->load->view('private/fragments/PerfilColaboradores/modalPerfilColaboradores', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/PerfilColaboradores/PerfilColaboradores_View', $data, TRUE);
        $this->load->view("default",$data,FALSE);
		
		}else{
			redirect(base_url()."web");
		}
			
			
    }

    public function verTipoPerfilesColaboradores(){

        $rs = $this->Perfil_colaboradores_model->ver_tipo_colaboradores();

        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." especialidades" : "no se encontraron especialidades";
        $data["TipoEspecialidad"] = $rs;

        echo JSON_ENCODE($data);
    }
    public function insertarPerfilColaborador(){
        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        $accion = $data['accion']; 


        if($data['accion'] == "agregar"){

            unset($data['accion']); //sacamos la accion del array
            $rs = $this->Perfil_colaboradores_model->inserta_Perfil_Colaborador($data);

        }else if($data['accion'] == "editar"){

            unset($data['accion']); 
            $rs = $this->Perfil_colaboradores_model->update_Perfil_Colaborador($data, $data['idTP']);
        }
        else if($data['accion'] == "CambiarEstatus"){
            if($data['estatus'] == 1){
 
                $status =  $data['estatus'];
                $idTP   =  $data['idTP'];

                unset($data['accion']); 

                $changeData = array(
                    "status"        => $status,
                    "idTP"          => $idTP,
                   
                );
                $rs = $this->Perfil_colaboradores_model->changeStatus1($changeData);
            }else if($data['estatus'] == 0) {
                $status =  $data['estatus'];
                $idTP   =  $data['idTP'];

                unset($data['accion']); 

                $changeData = array(
                    "status"        => $status,
                    "idTP"          => $idTP,
                   
                );
                $rs = $this->Perfil_colaboradores_model->changeStatus0($changeData);
            }
              
        }


        if($accion == "agregar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se inserto el tipo contratacion correctamente" : "No se inserto, prueba nuevamente";
        }else if($accion == "editar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se actualizo el tipo contratacion correctamente" : "No se actualizo prueba nuevamente";
        }
        else if($accion == "eliminar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se ha eliminado el tipo contratacion correctamente" : "Error en eliminar, prueba nuevamente";
        }
        else if($accion == "CambiarEstatus"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se ha cambiado el status" : "Error en cambiar estatus, prueba nuevamente";
        }


        echo json_encode($data);

    }
    public function bajaLogica(){

        $id = $this->input->post("id");
        $rs = $this->Perfil_colaboradores_model->borradoLogico($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";

        echo json_encode($data);

    }



}
?>
