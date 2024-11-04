<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Escuelas extends CI_Controller{



   function __construct() {
        parent::__construct();

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header('Content-Type: application/json'); 

        $this->load->model('app/Escuelas_model');
    }


    public function index() {

        echo "<h2>Soy Escuelas</h2>";
        
    }

    public function get_escuelas(){

        $rs = $this->Escuelas_model->get_escuelas();




        if ($rs) {
            echo json_encode($rs);
        } else {
            echo json_encode(array('error' => 'No se encontraron escuelas.'));
        }


    }

    public function agregar_escuela(){
        json_header();

        $ajax_data = $this->input->post();

        echo json_encode($ajax_data);
        die();



    }



}




?>