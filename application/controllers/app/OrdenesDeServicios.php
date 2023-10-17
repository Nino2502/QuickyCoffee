<?php 

class OrdenesDeServicios extends CI_Controller{


    private $rol_id;
	private $idP;


    public function __construct(){

        parent::__construct();
		
		verifica_token();
        $this->load ->model('app/Ordenes_De_Servicios_model');
        $this->rol_id = $this->session->userdata('idTipoUsuario');
		$this->idP = $this->session->userdata('idPerfilUsuario');
       
    }



    public function index(){

        $data['_APP_TITLE']              = "Categorias de Servicios";        
        $data['_APP_VIEW_NAME']          = "Ventas";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 3, 9);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Ordenes de Servicios");
        $data['scripts'][] = 'propiosScripts/Ordenes_De_Servicios';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['modals'][]  = $this->load->view('private/fragments/Ordenes_De_Servicios/modalOrdenes_De_Servicios', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/Ordenes_De_Servicios/Ordenes_De_Servicios_view.php', $data, TRUE);

        $this->load->view("default",$data,FALSE);

    }

    public function verOrdenes_De_Servicios(){

           $rs = $this->Categorias_servicios_model->ver_Ordenes_De_Servicios();
           $data['resultado'] = $rs != null;
           $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." categorias" : "no se econtraron categorias";
           $data["categorias"] = $rs;
           echo JSON_ENCODE($data);

    }


    public function insertaOrdenes_De_Servicios(){

        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        $accion = $data['accion']; 

        if($data['accion']== "Agregar"){

            unset($data['accion']); 
            $rs = $this->Categorias_servicios_model->inserta_Categorias_servicios($data);

        }else if($data['accion']== "editar"){

            unset($data['accion']); 
            $rs = $this->Categorias_servicios_model->update_Categorias_servicios($data, $data['idCS']);
        }

        if($accion== "Agregar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se inserto la categoria correctamente" : "No se inserto prueba nuevamente";
        }else if($accion == "editar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se actualizo la categoria correctamente" : "No se actualizo prueba nuevamente";
        }




        echo json_encode($data);

    }


    public function cambioEstatus(){

        $id = $this->input->post("id");
        $rs = $this->Categorias_servicios_model->estatus_Categorias_servicios($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se cambio el estatus correctamente": "No se pudo cambiar el estatus intenta de nuevo";

        echo json_encode($data);

    }


    public function bajaLogica(){

        $id = $this->input->post("id");
        $rs = $this->Categorias_servicios_model->borradoLogico($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";

        echo json_encode($data);

    }







}//termina clase


?>