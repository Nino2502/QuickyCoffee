<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {
    

    public function get_info()
    {
       
        json_header();
        $data = array();
        $idU      = $this->input->post('idU');
        $this->load->model('abdiel/perfil_model');
        $data = $this->perfil_model->info_user($idU);
        $response= array();
        if ($data!= null){
            
            
            $response['data'] = $data;
            $response['mensaje'] = "Bienvenido";
        }else{
           // echo "No existe la cuenta o los datos son incorrectos";
           $response['data'] = $data;
           $response['mensaje'] = "Error login uwu back";
        }
        echo json_encode($response);
    }
    
         public function update_user() {
        // Obtener los datos del formulario
        json_header();
        //$response = ;
        $idU = $this->input->post("idU");
        $nombreU = $this->input->post("nombreU");
        $apellidos = $this->input->post("apellidos");
        $telefono = $this->input->post("telefono");
        $this->load->model('abdiel/perfil_model');
        $response = $this->perfil_model->update_user($idU, $nombreU, $apellidos,  $telefono);
          echo json_encode($response);  
    }

    public function update_password(){
        json_header();
        $idU = $this->input->post("idU");
        $pass = md5($this->input->post("pass"));
        $newPass = md5($this->input->post("newPass"));
        $this->load->model('abdiel/perfil_model');
        $response = $this->perfil_model->update_pass($idU, $pass,  $newPass);
        echo json_encode($response);  
    }

    public function send_token(){
        json_header();
        $idU = $this->input->post("idU");
        $token = $this->input->post("token");
        $this->load->model('abdiel/perfil_model');
        $response = $this->perfil_model->update_token($idU, $token);
        echo json_encode($response);  
    }
    
        public function delete_usuario(){
        //json_header();
        $idU = $this->input->post("idU");
        $this->load->model('abdiel/perfil_model');
        $response = $this->perfil_model->eliminar_usuario($idU);//el idU lo pone null
			
        echo json_encode($response);
    }
    


}
