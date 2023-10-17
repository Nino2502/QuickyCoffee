                                
                                  <!--Inicio modal Agrega Inventario-->

                            




<!--Inicio modal tipo de pago-->
                                
                                <div class="modal fade" id="ModalEditar" tabindex="-1" role="dialog" aria-hidden="false">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="nombreModalE">Nombre</h5>
                                                <input type="hidden" id="accionE">
                                                <input type="hidden" id="idE">
												<input type="hidden" id="idESuc">
												<input type="hidden" id="inputNombreSucE">
												<input type="hidden" id="cantidadAnteriorE">
												<input type="hidden" id="nombreServicioE">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                               
                                                    <div class="form-group">
														<label for="message-text" class="col-form-label">Sucursal: <strong><span id="nomSucursalE"></span></strong></label>
                                                        <label for="message-text" class="col-form-label">Producto/Servicio: <strong><span id="nomServicioE"></span></strong></label></br>
														<label for="message-text" class="col-form-label">Cantidad actual: <strong><span id="cantidadInventarioE"></span></strong></label>
                                                    </div>
                                                  

                                                    
                                                    <!-- Termina select de categorias-->
													
													 <div class="form-group">
                                                        <label for="message-text"
                                                            class="col-form-label">Nueva Cantidad</span></label>
														<div id="divCantidadE"></div>
                                                       
                                                        <small class="text-danger" id="errorcantidadE" style="display: none;"></small>
                                                    </div>
										
													<div class="form-group ">
														<label for="message-text" class="col-form-label">Comentario(opcional):</label>
														<div id="div-modal-comentario-editar">

														</div>

													</div>
														
										
										
								
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-success" id="btnEnviarE" onclick="insertaEdicion()"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!--Fin modal-->






<!--Inicio modal tipo de pago-->
                                
                                <div class="modal fade" id="ModalTranspasar" tabindex="-1" role="dialog" aria-hidden="false">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="nombreModalT">Nombre</h5>
                                                <input type="hidden" id="accionT">
                                                <input type="hidden" id="idT">
												<input type="hidden" id="idTSuc">
												<input type="hidden" id="inputNombreSuc">
												<input type="hidden" id="cantidadAnterior">
												<input type="hidden" id="nombreServicio">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="ModalbodyEditar">
                                               
                                                    <div class="form-group">
														<label for="message-text" class="col-form-label">Sucursal: <strong><span id="nomSucursalT"></span></strong></label>
                                                        <label for="message-text" class="col-form-label">Producto/Servicio: <strong><span id="nomServicio"></span></strong></label></br>
														<label for="message-text" class="col-form-label">Cantidad actual: <strong><span id="cantidadInventario"></span></strong></label>
                                                    </div>
                                                  

                                                    <div class="form-group mt-3" id="divListaSucursales">
                                                            <div class="row">
                                                                <div class="col-sm-12">

                                                                <label>Sucursal de destino</label>
																	
																<select class="form-control select2-single" id="selectListaSucrusalesT">
																	<option value="Selecciona">--Selecciona--</option>
                                                                    
                                                                </select> 
																<small class="text-danger" id="errorselectListaSucrusalesT" style="display: none;"></small>

                                                                 </div>
                                                            </div>
                                                        <small class="text-danger" id="&nbsp;" style="display: none;"></small>
                                                    </div>
                                                    <!-- Termina select de categorias-->
													
													 <div class="form-group">
                                                        <label for="message-text"
                                                            class="col-form-label">Cantidad</span></label>
														<div id="divCantidad">
														
														</div>
                                                       
                                                        <small class="text-danger" id="errorcantidadT" style="display: none;"></small>
                                                    </div>
										
													
														
														<div class="form-group">
															<label for="message-text" class="col-form-label">Comentario(opcional):</label>
															<div id="div-modal-comentario-transpaso">
																
															</div>
															
														</div>
														
														
												
										
										
										
										
										
								
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-success" id="btnEnviarT" onclick="insertaTranspaso()"></button>
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
