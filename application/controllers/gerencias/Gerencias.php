<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gerencias extends CI_Controller {

    

    function __construct() {
        parent::__construct();

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header('Content-Type: application/json'); 

        $this->load->model('app/Gerencias_model');
    }

    public function index(){

        echo "<h1>Hola compadre</h1>";

    }

    public function get_gerencias() {
       
        

        $rs = $this->Gerencias_model->get_gerencias();




        if ($rs) {
            echo json_encode($rs);
        } else {
            echo json_encode(array('error' => 'No se encontraron gerencias.'));
        }

        
    }
}


?>