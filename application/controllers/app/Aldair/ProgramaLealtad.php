<?php
class ProgramaLealtad extends CI_Controller{
    
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
       
        $this->load->model('Aldair/CronJob_model');

        $this->load->model('Aldair/ProgramaLealtad_model');
       
    }

    public function index(){
		$this->permiso_id = get_permiso_modulo_seccion(
            $this->estatus,
            $this->rol_id,
			$this->idP,
            $modulo = 14,
            $seccion_id = 68
        );
		if (!is_null($this->permiso_id)) {
            $data['_APP_TITLE']              = "Gestión de puntos";        
            $data['_APP_VIEW_NAME']          = "Gestión de puntos";   
            $data['_APP_MENU']               = get_role_menu($this->rol_id, 12, 50);// menu lateral
            //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
            $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
            $data['_APP_BREADCRUMBS']        = array("Programa de lealtad");
            
            $data['scripts'][] = 'propiosScripts/Aldair/ProgramaLealtad';

            $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
            $data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
            $data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
            $data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';

            $data['scripts'][] = 'plantilla/js/dore-plugins/select.from.library';
            $data['scripts'][] = 'plantilla/js/vendor/select2.full';
            $data['scripts'][] = 'plantilla/js/vendor/bootstrap-datepicker';


            $data['styles'][] = 'vendor/select2.min';
            $data['styles'][] = 'vendor/select2-bootstrap.min';

            $data['modals'][]  = $this->load->view('private/fragments/programaLealtad/modal_programaLealtad', $data, TRUE);
            $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/programaLealtad/programaLealtad_view', $data, TRUE);
            $this->load->view("default",$data,FALSE);


		}else{
			redirect(base_url()."web");
		}
			
			
    }

    public function getProgramas(){

        $programas = $this->ProgramaLealtad_model->getProgramas();

       $data["programas"] = $programas != null ? $programas : null;
       $data["resultado"]   = $data["programas"] != null ? true : false;
       $data["mensaje"]   = $data["resultado"] != null ? "Se encontraron registros" : "No se encontraron registros";
       echo json_encode($data);


    }

    public function registrarPrograma(){
        $nombreControl          = $this->input->post('nombrePrograma');
        $valorControl           = $this->input->post('valorPunto');
        $porcentajeControl      = $this->input->post('porcentajePrograma');
        $fechaInicioControl     = $this->input->post('dateStart');
        $fechaFinControl        = $this->input->post('dateEnd');
        $restrinccionControl    = $this->input->post('restrinccion');

        $datosControl = array(
            'nombreControl'     => $nombreControl,
            'valor'             => $valorControl,
            'porcentaje'        => $porcentajeControl,
            'fecha_inicio'      => $fechaInicioControl == "" ? null : $fechaInicioControl,
            'fecha_fin'         => $fechaFinControl    == "" ? null : $fechaFinControl,
            'estatus'           => 0,
            'restrinccion'       => $restrinccionControl == 1 ? 1 : 0
        );

        if($restrinccionControl){
            $consultaFecha = $this->ProgramaLealtad_model->verificaFecha($fechaInicioControl, $fechaFinControl);

            if ($consultaFecha['estatus'] === true) {
                $insertarP = $this->ProgramaLealtad_model->insertarPrograma($datosControl);
                $data["mensaje"] = $insertarP != null ? "Se registró correctamente el programa" : "No se registró correctamente programa, intente más tarde";
                $data["resultado"]   = true;
            } else {
                $data["mensaje"] = "No se puede registrar el programa, ya que existe un programa activo o preparado para en esas fechas seleccionadas: " . $consultaFecha['registro']->nombreControl;
                $data["resultado"]   = true;
            }
            
        }else{
            $insertarP = $this->ProgramaLealtad_model->insertarPrograma($datosControl);
        }
     
        
       
  

       $data["resultado"]   = $insertarP != null ? true : false;
       $data["mensaje"]     = $insertarP != null ? "Se registró correctamente" : "No se registró correctamente";
       echo json_encode($data);
    }

    public function programaActual(){


        $rs = $this->ProgramaLealtad_model->programaActual();
        $data["programa"] =  $rs != null ?  $rs : null;
        $data["estatus"]  =  $rs != null ? true : false; 
        $data["mensaje"] = $data["estatus"] != false ? "Programa disponible" : "No hay programa disponible";
        echo json_encode($data);

    }


    public function obtenerPuntos(){
        
        $cliente  = $this->input->post('cliente');

     

        if($cliente != 0){

        
            $rs = $this->ProgramaLealtad_model->programaPuntoscliente($cliente);

            $data["puntosCliente"] = $rs != null ? $rs : null;
            $data["estatus"]       = $data["puntosCliente"]  != null ? true : false;
            $data["mensaje"]       = $rs != null ? "Cliente con puntos disponibles" : "sin puntos disponibles";
            $data["user"] = $cliente;

        }else{
            $data["estatus"] = false;
            $data["mensaje"] = "Cuenta publica no genera puntos";
            $data["puntosCliente"] = null;
            $data["user"] = $cliente;
        }

        echo json_encode($data);

    }
    public function habilitarPrograma() {
        $idControl = $this->input->post('idControl');
        $principal = 20;

        $this->db->trans_begin(); // Iniciar transacción

        try {
            // Desactivar todos los programas (estatus 0)
            $this->ProgramaLealtad_model->desactivarTodosLosProgramas();

            // Activar el nuevo programa cambiando su estatus a 1
            if($idControl != $principal){
              
                $this->ProgramaLealtad_model->actualizarPrograma(array(
                    'idControl' => $idControl,
                    'estatus' => 1
                ));
                $mensaje = "Programa activado";
            }
            // Si el programa activado es el programa principal, cambiamos su estatus a 1
            else if ($idControl == $principal) {

                $this->ProgramaLealtad_model->actualizarPrograma(array(
                    'idControl' => $principal,
                    'estatus' => 1
                ));

                $mensaje = "Programa principal activado";
            }

            // Finalizar la transacción si todo fue exitoso
            $this->db->trans_commit();

            $data["resultado"] = true;
            $data["mensaje"] = $mensaje;
        } catch (Exception $e) {
            // Si algo falla, deshacer la transacción
            $this->db->trans_rollback();

            $data["resultado"] = false;
            $data["mensaje"] = "Error al habilitar el programa";
        }

        echo json_encode($data);
    }
    public function consultarPrograma(){
        $idPrograma = $this->input->post('idPrograma');
        $rs = $this->ProgramaLealtad_model->getPrograma($idPrograma);
        echo json_encode($rs);
   
    }
    public function updatePrograma(){
        $idControl     = $this->input->post('idControl');
        $nombreControl = $this->input->post('nombrePrograma');
        $valor         = $this->input->post('valorPunto');
        $porcentaje    = $this->input->post('porcentajePrograma');
        $fecha_inicio  = $this->input->post('dateStart');
        $fecha_fin     = $this->input->post('dateEnd');
        $restrinccion  = $this->input->post('restrinccion');

        $data = array(
            'idControl'     => $idControl, 
            'nombreControl' => $nombreControl,
            'valor'         => $valor,
            'porcentaje'    => $porcentaje,
            'fecha_inicio'  => $fecha_inicio,
            'fecha_fin'     => $fecha_fin,
            'restrinccion'  => $restrinccion == 1 ? 1 : 0
        );

      
     
        $rs = $this->ProgramaLealtad_model->updatePrograma($data);
        $data["resultado"] = $rs != false ? true : false;
        $data["mensaje"]   = $rs != null ? "Se actualizó correctamente" : "No se actualizó correctamente";
        echo json_encode($data);
    }

    public function obtenerProgramaProgramado() {
        $programas = $this->ProgramaLealtad_model->obtenerProgramaProgramado();

        // echo json_encode($programas);
        // die();
        $this->CronJob_model->insert_event(
            array('fecha_exec' => date('Y-m-d H:i:s'))
        );

        
        if ($programas != false) {
            if($programas->estatus == 0){
                $rs = $this->ProgramaLealtad_model->desactivarTodosProgramas();
                if($rs){
                    $idPrograma = $programas->idControl;
                    $this->ProgramaLealtad_model->actualizarProgramaCron($idPrograma);
                    echo "programa actualizado";
                }else{
                    echo "No se pudo desactivar los programas";
                }
               
            }else if($programas->estatus == 1){
                echo "programa activo es: $programas->nombreControl";
            }
            else{
                echo "el programa tiene estatus 3, activando programa principal";
                $idPrograma = 20;
                $this->ProgramaLealtad_model->actualizarProgramaCron($idPrograma);
            }

        } 
        else {            
                $rs = $this->ProgramaLealtad_model->desactivarTodosProgramas();
           
                $idPrograma = 20;
                $this->ProgramaLealtad_model->actualizarProgramaCron($idPrograma);
                echo "programa principal activo";
            
        }
    }

    public function borrarPrograma(){
        $idControl = $this->input->post('idControl');
        $rs = $this->ProgramaLealtad_model->borrarPrograma($idControl);
        $data["resultado"] = $rs != false ? true : false;
        $data["mensaje"]   = $rs != false ? "Se eliminó correctamente" : "Hubo un error al eliminar el programa, intentelo más tarde";

        echo json_encode($data);
    }

}
?>
