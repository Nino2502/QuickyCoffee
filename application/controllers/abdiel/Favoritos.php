<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Favoritos extends CI_Controller {
    public function add_item(){
        json_header();
        $idAS = $this-> input -> post('idAS');
        $idU = $this-> input -> post('idU');
        $this->load->model('abdiel/Favoritos_model');
        $data = $this->Favoritos_model->agregar( $idAS, $idU );
        echo json_encode($data);
    }

    public function delete_item(){
        json_header();
        $idAS = $this-> input -> post('idAS');
        $idU = $this-> input -> post('idU');
        $this->load->model('abdiel/Favoritos_model');
        $data = $this->Favoritos_model->borrar( $idAS, $idU);
        echo json_encode($data);
    }

    public function get_items(){
        json_header();
        $idU = $this-> input -> post('idU');
       // $idU = $this-> input -> post('idU');
        $this->load->model('abdiel/Favoritos_model');
        $data = $this->Favoritos_model->ver( $idU);
        $response= array();
        if ($data!= null){
            $response['data'] = $data;
        }else{
           // echo "No existe la cuenta o los datos son incorrectos";
           //$response['data'] = [];
           $response= null;
        }
        echo json_encode($response);
    }

    public function check_item(){
        json_header();
        $idAS = $this-> input -> post('idAS');
        $idU = $this-> input -> post('idU');
        $this->load->model('abdiel/Favoritos_model');
        $data = $this->Favoritos_model->check( $idAS, $idU);
        echo json_encode($data);
    }
        public function banners(){
        json_header();
        $this->load->model('abdiel/Favoritos_model');
        $data = $this->Favoritos_model->getBanners();
        echo json_encode($data);
    }

}