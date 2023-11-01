<!--Inicio modal tipo de pago-->
                                
<div class="modal fade" id="agregarColaborador" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nombreModal">Agregar atributo</h5>
                <input type="hidden" id="acccion">
                <input type="hidden" id="idAtrD">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                
                <div class="row">
                
                    <div class="form-group col-12">
                        <label for="message-text"
                            class="col-form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombreAtributo" placeholder="Nombre del atributo">
                        <small class="text-danger" id="errornombreAtributo" style="display: none;"></small>
                    </div>
                    <div class="form-group col-12">
                        <label for="message-text"
                            class="col-form-label">Descripcion:</label>
                        <input type="text" class="form-control" id="descripcionAtributo" placeholder="Descripción del atributo">
                        <small class="text-danger" id="errordescripcionAtributo" style="display: none;"></small>
                    </div>

                    <div class="form-group col-12">
                            <label for="message-text" class="col-form-label">Precio:</label>
                            <input type="number" value="0" class="form-control" id="precioServicios" placeholder="Precio">
                            <small class="text-danger" id="errorprecioServicios" style="display: none;"></small>
                    </div>
                    <div>
                        

                    </div>
                    <div class="form-group col-12" id="divSelectAtributo">
                        <label>Tipo de atributo</label>
                        <select class="form-control select2-single" id="tipoAtributos">
                            

                        </select>
                        <small class="text-danger" id="errorselectAtributos" style="display: none;"></small>

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
