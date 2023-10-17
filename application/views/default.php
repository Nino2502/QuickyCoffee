<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
     <title><?= app_name() ?> | SDI | <?= $_APP_TITLE ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/font/iconsmind-s/css/iconsminds.css" />
    <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/font/simple-line-icons/css/simple-line-icons.css" />
    
    <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/css/vendor/bootstrap.rtl.only.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/css/vendor/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/css/vendor/component-custom-switch.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/css/main.css" />
	<link rel="stylesheet" href="<?= base_url() ?>static/fontawesome-6.2.1-web/css/all.css" />
    <link rel="stylesheet" href="<?= base_url() ?>static/toastr/toastr.min.css" />

    <link rel="stylesheet" href="<?= base_url() ?>static/cssTables/datatables.net-bs4/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>static/cssTables/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" />

    <!-- <?php if (isset($css)) :
        foreach($css as $c) : ?>
        <link rel="stylesheet" href="<?php echo base_url().$c; ?>" type="text/css" media="screen" />
    <?php endforeach; 
    endif; ?> -->
	
	
	
	<?php if (isset($cssExternos)) :
        foreach ($cssExternos as $cssE) : ?>
            <script type="text/javascript" src="<?= $cssE ?>"></script>
    <?php endforeach;
    endif; ?>
	
	
   

   
<!--
    
    <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/css/vendor/fullcalendar.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/css/vendor/bootstrap-float-label.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/css/vendor/select2.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/css/vendor/select2-bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/css/vendor/bootstrap-datepicker3.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/css/vendor/dropzone.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/css/vendor/bootstrap-tagsinput.css" />
    
   
    <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/css/vendor/nouislider.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/css/vendor/bootstrap-stars.css" />
    <link rel="stylesheet" href="<?= base_url() ?>static/plantilla/css/vendor/cropper.min.css" />
   


    




    <link rel="stylesheet" href="css/vendor/fullcalendar.min.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap-float-label.min.css" />
    
    <link rel="stylesheet" href="css/vendor/bootstrap-datepicker3.min.css" />
    <link rel="stylesheet" href="css/vendor/dropzone.min.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap-tagsinput.css" />
    <link rel="stylesheet" href="css/vendor/nouislider.min.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap-stars.css" />
    <link rel="stylesheet" href="css/vendor/cropper.min.css" />

-->






   
	
	
	 <?php if (isset($styles)) :
        foreach ($styles as $style) : ?>
            <link rel="stylesheet" href="<?= base_url( 'static/plantilla/css/' . $style . '.css') ?>" />
    <?php endforeach;
    endif; ?>
	
	
</head>

<body id="app-container" class="menu-default show-spinner">
    
	<!-- comentario en el body-->
	<?php $this->load->view('inc/menuSuperior_inc',''); ?>
	
  	<?= $_APP_VIEW_MENU ?>
		
		<main>
			<div class="container-fluid">
                
				<div class="row">
					<div class="col-12">
						 <h1><?= $_APP_VIEW_NAME ?></h1>
						<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
							<?php if (is_array($_APP_BREADCRUMBS)) : ?>
                            <ol class="breadcrumb pt-0">
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('web') ?>"> <?= app_name() ?> </a>
                                </li>
                                <?php foreach ($_APP_BREADCRUMBS as $bread) :
                                    if (is_array($bread)) : ?>
                                        <li class="breadcrumb-item">
                                            <a href="<?= base_url('app/' . $bread[0]) ?>"><?= $bread[1] ?></a>
                                        </li>
                                    <?php endif;
                                    if (!is_array($bread)) : ?>
                                        <li class="breadcrumb-item active" aria-current="page"><?= $bread ?></li>
                                <?php endif;
                                endforeach; ?>
                            </ol>
                        <?php endif; ?>
						</nav>
						<div class="separator mb-5"></div>
					</div>
				</div>
				
				<div id="cuerpoPrincipal">
					
					
					 <?= $_APP_FRAGMENT ?>
                     
				</div>

			</div>
		</main>
	
	
	
	
	<!-- Listado de modales-->


    <?php if (isset($modals)) :
        foreach ($modals as $modal) : ?>
            <?= $modal ?>
    <?php endforeach;
    endif; ?>

    <!--Termina  listado de modales-->

	
    
	
	<!-- Listado de scripts-->
	
	<?php $this->load->view('inc/listaScripts_inc', '', FALSE)?>
	
	
	<?php if (isset($scriptsExternos)) :
        foreach ($scriptsExternos as $scriptE) : ?>
            <script type="text/javascript" src="<?= $scriptE ?>"></script>
    <?php endforeach;
    endif; ?>
	
	
	
	
	<?php if (isset($scripts)) :
        foreach ($scripts as $script) : ?>
            <script type="text/javascript" src="<?= base_url( 'static/' . $script . '.js') ?>"></script>
    <?php endforeach;
    endif; ?>

    <!-- fin listado de scripts-->
	
	




</body>

</html>



