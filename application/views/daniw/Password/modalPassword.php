                                <!--Inicio modal tipo de pago-->
                                <div class="modal fade" id="ModalAgregar" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document"> 
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="nombreModal"></h5>
                                                <input type="hidden" id="accion">
                                                <input type="hidden" id="idTU"> 
                                                <!-- <input type="hidden" id="estatusModal"> -->
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <!-- Select Usuario -->
                                                    <div class="form-group" id="divSelectUsuario">
                                                        <label for="message-text" class="col-form-label">Tipo de usuario:</label>
                                                        <select type="text" class="form-control select2-single" id="selectUsuario"></select>
                                                        <small class="text-danger" id="errorUsuario" style="display: none;"></small> 
                                                    </div>

                                                    <!-- Select Perfil -->
                                                    <div class="form-group" id="divSelectPerfil">
                                                        <label for="message-text" class="col-form-label">Tipo de perfil:</label>
                                                        <select type="text" class="form-control select2-single" id="selectPerfil"></select>
                                                        <small class="text-danger" id="errorPerfil" style="display: none;"></small> 
                                                    </div>

                                                    <!-- Seltect Modulo -->
                                                    <div class="form-group" id="divSelectModulos">
                                                        <label for="message-text" class="col-form-label">Módulo:</label>
                                                        <select type="text" class="form-control select2-single" id="selectModulos"></select>
                                                        <small class="text-danger" id="errorModulo" style="display: none;"></small>
                                                    </div>

                                                    <!-- Select Seccion -->
                                                    <div class="form-group" id="divSelectSeccion">
                                                        <label for="message-text" class="col-form-label">Sección:</label>
                                                        <select type="text" class="form-control select2-single" id="selectSeccion"></select>
                                                        <small class="text-danger" id="errorSeccion" style="display: none;"></small>
                                                    </div>
                                                    
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-success" id="btnEnviar" onclick="insertaPermisos()"></button>
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
                                                <button type="button" class="btn btn-success" id="btnModalBorrar">Borrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            