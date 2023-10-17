<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title><?= app_name() ?> |SDI - Panel de Control | <?= $_APP_TITLE ?></title>
    <link rel="shortcut icon" href="<?= base_url( 'static/images/favicon.ico') ?>" type="image/x-icon">
    <link rel="icon" href="<?= base_url('static/images/favicon.ico' ) ?>" type="image/x-icon">
    
    <link rel="stylesheet" href="<?= base_url('static/plantilla/font/iconsmind-s/css/iconsminds.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('static/plantilla/font/simple-line-icons/css/simple-line-icons.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('static/plantilla/css/vendor/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('static/plantilla/css/vendor/bootstrap.rtl.only.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('static/plantilla/css/vendor/bootstrap-float-label.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('static/plantilla/css/vendor/component-custom-switch.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('static/plantilla/css/vendor/perfect-scrollbar.css') ?>" />
    <link rel="stylesheet" href="<?= base_url( 'static/admin/css/main.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('static/plantilla/css/dore.light.blue.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('static/plantilla/fa-5.7.2/css/all.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('static/plantilla/toastr/toastr.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('static/plantilla/css/verticaltimeline.css') ?>" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css" />

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script src="https://kit.fontawesome.com/5484496a36.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php if (isset($styles)) :
        foreach ($styles as $style) : ?>
            <link rel="stylesheet" href="<?= base_url('static/plantilla/css/' . $style . '.css') ?>" />
    <?php endforeach;
    endif; ?>
    <link rel="stylesheet" href="<?= base_url('static/plantilla/css/vendor/no-more-tables.css') ?>" />
    <style type="text/css">
        form.validate-ptp label.error {
            display: none !important;
        }

        input.err,
        input.error,
        textarea.err,
        textarea.error,
        select.err,
        select.error {
            border: #bf6464 2px dashed !important;
            background-color: #fdfbfb !important;

            -webkit-transition: all 0.2s ease-in;
            -moz-transition: all 0.2s ease-in;
            -o-transition: all 0.2s ease-in;
            transition: all 0.2s ease-in;
        }


        /*
        Form Validation
        */
        form.validate label.error {
            position: absolute;
            background-color: #ff0000;
            color: #fff;
            left: 0;
            z-index: 10;
            bottom: -26px;
            left: 36px;
            font-size: 11px;
            font-weight: 400;
            padding: 3px;
            display: none !important;
        }
    </style>
</head>

<body id="app-container" class="menu-sub-hidden rounded show-spinner">
    <?= $_APP_NAV ?>

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
                                    <a href="<?= base_url(
                                                    'app/home'
                                                ) ?>"> LEAPPI </a>
                                </li>
                                <?php foreach ($_APP_BREADCRUMBS as $bread) :
                                    if (is_array($bread)) : ?>
                                        <li class="breadcrumb-item">
                                            <a href="<?= base_url(
                                                            'app/' . $bread[0]
                                                        ) ?>"><?= $bread[1] ?></a>
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

            <?php if (
                isset($_APP_TITLE_SUPPORT) &&
                isset($_APP_VIDEO_SUPPORT)
            ) : ?>
                <!--             <div class="card mb-4">
                <div class="card-body">        
                    <h5> 
                        <i class="iconsminds-support"></i> 
                        ¿Necesitas ayuda?, 
                        <a id="link-modal-video-support" href="javascript:void(0);" title="">
                            <strong> esto puede ser de utilidad <i class=" iconsminds-youtube"></i> </strong> 
                        </a> 
                    </h5>
                </div>
            </div> -->
            <?php endif; ?>

            <?= $_APP_FRAGMENT ?>
        </div>
    </main>

    <?php if (isset($modals)) :
        foreach ($modals as $modal) : ?>
            <?= $modal ?>
    <?php endforeach;
    endif; ?>

    <?php if (isset($_APP_TITLE_SUPPORT) && isset($_APP_VIDEO_SUPPORT)) : ?>
        <!-- #modal-video-support -->
        <div id="modal-video-support" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="javascript:void(0);" class="modal-content" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title"> <?= $_APP_TITLE_SUPPORT ?> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"> <i class="fas fa-times"></i> </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <iframe width="100%" height="400" src="<?= $_APP_VIDEO_SUPPORT ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">
                                <i class="iconsminds-back"> </i> Regresar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /#modal-video-support -->
    <?php endif; ?>

    <script type="text/javascript">
        function base_url(complement = '') {
            return "<?= base_url() ?>" + complement
        }
    </script>
    <script type="text/javascript" src="<?= base_url('static/plantilla/js/vendor/jquery-3.3.1.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('static/plantilla/js/vendor/bootstrap.bundle.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('static/plantilla/js/vendor/perfect-scrollbar.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('static/plantilla/js/vendor/mousetrap.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('static/plantilla/js/vendor/jquery.form.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('static/plantilla/js/vendor/jquery.validation.min.js') ?>"></script>
    
	<script src="<?= base_url('static/plantilla/js/vendor/multi-select/jquery.multi-select.min.js') ?>"></script>
    <script src="<?= base_url('static/plantilla/js/vendor/multi-select/jquery.multi-select.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('static/plantilla/toastr/toastr.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('static/plantilla/js/dore.script.js') ?>"></script>

    <script type="text/javascript" src="<?= base_url('static/propiosScripts/js/app/private/apphelper.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('static/plantilla/js/scripts.single.theme.js') ?>"></script>

    <?php if (isset($scripts)) :
        foreach ($scripts as $script) : ?>
            <script type="text/javascript" src="<?= base_url('static/plantilla/js/' . $script . '.js') ?>"></script>
    <?php endforeach;
    endif; ?>

	

</body>

</html>