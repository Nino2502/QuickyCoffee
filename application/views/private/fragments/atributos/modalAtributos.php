                                
                                  <!--Inicio modal tipo de pago-->
                                
                                <div class="modal fade" id="ModalAgregar" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="nombreModal">Agregar Atributos</h5>
                                                <input type="hidden" id="accion">
                                                <input type="hidden" id="idAtr">
                                                <input type="hidden" id="estatusModal">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="message-text"
                                                            class="col-form-label">Nombre del Atributo:</label>
                                                        <input type="text" class="form-control" id="nombreAtributos">
                                                        <small class="text-danger" id="errornombreAtributos" style="display: none;"></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Descripción:</label>
                                                        <input type="text" class="form-control" id="descripcionAtributos">
                                                        <small class="text-danger" id="errordescripcionAtributos" style="display: none;"></small>
                                                    </div>
                                                    <div class="form-group" id="divAtributos">
                                                            
                                                                                                                
                                                    </div>

                                                    <!--<div class="col-sm-6" id="divSelectCategoriasServicios">
                                                        <label> * Categorías de Servicios</label>
                                                        <select class="form-control select2-single" id="selectCategoriaServicios">
                                                                
                                                        </select>
                                                    </div>-->

                                                    <div class="form-group" id="divSelectCategoriasServicios">
                                                            <div class="row">
                                                                <div class="col-sm-12">

                                                                    <label>Selecciona las categorías a la que pertenece</label>
                                                                    <select class="form-control select2-multiple" multiple="multiple" id="selectCategoriaServicios">
                                                                        
                                                                        
                                                                       
                                                                        

                                                                    </select>

                                                                 </div>
                                                            </div>
                                                        <small class="text-danger" id="errorselectCategoriaServicios" style="display: none;"></small>
                                                    </div>
                                                    <!-- Termina select de categorias-->





                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-success" id="btnEnviar" onclick="insertaAtributos()"></button>
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
