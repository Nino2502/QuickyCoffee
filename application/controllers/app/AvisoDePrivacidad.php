<?php 

class AvisoDePrivacidad extends CI_Controller{

	private $idusuario;
    private $rol_id;
	private $idP;
	private $estatus;
	private $permiso_id;
	


    public function __construct(){

        parent::__construct();
		
		verifica_token();
		
		
		update_user_estatus($this->session->userdata('idusuario'));
		
		
        $this->load ->model('app/Aviso_De_Privacidad_model');
		
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
            $seccion_id = 60
        );
		
		if (!is_null($this->permiso_id)) {
		

        $data['_APP_TITLE']              = "Tipo de pago";        
        $data['_APP_VIEW_NAME']          = "Administracion";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 3, 60);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Formas de pago");
		
		
		$data['styles'][] = 'vendor/quill.snow';
		$data['styles'][] = 'vendor/quill.bubble';
		
		$data['scripts'][] = 'plantilla/js/vendor/quill.min';
		$data['scripts'][] = 'plantilla/js/vendor/ckeditor5-build-classic/ckeditor';
		$data['scripts'][] = 'plantilla/js/vendor/mousetrap.min';
			
		
		
        $data['scripts'][] = 'propiosScripts/AvisoDePrivacidad';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['modals'][]  = $this->load->view('private/fragments/AvisoDePrivacidad/modalAvisoDePrivacidad', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/AvisoDePrivacidad/AvisoDePrivacidad_view', $data, TRUE);

        $this->load->view("default",$data,FALSE);
			
	}else{
			redirect(base_url()."web");
	
		}
			
			

    }

    public function verAvisoDePrivacidad(){

           $rs = $this->Aviso_De_Privacidad_model->ver_Aviso_De_Privacidad();
           $data['resultado'] = $rs != null;
           $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." avisos de privacidad" : "no se econtraron avisos de privacidad";
           $data["AvisoDePrivacidad"] = $rs;
           echo JSON_ENCODE($data);

    }


    public function insertaAvisoDePrivacidad(){

        $idADP = $this->input->post("idADP");
		$datos = $this->input->post("datos");
		$accion = $this->input->post("accion");
		$estatus = $this->input->post("estatus");
		
		
		$fecha = date("Y-m-d");
		
		
		
        

          
			$datos = ["idADP"=> $idADP, "cuerpoAviso"=>$datos, "estatus"=> $estatus, "fechaCreacion"=>$fecha];
			
            $rs = $this->Aviso_De_Privacidad_model->inserta_Aviso_De_Privacidad($datos);
			
			
			$data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se inserto la categoria correctamente" : "No se inserto prueba nuevamente";
			
			echo json_encode($data);
			
	

        
            
        
        

    }


    public function cambioEstatus(){

        $id = $this->input->post("id");
        $rs = $this->Aviso_De_Privacidad_model->estatus_Aviso_De_Privacidad($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se cambio el estatus correctamente": "No se pudo cambiar el estatus intenta de nuevo";

        echo json_encode($data);

    }


    public function bajaLogica(){

        $id = $this->input->post("id");
        $rs = $this->Aviso_De_Privacidad_model->borradoLogico($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";

        echo json_encode($data);

    }







}//termina clase


?>