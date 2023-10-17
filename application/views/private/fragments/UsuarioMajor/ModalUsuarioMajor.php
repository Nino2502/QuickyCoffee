<!--Inicio modal tipo de pago-->
                                
<div class="modal fade" id="agregarColaborador" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nombreModal">Agregar Major</h5>
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
                        <label for="message-text"
                            class="col-form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombreColaborador">
                        <small class="text-danger" id="errornombreColaborador" style="display: none;"></small>
                    </div>
                    <div class="form-group col-6">
                        <label for="message-text"
                            class="col-form-label">Apellidos:</label>
                        <input type="text" class="form-control" id="apellidosColaborador">
                        <small class="text-danger" id="errorapellidosColaborador" style="display: none;"></small>
                    </div>
                    <div class="form-group col-6">
                        <label for="message-text" class="col-form-label">Telefono:</label>
                        <input type="tel" max="10" class="form-control" id="telefonoColaborador">
                        <small class="text-danger" id="errortelefonoColaborador" style="display: none;"></small>
                    </div>
                    <div class="form-group col-6">
                        <label for="message-text" class="col-form-label">Correo:</label>
                        <input type="text" class="form-control" id="correoColaborador">
                        <small class="text-danger" id="errorcorreoColaborador" style="display: none;"></small>
                    </div>
                    <div class="form-group col-12">
                        <label for="message-text" class="col-form-label">RFC:</label>
                        <input type="text" class="form-control" id="rfcColaborador">
                        <small class="text-danger" id="errorrfcColaborador" style="display: none;"></small>
                    </div>
                    <div class="form-group col-6" id="passN">
                            <label for="exampleInputPassword1">Contraseña</label>
                            <div class="input-group">
                                    <input type="password" class="form-control" id="contrasenaColaborador"
                                                placeholder="Contraseña">
                                    <div class="input-group-append">
                                    <button id="contraseñaV" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon2"></span> </button>
                                    </div>
                                    <small class="text-danger" id="errorcontrasenaColaborador" style="display: none;"></small>
                                    <small class="text-danger" id="errorcontrasenaColaborador1" style="display: none;"></small>
                            </div>
                    </div>
                    <div class="form-group col-6" id="passO">
                            <label for="exampleInputPassword1">Contraseña</label>
                            <div class="input-group">
                                    <input type="password" class="form-control" id="contrasenaNColaborador"
                                                placeholder="Confirmar contraseña">
                                    <div class="input-group-append">
                                    <button id="contraseñaV2" class="btn btn-primary" type="button" onclick="mostrarPasswordConfirmar()"> <span class="fa fa-eye-slash icon"></span> </button>
                                    </div>
                                    <small class="text-danger" id="errorcontrasenaNColaborador" style="display: none;"></small>
                            </div>
                    </div>
                
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                    data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="btnEnviar" onclick="InsertarColaborador()">Agregar Major</button>
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
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Cancelar</button>
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


<!-- termina Modal vistaPrevia -->


<div class="modal fade" id="modalSucursal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nombreModalSucu">Agregar sucursal</h5>
                <input type="hidden" id="acccion">
                <input type="hidden" id="idSuc">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                
                <div class="row">

                 <!-- Seccion para super administrador-->
                            <div id="SelectMajor" class="form-group  <?php echo $_SESSION['idTipoUsuario'] == 1  ? 'col-12' : 'col-6'?>">
                     
                             </div>
                             <div class="form-group  <?php echo $_SESSION['idTipoUsuario'] == 1  ? 'col-12' : null ?>">
                             <div class="custom-control custom-checkbox mb-4">
                                    <input type="checkbox" class="custom-control-input" id="customCheckThis">
                                    <label class="custom-control-label" id="titleAccept" for="customCheckThis">Domicilio fiscal</label>
                                </div>
                            </div>

                            <div class="form-group  <?php echo $_SESSION['idTipoUsuario'] == 1  ? 'col-6' : null ?>">
                                <label for="message-text" class="col-form-label">Nombre Sucursal:</label>
                                <input type="text" class="form-control" id="nombreSuc"  placeholder="Nombre sucursal">
                                <small class="text-danger" id="errorrfcColaborador" style="display: none;"></small>
                            </div>

                            <div class="form-group  <?php echo $_SESSION['idTipoUsuario'] == 1  ? 'col-6' : null ?>">
                                <label for="message-text" class="col-form-label">Calle:</label>
                                <input type="text" class="form-control" id="calleSucursal"  placeholder="Calle">
                                <small class="text-danger" id="errorrfcColaborador" style="display: none;"></small>
                            </div>
                            
                            
                            <div class="form-group  <?php echo $_SESSION['idTipoUsuario'] == 1  ? 'col-4' : null ?>">
                                <label for="message-text" class="col-form-label">N# ext:</label>
                                <input type="text" class="form-control" id="nExteriorSu"  placeholder="Numero exterior">
                                <small class="text-danger" id="errorrfcColaborador" style="display: none;"></small>
                            </div>

                            <div class="form-group  <?php echo $_SESSION['idTipoUsuario'] == 1  ? 'col-4' : null ?>">
                                <label for="message-text" class="col-form-label">N# int:</label>
                                <input type="text" class="form-control" id="nInteriorSu"  placeholder="Numero interior">
                                <small class="text-danger" id="errorrfcColaborador" style="display: none;"></small>
                            </div>

                            <div class="form-group  <?php echo $_SESSION['idTipoUsuario'] == 1  ? 'col-4' : null ?>">
                                <label for="message-text" class="col-form-label">Codigo Postal:</label>
                                <input type="text" class="form-control" id="cpSu"  placeholder="Codigo postal">
                                <small class="text-danger" id="errorrfcColaborador" style="display: none;"></small>
                            </div>
                            <div class="form-group  <?php echo $_SESSION['idTipoUsuario'] == 1  ? 'col-4' : null ?>">
                                <label for="message-text" class="col-form-label">Municipio:</label>
                                <input type="text" class="form-control" id="municipioSu"  placeholder="Municipio ">
                                <small class="text-danger" id="errorrfcColaborador" style="display: none;"></small>
                            </div>
                            <div class="form-group  <?php echo $_SESSION['idTipoUsuario'] == 1  ? 'col-4' : null ?>">
                                <label for="message-text" class="col-form-label">Estado:</label>
                                <input type="text" class="form-control" id="estadoSu"  placeholder="Estado">
                                <small class="text-danger" id="errorrfcColaborador" style="display: none;"></small>
                            </div>

                            <div class="form-group  <?php echo $_SESSION['idTipoUsuario'] == 1  ? 'col-12' : null ?>">
                                <label for="message-text" class="col-form-label">Descripción:</label>
                                <input type="text" class="form-control" id="descripcionSu"  placeholder="Descripción">
                                <small class="text-danger" id="errorrfcColaborador" style="display: none;"></small>
                            </div>

                            

                 
                
                </div>
                
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                    data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="btnEnviarSuc" onclick="InsertartSucursal()">Agregar</button>
            </div>
        </div>
    </div>
</div>
