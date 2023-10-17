<?php

class ActualizacionPass extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
		$this->load->model('app/Login_model');
		$this->load->model('Aldair/RecuperarContrasena_model');
    }
    
    public function index(){
        /**/	
		//redirect( base_url());

		
		
        $data['_APP']['title'] = "Recuperar contraseña";
        $data['modals'][]  = $this->load->view('private/fragments/RecuperarContrasena/modal_recuperarContra', $data, TRUE);
        //$arr_backgrounds[] = base_url('static/images/it/bg1.webp');        
        //$data['bg'] = $arr_backgrounds[rand(0, sizeof($arr_backgrounds)-1)];
        //$data['bg_img_side'] = base_url('static/admin/img/login-img-dark-4.webp');
        $this->load->view('private/fragments/RecuperarContrasena/resetPasswordP_view', $data, FALSE);
		
		
		
    	
    }

    public function ValidarDatos(){
        $correo         = $this->input->post("correo");
        $token          = $this->input->post("token");

       
        $existCorreo 	= $this->RecuperarContrasena_model->verifica_correo($correo);

        if($existCorreo){

            $getIdCliente = $this->RecuperarContrasena_model->recuperarUsuario($correo); // obtenemos el id del cliente
			$idCliente = $getIdCliente->idU;// idCliente

            $validamosToken = $this->RecuperarContrasena_model->validar_token($token,$idCliente);
            if($validamosToken != false){
                
                $data["resultado"] = true;
                $data["Mensaje"]   = "Codigo de verificación valido";
            }
            else{
                $data["resultado"] = false;
                $data["Mensaje"]   = "El código de verificación invalido / Correo electronico invalido.";
            }
        }else{
            $data["resultado"] = false;
			$data["Mensaje"]   = "El correo electronico no existe";
        }
        echo json_encode($data);
    }

    public function actualizarContrasena(){
        $correo         = $this->input->post("correo");
        $contrasena     = $this->input->post("contrasenia");
        $token          = $this->input->post("token");

        $existCorreo 	= $this->RecuperarContrasena_model->verifica_correo($correo);

        if($existCorreo){

            $getIdCliente = $this->RecuperarContrasena_model->recuperarUsuario($correo); // obtenemos el id del cliente
			$idCliente = $getIdCliente->idU;// idCliente

            $newPass = md5($contrasena);

            $arr = array(
                'contrasenia' => $newPass,
                'correo'      => $correo
            );

            $cliente = $this->RecuperarContrasena_model->UpdateContrasena($idCliente,$arr);

            if($cliente){
                // actualizamos el token
                $updateToken = $this->RecuperarContrasena_model->UpdateToken($token);

                $data["token"]     = $updateToken == true ? "Token consumido" : "Error al actualizar el token";
                $data["resultado"] = true;
                $data["Mensaje"]   = "Contraseña actualizada correctamente";

            }else{
                $data["resultado"] = false;
                $data["Mensaje"]   = "Erroe en actualizar contraseña, intentelo más tarde";
            }

        }else{
         $data["Mensaje"] = "Error en el correo";
         $data["resultado"] = false;
        }

        echo json_encode($data);
    }
}
?>