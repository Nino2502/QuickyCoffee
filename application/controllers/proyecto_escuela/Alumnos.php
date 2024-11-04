<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Alumnos extends CI_Controller{

    function __construct() {
        parent::__construct();

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header('Content-Type: application/json'); 

        $this->load->model('app/Alumnos_model');
    }

    public function index() {

        echo "<h2>Soy Alumnos</h2>";
        
    }

    public function get_alumnos(){

        $rs = $this->Alumnos_model->get_alumnos();




        if ($rs) {
            echo json_encode($rs);
        } else {
            echo json_encode(array('error' => 'No se encontraron alumnos.'));
        }




    }







}




?>