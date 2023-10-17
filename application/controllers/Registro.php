<?php 


class Registro extends CI_Controller{
	
	
	public function __construct(){
		
		parent :: __construct();
		$this->load->model('app/Auth_model');
		$this->load->model('public/Registro_model');
	}
	
	public function index(){
		
		if(isset($_SESSION['idusuario']) || isset($_SESSION['correo']) || isset($_SESSION['token']) ){
			
			if($_SESSION['idusuario'] == ""|| $_SESSION['correo'] == "" || $_SESSION['token'] == ""){
				
				
				session_destroy();
				redirect(base_url()."login");
				
			}else{
				redirect(base_url()."web");	
			}
			
		}else{
		
			$data['_APP']['title']='Registro de usuarios';
			$data['_APP']['tipoRegistro']='Cliente';	
			$this->load->view("publico/registro_view", $data);
		
		}
	
	}

	public function traer_suc(){
		$sucursales = $this->Registro_model->traer_sucursales();
		echo json_encode($sucursales);
	}
	
	public function registrarse(){
		
		$this->form_validation->set_rules('nombre', 'nombre usuario', 'trim|required|max_length[100]','Introduce el nombre de usuario');
        $this->form_validation->set_rules('apellidos', 'apellidos usuario ', 'trim|required|max_length[100]', 'introduce los apellidos');
		$this->form_validation->set_rules('telefono', 'telefono usuario ', 'trim|required|max_length[10]', 'introduce el teléfono');
		$this->form_validation->set_rules('correoElectronico', 'correo usuario ', 'trim|required|valid_email', 'introduce el correo');
		$this->form_validation->set_rules('contrasenia', 'contrasenia usuario ', 'trim|required|max_length[50]', 'introduce la contrasenia');
		
		
		if ($this->form_validation->run()) {
			
				$nombre = $this->input->post("nombre");
				$apellidos = $this->input->post("apellidos");
				$telefono = $this->input->post("telefono");
				$correoElectronico = $this->input->post("correoElectronico");
				$contrasenia = $this->input->post("contrasenia");
				$sucursal = $this->input->post("idSuc");

				$verificaMail = $this->Registro_model->existe_correo($correoElectronico);
				$verificaTel = $this->Registro_model->existe_tel($telefono);

				if($verificaMail != null){

					$json = array(
						'resultado'   => true,
						'mensaje' =>"El correo ya esta registrado",
						'tipo_alerta' => 'warning'
			   		);
				}

				if($verificaTel != null){

					$json = array(
						'resultado'   => true,
						'mensaje' =>"El telefono ya esta registrado",
						'tipo_alerta' => 'warning'
			   		);
				}

				if ($verificaMail == null && $verificaTel == null) {
					$data = array(
						"nombreU"        => $nombre,
						"apellidos"      => $apellidos,
						"correo"         => $correoElectronico,
						"telefono"       => $telefono,
						"contrasenia"    => md5($contrasenia),
						"idTU"           => '4',
						"estatus"        => 1,
						"image_url" 	 => 'profile_pic.png',
						"idSuc"          => $sucursal
					);
					// var_dump($sucursal);
					// die();

					$respuesta = $this->Registro_model->insertar($data);

					if($respuesta > 0){
						$json = array(
							'resultado'   => true,
							'mensaje' =>"Registro exitoso",
							'tipo_alerta' => 'success'
						   );
					}else{
						$json = array(
							'resultado'   => true,
							'mensaje' =>"No se pudo registrar",
							'tipo_alerta' => 'danger'
						   );
					}		
				}	
		
		  }//termina form validation run 
		 
		else {
           
		   $json = array(
			'resultado'   => false,
			'mensaje'=> "No se pudo validar el formulario",
			'nombre_error' => form_error('nombre'),
			'apellidos_error' => form_error('apellidos'),
			'telefono_error' => form_error('telefono'),
			'correo_error' => form_error('correoElectronico'),
			'contrasenia_error' => form_error('contrasenia')
			
			
		   );
			
			 http_error(400);
			
		}
		 
		 echo json_encode($json);
		
		
	}
	
	
}

?>