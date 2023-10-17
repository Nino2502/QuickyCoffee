   
           
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs " role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
                                aria-controls="first" aria-selected="true" onclick="listaCompras()"><h3>Listado de gastos capturados</h3></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  id="second-tab" data-toggle="tab" href="#second" role="tab"
                                aria-controls="first" aria-selected="true" onClick="agregar()"><h3>Generar Gasto</h3></a>
                        </li>

                        
                       
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        
                        
                        <!-- inicia el primer tab-->
                        
                        <div class="tab-pane fade show active " id="first" role="tabpanel"
                            aria-labelledby="first-tab">
                                <div class="row mb-4">
                                    <div class="col-12 mb-4">
                                        <div class="card">
                                            <div class="card-body" id="despliegueTabla">
                                              
                                            </div>

                                        </div>
                                    </div>
                                </div>
                        </div>


                        <div class="tab-pane fade show" id="second" role="tabpanel"
                            aria-labelledby="first-tab">
                                <div class="row mb-4">
                                    <div class="col-12 mb-4">
                                        <div class="card">
                                            <div class="card-body" id="despliegueTabla2">
												
												<h2 id="tituloAccion">Capturar Gasto</h2>
												<h3 id="tituloAccion">Sucursal: <strong><?= $sucursal[0]->nombreSuc ?></strong> </h3>
                                                        
                                                        <div class="row">
															
															
															
															<div class="col-sm-6  mt-3" id="divFechaDeCompra">
																<label>*Fecha del gasto</label>
																<input  class="form-control datepicker" autocomplete="off" name="jQueryLabelsInInputDate" required="" id="fechaCompra">
																<small class="text-danger" id="errorfechaCompra" style="display: none;"></small>
																
																<input type="hidden" value="<?= date("Y-n-j") ?>"  id="fechaActual">
																<!--<span>Fecha de la compra</span>-->
															</div>
												

                                                            <div class="col-sm-6 mt-3" id="divListaTiposDeGastos">
                                                                <label>*Tipo de Gasto</label>
                                                                <select class="form-control select2-single" id="selectTiposDeGastos">
                                                                   
                                                                        
                                                                 
                                                                </select>
                                                                <small class="text-danger" id="errorselectTiposDeGastos" style="display: none;"></small>

                                                            </div>
															
															 <div class="form-group col-sm-6 mt-3">
                                                                <label for="inputEmail4">*Folio/Factura</label>
                                                                <input type="email" class="form-control" id="folioFactura" placeholder="Folio / Factura">
                                                                <small class="text-danger" id="errorfolioFactura" style="display: none;"></small>
                                                            </div>

                                                            

                                                            <div class="col-sm-6 mt-3">
                                                                <label for="inputEmail4">Descripción General</label>
                                                                <textarea class="form-control" rows="2" id="descripcion"></textarea>
                                                                <small class="text-danger" id="errordescripcion" style="display: none;"></small>
                                                                
                                                            </div>


                                                            <!--
															<div class="col-sm-4 mt-3" id="divListaServicios">
                                                                <label>Servicios</label>
                                                                <select class="form-control select2-single" id="selectListaServicios">
                                                                    
                                                                </select> 
																

                                                                <small class="text-danger" id="errorselectListaServicios" style="display: none;"></small>

                                                            </div>-->

                                                            <div class="col-sm-2 mt-4">
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-outline-secondary"  id="btnAgregarFila">Agregar fila</button>
                                                                </div>

                                                            </div>
                                                            
                                                        </div>
                                             </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-12 mb-4">
                                        <div class="card">
                                            <div class="card-body" id="despliegueTabla3">
                                            <button id="btnAgregar" type="button" class="btn btn-primary mr-3 mb-4 float-right" onclick="insertaGastoVariado()" >
                                                + Guardar
                                                                                            
                                                </button>
                                                <h5 class="card-title">Listado </h5>
                                                <small class="text-danger" id="errorfilasDelGasto" style="display: none;"></small></br>
                                                <small class="text-danger" id="errortotal" style="display: none;"></small>
												
												<input type="hidden" id="accion" value="Agregar">
                                                <input type="hidden" id="idAC" value="0">
                                                <input type="hidden" id="estatusAC" value="1">
												<input type="hidden" id="sucursal" value="<?= $sucursal[0]->idSuc ?>">
												<input type="hidden" id="idTipoDeGasto" >
											<input type="hidden" id="idUsuario" value="<?= $this->session->userdata('idusuario') ?>">
											
											
											

                                                    <table class="table table-bordered" id"filasDelGasto">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#id</th>
                                                                <th scope="col">Servicio</th>
                                                               
                                                                <th scope="col" >Costo</th>
                                                                <th scope="col">Cantidad</th>
                                                                <th scope="col">Subtotal</th>
                                                                <th scope="col">Quitar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="bodySeleccionados">             
                                                        </tbody>
                                                    </table>

                                                    <div>

                                                    <p><h5 class="card-title text-right">Total</h5></p>
                                                    <p><h5 class="card-title text-right"><strong>$<span id="totalSuma">0</span></strong></br></p>

                                                    </div>
                                                    

                                                    <div>
                                                        <button id="btnAgregar" type="button" class="btn btn-primary mr-3 mb-4 float-right" onclick="insertaGastoVariado()" >
                                                            + Guardar
                                                            
                                                        </button>
                                                    </div>


                                                                                    

                                                    </div>
                                                    
                                                
                                            </div>
                                        </div>






                        </div>
        
                        <!--termina aqui, inicia segundo tab-->

                        
        
                        <!--termina aqui, inicia segundo tab-->
 
                        
                       	
                    </div>
                </div>
                <!--termina cardBody-->
            </div>
   