// JavaScript Document


$(document).ready(()=>{
	listaSucursal();
	
	
	
	$("#formularioDeRegistro").submit((e)=>{
		e.preventDefault();
		
		$('#errorNombre').hide();
		$('#errorApellidos').hide();
		$('#errorTelefono').hide();
		$('#errorCorreo').hide();
		$('#errorContrasenia').hide();
		$('#errorConfirmContrasenia').hide();

		let nombre = $("#nombre").val();
		let apellidos = $("#apellidos").val();
		let telefono = $("#telefono").val();
		let sucursal = $("#sucursalR").val();
		let correo = $("#correoR").val();
		let contrasenia = $("#contrasenia").val();
		let confirContrasenia = $("#confirmcontrasenia").val();
		
		let goValidation = true;

		var r = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);	
		
		
		if("" == confirContrasenia.trim()){
			$('#errorConfirmContrasenia').show();
			$('#errorConfirmContrasenia').html("Ingresa la confirmación de la contraseña");
			$('#confirmcontrasenia').focus();	
			goValidation = false;
		}else if(contrasenia.trim() != confirContrasenia.trim() ){
			
			$('#errorConfirmContrasenia').show();
			$('#errorConfirmContrasenia').html("Las contraseñas no son iguales");
			$('#confirmcontrasenia').focus();	
			goValidation = false;
			
		}
		
		if("" == contrasenia.trim() || contrasenia.length <5){
			$('#errorContrasenia').show();
			$('#errorContrasenia').html("Ingresa una contraseña mayor de 5 caracteres");
			$('#contrasenia').focus();	
			goValidation = false;
		}
		
		if("" == correo.trim()){
			$('#errorCorreo').show();
			$('#errorCorreo').html("Debes ingresar un correo");
			$('#correoR').focus();
			goValidation = false;	
		}else if(!(r.test(correo.trim()))){
			
			$('#errorCorreo').show();
			$('#errorCorreo').html("El correo introducido no es valido");
			$('#correoR').focus();	
			goValidation = false;
			}
		
		if("" == telefono.trim() || telefono.length < 10){
			$('#errorTelefono').show();
			$('#errorTelefono').html("Ingresa teléfono valido");
			$('#telefono').focus();
			goValidation = false;
		}

		if("Selecciona" == sucursal.trim()){
			$('#errorSucursal').show();
			$('#errorSucursal').html("Selecciona una sucursal");
			$('#sucursalR').focus();	
			goValidation = false;
		}
		
		if("" == apellidos.trim()){
			$('#errorApellidos').show();
			$('#errorApellidos').html("Ingresa tus apellidos");
			$('#apellidos').focus();	
			goValidation = false;
		}
		
		if("" == nombre.trim() || nombre.length < 3){
			$('#errorNombre').show();
			$('#errorNombre').html("Ingresa un nombre valido");
			$('#nombre').focus();	
			goValidation = false;
		}
		
		
		if(goValidation){


			$.ajax({
				"url": base_url()+"Registro/registrarse",
				"dataType":"json",
				"type":"post",
				"data":{
					"nombre":nombre,
					"apellidos": apellidos,
					"telefono": telefono,
					"idSuc" : sucursal,
					"correoElectronico": correo, 
					"contrasenia": contrasenia,
				}

			})
			.done((json)=>{
			
			
			if(json.resultado){
				console.log(json);
				let resultado = json.resultado;
				
				
				
				if(json.tipo_alerta  == "success"){
					toastr["success"](json.mensaje);
					console.log("Aqui te a redireccionar a login");
					
					/*
					
					Si el registro es correcto te va a redireccionar
					al login ... se supone
					*/
					
					window.setTimeout( () => {
						$(location).attr("href", base_url() + "login");
						
					}, 2000)
					
					

		
					
				}else if(json.tipo_alerta  == "warning"){
					
					toastr["warning"](json.mensaje);
					
					console.log("Un dato coincide");
				
				}
				else{
				
					toastr["warning"](json.mensaje);
					console.log("No sabemos que paso");
					
					
				
				}
				

                }
				
				
				
			
			
			
		})
		.fail( (xhr, textStatus, errorThrown) => {
			
			
			
            console.log(xhr);
            console.log(textStatus);
            console.log(errorThrown);    
			
			
		
            

        })
			
			
			
			

		}// termina go validation

		
	})// termina el click del boton registro
	
	
});


function listaSucursal() {
	$.ajax({
		url: base_url() + "api/SucursalesGet/getSucursalesQro",
		dataType: "JSON"
	})
	.done((data) => {
		$("#sucursalR").html("");
		if (data.resultado) {
			$("#labelsucursalR").find("select").append(`
				<option value="Selecciona">Selecciona una Sucursal</option>
			`);
			$.each(data.Registro, function (i, o) {
				$("#labelsucursalR").find("select").append(
					`
					<option value="` + o.idSuc + `">` + o.nombreSuc +`</option>
					`
				);

			});
			
		} else {
			$("#labelsucursalR").find("select").append(
				`
				<option value="Selecciona">No existen sucursales</option>
				`
			);
		}
	})
	.fail();
}
