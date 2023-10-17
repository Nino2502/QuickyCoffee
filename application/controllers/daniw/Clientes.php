<?php 

class Clientes extends CI_Controller{

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

        $this->load ->model('daniw/Clientes_model');
        
       
    }



    public function index(){
		
		
			
		$this->permiso_id = get_permiso_modulo_seccion(
            $this->estatus,
            $this->rol_id,
			$this->idP,
            $modulo = 8,
            $seccion_id = 45
        );
		
		
		if (!is_null($this->permiso_id)) {

        $data['_APP_TITLE']              = "Clientessssss";        
        $data['_APP_VIEW_NAME']          = "Usuarios";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 8, 45);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Clientes"); 
        $data['scripts'][] = 'daniw/Clientes';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['_APP_FRAGMENT'] = $this->load->view('daniw/Clientes/Clientes_view', $data, TRUE);

        $this->load->view("default",$data,FALSE);
			
			
		 }else{
			redirect(base_url()."web");
	}	
			
			

    }

    public function getClientes() {

        $rs = $this->Clientes_model->get_Clientes();
        //Consulta de todos los usuarios clientes
		
		
		echo "<pre>";
		$query = $this->db->lact_query();
		var_dump($query);
		die();
		
		
		
		

        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." clientes" : "No se encontraron clientes";
        $data["Clientes"] = $rs;

        echo JSON_ENCODE($data);
		
		
		
		
		
		
        

        /*  
            Consulta de usuarios clientes con ventas
            $rs = $this->Clientes_model->get_Clientes_con_Ventas();

            if (!empty($rs)){
                $data['resultado'] = true;
                $data['mensaje'] = "Se encontraron ". count($rs)." clientes con ventas";
                $data["Clientes"] = $rs;
            } else {
                $data['resultado'] = false;
                $data['mensaje'] = "No se encontraron clientes con ventas";
                $data["Clientes"] = null;
            }

            echo JSON_ENCODE($data);
        */
    }

    public function getVentas() {
        $id = $this->input->post('idU');
        $rs = $this->Clientes_model->get_Ventas($id);

        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." ventas" : "No se encontraron ventas";
        $data["Clientes"] = $rs;

        echo JSON_ENCODE($data);
    }

    public function cambiaEstatus() {

        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        
        $rs = $this->Clientes_model->estatus_Cliente($data['idU']);

        $data["resultado"] = $rs != false;
        $data["mensaje"] = $data["resultado"] ? "Se cambio el estatus correctamente": "No se pudo cambiar el estatus intenta de nuevo";

        echo json_encode($data);

    }
    
}
?>
