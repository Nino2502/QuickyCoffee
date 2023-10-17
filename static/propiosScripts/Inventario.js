$(document).ready(()=>{

	listaSucursales();

    //alert("ya estamos aqui");
    $("#datatable").find("tbody").html("");

        
	
       

$("#selectSucursales").change((e)=>{

	e.preventDefault();

	let sucursal = $("#selectSucursales").val();

	console.log(sucursal);


	if(sucursal != "0"){

		listaInventario(sucursal);

	}else{

		$("#despliegueTabla").html("No haz seleccionado ninguna sucursal");

	}

});
	
	


});


function listaServicios(){

	axios(base_url()+"app/Servicios/verCatServicios")
	.then(({data})=>{

		if(data.resultado){

			$("#selectListaServicios").html('<option value="0" label="&nbsp;">&nbsp;</option>');

			$.each(data.catServicios, function(i,c){

					$.ajax({
						"url":base_url()+"app/Servicios/verServicios",
						"dataType":"JSON"

					})
					.done((data)=>{

						if(data.resultado){


							$("#selectListaServicios").append(`
									<optgroup label="`+c.nombreCS+`"> 

								`
								);


								$.each(data.Servicios, function(i,o){

									if(c.idCS == o.idCS){
										$("#selectListaServicios").append(`
											<option data-idCat="`+o.idCS+`" value="`+o.idS+`">`+o.nombreS+`</option>
										`
									);

									}

								});

								$("#selectListaServicios").append(`

								</optgroup>  
								`
								);
							}

					})
					.fail();

			});



			$("#datatable").DataTable(),$(".dataTables_length select").addClass("form-select form-select-sm");	

		}else{

			$("#despliegueTabla").html(data.mensaje);

		}


	})
	.catch(error=>{
		console.log(error);
	})



} // termina lista de servicios




function listaSucursales(){
	
	$.ajax({
		"url":base_url()+"app/Sucursales/verSucursales",
		"dataType":"JSON"
	})
	.done((data)=>{

		if(data.resultado){
			$("#selectSucursales").html('<option value="0" label="&nbsp;">&nbsp;</option>');
			
			
			$.each(data.sucursales, function(i,o){
				
				
				$("#selectSucursales").append(`<option value="`+o.idSuc+`">`+o.nombreSuc+`</option>`);
				
				
			})

			
		}else{
			
			$("#selectSucursales").html('<option label="&nbsp;">&nbsp;</option><option>No hay sucursales creadas</option>');
		
		}
		
		
	})
	.fail();
	
}




function listaSucursalesTranspaso(idSuc){
	
	$.ajax({
		"url":base_url()+"app/Sucursales/verSucursales",
		"dataType":"JSON"
	})
	.done((data)=>{

		if(data.resultado){
			$("#selectListaSucrusalesT").html('<option value="0" label="&nbsp;">&nbsp;</option>');
			
			
			$.each(data.sucursales, function(i,o){
				
				if(idSuc != o.idSuc){
				$("#selectListaSucrusalesT").append(`<option value="`+o.idSuc+`">`+o.nombreSuc+`</option>`);
				}
				
			})

			
		}else{
			
			$("#selectListaSucrusalesT").html('<option label="&nbsp;">&nbsp;</option><option>No hay sucursales creadas</option>');
		
		}
		
		
	})
	.fail();
	
}






        
function listaInventario(idSuc){


	$.ajax({
		"url":base_url()+"app/Inventario/verInventario",
		"type":"POST",
		"dataType":"JSON",
		"data":{
			"idSuc":idSuc

		}
	})
	.done((data)=>{
		//console.log("llegue al done");

			if(data.resultado){
			console.log(data);

				$("#despliegueTabla").html(`
				<table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<th>id</th>
							<th>Nombre</th>
							<th>Descripción</th>
							<th>Sucursal</th>
							<th>Inventario</th>


							
							
							<th style="text-align: center">Modificar</th>
							<th style="text-align: center">Transpasar</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>`
				);

				$.each(data.Inventario, function(i,o){

					$("#datatable").find("tbody").append(`
						<tr id="">
							<td>`+o.idS+`</td>
							<td>`+o.nombreS+`</td>
							<td>`+o.desS+`</td>
							<td>`+o.nombreSuc+`</td>
							<td>`+o.inventario+`</td>


							<td align="center"><a href="#" onclick="editar('`+o.idS+`','`+ o.idSuc+`','`+o.nombreS+`','`+o.nombreSuc+`','`+o.inventario+`')"><i class="fas fa-pencil fa-2x"></i></a> </td>
							<td align="center"><a href="#" onclick="transpaso('`+o.idS+`','`+ o.idSuc+`','`+o.nombreS+`','`+o.nombreSuc+`','`+o.inventario+`')"><i class="fa fa-arrows-h fa-2x"></i></a> </td>





						</tr>`
					);

				});


				$("#datatable").DataTable(),$(".dataTables_length select").addClass("form-select form-select-sm");	

			}else{

				$("#despliegueTabla").html(data.mensaje);

			}



	})
	.fail(()=>{
			(toastr["danger"]("Ha ocurrido un error vuelve a intentar"));
			//$("#btnEnviar, #nombreInventario, #descripcionInventario, #precioInventario, #subServicioCheck, #selectCategoriaInventario", "#selectformularioDiagnostico").removeAttr("disabled");
	});





} // termina lista de inventario
    



    
    
function insertaInventario(){

	quitaErroresCamposVacios();

	$("#btnEnviar, #cantidad, #selectListaServicios").attr("disabled", "disabled");


	let sucursal = $("#selectSucursales").val();
	let cantidad = $("#cantidad").val();
	let servicio = $("#selectListaServicios").val();

	let accion = $("#accion").val();
	let goValidation = true;

	
	let nombreSucE = ($("#selectSucursales option:selected").text());
	let nombreServicio = ($("#selectListaServicios option:selected").text());
	




	if(accion == "editar"){
		estatus = $("#estatusModal").val();
	}

	if(cantidad <= 0){
		$('#errorcantidad').show();
		$('#errorcantidad').html("La cantidad no debe ser menor de 0");
		$('#cantidad').focus();	
		goValidation = false;
		$("#btnEnviar, #cantidad, #selectListaServicios").removeAttr("disabled"); 
	}

	if(servicio <= 0){
		$('#errorselectListaServicios').show();
		$('#errorselectListaServicios').html("Selecciona un servicio");
		$('#selectListaServicios').focus();	
		goValidation = false;
		$("#btnEnviar, #cantidad, #selectListaServicios").removeAttr("disabled"); 
	}



	if(goValidation){


		console.log("paso la validacion");

			let sucursal = $("#selectSucursales").val();
			let cantidad = $("#cantidad").val();
			let servicio = $("#selectListaServicios").val();


		   $.ajax({
				"url":base_url()+"app/Inventario/existeInventario",
				"type":"POST",
				"dataType":"JSON",
				"data":{
					idS:servicio,
					idSuc:sucursal
				}
			})
			.done((data)=>{


				if(data.resultado){

					console.log(data);

					toastr["warning"]("Ya existe un inventario de este producto en esta sucursal");

					$("#btnEnviar, #cantidad, #selectListaServicios").removeAttr("disabled");




				}else{

				   $.ajax({
						"url":base_url()+"app/Inventario/insertaInventario",
						"type":"POST",
						"dataType":"JSON",
						"data":{
							idS:servicio,
							idSuc:sucursal,
							inventario:cantidad,
							nombreSucE :nombreSucE,
							nombreServicio : nombreServicio 

						}
					})
					.done((data)=>{


						if(data.resultado){

							console.log(data);
							toastr["success"](data.mensaje);

							listaInventario(sucursal);

							cierraAgregaInventario();


							$("#btnEnviar, #cantidad, #selectListaServicios").removeAttr("disabled");

							//$("#addRecordForm")[0].reset();

						}else{

							toastr["warning"](data.mensaje);
							$("#btnEnviar, #cantidad, #selectListaServicios").removeAttr("disabled");

						}
					})
					.fail(()=>{
						(toastr["danger"]("Ha ocurrido un error vuelve a intentar"));
						$("#btnEnviar, #nombreInventario, #descripcionInventario, #precioInventario, #subServicioCheck, #selectCategoriaInventario", "#selectformularioDiagnostico").removeAttr("disabled");
					});

				}
			})
			.fail(()=>{
				(toastr["danger"]("Ha ocurrido un error vuelve a intentar"));
				$("#btnEnviar, #nombreInventario, #descripcionInventario, #precioInventario, #subServicioCheck, #selectCategoriaInventario", "#selectformularioDiagnostico").removeAttr("disabled");
			});





	}

} // termina insertar servicio







function cierraAgregaInventario(){
	
	let agregaInventario = document.getElementById("nuevoInventario");
	agregaInventario.style.display='none';
	
	$("#divCantidadAgregaInv").html(`
			<label for="message-text" class="col-form-label">cantidad</span></label>
			<input type="number" class="form-control" id="cantidad">
			<small class="text-danger" id="errorcantidad" style="display: none;"></small>
	`)
	
	
}


    
function agregar(){
	//$(location).attr("href",base_url()+"app/AgregarInventario")

	quitaErroresCamposVacios();



	let sucursal = $("#selectSucursales").val();

	//console.log(sucursal);

	if(sucursal != 0){

		listaServicios();



		$("#nomsucursal").html($("#selectSucursales option:selected").text());

		$("#btnEnviar").html("btnAgregaInv");
		//$('#ModalAgregar').modal('show');
		$("#nombreAgregaInv").html("Agregar al inventario");


		$("#accionAI").val("Agregar");
		$("#idS").val("0");

		let agregaInventario = document.getElementById("nuevoInventario");
		agregaInventario.style.display='block';



	}else{

		toastr["warning"]("Debes elegir una sucursal.");

	}


} // termina modal agregar tipo de pago




function transpaso(idS, idSuc, nombreS, nombreSuc, canInventario){
	
	listaSucursalesTranspaso(idSuc);
	
	quitaErroresTranspaso();
	
	 let sucursal = $("#selectSucursales").val();
	 if(sucursal != 0){
		 
		 
		 	$("#divCantidad").html( '<input type="number" class="form-control" id="cantidadT">');
		 	$("#div-modal-comentario-transpaso").html(`<textarea class="form-control" rows="2"  id="comentariotranspaso"></textarea>`);
			$("#btnEnviarT").html("Transpasar");
			$("#accionT").val("trasnpasar");
		 	$("#idT").val(idS);
		 	$("#idTSuc").val(idSuc);
			$("#nombreModalT").html("Transpasar inventario de: "+nombreS);
			$("#nomServicio").html(nombreS);
			$("#cantidadInventario").html(canInventario);
		 	$("#nomSucursalT").html(nombreSuc);
		 	$("#inputNombreSuc").val(nombreSuc);
			$('#ModalTranspasar').modal('show');
		 	$("#cantidadAnterior").val(canInventario);
		 	$("#nombreServicio").val(nombreS);
		 
		 




		}else{

			toastr["warning"]("Debes elegir una sucursal.");

		}
}


function insertaTranspaso(){
	
	quitaErroresTranspaso();
	
	$("#cantidadT, #selectListaSucrusalesT, #btnEnviarT").attr("disabled", "disabled");

	let comentariotranspaso = $("#comentariotranspaso").val();
	let idServicio = $("#idT").val();
	let idSucAnterior = $("#idTSuc").val();
	let nombreSucAnterior = $("#inputNombreSuc").val();
	let sucursalNueva = $("#selectListaSucrusalesT").val();
	let cantidad = $("#cantidadT").val();
	let goValidation = true;
	let cantidadAnterior = $("#cantidadAnterior").val();
	let nombreServicio = $("#nombreServicio").val();
	let nombreSucnueva = $( "#selectListaSucrusalesT option:selected" ).text();
	
	
	console.log(nombreSucnueva, nombreSucAnterior);
	
		if(cantidad <= 0){
		$('#errorcantidadT').show();
		$('#errorcantidadT').html("La cantidad del transpaso debe ser mayor a 0");
		$('#cantidadT').focus();	
		goValidation = false;
		$("#cantidadT, #selectListaSucrusalesT, #btnEnviarT").removeAttr("disabled"); 
		}else if(parseInt(cantidad) > parseInt(cantidadAnterior) ){
			
			$('#errorcantidadT').show();
			$('#errorcantidadT').html("La cantidad no puede ser mayor al inventario actual");
			$('#cantidadT').focus();	
			goValidation = false;
			$("#cantidadT, #selectListaSucrusalesT, #btnEnviarT").removeAttr("disabled"); 
			
			
		}
	
	
	
	
	if(sucursalNueva == 0){
		$('#errorselectListaSucrusalesT').show();
		$('#errorselectListaSucrusalesT').html("Selecciona un servicio");
		$('#selectListaSucrusalesT').focus();	
		goValidation = false;
		$("#cantidadT, #selectListaSucrusalesT, #btnEnviarT").removeAttr("disabled"); 
		}
	
	
	
	console.log(idServicio, idSucAnterior, cantidad , sucursalNueva);

	if(goValidation){
			   
			   
			$.ajax({
				"url":base_url()+"app/Inventario/transpasoSucursal",
				"type":"POST",
				"dataType":"JSON",
				"data":{
					"idServicio":idServicio,
					"idSucAbterior":idSucAnterior,
					"nombreSucAnterior": nombreSucAnterior,
					"cantidad":cantidad,
					"sucursalNueva":sucursalNueva,
					"nombreSucNueva":nombreSucnueva,
					"nombreServicio":nombreServicio,
					"comentariotranspaso":comentariotranspaso
				}
			})
			.done((data)=>{ 
				
				if(data.resultado){
					
					$("#cantidadT, #selectListaSucrusalesT, #btnEnviarT").removeAttr("disabled"); 
					
					listaInventario(idSucAnterior);
					
					toastr["success"](data.mensaje);
					$('#ModalTranspasar').modal('hide');
					
				}else{
					
					toastr["warning"](data.mensaje);
					$("#cantidadT, #selectListaSucrusalesT, #btnEnviarT").removeAttr("disabled"); 
					
				}
			   
			   


			})
			.fail(()=>{
				(toastr["danger"]("Ha ocurrido un error vuelve a intentar"));
				$("#cantidadT, #selectListaSucrusalesT, #btnEnviarT").removeAttr("disabled"); 
			});
		

		
		
	}

	
	
}//termina inserta transpaso





function editar(idS, idSuc, nombreS, nombreSuc, canInventario ){
        
	quitaErroresEdicion();


	let sucursal = $("#selectSucursales").val();

	if(sucursal != 0){

	$("#btnEnviarE").html("Actualizar");
	$("#accionE").val("editar");
	$("#idE").val(idS);
	$("#idESuc").val(idSuc);
	$("#nombreModalE").html("Editar inventario de: "+nombreS);
	$("#nomServicioE").html(nombreS);
	$("#nombreServicioE").val(nombreS);
	
		
	$("#divCantidadE").html(`<input type="number" value="`+canInventario+`" class="form-control" id="cantidadE">`);
	$("#div-modal-comentario-editar").html(`<textarea class="form-control" rows="2"  id="comentarioEditar"></textarea>`);
	
	$("#nomSucursalE").html(nombreSuc);
	$("#inputNombreSucE").val(nombreSuc);

	$('#ModalEditar').modal('show');

	}else{

		toastr["warning"]("Debes elegir una sucursal.");
		$("#cantidadE, #btnEnviarE").removeAttr("disabled"); 
			

	}



} // temrina modal editar tipo de pago




//inicia  inserta edicion
function insertaEdicion(){
	
	
	
	
	quitaErroresEdicion();
	
	$("#cantidadE, #btnEnviarE").attr("disabled", "disabled");
	
	let comentarioEditar = $("#comentarioEditar").val();
	let idServicio = $("#idE").val();
	let idSucE = $("#idESuc").val();
	let nombreSucE = $("#inputNombreSucE").val();
	let cantidad = $("#cantidadE").val();
	let goValidation = true;
	let cantidadAnteriorE = $("#cantidadAnteriorE").val();
	let nombreServicio = $("#nombreServicioE").val();
	
	console.log(comentarioEditar);
	
		if(cantidad <= 0){
		$('#errorcantidadT').show();
		$('#errorcantidadT').html("La cantidad del transpaso debe ser mayor a 0");
		$('#cantidadT').focus();	
		goValidation = false;
			
		$("#cantidadE, #btnEnviarE").removeAttr("disabled"); 
			
		}else if(parseInt(cantidad) > parseInt(cantidadAnterior) ){
			
			$('#errorcantidadT').show();
			$('#errorcantidadT').html("La cantidad no puede ser mayor al inventario actual");
			$('#cantidadT').focus();	
			goValidation = false;
			$("#cantidadE, #btnEnviarE").removeAttr("disabled"); 
			
			
		}
	


	if(goValidation){
			   
			   
			$.ajax({
				"url":base_url()+"app/Inventario/editaInventarioSucursal",
				"type":"POST",
				"dataType":"JSON",
				"data":{
					"idServicio":idServicio,
					"idSucE":idSucE,
					"nombreSucE": nombreSucE,
					"cantidad":cantidad,
					"nombreServicio":nombreServicio,
					"comentarioEditar":comentarioEditar
				}
			})
			.done((data)=>{ 
				
				if(data.resultado){
					
					listaInventario(idSucE);
					
					toastr["success"](data.mensaje);
					$('#ModalEditar').modal('hide');
					$("#cantidadE, #btnEnviarE").removeAttr("disabled"); 
					
				}else{
					
					toastr["warning"](data.mensaje);
					$("#cantidadE, #btnEnviarE").removeAttr("disabled"); 
					
				}
			   
			   


			})
			.fail(()=>{
				toastr["warning"]("algo sucedio, intenta de nuevo");
				$("#cantidadE, #btnEnviarE").removeAttr("disabled"); 
			
			});
		

		
		
	}

	
	
	
	
	
	
}

//termina inserta edicion








function quitaErroresTranspaso(){
        $("#errorselectListaSucrusalesT").hide();
        $("#errorcantidadT").hide();
        
    }


function quitaErroresEdicion(){
        
        $("#errorcantidadE").hide();
        
    }




    function quitaErroresCamposVacios(){
        $("#errorselectListaSucrusales").hide();
        $("#errorcantidad").hide();
        
    }

