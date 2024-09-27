<?php
class LevantarOrden extends CI_Controller{
    private $rol_id;
	private $idP;
    private $idUsuario;
    private $idTU;
    private $idSuc;
    private $macaco;
	
	
	private $idusuario;
    //private $rol_id;

	//private $idP;
	
	//private $idSuc;
	private $estatus;
	private $permiso_id;

	
	
	
  


    public  function __construct(){
        parent::__construct();

        verifica_token();
        $this->load->model('Aldair/LevantarOrden_model');
		
		$this->idusuario = $this->session->userdata('idusuario');

        //$this->rol_id = $this->session->userdata('idTipoUsuario');

		//$this->idP = $this->session->userdata('idPerfilUsuario');
		
		//$this->idSuc        = $this->session->userdata('sucursal');
		$this->idP = $this->session->userdata('idPerfilUsuario');
		$this->estatus = $this->session->userdata('estatus');
        $this->rol_id       = $this->session->userdata('idTipoUsuario');
		$this->idP          = $this->session->userdata('idPerfilUsuario');
        $this->idUsuario    = $this->session->userdata('idusuario');
        $this->idTU         = $this->session->userdata('idTipoUsuario');
        $this->idSuc        = $this->session->userdata('sucursal');
        $this->macaco        = $this->session->userdata('macaco');
    
       
    }
    public function index(){
		
		$this->permiso_id = get_permiso_modulo_seccion(
            $this->estatus,
            $this->rol_id,
			$this->idP,
            $modulo =7,
            $seccion_id = 12
        );
		
		
		if (!is_null($this->permiso_id)) {
			
		

        $data["contra"] = 123;
        $data['_APP_TITLE']              = "Levantar orden";        
        $data['_APP_VIEW_NAME']          = "Levantar orden";   
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 7, 12);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Levantar orden");
        $data['scripts'][] = 'propiosScripts/Aldair/LevantarOrden';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';

        $data['scripts'][] = 'plantilla/js/dore-plugins/select.from.library';
        $data['scripts'][] = 'plantilla/js/vendor/select2.full';


        $data['styles'][] = 'vendor/select2.min';
        $data['styles'][] = 'vendor/select2-bootstrap.min';


        $data['modals'][]  = $this->load->view('private/fragments/LevantarOrden/modalLevantarOrden', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/LevantarOrden/levantarOrden_view', $data, TRUE);
        
        $this->load->view("default",$data,FALSE);
		
							
		}else{
			redirect(base_url()."web");
		}
		
		
		
    }
    public function ListaOrdenesLE(){
        
        $Estatus = $this->LevantarOrden_model->ListaOrdenesLE();
      
       
        $data["OrdenesLevantadas"] = $this->LevantarOrden_model->ListaOrdenesLE();
        $data["resultado"]     = $data["OrdenesLevantadas"] != null ? true : false;
        $data["mensaje"]    = $data["resultado"] ? "Ordenes levantadas" : "No hay ordenes levantadas";
        echo json_encode($data);
    }

    public function listaServicios(){
        
        
        $data["Servicios"] = $this->LevantarOrden_model->listadoServicios();


        $data["resultado"]     = $data["Servicios"] != null ? true : false;
        $data["mensaje"]    = $data["resultado"] ? "Servicios encontrados" : "No hay servicios disponibles";
        echo json_encode($data);
    }
    
    public function OrdenRecepcionista(){
        $id                = $this->input->post("idColaborador");
        $fechaVenta        = $this->input->post("fecha");
        $totla             = $this->input->post("total");
        $idFP              = $this->input->post("idFormaPago");
        $idEP              = $this->input->post("idEstatusPago");
        $ComentarioCliente = $this->input->post("comentarioCliente");
        $LOCliente         = $this->input->post("LOCliente");


        $arrVenta = array(
            'idColaborador' => $id,
            'fecha' => $fechaVenta,
            'total' => $totla,
            'idFP' => $idFP,
            'idEP' => $idEP,
            'comentarioCliente' => $ComentarioCliente,
            'LOCliente' => $LOCliente,
            'estatusServicio' => 1
        );


        $idVenta = $this->LevantarOrden_model->InsertarVentaRecepcionista($arrVenta);
        if ($idVenta != null) {
            $datoss = array(
                array('desDO' =>'Juan', 'costo' => 300, 'cantidad' => 2),
                array('desDO' => 'María', 'costo' => 200, 'cantidad' => 3),
                array('desDO' => 'Pedro', 'costo' => 100, 'cantidad' => 4)
            );            
            foreach ($datoss as &$datos) {
                $datos['idV'] = $idVenta;
            }
            $data["Registro"] = $this->LevantarOrden_model->OrdenRecepcionista($datoss);
        }else{
            $data["resultado"]  = false;
            $data["mensaje"]    = "Error al registrar venta";
            $data["Registro"]   = null;
        }
        $data["resultado"]     = $data["Registro"]  != null ? true : false;
        $data["mensaje"]    = $data["resultado"] ? "Registrado" : "ERROR";
        echo json_encode($data);
    }

    public function VerificaUsuario(){

        $rs = $this->LevantarOrden_model->VerificaUsuario();
        $data["resultado"] = $rs != null ? true : false;
        $data["mensaje"] = $data["resultado"] ? "¡Cliente encontrado en el sistema!" : "Cliente no encontrado en el sistema";
        $data["usuario"] = $rs;
        echo json_encode($data);
    }

    public function registrarCliente(){
        $correo          = $this->input->post("correo");
        $telefono        = $this->input->post("telefono");

        $nombreU         = $this->input->post("nombreU");
        $apellidos       = $this->input->post("apellidos");
        $rfc             = $this->input->post("rfc");
        $contrasenia     = $this->input->post("contrasenia");
        $idTU            = $this->input->post("idTU");
        $estatus         = $this->input->post("estatus");

        $arrData = array(
            'correo'        => $correo,
            'telefono'      => $telefono,
            'nombreU'       => $nombreU,
            'apellidos'     => $apellidos,
            'rfc'           => $rfc,
            'contrasenia'   => md5($contrasenia),
            'idTU'          => $idTU,
            'estatus'       => $estatus
        );


        $rs                    = $this->LevantarOrden_model->VerificaUsuarioExist($correo, $telefono);
        $data["resultadoUser"] = $rs != null ? true : false;
        $data["mensajeUser"]   = $data["resultadoUser"] ? "ERROR: ¡Cliente encontrado en el sistema!: " .$rs->nombreU. ". No es posible realizar el registro, verificar la cuenta": "Registrando en el sistema...";
        
        
        
        if($data["resultadoUser"] == false){
          
            $registroCliente = $this->LevantarOrden_model->InsertarUsuario($arrData);

            if ($registroCliente != null) {
                $data["resultadoRegistro"]  = true;
                $data["mensajeRegistro"]    = "¡Cliente registrado en el sistema!";
                $data["idUsuario"]            = $registroCliente;

            }else{
                $data["resultadoRegistro"]  = false;
                $data["mensajeRegistro"]    = "Error al registrar cliente";
                
            }
        }
        echo json_encode($data);


    }

    public function getProductos(){
      
        $data["Productos"]     = $this->LevantarOrden_model->getProductos();
        $data["resultado"]     = $data["Productos"] != null ? true : false;
        $data["mensaje"]       = $data["resultado"] ? "¡Productos encontrados: " .Count($data["Productos"])." !": "No hay productos disponibles";
        echo json_encode($data);
    }
    
    public function verServicios(){


        $rs = $this->LevantarOrden_model->ver_Servicios();





        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." servicios o productos" : "no se econtraron servicios";
        $data["Servicios"] = $rs;
        echo JSON_ENCODE($data);

     }
	
	 public function verServiciosNoImpresos(){


        $rs = $this->LevantarOrden_model->ver_ServiciosNoImpresos($this->idSuc);
        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." servicios no impresos" : "no se econtraron servicios";
        $data["ServiciosNoImpresos"] = $rs;
        echo JSON_ENCODE($data);

     }
	
	
	
	
     public function verServicio(){
		 
        $id = $this->input->post("id");
        $rs = $this->LevantarOrden_model->ver_Servicio($id, $this->idSuc);
    
   
  
		 
      $data['resultado'] = $rs != null;
      $data['mensaje'] = $data['resultado'] ? "Se encontro ". count($rs)." servicio" : "no se econtraron servicios";
      $data["Servicio"] = $rs;
      echo JSON_ENCODE($data);
   
    }

    public function consultarProducto(){

        $idProducto = $this->input->post("idS");
		

        $rs = $this->LevantarOrden_model->consultarProducto($idProducto);

        $data["resultado"] = $rs != null ? true : false;
        $data["mensaje"] = $data["resultado"] ? "¡Producto encontrado en sucursales!" : "¡Producto, no encontrado en sucursales!";
        $data["producto"] = $rs != null ? $rs : false;

        echo json_encode($data);
    } 

    public function TiposPagos(){
        $rs = $this->LevantarOrden_model->TiposPagos();
        $data['resultado'] = $rs != null ? true : false;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." tipos de pago" : "No hay tipos de pagos registrados";
        $data["TiposPagos"] = $rs;
        echo JSON_ENCODE($data);
    }

    public function getUser(){
        $User = $this->input->post("idU");
        $rs = $this->LevantarOrden_model->getUser($User);
        $data["rs"]        = $User;
        $data["resultado"] = $rs != null ? true : false;
        $data["mensaje"] = $data["resultado"] ? "¡Usuario encontrado ssss!" : "¡Usuario, no encontrado!";
        $data["usuario"] = $rs != null ? $rs : false;

        echo json_encode($data);


    }

    public function registrarNuevoCliente(){
        $correo          = $this->input->post("correo");
        $telefono        = $this->input->post("telefono");
        $nombreU         = $this->input->post("nombreU");
        $apellidos       = $this->input->post("apellidos");
        $contrasenia     = $this->input->post("contrasenia");
        $idTU            = 4;
        $estatus         = 1;

        $arrData = array(
            'correo'        => $correo,
            'telefono'      => $telefono,
            'nombreU'       => $nombreU,
            'apellidos'     => $apellidos,
            'contrasenia'   => md5($telefono),
            'idTU'          => $idTU,
            'estatus'       => $estatus
        );

        

        $rs                    = $this->LevantarOrden_model->VerificaUsuarioExist($correo, $telefono);
        $data["resultadoUser"] = $rs != null ? true : false;
        $data["mensajeUser"]   = $data["resultadoUser"] ? "ERROR: ¡Cliente encontrado en el sistema!: " .$rs->nombreU. "": "Registrando en el sistema...";
        
        
        
        if($data["resultadoUser"] == false){
          
            $registroCliente = $this->LevantarOrden_model->InsertarUsuario($arrData);

            if ($registroCliente != null) {
                $data["resultadoRegistro"]  = true;
                $data["mensajeRegistro"]    = "¡Cliente registrado en el sistema!";
                $data["idUsuario"]            = $registroCliente;

                $data["contra"] = $telefono;
                
                $user_send = 'PZO';
				$to_email  = $correo; // correo electrónico del destinatario (cliente)
				$asunto = 'PZO';
	
				$html = ($this->load->view('private/fragments/LevantarOrden/account_view', $data, TRUE));
				//$attach = '/ruta/al/archivo.pdf';
	
				$resultado_envio = send_mail2($user_send, $to_email, $asunto, $html);

                if ($resultado_envio) {
					$data["resultadod"] = true;
					$data["Mensaje"]   = "Se ha enviando a tu correo: ". $correo. " indicaciones para la actualización de contraseña";
					
					
				}else {
					// hubo un error al enviar el correo electrónico
					$data["resultadod"] = false;
					$data["Mensaje"]   = "Hubo un error al generar el token, intente de nuevo";
				
				}

            }else{
                $data["resultadoRegistro"]  = false;
                $data["mensajeRegistro"]    = "Error al registrar cliente";
                
            }
        }
        echo json_encode($data);


    }

     
    public function OrdenCompra(){
       
	    $idEmpleado             = $this->idUsuario;
        
		$total                  = $this->input->post("total");
        
		$Carrito                = $this->input->post("Array");
        
		$idCliente              = $this->input->post("idCliente");
        
		$idFP                   = $this->input->post("idFP");
        
		$informacionPrograma = json_decode($this->input->post("informacionPrograma"), true);

        $idSucursal     = $this->LevantarOrden_model->getSucursalEmpleado($idEmpleado); //Obtenemos la sucursal del empleado y nombre de la sucursal

        
        if($idSucursal != null){

            /**Genera token venta */
            $nombreCliente = $idSucursal->nombreU;
            $uniqid = uniqid("", true);
            $timestamp = time();
            $combined_string = $nombreCliente . $uniqid . $timestamp;
            $token = md5($combined_string);
            /**termina tokenVenta */


                
                $res = json_decode($Carrito);
                
                
                $new_array = array();

               
                

            
                foreach ($res as $item) {
                    $obj_data = array();
                    foreach ($item as $key => $value) {
                        if ($key == "idServicio" || $key == "Cantidad" || $key == "PrecioUnitario" || $key == "ProductoComentario" || $key == "subtotal") {
                            $obj_data[$key] = $value;
                        }
                    }
                    $new_array[] = $obj_data;
                }
                
                $carritoFinal = array();
                $carritoFinal[] = $new_array;

                $cantidadTotal = 0;






                foreach($carritoFinal as $posiciones){
                    foreach($posiciones as $posicion){

                        $cantidadTotal += $posicion["Cantidad"];

                        $idSer = $posicion["idServicio"];

                        $cantidadProductos = $posicion["Cantidad"];

                        $TipoElemento = $this->LevantarOrden_model->IngredientesServicios($idSer);



                        foreach ($TipoElemento as $ingrediente) {
                            $elementos = explode(',', $ingrediente);
                            foreach($elementos as $nuevo_ingre){
                                $id_ingre = $nuevo_ingre;

                                switch($id_ingre) {
                                    case 17:
                                        // Ingrediente Leche!!
                                        // Consultamos el inventario actual de este ingrediente
                                        $leche_actual_inve = $this->LevantarOrden_model->obtener_inventario($id_ingre);
                                        // Convertimos la cantidad actual del ingrediente a double
                                        $leche_actual = (double)$leche_actual_inve[0]->cantidad;
                                        // Vamos a identificar cuánta leche vamos a descontar y lo vamos a multiplicar por los productos
                                        $leche_des = 250.00 * $cantidadProductos;
                                        // Metemos el id_inventario y cantidad en un array
                                        $array_data = [
                                            "cantidad" => $leche_des,
                                            "id_inventario" => $id_ingre
                                        ];
                                        // Después se lo mandamos al modelo que va a hacer toda la magia, neta te lo juro
                                        $leche_descontada = $this->LevantarOrden_model->actualizar_inventario($array_data);
                                        break;
                                    case 18:
                                        // Ingrediente Cafe en Polvo
                                        // Consultamos el inventario actual de este ingrediente
                                        $cafe_actual_inve = $this->LevantarOrden_model->obtener_inventario($id_ingre);
                                        // Convertimos la cantidad actual del ingrediente a double
                                        $cafe_actual = (double)$cafe_actual_inve[0]->cantidad;
                                        // Vamos a identificar cuánta café en polvo vamos a descontar y lo vamos a multiplicar por los productos
                                        $cafe_des = 50.00 * $cantidadProductos; // Ajusta la cantidad según necesidad
                                        // Metemos el id_inventario y cantidad en un array
                                        $array_data = [
                                            "cantidad" => $cafe_des,
                                            "id_inventario" => $id_ingre
                                        ];
                                        // Después se lo mandamos al modelo que va a hacer toda la magia, neta te lo juro
                                        $cafe_descontado = $this->LevantarOrden_model->actualizar_inventario($array_data);
                                        break;
                                    case 19:
                                        // Ingrediente Galleta Oreo
                                        // Consultamos el inventario actual de este ingrediente
                                        $galleta_actual_inve = $this->LevantarOrden_model->obtener_inventario($id_ingre);
                                        // Convertimos la cantidad actual del ingrediente a double
                                        $galleta_actual = (double)$galleta_actual_inve[0]->cantidad;
                                        // Vamos a identificar cuántas galletas Oreo vamos a descontar y lo vamos a multiplicar por los productos
                                        $galleta_des = 10.00 * $cantidadProductos; // Ajusta la cantidad según necesidad
                                        // Metemos el id_inventario y cantidad en un array
                                        $array_data = [
                                            "cantidad" => $galleta_des,
                                            "id_inventario" => $id_ingre
                                        ];
                                        // Después se lo mandamos al modelo que va a hacer toda la magia, neta te lo juro
                                        $galleta_descontada = $this->LevantarOrden_model->actualizar_inventario($array_data);
                                        break;
                                    case 20:
                                        // Ingrediente Concentrado de capuchino
                                        // Consultamos el inventario actual de este ingrediente
                                        $capuchino_actual_inve = $this->LevantarOrden_model->obtener_inventario($id_ingre);
                                        // Convertimos la cantidad actual del ingrediente a double
                                        $capuchino_actual = (double)$capuchino_actual_inve[0]->cantidad;
                                        // Vamos a identificar cuánta concentración de capuchino vamos a descontar y lo vamos a multiplicar por los productos
                                        $capuchino_des = 100.00 * $cantidadProductos; // Ajusta la cantidad según necesidad
                                        // Metemos el id_inventario y cantidad en un array
                                        $array_data = [
                                            "cantidad" => $capuchino_des,
                                            "id_inventario" => $id_ingre
                                        ];
                                        // Después se lo mandamos al modelo que va a hacer toda la magia, neta te lo juro
                                        $capuchino_descontado = $this->LevantarOrden_model->actualizar_inventario($array_data);
                                        break;
                                    case 21:
                                        // Ingrediente Concentrado Moka
                                        // Consultamos el inventario actual de este ingrediente
                                        $moka_actual_inve = $this->LevantarOrden_model->obtener_inventario($id_ingre);
                                        // Convertimos la cantidad actual del ingrediente a double
                                        $moka_actual = (double)$moka_actual_inve[0]->cantidad;
                                        // Vamos a identificar cuánta concentración de moka vamos a descontar y lo vamos a multiplicar por los productos
                                        $moka_des = 75.00 * $cantidadProductos; // Ajusta la cantidad según necesidad
                                        // Metemos el id_inventario y cantidad en un array
                                        $array_data = [
                                            "cantidad" => $moka_des,
                                            "id_inventario" => $id_ingre
                                        ];
                                        // Después se lo mandamos al modelo que va a hacer toda la magia, neta te lo juro
                                        $moka_descontado = $this->LevantarOrden_model->actualizar_inventario($array_data);
                                        break;
                                    case 22:
                                        // Ingrediente Chocolate Italiano
                                        // Consultamos el inventario actual de este ingrediente
                                        $choco_italiano_actual_inve = $this->LevantarOrden_model->obtener_inventario($id_ingre);
                                        // Convertimos la cantidad actual del ingrediente a double
                                        $choco_italiano_actual = (double)$choco_italiano_actual_inve[0]->cantidad;
                                        // Vamos a identificar cuánta cantidad de chocolate italiano vamos a descontar y lo vamos a multiplicar por los productos
                                        $choco_italiano_des = 80.00 * $cantidadProductos; // Ajusta la cantidad según necesidad
                                        // Metemos el id_inventario y cantidad en un array
                                        $array_data = [
                                            "cantidad" => $choco_italiano_des,
                                            "id_inventario" => $id_ingre
                                        ];
                                        // Después se lo mandamos al modelo que va a hacer toda la magia, neta te lo juro
                                        $choco_italiano_descontado = $this->LevantarOrden_model->actualizar_inventario($array_data);
                                        break;
                                    case 23:
                                        // Ingrediente Chocolate Blanco
                                        // Consultamos el inventario actual de este ingrediente
                                        $choco_blanco_actual_inve = $this->LevantarOrden_model->obtener_inventario($id_ingre);
                                        // Convertimos la cantidad actual del ingrediente a double
                                        $choco_blanco_actual = (double)$choco_blanco_actual_inve[0]->cantidad;
                                        // Vamos a identificar cuánta cantidad de chocolate blanco vamos a descontar y lo vamos a multiplicar por los productos
                                        $choco_blanco_des = 90.00 * $cantidadProductos; // Ajusta la cantidad según necesidad
                                        // Metemos el id_inventario y cantidad en un array
                                        $array_data = [
                                            "cantidad" => $choco_blanco_des,
                                            "id_inventario" => $id_ingre
                                        ];
                                        // Después se lo mandamos al modelo que va a hacer toda la magia, neta te lo juro
                                        $choco_blanco_descontado = $this->LevantarOrden_model->actualizar_inventario($array_data);
                                        break;
                                    case 24:
                                        // Ingrediente Agua
                                        // Consultamos el inventario actual de este ingrediente
                                        $agua_actual_inve = $this->LevantarOrden_model->obtener_inventario($id_ingre);
                                        // Convertimos la cantidad actual del ingrediente a double
                                        $agua_actual = (double)$agua_actual_inve[0]->cantidad;
                                        // Vamos a identificar cuánta agua vamos a descontar y lo vamos a multiplicar por los productos
                                        $agua_des = 500.00 * $cantidadProductos; // Ajusta la cantidad según necesidad
                                        // Metemos el id_inventario y cantidad en un array
                                        $array_data = [
                                            "cantidad" => $agua_des,
                                            "id_inventario" => $id_ingre
                                        ];
                                        // Después se lo mandamos al modelo que va a hacer toda la magia, neta te lo juro
                                        $agua_descontada = $this->LevantarOrden_model->actualizar_inventario($array_data);
                                        break;
                                    case 25:
                                        // Ingrediente Cacao
                                        // Consultamos el inventario actual de este ingrediente
                                        $cacao_actual_inve = $this->LevantarOrden_model->obtener_inventario($id_ingre);
                                        // Convertimos la cantidad actual del ingrediente a double
                                        $cacao_actual = (double)$cacao_actual_inve[0]->cantidad;
                                        // Vamos a identificar cuánta cantidad de cacao vamos a descontar y lo vamos a multiplicar por los productos
                                        $cacao_des = 30.00 * $cantidadProductos; // Ajusta la cantidad según necesidad
                                        // Metemos el id_inventario y cantidad en un array
                                        $array_data = [
                                            "cantidad" => $cacao_des,
                                            "id_inventario" => $id_ingre
                                        ];
                                        // Después se lo mandamos al modelo que va a hacer toda la magia, neta te lo juro
                                        $cacao_descontado = $this->LevantarOrden_model->actualizar_inventario($array_data);
                                        break;
                                    case 26:
                                        // Ingrediente Crema Americana
                                        // Consultamos el inventario actual de este ingrediente
                                        $crema_actual_inve = $this->LevantarOrden_model->obtener_inventario($id_ingre);
                                        // Convertimos la cantidad actual del ingrediente a double
                                        $crema_actual = (double)$crema_actual_inve[0]->cantidad;
                                        // Vamos a identificar cuánta cantidad de crema americana vamos a descontar y lo vamos a multiplicar por los productos
                                        $crema_des = 200.00 * $cantidadProductos; // Ajusta la cantidad según necesidad
                                        // Metemos el id_inventario y cantidad en un array
                                        $array_data = [
                                            "cantidad" => $crema_des,
                                            "id_inventario" => $id_ingre
                                        ];
                                        // Después se lo mandamos al modelo que va a hacer toda la magia, neta te lo juro
                                        $crema_descontada = $this->LevantarOrden_model->actualizar_inventario($array_data);
                                        break;
                                    default:
                                        // No hacer nada para casos no especificados
                                        break;
                                }
                                
                                
                
                            }
                        }
                        
             
                      /*

                        foreach ($ingredientes_array as $ingrediente) {
                          echo $ingrediente . "<br>";
                        }

                        */







                        

                    




                    }

                }

               
                
            
                //Generamos la venta y obtenemos el id de la venta
                $arrData = array(
                   
                    'tokenVenta' => $token,
                    'idCliente' => $idCliente,
                    'idEmpleado' => $idEmpleado,
                    'idFP'       => $idFP,
                    'idEP'       => 1,
                    'FechaVentaG' => date('Y-m-d H:i:s'),
                    'idSuc' => $idSucursal->idSuc,
                    'FechaVentaCierre' => date('Y-m-d H:i:s'),
                    'TotalVenta' => $total,
                    'estatus' => 4,

                );

                $idVenta = $this->LevantarOrden_model->GenerarVenta($arrData);

                

                if($idVenta != null){
                    foreach ($carritoFinal[0] as &$venta) {
                        $venta["idVenta"] = $idVenta;
                        $venta["idSuc"] = $idSucursal->idSuc;
                    }

                    
                   
                    $data["Registro"] = $this->LevantarOrden_model->InsertarDetalleVenta($carritoFinal[0]);

                    /** Actualizacion: Programa lealtad 2023/08/01 **/
                    if($informacionPrograma != null){
                        foreach ($informacionPrograma as &$elemento) {
                            $elemento['idVenta'] = $idVenta;
                        }
                            /*Insertamos los registros al log de programa */
                            
                        $data["programa"] = $this->LevantarOrden_model->insertarLogPrograma($informacionPrograma);
    
                        foreach ($informacionPrograma as $item) {
                            $idCliente = $item["idCliente"];
                            $tipo = $item["tipo"];
                            $cantidad = $item["cantidad"];
                
                            $puntos_actuales = $this->LevantarOrden_model->obtenerPuntosUsuario($idCliente);
                
                            if ($tipo == 1) {
                                // Descontar puntos
                                $puntos_actuales -= $cantidad;
                                  // Evitar tener puntos negativos
                                  if ($puntos_actuales < 0) {
                                    $puntos_actuales = 0;
                                }
                            } elseif ($tipo == 2) {
                                  // Sumar puntos
                              
                                $puntos_actuales += $cantidad;
                              
                            }
                
                            $this->LevantarOrden_model->actualizarPuntosUsuario($idCliente, $puntos_actuales);
                        }
                    }else{
                        $data["programa"]= "No hay programa";
                       
                    }

                }else{
                    $data["resultado"]  = false;
                    $data["mensaje"]    = "Error al registrar venta";
                    $data["Registro"]   = null;
                }

                 
                $data["resultado"]  = $data["Registro"] != false  ? true : false;
                $data["mensaje"]    = $data["resultado"] ? "Compra registrada" : "ERROR en realizar la compra";


        }else{
            $data["resultado"]  = false;
            $data["mensaje"]    = "Error al obtener sucursal del empleado";
            $data["Registro"]   = null;

        }

         echo JSON_encode($data);
    }
   
    public function checkCaja(){

      
            $empleado  = 8;
    
            $fechaActual =  date("Y-m-d 00:00:00");
    
            $getUser = $this->LevantarOrden_model->getUser($empleado);
    
            $Nombre = $getUser->nombreU;
            
            $getCorte = $this->LevantarOrden_model->getDayCorte($empleado,$fechaActual);
    
          
            
            $data["resultado"]          =  $getCorte       != null ? true : false;
            $data["mensaje"]            =  $data["resultado"]   ? "Venta NO DISPONIBLE, corte de caja realizado: " .$getCorte->fechaCorteReali."" : "¡Corte de caja disponible: $Nombre!";
            $data["SistemaCorte"]       =  $getCorte       != null ? $getCorte : false;
       

       
        echo json_encode($data);
    }   

    public function CambioCaja(){
        $idSuc          = $this->idSuc;
        $empleado       = $this->idUsuario;
        $idFP           = 5;
        $Cambio         = $this->input->post("TotalVenta");
        $Comentario     = $this->input->post("Comentario");
        $TipCambio      = $this->input->post("TipCambio");

      


        $arr = array(
            'idFP'              => $idFP,
            'idEP'              => 1,
            'idEmpleado'        => $empleado,
            'TotalVenta'        => $Cambio,
            'FechaVentaG'       => date('Y-m-d H:i:s'),
            'FechaVentaCierre'  => date('Y-m-d H:i:s'),
            'idSuc'             => $idSuc,
            'Comentario'        => $Comentario,
            'TipCambio'         => $TipCambio,
            'estatus'           => 4
        );

      
        $addChange = $this->LevantarOrden_model->registraCambio($arr);


        $data["resultado"]          =  $addChange       != null ? true : false;
        $data["mensaje"]            =  $data["resultado"]   ? "Cambio registrado en caja" : "Error al registrar cambio";
        $data["SistemaCorte"]       =  $addChange       != null ? $addChange : false;

        echo json_encode($data);
    }

    public function getTM(){

        $getTM = $this->LevantarOrden_model->getTM();


        $data["resultado"]          =  $getTM       != null ? true : false;
        $data["mensaje"]            =  $data["resultado"]   ? "Tipos movimientos encontrados" : "Error al obtener tipos de movimientos";
        $data["getTM"]       =  $getTM       != null ? $getTM : false;
        echo json_encode($data);

    }

    public function Acceder(){
        
        $Clave = $this->input->post("ClaveAcceso");

        $getClave = $this->LevantarOrden_model->getClave($Clave);

        $data["resultado"]          =  $getClave       != null ? true : false;
        $data["mensaje"]            =  $data["resultado"]   ? "Acceso permitido" : "Acceso denegado: Clave incorrecta";
        
        echo json_encode($data);
    
    }
	
	public function consultaPrecios(){
		
		$id = $this->input->post("id");
		$categoria= $this->input->post("categoria");
		

		
		
		
		if($categoria == "1"){
			

			$getPrecios = $this->LevantarOrden_model->consulta_precios_impresos($id);
			

			
		}else if($categoria == "2"){
			

			$getPrecios = $this->LevantarOrden_model->consulta_precios_Noimpresos($id);
			
		}
		
		
		$data["precios"] = $getPrecios;
        $data["resultado"] =  $getPrecios  != null ;
        $data["mensaje"] =  $data["resultado"]   ? "Precios encontrados" : "No hay precios dinamicos";
        
        echo json_encode($data);
		
		
	}
	
	
	
}
?>