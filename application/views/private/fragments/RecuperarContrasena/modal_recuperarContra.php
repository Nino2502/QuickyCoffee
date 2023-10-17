<!--Ingreso cambio sistema-->
                                
<div class="modal fade" id="modalActualizar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title_venta">Actualización contraseña</h5>

                <input type="hidden" id="acccion">
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
         
<form>                

<div class="row">

    
        
    <div class="form-group col-12" id="OperacionMovimiento">
            
            <div class="form-group col-12">
                <label for="message-text"
                    class="col-form-label">Contraseña:</label>
                <input type="text" class="form-control" id="contrasena" value="">
                <small class="text-danger" id="errorcontrasena"  style="display: none;"></small> 
                <br>
            </div>
            <div class="form-group col-12">
                <label for="message-text" class="col-form-label">Confirmar contraseña:</label>
                <input type="text" class="form-control" id="confirmarcontrasena" value="">
                <small class="text-danger" id="errorNcontrasena"  style="display: none;"></small> 
                <br>
            </div>
            
        
    </div>
   
</div>

</form>
            </div>
            <div class="modal-footer" id="btnRegistroCambio">
                <button type="button" class="btn btn-danger"
                    data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="añadirChange" onclick="actualizar()">Actualizar</button>
            </div>
        </div>
    </div>
</div>


<!--Fin modal Ingreso cambio sistema-->
