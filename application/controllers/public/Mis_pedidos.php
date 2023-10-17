<?php

class Mis_pedidos extends CI_Controller{
	
	
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('Login_model');
	}
	
	
	
	
	public function index(){
	
        $data['_APP']['title'] = "Mis pedidos";
        $this->load->view('publico/template/header_view', $data, FALSE);
		$this->load->view('publico/template/navbar_view', $data, FALSE);
		$this->load->view('publico/mis_pedidos_view', $data, FALSE);
		$this->load->view('publico/template/footer_view');
		$this->load->view('publico/scripts/home', $data, FALSE);
		
		}
    	
	}


?>