$(document).ready(() => {
  //alert("ya estamos aqui");
  $("#datatable").find("tbody").html("");
  listaSucursales();
  setEstados();
});

function setEstados() {
  //console.log("setEstados");
  axios(base_url() + "app/Sucursales/verEstados")
    .then(({ data }) => {
        $("#estados_s").empty();
      if (data.resultado) {
        $.each(data.estados, function (i, o) {
          $("#estados_s").append(
            `
                    <option value="` +
              o.estado_id +
              `">` +
              o.nombre_estado +
              `</option>
                `
          );
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
    url: base_url() + "app/Sucursales/verMunicipios",
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
          $("#municipio_s").append(
            `
                    <option value="` +
              o.municipio_id +
              `">` +
              o.nombre_municipio +
              `</option>
                `
          );
        });
      }
    })
    .fail();
}

function listaSucursales() {
  axios(base_url() + "app/Sucursales/verSucursales")
    .then(({ data }) => {
      if (data.resultado) {
        console.log(data);

        $("#despliegueTabla").html(`
            <table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nombre</th>
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

        $.each(data.sucursales, function (i, o) {
          $("#datatable")
            .find("tbody")
            .append(
              `
                    <tr id="tr-` +
                o.idSuc +
                `">
                        <td>` +
                o.idSuc +
                `</td>
                        <td>` +
                o.nombreSuc +
                `</td>
                        <td>` +
                        o.estado +
                        `</td>
                        <td>` +
                        o.municipio +
                        `</td>
                        <td align="center"><a href="#" onclick="cambiaEstatus(` +
                o.idSuc +
                `)"><i id="icono-` +
                o.idSuc +
                `" class="fas fa-toggle-` +
                (o.estatus == 1 ? "on" : "off") +
                ` fa-2x"></i></a></td>
                        <td align="center"><a href="#" onclick="editar(` +
                o.idSuc +
                `,'` +
                o.nombreSuc +
                `','` +
                o.calleSuc +
                `','` +
                o.numSuc +
                `','` +
                o.coloniaSuc +
                `','` +
                o.cpSuc +
                `','` +
                o.estadoSuc +
                `','` +
                o.munisipioSuc +
                `','` +
                o.estatus +
                `')"><i class="fas fa-pencil fa-2x"></i></a> </td>
                        <td align="center"><a href="#" onclick="modalBorrar(` +
                o.idSuc +
                `,'` +
                o.nombreSuc +
                `')"><i class="fas fa-trash fa-2x"></i></a></td>
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
} // termina lista sucursales



function quitaErroresCamposVacios() {
  $("#errornombreSucursales").hide();
  $("#errorcalleSucursales").hide();
  $("#errornumeroSucursales").hide();
  $("#errorcoloniaSucursales").hide();
  $("#errorcpSucursales").hide();
  $("#errormunicipio_s").hide();
}





function insertaSucursales() {
  quitaErroresCamposVacios();

  let idTP = $("#idFP").val();
  let nom = $("#nombreSucursales").val();
  let call = $("#calleSuc").val();
  let num = $("#numeroSuc").val();
  let col = $("#coloniaSuc").val();
  let cp = $("#cpSuc").val();
  let est = $("#estados_s").val();
  let mun = $("#municipio_s").val();
  let accion = $("#accion").val();
  console.log("municipio ", mun);
  let goValidation = true;
  let estatus = 1;

  if (accion == "editar") {
    estatus = $("#estatusModal").val();
  }

  if ("" == nom.trim()) {
    $("#errornombreSucursales").show();
    $("#errornombreSucursales").html("Ingresa un nombre");
    $("#nombreSucursales").focus();
    goValidation = false;
  }

  if ("" == call.trim()) {
    $("#errorcalleSucursales").show();
    $("#errorcalleSucursales").html("Ingresa una calle");
    $("#calleSuc").focus();
    goValidation = false;
  }


  if ("" == num.trim()) {
    $("#errornumeroSucursales").show();
    $("#errornumeroSucursales").html("Ingresa un numero");
    $("#numeroSuc").focus();
    goValidation = false;
   
  }

  if ("" == col.trim()) {
    $("#errorcoloniaSucursales").show();
    $("#errorcoloniaSucursales").html("Ingresa una colonia");
    $("#coloniaSuc").focus();
    goValidation = false; 
  }

  if ("" == cp.trim()) {
    $("#errorcpSucursales").show();
    $("#errorcpSucursales").html("Ingresa un codigo postal");
    $("#cpSuc").focus();
    goValidation = false; 
  }
	
	// let mun = $("#municipio_s").val();
if( mun == "--Selecciona--" ){
   $("#errormunicipio_s").show();
    $("#errormunicipio_s").html("Selecciona un municipio");
    $("#municipio_s").focus();
    goValidation = false;
   
	
}	
	

  if (goValidation) {
    axios
      .post(base_url() + "app/Sucursales/insertaSucursales", {
        idSuc: idTP,
        nombreSuc: nom,
        calleSuc: call,
        numSuc: num,
        coloniaSuc: col,
        cpSuc: cp,
        estadoSuc: est,
        munisipioSuc: mun,
        estatus: estatus,
        accion: accion,
      })
      .then(({ data }) => {
        if (data.resultado) {
          toastr["success"](data.mensaje);
          $("#nombreSucursales").val("");
          $("#calleSuc").val("");
          $("#numeroSuc").val("");
          $("#coloniaSuc").val("");
          $("#cpSuc").val("");
          $("#ModalAgregar").modal("hide");
          listaSucursales();

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

 
  $("#calleSuc").val("");
  $("#numeroSuc").val("");
  $("#coloniaSuc").val("");
  $("#cpSuc").val("");
  $("#municipio_s").val();	
  $("#btnEnviar").html("Agregar");
  $("#ModalAgregar").modal("show");
  $("#nombreModal").html("Agregar Sucursal");
  $("#nombreSucursales").val("");
  $("#accion").val("Agregar");
  $("#idFP").val("0");
  $("#estados_s").change(function () {
    console.log($(this).val());
    setMunicipios($(this).val());
  });
} // termina modal agregar tipo de pago

function editar(id, nombre, calle, numero, colonia, cp, estado, municipio, estatus) {
  quitaErroresCamposVacios();
 
  setMunicipios(estado);
  $("#btnEnviar").html("Actualizar");
  $("#accion").val("editar");
  $("#ModalAgregar").modal("show");
  $("#nombreModal").html("Editar Sucursal");
  setTimeout(() => {
  $("#nombreSucursales").val(nombre);
  $("#calleSuc").val(calle);
  $("#numeroSuc").val(numero);
  $("#coloniaSuc").val(colonia);
  $("#cpSuc").val(cp);
  $(`#estados_s`).val(estado);
  $("#municipio_s").val(municipio);
  $("#estatusModal").val(estatus);
  $("#idFP").val(id);
  if ($("#icono-" + id).hasClass("fa-toggle-on")) {
    $("#estatusModal").val("1");
  } else {
    $("#estatusModal").val("0");
  }
  }, 500);

  $("#estados_s").change(function () {
    console.log($(this).val());
    setMunicipios($(this).val());
  });
} // temrina modal editar tipo de pago

function cambiaEstatus(id) {
  $.ajax({
    url: base_url() + "app/Sucursales/cambioEstatus",
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
    url: base_url() + "app/Sucursales/bajaLogica",
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


