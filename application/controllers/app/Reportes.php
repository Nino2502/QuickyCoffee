<?php 
require FCPATH.'vendor/autoload.php';

class Reportes extends CI_Controller{

	private $idusuario;
    private $rol_id;
	private $idP;
	private $idSuc;
	private $estatus;
	private $permiso_id;


    public function __construct(){

        parent::__construct();
		
		verifica_token();
		
		
		update_user_estatus($this->session->userdata('idusuario'));
		
		
        $this->load ->model('app/Reportes_model');
		$this->load->model('app/Usuarios_model');
		 $this->load->model('app/Sucursales_model');
		 $this->load ->model('app/Tipo_de_pago_model');
		$this->load ->model('app/Tipos_De_Gastos_model');
		
		$this->idusuario = $this->session->userdata('idusuario');
        $this->rol_id = $this->session->userdata('idTipoUsuario');
		$this->idP = $this->session->userdata('idPerfilUsuario');
		$this->idSuc        = $this->session->userdata('sucursal');
		$this->idP = $this->session->userdata('idPerfilUsuario');
		$this->estatus = $this->session->userdata('estatus');
       
    }
	
	

    public function index(){
		
						
		$this->permiso_id = get_permiso_modulo_seccion(
            $this->estatus,
            $this->rol_id,
			$this->idP,
            $modulo = 9,
            $seccion_id = 53
        );
		
		
		if (!is_null($this->permiso_id)) {
		
		
		$data['usuariosCaja'] = $this->Usuarios_model->ver_lista_colaboradores_caja();
		$data['clientes'] = $this->Usuarios_model->ver_lista_clientes();
		$data['sucursales'] = $this->Sucursales_model->ver_Sucursales();
		$data['tiposDeGasto'] = $this->Tipos_De_Gastos_model->ver_Tipos_De_Gastos();
		$data['tiposDePagos']  = $this->Tipo_de_pago_model->ver_tipo_de_pago();
		

        $data['_APP_TITLE']              = "Reportes de Ventas";        
        $data['_APP_VIEW_NAME']          = "Reportes de Ventas";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 9, 53);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Reportes de Ventas");
		
		
		$data['styles'][]           = 'vendor/component-custom-switch.min';
		$data['scripts'][]          = 'plantilla/js/vendor/bootstrap-datepicker';
		
		$data['styles'][] = 'vendor/select2.min';
        $data['styles'][] = 'vendor/select2-bootstrap.min';
        $data['scripts'][] = 'plantilla/js/dore-plugins/select.from.library';
        $data['scripts'][] = 'plantilla/js/vendor/select2.full';      
        $data['scripts'][] = 'plantilla/js/vendor/bootstrap-tagsinput.min';		
		
        $data['scripts'][] = 'propiosScripts/Reportes';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/exportaTablaexcel';
		
		$data['scriptsExternos'][] = 'https://unpkg.com/xlsx@0.16.9/dist/xlsx.full.min.js';
		$data['scriptsExternos'][] = 'https://unpkg.com/file-saverjs@latest/FileSaver.min.js';
		$data['scriptsExternos'][] = 'https://unpkg.com/tableexport@latest/dist/js/tableexport.min.js';
		
		
		
		
		
		
		$data['modals'][]  = $this->load->view('daniw/Clientes/modalDetalle', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/Reportes/Reportes_view.php', $data, TRUE);

        $this->load->view("default",$data,FALSE);
		
		
					
		}else{
			redirect(base_url()."web");
		}

    }


   public function listaPago(){
	   
	   	$selectSucursal = $this->input->post("selectSucursal");	   
		$selectCaja = $this->input->post("selectCaja");
		$selectFactura = $this->input->post("selectFactura");
		$fechaInicio = $this->input->post("fechaInicio");
		$fechaFin = $this->input->post("fechaFin");
	   	$selectClientes = $this->input->post("selectClientes");
		$selectTipoDePago = $this->input->post("selectTipoDePago");
	   
	 /*  echo("<pre>");
	   var_dump($selectCaja, $selectFactura, $fechaInicio, $fechaFin );*/

	   if($selectSucursal == 0){
		   $selectSucursal = null;
	   }
	   if($selectCaja == "0"){
			$selectCaja = null;
		}
	   if($selectFactura == "0"){
			$selectFactura = null;
		}
	   
	    if($selectClientes == "todos"){
			$selectClientes = null;
		}
	   
	   
	   if($fechaInicio == ""){
			$fechaInicio = null;
		}
	   if($fechaFin == ""){
			$fechaFin = null;
		}
	   
	   if($selectTipoDePago == "todos"){
			$selectTipoDePago = null;
		}
		
	   
	  /* echo("<pre>");
	   var_dump($selectCaja, $selectFactura, $fechaInicio, $fechaFin );
	   die();*/
			
		   $rs = $this->Reportes_model->reporte_de_ventas($selectSucursal, $selectCaja, $selectFactura, $selectClientes,$selectTipoDePago, $fechaInicio, $fechaFin);

	   //echo "<pre>" . $selectFactura;
	    //echo  $this->db->last_query();
	   //die();
	   
		   $data['resultado'] = $rs != null;
           $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." ventas" : "no se econtraron ventas";
           $data["ventas"] = $rs;
           echo JSON_ENCODE($data);
	
	}
	
	
		
		public function listaGastos(){
	   
		$selectTipoDeGasto = $this->input->post("selectTipoDeGasto");
		$selectSucursal = $this->input->post("selectSucursal");

		
		$fechaInicio2 = $this->input->post("fechaInicio2");
		$fechaFin2 = $this->input->post("fechaFin2");
	  
	   
	 /*  echo("<pre>");
	   var_dump($selectCaja, $selectFactura, $fechaInicio, $fechaFin );*/

	   if($selectTipoDeGasto == "0"){
			$selectTipoDeGasto = null;
		}
	 
		 if($selectSucursal == "0"){
			$selectSucursal = null;
		}	
	   
	   
	   if($fechaInicio2 == ""){
			$fechaInicio2 = null;
		}
	   if($fechaFin2 == ""){
			$fechaFin2 = null;
		}
		
	   
	  /* echo("<pre>");
	   var_dump($selectCaja, $selectFactura, $fechaInicio, $fechaFin );
	   die();*/
			
		   $rs = $this->Reportes_model->reporte_de_gastos($selectTipoDeGasto, $selectSucursal, $fechaInicio2, $fechaFin2);
		
	   //echo "<pre>" . $selectFactura;
	    //echo  $this->db->last_query();
	   //die();
	   
		   $data['resultado'] = $rs != null;
           $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." ventas" : "no se econtraron gastos registrados";
           $data["gastos"] = $rs;
           echo JSON_ENCODE($data);
	
	}
	
	
	public function listaCajasSucursal(){
		
		
		$idSucursal = $this->input->post("idSucursal");
		$rs = $this->Sucursales_model->ver_lista_cajas_sucursal($idSucursal);
		
		
		//echo  "<pre>" ;
		//echo  $idSucursal ;
		//var_dump($this->db->last_query());
		//$die();
		

	   $data['resultado'] = $rs != null;
	   $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." cajas" : "no se econtraron cajas en esta sucursal";
	   $data["cajas"] = $rs;
	   echo JSON_ENCODE($data);

		
		
		
		
	}
	
	
	public function ventasVSgastos(){
			
		
		$selectSucursal = $this->input->post("selectSucursal");	   
		$selectFactura = $this->input->post("selectFactura");
		$fechaInicio = $this->input->post("fechaInicio");
		$fechaFin = $this->input->post("fechaFin");
		
		
		if($selectSucursal == 0){
		   $selectSucursal = null;
	   }
	  
	   if($selectFactura == "0"){
			$selectFactura = null;
		}
	   
	   if($fechaInicio == ""){
			$fechaInicio = null;
		}
	   if($fechaFin == ""){
			$fechaFin = null;
		}
	   
	   
		
		$rsVentas = $this->Reportes_model->ventasVS($selectSucursal,$selectFactura,$fechaInicio,$fechaFin);
		
		$rsGastos = $this->Reportes_model->gastosVS($selectSucursal, $fechaInicio, $fechaFin);
		
	   $data['resultado'] = $rsVentas != null || $rsGastos != null;
	   $data['mensaje'] = $data['resultado'] ? "si hay ventas o gastos" : "no se econtraron gastos registrados";
	   $data["gastosVS"] = $rsGastos;
	   $data["ventasVS"] = $rsVentas;
	   echo JSON_ENCODE($data);

		
		
		
	}
	
	
	// public function pdf() {
	// 	$json = file_get_contents('php://input');
    //     $data = (array)json_decode($json);
	// 	// var_dump($data);
	// 	// die();
	// 	$idSuc = $this->idSuc;
	// 	$rs2 = $this->Reportes_model->get_Sucursal($idSuc);
	// 	$data2["nombreSucursal"] = $rs2->nombreSuc;
		
	// 	$data['resultado'] = $data != null;
	//    	$data['mensaje'] = $data['resultado'] ? "PDF generado" : "Error al cargar PDF";


	// 	$mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
	// 	$html = $this->load->view('private/fragments/Reportes/PDF_view', $data + $data2, true);
	// 	$mpdf->WriteHTML($html);
	// 	$mpdf->Output('Reporte.pdf', 'I');
    // }

	public function pdf() {
		$json = file_get_contents('php://input');
		$data = (array)json_decode($json);
	  
		$idSuc = $this->idSuc;
		$rs2 = $this->Reportes_model->get_Sucursal($idSuc);
		$data2["nombreSucursal"] = $rs2->nombreSuc;
	  
		$response['resultado'] = !empty($data);
		$response['mensaje'] = $response['resultado'] ? "PDF generado" : "Error al cargar PDF";
	  
		if ($response['resultado']) {
		  $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
		  $html = $this->load->view('private/fragments/Reportes/PDF_view', $data + $data2, true);
		  $mpdf->WriteHTML($html);
		  $mpdf->Output('Reporte.pdf', 'I');
		  $response['path'] = 'Reporte.pdf';
		}
	  
		echo json_encode($response);
	  }
	
	
	
}//termina clase


?>