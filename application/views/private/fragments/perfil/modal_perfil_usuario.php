<!--Inicio modal tipo de pago-->
                                
<div class="modal fade" id="ModalEditarPerfil" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nombreModal">Editando usuario</h5>
                <input type="hidden" id="acccion">
                <input type="hidden" id="idFP">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="message-text"
                            class="col-form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombrePerfilUsuario">
                        <small class="text-danger" id="errorNombreUsuM" style="display: none;"></small>
                    </div>
                    <div class="form-group">
                        <label for="message-text"
                            class="col-form-label">Apellidos:</label>
                        <input type="text" class="form-control" id="apellidoPerfilUsuario">
                        <small class="text-danger" id="errorApellidoUM" style="display: none;"></small>
                    </div>
                    <div class="form-group">
                        <label for="message-text"
                            class="col-form-label">Teléfono:</label>
                        <input type="text" class="form-control" id="telefonoPerfilUsuario">
                        <small class="text-danger" id="errorTelefonoUsu" style="display: none;"></small>
                    </div>
                  
                </form>
            </div>
            <div class="modal-footer" id="actualizar-info">
    
            </div>
        </div>
    </div>
</div>


<!--Fin modal-->