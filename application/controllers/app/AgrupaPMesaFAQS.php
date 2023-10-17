<?php 

class AgrupaPMesaFAQS extends CI_Controller{


    private $rol_id;
	private $idP;


    public function __construct(){

        parent::__construct();
		
		verifica_token();
        $this->load->model('app/AgrupaPMesaFAQS_model');
        $this->rol_id = $this->session->userdata('idTipoUsuario');
		$this->idP = $this->session->userdata('idPerfilUsuario');
       
    }


    public function index(){

        $data['_APP_TITLE']              = "Agrupar Preguntas Mesa FAQS";        
        $data['_APP_VIEW_NAME']          = "Mesa FAQS";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 5, 20);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Agrupar Preguntas Mesa FAQS");

        
        $data['styles'][] = 'vendor/select2.min';
        $data['styles'][] = 'vendor/select2-bootstrap.min';

        $data['scripts'][] = 'plantilla/js/dore-plugins/select.from.library';
        $data['scripts'][] = 'plantilla/js/vendor/select2.full';


        $data['scripts'][] = 'propiosScripts/AgrupaPMesaFAQS';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';




        $data['modals'][]  = $this->load->view('private/fragments/AgrupaPMesaFAQS/modalAgrupaPMesaFAQS', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('private/fragments/AgrupaPMesaFAQS/AgrupaPMesaFAQS_view', $data, TRUE);

        $this->load->view("default",$data,FALSE);

    }

    public function verAgrupaPMesaFAQS(){

           $rs = $this->AgrupaPMesaFAQS_model->ver_agrupa_preguntas_mesaFAQS();
           $data['resultado'] = $rs != null;
           $data['mensaje'] = $data['resultado'] ? "Se econtraron ". count($rs)." agrupaciones " : "no se econtraron agrupaciones";
           $data["AgrupaPMesaFAQS"] = $rs;
           echo JSON_ENCODE($data);

    }


    public function vistaPrevia(){
        $id= $this->input->post("id");

        $rs = $this->AgrupaPMesaFAQS_model->vista_previa($id);

        $data["resultado"] = $rs != null;
        $data["mensaje"]= $data["resultado"] ? "Se obtuvieron " . count($rs) . " pregunta(s) ": "No se obtuvieron preguntas";
        $data["preguntas"]= $rs;

        echo json_encode($data);

    }


    public function insertaAgrupaPMesaFAQS(){

        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        $accion = $data['accion']; 
        $insertado = false;


        

        $arrayPreguntas = $data['preguntas'];

        unset($data['preguntas']); 

        if($data['accion']== "Agregar"){

            
            unset($data['accion']); 


            $rs = $this->AgrupaPMesaFAQS_model->inserta_nombre_agrupacion($data);

            if($rs != 0){


                if(count($arrayPreguntas) >=1 ){

                    $orden = 1;

                    foreach($arrayPreguntas as $pregunta){

                        $dataPreguntas = ["idPRAT"=>$pregunta, "idAT"=>$rs, "orden"=> $orden];

                        $insertaPreguntas = $this->AgrupaPMesaFAQS_model->inserta_agrupa_preguntas_mesaFAQS($dataPreguntas);

                        $orden ++;

                    }
                }

                $insertaPreguntas != false ?  $insertado = true :  $insertado = false;

            }else{

                $insertado = false;

            }

            $data["resultado"]= $insertado != false;
            $data["mensaje"] = $data["resultado"] ? "Se inserto correctamente" : "No se inserto prueba nuevamente";






        }else if($data['accion']== "editar"){

            $bDatos= 0;

            $bPreg =0;
            unset($data['accion']); 

            if(count($arrayPreguntas) >=1 ){

                $orden = 1;

               $this->AgrupaPMesaFAQS_model->borra_agrupa_preguntas_mesaFAQS($data['idAT']);

                foreach($arrayPreguntas as $pregunta){

                    $dataPreguntas = ["idPRAT"=>$pregunta, "idAT"=>$data["idAT"], "orden"=> $orden];

                    $insertaPreguntas = $this->AgrupaPMesaFAQS_model->inserta_agrupa_preguntas_mesaFAQS($dataPreguntas);

                    $insertaPreguntas !=false ? $bPreg =1: $bPreg =0;

                    $orden ++;

                }
            }

           
            $rs = $this->AgrupaPMesaFAQS_model->update_agrupa_preguntas_mesaFAQS($data, $data['idAT']);

            $rs !=false ? $bDatos =1: $bDatos =0;



        }



        if($accion== "Agregar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se inserto correctamente" : "No se inserto prueba nuevamente";
        }else if($accion == "editar"){
            $data["resultado"]=  $data["resultado"]= $bDatos == 1 || $bPreg == 1;;
            $data["mensaje"] = $data["resultado"] ? "Se actualizo correctamente" : "No se actualizo prueba nuevamente";
        }

        echo json_encode($data);

    }


    public function cambioEstatus(){

        $id = $this->input->post("id");
        $rs = $this->AgrupaPMesaFAQS_model->estatus_agrupa_preguntas_mesaFAQS($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se cambio el estatus correctamente": "No se pudo cambiar el estatus intenta de nuevo";

        echo json_encode($data);

    }


    public function bajaLogica(){

        $id = $this->input->post("id");
        $rs = $this->AgrupaPMesaFAQS_model->borradoLogico($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";

        echo json_encode($data);

    }







}//termina clase


?>