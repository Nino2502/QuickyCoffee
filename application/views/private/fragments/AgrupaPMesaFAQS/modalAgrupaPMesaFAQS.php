                                
                                  <!--Inicio modal tipo de pago-->
                                
                                  <div class="modal fade" id="ModalAgregar" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="nombreModal">Agregar Pregunta Disgnostica</h5>
                                                <input type="hidden" id="accion">
                                                <input type="hidden" id="idAT">
                                                <input type="hidden" id="estatusModal">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="message-text"
                                                            class="col-form-label">Título agrupación:</label>
                                                        <input type="text" class="form-control" id="nombrePreguntasMesaFAQS">
                                                        <small class="text-danger" id="errornombrePreguntasMesaFAQS" style="display: none;"></small>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label"> * Descripción:</label>
                                                        <textarea class="form-control" rows="3" id="desPreguntasMesaFAQS"></textarea>
                                                        
                                                        <small class="text-danger" id="errordesPreguntasMesaFAQS" style="display: none;"></small>
                                                    </div>





                                                    <div class="form-group" id="divSelectMultiAgrupaPMesaFAQS">
                                                            <div class="row">
                                                                <div class="col-sm-12">

                                                                    <label>Selecciona las preguntas</label>
                                                                    <select class="form-control select2-multiple" multiple="multiple" id="SelectAgrupaPMesaFAQS">
                                                                        
                                                                        
                                                                       
                                                                        

                                                                    </select>

                                                                 </div>
                                                            </div>
                                                        <small class="text-danger" id="errorSelectAgrupaPMesaFAQS" style="display: none;"></small>
                                                    </div>
                                                    <!-- Termina select de categorias-->


                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-success" id="btnEnviar" onclick="insertaAgrupaPMesaFAQS()"></button>
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
