<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {

    function __construct(){
        parent::__construct(); 
		$this->load->model('public/Registro_model');
		$this->load->model('app/Auth_model');

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, OPTIONS");
	}
	

	public function registro_usuario()
		{
			json_header();
			$nombre = $this->input->post("nombre");
			$apellidos = $this->input->post("apellidos");
			$telefono = $this->input->post("telefono");
			$correo = $this->input->post("correo");
			$contrasenia = $this->input->post("contrasenia");
			$sucursal = $this->input->post("sucursal");


			$verificaMail = $this->Registro_model->existe_correo($correo);
			$verificaTel = $this->Registro_model->existe_tel($telefono);

			if($verificaMail != null){

				$json = array(
					'resultado'   => false,
					'mensaje' =>"El correo ya esta registrado",
					'tipo_alerta' => 'warning'
				   );
			}

			if($verificaTel != null){

				$json = array(
					'resultado'   => false,
					'mensaje' =>"El telefono ya esta registrado",
					'tipo_alerta' => 'warning'
				   );
			}

			if ($verificaMail == null && $verificaTel == null) {
				$data = array(
					"nombreU"        => $nombre,
					"apellidos"      => $apellidos,
					"correo"         => $correo,
					"telefono"       => $telefono,
					"contrasenia"    => md5($contrasenia),
					"idTU"           => '4',
					"estatus"        => 1,
					"idSuc"          => $sucursal
				);

				$respuesta = $this->Registro_model->insertar($data);

				if($respuesta > 0){
					$json = array(
						'resultado'   => true,
						'mensaje' =>"Registro exitoso",
						'tipo_alerta' => 'success'
					   );
				}else{
					$json = array(
						'resultado'   => false,
						'mensaje' =>"No se pudo registrar",
						'tipo_alerta' => 'danger'
					   );
				}		
			
		
			}
			echo json_encode($json);
			
			
	}



}