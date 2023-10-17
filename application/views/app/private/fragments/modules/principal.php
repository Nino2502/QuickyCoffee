

<div class="row mb-4">
	<div class="col-12 mb-4">
		<div class="card">
			<div class="card-body">
					 
					
							
				  <div class="form-group">
						<div class="row">
						<div class="col-sm-3" id="divSelectCategoriasServicios">
							<label>  Sucursal</label>
							<select  class="form-control select2-single"  id="idSucG">
								<!-- onchange="muestraAtributosSC()"-->
								<option value="Selecciona">--Selecciona--</option>
								<option value="999">Ventas en Línea</option>
								
							
												<?php if($sucursales != null): ?>
								
													<?php foreach($sucursales as $suc ): ?>

													<option value="<?= $suc->idSuc ?>" <?= ($idSuc == $suc->idSuc ? "selected": "") ?> ><?= $suc->nombreSuc ?>  </option>
													<?php endforeach; ?>
							
												<?php endif; ?>
								

							</select>
							<small class="text-danger" id="erroridSucG" style="display: none;"></small>
						</div>
						<div class="col-sm-3" id="divSelectCategoriasServicios">
							<label>  Año</label>
							<select   class="form-control select2-single" id="idAnioG">
								<!-- onchange="muestraAtributosSC()"-->
								<option value="Selecciona">--Selecciona--</option>
								
								<?php 
								
								$hoy = date("Y");
								$anioInicio = 2021;
								 for($i=$anioInicio; $i<=$hoy; $i++ ){
									 
									echo '<option value="'.$i.'" '. ($hoy == $i ? "selected": "") .'>'.$i.'</option>';  
								 }
								?>
							</select>
							<small class="text-danger" id="erroridAnioG" style="display: none;"></small>
						</div>
							
							
						<div class="col-sm-3" id="divSelectCategoriasServicios">
							<p>
							  <label>  Mes</label>
							  <select   class="form-control select2-single"  id="idMesG">
							    <!-- onchange="muestraAtributosSC()"-->
							   
							    
							    <?php 
								
									$mes = date("m");

									$meses = array();
									   $meses[0] = "--Selecciona--";
									   $meses[1] = "Enero";
									   $meses[2] = "Febrero";
									   $meses[3] = "Marzo";
									   $meses[4] = "Abril";
									   $meses[5] = "Mayo";
									   $meses[6] = "Junio";
									   $meses[7] = "Julio";
									   $meses[8] = "Agosto";
									   $meses[9] = "Septiembre";
									   $meses[10] = "Octubre";
									   $meses[11] = "Noviembre";
									   $meses[12] = "Diciembre";


									for($i=0; $i<=12; $i++){
									  if (date("m") == $i){
										 echo "<option value=\"$i\" selected>$meses[$i]</option>";
									  }
									  else {
										 echo "<option value=\"$i\">$meses[$i]</option>";
									  }
									}
								
								?>
							    
							    
						      </select>
							  <small class="text-danger" id="erroridMesG" style="display: none;"></small></p>
							<p>&nbsp;</p>
						</div>
							
							
						<div class="col-sm-3" id="botonBuscar">
							
						  <button type="button" class="btn btn-primary mr-3 mb-4" onclick="botonGraficaMajor()">
                                + Consultar
                                
                          </button>
							
						</div>	
							
							

					</div>
					</div>
							
							
							
			<div class="row">
                <div class="col-12">
                  

                    <div class="card mb-4">
                        <div class="card-body">
                            <!--<h5 class="mb-4">Gráfico Top 5 <span id="nombreSucGrafica"></span> </h5>-->
                            <div class="row">
                                <div class="col-lg-12 mb-5">
                                    <!--<h6 class="mb-4">Productos más vendidos en <span id="nombreMesGrafica"></span> <span id="nombreAnioGrafica"></span></h6>-->
                                    <div class="chart-container chart">
                                        
										<figure class="highcharts-figure">
											<div id="container"></div>
											<!--<p class="highcharts-description">
												Chart showing browser market shares. Clicking on individual columns
												brings up more detailed data. This chart makes use of the drilldown
												feature in Highcharts to easily switch between datasets.
											</p>-->
										</figure>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>



                

            

                </div>
            </div>
							
							
							
	
						</div>
						<div id="contenido">
						
						
						
						</div>

                    </div>
                </div>
            </div>


        </div>
    </main>