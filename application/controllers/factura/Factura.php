 <?php 

class Factura extends CI_Controller{
	
	
	public function __construct(){
		parent::__construct();
		
	}
	
	
	public function index(){
		echo "YA llegue al controlador";
	}
	

	
	public function datosFactura(){
		
		$datoFactura = $this->input->post("datoXML");
		$datoPDF = $this->input->post("datoPDF");
		$xmlConver = (array)simplexml_load_string($datoFactura);
		
		echo "<pre>";
		
		$atributos = $xmlConver["@attributes"];
		
		var_dump($atributos);
		var_dump($xmlConver);
		
		echo $xmlConver["@attributes"]["Version"]. "<br>";
		echo $xmlConver["@attributes"]["Serie"]. "<br>";
		echo $xmlConver["@attributes"]["Folio"]. "<br>";
		echo $xmlConver["@attributes"]["Fecha"]. "<br>";
		echo $xmlConver["@attributes"]["FormaPago"]. "<br>";
		
		
		var_dump($xmlConver);

		
		echo $datoFactura;
		
		echo "<br><br><br>";
		
		echo $datoPDF;
		
	}
	
	
	
}
?>