$(document).ready(() => {
  listatipocontratacion();

  $("#contrasenas").html(`
    <div class="form-group col-6" id="passN">
      <label for="exampleInputPassword1">Contraseña <span style="color:red;">*</span></label>
      <div class="input-group">
        <input type="password" class="form-control" id="contrasenaColaborador" placeholder="Contraseña">
        <div class="input-group-append">
          <button id="contraseñaV" class="btn btn-primary" type="button" onclick="mostrarPassword()"> 
            <span class="fa fa-eye-slash icon2"></span>
          </button>
        </div>
        <small class="text-danger" id="errorcontrasenaColaborador" style="display: none;"></small>
        <small class="text-danger" id="errorcontrasenaColaborador1" style="display: none;"></small>
      </div>
    </div>
    <div class="form-group col-6" id="passO">
      <label for="exampleInputPassword1">Contraseña <span style="color:red;">*</span></label>
      <div class="input-group">
        <input type="password" class="form-control" id="contrasenaNColaborador" placeholder="Confirmar contraseña">
        <div class="input-group-append">
          <button id="contraseñaV2" class="btn btn-primary" type="button" onclick="mostrarPasswordConfirmar()"> 
            <span class="fa fa-eye-slash icon"></span>
          </button>
        </div>
        <small class="text-danger" id="errorcontrasenaNColaborador"style="display: none;"></small>
      </div>
    </div>
  `);
});

function listatipocontratacion() {
  axios(base_url() + "app/Usuario_colaboradores/verListaColaboradores")
  .then(({ data: Response }) => {
    if (Response.resultado) {
      
      $("#despliegueTabla").html(`
        <table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
          <thead>
            <tr>
              <th>id</th>
              <th>Nombre</th>
              <th>Telefono</th>
              <th>Correo</th>
              <th style="text-align: center">Detalle usuario</th>
              <th style="text-align: center">Estatus</th>
              <th style="text-align: center">Editar</th>
              <th style="text-align: center">Borrar</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>`
      );
      
      $.each(Response.ListaColaboradores, function (i, o) {
        $("#datatable").find("tbody").append(` 
          <tr>
            <td>` + o.idU + `</td>
            <td>` + o.nombreU + ` ` + o.apellidos + `</td>
            <td>` + (o.telefono ? o.telefono : "No disponible") + `</td> 
            <td>` + o.correo + `</td>
            <td align="center">
              <a href="#" onclick="ModalVistaPrevia(` + o.idU + `)">
                <i class="fas fa-list fa-2x"></i>
              </a>
            </td>
            <td align="center">
              <a href="#" onclick="cambiaEstatus(` + o.idU + `,'` + o.estatus + `')">` +
              (o.estatus == 1 ? '<i class="fas fa-toggle-on fa-2x"></i>' : '<i class="fas fa-toggle-off fa-2x"></i>') +
              `</a>
            </td>
            <td align="center">
              <a href="#" onclick="editar(` + o.idU + `,'` + o.nombreU + `','` + o.apellidos + `','` + (o.rfc ? o.rfc : "") + `','`  + (o.sueldo ? o.sueldo : "") + `','` + (o.telefono ? o.telefono : "") + `','` + o.correo + `','` + o.idP + `','` + o.idEsp + `','` + o.idSuc + `')">
                <i class="fas fa-pencil fa-2x"></i>
              </a> 
            </td>
            <td align="center">
              <a href="#" onclick="modalBorrar(` + o.idU + `,'` + o.nombreU + `','` + o.desTC + `')">
                <i class="fas fa-trash fa-2x"></i>
              </a>
            </td>
          </tr>
        `);
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

function habilitarCampos() {
  $("#btnEnviar, #nombreColaborador,#apellidosColaborador,#correoColaborador,#contrasenaColaborador,#rfcColaborador,#sueldoColaborador,#telefonoColaborador,#contrasenaNColaborador,#perfilColaborador,#especialidadColaborador,#sucursalColaborador").removeAttr("disabled");
}

function InsertarColaborador() {

  $(
    "#btnEnviar, #nombreColaborador,#apellidosColaborador,#rfcColaborador,#telefonoColaborador,#correoColaborador,#sueldoColaborador,#contrasenaColaborador,#contrasenaNColaborador,#perfilColaborador,#especialidadColaborador,#sucursalColaborador"
  ).attr("disabled", "disabled");

  quitaErroresCamposVacios();

  let rfc     = $("#rfcColaborador").val() !== "" ? $("#rfcColaborador").val() : null;
  let tel     = $("#telefonoColaborador").val() !== "" ? $("#telefonoColaborador").val() : null;
  let sueldo  = $("#sueldoColaborador").val() !== "" ? $("#sueldoColaborador").val() : null;
  let TEsp    = $("#especialidadColaborador").val() !== "" ? $("#especialidadColaborador").val() : null; 
  let contra  = $("#contrasenaColaborador").val() !== "" ? $("#contrasenaColaborador").val() : null;

  let accion = $("#acccion").val();
  let idU = $("#idU").val();
  let nom = $("#nombreColaborador").val();
  let apell = $("#apellidosColaborador").val();
  let correo = $("#correoColaborador").val();
  
  let contraValida = $("#contrasenaNColaborador").val();
  let TPerfil = $("#perfilColaborador").val();
  let Suc = $("#sucursalColaborador").val();
  //let Major = 3;

  let goValidation = true;

  const validRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
  if (accion == "editar") {
    estatus = $("#estatusModal").val(); 

    if ("" == nom.trim()) {
      $("#errornombreColaborador").show();
      $("#errornombreColaborador").html("Ingresa el nombre del colaborador");
      $("#nombreColaborador").focus();
      goValidation = false;
      habilitarCampos();
    }

    if ("" == apell.trim()) {
      $("#errorapellidosColaborador").show();
      $("#errorapellidosColaborador").html("Ingresa los apellido del colaborador");
      $("#apellidosColaborador").focus();
      goValidation = false;
      habilitarCampos();
    }
    
    if (tel !== null && (isNaN(tel) || tel.length !== 10)) {
      $("#errortelefonoColaborador").show();
      $("#errortelefonoColaborador").html("Teléfono no permitido");
      $("#telefonoColaborador").focus();
      goValidation = false;
      habilitarCampos();
    } 

    if (rfc !== null && rfc.length !== 13) {
      $("#errorrfcColaborador").show();
      $("#errorrfcColaborador").html("Solo se permiten 13 dígitos");
      $("#rfcColaborador").focus();
      goValidation = false;
      habilitarCampos();
    }
  
    if (!correo.match(validRegex)) {
      $("#errorcorreoColaborador").show();
      $("#errorcorreoColaborador").html("Ingresa un correo valido");
      $("#correoColaborador").focus();
      goValidation = false;
      habilitarCampos();
    }

    if ("" == correo.trim()) {
      $("#errorcorreoColaborador").show();
      $("#errorcorreoColaborador").html("Ingresa el correo del colaborador");
      $("#correoColaborador").focus();
      goValidation = false;
      habilitarCampos();
    }

    if ("" == TPerfil.trim()) {
      $("#errorPerfilColaborador").show();
      $("#errorPerfilColaborador").html("Seleccione tipo de perfil");
      $("#perfilColaborador").focus(); 
      goValidation = false;
      habilitarCampos();
    }

    if ("" == Suc.trim()) {
      $("#errorSucursalColaborador").show();
      $("#errorSucursalColaborador").html("Seleccione sucursal");
      $("#sucursalColaborador").focus();
      goValidation = false;
      habilitarCampos();
    }
  } else {
    if ("" == nom.trim()) {
      $("#errornombreColaborador").show();
      $("#errornombreColaborador").html("Ingresa el nombre del colaborador");
      $("#nombreColaborador").focus();
      goValidation = false;
      habilitarCampos();
    }

    if ("" == apell.trim()) {
      $("#errorapellidosColaborador").show();
      $("#errorapellidosColaborador").html(
        "Ingresa los apellido del colaborador"
      );
      $("#apellidosColaborador").focus();
      goValidation = false;
      habilitarCampos();
    }
    
    if (tel !== null && (isNaN(tel) || tel.length !== 10)) {
      $("#errortelefonoColaborador").show();
      $("#errortelefonoColaborador").html("Teléfono no permitido");
      $("#telefonoColaborador").focus();
      goValidation = false;
      habilitarCampos();
    } 

    if (rfc !== null && rfc.length !== 13) {
      $("#errorrfcColaborador").show();
      $("#errorrfcColaborador").html("Solo se permiten 13 dígitos");
      $("#rfcColaborador").focus();
      goValidation = false;
      habilitarCampos();
    }
  
    if (!correo.match(validRegex)) {
      $("#errorcorreoColaborador").show();
      $("#errorcorreoColaborador").html("Ingresa un correo valido");
      $("#correoColaborador").focus();
      goValidation = false;
      habilitarCampos();
    }

    if ("" == correo.trim()) {
      $("#errorcorreoColaborador").show();
      $("#errorcorreoColaborador").html("Ingresa el correo del empleado");
      $("#correoColaborador").focus();
      goValidation = false;
      habilitarCampos();
    }

    if ("" == contra.trim() || contra.length < 5) {
      if ("" == contra.trim()) {
        $("#errorcontrasenaColaborador").show();
        $("#errorcontrasenaColaborador").html("Ingresa la contraseña del empleado");
        $("#contrasenaColaborador").focus();
        goValidation = false;
        habilitarCampos();
      }
      if (contra.length < 5) {
        $("#errorcontrasenaColaborador").show();
        $("#errorcontrasenaColaborador").html("La contraseña es demasiado corta");
        $("#contrasenaColaborador").focus();
        goValidation = false;
        habilitarCampos();
      }

    }

    if (contra != contraValida) {

      $("#errorcontrasenaNColaborador").show();
      $("#errorcontrasenaNColaborador").html(
        "Las contraseñas no coinciden, por favor verificalas"
      );

      $("#errorcontrasenaColaborador").show();
      $("#errorcontrasenaColaborador").html(
        "Las contraseñas no coinciden, por favor verificalas"
      );
      $("#contrasenaColaborador").focus();
      goValidation = false;
      habilitarCampos();
      
    }
    
    if ("" == contraValida.trim()) {
      $("#errorcontrasenaNColaborador").show();
      $("#errorcontrasenaNColaborador").html(
        "Ingresa la contraseña del empleado"
      );
      $("#contrasenaNColaborador").focus();
      goValidation = false;
      habilitarCampos();
    }

    if ("" == TPerfil.trim()) {
      $("#errorPerfilColaborador").show();
      $("#errorPerfilColaborador").html("Seleccione tipo de perfil");
      $("#perfilColaborador").focus(); 
      goValidation = false;
      habilitarCampos();
    }

    if ("" == Suc.trim()) {
      $("#errorSucursalColaborador").show();
      $("#errorSucursalColaborador").html("Seleccione sucursal");
      $("#sucursalColaborador").focus();
      goValidation = false;
      habilitarCampos();
    }
  }

  // if (accion == "editar") {
  //   estatus = $("#estatusModal").val(); 
  // }

  if (goValidation) {
    data = {
      idU: idU,
      nombreU: nom,
      apellidos: apell,
      rfc: rfc,
      correo: correo,
      accion: accion,
      contrasenia: contra,
      telefono: tel,
      idTU: 3,
      idP: TPerfil,
      idSuc: Suc,
      estatus: 1,
      sueldo: sueldo,
      idEsp: TEsp,
    };

    //if (data != null) {
      axios.post(base_url() + "app/Usuario_colaboradores/insertarColaborador", data)
      .then(({ data }) => {
        if (data.resultado) {
          toastr["success"](data.mensaje);
          $("#nombreColaborador").val("");
          $("#apellidosColaborador").val("");
          $("#rfcColaborador").val("");
          $("#telefonoColaborador").val("");
          $("#correoColaborador").val("");
          $("#sueldoColaborador").val("");
          $("#contrasenaColaborador").val("");
          $("#contrasenaNColaborador").val("");
          $("#perfilColaborador").val("");
          $("#especialidadColaborador").val("");
          $("#sucursalColaborador").val("");
          $("#agregarColaborador").modal("hide");
          listatipocontratacion();

          habilitarCampos();
        } else {
          let res = "Ocurrio un error en: ";
          if (data.StatusCo == false) {
            toastr["warning"](res + (data.StatusCo == false ? `${data.ResCorreo}` : null));
          }
          if (data.StatusTe == false) {
            toastr["warning"](res + (data.StatusTe == false ? `${data.ResTelefono}` : null));
          }

          habilitarCampos(); 
        }
      })
      .catch((error) => {
        console.log(error);
      });
    //}
  } else {
    console.log("Falta datos para completar el formulario");
  }
}

function listaTipoPerfil(idP) {
  
  $.ajax({
    url: base_url() + "app/Perfiles_colaboradores/verTipoPerfilesColaboradores",
    dataType: "JSON",
  })
  .done((data) => {
    $("#perfilColaborador").html("");
    if (data.resultado) {
      $("#perfilColaborador").append(`
        <option value="">Selecciona</option>
        `);
      $.each(data.TipoEspecialidad, function (i, o) {
        if (o.estatus == 1 || o.estatus == 0) {
          $("#perfilColaborador").append(
            `<option value="` + o.idTP +`"` + (o.idTP === idP ? "selected" : "") +`>` + o.nombreTP + `</option>`
          );
        }
      });
    } else {
      $("#perfilColaborador").append(`
        <option value="Selecciona">No existen tipos de perfil</option>
        `);
    }
  })
  .fail();
}

function listaEspecialidad(idEsp) {
  $.ajax({
    url: base_url() + "app/Especialidad_colaborador/verTipoEspecialidadesColaboradores",
    dataType: "JSON"
  })
  .done((data) => {
    $("#especialidadColaborador").html("");
    if (data.resultado == true) {
      $("#especialidadColaborador").append(`
        <option value="">Selecciona</option>
        `);
      $.each(data.tipoEspecialidadC, function (i, o) {
        if (o.estatus == 1) {
          $("#especialidadColaborador").append(`
            <option value="` + o.idEsp + `"` + (o.idEsp === idEsp ? "selected" : "") +`>` + o.nombreEsp + `</option>
          `);
        }
      });
    } else {
      $("#especialidadColaborador").append(`
        <option value="">No existen especialidades</option>
      `);
    }
  })
  .fail();
}

function listaSucursal(idSuc) {
  $.ajax({
    url: base_url() + "app/Sucursales/verSucursales/",
    dataType: "JSON",
  })
  .done((data) => {

    $("#sucursalColaborador").html("");
    if (data.resultado == true) {
      $("#sucursalColaborador").append(`
        <option value="">Selecciona</option>
        `);
      $.each(data.sucursales, function (i, o) {
        if (o.estatus == 1) {
          $("#sucursalColaborador").append(`
            <option value="` + o.idSuc + `"` + (o.idSuc === idSuc ? "selected" : "") +`>` + o.nombreSuc + `</option>
          `);
        }
      });
    } else {
      $("#especialidadColaborador").append(`
        <option value="Selecciona">No existen sucursales</option>
      `);
    }
  })
  .fail();
}

function agregarColaborador() {
  quitaErroresCamposVacios(); 

  listaTipoPerfil();
  listaEspecialidad();
  listaSucursal();

  $("#agregarColaborador").modal("show");
  $("#nombreModal").html("Agregar empleado");
  
  $("#nombreColaborador").val("");
  $("#apellidosColaborador").val("");
  $("#rfcColaborador").val("");
  $("#telefonoColaborador").val("");
  $("#correoColaborador").val("");
  $("#sueldoColaborador").val("");
  $("#contrasenaColaborador").val("");
  $("#contrasenaNColaborador").val("");
  $("#acccion").val("agregar");
  $("#idU").val("0");
  $("#btnEnviar").html("Añadir");

  $("#contrasenas").html(`
    <div class="form-group col-6 pl-1 pr-2" id="passN"> 
      <label for="exampleInputPassword1">Contraseña <span style="color:red;">*</span></label>
      <div class="input-group">
        <input type="password" class="form-control" id="contrasenaColaborador" placeholder="Contraseña">
        <div class="input-group-append">
          <button id="contraseñaV" class="btn btn-primary" type="button" onclick="mostrarPassword()"> 
            <span class="fa fa-eye-slash icon2"></span>
          </button>
        </div>
        <small class="text-danger" id="errorcontrasenaColaborador" style="display: none;"></small>
        <small class="text-danger" id="errorcontrasenaColaborador1" style="display: none;"></small>
      </div>
    </div>
    <div class="form-group col-6 pl-4 pr-0" id="passO"> 
      <label for="exampleInputPassword1">Contraseña <span style="color:red;">*</span></label>
      <div class="input-group">
        <input type="password" class="form-control" id="contrasenaNColaborador" placeholder="Confirmar contraseña">
        <div class="input-group-append">
          <button id="contraseñaV2" class="btn btn-primary" type="button" onclick="mostrarPasswordConfirmar()"> 
            <span class="fa fa-eye-slash icon"></span>
          </button>
        </div>
        <small class="text-danger" id="errorcontrasenaNColaborador"style="display: none;"></small>
      </div>
    </div>
  `);
}

function mostrarPassword() {
  var cambio = document.getElementById("contrasenaColaborador");
  if (cambio.type == "password") {
    cambio.type = "text";
    $(".icon2").removeClass("fa fa-eye-slash").addClass("fa fa-eye");
  } else {
    cambio.type = "password";
    $(".icon2").removeClass("fa fa-eye").addClass("fa fa-eye-slash");
  }
}
function mostrarPasswordConfirmar() {
  var cambio = document.getElementById("contrasenaNColaborador");
  if (cambio.type == "password") {
    cambio.type = "text";
    $(".icon").removeClass("fa fa-eye-slash").addClass("fa fa-eye");
  } else {
    cambio.type = "password";
    $(".icon").removeClass("fa fa-eye").addClass("fa fa-eye-slash");
  }
}

function editar(id, nombre, app, rfc, sueldo, tel, correo, idP, idEsp, idSuc) {
  $("#agregarColaborador").modal("show");
  quitaErroresCamposVacios();
  
  
  //(o.telefono ? o.telefono : "No disponible") 
    $("#nombreColaborador").val(nombre).attr("disabled", false);
    $("#apellidosColaborador").val(app).attr("disabled", false);
    $("#telefonoColaborador").val(tel).attr("disabled", false); 
    $("#correoColaborador").val(correo).attr("disabled", false);
    $("#rfcColaborador").val(rfc).attr("disabled", false);
    $("#sueldoColaborador").val(sueldo).attr("disabled", false);
    // $("#perfilColaborador").val(idP).attr("disabled", false);
    // $("#especialidadColaborador").val(o.idEsp).attr("disabled", false);
    // $("#sucursalColaborador").val(o.idSuc).attr("disabled", false);
    $("#acccion").val("editar");
    $("#idU").val(id);
      

    // });
    $("#nombreModal").html("Editando colaborador: " + "(" + nombre + ")");
    $("#btnEnviar").html("Actualizar");
    $("#contrasenas").html('');
    listaTipoPerfil(idP);
    listaEspecialidad(idEsp);
    listaSucursal(idSuc); 

}

function ModalVistaPrevia(id) {
  $("#PreviaModal").modal("show");

  axios.post(base_url() + "app/Usuario_colaboradores/verColaborador", {id: id})
  .then(({ data : Response }) => {

    $.each(Response.Detalle, function (i, o) {

      $("#tituloModalPrevia").html('Detalle usuario: <strong>"' + o.nombreU + '"</strong>');
      $("#cuerpoModalprevia").html(
        "Nombre completo: <strong>" + o.nombreU + " " + o.apellidos + "</strong></br>" +
        "RFC: <strong>" + (o.rfc ? o.rfc : "No disponible") + "</strong></br>" + 
        "Teléfono : <strong>" + (o.telefono ? o.telefono : "No disponible") + "</strong></br>" + 
        "Correo: <strong>" + o.correo + "</strong></br>" + 
        "Sueldo: <strong>" + (o.sueldo ? ` $`+o.sueldo : "No disponible") + "</strong></br>" + 
        "Sucursal: <strong>" + (o.sucursal ? o.sucursal : "No disponible") + "</strong></br>" + 
        "Especialidad: <strong>" + o.especialidad + "</strong></br>" + 
        "Perfil usuario: <strong>" + o.perfil + "</strong>"
      );
    });
  })
  .catch((error) => {
    console.log("error", error);
  });
}

function modalBorrar(id, nombre, des) {
  $("#borrarModal").modal("show");
  $("#tituloModalBorrar").html("Borrar usuario: <strong>" + nombre + "</strong>");
  $("#cuerpoModalBorrar").html(
    "¿Estas seguro que deseas borrar?<br> <strong>" + nombre + "</strong>"
  );
  $("#btnModalBorrar").attr("appData-Id", id);  
}

function btnModalBorrar() {
  let id = $("#btnModalBorrar").attr("appData-Id");

  $.ajax({
    url: base_url() + "app/Usuario_colaboradores/bajaLogica",
    dataType: "JSON",
    type: "POST",
    data: {idU: id}
  })
  .done((data) => {
    if (data.resultado) {
      toastr["success"](data.mensaje);
      $("#tr-" + id).remove();
      $("#borrarModal").modal("hide");
      listatipocontratacion();
    } else {
      toastr["warning"](data.mensaje);
      $("#borrarModal").modal("hide");
    }
  })
  .fail();
}

function cambiaEstatus(id, estatus) {
  const idContrato = id;
  const estatusContrato = estatus;

  let accion = "CambiarEstatus";

  axios.post(base_url() + "app/Usuario_colaboradores/insertarColaborador", {
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
  $("#errorsueldoColaborador").hide();
  $("#errorcontrasenaColaborador").hide();
  $("#errorrfcColaborador").hide();
  $("#errortelefonoColaborador").hide();
  $("#errorcontrasenaNColaborador").hide();
  $("#errorPerfilColaborador").hide();
  $("#errorEspecialidadColaborador").hide();
  $("#errorSucursalColaborador").hide();
}
