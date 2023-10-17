   
           
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs " role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
                                aria-controls="first" aria-selected="true"><h3>Inventario</h3></a>
                        </li>
						<!--<li class="nav-item">
                            <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab"
                                aria-controls="second" aria-selected="true"><h3>Inventario Inicial</h3></a>
                        </li>-->
                       
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        
                        
                        <!-- inicia el primer tab-->
                        
                        <div class="tab-pane fade show active" id="first" role="tabpanel"
                            aria-labelledby="first-tab">
							
							
							<div class="row mb-4">
                                    <div class="col-12 mb-4">
                                        <div class="card">
                                            <div class="card-body" id="divSucursales">

												<div class="d-flex justify-content-between">

													<div class="col-sm-3">
														<label>Sucursal</label>
														<select class="form-control select2-single" id="selectSucursales">
														</select>
													</div>
													<div>
														<h5 class="card-title mt-4" >Agregar un nuevo inventario <button type="button" class="btn btn-primary " onClick="agregar()"><strong>+</strong></button></h5>
													
													</div>
													
												</div><!-- termina row-->
												
												
												<!-- Inicia agrega inventario-->	
												<div id="nuevoInventario"  style="display: none;">
													
													<div class="contenido">
														<div class="modal-header">
															<h5 class="modal-title" id="nombreAgregaInv"></h5>
															<input type="hidden" id="accionAI">
															
															<input type="hidden" id="estatusModal">
															<button type="button" class="close" id="cerrarAgregaInv" onClick="cierraAgregaInventario()" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">

																<div class="form-group">
																	<label for="message-text"
																		class="col-form-label">Sucursal: <strong><span id="nomsucursal"></span></strong></label>


																</div>


																<div class="form-group mt-3" id="divListaServicios">
																		<div class="row">
																			<div class="col-sm-12">

																				 <label>Servicios</label>

																			<select class="form-control select2-single" id="selectListaServicios">
																				<option value="Selecciona">--Selecciona--</option>

																			</select> 




																				<small class="text-danger" id="errorselectListaServicios" style="display: none;"></small>

																			 </div>
																		</div>
																	<small class="text-danger" id="&nbsp;" style="display: none;"></small>
																</div>
																<!-- Termina select de categorias-->

																 <div class="form-group" id="divCantidadAgregaInv">
																	<label for="message-text"
																		class="col-form-label">cantidad</span></label>
																	<input type="number" class="form-control" id="cantidad">
																	<small class="text-danger" id="errorcantidad" style="display: none;"></small>
																</div>








														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-danger" data-dismiss="modal" onClick="cierraAgregaInventario()">Cancelar</button>
															<button type="button" class="btn btn-success" id="btnAgregaInv" onclick="insertaInventario()">Aceptar</button>
														</div>
													</di




																></div>



											</div><!-- termina agrega inventario-->	
												
												
												</div>
                                              
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            

                            
                                <div class="row mb-4">
                                    <div class="col-12 mb-4">
                                        <div class="card">
                                            <div class="card-body" id="despliegueTabla">
												
												Elige una sucursal
                                              
                                            </div>



                                        </div>
                                    </div>
                                </div>
                        </div>
        
                        <!--termina aqui, inicia segundo tab-->
						
						<!-- inicia el second tab
                        
                      <div class="tab-pane fade show " id="second" role="tabpanel"
                            aria-labelledby="first-tab">
                            

                            
                                <div class="row mb-4">
                                    <div class="col-12 mb-4">
                                        <div class="card">
                                            <div class="card-body" id="divAgregaInventarioU">
												
														<div class="row">
															<div class="col-sm-6">
																<label>Servicios</label>
																<select class="form-control select2-single" id="selectServicios">
																</select>
															</div>
															<div class="col-sm-3">
																<label>Sucursal</label>
																<select class="form-control select2-single" id="selectSucursales">
																</select>
															</div>
															<button type="button" class="btn btn-primary mt-4" onClick="agregarLista()"><strong>+</strong></button>
														</div><!-- termina row-->
                                            <!--</div><!-- termina card-body-->
                                       <!-- </div><!-- termina card 1-->
										
										
										
										<!--<div class="card mt-4">
                                            <div class="card-body" id="divListaAgregaInventario">
												
												
													
                                              
                                            </div><!-- termina card body -->
                                       <!-- </div><!-- termina card 2-->
										
										
                                   <!-- </div>
                                </div>
                        </div>
        
                        <!--termina aqui, inicia tercer tab-->
                        
                        
                       	
                    </div>
                </div>
                <!--termina cardBody-->
            </div>
   