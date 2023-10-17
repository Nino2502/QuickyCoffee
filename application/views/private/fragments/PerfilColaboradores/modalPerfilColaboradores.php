<!--Inicio modal tipo de pago-->
                                
<div class="modal fade" id="agregarPerfilColaborador" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nombreModal">Agregar perfil colaborador</h5>
                <input type="hidden" id="acccion">
                <input type="hidden" id="idTP">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="message-text"
                            class="col-form-label">Nombre del tipo de perfil colaborador:</label>
                        <input type="text" class="form-control" id="nombrePerfilColaborador">
                        <small class="text-danger" id="errorNombrePerfilColaborador" style="display: none;"></small>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Descripción:</label>
                        <input type="text" class="form-control" id="descripcionPC">
                        <small class="text-danger" id="errordescripcionPC" style="display: none;"></small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                    data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="btnEnviar" onclick="InsertarTipoColaborador()">Agregar Tipo de Contratación</button>
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
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-success" id="btnModalBorrar" onclick="btnModalBorrar()">Borrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


<!-- termina Modal borrar -->