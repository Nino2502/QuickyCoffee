<?php


use ExpoSDK\Expo;
use ExpoSDK\ExpoMessage;

class NotificacionExpo extends CI_Controller{

    private $rol_id;
	private $idP;
    private $idUsuario;
    private $idTU;
  
    public  function __construct(){
        parent::__construct();

        verifica_token();
        $this->load->model('Notificacion/Notificacion_model');
        $this->rol_id       = $this->session->userdata('idTipoUsuario');
		$this->idP          = $this->session->userdata('idPerfilUsuario');
        $this->idUsuario    = $this->session->userdata('idusuario');
        $this->idTU         = $this->session->userdata('idTipoUsuario');
      
       
    }
    public function enviarNotificacion(){

    $estatus = $this->input->post("estatus");
    $idVenta = $this->input->post("idVenta");

    


    $status = $this->Notificacion_model->getStatus($estatus);

    $desc   = $status->descripcion;
    $titulo = $status->estatus;

    $getCliente = $this->Notificacion_model->getCliente($idVenta);
   
    if($getCliente->deviceToken != null){
            
            $usuarioCliente = $getCliente->deviceToken;

            require FCPATH.'vendor/autoload.php';
            $messages = [
                
                new ExpoMessage([
                    'title' => "SDI-" . $titulo,
                    'body' => $desc,
                ]),
            ];
            
            /**
             * These recipients are used when ExpoMessage does not have "to" set
             *  'ExponentPushToken[detf23H__6CCZHqVrygDdm]',
             *  'ExponentPushToken[Kuit9oFJyRBw1AMYvGtVSp]',
             * 'ExponentPushToken[uoYuPrwH_xJBCWO3msvzf3A]'
             *
             */
            $defaultRecipients = [$usuarioCliente];
                    (new Expo)->send($messages)->to($defaultRecipients)->push();
            
                    $data["resultado"] = true;
                    $data["Mensaje"] = "Notificacion enviada";
                    //echo json_encode(array('token' => $usuarioCliente,'status' => true, 'message' => 'Notificacion enviada'));
                  
        }else{
            $data["resultado"] = false;
            $data["Mensaje"] = "Usuario sin token de notificación. No,es posible enviar notificación";
        }
        echo json_encode($data);
        
    }

}


?>