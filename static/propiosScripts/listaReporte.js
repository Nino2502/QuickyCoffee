$(document).ready(function(){
	
	
	
	$("#rIdServicio").change(function(){
		
		let servicio = $("#rIdServicio").val();
		
		if(servicio != 1 ){
			
			$("#rIdEstatusCaso").prop('disabled', false);
			
			
		}else{
			
			$("#rIdEstatusCaso").prop('disabled', true);
			
		}
		
	});
	
	
	
	$("#tres-tab").click(function(){
		
	$("#modal-mensaje-validar").html("");
	$("#contenidoListaCard").html("");
		console.log("ya tubo que haber quitado el div de arriba");
	$("#totales").html("");
		
	$("#contenidoReporte").html("");
		
		
	$.ajax({
		"url":base_url()+"app/report/ver_reportes",
		"dataType": "json"
		
		
	})
	.done(function(obj){
		
		
		if(obj.respuesta){
			
			$("#contenidoReporte").append('<div class="row mb-4"><div class="col-12 mb-4"> <div class="card"><div class="card-body"><table id="reporteTable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;"><thead><tr><th>Fecha</th><th>Venta</th><th>Referencia</th><th>Nombre abogado</th><th>Pago</th><th>Porcentaje Aplicado</th></th></tr></thead><tbody id="bodyTabla"></tbody></table></div></div></div></div>');
			
			
			
				
				$.each(obj.reportes, function(i,p){
				
					
				
					
					let nombreCompleto = p.nombres_usuario + " " + p.apellidos_usuario;
					
					$("#contenidoReporte").find("tbody").append('<tr><td>'+p.fechaReporte+'</td><td class="text-center">'+p.idVenta+'</td><td>'+p.referencia+'</td><td>'+nombreCompleto+'</td><td class="text-center">'+p.pago+'</td><td class="text-center">'+(p.porcentaje * 100)+'%</td></tr>');
					
					//nombreUsuario = p.nombres_usuario+' ' + p.apellidos_usuario;

				});
				
			$("#reporteTable").DataTable(),$(".dataTables_length select").addClass("form-select form-select-sm");	
			
			
		}else{
			$("#contenidoReporte").html('no se encontraron reportes');
			
		}
		
		
		
	})
	.fail();
		
		
		




		
	})
	
	
	
	
	
	
	
	/*
	$("#first-tab").click(function(){
		$("#contenidoListaCard").html("");
		$("#totales").html("");
		});
	
	$("#second-tab").click(function(){
		
		$("#contenidoListaCard").html("");
		$("#totales").html("");

	});
	*/
	
})



function calcularPago(){
	$("#modal-mensaje-validar").html("");
	$("#contenidoListaCard").html("");
	$("#totales").html("");
	
		let comisionModal = $("#rIdComision").val();
		let idAbogado = $("#rIdAbogado").val(); 
		let idServicio = $("#rIdServicio").val();
		let idComision = "."+$("#rIdComision").val();
		let fechaInicio = $("#rFechaInicio").val();
		let fechaFin = $("#rFechaFin").val();
		var estatusCaso = $("#rIdEstatusCaso").val();
		let estatusPago = $("#rIdEstatusPago").val();
		let PagoCliente = $("#rIdEstatusPagoCliente").val();
	
	

	
	if("--Selecciona--" == $("#rIdAbogado").val()){
		$("#modal-mensaje-validar").append("Debes seleccionar un abogado");
	} else if( "--Selecciona--" == $("#rIdServicio").val()){
		$("#modal-mensaje-validar").append("Debes seleccionar un servicio");
	}else if($("#rIdComision").val() == ""){
		$("#modal-mensaje-validar").append("Debes escribir la comisión");
	}
	else{
		
/*		console.log(idAbogado,idServicio,idComision,fechaInicio,fechaFin,estatusCaso,estatusPago,PagoCliente);
*/		
	
	$.ajax({
		
		"url": base_url("app/report/listaPago"),
		"dataType": "json",
		"type":"post",
		"data":{
			idAbogado,
			idServicio,
			idComision,
			fechaInicio,
			fechaFin,
			estatusCaso,
			estatusPago,
			PagoCliente,
			
		}
		
		
		
		
	})
	.done(function(obj){
		
		let nombreP = null;
		let apellidosP = null;
		let clabeP = null;
		let bancoP = null;
		let correoP = null;
		
		if(obj.resultado){
			
			if(idAbogado != 0){

				if(obj.documentos != null){
					nombreP = obj.documentos[0]["nombres_usuario"];
					apellidosP = obj.documentos[0]["apellidos_usuario"];
					clabeP = obj.documentos[0]["clabe"];
					bancoP = obj.documentos[0]["banco"];
					correoP = obj.documentos[0]["correo_usuario"];
				}else if(obj.asesorias != null){
					nombreP = obj.asesorias[0]["nombres_usuario"];
					apellidosP = obj.asesorias[0]["apellidos_usuario"];
					clabeP = obj.asesorias[0]["clabe"];
					bancoP = obj.asesorias[0]["banco"];
					correoP = obj.asesorias[0]["correo_usuario"];
				}else if(obj.litigios != null){
					nombreP = obj.litigios[0]["nombres_usuario"];
					apellidosP = obj.litigios[0]["apellidos_usuario"];
					clabeP = obj.litigios[0]["clabe"];
					bancoP = obj.litigios[0]["banco"];
					correoP = obj.litigios[0]["correo_usuario"];
				}
			}
			
			
			$("#contenidoListaCard").append('<div class="row mb-4"><div class="col-12 mb-4"> <div class="card"><div class="card-body"><table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;"><thead><tr><th>venta</th><th>Fecha</th><th>Nombre</th><th>Servicio</th><th>Caso</th><th>P. Cliente</th><th>Costo</th><th>Comision</th><th>A Pagar</th><th>Estatus</th><th>'+(estatusPago != 2 ? 'Pagar': '')+'</th></tr></thead><tbody id="bodyTabla"></tbody></table></div></div></div></div>');
			
			
			let totalComisiones = 0;
			let totalPagar = 0;
			let totalVentas = 0;
			//let nombreUsuario = null;

			if(obj.documentos != null){
				
				
				
				
				$.each(obj.documentos, function(i,p){
				
					let com = p.costo * idComision;
					let sub = (p.costo)-(p.costo * idComision);
					
					if(p.estatusPago == "PAGADO" && p.liberado == 0 ){
						totalComisiones += com;
						totalPagar += sub;
						totalVentas += parseFloat(p.costo);
					}
					
					let nombreCompleto = p.nombres_usuario + " " + p.apellidos_usuario;
					
					$("#contenidoListaCard").find("tbody").append('<tr id="reg-'+p.idVenta+'"><td>'+p.idVenta+'</td><td>'+p.fecha+'</td><td>'+p.nombres_usuario+' ' + p.apellidos_usuario+'</td><td>'+p.nombre_servicio+'</td><td>cerrado</td><td>'+p.estatusPago+'</td><td>'+p.costo+'</td><td>$'+ com +'</td><td>$'+sub+'</td><td>'+(p.liberado == "0" ? 'Por Pagar': 'Liberado')+'</td><td>'+(p.liberado == "0" && p.estatusPago == "PAGADO" ? '<button type="button" class="btn btn-secondary" onClick="abreModalReporte(\''+p.idVenta+'\',\''+nombreCompleto+'\',\''+p.costo+'\',\''+com+'\',\''+sub+'\',\''+p.banco+'\',\''+p.clabe+'\',\''+idComision+'\')">Pagar</button>': '')+'</td></tr>');
					
					//nombreUsuario = p.nombres_usuario+' ' + p.apellidos_usuario;

				});
				
			}
			if(obj.asesorias != null){
				
				$.each(obj.asesorias, function(i,p){
				
					let com = p.costo * idComision;
					let sub = (p.costo)-(p.costo * idComision);
					
					if(p.estatusPago == "PAGADO" && p.liberado == "0" && p.Confirmacion_abogado == "1" && p.Confirmacion_cliente == "1" ){

					totalComisiones += com;
					totalPagar += sub;
					totalVentas += parseFloat(p.costo);
					}
					
					/*console.log(p.idVenta, p.Confirmacion_abogado, p.Confirmacion_cliente );*/
					let nombreCompleto = p.nombres_usuario + " " + p.apellidos_usuario;
					
					$("#contenidoListaCard").find("tbody").append('<tr id="reg-'+p.idVenta+'"><td>'+p.idVenta+'</td><td>'+p.fecha+'</td><td>'+p.nombres_usuario+' ' + p.apellidos_usuario+'</td><td>'+p.nombre_servicio+'</td><td>'+(p.Confirmacion_abogado == "0" || p.Confirmacion_cliente == "0" ? "Abierto": "Cerrado")+'</td><td>'+p.estatusPago+'</td><td>'+p.costo+'</td><td>$'+ com +'</td><td>$'+sub+'</td><td>'+(p.liberado == "0" ? 'Por Pagar': 'Liberado')+'</td><td>'+(p.liberado == "0" && p.estatusPago == "PAGADO" && p.Confirmacion_abogado == "1" && p.Confirmacion_cliente == "1" ? '<button type="button" class="btn btn-secondary" onClick="abreModalReporte(\''+p.idVenta+'\',\''+nombreCompleto+'\',\''+p.costo+'\',\''+com+'\',\''+sub+'\',\''+p.banco+'\',\''+p.clabe+'\',\''+idComision+'\')">Pagar</button>': '')+'</td></tr>');

				});
				
			}
			if(obj.litigios != null){
				
				$.each(obj.litigios, function(i,p){
				
					let com = p.costo * idComision;
					let sub = (p.costo)-(p.costo * idComision);
					
					if(p.estatusPago == "PAGADO" && p.liberado == 0 && p.Confirmacion_abogado == "1" && p.Confirmacion_cliente == "1" ){
						totalComisiones += com;
						totalPagar += sub;
						totalVentas += parseFloat(p.costo);
						 
					}
					
					/*console.log("venta",p.idVenta,"liberado",p.liberado, "estatus", p.estatusPago,"CA", p.Confirmacion_abogado, "cC", p.Confirmacion_cliente);*/
					
					let nombreCompleto = p.nombres_usuario + " " + p.apellidos_usuario;


					$("#contenidoListaCard").find("tbody").append('<tr id="reg-'+p.idVenta+'"><td>'+p.idVenta+'</td><td>'+p.fecha+'</td><td>'+p.nombres_usuario+' ' + p.apellidos_usuario+'</td><td>'+p.nombre_servicio+'</td><td>'+(p.Confirmacion_abogado == "0" || p.Confirmacion_cliente == "0" ? "Abierto": "Cerrado")+'</td><td>'+p.estatusPago+'</td><td>'+p.costo+'</td><td>$'+ com +'</td><td>$'+sub+'</td><td>'+(p.liberado == "0" ? 'Por Pagar': 'Liberado')+'</td><td>'+(p.liberado == "0" && p.estatusPago == "PAGADO" && p.Confirmacion_abogado == "1" && p.Confirmacion_cliente == "1" ? '<button type="button" class="btn btn-secondary" onClick="abreModalReporte(\''+p.idVenta+'\',\''+nombreCompleto+'\',\''+p.costo+'\',\''+com+'\',\''+sub+'\',\''+p.banco+'\',\''+p.clabe+'\',\''+idComision+'\')">Pagar</button>': '')+'</td></tr>');

				});
				
			}
			
			$("#totales").html('<div class="form-group col-md-3 "><h5 class="mb-2"><strong>Total:</strong></h5><h5 class="mb-2">$<span id="mtotalVentas">'+(totalVentas.toFixed(2))+'</span></h5> </div><div class="form-group col-md-3 "><h5 class="mb-2"><strong>Comisión Total:</strong></h5><h5 class="mb-2">$<span id="mtotalComisiones">'+(totalComisiones.toFixed(2))+'</span></h5> </div><div class="form-group col-md-3 "><h5 class="mb-2"><strong>Total a pagar:</strong></h5><h5 class="mb-2" id="totalPagar">$<span id="mtotalPagar">'+(totalPagar.toFixed(2))+'</span></h5> </div><div><input type="hidden" id="hTotal" value="'+totalVentas+'"><input type="hidden" id="hComisionTotal" value="'+totalComisiones+'"><input type="hidden" id="hTotalPagar" value="'+totalPagar+'"></div>');
			
			if(idAbogado != 0 ){
				
				$("#totales").append('<div class="form-group col-md-3 "><!--<button class="btn btn-outline-primary active">Reportar pago total</button> --></div><div class="form-group col-md-12 "><h4>'+nombreP+' '+apellidosP+'  <strong> Clabe: </strong>'+ clabeP+' <strong> Banco: </strong> '+bancoP+'  <strong> correo: </strong>' + correoP +'</h4> </div>');
				
			}
			
			
			$("#datatable").DataTable(),$(".dataTables_length select").addClass("form-select form-select-sm");	
			
	
		}// termina if 
		else{
					
			$("#contenidoListaCard").html("No se encontraron elementos para mostrar en la busqueda. ");
			
			
		}
		
	})
	.fail();
		
	}
	
}

function abreModalReporte(venta, nombre, costo, com, pago, banco, clabe, porcentaje){
	
$("#tituloReporte").html("");
$("#bodyReportePago").html("");
$("#ModalTotales").html("");
	

 //console.log('cerrar modal')
$('#modal-reportarPago').modal('show');

$("#tituloReporte").html('<h5 class="modal-title w-100">¿Quieres registrar el pago de la venta '+ venta +'?</h5>');

$("#bodyReportePago").html('<p>Nombre: '+nombre+'</p><p>Pago: $'+pago+'</p><p>Banco:'+banco+'</p><p>Clabe: '+clabe+'</p> <input type="hidden" id="hCostoSer" value="'+costo+'"> <input type="hidden" id="hComisionSer" value="'+com+'"> <input type="hidden" id="hPagoSer" value="'+pago+'"><input type="hidden" id="hPorcentajeSer" value="'+porcentaje+'">')


$("#btn-reporte-enviar").attr("data-idVenta-reporte", venta);
	
$("#comentario-reporte").val("");

	
}


function enviaReporte(){
	
	let venta = $("#btn-reporte-enviar").attr("data-idVenta-reporte");
	let referencia = $("#comentario-reporte").val();
	let hCostoSer = $("#hCostoSer").val();
	let hComisionSer = $("#hComisionSer").val();
	let hPagoSer = $("#hPagoSer").val();
	let hPorcentajeSer = $("#hPorcentajeSer").val();
	
	$.ajax({
		"url":base_url()+"app/report/enviarPago",
		
		"dataType":"json",
		"type":"post",
		"data":{
			idVenta: venta,
			referencia: referencia,
			hCostoSer : hCostoSer,
			hComisionSer : hComisionSer,
			hPagoSer : hPagoSer,
			hPorcentajeSer : hPorcentajeSer,
			
			
		}
		
		
	})
	.done(function(obj){
		
		
		
		
		if(obj.respuesta){
			
			toastr[obj.response_type](obj.message);
			
			
			let oldTotal = $("#hTotal").val();
			let oldComisiones = $("#hComisionTotal").val();
			let oldTotalPagar = $("#hTotalPagar").val();
			
		
			let nuevototalVentas = oldTotal - hCostoSer;
			let nuevototalComisiones = oldComisiones - hComisionSer;
			let nuevototalPagar = oldTotalPagar - hPagoSer;
			
			
			
			$("#totales").html('<div class="form-group col-md-3 "><h5 class="mb-2"><strong>Total:</strong></h5><h5 class="mb-2">$<span id="mtotalVentas">'+nuevototalVentas+'</span>.00</h5> </div><div class="form-group col-md-3 "><h5 class="mb-2"><strong>Comisión Total:</strong></h5><h5 class="mb-2">$<span id="mtotalComisiones">'+nuevototalComisiones+'</span>.00</h5> </div><div class="form-group col-md-3 "><h5 class="mb-2"><strong>Total a pagar:</strong></h5><h5 class="mb-2" id="totalPagar">$<span id="mtotalPagar">'+nuevototalPagar+'</span>.00</h5> </div><div><input type="hidden" id="hTotal" value="'+nuevototalVentas+'"><input type="hidden" id="hComisionTotal" value="'+nuevototalComisiones+'"><input type="hidden" id="hTotalPagar" value="'+nuevototalPagar+'"></div>');
			
			

			$('#reg-'+venta).remove();
			
			
			$('#modal-reportarPago').modal('hide');
			
			
			
		}else{
			toastr[obj.response_type](obj.message);
			console.log("entra en el else");
		}
		
		
	})
	.fail();
	
}



function verReportes(){
	
	
	
	
	
	
	
	
	
	
	
}
















