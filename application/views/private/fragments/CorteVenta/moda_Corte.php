<!-- Modal borrar -->

                                <div class="modal fade" id="modalCorteregistro" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="tituloCorte"></h5>
                                                
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body col-12">
                                                <div class="row">
                                                    <div class="form-group col-6">
                                                        <label for="message-text" class="col-form-label">Consulta de corte caja:</label>
                                                        <input type="text" class="form-control" id="FechaEmision">
                                                        <small class="text-danger" id="errornombreColaborador" style="display: none;"></small>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="message-text" class="col-form-label">Caja:</label>
                                                        <input type="text" class="form-control" id="CajaActiva">
                                                        <small class="text-danger" id="errornombreColaborador" style="display: none;"></small>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="message-text" class="col-form-label">Corte caja - Sistema:</label>
                                                        <input type="text" class="form-control" id="corteSistema">
                                                        <small class="text-danger" id="errornombreColaborador" style="display: none;"></small>
                                                    </div>

                                                    <div class="form-group col-6">
                                                        <label for="message-text" class="col-form-label">Corte caja - Caja:</label>
                                                        <input type="text" class="form-control" id="corteCaja">
                                                        <small class="text-danger" id="errornombreColaborador" style="display: none;"></small>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label for="message-text" class="col-form-label" id="Advertencia"> </label>
                                
                                                      
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-success" id="registrarCorte">Registar recorte</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


<!-- termina Modal borrar -->


<!-- Modal detalleCorte -->

<div class="modal fade" id="modalDetalleCorte" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="tituloCorte">Detalle corte caja</h5>
                                                
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body col-12">
                                            
                                                    
                                                   
                                                    <div id="registroCambios">
                                                            <h5  class="pb-4" style="text-align:center">Movimientos caja</h5>
                                                            <div class="form-group col-12" id="listaCambios"></div>         
                                                    </div>
                                                  
                                                    
                                                    <div id="registroProductos">   
                                                    <hr>  
                                                           <h5  class="pb-4" style="text-align:center">Productos</h5>
                                                           <label style="text-align:center" for="message-text" class="col-form-label" id="statusHistorialCorte" ></label>
                                                            <div class="form-group col-12" id="listaproductosVenta"></div>
                                                    </div>
                                               
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Cerrar</button>
                                             
                                            </div>
                                        </div>
                                    </div>
                                </div>


<!-- termina Modal borrar -->