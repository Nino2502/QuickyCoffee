
           
<div class="card">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs " role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
                    aria-controls="first" aria-selected="true"><h3><?= $titulo ?> <strong><?= $titulo =="Editar" ? $datosServicio[0]->nombreS : " producto/servicio" ?></strong></h3></a>
            </li>
            
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            
            
            <!-- inicia el primer tab-->
            
            <div class="tab-pane fade show active" id="first" role="tabpanel"
                aria-labelledby="first-tab">

                <div class="d-flex justify-content-between">

                    <button type="button" class="btn btn-primary mr-3 mb-4" onclick=" insertaServicios()" id="guardar2" >
                        + Guardar
                        
                    </button>

                    <button type="button" class="btn btn-info mr-3 mb-4" onclick=" regresar()" >
                        Regresar
                        
                    </button>

                </div>

                
        
     


                                <div class="row mb-4">
                                    <div class="col-12 mb-4">
                                        <div class="card">
                                            <div class="card-body" id="despliegueTabla">

                                            

                                    <form id="addRecordForm"> 
                                                <input type="hidden" value="<?= $titulo == "Editar" ? "actualizar" : "duplicar" ?>" id="accion">
                                                <input type="hidden" value="<?= $titulo == "Editar" ? $datosServicio[0]->idS : "0" ?>" id="idS">
                                                <input type="hidden" value="<?=$datosServicio[0]->estatus?>" id="estatusModal">

                                                <input type="hidden" value="<?= $datosServicio[0]->anchoMaterial ?>" id="idanchoMaterial">
												<input type="hidden" value="<?= $datosServicio[0]->idUnidad ?>" id="idUnidad">
                                                <input type="hidden" value="<?= $datosServicio[0]->idPolImpre ?>" id="idPolitica">
                                                <input type="hidden" value="<?= $datosServicio[0]->PM ?>" id="idPromocionales"  />
                                                <input type="hidden" value="<?= $datosServicio[0]->idS ?>" id="idServiciooo"/>
                                                
                                                

                                         
										
										
										
										<?php if($titulo =="Editar"): ?>
										<div class="row">
											<div class="form-group col-sm-6" id="divCodigoBarras" >
												<label >Codigo / Identificador: <?= $datosServicio[0]->idS ?></label>
                                                <input type="hidden"class="form-control" id="codigoDeBarras" placeholder="<?= $datosServicio[0]->idS ?>">
                                                <small class="text-danger" id="errorcodigoDeBarras" style="display: none;"></small>
                                            </div>
											
										</div>
										
										<?php else: ?>
										
										
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
										<?php endif ?>
										
										
										
										
										
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="message-text"
                                                    class="col-form-label"> * Nombre de Servicio:</label>
                                                <input type="text" value="<?= $datosServicio[0]->nombreS?>" class="form-control" id="nombreServicios" placeholder="Escribe un nombre para el servicio">
                                                <small class="text-danger" id="errornombreServicios" style="display: none;"></small>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="message-text" class="col-form-label"> * Descripción:</label>
                                                <textarea class="form-control" rows="3" id="descripcionServicios"><?=$datosServicio[0]->desS?></textarea>
                                                <small class="text-danger" id="errordescripcionServicios" style="display: none;"></small>
                                            </div>
                                        </div>

                                        

                                        <div class="form-group">
                                            <div class="row">
                                            <div class="col-sm-6" id="divSelectCategoriasServicios">
                                                    <label> * Categorías de Servicios</label>
                                                    <select onchange="muestraAtributosSC()"  class="form-control select2-single" id="selectCategoriaServicios">
                                                        <!-- onchange="muestraAtributosSC()"-->
                                                        <option value="Selecciona">--SeleccionaU--</option>
                                                        <?php
                                                        foreach($categorias as $categoria):
                                                        ?>
                                                         <option  value="<?= $categoria->idCS?>" <?= $datosServicio[0]->idCS == $categoria->idCS ? "selected": "" ?>><?= $categoria->nombreCS?></option>

                                                        <?php endforeach ?>

                                                        



                                                            
                                                    </select>
                                                    <small class="text-danger" id="errorselectCategoriaServicios" style="display: none;"></small>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="message-text" class="col-form-label"> * Sku:</label>
                                                    <input type="text" value="<?=$datosServicio[0]->sku?>" class="form-control" id="sku">
                                                    <small class="text-danger" id="errorsku" style="display: none;"></small>
                                                </div>
                                            </div>
                                        </div>

                                        <!--<div class="form-group">
                                            <div class="row" id="selectDeAtributos" style="display: none;"> 
                                               -->

                                               <div class="form-group">
                                                    <div class="row" id="selectDeAtributos" >

                                                    </div>
                                                </div>
                                                    
                                            <!--  </div>termina select de atributos-->
                                        <!-- </div> termina grupo de atributos -->
										
										
										<!-- select de agrupaciones -->
										 <div class="form-group mt-3">
                                            <div class="row">
												
											<div class="col-sm-2" >	
												<div class="custom-control custom-checkbox mb-4">
														<input type="checkbox" onchange="cambioAgrupaServicio()" class="custom-control-input" id="servicioAgrupadoCheck" 
															   <?= $datosServicio[0]->idAS == null || $datosServicio[0]->idAS == 0 ? "": "Checked" ?> >
														<label class="custom-control-label" for="servicioAgrupadoCheck">Agrupar Servicio </label>
												</div>	
												 
											</div>
												
											
												
												
                                            <div class="col-sm-6" id="divServicioAgrupado" style="display: none;">
												
												
												
												<div class="row">
													
													<div class="col-10" id="divSelectAgrupaciones">
														 <label> * Agrupaciones</label>
                                                   		<select class="form-control select2-single" id="SelectAgrupaciones">
															
															<option value="Selecciona">--Selecciona--</option>
                                                        <?php
                                                        foreach($agrupacion as $agr):
                                                        ?>
                                                         <option  value="<?= $agr->idAgrupacionS?>" <?= $datosServicio[0]->idAS == $agr->idAgrupacionS ? "selected": "" ?>><?= $agr->nombreAgrupaS?></option>

                                                        <?php endforeach ?>
															
															
															
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
												
												
												<div class="col-sm-6" id="ImpresoNoImpreso">
														
														<small class="text-danger" id="errorImpresoNoImpreso" style="display: none;"></small>
														
														
														<h4>Selecciona si pertenece a impresos, no impresos o ambos</h4>
															 <div>
																 
																 
																 
																 
																 <div class="col-sm-4" >	
																	<div class="custom-control custom-checkbox mb-4">
																			<input type="checkbox" class="custom-control-input" <?=$datosServicio[0]->noImpreso == 1 ? "checked": ""?> id="servicioNoImpresoCheck" >
																			<label class="custom-control-label" for="servicioNoImpresoCheck">No impreso </label>
																	</div>	
																</div>
																 
																 <div class="col-sm-4" >	
																	<div class="custom-control custom-checkbox mb-4">
																			<input type="checkbox" onClick="cambioCheckImpresion()" <?=$datosServicio[0]->impresion == 1 ? "checked": ""?> class="custom-control-input" id="servicioImpresoCheck">
																			<label class="custom-control-label" for="servicioImpresoCheck">Impreso </label>
																	</div>	
																</div>
																 
																 
																 
																
																 <small class="text-danger" id="errorCheckImpre" style="display: none;"></small>

															 </div>


													
													
												<div class="col-sm-12" id="divPrecioImpresion" style="display: none;">
													<div class="row">
														<div class="col-10">
													
															
																<label for="message-text" class="col-form-label"> * Precio de impresión:</label>
																<input   type="text"  class="form-control" value="<?=$datosServicio[0]->precioImpresion?>" id="precioServiciosConImpresion">
																<small class="text-danger" id="errorprecioServiciosConImpresion" style="display: none;"></small>
															</div>
													
														<div class="col-2">

															<button type="button" class="btn btn-primary mt-4" id="btnAgregaPreSerImp">+</button>
															
														</div>
													</div>
												</div>
													
													
													
													
													
                                                    </div>
												
												
												
												
												<!--
												
												
												 <div class="col-sm-6" id="ImpresoNoImpreso">
													 
													 
													 <div>
													 
													 <div class="custom-control custom-radio">
														<input onchange="cambioCheckImpresion()" type="radio" id="customRadio1" name="customRadio" class="custom-control-input" <?=$datosServicio[0]->noImpreso == 1 ? "checked": ""?>  value="noImpreso">
														<label class="custom-control-label" for="customRadio1">No Impreso</label>
													</div>
													<div class="custom-control custom-radio">
														<input onchange="cambioCheckImpresion()" type="radio" id="customRadio2" name="customRadio" class="custom-control-input" <?=$datosServicio[0]->impresion == 1 ? "checked": ""?> value="impreso">
														<label class="custom-control-label" for="customRadio2">Impresos</label>
													</div>
													 
													 
													 
													 </div>
													 
												
														<div id="divPrecioImpresion" style="display: none;">
															<label for="message-text" class="col-form-label"> * Precio de impresión:</label>
															<input   type="text"  class="form-control" value="<?=$datosServicio[0]->precioImpresion?>" id="precioServiciosConImpresion">
															<small class="text-danger" id="errorprecioServiciosConImpresion" style="display: none;"></small>
														</div>
													 
													 
													 
													 
												</div>
												-->
											

                                                    <div class="col-sm-6">
                                                        <div class="custom-control custom-checkbox mb-4">
															<input onchange="cambioCheckPoliticas()" type="checkbox" class="custom-control-input" <?=$datosServicio[0]->idPolImpre == 0 || $datosServicio[0]->idPolImpre == 1 ? "": "checked"?> id="politicas">
															<label class="custom-control-label" for="politicas">¿Tiene politicas?</label>
                                                    	</div>

                                                        <div class="col-sm-6" id="divPoliticas" style="display: none;">
                                                            <label> * Politicas</label>
                                                            <select class="form-control select2-single" id="selectPoliticas">
                                                            
                                                            </select>
                                                        </div>
                                                        <small class="text-danger" id="errorselectPoliticas" style="display: none;"></small>
                                                    </div>
												
                                            </div> <!-- termina row-->
											
												<!-- comienza seccion precios dinamicos de impresion -->
									
												<div class="form-group">
													<div class="row">


															<div id="precioDinamicoImpresion" class=" col-sm-12">
																<!-- div para precios dinamicos -->
																<table id="tablaPreDinImpresion" class="table mt-3">

																	<tbody id="tBodyfilasPreSerImpr">
																		
																		
																		<?php $contador = 1; if($preciosDinamicosImpresion != null && count($preciosDinamicosImpresion) >=1): ?>
																		
																		
																		
																		<?php  foreach($preciosDinamicosImpresion as $fila): ?>
																		
																			<tr class="filaSelecionada" data-fila="<?= $contador ?>" id="trPreSerImpr-<?= $contador ?>`">
																				<td class="align-middle" indeti scope="row" id="idSelecionado"><?= $contador ?>
																					<input id="inputCatPreSerImp" db="categoria" data type="hidden" value="1">
																					<input id="inputIdPreSerImp" db="idS" data type="hidden" value="0">

																				</td>
																				<td>
																					<label for="message-text" class="col-form-label"> *Descripción:</label>
																					<input data entradaDatos db="desPreSer" type="text" class="form-control" value="<?= $fila->desPreSer ?>" id="descripcionServiciosConImpresion-<?= $contador ?>">
																					<small class="text-danger" id="errordescripcionServiciosConImpresion-<?= $contador ?>" style="display: none;"></small>
																				</td>
																				<td>
																					<label for="message-text" class="col-form-label"> *Cantidad:</label>
																					<input data entradaDatos db="cantidad" type="text" class="form-control" value="<?= $fila->cantidad ?>" id="cantidadServiciosConImpresion-<?= $contador ?>">
																					<small class="text-danger" id="errorcantidadServiciosConImpresion-<?= $contador ?>" style="display: none;"></small>
																				</td>
																				<td>
																					<label for="message-text" class="col-form-label"> * Precio:</label>
																					<input data entradaDatos db="precio" type="text" class="form-control" value="<?= $fila->precio ?>" id="precioServiciosConImpresion-<?= $contador ?>">
																					<small class="text-danger" id="errorprecioServiciosConImpresion-<?= $contador ?>" style="display: none;"></small>
																				</td>
																				<td><button class="btn" onclick="quitarDeLista(<?= $contador ?>)"><i class="fas fa-trash fa-2x mt-4"></i></button></td>
																			</tr>
																		
																		<?php $contador ++; ?>
																		
																		<?php endforeach; ?>
																		<?php endif;?>




																	</tbody>


																</table>

															</div>






													</div>
												</div>
									
									
									<!-- termina seccion precios dinamicos impresion -->
											
											
											
											
											
											
										
											
											
                                       
                                        </div>

                                        <div class="form-group">
											
											
											<div class="row">

                                                	
											<div class="form-group col-sm-6">
														<label for="message-text"
															class="col-form-label"> Area impresión:</label>
														<input type="text" value="<?=$datosServicio[0]->areaImpresion?>" class="form-control" id="areaImpresion" placeholder="Escribe el area de impresión">
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
                                                    <input type="number"  class="form-control" value="<?=$datosServicio[0]->inventarioMin?>" id="inventarioMinimo">
                                                    <small class="text-danger" id="errorinventarioMinimo" style="display: none;"></small>
                                                </div>
												
												<!-- -->
												
												<div class="col-sm-6" style="display: none;" id="divanchoMaterial">
												
												</div>


										</div>

                                               
                                                
                                        </div>
											
											 </br></br>
											<div class="col-sm-12" id="divPrecioProducto">

												 <div class="row">
												
												
													 
												<div class="col-6">
													<div class="row">
														<div class="col-10">
															
																<label for="message-text" class="col-form-label"> * Precio del producto/servico por menudeo:</label>
																 <input type="number" value="<?=$datosServicio[0]->precioS?>"class="form-control" id="precioServicios">
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
																			
																			
																		<?php $contador = 1; if($preciosDinamicosProductos != null && count($preciosDinamicosProductos) >=1): ?>
																		
																		
																		
																		<?php  foreach($preciosDinamicosProductos as $fila): ?>
																			
																				<tr class="filaSelecionadaPreDinPro" data-filaPreDinPro="<?= $contador ?>" id="tr-<?= $contador ?>">
																					<td class="align-middle"  indetiPreDinPro scope="row" id="idSelecionadoPreDinPro"><?= $contador ?>
																						<input id="inputCatPreSerImp" db="categoria" dataPreDinPro type="hidden" value="2">
																						<input id="inputIdPreSerImp" db="idS" dataPreDinPro type="hidden" value="0">
																					</td>
																					<td>
																						<label for="message-text" class="col-form-label"> *Descripción:</label>
																						<input dataPreDinPro entradaDatos db="desPreSer" type="text" class="form-control" value="<?= $fila->desPreSer ?>" id="descripcionPreDinPro-<?= $contador ?>">
																						<small class="text-danger" id="errordescripcionPreDinPro-<?= $contador ?>" style="display: none;"></small>
																					</td>
																					<td>
																						<label for="message-text" class="col-form-label"> * Cantidad:</label>
																						<input dataPreDinPro entradaDatos db="cantidad" type="text" class="form-control" value="<?= $fila->cantidad ?>" id="cantidadPreDinPro-<?= $contador ?>">
																						<small class="text-danger" id="errorcantidadPreDinPro-<?= $contador ?>" style="display: none;"></small>
																					</td>
																					<td>
																						<label for="message-text" class="col-form-label"> * Precio:</label>
																						<input dataPreDinPro entradaDatos db="precio" type="text" class="form-control" value="<?= $fila->precio ?>" id="precioPreDinPro-<?= $contador ?>">
																						<small class="text-danger" id="errorprecioPreDinPro-<?= $contador ?>" style="display: none;"></small>
																					</td>
																					<td><button class="btn" onclick="quitarDeListaPreDinPro(<?= $contador ?>)"><i class="fas fa-trash fa-2x mt-4"></i></button></td>
																				</tr>

																		
																		<?php $contador ++; ?>
																		
																		<?php endforeach; ?>
																		<?php endif;?>

																			
																			
																			
																			
																			
																			

																		</tbody>
																	</table>

																</div>
														</div>
													</div><!-- fin div form group -->
                                                    
                                                      <div class="row">
                                                        <div class="col-6">
                                                            <div class="custom-control custom-checkbox mb-4">
                                                                <input onchange="mostrarPreciosBases()" type="checkbox" class="custom-control-input" <?= $datosServicio[0]->preciosBases != null ? 'checked': ''?> id="preciosBasesCheck">
                                                                <label class="custom-control-label" for="preciosBasesCheck">Tiene mas precios bases</label>
                                                            </div>
                                                    
                                                            <div class="col-sm-12" id="divPreciosBases"  style="display:none;">
                                                            		<label>Selecciona precios bases</label>
                                                                    
                                                                    <select class="form-control select2-multiple" multiple="multiple" id="selectPreciosBases">

                                                                    
                                                                    </select>
                                                                    <small class="text-danger" id="errorSelectPrecios" style="display:none"></small>

                                                            </div>
                                                        </div>
                                                        
                                                        

                                                        <div class="col-6">
                                                        		<div class="custom-control custom-checkbox mb-4">
                                                                	<input type="checkbox" onchange="cambioCheckAtributos()" class="custom-control-input" <?=$datosServicio[0]->Atributos_mas != null ? 'checked': ''?> id="atributosCheck">
                                                                    <label class="custom-control-label" for="atributosCheck">Tiene mas atributos</label>
        
                                                                </div>
                                                                
                                                                <div class="col-sm-12" id="divSelectAtributos" style="display:none;">
                                                                		<label>Selecciona atributos adicionales</label>
                                                                        
                                                                        <select class="form-control select2-multiple" multiple="multiple" id="selectAtributosAdicionales">

                                                                        
                                                                        </select>
                                                                        
                                                                        <small class="text-danger" id="errorAtributoAdicional" style="display:none;"></small>
                                                                
                                                                </div>

                                                        </div>
                                                        
                                                        
                                                        
  														<div class="col-6">
                                                        		<div class="custom-control custom-checkbox mb-4">
                                                                	<input type="checkbox" onchange="mostrar_promocionales()" class="custom-control-input" <?=$datosServicio[0]->PM != null ? 'checked' : '' ?> id="promocionales_promos">
                                                                    <label class="custom-control-label" for="promocionales_promos">Productos promocionales</label>
        
                                                                </div>
                                                                
                                                                <div class="col-sm-12" id="divSelectPromocionales" style="display:none;">
                                                                		<label>Selecciona promoccionales</label>
                                                                        
                                                                        <select class="form-control select2-single select2-hidden-accessible" id="selectPromociones">

                                                                        
                                                                        </select>
                                                                        
                                                                        <small class="text-danger" id="errorAtributoAdicional" style="display:none;"></small>
                                                                
                                                                </div>

                                                        </div>
                                                    </div>
       
												
												
												</div>
	 
													 
													 
													 
												
											</div> <!-- termian row de los precios por producto dinamicos-->
										</div>
											
												
											<!--	
											
                                            <div class="row">
												
												
												<div class="col-sm-6">
                                                    <label for="message-text" class="col-form-label"> Cantidad Medio Mayoreo:</label>
                                                    <input type="number" value="<?=$datosServicio[0]->cantidadMedioMayoreo?>" class="form-control" id="cantidadMedioMayoreo">
                                                    <small class="text-danger" id="errorcantidadMedioMayoreo" style="display: none;"></small>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="message-text" class="col-form-label"> Precio Medio Mayoreo:</label>
                                                    <input type="number" value="<?=$datosServicio[0]->precioMedioMayoreo?>" class="form-control" id="precioMedioMayoreo">
                                                    <small class="text-danger" id="errorprecioMedioMayoreo" style="display: none;"></small>
                                                </div>
												
												
                                                <div class="col-sm-6">
                                                    <label for="message-text" class="col-form-label"> Cantidad mayoreo:</label>
                                                    <input type="number"  class="form-control" value="<?=$datosServicio[0]->cantidadMayoreo?>" id="cantidadMayoreo">
                                                    <small class="text-danger" id="errorcantidadMayoreo" style="display: none;"></small>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="message-text" class="col-form-label"> Precio Mayoreo:</label>
                                                    <input type="number"  class="form-control" value="<?=$datosServicio[0]->precioMayoreo?>" id="precioMayoreo">
                                                    <small class="text-danger" id="errorprecioMayoreo" style="display: none;"></small>
                                                </div>

                                                
                                            </div>-->
                                        </div>

                                        <div class="form-group" id="divTags">

                                            <h5 class="mb-4">Palabras clave</h5>                                                       
                                            <input data-role="tagsinput" type="text" <?=$datosServicio[0]->tags != "" ? 'value="'.$datosServicio[0]->tags.'"': ""?> id="palabrasClave">
                                            <small class="text-danger" id="errorpalabrasClave" style="display: none;"></small>
                                                                                                                                                    
                                        </div>


                    


									

                                        <div class="form-group">
                                            <div class="input-group mb-3">
												
												
											<?php if($titulo == "Editar"):?>	
                                            <div>
                                                <img src="<?=base_url()."/static/imgServicios/" . $datosServicio[0]->image_url ?>" height="40" />
                                                
                                            </div>
											<?php endif ?>
												
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

                        <button type="button" class="btn btn-info mr-3 mb-4" onclick=" regresar()" >
                            Regresar
                            
                        </button>

                    </div>

    

            </div>

            <!--termina aqui, inicia segundo tab-->
            
            
            
        </div>
    </div>
    <!--termina cardBody-->
</div>







