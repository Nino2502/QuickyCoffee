<input id="idTU" type="hidden" value="<?php echo($_SESSION['idTipoUsuario']) ?>">
<input id="Carrito" type="hidden" value="">
<input id="idCliente" type="hidden" value="">


<div class="card">
	<div class="card-header">
		<ul class="nav nav-tabs card-header-tabs " role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="true"><h3>Levantar venta</h3></a>
			</li>
			<!-- <li class="nav-item">
                             <a class="nav-link"       id="second-tab" data-toggle="tab" href="#second" role="tab"
                              aria-controls="second" aria-selected="false" onclick=""><h3>Sucurales</h3></a>
                         </li> -->
		</ul>
	</div>
	<div class="card-body">
		<div class="tab-content">
			<!-- inicia el primer tab-->
			<div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab">
				
				
				<div class="row mb-4">
					<div class="col-12 mb-4">

						<div class="card">


							<div class="row">

								<div class="card-body" id="despliegueTabla2">

									<div class="modal-body">

										<form>

											<div class="row">


												<div class="form-group col-12">
													<button type="button" class="btn btn-primary mr-3 mb-4" onclick="modalRegistro()">
														+ Agregar Cliente
													</button>
												



												
												<!--	
													<button type="button" class="btn btn-primary mr-3 mb-4" onclick="AgregarCambio()">
														Movimiento caja
													</button>

													-->



													<hr>
													<div class="row" id="ClienteSistema">
														<div id="selectCliente" class="col-4">
															<label for="message-text" class="col-form-label">Cliente:</label>
															<select id="confirmarCliente" class="form-control select2-single"></select>
															<small class="text-danger" id="errorClienteS" style="display: none;"></small>
														</div>
														<div class="input-group-append col-sm-2">
															<button class="btn btn-outline-secondary mt-4 " id="estatusAccount" type="button">Confirmar</button>
														</div>

													</div>
												</div>




											</div>

										</form>
									</div>

									<h2 class="pl-3" id="tituloAccion">Carrito de orden</h2>
									
									<!--  ****** select de productos no impresos ******-->


									<!--

									<div class="row pl-3  col-12 mb-4">
										<div class="col-sm-4" id="divListaServiciosNoImpresos">
											<label>Productos <strong style="font-size: 125%">No Impresos</strong></label>


											<select class="form-control select2-single" id="selectListaServiciosNoImpresos">
                                            </select>
										





											<small class="text-danger" id="errorselectListaServiciosNoImpresos" style="display: none;"></small>

										</div>

										<div class="col-sm-2">
											<div class="input-group-append" >
												<button class="btn btn-outline-secondary mt-4" value="2" id="btnAgregarServicioNoImpresos"> + Agregar</button>
											</div>


										</div>
										<div class="input-group-append pl-4 ml-auto">
											<button class="btn btn-outline-secondary" value="1" id="btnVentaRapida">+ Venta rapida</button>
										</div>

									</div> termina select de productos no impresos-->



									
									
									<!-- ******* select de productos impresos ******-->

									<div class="row pl-3  col-12 mt-3">
										<div class="col-sm-4" id="divListaServicios">
											<label><strong style="font-size: 125%">Productos</strong></label>


											<select class="form-control select2-single" id="selectListaServicios">
                                                                </select>
										





											<small class="text-danger" id="errorselectListaServicios" style="display: none;"></small>

										</div>

										<div class="col-sm-2">
											<div class="input-group-append">
												<button class="btn btn-outline-secondary mt-4" value="2" id="btnAgregarServicio"> + Agregar</button>
											</div>


										</div>
										

									</div> <!--termina select de productos no impresos-->
									
									
									
									
									
								</div><!-- Termina despliegue tabla dos-->


							</div><!-- fin Row-->
						</div><!-- fin card -->
					</div>
				</div>

				<div class="row mb-4">
					<div class="col-12 mb-4">
						<div class="card">
							<div class="card-body" id="despliegueTabla3">
								<h5 class="card-title">Servicios Seleccionados</h5>

								<small class="text-danger" id="errorserviciosSeleccionados" style="display: none;"></small>
								</br>
								<small class="text-danger" id="errortotal" style="display: none;"></small>

								<input type="hidden" id="accion" value="Agregar">
								<input type="hidden" id="idAS" value="0">
								<input type="hidden" id="estatusAS" value="1">
								<input type="hidden" id="validaINV" value="0">

								<table class="table table-bordered" ida="serviciosSeleccionados">
									<thead>
										<tr style="text-align: center">
											
											
											<th scope="col">#id</th>
											<th scope="col">Producto</th>
											<th scope="col">Descripción</th>
											<th scope="col">Unidad</th>
											<th scope="col">Stock</th>
											<th scope="col">Precio</th>
											
											<th >Cantidad</th>
											<th scope="col">Subtotal</th>
											<th scope="col">Quitar</th>
										</tr>
									</thead>
									<tbody id="bodySeleccionados">
									</tbody>
								</table>

								<div>

									<p>
										<h5 class="card-title text-right">Total</h5>
									</p>
									<p>
										<h5 class="card-title text-right"><strong>$<span id="totalSuma">0</span></strong></br></p>

                                                    </div>
                                                    

                                                    <div>
                                                        <button id="btnOrden" type="button" class="btn btn-primary mr-3 mb-4 float-right" onclick="insertaAgrupaServicios()" >
                                                            Levantar orden
                                                            
                                                        </button>
                                                    </div>


                                                                                    

                                                    </div>
                                                    
                                                
                                            </div>
                                        </div>






				</div>
        
			</div>
                        <!--termina aqui, inicia segundo tab-->

                        <!-- <div class="tab-pane fade" id="second" role="tabpanel"
                                 aria-labelledby="second-tab">
                            <button type="button" class="btn btn-primary mr-3 mb-4" onclick="agregarSucursal()" >
                                + hola
                                
                            </button>

                            
                                <div class="row mb-4">
                                    <div class="col-12 mb-4">
                                        <div class="card">
                                            <div class="card-body" id="despliegueTablaSucu">
                                              
                                            </div>

                                        </div>
                                    </div>
                                </div>

                

                            </div> -->
        
                        <!--termina aqui segundo tab-->
		</div>
	</div>
	<!--termina cardBody-->
</div>