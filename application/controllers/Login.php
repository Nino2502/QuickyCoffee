<?php

class Login extends CI_Controller{
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('app/Login_model');
	}
	
	
	
	
	
	
	public function index(){
		
		
		
	
		/**/	
		//redirect( base_url());

		if(isset($_SESSION['idusuario']) || isset($_SESSION['correo']) || isset($_SESSION['token']) ){
			
			if($_SESSION['idusuario'] == ""|| $_SESSION['correo'] == "" || $_SESSION['token'] == ""){
	
				session_destroy();
				redirect(base_url()."login");
				
				
			}else{

				$login = $this->Login_model->check_token( $_SESSION['idusuario'], $_SESSION['correo'], $_SESSION['token']);

				if($login){
					redirect(base_url()."web");

				}else{
					session_destroy();
					$CI = &get_instance();
					$CI->session->set_flashdata(
						'message',
						'<h3> <i class="fas fa-exclamation-triangle"></i> Tu token a caducado</h3> o iniciaste sesión en otro dispositivo'
					);
					//$CI->session->session_regenerate_id();
					$CI->session->set_flashdata('message_type', 'danger');

					redirect(base_url()."login");
				}
				



				
			
				
			}
			
			
			
		}else{
		
		
	
        $data['_APP']['title'] = "Iniciar sesión";
        //$arr_backgrounds[] = base_url('static/images/it/bg1.webp');        
        //$data['bg'] = $arr_backgrounds[rand(0, sizeof($arr_backgrounds)-1)];
        //$data['bg_img_side'] = base_url('static/admin/img/login-img-dark-4.webp');
        $this->load->view('publico/login_view', $data, FALSE);
		
		}
    	
	}
	
	
	
	
	
	 function auth()
    { 
		 /* set rules validation recibe tres parametros
		 1.-El nombre del campo: el nombre exacto que le has dado al campo del formulario.
		 2.-Un nombre "humano" para este campo, que se insertará en el mensaje de error. Por ejemplo, si su campo se llama "usuario", puede darle un nombre humano de "Nombre de usuario".
		 3.-Las reglas de validación para este campo de formulario.
		 4.-(opcional) Establezca mensajes de error personalizados en cualquier regla dada para el campo actual. Si no se proporciona, se utilizará el predeterminado.
		 */
		 
        $this->form_validation->set_rules('correoL', 'correo usuario', 'trim|required|valid_email','Introduce el correo');
        $this->form_validation->set_rules('contraseniaL', 'constraseña usuario ', 'trim|required|max_length[16]', 'introduce la contrasenia');

        // json_header();contraenia_error

        if ($this->form_validation->run()) {
			
            $correoL = $this->input->post('correoL');
            $contraseniaL = $this->input->post('contraseniaL');
            $contraseniaL = md5($contraseniaL);

			
            $datos_usuario = $this->Login_model->login($correoL);

            if (!is_null($datos_usuario)) {
				
                if($datos_usuario->contrasenia === $contraseniaL) {
					
					
					if($datos_usuario->estatus == 1 || $datos_usuario->estatus == 2){
					
						session_regenerate_id();
						$token = md5(session_id());

						$token = $this->Login_model->update_token($datos_usuario->idU, $token);

						if($token != null){
							
							$datos_usuario = $this->Login_model->login($correoL);

							$json['resultado']= $datos_usuario != null;
							$json['mensaje']= "Se ha regenerado la session y se ha creado un nuevo token"; 
							$json['usuario'] = $datos_usuario;

						}else{

							$json['resultado']= false;
							$json['mensaje']= "No se genero el token";


						}
						
						
						
					}else{
						$json['resultado']= false;
						$json['mensaje']= "Tu Usuario no esta activo, ponte en contacto con el administrador:  contacto@laptopfixrun.com";
						
					}
                
				} // termina la comparación de la contraseña, si no es correcta entra en el siguiente else
				
				else {
					  $json = array(
						'resultado'   => false,
						'mensaje' => 'La contraseña es incorrecta, intenta de nuevo',

					   );
					
					
                }
            } // termina if de consulta a bd, si el usuario no es  encontrado siguiente else
			
			else { 
				
					$json = array(
					'resultado'   => false,
					'error' => true,   
					'mensaje' => 'El usuario no esta registrado en la base de datos',

				   );

					
                
            }
			
           
			
			
        }//termina form validation run 
		 
		else {
           
		   $json = array(
			'resultado'   => false,
			'correo_error' => form_error('correoL'),
			'contrasenia_error' => form_error('contraseniaL')
			
		   );
			
			 http_error(400);
			
		}
        

		 
		 
		 echo json_encode($json);
		 
		 
    }//termina funcion login
	
	
	
	public function acceso($idUsuario = 0, $correo="", $nombre = "", $token=null, $idTU=0, $idP=null, $estatus=0, $idSuc=null, $idMajor=null, $imagen=null, $ruta=""){ 
		
		
		
		/*
		echo "<pre>";
		var_dump($idUsuario, $correo, $nombre, $token, $idTU, $idP, $estatus, $ruta);
		die();
		*/
		
		if($idUsuario == 0 || trim($correo)=="" || $token == null){
			
			redirect( base_url() );
				
		}// termina if si existe o no usuario, correo y token
		
		
		
		// echo $imagen;
		// die();
		
		$this->session->set_userdata(array(
			
			"idusuario"=> $idUsuario,
			"correo"=> $correo,
			"nombreU"=> rawurldecode($nombre),
			"token"=> $token,
			"idTipoUsuario"=> $idTU,
			"idPerfilUsuario" => $idP,
			"estatus"=> $estatus,
			"sucursal"=> $idSuc,
			"major"=>$idMajor,
			"image_url"=>$imagen,
			"ruta" => $ruta
		));
		
		
		
		
		
		if($idTU == 4){
			redirect( base_url()."store/");
		}else{
			
			
			
			redirect( base_url()."web" );
		}
		
		
		
		
		
	}//termina accesso
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}// termina clase login


?>