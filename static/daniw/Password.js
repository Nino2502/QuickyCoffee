$(document).ready(() => {
  passAcc();
});

function passAcc() {
	$.ajax({
		url: base_url() + "daniw/Password/getPass",
		dataType: "JSON"
	})
    .done((data) => {
    	$("#passAcceso").html("");
    	if (data.resultado) {
			// toastr["success"](data.mensaje);
			// console.log(data.resultado);

			$("#passAcceso").html(`
				<div class="form-group position-relative error-l-50">
					<label>Contraseña actual</label>
					<div class="input-group">
					<input type="password" class="form-control" id="password" placeholder="Contraseña">
					<div class="input-group-append">
						<button class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
					</div>
					</div>
					<small class="text-danger" id="errorPassword" style="display: none;"></small>
				</div>
		
				<div class="form-row pb-2">
					<div class="form-group col-md-6">
					<label for="inputEmail4">Nueva contraseña</label>
					<div class="input-group">
						<input type="password" class="form-control" id="password2" placeholder="Ingresa contraseña">
						<div class="input-group-append">
						<button class="btn btn-primary" type="button" onclick="mostrarPassword2()"> <span class="fa fa-eye-slash icon1"></span> </button>
						</div>
					</div>
					<small class="text-danger" id="errorPassword2" style="display: none;"></small>
					</div>
					<div class="form-group col-md-6">
					<label for="inputPassword4">Confirma contraseña</label>
					<div class="input-group">
						<input type="password" class="form-control" id="password3" placeholder="Confirma contraseña">
						<div class="input-group-append">
						<button class="btn btn-primary" type="button" onclick="mostrarPassword3()"> <span class="fa fa-eye-slash icon2"></span> </button>
						</div>
					</div>
					<small class="text-danger" id="errorPassword3" style="display: none;"></small>
					</div>
				</div>
				<div style="text-align: center;">
					<a href="#" class="btn btn-primary mb-0 text-center" style="justify-content: center;" onclick="updatePass()">Editar contraseña</a>
				</div>
			`);
      	} else {
			//console.log(data.resultado);
			toastr["warning"](data.mensaje);

			$("#passAcceso").html(`
			<div class="form-row pb-2">
				<div class="form-group col-md-6">
				<label for="inputEmail4">Nueva contraseña</label>
				<div class="input-group">
					<input type="password" class="form-control" id="pass1" placeholder="Ingresa contraseña">
					<div class="input-group-append">
					<button class="btn btn-primary" type="button" onclick="mostrarPass1()"> <span class="fa fa-eye-slash icon1"></span> </button>
					</div>
				</div>
				<small class="text-danger" id="errorPass" style="display: none;"></small>
				</div>
				<div class="form-group col-md-6">
				<label for="inputPassword4">Confirma contraseña</label>
				<div class="input-group">
					<input type="password" class="form-control" id="pass2" placeholder="Confirma contraseña">
					<div class="input-group-append">
					<button class="btn btn-primary" type="button" onclick="mostrarPass2()"> <span class="fa fa-eye-slash icon2"></span> </button>
					</div>
				</div>
				<small class="text-danger" id="errorPass2" style="display: none;"></small>
				</div>
			</div>
			<div style="text-align: center;">
				<a href="#" class="btn btn-primary mb-0 text-center" style="justify-content: center;" onclick="insertPass()">Guardar contraseña</a>
			</div>
			`);
		}
    })
    .fail();
}

function updatePass() {
	let contra = $("#password").val();
	let contra2 = $("#password2").val();
	let contra3 = $("#password3").val();

	goValidation = true;

	if ("" == contra.trim()) {
		$("#errorPassword").show();
		$("#errorPassword").html("Ingresa tu contraseña");
		$("#password").focus();
		goValidation = false;
	}

	if ("" == contra2.trim()) {
		$("#errorPassword2").show();
		$("#errorPassword2").html("Ingresa tu contraseña");
		$("#password2").focus();
		goValidation = false;
	}

	if ("" == contra3.trim()) {
		$("#errorPassword3").show();
		$("#errorPassword3").html("Ingresa tu contraseña");
		$("#password3").focus();
		goValidation = false;
	}

	if (contra2 != contra3 || contra3 != contra2) {
		$("#errorPassword2").show();
		$("#errorPassword2").html("Contraseñas no coinciden");
		$("#password2").focus();

		$("#errorPassword3").show();
		$("#errorPassword3").html("Contraseñas no coinciden");
		$("#password3").focus();

		goValidation = false;
	}

	if (goValidation == true) {
		$.ajax({
			url		 : base_url() + "daniw/Password/updatePassAcc",
			dataType : "JSON",
			type	 : "POST",
			data	 : {
				'ClaveVal' : contra,
				'ClaveAcceso' : contra2,
			}
		})
		.done((data) => {
			if (data.resultado) {
				toastr["success"](data.mensaje);
				passAcc();
				$("#pass1").val("");
				$("#pass2").val("");
			} else {
				toastr["warning"](data.mensaje);
			}
		})
		.fail();
	}
}

function insertPass() {
	let contra = $("#pass1").val();
	let contra2 = $("#pass2").val();

	goValidation = true;

	if ("" == contra.trim()) {
		$("#errorPass").show();
		$("#errorPass").html("Ingresa tu contraseña");
		$("#pass1").focus();
		goValidation = false;
	}

	if ("" == contra2.trim()) {
		$("#errorPass2").show();
		$("#errorPass2").html("Ingresa tu contraseña");
		$("#pass2").focus();
		goValidation = false;
	}

	if (contra != contra2 || contra2 != contra) {
		$("#errorPass2").show();
		$("#errorPass2").html("Contraseñas no coinciden");
		$("#pass2").focus();

		$("#errorPass").show();
		$("#errorPass").html("Contraseñas no coinciden");
		$("#pass1").focus();

		goValidation = false;
	}

	if (goValidation == true) {
		$.ajax({
			url		 : base_url() + "daniw/Password/insertPassAcc",
			dataType : "JSON",
			type	 : "POST",
			data	 : {
				ClaveAcceso: contra,
			}
		})
		.done((data) => {
			if (data.resultado) {
				toastr["success"](data.mensaje);
				passAcc();
				$("#pass1").val("");
				$("#pass2").val("");
			} else {
				toastr["warning"](data.mensaje);
			}
		})
		.fail();
	}
}

// Mostrar password form actualizar
function mostrarPassword(){
	var cambio = document.getElementById("password");
	if(cambio.type == "password"){
		cambio.type = "text";
		$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
	}else{
		cambio.type = "password";
		$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
	}
} 

function mostrarPassword2(){
	var cambio = document.getElementById("password2");
	if(cambio.type == "password"){
		cambio.type = "text";
		$('.icon1').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
	}else{
		cambio.type = "password";
		$('.icon1').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
	}	
} 

function mostrarPassword3(){
	var cambio = document.getElementById("password3");
	if(cambio.type == "password"){
		cambio.type = "text";
		$('.icon2').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
	}else{
		cambio.type = "password";
		$('.icon2').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
	}
} 

// Mostrar password form insertar
function mostrarPass1(){
	var cambio = document.getElementById("pass1");
	if(cambio.type == "password"){
		cambio.type = "text";
		$('.icon2').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
	}else{
		cambio.type = "password";
		$('.icon2').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
	}
} 

function mostrarPass2(){
	var cambio = document.getElementById("pass2");
	if(cambio.type == "password"){
		cambio.type = "text";
		$('.icon2').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
	}else{
		cambio.type = "password";
		$('.icon2').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
	}
} 