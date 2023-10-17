$(document).ready(() => { 
	listaClientes();
	$("#despliegueTabla").find("tbody").html(""); 
	
});

function listaClientes() {
	axios(base_url() + "daniw/Clientes/getClientes").then(({ data: Response }) => {
		

		if (Response.resultado == true) {

			$("#despliegueTabla").html(`
			<table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
				<thead>
					<tr>
						<th>id</th>
						<th>Nombres</th>
						<th>Telefono</th>
						<th>Correo</th>
						<th style="text-align: center">Detalle compras</th>
						<th style="text-align: center">Estatus</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>`);
			$.each(Response.Clientes, function (i, o) {
				$("#datatable").find("tbody").append(
					`<tr id="tr-` + o.idU + `">
						<td>` + o.idU + `</td>
						<td>` + o.nombreU + ` ` + o.apellidos + `</td>
						<td>` + o.telefono + `</td>
						<td>` + o.correo + `</td>
						<td align="center">
							<a href="#" onclick="VistaPrevia(` + o.idU + `,'` + o.nombreU + `','` + o.apellidos + `')">
								<i class="fa-solid fa-eye fa-2x"></i>
							</a>
						</td>
						<td align="center">
							<a href="#" onclick="cambiaEstatus(` + o.idU + `)">
								<i id="icono-` + o.idU + `" class="fas fa-toggle-` + (o.estatus == 1 ? "on" : "off") + ` fa-2x"></i>
					  		</a>
						</td>
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

function VistaPrevia(id, nombre, apellidos) {

	var url = base_url() + "daniw/CVentas?id=" + id + "&nombre=" + nombre + "&apellidos=" + apellidos;
    $(location).attr("href", url);

}


function cambiaEstatus(id) {
	const idUser = id;
	// const estatus = estatus;

	// let accion = "CambiarEstatus";

	axios.post(base_url() + "daniw/Clientes/cambiaEstatus", {idU: idUser})
	.then(({ data }) => {
		if (data.resultado) {
			toastr["success"](data.mensaje);
			if ($("#icono-" + id).hasClass("fa-toggle-on")) {
				$("#icono-" + id).removeClass("fa-toggle-on");
				$("#icono-" + id).addClass("fa-toggle-off");
			} else {
				$("#icono-" + id).removeClass("fa-toggle-off");
				$("#icono-" + id).addClass("fa-toggle-on");
			}
			listaClientes();
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
