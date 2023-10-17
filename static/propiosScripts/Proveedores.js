$(document).ready(() => {
  //alert("ya estamos aqui");
  $("#datatable").find("tbody").html("");
  listaProveedores();
  setEstados();
});

function setEstados() {
  //console.log("setEstados");
  axios(base_url() + "app/Proveedores/verEstados")
    .then(({ data }) => {
        $("#estados_s").empty();
      if (data.resultado) {
        $.each(data.estados, function (i, o) {
          $("#estados_s").append(`
				<option value="` +o.estado_id +`">` +o.nombre_estado +`</option>
           `);
        });
      }
    })
    .catch((error) => {
      console.log(error);
    });
}

function setMunicipios(estado) {
  console.log("setMunicipios");
  $.ajax({
    url: base_url() + "app/Proveedores/verMunicipios",
    dataType: "JSON",
    type: "POST",
    data: {
      estado_id: estado,
    },
  })
    .done((data) => {
      //console.log(data);
      $("#municipio_s").empty();
      if (data.resultado) {
        $.each(data.municipios, function (i, o) {
          $("#municipio_s").append(`
             <option value="` +o.municipio_id +`">` +o.nombre_municipio +`</option>
            `);
        });
      }
    })
    .fail();
}

function listaProveedores() {
  axios(base_url() + "app/Proveedores/verProveedores")
    .then(({ data }) => {
      if (data.resultado) {
        console.log(data);

        $("#despliegueTabla").html(`
            <table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nombre</th>
						<th>Representante</th>
						<th>Comentarios</th>
						<th>Teléfono</th>
						<th>Dirección</th>
                        <th>Estado</th>
                        <th>Municipio</th>
                        <th style="text-align: center">Estatus</th>
                        <th style="text-align: center">Editar</th>
                        <th style="text-align: center">Borrar</th>
                    </tr>
                </thead>
                <tbody>
            
                </tbody>
            </table>`);

        $.each(data.Proveedores, function (i, o) {
          $("#datatable")
            .find("tbody")
            .append(
              `<tr id="tr-` +o.idProv +`">
                        <td>` + o.idProv +`</td>
                        <td>` +o.nombreProv +`</td>
						<td>` +o.nombreRepresentante +`</td>
                        <td>` +o.anotacion +`</td>
						<td>` +o.telefono +`</td>
                        <td>` +o.calleProv +` `+`` +(o.numProv != "" ? " #"+o.numProv : "" ) +` `+`` +(o.numInt != "" ? " int. "+o.numInt : "" ) +` `+`` +(o.colonia != "" ? " col. "+o.colonia : "" ) +` `+`` +(o.cpProv != "" ? " cp. "+o.cpProv : "" ) +` `+`</td>
						
                        <td>` +o.estado +`</td>
                        <td>` +o.municipio +`</td>
                        <td align="center"><a href="#" onclick="cambiaEstatus(` +o.idProv +`)"><i id="icono-` +o.idProv +`" class="fas fa-toggle-` +(o.estatus == 1 ? "on" : "off") +` fa-2x"></i></a></td>
                        <td align="center"><a href="#" onclick="editar('` +o.idProv +`','` +o.nombreProv +`','` +o.nombreRepresentante +`','` +o.anotacion +`','` +o.telefono +`','` +o.calleProv +`','` +o.numProv +`','` +o.numInt +`','` +o.colonia +`','` +o.cpProv +`','` +o.estadoId +`','` +o.municipioId +`','` +o.estatus +`')"><i class="fas fa-pencil fa-2x"></i></a> </td>
                        <td align="center"><a href="#" onclick="modalBorrar(` +o.idProv +`,'` +o.nombreProv +`')"><i class="fas fa-trash fa-2x"></i></a></td>
                    </tr>`
            );
        });

        $("#datatable").DataTable(),
          $(".dataTables_length select").addClass("form-select form-select-sm");
      } else {
        $("#despliegueTabla").html(data.mensaje);
      }
    })
    .catch((error) => {
      console.log(error);
    });
} // termina lista de Tipos de PAgo

function insertaProveedores() {
  quitaErroresCamposVacios();

  let id = $("#idProv").val();
  let nom = $("#nombreProveedores").val();
  let nomRep = $("#nombreRepresentante").val();
  let telefono = $("#telefono").val();
  let anotacion = $("#descripcionAnotación").val();
  let call = $("#calleProv").val();
  let num = $("#numeroProv").val();
  let numeroInt = $("#numeroInt").val();
  let col = $("#colonia").val();
  let cp = $("#cpProv").val();
  let est = $("#estados_s").val();
  let mun = $("#municipio_s").val();
  let accion = $("#accion").val();
  console.log(accion);
  let goValidation = true;
  let estatus = 1;

  if (accion == "editar") {
    estatus = $("#estatusModal").val();
  }
	

 if ("" == mun) {
    $("#errormunicipio_s").show();
    $("#errormunicipio_s").html("Debes seleccionar un municipio");
    $("#municipio_s").focus();
    goValidation = false;
  }
	
	

  if ("" == nom.trim()) {
    $("#errornombreProveedores").show();
    $("#errornombreProveedores").html("Ingresa un nombre");
    $("#nombreProveedores").focus();
    goValidation = false;
  }

  if ("" == call.trim()) {
    $("#errorcalleProv").show();
    $("#errorcalleProv").html("Ingresa una calle");
    $("#calleProv").focus();
    goValidation = false;
  }


  if ("" == num.trim()) {
    $("#errornumeroProv").show();
    $("#errornumeroProv").html("Ingresa un numero");
    $("#numeroProv").focus();
    goValidation = false;
   
  }


  if (goValidation) {
    axios
      .post(base_url() + "app/Proveedores/insertaProveedores", {
        idProv: id,
        nombreProv: nom,
		nombreRepresentante: nomRep,
		anotacion: anotacion,
		telefono: telefono,
		
        calleProv: call,
        numProv: num,
		numInt: numeroInt,
        colonia: col,
        cpProv: cp,
        estadoId: est,
        municipioId: mun,
        estatus: estatus,
        accion: accion
		
      })
      .then(({ data }) => {
        if (data.resultado) {
          toastr["success"](data.mensaje);
          $("#nombreProveedores").val("");
		  $("#nombreRepresentante").val("");
		  $("#telefono").val("");
		
		  $("#anotacionCampo").html(`
			<label for="message-text" class="col-form-label">Anotación:</label>
			<textarea class="form-control" rows="1" id="descripcionAnotación"></textarea>
			small class="text-danger" id="errordescripcionAnotación" style="display: none;"></small>
			`);
		 
          $("#calleProv").val("");
          $("#numeroProv").val("");
		  $("#numeroInt").val("");
          $("#colonia").val("");
          $("#cpProv").val("");
          $("#ModalAgregar").modal("hide");
			
			
          listaProveedores();

        } else {
          toastr["warning"](data.mensaje);
        }
      })
      .catch((error) => {
        console.log(error);
      });
  } else {
    console.log("Falta un dato");
  }
} // termina insertar tipo de pago

function agregar() {
  quitaErroresCamposVacios();

  $("#btnEnviar").html("Agregar");
  $("#ModalAgregar").modal("show");
  $("#nombreModal").html("Agregar Provedor");
  $("#nombreProveedores").val("");
  $("#nombreRepresentante").val("");
  $("#telefono").val("");
  $("#descripcionAnotación").val("");
  $("#calleProv").val("");
  $("#numeroProv").val("");
  $("#numeroInt").val("");
  $("#colonia").val("");
  $("#cpProv").val("");
  $("#estados_s").val("");
  $("#municipio_s").val("");
  $("#accion").val("Agregar");
  $("#idProv").val("0");


  $("#estados_s").change(function () {
    console.log($(this).val());
    setMunicipios($(this).val());
  });
} // termina modal agregar tipo de pago

function editar(id="", nombre="",nombreR="",anotacion="",telefono="",calle="", numero="",numInt="", colonia="", cp="", estado=0, municipio=0, estatus=0) {
	

	
  quitaErroresCamposVacios();
	
 
  setMunicipios(estado);
  $("#btnEnviar").html("Actualizar");
  $("#accion").val("editar");
  $("#ModalAgregar").modal("show");
  $("#nombreModal").html("Editar Provedor");
  setTimeout(() => {
  $("#nombreProveedores").val(nombre);
  $("#nombreRepresentante").val(nombreR);
  $("#descripcionAnotación").val(anotacion);
  $("#telefono").val(telefono);
  $("#calleProv").val(calle);
  $("#numeroProv").val(numero);
  $("#numeroInt").val(numInt);
  $("#colonia").val(colonia);
  $("#cpProv").val(cp);
  $(`#estados_s`).val(estado);
  $("#municipio_s").val(municipio);
  $("#estatusModal").val(estatus);
  $("#idProv").val(id);
  if ($("#icono-" + id).hasClass("fa-toggle-on")) {
    $("#estatusModal").val("1");
  } else {
    $("#estatusModal").val("0");
  }
  }, 1000);

  $("#estados_s").change(function () {
    console.log($(this).val());
    setMunicipios($(this).val());
  });
} // temrina modal editar tipo de pago

function cambiaEstatus(id) {
  $.ajax({
    url: base_url() + "app/Proveedores/cambioEstatus",
    dataType: "JSON",
    type: "POST",
    data: {
      id: id,
    },
  })
    .done((data) => {
      if (data.resultado) {
        toastr["success"](data.mensaje);

        if ($("#icono-" + id).hasClass("fa-toggle-on")) {
          $("#icono-" + id).removeClass("fa-toggle-on");
          $("#icono-" + id).addClass("fa-toggle-off");
        } else {
          $("#icono-" + id).removeClass("fa-toggle-off");
          $("#icono-" + id).addClass("fa-toggle-on");
        }
      } else {
        toastr["warning"](data.mensaje);
      }
    })
    .fail();
}

function modalBorrar(id, nombre, des) {
  $("#borrarModal").modal("show");
  $("#tituloModalBorrar").html("Borrar <strong>" + nombre + "</strong>");
  $("#cuerpoModalBorrar").html(
    "Estas seguro que deseas borrar: <strong>" +
      nombre +
      "</strong>"
  );
  $("#btnModalBorrar").attr("appData-Id", id);
} // temrina modal editar tipo de pago

function btnModalBorrar() {
  let id = $("#btnModalBorrar").attr("appData-Id");

  $.ajax({
    url: base_url() + "app/Proveedores/bajaLogica",
    dataType: "JSON",
    type: "POST",
    data: {
      id: id,
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

function quitaErroresCamposVacios() {
  $("#errornombreProveedores").hide();
  $("#errorcalleProv").hide();
  $("#errornumeroProv").hide();
  $("#errormunicipio_s").hide();
	
}
