<?php 


class Contacto extends CI_Controller{
	
	
	  public function __construct(){

        parent::__construct();
		
       
    }
	
	
	
	
	public function contactoEnviar(){

       

        $correo     = $this->input->post('correo');
		$nombre     = $this->input->post('nombre');
		$mensaje     = $this->input->post('mensaje');

        
		
		$hoy = date("d-m-Y");
		
		
		$data['correo'] = $correo;
		$data['nombre'] = $nombre;
		$data['mensaje'] = $mensaje;
		$data['fecha'] = $hoy;
		
		$valida = true;
		
		
		if($correo == "" || $correo == null){
			
			$valida = false;
			
		}
		
		if($nombre == "" || $nombre == null){
			
			$valida = false;
			
		}
		
		if($mensaje == "" || $mensaje == null){
			
			$valida = false;
			
		}
		
		
		if($valida){
			
			

     
            send_mail(

                'SDI' , //Quien lo envia

                $correo, //destinatario

                'Contacto desde web' , //asunto 

                $html = ( $this->load->view('publico/components/contacto_form_view', $data, true)),//Cuerpo (puede ser una vista) 

                $attach = NULL //adjunto

              );
			
			
			  $mensaje =    array(

                "resultado" => true, 

                "mensaje" => 'Se ha enviado el mensaje',

            );   
			
			
			 echo json_encode($mensaje);
			
		}else{
			
			
			  $mensaje =    array(

                "resultado" => false, 

                "mensaje" => 'algo ocurrio intenta de nuevo',

            );  
			
			 echo json_encode($mensaje);
			
			
		}

    }
	
	
	
	
	
	
}



?>