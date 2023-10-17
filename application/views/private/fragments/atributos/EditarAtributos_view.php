   
           
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs " role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
                                aria-controls="first" aria-selected="true"><h3>Editar <?= urldecode( $nombre)?></h3></a>
                        </li>
                       
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
                                            <div class="card-body" id="despliegueTabla">
                                              
												
												
										
												
												<?php if($atributos != null): ?>
												<div class="d-flex justify-content-between">
												
												<h1>Atributos</h1>  <button type="button" class="btn btn-info mr-3 mb-4" onclick="location.href='<?= base_url()."app/Atributos/"?>'" >
												 regresar
												</button>
												
												</div>
												</br>
												
												 <button type="button" class="btn btn-primary mr-3 mb-4" onclick="agregar()" >
												+ Agregar nuevo atributo
												</button>
											
											
												<div id="despliegaTabla">

														<table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
																<thead>
																	<tr align="center">
																		<th>id</th>
																		<th>Nombre</th>
                                                                        <th align="center">Eliminar</th>
                                                                 		<th align="center">Editar</th>
																								

																	</tr>
																</thead>
																<tbody>

																<?php foreach($atributos as $o ): ?>
																	<tr align="center">
																		<td><?=$o->idDAtr ?></td>
																		<td><?=$o->nombreDAtr ?></td>
                                                                        <td align="center">
                                                                        	<a href="#" onclick="modalBorrar('<?= $o->idDAtr ?>','<?= $o->nombreDAtr ?>')">
                                                                            <i class="fas fa-trash fa-2x"></i>
                                                                            </a>
                                                                            
                                                                        </td>
                                                                        <td align="center">
                                                                        	<a href="#" onclick="modalEditar('<?= $o->idDAtr ?>','<?= $o->nombreDAtr ?>')">
                                                                            
                                                                       <i class="fas fa-pencil fa-2x"></i>     	
                                                                            </a>
                                                                        </td>
																		
																	</tr>

																<?php endforeach; ?>

																</tbody>
															</table>


													</div>

											
											
											
												
													
							
												<?php endif; ?>
												
											
											
												<?php if($categorias != null): ?>
												
													<h1>Categorias</h1>
													<table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
														<thead>
															<tr>
																<th>id</th>
																<th>nombre</th>

															</tr>
														</thead>
														<tbody>

														<?php foreach($categorias as $cat ): ?>
															<tr>
																<td><?=$cat->idCS ?></td>
																<td><?=$cat->nombreCS ?></td>
															</tr>

														<?php endforeach; ?>

														</tbody>
													</table>
							
												<?php endif; ?>
												
												
												
												
												
												
												
                                            </div>

                                        </div>
                                    </div>
                                </div>

                

                        </div>
        
                        <!--termina aqui, inicia segundo tab-->
                        
                        
                       	
                    </div>
                </div>
                <!--termina cardBody-->
            </div>
   