<?php 

class DetalleVenta extends CI_Controller {
	
	
	
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('daniw/Perfil_model');
        $this->load ->model('daniw/Home_model');
	}
	
	
	
	
	public function detalle($idUsuario = 0, $idVenta = 0, $idToken = ""){
		
		
		
		
		
		if($idUsuario == 0 || $idVenta == 0 || $idToken == "" ){
		
			$data["comprueba"] = false;
		
			$mpdf = new \Mpdf\Mpdf([
				'mode' => 'utf-8',
				'margin_top' => 25

			]);

			$html = $this->load->view('publico/ventaDetalle', $data , true);
			$mpdf->WriteHTML($html);
			$mpdf->Output('detalleVentaError.pdf', 'I');
			
		}else{
			
			$data["comprueba"] = true;
			
			$usuario = $idUsuario;
			$id = $idVenta;
			
			

			$rs = $this->Home_model->get_DetalleVentaPublico($idUsuario,$idVenta,$idToken);
			$data["detalleVenta"] = $rs; 
			
			$datosVentaFactura = $this->Home_model->get_datos_factura($idUsuario,$idVenta,$idToken);
			$data["datosVentaFactura"] = $datosVentaFactura;
			
			
			if($rs != NULL){
				
				if($rs[0]->Factura != NULL){
					$Datosfiscales = $this->Home_model->datoFactura($usuario);
					
					$Datosfiscales != NULL ? $data["Fiscales"] = $Datosfiscales : "";
					
				}
				
				$mpdf = new \Mpdf\Mpdf([
				'mode' => 'utf-8',
				'margin_top' => 25

			]);


			//$header = $this->load->view('private/fragments/GenerarReporte/headerPDF', $data , true); 
			//$mpdf->SetHeader($header);
			//$mpdf->SetFooter('<div style="text-align: center;">Página {PAGENO}</div>');

			$html = $this->load->view('publico/ventaDetalle', $data , true);
			$mpdf->WriteHTML($html);
			$mpdf->Output('detalleVenta'.$id.'.pdf', 'I');
			$html = $this->load->view('publico/ventaDetalle', $data , true);

				
				
			}else{
			
			
			$data["comprueba"] = false;
		
				$mpdf = new \Mpdf\Mpdf([
					'mode' => 'utf-8',
					'margin_top' => 25

				]);

				$html = $this->load->view('publico/ventaDetalle', $data , true);
				$mpdf->WriteHTML($html);
				$mpdf->Output('detalleVentaError.pdf', 'I');
			
		} 

			

		}
		
	
	}
	
	
	public function satRepresentacion($idUsuario = 0, $idVenta = 0, $idToken = ""){
		
		
		
		if ( $idUsuario == 0 || $idVenta == 0 || $idToken == "" ) {


			$data["comprueba"] = false;
		
			$mpdf = new \Mpdf\Mpdf([
				'mode' => 'utf-8',
				'margin_top' => 25

			]);

			$html = $this->load->view('publico/ventaDetalle', $data , true);
			$mpdf->WriteHTML($html);
			$mpdf->Output('detalleVentaError.pdf', 'I');


		} else {


			$datosVentaFactura = $this->Home_model->get_datos_factura($idUsuario,$idVenta,$idToken );

			if ( $datosVentaFactura != null ) {
				# Define the Base64 string of the PDF file
				// Decodifica el texto en base64 a datos binarios
				$pdfBinaryData = base64_decode( $datosVentaFactura->XML );

				// Genera un nombre único para el archivo temporal
				$tempFileName = 'temp_pdf_' . uniqid() . '.pdf';

				// Ruta completa para el archivo temporal
				$tempFilePath = FCPATH . 'temp/' . $tempFileName;

				// Guarda los datos binarios en el archivo temporal
				file_put_contents( $tempFilePath, $pdfBinaryData );

				// Carga la biblioteca 'download'
				$this->load->helper( 'download' );

				// Descarga el archivo PDF
				force_download( $tempFileName, $pdfBinaryData );

			} else {

				$data["comprueba"] = false;
		
				$mpdf = new \Mpdf\Mpdf([
					'mode' => 'utf-8',
					'margin_top' => 25

				]);

				$html = $this->load->view('publico/ventaDetalle', $data , true);
				$mpdf->WriteHTML($html);
				$mpdf->Output('detalleVentaError.pdf', 'I');

			}



		}
		
		
	}
	
	
	
	public function xml($idUsuario = 0, $idVenta = 0, $idToken = ""){
		
		
		
		if ( $idUsuario == 0 || $idVenta == 0 || $idToken == "" ) {


			$data["comprueba"] = false;
		
			$mpdf = new \Mpdf\Mpdf([
				'mode' => 'utf-8',
				'margin_top' => 25

			]);

			$html = $this->load->view('publico/ventaDetalle', $data , true);
			$mpdf->WriteHTML($html);
			$mpdf->Output('detalleVentaError.pdf', 'I');


		} else {


			$datosVentaFactura = $this->Home_model->get_datos_factura($idUsuario,$idVenta,$idToken);
			
			

			if ( $datosVentaFactura != NULL ) {
				
				$tempFileName = 'temp_pdf_' . uniqid() . '.xml';
				
				$tempFilePath = FCPATH . 'temp/' . $tempFileName;
				file_put_contents($tempFilePath,  $datosVentaFactura->PDF);
				
				$this->load->helper( 'download' );

				// Descargar el archivo XML
				force_download($tempFileName, file_get_contents($tempFilePath));
				

			} else {

				$data["comprueba"] = false;
		
				$mpdf = new \Mpdf\Mpdf([
					'mode' => 'utf-8',
					'margin_top' => 25

				]);

				$html = $this->load->view('publico/ventaDetalle', $data , true);
				$mpdf->WriteHTML($html);
				$mpdf->Output('detalleVentaError.pdf', 'I');

			}



		}
		
		
	}
	
	
	
}



