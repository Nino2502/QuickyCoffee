<?php


defined('BASEPATH') OR exit('No direct script access allowed');


class Departamentos extends CI_controller{

    function __construct() {
        parent::__construct();

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header('Content-Type: application/json'); 

        $this->load->model('app/Departamentos_model');
    }


    public function index(){
        echo '<h1>Hola soy Departamentos</h1>';
    }

    
    public function get_departamentos(){

        $rs = $this->Departamentos_model->get_departamentos();




        if ($rs) {
            echo json_encode($rs);
        } else {
            echo json_encode(array('error' => 'No se encontraron departamentos.'));
        }


    }




}

?>