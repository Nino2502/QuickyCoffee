<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    
    <title>SDI | <?=$_APP['title']?></title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="<?= base_url()."static/plantilla/frontImg/"?>favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="<?= base_url()."static/plantilla/frontImg/"?>apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?= base_url()."static/plantilla/frontImg/"?>apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?= base_url()."static/plantilla/frontImg/"?>apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?= base_url()."static/plantilla/frontImg/"?>apple-touch-icon-144x144-precomposed.png">
	
    <!-- GOOGLE WEB FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="<?= base_url()."static/plantilla/frontcss/"?>bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url()."static/plantilla/frontcss/"?>style.css" rel="stylesheet">

	  <link rel="stylesheet" href="<?= base_url() ?>static/toastr/toastr.min.css" />
	
	<!-- listado de css -->
	
	<link rel="stylesheet" href="https://laptopfix.com.mx/run/static/stylesheets/cargando.css">
	<link rel="stylesheet" href="https://laptopfix.com.mx/run/static/fontawesome-6.2.1-web/css/all.css">
	

	
	<!-- SPECIFIC CSS -->
	

	 <?php if (isset($styles)) :
		foreach ($styles as $style) : ?>
		<link rel="stylesheet" href="<?= base_url( 'static/' . $style . '.css') ?>" />
    	<?php endforeach;
    endif; ?>
	
	
  

</head>

<body>
	
	<div id="cargando">
		
		<h1><i class=" fas fa-spinner fa-pulse 5x"></i> Cargando...</h1>
		
	</div>	
	
	<div id="page">
		
	<header class="version_1">
		<div class="layer"></div><!-- Mobile menu overlay mask -->
		<div class="main_header Sticky">
			<div class="container">
				<div class="row small-gutters">
					<div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
						 <div id="logo">
                        	<a onClick="location.href='<?= base_url()?>';"><img src="<?= base_url()?>static/publico/img/sdi_logo.png" alt="" height="60"></a>
                    	</div>
					</div>
					<nav class="col-xl-6 col-lg-7">
						<a class="open_close" href="javascript:void(0);">
							<div class="hamburger hamburger--spin">
								<div class="hamburger-box">
									<div class="hamburger-inner"></div>
								</div>
							</div>
						</a>
						<!-- Mobile menu button -->
						<div class="main-menu">
							<div id="header_menu">
								<a onClick="location.href='<?= base_url()?>';"><img src="<?= base_url()?>static/publico/img/sdi_logo.png" alt="" width="100" height="35"></a>
								<a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
							</div>
							<ul>
								<li>
									<a href="<?= base_url() . "store/"?>">Inicio</a>
								</li>
								<li>
									<a href="<?= base_url() . "store/nosotros"?>">Nosotros</a>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);" class="show-submenu">Productos</a>
									<ul>
										<li><a href="<?= base_url().'store/impresos'?>">Impresos</a></li>
										<li><a href="<?= base_url().'store/noImpresos'?>">No Impresos</a></li>
										
									</ul>
								</li>
								<li>
									<a href="<?= base_url().'public/Facturacion'?>">Factura en línea</a>
								</li>
								<li>
									<a href="<?= base_url().'store/contacto'?>">Contacto</a>
								</li>
							</ul>
						</div>
						<!--/main-menu -->
					</nav>
					<div class="col-xl-3 col-lg-2 d-lg-flex align-items-center justify-content-end text-end">
						<ul class="top_tools">

						 <?php if($this->session->userdata('idusuario') !=0  && $this->session->userdata('token') != null):
							?>
							
							
							
							<?php if($this->session->userdata('idTipoUsuario') != 4): ?>
							
							
							<li>
									<div class="dropdown dropdown-access">
										<a href="#" class="access_link"><span>Cuenta</span></a>
										<div class="dropdown-menu">

											<ul>

												<li>
													<a href="<?= base_url(). "web"?>"><i class="ti-package"></i>Administración</a>
												</li>
												<li>
													<a href="<?= base_url(). "daniw/Perfil_usuario"?>"><i class="ti-user"></i>Mi perfil</a>
												</li>
												<li>
													 <a href="#" onClick="location.href='<?= base_url()?>logout/cerrarSesionIrTienda/';"><i
                                                    class="ti-power-off"></i>Cerrar sesion</a>
												</li>

											</ul>
										</div>
									</div>
									<!-- /dropdown-access-->
								</li>
							
							
							
							
							
							<?php else: ?>
							
							
							
								<li>
									<div class="dropdown dropdown-access">
										<a href="#" class="access_link"><span>Cuenta</span></a>
										<div class="dropdown-menu">

											<ul>

												<li>
													<a href="<?= base_url(). "web"?>"><i class="ti-package"></i>Mis pedidos</a>
												</li>
												<li>
													<a href="<?= base_url(). "daniw/Perfil_usuario"?>"><i class="ti-user"></i>Mi perfil</a>
												</li>
												<li>
													 <a href="#" onClick="location.href='<?= base_url()?>logout/cerrarSesionIrTienda/';"><i
                                                    class="ti-power-off"></i>Cerrar sesion</a>
												</li>

											</ul>
										</div>
									</div>
									<!-- /dropdown-access-->
								</li>
							
							<? endif ?>
							
							
							<?php else: ?>
							
							<li>
								<div class="dropdown dropdown-access">
									<a href="#" class="access_link"><span>Cuenta</span></a>
									<div class="dropdown-menu">
										<a id="inniciar" onClick="location.href='<?= base_url()?>login';"
                                        class="btn_1">Iniciar Sesion</a>
										<a id="inniciar" onClick="location.href='<?= base_url()?>registro';"
                                        class="btn_1 mt-2">Registrarse</a>
										
									</div>
								</div>
								<!-- /dropdown-access-->
							</li>
                       
							<?php endif	 ?>
						
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
		</div>
		<!-- /main_header -->
	</header>
	<!-- /header -->
	<main>
	
	<div id="cuerpoPrincipal">
							
		 <?= $_APP_FRAGMENT ?>

	</div>
		
		
	</main>	
		
	
	<!-- /main -->
		
	<footer class="revealed">
		<div class="container">
			<div class="row">
				
				<div class="col-lg-3 col-md-6">
					<h3 data-bs-target="#collapse_2">Categorias</h3>
					<div class="collapse dont-collapse-sm links" id="collapse_2">
						<ul>
							
							
							
							
							<li><a href="<?= base_url().'store/impresos'?>">Impresos</a></li>
							<li><a href="<?= base_url().'store/noImpresos'?>">No impresos</a></li>
							
						</ul>
					</div>
						<h3 data-bs-target="#collapse_3">Síguenos</h3>
					<div class="follow_us">
							<ul>
								<!--<li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="<?= base_url()."static/plantilla/frontImg/"?>twitter_icon.svg" alt="" class="lazy"></a></li>-->
								<li><a href="https://www.facebook.com/sdiqueretaro/?locale=es_LA"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="<?= base_url()."static/plantilla/frontImg/"?>facebook_icon.svg" alt="" class="lazy"></a></li>
								<!--<li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="<?= base_url()."static/plantilla/frontImg/"?>instagram_icon.svg" alt="" class="lazy"></a></li>
								<li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="<?= base_url()."static/plantilla/frontImg/"?>youtube_icon.svg" alt="" class="lazy"></a></li>-->
							</ul>
						</div>
				</div>
				<div class="col-lg-3 col-md-6">
						<h3 data-bs-target="#collapse_3">Contactanos</h3>
					<div class="collapse dont-collapse-sm contacts" id="collapse_3">
						
						 
						<ul>
							<li><i class="ti-home"></i>Matriz: Juan de la barrera #18 <br>  esq. Pino Suárez<br> Col. Niños Heroes 76010, <br>Querétaro, <br> Querétaro, México</li>
							<li><a href="https://api.whatsapp.com/send?phone=4427209528&text=Hola%20,te%20asesoramos%20por
%20whatsapp%20." target="_blank"><i><img style="height: 20px" src="<?= base_url()?>/static/plantilla/frontImg/whats.png" ></i>+52 442 720 9528</a></li>
							<!--<li><i class="ti-email"></i><a href="#0">contacto@sdiqro.store</a></li>-->
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
						
					<div class="collapse dont-collapse-sm contacts" id="collapse_3">
												<h3 data-bs-target="#collapse_3"><br></h3>

						<ul>
							<li><i class="ti-home"></i>Río: Avenida Universidad #133<br> Col.  Centro, 76000 <br> Querétaro, <br> Querétaro, México</li>
							<li><a href="https://api.whatsapp.com/send?phone=4421217296&text=Hola%20,te%20asesoramos%20por
%20whatsapp%20." target="_blank"><i><img style="height: 20px" src="<?= base_url()?>/static/plantilla/frontImg/whats.png" ></i>+52 442 121 7296 </a></li>
							<!--<li><i class="ti-email"></i><a href="#0">contacto@sdiqro.store</a></li>-->
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
						<h3 data-bs-target="#collapse_3"><br></h3>
					<div class="collapse dont-collapse-sm contacts" id="collapse_3">
						
						 
						<ul>
							<li><i class="ti-home"></i>San Juan del Río: Pino Suárez #92<br> Col. Ccntro, <br>San Juan del Río,<br> Querétaro, México</li>
							<li><a href="https://api.whatsapp.com/send?phone=4421337921&text=Hola%20,te%20asesoramos%20por
%20whatsapp%20." target="_blank"><i><img style="height: 20px" src="<?= base_url()?>/static/plantilla/frontImg/whats.png" ></i></i>+52 442 133 7921</a></li>
							<!--<li><i class="ti-email"></i><a href="#0">contacto@sdiqro.store</a></li>-->
						</ul>
					</div>
				</div>
				
			</div>
			<!-- /row-->
			<hr>
			<div class="row add_bottom_25">
				<div class="col-lg-6">
					<ul class="footer-selector clearfix">
						
						<li><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="<?= base_url()."static/plantilla/frontImg/"?>cards_all.svg" alt="" width="198" height="30" class="lazy"></li>
					</ul>
				</div>
				<div class="col-lg-6">
					<ul class="additional_links">
						<li><a href="#">Terminos y condiciones</a></li>
						<li><a href="#">Politicas de privacidad</a></li>
						<li><span>© <?= date("Y")?> SDI</span></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<!--/footer-->
	</div>
	<!-- page -->
	
	<div id="toTop"></div><!-- Back to top button -->
	
	<!-- COMMON SCRIPTS -->
    <script src="<?= base_url()."static/plantilla/frontjs/"?>common_scripts.min.js"></script>
    <script src="<?= base_url()."static/plantilla/frontjs/"?>main.js"></script>
	
	<script src="<?= base_url() ?>static/toastr/toastr.min.js"></script>
	<script type="text/javascript"> function base_url() { return "<?=base_url()?>" } </script>

	
	<!-- Listado de scripts-->
	
	
	
	
	<?php if (isset($scriptsExternos)) :
        foreach ($scriptsExternos as $scriptE) : ?>
            <script type="text/javascript" src="<?= $scriptE ?>"></script>
    <?php endforeach;
    endif; ?>
	
	
	
	<!-- SPECIFIC SCRIPTS -->
	<?php if (isset($scripts)) :
        foreach ($scripts as $script) : ?>
            <script type="text/javascript" src="<?= base_url( 'static/' . $script . '.js') ?>"></script>
    <?php endforeach;
    endif; ?>


<script type="text/javascript" src="https://laptopfix.com.mx/run/static/fontawesome-6.2.1-web/js/all.js"></script>


    <!-- fin listado de scripts-->
	
	


</body>
</html>l