<?php 

class Inventario extends CI_Controller{

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
       
    
        $this->load ->model('app/Inventario_model');
        $this->load ->model('app/Servicios_model');
        $this->load ->model('app/Categorias_servicios_model');
        
       
       
    }



    public function index(){
		
		
		
		$this->permiso_id = get_permiso_modulo_seccion(
            $this->estatus,
            $this->rol_id,
			$this->idP,
            $modulo = 10,
            $seccion_id = 25
        );
		
		
		if (!is_null($this->permiso_id)) {
		

        $data['_APP_TITLE']              = "Lista Inventario";        
        $data['_APP_VIEW_NAME']          = "Inventario";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 10, 25);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Inventario");


        $data['styles'][] = 'vendor/bootstrap-tagsinput';
        $data['styles'][] = 'vendor/select2.min';
        $data['styles'][] = 'vendor/select2-bootstrap.min';
		
		
		
		

        $data['scripts'][] = 'plantilla/js/dore-plugins/select.from.library';
        $data['scripts'][] = 'plantilla/js/vendor/select2.full';

      
        $data['scripts'][] = 'plantilla/js/vendor/bootstrap-tagsinput.min';

        
        $data['scripts'][] = 'propiosScripts/Inventario';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['modals'][]  = $this->load->view('private/fragments/Inventario/modalInventario', $data, TRUE);
        
        
        
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/Inventario/Inventario_view', $data, TRUE);

        $this->load->view("default",$data,FALSE);
			
		 }else{
			redirect(base_url()."web");
	}	
			
			
			

    }
	
	
	
	public function verInventario(){
		
		$idSuc = $this->input->post("idSuc");
		
		$rs = $this->Inventario_model->ver_Inventario($idSuc);
		
		$data['resultado'] = $rs != null;
		$data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." Productos en el inventario" : "no se encontraron productos/servicios en el Inventario";
		$data["Inventario"] = $rs;
		echo JSON_ENCODE($data);
		
		
	}
	

	
	public function existeInventario(){
		
		$idServicio = $this->input->post("idS");
		$idSucursal = $this->input->post("idSuc");

		
		$comprueba = $this->Inventario_model->comprueba_Inventario($idServicio, $idSucursal);
		
		$data['resultado'] = $comprueba != null;
	   $data['mensaje'] = $data['resultado'] ? "Se econtro ". count($comprueba)." servicio" : "no se econtraron Inventario";
	   $data["ServicioInv"] = $comprueba;
	   echo JSON_ENCODE($data);
		
	}
	

	
    public function insertaInventario(){

        //$json = file_get_contents('php://input');
        //$data = (array)json_decode($json);
        //$accion = $data['accion']; 

         
				
					$ajax_data = $this->input->post();

                    //$accion = $ajax_data['accion']; 

                    //unset($ajax_data['accion']); 
		
		
					
					$idS = $this->input->post("idS");
					$idSuc = $this->input->post("idSuc");
					$inventario = $this->input->post("inventario");
					$nombreSucE = $this->input->post("nombreSucE");
					$nombreServicio = $this->input->post("nombreServicio");
					
					unset($ajax_data['nombreSucE']); 
					unset($ajax_data['nombreServicio']); 

                    $rs = $this->Inventario_model->inserta_Inventario($ajax_data);
		
		
							
		
		
					if($rs != false ){
						
						
						
						$descripcion = "<strong>Nuevo Inventario:</strong> Se ha crea un nuevo inventario en la  <strong>sucursal:</strong> ". $idSuc. " ". $nombreSucE ." <strong>Producto: </strong>". $idS ." ". $nombreServicio ."  <strong> cantidad:</strong> ". $inventario . " ";
								
								$dataHI = ["idHI"=>0,"idS"=>$idS,"idSuc"=>$idSuc,"descripcion"=>$descripcion, "idU"=>$_SESSION["idusuario"]];
								
								$insertaHistorico = $this->Inventario_model->inserta_historico_Inventario($dataHI);
								
								//$insertaHistorico != false ? $historico =1 : $historico =0;
									
							}
		
		
		
		

                    //if($accion== "Agregar"){
                        $data["resultado"]= $rs != false;
                        $data["mensaje"] = $data["resultado"] ? "Se agrego  correctamente al inventario" : "No se inserto prueba nuevamente";
                    //}else if($accion == "editar"){
                      //  $data["resultado"]= $rs != false;
                        //$data["mensaje"] = $data["resultado"] ? "Se actualizo  correctamente" : "No se actualizo prueba nuevamente";
                    //}
			
            echo json_encode($data);
	

    }
	

	
	public function transpasoSucursal(){
		
		
		
		$ajax_data = $this->input->post();
		
		$idServicio = $this->input->post("idServicio");
		$idSucAbterior = $this->input->post("idSucAbterior");
		$cantidad = $this->input->post("cantidad");
		$sucursalNueva = $this->input->post("sucursalNueva");
		$nombreServicio = $this->input->post("nombreServicio");
		$nombreSucAnterior = $this->input->post("nombreSucAnterior");
		$nombreSucNueva = $this->input->post("nombreSucNueva"); 
		$comentariotranspaso = $this->input->post("comentariotranspaso");
		
		
		//echo "<pre>";
		//var_dump($ajax_data);
		//die();
                    
		$inventarioAnterior = $this->Inventario_model->comprueba_Inventario($idServicio, $idSucAbterior);
		
		if($cantidad > $inventarioAnterior[0]->inventario){	
                   
                      
                        $data["mensaje"] =  "La cantidad que quiere transpasar es mayor a la que hay en el inventario";
                    
			
		}else{
			
			$resta1 = 0;
			$suma2 = 0;
			$historico = 0;
		
			
			$comprueba = $this->Inventario_model->comprueba_Inventario($idServicio, $sucursalNueva);
			
		
				if($comprueba != null){
							
							
							$restaInventario = (($inventarioAnterior[0]->inventario)-($cantidad));
							$resInv = ["inventario"=>$restaInventario];		
							$restaAlInventario = $this->Inventario_model->update_sumaCompra_Inventario($resInv,$idServicio, $idSucAbterior);
							$restaAlInventario != false ? $resta1=1 : $resta1 =0;
					
					
					
							$cantEnInventrio = $comprueba[0]->inventario;
							$suma = (($cantidad)+($cantEnInventrio));
							$dataInv = ["inventario"=>$suma];
							
							$actualizaInventario = $this->Inventario_model->update_sumaCompra_Inventario($dataInv,$idServicio, $sucursalNueva);
							$actualizaInventario != false ? $suma2=1 : $suma2 =0;
							
									 
							//echo("if <pre>");
							//var_dump($restaAlInventario);
							//var_dump($actualizaInventario);
							//die();		 
									  
									  
							
							if($actualizaInventario != false || $restaAlInventario != false  ){
								
								$descripcion = "<strong>Transpaso de sucursal:</strong>Se lleva a cabo un aumento en el inventario </br> <strong>sucursal:</strong> ".$sucursalNueva. " ". $nombreSucNueva ." </br> <strong>Producto: </strong>". $nombreServicio ."  <strong>id:</strong> ". $idServicio ."   <strong>cantidad: </strong>". $cantidad . "  </br> Descuento a la sucursal <strong>". $idSucAbterior . " ".$nombreSucAnterior." </strong>". "</br><strong>Comentario:</strong> " . $comentariotranspaso;
								
								$dataHI = ["idHI"=>0,"idS"=>$idServicio,"idSuc"=>$idSucAbterior,"descripcion"=>$descripcion, "idU"=>$_SESSION["idusuario"]];
								
								$insertaHistorico = $this->Inventario_model->inserta_historico_Inventario($dataHI);
								
								$insertaHistorico != false ? $historico =1 : $historico =0;
									
							}else{
								$historico=0;
							}
							
						}else{
							
							$dataInv = ["idS"=>$idServicio,"idSuc"=>$sucursalNueva,"inventario"=>$cantidad];
							$insertaInventario = $this->Inventario_model->inserta_Inventario($dataInv);
							
							
							//echo("else <pre>");
							//var_dump($dataInv);
							//var_dump($insertaInventario);
							//die();
							
					
							$restaInventario = (($inventarioAnterior[0]->inventario)-($cantidad));
							$resInv = ["inventario"=>$restaInventario];	
							$restaAlInventario = $this->Inventario_model->update_sumaCompra_Inventario($resInv,$idServicio, $idSucAbterior);
						
							$insertaInventario != false ? $suma2=1 : $suma2 =0;
							$restaAlInventario != false ? $resta1=1 : $resta1 =0;
							
							if($insertaInventario != false || $restaAlInventario != false ){
								
								$descripcion = "<strong>Transpaso de sucursal:</strong> Derivado del transpaso, se crea un nuevo inventario </br> <strong>sucursal:</strong> ".$sucursalNueva. " ". $nombreSucNueva ." </br> <strong>Producto: </strong>". $nombreServicio ."  <strong>id:</strong> ". $idServicio ."   <strong>cantidad: </strong>". $cantidad . "  </br> Descuento a la sucursal <strong>". $idSucAbterior . " ".$nombreSucAnterior." </strong>". "</br><strong>Comentario:</strong> " . $comentariotranspaso;
								
								$dataHI = ["idHI"=>0,"idS"=>$idServicio,"idSuc"=>$idSucAbterior,"descripcion"=>$descripcion, "idU"=>$_SESSION["idusuario"]];
								
								$insertaHistorico = $this->Inventario_model->inserta_historico_Inventario($dataHI);
								
								$insertaHistorico != false ? $historico =1 : $historico =0;
								
								
							}else{
								$historico=0;
								
							}
							
						}//termina else de comprobar si hay o no inventario inicial
			
			
						$data["resultado"]= $resta1 != 0 && $suma2 !=0  ;
						$data["mensaje"] = $data["resultado"] ? 
							"Se a transpasado con exito " . ($resta1 != 0 ? "Se resto del inventario, " : " No se resto del inventario, ") . 
							($suma2 != 0 ? " Se sumo al nuevo inventario, " : " No se su al nuevo inventario, ") .
							($historico != 0 ? " Se agrego al historico, " : " No se agrego al historico correctamente, ") : 
							" Se ha transpasado con exito, " . 
							($resta1 != 0 ? " Se resto del inventario, " : " No se resto del inventario, ") .  
							($suma2 != 0 ? " Se sumo al nuevo inventario, " : " No se su al nuevo inventario, ") . 
							($historico != 0 ? " Se agrego al historico correctamente, " : " No se agrego al historico correctamente, ");

		
		}
		
            echo json_encode($data);
		
		
		
	}


	public function editaInventarioSucursal(){
		
		
		
		$ajax_data = $this->input->post();
		
		$idServicio = $this->input->post("idServicio");
		$idSucE = $this->input->post("idSucE");
		$nombreSucE = $this->input->post("nombreSucE");
		$cantidad = $this->input->post("cantidad");
		$nombreServicio = $this->input->post("nombreServicio");   
		
		$comentarioEditar = $this->input->post("comentarioEditar");
		
		//echo "<pre>";
		//var_dump($ajax_data);
		//die();
                    
			$inventarioAnterior = $this->Inventario_model->comprueba_Inventario($idServicio, $idSucE);
			$comprueba = $this->Inventario_model->comprueba_Inventario($idServicio, $idSucE);
		
		
			
			$edita1 = 0;
			
			$historico = 0;
			
		
				if($comprueba != null){
							
							
							$dataInv = ["inventario"=>$cantidad];
							
							$actualizaInventario = $this->Inventario_model->update_sumaCompra_Inventario($dataInv,$idServicio, $idSucE);
							$actualizaInventario != false ? $edita1=1 : $edita1 =0;
							
									 
							//echo("if <pre>");
							//var_dump($restaAlInventario);
							//var_dump($actualizaInventario);
							//die();		 	  
							
							if($actualizaInventario != false ){
								
								$descripcion = "<strong>Edición de inventario:</strong> Se llevó a cabo la edición del inventario <strong>sucursal:</strong>  ".$idSucE." ". $nombreSucE ."</br> <strong>Producto: </strong>". $idServicio ." ". $nombreServicio ."   </br> La cantidad anterior era: <strong> ".$inventarioAnterior[0]->inventario."</strong>  </br>La nueva  cantidad  establecida es <strong>". $cantidad . "</strong>" . "</br><strong>Comentario:</strong> " . $comentarioEditar;
								
								$dataHI = ["idHI"=>0,"idS"=>$idServicio,"idSuc"=>$idSucE,"descripcion"=>$descripcion, "idU"=>$_SESSION["idusuario"]];
								
								$insertaHistorico = $this->Inventario_model->inserta_historico_Inventario($dataHI);
								
								$insertaHistorico != false ? $historico =1 : $historico =0;
									
							}
							
						}
			
						$data["resultado"]= $edita1 != 0 && $historico !=0  ;
						$data["mensaje"] = $data["resultado"] ? 
							"Se edito el inventario con éxito " : 
							"Hubo un problema:  " . 
							($edita1 != 0 ? " Se edito el inventario con exito, " : "  No se edito el inventario con exito, ") .  
							($historico != 0 ? " Se agrego al historico de forma correcta " : " No agrego al historico de forma correcta  ");

		
            echo json_encode($data);
		
		
		
		
		
	}
	
	
	
	
	
	
	
	


    public function compruebaInventarioInicial(){
		
		$idS = $this->input->post("idS");
		$idSuc = $this->input->post("idSuc");
		$rs = $this->Inventario_model->comprueba_Inventario_Inicial($idSuc, $idS);
		$inve = $this->Inventario_model->prInveIn($idSuc, $idS);
		
		
		
		
		$data['resultado'] = $rs != null;
	    $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." atributos" : "no se econtraron atributos";
		$data['inventario'] = $inve;
	    $data['atributos'] = $rs;
	    echo JSON_ENCODE($data);

    }







}//termina clase


?>