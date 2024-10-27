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


    <style>

        .form-side{
            margin-left: 400px;  
            margin-right: 400px; 
            margin-top: 200px;
            border: 1px solid black; /* Cambia el borde a negro */
            border-radius: 10px;     /* Redondea las esquinas del borde */
            padding: 20px;           /* Agrega espacio interno para que el contenido no toque el borde */
            background-color: white; /* Fondo blanco para resaltar el borde (opcional) */

        }
        #boton-login{
            background: linear-gradient(135deg, #ff5733, #ffcc33); 
            color: white;              /* Color del texto del botón */
            border: none;              /* Quita el borde predeterminado */
            border-radius: 5px;       /* Esquinas redondeadas */
            padding: 10px 20px;       /* Espaciado interno */
            font-size: 20px;          /* Tamaño de la fuente */
            cursor: pointer; 
        }
        #letra_login {
            color: red; /* Cambia el color del texto a rojo */
            border: 2px solid white; /* Establece un borde blanco */
            padding: 5px; /* Espaciado interno */
            display: inline-block; /* Asegura que el borde se ajuste al tamaño del texto */
            font-family: 'Montserrat', sans-serif; /* Usando Montserrat */
            font-size: 24px; /* Ajusta el tamaño de la letra según lo desees */
            font-weight: 700; /* Establece el grosor de la fuente en negrita */
        }
        .menu-izquierdo{

            

        }

  
        
        </style>
	
	
</head>

<body class="background show-spinner">

<div class="container">





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
               
            </h1>
  
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSYBQh80mvhwpf_R1izQ6NrW7fKgNycmlUiGA&s" alt="Quicky Coffee Logo" style="max-width: 100%; height: auto;"/>
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
        <div class="menu_izquierdo">
                <h1>Menu izquierdo</h1>
        </div>
        <div class="menu_derecho">
            <h1>Soy menu derecho</h1>

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