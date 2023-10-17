<?php
class Admin extends CI_Controller{
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
       
        $this->load->model('daniw/Admin_model');
        
       
    }


    public function index(){
		
		
			$this->permiso_id = get_permiso_modulo_seccion(
            $this->estatus,
            $this->rol_id,
			$this->idP,
            $modulo = 8,
            $seccion_id = 57
        );
		
		
		if (!is_null($this->permiso_id)) {
		
		
		
        $data['_APP_TITLE']              = "Super Administrador";        
        $data['_APP_VIEW_NAME']          = "Usuarios";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 8, 57);// menu lateral
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Super Administrador");
        $data['scripts'][] = 'daniw/Admin';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['modals'][]  = $this->load->view('daniw/Admin/modalAdmin', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('daniw/Admin/Admin_View', $data, TRUE);
        $this->load->view("default",$data,FALSE);
			
		 }else{
			redirect(base_url()."web");
	}	
			
			
    }

    // Listado de la tabla
    public function verListaColaboradores(){
        $rs = $this->Admin_model->ver_lista_colaboradores(); 

        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." administradores!" : "No se encontraron administradores";
        $data["ListaColaboradores"] = $rs;

        echo JSON_ENCODE($data);
    }

    // Vista Previa 
    public function verColaborador(){
        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        $id = $data['id'];
        
        $rs = $this->Admin_model->ver_colaborador($id);

        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Detalle de usuario encontrado" : "El detalle no se pudo encontrar";
        $data["Detalle"] = $rs;

        echo JSON_ENCODE($data);
    }


    public function insertarColaborador(){
        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        $accion = $data['accion']; 

        if($data['accion'] == "agregar"){
            $correo = $data['correo'];
            $telefono = $data['telefono'];
            unset($data['accion']); 
            //Validamos que el correo no exista
            $ValidaTel    = $this->Admin_model->validarTelefono($telefono);
            $ValidaCorreo = $this->Admin_model->validarCorreo($correo);
            
            if($ValidaCorreo != null && $ValidaCorreo != "" || $ValidaTel != null && $ValidaTel != ""){

                if ($ValidaTel != null && $ValidaTel != ""){
                    $data["StatusTe"] = false;
                    $data["ResTelefono"] = "telefono ya registrado, registre uno nuevo";
                }
                if($ValidaCorreo != null && $ValidaCorreo != ""){ 
                    $data["StatusCo"] = false;
                    $data["ResCorreo"] = "correo ya esta registrado, registre uno nuevo";
                }

                $rs = false; 
              
            }else{
                unset($data['accion']); 
                $contrasenia = $data['contrasenia'];
                $contraseniaEncriptada = md5($contrasenia);
                $data['contrasenia'] = $contraseniaEncriptada;

                $rs = $this->Admin_model->inserta_usuario_colaborador($data);

            }

        }else if($data['accion'] == "editar"){

            unset($data['accion']); 
            $rs = $this->Admin_model->update_Tipo_Contratacion($data, $data['idU']);
        }
       
        else if($data['accion'] == "CambiarEstatus"){
            if($data['estatus'] == 1){
 
                $status =  $data['estatus'];
                $idU   =  $data['idU'];

                unset($data['accion']); 

                $changeData = array(
                    "status"        => $status,
                    "idU"          => $idU,
                   
                );
                $rs = $this->Admin_model->changeStatus1($changeData);
            }else if($data['estatus'] == 0) {
                $status =  $data['estatus'];
                $idU   =  $data['idU'];

                unset($data['accion']); 

                $changeData = array(
                    "status"        => $status,
                    "idU"          => $idU,
                   
                );
                $rs = $this->Admin_model->changeStatus0($changeData);
            }
              
        }


        if($accion == "agregar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se inserto el administrador correctamente" : "Registro no realizado";
        }else if($accion == "editar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se actualizo el administrador correctamente" : "No se actualizo prueba nuevamente";
        }
        else if($accion == "eliminar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se ha eliminado el administrador correctamente" : "Error en eliminar, prueba nuevamente";
        }
        else if($accion == "CambiarEstatus"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se ha cambiado el status" : "Error en cambiar estatus, prueba nuevamente";
        }


        echo json_encode($data);

    }
    public function bajaLogica(){

        $id = $this->input->post("idU");
        $rs = $this->Admin_model->borradoLogico($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";

        echo json_encode($data);

    }
    public function TipoUsuario(){
        $rs = $this->Admin_model->ver_lista_tipoUsuario();

        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron  clases de usuarios!" : "no se encontraron clases disponibles";
        $data["TipoUsuarios"] = $rs;

        echo JSON_ENCODE($data);
    }




}
?>
