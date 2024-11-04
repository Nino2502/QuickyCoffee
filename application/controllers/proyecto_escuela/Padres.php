<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Padres extends CI_Controller{

    function __construct() {
        parent::__construct();

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header('Content-Type: application/json'); 

        $this->load->model('app/Padres_model');
    }

    public function index() {

        echo "<h2>Soy Padres</h2>";
        
    }

    public function get_padres(){

        $rs = $this->Padres_model->get_padres();


        /*
        for($i = 0; $i<count($rs); $i++){

            $hijos_padres =  $rs[$i]->id_alumnos;
        }

        */

       




        if ($rs) {
            echo json_encode($rs);
        } else {
            echo json_encode(array('error' => 'No se encontraron padres.'));
        }




    }







}


?>