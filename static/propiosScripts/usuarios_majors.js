$(document).ready(() => {
	listatipocontratacion();
	
    let idTU= $("#idTU").val();
    
    if(idTU == 1){

		$("#sucursal").html(` 
		<div id="ModalPerfil">
		<label for="message-text"   class="col-form-label">Perfil:</label>
		 <select  id="selectEspecialidad" class="form-control select2-single"></select>
		 </div>
		 <small class="text-danger" id="errorEspecialidad"  style="display: none;"></small> 
		`)
		
     
    }
	
});

function listatipocontratacion() {
	//consumimos servicio para mostrar los tipos de contratacion
	axios(base_url() + "app/Usuarios_Majors/verListaMajors")
		.then(({ data: Response }) => {
			console.log(Response);

			if (Response.resultado) {
				/**
				 * #despliegueTabla es el id de un div que se encuentra en la vista en TipoContratacion_view.php
				 * se pintara la tabla en el id: despliegueTabla
				 */
                console.log("hooola",Response.ListaMajors)

				$("#despliegueTablaMajors").html(`
         <table id="datatableMajors" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
             <thead>
                 <tr>
                     <th>id</th>
                     <th>Nombre</th>
                     <th>Telefono</th>
                     <th>Correo</th>
                     <th>Detalle usuario</th>
                     <th style="text-align: center">Estatus</th>
                     <th style="text-align: center">Editar</th>
                     <th style="text-align: center">Borrar</th>
                 </tr>
             </thead>
             <tbody>
         
             </tbody>
         </table>`);
				$.each(Response.ListaMajors, function (i, o) {
                    console.log(o.contrasenia)
					$("#datatableMajors")
						.find("tbody")
						.append(
							`
                <tr id="tr-` +
								o.idU +
								`">
                     <td>` +
								o.idU +
								`</td>
                     <td>` +
								o.nombreU +
								` ` +
								o.apellidos +
								`</td>
                     <td>` +
								o.telefono +
								`</td>
                     <td>` +
								o.correo +
								`</td>
                     <td align="center"><a href="#" onclick="ModalVistaPrevia(` +
								o.idU +
								`,'` +
								o.nombreU +
								`','` +
								o.apellidos +
								`','` +
								o.rfc +
								`','` +
								o.telefono +
								`','` +
								o.correo +
								`','` +
								o.idP +
								`')"><i class="fas fa-list fa-2x"></i></a></td>
                     <td align="center"><a href="#" onclick="cambiaEstatus(` +
								o.idU +
								`,'` +
								o.estatus +
								`')">` +
								(o.estatus == 1
									? '<i class="fas fa-toggle-on fa-2x"></i>'
									: '<i class="fas fa-toggle-off fa-2x"></i>') +
								`</a></td>
                     <td align="center"><a href="#" onclick="editar(` +
								o.idU +
								`,'` +
								o.nombreU +
								`','` +
								o.apellidos +
								`','` +
								o.rfc +
								`','` +
								o.telefono +
								`','` +
								o.correo +
								`','` +
								o.idP +
								`','` +
								o.contrasenia +
								`')"><i class="fas fa-pencil fa-2x"></i></a> </td>
                     <td align="center"><a href="#" onclick="modalBorrar(` +
								o.idU +
								`,'` +
								o.nombreU +
								`','` +
								o.desTC +
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
		"#btnEnviar, #nombreColaborador,#apellidosColaborador,#telefonoColaborador,#correoColaborador,#rfcColaborador,#contrasenaColaborador,#contrasenaNColaborador"
	).attr("disabled", "disabled");
	
	let accion  = $("#acccion").val();
	let idU 	= $("#idU").val();
	let nom 	= $("#nombreColaborador").val();
	let apell   = $("#apellidosColaborador").val();
	let tel 	= $("#telefonoColaborador").val();
	let correo  = $("#correoColaborador").val();
	let rfc 	= $("#rfcColaborador").val();
	let contra  = $("#contrasenaColaborador").val();
	let contraValida = $("#contrasenaNColaborador").val();
	let TPerfil  = $("#selectTipoPerfil").val();
	let idTU	 = $("#selectEspecialidad").val();

	

	let goValidation = true;

	const validRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


	
	if (accion == "editar"){
		if (!correo.match(validRegex)) {
	
			console.log("correo no valido")
			$("#errorcorreoColaborador").show();
			$("#errorcorreoColaborador").html("Ingresa un correo valido");
			$("#correoColaborador").focus();
			goValidation = false;
			$(
				"#btnEnviar, #nombreColaborador,#apellidosColaborador,#telefonoColaborador,#correoColaborador,#rfcColaborador,#contrasenaColaborador,#contrasenaNColaborador"
			).removeAttr("disabled");
		}
		if ("" == rfc.trim() || rfc.length > 13) {
			console.log("rfc")
			if( rfc.length > 13){
				$("#errorrfcColaborador").show();
				$("#errorrfcColaborador").html("RFC invalido");
			}
			if("" == rfc.trim()){
				$("#errorrfcColaborador").show();
				$("#errorrfcColaborador").html("Ingresa el rfc del colaborador");
			}
			$("#rfcColaborador").focus();
			goValidation = false;
			$(
				"#btnEnviar, #nombreColaborador,#apellidosColaborador,#telefonoColaborador,#correoColaborador,#rfcColaborador,#contrasenaColaborador,#contrasenaNColaborador"
			).removeAttr("disabled");
		}
		if ("" == correo.trim()) {
				console.log("correo")
			$("#errorcorreoColaborador").show();
			$("#errorcorreoColaborador").html("Ingresa el correo del colaborador");
			$("#correoColaborador").focus();
			goValidation = false;
			$(
				"#btnEnviar, #nombreColaborador,#apellidosColaborador,#telefonoColaborador,#correoColaborador,#rfcColaborador,#contrasenaColaborador,#contrasenaNColaborador"
			).removeAttr("disabled");
		}
		if (!tel.match(/^[0-9]+$/) || tel.length >10){
			console.log("tel.match")
			if(!tel.match(/^[0-9]+$/) ){
				$("#errortelefonoColaborador").show();
				$("#errortelefonoColaborador").html("Ingresa un telefono valido");
				$("#telefonoColaborador").focus();
				goValidation = false;
				$(
					"#btnEnviar, #nombreColaborador,#apellidosColaborador,#telefonoColaborador,#correoColaborador,#rfcColaborador,#contrasenaColaborador,#contrasenaNColaborador"
				).removeAttr("disabled");
			}
			if( tel.length >10){
				$("#errortelefonoColaborador").show();
				$("#errortelefonoColaborador").html("Solo se permiten 10 digitos");
				$("#telefonoColaborador").focus();
				goValidation = false;
				$(
					"#btnEnviar, #nombreColaborador,#apellidosColaborador,#telefonoColaborador,#correoColaborador,#rfcColaborador,#contrasenaColaborador,#contrasenaNColaborador"
				).removeAttr("disabled");
			}
			
		}
		if ("" == tel.trim() ) {
			console.log("tel")
			$("#errortelefonoColaborador").show();
			$("#errortelefonoColaborador").html("Ingresa el telefono del colaborador");
			$("#telefonoColaborador").focus();
			goValidation = false;
			$(
				"#btnEnviar, #nombreColaborador,#apellidosColaborador,#telefonoColaborador,#correoColaborador,#rfcColaborador,#contrasenaColaborador,#contrasenaNColaborador"
			).removeAttr("disabled");
		}
		if ("" == apell.trim()) {
			console.log("apell")
			$("#errorapellidosColaborador").show();
			$("#errorapellidosColaborador").html(
				"Ingresa los apellido del colaborador"
			);
			$("#apellidosColaborador").focus();
			goValidation = false;
			$(
				"#btnEnviar, #nombreColaborador,#apellidosColaborador,#telefonoColaborador,#correoColaborador,#rfcColaborador,#contrasenaColaborador,#contrasenaNColaborador"
			).removeAttr("disabled");
		}
		if ("" == nom.trim()) {
			console.log("nombre")
			$("#errornombreColaborador").show();
			$("#errornombreColaborador").html("Ingresa el nombre del colaborador");
			$("#nombreColaborador").focus();
			goValidation = false;
			$(
				"#btnEnviar, #nombreColaborador,#apellidosColaborador,#telefonoColaborador,#correoColaborador,#rfcColaborador,#contrasenaColaborador,#contrasenaNColaborador"
			).removeAttr("disabled");
		}

	}else{
		if (!correo.match(validRegex)) {
	
			console.log("correo no valido")
			$("#errorcorreoColaborador").show();
			$("#errorcorreoColaborador").html("Ingresa un correo valido");
			$("#correoColaborador").focus();
			goValidation = false;
			$(
				"#btnEnviar, #nombreColaborador,#apellidosColaborador,#telefonoColaborador,#correoColaborador,#rfcColaborador,#contrasenaColaborador,#contrasenaNColaborador"
			).removeAttr("disabled");
		}
		if (contra != contraValida) {
			console.log("contra!=contraValida")
			console.log("contraseñas no coinciden: contra", contra , "confirma",contraValida )
	
			$("#errorcontrasenaNColaborador").show();
			$("#errorcontrasenaNColaborador").html(
				"Las contraseñas no coinciden, porfavor verificalas"
			);
	
			$("#errorcontrasenaColaborador").show();
			$("#errorcontrasenaColaborador").html(
				"Las contraseñas no coinciden, porfavor verificalas"
			);
			$("#contrasenaColaborador").focus();
			goValidation = false;
			$(
				"#btnEnviar, #nombreColaborador,#apellidosColaborador,#telefonoColaborador,#correoColaborador,#rfcColaborador,#contrasenaColaborador,#contrasenaNColaborador"
			).removeAttr("disabled")
			
		}
		
		if ("" == contraValida.trim()) {
			console.log("== contraValida.trim()")
			$("#errorcontrasenaNColaborador").show();
			$("#errorcontrasenaNColaborador").html(
				"Ingresa la contraseña del colaborador"
			);
			$("#contrasenaNColaborador").focus();
			goValidation = false;
			$(
				"#btnEnviar, #nombreColaborador,#apellidosColaborador,#telefonoColaborador,#correoColaborador,#rfcColaborador,#contrasenaColaborador,#contrasenaNColaborador"
			).removeAttr("disabled");
		}
		if ("" == contra.trim() || contra.length <= 5) {
			
			console.log("== contra.trim() || contra.length <= 5")
	
	
			if("" == contra.trim()){
				console.log("contra.trime")
				$("#errorcontrasenaColaborador").show();
				$("#errorcontrasenaColaborador").html(
					"Ingresa la contraseña del colaborador"
				);
						$("#contrasenaColaborador").focus();
					goValidation = false;
					$(
						"#btnEnviar, #nombreColaborador,#apellidosColaborador,#telefonoColaborador,#correoColaborador,#rfcColaborador,#contrasenaColaborador,#contrasenaNColaborador"
					).removeAttr("disabled");
			}
			if(contra.length <= 5){
				console.log("contra.length <= 5c")
				$("#errorcontrasenaColaborador").show();
				$("#errorcontrasenaColaborador").html(
					"La contraseña es demaciado corta"
				);
				$("#contrasenaColaborador").focus();
					goValidation = false;
					$(
						"#btnEnviar, #nombreColaborador,#apellidosColaborador,#telefonoColaborador,#correoColaborador,#rfcColaborador,#contrasenaColaborador,#contrasenaNColaborador"
					).removeAttr("disabled");
			}
			
			
		}
		if ("" == rfc.trim() || rfc.length > 13) {
			console.log("rfc")
			if( rfc.length > 13){
				$("#errorrfcColaborador").show();
				$("#errorrfcColaborador").html("RFC invalido");
			}
			if("" == rfc.trim()){
				$("#errorrfcColaborador").show();
				$("#errorrfcColaborador").html("Ingresa el rfc del colaborador");
			}
			
			$("#rfcColaborador").focus();
			goValidation = false;
			$(
				"#btnEnviar, #nombreColaborador,#apellidosColaborador,#telefonoColaborador,#correoColaborador,#rfcColaborador,#contrasenaColaborador,#contrasenaNColaborador"
			).removeAttr("disabled");
		}
		if ("" == correo.trim()) {
				console.log("correo")
			$("#errorcorreoColaborador").show();
			$("#errorcorreoColaborador").html("Ingresa el correo del colaborador");
			$("#correoColaborador").focus();
			goValidation = false;
			$(
				"#btnEnviar, #nombreColaborador,#apellidosColaborador,#telefonoColaborador,#correoColaborador,#rfcColaborador,#contrasenaColaborador,#contrasenaNColaborador"
			).removeAttr("disabled");
		}
		if (!tel.match(/^[0-9]+$/) || tel.length >10){
			console.log("tel.match")
			if(!tel.match(/^[0-9]+$/) ){
				$("#errortelefonoColaborador").show();
				$("#errortelefonoColaborador").html("Ingresa un telefono valido");
				$("#telefonoColaborador").focus();
				goValidation = false;
				$(
					"#btnEnviar, #nombreColaborador,#apellidosColaborador,#telefonoColaborador,#correoColaborador,#rfcColaborador,#contrasenaColaborador,#contrasenaNColaborador"
				).removeAttr("disabled");
			}
			if( tel.length >10){
				$("#errortelefonoColaborador").show();
				$("#errortelefonoColaborador").html("Solo se permiten 10 digitos");
				$("#telefonoColaborador").focus();
				goValidation = false;
				$(
					"#btnEnviar, #nombreColaborador,#apellidosColaborador,#telefonoColaborador,#correoColaborador,#rfcColaborador,#contrasenaColaborador,#contrasenaNColaborador"
				).removeAttr("disabled");
			}
			
		}
		if ("" == tel.trim() ) {
			console.log("tel")
			$("#errortelefonoColaborador").show();
			$("#errortelefonoColaborador").html("Ingresa el telefono del colaborador");
			$("#telefonoColaborador").focus();
			goValidation = false;
			$(
				"#btnEnviar, #nombreColaborador,#apellidosColaborador,#telefonoColaborador,#correoColaborador,#rfcColaborador,#contrasenaColaborador,#contrasenaNColaborador"
			).removeAttr("disabled");
		}
		if ("" == apell.trim()) {
			console.log("apell")
			$("#errorapellidosColaborador").show();
			$("#errorapellidosColaborador").html(
				"Ingresa los apellido del colaborador"
			);
			$("#apellidosColaborador").focus();
			goValidation = false;
			$(
				"#btnEnviar, #nombreColaborador,#apellidosColaborador,#telefonoColaborador,#correoColaborador,#rfcColaborador,#contrasenaColaborador,#contrasenaNColaborador"
			).removeAttr("disabled");
		}
		if ("" == nom.trim()) {
			console.log("nombre")
			$("#errornombreColaborador").show();
			$("#errornombreColaborador").html("Ingresa el nombre del colaborador");
			$("#nombreColaborador").focus();
			goValidation = false;
			$(
				"#btnEnviar, #nombreColaborador,#apellidosColaborador,#telefonoColaborador,#correoColaborador,#rfcColaborador,#contrasenaColaborador,#contrasenaNColaborador"
			).removeAttr("disabled");
		}
		
		if (idTU == "Selecciona") {
			console.log("nombre")
			$("#errorEspecialidad").show();
			$("#errorEspecialidad").html("Selecciona una especialidad");
			$("#selectEspecialidad").focus();
			goValidation = false;
			$(
				"#btnEnviar,#selectEspecialidad,#selectEspecialidad,#nombreColaborador,#apellidosColaborador,#telefonoColaborador,#correoColaborador,#rfcColaborador,#contrasenaColaborador,#contrasenaNColaborador"
			).removeAttr("disabled");
		}
		

	}

	let formbody = {};
	const IDUTU= $("#idTU").val();

	if (goValidation) {
		//para  superadministradores IDTU = 1
		// registra a los majors  como adminsitradores
		if(IDUTU == 1){
			 formbody =  {
				idU: idU,
				nombreU: nom,
				apellidos: apell,
				rfc: rfc,
				correo: correo,
				accion: accion,
				contrasenia: contra,
				telefono: tel,
				idTU: 2,
				estatus: 1,
				idP: 1,
			}
		}
		
		if (formbody != null){
			
			console.log("entro aquiii")
			console.log("formbody",formbody)
			 axios
			.post(base_url() + "app/Usuario_colaboradores/insertarColaborador",formbody)
			.then(({ data }) => {
				if (data.resultado) {
					toastr["success"](data.mensaje);
					$("#nombreColaborador").val("");
					$("#descripcionTipoContratacion").val("");
					$("#agregarColaborador").modal("hide");
					listatipocontratacion();

					$(
						"#btnEnviar, #nombreColaborador,#apellidosColaborador,#telefonoColaborador,#correoColaborador,#rfcColaborador,#contrasenaColaborador,#contrasenaNColaborador"
					).removeAttr("disabled");
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

function listaTipoPerfil() {
	$.ajax({
		url: base_url() + "app/Perfiles_colaboradores/verTipoPerfilesColaboradores",
		dataType: "JSON",
	})
		.done((data) => {
			$("#selectTipoPerfil").html("");
			if (data.resultado) {
				$("#TipoPerfil").find("select").append(`
                <option value="Selecciona">--Selecciona--</option>
                `);
				console.log("-----", data);
				$.each(data.TipoEspecialidad, function (i, o) {
					if (o.estatus == 1 || o.estatus == 0) {
						$("#TipoPerfil")
							.find("select")
							.append(
								`
                    <option value="` +
									o.idTP +
									`">` +
									o.nombreTP +
									`</option>
                    `
							);
					}
				});
			} else {
				$("#TipoPerfil").find("select").append(`
                <option value="Selecciona">--No existen categorias para mostrar--</option>
                `);
			}
		})
		.fail();
}
function listaTipoUsuario() {
	const IDTU= $("#idTU").val();
	$.ajax({
		url:
			base_url() +
			"app/Usuario_colaboradores/TipoUsuario/",
		dataType: "JSON",
	})
		.done((data) => {


			$("#selectEspecialidad").html("");
			if (data.resultado == true) {
				$("#Especiliadad").find("select").append(`
                <option value="Selecciona">--Selecciona--</option>
                `);
				
				if(IDTU == 1){
					var TipoU = data.TipoUsuarios
					
					var arrAdmin = TipoU.filter(function(c) {
						return (c.nombreTU !== 'Cliente' && c.nombreTU !== 'Super Administrador'); 
					});

					$.each(arrAdmin, function (i, o) {
					
						$("#Especiliadad")
							.find("select")
							.append(
								`
                    <option value="` +
									o.idTU +
									`">` +
									o.nombreTU +
									`</option>
                    `
							);
					
					});
				}
				if(IDTU == 2){
					var TipoU = data.TipoUsuarios
					
					var arrAdmin = TipoU.filter(function(c) {
						return (c.nombreTU !== 'Cliente' && c.nombreTU !== 'Super Administrador' && c.nombreTU !== 'Major'); 
					});

					$.each(arrAdmin, function (i, o) {
					
						$("#Especiliadad")
							.find("select")
							.append(
								`
                    <option value="` +
									o.idTU +
									`">` +
									o.nombreTU +
									`</option>
                    `
							);
					
					});
				}
			} else {
				$("#Especiliadad").find("select").append(`
                <option value="Selecciona">--No existen categorias para mostrar--</option>
                `);
			}
		})
		.fail();
}

function agregarColaborador() {
	quitaErroresCamposVacios();
	
    let idTU= $("#idTU").val();
	listaTipoUsuario();

	$("#agregarColaborador").modal("show");
	if(idTU == 1){
		$("#nombreModal").html("Agregar Major");
	}
	if(idTU == 2){
		$("#nombreModal").html("Agregar colaborador");
	}
	

	$("#nombreColaborador").val("").attr("disabled", false);
	$("#apellidosColaborador").val("").attr("disabled", false);
	$("#telefonoColaborador").val("").attr("disabled", false);
	$("#apellidosColaborador").val("").attr("disabled", false);
	$("#correoColaborador").val("").attr("disabled", false);
	$("#rfcColaborador").val("").attr("disabled", false);
	$("#contrasenaColaborador").val("").attr("disabled", false);
	$("#contrasenaNColaborador").val("").attr("disabled", false);
	$("#acccion").val("agregar");
	$("#idU").val("0");
	$("#btnEnviar").html("Añadir");
	$("#passN").fadeIn();
	$("#passO").fadeIn();



	
	

}

function mostrarPassword(){
	var cambio = document.getElementById("contrasenaColaborador");
	if(cambio.type == "password"){
		cambio.type = "text";
		$('.icon2').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
	}else{
		cambio.type = "password";
		$('.icon2').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
	}
	
	


} 
function mostrarPasswordConfirmar(){
	var cambio = document.getElementById("contrasenaNColaborador");
	if(cambio.type == "password"){
		cambio.type = "text";
		$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
	}else{
		cambio.type = "password";
		$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
	}

	
} 
//termina funcion agregar

/**Inicia funcion editar
 * abrimos el modal para editar un nuevo tipo de contratacion
 */
function editar(id, nombre, apellidos, rfc, telefono, correo,idP, contrasenia) {
	quitaErroresCamposVacios();
	$("#errornombreColaborador").hide();
	$("#errordescripcionTipoContratacion").hide();
	$("#agregarColaborador").modal("show");
	$("#nombreModal").html("Editando Major: " + "(" + nombre + ")");
	$("#nombreColaborador").val(nombre).attr("disabled", false);
	$("#apellidosColaborador").val(apellidos).attr("disabled", false);
	$("#telefonoColaborador").val(telefono).attr("disabled", false);
	$("#correoColaborador").val(correo).attr("disabled", false);
	$("#rfcColaborador").val((rfc != "null" ? `${rfc}` : "(Ingresa el rfc)")).attr("disabled", false);
	$("#passN").fadeOut();
	$("#passO").fadeOut();


	$("#acccion").val("editar");
	$("#idU").val(id);
	$("#btnEnviar").html("Actualizar");
}

function ModalVistaPrevia(id, nombre, apellidos, rfc, telefono, correo, idP) {
	if (idP == 1) {
		idP = "Administrador";
	}
	if (idP == 2) {
		idP = "Cliente";
	} else {
		idP = "NO DEFINIDO";
	}

	$("#PreviaModal").modal("show");
	$("#tituloModalPrevia").html(
		"Detalle usuario <strong>" + nombre + "</strong>"
	);
	$("#cuerpoModalprevia").html(
		"Nombre completo: <strong>" +
			nombre +
			" " +
			apellidos +
			"</strong></br> RFC: <strong>" +
			(rfc != "null" ? `${rfc}` : "Pendiente de capturar") +
			"</strong></br> telefono: <strong>" +
			telefono +
		
			"</strong></br> correo: <strong>" +
			correo +
			"</strong></br>Sucursal: <strong>PENDIENTE</strong></br>Especialidad: <strong>" +
			idP +
			"</strong></br>Perfil usuario: <strong>PENDIENTE</strong>"
	);
	$("#btnModalBorrar").attr("appData-Id", id);
}

function modalBorrar(id, nombre, des) {
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

	$.ajax({
		url: base_url() + "app/Usuario_colaboradores/bajaLogica",
		dataType: "JSON",
		type: "POST",
		data: {
			idU: id,
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

function cambiaEstatus(id, estatus) {
	console.log("ID", id);
	console.log("Estatus", estatus);
	const idContrato = id;
	const estatusContrato = estatus;

	let accion = "CambiarEstatus";

	axios
		.post(base_url() + "app/Usuario_colaboradores/insertarColaborador", {
			idU: idContrato,
			accion: accion,
			estatus: estatusContrato,
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
	$("#errornombreColaborador").hide();
	$("#errordescripcionTipoContratacion").hide();
	$("#errorapellidosColaborador").hide();
	$("#errorcorreoColaborador").hide();
	$("#errorcontrasenaColaborador").hide();
	$("#errorrfcColaborador").hide();
	$("#errortelefonoColaborador").hide();
	$("#errorcontrasenaNColaborador").hide()
	$("#erroPerfil").hide()
	$("#errorEspecialidad").hide()
}
