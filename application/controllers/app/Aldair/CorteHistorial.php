<?php
class CorteHistorial extends CI_Controller{
    private $rol_id;
	private $idP;
    private $idUsuario;
    private $idTU;
  


    public  function __construct(){
        parent::__construct();

        verifica_token();
        $this->load->model('Aldair/Corte_model');
        $this->rol_id       = $this->session->userdata('idTipoUsuario');
		$this->idP          = $this->session->userdata('idPerfilUsuario');
        $this->idUsuario    = $this->session->userdata('idusuario');
        $this->idTU         = $this->session->userdata('idTipoUsuario');
      
       
    }
    public function index(){
        $data['_APP_TITLE']              = "Historial de corte de caja";        
        $data['_APP_VIEW_NAME']          = "Historial de corte de caja";   
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 1);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Historial de corte de caja");
        $data['scripts'][] = 'propiosScripts/Aldair/CorteHistorial';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';

        $data['scripts'][] = 'plantilla/js/dore-plugins/select.from.library';
        $data['scripts'][] = 'plantilla/js/vendor/select2.full';
        $data['scripts'][] = 'plantilla/js/vendor/bootstrap-datepicker';


        $data['styles'][] = 'vendor/select2.min';
        $data['styles'][] = 'vendor/select2-bootstrap.min';


        $data['modals'][]  = $this->load->view('private/fragments/CorteVenta/moda_Corte', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/CorteVenta/Corte_historial_view', $data, TRUE);
        $this->load->view("default",$data,FALSE);
    }



    public function showCortecaja(){
        $empleado = $this->idUsuario;
        
        $getVentaCorte = $this->Corte_model->getVentaCorte($empleado);
        
        $data["resultado"]          =  $getVentaCorte       != null ? true : false;
        $data["mensaje"]            =  $data["resultado"]   ? "Registro de corte de cajas disponibles"  : "¡No hay registros cortes de caja!";
        $data["RegistrosCortes"]    =  $getVentaCorte       != null ? $getVentaCorte : false;
        echo json_encode($data);
    }

    public function detalleCorte(){
        $empleado = $this->idUsuario;
        $idRC = $this->input->post('idRC');
     
        $getCortes = $this->Corte_model->getCortes($empleado, $idRC);

        $getCambios = $this->Corte_model->getCambios($empleado, $idRC);

        $data["Cambios"]            =  $getCambios       != null ? $getCambios : false;
        $data["resultado"]          =  $getCortes       != null ? true : false;
        $data["mensaje"]            =  $data["resultado"]   ? "Registros encontrados"  : "¡No hay registros cortes de caja!";
        $data["RegistrosCortes"]    =  $getCortes       != null ? $getCortes : false;
        echo json_encode($data);
    }



}
?>
