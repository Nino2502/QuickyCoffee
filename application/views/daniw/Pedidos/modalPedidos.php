
                                <div class="modal fade" id="ModalCheck" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="nombreModal"></h5>
                                                <input type="hidden" id="idVenta">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <!-- Select Estatus -->
                                                    <div class="form-group" id="divEstatus">
                                                        <label for="message-text" class="col-form-label">Estatus:</label>
                                                        <select type="text" class="form-control select2-single" id="estatus"></select>
                                                        <small class="text-danger" id="errorEstatus" style="display: none;"></small> 
                                                    </div>

                                                    <!-- Token -->
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Token del pedido:</label>
                                                        <input type="text" class="form-control" id="token">
                                                        <small class="text-danger" id="errorToken" style="display: none;"></small>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-success" id="btnEnviar" onclick="conPedidos()"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!--Fin modal-->



                                <!-- Modal vistaPrevia -->
                                <div class="modal fade" id="detalleVenta" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <!-- Titulo del modal -->
                                                <h5 class="modal-title" id="titleDetalle"></h5>

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="contenidoDet"></div>
                                            <div class="modal-footer" id="buttonModal">
                                                <!-- <a href="<?= base_url('daniw/Pedidos/pdf') ?>">PDF</a> -->
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            