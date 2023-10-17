$(document).ready(function(){
	
	//alert("login");
	
	//verCorreo();
	
	$("#correoL").focus();
	
	
	$("#formInicioSesion").submit((e)=>{
		e.preventDefault();
		
		
		//console.log(base_url() + 'login/auth');
		
		let btnSbmt =$('#iniciarSesion');
		
		let textBtn = btnSbmt.html();
		
		
		//$("#iniciarSesion, #correoL, #contraseniaL").attr("disabled", "disabled");

		$.ajax({
			"url": base_url()+"login/auth",
			"type":"post",
			"dataType":"json",
			beforeSend:function(){
				$("#iniciarSesion, #correoL, #contraseniaL").attr("disabled", "disabled");
				btnSbmt.html('<i class="fas fa-spinner fa-pulse"></i>&nbsp;&nbsp;&nbsp;Autenticando...');   
			},
			"data":{
				correoL:$("#correoL").val(),
				contraseniaL:$("#contraseniaL").val()
			}
			
		})
		.done((json)=>{
			
			
			if(json.resultado){
				console.log(json);
				
                

                    toastr["success"]("Hola "+json.usuario.nombreU+", bienvenido de nuevo <br> <i class='fas fa-spinner fa-pulse'></i> Ingresando ..."); 

                    window.setTimeout( () => {

                        //window.location.href = base_url();
					
						$(location).attr("href", base_url()+ "login/acceso/" + json.usuario.idU+ "/" + json.usuario.correo+ "/" + json.usuario.nombreU + "/"+ json.usuario.token+ "/"  + json.usuario.idTU + "/" + json.usuario.idP + "/"+ json.usuario.estatus + "/"+ json.usuario.idSuc + "/"+ json.usuario.idMa + "/"+ json.usuario.image_url); 
						
						
                    }, 2000);

                }
                else {

                    toastr["error"](json.mensaje);

					$("#iniciarSesion, #correoL, #contraseniaL").removeAttr("disabled");            

					$("#iniciarSesion").html(textBtn);          

                }
				
				
				
			
			
			
		})
		.fail( (xhr, textStatus, errorThrown) => {
			
			
			
			let errorContra = xhr['responseJSON']['contrasenia_error'] == "" ? "" : "Debes llenar el campo de la contraseña;";
			let errorUsuario = xhr['responseJSON']['correo_error'] == "" ?  "" : "Debes llenar el campo correo";

            toastr["error"]("Error al introducir tus datos. escribelos nuevamente "+ errorContra + " " + errorUsuario   );  

            console.log(xhr);
            console.log(textStatus);
            console.log(errorThrown);    
			
			
			
			$("#iniciarSesion, #correoL, #contraseniaL").removeAttr("disabled");            

            $("#iniciarSesion").html(textBtn); 
			
            

        }).always( () => {            

            $("#correoL, #contraseniaL").val('');                        
            $("#correoL").focus();  

        });;
	
		
	});//Termina submit 
	
	
	
});


function verCorreo() {
	let idUsuario = $("#idUsu").attr("value");
	
	 $.ajax({
      "url": base_url()+"daniw/Perfil_usuario/getUsuario",
      "dataType": "JSON",
      "type":"POST",
      "data":{
          idU: idUsuario
      }
  })
	.done((data)=>{
		  let o = data.Usuario
		  
		$("#correoL").val(o.correoL);
		 
		  
	 })
	.fail();
	
	
}


console.log(verCorreo);