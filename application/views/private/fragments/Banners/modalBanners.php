                                
                                  <!--Inicio modal tipo de pago-->
                                
                                <div class="modal fade" id="ModalAgregar" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="nombreModal"></h5>
                                                <input type="hidden" id="accion">
                                                <input type="hidden" id="idBan">
                                                <input type="hidden" id="estatusModal">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="message-text"
                                                            class="col-form-label">Nombre de slide:</label>
                                                        <input type="text" class="form-control" id="nombreBanners">
                                                        <small class="text-danger" id="errornombreBanners" style="display: none;"></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Descripción:</label>
                                                        <input type="text" class="form-control" id="descripcionBanners">
                                                        <small class="text-danger" id="errordescripcionBanners" style="display: none;"></small>
                                                    </div>
													<div class="form-group">
                                                        <label for="message-text" class="col-form-label">Orden:</label>
                                                        <input type="text" class="form-control" id="Orden">
                                                        <small class="text-danger" id="errorOrden" style="display: none;"></small>
                                                    </div>
													
													<div class="form-group justify-content-center">
														 <div id="imagenCategoria">



														  </div>
													 </div>
															
													
													 <div class="form-group">
														 
														 <div id="editaImagen">
															 
															 
															 <div class="input-group mb-3">
																<div class="input-group-prepend">
																	<span class="input-group-text">Imagen</span>
																</div>

																<div class="custom-file" id="inputImagen">
																	<input type="file" class="custom-file-input" id="img">

																	<label class="custom-file-label" for="customFile">Elegir imagen</label>
																</div>
															</div>
															<small class="text-danger" id="errorimg" style="display: none;"></small>
														 
														 
														 
														 </div>
														
														
													</div>
                                                    
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-success" id="btnEnviar" onclick="insertaBanners()"></button>
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
