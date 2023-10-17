$(document).ready(() => {
  InformacionUsuario();

  // $("#idUsu").val();
  // let idU= $("#idTU").val();

  informacionPersonal();

  /*
    if(idU != 2){

      informacionPersonal();
      Eliminamos de la lista los siguientes tabs para cargar la vista del idTU = 1 
      $('[id="3"]').remove(); 
      $('[id="3"]').remove(); 
      $('[name="empresa"]').remove();
        
    } 
  */
});

function InformacionUsuario() {

  $("#despliegueTabla").html(`
    <ul class="nav nav-tabs card-header-tabs " role="tablist">
      <li class="nav-item"  id="1">
        <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="true">
          <h3>Información personal</h3>
        </a>
      </li>
      <li class="nav-item" id="2">
        <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-selected="false" onclick="mostrarDF()">
            <h3>Datos Fiscales</h3>
        </a>
      </li>  
    </ul>
  `)
}

function informacionPersonal() {
  removerErrores();
  let idUsuario = $("#idUsu").attr("value");


  $.ajax({
    "url": base_url() + "daniw/Perfil_usuario/getUsuario",
    "dataType": "JSON",
    "type": "POST",
    "data": {
      idU: idUsuario
    }
  })
    .done((data) => {
      let o = data.Usuario

      $("#nombreUsuperfil").html(o.nombreU + " " + o.apellidos)
      $("#nombre").val(o.nombreU);
      $("#apellidos").val(o.apellidos);
      $("#correo").val(o.correo);
      $("#telefono").val(o.telefono);

    })
    .fail();

}

// Actuliza datos principales
function updateDatos() {

  id = $("#idUsu").val();
  let nombre = $("#nombre").val();
  let apellidos = $("#apellidos").val();
  let tel = $("#telefono").val();
  let correo = $("#correo").val();
  //let emailRegex   = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

  var r = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
  goValidation = true;


  // Validaciones:
  if ("" == nombre.trim()) {
    $('#errorNombre').show();
    $('#errorNombre').html("Ingresa tu nombre");
    $('#nombre').focus();
    goValidation = false;
  }

  if ("" == apellidos.trim()) {
    $('#errorApellidos').show();
    $('#errorApellidos').html("Ingresa tus apellidos");
    $('#apellidos').focus();
    goValidation = false;
  }

  if ("" == correo.trim()) {
    $('#errorCorreo').show();
    $('#errorCorreo').html("Ingresa tu correo");
    $('#correo').focus();
    goValidation = false;
  } else if (!(r.test(correo.trim()))) {
    $('#errorCorreo').show();
    $('#errorCorreo').html("formato usuario@dominio.com");
    $('#correo').focus();
    goValidation = false;
  }

  if ("" == tel.trim()) {
    $('#errorTelefono').show();
    $('#errorTelefono').html("Ingresa tu telefono");
    $('#telefono').focus();
    goValidation = false;
  }

  if (goValidation == true) {

    $.ajax({
      "url": base_url() + "daniw/Perfil_usuario/ActualizarPerfil",
      "dataType": "JSON",
      "type": "POST",
      "data": {
        idU: id,
        nombreU: nombre,
        apellidos: apellidos,
        telefono: tel,
        correo: correo,
      }
    })
      .done((data) => {

        if (data.resultado == true) {

          toastr["success"](data.mensaje);
        }
        if (data.resultado == false) {
          info = data.info
          toastr["warning"]("Registra uno diferente ", data.ResTelefono);

          $("#nombrePerfilUsuario").val(info.nombreU).attr("disabled", false);
          $("#apellidoPerfilUsuario").val(info.apellidos).attr("disabled", false);
          $("#telefonoPerfilUsuario").val(info.telefono).attr("disabled", false);
          $("#btnEnviar").attr("disabled", false);
        }

      })
      .fail();
  }

}

// Actualiza contraseña
function updatePass() {
  removerErrores()
  let idUsuario = $("#idUsu").attr("value");
  let pass = $("#password").val()
  let pass1 = $("#password2").val()
  let pass2 = $("#password3").val()

  goValidation = true;

  if ("" == pass.trim()) {
    $('#errorPassword').show();
    $('#errorPassword').html("Ingresa tu contraseña");
    $('#password').focus();
    goValidation = false;

  }
  if ("" == pass1.trim()) {
    $('#errorPassword2').show();
    $('#errorPassword2').html("Campo vacio");
    $('#password2').focus();
    goValidation = false;

  }
  if ("" == pass2.trim()) {
    $('#errorPassword3').show();
    $('#errorPassword3').html("Campo vacio");
    $('#password3').focus();
    goValidation = false;

  }


  if (pass1 != pass2 || pass2 != pass1) {
    console.log("contraseñas no coinciden")
    $('#errorPassword2').show();
    $('#errorPassword2').html("Contraseñas no coinciden");
    $('#password2').focus();

    $('#errorPassword3').show();
    $('#errorPassword3').html("Contraseñas no coinciden");
    $('#password3').focus();

    goValidation = false;
  }

  if (goValidation == true) {

    $.ajax({
      "url": base_url() + "daniw/Perfil_usuario/updatePass",
      "dataType": "JSON",
      "type": "POST",
      "data": {
        idU: idUsuario,
        pass: pass,
        passN: pass1,
      }
    })
      .done((data) => {
        if (data.resultado) {
          toastr["success"](data.mensaje);
          $("#password").val("")
          $("#password2").val("")
          $("#password3").val("")

        } else {
          if (data.Status == false) {
            toastr["warning"](data.Pass + ", Verifica tu contraseña");
          }
        }

      })
      .fail();
  }
}

// Cambiar tipo input: text-password
function mostrarPassword() {
  var cambio = document.getElementById("password");
  if (cambio.type == "password") {
    cambio.type = "text";
    $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
  } else {
    cambio.type = "password";
    $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
  }
}

function mostrarPassword2() {
  var cambio = document.getElementById("password2");
  if (cambio.type == "password") {
    cambio.type = "text";
    $('.icon1').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
  } else {
    cambio.type = "password";
    $('.icon1').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
  }
}

function mostrarPassword3() {
  var cambio = document.getElementById("password3");
  if (cambio.type == "password") {
    cambio.type = "text";
    $('.icon2').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
  } else {
    cambio.type = "password";
    $('.icon2').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
  }
}

function removerErrores() {

  $("#errorPassword").hide();
  $("#errorPassword2").hide();
  $("#errorPassword3").hide();

}

// ---------------------------------- Datos fiscales ----------------------------------
function mostrarDF() {
  $("#firstCard").html(`
    <div class="card mb-4 col-sm-12">
        <div class="card-body">
            <h5 class="mb-4">Datos fiscales</h5>
            <div class="card-body" id="despliegueTab3">
              <p>Hola</p>
            </div>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="agregarDF()">
                    + Agregar
                </button>
            </div>
        </div>
    </div>
  `);


  axios.get(base_url() + "daniw/Perfil_usuario/getDF")
    .then(({ data }) => {
      if (data.resultado) {
        $("#despliegueTab3").html(`
          <table id="datatable3" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
                <tr>
                  <th>RFC</th> 
                  <th>Razón social</th>
                  <th>Regimen</th>
                  <th>Detalle</th>
                  <th>Domicilio</th>
                  <th>Correo</th>
                  <th>Principal</th>
                  <th style="text-align: center">Estatus</th> 
                  <th style="text-align: center">Editar</th>
                  <th style="text-align: center">Borrar</th>
                </tr>
            </thead>
            <tbody></tbody>
          </table>
        `);

        $.each(data.Fiscales, function (i, o) {
          $("#datatable3").find("tbody").append(
            `<tr id="tr-` + o.idFiscales + `">
              <td>` + o.RFC + `</td>
              <td>` + o.rSocial + `</td>
              <td>` + o.nomRegimen + `</td>     
              <td>` + o.descripcion + `</td>  
              <td>` + o.calle + `</td>
              <td>` + o.correo + `</td>  
              <td>` + (o.orden != 1 ? "No" : "Si") + `</td>   
              <td align="center">
                <a href="#" onclick="cambiaEstatus(` + o.idD + `)">
                  <i id="icono-` + o.idD + `" class="fas fa-toggle-` + (o.estatus == 1 ? "on" : "off") + ` fa-2x"></i>
                </a>
              </td>
              <td align="center">
                <a href="#" onclick="editarDF(` + o.idFiscales + `,'` + o.calle + `','` + o.idRegimen + `','` + o.idDRF + `','` + o.rSocial + `','` + o.RFC + `','` + o.correo + `','` + o.orden + `')">
                  <i class="fas fa-pencil fa-2x"></i>
                </a> 
              </td>
              <td align="center">
                <a href="#" onclick="modalBorrarDF(` + o.idD + `,'` + o.calle + `')">
                  <i class="fas fa-trash fa-2x"></i>
                </a>
              </td>
            </tr>`
          );
        });

        $("#datatable3").DataTable(),
          $(".dataTables_length select").addClass("form-select form-select-sm");
      } else {
        $("#despliegueTab3").html(data.mensaje);
      }

      mostrarDom();
    })
    .catch((error) => {
      console.log(error);
    });
}


// $("#cbox").on("change", function() {
//   let cbox = $("#cbox");
//   let valor = cbox.is(":checked") ? 1 : 0; // Si está marcado, obtener el valor "1"; de lo contrario, obtener un valor vacío

//   insertaFiscal(valor);
// });
function hab() {
  $("#btnFiscales, #domicilioF, #regimenF, #DRF, #rfcF, #correoF").removeAttr("disabled");
}

function des() {
  $("#btnFiscales, #domicilioF, #regimenF, #DRF, #rfcF, #correoF").attr("disabled", "disabled");
}

function insertaFiscal() {

  //quitaErroresCamposVacios();
  //desabilitaCampos();
  quitaErroresCampos();

  //hab();

  $("#btnFiscales, #domicilioF, #regimenF, #DRF, #rfcF, #correoF").attr("disabled", "disabled");



  let idFiscales = $("#idFiscales").val();
  let idU = $("#idU").val();
  let calle = $("#domicilioF").val();
  let regimen = $("#regimenF").val();
  let detalle = $("#DRF").val();
  let rSocial = $("#rSocial").val();
  let rfc = $("#rfcF").val();
  let correo = $("#correoF").val();
  let accion = $("#accion").val();
  let checkbox = document.getElementById('cbox');
  let cbox = checkbox.checked ? 1 : 0;

  var r = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);

  var ro = new RegExp(/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/);

  let goValidation = true;
  let estatus = 1;


  if (accion == "editar") {
    estatus = $("#estatusModal").val();
  }

  if ("selecciona" == calle) {
    $('#errorCalleF').show();
    $('#errorCalleF').html("Elige un domicilio");
    $('#calle').focus();
    goValidation = false;
    $("#btnFiscales, #domicilioF, #regimenF, #DRF, #rfcF, #correoF").removeAttr("disabled");
    //des();
    //habilitaCampos();
  }

  if ("Selecciona" == regimen) {
    $('#errorRegimenF').show();
    $('#errorRegimenF').html("Selecciona un regimen");
    $('#regimen').focus();
    goValidation = false;
    $("#btnFiscales, #domicilioF, #regimenF, #DRF, #rfcF, #correoF").removeAttr("disabled");
    //des();

  }

  if ("Selecciona" == detalle) {
    $('#errorRegimenF').show();
    $('#errorRegimenF').html("Por favor selecciona un regimen");
    $('#regimen').focus();
    goValidation = false;
    $("#btnFiscales, #domicilioF, #regimenF, #DRF, #rfcF, #correoF").removeAttr("disabled");
    //des();

  }

  if ("" == rSocial.trim()) {
    $("#errorSocial").show();
    $("#errorSocial").html("El campo no debe de ir vacio");
    $("#rSocial").focus();
    goValidation = false;
    $("#btnFiscales, #domicilioF, #regimenF, #DRF, #rfcF, #correoF").removeAttr("disabled");
    //des();
  }
  /*
  Esta es validacion de RFC no permite dejarlo vacio
  No permite mas de 13 caracteres
  No permite menos de 13 caracteres
  */
  if ("" == rfc.trim()) {
    $("#errorRFC").show();
    $("#errorRFC").html("El campo no debe de ir vacio");
    $("#rfcF").focus();
    goValidation = false;
    $("#btnFiscales, #domicilioF, #regimenF, #DRF, #rfcF, #correoF").removeAttr("disabled");
    //des();
    //hab();
  }

  if (rfc.length > 13) {
    $("#errorRFC").show();
    $("#errorRFC").html("No debe de ser mayor a 13 caracteres");
    $("#rfcF").focus();
    goValidation = false;
    $("#btnFiscales, #domicilioF, #regimenF, #DRF, #rfcF, #correoF").removeAttr("disabled");
    //des();
  }

  if (rfc.length < 13) {
    $("#errorRFC").show();
    $("#errorRFC").html("No debe de ser menor a 13");
    $("#rfcF").focus();
    goValidation = false;
    //des();
    $("#btnFiscales, #domicilioF, #regimenF, #DRF, #rfcF, #correoF").removeAttr("disabled");
  }


  if ("" == correo.trim()) {
    $("#errorCorreoF").show();
    $("#errorCorreoF").html("El campo no debe ir vacio");
    $("#correoF").focus();
    goValidation = false;
    //des();
    $("#btnFiscales, #domicilioF, #regimenF, #DRF, #rfcF, #correoF").removeAttr("disabled");
  }

  if (!(r.test(correo.trim()))) {
    $("#errorCorreoF").show();
    $("#errorCorreoF").html("Formato usuario@dominio.com");
    $("#correoF").focus();
    goValidation = false;
    //des();
    $("#btnFiscales, #domicilioF, #regimenF, #DRF, #rfcF, #correoF").removeAttr("disabled");
  }

  if (goValidation) {
    axios.post(base_url() + "daniw/Perfil_usuario/insertFiscal", {
      idFiscales: idFiscales,
      idU: idU,
      idD: calle,
      idRegimen1: regimen,
      idUsoCFDI: detalle,  
      rSocial: rSocial,
      RFC: rfc,
      correo: correo,
      estatus: estatus,
      orden: cbox,
      accion: accion
    })
      .then(({ data }) => {
        if (data.resultado) {
          toastr["success"](data.mensaje);
          $("#domicilioF").val("");
          $("#regimenF").val("");
          $("#rSocial").val("");
          $("#rfcF").val("");
          $("#correoF").val("");
          $("#cbox").val("");
          $("#ModalDF").modal("hide");
          checkbox.checked = false;
          mostrarDF();
          //resetPagina();
        } else {
          toastr["warning"](data.mensaje);
        }
      })
      .catch((error) => {
        console.log(error);
      });
  } else {
    console.log("Faltan datos dentro del formulario");
    //console.log(cbox);
  }
}

function agregarDF() {
  mostrarDomi();
  mostrarFiscales();
  mostrarDetalle();


  $("#btnFiscales").html("Agregar");
  $("#ModalDF").modal("show");
  $("#nombreFiscales").html("Agregar datos fiscales");
  $("#idU").attr("value");
  $("#correoF").val("");
  $("#rfcF").val("");
  $("#rSocial").val("");
  $("#cbox").val("");
  $('#errorCalleF').hide();
  $('#errorRegimenF').hide();
  $("#errorSocial").hide();
  $("#errorRFC").hide();
  $("#errorCorreoF").hide();





  $("#accion").val("Agregar");
  hab();

}

function editarDF(id, calle, regimen, detalle, rSoc, rfc, correo, orden) {
  mostrarDomi(calle);
  mostrarFiscales(regimen, detalle);

  $("#btnFiscales").html("Actualizar");
  $("#accion").val("editar");
  $("#ModalDF").modal("show");
  $("#nombreFiscales").html("Editar datos fiscales");
  $("#regimenF").val(regimen);
  $("#idFiscales").val(id);
  $("#rSocial").val(rSoc);
  $("#rfcF").val(rfc);

  let checkbox = document.getElementById('cbox');
  if (orden != 1) {
    checkbox.checked = false;
  } else {
    checkbox.checked = true;
  }
  $("#correoF").val(correo);
  hab();



  if ($("#icono-" + id).hasClass("fa-toggle-on")) {
    $("#estatusModal").val("1");
  } else {
    $("#estatusModal").val("0");
  }
}

// Select para mostar datos de Domicilio
function mostrarDomi(calle) {
  let idU = $("#idU").val();

  $.ajax({
    url: base_url() + "daniw/Perfil_usuario/getDomicilio",
    type: "POST",
    dataType: "JSON",
    data: {
      idU: idU
    }
  })
    .done((data) => {
      $("#domicilioF").html("");
      if (data.resultado) {
        $("#divDomicilio").find("select").append(`  
        <option value="selecciona">Seleccione Domicilio</option> 
      `);
        $.each(data.Domicilio, function (i, o) {
          $("#divDomicilio").find("select").append(
            // agrega el atributo "selected" si la calle es igual a la calle pasada como parámetro
            `<option value="` + o.idD + `"` + (o.calle === calle ? "selected" : "") + `>` + o.calle + `</option>`
          );

        });
      } else {
        $("#divDomicilio").find("select").append(
          `
        <option value="Selecciona">No hay datos</option>
        `
        );
      }
    })
    .fail();
}

// Select para mostar datos de Regimen Fiscal
function mostrarFiscales(regimen, detalle) {

  $.ajax({
    url: base_url() + "daniw/Perfil_usuario/getrFiscal",
    type: "POST",
    dataType: "JSON"
  })
    .done((data) => {
      $("#regimenF").html("");
      if (data.resultado) {
        $("#divRegimen").find("select").append(`
        <option value="Selecciona">Selecciona un regimen</option> 
      `);
        $.each(data.rFiscal, function (i, o) {
          $("#divRegimen").find("select").append(
            `<option value="` + o.idRegimen + `"` + (o.idRegimen === regimen ? "selected" : "") + `>` + o.nomRegimen + `</option>` 
          );
        });

        // Llamar a mostrarDetalle con el valor de detalle
        mostrarDetalle($("#divRegimen").find("select").val(), detalle);
        // Agregar evento change al select
        $("#divRegimen").find("select").on("change", function () { 

          var idRegimen = $(this).val();
          mostrarDetalle(idRegimen);

        });

      } else {
        $("#divRegimen").find("select").append(
          `
        <option value="Selecciona">No datos para mostrar</option>
        `
        );
      }
    })
    .fail();
}

// Select para mostar datos de Detalle de Regimen Fiscal
function mostrarDetalle(detalle) {
  $("#DRF").html("");
  $.ajax({
    url: base_url() + "daniw/Perfil_usuario/getDetalle",
    type: "POST",
    dataType: "JSON"
  })
    .done((data) => {

      if (data.resultado) {
        $("#divDRF").find("select").append(`
        <option value="Selecciona">Selecciona CFDI</option>
      `);    
        $.each(data.Detalle, function (i, o) {
          $("#divDRF").find("select").append(
            `<option value="` + o.idUsoCFDI + `"` + (o.idUsoCFDI === detalle ? "selected" : "") + `>` + o.descripcion + `</option>`
          );

        });
      } else {
        $("#divDRF").find("select").append(
          `
        <option value="Selecciona">No existen Detalles de Regimen</option>
        `
        );
      }
    })
    .fail();
}

function mostrarDom() {
  let idUsuario = $("#idUsu").attr("value");
  $("#secondCard").html(`
    <div class="card mb-4 col-sm-12">
        <div class="card-body">

            <h5 class="mb-4">Domicilios</h5>
            <div class="card-body" id="despliegueTab">
            </div>

            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="agregar()">
                    + Agregar
                </button>
            </div>
        </div>
    </div>
  `);
  const valor = {
    idU: idUsuario
  };
  axios.post(base_url() + "daniw/Perfil_usuario/getDFiscal", valor)
    .then(({ data }) => {
      if (data.resultado) {
        $("#despliegueTab").html(`
          <table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
                <tr>
                  <th>Calle</th>
                  <th>Colonia</th>
                  <th style="text-align: center"># Exterior</th>
                  <th style="text-align: center"># Interior</th>
                  <th style="text-align: center">CP</th>
                  <th style="text-align: center">Estatus</th>
                  <th style="text-align: center">Editar</th>
                  <th style="text-align: center">Borrar</th>
                </tr>
            </thead>
            <tbody></tbody>
          </table>
          `);

        $.each(data.Fiscales, function (i, o) {
          $("#datatable").find("tbody").append(
            `<tr id="tr-` + o.idD + `">
              <td>` + o.calle + `</td>
              <td>` + o.colonia + `</td>
              <td align="center">` + (o.numeroExterior ? o.numeroExterior : 'Sin dato') + `</td>
              <td align="center">` + (o.numeroInterior ? o.numeroInterior : 'Sin dato') + `</td>
              <td align="center">` + (o.codigoPostal ? o.codigoPostal : 'Sin dato') + `</td>
              <td align="center">
                <a href="#" onclick="cambiaEstatus(` + o.idD + `)">
                  <i id="icono-` + o.idD + `" class="fas fa-toggle-` + (o.estatus == 1 ? "on" : "off") + ` fa-2x"></i>
                </a>
              </td>
              <td align="center">
                <a href="#" onclick="editar(` + o.idU + `,'` + o.calle + `','` + o.colonia + `','` + o.numeroExterior + `','` + o.numeroInterior + `','` + o.codigoPostal + `',` + o.estado + `,` + o.municipio + `)"> 
                  <i class="fas fa-pencil fa-2x"></i>
                </a> 
              </td>
              <td align="center">
                <a href="#" onclick="modalBorrar(` + o.idD + `,'` + o.calle + `')">
                  <i class="fas fa-trash fa-2x"></i>
                </a>
              </td>
            </tr>`
          );
        });

        $("#datatable").DataTable(),
          $(".dataTables_length select").addClass("form-select form-select-sm");
      } else {
        $("#despliegueTab").html(data.mensaje);
      }
    })
    .catch((error) => {
      console.log(error);
    });
}

function insertaDom() {

  quitaErroresCampos();

  $("#btnEnviar, #calle, #colonia, #ext, #int, #cp, #municipio, #estado").attr("disabled", "disabled");


  let idU = $("#idU").val();
  let calle = $("#calle").val();
  let colonia = $("#colonia").val();
  let ext = $("#ext").val();
  let int = $("#int").val();
  let cp = $("#cp").val();

  let municipio = $("#municipio").val();
  let estado = $("#estado").val();
  let accion = $("#accion").val();
  let goValidation = true;
  let estatus = 1;


  if (accion == "editar") {
    estatus = $("#estatusModal").val();
  }



  if ("" == calle.trim()) {
    $("#errorCalle").show();
    $("#errorCalle").html("El campo no debe ir vacio");
    $("#calle").focus();
    goValidation = false;
    $("#btnEnviar, #calle, #colonia, #ext, #int, #cp, #municipio, #estado").removeAttr("disabled");

  }

  if ("" == colonia.trim()) {
    $("#errorColonia").show();
    $("#errorColonia").html("El campo no debe ir vacio");
    $("#colonia").focus();
    goValidation = false;
    $("#btnEnviar, #calle, #colonia, #ext, #int, #cp, #municipio, #estado").removeAttr("disabled");
  }

  if ("" == ext.trim()) {
    $("#errorExterior").show();
    $("#errorExterior").html("El campo no debe ir vacio");
    $("#ext").focus();
    goValidation = false;
    $("#btnEnviar, #calle, #colonia, #ext, #int, #cp, #municipio, #estado").removeAttr("disabled");
  }

  if ("Selecciona" == municipio) {
    $('#errorMUN').show();
    $('#errorMUN').html("Elige un municipio por favor");
    $('#municipio').focus();
    goValidation = false;
    $("#btnEnviar, #calle, #colonia, #ext, #int, #cp, #municipio, #estado").removeAttr("disabled");
    //habilitaCampos();
  }

  if ("Selecciona" == estado) {
    $('#errorEST').show();
    $('#errorEST').html("Elige un estado por favo22r");
    $('#estado').focus();
    goValidation = false;
    $("#btnEnviar, #calle, #colonia, #ext, #int, #cp, #municipio, #estado").removeAttr("disabled");
    //habilitaCampos();
  }





  if (goValidation) {
    axios.post(base_url() + "daniw/Perfil_usuario/insertDomicilio", {
      idU: idU,
      calle: calle,
      colonia: colonia,
      numeroExterior: ext,
      numeroInterior: int,
      codigoPostal: cp,
      municipio: municipio,
      estado: estado,
      estatus: estatus,
      accion: accion
    })
      .then(({ data }) => {
        if (data.resultado) {
          toastr["success"](data.mensaje);
          $("#calle").val("");
          $("#colonia").val("");
          $("#ext").val("");
          $("#int").val("");
          $("#cp").val("");
          $("#ModalAgregar").modal("hide");
          mostrarDom();
          resetPagina();

        } else {
          toastr["warning"](data.mensaje);
        }
      })
      .catch((error) => {
        console.log(error);
      });
  } else {
    console.log("Faltan datos dentro del formulario");
  }
}

function agregar() {
  mostrarMun();
  mostrarEst();

  $("#btnEnviar").html("Agregar");
  $("#ModalAgregar").modal("show");
  $("#nombreModal").html("Agregar nueva dirección");
  $("#idU").attr("value");
  $("#calle").val("");
  $("#colonia").val("");
  $("#ext").val("");
  $("#int").val("");
  $("#cp").val("");
  $("#municipio").val("");
  $("#estado").val("");
  $("#errorCalle").hide();
  $("#errorColonia").hide();
  $("#errorExterior").hide();
  $("#errorMUN").hide();
  $("#errorEST").hide();
  $("#errorSocial").hide();


  $("#accion").val("Agregar");

}

function editar(id, calle, colonia, ext, int, cp, estado, municipio) {
  mostrarMun();
  mostrarEst(estado);
  $("#mun").val(municipio);

  $("#btnEnviar").html("Actualizar");
  $("#accion").val("editar");
  $("#ModalAgregar").modal("show");
  $("#nombreModal").html("Editar dirección");
  $("#calle").val(calle);
  $("#colonia").val(colonia);
  $("#ext").val(ext);
  $("#int").val(int);
  $("#cp").val(cp);
  $("#municipio").val(municipio);
  $("#estado").val(estado);
  //$("#estatusModal").val(estatus);
  $("#idU").val(id);

  if ($("#icono-" + id).hasClass("fa-toggle-on")) {
    $("#estatusModal").val("1");
  } else {
    $("#estatusModal").val("0");
  }
}

function modalBorrar(id, dir) {
  $("#borrarModal").modal("show");
  $("#tituloModalBorrar").html("Borrar dirección");
  $("#cuerpoModalBorrar").html(
    "Estas seguro que deseas borrar: <strong>" +
    dir +
    "</strong>"
  );
  $("#btnModalBorrar").attr("appData-Id", id);
}

function btnModalBorrar() {
  let id = $("#btnModalBorrar").attr("appData-Id");

  $.ajax({
    url: base_url() + "daniw/Perfil_usuario/bajaLogica",
    dataType: "JSON",
    type: "POST",
    data: {
      id: id,
    }
  })
    .done((data) => {
      if (data.resultado) {
        mostrarDom();
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

function cambiaEstatus(id) {
  const idD = id;

  axios.post(base_url() + "daniw/Perfil_usuario/cambiaEstatus", { idD: idD })
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
        mostrarDom();
      } else {
        toastr["warning"](data.mensaje);
      }
    })
    .catch((error) => {
      console.log(error);
    });
}

let isEventoChangeSet = false; // Bandera para controlar si el evento change ya se ha configurado

function mostrarEst(estado) {
  $.ajax({
    url: base_url() + "daniw/Perfil_usuario/getEstados",
    dataType: "JSON"
  })
    .done((data) => {
      $("#estado").html("");
      if (data.resultado) {
        $("#divEstado").find("select").append(`<option value="Selecciona">Selecciona Estado</option>`);

        $.each(data.Estado, function (i, o) {
          $("#divEstado").find("select").append(
            `<option value="` + o.estado_id + `"` + (o.estado_id == estado ? "selected" : "") + `>` + o.nombre_estado + `</option>`
          );

        });


        // Verificar si se debe mostrar el municipio
        if (estado !== '') {
          mostrarMun(estado);
        }


        if (!isEventoChangeSet) {
          $("#divEstado").find("select").on("change", function () {
            var estado_id = $(this).val();
            mostrarMun(estado_id);
          });
          isEventoChangeSet = true;
        }
        // if(estado != ''){
        //   // Agregar evento change al select 
        //   mostrarMun(estado);
        // }else {
        //   // Agregar evento change al select 
        //   $("#divEstado").find("select").on(function() {  
        //     var estado_id = $(this).val();
        //     mostrarMun(estado_id);
        //   });
        // }
      } else {
        $("#divEstado").find("select").append(
          `
        <option value="Selecciona">No existen Estados</option>
        `
        );
      }
    })
    .fail();
}

function mostrarMun(estado_id) {
  let mun = $('#mun').val();
  // console.log('estado id: '+ estado_id)
  // console.log(mun)
  $.ajax({
    url: base_url() + "daniw/Perfil_usuario/getMunicipio",
    type: "POST",
    dataType: "JSON",
    data: {
      estado_id: estado_id
    }
  })
    .done((data) => {
      $("#municipio").html("");
      if (data.resultado) {
        $("#divMunicipio").find("select").append(`
        <option value="Selecciona">Selecciona Municipio</option>
      `);
        var municipios = data.Municipio.filter(function (o) {
          return o.estado_id == estado_id;
        });
        $.each(municipios, function (i, o) {
          $("#divMunicipio").find("select").append(
            `<option value="` + o.municipio_id + `"` + (o.municipio_id == mun ? "selected" : "") + `>` + o.nombre_municipio + `</option>`
          );
        });
      } else {
        $("#divMunicipio").find("select").append(
          `
        <option value="Selecciona">No existen Municipios</option>
        `
        );
      }
    })
    .fail();
}

function mostrarCard() {
  let idUsuario = $("#idUsu").attr("value");
  $("#cardNom").val("");
  $("#cardNum").val("");
  $("#exp").val("");
  const valor = {
    idU: idUsuario
  };
  axios.post(base_url() + "daniw/Perfil_usuario/getCard", valor)
    .then(({ data }) => {
      if (data.resultado) {
        $("#despliegueTab2").html(`
          <table id="datatable2" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <thead>
                  <tr> 
                    <th>Nombre</th>
                    <th>Número</th>
                    <th>Fecha exp</th>
                    <th style="text-align: center">Estatus</th>
                    <th style="text-align: center">Editar</th>
                    <th style="text-align: center">Borrar</th>
                  </tr>
              </thead>
              <tbody></tbody>
          </table>`);

        $.each(data.Fiscales, function (i, o) {
          $("#datatable2").find("tbody").append(
            `<tr id="tr-` + o.idD + `">
              <td>` + o.nombre + `</td>
              <td>` + o.numCard + `</td>
              <td align="center">` + o.fechaExp + `</td>
              <td align="center">
                <a href="#" onclick="cambiaEstatus(` + o.idD + `)">
                  <i id="icono-` + o.idD + `" class="fas fa-toggle-` + (o.estatus == 1 ? "on" : "off") + ` fa-2x"></i>
                </a>
              </td>
              <td align="center">
                <a href="#" onclick="editarCard(` + o.idU + `,'` + o.nombre + `','` + o.numCard + `','` + o.fechaExp + `')">
                  <i class="fas fa-pencil fa-2x"></i>
                </a> 
              </td>
              <td align="center">
                <a href="#" onclick="modalBorrar(` + o.idD + `,'` + o.calle + `')">
                  <i class="fas fa-trash fa-2x"></i>
                </a>
              </td>
            </tr>`
          );
        });

        $("#datatable2").DataTable(),
          $(".dataTables_length select").addClass("form-select form-select-sm");
      } else {
        $("#despliegueTab2").html(data.mensaje);
      }
    })
    .catch((error) => {
      console.log(error);
    });
}

function insertaTarjeta() {

  let idU = $("#idU").val();
  let nombre = $("#calle").val();
  let numero = $("#colonia").val();
  let exp = $("#ext").val();
  let accion = $("#accion").val();
  let goValidation = true;
  let estatus = 1;

  if (accion == "editar") {
    estatus = $("#estatusModal").val();
  }

  if ("" == nombre.trim()) {
    $("#errorCalle").show();
    $("#errorCalle").html("El campo no debe ir vacio");
    $("#calle").focus();
    goValidation = false;
    habilitaCampos();
  }

  if ("" == numero.trim()) {
    $("#errorColonia").show();
    $("#errorColonia").html("El campo no debe ir vacio");
    $("#colonia").focus();
    goValidation = false;
    habilitaCampos();
  }

  if ("" == exp.trim()) {
    $("#errorExterior").show();
    $("#errorExterior").html("El campo no debe ir vacio");
    $("#ext").focus();
    goValidation = false;
    habilitaCampos();
  }

  if (goValidation) {
    axios.post(base_url() + "daniw/Perfil_usuario/insertTarjeta", {
      idU: idU,
      nombre: nombre,
      apellidos: apellidos,
      exp: exp,
      accion: accion
    })
      .then(({ data }) => {
        if (data.resultado) {
          toastr["success"](data.mensaje);
          $("#cardNum").val("");
          $("#nomNum").val("");
          $("#exp").val("");
          // $("#ModalAgregar").modal("hide");
          // mostrarRFC();
          // habilitaCampos();
        } else {
          toastr["warning"](data.mensaje);
          //console.log('idU');
          //habilitaCampos();
        }
      })
      .catch((error) => {
        console.log(error);
      });
  } else {
    console.log("Faltan datos dentro del formulario");
  }
}

function agregarCard() {

  //quitaErroresCamposVacios();
  //listaModulos();

  $("#btnEnviar").html("Agregar");
  $("#ModalAgregar").modal("show");
  $("#nombreModal").html("Agregar nueva dirección");
  $("#idU").attr("value");
  $("#colonia").val("");
  $("#ext").val("");
  $("#int").val("");
  $("#cp").val("");
  $("#municipio").val("");
  $("estado").val("");
  //$("#selectmod").val("");
  $("#accion").val("Agregar");
  $("#seccion_id").val("0");

}

function editarCard(id, nom, num, exp) {

  $("#btnEnviar").html("Actualizar");
  $("#accion").val("editar");
  $("#cardNom").val(nom);
  $("#cardNum").val(num);
  $("#exp").val(exp);
  $("#idU").val(id);

  if ($("#icono-" + id).hasClass("fa-toggle-on")) {
    $("#estatusModal").val("1");
  } else {
    $("#estatusModal").val("0");
  }

}


function quitaErroresCampos() {
  $("#errorCalle").hide();
  $("#errorColonia").hide();
  $("#errorExterior").hide();
  $("#errorCP").hide();
  $('#errorMUN').hide();
  $('#errorEST').hide();
  $('#errorCorreoF').hide();
  $("#errorRFC").hide();
  $("#errorCalleF").hide();
  $('#errorRegimenF').hide();
  $('#errorSocial').hide();

}


function resetPagina() {
  location.reload();
}

