<!--Inicio modal tipo de pago-->
<!-- Agregar -->
<div class="modal fade" id="agregarColaborador" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nombreModal"></h5>
                <input type="hidden" id="acccion">
                <input type="hidden" id="idU">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>

                    <div class="row">

                        <div class="form-group col-6">
                            <label for="message-text" class="col-form-label">Nombre: <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="nombreColaborador" placeholder="Ingresa nombre">
                            <small class="text-danger" id="errornombreColaborador" style="display: none;"></small>
                        </div>
                        <div class="form-group col-6">
                            <label for="message-text" class="col-form-label">Apellidos: <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="apellidosColaborador" placeholder="Ingresa apellidos">
                            <small class="text-danger" id="errorapellidosColaborador" style="display: none;"></small>
                        </div>

                        <div class="form-group col-6">
                            <label for="message-text" class="col-form-label">Telefono: </label>
                            <input type="tel" max="10" class="form-control" id="telefonoColaborador" placeholder="Ingresa telefono">
                            <small class="text-danger" id="errortelefonoColaborador" style="display: none;"></small>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="message-text" class="col-form-label">Correo: <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="correoColaborador" placeholder="Ingresa correo">
                            <small class="text-danger" id="errorcorreoColaborador" style="display: none;"></small>
                        </div>

                        <!-- Contraseñas -->
                        <div class="form-row col-md-12" id="contrasenas"></div>
                        
                        <div class="form-group col-6">
                            <label for="message-text" class="col-form-label">RFC: </label>
                            <input type="text" class="form-control" id="rfcColaborador" placeholder="Ingresa RFC">
                            <small class="text-danger" id="errorrfcColaborador" style="display: none;"></small>
                        </div>

                        <div class="form-group col-6">
                            <label for="message-text" class="col-form-label">Sueldo: </label>
                            <input type="text" class="form-control" id="sueldoColaborador" placeholder="Ingresa un sueldo">
                            <small class="text-danger" id="errorsueldoColaborador" style="display: none;"></small>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputPassword4" class="form-label">Tipo de perfil <span style="color:red;">*</span></label>
                            <select class="form-control select2-single" id="perfilColaborador"></select>
                            <small class="text-danger" id="errorPerfilColaborador" style="display: none;"></small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4" class="form-label">Especialidad</label>
                            <select class="form-control select2-singlel" id="especialidadColaborador"></select>
                            <small class="text-danger" id="errorEspecialidadColaborador" style="display: none;"></small>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4" class="form-label">Sucursal <span style="color:red;">*</span></label>
                            <select class="form-control select2-singlel" id="sucursalColaborador"></select>
                            <small class="text-danger" id="errorSucursalColaborador" style="display: none;"></small>
                        </div>

                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="btnEnviar" onclick="InsertarColaborador()"></button>
            </div>
        </div>
    </div>
</div>
<!--Fin modal-->

<!-- Modal borrar -->
<div class="modal fade" id="borrarModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModalBorrar"></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="cuerpoModalBorrar">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="btnModalBorrar" onclick="btnModalBorrar()">Borrar</button>
            </div>
        </div>
    </div>
</div>


<!-- termina Modal borrar -->

<!-- Modal vistaPrevia -->

<div class="modal fade" id="PreviaModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModalPrevia"></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="cuerpoModalprevia">

            </div>
            <div class="modal-footer">

            </div>

        </div>
    </div>
</div>