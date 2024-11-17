<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Estructura extends CI_Controller {

    function __construct() {
        parent::__construct();

        // Configuración de CORS
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        header('Content-Type: application/json');

        // Cargar el modelo
        $this->load->model('app/Estructura_model');
    }

    public function index() {
        echo "<h1>Hola Soy Jesus Nino</h1>";
    }

    public function estructura_info() {
        $rs = $this->Estructura_model->get_organizational_structure();

        if ($rs) {
            echo json_encode($rs);
        } else {
            echo json_encode(array('error' => 'No se encontraron empleados.'));
        }
    }
}
