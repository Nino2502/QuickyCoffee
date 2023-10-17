<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agrupacion_servicios extends CI_Controller {

    function __construct(){
        parent::__construct(); 

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, OPTIONS");
	}


    public function get_atributos(){
        json_header();
        $idAS = $this-> input -> post('idAS');
        $this->load->model('abdiel/Agrupacion_servicios_model');
        $data = $this->Agrupacion_servicios_model->ver_atributos( $idAS);
        $response= array();
        if ($data!= null){
            $response['atributos'] = $data;
        }else{
           // echo "No existe la cuenta o los datos son incorrectos";
           //$response['data'] = [];
           $response= null;
        }
        echo json_encode($response);
    }

}
