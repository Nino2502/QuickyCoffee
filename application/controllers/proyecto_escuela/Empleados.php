<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Empleados extends CI_controller{

    function __construct() {
        parent::__construct();

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header('Content-Type: application/json'); 

        $this->load->model('app/Empleados_model');
    }



    public function index(){
        echo `<h1>Hola soy empleados</h1>`;
    }

    
    public function get_empleados(){

        $rs = $this->Empleados_model->get_empleados();




        if ($rs) {
            echo json_encode($rs);
        } else {
            echo json_encode(array('error' => 'No se encontraron empleados.'));
        }


    }

}

?>