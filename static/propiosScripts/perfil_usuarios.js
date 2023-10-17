$(document).ready(()=>{
    InformacionUsuario()
   
    $("#idUsu").val();
    let id= $("#idTU").val();
    
    if(id == 4){

        informacionPersonal()
        /* Eliminamos de la lista los siguientes tabs para cargar la vista del idTU = 4 */
        $('[id="1"]').remove(); 
        $('[id="3"]').remove(); 
        $('[name="empresa"]').remove();
        
        $("#btn-EP").html(` 
        <button type="button" class="btn btn-primary mb-0" onclick="EditarPerfil()">Editar información</button>
       `)
    }
    else{
        $("#btn-EP").html(` 
        <button type="button" class="btn btn-primary mb-0" onclick="EditarPerfil(`+id+`)">Editar información</button>
       `)
    }
});

function InformacionUsuario(){

    
  
    $("#despliegueTabla").html(`
            <ul class="nav nav-tabs card-header-tabs " role="tablist"  >
           
            <li class="nav-item"  id="1" >
                <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
                    aria-controls="first" aria-selected="true">Empresa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab"
                    aria-controls="second" aria-selected="false" onclick="informacionPersonal()">Información personal</a>
            </li>
            <li class="nav-item" id="3">
                <a class="nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab"
                    aria-controls="third" aria-selected="false">Bancaria</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="four-tab" data-toggle="tab" href="#four" role="tab"
                    aria-controls="four" aria-selected="false" onclick="actualizarContraseña()"> Contraseña</a>
            </li>
          
            <li class="nav-item" id="5">
                <a class="nav-link" id="five-tab" data-toggle="tab" href="#five" role="tab"
                aria-controls="five" aria-selected="false"> Especialidades</a>
            </li>
                
            </ul>
        `)

        
} 

function informacionPersonal(){
    removerErrores()

        let idUsuario = $("#idUsu").attr("value");


    $.ajax({
        "url": base_url()+"app/Perfil_usuario/InformacionUsuario",
        "dataType": "JSON",
        "type":"POST",
        "data":{
            idU: idUsuario
        }
    })
    .done((data)=>{
        let General = data.ListaColaboradores
        console.log("Data obtenida",data.ListaColaboradores.nombreU);
      
        $("#nombreUsuperfil").html(General.nombreU)
        $("#InputNombre").val(General.nombreU).attr("disabled", "disabled");
        $("#InputApellidos").val(General.apellidos).attr("disabled", "disabled");
        $("#InputTelefono").val(General.telefono).attr("disabled", "disabled");

    
        

    })
    .fail();
    
}
function updatePass(){
    removerErrores()
    let idUsuario = $("#idUsu").attr("value");
    let pass   = $("#contrasenaPerfil").val()
    let passN1 = $("#contrasenaPerfilV").val()
    let passN2 = $("#contrasenaPerfilV2").val()
   
    goValidation = true;

    if("" == pass.trim() ){
        $('#errorcontraseñaUsuario').show();
        $('#errorcontraseñaUsuario').html("Ingresa tu contraseña");
        $('#contrasenaPerfil').focus();	
        goValidation = false;
       
    }
    if("" == passN1.trim() ){
        $('#errorcontraseñaUsuario1').show();
        $('#errorcontraseñaUsuario1').html("Campo vacio");
        $('#contrasenaPerfilV').focus();	
        goValidation = false;
       
    }
    if("" == passN2.trim() ){
        $('#errorcontraseñaUsuario2').show();
        $('#errorcontraseñaUsuario2').html("Campo vacio");
        $('#contrasenaPerfilV2').focus();	
        goValidation = false;
       
    }


    if(passN1 != passN2 || passN2 != passN1){
        console.log("contraseñas no coinciden")
        $('#errorcontraseñaUsuario1').show();
        $('#errorcontraseñaUsuario1').html("Contraseñas no coinciden");
        $('#contrasenaPerfilV').focus();
        goValidation = false;
    }

    if(goValidation == true){
        alert("entro")
          
            $.ajax({
                "url": base_url()+"app/Perfil_usuario/actualizarPass",
                "dataType": "JSON",
                "type":"POST",
                "data":{
                    idU: idUsuario,
                    pass: pass,
                    passN: passN1,
                }
            })
            .done((data)=>{
                let General = data.ListaColaboradores
                console.log("data",data)
                if (data.resultado) {
                    toastr["success"](data.mensaje);
                     $("#contrasenaPerfil").val("")
                     $("#contrasenaPerfilV").val("")
                     $("#contrasenaPerfilV2").val("")
                   
                } else {
                    if(data.Status == false){
                        toastr["warning"](data.Pass + ", Verifica tu contraseña");
                    }
                    
                   
                }

            })
            .fail();
    }
}



const EditarPerfil = async () =>{

    id= $("#idUsu").val();
 
    $('#ModalEditarPerfil').modal('show');
    $("#nombreModal").html("Editando perfil");
       
    $("#nombrePerfilUsuario").val("cargado....").attr("disabled", "disabled");
    $("#apellidoPerfilUsuario").val("cargado....").attr("disabled", "disabled");
    $("#telefonoPerfilUsuario").val("cargado....").attr("disabled", "disabled");

    $("#actualizar-info").html(`
          <button type="button" class="btn btn-danger"
           data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-success" id="btnEnviar" value="agregar" onclick="actualizarDatos()">Actualizar información</button>
    `)

    $.ajax({
        "url": base_url()+"app/Perfil_usuario/InformacionUsuario",
        "dataType": "JSON",
        "type":"POST",
        "data":{
            idU: id
        }
    })
    .done((data)=>{
        let General = data.ListaColaboradores
    
        
        $("#nombrePerfilUsuario").val(General.nombreU).attr("disabled", false);
        $("#apellidoPerfilUsuario").val(General.apellidos).attr("disabled", false);
        $("#telefonoPerfilUsuario").val(General.telefono).attr("disabled", false);



    })
    .fail();

   
    
   
}
function actualizarDatos(){
   
  

    let accion = $("#btnEnviar").val();
    if(accion == "agregar"){
        
        $("#btnEnviar").attr("disabled", false);   
        id= $("#idUsu").val();

        let nombre      = $("#nombrePerfilUsuario").val()
        let apellidos   = $("#apellidoPerfilUsuario").val()
        let tel    = $("#telefonoPerfilUsuario").val()

        const validRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        goValidation = true;

        if("" == nombre.trim() ){
            $('#errorNombreUsuM').show();
            $('#errorNombreUsuM').html("Ingresa tu nombre");
            $('#nombrePerfilUsuario').focus();	
            goValidation = false;
            $(
                "#btnEnviar, #nombrePerfilUsuario,#apellidoPerfilUsuario,#telefonoPerfilUsuario,"
            ).removeAttr("disabled");
           
        }
        if("" == apellidos.trim() ){
            $('#errorApellidoUM').show();
            $('#errorApellidoUM').html("Ingresa tus apellidos");
            $('#apellidoPerfilUsuario').focus();	
            goValidation = false;
            $(
                "#btnEnviar, #nombrePerfilUsuario,#apellidoPerfilUsuario,#telefonoPerfilUsuario,"
            ).removeAttr("disabled");
           
        }
        if (!tel.match(/^[0-9]+$/) || tel.length >10){
			console.log("tel.match", tel)
			if(!tel.match(/^[0-9]+$/) ){
				$("#errorTelefonoUsu").show();
				$("#errorTelefonoUsu").html("Ingresa un telefono valido");
				$("#telefonoPerfilUsuario").focus();
				goValidation = false;
				$(
					"#btnEnviar, #nombrePerfilUsuario,#apellidoPerfilUsuario,#telefonoPerfilUsuario,"
				).removeAttr("disabled");
			}
			if( tel.length >10){
				$("#errorTelefonoUsu").show();
				$("#errorTelefonoUsu").html("Solo se permiten 10 digitos");
				$("#telefonoPerfilUsuario").focus();
				goValidation = false;
				$(
					"#btnEnviar, #nombrePerfilUsuario,#apellidoPerfilUsuario,#telefonoPerfilUsuario,"
				).removeAttr("disabled");
			}
			
            }
           
            
    
    
    
        if(goValidation == true){
            console.log("id usuario"+ id)
            
            $("#nombrePerfilUsuario").attr("disabled", false);
            $("#apellidoPerfilUsuario").attr("disabled", false);
            $("#telefonoPerfilUsuario").attr("disabled", false);
            $("#btnEnviar").attr("disabled", "disabled");   
       
            $.ajax({
                "url": base_url()+"app/Perfil_usuario/ActualizarPerfil",
                "dataType": "JSON",
                "type":"POST",
                "data":{
                    idU: id,
                    nombreU: nombre,
                    apellidos: apellidos,
                    telefono: tel
                }
            })
            .done((data)=>{
             const General = data.ListaColaboradores
                console.log("Data obtenida",data.ListaColaboradores.nombreU);
          
                if(data.resultado == true){
                    console.log("Response: ",data);
                    toastr["success"](data.mensaje);
                   
                    informacionPersonal()
                    $("#btnEnviar").attr("disabled", false);   
                }
                if(data.resultado == false){    
                    info = data.info
                        toastr["warning"]("registra uno diferente ",data.ResTelefono);
                     
                        $("#nombrePerfilUsuario").val(info.nombreU).attr("disabled", false);
                        $("#apellidoPerfilUsuario").val(info.apellidos).attr("disabled", false);
                        $("#telefonoPerfilUsuario").val(info.telefono).attr("disabled", false);
                        $("#btnEnviar").attr("disabled", false);
                }
             
                   
                
            })
            .fail();


          
        }
    
}
}

function actualizarContraseña(){
   
    
    $("#btn_guardar").html(`
         <button type="button" class="btn btn-primary mb-0" onclick="updatePass()">Guardar cambios</button>
    `)

}
function mostrarPasswordActual(){
	var cambio = document.getElementById("contrasenaPerfil");
	if(cambio.type == "password"){
		cambio.type = "text";
		$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
	}else{
		cambio.type = "password";
		$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
	}
	
	


} 
function mostrarPasswordConfirmar(){
	var cambio = document.getElementById("contrasenaPerfilV");
	if(cambio.type == "password"){
		cambio.type = "text";
		$('.icon1').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
	}else{
		cambio.type = "password";
		$('.icon1').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
	}

	
} 
function mostrarPasswordConfirmar2(){
	var cambio = document.getElementById("contrasenaPerfilV2");
	if(cambio.type == "password"){
		cambio.type = "text";
		$('.icon2').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
	}else{
		cambio.type = "password";
		$('.icon2').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
	}

	
} 

function removerErrores(){

    $("#errorcontraseñaUsuario").hide(); 
    $("#errorcontraseñaUsuario1").hide(); 
    $("#errorcontraseñaUsuario2").hide(); 

}