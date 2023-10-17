<?php 

class Compras extends CI_Controller{

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
		
        $this->load->model('app/Compras_model');
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
            $seccion_id = 32
        );
		
		if (!is_null($this->permiso_id)) {
		
		
		
        $data['_APP_TITLE']              = "Lista Compras";        
        $data['_APP_VIEW_NAME']          = "Inventario";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 9, 32);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Compras");
		$data['sucursal']        = $this->Sucursales_model->ver_Sucursal($this->session->userdata('sucursal'));

        
        $data['styles'][] = 'vendor/select2.min';
        $data['styles'][] = 'vendor/select2-bootstrap.min';
        //$data['styles'][] = 'vendor/fullcalendar.min';
        $data['styles'][] = 'vendor/bootstrap-datepicker3.min';

        $data['scripts'][] = 'plantilla/js/dore-plugins/select.from.library';
        $data['scripts'][] = 'plantilla/js/vendor/select2.full';

        

        $data['scripts'][] = 'propiosScripts/Compras';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';

        $data['scripts'][] = 'plantilla/js/vendor/bootstrap-datepicker';


        

		//echo "<pre>";
		//var_dump($data["sucursal"]);
		//die();


        $data['modals'][]  = $this->load->view('private/fragments/Compras/modalCompras', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/Compras/Compras_view', $data, TRUE);

        $this->load->view("default",$data,FALSE);
			
		}else{
			redirect(base_url()."web");
		}

    }

    public function verCompras(){

           $rs = $this->Compras_model->ver_Compras();
           $data['resultado'] = $rs != null;
           $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." Compras " : "no se econtraron Compras";
           $data["Compras"] = $rs;
           echo JSON_ENCODE($data);

    }


    public function vistaPrevia(){
        $id= $this->input->post("id");

        $rs = $this->Compras_model->vista_previa($id);

        $data["resultado"] = $rs != null;
        $data["mensaje"]= $data["resultado"] ? "Se obtuvieron " . count($rs) . " Compras(s) ": "No se obtuvieron Comprass";
        $data["detalleCompra"]= $rs;

        echo json_encode($data);

    }


    public function insertaCompras(){

        $json = file_get_contents('php://input');
        $datos = (array)json_decode($json);
        $accion = $datos['accion']; 
        $insertado = false;

		



        $arrayDetalleCompra = $datos['serviciosArray'];

        unset($datos['serviciosArray']); 

        if($accion == "Agregar"){

            unset($datos['accion']); 
            $rs = $this->Compras_model->inserta_nueva_Compra($datos);

            if($rs != 0){


                if(count($arrayDetalleCompra) >=1 ){

                    $cantidad = 0;
					

                    foreach($arrayDetalleCompra as $fila){
						
						$bandera1 = 0;
						$bandera2 = 0;

                        
                        $dataCompras = ["idCom"=>$rs, "idS"=>$fila[0], "nombreProducto"=> $fila[1], "cantidad"=> $fila[3], "precio"=> $fila[2], "subtotal"=> $fila[4]];

                        
						$dataUltimoPrecioCompra = ["ultimoPrecioCompra"=> $fila[2]];
						
						$insertaUltimoPrecioCompra = $this->Compras_model->update_ultimo_precio_compra($dataUltimoPrecioCompra, $fila[0]);
						
						

                        $insertaCompras = $this->Compras_model->inserta_Compras($dataCompras);

                        $insertaCompras != null ? $bandera1 =1 : $bandera1=0;
						
						
						$comprueba = $this->Inventario_model->comprueba_Inventario($fila[0], $datos['idSuc']);
						
						
						
						
						if($comprueba != null){
							
							
							
							$cantidadForm = $fila[3];
							$cantEnInventrio = $comprueba[0]->inventario;
							$suma = ($cantidadForm+$cantEnInventrio);
							
							$dataInv = ["inventario"=>$suma];
							
							$actualizaInventario = $this->Inventario_model->update_sumaCompra_Inventario($dataInv,$fila[0], $datos['idSuc']);
							
							
							if($actualizaInventario != null){
								
								$descripcion = "<strong>Compra a proveedor: </strong>Se lleva a cabo un aumento en el inventario, <strong>sucursal id: </strong>".$datos['idSuc']." <strong>producto id:</strong> ". $fila[0] ." <strong>nombre:</strong> ". $fila[1] ." <strong>cantidad:</strong> ". $fila[3] ;
								
								$dataHI = ["idHI"=>0,"idS"=>$fila[0],"idSuc"=>$datos['idSuc'],"descripcion"=>$descripcion, "idU"=>$datos['idU']];
								
								$insertaHistorico = $this->Inventario_model->inserta_historico_Inventario($dataHI);
								
								$bandera2 =1;
									
							}else{
								$bandera2=0;
							}
							
							
							
							
							
							
						}else{
							
							$dataInv = ["idS"=>$fila[0],"idSuc"=>$datos['idSuc'],"inventario"=>$fila[3]];
							$insertaInventario = $this->Inventario_model->inserta_Inventario($dataInv);
							
							if($insertaInventario != null){
								
								$descripcion = "<strong>Compra a proveedor: </strong> Se creo un inventario inicial en la <strong>sucursal id: </strong>".$datos['idSuc']." <strong>producto id:</strong> ". $fila[0] ." <strong>nombre:</strong> ". $fila[1] ." <strong>cantidad:</strong> ". $fila[3] ;
								
								$dataHI = ["idHI"=>0,"idS"=>$fila[0],"idSuc"=>$datos['idSuc'],"descripcion"=>$descripcion, "idU"=>$datos['idU']];
								
								$insertaHistorico = $this->Inventario_model->inserta_historico_Inventario($dataHI);
								
								$bandera2 =1;
								
								
							}else{
								$bandera2=0;
								
							}
							
						}//termina else de comprobar si hay o no inventario inicial
						

                    }
                }

                $insertaCompras != false ?  $insertado = true :  $insertado = false;

            }else{

                $insertado = false;

            }

            $data["resultado"]= $insertado != false;
            $data["mensaje"] = $data["resultado"] ? "Se inserto correctamente" : "No se inserto prueba nuevamente";



        }



        if($accion== "Agregar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se inserto correctamente" : "No se inserto prueba nuevamente";
        }else if($accion == "editar"){
            $data["resultado"]= $actualizaDatos  != false || $insertaCompras  != false;
            $data["mensaje"] = $data["resultado"] ? "Se actualizo correctamente" : "No se actualizo prueba nuevamente";
        }
		
		
		//echo "<pre>";
       	//var_dump($json);
		//var_dump($data);
        //die();
		
		

        echo json_encode($data);

    }


    public function cambioEstatus(){

        $id = $this->input->post("id");
        $rs = $this->Compras_model->estatus_Compras($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se cambio el estatus correctamente": "No se pudo cambiar el estatus intenta de nuevo";

        echo json_encode($data);

    }


    public function bajaLogica(){

        $id = $this->input->post("id");
        $rs = $this->Compras_model->borradoLogico($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";

        echo json_encode($data);

    }







}//termina clase


?>