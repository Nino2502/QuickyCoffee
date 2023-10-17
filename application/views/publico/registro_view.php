<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?=app_name()?> || <?=$_APP['title']?>      </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	
	<link rel="stylesheet" href="<?= base_url() ?>static/plantilla/font/iconsmind-s/css/iconsminds.css" />
     <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/font/simple-line-icons/css/simple-line-icons.css" />

     <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/css/vendor/bootstrap.min.css" />
     <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/css/vendor/bootstrap.rtl.only.min.css" />
     <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/css/vendor/bootstrap-float-label.min.css" />
     <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/css/main.css" />
	
	<link rel="stylesheet" href="<?= base_url() ?>static/fontawesome-6.2.1-web/css/all.css" />
	<link rel="stylesheet" href="<?= base_url() ?>static/toastr/toastr.min.css" />
	

 
</head>

<body class="background show-spinner">
    <div class="fixed-background" style="background: url(<?= base_url('static/plantilla/img/balloon.jpg') ?>) no-repeat;"></div>
    <main>
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
                    <div class="card auth-card">
                        <div class="position-relative image-side" style="background: url(<?= base_url('static/plantilla/img/login-balloon.jpg') ?>) no-repeat;  background-size: cover;">
                           
                        </div>
                        <div class="form-side">
                            <a href="<?= base_url() . "store/"?>">
                                <span class="logo-single" style="background: url(<?= base_url('static/plantilla/img/logo-black.svg') ?>) no-repeat;"></span>
                            </a>
                            <h6 class="mb-4">Formulario de Registro</h6>
							 <h6 class="mb-4"><?=$_APP['tipoRegistro']?> </h6>

                            <form id="formularioDeRegistro">
                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" id="nombre" name="nombre" />
                                    <span>Nombre</span>
									<small class="text-danger" id="errorNombre" style="display: none;"></small>
                                </label>
                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" id="apellidos" name="apellidos" />
                                    <span>Apellidos</span>
									<small class="text-danger" id="errorApellidos" style="display: none;">Ingrese un nombre valido para el usuario</small>
                                </label>
                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" id="telefono" name="telefono" />
                                    <span>Teléfono</span>
									<small class="text-danger" id="errorTelefono" style="display: none;">Ingrese un nombre valido para el usuario</small>
                                </label>
                                <label class="form-group has-float-label mb-4" id="labelsucursalR">
                                    <select class="form-control select2-single" id="sucursalR" name="sucursalR"></select>
                                    <span>Sucursal de preferencia</span>
                                    <small class="text-danger" id="errorSucursal" style="display: none;">Ingrese una sucursal valida para el usuario</small>
                                </label>
                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" type="email" id="correoR" name="correoR" />
                                    <span>Correo electrónico</span>
									<small class="text-danger" id="errorCorreo" style="display: none;">Ingrese un nombre valido para el usuario</small>
                                </label>
                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" type="password" placeholder="Constraseña mínimo 5 caracteres" id="contrasenia" name="contrasenia" />
                                    <span>Contraseña</span>
									<small class="text-danger" id="errorContrasenia" style="display: none;">Ingrese un nombre valido para el usuario</small>
                                </label>
                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" type="password" placeholder="confirmar contraseña" id="confirmcontrasenia" name="confirmcontrasenia" />
                                    <span>Confirmar contraseña</span>
									<small class="text-danger" id="errorConfirmContrasenia" style="display: none;">Ingrese un nombre valido para el usuario</small>
                                </label>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="<?= base_url()?>login">¿Tienes cuenta? Inicia Sesión</a>
                                    <button id="btnRegistro" class="btn btn-primary btn-lg btn-shadow" type="submit">Registrarse</button>
                                </div>
								<DIV
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
		
   <script type="text/javascript"> function base_url() { return "<?=base_url()?>" } </script>
   <script src="<?= base_url() ?>static/plantilla/js/vendor/jquery-3.3.1.min.js"></script>
   <script src="<?= base_url() ?>static/plantilla/js/vendor/bootstrap.bundle.min.js"></script>
   <script src="<?= base_url() ?>static/plantilla/js/dore.script.js"></script>
   <script src="<?= base_url() ?>static/plantilla/js/scripts.js"></script>
		
   <script src="<?= base_url() ?>static/propiosScripts/registro.js"></script>	
		<script src="<?= base_url() ?>static/toastr/toastr.min.js"></script>
		
</body>

</html>