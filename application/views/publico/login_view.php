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
						
							   <?php if ($this->session->flashdata('message')) : ?>
                                <div class="alert alert-<?=$this->session->flashdata('message_type')?> alert-dismissible fade show  mb-3" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <?=$this->session->flashdata('message')?>
                                </div>
                            <?php endif; ?>
							
							
                            <a href="<?= base_url() . "store/"?>">
                                <span class="logo-single" style="background: url(<?= base_url('static/plantilla/img/logo-black.svg') ?>) no-repeat;"></span>
                            </a>
                            <h6 class="mb-4">Inicio de sesión</h6>

							
                            <form id="formInicioSesion">
                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" id="correoL" name="correoL" />
                                    <span>Correo electrónico</span>
									<div class="invalid-tooltip">
                                        El correo es requerido!
                                    </div>
                                </label>

                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" type="password" placeholder="Introduce tu contraseña" id="contraseniaL" name="contraseniaL" />
                                    <span>Contraseña</span>
									<div class="invalid-tooltip">
                                        La contraseña es requerida!
                                    </div>
                                </label>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="<?= base_url()?>resetPass">¿Olvidaste tu contraseña? </a>
                                    <button class="btn btn-primary btn-lg btn-shadow" type="submit" id="iniciarSesion">Iniciar sesión</button>
                                </div>
								
								<div class="d-flex justify-content-between align-items-center">
                                    <a href="<?= base_url()?>registro">Registrate aquí</a>
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
	
	
	<script src="<?= base_url() ?>static/propiosScripts/login.js"></script>
	<script src="<?= base_url() ?>static/toastr/toastr.min.js"></script>
	
	
	
</body>

</html>