<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Login extends CI_Controller {
    
        public function inicio_sesion()
        {
            $correo      = $this->input->post('correo');
            $contrasenia = $this->input->post('contrasenia');

            $this->load->model('abdiel/login_model');
            $data = $this->login_model->get_user($correo, md5($contrasenia));

            if ($data!= null){
                $response['status'] = true;
				$response['mensaje'] = "Bienvenido ".$data->nombreU." ".$data->apellidos;
                $response['idU'] = $data->idU;
                $response['idC'] = $this->login_model->check_carrito($data->idU, $data->idSuc);
            }else{
               // echo "No existe la cuenta o los datos son incorrectos";
               $response['status'] = false;
               $response['mensaje'] = "ERROR en credenciales de acceso";
            }
            echo json_encode($response);
        }

      
}