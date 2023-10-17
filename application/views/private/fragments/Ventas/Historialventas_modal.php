
<!--Inicio modal DetalleCotizacion-->
                                
<div class="modal fade" id="ModaldetalleCotizacion" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Detalle</h5>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
         
<form>                

<div class="row">
    
    <div class="col-12" id="ClienteInfo">
        <strong for="message-text" class="col-form-label d-flex justify-content-center align-items-center">Datos del cliente</strong>

           

            <div class="form-group col-12">
                <label for="message-text" class="col-form-label">Nombre:</label>
                <input type="tel" max="10" class="form-control" id="nombreCli"  disabled>
            </div>

            <div class="form-group col-12">
                <label for="message-text" class="col-form-label">Teléfono:</label>
                <input type="tel" max="10" class="form-control" id="telefonoCli"  disabled>
            </div>

            <div class="form-group col-12">
                <label for="message-text" class="col-form-label">Correo:</label>
                <input type="tel" max="10" class="form-control" id="correoCli"  disabled>
            </div>

          
            
          
            

    </div>
    <hr>
    <div class="form-group col-12">
        
        <strong for="message-text" class="col-form-label d-flex justify-content-center align-items-center">Servicios</strong>

        <div id="listaCotizacion"></div>
    </div>
    <div class="form-group col-12">
        
       

        <div id="listaMovimientos"></div>
    </div>
  

    
  
</div>

</form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                    data-dismiss="modal">Cerrar</button>
                
            </div>
        </div>
    </div>
</div>


<!--Fin modal DetalleCotizacion-->
