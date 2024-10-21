$(document).ready(function() { 

    
  

});

function validarEmail(email) {
   
    const Correo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if(Correo.test(email.trim())) {
      return true;
    } else {
      return false;
    }
  }
  


function recuperarPass(){
    let email = $("#correoL").val();
    
    if(validarEmail(email)){
     

        formbody =  {
          correo: email
      }
      
      $.ajax({
          url: base_url() + "ResetPass/resetPass",
          dataType: "JSON",
          type: "POST",
          data: formbody
      })
      .done((data) => { 

            if(data.resultado){
              toastr["success"](data.Mensaje);

              setTimeout(function() {
                window.location.href = base_url() +"/login";
              }, 4000);
              
            }else{
              toastr["warning"](data.Mensaje);
            }
              
      })
      .fail();

    }else{
        toastr["warning"]("Correo invalido");
    }


}


function validar(){
 

  let email = $("#correoE").val();  
  let token = $("#tokenVerificacion").val();


  if(validarEmail(email)){
      formbody =  {
        correo: email,
        token: token
    }

        $.ajax({
          url: base_url() + "ActualizacionPass/ValidarDatos",
          dataType: "JSON",
          type: "POST",
          data: formbody
      })
      .done((data) => { 

            if(data.resultado){
              toastr["success"](data.Mensaje);

              $("#modalActualizar").modal("show")
              
            }else{
              toastr["warning"](data.Mensaje);
            }
              
      })
      .fail();

  }else{
    toastr["warning"]("Correo invalido");
  }

}

function actualizar(){
  quitaErrores()
  let contra  = $("#contrasena").val()
  let contraC = $("#confirmarcontrasena").val()
  let correo  = $("#correoE").val(); 
  let token   = $("#tokenVerificacion").val();
  console.log("contra" + contra);
  console.log("pass" +contraC)

  let bandera = true;

  
  if (contra.length <= 0 || contra == ""){
    $("#errorcontrasena").show();
    $("#errorcontrasena").html("la contraseña no puede ir vacia");
    $("#errorcontrasena").focus();
    bandera = false
  }
  if(contraC.length <= 0 || contraC == ""){
    $("#errorNcontrasena").show();
    $("#errorNcontrasena").html("la contraseña no puede ir vacia");
    $("#errorNcontrasena").focus();
    bandera = false
  }
  if (contra !== contraC) {
    $("#errorNcontrasena").show();
    $("#errorNcontrasena").html("la contraseña deben ser iguales");
    $("#errorNcontrasena").focus();
    bandera = false
  }
  

  if(bandera){
    formbody =  {
      correo: correo,
      contrasenia: contra,
      token: token
    }

    $.ajax({
      url: base_url() + "ActualizacionPass/actualizarContrasena",
      dataType: "JSON",
      type: "POST",
      data: formbody
    })
    .done((data) => { 

          if(data.resultado){
            vaciarInputs()
            toastr["success"](data.Mensaje);
            $("#modalActualizar").modal("hide");
             setTimeout(function() {
                window.location.href = base_url() +"/login";
              }, 4000);
              

            
          }else{
            toastr["warning"](data.Mensaje);
          }
            
    })
    .fail();
  }else{
    console.log("Hay campos que faltan verificar")
  }
     
}

function vaciarInputs(){
  $("#contrasena").val("");
  $("#confirmarcontrasena").val("");
}


function quitaErrores(){
  $("#errorcontrasena").hide()
  $("#errorNcontrasena").hide()
}
