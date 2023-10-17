<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Documento sin título</title>
</head>

<body>
	
	
	<?php
		
			if($this->session->userdata('idusuario') !=0  && $this->session->userdata('token') != null){


				echo "Tienen una sesion abierta " . $_SESSION['nombreU'];

			}else{

				echo "No hay una session iniciada o no es valida";

			}
	
	?>
	
	<h1>Página publica de Inicio</h1>
	
	
	<button onClick="location.href='<?= base_url()?>registro';">Registro</button>
	
	<button onClick="location.href='<?= base_url()?>login';">Inicia Sesión</button>

	
	
	
</body>
</html>