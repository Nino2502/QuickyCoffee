<input id="idUsu" type="hidden" value="<?php echo ($_SESSION['idusuario']) ?>">
<input id="idTU" type="hidden" value="<?php echo ($_SESSION['idTipoUsuario']) ?>">

<div class="container-fluid">

    <div class="row">
        <div class="col col-sm-4 mb-4">

            <div class="card">
                <div class="card-body">
                    <div class="text-center">

                        <img alt="Profile" src='<?= base_url() . 'static/uploads/profiles/' . $info_usuario->image_url ?>' style="aspect-ratio: 1; border-radius: 50%;width: 150px;">
                        <form id="form-subir-img" action="<?= base_url('daniw/Perfil_usuario/subir_imagenPerfil') ?>" class="validate-ptp" method="post" enctype="multipart/form-data">
                            <input type="file" name="fileImagen" id="fileImagen" accept="image/png, image/jpeg, image/jpg " require class="form-control btn btn-primary required btn-block mt-3">
                            <button class="btn btn-link btn-block mb-4 mt-2" style="font-size: 18px">
                                <i name="btnon" id="btnon" class="fas fa-camera"></i>
                                <u>Guardar foto</u>
                            </button>
                            </input>

                            <hr>
                            <p class="list-item-heading mb-1" id="nombreUsuperfil"></p>

                            <p class="mb-4 text-muted text-small"><?php echo $_SESSION['idTipoUsuario'] == 4 ? 'Cliente' : 'Administrador' ?></p>
                        </form>
                    </div>
                </div>
            </div>


        </div>
        <div class="col col-sm-8">
            <div class="card">
                <div.mylist class="card-header" id="despliegueTabla"></div.mylist>

                <div class="card-body">
                    <div class="tab-content">


                        <!-- inicia el primer tab-->

                        <div class="tab-pane fade <?php echo $_SESSION['idTipoUsuario'] == 1 || 2 || 3 || 4 ? 'show active' : '' ?>" id="first" name="empresa" role="tabpanel" aria-labelledby="first-tab">

                            <div class="card mb-4 col-sm-12">
                                <div class="card-body">
                                    <!-- <h5 class="mb-4">Empresa</h5> -->
                                    <form class="needs-validation tooltip-label-right" novalidate>

                                        <div class="form-row pb-2">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Nombre</label>
                                                <input type="text" class="form-control" id="nombre" placeholder="Ingresa nombre">
                                                <small class="text-danger" id="errorNombre" style="display: none;"></small>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Apellidos</label>
                                                <input type="text" class="form-control" id="apellidos" placeholder="Ingresa apellidos">
                                                <small class="text-danger" id="errorApellidos" style="display: none;"></small>
                                            </div>
                                        </div>
                                        <div class="form-row pb-2">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Correo</label>
                                                <input type="text" class="form-control" id="correo" placeholder="Ingresa correo">
                                                <small class="text-danger" id="errorCorreo" style="display: none;"></small>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Teléfono</label>
                                                <input type="text" class="form-control" id="telefono" placeholder="Ingresa teléfono">
                                                <small class="text-danger" id="errorTelefono" style="display: none;"></small>
                                            </div>
                                        </div>
                                        <div style="text-align: center;">
                                            <a href="#" class="btn btn-primary mb-0" onclick="updateDatos()" id="btnGuardar">Editar perfil</a>
                                        </div>
                                        <hr>
                                        <h5 class="mb-4">Editar contraseña</h5>
                                        <div class="form-group position-relative error-l-50">
                                            <label>Contraseña actual</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="password" placeholder="Contraseña">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                                                </div>
                                            </div>
                                            <small class="text-danger" id="errorPassword" style="display: none;"></small>
                                        </div>

                                        <div class="form-row pb-2">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Nueva contraseña</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="password2" placeholder="Ingresa contraseña">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="mostrarPassword2()"> <span class="fa fa-eye-slash icon1"></span> </button>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="errorPassword2" style="display: none;"></small>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Confirma contraseña</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="password3" placeholder="Confirma contraseña">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="mostrarPassword3()"> <span class="fa fa-eye-slash icon2"></span> </button>
                                                    </div>
                                                </div>
                                                <small class="text-danger" id="errorPassword3" style="display: none;"></small>
                                            </div>
                                        </div>
                                        <div style="text-align: center;">
                                            <a href="#" class="btn btn-primary mb-0 text-center" style="justify-content: center;" onclick="updatePass()">Editar contraseña</a>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div> <!--termina aqui-->

                        <!-- tabla ded datos fiscales -->
                        <div class="tab-pane fade <?php echo $_SESSION['idTipoUsuario'] == 4 ? 'show active' : '' ?>" id="second" role="tabpanel" aria-labelledby="second-tab">
                            <div class="" id="firstCard">
                                
                            </div>

                            <div class="" id="secondCard">
                                
                            </div>
                        </div>

                        <!-- inicia el tercer tab-->

                        <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="third-tab">

                            <div class="card mb-4 col-sm-12" style="background-color: #f7fbfc;">
                                <div class="card-body">

                                    <div class="chip">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 230 384.4 300.4" width="38" height="70">
                                            <path d="M377.2 266.8c0 27.2-22.4 49.6-49.6 49.6H56.4c-27.2 0-49.6-22.4-49.6-49.6V107.6C6.8 80.4 29.2 58 56.4 58H328c27.2 0 49.6 22.4 49.6 49.6v159.2h-.4z" data-original="#FFD66E" data-old_color="#00FF0C" fill="rgb(237,237,237)" />
                                            <path d="M327.6 51.2H56.4C25.2 51.2 0 76.8 0 107.6v158.8c0 31.2 25.2 56.8 56.4 56.8H328c31.2 0 56.4-25.2 56.4-56.4V107.6c-.4-30.8-25.6-56.4-56.8-56.4zm-104 86.8c.4 1.2.4 2 .8 2.4 0 0 0 .4.4.4.4.8.8 1.2 1.6 1.6 14 10.8 22.4 27.2 22.4 44.8s-8 34-22.4 44.8l-.4.4-1.2 1.2c0 .4-.4.4-.4.8-.4.4-.4.8-.8 1.6v74h-62.8v-73.2-.8c0-.8-.4-1.2-.4-1.6 0 0 0-.4-.4-.4-.4-.8-.8-1.2-1.6-1.6-14-10.8-22.4-27.2-22.4-44.8s8-34 22.4-44.8l1.6-1.6s0-.4.4-.4c.4-.4.4-1.2.4-1.6V64.8h62.8v72.4c-.4 0 0 .4 0 .8zm147.2 77.6H255.6c4-8.8 6-18.4 6-28.4 0-9.6-2-18.8-5.6-27.2h114.4v55.6h.4zM13.2 160H128c-3.6 8.4-5.6 17.6-5.6 27.2 0 10 2 19.6 6 28.4H13.2V160zm43.2-95.2h90.8V134c-4.4 4-8.4 8-12 12.8h-122V108c0-24 19.2-43.2 43.2-43.2zm-43.2 202v-37.6H136c3.2 4 6.8 8 10.8 11.6V310H56.4c-24-.4-43.2-19.6-43.2-43.2zm314.4 42.8h-90.8v-69.2c4-3.6 7.6-7.2 10.8-11.6h122.8v37.6c.4 24-18.8 43.2-42.8 43.2zm43.2-162.8h-122c-3.2-4.8-7.2-8.8-12-12.8V64.8h90.8c23.6 0 42.8 19.2 42.8 42.8v39.2h.4z" data-original="#005F75" class="active-path" data-old_color="#005F75" fill="rgba(0,0,0,.4)" />
                                        </svg>
                                    </div>
                                    <form class="form-card" action="#">
                                        <div class="form-group">
                                            <label for="inputEmail4">Número de tarjeta</label>
                                            <input type="password" class="form-control" id="cardNum" placeholder="0000 - 0000 - 0000 - 0000">
                                            <small class="text-danger" id="errorCP" style="display: none;"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail4">Nombre del propietario</label>
                                            <input type="text" class="form-control" id="cardNom" placeholder="Ingresa nombre">
                                            <small class="text-danger" id="errorNombre" style="display: none;"></small>
                                        </div>
                                        <div class="form-row pb-2">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Valid Thru</label>
                                                <input type="text" class="form-control" id="exp" placeholder="Ingresa fecha de expiración">
                                                <small class="text-danger" id="errorNombre" style="display: none;"></small>
                                            </div>
                                            <!-- <div class="form-group col-md-6">
                                                        <label for="inputPassword4">cvc</label>
                                                        <input type="text" class="form-control" id="apellidos" placeholder="Ingresa apellidos" style="border: none; border-bottom: 1px solid gray; outline: none;"
                                                        <small class="text-danger" id="errorApellidos" style="display: none;"></small>
                                                    </div> -->
                                            <div class="form-group col-md-6 mt-4">
                                                <buttona class="btn btn-info">Agregar</button>
                                            </div>
                                        </div>


                                        <!-- <label1 for="name">Nombre
                                                    <input1 type="text" id="name" placeholder="Jhon Doe">
                                                </label1>
                                                <label1 for="date">Valid Thru
                                                    <input1 type="text" id="date" placeholder="00/00">
                                                </label1>
                                                <label1 for="cvc">cvc
                                                    <input1 type="text" id="cvc" placeholder="000">
                                                </label1> -->
                                        <!-- <button1>Guardar
                                                    <i class="fa fa-angle-right"></i>
                                                </button1>
                                                <label1 for="remember">Save my information for later
                                                    <input type="checkbox" checked="checked" id="remember">
                                                </label1> -->
                                    </form>
                                    <!-- <div style="text-align: center;">
                                                <button type="button" class="btn btn-primary" onclick="agregar()" >
                                                    + Agregar
                                                </button>
                                            </div> -->
                                </div>

                            </div>

                            <div class="card mb-4 col-sm-12">
                                <div class="card-body">
                                    <div class="tab-content">

                                        <div class="row mb-2">
                                            <div class="col-12 mb-2">

                                                <div class="card-body" id="despliegueTab2">
                                                    <p>No hay datos registrados</p>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- <div style="text-align: center;">
                                                    <button type="button" class="btn btn-primary" onclick="agregar()" >
                                                        + Agregar
                                                    </button>
                                                </div> -->

                                    </div>
                                </div>
                            </div>

                        </div> <!--termina aqui-->

                    </div>
                </div>

                <!--termina cardBody-->
            </div>
        </div>

    </div>

</div>