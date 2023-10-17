<?php 

class Facturacion extends CI_Controller{
	
	
	
	
	public function __construct(){
		
		
		parent:: __construct();
		
		
        $this->load ->model('daniw/Home_model');
		$this->load->model('public/Facturacion_model');
		$this->load->model('daniw/Perfil_model');
		
		
	}
	
	
	
	
	
	public function index(){
		
		
		$data['_APP']['title'] = "Facturación";
		
       
		
		//$data['styles'][] = 'plantilla/frontcss/contact';
		//$data['styles'][] = 'plantilla/frontcss/custom';
	  
		 
        $data['scripts'][] = 'propiosScripts/Facturacion';
		
		
		$data['_APP_FRAGMENT'] = $this->load->view('publico/fragments/facturacion/Facturacion_view.php', $data, TRUE);

		
		
		$this->load->view('publico/inicio_view', $data, FALSE);
		
		
	}
	
		public function cargaDatosFactura($idVenta ="", $fechaCompra="", $monto="", $token="", $razonSocial="", $rfc="", $correo="", $codigoPostal=""){
			
		$data['id'] = $idVenta;
		$data['fecha'] = $fechaCompra;
		$data['monto'] = $monto;
		$data['token'] = $token;
		$data['razonSocial'] = $razonSocial;
		$data['rfc'] = $rfc;
		$data['correo'] = $correo;
		$data['codigoPostal'] = $codigoPostal;
	
		$data['_APP']['title'] = "Facturación";
        $data['scripts'][] = 'propiosScripts/Facturacion';		
		$data['_APP_FRAGMENT'] = $this->load->view('publico/fragments/facturacion/Facturacion_view.php', $data, TRUE);

		
		
		$this->load->view('publico/inicio_view', $data, FALSE);
	}
	
	
	
	
	
	
	
	
	
	public function facturarCompra(){
		
		
		$idUsuario = $this->input->post("idU");
		$idVenta = $this->input->post("idVen");
		$idRfc = $this->input->post("rfc");
	
		if($idRfc != "sinRfc"){
			
			$Datosfiscales = $this->Perfil_model->get_datosParaFactura($idUsuario, $idRfc);
			$data["Fiscales"] = $Datosfiscales;
		
		}
		
		$rs = $this->Home_model->detalleVentaParaFactura($idVenta);
		
		/*echo "<pre>";
		var_dump($rs);
		var_dump($Datosfiscales);
		die();*/
		
		
	
		
		$data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "preparando datos" : "No se encontraron datos";
        $data["detalleVenta"] = $rs;

        echo JSON_ENCODE($data);
	}
	
	
	
	
	public function validaFactura(){
		
		
		$datos = $this->input->post();
		
		$idVenta = $datos['idVenta'];
		$token = $datos['tokenVenta']; 
		$FechaVentaG = $datos['fecha'];
		$TotalVenta = $datos['TotalVenta'];
		
		$rs = $this->Facturacion_model->verificaFactura($idVenta, $token, $FechaVentaG, $TotalVenta);
		
		$numeroFactura = NULL; 
		
		
		
		
		if($rs != null){
			
			
			$numeroFactura = $rs[0]->Factura;
	
			
		}
		
		
		$dias = 30;
		
		$fechahoy = date("Y-m-d");
		

		$fecha1= new DateTime($fechahoy);
		$fecha2= new DateTime($FechaVentaG);
		$diff = $fecha1->diff($fecha2);

		//echo $diff->days;
		//die();
		
		
		
			if($numeroFactura == !NULL){

			   $data['resultado'] = false;
			   $data['mensaje'] =  "Esta compra ya ha sido facturada" ;
			   $data["factura"] = $rs;
			   echo JSON_ENCODE($data);

			}elseif($diff->days > 30){

			  $data['resultado'] = false;
			   $data['mensaje'] =  "Esta compra a superado los 30 días permitidos para la facturación" ;
			   $data["factura"] = $rs;
			   echo JSON_ENCODE($data);


			}else{
			
				$concep = $this->Facturacion_model->conceptos_Venta($idVenta);
				
				
				
				if($concep != null){
					
					
					
					
					$rutaImagen = "http://sdiqro.store/static/publico/img/sdi_logo.png";
					$contenido = file_get_contents($rutaImagen);
					$imagenBase64 = base64_encode($contenido);
				
					
				   $data['resultado'] = $rs != null;
				   $data['mensaje'] = $data['resultado'] ? "Se encontro la la compra se inicia proceso de facturacion" : "Verifica los datos, no se ha encontrado la compra";
				   $data["factura"] = $rs;
				   $data['conceptos'] = $concep;
				   $data['imagen'] = $imagenBase64;
				   echo JSON_ENCODE($data);
					
					
				}else{
					
				
					
					 $data['resultado'] = $rs != null;;
				     $data['mensaje'] = "Esta compra no tiene detalles de compra, contacta con el administrador";
					
					echo JSON_ENCODE($data);
					
					
				}
					
			}
		
}
	
	
	
	/* Datos fiscales  */
	
	
	
	/* regimen fiscal */
	public function getrFiscal() {
        $rs = $this->Perfil_model->get_rFiscal();
       
        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Regimen Fiscal encontrados" : "No se encontraron datos";
        $data["rFiscal"] = $rs;

        echo JSON_ENCODE($data);
    
    }
	
	
	/* termina regimen fiscal */
		
		
		/* detalle regimen fiscal */
	
	  public function getUsoCFDI() {
        
        $rs = $this->Perfil_model-> get_UsoCDFI();
       
        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "usos encontrados" : "No se encontraron usos";
        $data["usoCFDI"] = $rs;

        echo JSON_ENCODE($data);  
    }

	
	/* termina detalle regimen fiscal */
		
		
		
		
		
	
	
	/* detalle regimen fiscal */
	
	  public function getDetalle() {
        $idR = $this->input->post("idRegimen") != NULL ? $this->input->post("idRegimen") : 0;
        $rs = $this->Perfil_model->get_Detalle($idR);
       
        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Detalles encontrados" : "No se encontraron detalles";
        $data["Detalle"] = $rs;

        echo JSON_ENCODE($data);  
    }

	
	/* termina detalle regimen fiscal */
		
		
		
	
	
	
	
	public function getDF() {
        $Usuario = $this->idUsuario;
		
		
        // echo $Usuario;
        // var_dump($_SESSION);
        // die();



        $rs = $this->Perfil_model->get_DF($Usuario);
        // echo "<pre>";
        // var_dump($this->db->last_query());
        // var_dump($rs);
        // die();
        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." datos fiscales" : "No se encontraron datos fiscales";
        $data["Fiscales"] = $rs;
        echo JSON_ENCODE($data); 
    }
	
	
	
	

    public function getDFiscal() {
        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);

        $rs = $this->Perfil_model->get_DFiscales($data['idU']);
        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." domicilios" : "No se encontraron domicilios";
        $data["Fiscales"] = $rs;
        echo JSON_ENCODE($data); 
    }
	
	
	
	public function validaVenta(){
		
		
		$idVenta = $this->input->post("idVenta");
		
		
		$rs = $this->Facturacion_model->valida_Venta($idVenta);
		
		
		$data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontro la venta" : "No existe esta venta";
		$data['valor'] = $rs;
       
        echo JSON_ENCODE($data); 
		
		
		
		
		
	}
	
	
	
	public function guardaFactura(){
		
		$datoFactura = $this->input->post("datoXML");
		$datoPDF = $this->input->post("datoPFD");
		$fecha = $this->input->post("fecha");
		$idVenta = $this->input->post("idVenta");
		$folio = $this->input->post("folio");
		$Rfc = $this->input->post("Rfc");
		$razonSocial = $this->input->post("Nombre");
		$DomicilioFiscalReceptor = $this->input->post("DomicilioFiscalReceptor");
		$RegimenFiscalReceptor = $this->input->post("RegimenFiscalReceptor");
		$UsoCFDI = $this->input->post("UsoCFDI");
		
		
		
		$xmlConver = (array)simplexml_load_string($datoFactura);
		
		
		
		
		
		
		$xmlConver["@attributes"]["PDF"]= $datoFactura;
		$xmlConver["@attributes"]["XML"]= $datoPDF ;
		$xmlConver["@attributes"]["rfcReceptor"]= $Rfc;
		$xmlConver["@attributes"]["razonSocial"]= $razonSocial;
		$xmlConver["@attributes"]["DomicilioFiscalReceptor"]= $DomicilioFiscalReceptor;
		$xmlConver["@attributes"]["RegimenFiscalReceptor"]= $RegimenFiscalReceptor;
		$xmlConver["@attributes"]["UsoCFDI"]= $UsoCFDI;
		
		
		
		
		/*
		echo "<pre>";
		var_dump("fecha: ". $fecha," folio: " . $folio, "rfc: " . $Rfc," idVenta: " . $idVenta);
		
		
		echo "<pre>";
		var_dump($xmlConver["@attributes"]);
		
		die();
		
		*/
		
			
		
		$actualizaVentaFactura = $this->Facturacion_model->actualizaVentaFactura($fecha,$folio,$Rfc, $idVenta);
		$insertaDatos = $this->Facturacion_model->insertaFactura($xmlConver["@attributes"]);
			
		
		$data['resultado'] = $insertaDatos != null || $actualizaVentaFactura != null;
		
        $data['mensaje'] = $data['resultado'] ? "Factura almacenada correctamente" : "ocurrio un error";
		$data['insertaDatos'] = $insertaDatos;
		$data['actualizaVentaFactura'] = $actualizaVentaFactura;
       
        echo JSON_ENCODE($data); 
			
		
	}
	
	
	public function datoFi(){
		
		
		$data["codigo"]=200;
		$data["mensaje"]= "controlador de prueba";
		
		
		
		
		echo JSON_ENCODE($data);

		
		
	}

	
	
	/* Termina datos fiscales */

}



?>