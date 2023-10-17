$(document).ready(() => {
  let id = $("#idTU").val();
  informacionPersonal();
  $("#edit_btn").hide();
  $("#correo_edit").on("change", function () {
    $("#edit_btn").show();
  });
});

function informacionPersonal() {
  id = $("#idUsu").val();

  $.ajax({
    url: base_url() + "app/Perfil_usuario/InformacionUsuario",
    dataType: "JSON",
    type: "POST",
    data: {
      idU: id,
    },
  })
    .done((data) => {
      let General = data.ListaColaboradores;

      console.log("data", General);

      $("#correo_edit").val(General.correo);
      $("#nombre_edit").val(General.nombreU);
      $("#apellido_edit").val(General.apellidos);
      $("#telefono_edit").val(General.telefono);
    })
    .fail();
}

function actualizarDatos() {
  let accion = $("#btnEnviar").val();
  if (accion == "agregar") {
    $("#btnEnviar").attr("disabled", false);
    id = $("#idUsu").val();

    let nombre = $("#nombrePerfilUsuario").val();
    let apellidos = $("#apellidoPerfilUsuario").val();
    let tel = $("#telefonoPerfilUsuario").val();

    const validRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    goValidation = true;

    if ("" == nombre.trim()) {
      $("#errorNombreUsuM").show();
      $("#errorNombreUsuM").html("Ingresa tu nombre");
      $("#nombrePerfilUsuario").focus();
      goValidation = false;
      $(
        "#btnEnviar, #nombrePerfilUsuario,#apellidoPerfilUsuario,#telefonoPerfilUsuario,"
      ).removeAttr("disabled");
    }
    if ("" == apellidos.trim()) {
      $("#errorApellidoUM").show();
      $("#errorApellidoUM").html("Ingresa tus apellidos");
      $("#apellidoPerfilUsuario").focus();
      goValidation = false;
      $(
        "#btnEnviar, #nombrePerfilUsuario,#apellidoPerfilUsuario,#telefonoPerfilUsuario,"
      ).removeAttr("disabled");
    }
    if (!tel.match(/^[0-9]+$/) || tel.length > 10) {
      console.log("tel.match", tel);
      if (!tel.match(/^[0-9]+$/)) {
        $("#errorTelefonoUsu").show();
        $("#errorTelefonoUsu").html("Ingresa un telefono valido");
        $("#telefonoPerfilUsuario").focus();
        goValidation = false;
        $(
          "#btnEnviar, #nombrePerfilUsuario,#apellidoPerfilUsuario,#telefonoPerfilUsuario,"
        ).removeAttr("disabled");
      }
      if (tel.length > 10) {
        $("#errorTelefonoUsu").show();
        $("#errorTelefonoUsu").html("Solo se permiten 10 digitos");
        $("#telefonoPerfilUsuario").focus();
        goValidation = false;
        $(
          "#btnEnviar, #nombrePerfilUsuario,#apellidoPerfilUsuario,#telefonoPerfilUsuario,"
        ).removeAttr("disabled");
      }
    }

    if (goValidation == true) {
      console.log("id usuario" + id);

      $("#nombrePerfilUsuario").attr("disabled", false);
      $("#apellidoPerfilUsuario").attr("disabled", false);
      $("#telefonoPerfilUsuario").attr("disabled", false);
      $("#btnEnviar").attr("disabled", "disabled");

      $.ajax({
        url: base_url() + "app/Perfil_usuario/ActualizarPerfil",
        dataType: "JSON",
        type: "POST",
        data: {
          idU: id,
          nombreU: nombre,
          apellidos: apellidos,
          telefono: tel,
        },
      })
        .done((data) => {
          const General = data.ListaColaboradores;
          console.log("Data obtenida", data.ListaColaboradores.nombreU);

          if (data.resultado == true) {
            console.log("Response: ", data);
            toastr["success"](data.mensaje);

            informacionPersonal();
            $("#btnEnviar").attr("disabled", false);
          }
          if (data.resultado == false) {
            info = data.info;
            toastr["warning"]("registra uno diferente ", data.ResTelefono);

            $("#nombrePerfilUsuario").val(info.nombreU).attr("disabled", false);
            $("#apellidoPerfilUsuario")
              .val(info.apellidos)
              .attr("disabled", false);
            $("#telefonoPerfilUsuario")
              .val(info.telefono)
              .attr("disabled", false);
            $("#btnEnviar").attr("disabled", false);
          }
        })
        .fail();
    }
  }
}

// function updatePass(){
//     removerErrores()
//     let idUsuario = $("#idUsu").attr("value");
//     let pass   = $("#contrasenaPerfil").val()
//     let passN1 = $("#contrasenaPerfilV").val()
//     let passN2 = $("#contrasenaPerfilV2").val()

//     goValidation = true;

//     if("" == pass.trim() ){
//         $('#errorcontraseñaUsuario').show();
//         $('#errorcontraseñaUsuario').html("Ingresa tu contraseña");
//         $('#contrasenaPerfil').focus();
//         goValidation = false;

//     }
//     if("" == passN1.trim() ){
//         $('#errorcontraseñaUsuario1').show();
//         $('#errorcontraseñaUsuario1').html("Campo vacio");
//         $('#contrasenaPerfilV').focus();
//         goValidation = false;

//     }
//     if("" == passN2.trim() ){
//         $('#errorcontraseñaUsuario2').show();
//         $('#errorcontraseñaUsuario2').html("Campo vacio");
//         $('#contrasenaPerfilV2').focus();
//         goValidation = false;

//     }

//     if(passN1 != passN2 || passN2 != passN1){
//         console.log("contraseñas no coinciden")
//         $('#errorcontraseñaUsuario1').show();
//         $('#errorcontraseñaUsuario1').html("Contraseñas no coinciden");
//         $('#contrasenaPerfilV').focus();
//         goValidation = false;
//     }

//     if(goValidation == true){
//         alert("entro")

//             $.ajax({
//                 "url": base_url()+"app/Perfil_usuario/actualizarPass",
//                 "dataType": "JSON",
//                 "type":"POST",
//                 "data":{
//                     idU: idUsuario,
//                     pass: pass,
//                     passN: passN1,
//                 }
//             })
//             .done((data)=>{
//                 let General = data.ListaColaboradores
//                 console.log("data",data)
//                 if (data.resultado) {
//                     toastr["success"](data.mensaje);
//                      $("#contrasenaPerfil").val("")
//                      $("#contrasenaPerfilV").val("")
//                      $("#contrasenaPerfilV2").val("")

//                 } else {
//                     if(data.Status == false){
//                         toastr["warning"](data.Pass + ", Verifica tu contraseña");
//                     }

//                 }

//             })
//             .fail();
//     }
// }

// function actualizarContraseña(){

//     $("#btn_guardar").html(`
//          <button type="button" class="btn btn-primary mb-0" onclick="updatePass()">Guardar cambios</button>
//     `)

// }
// function mostrarPasswordActual(){
// 	var cambio = document.getElementById("contrasenaPerfil");
// 	if(cambio.type == "password"){
// 		cambio.type = "text";
// 		$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
// 	}else{
// 		cambio.type = "password";
// 		$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
// 	}

// }
// function mostrarPasswordConfirmar(){
// 	var cambio = document.getElementById("contrasenaPerfilV");
// 	if(cambio.type == "password"){
// 		cambio.type = "text";
// 		$('.icon1').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
// 	}else{
// 		cambio.type = "password";
// 		$('.icon1').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
// 	}

// }
// function mostrarPasswordConfirmar2(){
// 	var cambio = document.getElementById("contrasenaPerfilV2");
// 	if(cambio.type == "password"){
// 		cambio.type = "text";
// 		$('.icon2').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
// 	}else{
// 		cambio.type = "password";
// 		$('.icon2').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
// 	}

// }

// function removerErrores(){

//     $("#errorcontraseñaUsuario").hide();
//     $("#errorcontraseñaUsuario1").hide();
//     $("#errorcontraseñaUsuario2").hide();

// }
