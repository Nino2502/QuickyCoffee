<?php
class Usuario_colaboradores extends CI_Controller{
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
       
    
        $this->load->model('app/Usuarios_model');
       
       
    }


    public function index(){
		
		
			$this->permiso_id = get_permiso_modulo_seccion(
            $this->estatus,
            $this->rol_id,
			$this->idP,
            $modulo = 5,
            $seccion_id = 3
        );
		
		
		if (!is_null($this->permiso_id)) {
		
		
		
        $data['_APP_TITLE']              = "Empleados";        
        $data['_APP_VIEW_NAME']          = "Usuarios";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 8, 15);// menu lateral
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Empleados");
        $data['scripts'][] = 'propiosScripts/Usuarios';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['modals'][]  = $this->load->view('private/fragments/Usuarios/modalUsuarios', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/Usuarios/Usuarios_View', $data, TRUE);
        $this->load->view("default",$data,FALSE);
			
			
		 }else{
			redirect(base_url()."web");
	}	
			
			
			
    }

    // Listado de la tabla
    public function verListaColaboradores(){
        $rs = $this->Usuarios_model->ver_lista_colaboradores(); 

        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." empleados!" : "No se encontraron empleados";
        $data["ListaColaboradores"] = $rs;

        echo JSON_ENCODE($data);
    }

    // Vista Previa 
    public function verColaborador(){
        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        $id = $data['id'];
        
        $rs = $this->Usuarios_model->ver_colavorador($id);

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
            // var_dump('agregar');
            // die();
            $correo = $data['correo'];
            $telefono = $data['telefono'];
            unset($data['accion']); 
            //Validamos que el correo no exista
            $ValidaTel    = $this->Usuarios_model->validarTelefono($telefono);
            $ValidaCorreo = $this->Usuarios_model->validarCorreo($correo);
            // var_dump("Telefono: ".$ValidaTel);
            // die();
            
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

                if ($data['idEsp'] == ""){
                    $NuevaData = array(
                        "nombreU"        => $data['nombreU'],
                        "apellidos"      => $data['apellidos'],
                        "correo"         => $data['correo'],
                        "telefono"       => $data['telefono'],
                        "sueldo"         => $data['sueldo'],
                        "contrasenia"    => md5($data['contrasenia']),
                        "rfc"            => $data['rfc'],
                        "idTU"           => $data['idTU'],
                        "idP"            => $data['idP'],
                        "idSuc"          => $data['idSuc'],
                        "estatus"        => 1,
                    );
                } else {

                    $NuevaData = array(
                        "nombreU"        => $data['nombreU'],
                        "apellidos"      => $data['apellidos'],
                        "correo"         => $data['correo'],
                        "telefono"       => $data['telefono'],
                        "sueldo"         => $data['sueldo'],
                        "contrasenia"    => md5($data['contrasenia']),
                        "rfc"            => $data['rfc'],
                        "idTU"           => $data['idTU'],
                        "idP"            => $data['idP'],
                        "idSuc"          => $data['idSuc'],
                        "estatus"        => 1,
                        "idEsp"          => $data['idEsp'],
                    );

                }
                $contrasenia = $data['contrasenia'];
                $contraseniaEncriptada = md5($contrasenia);
                $data['contrasenia'] = $contraseniaEncriptada;
                $rs = $this->Usuarios_model->inserta_usuario_colaborador($NuevaData);

            } 


        }else if($data['accion'] == "editar"){

            unset($data['accion']); 
            $rs = $this->Usuarios_model->update_Tipo_Contratacion($data, $data['idU']);
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
                $rs = $this->Usuarios_model->changeStatus1($changeData);
            }else if($data['estatus'] == 0) {
                $status =  $data['estatus'];
                $idU   =  $data['idU'];

                unset($data['accion']); 

                $changeData = array(
                    "status"        => $status,
                    "idU"          => $idU,
                   
                );
                $rs = $this->Usuarios_model->changeStatus0($changeData);
            }
              
        }


        if($accion == "agregar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se inserto el colaborador correctamente" : "Registro no realizado";
        }else if($accion == "editar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se actualizo el colaboradorcorrectamente" : "No se actualizo prueba nuevamente";
        }
        else if($accion == "eliminar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se ha eliminado el colaborador correctamente" : "Error en eliminar, prueba nuevamente";
        }
        else if($accion == "CambiarEstatus"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se ha cambiado el status" : "Error en cambiar estatus, prueba nuevamente";
        }


        echo json_encode($data);

    }
    public function bajaLogica(){

        $id = $this->input->post("idU");
        $rs = $this->Usuarios_model->borradoLogico($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";

        echo json_encode($data);

    }
    public function TipoUsuario(){
        $rs = $this->Usuarios_model->ver_lista_tipoUsuario();

        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron  clases de usuarios!" : "no se encontraron clases disponibles";
        $data["TipoUsuarios"] = $rs;

        echo JSON_ENCODE($data);
    }




}
?>
