<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SucursalesGet extends CI_Controller {
    function __construct(){
        parent::__construct(); 
        $this->load->model('api/SucursalesGet_model');

	}


        public function getSucursalesQro()
        {
            $sucursal = $this->SucursalesGet_model->get_Sucursales();
            $data["resultado"]  = $sucursal != null ?  true : false;
            $data["mensaje"]    = $data["resultado"] != false ? "Se encontraron " .count($sucursal). " sucursales " : "No se encontraron sucursales";
            $data["Registro"]   = $sucursal;
            echo JSON_encode($data);
        }

      
}