<?php 

class CVentas extends CI_Controller{


    private $rol_id;
	private $idP;


    public function __construct(){

        parent::__construct();
		
		verifica_token();
        $this->load ->model('daniw/CVentas_model');
        $this->rol_id = $this->session->userdata('idTipoUsuario');
		$this->idP = $this->session->userdata('idPerfilUsuario');
       
    }



    public function index(){

        $data['_APP_TITLE']              = "Historial ventas";        
        $data['_APP_VIEW_NAME']          = "Usuarios";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 8, 45);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Historial ventas"); 
        $data['scripts'][] = 'daniw/cVentas';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        
        $data['modals'][]  = $this->load->view('daniw/Clientes/modalDetalle', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('daniw/Clientes/Ventas_view', $data, TRUE); 

        $this->load->view("default",$data,FALSE);

    }

    public function getVentas($id) {
        //$id = $this->input->post('clienteId');
        $rs = $this->CVentas_model->get_Ventas($id);

        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." ventas" : "No se encontraron ventas";
        $data["Ventas"] = $rs;

        echo JSON_ENCODE($data);
    }

    public function verDetalle() {
        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);

        $rs = $this->CVentas_model->ver_Detalle($data['idVenta']);

        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." ventas" : "No se encontraron ventas";
        $data["Detalle"] = $rs;

        echo JSON_ENCODE($data);
    }
    
}
?>
