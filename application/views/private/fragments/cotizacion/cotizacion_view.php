
<input id="idTU"  type="hidden"  value="<?php echo($_SESSION['idTipoUsuario']) ?>">
<input id="Carrito"  type="hidden"  value="">
<input id="idCliente"  type="hidden"  value="">


        <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs " role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
                                aria-controls="first" aria-selected="true"><h3>Cotización</h3></a>
                        </li>
                        <li class="nav-item">
                             <a class="nav-link"       id="second-tab" data-toggle="tab" href="#second" role="tab"
                              aria-controls="second" aria-selected="false" onclick=""><h3>Historial cotizaciones</h3></a>
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

                                           
                                            <div class="row">
                                                
                                            <div class="card-body" id="despliegueTabla2">
                                                
                                            <div class="modal-body">
            </div>
												
												<h2 class="pl-3"id="tituloAccion">Productos/Servicios</h2>
                                                        
                                                        <div class="row pl-3  col-12">
                                                            <div class="col-sm-4" id="divListaServicios">
 
                                                                <select class="form-control select2-single" id="selectListaServicios">
                                                                </select> 
																

                                                                <small class="text-danger" id="errorselectListaServicios" style="display: none;"></small>

                                                            </div>

                                                            <div class="col-sm-2">
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-outline-secondary" value="2"  id="btnAgregarServicio">Agregar</button>
                                                                </div>
                                                              

                                                            </div>
                                                            <!-- <div class="input-group-append pl-4 ml-auto">
                                                                    <button class="btn btn-outline-secondary" value="1"  id="btnVentaRapida">Servicios express</button>
                                                            </div>
                                                             -->
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
                                                <h5 class="card-title">Servicios Seleccionados</h5>
                                                
                                                <small class="text-danger" id="errorserviciosSeleccionados" style="display: none;"></small></br>
                                                <small class="text-danger" id="errortotal" style="display: none;"></small>
												
												<input type="hidden" id="accion" value="Agregar">
                                                <input type="hidden" id="idAS" value="0">
                                                <input type="hidden" id="estatusAS" value="1">
                                                <input type="hidden" id="validaINV" value="0">

                                                    <table class="table table-bordered" ida="serviciosSeleccionados">
                                                        <thead>
                                                            <tr style="text-align: center">
                                                                <th scope="col">Inventario</th>
                                                                <th scope="col">#id</th>
                                                                <th scope="col">Producto</th>
                                                                <th scope="col">Descripción</th>
                                                                <th scope="col">Altura</th>
                                                                <th scope="col">Ancho</th>
                                                                <th scope="col">Stock</th>
                                                                <th scope="col">Precio base</th>
                                                                <th scope="col"><p><span class="bs-tooltip-auto" data-bs-toggle="tooltip" title="Cantidad medio mayoreo">CMM</span></p></th>
                                                                <th scope="col"><p><span class="bs-tooltip-auto" data-bs-toggle="tooltip" title="Precio medio mayoreo">PMM</span></p></th>
                                                                <th scope="col"><p><span class="bs-tooltip-auto" data-bs-toggle="tooltip" title="Cantidad mayoreo">CM</span></p></th>
                                                                <th scope="col"><p><span class="bs-tooltip-auto" data-bs-toggle="tooltip" title="Precio mayoreo">PM</span></p></th>
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
                                                        <button id="btnOrden" type="button" class="btn btn-primary mr-3 mb-4 float-right" onclick="insertaAgrupaServicios()" >
                                                            Guardar cotización
                                                            
                                                        </button>
                                                    </div>


                                                                                    

                                                    </div>
                                                    
                                                
                                            </div>
                                        </div>






                        </div>
        
                        </div>
                        <!--termina aqui, inicia segundo tab-->

                        <div class="tab-pane fade" id="second" role="tabpanel"
                                 aria-labelledby="second-tab">
                                 <div class="row">
                                <div class="col-12 col-12 mb-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                        <div class="row">
                                            
                                            <div class="form-group mb-4 col-4">
                                            
                                             
                                                <div class="form-group mt-4">
                                                    <label>Fecha cotización</label>
                                                    <input class="form-control datepicker" placeholder="Date" id="consultaCotizacion">
                                                </div>

                                            </div>
                                            
                                                    <div class="form-group pt-5 col-6">
                                                    <button type="button" class="btn btn-primary mr-3 mb-4" id="btnConsultarCorte" onclick="getCotizacionDate()" >
                                                                Consultar 
                                                            </button>
                                                            <button type="button" class="btn btn-primary mr-3 mb-4"   onclick="resetDate()">
                                                                restablecer
                                                            </button>
                                                    </div>
                                                    
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                             </div>
                            
                                <div class="row mb-4">
                                    <div class="col-12 mb-4">
                                        <div class="card">
                                            <div class="card-body" id="tablaCotizaciones">
                                              
                                            </div>

                                        </div>
                                    </div>
                                </div>

                

                            </div>
        
                        <!--termina aqui segundo tab-->
                    </div>
                </div>
                <!--termina cardBody-->
            </div>