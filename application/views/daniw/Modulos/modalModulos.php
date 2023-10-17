                                <!--Inicio modal tipo de pago-->

                                <div class="modal fade" id="ModalAgregar" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="nombreModal"></h5>
                                                <input type="hidden" id="accion">
                                                <input type="hidden" id="modulo_id">
                                                <input type="hidden" id="estatusModal">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <!-- Add name -->
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Nombre del modulo:</label>
                                                        <input type="text" class="form-control" id="nombreModulos">
                                                        <small class="text-danger" id="errornombre" style="display: none;"></small>
                                                    </div>

                                                    <!-- Description ...-->
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Descripción:</label>
                                                        <input type="text" class="form-control" id="des">
                                                        <small class="text-danger" id="errordes" style="display: none;"></small>
                                                    </div>

                                                    <!-- Icon -->
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Icono:</label>
                                                        <input type="text" class="form-control" id="iconModulos">
                                                        <small class="text-danger" id="errorIcono" style="display: none;"></small>
                                                    </div>

                                                    <!-- Orden by -->
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Orden:</label>
                                                        <input type="numeric" class="form-control" id="ordenModulos">
                                                        <small class="text-danger" id="errorOrden" style="display: none;"></small>
                                                    </div>

                                                    
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-success" id="btnEnviar" onclick="insertaModulos()"></button>
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


                            