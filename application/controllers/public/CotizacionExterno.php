<?php
class cotizacionExterno extends CI_Controller{
    private $rol_id;
	private $idP;
    private $idUsuario;
    private $idTU;
    private $idSuc;



    public  function __construct(){
        parent::__construct();

    
        $this->load->model('Aldair/Cotizaciones_model');
        $this->rol_id       = $this->session->userdata('idTipoUsuario');
		$this->idP          = $this->session->userdata('idPerfilUsuario');
        $this->idUsuario    = $this->session->userdata('idusuario');
        $this->idTU         = $this->session->userdata('idTipoUsuario');
        $this->idSuc        = $this->session->userdata('sucursal');
    
       
    }
    public function index(){
        $data['_APP_TITLE']              = "Cotizaciones";        
        $data['_APP_VIEW_NAME']          = "Cotizaciones";   
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 1);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Cotizaciones");
        
        $data['scripts'][] = 'propiosScripts/Aldair/HistorialCotizacion';
        $data['scripts'][] = 'propiosScripts/Aldair/cotizacion';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';

        $data['scripts'][] = 'plantilla/js/dore-plugins/select.from.library';
        $data['scripts'][] = 'plantilla/js/vendor/select2.full';
        $data['scripts'][] = 'plantilla/js/vendor/bootstrap-datepicker';

        $data['styles'][] = 'vendor/select2.min';
        $data['styles'][] = 'vendor/select2-bootstrap.min';


        $data['modals'][]  = $this->load->view('private/fragments/cotizacion/modalcotizacion', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/cotizacion/cotizacion_view', $data, TRUE);
        $this->load->view("default",$data,FALSE);
    }
  
 

    public function detalleCotizacion(){
        $idCotizacion = $this->input->post("idCotizacion");

        $rs = $this->Cotizaciones_model->detalleCotizacion($idCotizacion);

        $usuario = $rs-> idCliente;
        $dataCliente = null;

            if($usuario != 0){
                $dataCliente = $this->Cotizaciones_model->verCliente($usuario);
            }
        
        
        $data["resultado"] = $rs != null ? true : false;
        $data["mensaje"] = $data["resultado"] ? "¡Detalle cotizacion encontrada!" : "¡No hay detalle cotizaciones registradas!";
        $data["detalleCotizacion"] = $rs != null ? $rs : false;
        $data["Usuario"] =  $dataCliente  == null ? "Publico General" : $dataCliente;

        echo json_encode($data);
    }



    public function Print_cotizacion($idCotizacion){   
        date_default_timezone_set('America/Mexico_City');
        $fecha_actual = date("d-m-Y h:i:s");


       // $NombreSuc = $this->Cotizaciones_model->verSucursal($this->idSuc);

        //reporte venta
        $rs = $this->Cotizaciones_model->detalleCotizacion($idCotizacion);
        $usuario = $rs->idCliente;
        $dataCliente = null;

        if ($usuario != 0) {
            $dataCliente = $this->Cotizaciones_model->verCliente($usuario);
        }

        $Servicios = json_decode($rs->Servicios, true);

        /*  
            Obtenemos del array de la consulta $rs los datos de la cotizacion y solo tomamtos el id de los servicios, 
            ya que se guardo todos los servicios en un array en la base de datos.
        */
        $idServicioArray = array();
        if (is_array($Servicios)) {
            foreach ($Servicios as $servicio) {
                $idServicio = $servicio['idServicio'];
                $idServicioArray[] = $idServicio;
            }
        }
        /*
            ahora consulto con la id de los servicios para obtener los datos de los servicios, como nombre,url_img etc.
        */
        $getData = $this->Cotizaciones_model->getDetalleProductos($idServicioArray);



        /*
            Ahora combino los datos de la consulta $rs y $getData para tener un solo array con todos los datos, y todo se guarda en combinedArray
         */
        $PServicios = [];

        // Recorrer los datos de $Servicios
        foreach ($Servicios as $servicio) {
            $idServicio = $servicio['idServicio'];
        
            // Buscar los datos correspondientes en $getData
            foreach ($getData as $data) {
                $idS = $data['idS'];
                if ($idServicio == $idS) {
                    // Combinar los datos en un solo array
                    $FuncionarData = array_merge($servicio, $data);
                    $PServicios[] = $FuncionarData;
                    break;
                }
            }
        }
        //@AldairCruz

        
        // echo json_encode($PServicios);
        // die();
        
        
        // $DatosTecnico = $this->Reportes_modal->DetalleTecnico($Tecnico);
        // $venta = $this->Reportes_modal->DetalleOrden($VentaO);

        // //domicilio cliente
        // $domicilio = $this->Reportes_modal->domicilioCliente();

        $data["ReporteVenta"] = $rs;
        
        $data = array(
            'titulo' => "Hola",
            'contenido' => $rs,
            'nombreSucursal' => "SDI",
            "DatosCliente" => $dataCliente,
            "Servicios" => $PServicios,
            // 'domicilio' => $domicilio,
            // 'venta' => $venta,
            // 'DatosTecnico' => $DatosTecnico,
            // 'fecha_emision' => $fecha_actual,
            
        );

        // echo json_encode($rs->Servicios);
        // die();


        $mpdf = new \Mpdf\Mpdf(
            ['format' => 'A4',]
        );
        $html = $this->load->view('private/fragments/cotizacion/detalleCotizacionpdf', $data, true);
        $mpdf->WriteHTML($html);
        $mpdf->Output('cotizacion.pdf','D'); // it downloads the file into the user system, with give name


        
       
        //$mpdf->Output('ejemplo.pdf', 'D'); $mpdf->Output('ejemplo.pdf', 'D');
        //$mpdf->Output('arjun.pdf','D'); // it downloads the file into the user system, with give name
    
   }

   public function enviarCorreo(){
        $idCotizacion = $this->input->post("idCotizacion");
        $idUsuario = $this->input->post("idUsuario");

        $correoCliente = $this->Cotizaciones_model->verCorreoCliente($idUsuario);

        // echo json_encode($correoCliente);
        // die();
       
        if($correoCliente != null){
            $correo = $correoCliente->correo;



            $data["cotizacion"] = $idCotizacion;
            $user_send = 'SDI';
            $to_email  = $correo; // correo electrónico del destinatario (cliente)
            $asunto = 'SDI - Cotización';
        
            $html = ($this->load->view('private/fragments/cotizacion/cotizacionEmail_view', $data, TRUE));
             //$attach = '/ruta/al/archivo.pdf';
        
            $resultado_envio = send_mail2($user_send, $to_email, $asunto, $html);
        
            if ($resultado_envio) {
                $data["resultado"] = true;
                $data["Mensaje"]   = "Se ha enviando a tu correo: ". $correo. " indicaciones para la actualización de contraseña";

                
                
                
            }else {
                // hubo un error al enviar el correo electrónico
                $data["resultado"] = false;
                $data["Mensaje"]   = "Hubo un error al generar el token, intente de nuevo";
            
            }
        }else{
            $data["resultado"] = false;
            $data["Mensaje"]   = "Hubo un error al enviar el correo";
        }

        echo json_encode($data);

       
   }
}
?>
