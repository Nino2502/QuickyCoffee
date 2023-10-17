<?php

class Descripcion extends CI_Controller{
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('public/Descripcion_model');
	}
	
	
	
	
	public function vista($id){
        $data['_APP']['title'] = "Descripcion del producto";
		$data['id'] = $id;
        $this->load->view('publico/template/header_view', $data, FALSE);
		$this->load->view('publico/template/navbar_view', $data, FALSE);
		$this->load->view('publico/descrip_view', $data, FALSE);
		$this->load->view('publico/template/footer_view');
		$this->load->view('publico/scripts/descripcion', $data, FALSE);
		
		}

	public function get_informacion()
	{
		$id = $this->input->post('idS');
		$informacion = $this->Descripcion_model->get_informacion($id);
		echo json_encode($informacion);
	}
    	
	}


?>