





<!-- Datos del abogado a pagar -->


<?php if($reporte != null ): ?>

<div class="row mb-4">
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Fecha</th>
										<th>Servicio</th>
                                        <th>Costo</th>
                                        <th>Comision</th>
                                        <th>Total</th>
										<th></th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
									
									
									<?php foreach($reporte as $fila): ?>
									
										<tr>
											<td><?= $fila->idVenta?></td>
											<td><?= $fila->fecha?></td>
											<td><?= $fila->nombre_servicio?></td>
											<td><?= $fila->costo?></td>
											<td>0</td>
											<td>0</td>
										</tr>
									
									
									<?php endforeach; ?>
									
									
									
                                    
                                  

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>






<?php endif; ?>










<!-- Datos del abogado a pagar -->