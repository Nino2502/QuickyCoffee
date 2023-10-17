                                
                                  <!--Inicio modal tipo de pago-->
                                
                                <div class="modal fade" id="ModalAgregar" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="nombreModal">Agregar Unidad de Medida</h5>
                                                <input type="hidden" id="accion">
                                                <input type="hidden" id="idUni">
                                                <input type="hidden" id="estatusModal">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
													<div class="form-group">
                                                        <label for="message-text"
                                                            class="col-form-label">Clave SAT:</label>
                                                        <input type="text" class="form-control" id="claveSat">
                                                        <small class="text-danger" id="errorclaveSat" style="display: none;"></small>
                                                    </div>
													
                                                    <div class="form-group">
                                                        <label for="message-text"
                                                            class="col-form-label">Nombre unidad:</label>
                                                        <input type="text" class="form-control" id="nombreUnidades">
                                                        <small class="text-danger" id="errornombreUnidades" style="display: none;"></small>
                                                    </div>
                                                    
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-success" id="btnEnviar" onclick="insertaUnidades()"></button>
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
