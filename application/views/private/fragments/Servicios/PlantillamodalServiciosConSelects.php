                                
                                  <!--Inicio modal tipo de pago-->
                                
                                  <div class="modal fade" id="ModalAgregar" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="nombreModal"></h5>
                                                <input type="hidden" id="accion">
                                                <input type="hidden" id="idS">
                                                <input type="hidden" id="estatusModal">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="formulario">
                                                    <div class="form-group">
                                                        <label for="message-text"
                                                            class="col-form-label">Nombre de Servicio:</label>
                                                        <input type="text" class="form-control" id="nombreServicios">
                                                        <small class="text-danger" id="errornombreServicios" style="display: none;"></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Descripción:</label>
                                                        <textarea class="form-control" rows="3" id="descripcionServicios"></textarea>
                                                        
                                                        <small class="text-danger" id="errordescripcionServicios" style="display: none;"></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">precio:</label>
                                                        <input type="text" class="form-control" id="precioServicios">
                                                        <small class="text-danger" id="errordescripcionServicios" style="display: none;"></small>
                                                    </div>

                                                    <div class="mb-4">
                                                        <div class="custom-control custom-checkbox mb-4">
                                                            <input type="checkbox" class="custom-control-input" id="subServicioCheck">
                                                            <label class="custom-control-label" for="subServicioCheck">Es un subservicio</label>
                                                        </div>
                                                    </div>

                                                    <div class="mb-4">
                                                        <div class="custom-control custom-checkbox mb-4">
                                                            <input type="checkbox" class="custom-control-input" id="formDiagnosticoCheck">
                                                            <label class="custom-control-label" for="formDiagnosticoCheck">Le aplica un formulario diagnostico</label>
                                                        </div>
                                                    </div>

                                                    <!-- Comienza select de formularios-->
                                                    <div class="form-group" id="selectFormDiagnostico">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <label>Formularios Diagnosticos</label>
                                                                        <select class="form-control select2-single" id="formularioDiagnosticoServicios">
                                                                                <option value="Selecciona">--Selecciona--</option>
                                                                                <option value="2">Form2</option>
                                                                                <option value="3">Form 3</option>
                                                                                <option value="4">Form 4</option>
                                                                                <option value="5">Form 5</option>
                                                                                <option value="6">Form 6</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                    </div>
                                                    <!-- Termina select de formularios-->


                                                    <!-- Comienza select de categorias-->
                                                    <div class="form-group" id="selectCategoriasServicios">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <label>Categorías de Servicios</label>
                                                                        <select class="form-control select2-single" id="categoriaServicios">
                                                                                <option value="Selecciona">--Selecciona--</option>
                                                                                <option value="2">Cat 1</option>
                                                                                <option value="3">Cat 2</option>
                                                                                <option value="4">cat 3</option>
                                                                                <option value="5">Cat 4</option>
                                                                                <option value="6">cat 5</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                        <small class="text-danger" id="errorcategoriaServicios" style="display: none;"></small>
                                                    </div>
                                                    <!-- Termina select de categorias-->

                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-success" id="btnEnviar" onclick="insertaServicios()"></button>
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
