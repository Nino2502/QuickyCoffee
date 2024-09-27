<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class Logout extends CI_Controller{
	
	public function index(){
		fuchi_wakala();
		
	}
	
	
	public function cerrarSesionIrTienda(){


	
		
		$this->session->sess_destroy();

		redirect('login');
		
		//fuchi_wakala2();
		
	}
	
	
	
	
}



?>