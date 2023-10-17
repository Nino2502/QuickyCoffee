// JavaScript Document
$(document).ready(()=>{


console.log("ya estoy en contacto");

   
})




function enviarFormulario(){
	
	let validation = true;
	
   let correo = $.trim($("#correo").val());
   let nombre = $.trim($("#nombre").val());
   let mensaje = $.trim($("#mensaje").val());

	
 if(correo =='' || correo == null ){

	toastr['warning']('por favor coloca el correo ');
	validation = false;

 } 

 if(nombre =='' || nombre == null ){

	toastr['warning']('por favor coloca el nombre');
	validation = false;

 } 

 if(mensaje =='' || mensaje == null ){

	toastr['warning']('por favor coloca el mensaje');
	validation = false;

 } 

	
	
	if(validation){
	
		$.ajax({
			"url": base_url()+"public/Contacto/contactoEnviar",
			"dataType": "JSON",
			"type":"POST",
			"data":{
				correo: correo,
				nombre: nombre,
				mensaje: mensaje
			}
		})
		.done((data)=>{
			if(data.resultado){

				toastr["success"](data.mensaje);
				
				
				$("#formularioContacto").html(`
							<div class="form-group">
								<input class="form-control" type="text" placeholder="Nombre *" id="nombre">
							</div>
							<div class="form-group">
								<input class="form-control" type="email" placeholder="Email *" id="correo">
							</div>
							<div class="form-group">
								<textarea class="form-control" style="height: 150px;" placeholder="Mensaje *" id="mensaje"></textarea>
							</div>
							<div class="form-group">
								<input class="btn_1 full-width" value="Enviar" onclick="enviarFormulario()">
							</div>
						`);
				
				

			} else{
				toastr["warning"](data.mensaje);
				
			}
		})
		.fail();

	}


}