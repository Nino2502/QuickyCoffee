<div class="card">
	<div class="card-header">
		<ul class="nav nav-tabs card-header-tabs " role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="true"><h3>Agregar Servicios</h3></a>
			</li>

		</ul>
	</div>
	<div class="card-body">
		<div class="tab-content">


			<!-- inicia el primer tab-->

			<div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab">

				<div class="d-flex justify-content-between">

					<button type="button" class="btn btn-primary mr-3 mb-4" onclick="insertaServicios()" id="guardar2">
                        + Guardar
                        
                    </button>
				


					<button type="button" class="btn btn-info mr-3 mb-4" onclick=" regresar()">
                        Regresar
                        
                    </button>
				


				</div>


				<div class="row mb-4">
					<div class="col-12 mb-4">
						<div class="card">
							<div class="card-body" id="despliegueTabla">



								<form id="addRecordForm">
									<input type="hidden" value="Agregar" id="accion">
									<input type="hidden" value="0" id="idS">
									<input type="hidden" value="1" id="estatusModal">

									<div class="row">

										<div class="custom-control custom-checkbox mb-4">
											<input type="checkbox" onchange="cambioCheckCodigoBarras()" class="custom-control-input" id="codigoBarrasCheck">
											<label class="custom-control-label" for="codigoBarrasCheck">Tiene Codigo de barras</label>
										</div>

										<div class="form-group col-sm-6" id="divCodigoBarras" style="display: none;">
											<input type="text" class="form-control" id="codigoDeBarras" placeholder="Escanear el código">
											<small class="text-danger" id="errorcodigoDeBarras" style="display: none;"></small>
										</div>

									</div>


									<div class="row">
										<div class="form-group col-sm-6">
											<label for="message-text" class="col-form-label"> * Nombre de Servicio:</label>
											<input value="" type="text" class="form-control"  id="nombreServicios" placeholder="Escribe un nombre para el servicio">
											<small class="text-danger" id="errornombreServicios" style="display: none;"></small>
										</div>
										<div class="form-group col-sm-6">
											<label for="message-text" class="col-form-label"> * Descripcións:</label>
											<textarea  class="form-control" rows="3" id="descripcionServicios" placeholder="Descripcion del producto"></textarea>
											<small class="text-danger" id="errordescripcionServicios" style="display: none;"></small>
										</div>
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-sm-6" id="divSelectCategoriasServicios">
												<label> * Categorías de Servicios</label>
												<select onchange="muestraAtributosSC()" class="form-control select2-single" id="selectCategoriaServicios">
													<!-- onchange="muestraAtributosSC()"-->

												</select>
												<small class="text-danger" id="errorselectCategoriaServicios" style="display: none;"></small>
											</div>

											<div class="col-sm-6">
												<label for="message-text" class="col-form-label"> * Sku:</label>
												<input value="" type="text" class="form-control" id="sku" placeholder="sku">
												<small class="text-danger" id="errorsku" style="display: none;"></small>
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="row" id="selectDeAtributos">

										</div>
									</div>



									<!-- select de agrupaciones -->
									<div class="form-group mt-3">
										<div class="row">

											<div class="col-sm-2">
												<div class="custom-control custom-checkbox mb-4">
													<input type="checkbox" onchange="cambioAgrupaServicio()" class="custom-control-input" id="servicioAgrupadoCheck">
													<label class="custom-control-label" for="servicioAgrupadoCheck">Agrupar Servicio </label>
												</div>

											</div>




											<div class="col-sm-6" id="divServicioAgrupado" style="display: none;">



												<div class="row">

													<div class="col-10" id="divSelectAgrupaciones">
														<label> * Agrupaciones</label>
														<select class="form-control select2-single" id="SelectAgrupaciones">
															
														 </select>

													


														<small class="text-danger" id="errorSelectAgrupaciones" style="display: none;"></small>
													</div>

													<div class="col-2 pt-2">
														<button onClick="agregaAgrupacionServicio()" type="button" class="btn btn-primary">+</button>
													</div>

												</div>

											</div>
										</div>
									</div>

									<!-- termina select de agrupaciones -->



									<div class="form-group mt-2">

										<div class="row">




											<!-- nuevo impreso no impreso -->


											<div class="col-sm-6" id="ImpresoNoImpreso">

												<small class="text-danger" id="errorImpresoNoImpreso" style="display: none;"></small>


												<h4>Selecciona si pertenece a impresos, no impresos o ambos</h4>
												<div>




													<div class="col-sm-4">
														<div class="custom-control custom-checkbox mb-4">
															<input type="checkbox" class="custom-control-input" id="servicioNoImpresoCheck">
															<label class="custom-control-label" for="servicioNoImpresoCheck">No impreso </label>
														</div>
													</div>

													<div class="col-sm-4">
														<div class="custom-control custom-checkbox mb-4">
															<input type="checkbox" onClick="cambioCheckImpresion()" class="custom-control-input" id="servicioImpresoCheck">
															<label class="custom-control-label" for="servicioImpresoCheck">Impreso </label>
														</div>
													</div>




													<small class="text-danger" id="errorCheckImpre" style="display: none;"></small>

												</div>


												<div class="col-sm-12" id="divPrecioImpresion" style="display: none;">
													<div class="row">
														<div class="col-10">
															<label for="message-text" class="col-form-label"> * Precio de la impresión por menudeo:</label>
															<input type="text" class="form-control" value="0" id="precioServiciosConImpresion">
															<small class="text-danger" id="errorprecioServiciosConImpresion" style="display: none;"></small>
														</div>
														<div class="col-2">

															<button type="button" class="btn btn-primary mt-4" id="btnAgregaPreSerImp">+</button>
															
														</div>
													</div>
												</div>





											





											</div>


											<!-- -->







											<!-- anterior impreso no impreso -->

											<!--

                                                    <div class="col-sm-6" id="ImpresoNoImpreso">
														
														<small class="text-danger" id="errorImpresoNoImpreso" style="display: none;"></small>
														
														
														
															 <div>
																 <input type="checkbox" onchange="cambioAgrupaServicio()" class="custom-control-input" id="servicioAgrupadoCheck">
																 
													 
																 <div class="custom-control custom-radio">
																	 <input type="checkbox" class="custom-control-input" id="servicioAgrupadoCheck">
																	<input onchange="cambioCheckImpresion()" type="radio" id="customRadio1" name="customRadio" class="custom-control-input"  value="noImpreso">
																	<label class="custom-control-label" for="customRadio1">No Impreso</label>
																</div>
																<div class="custom-control custom-radio">
																	<input onchange="cambioCheckImpresion()" type="radio" id="customRadio2" name="customRadio" class="custom-control-input"  value="impreso">
																	<label class="custom-control-label" for="customRadio2">Impresos</label>
																</div>
																 <small class="text-danger" id="errorCheckImpre" style="display: none;"></small>

															 </div>


															<div id="divPrecioImpresion" style="display: none;">
																<label for="message-text" class="col-form-label"> * Precio de impresión:</label>
																<input   type="text"  class="form-control" value="" id="precioServiciosConImpresion">
																<small class="text-danger" id="errorprecioServiciosConImpresion" style="display: none;"></small>
															</div>
                                                    </div>

												-->

											<!-- termian anterior impreso no impreso -->


											<div class="col-sm-6">
												<div class="custom-control custom-checkbox mb-4">
													<input onchange="cambioCheckPoliticas()" type="checkbox" class="custom-control-input" id="politicas">
													<label class="custom-control-label" for="politicas">¿Tiene politicas?</label>
												</div>

												<div class="col-sm-6" id="divPoliticas" style="display: none;">
													<label> * Politicas</label>
													<select class="form-control select2-single" id="selectPoliticas">
                                                            
                                                            </select>

												</div>
												<small class="text-danger" id="errorselectPoliticas" style="display: none;"></small>
											</div>


										</div>





									</div> <!-- termina primera seccion row -->
									
									<!-- comienza seccion precios dinamicos de impresion -->
									
									<div class="form-group">
										<div class="row">
											
											
												<div id="precioDinamicoImpresion" class=" col-sm-12">
													<!-- div para precios dinamicos -->
													<table id="tablaPreDinImpresion" class="table mt-3">
														
														<tbody id="tBodyfilasPreSerImpr">
															
															
															<!-- style="width: 15rem;"-->
															
														
														</tbody>


													</table>

												</div>
											
											
											
											
											
											
										</div>
									</div>
									
									
									<!-- termina seccion precios dinamicos impresion -->


									<div class="form-group">



										<div class="row">
											
											
											
										<div class="form-group col-sm-6 mt-4">
											<label for="message-text" class="col-form-label"> Area impresión:</label>
											<input value="" type="text" class="form-control" id="areaImpresion" placeholder="Escribe el area de impresión">
											<small class="text-danger" id="errorareaImpresión" style="display: none;"></small>
										</div>
											
											

											<div class="col-sm-6 mt-4" id="divUnidades">
												<label> * Unidad</label>
												<select onchange="muestraAnchoMaterial()" class="form-control select2-single" id="selectUnidades">
                                                         
                                                    </select>

											



												<small class="text-danger" id="errorunidad" style="display: none;"></small>


											</div>

											<div class="col-sm-6">
												<label for="message-text" class="col-form-label"> Inventario Min:</label>
												<input value="0" type="number" class="form-control" id="inventarioMinimo">
												<small class="text-danger" id="errorinventarioMinimo" style="display: none;"></small>
											</div>
											<!--
											<div class="col-sm-6" style="display: none;" id="divanchoMaterial">
												
											</div>

											-->
											<div class="col-sm-6">
												<p>SOY UN PARRAFO</p>
												<h5>SOI UN TEXTO</h5>
												
											</div>


										</div>

										<!--
										<div class="row">

											<div class="col-sm-6">
												<label for="message-text" class="col-form-label"> * Precio Menudeo:</label>
												<input type="number" value="0" class="form-control" id="precioServicios">
												<small class="text-danger" id="errorprecioServicios" style="display: none;"></small>
											</div>
										

										</div>-->
								
								<!-- div para los precios dinamicos por producto -->
										<div class="col-sm-12" id="divPrecioProducto">
											<div class="row">


												<div class="col-6">
													<div class="row">
														<div class="col-10">
															
																<label for="message-text" class="col-form-label"> * Precio del producto/servico por menudeo:</label>
																<input type="number" value="0" class="form-control" id="precioServicios">
																<small class="text-danger" id="errorprecioServicios" style="display: none;"></small>
															
														</div>
														<div class="col-2">

															<button id="btnAgregaPreDinPro" type="button" class="btn btn-primary mt-4">+</button>
														</div>
													</div>


												</div>
												<div class="col-6">

												
												</div>
												
												<div class="col-12">
													
													<div class="form-group">
														<div class="row">
																<div id="precioDinamicoProducto" class="col-sm-12">
																	<!-- div para precios dinamicos -->
																	<table id="tablaPreDinPro" class="table mt-3">
																		<tbody id="tBodyfilasPreDinPro">
																			

																		</tbody>
																	</table>

																</div>
														</div>
													</div><!-- fin div form group -->
												
												
												</div>

											</div>
										</div>

											

					
								
								<!-- termina  div para los precios dinamicos por producto -->


									<!-- iniciadiv menudeo mayoreo anterior -->
										<!--<div class="row">
											<div class="col-sm-6">
												<label for="message-text" class="col-form-label"> Cantidad Medio Mayoreo:</label>
												<input type="number" value="0" class="form-control" id="cantidadMedioMayoreo">
												<small class="text-danger" id="errorcantidadMedioMayoreo" style="display: none;"></small>
											</div>

											<div class="col-sm-6">
												<label for="message-text" class="col-form-label"> Precio Medio Mayoreo:</label>
												<input type="number" value="0" class="form-control" id="precioMedioMayoreo">
												<small class="text-danger" id="errorprecioMedioMayoreo" style="display: none;"></small>
											</div>
											<div class="col-sm-6">
												<label for="message-text" class="col-form-label"> Cantidad Mayoreo:</label>
												<input type="number" value="0" class="form-control" id="cantidadMayoreo">
												<small class="text-danger" id="errorcantidadMayoreo" style="display: none;"></small>
											</div>
											<div class="col-sm-6">
												<label for="message-text" class="col-form-label"> Precio Mayoreo:</label>
												<input type="number" value="0" class="form-control" id="precioMayoreo">
												<small class="text-danger" id="errorprecioMayoreo" style="display: none;"></small>
											</div>


										</div> -->
								<!-- termina div menudeo mayoreo anterior -->
								
								
									</div>


									<!--	
										 <div class="form-group" id="Sucursales">

                                            <div class="custom-control custom-checkbox mb-4">
												<input type="checkbox" onchange="cambioInventarioInicial()" class="custom-control-input" id="inventarioInicial">
												<label class="custom-control-label" for="inventarioInicial">Quieres agregar un inventario inicial a la sucursal principal?</label>
											</div>
											
											<div class="form-group col-sm-6" id="divInventarioInicial" style="display: none;">
												
												<row>
												
												<label for="message-text" class="col-form-label"> Matriz:</label>
                                                <input type="number" value="0" class="form-control" id="inventarioInicialCant">
												<small class="text-danger" id="errorinventarioInicialCant" style="display: none;"></small>
												
												</row>
												
                                                
                                            </div>
                                                                                                                                                    
                                        </div>	-->










									<div class="form-group" id="divTags">

										<h5 class="mb-4">Palabras clave</h5>
										<input value="" data-role="tagsinput" type="text" id="palabrasClave">
										<small class="text-danger" id="errorpalabrasClave" style="display: none;"></small>

									</div>







									<div class="form-group">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text">Imagen</span>
											</div>

											<div class="custom-file">
												<input type="file" class="custom-file-input" id="img">
												<label class="custom-file-label" for="customFile">Elegir imagen</label>
											</div>
										</div>
										<small class="text-danger" id="errorimg" style="display: none;"></small>

									</div>
									<!-- Comienza select de categorias
                                        <div class="form-group" id="divSelectCategoriasServicios">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label> * Categorías de Servicios</label>
                                                            <select class="form-control select2-single" id="selectCategoriaServicios">
                                                                    
                                                            </select>
                                                        </div>
                                                    </div>
                                            <small class="text-danger" id="errorcategoriaServicios" style="display: none;"></small>
                                        </div>
                                            Termina select de categorias-->

								</form>

							</div>



						</div>
					</div>
				</div>


				<div class="d-flex justify-content-between">

					<button type="button" class="btn btn-primary mr-3 mb-4" onclick=" insertaServicios()" id="guardar1">
                            + Guardar
                            
                        </button>
				


					<button type="button" class="btn btn-info mr-3 mb-4" onclick=" regresar()">
                            Regresar
                            
                        </button>
				


				</div>



			</div>

			<!--termina aqui, inicia segundo tab-->



		</div>
	</div>
	<!--termina cardBody-->
</div>