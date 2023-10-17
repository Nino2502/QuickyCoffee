<?php
require FCPATH.'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class Notificaciones extends CI_Controller{

    private $rol_id;
	private $idP;
	private $idSuc;


    public function __construct(){

        parent::__construct();
		
	
        $this->load ->model('app/Reportes_model');
		
        $this->rol_id = $this->session->userdata('idTipoUsuario');
		$this->idP = $this->session->userdata('idPerfilUsuario');
		$this->idSuc        = $this->session->userdata('sucursal');
       
    }

    public function enviar_notificacion() {
        // Cargar la biblioteca de Firebase
        $factory = (new Factory)
            ->withServiceAccount('ruta/a/tu/archivo-de-credenciales.json');
        $messaging = $factory->createMessaging();
    
        // Obtener el token del dispositivo del usuario
        $userId = 123; // ID del usuario al que deseas enviar la notificación
        $deviceToken = $this->obtenerTokenDispositivoUsuario($userId);
    
        if ($deviceToken) {
            // Crear la notificación
            $notification = Notification::fromArray([
                'title' => 'Título de la notificación',
                'body' => 'Cuerpo de la notificación',
            ]);
    
            // Crear el mensaje con el token del dispositivo del usuario
            $message = CloudMessage::withTarget($deviceToken)
                ->withNotification($notification);
    
            try {
                // Enviar la notificación
                $messaging->send($message);
    
                // Notificación enviada exitosamente
                echo "La notificación se envió correctamente";
            } catch (Exception $e) {
                // Error al enviar la notificación
                echo "Error al enviar la notificación: " . $e->getMessage();
            }
        } else {
            // El usuario no tiene un token de dispositivo registrado
            echo "No se encontró un token de dispositivo para el usuario";
        }
    }

    private function obtenerTokenDispositivoUsuario($userId) {
        // Código para obtener el token de dispositivo del usuario desde la base de datos o cualquier otro mecanismo de almacenamiento
        
        // Devolver el token de dispositivo del usuario
        return 'device_token'; // Reemplazar con el token real obtenido para el usuario
    }
	
}
?>