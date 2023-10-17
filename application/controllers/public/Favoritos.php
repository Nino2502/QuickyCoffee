<?php

class Favoritos extends CI_Controller{
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('public/Favoritos_model');
	}
	

	public function index(){
        $data['_APP']['title'] = "Favoritos";
        $this->load->view('publico/template/header_view', $data, FALSE);
		$this->load->view('publico/template/navbar_view', $data, FALSE);
		$this->load->view('publico/favoritos_view', $data, FALSE);
		$this->load->view('publico/template/footer_view');
		$this->load->view('publico/scripts/favoritos', $data, FALSE);
		
		}

		public function get_favoritos()
		{
			$idU = $_SESSION['idusuario'];
			$favoritos = $this->Favoritos_model->get_favoritos($idU);
			echo json_encode($favoritos);
		}

	public function insertar()
	{
		$idS = $this->input->post('idS');
        $idU = $_SESSION['idusuario'];


		$existe = $this->Favoritos_model->buscar($idU, $idS);
		if ($existe == null) {
			$insertar = $this->Favoritos_model->insertar($idU, $idS);
			if ($insertar) {
				echo json_encode($insertar);
			} else {
				echo false;
			}
		} else {
			echo "2";
		}

		
	}
    	
	}


?>