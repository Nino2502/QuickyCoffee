<?php 

class GastoVariado extends CI_Controller{

	private $idusuario;
    private $rol_id;
	private $idP;
	private $sucursal;
	private $major;
	private $estatus;
	private $permiso_id;


    public function __construct(){

        parent::__construct();
		
		verifica_token();
		
		update_user_estatus($this->session->userdata('idusuario'));
		
        $this->load->model('app/GastoVariado_model');
		$this->load->model('app/Inventario_model');
		$this->load->model('app/Sucursales_model');
		
		
		$this->idusuario = $this->session->userdata('idusuario');
		
        $this->rol_id = $this->session->userdata('idTipoUsuario');
		$this->idP = $this->session->userdata('idPerfilUsuario');
		//$this->sucursal = $this->session->userdata('sucursal');
		$this->major = $this->session->userdata('major');
		
		$this->estatus = $this->session->userdata('estatus');
		
		
		
		
		//echo "<pre>";
		//var_dump($_SESSION);
		//die();
       
    }


    public function index(){
		
		$this->permiso_id = get_permiso_modulo_seccion(
            $this->estatus,
            $this->rol_id,
			$this->idP,
            $modulo = 9,
            $seccion_id = 51
        );
		
		
		if (!is_null($this->permiso_id)) {
		
		
		
		
		
        $data['_APP_TITLE']              = "Lista GastoVariado";        
        $data['_APP_VIEW_NAME']          = "Finanzas";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 9, 51);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("GastoVariado");
		$data['sucursal']        = $this->Sucursales_model->ver_Sucursal($this->session->userdata('sucursal'));

        
        $data['styles'][] = 'vendor/select2.min';
        $data['styles'][] = 'vendor/select2-bootstrap.min';
        //$data['styles'][] = 'vendor/fullcalendar.min';
        $data['styles'][] = 'vendor/bootstrap-datepicker3.min';

        $data['scripts'][] = 'plantilla/js/dore-plugins/select.from.library';
        $data['scripts'][] = 'plantilla/js/vendor/select2.full';

        

        $data['scripts'][] = 'propiosScripts/GastoVariado';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';

        $data['scripts'][] = 'plantilla/js/vendor/bootstrap-datepicker';


        

		//echo "<pre>";
		//var_dump($data["sucursal"]);
		//die();


        $data['modals'][]  = $this->load->view('private/fragments/GastoVariado/modalGastoVariado', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/GastoVariado/GastoVariado_view', $data, TRUE);

        $this->load->view("default",$data,FALSE);
			
		}else{
			redirect(base_url()."web");
		}

    }

    public function verGastoVariado(){

           $rs = $this->GastoVariado_model->ver_GastoVariado();
		
		//var_dump($this->db->last_query());
		//die();
		
		
           $data['resultado'] = $rs != null;
           $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." GastoVariado " : "no se econtraron GastoVariado";
           $data["GastoVariado"] = $rs;
           echo JSON_ENCODE($data);

    }


    public function vistaPrevia(){
        $id= $this->input->post("id");

        $rs = $this->GastoVariado_model->vista_previa($id);

        $data["resultado"] = $rs != null;
        $data["mensaje"]= $data["resultado"] ? "Se obtuvieron " . count($rs) . " GastoVariado(s) ": "No se obtuvieron GastoVariados";
        $data["detalleCompra"]= $rs;

        echo json_encode($data);

    }


    public function insertaGastoVariado(){

        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        $accion = $data['accion']; 
        $insertado = false;

		//echo "<pre>";
        //var_dump($json);
		//var_dump($data);
        //die();

        $arrayDetalleCompra = $data['serviciosArray'];

        unset($data['serviciosArray']); 

        if($accion == "Agregar"){

            unset($data['accion']); 
            $rs = $this->GastoVariado_model->inserta_nueva_GastoVariado($data);

            if($rs != 0){


                if(count($arrayDetalleCompra) >=1 ){

                    $cantidad = 0;
					

                    foreach($arrayDetalleCompra as $fila){
						
						$bandera1 = 0;
						$bandera2 = 0;

                        
                        $dataGastoVariado = ["idCom"=>$rs, "idS"=>$fila[0], "nombreProducto"=> $fila[1], "cantidad"=> $fila[3], "precio"=> $fila[2], "subtotal"=> $fila[4]];

                        

                        $insertaGastoVariado = $this->GastoVariado_model->inserta_GastoVariado($dataGastoVariado);

                        $insertaGastoVariado != null ? $bandera1 =1 : $bandera1=0;
						
						
						
							
						}//termina else de comprobar si hay o no inventario inicial
						

                    }
                }

                $insertaGastoVariado != false ?  $insertado = true :  $insertado = false;

            }else{

                $insertado = false;

            }

            $data["resultado"]= $insertado != false && $rs != null ;
            $data["mensaje"] = $data["resultado"] ? "Se inserto correctamente" : "No se inserto prueba nuevamente";



        



        if($accion== "Agregar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se inserto correctamente" : "No se inserto prueba nuevamente";
        }else if($accion == "editar"){
            $data["resultado"]= $actualizaDatos  != false || $insertaGastoVariado  != false;
            $data["mensaje"] = $data["resultado"] ? "Se actualizo correctamente" : "No se actualizo prueba nuevamente";
        }

        echo json_encode($data);

    }


    public function cambioEstatus(){

        $id = $this->input->post("id");
        $rs = $this->GastoVariado_model->estatus_GastoVariado($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se cambio el estatus correctamente": "No se pudo cambiar el estatus intenta de nuevo";

        echo json_encode($data);

    }


    public function bajaLogica(){

        $id = $this->input->post("id");
        $rs = $this->GastoVariado_model->borradoLogico($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";

        echo json_encode($data);

    }







}//termina clase


?>