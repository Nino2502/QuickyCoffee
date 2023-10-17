<?php

class Quienes_somos extends CI_Controller{
	
	
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('Login_model');
	}
	
	
	
	
	public function index(){
	
        $data['_APP']['title'] = "Quienes somos";
        $this->load->view('publico/template/header_view', $data, FALSE);
		$this->load->view('publico/template/navbar_view', $data, FALSE);
		$this->load->view('publico/quienes_view', $data, FALSE);
		$this->load->view('publico/template/footer_view');
		$this->load->view('publico/scripts/home', $data, FALSE);
		
		}
    	
	}


?>