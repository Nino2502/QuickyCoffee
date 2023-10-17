<!--Inicio modal tipo de pago-->
                                
<div class="modal fade" id="modalClienteRegistro" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="FechaLevantamientoOrden">Registro cliente</h5>
                <input type="hidden" id="acccion">
                <input type="hidden" id="idU">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
         
<form>                

<div class="row">
  

    <div class="form-group col-6">
        <label for="message-text"
            class="col-form-label">Nombre:</label>
        <input type="text" class="form-control" id="nombreCliente"  placeholder="Ingresa nombre">
        <small class="text-danger" id="errornombreCliente" style="display: none;"></small>
    </div>
    <div class="form-group col-6">
        <label for="message-text"
            class="col-form-label">Apellidos:</label>
        <input type="text" class="form-control" id="apellidosCliente"  placeholder="Ingresa apellidos">
        <small class="text-danger" id="errorApellidosCliente" style="display: none;"></small>
    </div>
    <div class="form-group col-6">
        <label for="message-text" class="col-form-label">Telefono:</label>
        <input type="tel" max="10" class="form-control" id="telefonoCliente"  placeholder="Ingresa telefono">
        <small class="text-danger" id="errortelefonoCliente" style="display: none;"></small>
    </div>
    <div class="form-group col-6">
        <label for="message-text" class="col-form-label">Correo:</label>
        <input type="text" class="form-control" id="correoCliente"  placeholder="Ingresa correo">
        <small class="text-danger" id="errorcorreoCliente" style="display: none;"></small>
    </div>

    <div class="form-group col-6" id="passN">
            <label for="exampleInputPassword1">Contraseña</label>
            <div class="input-group">
                    <input disabled type="password" class="form-control" id="contrasenaColaborador"
                                placeholder="">
                    <div class="input-group-append">
                    <button id="contraseñaV" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon2"></span> </button>
                    </div>
            </div>
            <small class="text-danger" id="errorcontrasenaColaborador" style="display: none;"></small>
    </div>

  
</div>

</form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                    data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="btnEnviar" onclick="registrarUsuario()">Registrar</button>
            </div>
        </div>
    </div>
</div>


<!--Fin modal-->


<!--Inicio modal tipo de pago-->
                                
<div class="modal fade" id="modalCarrito" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title_venta">Cotización</h5>
                <input type="hidden" id="acccion">
                <input type="hidden" id="idU">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
         
<form>                

<div class="row">
  

   
    <div class="form-group col-6" id="tipoPago">
        <label for="message-text"   class="col-form-label">Cliente:</label>
        <select  id="selectPago" class="form-control select2-single"></select>
        <small class="text-danger" id="errorEspecialidad"  style="display: none;"></small> 
    </div>

    <div class="form-group col-6">
        <label for="message-text" class="col-form-label">Total:</label>
        <input type="tel" max="10" class="form-control" id="totapago" >
        <small class="text-danger" id="errortelefonoCliente" style="display: none;"></small>
    </div>
    <div class="form-group col-12" id="datosCliente">
        <label for="message-text" class="col-form-label">Datos cliente:</label>
        <textarea id="PublicoGeneral" class="form-control"></textarea>
        <small class="text-danger" id="errortelefonoCliente" style="display: none;"></small>
    </div>
    <div class="form-group col-12" id="checkSeleccionar">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
            <label class="form-check-label" for="flexSwitchCheckDefault">Enviar cotización correo electronico</label>
        </div>
    </div>

    <!-- <div class="form-group col-12" id="tokenCotizacion">
        <label for="message-text" class="col-form-label">Token cotización:</label>
        <input type="tel" disabled max="10" class="form-control" id="tokencoti">
        <small class="text-danger" id="errortelefonoCliente">Token cotizacion para Publico en general</small>
    </div>
     -->






  
</div>

</form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                    data-dismiss="modal" onclick="reset()">Cerrar</button>
                <button type="button" class="btn btn-success" id="btnCotizacion" >Registrar</button>
            </div>
        </div>
    </div>
</div>


<!--Fin modal-->



<!--Inicio modal stock sucursales productos-->
                                
<div class="modal fade show" id="modalStockinv" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleStock"></h5>
                <input type="hidden" id="acccion">
                <input type="hidden" id="idU">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
         
<form>                

<div class="row">
  

   
    <div class="form-group col-12" id="SucursalesInventario">
        
        <small class="text-danger" id="errorApellidosCliente" style="display: none;"></small>
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


<!--Fin modal-->

<!--Ingreso cambio sistema-->
                                
<div class="modal fade" id="modal-IngresoCambio" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title_venta">Movimiento caja</h5>

                <input type="hidden" id="acccion">
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
         
<form>                

<div class="row">

    <div class="form-group col-12 text-center" id="ControlAcceso">
        <label for="message-text" class="col-form-label">Ingrese el acceso para acceder al movimiento de caja:</label>
        <input type="password" class="form-control mb-3" id="accesoAdmin" value="">
        <small class="text-danger" id="errorAcceso"  style="display: none;"> Clave incorrecta.</small> 
        <i class="simple-icon-check text-success  display-4" style="display: none;" id="accesoPermitido"></i>
       
        <br>
        <button type="button" class="btn btn-primary mb-1 mx-auto" id="btnverificarAcceso" >Acceder</button>
    
        
    </div>
        
    <div class="form-group col-12" id="OperacionMovimiento">
            <div id="seleccionarTipoMovimiento" class="form-group col-12">
                    <label for="message-text"   class="col-form-label">Tipo movimiento:</label>
                    <select  id="seleccionarTM" class="form-control select2-single"></select>		
                    <small class="text-danger" id="errorTMovimiento"  style="display: none;"></small> 
        
            </div>
            <div class="form-group col-12">
                <label for="message-text"
                    class="col-form-label">Efectivo:</label>
                <input type="text" class="form-control" id="intCambio" value="">
                <small class="text-danger" id="errorCambio"  style="display: none;"></small> 
                <br>
            </div>
            <div class="form-group col-12">
                
                    <label for="inputEmail4">Comentario</label>
                    <textarea class="form-control" rows="4" id="comentarioCambio"></textarea>
                    <small class="text-danger" id="errorComentario"  style="display: none;"></small> 
            </div>
    </div>
   
</div>

</form>
            </div>
            <div class="modal-footer" id="btnRegistroCambio">
                <button type="button" class="btn btn-danger"
                    data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="añadirChange" onclick="añadirCambio()">Registrar</button>
            </div>
        </div>
    </div>
</div>


<!--Fin modal Ingreso cambio sistema-->


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
    
    <div class="col-12" id="clienteEspe">
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

    <div class="form-group col-12" id="clienteGeneral">
        <strong for="message-text" class="col-form-label d-flex justify-content-center align-items-center">Datos del cliente</strong>
        <textarea id="detalleCliente" class="form-control" disabled></textarea>

    </div>
    
   

    <div class="form-group col-12">
        <hr>
        <strong for="message-text" class="col-form-label d-flex justify-content-center align-items-center">Servicios</strong>

        <div id="listaCotizacion"></div>
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
