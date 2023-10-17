<?php 

class AgrupaPreguntasDiagnosticas extends CI_Controller{


    private $rol_id;
	private $idP;


    public function __construct(){

        parent::__construct();
		
		verifica_token();
        $this->load->model('app/AgrupaPreguntasDiagnosticas_model');
        $this->rol_id = $this->session->userdata('idTipoUsuario');
		$this->idP = $this->session->userdata('idPerfilUsuario');
       
    }


    public function index(){

        $data['_APP_TITLE']              = "Agrupar Preguntas Diagnosticas";        
        $data['_APP_VIEW_NAME']          = "Cuestinarios";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 6, 21);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Agrupar Preguntas Diagnosticas");


        
        $data['styles'][] = 'vendor/select2.min';
        $data['styles'][] = 'vendor/select2-bootstrap.min';

        $data['scripts'][] = 'plantilla/js/dore-plugins/select.from.library';
        $data['scripts'][] = 'plantilla/js/vendor/select2.full';


        $data['scripts'][] = 'propiosScripts/AgrupaPreguntasDiagnosticas';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';




        $data['modals'][]  = $this->load->view('private/fragments/AgrupaPreguntasDiagnosticas/modalAgrupaPreguntasDiagnosticas', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/AgrupaPreguntasDiagnosticas/AgrupaPreguntasDiagnosticas_view', $data, TRUE);

        $this->load->view("default",$data,FALSE);

    }

    public function verAgrupaPreguntasDiagnosticas(){

           $rs = $this->AgrupaPreguntasDiagnosticas_model->ver_agrupa_preguntas_diagnosticas();
           $data['resultado'] = $rs != null;
           $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." agrupaciones " : "no se econtraron agrupaciones";
           $data["AgrupaPreguntasDiagnosticas"] = $rs;
           echo JSON_ENCODE($data);

    }


    public function vistaPrevia(){
        $id= $this->input->post("id");

        $rs = $this->AgrupaPreguntasDiagnosticas_model->vista_previa($id);

        $data["resultado"] = $rs != null;
        $data["mensaje"]= $data["resultado"] ? "Se obtuvieron " . count($rs) . " pregunta(s) ": "No se obtuvieron preguntas";
        $data["preguntas"]= $rs;


        echo json_encode($data);

    }


    public function insertaAgrupaPreguntasDiagnosticas(){

        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        $accion = $data['accion']; 
        $insertado = false;

        $arrayPreguntas = $data['preguntas'];

        unset($data['preguntas']); 

        





        if($data['accion']== "Agregar"){

            
            unset($data['accion']); 


            $rs = $this->AgrupaPreguntasDiagnosticas_model->inserta_nombre_agrupacion($data);

            if($rs != 0){


                if(count($arrayPreguntas) >=1 ){

                    foreach($arrayPreguntas as $pregunta){

                        $dataPreguntas = ["idFormD"=>$rs, "idPD"=>$pregunta];

                        $insertaPreguntas = $this->AgrupaPreguntasDiagnosticas_model->inserta_agrupa_preguntas_diagnosticas($dataPreguntas);

                    }
                }

                $insertaPreguntas != false ?  $insertado = true :  $insertado = false;;

            }else{

                $insertado = false;

            }

            $data["resultado"]= $insertado != false;
            $data["mensaje"] = $data["resultado"] ? "Se inserto correctamente" : "No se inserto prueba nuevamente";






        }else if($data['accion']== "editar"){

            unset($data['accion']); 

            

            $actualizaAgrupacion = false;
            

            $actualizaDatos = $this->AgrupaPreguntasDiagnosticas_model->update_agrupa_preguntas_diagnosticas($data, $data['idFormD']);

            if(count($arrayPreguntas) >=1 ){

                 $this->AgrupaPreguntasDiagnosticas_model->eliminaAgrupacion($data['idFormD']);

                foreach($arrayPreguntas as $pregunta){

                    $dataPreguntas = ["idFormD"=>$data["idFormD"], "idPD"=>$pregunta];

                    $actualizaAgrupacion = $this->AgrupaPreguntasDiagnosticas_model->inserta_agrupa_preguntas_diagnosticas($dataPreguntas);

                }
            }





            
        }



        if($accion== "Agregar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se inserto correctamente" : "No se inserto prueba nuevamente";
        }else if($accion == "editar"){
            $data["resultado"]= $actualizaDatos  != false || $actualizaAgrupacion  != false;
            $data["mensaje"] = $data["resultado"] ? "Se actualizo correctamente" : "No se actualizo prueba nuevamente";
        }

        echo json_encode($data);

    }


    public function cambioEstatus(){

        $id = $this->input->post("id");
        $rs = $this->AgrupaPreguntasDiagnosticas_model->estatus_agrupa_preguntas_diagnosticas($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se cambio el estatus correctamente": "No se pudo cambiar el estatus intenta de nuevo";

        echo json_encode($data);

    }


    public function bajaLogica(){

        $id = $this->input->post("id");
        $rs = $this->AgrupaPreguntasDiagnosticas_model->borradoLogico($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";

        echo json_encode($data);

    }







}//termina clase


?>