<?php
class Atributos_adicionales extends CI_Controller{
    private $rol_id;
	private $idP;
    private $idusuario;
    private $estatus;
    private $permiso_id;


    public function __construct(){
         parent::__construct();

        // verifica_token();
        $this->load->model('app/Atributos_adicionales_model');
        $this->rol_id = $this->session->userdata('idTipoUsuario');
		$this->idP = $this->session->userdata('idPerfilUsuario');
        $this->idusuario = $this->session->userdata('idusuario');
        $this->estatus = $this->session->userdata('estatus');
       
    }


    public function index(){

        $this->permiso_id = get_permiso_modulo_seccion(
            $this->estatus,
            $this->rol_id,
            $this->idP,
            $modulo = 5,
            $seccion_id = 69


        );

        if(!is_null($this->permiso_id)){
                $data['_APP_TITLE']              = "Atributos Adicionales";        
                $data['_APP_VIEW_NAME']          = "Atributos Adicionales";
                $data['_APP_MENU']               = get_role_menu($this->rol_id, 5, 69);
                //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
                $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
                $data['_APP_BREADCRUMBS']        = array("Atrib.adicionales");
                $data['scripts'][] = 'propiosScripts/Atributos_adicionales';
                //$data['scripts'][] = 'propiosScripts/Usuarios_Sucurales';
                $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
                $data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
                $data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
                $data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
                $data['modals'][]  = $this->load->view('private/fragments/Atributos_adicionales/ModalAtributosAdicionales', $data, TRUE);
                $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/Atributos_adicionales/AtributosAdicionales_view', $data, TRUE);
                $this->load->view("default",$data,FALSE);



        }else{
            redirect(base_url()."web");

        }

    }

    public function verListaAtributos(){

        $rs = $this->Atributos_adicionales_model->ver_lista_atributos();


        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." Atributos!" : "no se encontraron atributos";
        $data["listaAtributos"] = $rs;

        echo JSON_ENCODE($data);
    }
	
	public function verAtributos_promos(){
		$rs = $this->Atributos_adicionales_model->ver_promos();
		
		$data['resultado'] = $rs != null;
		$data['mensaje'] = $data['resultado'] ? "Se encontraron  ".count($rs)."Promocionales" : "No se encontraron promocionales";
		$data['Promocionales'] = $rs;
		
		echo json_encode($data);
	
	
	}
    public function insertarColaborador(){
        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        $accion = $data['accion']; 


        if($data['accion'] == "agregar"){

                
                unset($data['accion']);



                
                $NuevaData = array(
                    "nombreAtrD"     => $data['nombreAtrD'],
                    "desAtrD"        => $data['desAtrD']  ,
                    "precio"         => $data['precio'],
                    "estatus"        => 1,
                    "cat"            => $data['cat'],
                    
                );



                unset($data['accion']); //sacamos la accion del array
                $rs = $this->Atributos_adicionales_model->inserta_nuevo_colaborador($NuevaData);
  


        }else if($data['accion'] == "editar"){


 
            unset($data['accion']); 
            $rs = $this->Atributos_adicionales_model->update_Tipo_Contratacion($data, $data['idAtrD']);
        }
       
        else if($data['accion'] == "CambiarEstatus"){
            if($data['estatus'] == 1){

 
                $estatus =  $data['estatus'];
                $idAtrD   =  $data['idAtrD'];

                unset($data['accion']); 

                $changeData = array(
                    "estatus"        => $estatus,
                    "idAtrD"          => $idAtrD,
                   
                );



                $rs = $this->Atributos_adicionales_model->changeStatus1($changeData);
            }else if($data['estatus'] == 0) {
                $estatus =  $data['estatus'];
                $idAtrD   =  $data['idAtrD'];

                unset($data['accion']); 

                $changeData = array(
                    "estatus"        => $estatus,
                    "idAtrD"          => $idAtrD,
                   
                );
                $rs = $this->Atributos_adicionales_model->changeStatus0($changeData);
            }
              
        }


        if($accion == "agregar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se inserto el atributo correctamente" : "Registro no realizado";
        }else if($accion == "editar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se actualizo el atributo correctamente" : "No se actualizo prueba nuevamente";
        }
        else if($accion == "eliminar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se ha eliminado el atributo correctamente" : "Error en eliminar, prueba nuevamente";
        }
        else if($accion == "CambiarEstatus"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se ha cambiado el estatus" : "Error en cambiar estatus, prueba nuevamente";
        }


        echo json_encode($data);

    }
    public function bajaLogica(){

        $id = $this->input->post("idAtrD");

       

        $rs = $this->Atributos_adicionales_model->borradoLogico($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";

        echo json_encode($data);

    }
    public function listaSucursales(){
        
        $rs = $this->Atributos_adicionales_model->ver_lista_sucursales();

        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." Sucursales!" : "no se encontraron sucursales";
        $data["Sucursales"] = $rs;

        echo JSON_ENCODE($data);
    }

    public function SucursalRegistro(){
        $idU            = $this->input->post("idU");
        $calle          = $this->input->post("calle");
        $numeroExterior = $this->input->post("numeroExterior");
        $numeroInterior = $this->input->post("numeroInterior");
        $codigoPostal   = $this->input->post("codigoPostal");
        $municipio      = $this->input->post("municipio");
        $estado         = $this->input->post("estado");
        $descripcion    = $this->input->post("descripción");
        $domFiscal      = $this->input->post("domFiscal");
        $estatus        = 1;

        $AddressData = array(
            "idU"           => $idU,
            "calle"         => $calle,
            "numeroExterior"=> $numeroExterior,
            "numeroInterior"=> $numeroInterior,
            "codigoPostal"  => $codigoPostal,
            "municipio"     => $municipio,
            "estado"        => $estado,
            "descripción"   => $descripcion,
            "domFiscal"     => $domFiscal,
            "estatus"       => $estatus,
        );

        if ($domFiscal == 1) {
                /*
                    si el nuevo domicilio que se regristra es domicilio fiscal 1, necesitamos actualizar los demas en 0
                */
            $StatusDomfiscal = $this->Atributos_adicionales_model->updateDomFiscal($idU);
                /*
                    una ves actualizado los demas domicilios a 0, procedemos a insertar el nuevo domicilio con domilio fiscal 1
                */
            if($StatusDomfiscal != null){
                /* 
                    Insertamos el nuevo domicilio fiscal 
                */
                $rs = $this->Atributos_adicionales_model->registerAddress($AddressData);
                if($rs != null){
                    $data["resultado"] = $rs != false;
                    $data["mensajeDOM"] ="Se registro correctamente";
                    //procedemos a registrar la sucursales
                }else{
                    $data["resultado"] = $rs != false;
                    $data["mensajeDOM"] ="No se registro correctamente";
                }
            }
        }
        if ($domFiscal == 0){
            // insert the new sucursal
            // $rs = $this->Usuario_majors_model->registro($AddressData);
            $rs = $this->Atributos_adicionales_model->registro();
        
        }
         // first, need to register the  domicile or address of the Major
      
        echo JSON_ENCODE($data);
        
    }
    


}
?>
