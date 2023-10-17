<?php 

class QrCodigoG extends CI_Controller{
	
	public function __construct(){
		
		parent::__construct();
		
		$this->load->library('ciqrcode');
				
	}
	
	public function index(){
		
		
		

		$params['data'] = 'This is a text to encode become QR Code';
		$params['size'] = 10;
		$params['savename'] = FCPATH.'tes.png';
		echo $this->ciqrcode->generate($params);
		
		
		
		
	}
	
}



?>