var datosGrafica;
$(document).ready(() => {
	listatipoatributos();
	precio_total();
	$("#cart_grafica").hide();

	let idTU = $("#idTU").val();


});
function creaGrafic_Echo_porKevinElChido() {
	$('#Echo_porKevinElChido').hide();
	$("#cart_grafica").show();

	// Extraer los datos del array proporcionado
	var data = datosGrafica.map(function (item) {
		return [item.nombre, parseFloat(item.cantidad)];
	});

	// Crear la gráfica de Highcharts
	Highcharts.chart('container', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: 0,
			plotShadow: false,
			type: 'pie' // Cambiamos el tipo de gráfico a pie
		},
		title: {
			text: 'Cantidad de Ingredientes'
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.y}</b>'
		},
		plotOptions: {
			pie: {
				dataLabels: {
					enabled: true,
					format: '{point.name}: <b>{point.y}</b>'
				},
				startAngle: -90,
				endAngle: 90,
				center: ['50%', '75%'],
				size: '110%'
			}
		},
		series: [{
			name: 'Cantidad',
			innerSize: '50%',
			data: data
		}]
	});

	creaGraficaBarras();
}
function creaGraficaBarras() {
    // Extraer los datos del array proporcionado
    var nombresIngredientes = datosGrafica.map(function(item) {
        return item.nombre;
    });

    var preciosIngredientes = datosGrafica.map(function(item) {
        return parseFloat(item.precio);
    });

    // Crear la gráfica de Highcharts
    Highcharts.chart('container33', {
        chart: {
            type: 'bar' // Gráfico de barras
        },
        title: {
            text: 'Precio de Ingredientes'
        },
        xAxis: {
            categories: nombresIngredientes, // Nombres de los ingredientes en el eje X
            title: {
                text: 'Ingrediente'
            }
        },
        yAxis: {
            title: {
                text: 'Precio'
            }
        },
        series: [{
            name: 'Precio',
            data: preciosIngredientes, // Precios de ingredientes en el eje Y
            colorByPoint: true // Asignar colores automáticamente a las barras
        }]
    });
}





function listatipoatributos() {
	//consumimos servicio para mostrar los tipos de contratacion
	axios(base_url() + "app/Inventario_pizza/verListaInventario")
		.then(({ data: Response }) => {
			console.log(Response);

			if (Response.resultado) {
				/**
				 * #despliegueTabla es el id de un div que se encuentra en la vista en TipoContratacion_view.php
				 * se pintara la tabla en el id: despliegueTabla
				 */
				//console.log("hooola", Response.listaIngredientes)
				datosGrafica = Response.listaIngredientes;
				console.log(datosGrafica);
				$("#despliegueTablaAtributos").html(`
         <table id="datatableAtributos" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
             <thead>
                 <tr>
                     <th>id</th>
                     <th>Ingrediente</th>
                     <th>Cantidad</th>
					 <th>Precio</th>
                     <th style="text-align: center">Estatus</th>
                     <th style="text-align: center">Editar</th>
                     <th style="text-align: center">Borrar</th>
                 </tr>
             </thead>
             <tbody>
         
             </tbody>
         </table>`);
				$.each(Response.listaIngredientes, function (i, o) {

					$("#datatableAtributos")
						.find("tbody")
						.append(
							`
                <tr id="tr-` +
							o.id_inventario +
							`">
                     <td>` +
							o.id_inventario +
							`</td>
                     <td>` +
							o.nombre +
							` 
								<td>` + (o.cantidad < 0 ? 0 : o.cantidad) + `</td>
								<td>` +
							o.precio +
							`</td>
                     
                     <td align="center"><a href="#" onclick="cambiaEstatus(` +
							o.id_inventario +
							`,'` +
							o.estatus +
							`')">` +
							(o.estatus == 1
								? '<i class="fas fa-toggle-on fa-2x"></i>'
								: '<i class="fas fa-toggle-off fa-2x"></i>') +
							`</a></td>
                     <td align="center"><a href="#" onclick="editar(` +
							o.id_inventario +
							`,'` +
							o.nombre +
							`','` +
							o.cantidad +
							`','` +
							o.precio +
							`')"><i class="fas fa-pencil fa-2x"></i></a> </td>
                     <td align="center"><a href="#" onclick="modalBorrar(` +
							o.id_inventario +
							`,'` +
							o.nombre +
							`','` +
							o.cantidad +
							`','` +
							o.precio +
							`')"><i class="fas fa-trash fa-2x"></i></a></td>
                 </tr>`
						);
				});
				$("#datatable").DataTable(),
					$(".dataTables_length select").addClass("form-select form-select-sm");
			} else {
				$("#despliegueTabla").html(Response.mensaje);
			}
		})
		.catch((error) => {
			console.log(error, "Error al cargar el controlador ");
		});
}
function InsertarColaborador() {
	/*
	 ModalTipoContratacion 
	*/

	quitaErroresCamposVacios();

	$(
		"#btnEnviar, #nombre_ingrediente,#cantidad_ingrediente"
	).attr("disabled", "disabled");

	let accion = $("#acccion").val();
	let id_inventario = $("#id_inventario").val();
	let nombre = $("#nombre_ingrediente").val();
	let cantidad = $("#cantidad_ingrediente").val();


	let precio = $("#precio_ingrediente").val();






	let goValidation = true;

	const validRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;



	if (accion == "editar") {


		if ("" == nombre.trim()) {

			$("#errornombreAtributo").show();
			$("#errornombreAtributo").html("Ingresa el nombre del ingrediente");
			$("#nombre_ingrediente").focus();
			goValidation = false;
			$(
				"#btnEnviar, #nombre_ingrediente,#cantidad_ingrediente").removeAttr("disabled");
		}

		if ("" == cantidad.trim()) {
			$("#errordescripcionAtributo").show();
			$("#errordescripcionAtributo").html("Ingresa la cantidad de productos");
			$("#cantidad_ingrediente").focus();
			goValidation = false;
		}
		if ("" == precio.trim()) {
			$("#errorPrecio").show();
			$("#errorPrecio").html("Ingresa el precio del producto");
			$("#precio_ingrediente").focus();
			goValidation = false;
		}






	} else {

		if ("" == nombre.trim()) {
			console.log("correo")
			$("#errornombreAtributo").show();
			$("#errornombreAtributo").html("Ingresa el nombre del producto");
			$("#nombre_ingrediente").focus();
			goValidation = false;
			$(
				"#btnEnviar, #nombreAtributo,#descripcionAtributo,#precioServicios,#tipoAtributos").removeAttr("disabled");
		}

		if ("" == cantidad.trim()) {
			$("#errordescripcionAtributo").show();
			$("#errordescripcionAtributo").html("Ingresa la cantidad de productos");
			$("#cantidad_ingrediente").focus();
			goValidation = false;
		}
		if ("" == precio.trim()) {
			$("#errorPrecio").show();
			$("#errorPrecio").html("Ingresa el precio del producto");
			$("#precio_ingrediente").focus();
			goValidation = false;
		}

		/*
		
		if (precio == 0) {
			console.log("Soi precio",precio)
			$("#errorprecioServicios").show();
			$("#errorprecioServicios").html(
				"Ingresa precio mayor a 0"
			);
			$("#precioServicios").focus();
			goValidation = false;
			
			$(
				"#btnEnviar, #nombreAtributo,#descripcionAtributo,#precioServicios,#tipoAtributos").removeAttr("disabled");
		}

		*/




	}

	let formbody = {};
	const IDUTU = $("#idTU").val();

	if (goValidation) {
		//para  superadministradores IDTU = 1
		// registra a los majors  como adminsitradores
		if (IDUTU == 1) {
			formbody = {
				id_inventario: id_inventario,
				nombre: nombre,
				cantidad: cantidad,
				precio: precio,

				accion: accion,



			}
		}

		if (formbody != null) {

			console.log("entro aquiii")
			console.log("formbody", formbody)



			axios
				.post(base_url() + "app/Inventario_pizza/insertarColaborador", formbody)
				.then(({ data }) => {
					if (data.resultado) {
						toastr["success"](data.mensaje);
						$("#nombre_ingrediente").val("");
						$("#cantidad_ingrediente").val("");
						$("#agregarColaborador").modal("hide");
						listatipoatributos();
						window.location.reload();
						$(
							"#btnEnviar, #nombre_ingrediente,#cantidad_ingrediente").removeAttr("disabled");
					} else {
						let res = "Ocurrio un error en: ";
						if (data.StatusCo == false) {
							toastr["warning"](
								res +
								(data.StatusCo == false
									? `${data.ResCorreo}`
									: (null))

							);
						} if (data.StatusTe == false) {
							toastr["warning"](
								res +
								(data.StatusTe == false
									? `${data.ResTelefono}`
									: (null))

							);
						}


						$(
							"#btnEnviar, #nombreColaborador, #apellidosColaborador,#telefonoColaborador,#correoColaborador,#rfcColaborador,#contrasenaColaborador,#contrasenaNColaborador"
						).removeAttr("disabled");
					}
				})
				.catch((error) => {
					console.log(error);
				});
		}


	} else {
		console.log("Falta datos para completar el formulario");
	}
}
function regresar() {
	$('#Echo_porKevinElChido').show();
	$("#cart_grafica").hide();
}
/**Inicia funcion agregar
 * abrimos el modal para agregar un nuevo tipo de contratacion
 */
function agregarColaborador() {
	quitaErroresCamposVacios();

	let idTU = $("#idTU").val();


	$("#agregarColaborador").modal("show");







	$("#nombreAtributo").val("").attr("disabled", false);
	$("#descripcionAtributo").val("").attr("disabled", false);
	$("#precioServicios").val("").attr("disabled", false);
	//$("#tipoAtributos").val("").attr("disabled",false);

	$("#acccion").val("agregar");
	$("#idAtrD").val("0");
	$("#btnEnviar").html("Añadir");






}


//termina funcion agregar

/**Inicia funcion editar
 * abrimos el modal para editar un nuevo tipo de contratacion
 */
function editar(id_inventario, nombre, cantidad, precio) {
	quitaErroresCamposVacios();
	console.log("Soy el id del ingrediente en el inventario   ", id_inventario);
	console.log("Soy el nombre A  ", nombre);
	console.log("Soy descripcion de  ", cantidad);
	console.log("Soy la cantidad de precio   ", precio);
	$("#agregarColaborador").modal("show");
	$("#nombreAtributo").html("Editando ingrediente: " + "(" + nombre + ")");
	$("#nombre_ingrediente").val(nombre).attr("disabled", false);
	$("#cantidad_ingrediente").val(cantidad).attr("disabled", false);
	$("#precio_ingrediente").val(precio).attr("disabled", false);
	$("#nombreModal").html("Editar Ingrediente");
	$("#acccion").val("editar");
	$("#id_inventario").val(id_inventario);
	$("#btnEnviar").html("Actualizar");
}
function modalBorrar(id_inventario, nombre, cantidad) {
	alert("Soy modal borrar");
	console.log("Soy el id del servicio", id_inventario);
	console.log("Soy el nombre", nombre);
	console.log("Soy la cantidad", cantidad);

	$("#borrarModal").modal("show");
	$("#tituloModalBorrar").html("Borrar <strong>" + nombre + "</strong>");
	$("#cuerpoModalBorrar").html(
		"¿Estas seguro que deseas borrar?: <strong>" +
		nombre +
		"</strong>"
	);
	$("#btnModalBorrar").attr("appData-Id", id_inventario);
}

function btnModalBorrar() {
	let id = $("#btnModalBorrar").attr("appData-Id");

	console.log("Soy el id del atributo", id);

	$.ajax({
		url: base_url() + "app/Inventario_pizza/bajaLogica",
		dataType: "JSON",
		type: "POST",
		data: {
			idAtrD: id,
		},
	})
		.done((data) => {
			if (data.resultado) {
				toastr["success"](data.mensaje);
				$("#tr-" + id).remove();
				$("#borrarModal").modal("hide");
				listatipoatributos();
			} else {
				toastr["warning"](data.mensaje);
				$("#borrarModal").modal("hide");
			}
		})
		.fail();
}

function cambiaEstatus(id_inventario, estatus) {
	console.log("Id de los ingredintes", id_inventario);
	console.log("Estatus", estatus);


	const id_inv = id_inventario;
	const est = estatus;

	let accion = "CambiarEstatus";

	axios
		.post(base_url() + "app/Inventario_pizza/insertarColaborador", {
			id_inventario: id_inv,
			accion: accion,
			estatus: est,
		})
		.then(({ data }) => {
			if (data.resultado) {
				toastr["success"](data.mensaje);
				listatipoatributos();
			} else {
				toastr["warning"](data.mensaje);
			}
		})
		.catch((error) => {
			console.log(error);
		});
}

function quitaErroresCamposVacios() {
	$("#errornombreAtributo").hide();
	$("#errordescripcionAtributo").hide();
	$("#errorprecioServicios").hide();
	$("#errorselectAtributos").hide();

}

function precio_total() {

	axios(base_url() + "app/Inventario_pizza/total_inventario")
		.then(({ data }) => {

			console.log("Soy data en precio total", data);


			//toastr["success"]("Precio total de inventario es de ",data.total_inventario.precio);

			if (data.resultado) {


				console.log("Soy data de Precio Total . . ", data);
				


				$("#boton_inventario").html(data.total_inventario.precio);

				$("#boton_inventario").html(data.total_inventario.precio);

				console.log("Soy data resultado", data.total_inventario.precio);


				let precios_inventarios = data.total_inventario.precio;

				let precios_pizzas = data.total_ganancia[0].subtotal;

				let ganacias_original = precios_pizzas - precios_inventarios;




				$("#ganancia_neto").html(ganacias_original);


				$("#pizzas_vendidas").html(data.total_ganancia[0].subtotal);




			} else {


				console.log("Soy el inventario que entro en 2");

			}
		})
		.catch(error => {
			console.log(error);
		})

}


function botonGraficaMajor(){

	console.log("Entre a function de graficas. . . ");

	let goValidation = true;
	let nombresuc = $( "#idSucG option:selected").text();
	let nombreanio = $( "#idAnioG option:selected").text();
	let nombremes = $( "#idMesG option:selected").text();

	let idsuc = $( "#idSucG").val();
	let idanio = $( "#idAnioG").val();
	let idMes = $( "#idMesG").val();
	

	console.log(nombresuc, " <-sucursal ", nombreanio, " <- anio", nombremes);
	console.log( " Valor suc ", idsuc, " Valor anio", idanio, " Valor mes", idMes);
	
	$("#container").html("");
	
	
	
    if("Selecciona" == idsuc){
        $('#erroridSucG').show();
        $('#erroridSucG').html("Elige una sucursal");
        $('#idSucG').focus();	
        goValidation = false;
        
    }
	 if("Selecciona" == idanio){
        $('#erroridAnioG').show();
        $('#erroridAnioG').html("Elige un año");
        $('#idAnioG').focus();	
        goValidation = false;
        
    }
	if("0" == idMes){
        $('#erroridMesG').show();
        $('#erroridMesG').html("Elige un mes");
        $('#idMesG').focus();	
        goValidation = false;
        
    }
	
	if(goValidation){
		console.log("Todo esta correcto . . . ");

		if(1 == idMes){

			console.log("Soy Enero");

							// Función para calcular la regresión lineal
							function linearRegression(y, x) {
								const n = y.length;
								const xSum = x.reduce((a, b) => a + b, 0);
								const ySum = y.reduce((a, b) => a + b, 0);
								const xSqSum = x.reduce((a, b) => a + b ** 2, 0);
								const xySum = y.reduce((sum, yi, i) => sum + yi * x[i], 0);
			
								const slope = (n * xySum - xSum * ySum) / (n * xSqSum - xSum ** 2);
								const intercept = (ySum - slope * xSum) / n;
			
								return { slope, intercept };
							}
			
							///Enero --> VENTA DEL DIA DE ENERO
							var data_1 = {
								resultado: true,
								mensaje: 'Resultado encontrado',
								final: [
									{ idServicio: 'SDI-Sel-Cof-212455', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '10.00', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212456', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '11.50', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212457', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '12.38', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212458', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '13.42', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212459', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '14.10', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212460', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '15.67', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212461', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '16.36', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212462', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '17.09', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212463', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '18.92', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212464', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '19.19', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212465', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '20.20', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212466', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '21.55', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212467', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '22.16', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212468', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '23.31', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212469', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '24.73', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212470', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '25.62', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212471', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '26.82', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212472', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '27.02', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212473', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '28.77', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212474', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '29.56', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212475', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '24.80', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212476', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '23.78', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212477', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '22.50', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212478', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '16.21', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212479', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '14.28', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212480', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '15.63', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212481', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '16.56', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212482', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '19.32', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212483', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '18.68', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' },
									{ idServicio: 'SDI-Sel-Cof-212484', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '22.90', idSuc: '9', ultimaFechaVenta: '2024-01-15 12:00:00' }
								]
							};
								// Extraer y procesar los datos
				var items = data_1.final; // Accede al array dentro de `final`

				

				


				var quantities = items.map(function(item) {
					return { nombre: item.nombreS, cantidad: parseFloat(item.sumaCantidad) }; // Extrae los valores numéricos junto con el nombre del producto
				});

				// Crear un arreglo de índices para x
				const x = quantities.map((_, index) => index + 1);

				const { slope, intercept } = linearRegression(quantities.map(q => q.cantidad), x);

				// Generar los puntos de la línea de regresión
				const regressionLine = x.map(xi => [xi, slope * xi + intercept]);
				

				// Crear la gráfica con Highcharts


					// Crear la gráfica con Highcharts
						Highcharts.chart('grafica_lineal', {
							title: {
								text: 'Regresión Lineal Productos Enero'
							},
							xAxis: {
								categories: ['Lunes','Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo', 'Lunes', 'Martes', 'Miercoles','Jueves','Viernes','Sabado','Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'],
								title: {
									text: 'Días de la Semana'
								}
							},
							yAxis: {
								title: {
									text: 'Suma de Cantidad'
								},
								plotLines: [{
									color: 'red',
									value: intercept,
									width: 2,
									dashStyle: 'ShortDash',
									label: {
										text: 'Línea de Regresión'
									}
								}]
							},
							series: [{
								name: 'Ventas',
								data: x.map((xi, index) => {
									return {
										x: xi,
										y: quantities[index].cantidad,
										name: quantities[index].nombre
									};
								}),
								tooltip: {
									pointFormat: '{point.name}: {point.y}'
								}
							}, {
								name: 'Línea de Regresión',
								type: 'line',
								data: regressionLine,
								marker: {
									enabled: false
								},
								states: {
									hover: {
										lineWidth: 0
									}
								},
								enableMouseTracking: false
							}]
						});
			


		}
		if(2 == idMes){

			console.log("Soy Febrero");


										// Función para calcular la regresión lineal
										function linearRegression(y, x) {
											const n = y.length;
											const xSum = x.reduce((a, b) => a + b, 0);
											const ySum = y.reduce((a, b) => a + b, 0);
											const xSqSum = x.reduce((a, b) => a + b ** 2, 0);
											const xySum = y.reduce((sum, yi, i) => sum + yi * x[i], 0);
						
											const slope = (n * xySum - xSum * ySum) / (n * xSqSum - xSum ** 2);
											const intercept = (ySum - slope * xSum) / n;
						
											return { slope, intercept };
										}



		var data_1 = {
			resultado: true,
			mensaje: 'Resultado encontrado',
			final: [
				{ idServicio: 'SDI-Sel-Cof-212455', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '25.00', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212456', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '26.50', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212457', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '27.38', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212458', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '13.42', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212459', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '29.10', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212460', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '30.67', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212461', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '31.36', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212462', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '22.09', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212463', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '33.92', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212464', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '34.19', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212465', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '23.20', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212466', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '36.55', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212467', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '37.16', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212468', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '60.31', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212469', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '39.73', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212470', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '22.62', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212471', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '41.82', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212472', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '55.02', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212473', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '21.77', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212474', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '11.56', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212475', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '42.80', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212476', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '46.78', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212477', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '14.50', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212478', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '48.21', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212479', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '22.28', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212480', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '44.63', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212481', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '51.56', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212482', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '34.32', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212483', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '53.68', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' },
				{ idServicio: 'SDI-Sel-Cof-212484', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '11.90', idSuc: '9', ultimaFechaVenta: '2024-02-15 12:00:00' }
			]
		};

			// Extraer y procesar los datos
			var items = data_1.final; // Accede al array dentro de `final`

				

				


			var quantities = items.map(function(item) {
				return { nombre: item.nombreS, cantidad: parseFloat(item.sumaCantidad) }; // Extrae los valores numéricos junto con el nombre del producto
			});

			// Crear un arreglo de índices para x
			const x = quantities.map((_, index) => index + 1);

			const { slope, intercept } = linearRegression(quantities.map(q => q.cantidad), x);

			// Generar los puntos de la línea de regresión
			const regressionLine = x.map(xi => [xi, slope * xi + intercept]);
			

			// Crear la gráfica con Highcharts


				// Crear la gráfica con Highcharts
					Highcharts.chart('grafica_lineal', {
						title: {
							text: 'Regresión Lineal Productos Febrero'
						},
						xAxis: {
							categories: ['Lunes','Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo', 'Lunes', 'Martes', 'Miercoles','Jueves','Viernes','Sabado','Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'],
							title: {
								text: 'Días de la Semana'
							}
						},
						yAxis: {
							title: {
								text: 'Suma de Cantidad'
							},
							plotLines: [{
								color: 'red',
								value: intercept,
								width: 2,
								dashStyle: 'ShortDash',
								label: {
									text: 'Línea de Regresión'
								}
							}]
						},
						series: [{
							name: 'Ventas',
							data: x.map((xi, index) => {
								return {
									x: xi,
									y: quantities[index].cantidad,
									name: quantities[index].nombre
								};
							}),
							tooltip: {
								pointFormat: '{point.name}: {point.y}'
							}
						}, {
							name: 'Línea de Regresión',
							type: 'line',
							data: regressionLine,
							marker: {
								enabled: false
							},
							states: {
								hover: {
									lineWidth: 0
								}
							},
							enableMouseTracking: false
						}]
					});
		
		}
		if(3 == idMes){

			console.log("SOY Marzo");


										// Función para calcular la regresión lineal
										function linearRegression(y, x) {
											const n = y.length;
											const xSum = x.reduce((a, b) => a + b, 0);
											const ySum = y.reduce((a, b) => a + b, 0);
											const xSqSum = x.reduce((a, b) => a + b ** 2, 0);
											const xySum = y.reduce((sum, yi, i) => sum + yi * x[i], 0);
						
											const slope = (n * xySum - xSum * ySum) / (n * xSqSum - xSum ** 2);
											const intercept = (ySum - slope * xSum) / n;
						
											return { slope, intercept };
										}
					///Marso --> VENTA DEL DIA DE MARZO
				var data_1 = {
					resultado: true,
					mensaje: 'Resultado encontrado',
					final: [
						{ idServicio: 'SDI-Sel-Cof-212455', nombreS: 'Capuchino Moka', sumaCantidad: '12.35', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212456', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '14.50', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212457', nombreS: 'Cafe Caliente Americano', sumaCantidad: '18.38', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212458', nombreS: 'Cafe Caliente Americano', sumaCantidad: '20.42', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212459', nombreS: 'Capuchino Moka', sumaCantidad: '22.10', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212460', nombreS: 'Cafe Caliente Americano', sumaCantidad: '43.67', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212461', nombreS: 'Cafe Caliente Americano', sumaCantidad: '22.36', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212462', nombreS: 'Capuchino Moka', sumaCantidad: '33.09', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212463', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '37.92', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212464', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '32.19', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212465', nombreS: 'Cafe Caliente Americano', sumaCantidad: '14.20', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212466', nombreS: 'Cafe Caliente Americano', sumaCantidad: '59.55', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212467', nombreS: 'Capuchino Moka', sumaCantidad: '34.16', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212468', nombreS: 'Capuchino Moka', sumaCantidad: '50.31', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212469', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '42.73', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212470', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '27.62', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212471', nombreS: 'Cafe Caliente Americano', sumaCantidad: '16.82', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212472', nombreS: 'Capuchino Moka', sumaCantidad: '16.02', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212473', nombreS: 'Cafe Caliente Americano', sumaCantidad: '30.77', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212474', nombreS: 'Moka Galleta Oreo', sumaCantidad: '45.56', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212475', nombreS: 'Moka Galleta Oreo', sumaCantidad: '25.80', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212476', nombreS: 'Capuchino Moka', sumaCantidad: '46.78', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212477', nombreS: 'Capuchino Moka', sumaCantidad: '38.50', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212478', nombreS: 'Cafe Caliente Americano', sumaCantidad: '17.21', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212479', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '35.28', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212480', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '24.63', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212481', nombreS: 'Capuchino Moka', sumaCantidad: '36.56', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212482', nombreS: 'Cafe Caliente Americano', sumaCantidad: '43.32', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212483', nombreS: 'Moka de Galleta Oreo', sumaCantidad: '27.68', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212484', nombreS: 'Capuchino Moka', sumaCantidad: '20.90', idSuc: '9', ultimaFechaVenta: '2024-03-15 12:00:00' }
					]
				};

					// Extraer y procesar los datos
					var items = data_1.final; // Accede al array dentro de `final`

				

				


					var quantities = items.map(function(item) {
						return { nombre: item.nombreS, cantidad: parseFloat(item.sumaCantidad) }; // Extrae los valores numéricos junto con el nombre del producto
					});
	
					// Crear un arreglo de índices para x
					const x = quantities.map((_, index) => index + 1);
	
					const { slope, intercept } = linearRegression(quantities.map(q => q.cantidad), x);
	
					// Generar los puntos de la línea de regresión
					const regressionLine = x.map(xi => [xi, slope * xi + intercept]);
					
	
					// Crear la gráfica con Highcharts
	
	
						// Crear la gráfica con Highcharts
							Highcharts.chart('grafica_lineal', {
								title: {
									text: 'Regresión Lineal Productos Marzo'
								},
								xAxis: {
									categories: ['Lunes','Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo', 'Lunes', 'Martes', 'Miercoles','Jueves','Viernes','Sabado','Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'],
									title: {
										text: 'Días de la Semana'
									}
								},
								yAxis: {
									title: {
										text: 'Suma de Cantidad'
									},
									plotLines: [{
										color: 'red',
										value: intercept,
										width: 2,
										dashStyle: 'ShortDash',
										label: {
											text: 'Línea de Regresión'
										}
									}]
								},
								series: [{
									name: 'Ventas',
									data: x.map((xi, index) => {
										return {
											x: xi,
											y: quantities[index].cantidad,
											name: quantities[index].nombre
										};
									}),
									tooltip: {
										pointFormat: '{point.name}: {point.y}'
									}
								}, {
									name: 'Línea de Regresión',
									type: 'line',
									data: regressionLine,
									marker: {
										enabled: false
									},
									states: {
										hover: {
											lineWidth: 0
										}
									},
									enableMouseTracking: false
								}]
							});
				
	
			
		}
		if(4 == idMes){

			console.log("Soy Abril");


										// Función para calcular la regresión lineal
										function linearRegression(y, x) {
											const n = y.length;
											const xSum = x.reduce((a, b) => a + b, 0);
											const ySum = y.reduce((a, b) => a + b, 0);
											const xSqSum = x.reduce((a, b) => a + b ** 2, 0);
											const xySum = y.reduce((sum, yi, i) => sum + yi * x[i], 0);
						
											const slope = (n * xySum - xSum * ySum) / (n * xSqSum - xSum ** 2);
											const intercept = (ySum - slope * xSum) / n;
						
											return { slope, intercept };
										}
						///ABRIL --> VENTA DEL DIA ABRIL

				var data_1 = {
					resultado: true,
					mensaje: 'Resultado encontrado',
					final: [
						{ idServicio: 'SDI-Sel-Cof-212455', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212456', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212457', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212458', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212459', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212460', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212461', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212462', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212463', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212464', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212465', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212466', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212467', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212468', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212469', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212470', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212471', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212472', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212473', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212474', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212475', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212476', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212477', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212478', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212479', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212480', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212481', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212482', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212483', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212484', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (45 - 12) + 12).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-04-15 12:00:00' }
					]
				};
				
				// Extraer y procesar los datos
				var items = data_1.final; // Accede al array dentro de `final`

				

				


				var quantities = items.map(function(item) {
					return { nombre: item.nombreS, cantidad: parseFloat(item.sumaCantidad) }; // Extrae los valores numéricos junto con el nombre del producto
				});

				// Crear un arreglo de índices para x
				const x = quantities.map((_, index) => index + 1);

				const { slope, intercept } = linearRegression(quantities.map(q => q.cantidad), x);

				// Generar los puntos de la línea de regresión
				const regressionLine = x.map(xi => [xi, slope * xi + intercept]);
				

				// Crear la gráfica con Highcharts


					// Crear la gráfica con Highcharts
						Highcharts.chart('grafica_lineal', {
							title: {
								text: 'Regresión Lineal Productos Abril'
							},
							xAxis: {
								categories: ['Lunes','Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo', 'Lunes', 'Martes', 'Miercoles','Jueves','Viernes','Sabado','Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'],
								title: {
									text: 'Días de la Semana'
								}
							},
							yAxis: {
								title: {
									text: 'Suma de Cantidad'
								},
								plotLines: [{
									color: 'red',
									value: intercept,
									width: 2,
									dashStyle: 'ShortDash',
									label: {
										text: 'Línea de Regresión'
									}
								}]
							},
							series: [{
								name: 'Ventas',
								data: x.map((xi, index) => {
									return {
										x: xi,
										y: quantities[index].cantidad,
										name: quantities[index].nombre
									};
								}),
								tooltip: {
									pointFormat: '{point.name}: {point.y}'
								}
							}, {
								name: 'Línea de Regresión',
								type: 'line',
								data: regressionLine,
								marker: {
									enabled: false
								},
								states: {
									hover: {
										lineWidth: 0
									}
								},
								enableMouseTracking: false
							}]
						});
	

			
		}
		if(5 == idMes){

			console.log("Soy Mayo");


										// Función para calcular la regresión lineal
										function linearRegression(y, x) {
											const n = y.length;
											const xSum = x.reduce((a, b) => a + b, 0);
											const ySum = y.reduce((a, b) => a + b, 0);
											const xSqSum = x.reduce((a, b) => a + b ** 2, 0);
											const xySum = y.reduce((sum, yi, i) => sum + yi * x[i], 0);
						
											const slope = (n * xySum - xSum * ySum) / (n * xSqSum - xSum ** 2);
											const intercept = (ySum - slope * xSum) / n;
						
											return { slope, intercept };
										}

					///MAYO --> VENTA DEL DIA MAYO

				var data_1 = {
					resultado: true,
					mensaje: 'Resultado encontrado',
					final: [
						{ idServicio: 'SDI-Sel-Cof-212455', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212456', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212457', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212458', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212459', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212460', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212461', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212462', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212463', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212464', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212465', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212466', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212467', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212468', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212469', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212470', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212471', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212472', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212473', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212474', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212475', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212476', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212477', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212478', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212479', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212480', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212481', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212482', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212483', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212484', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (55 - 5) + 5).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-05-15 12:00:00' }
					]
				};

					// Extraer y procesar los datos
					var items = data_1.final; // Accede al array dentro de `final`

				

				


					var quantities = items.map(function(item) {
						return { nombre: item.nombreS, cantidad: parseFloat(item.sumaCantidad) }; // Extrae los valores numéricos junto con el nombre del producto
					});
	
					// Crear un arreglo de índices para x
					const x = quantities.map((_, index) => index + 1);
	
					const { slope, intercept } = linearRegression(quantities.map(q => q.cantidad), x);
	
					// Generar los puntos de la línea de regresión
					const regressionLine = x.map(xi => [xi, slope * xi + intercept]);
					
	
					// Crear la gráfica con Highcharts
	
	
						// Crear la gráfica con Highcharts
							Highcharts.chart('grafica_lineal', {
								title: {
									text: 'Regresión Lineal Productos Mayo'
								},
								xAxis: {
									categories: ['Lunes','Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo', 'Lunes', 'Martes', 'Miercoles','Jueves','Viernes','Sabado','Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'],
									title: {
										text: 'Días de la Semana'
									}
								},
								yAxis: {
									title: {
										text: 'Suma de Cantidad'
									},
									plotLines: [{
										color: 'red',
										value: intercept,
										width: 2,
										dashStyle: 'ShortDash',
										label: {
											text: 'Línea de Regresión'
										}
									}]
								},
								series: [{
									name: 'Ventas',
									data: x.map((xi, index) => {
										return {
											x: xi,
											y: quantities[index].cantidad,
											name: quantities[index].nombre
										};
									}),
									tooltip: {
										pointFormat: '{point.name}: {point.y}'
									}
								}, {
									name: 'Línea de Regresión',
									type: 'line',
									data: regressionLine,
									marker: {
										enabled: false
									},
									states: {
										hover: {
											lineWidth: 0
										}
									},
									enableMouseTracking: false
								}]
							});

			
		}
		if(6 ==  idMes){

			console.log("Soy Junio");

										// Función para calcular la regresión lineal
										function linearRegression(y, x) {
											const n = y.length;
											const xSum = x.reduce((a, b) => a + b, 0);
											const ySum = y.reduce((a, b) => a + b, 0);
											const xSqSum = x.reduce((a, b) => a + b ** 2, 0);
											const xySum = y.reduce((sum, yi, i) => sum + yi * x[i], 0);
						
											const slope = (n * xySum - xSum * ySum) / (n * xSqSum - xSum ** 2);
											const intercept = (ySum - slope * xSum) / n;
						
											return { slope, intercept };
										}
					////JUNIO --> VENTA DEL DIA JUNIO

				var data_1 = {
					resultado: true,
					mensaje: 'Resultado encontrado',
					final: [
						{ idServicio: 'SDI-Sel-Cof-212455', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212456', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212457', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212458', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212459', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212460', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212461', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212462', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212463', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212464', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212465', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212466', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212467', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212468', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212469', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212470', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212471', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212472', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212473', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212474', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212475', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212476', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212477', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212478', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212479', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212480', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212481', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212482', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212483', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212484', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (76 - 34) + 34).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-06-15 12:00:00' }
					]
				};

					// Extraer y procesar los datos
					var items = data_1.final; // Accede al array dentro de `final`

				

				


					var quantities = items.map(function(item) {
						return { nombre: item.nombreS, cantidad: parseFloat(item.sumaCantidad) }; // Extrae los valores numéricos junto con el nombre del producto
					});
	
					// Crear un arreglo de índices para x
					const x = quantities.map((_, index) => index + 1);
	
					const { slope, intercept } = linearRegression(quantities.map(q => q.cantidad), x);
	
					// Generar los puntos de la línea de regresión
					const regressionLine = x.map(xi => [xi, slope * xi + intercept]);
					
	
					// Crear la gráfica con Highcharts
	
	
						// Crear la gráfica con Highcharts
							Highcharts.chart('grafica_lineal', {
								title: {
									text: 'Regresión Lineal Productos Junio'
								},
								xAxis: {
									categories: ['Lunes','Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo', 'Lunes', 'Martes', 'Miercoles','Jueves','Viernes','Sabado','Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'],
									title: {
										text: 'Días de la Semana'
									}
								},
								yAxis: {
									title: {
										text: 'Suma de Cantidad'
									},
									plotLines: [{
										color: 'red',
										value: intercept,
										width: 2,
										dashStyle: 'ShortDash',
										label: {
											text: 'Línea de Regresión'
										}
									}]
								},
								series: [{
									name: 'Ventas',
									data: x.map((xi, index) => {
										return {
											x: xi,
											y: quantities[index].cantidad,
											name: quantities[index].nombre
										};
									}),
									tooltip: {
										pointFormat: '{point.name}: {point.y}'
									}
								}, {
									name: 'Línea de Regresión',
									type: 'line',
									data: regressionLine,
									marker: {
										enabled: false
									},
									states: {
										hover: {
											lineWidth: 0
										}
									},
									enableMouseTracking: false
								}]
							});
	
		}
		if(7 == idMes){

			console.log("Soy Julio");


										// Función para calcular la regresión lineal
										function linearRegression(y, x) {
											const n = y.length;
											const xSum = x.reduce((a, b) => a + b, 0);
											const ySum = y.reduce((a, b) => a + b, 0);
											const xSqSum = x.reduce((a, b) => a + b ** 2, 0);
											const xySum = y.reduce((sum, yi, i) => sum + yi * x[i], 0);
						
											const slope = (n * xySum - xSum * ySum) / (n * xSqSum - xSum ** 2);
											const intercept = (ySum - slope * xSum) / n;
						
											return { slope, intercept };
										}

					///Julio --> Venta del dia JULIO

				var data_1 = {
					resultado: true,
					mensaje: 'Resultado encontrado',
					final: [
						{ idServicio: 'SDI-Sel-Cof-212455', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212456', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212457', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212458', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212459', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212460', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212461', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212462', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212463', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212464', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212465', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212466', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212467', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212468', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212469', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212470', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212471', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212472', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212473', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212474', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212475', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212476', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212477', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212478', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212479', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212480', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212481', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212482', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212483', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212484', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (100 - 45) + 45).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-07-15 12:00:00' }
					]
				};

					// Extraer y procesar los datos
					var items = data_1.final; // Accede al array dentro de `final`

				

				


					var quantities = items.map(function(item) {
						return { nombre: item.nombreS, cantidad: parseFloat(item.sumaCantidad) }; // Extrae los valores numéricos junto con el nombre del producto
					});
	
					// Crear un arreglo de índices para x
					const x = quantities.map((_, index) => index + 1);
	
					const { slope, intercept } = linearRegression(quantities.map(q => q.cantidad), x);
	
					// Generar los puntos de la línea de regresión
					const regressionLine = x.map(xi => [xi, slope * xi + intercept]);
					
	
					// Crear la gráfica con Highcharts
	
	
						// Crear la gráfica con Highcharts
							Highcharts.chart('grafica_lineal', {
								title: {
									text: 'Regresión Lineal Productos Julio'
								},
								xAxis: {
									categories: ['Lunes','Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo', 'Lunes', 'Martes', 'Miercoles','Jueves','Viernes','Sabado','Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'],
									title: {
										text: 'Días de la Semana'
									}
								},
								yAxis: {
									title: {
										text: 'Suma de Cantidad'
									},
									plotLines: [{
										color: 'red',
										value: intercept,
										width: 2,
										dashStyle: 'ShortDash',
										label: {
											text: 'Línea de Regresión'
										}
									}]
								},
								series: [{
									name: 'Ventas',
									data: x.map((xi, index) => {
										return {
											x: xi,
											y: quantities[index].cantidad,
											name: quantities[index].nombre
										};
									}),
									tooltip: {
										pointFormat: '{point.name}: {point.y}'
									}
								}, {
									name: 'Línea de Regresión',
									type: 'line',
									data: regressionLine,
									marker: {
										enabled: false
									},
									states: {
										hover: {
											lineWidth: 0
										}
									},
									enableMouseTracking: false
								}]
							});
					

		}
		if( 8 == idMes){

			console.log("SOY Agosto");

										// Función para calcular la regresión lineal
										function linearRegression(y, x) {
											const n = y.length;
											const xSum = x.reduce((a, b) => a + b, 0);
											const ySum = y.reduce((a, b) => a + b, 0);
											const xSqSum = x.reduce((a, b) => a + b ** 2, 0);
											const xySum = y.reduce((sum, yi, i) => sum + yi * x[i], 0);
						
											const slope = (n * xySum - xSum * ySum) / (n * xSqSum - xSum ** 2);
											const intercept = (ySum - slope * xSum) / n;
						
											return { slope, intercept };
		
									}

									///AGOSTO --> Venta del dia AGOSTO

				var data_1 = {
					resultado: true,
					mensaje: 'Resultado encontrado',
					final: [
						{ idServicio: 'SDI-Sel-Cof-212455', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (67 - 35) + 35).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-08-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212456', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (67 - 35) + 35).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-08-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212457', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (67 - 35) + 35).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-08-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212458', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (67 - 35) + 35).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-08-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212459', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (67 - 35) + 35).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-08-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212460', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (67 - 35) + 35).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-08-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212461', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (67 - 35) + 35).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-08-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212462', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (67 - 35) + 35).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-08-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212463', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (67 - 35) + 35).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-08-15 12:00:00' },
						{ idServicio: 'SDI-Sel-Cof-212464', nombreS: 'Moka de Galleta Oreo', sumaCantidad: (Math.random() * (67 - 35) + 35).toFixed(2), idSuc: '9', ultimaFechaVenta: '2024-08-15 12:00:00' }
					]
				};

					// Extraer y procesar los datos
					var items = data_1.final; // Accede al array dentro de `final`

				

				


					var quantities = items.map(function(item) {
						return { nombre: item.nombreS, cantidad: parseFloat(item.sumaCantidad) }; // Extrae los valores numéricos junto con el nombre del producto
					});
	
					// Crear un arreglo de índices para x
					const x = quantities.map((_, index) => index + 1);
	
					const { slope, intercept } = linearRegression(quantities.map(q => q.cantidad), x);
	
					// Generar los puntos de la línea de regresión
					const regressionLine = x.map(xi => [xi, slope * xi + intercept]);
					
	
					// Crear la gráfica con Highcharts
	
	
						// Crear la gráfica con Highcharts
							Highcharts.chart('grafica_lineal', {
								title: {
									text: 'Regresión Lineal Productos Agosto'
								},
								xAxis: {
									categories: ['Lunes','Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo', 'Lunes', 'Martes', 'Miercoles','Jueves','Viernes','Sabado','Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'],
									title: {
										text: 'Días de la Semana'
									}
								},
								yAxis: {
									title: {
										text: 'Suma de Cantidad'
									},
									plotLines: [{
										color: 'red',
										value: intercept,
										width: 2,
										dashStyle: 'ShortDash',
										label: {
											text: 'Línea de Regresión'
										}
									}]
								},
								series: [{
									name: 'Ventas',
									data: x.map((xi, index) => {
										return {
											x: xi,
											y: quantities[index].cantidad,
											name: quantities[index].nombre
										};
									}),
									tooltip: {
										pointFormat: '{point.name}: {point.y}'
									}
								}, {
									name: 'Línea de Regresión',
									type: 'line',
									data: regressionLine,
									marker: {
										enabled: false
									},
									states: {
										hover: {
											lineWidth: 0
										}
									},
									enableMouseTracking: false
								}]
							});

				
		}



	

	

		
			
		
			


				

				

				
				
			

				
				
				
				
				
				

				
				
				






				// Extraer y procesar los datos
				var items = data_1.final; // Accede al array dentro de `final`

				

				


				var quantities = items.map(function(item) {
					return { nombre: item.nombreS, cantidad: parseFloat(item.sumaCantidad) }; // Extrae los valores numéricos junto con el nombre del producto
				});

				// Crear un arreglo de índices para x
				const x = quantities.map((_, index) => index + 1);

				const { slope, intercept } = linearRegression(quantities.map(q => q.cantidad), x);

				// Generar los puntos de la línea de regresión
				const regressionLine = x.map(xi => [xi, slope * xi + intercept]);
				

				// Crear la gráfica con Highcharts


					// Crear la gráfica con Highcharts
						Highcharts.chart('grafica_lineal', {
							title: {
								text: 'Regresión Lineal Productos'
							},
							xAxis: {
								categories: ['Lunes','Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo', 'Lunes', 'Martes', 'Miercoles','Jueves','Viernes','Sabado','Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'],
								title: {
									text: 'Días de la Semana'
								}
							},
							yAxis: {
								title: {
									text: 'Suma de Cantidad'
								},
								plotLines: [{
									color: 'red',
									value: intercept,
									width: 2,
									dashStyle: 'ShortDash',
									label: {
										text: 'Línea de Regresión'
									}
								}]
							},
							series: [{
								name: 'Ventas',
								data: x.map((xi, index) => {
									return {
										x: xi,
										y: quantities[index].cantidad,
										name: quantities[index].nombre
									};
								}),
								tooltip: {
									pointFormat: '{point.name}: {point.y}'
								}
							}, {
								name: 'Línea de Regresión',
								type: 'line',
								data: regressionLine,
								marker: {
									enabled: false
								},
								states: {
									hover: {
										lineWidth: 0
									}
								},
								enableMouseTracking: false
							}]
						});
			





	
		
	
	}
	
}
	





