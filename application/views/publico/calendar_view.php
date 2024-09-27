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

   
	
	<link rel="stylesheet" href="http://localhost/sdi_web/static/plantilla/font/iconsmind-s/css/iconsminds.css">
    <link rel="stylesheet" href="http://localhost/sdi_web/static/plantilla/font/simple-line-icons/css/simple-line-icons.css">
    
    <link rel="stylesheet" href="http://localhost/sdi_web/static/plantilla/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/sdi_web/static/plantilla/css/vendor/bootstrap.rtl.only.min.css">
    <link rel="stylesheet" href="http://localhost/sdi_web/static/plantilla/css/vendor/perfect-scrollbar.css">
    <link rel="stylesheet" href="http://localhost/sdi_web/static/plantilla/css/vendor/component-custom-switch.min.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/sdi_web/static/plantilla/css/dore.light.blue.min.css"><link rel="stylesheet" href="http://localhost/sdi_web/static/plantilla/css/main.css">
	<link rel="stylesheet" href="http://localhost/sdi_web/static/fontawesome-6.2.1-web/css/all.css">
    <link rel="stylesheet" href="http://localhost/sdi_web/static/toastr/toastr.min.css">

    <link rel="stylesheet" href="http://localhost/sdi_web/static/cssTables/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="http://localhost/sdi_web/static/cssTables/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
 <link rel="stylesheet" href="http://localhost/sdi_web/static/plantilla/css/vendor/select2.min.css">
                <link rel="stylesheet" href="http://localhost/sdi_web/static/plantilla/css/vendor/select2-bootstrap.min.css">
                <link rel="stylesheet" href="http://localhost/sdi_web/static/plantilla/css/vendor/bootstrap-datepicker3.min.css">
    	
	
	
	
	
	
	<!-- listado de css -->
	
	
	
	
	

	
	<!-- SPECIFIC CSS -->
	

	 <?php if (isset($styles)) :
		foreach ($styles as $style) : ?>
		<link rel="stylesheet" href="<?= base_url( 'static/' . $style . '.css') ?>" />
    	<?php endforeach;
    endif; ?>
	
	
  

</head>

<body>
	
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
								<a href="index.html"><img src="<?= base_url()."static/plantilla/frontImg/"?>logo_black.svg" alt="" width="100" height="35"></a>
								<a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
							</div>
							<ul>
								<li>
									<a href="<?= base_url() . "store/inicioWeb"?>">Inicio</a>
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
		
		
		
		<div class="col-sm-6  mt-3" id="divFechaDeCompra">
																<label>*Fecha del gasto</label>
																<input  class="form-control datepicker" autocomplete="off" name="jQueryLabelsInInputDate" required="" id="fechaCompra">
																<small class="text-danger" id="errorfechaCompra" style="display: none;"></small>
																
																<input type="hidden" value="<?= date("Y-n-j") ?>"  id="fechaActual">
																<!--<span>Fecha de la compra</span>-->
															</div>
							
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
							<li><a href="listing-grid-1-full.html">Impresos</a></li>
							<li><a href="listing-grid-2-full.html">No impresos</a></li>
							
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
							<li><i class="ti-home"></i>Matriz: Juan de la barrera #18 <br>  esq. pino suarez<br> Col. Niños Heroes 76010, <br>Querétaro, <br> Querétaro, México</li>
							<li><i class="ti-headphone-alt"></i>+52 442 242 4356</li>
							<li><i class="ti-email"></i><a href="#0">contacto@localhost/sdi_web</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
						
					<div class="collapse dont-collapse-sm contacts" id="collapse_3">
												<h3 data-bs-target="#collapse_3"><br></h3>

						<ul>
							<li><i class="ti-home"></i>Río: Avenida Universidad #137_10,<br> Col.  Centro, 76000 <br> Querétaro, <br> Querétaro, México</li>
							<li><i class="ti-headphone-alt"></i>+52  442 224 2242</li>
							<li><i class="ti-email"></i><a href="#0">contacto@localhost/sdi_web</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
						<h3 data-bs-target="#collapse_3"><br></h3>
					<div class="collapse dont-collapse-sm contacts" id="collapse_3">
						
						 
						<ul>
							<li><i class="ti-home"></i>San Juan del Río: Pino Suarez #92<br> Col. Ccntro, <br>San Juan del Río,<br> Querétaro, México</li>
							<li><i class="ti-headphone-alt"></i>+52 442 242 4356</li>
							<li><i class="ti-email"></i><a href="#0">contacto@localhost/sdi_web</a></li>
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
						<li><a href="#0">Terminos y condiciones</a></li>
						<li><a href="#0">Politicas de privacidad</a></li>
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
    
	

	
	<!-- Listado de scripts-->
	





	
	
		
	
	
	
	            <script type="text/javascript" src="http://localhost/sdi_web/static/plantilla/js/dore-plugins/select.from.library.js" style="opacity: 1;"></script>
                <script type="text/javascript" src="http://localhost/sdi_web/static/plantilla/js/vendor/select2.full.js" style="opacity: 1;"></script>
                <script type="text/javascript" src="http://localhost/sdi_web/static/propiosScripts/GastoVariado.js" style="opacity: 1;"></script>
                <script type="text/javascript" src="http://localhost/sdi_web/static/propiosScripts/tabla/datatables.net/js/jquery.dataTables.min.js" style="opacity: 1;"></script>
                <script type="text/javascript" src="http://localhost/sdi_web/static/propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min.js" style="opacity: 1;"></script>
                <script type="text/javascript" src="http://localhost/sdi_web/static/propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min.js" style="opacity: 1;"></script>
                <script type="text/javascript" src="http://localhost/sdi_web/static/propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js" style="opacity: 1;"></script>
                <script type="text/javascript" src="http://localhost/sdi_web/static/propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js" style="opacity: 1;"></script>
                <script type="text/javascript" src="http://localhost/sdi_web/static/plantilla/js/vendor/bootstrap-datepicker.js" style="opacity: 1;"></script>
    
    <!-- fin listado de scripts-->
	<script type="text/javascript"> function base_url() { return "<?=base_url()?>" } </script>
	
	
	
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

    <!-- fin listado de scripts-->
	
	


</body>
</html>l