<div class="bg_white">
    <div class="container pt-5">
        <div class="main_title">
            <h2>Mi perfil</h2>
        </div>
    </div>

    <div class="yy container"></div>
    <br>

    <div class="container margin_30">
        <div class="row">
            <div class="col-lg-8">

                <div class="main_title">
                    <h3>Mis datos</h3>
                </div>

                <input id="idUsu" type="hidden" value="<?php echo($_SESSION['idusuario']) ?>">
                <input id="idTU" type="hidden" value="<?php echo($_SESSION['idTipoUsuario']) ?>">


                <!-- formulario de datos personales -->
                <form class="row g-3 container">
                    <div class="col-md-6">
                        <label for="inputCorreo" class="form-label">Correo</label>
                        <input type="text" readonly class="form-control-plaintext" id="correo_edit">
                    </div>
                    <div class="col-md-6">
                        <label for="inputNombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_edit">
                    </div>
                    <div class="col-md-6">
                        <label for="inputApellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellido_edit">
                    </div>
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Telefono</label>
                        <input type="text" class="form-control" id="telefono_edit">
                    </div>

                    <div class="col-12">
                        <button type="button" class="btn btn-info" onclick="actualizarDatos()" id="edit_btn">Editar informacion</button>
                    </div>
                </form>
                <br>

                <form action="">
                <h5>Datos fiscales</h5>
                    <div class="yy"></div>

                    <div class="col-md-6">
                        <label for="inputAddress2" class="form-label">Nombre o razon social</label>
                        <input type="text" class="form-control" id="direccion_edit">
                    </div>
                    <div class="col-md-6">
                        <label for="inputZip" class="form-label">RFC</label>
                        <input type="text" class="form-control" id="rfc">
                    </div>
                    <div class="col-md-9">
                        <label for="inputCity" class="form-label">Régimen Fiscal</label>
                        <input type="text" class="form-control" id="regimen">
                    </div>
                    <div class="col-md-3">
                        <label for="inputState" class="form-label">C.P.</label>
                        <input type="text" class="form-control" id="codigo_p">
                    </div>
                </form>

            </div>
            <aside class="col-lg-4">

                <div class="main_title">
                    <h3>Foto de perfil</h3>
                </div>

                <div class="d-flex justify-content-center">
                    <div class="avatar">
                        <a href="#"><img src="<?= base_url()?>static/publico/img/avatar1.jpg" alt="">
                        </a>
                    </div>
                </div>
            </aside>

        </div>
    </div>

</div>