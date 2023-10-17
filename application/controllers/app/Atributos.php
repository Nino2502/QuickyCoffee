<?php 

class Atributos extends CI_Controller{
	
	
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
       
    
        $this->load ->model('app/Atributos_model');
        $this->rol_id = $this->session->userdata('idTipoUsuario');
		
    }



    public function index(){
		
		
		$this->permiso_id = get_permiso_modulo_seccion(
            $this->estatus,
            $this->rol_id,
			$this->idP,
            $modulo = 5,
            $seccion_id = 22
        );
		
		
		if (!is_null($this->permiso_id)) {
		
		

        $data['_APP_TITLE']              = "Atributos";        
        $data['_APP_VIEW_NAME']          = "Atributos";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 5,22);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Listado atributos");

        $data['styles'][] = 'vendor/bootstrap-tagsinput';


        $data['styles'][] = 'vendor/select2.min';
        $data['styles'][] = 'vendor/select2-bootstrap.min';

        $data['scripts'][] = 'plantilla/js/dore-plugins/select.from.library';
        $data['scripts'][] = 'plantilla/js/vendor/select2.full';

      
        $data['scripts'][] = 'plantilla/js/vendor/bootstrap-tagsinput.min';


        $data['scripts'][] = 'propiosScripts/Atributos';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['modals'][]  = $this->load->view('private/fragments/atributos/modalAtributos', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/atributos/Atributos_view', $data, TRUE);

        $this->load->view("default",$data,FALSE);
			
			
			
			 }else{
				redirect(base_url()."web");
		}
			
			

    }

    public function verAtributos(){

           $rs = $this->Atributos_model->ver_Atributos();
           $data['resultado'] = $rs != null;
           $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." Atributos" : "no se econtraron Atributos";
           $data["Atributos"] = $rs;
           echo JSON_ENCODE($data);

    }

    public function vistaPreviaCat(){
        $id= $this->input->post("id");

        $rs = $this->Atributos_model->vista_previaC($id);

        $data["resultado"] = $rs != null;
        $data["mensaje"]= $data["resultado"] ? "Se obtuvieron " . count($rs) . " catgorias(s) ": "Este atributo no esta asociado a una categoria";
        $data["categorias"]= $rs;

        echo json_encode($data);

    }

    public function vistaPreviaAtr(){
        $id= $this->input->post("id");

        $rs = $this->Atributos_model->vista_previaAtr($id);

        $data["resultado"] = $rs != null;
        $data["mensaje"]= $data["resultado"] ? "Se obtuvieron " . count($rs) . " atributos(s) ": "No se obtuvieron atributos";
        $data["atributos"]= $rs;

        echo json_encode($data);

    }
    


    public function vistaPreviaAtributosDeCategoria(){
        $id= $this->input->post("id");

        $rs = $this->Atributos_model->vista_previa_atributos_de_categoria($id);

        $data["resultado"] = $rs != null;
        $data["mensaje"]= $data["resultado"] ? "Se obtuvieron " . count($rs) . " atributos(s) ": "No se obtuvieron atributos";
        $data["nombreAtributos"]= $rs;

        echo json_encode($data);

    }

	
	 public function vistaPreviaAtributosDeCategoria2(){
        $id= $this->input->post("id");

        $rs = $this->Atributos_model->vista_previa_atributos_de_categoria2($id);

        $data["resultado"] = $rs != null;
        $data["mensaje"]= $data["resultado"] ? "Se obtuvieron " . count($rs) . " atributos(s) ": "No se obtuvieron atributos";
        $data["nombreAtributos"]= $rs;

        echo json_encode($data);

    }




    public function insertaAtributos(){

        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        $accion = $data['accion']; 

        $dataUno['idAtr']= $data["idAtr"];
        $dataUno['nombreAtr']= $data["nombreAtr"];
        $dataUno['desAtr']= $data["desAtr"];
        $dataUno['estatus']= $data["estatus"];

        $dataDos['listaCategorias']= $data["listaCategorias"];
        $dataTres['listaAtributos']= $data["listaAtributos"];
        


        /*echo "<pre>";
        var_dump ($dataUno);


        var_dump ($dataDos);
      var_dump ($dataTres);

        die();
*/

        if($data['accion']== "Agregar"){

            $atrInsert = 0;
            $atrDetail = 0;
            $resultado = true;
            $mensaje1 = "Nombre ok";
            $mensaje2 = "Categoria ok";
            $mensaje3 = "Detalle ok";
            $idInsertaNombreAtributo = $this->Atributos_model->inserta_nombre_atributos($dataUno);

            

            if($idInsertaNombreAtributo != false){

                foreach($data["listaCategorias"] as $idC => $categoriaAtributo){

                    $categoriaAtributo = ["idCS"=>$categoriaAtributo, "idAtr"=>$idInsertaNombreAtributo];

                    $insertaCategoriaAtributo = $this->Atributos_model->inserta_categorias_atributos($categoriaAtributo);

                    $insertaCategoriaAtributo ?  $atrInsert ++ : "";

                }

                if($atrInsert != 0){

                    foreach($data["listaAtributos"] as $detalleAtr){

                        $dataDetalleAtributo = ["idDAtr"=>0, "idAtr"=>$idInsertaNombreAtributo, "nombreDAtr"=>$detalleAtr];

                        $insertaDetalleAtributo = $this->Atributos_model->inserta_detalle_atributo($dataDetalleAtributo);

                        $insertaDetalleAtributo ?  $atrDetail ++ : "";

                    }
                }

            }//termina if de insercion del nombre

            

            if($idInsertaNombreAtributo == false || $atrInsert == 0 || $atrDetail == 0  ){

               if($idInsertaNombreAtributo == false){
                $mensaje1 = "No se inserto el nombre";

               }else if($atrInsert == 0){
                $mensaje2 = "No se inserto la categoria";

               }else{

                $mensaje3 = "No se inserto el detalle";

               }
            
            

                $resultado = false;

              
            }

            


        }//Termina accion agregar
        else if($data['accion']== "editar"){


                $atrInsert = 0;
                $datosgral = 0;
                $atrDetail = 0;
                $resultado = true;
                $mensaje1 = "Nombre ok";
                $mensaje2 = "Categoria ok";
                $mensaje3 = "Detalle ok";
               

                $actualizaDatos = $this->Atributos_model->update_atributos($dataUno, $data["idAtr"]);

                
                    if(count($dataDos['listaCategorias']) != 0){

                        $borraCategoriasAtributo = $this->Atributos_model->borra_atributo_categoria($data["idAtr"]);

                       

                        foreach($data["listaCategorias"] as $idC => $categoriaAtributo){

                            $categoriaAtributo = ["idCS"=>$categoriaAtributo, "idAtr"=>$data["idAtr"]];

                            $insertaCategoriaAtributo = $this->Atributos_model->inserta_categorias_atributos($categoriaAtributo);

                            $insertaCategoriaAtributo ?  $atrInsert ++ : "";

                        }

                       
                    }//termina if de insercion del nombre

                    if(count(  $dataTres['listaAtributos']) != 0){

                       $borradetalleAtributo = $this->Atributos_model->borra_detalle_atributo($data["idAtr"]);

                       

                       foreach($data["listaAtributos"] as $detalleAtr){

                           $dataDetalleAtributo = ["idDAtr"=>0, "idAtr"=>$data["idAtr"], "nombreDAtr"=>$detalleAtr];

                           $insertaDetalleAtributo = $this->Atributos_model->inserta_detalle_atributo($dataDetalleAtributo);

                           $insertaDetalleAtributo ?  $atrDetail ++ : "";

                       }
                   }


                    

                    if($actualizaDatos == true || $atrInsert >= 1 || $atrDetail >= 1  ){

                        $resultado = true;

                    }else{
                        $resultado = false;
                    }

                    if($datosgral == false){
                        $mensaje1 = "No cambiaron los datos generales";

                    }else if($atrInsert == 0){
                        $mensaje2 = "No se cambiaron los datos de la categoria";

                    }else{

                        $mensaje3 = "No se cambiaron los atributos";

                    }

        }//Termina accion editar
		if($data['accion']== "AgregarAtr"){
			
			$atrDetail = 0;
			$resultado = true;
			
			

            if(count(  $dataTres['listaAtributos']) != 0){

                       

                       

                       foreach($data["listaAtributos"] as $detalleAtr){

                           $dataDetalleAtributo = ["idDAtr"=>0, "idAtr"=>$data["idAtr"], "nombreDAtr"=>$detalleAtr];

                           $insertaDetalleAtributo = $this->Atributos_model->inserta_detalle_atributo($dataDetalleAtributo);

                           $insertaDetalleAtributo ?  $atrDetail ++ : "";

                       }
                   }

            


        }//Termina accion agregar








        if($accion== "Agregar"){
            $data["resultado"]= $resultado != false;
            $data["mensaje"] = $data["resultado"] ? "Se inserto correctamente" : "Error: " . $mensaje1 . " " . $mensaje2. " ". $mensaje3;
           
        }else if($accion == "editar"){
            $data["resultado"]= $resultado != false;
            $data["mensaje"] = $data["resultado"] ? "Se actualizo el atributo correctamente" : "Error: " . $mensaje1 . " " . $mensaje2. " ". $mensaje3;
        }else if($accion == "AgregarAtr"){
            $data["resultado"]= $resultado != false;
            $data["mensaje"] = $data["resultado"] ? "Se agregaron correctamente" : "Error: " . $mensaje3;
        }
		

        echo json_encode($data);

    }


    public function cambioEstatus(){

        $id = $this->input->post("id");
        $rs = $this->Atributos_model->estatus_Atributos($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se cambio el estatus correctamente": "No se pudo cambiar el estatus intenta de nuevo";

        echo json_encode($data);

    }


    public function bajaLogica(){

        $id = $this->input->post("id");
		
		
		$borraAtributos = $this->Atributos_model->borra_atributo_categoria($id);
		$borraAtributos = $this->Atributos_model->borra_detalle_atributo($id);
        $rs = $this->Atributos_model->borradoLogico($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";

        echo json_encode($data);

    }


    public function getAtributosDeServicio(){

        $id = $this->input->post("id");
        $rs = $this->Atributos_model->get_atributos_de_servicio($id);
        $data["resultado"] = $rs != NULL;
        $data["mensaje"] = $data["resultado"] ? "Se encontraron " . count($rs) . " Atributos" : "No se encontraron atributos";
        $data["atributosCategoria"] = $rs;

        echo json_encode($data);
    }
	
	
	public function verAtributosDeUnServicio(){
		$id = $this->input->post("id");
        $rs = $this->Atributos_model->get_atributos_de_servicio($id);
        $data["resultado"] = $rs != NULL;
        $data["mensaje"] = $data["resultado"] ? "Se encontraron " . count($rs) . " Atributos" : "No se encontraron atributos";
        $data["atributosCategoria"] = $rs;

        echo json_encode($data);
		
		
		
	}
	
	
	
	public function editarAtr($idAtr, $nombre, $estatus ){
		
		
		
		$data['categorias'] = $this->Atributos_model->vista_previaC($idAtr);
		
		
		$data['atributos'] = $this->Atributos_model->vista_previaATR($idAtr);
		
		
		$data['nombre'] = $nombre;  
		
		
		
		$data['idAtrBase'] = $idAtr; 
		/*echo "<pre>";
		var_dump($data['categorias']);
		var_dump($data['atributos']);
		die();*/
		
		
		
	
		$data['_APP_TITLE']              = "Editar atributos";        
        $data['_APP_VIEW_NAME']          = "Atributos";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 5,22);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Editar atributos");

        $data['styles'][] = 'vendor/bootstrap-tagsinput';
        $data['styles'][] = 'vendor/select2.min';
        $data['styles'][] = 'vendor/select2-bootstrap.min';
        $data['scripts'][] = 'plantilla/js/dore-plugins/select.from.library';
        $data['scripts'][] = 'plantilla/js/vendor/select2.full';
        $data['scripts'][] = 'plantilla/js/vendor/bootstrap-tagsinput.min';




        $data['scripts'][] = 'propiosScripts/editarAtributos';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
		
        
		$data['modals'][]  = $this->load->view('private/fragments/atributos/modalEditarAtributos', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/atributos/EditarAtributos_view', $data, TRUE);

        $this->load->view("default",$data,FALSE);

		
		
		
		
		
	}
	
	
	


public function recargaAtributos(){
	
	 $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        $idAtr = $data['idAtr']; 

       
	
	
   $rs = $this->Atributos_model->vista_previaATR($idAtr);
   $data['resultado'] = $rs != null;
   $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." Atributos" : "no se econtraron Atributos";
   $data["atributos"] = $rs;
   echo JSON_ENCODE($data);
	
	
	
	
	
	
}

public function borrarAtributo(){
	
	
	$id = $this->input->post("id");
	


	
	
	$rs = $this->Atributos_model->modal_borrar($id);
	
	
		 
		 
	
	
	$data['resultado'] = $rs != false;
	
	$data['mensaje'] = $data['resultado'] ? "Se borró atributo" : "No se pudo borrar";

	
	echo json_encode($data);

}

public function editarAtributo(){
	
	    $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        $accion = $data['accion'];
		
		if($data['accion'] == "editar"){
			
			$datac['nombreDAtr'] = $data['nombreDAtr'];
			
			
			if($datac['nombreDAtr'] == $data['nombreDAtr']){
				
				$resultado = false;
				
				$data["resultado"] = $resultado;
				
				$data["mensaje"] = $data["resultado"] ? "Modifica algo" : "No hay modificaciones";

			
			}
			
			$datac["idDAtr"] = $data['idDAtr'];
			
			$actualizarAtributo = $this->Atributos_model->update_atributos_model($datac,$data["idDAtr"]);
			
			if($actualizarAtributo == true){
			
				$resultado = true;
				
				if($accion == "editar"){
					$data["resultado"] = $resultado != false;
					
					$data["mensaje"] = $data["resultado"] ? "Se actualizo los atributos" : "No se pudo actualizar";
					
					
					echo json_encode($data);
				
				
				
				}
			
			}
			

		
		}else{
			
			$data["resultado"] = $resultado != false;
					
			$data["mensaje"] = $data["resultado"] ? "No se pudo actualizar" : "No se pudo actualizar";
			

			echo json_encode($data);
		
		
		
		}


		






}




}//termina clase


?>