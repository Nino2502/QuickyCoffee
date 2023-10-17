<?php

class Perfil extends CI_Controller{
	
	
	public function __construct()
	{
		parent::__construct();
		// verifica_token();
        $this->load->model('app/Usuario_perfil_model');
        $this->rol_id       = $this->session->userdata('idTipoUsuario');
		$this->idP          = $this->session->userdata('idPerfilUsuario');
        $this->idUsuario    = $this->session->userdata('idusuario');
        $this->idTU         = $this->session->userdata('idTipoUsuario');
		
	}
	
	
	
	
	public function index(){
	
        $data['_APP']['title'] = "Perfil";
        $this->load->view('publico/template/header_view', $data, FALSE);
		$this->load->view('publico/template/navbar_view', $data, FALSE);
		$this->load->view('publico/perfil_view', $data, FALSE);
		$this->load->view('publico/template/footer_view');
		$this->load->view('publico/scripts/editar', $data, FALSE);
		
		}
    	
	}


?>