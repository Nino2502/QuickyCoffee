<?php
class Ventas extends CI_Controller{
    private $rol_id;
	private $idP;
    private $idUsuario;
    private $idTU;
	
	private $idusuario;
    //private $rol_id;

	//private $idP;
	
	private $idSuc;
	private $estatus;
	private $permiso_id;
  


    public  function __construct(){
        parent::__construct();

        verifica_token();
        $this->load->model('Aldair/Historialventas_model');
		
		$this->idusuario = $this->session->userdata('idusuario');
        $this->rol_id       = $this->session->userdata('idTipoUsuario');
		$this->idP          = $this->session->userdata('idPerfilUsuario');
        $this->idUsuario    = $this->session->userdata('idusuario');
        $this->idTU         = $this->session->userdata('idTipoUsuario');
		
		
		$this->idP = $this->session->userdata('idPerfilUsuario');
		
		$this->idSuc        = $this->session->userdata('sucursal');
		//$this->idP = $this->session->userdata('idPerfilUsuario');
		$this->estatus = $this->session->userdata('estatus');
		
		
      
       
    }
    public function index(){
		
		$this->permiso_id = get_permiso_modulo_seccion(
            $this->estatus,
            $this->rol_id,
			$this->idP,
            $modulo =7,
            $seccion_id = 55
        );
		
		
		if (!is_null($this->permiso_id)) {
			
			
        $data['_APP_TITLE']              = "Historial ventas";        
        $data['_APP_VIEW_NAME']          = "Historial ventas";   
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 7, 55);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Historial ventas");
        $data['scripts'][] = 'propiosScripts/Aldair/HistorialVM';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';

        $data['scripts'][] = 'plantilla/js/dore-plugins/select.from.library';
        $data['scripts'][] = 'plantilla/js/vendor/select2.full';
        $data['scripts'][] = 'plantilla/js/vendor/bootstrap-datepicker';


        $data['styles'][] = 'vendor/select2.min';
        $data['styles'][] = 'vendor/select2-bootstrap.min';


        $data['modals'][]  = $this->load->view('private/fragments/Ventas/Historialventas_modal', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/Ventas/Historialventas_view', $data, TRUE);
        $this->load->view("default",$data,FALSE);
		
		}else{
			redirect(base_url()."web");
		}
		
		
    }

    public function getVentas(){
            $caja = $this->idUsuario;
            $fecha = $this->input->post("FechaVentaG");

            $checkCorte = $this->Historialventas_model->getHistorial($caja, $fecha);
           
         
           
            

            $data["resultado"]     =   $checkCorte != null &&  $caja != null ? true : false;
            $data["mensaje"]       =   $data["resultado"] ? "Ventas encontradas " : "No hay ventas registradas";
            $data["HistorialVM"]    =   $checkCorte != null ? $checkCorte : false;
        
        
        echo json_encode($data);
     
    }
    public function getDetalle(){
        $idVenta = $this->input->post("idVenta");
        $detalle = $this->Historialventas_model->getVentas($idVenta);
        $data["resultado"]     =   $detalle != null ? true : false;
        $data["mensaje"]       =   $data["resultado"] ? "Detalle ventas encontrados " : "No hay detalle ventas registrados";
        $data["DetalleVentas"]    =   $detalle != null ? $detalle : false;
        echo json_encode($data);
    }
    public function getCliente(){
        $idVenta = $this->input->post("idVenta");
        
        $cliente = $this->Historialventas_model->getCliente($idVenta);
        $data["resultado"]     =   $cliente != null ? true : false;
        $data["mensaje"]       =   $data["resultado"] ? "Cliente encontrado " : "No hay cliente registrado";
        $data["Cliente"]    =   $cliente != null ? $cliente : false;
        echo json_encode($data);
    }


}
?>
