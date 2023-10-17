<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Report extends CI_Controller {



    private $id_usuario; 
    private $rol_id; 
    private $estatus_id;
    private $permiso_id;

    /**

     * [__construct description]

     */

    public function __construct()

    {

        parent::__construct();
        is_user_logged_in();

        $this->id_usuario = $this->session->userdata('id_usuario');
        $this->rol_id = $this->session->userdata('rol_id');
        update_user_estatus($this->id_usuario);
        $this->estatus_id = $this->session->userdata('estatus_id');

        $this->load->model('accounts_model');
		$this->load->model('servicios_model');
		$this->load->model('user_model');
		$this->load->model('reportes_model');


    }



    /**

     * [index description]

     * @return [type] [description] js/vendor/bootstrap-datepicker.js

     */

    public function index()

    {

      

       
        $data['styles'][]           = 'plantilla/js/vendor/component-custom-switch.min';
		$data['scripts'][]          = 'plantilla/js/vendor/bootstrap-datepicker';
		
        

		 //$data['scripts'][]          = 'vendor/jquery.mask.min'; 
		
		$data['_APP_TITLE']              = "Reporte General de Ventas";        
        $data['_APP_VIEW_NAME']          = "Finanzas";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 10, 29);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Reporte general de ventas");
        $data['scripts'][] = 'propiosScripts/listaReporte';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
		 $data['modals'][]  = $this->load->view('private/fragments/reporte/reporte_pago_m', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/reporte/reporteGeneral.php', $data, TRUE);

        $this->load->view("default",$data,FALSE);
		
		
		
		
		
		

    }


	
	//1 documentos
	//2 litigios
	//3 asesorias
	
	public function listaPago(){
		
		$idAbogado = $this->input->post("idAbogado");
		$idServicio = $this->input->post("idServicio");
		$idComision = $this->input->post("idComision");
		$PagoCliente = $this->input->post("PagoCliente");
		$fechaInicio =  $this->input->post("fechaInicio"); //'2022-09-1'; //
		$fechaFin =  $this->input->post("fechaFin"); //'2022-09-10';
		$estatusCaso = $this->input->post("estatusCaso");		
		$pagoLiberado = $this->input->post("estatusPago"); 
		$or = null;
		
		
		
		if($idAbogado == 0){
			$idAbogado = null;
		}
		$confirmacionAbogado = null;
		$confirmacionCliente = null;
		$estatusPago = null;
		$liberado = null;
		
		if($estatusCaso == 0){
			$confirmacionAbogado = null;
			$confirmacionCliente = null;
			
		
		}elseif($estatusCaso == 1){
			$confirmacionAbogado = "1";
			$confirmacionCliente = "1";
			
		}elseif($estatusCaso == 2){
			$confirmacionCliente = "1";
		}
		elseif($estatusCaso == 3){
			$confirmacionAbogado = "1";
		}
		elseif($estatusCaso == 4){
			$confirmacionAbogado = "0";
			$confirmacionCliente = "0";
			$or = "1";
		}
		
		
		if($PagoCliente == 1){
			$ePago = "PAGADO";
		}elseif($PagoCliente == 2){
			
			$ePago = "PENDIENTE";
		
		}elseif($PagoCliente == 3 ){
			
			$ePago = "CANCELADO";
		
		}elseif($PagoCliente == 0 ){
			
			$ePago = null;
		
		}
		

		if($pagoLiberado == 3){
			 $liberado="0";
		}elseif($pagoLiberado == 2){
			$liberado="1";

		}else{
			$liberado=null;

		}
	
		
		$data["documentos"] = null;
		$data["litigios"] = null;
		$data["asesorias"] = null;
		
		
		
		
		if($idServicio == 1){
			
			$data['documentos'] = $this->reportes_model->get_documentos_reporte($idAbogado, $fechaInicio, $fechaFin, $ePago, $liberado);
	
			
		}elseif ($idServicio == 2){
			
			$data['litigios']  = $this->reportes_model->get_litigios_reporte($idAbogado, $fechaInicio, $fechaFin, $confirmacionAbogado, $confirmacionCliente, $ePago, $liberado, $or);
			
		}elseif ($idServicio == 3){
			
			$data['asesorias']  = $this->reportes_model->get_asesorias_reporte($idAbogado, $fechaInicio, $fechaFin, $confirmacionAbogado, $confirmacionCliente, $ePago, $liberado, $or);
			
		}elseif ($idServicio == 0){
			
			$data['documentos'] = $this->reportes_model->get_documentos_reporte($idAbogado, $fechaInicio, $fechaFin, $ePago, $liberado);
			
			
/*			$query1 = $this-> db-> last_query();echo "<pre>";echo $query1;echo "</pre>";*/			
			
			$data['asesorias']  = $this->reportes_model->get_asesorias_reporte($idAbogado, $fechaInicio, $fechaFin, $confirmacionAbogado, $confirmacionCliente, $ePago, $liberado, $or);
			
			
			
/*			$query2 = $this-> db-> last_query();echo "<pre>";echo $query2;echo "</pre>";*/			
			
			
			
			$data['litigios']  = $this->reportes_model->get_litigios_reporte($idAbogado, $fechaInicio, $fechaFin, $confirmacionAbogado, $confirmacionCliente, $ePago, $liberado, $or);
			
/*			$query3 = $this-> db-> last_query();echo "<pre>";echo $query3;echo "</pre>";die();*/			
		}else{
			
			$data["documentos"]= null;
			$data["litigios"] = null;
			$data["asesorias"] = null;

		}
		
		
		
		
		
		$data['resultado'] = $data['documentos'] != null || $data["litigios"] != null || $data["asesorias"] != null;

		
		
		if($data['resultado']){
			
			/*$html = $this->load->view('app/private/fragments/modules/reporte/reporteLista',$data,true);
			 echo $html;*/
			
			echo json_encode($data);
			
			
			
		}else{
			
			echo json_encode([
                    'response_code' => 403,
                    'response_type' => 'error',
                    'message' => 'No se econtro ningun registro',
                ]);
			
			
		}
		
		
		
	}
	
	public function enviarPago(){
		
		$fechaReporte = date('y-m-d h:i:s');
		$idVenta = $this->input->post("idVenta");
		$referencia = $this->input->post("referencia");
		$hCostoSer = $this->input->post("hCostoSer");
		$hComisionSer = $this->input->post("hComisionSer");
		$hPagoSer = $this->input->post("hPagoSer");
		$hPorcentajeSer = $this->input->post("hPorcentajeSer");
		
	
		
		$dataInsertaReporte = [
			"fechaReporte"=>$fechaReporte,
			"idVenta"=>$idVenta,
			"referencia"=>$referencia,
			"costo"=>$hCostoSer,
			"porcentaje"=>$hPorcentajeSer,
			"pago"=>$hPagoSer,
			"comisionCobrada"=>$hComisionSer,
		];
		
		
	
		
		$dataActualiza =["liberado"=>1];
		
		
		$insertaReporte = $this->reportes_model->guardarReportePago($dataInsertaReporte);
		$actualizaPagos = $this->reportes_model->actualizaEstatusPago($dataActualiza, $idVenta);
		
		
	
		
		
		if($insertaReporte == true && $actualizaPagos == true ){
			
			echo json_encode([
					'respuesta'=> true,
                    'response_code' => 200,
                    'response_type' => 'success',
                    'message' => 'Se almaceno el reporte y actualizo el estus correctamente',
                ]);
			
			
		}elseif($insertaReporte == null && $actualizaPagos == null ){
			echo json_encode([
					'respuesta'=> false,
                    'response_code' => 403,
                    'response_type' => 'error',
                    'message' => 'No se almaceno el reporte ni se actualizo el estatus intenta de nuevo',
                ]);
			
		}elseif($insertaReporte == null ){
			echo json_encode([
					'respuesta'=> false,
                    'response_code' => 403,
                    'response_type' => 'error',
                    'message' => 'No se almaceno el reporte intenta de nuevo',
                ]);
		}elseif($actualizaPagos == null ){
			echo json_encode([
					'respuesta'=> false,
                    'response_code' => 403,
                    'response_type' => 'error',
                    'message' => 'No se actualizo el estatus intenta de nuevo',
                ]);
		}
		
			
			
		
		
		
		
		
		
	}
	
	
	public function ver_reportes(){
		
		
		$rs = $this->reportes_model->verReportes();
		
		
		if($rs != null){
			$conteo = count($rs);
			echo json_encode([
					'respuesta'=> true,
                    'response_code' => 200,
                    'response_type' => 'success',
					'reportes' => $rs,
                    'message' => 'se econtraron ' . $conteo . ' reportes',
                ]);
			
			
		}else{
			echo json_encode([
					'respuesta'=> false,
                    'response_code' => 403,
                    'response_type' => 'warning',
                    'message' => 'No hay reportes para mostrar',
                ]);
			
		}
		
		
	}
	
	
	
	

} // termina clase report







/* End of file Myaccount.php */

/* Location: ./application/controllers/app/Myaccount.php */

