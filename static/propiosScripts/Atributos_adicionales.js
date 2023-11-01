$(document).ready(() => {
	listatipoatributos();
	atributos_adicionales();


    let idTU= $("#idTU").val();



	
});

function listatipoatributos() {
	//consumimos servicio para mostrar los tipos de contratacion
	axios(base_url() + "app/Atributos_adicionales/verListaAtributos")
		.then(({ data: Response }) => {
			console.log(Response);

			if (Response.resultado) {
				/**
				 * #despliegueTabla es el id de un div que se encuentra en la vista en TipoContratacion_view.php
				 * se pintara la tabla en el id: despliegueTabla
				 */
                console.log("hooola",Response.listaAtributos)

				$("#despliegueTablaAtributos").html(`
         <table id="datatableAtributos" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
             <thead>
                 <tr>
                     <th>id</th>
                     <th>Nombre Atributos</th>
                     <th>Descripcion</th>
                     <th>Precio</th>
                     <th>Categoría</th>
                     <th style="text-align: center">Estatus</th>
                     <th style="text-align: center">Editar</th>
                     <th style="text-align: center">Borrar</th>
                 </tr>
             </thead>
             <tbody>
         
             </tbody>
         </table>`);
				$.each(Response.listaAtributos, function (i, o) {

					$("#datatableAtributos")
						.find("tbody")
						.append(
							`
                <tr id="tr-` +
								o.idAtrD +
								`">
                     <td>` +
								o.idAtrD +
								`</td>
                     <td>` +
								o.nombreAtrD +
								` 
                     <td>` +
								o.desAtrD +
								`</td>
                     <td>` +
								o.precio +
								`</td>
						<td>` +
								(o.cat == 1 ? 'Impresiones' : 'Precio Vinil') +
								`</td>
                     <td align="center"><a href="#" onclick="cambiaEstatus(` +
								o.idAtrD +
								`,'` +
								o.estatus +
								`')">` +
								(o.estatus == 1
									? '<i class="fas fa-toggle-on fa-2x"></i>'
									: '<i class="fas fa-toggle-off fa-2x"></i>') +
								`</a></td>
                     <td align="center"><a href="#" onclick="editar(` +
								o.idAtrD +
								`,'` +
								o.nombreAtrD +
								`','` +
								o.desAtrD +
								`','` +
								o.precio +
								`','` +
								o.cat +
								`')"><i class="fas fa-pencil fa-2x"></i></a> </td>
                     <td align="center"><a href="#" onclick="modalBorrar(` +
								o.idAtrD +
								`,'` +
								o.nombreAtrD +
								`','` +
								o.desAtrD +
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
		"#btnEnviar, #nombreAtributo,#descripcionAtributo,#precioServicios,#tipoAtributos"
	).attr("disabled", "disabled");
	
	let accion  = $("#acccion").val();
	let idAtrD 	= $("#idAtrD").val();
	let nom 	= $("#nombreAtributo").val();
	let desc   = $("#descripcionAtributo").val();
	let precio 	= $("#precioServicios").val();
	console.log("Soi precio",precio);
	let atributo  = $("#tipoAtributos").val();



	

	let goValidation = true;

	const validRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


	
	if (accion == "editar"){
		

		if ("" == nom.trim()) {
				console.log("correo")
			$("#errornombreAtributo").show();
			$("#errornombreAtributo").html("Ingresa el nombre del atributo");
			$("#nombreAtributo").focus();
			goValidation = false;
			$(
				"#btnEnviar, #nombreAtributo,#descripcionAtributo,#precioServicios,#tipoAtributos").removeAttr("disabled");
		}

		if ("" == desc.trim() ) {
			console.log("tel")
			$("#errordescripcionAtributo").show();
			$("#errordescripcionAtributo").html("Ingresa de descripcion de atributo");
			$("#descripcionAtributo").focus();
			goValidation = false;

						

		}
		if ("" == precio.trim()) {
			console.log("apell")
			$("#errorprecioServicios").show();
			$("#errorprecioServicios").html(
				"Ingresa precio"
			);
			$("#precioServicios").focus();
			goValidation = false;
			
		}

		
		if (atributo == "Selecciona" || "" == atributo) {
			$("#errorselectAtributos").show();
			$("#errorselectAtributos").html("Seleccione categoria");
			$("#divSelectAtributo").focus(); 
			
			goValidation = false;
			console.log("Validar select");
	    	$(
				"#btnEnviar, #nombreAtributo,#descripcionAtributo,#precioServicios,#tipoAtributos").removeAttr("disabled");		
		}


	}else{

		if ("" == nom.trim()) {
				console.log("correo")
			$("#errornombreAtributo").show();
			$("#errornombreAtributo").html("Ingresa el nombre del atributo");
			$("#nombreAtributo").focus();
			goValidation = false;
			$(
				"#btnEnviar, #nombreAtributo,#descripcionAtributo,#precioServicios,#tipoAtributos").removeAttr("disabled");
		}

		if ("" == desc.trim() ) {
			console.log("tel")
			$("#errordescripcionAtributo").show();
			$("#errordescripcionAtributo").html("Ingresa de descripcion de atributo");
			$("#descripcionAtributo").focus();
			goValidation = false;
			$(
				"#btnEnviar, #nombreAtributo,#descripcionAtributo,#precioServicios,#tipoAtributos").removeAttr("disabled");

						

		}
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

		
		if (atributo == "Selecciona" || "" == atributo) {
			$("#errorselectAtributos").show();
			$("#errorselectAtributos").html("Seleccione categoria");
			$("#divSelectAtributo").focus(); 
			
			goValidation = false;
			console.log("Validar select");
	    	$(
				"#btnEnviar, #nombreAtributo,#descripcionAtributo,#precioServicios,#tipoAtributos").removeAttr("disabled");		
		}
		
		

	}

	let formbody = {};
	const IDUTU= $("#idTU").val();

	if (goValidation) {
		//para  superadministradores IDTU = 1
		// registra a los majors  como adminsitradores
		if(IDUTU == 1){
			 formbody =  {
				idAtrD: idAtrD,
				nombreAtrD:nom,
				desAtrD:desc,
				precio:precio,
				estatus:1,
				cat:atributo,

				accion: accion,



			}
		}
		
		if (formbody != null){
			
			console.log("entro aquiii")
			console.log("formbody",formbody)
			 axios
			.post(base_url() + "app/Atributos_adicionales/insertarColaborador",formbody)
			.then(({ data }) => {
				if (data.resultado) {
					toastr["success"](data.mensaje);
					$("#nombreColaborador").val("");
					$("#descripcionTipoContratacion").val("");
					$("#agregarColaborador").modal("hide");
					listatipocontratacion();
				$(
				"#btnEnviar, #nombreAtributo,#descripcionAtributo,#precioServicios,#tipoAtributos").removeAttr("disabled");
				} else {
					let res = "Ocurrio un error en: ";
					if (data.StatusCo == false){
						toastr["warning"](
								 res+
								(data.StatusCo == false
									? `${data.ResCorreo}`
									: (null))
									
						);
					}if(data.StatusTe == false){
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

/**Inicia funcion agregar
 * abrimos el modal para agregar un nuevo tipo de contratacion
 */



function agregarColaborador() {
	quitaErroresCamposVacios();
	
    let idTU= $("#idTU").val();
	

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
function editar(id,nombreA,descA,precio,cat) {
	quitaErroresCamposVacios();
	$("#agregarColaborador").modal("show");
	$("#nombreAtributo").html("Editando Atributo: " + "(" + nombreA + ")");
	$("#nombreAtributo").val(nombreA).attr("disabled", false);
	$("#descripcionAtributo").val(descA).attr("disabled", false);
	$("#precioServicios").val(precio).attr("disabled", false);
	$("#tipoAtributos").val(cat).attr("disabled",false);



	$("#acccion").val("editar");
	$("#idAtrD").val(id);
	$("#btnEnviar").html("Actualizar");
}



function modalBorrar(id, nombre, des) {
	console.log("Soy el id del servicio",id);

	console.log("Soy el nombre",nombre);


	console.log("Soy el des",des);

	$("#borrarModal").modal("show");
	$("#tituloModalBorrar").html("Borrar <strong>" + nombre + "</strong>");
	$("#cuerpoModalBorrar").html(
		"¿Estas seguro que deseas borrar?: <strong>" +
			nombre +
			"</strong>"
	);
	$("#btnModalBorrar").attr("appData-Id", id);
}

function btnModalBorrar() {
	let id = $("#btnModalBorrar").attr("appData-Id");

	console.log("Soy el id del atributo",id);

	$.ajax({
		url: base_url() + "app/Atributos_adicionales/bajaLogica",
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
			} else {
				toastr["warning"](data.mensaje);
				$("#borrarModal").modal("hide");
			}
		})
		.fail();
}

function cambiaEstatus(id, estatusD) {
	console.log("Id de los atributos", id);
	console.log("Estatus", estatusD);
	const idAtrD = id;
	const estatus = estatusD;

	let accion = "CambiarEstatus";

	axios
		.post(base_url() + "app/Atributos_adicionales/insertarColaborador", {
			idAtrD: idAtrD,
			accion: accion,
			estatus: estatus,
		})
		.then(({ data }) => {
			if (data.resultado) {
				toastr["success"](data.mensaje);
				listatipocontratacion();
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

function atributos_adicionales(){


	$("#divSelectAtributo").find("select").append(`
		<option value="Selecciona" selected>--Selecciona--</option>
		<option value="1">Impresiones</option>
		<option value="2">Precio Vinil</option>




	`);





}

                                                       