<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?=app_name()?> || <?=$_APP['title']?></title>
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
            display: flex; /* Habilitar flexbox */
            justify-content: center; /* Centrar horizontalmente */
            align-items: center; /* Centrar verticalmente */
            height: 100vh; /* Altura completa de la ventana */
        }

        .form-side {
            width: 400px; /* Ajustar el ancho del formulario */
            border: 1px solid black;
            border-radius: 10px;
            padding: 20px;
            background-color: white;
            margin: 0 20px; /* Espaciado a los lados del formulario */
        }

        #boton-login {
            background: linear-gradient(135deg, #ff5733, #ffcc33);
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 20px;
            cursor: pointer; 
        }

        #letra_login {
            color: red;
            border: 2px solid white;
            padding: 5px;
            display: inline-block;
            font-family: 'Montserrat', sans-serif;
            font-size: 24px;
            font-weight: 700;
        }


        .menu-izquierdo{
            font-family: 'Montserrat', sans-serif;
            width: 200px;
            margin-right: 200px;
            text-align: center; /* Centrar el texto */


        }
        .menu_derecho {
            font-family:  'Montserrat', sans-serif;
            width: 200px;
            margin-left: 200px;
            text-align: center; /* Centrar el texto */




        }

        .menu-izquierdo h1, .menu_derecho h1 {
            text-align
            margin: 0;
            margin-top: 1px;
        }
    </style>
</head>

<body class="background show-spinner">
<div class="container">
    <div class="menu-izquierdo">
        <h1>EXPRESSO</h1>
        <ul>

            <li>Americano . . .  $3.00</li>
            <li>Galleta Oreo . ..$4.00</li>
            <li>Capucchino . . . $3.80</li>
        </ul>

    </div>

    <div class="form-side">
        <?php if ($this->session->flashdata('message')) : ?>
            <div class="alert alert-<?=$this->session->flashdata('message_type')?> alert-dismissible fade show mb-3" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                <?=$this->session->flashdata('message')?>
            </div>
        <?php endif; ?>

        <center>
            <h1 class="curved-text">
                <span>Quicky Coffee</span>
            </h1>
            <br>
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSYBQh80mvhwpf_R1izQ6NrW7fKgNycmlUiGA&s" alt="Quicky Coffee Logo" style="max-width: 100%; height: auto;"/>
            <br>

            <h6 class="mb-4" id="letra_login">Login</h6>
        </center>

        <form id="formInicioSesion">
            <label class="form-group has-float-label mb-4">
                <input class="form-control" id="correoL" name="correoL" required />
                <span>Correo electrónico</span>
                <div class="invalid-tooltip">El correo es requerido!</div>
            </label>

            <label class="form-group has-float-label mb-4">
                <input class="form-control" type="password" placeholder="Introduce tu contraseña" id="contraseniaL" name="contraseniaL" required />
                <span>Contraseña</span>
                <div class="invalid-tooltip">La contraseña es requerida!</div>
            </label>

            <center>
                <button id="boton-login" class="btn btn-success btn-lg" type="submit" id="iniciarSesion">Iniciar Sesión</button>
            </center>
        </form>
    </div>

    <div class="menu_derecho">
        <h1>EXPRESSO</h1>
        <ul>

            <li>Americano . . .  $3.00</li>
            <li>Galleta Oreo . ..$4.00</li>
            <li>Capucchino . . . $3.80</li>
        </ul>
    </div>
</div>

<script type="text/javascript"> function base_url() { return "<?=base_url()?>" } </script>
<script src="<?= base_url() ?>static/plantilla/js/vendor/jquery-3.3.1.min.js"></script>
<script src="<?= base_url() ?>static/plantilla/js/vendor/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>static/plantilla/js/dore.script.js"></script>
<script src="<?= base_url() ?>static/plantilla/js/scripts.js"></script>
<script src="<?= base_url() ?>static/propiosScripts/login.js"></script>
<script src="<?= base_url() ?>static/toastr/toastr.min.js"></script>

</body>
</html>
