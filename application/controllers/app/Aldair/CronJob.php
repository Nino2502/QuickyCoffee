<?php
class CronJob extends CI_Controller{
    
	


    public function __construct(){

        parent::__construct();
		
		//verifica_token();
		
		//update_user_estatus($this->session->userdata('idusuario'));
		
		
		
       
		// $this->idusuario = $this->session->userdata('idusuario');
        // $this->rol_id = $this->session->userdata('idTipoUsuario');
		// $this->idP = $this->session->userdata('idPerfilUsuario');
		// $this->estatus = $this->session->userdata('estatus');
       
   

        $this->load->model('Aldair/CronJob_model');
       
    }
    public function test_cronjob(){


        $this->CronJob_model->insert_event(
            array('fecha_exec' => date('Y-m-d H:i:s'))
        );

    }
}

