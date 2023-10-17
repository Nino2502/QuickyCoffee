<?php
class Corte extends CI_Controller{
    
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
       
   

        $this->load->model('Aldair/Corte_model');
       
    }
    public function index(){
		
		
		$this->permiso_id = get_permiso_modulo_seccion(
            $this->estatus,
            $this->rol_id,
			$this->idP,
            $modulo = 12,
            $seccion_id = 50
        );
		
		
		if (!is_null($this->permiso_id)) {
		
		
		
        $data['_APP_TITLE']              = "Corte de caja";        
        $data['_APP_VIEW_NAME']          = "Corte de caja";   
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 12, 50);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Corte de caja");
        $data['scripts'][] = 'propiosScripts/Aldair/Corte';
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
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/CorteVenta/Corte_view', $data, TRUE);
        $this->load->view("default",$data,FALSE);
			
			
		 }else{
			redirect(base_url()."web");
		}
			
			
    }

    public function consultarCorteCaja(){
        $empleado = $this->idusuario;
        $fecha = $this->input->post("fechaConsulta");

            $checkCorte = $this->Corte_model->checkCorte($empleado, $fecha);
            $fechaActual = date("Y-m-d H:i:s");

            $mensaje =  $checkCorte != NULL ? "Ultimo corte de caja realizado: " .$checkCorte->fechaCorteReali.".  No hay ventas registradas en este momento: ".$fechaActual : "No hay ventas registradas en esta caja: " .$fecha."";
       
            $RS                    = $this->Corte_model->corteCaja($empleado, $fecha);
            $data["resultado"]     = $RS->total_venta_caja != null &&  $empleado != null ? true : false;
            $data["mensaje"]       = $data["resultado"] ? "Corte de caja disponible: " .$fechaActual. "" : $mensaje;
            $data["TotalCorte"]    =   $RS->total_venta_caja  != null ? $RS : false;
           
        
        echo json_encode($data);
     
    }

    public function CajaActual(){
        $empleado = $this->idusuario;

        $RS                    = $this->Corte_model->getUsuario($empleado);
        $data["resultado"]     = $RS != null ? true : false;
        $data["mensaje"]       = $data["resultado"] ? "CAJA encontrada": "CAJA no encontrada";
        $data["TotalCorte"]    =   $RS != null ? $RS : false;
        echo json_encode($data);
    }
    
    public function registroCaja(){
        $empleado           = $this->idusuario;
        $corteCaja          = $this->input->post("TotalCAJA");
        $corteSistema       = $this->input->post("TotalCorte");
        $fechaCorteCons     = $this->input->post("fechaCorteCons");
        $fechaCorteReali    = $this->input->post("fechaCorteReali");
        $diferencia         = $corteSistema - $corteCaja;

        $arr = array (
            'idEmpleado' => $empleado,
            'TotalCAJA' => $corteCaja,
            'TotalCorte' => $corteSistema,
            'FechaCorteCons' => $fechaCorteCons,
            'FechaCorteReali' => date('Y-m-d H:i:s'),
            'Diferencia' => $diferencia
        );
       
        
           
                // if($checkCorte != null){
                //     $data["resultado"]     = false;
                //     $data["mensaje"]       = "Ya se realizo un corte de caja para este dia, verifique en el historial de cortes";
                    
                
                // }else{

                    $RS  = $this->Corte_model->registrarCorte($arr);
                    $data["resultado"]     = $RS != null ? true : false;
                    $data["mensaje"]       = $data["resultado"] ? "Corte de caja registrado exitosamente" : "No se pudo registrar el corte de caja";
                    $data["TotalCorte"]    =   $RS != null ? $RS : false;

                    if (  $data["resultado"] == true ){
                        
                        $R = array('idRC' => $RS);
                        
                        $UpdateVentas  = $this->Corte_model->UpdateVentasCorte($empleado, $R);
                    
                        
                        $data["resultadoUpdate"]     = $UpdateVentas != null ? true : false;
                        $data["mensajeUpdate"]       = $data["resultadoUpdate"] ? "Registros actualizados correctamente" : "ERROR en actualizar las ventas";
                        $data["TotalCorteUpdate"]    =   $RS != null ? $RS : false;

                    }

                

        
            echo json_encode($data);

        }
 


}
?>
