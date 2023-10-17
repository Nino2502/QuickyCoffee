<?php
class TipoDeContratacion extends CI_Controller{
    private $rol_id;
	private $idP;

    public  function __construct(){
        parent::__construct();

        verifica_token();
        $this->load->model('app/Tipo_de_contratacion_model');
        $this->rol_id = $this->session->userdata('idTipoUsuario');
		$this->idP = $this->session->userdata('idPerfilUsuario');
       
    }



    public function index(){
        $data['_APP_TITLE']              = "Tipo de contratacion";        
        $data['_APP_VIEW_NAME']          = "Administracion";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 1);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Tipos de contratacion");
        $data['scripts'][] = 'propiosScripts/tiposDeContratacion';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['modals'][]  = $this->load->view('private/fragments/TipoContratacion/modalTipoContratacion', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/TipoContratacion/TipoContratacion_View', $data, TRUE);
        $this->load->view("default",$data,FALSE);
    }

    public function verTipoContrataciones(){

        $rs = $this->Tipo_de_contratacion_model->ver_tipo_contratacion();

        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." tipos de contratacion" : "no se encontraron contrataciones";
        $data["tiposContrataciones"] = $rs;

        echo JSON_ENCODE($data);
    }
    public function insertarTipoContratacion(){
        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        $accion = $data['accion']; 


        if($data['accion'] == "agregar"){

            unset($data['accion']); //sacamos la accion del array
            $rs = $this->Tipo_de_contratacion_model->inserta_Tipo_De_Contratacion($data);

        }else if($data['accion'] == "editar"){

            unset($data['accion']); 
            $rs = $this->Tipo_de_contratacion_model->update_Tipo_Contratacion($data, $data['idTC']);
        }
       
        else if($data['accion'] == "CambiarEstatus"){
            if($data['estatus'] == 1){
 
                $status =  $data['estatus'];
                $idTC   =  $data['idTC'];

                unset($data['accion']); 

                $changeData = array(
                    "status"        => $status,
                    "idTC"          => $idTC,
                   
                );
                $rs = $this->Tipo_de_contratacion_model->changeStatus1($changeData);
            }else if($data['estatus'] == 0) {
                $status =  $data['estatus'];
                $idTC   =  $data['idTC'];

                unset($data['accion']); 

                $changeData = array(
                    "status"        => $status,
                    "idTC"          => $idTC,
                   
                );
                $rs = $this->Tipo_de_contratacion_model->changeStatus0($changeData);
            }
              
        }


        if($accion == "agregar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se inserto el tipo contratacion correctamente" : "No se inserto, prueba nuevamente";
        }else if($accion == "editar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se actualizo el tipo contratacion correctamente" : "No se actualizo prueba nuevamente";
        }
        else if($accion == "eliminar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se ha eliminado el tipo contratacion correctamente" : "Error en eliminar, prueba nuevamente";
        }
        else if($accion == "CambiarEstatus"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se ha cambiado el status" : "Error en cambiar estatus, prueba nuevamente";
        }


        echo json_encode($data);

    }
    public function bajaLogica(){

        $id = $this->input->post("id");
        $rs = $this->Tipo_de_contratacion_model->borradoLogico($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";

        echo json_encode($data);

    }



}
?>
