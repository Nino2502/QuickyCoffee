<?php 

class HistoricoInventario extends CI_Controller{


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
       
    

        $this->load ->model('app/Historico_Inventario_model');
       
       
    }



    public function index(){
		
		
		
		$this->permiso_id = get_permiso_modulo_seccion(
            $this->estatus,
            $this->rol_id,
			$this->idP,
            $modulo = 10,
            $seccion_id = 29
        );
		
		
		if (!is_null($this->permiso_id)) {
		
		
		
		
		

        $data['_APP_TITLE']              = "Historico Inventario";        
        $data['_APP_VIEW_NAME']          = "Inevntario";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 10, 29);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Historico Inventario");
        $data['scripts'][] = 'propiosScripts/HistoricoInventario';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/HistoricoInventario/HistoricoInventario_view.php', $data, TRUE);

        $this->load->view("default",$data,FALSE);
			
	}else{
			redirect(base_url()."web");
	}		
			
			

    }

    public function verHistoricoInventario(){

           $rs = $this->Historico_Inventario_model->ver_HistoricoInventario();
           $data['resultado'] = $rs != null;
           $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." filas del Historico" : "no se econtro Historico";
           $data["Historico"] = $rs;
           echo JSON_ENCODE($data);

    }


    










}//termina clase


?>