<?php
class Prueba extends CI_Controller{
    private $rol_id;
	private $idP;
    private $idUsuario;
    private $idTU;
    private $idSuc;
   
  
    public  function __construct(){
        parent::__construct();

        //verifica_token();
        $this->load->model('Aldair/LevantarOrden_model');
        $this->rol_id       = $this->session->userdata('idTipoUsuario');
		$this->idP          = $this->session->userdata('idPerfilUsuario');
        $this->idUsuario    = $this->session->userdata('idusuario');
        $this->idTU         = $this->session->userdata('idTipoUsuario');
        $this->idSuc        = $this->session->userdata('sucursal');
      
    
       
    }
    public function index(){
        echo "hola";
    }

}