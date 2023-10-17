<?php 

class Password extends CI_Controller{


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
       
   
        $this->load ->model('daniw/Password_model');
        
    }



    public function index(){
		
		
		$this->permiso_id = get_permiso_modulo_seccion(
            $this->estatus,
            $this->rol_id,
			$this->idP,
            $modulo = 3,
            $seccion_id = 59
        );
		
		
		if (!is_null($this->permiso_id)) {
		
		
		

        $data['_APP_TITLE']              = "Perfil";        
        $data['_APP_VIEW_NAME']          = "Perfil";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 3, 59);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Contraseña privada");
        $data['scripts'][] = 'daniw/Password';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['modals'][]  = $this->load->view('daniw/Password/modalPassword', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('daniw/Password/Password_view', $data, TRUE);

        $this->load->view("default",$data,FALSE);
			
			
		 }else{
			redirect(base_url()."web");
	}
	
			
			
			

    }

    public function getPass(){
        $Usuario = $this->idusuario;
       
        $rs = $this->Password_model->get_Pass($Usuario);

        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Cantraseña encontrada" : "Debes dar de alta una contraseña en el sistema";

        echo JSON_ENCODE($data);
    }
   
    public function insertPassAcc(){
        $Usuario    = $this->idusuario;
        $pass       =   $this->input->post('ClaveAcceso');
        $data = array(
            'idEmpleado'  => $Usuario,
            'ClaveAcceso' => md5($pass) 
        );
        
           
        $rs = $this->Password_model->insert_PassAcc($data);

        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se actualizo la contraseña!" : "ERROR en actualizar";
        echo JSON_ENCODE($data);
    }

    public function updatePassAcc(){
        $Usuario    = $this->idusuario;
        $pass1      = md5($this->input->post('ClaveVal'));
        $pass2      = md5($this->input->post('ClaveAcceso'));
        $validaContra = $this->Password_model->valida_Contra($Usuario, $pass1);
        // var_dump($validaContra); 
        // die();

        if($validaContra != null){

            $rs = $this->Password_model->update_PassAcc($Usuario, $pass2);

            if ($rs != null) {
                $data['resultado'] = true;
                $data['mensaje'] = "Se actualizo la contraseña!";
            } else {
                $data['resultado'] = false;
                $data['mensaje'] = "Error en actualizar la contraseña";
            }
        } else {
            $data['resultado'] = false;
            $data['mensaje'] = "Contraseña invalida";
        }
        
        echo json_encode($data);
    }

}//termina clase


?>