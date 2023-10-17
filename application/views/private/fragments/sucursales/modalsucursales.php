                                <!--Inicio modal tipo de pago-->

                                <div class="modal fade" id="ModalAgregar" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="nombreModal">Agregar Sucursal</h5>
                                                <input type="hidden" id="accion">
                                                <input type="hidden" id="idFP">
                                                <input type="hidden" id="estatusModal">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="row g-3">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">Nombre de
                                                                la
                                                                sucursal:</label>
                                                            <input type="text" class="form-control"
                                                                id="nombreSucursales">
                                                            <small class="text-danger" id="errornombreSucursales"
                                                                style="display: none;"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <h4>Domicilio: </h4>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="inputEmail4" class="form-label">Calle</label>
                                                        <input type="text" class="form-control" id="calleSuc">
                                                        <small class="text-danger" id="errorcalleSucursales"
                                                                style="display: none;"></small>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputPassword4" class="form-label">Numero</label>
                                                        <input type="text" class="form-control" id="numeroSuc">
                                                        <small class="text-danger" id="errornumeroSucursales"
                                                                style="display: none;"></small>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputPassword4" class="form-label">Colonia</label>
                                                        <input type="text" class="form-control" id="coloniaSuc">
                                                        <small class="text-danger" id="errorcoloniaSucursales"
                                                                style="display: none;"></small>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputPassword4" class="form-label">C.P.</label>
                                                        <input type="text" class="form-control" id="cpSuc">
                                                        <small class="text-danger" id="errorcpSucursales"
                                                                style="display: none;"></small>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputPassword4" class="form-label">Estado</label>
                                                        <select class="form-control select2-single" id="estados_s">
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputPassword4" class="form-label">Municipio</label>
                                                        <select class="form-control select2-singlel" id="municipio_s">
															<option value="--Selecciona--">--Selecciona--</option>
                                                            
                                                        </select>
														 <small class="text-danger" id="errormunicipio_s"
                                                                style="display: none;"></small>
                                                    </div>

                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-success" id="btnEnviar"
                                                    onclick="insertaSucursales()"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!--Fin modal-->



                                <!-- Modal borrar -->

                                <div class="modal fade" id="borrarModal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="tituloModalBorrar"></h5>

                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="cuerpoModalBorrar">

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-success" id="btnModalBorrar"
                                                    onclick="btnModalBorrar()">Borrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- termina Modal borrar -->