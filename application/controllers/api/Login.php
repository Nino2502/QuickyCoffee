<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
        public function inicio_sesion()
        {
            $correo      = $this->input->post('correo');
            $contrasenia = $this->input->post('contrasenia');

            $this->load->model('app/login_api_model');
            $data = $this->login_api_model->get_user($correo, md5($contrasenia));

            if ($data!= null){
                $response['status'] = true;
				$response['mensaje'] = "Bienvenido ".$data->nombreU." ".$data->apellidos;
            }else{
               // echo "No existe la cuenta o los datos son incorrectos";
               $response['status'] = false;
               $response['mensaje'] = "ERROR en credenciales de acceso";
            }
            echo json_encode($response);
        }

      
}