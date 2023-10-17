<?php
class Perfil_usuario extends CI_Controller{
  

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
       
    
        $this->load->model('daniw/Perfil_model');
             
       
    }


    public function index(){
		
		/*
			$this->permiso_id = get_permiso_modulo_seccion(
            $this->estatus,
            $this->rol_id,
			$this->idP,
            $modulo = 4,
            $seccion_id = 19
        );
		
		
		if (!is_null($this->permiso_id)) {
		
*/
		
		
        $info_usuario                    = $this->Perfil_model->get_perfil($this->idusuario); 
        $data["info_usuario"]            = $info_usuario;
        
        $data['_APP_TITLE']              = "Usuarios perfil";        
        $data['_APP_VIEW_NAME']          = "Usuario perfil";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 4, 19);// menu lateral     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Perfil");
        $data['scripts'][] = 'daniw/perfil_usuarios'; 
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['css'][] = 'static/stylesheets/estilos.css';
        $data['modals'][]  = $this->load->view('daniw/Perfil/modal_perfil_usuario', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('daniw/Perfil/perfil_usuario_View', $data, TRUE);
        $this->load->view("default",$data,FALSE);
			
		/*	
			
		 }else{
			redirect(base_url()."web");
	}	*/
			
			
    }

    public function getUsuario(){
        json_header();
        $idUsuario =   $this -> input ->post('idU');
       
        $rs = $this->Perfil_model->get_perfil($idUsuario);
       

        $data['idUsu'] = $idUsuario;
        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Informacion encontrada!" : "no se encontro nada";
        $data["Usuario"] = $rs;

        echo JSON_ENCODE($data);
    }

    public function getMunicipio() {
        $estado_id = $this->input->post("estado_id") != NULL ? $this->input->post("estado_id") : 0;
        $rs = $this->Perfil_model->get_Municipio($estado_id);
       
        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Municipios encontrados" : "No se encontraron municipios";
        $data["Municipio"] = $rs;

        echo JSON_ENCODE($data);   
    }

    public function getEstados() {
        $rs = $this->Perfil_model->get_Estados();
       
        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Estados encontrados" : "No se encontraron estados";
        $data["Estado"] = $rs;

        echo JSON_ENCODE($data);
    
    }

    public function updatePass(){
        json_header();
        $idUsuario  =   $this -> input ->post('idU');
        $pass       =   $this -> input ->post('pass');
        $passN      =   $this -> input ->post('passN');
        $UpdateData = array(
            'pass'  => $pass,
            'idU'   => $idUsuario,
            'passN' => $passN
        );
        $verificaPass = $this->Perfil_model->VerificaPass_usuario_perfil($UpdateData);
        if ($verificaPass == true){
           
            $rs = $this->Perfil_model->UpdatePass_usuario_perfil($UpdateData);
        }
        else{
            $data["Status"] = false;
            $data["Pass"] = "La contraseña es invalida";
            $rs = false;
        }
        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se actualizo la contraseña!" : "ERROR en actualizar";
        $data["ListaColaboradores"] = $rs;
        echo JSON_ENCODE($data);
    }

    public function ActualizarPerfil(){
        json_header();
        $idUsuario      =   $this -> input ->post('idU');
        $nombreU        =   $this -> input ->post('nombreU');
        $apellidos      =   $this -> input ->post('apellidos');
        $telefono       =   $this -> input ->post('telefono');
        
        $UpdateData = array(
            'idU'           => $idUsuario,
            'nombreU'       => $nombreU,
            'apellidos'     => $apellidos,
            'telefono'      => $telefono
        );
        $info = $this->Perfil_model->infoShort($idUsuario);
        $ValidaTel              = $this->Perfil_model->telSame($UpdateData);
        $telSameDiferente       = $this->Perfil_model->telSameDiferente($UpdateData);

        if ($ValidaTel == true){
            $data["StatusTe"] = true;
            $data["ResTelefono"] = "telefono valido";
            $rs = $this->Perfil_model->UpdatePerfil_usuario_perfil($UpdateData);

        }if ($telSameDiferente == true){
            $data["StatusTe"] = false;
            $data["ResTelefono"] = "telefono en uso";
            $data["info"] = $info;
            $rs = false;
        }else{
            $data["StatusTe"] = true;
            $data["ResTelefono"] = "telefono disponible";
            $rs = $this->Perfil_model->UpdatePerfil_usuario_perfil($UpdateData);
        }

        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se actualizo la información!" : "ERROR en actualizar";
        $data["ListaColaboradores"] = $rs;
        echo JSON_ENCODE($data);

       
    }


    public function subir_imagenPerfil() {
        $idUsuario = $this->idusuario;
      

        $config['upload_path'] = 'static/uploads/profiles/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '1024';
        $hoy = date('YmdHis');



        $nuevoNombreImg = 'profile_pic_' . ($hoy = date('YmdHis'));
        $config['file_name'] = strtolower($nuevoNombreImg);

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('fileImagen')) {
            $data["upload"]= true;
            $file_info = $this->upload->data();
            $imagen = $file_info['file_name'];
            $data = [
                'avatar_usuario' => $imagen,
            ];

            $response = $this->Perfil_model->logo_user($data, $idUsuario);

            // Actualizar la variable de sesión 'image_url'
            $_SESSION['image_url'] = $imagen;

            




            if($response){
                $data["res"]= true;
            }else{
                $data["res"]= false;
            }
            

            redirect(base_url('daniw/Perfil_usuario'), 'refresh');
            
        }else{
            $data["upload"]= false;
           
         
            redirect(base_url('daniw/Perfil_usuario'), 'refresh');
        }

        echo JSON_ENCODE($data);

       
    }

    public function getDF() {
        $Usuario = $this->idusuario; 
        // echo $Usuario;
        // var_dump($_SESSION);
        // die();



        $rs = $this->Perfil_model->get_DF($Usuario);
        // echo "<pre>";
        // var_dump($this->db->last_query());
        // var_dump($rs);
        // die();
        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." datos fiscales" : "No se encontraron datos fiscales";
        $data["Fiscales"] = $rs;
        echo JSON_ENCODE($data); 
    }

    public function getDomicilio() {
        $idU = $this->input->post("idU") != NULL ? $this->input->post("idU") : 0;
        $rs = $this->Perfil_model->get_Domicilio($idU);
       
        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Domicilios encontrados" : "No se encontraron domicilios";
        $data["Domicilio"] = $rs;

        echo JSON_ENCODE($data);
    
    }

    public function getrFiscal() {
        $rs = $this->Perfil_model->get_rFiscal();
       
        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Regimen Fiscal encontrados" : "No se encontraron datos";
        $data["rFiscal"] = $rs;

        echo JSON_ENCODE($data);
    
    }

    public function getDFiscal() {
        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);

        $rs = $this->Perfil_model->get_DFiscales($data['idU']);
        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." domicilios" : "No se encontraron domicilios";
        $data["Fiscales"] = $rs;
        echo JSON_ENCODE($data); 
    }

    public function getDetalle() {
        $rs = $this->Perfil_model->get_Detalle();
       
        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Detalles encontrados" : "No se encontraron detalles";
        $data["Detalle"] = $rs;

        echo JSON_ENCODE($data);  
    }

    public function insertFiscal(){
        $Usuario = $this->idusuario;

        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        $accion = $data['accion']; 
        // var_dump($data); 
        // die();

        if($data['accion'] == "Agregar") {            
            unset($data['accion']); 

            if($data['orden'] == 1) {
                $rs = $this->Perfil_model->insert_Fiscal2($data, $Usuario);
            } else {
                $rs = $this->Perfil_model->insert_Fiscal($data); 
            }

        }else if($data['accion']== "editar") {

            unset($data['accion']); 

            if($data['orden'] == 1) {
                $rs = $this->Perfil_model->update_Fiscal2($data, $data['idFiscales'], $Usuario);
            } else {
                $rs = $this->Perfil_model->update_Fiscal($data, $data['idFiscales']);
            }

        }

        if($accion == "Agregar") {
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se inserto el domicilio fiscal" : "No se inserto prueba nuevamente";
        }else if($accion == "editar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se actualizo el domicilio fiscal" : "No se actualizo prueba nuevamente";
        }

        echo json_encode($data);

    }

    public function insertDomicilio(){

        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        $accion = $data['accion']; 

        if($data['accion'] == "Agregar") {

            unset($data['accion']); 
            $rs = $this->Perfil_model->insert_Domicilio($data);

        }else if($data['accion']== "editar") {

            unset($data['accion']); 
            $rs = $this->Perfil_model->update_Domicilio($data, $data['idU']);

        }

        if($accion == "Agregar") {
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se inserto el domicilio fiscal" : "No se inserto prueba nuevamente";
        }else if($accion == "editar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se actualizo el domicilio fiscal" : "No se actualizo prueba nuevamente";
        }

        echo json_encode($data);

    }

    public function cambiaEstatus() {

        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        
        $rs = $this->Perfil_model->update_Estatus($data['idD']);

        $data["resultado"] = $rs != false;
        $data["mensaje"] = $data["resultado"] ? "Se cambio el estatus correctamente": "No se pudo cambiar el estatus intenta de nuevo";

        echo json_encode($data);

    }

    public function bajaLogica(){

        $id = $this->input->post("id");
        $rs = $this->Perfil_model->borradoLogico($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";

        echo json_encode($data);

    }

    public function getCard() {
        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);

        $rs = $this->Perfil_model->get_Card($data['idU']);
        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." tarjetas" : "No se encontraron tarjetas";
        $data["Fiscales"] = $rs;
        echo JSON_ENCODE($data); 
    }
 
}
?>
