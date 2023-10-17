<?php
class Usuarios_Majors extends CI_Controller{
    private $rol_id;
	private $idP;

    public function __construct(){
         parent::__construct();

        // verifica_token();
        $this->load->model('app/Usuario_majors_model');
        $this->rol_id = $this->session->userdata('idTipoUsuario');
		$this->idP = $this->session->userdata('idPerfilUsuario');
       
    }


    public function index(){
        $data['_APP_TITLE']              = "Majors";        
        $data['_APP_VIEW_NAME']          = "Usuarios";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 1);
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Majors");
        $data['scripts'][] = 'propiosScripts/usuarios_majors';
        $data['scripts'][] = 'propiosScripts/Usuarios_Sucurales';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['modals'][]  = $this->load->view('private/fragments/UsuarioMajor/ModalUsuarioMajor', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/UsuarioMajor/UsuarioMajor_view', $data, TRUE);
        $this->load->view("default",$data,FALSE);
    }

    public function verListaMajors(){

        $rs = $this->Usuario_majors_model->ver_lista_majors();

        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." Majors!" : "no se encontraron colaboradores";
        $data["ListaMajors"] = $rs;

        echo JSON_ENCODE($data);
    }
    public function insertarColaborador(){
        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        $accion = $data['accion']; 


        if($data['accion'] == "agregar"){
            $correo = $data['correo'];
            $telefono = $data['telefono'];
            unset($data['accion']); //sacamos la accion del array
            //Validamos que el correo no exista
            $ValidaTel    = $this->Usuario_majors_model->validarTelefono($telefono);
            $ValidaCorreo = $this->Usuario_majors_model->validarCorreo($correo);

            if($ValidaCorreo != null || $ValidaTel != null){

                if ($ValidaTel != null){
                    $data["StatusTe"] = false;
                    $data["ResTelefono"] = "telefono ya registrado, registre uno nuevo";
                }
                if($ValidaCorreo !=null){
                    $data["StatusCo"] = false;
                    $data["ResCorreo"] = "correo ya esta registrado, registre uno nuevo";
                }
               
             
                $rs = false;
              
            }else{
                unset($data['accion']); //sacamos la accion del array
                
                $NuevaData = array(
                    "nombreU"        => $data['nombreU'],
                    "apellidos"      => $data['apellidos']  ,
                    "correo"         => $data['correo'],
                    "telefono"       => $data['telefono'],
                    "contrasenia"    => md5($data['contrasenia']),
                    "rfc"            => $data['rfc'],
                    "idTU"           => $data['idTU'],
                    "idP"            => $data['idP'],
                    "estatus"        => 1,
                );
                
                unset($data['accion']); //sacamos la accion del array
                $rs = $this->Usuario_majors_model->inserta_usuario_colaborador($NuevaData);
            }


        }else if($data['accion'] == "editar"){

            unset($data['accion']); 
            $rs = $this->Usuario_majors_model->update_Tipo_Contratacion($data, $data['idU']);
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
                $rs = $this->Usuario_majors_model->changeStatus1($changeData);
            }else if($data['estatus'] == 0) {
                $status =  $data['estatus'];
                $idU   =  $data['idU'];

                unset($data['accion']); 

                $changeData = array(
                    "status"        => $status,
                    "idU"          => $idU,
                   
                );
                $rs = $this->Usuario_majors_model->changeStatus0($changeData);
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
        $rs = $this->Usuario_majors_model->borradoLogico($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";

        echo json_encode($data);

    }
    public function listaSucursales(){
        
        $rs = $this->Usuario_majors_model->ver_lista_sucursales();

        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." Sucursales!" : "no se encontraron sucursales";
        $data["Sucursales"] = $rs;

        echo JSON_ENCODE($data);
    }

    public function SucursalRegistro(){
        $idU            = $this->input->post("idU");
        $calle          = $this->input->post("calle");
        $numeroExterior = $this->input->post("numeroExterior");
        $numeroInterior = $this->input->post("numeroInterior");
        $codigoPostal   = $this->input->post("codigoPostal");
        $municipio      = $this->input->post("municipio");
        $estado         = $this->input->post("estado");
        $descripcion    = $this->input->post("descripción");
        $domFiscal      = $this->input->post("domFiscal");
        $estatus        = 1;

        $AddressData = array(
            "idU"           => $idU,
            "calle"         => $calle,
            "numeroExterior"=> $numeroExterior,
            "numeroInterior"=> $numeroInterior,
            "codigoPostal"  => $codigoPostal,
            "municipio"     => $municipio,
            "estado"        => $estado,
            "descripción"   => $descripcion,
            "domFiscal"     => $domFiscal,
            "estatus"       => $estatus,
        );

        if ($domFiscal == 1) {
                /*
                    si el nuevo domicilio que se regristra es domicilio fiscal 1, necesitamos actualizar los demas en 0
                */
            $StatusDomfiscal = $this->Usuario_majors_model->updateDomFiscal($idU);
                /*
                    una ves actualizado los demas domicilios a 0, procedemos a insertar el nuevo domicilio con domilio fiscal 1
                */
            if($StatusDomfiscal != null){
                /* 
                    Insertamos el nuevo domicilio fiscal 
                */
                $rs = $this->Usuario_majors_model->registerAddress($AddressData);
                if($rs != null){
                    $data["resultado"] = $rs != false;
                    $data["mensajeDOM"] ="Se registro correctamente";
                    //procedemos a registrar la sucursales
                }else{
                    $data["resultado"] = $rs != false;
                    $data["mensajeDOM"] ="No se registro correctamente";
                }
            }
        }
        if ($domFiscal == 0){
            // insert the new sucursal
            // $rs = $this->Usuario_majors_model->registro($AddressData);
            $rs = $this->Usuario_majors_model->registro();
        
        }
         // first, need to register the  domicile or address of the Major
      
        echo JSON_ENCODE($data);
        
    }
    


}
?>
