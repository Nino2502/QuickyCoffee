                                
                                  <!--Inicio modal tipo de pago-->
                                
                                <div class="modal fade" id="ModalAgregar" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="nombreModal">Agregar Pregunta Disgnostica</h5>
                                                <input type="hidden" id="accion">
                                                <input type="hidden" id="idFormD">
                                                <input type="hidden" id="estatusModal">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="message-text"
                                                            class="col-form-label">Nombre del grupo de preguntas:</label>
                                                        <input type="text" class="form-control" id="nombreAgrupaPreguntasDiagnosticas">
                                                        <small class="text-danger" id="errornombreAgrupaPreguntasDiagnosticas" style="display: none;"></small>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label"> * Descripción:</label>
                                                        <textarea class="form-control" rows="3" id="descripcionAgrupaPD"></textarea>
                                                        
                                                        <small class="text-danger" id="errordescripcionAgrupaPD" style="display: none;"></small>
                                                    </div>





                                                    <div class="form-group" id="divSelectMultiAgrupaPreguntasDiagnosticas">
                                                            <div class="row">
                                                                <div class="col-sm-12">

                                                                    <label>Selecciona las preguntas</label>
                                                                    <select class="form-control select2-multiple" multiple="multiple" id="SelectAgrupaPreguntasDiagnosticas">
                                                                        
                                                                        
                                                                       
                                                                        

                                                                    </select>

                                                                 </div>
                                                            </div>
                                                        <small class="text-danger" id="errorSelectAgrupaPreguntasDiagnosticas" style="display: none;"></small>
                                                    </div>
                                                    <!-- Termina select de categorias-->


                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-success" id="btnEnviar" onclick="insertaAgrupaPreguntasDiagnosticas()"></button>
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






<!-- Modal borrar -->

<div class="modal fade" id="vistaPreviaModal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="tituloModaVistaPrevia"></h5>
                                                
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="cuerpoModalVistaPrevia">
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- termina Modal borrar -->
