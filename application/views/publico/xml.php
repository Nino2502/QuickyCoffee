
	
<?php 
	
	
	var_dump($xml);
	die();
	
	
	if(isset($xml)){
		
		if($xml != NULL){
			echo $xml->pdf;
		}else{
			echo "No hay información para mostrar";
		}
		
		
	}else{
		echo "No hay información para mostrar";
	}
	
	
?>	
	
