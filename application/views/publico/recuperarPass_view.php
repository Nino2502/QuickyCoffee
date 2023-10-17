<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?=app_name()?> || <?=$_APP['title']?>   </title>
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

<body class="background show-spinner" >
	
    <div class="fixed-background" style="background: url(<?= base_url('static/plantilla/img/balloon.jpg') ?>) no-repeat;"></div>
    <main>
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
                    <div class="card auth-card">
                        <div class="position-relative image-side" style="background: url(<?= base_url('static/plantilla/img/login-balloon.jpg') ?>) no-repeat;" >

                            <!--<p class=" text-black h2" >SDI Administración</p>

                            <p class="black mb-0">
                                Favor de usar tus datos para iniciar sesión.
                                <br>Si no tienes cuenta, favor de 
                                <a href="<?= base_url()?>registro" class="white">registrarse aquí</a>.
                            </p>-->
                        </div>
                        <div class="form-side">
						
							 
							
							
                            <a href="#">
                                <span class="logo-single" style="background: url(<?= base_url('static/plantilla/img/logo-black.svg') ?>) no-repeat;"></span>
                            </a>
                            <h6 class="mb-4">Recuperación contraseña</h6>

							
                            <form id="formRecuperarContraseña">
                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" id="correoL" name="correoL" />
                                    <span>Correo electrónico</span>
									
                                </label>

                             
                                <div class="d-flex justify-content-between align-items-center">
                                  
                                    <button class="btn btn-primary btn-lg btn-shadow" type="button" id="recuperar" onclick="recuperarPass()">Recuperar contraseña</button>
                                </div>
								
								
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
	
	
	<script src="<?= base_url() ?>static/propiosScripts/Aldair/recuperarcontraseña.js"></script>
	<script src="<?= base_url() ?>static/toastr/toastr.min.js"></script>
	
	
	
</body>

</html>