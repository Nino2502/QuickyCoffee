
<input id="idTU"  type="hidden"  value="<?php echo($_SESSION['idTipoUsuario']) ?>">
<input id="Carrito"  type="hidden"  value="">
<input id="idCliente"  type="hidden"  value="">


        <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs " role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
                                aria-controls="first" aria-selected="true"><h3>Historial ventas/movimientos</h3></a>
                        </li>
                      
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <!-- inicia el primer tab-->
                        <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                        
                            <div class="row">
                                    <div class="col-12 col-12 mb-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                            <div class="row">
                                                
                                                <div class="form-group mb-4 col-4">
                                                
                                                
                                                    <div class="form-group mt-4">
                                                        <label>Fecha venta/movimientos</label>
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
                       
                    </div>
                </div>
                <!--termina cardBody-->
            </div>