   
           
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs " role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
                                aria-controls="first" aria-selected="true" onclick="listaAgrupaServicios()"><h3>Agrupaciones</h3></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  id="second-tab" data-toggle="tab" href="#second" role="tab"
                                aria-controls="first" aria-selected="true" onClick="agregar()"><h3>Crear/Editar</h3></a>
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
												
												<h2 id="tituloAccion">Crear Agrupación</h2>
                                                        
                                                        <div class="row">

                                                            <div class="form-group col-sm-6">
                                                                <label>Vigéncia</label>
                                                                    <div class="input-daterange input-group" id="datepicker">
                                                                        <input type="text" class="input-sm form-control" name="start" placeholder="Inicio" id="fechaInicio"/>
                                                                        <span class="input-group-addon"></span>
                                                                        <input type="text" class="input-sm form-control" name="end" placeholder="Fin" id="fechaFin" />
                                                                    </div>
                                                                    <small class="text-danger" id="errorfechaInicio" style="display: none;"></small>
                                                            </div>


                                                            <div class="col-sm-6" id="divListaTiposContratacion">
                                                                <label>Tipos de contratación</label>
                                                                <select class="form-control select2-single" id="selectTiposContratacion">
                                                                   
                                                                        
                                                                 
                                                                </select>
                                                                <small class="text-danger" id="errorselectTiposContratacion" style="display: none;"></small>

                                                            </div>

                                                            <div class="form-group col-sm-6">
                                                                <label for="inputEmail4">Nombre</label>
                                                                <input type="email" class="form-control" id="nombreAgrupacion" placeholder="Nombre de la agrupación">
                                                                <small class="text-danger" id="errornombreAgrupacion" style="display: none;"></small>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <label for="inputEmail4">Descripción</label>
                                                                <textarea class="form-control" rows="4" id="descripcion"></textarea>
                                                                <small class="text-danger" id="errordescripcion" style="display: none;"></small>
                                                                
                                                            </div>


                                                            <div class="col-sm-4" id="divListaServicios">
                                                                <label>Servicios</label>
                                                                <select class="form-control select2-single" id="selectListaServicios">
                                                                    
                                                                </select> 
																

                                                                <small class="text-danger" id="errorselectListaServicios" style="display: none;"></small>

                                                            </div>

                                                            <div class="col-sm-2">
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-outline-secondary"  id="btnAgregarServicio">Agregar</button>
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
                                            <button id="btnAgregar" type="button" class="btn btn-primary mr-3 mb-4 float-right" onclick="insertaAgrupaServicios()" >
                                                + Guardar
                                                                                            
                                                </button>
                                                <h5 class="card-title">Servicios Seleccionados</h5>
                                                <small class="text-danger" id="errorserviciosSeleccionados" style="display: none;"></small></br>
                                                <small class="text-danger" id="errortotal" style="display: none;"></small>
												
												<input type="hidden" id="accion" value="Agregar">
                                                <input type="hidden" id="idAS" value="0">
                                                <input type="hidden" id="estatusAS" value="1">

                                                    <table class="table table-bordered" id"serviciosSeleccionados">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#id</th>
                                                                <th scope="col">Servicio</th>
                                                                <th scope="col">Descripción</th>
                                                                <th scope="col">Precio</th>
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
                                                        <button id="btnAgregar" type="button" class="btn btn-primary mr-3 mb-4 float-right" onclick="insertaAgrupaServicios()" >
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
   