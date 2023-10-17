<?php

class resetPass extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('app/resetPass_model');
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
        


























}
?>