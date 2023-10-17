   
           
<div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs " role="tablist">
                        <li class="nav-item">
							<a class="nav-link active" id="second-tab" data-toggle="tab" href="#second" role="tab"
								aria-controls="second" aria-selected="false">Reportes de Ventas</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="tres-tab" data-toggle="tab" href="#tres" role="tab"
								aria-controls="tres" aria-selected="true">Reportes de gastos</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="cuatro-tab" data-toggle="tab" href="#cuatro" role="tab"
								aria-controls="cuatro" aria-selected="true">ventas VS gastos</a>
						</li>
                       
                    </ul>
                </div>
	<div class="card-body">
		<div class="tab-content">


			<!-- inicia el primer tab-->

			<div class="tab-pane fade show active" id="second" role="tabpanel"
				aria-labelledby="second-tab">
				
				<p class="font-weight-bold">Reportes de Ventas</p>



					<div class="row mb-4">
						<div class="col-12 mb-4">
							<div class="card">
								<div class="card-body" id="campos">
									<!-- comienza despliegue de campos-->
										<!--<h5 class="mb-1">Reporte de pagos por servicios.</h5>-->
										<div style="color: red" class="col-md-12" id="mensaje-validar"></div>
											<div class="form-row">
												
												
												
												<?php if($sucursales != null): ?>
														<div class="form-group col-md-3">
														<label for="inputState">Sucursales</label>
														<select id="selectSucursal"  class="form-control select2-single select2-hidden-accessible" tabindex="-1" aria-hidden="true">

															<option>--Selecciona--</option>
															<option value="0" selected >Todas</option>
															<option value="999" >Venta en línea</option>
															<?php foreach($sucursales as $suc ): ?>

															<option value="<?= $suc-> idSuc ?>"><?= $suc->nombreSuc ?>  </option>
															<?php endforeach; ?>

														</select>
														</div>

												<?php endif; ?>
												


													
														<div class="form-group col-md-3">
														<label for="inputState">Cajas</label>
														<select id="selectCaja"  class="form-control select2-single select2-hidden-accessible" tabindex="-1" aria-hidden="true">
															<option>--Selecciona--</option>
															<option value="0" selected >Todos</option>
															

															
															

														</select>
														</div>
												
												<?php if($tiposDePagos != null): ?>
														<div class="form-group col-md-3">
														<label for="inputState">Tipo de pago</label>
														<select id="selectTipoDePago"  class="form-control select2-single select2-hidden-accessible" tabindex="-1" aria-hidden="true">

															<option>--Selecciona--</option>
															<option value="todos" selected >Todos</option>
															<?php foreach($tiposDePagos as $tiposDePago ): ?>
															
															<?php if($tiposDePago-> idFP != "5"): ?>
															
															<option value="<?= $tiposDePago-> idFP ?>"><?= $tiposDePago->nombreFP ?>  </option>
															
															<?php endif; ?>
															<?php endforeach; ?>

														</select>
														</div>
													<?php endif; ?>
													



												


												

												<button onClick="calcularVentas()" class="btn btn-sm btn-outline-primary mb-2 float-end">Reporte</button>
												
												
												
												  <div class="form-group col-md-3 ">
													<label>Fecha</label>
													<div class="input-daterange input-group" id="datepicker">
														<input id="rFechaInicio" type="text" class="input-sm form-control" name="start"
															placeholder="Inicio" autocomplete="off"/>
														<span class="input-group-addon"></span>
														<input id="rFechaFin" type="text" class="input-sm form-control" name="end"
															placeholder="Fin" autocomplete="off" />
													</div>
												</div>
												
												
													<?php if($clientes != null): ?>
														<div class="form-group col-md-3">
														<label for="inputState">clientes</label>
														<select id="selectClientes"  class="form-control select2-single select2-hidden-accessible" tabindex="-1" aria-hidden="true">

															<option>--Selecciona--</option>
															<option value="todos" selected >Todos</option>
															<?php foreach($clientes as $cliente ): ?>

															<option value="<?= $cliente-> idU ?>"><?= $cliente->nombreU ?>  </option>
															<?php endforeach; ?>

														</select>
														</div>
													<?php endif; ?>
												
												<div class="form-group col-md-3">
													<label for="inputState">Venta con factura</label>
													<select id="selectFactura" class="form-control select2-single select2-hidden-accessible" tabindex="-1" aria-hidden="true">
														<option>--Selecciona--</option>
														<option value="0" selected>Todos</option>
														<option value="1" >Sin Factura</option>
														<option value="2"  >Ventas ya facturadas</option>
													</select>
												</div>	



												






											</div>

											<div class="form-group col-md-12 pt-3" id="totales">

											</div>
									
									</div>

									<!--Termina depsliegue de campos -->

								</div>

							</div>
						</div>
					</div><!-- termina tab -->
			
			
			
			
				  <!--termina aqui, inicia segundo tab-->
					<div class="tab-pane fade show" id="tres" role="tabpanel" aria-labelledby="tres-tab">

						<p class="font-weight-bold">Reportes de Gastos</p>
						
						
						<div class="row mb-4">
						<div class="col-12 mb-4">
							<div class="card">
								<div class="card-body" id="campos2">
									<!-- comienza despliegue de campos-->
										<!--<h5 class="mb-1">Reporte de pagos por servicios.</h5>-->
										<div style="color: red" class="col-md-12" id="mensaje-validar2"></div>
											<div class="form-row">


													<?php if($tiposDeGasto != null): ?>
														<div class="form-group col-md-3">
														<label for="inputState">Tipo de gasto</label>
														<select id="selectTipoDeGasto2"  class="form-control select2-single select2-hidden-accessible" tabindex="-1" aria-hidden="true">

															<option>--Selecciona--</option>
															<option value="0" selected >Todos</option>
															<?php foreach($tiposDeGasto as $tg ): ?>

															<option value="<?= $tg-> idTG ?>"><?= $tg->nombreTG ?>  </option>
															<?php endforeach; ?>

														</select>
														</div>
													<?php endif; ?>
												
												
												<?php if($sucursales != null): ?>
														<div class="form-group col-md-3">
														<label for="inputState">Sucursales</label>
														<select id="selectSucursal2"  class="form-control select2-single select2-hidden-accessible" tabindex="-1" aria-hidden="true">

															<option>--Selecciona--</option>
															<option value="0" selected >Todas</option>
															<!--<option value="999" >Venta en línea</option>-->
															<?php foreach($sucursales as $suc ): ?>

															<option value="<?= $suc-> idSuc ?>"><?= $suc->nombreSuc ?>  </option>
															<?php endforeach; ?>

														</select>
														</div>

												<?php endif; ?>

												



											   

												<button onClick="calcularGastos()" class="btn btn-sm btn-outline-primary mb-2 float-end">Reporte</button>
												
												 <div class="form-group col-md-3 ">
													
												</div>
												
												  <div class="form-group col-md-3 ">
													<label>Fecha</label>
													<div class="input-daterange input-group" id="datepicker">
														<input id="rFechaInicio2" type="text" class="input-sm form-control" name="start"
															placeholder="Inicio" autocomplete="off"/>
														<span class="input-group-addon"></span>
														<input id="rFechaFin2" type="text" class="input-sm form-control" name="end" placeholder="Fin" autocomplete="off" />
													</div>
												</div>



											</div>

											<div class="form-group col-md-6 pt-3" id="totales2">

											</div>




									</div>

									<!--Termina depsliegue de campos -->

								</div>

							</div>
						</div>



						


					</div>
			
			
			
			<div class="tab-pane fade show" id="cuatro" role="tabpanel" aria-labelledby="cuatro-tab">

						<p class="font-weight-bold">Entradas VS Gastos</p>
				
				<div class="row mb-4">
						<div class="col-12 mb-4">
							<div class="card">
								<div class="card-body" id="campos3">
									<!-- comienza despliegue de campos-->
										<!--<h5 class="mb-1">Reporte de pagos por servicios.</h5>-->
										<div style="color: red" class="col-md-12" id="mensaje-validar3"></div>
											<div class="form-row">
												
												<?php if($sucursales != null): ?>
														<div class="form-group col-md-3">
														<label for="inputState">Sucursales</label>
														<select id="selectSucursalVS"  class="form-control select2-single select2-hidden-accessible" tabindex="-1" aria-hidden="true">

															<option>--Selecciona--</option>
															<option value="0" selected >Todas</option>
															<?php foreach($sucursales as $suc ): ?>

															<option value="<?= $suc-> idSuc ?>"><?= $suc->nombreSuc ?>  </option>
															<?php endforeach; ?>

														</select>
														</div>

												<?php endif; ?>
												
												
												<div class="form-group col-md-3">
													<label for="inputState">Ventas con factura</label>
													<select id="selectFacturaVS" class="form-control select2-single select2-hidden-accessible" tabindex="-1" aria-hidden="true">
														<option>--Selecciona--</option>
														<option value="0" selected>Todos</option>
														<option value="1" >Sin Factura</option>
														<option value="2"  >Ventas ya facturadas</option>
													</select>
												</div>
												
												
												
												<button onClick="ventasVSgastos()" class="btn btn-sm btn-outline-primary mb-2 float-end">Reporte</button>
												
												
												
												<div class="form-group col-md-3 ">
													
												</div>
												
												  <div class="form-group col-md-3 ">
													<label>Fecha</label>
													<div class="input-daterange input-group" id="datepicker">
														<input id="rFechaInicioVS" type="text" class="input-sm form-control" name="start"
															placeholder="Inicio" autocomplete="off"/>
														<span class="input-group-addon"></span>
														<input id="rFechaFinVS" type="text" class="input-sm form-control" name="end" placeholder="Fin" autocomplete="off" />
													</div>
												</div>


													



											</div>

											<div class="form-group col-md-6 pt-3" id="totales3">

											</div>




									</div>

									<!--Termina depsliegue de campos -->

								</div>

							</div>
						</div>



						


					</div>
			
			
			
			
			</div><!--termina tab content-->
		
		
	

		</div><!--termina card body-->
	
	
		
					<div class="card-body" id="despliegueTabla">


					</div>	
		
	
	
				<div  id="exportaTabla" style="display: none" >


				</div>	
	
	
	
</div>  <!--termina card-->
              
           <!-- </div>-->
   