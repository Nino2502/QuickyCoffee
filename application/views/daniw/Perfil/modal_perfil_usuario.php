        <div class="modal fade" id="ModalDF" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="nombreFiscales"></h5>
                        <input type="hidden" id="accion">
                        <input type="hidden" id="idU" value="<?= $_SESSION['idusuario'] ?>">
                        <input type="hidden" id="idFiscales" value="">
                        <input type="hidden" id="estatusModal">
                        <input type="hidden" id="mun" value="">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>

                            <!-- Calle -->
                            <div class="form-group" id="divDomicilio">
                                <label for="message-text" class="col-form-label">Domicilio</label>
                                <select type="text" class="form-control select2-single" id="domicilioF"></select>
                                <small class="text-danger" id="errorCalleF" style="display: none;"></small>
                            </div>

                            <!-- Regimen -->
                            <div class="form-group" id="divRegimen">
                                <label for="message-text" class="col-form-label">Regimen</label>
                                <select class="form-control select2-single" id="regimenF"></select>
                                <small class="text-danger" id="errorRegimenF" style="display: none;"></small>
                            </div>

                            <!-- DeRegimen -->
                            <div class="form-group" id="divDRF">
                                <label for="message-text" class="col-form-label">CFDI</label>
                                <select class="form-control select2-single" id="DRF"></select>
                                <small class="text-danger" id="errorRegimenF" style="display: none;"></small> 
                            </div>

                            <!-- Calle -->
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Razón social</label>
                                <input type="text" class="form-control" id="rSocial">
                                <small class="text-danger" id="errorSocial" style="display: none;"></small>
                            </div>

                            <div class="form-row pb-2">
                                <!-- Numero Interior -->
                                <div class="form-group col-md-6">
                                    <label for="message-text" class="col-form-label">RFC</label>
                                    <input type="text" class="form-control" id="rfcF">
                                    <small class="text-danger" id="errorRFC" style="display: none;"></small>
                                </div>

                                <!-- Numero Interior -->
                                <div class="form-group col-md-6">
                                    <label for="message-text" class="col-form-label">Correo</label>
                                    <input type="text" class="form-control" id="correoF">
                                    <small class="text-danger" id="errorCorreoF" style="display: none;"></small>
                                </div>
                            </div>

                            <!-- <div style="text-align: center;"> -->
                            <label class="col-form-label">
                                <input type="checkbox" class="mr-1" id="cbox" value="1">Datos fiscales predeterminados 
                            </label> 
                            <!-- </div> -->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" id="btnFiscales" onclick="insertaFiscal()"></button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="ModalAgregar" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="nombreModal"></h5>
                        <input type="hidden" id="accion">
                        <input type="hidden" id="idU" value="<?= $_SESSION['idusuario'] ?>">
                        <input type="hidden" id="estatusModal">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>

                            <!-- Calle -->
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Calle</label>
                                <input type="text" class="form-control" id="calle">
                                <small class="text-danger" id="errorCalle" style="display: none;"></small>
                            </div>

                            <!-- Colonia ...-->
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Colonia</label>
                                <input type="text" class="form-control" id="colonia">
                                <small class="text-danger" id="errorColonia" style="display: none;"></small>
                            </div>

                            <div class="form-row pb-2">
                                <!-- Numero Interior -->
                                <div class="form-group col-md-6">
                                    <label for="message-text" class="col-form-label"># Exterior</label>
                                    <input type="text" class="form-control" id="ext">
                                    <small class="text-danger" id="errorExterior" style="display: none;"></small>
                                </div>

                                <!-- Numero Interior -->
                                <div class="form-group col-md-6">
                                    <label for="message-text" class="col-form-label"># Interior</label>
                                    <input type="text" class="form-control" id="int">
                                    <small class="text-danger" id="errorInterior" style="display: none;"></small>
                                </div>

                            </div>

                            <!-- CP -->
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">CP</label>
                                <input type="text" class="form-control" id="cp">
                                <small class="text-danger" id="errorCP" style="display: none;"></small>
                            </div>

                            <div class="form-row pb-2">
                                <!-- Estado -->
                                <div class="form-group col-md-6" id="divEstado">
                                    <label for="message-text" class="col-form-label">Estado</label>
                                    <select type="text" class="form-control select2-single" id="estado"></select>
                                    <small class="text-danger" id="errorEST" style="display: none;"></small>
                                </div>

                                <!-- Municipio -->
                                <div class="form-group col-md-6" id="divMunicipio">
                                    <label for="message-text" class="col-form-label">Municipio</label>
                                    <select class="form-control select2-single" id="municipio"></select>
                                    <small class="text-danger" id="errorMUN" style="display: none;"></small>
                                </div>

                                
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" id="btnEnviar" onclick="insertaDom()"></button>
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

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="cuerpoModalBorrar">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" id="btnModalBorrar" onclick="btnModalBorrar()">Borrar</button>
                    </div>
                </div>
            </div>
        </div>