



<!------------------------------------------------------

-->



<div class="card mb-4 p-5">
	
	
	
	
	<?php if(isset($_ERROR)): ?>
	
	
	
        <div class="container-fluid">
			
			
         

            <div class="row">
                <div class="col-12">
                    <div class="card mb-5">
						<p>Esta compra tiene un error, reportala con el administrador.</p>
                        <div class="card-body d-flex justify-content-between">
							
							<div>
								
								<a class="btn btn-primary"  href="<?= base_url()?>web">Regresar</a>
								
								
								
							
							
							</div>
							
							
							

	
								
                        </div>
                    </div>
                </div>
            </div>
			
	</div>	
	
	
	
	
	
	
	
	
	
	<?php else: ?>

	
	
        <div class="container-fluid">
			
			
         

            <div class="row">
                <div class="col-12">
                    <div class="card mb-5">
						<p>Para llevar a cabo el proceso de fatcuración cuentas con 30 días naturales despues de realizada tu compra.</p>
                        <div class="card-body d-flex justify-content-between">
							
							<div>
								
								<a class="btn btn-primary"  href="<?= base_url()?>web">Regresar</a>
								<a class="btn btn-primary" href="<?= base_url()?>public/DetalleVenta/detalle/<?= $this->session->userdata('idusuario')?>/<?= $detalleVenta[0]->idVenta ?>/<?= $detalleVenta[0]->tokenVEnta ?>/" target="_blank">Imprimir detalle venta</a>
								<a class="btn btn-primary" href="<?= base_url()?>public/DetalleVenta/satRepresentacion/<?= $this->session->userdata('idusuario')?>/<?= $detalleVenta[0]->idVenta ?>/<?= $detalleVenta[0]->tokenVEnta ?>" target="_blank">Descargar representación sat</a>
								<a class="btn btn-primary" href="<?= base_url()?>public/DetalleVenta/xml/<?= $this->session->userdata('idusuario')?>/<?= $detalleVenta[0]->idVenta ?>/<?= $detalleVenta[0]->tokenVEnta ?>" target="_blank">Descargar XML</a>
							
								
								
								
								
								<input id="idU" type="hidden" value="<?= $this->session->userdata('idusuario')?>">
								<input id="idVen" type="hidden" value="<?= $detalleVenta[0]->idVenta ?>">
								
								
							
							
							</div>
							
						

	
								
                        </div>
                    </div>
                </div>
            </div>
			
			
 
            <div class="row invoice">
                <div class="col-12">
                    <div class="invoice-contents" leftmargin="0" marginwidth="0" topmargin="0" marginheight="0"
                        offset="0" style="background-color:#ffffff; height:1200px; max-width:830px; font-family: Helvetica,Arial,sans-serif !important; position: relative;">
						
						<table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0"
                            style="width:100%; background-color:#ffffff;border-collapse:separate !important; border-spacing:0;color:#242128; margin:0;padding:30px;"
                            heigth="auto">

                            <tbody>
                                <tr>
                                    <td align="left" valign="center" style="padding-bottom:35px; padding-top:15px; border-top:0;width:100% !important;">
                                        <img src="<?=base_url()?>static/plantilla/img/logo-black.svg" width="200px" />
                                    </td>
                                    <td align="right" valign="center"
                                        style="padding-bottom:35px; padding-top:15px; border-top:0;width:100% !important;">
                                        <p
                                            style="color: #8f8f8f; font-weight: normal; line-height: 1.2; font-size: 12px; white-space: nowrap; ">
                                            Juan de la barrera #18 esq. Pino Suárez </br>
											Col. Niños Heroes 76010,</br>
											Querétaro, Querétaro, México<br> 
                                            442 720 9528
                                        </p>
                                    </td>
                                </tr>
							</tbody>
						</table>
						
						
						 <table style="width: 100%;">
							<tbody>
								<tr>
									<td style="vertical-align:middle; border-radius: 3px; padding:30px; background-color: #f9f9f9; border-right: 5px solid white;">
										
												
											<strong>Fecha:</strong> <?= $datosVentaFactura->Fecha . " " ?>  <strong>Serie:</strong> <?= $datosVentaFactura->Serie . " " ?> <br>
											<strong>Factura:</strong>  <?= $datosVentaFactura->Factura . " " ?> <br>
											<strong>Forma de pago:</strong> <?= $datosVentaFactura->FormaPago . " " ?> <strong> Domicilio:</strong> <?= $datosVentaFactura->DomicilioFiscalReceptor . " " ?> <br>
											<strong>Razon social:</strong> <?= $datosVentaFactura->razonSocial . " " ?> <br>
											<strong>RFC:</strong> <?= $datosVentaFactura->rfcReceptor . " " ?> <br>
											<strong>Regimen:</strong> <?= $datosVentaFactura->RegimenFiscalReceptor . " " ?><strong> Uso CFDI:</strong>  <?= $datosVentaFactura->UsoCFDI . " " ?> <br>
											
											
										
									</td>

									<td
										style="text-align: right; padding-top:0px; padding-bottom:0; vertical-align:middle; padding:30px; background-color: #f9f9f9; border-radius: 3px; border-left: 5px solid white;">
										<p
											style="color:#8f8f8f; font-size: 14px; padding: 0; line-height: 1.6; margin:0; ">
											Id Venta: <?= $detalleVenta[0]->idVenta ?>  </br>
											Token venta: <?= $detalleVenta[0]->tokenVEnta ?>  </br>
											
											Fecha venta:<?= $detalleVenta[0]->FechaVentaG ?>  </br>

											
										</p>
									</td>
								</tr>
							</tbody>
						</table>
                        <table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0"
                            style="width:100%; background-color:#ffffff;border-collapse:separate !important; border-spacing:0;color:#242128; margin:0;padding:30px;"
                            heigth="auto">

                            <tbody>
                                        <table style="width: 100%; margin-top:40px;">
                                            <thead>
                                                <tr>
                                                    <th
                                                        style="text-align:left; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                                        venta
                                                    </th>
                                                    <th
                                                        style="text-align:left; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                                        Fecha
                                                    </th>
                                                    <th
                                                        style="text-align:right; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                                        Servicio
                                                    </th>
													<th
                                                        style="text-align:left; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                                        Cantidad
                                                    </th>
                                                    <th
                                                        style="text-align:right; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                                        Precio Unitario
                                                    </th>
													<th
                                                        style="text-align:right; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                                        Subtotal
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
												<?php foreach($detalleVenta as $fila): ?>
												
                                                <tr>
                                                    <td style="padding-top:0px; padding-bottom:5px;">
                                                        <h4
                                                            style="font-size: 16px; line-height: 1; margin-bottom:0; color:#303030; font-weight:500; margin-top: 10px;">
                                                            <?= $fila->idVenta ?>
                                                            </h4>
                                                    </td>
                                                    <td>
                                                        <p href="#"
                                                            style="font-size: 13px; text-decoration: none; line-height: 1; color:#909090; margin-top:0px; margin-bottom:0;">
                                                            <?= $fila->FechaVentaG ?></p>
                                                    </td>
                                                    <td style="padding-top:0px; padding-bottom:0; text-align: right;">
                                                        <p
                                                            style="font-size: 13px; line-height: 1; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap;">
                                                            <?= $fila->nombreS ?></p>
                                                    </td>
													<td style="padding-top:0px; padding-bottom:0; text-align: right;">
                                                        <p
                                                            style="font-size: 13px; line-height: 1; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap;">
                                                            <?= $fila->cantidad ?></p>
                                                    </td>
													<td style="padding-top:0px; padding-bottom:0; text-align: right;">
                                                        <p
                                                            style="font-size: 13px; line-height: 1; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap;">
                                                            $<?= $fila->precioUnitario ?></p>
                                                    </td>
													<td style="padding-top:0px; padding-bottom:0; text-align: right;">
                                                        <p
                                                            style="font-size: 13px; line-height: 1; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap;">
                                                            $<?= $fila->Subtotal ?></p>
                                                    </td>
													
													
                                                </tr>
												<?php endforeach; ?>
												
											</tbody>
                        </table>
						
								
								<table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0"
                            style="position:absolute; bottom:0; width:100%; background-color:#ffffff;border-collapse:separate !important; border-spacing:0;color:#242128; margin:0;padding:30px; padding-top: 20px;"
                            heigth="auto">
                            <tr>
								<td rowspan="4" style="width: 750px;">
									Detalle venta<br>
									<img src="https://chart.googleapis.com/chart?chs=150x150&amp;cht=qr&amp;chl=<?= base_url()?>public/DetalleVenta/detalle/<?= $detalleVenta[0]->idCliente?>/<?= $detalleVenta[0]->idVenta ?>/<?= $detalleVenta[0]->tokenVEnta ?>/&amp;choe=UTF-8" />
								</td>

							</tr>
							<tr>
                                <td colspan="2" style="width: 100%">
                                    <p href="#"
                                        style="font-size: 13px; text-decoration: none; line-height: 1.6; color:#909090; margin-top:0px; margin-bottom:0; text-align: right;">
                                        sub Total : </p>
                                </td>
                                <td style="padding-top:0px; text-align: right;">
                                    <p
                                        style="font-size: 13px; line-height: 1.6; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap; margin-left:15px">$
										<?php echo (round((floatval($detalleVenta[0]->TotalVenta) / 1.16), 2)); ?></p>
                                </td>
                            </tr>		
                            <tr>
                                <td colspan="2" style="width: 100%">
                                    <p href="#"
                                        style="font-size: 13px; text-decoration: none; line-height: 1.6; color:#909090; margin-top:0px; margin-bottom:0; text-align: right;">
                                        IVA : </p>
                                </td>
                                <td style="padding-top:0px; text-align: right;">
                                    <p
                                        style="font-size: 13px; line-height: 1.6; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap; margin-left:15px">$
										<?php echo (round(((floatval($detalleVenta[0]->TotalVenta) / 1.16)*.16),2)); ?></p>
                                </td>
                            </tr>
                           
                            <tr>
                                <td colspan="2" style=" width: 100%; padding-bottom:15px;">
                                    <p href="#"
                                        style="font-size: 13px; text-decoration: none; line-height: 1.6; color:#909090; margin-top:0px; margin-bottom:0; text-align: right;">
                                        <strong>Total : </strong></p>
                                </td>
                                <td style="padding-top:0px; text-align: right; padding-bottom:15px;">
                                    <p
                                        style="font-size: 13px; line-height: 1.6; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap; margin-left:15px">
                                        <strong>$ <?=(round(($detalleVenta[0]->TotalVenta), 2)) ?> </strong></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="border-top:1px solid #f1f0f0">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align:center;">
                                   
                                </td>
                            </tr>
                        </table>
								
								
								
								
                    </div>
                </div>
            </div>
						
						
        </div>


<div style="width: 600px;">
	<strong>Sello sat:</strong> <br><?= $datosVentaFactura->Sello . " " ?> 

</div>

	
</div>

<?php endif; ?>
	





	
