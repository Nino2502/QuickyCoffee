// JavaScript Document

$(document).ready(()=>{
	
	
	
	
	
	
});



function btnFacturar(){
	
	
	
	 $("#errorselectRFC").hide();
	
	let goValidation = true;
	let rfc = $("#selectRFC").val();
	let idUsuario = $("#idU").val();
	let idVenta = $("#idVen").val();
	
	console.log(rfc);
	
	
	if(rfc == "Selecciona"){
		
		$('#errorselectRFC').show();
		 $('#errorselectRFC').html("Selecciona un RFC de tu lista o elige continuar sin RFC para capturarlo manualmente");
        $('#selectRFC').focus();	
        goValidation = false;
	
	}

	
	if(goValidation){
		
		
			
			    $.ajax({
					"url": base_url()+"public/Facturacion/facturarCompra",
					"dataType": "JSON",
					"type":"POST",
					"data":{
						"idU":$("#idU").val(),
						"idVen":$("#idVen").val(),
						"rfc": rfc
					}
				})
				.done((data)=>{
					
					
					 if(data.resultado){

						$(location).attr('href', base_url()+'public/Facturacion/cargaDatosFactura/'+idVenta+'/'+data.detalleVenta[0].fechaCompra+'/'+data.detalleVenta[0].TotalVenta+'/'+data.detalleVenta[0].tokenVEnta+'/'+(rfc == "sinRfc" ? "" : data.Fiscales[0].rSocial+'/'+data.Fiscales[0].RFC+'/'+data.Fiscales[0].correo+'/'+data.Fiscales[0].codigoPostal+'/'));
						

					} else{
						toastr["warning"](data.mensaje);
					}
					
					
					
					
				})
				.fail();
	
		
		
	}
	
	
	
}