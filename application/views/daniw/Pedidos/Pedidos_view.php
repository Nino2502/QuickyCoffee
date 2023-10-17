   
           
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs " role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
                                aria-controls="first" aria-selected="true">
                                <h3>Pedidos en línea</h3>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab"
                                aria-controls="second" aria-selected="false" onclick="listaHistorial()">
                                <h3>Pedidos entregados</h3>
                            </a>
                        </li>
                       
                    </ul> 
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        
                        
                        <!-- inicia el primer tab-->
                        
                        <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                            
                            <div class="row mb-4">
                                <div class="col-12 mb-4">
                                    <div class="card">
                                        <div class="card-body" id="despliegueTabla"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
        
                        <!--termina aqui, inicia segundo tab-->

                        <div class="tab-pane fade show active" id="second" role="tabpanel" aria-labelledby="second-tab">

                            <div class="row mb-4">
                                <div class="col-12 mb-4" id="despliegueTabla2">
                                    
                                </div>
                            </div>

                        </div>
                        
                        
                       	
                    </div>
                </div>
                <!--termina cardBody-->
            </div>
   