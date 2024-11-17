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
	

<style>

.container {
    margin-right: 600px;
    margin-left: 300px;
    color: #000; /* Texto en negro */
    background-color: #fff; /* Fondo blanco */
    border: 2px solid #000; /* Borde negro */
}

.background {
    background-color: #fff; /* Fondo blanco */
    border: 2px solid #000; /* Borde negro */
}

#cuadro_1 {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 500px; /* Manteniendo tu altura */
    width: 700px; /* Manteniendo tu ancho */
    margin: 0 auto; /* Centrado horizontal */
    background-color: #fff; /* Fondo blanco */
    border: 2px solid #000; /* Borde negro */
    border-radius: 15px; /* Bordes redondeados */
}

#cuadro_2 {
    width: 800px; /* Manteniendo tu ancho */
    height: 800px; /* Manteniendo tu altura */
    background-color: #fff; /* Fondo blanco */
    border: 3px solid #000; /* Borde negro */
    border-radius: 10px; /* Bordes redondeados */
}
</style>

</head>

<body class="background show-spinner">
    <main>
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
                    <div class="card auth-card" id="cuadro_1">
                        <div class="form-side" id="cuadro_2">
                            <a href="<?= base_url() . "store/" ?>">
                                <h3 class="text-center mb-4">Quicky Coffee</h3>
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
                                    <small class="text-danger" id="errorApellidos" style="display: none;">Ingrese un nombre válido para el usuario</small>
                                </label>
                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" id="telefono" name="telefono" />
                                    <span>Teléfono</span>
                                    <small class="text-danger" id="errorTelefono" style="display: none;">Ingrese un teléfono válido</small>
                                </label>
                                <label class="form-group has-float-label mb-4">
                                    <select class="form-control select2-single" name="sucursalR">
                                        <option value="selecciona">--Selecciona--</option>
                                        <option value="9" selected>Matrix</option>

                                    </select>
                                    <span>Sucursal de preferencia</span>
                                    <small class="text-danger" id="errorSucursal" style="display: none;">Seleccione una sucursal válida</small>
                                </label>
                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" type="email" id="correoR" name="correoR" />
                                    <span>Correo electrónico</span>
                                    <small class="text-danger" id="errorCorreo" style="display: none;">Ingrese un correo válido</small>
                                </label>
                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" type="password" placeholder="Contraseña mínimo 5 caracteres" id="contrasenia" name="contrasenia" />
                                    <span>Contraseña</span>
                                    <small class="text-danger" id="errorContrasenia" style="display: none;">Ingrese una contraseña válida</small>
                                </label>
                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" type="password" placeholder="Confirmar contraseña" id="confirmcontrasenia" name="confirmcontrasenia" />
                                    <span>Confirmar contraseña</span>
                                    <small class="text-danger" id="errorConfirmContrasenia" style="display: none;">Las contraseñas no coinciden</small>
                                </label>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="<?= base_url() ?>login">¿Tienes cuenta? Inicia Sesión</a>
                                    <button id="btnRegistro" class="btn btn-primary btn-lg btn-shadow" type="submit">Registrarse</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript">function base_url() { return "<?= base_url() ?>" }</script>
    <script src="<?= base_url() ?>static/plantilla/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url() ?>static/plantilla/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>static/plantilla/js/dore.script.js"></script>
    <script src="<?= base_url() ?>static/plantilla/js/scripts.js"></script>
    <script src="<?= base_url() ?>static/propiosScripts/registro.js"></script>
    <script src="<?= base_url() ?>static/toastr/toastr.min.js"></script>
</body>


</html>