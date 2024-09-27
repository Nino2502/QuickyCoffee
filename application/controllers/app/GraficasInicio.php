<?php 

class GraficasInicio extends CI_Controller{


    private $rol_id;
	private $idP;


    public function __construct(){

        parent::__construct();
		
		verifica_token();
        $this->load ->model('app/Graficas_Inicio_model');
        $this->rol_id = $this->session->userdata('idTipoUsuario');
		$this->idP = $this->session->userdata('idPerfilUsuario');
       
    }




    public function GraficasInicioMajor(){

		
		$idSuc = $this->input->post("idSuc");
		$idAnio = $this->input->post("idAnio");
		$idMes = $this->input->post("idMes");
		
		$final = array();
		
		
		if($idSuc == "" || $idAnio == "" || $idMes == ""){
			
			
			$data['mensaje'] =  "Selecciona los datos correspondientes para obtener el reporte" ;
			
		}else{
			
			
			$rs = $this->Graficas_Inicio_model->ver_Graficas_Inicio_major($idSuc, $idAnio, $idMes);

	


	


			
			
			//echo "<pre>";
			//var_dump($final);
			//var_dump($cantidades);
			//die();
			
			
			$data['resultado'] = $rs != null;
            $data['mensaje'] = $data['resultado'] ? "Resultado encontrado" : "no se encontro información con los parametros proporcionados";
            //$data["nombres"] = $nombres;
			$data["final"] = $rs;
			
            echo JSON_ENCODE($data);
			
		}
		
           
		
		
		
		
		
           

    }






}//termina clase


?>