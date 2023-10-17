<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Detalle Venta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body style="margin:0; padding:0;">
    <!--Mailing Start-->
     

<?php if($comprueba):?>


<!--Mailing Start-->
    <div leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="background-color:#ffffff; height:28cm; max-width:21.5cm; font-family: Helvetica,Arial,sans-serif !important; margin-bottom: 40px; position: relative;">
        <table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" style="width:100%; background-color:#ffffff;border-collapse:separate !important; border-spacing:0;color:#242128; margin:0;padding:30px; padding-top: 20px;"
            heigth="auto">

            <tbody>
                <tr>
                    <td align="left" valign="center" style="padding-bottom:20px;border-top:0;width:100% !important;"> 
						 <img src="<?=base_url()?>static/plantilla/img/logo-black.svg" width="200px" />
                    </td>
                    <td align="right" valign="center" style="padding-bottom:20px;border-top:0;width:100% !important;">
                        <p style="color: #8f8f8f; font-weight: normal; line-height: 1.2; font-size: 12px; white-space: nowrap; ">
                          
							Juan de la barrera #18 esq. Pino Suárez <br>
							Col. Niños Heroes 76010,<br>
							Querétaro, Querétaro, México<br> 
							442 720 9528
                                      
                        </p>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" style="padding-top:30px; border-top:1px solid #f1f0f0">
                        <table style="width: 100%;">
                            <tbody>
                                <tr>
                                    <td style="vertical-align:middle; border-radius: 3px; padding:30px; background-color: #f9f9f9; border-right: 5px solid white;">
                                        <p style="color:#8f8f8f; font-size: 14px; padding: 0; line-height: 1.6; margin:0; ">
											
										<?php if(isset($datosVentaFactura)):?>	
											
											<strong>Fecha:</strong> <?= $datosVentaFactura->Fecha . " " ?>  <strong>Serie:</strong> <?= $datosVentaFactura->Serie . " " ?> <br>
											<strong>Factura:</strong>  <?= $datosVentaFactura->Factura . " " ?> <br>
											<strong>Forma de pago:</strong> <?= $datosVentaFactura->FormaPago . " " ?> <strong> Domicilio:</strong> <?= $datosVentaFactura->DomicilioFiscalReceptor . " " ?> <br>
											<strong>Razon social:</strong> <?= $datosVentaFactura->razonSocial . " " ?>  <strong>Regimen:</strong> <?= $datosVentaFactura->RegimenFiscalReceptor . " " ?><strong> Uso CFDI:</strong>  <?= $datosVentaFactura->UsoCFDI . " " ?> <br>
											
											
										<?php endif; ?>
                                        </p>
                                    </td>

                                    <td style="text-align: right; padding-top:0px; padding-bottom:0; vertical-align:middle; padding:30px; background-color: #f9f9f9; border-radius: 3px; border-left: 5px solid white;">
                                       
 										<p style="color:#303030; font-size: 14px;  line-height: 1.6; margin:0; padding:0;">
                                           Id Venta: <?= $detalleVenta[0]->idVenta ?>  <br>
											Token venta: <?= $detalleVenta[0]->tokenVEnta ?>  <br>
											Fecha venta:<?= $detalleVenta[0]->FechaVentaG ?>  <br>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        
                    </td>
                </tr>
            </tbody>
        </table>
		<table style="width: 100%; margin-top:40px;">
                            <thead>
                                <tr> 
									<th style="text-align:left; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
										venta
									</th>
									<th style="text-align:left; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
										Fecha
									</th>
									<th style="text-align:center; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
										Servicio
									</th>
									<th style="text-align:right; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
										Cantidad
									</th>
									<th style="text-align:right; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
										Precio Unitario
									</th>
									<th style="text-align:right; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
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
                                                    <td style="padding-top:0px; padding-bottom:0; text-align: center;">
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


        <table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" style="position:absolute; bottom:0; width:100%; background-color:#ffffff;border-collapse:separate !important; border-spacing:0;color:#242128; margin:0;padding:30px; padding-top: 20px;"
            heigth="auto">
            <tr>
                <td colspan="4" style="border-top:1px solid #f1f0f0">&nbsp;</td>
            </tr>
			<tr>
                <td rowspan="4" style="width: 750px;">
					Detalle venta<br>
					<img src="https://chart.googleapis.com/chart?chs=150x150&amp;cht=qr&amp;chl=<?= base_url()?>public/DetalleVenta/detalle/<?= $detalleVenta[0]->idCliente?>/<?= $detalleVenta[0]->idVenta ?>/<?= $detalleVenta[0]->tokenVEnta ?>/&amp;choe=UTF-8" />
				</td>
				
            </tr>
            <tr>
                <td colspan="2" style="width: 150px">
                    <p href="#" style="font-size: 13px; text-decoration: none; line-height: 1.6; color:#909090; margin-top:0px; margin-bottom:0; text-align: right;">
                        Subtotal : </p>
                </td>
                <td style="padding-top:0px; text-align: right; width: 100px">
                    <p style="font-size: 13px; line-height: 1.6; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap; margin-left:15px">$
                      <?php echo (round((floatval($detalleVenta[0]->TotalVenta) / 1.16), 2)); ?></p>
                </td>
            </tr>

            <tr>
                <td colspan="2" style="width: 100%">
                    <p href="#" style="font-size: 13px; text-decoration: none; line-height: 1.6; color:#909090; margin-top:0px; margin-bottom:0; text-align: right;">
                        iva : </p>
                </td>
                <td style="padding-top:0px; text-align: right;">
                    <p style="font-size: 13px; line-height: 1.6; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap; margin-left:15px">$
                       <?php echo (round(((floatval($detalleVenta[0]->TotalVenta) / 1.16)*.16),2)); ?></p>
                </td>
            </tr>

           
            <tr>
                <td colspan="2" style=" width: 100%; padding-bottom:15px;">
                    <p href="#" style="font-size: 13px; text-decoration: none; line-height: 1.6; color:#909090; margin-top:0px; margin-bottom:0; text-align: right;">
                        <strong>Total : </strong></p>
                </td>
                <td style="padding-top:0px; text-align: right; padding-bottom:15px;">
                    <p style="font-size: 13px; line-height: 1.6; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap; margin-left:15px"><strong>
                            <strong>$ <?=(round(($detalleVenta[0]->TotalVenta), 2)) ?></strong></p>
                </td>
            </tr>

            <tr>
                <td colspan="4" style="border-top:1px solid #f1f0f0">&nbsp;</td>
            </tr>

            <tr>
                <td class="text-wrap" colspan="4" style="text-align:center; width: 15rem" >
                    <p style="color: #909090; font-size:11px; text-align:center;">
					
                       </p>
                </td>
            </tr>

        </table>
		
		
		<?php if(isset($datosVentaFactura)):?>	
			<div style="width: 100%;">
				<strong>Sello sat:</strong> <br><?= $datosVentaFactura->Sello . " " ?> 

			</div>
		<?php endif; ?>




    </div>
    <!--Mailing End-->


<?php else:?>



	<div leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="background-color:#ffffff; height:29.7cm; max-width:22cm; font-family: Helvetica,Arial,sans-serif !important; margin-bottom: 40px; position: relative;">
        <table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" style="width:100%; background-color:#ffffff;border-collapse:separate !important; border-spacing:0;color:#242128; margin:0;padding:30px; padding-top: 20px;"
            heigth="auto">

            <tbody>
                <tr>
                    <td align="left" valign="center" style="padding-bottom:20px;border-top:0;width:100% !important;"> 
						 <h1>No existe la venta</h1>
                    </td>
				</tr>
			</tbody>
		</table>
	</div>
	



<?php endif; ?>
</body>

</html>
