<div class="container margin_30">
	
	
	<?php 
	
	
	
		/*
		echo $id;
		echo $fecha;
		echo $monto;
		echo $token;
		echo $razonSocial;
		echo $rfc;
		echo $correo;
		*/
	
	
	?>
	
	
	
		
	<!-- /page_header -->
			<div class="row justify-content-center">
			
			<div class="col-xl-6 col-lg-6 col-md-8">
				<div class="box_account">
					<h3 class="new_client">Facturación</h3> <small class="float-right pt-2">* Campos Requeridos</small>
					<div class="form_container">
						
						
						
					
						<div class="private box">
							<div class="row no-gutters">
								<div class="col-4 pr-1">
									<div class="form-group">
										<label for="message-text" class="col-form-label">Id venta</label>
										<input entradaDatos type="text" value="<?= isset($id) ? $id : '' ?>" class="form-control" id="idVenta" placeholder="Id Venta*">
										<small errorCampo class="text-danger" id="erroridVenta" style="display: none;"></small>
									</div>
								</div>
								<div class="col-4 pl-1">
									<div class="form-group">
										<label for="message-text" class="col-form-label">Fecha de compra</label>
										<input entradaDatos type="text" value="<?= isset($fecha) ? $fecha : '' ?>" alt="Sigue el siguiente formato 2023-04-01(año-mes-día)" class="form-control" id="fecha" placeholder="2023/04/01 Fecha*">
										<small errorCampo class="text-danger" id="errorfecha" style="display: none;"></small>
									</div>
								</div>
								<div class="col-4 pl-1">
									<div class="form-group">
										<label for="message-text" class="col-form-label">Monto total</label>
										<input entradaDatos type="text" value="<?= isset($monto) ? $monto : '' ?>" class="form-control" id="monto" placeholder="Monto*">
										<small errorCampo class="text-danger" id="errormonto" style="display: none;"></small>
									</div>
								</div>
								<div class="form-group">
									<label for="message-text" class="col-form-label">Token</label>
									<input entradaDatos type="text" value="<?= isset($token) ? $token : '' ?>" autocomplete="off" class="form-control" id="token" name="token" id="token" placeholder="Token*">
									<small errorCampo class="text-danger" id="errortoken" style="display: none;"></small>
								</div>
								
								<div class="text-center"><input type="submit" value="Validar Compra" onClick="validaFactura()" class="btn_1 full-width"></div>
								
								<h3 class="new_client">Datos Fiscales</h3><small class="float-right pt-2">Antes de llenar tus datos fiscales, valida tu compra. * Campos Requeridos</small>
								
								
								<div class="form-group">
									<label for="message-text" class="col-form-label">Razón social</label>
									<input value="<?= isset($razonSocial) ? urldecode($razonSocial != "" ? $razonSocial : '') : '' ?>" entradaDatos type="text" autocomplete="off" class="form-control" id="razonSocial" name="razonSocial" id="razonSocial" placeholder="Razón Social*">
									<small errorCampo class="text-danger" id="errorrazonSocial" style="display: none;"></small>
								</div>
								<div class="form-group">
									<label for="message-text" class="col-form-label">RFC</label>
									<input value="<?= isset($rfc) ? ($rfc != "" ? $rfc : '') : '' ?>" entradaDatos autocomplete="off" type="text" class="form-control" name="rfc" id="rfc" placeholder="RFC*">
									<small errorCampo class="text-danger" id="errorrfc" style="display: none;"></small>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label for="message-text" class="col-form-label">Correo</label>
										<input value="<?= isset($correo) ? ($correo != "" ? $correo : '') : '' ?>" entradaDatos type="text" autocomplete="off" class="form-control" id="correo" placeholder="Correo*">
										<small errorCampo class="text-danger" id="errorcorreo" style="display: none;"></small>
									</div>
								</div>
								
								<div class="col-12">
									<div class="form-group">
										<label for="message-text" class="col-form-label">Código Postal</label>
										<input value="<?= isset($codigoPostal) ? ($codigoPostal != "" ? $codigoPostal : '' ) : '' ?>" entradaDatos type="text" autocomplete="off" class="form-control" id="codigoPostal" placeholder="Codigo Postal*">
										<small errorCampo class="text-danger" id="errorcodigoPostal" style="display: none;"></small>
									</div>
								</div>
								
								
								
								   <!-- Regimen -->
									<div class="form-group" id="divRegimen">
										<label for="message-text" class="col-form-label">Regimen</label>
										<select entradaDatos class="form-control select2-single" id="regimenF"></select>
										<small errorCampo class="text-danger" id="errorRegimenF" style="display: none;"></small>
									</div>
								
								
								<!-- DeRegimen -->
									<div class="form-group" id="divusoCFDI">
										<label for="message-text" class="col-form-label">Usos del CFDI</label>
										<select entradaDatos class="form-control select2-single" id="usoCFDI"></select>
										<small errorCampo class="text-danger" id="errorusoCFDI" style="display: none;"></small>
									</div>

									<!-- DeRegimen 
									<div class="form-group" id="divDRF">
										<label for="message-text" class="col-form-label">Detalle de Regimen</label>
										<select entradaDatos class="form-control select2-single" id="DRF"></select>
										<small errorCampo class="text-danger" id="errorDRF" style="display: none;"></small>
									</div>-->
								
								
								
								
								
							</div>
							<!-- /row -->
							
							
						</div>
						<!-- /private -->
						
						<div id="botonFacturar"></div>
						
						
					</div>
					<!-- /form_container -->
				</div>
				<!-- /box_account -->
			</div>
		</div>
		<!-- /row -->
		</div>