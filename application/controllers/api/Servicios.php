<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicios extends CI_Controller {
    
        public function ver_servicios()
        {
            json_header();
            $data = array();
            $this->load->model('servicios_api_model');
            $data = $this->servicios_api_model->get_servicios(1);
            $response= array();
            if ($data!= null){
                $response['data'] = $data;
            }else{
               // echo "No existe la cuenta o los datos son incorrectos";
               $response['data'] = "No hay por el momento.";
            }
            echo json_encode($response);
        }
        
        public function detalle_servicio(){
            json_header();
            $data = array();
            $idS = $this->input->post('idS');
            $this->load->model('servicios_api_model');
            $data = $this->servicios_api_model->get_detalle_servicio($idS);
            $response= array();
            if ($data!= null){
                $response['data'] = $data;
            }else{
               // echo "No existe la cuenta o los datos son incorrectos";
               $response['data'] = "No hay por el momento.";
            }
            echo json_encode($response);

        }
}