<?php 

class AgrupaServicios extends CI_Controller{


    private $rol_id;
	private $idP;


    public function __construct(){

        parent::__construct();
		
		verifica_token();
        $this->load->model('app/AgrupaServicios_model');
        $this->rol_id = $this->session->userdata('idTipoUsuario');
		$this->idP = $this->session->userdata('idPerfilUsuario');
       
    }


    public function index(){

        $data['_APP_TITLE']              = "Agrupa Servicios";        
        $data['_APP_VIEW_NAME']          = "Administración";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 3, 10);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Agrupa Servicios");

        
        $data['styles'][] = 'vendor/select2.min';
        $data['styles'][] = 'vendor/select2-bootstrap.min';
        //$data['styles'][] = 'vendor/fullcalendar.min';
        $data['styles'][] = 'vendor/bootstrap-datepicker3.min';

        $data['scripts'][] = 'plantilla/js/dore-plugins/select.from.library';
        $data['scripts'][] = 'plantilla/js/vendor/select2.full';

        

        $data['scripts'][] = 'propiosScripts/AgrupaServicios';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';

        $data['scripts'][] = 'plantilla/js/vendor/bootstrap-datepicker';


        




        $data['modals'][]  = $this->load->view('private/fragments/AgrupaServicios/modalAgrupaServicios', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/AgrupaServicios/AgrupaServicios_view', $data, TRUE);

        $this->load->view("default",$data,FALSE);

    }

    public function verAgrupaServicios(){

           $rs = $this->AgrupaServicios_model->ver_agrupa_servicios();
           $data['resultado'] = $rs != null;
           $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." agrupaciones " : "no se econtraron agrupaciones";
           $data["AgrupaServicios"] = $rs;
           echo JSON_ENCODE($data);

    }


    public function vistaPrevia(){
        $id= $this->input->post("id");

        $rs = $this->AgrupaServicios_model->vista_previa($id);

        $data["resultado"] = $rs != null;
        $data["mensaje"]= $data["resultado"] ? "Se obtuvieron " . count($rs) . " pregunta(s) ": "No se obtuvieron preguntas";
        $data["servicios"]= $rs;

        echo json_encode($data);

    }


    public function insertaAgrupaServicios(){

        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        $accion = $data['accion']; 
        $insertado = false;


        //echo $json;
        //die();



        $arrayServicosGroup = $data['serviciosArray'];

        unset($data['serviciosArray']); 

        if($accion == "Agregar"){

            

            
            unset($data['accion']); 


            $rs = $this->AgrupaServicios_model->inserta_nombre_agrupacion($data);

            if($rs != 0){


                if(count($arrayServicosGroup) >=1 ){

                    $orden = 1;

                    foreach($arrayServicosGroup as $servicioGrupo){

                        
                        $dataServicios = ["idAS"=>$rs, "idS"=>$servicioGrupo[0], "cantidad"=> $servicioGrupo[2], "costo"=> $servicioGrupo[1]];

                        

                        $insertaServicios = $this->AgrupaServicios_model->inserta_agrupa_servicios($dataServicios);

                        $orden ++;

                    }
                }

                $insertaServicios != false ?  $insertado = true :  $insertado = false;

            }else{

                $insertado = false;

            }

            $data["resultado"]= $insertado != false;
            $data["mensaje"] = $data["resultado"] ? "Se inserto correctamente" : "No se inserto prueba nuevamente";






        }else if($accion== "editar"){

            
            unset($data['accion']); 


            $actualizaDatos = $this->AgrupaServicios_model->update_agrupa_servicios($data, $data['idAS']);

            if(count($arrayServicosGroup) >=1 ){

                $orden = 1;

                $this->AgrupaServicios_model->borra_agrupa_servicios($data['idAS']);

                foreach($arrayServicosGroup as $servicioGrupo){

                    
                    $dataServicios = ["idAS"=>$data['idAS'], "idS"=>$servicioGrupo[0], "cantidad"=> $servicioGrupo[2], "costo"=> $servicioGrupo[1]];

                    

                    $insertaServicios = $this->AgrupaServicios_model->inserta_agrupa_servicios($dataServicios);

                    $orden ++;

                }
            }


        }



        if($accion== "Agregar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se inserto correctamente" : "No se inserto prueba nuevamente";
        }else if($accion == "editar"){
            $data["resultado"]= $actualizaDatos  != false || $insertaServicios  != false;
            $data["mensaje"] = $data["resultado"] ? "Se actualizo correctamente" : "No se actualizo prueba nuevamente";
        }

        echo json_encode($data);

    }


    public function cambioEstatus(){

        $id = $this->input->post("id");
        $rs = $this->AgrupaServicios_model->estatus_agrupa_servicios($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se cambio el estatus correctamente": "No se pudo cambiar el estatus intenta de nuevo";

        echo json_encode($data);

    }


    public function bajaLogica(){

        $id = $this->input->post("id");
        $rs = $this->AgrupaServicios_model->borradoLogico($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";

        echo json_encode($data);

    }







}//termina clase


?>