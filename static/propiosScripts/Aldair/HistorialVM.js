$(document).ready(function() { 

    


});


function getCotizacionDate(){ // consultamos la fecha especifica
    /*variables*/
    let fecha = $("#consultaCotizacion").val();
    

    if(validarFecha(fecha)){
        mostrarCotizaciones(fecha)
        console.log("fecha: " +fecha);
    }else{
        alert("Fecha no valida");
    }
   
}

function validarFecha(fecha){
    const fechaDate = Date.parse(fecha);
    return !isNaN(fechaDate);
}

function mostrarCotizaciones(fecha){
    /*variables*/
    
    formbody =  {
        FechaVentaG: fecha
    }


    $.ajax({
        url: base_url() + "app/Aldair/Ventas/getVentas",
        dataType: "JSON",
        type: "POST",
        data: formbody
    })
    .done((data) => {

        console.log("data: " +data.cotizaciones);
            if (data.resultado) {
             
                $("#tablaCotizaciones").html(`
                <table id="tablaCoti" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th style="text-align: center">id</th>
                            <th style="text-align: center">Cliente</th>
                            <th style="text-align: center">Fecha</th>
                            <th style="text-align: center">$</th>
                          
                            <th style="text-align: center">Tipo</th>
                            <th style="text-align: center">Detalle</th>
                           
                           
                        </tr>
                    </thead>
                    <tbody>
                
                    </tbody>
                </table>`);
                $.each(data.HistorialVM, function (i, o) {
                    
                    let tipo          = o.TipCambio != null ? o.NombreTM : "Venta"
                    let NombreCliente = o.nombreU != null ?  o.nombreU + " " + o.apellidos : "Movimiento Caja"

					$("#tablaCoti")
						.find("tbody")
						.append(
							`
                     <tr id="tr-` + o.idVenta +`">
                        <td style="text-align: center">` + o.idVenta +`</td>
                        <td style="text-align: center">` + NombreCliente + `</td>
                        <td style="text-align: center">`  +o.FechaVentaG + `</td>
                        <td style="text-align: center">` + '$ '+o.TotalVenta + ' MXN'+ `</td> 
                        
                        <td style="text-align: center">`  + tipo+ `</td> 
                        <td align="center"><a href="#" onclick="detalleCotizacion('`+o.idVenta+`','`+o.Comentario+`','`+o.TotalVenta+`')"><i class="fas fa-pencil fa-2x"></i></a></td>
                       
                     </tr>`
						);
				});

                
				$("#tablaCoti").DataTable(),
					$(".dataTables_length select").addClass("form-select form-select-sm");
            
            }else{
             	$("#tablaCotizaciones").html("No hay ventas registradas para esta fecha: " + fecha);
            }
    })
    .fail();
    

}
function resetDetalleCo(){
    $("#listaCotizacion").html("");
    $("#detalleCliente").val("");
}

function cliente(idVenta){
    formbody =  {
        idVenta: idVenta
    }
    
    $.ajax({
        url: base_url() + "app/Aldair/Ventas/getCliente",
        dataType: "JSON",
        type: "POST",
        data: formbody
    })
    .done((data) => {
            if (data.resultado) {
                let general = data.Cliente
                $("#nombreCli").val(general.nombreU + " " + general.apellidos);
                $("#telefonoCli").val(general.telefono);
                $("#correoCli").val(general.correo);


            }else{
                
            }
    })
    .fail();

}

const  detalleCotizacion = async (idVenta,Comentario,TotalVenta)=> {
    $("#ClienteInfo").hide();
    $("#listaMovimientos").hide();

    resetDetalleCo()
    $("#ModaldetalleCotizacion").modal("show");
    formbody =  {
        idVenta: idVenta
    }

    cliente(idVenta)
    
    $.ajax({
        url: base_url() + "app/Aldair/Ventas/getDetalle",
        dataType: "JSON",
        type: "POST",
        data: formbody
    })
    .done((data) => {
            if (data.resultado) {
                $("#ClienteInfo").show();
               $.each(data.DetalleVentas, function (i, p) {

                    let detalle = p.idServicio.startsWith("SDI-Ven-Ven-") ? p.ProductoComentario : "Sin detalle";

                        $("#listaCotizacion").append(`
                            <hr>
                            <div class="row">
                         
                            <div class="col-md-8 pb-4">
                                <ul>
                                    <li>Servicio/Producto: <strong>`+ p.idServicio+`</strong></li>
                                    <li>Cantidad: <strong>`+ p.Cantidad+`</strong></li>
                                    <li>Precio: <strong>`+ p.PrecioUnitario+` MXN</strong></li>
                                    <li>Detalle: <strong>` +detalle+`</strong></li>

                                </ul>
                            
                               
                            </div>
                        </div>
                        
                        
                        `)
                });

               
            }else{
                $("#listaMovimientos").show();
             console.log("hola pta", TotalVenta )
             $("#listaMovimientos").html(`
             <hr>
             <div class="row">
          
                    <div class="col-md-8 pb-4">
                        <ul>
                            <li>Servicio/Producto: <strong>Movimiento</strong></li>
                            <li>Cantidad: <strong>`+ TotalVenta+` MXN</strong></li>
                            <li>Comentario:  <strong>` + (Comentario != null ? Comentario : "sin comentario") +`</strong></li>

                        </ul>
                    
                        
                    </div>
              </div>
         
        

         `)
            }
    
           
    })
    .fail();



 
}


function resetDate(){// reiniciamos todos 
    location.reload();
}
