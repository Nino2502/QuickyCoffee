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
        fechaCotizacion: fecha
    }


    $.ajax({
        url: base_url() + "app/Aldair/Cotizaciones/getCotizacion",
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
                            <th style="text-align: center">Fecha cotización</th>
                            <th style="text-align: center">$ Cotización</th>
                          
                            <th style="text-align: center">Token Cotización</th>
                            <th style="text-align: center">Detalle cotización</th>
                           
                           
                        </tr>
                    </thead>
                    <tbody>
                
                    </tbody>
                </table>`);
                $.each(data.cotizaciones, function (i, o) {
                    
					$("#tablaCoti")
						.find("tbody")
						.append(
							`
                     <tr id="tr-` + o.idCotizacion +`">
                        <td style="text-align: center">` + o.idCotizacion +`</td>
                        <td style="text-align: center">` + o.nombreU + ` ` + o.apellidos + `</td>
                        <td style="text-align: center">`  +o.fechaCotizacion + `</td>
                        <td style="text-align: center">` + '$ '+o.TotalCotizacion + `</td> 
                        
                        <td style="text-align: center">`  + o.TokenCotizacion + `</td> 
                        <td align="center"><a href="#" onclick="detalleCotizacion(`+o.idCotizacion+`,'`+o.PublicoGeneral+`','`+o.idCliente+`')"><i class="fas fa-pencil fa-2x"></i></a></td>
                       
                     </tr>`
						);
				});

                
				$("#tablaCoti").DataTable(),
					$(".dataTables_length select").addClass("form-select form-select-sm");
            
            }else{
             	$("#tablaCotizaciones").html("No hay cotizaciones registradas en esta fecha: " + fecha);
            }
    })
    .fail();
    

}
function resetDetalleCo(){
    $("#listaCotizacion").html("");
    $("#detalleCliente").val("");
}

function detalleCotizacion(idCotizacion, PublicoGeneral, idCliente){
    resetDetalleCo()
    
    $("#ModaldetalleCotizacion").modal("show");
    
    console.log("idCotizacion: " + idCotizacion);
    console.log("PublicoGeneral: " + PublicoGeneral);
    console.log("idCliente: " + idCliente);
    console.log("idCliente: " + typeof(idCliente));

    let idClienteG = parseInt(idCliente);


    formbody =  {
        idCotizacion: idCotizacion
    }

    $("#clienteGeneral").hide();
    $("#clienteEspe").hide()

    
    $.ajax({
        url: base_url() + "app/Aldair/Cotizaciones/detalleCotizacion",
        dataType: "JSON",
        type: "POST",
        data: formbody
    })
    .done((data) => {

        if(idClienteG == 0){/*Validamos el cliente si es general o especifico */
            $("#clienteGeneral").show();
            
            if (data.resultado) {
                $("#detalleCliente").val(PublicoGeneral)

               $.each(JSON.parse(data.detalleCotizacion.Servicios), function (i, p) {
                        $("#listaCotizacion").append(`
                            <hr>
                            <div class="row">
                         
                            <div class="col-md-8 pb-4">
                                <ul>
                                    <li>Servicio/Producto: `+ p.idServicio+`</li>
                                    <li>Cantidad: `+ p.Cantidad+`</li>
                                    <li>Precio: `+ p.PrecioUnitario+`</li>
                                </ul>
                            
                               
                            </div>
                        </div>
                        
                        
                        `)
                });
            }else{
             
            }
        }else{/*Si es un cliente especifico */
        $("#clienteEspe").show();
           
           /*Variables a pintar*/
              $("#nombreCli").val(data.Usuario.nombreU + " " + data.Usuario.apellidos);
              $("#correoCli").val(data.Usuario.correo);
              $("#telefonoCli").val(data.Usuario.telefono);


            $.each(JSON.parse(data.detalleCotizacion.Servicios), function (i, p) {
                $("#listaCotizacion").append(`
                    <hr>
                    <div class="row">
                 
                    <div class="col-md-8 pb-4">
                        <ul>
                            <li>Servicio/Producto: `+ p.idServicio+`</li>
                            <li>Cantidad: `+ p.Cantidad+`</li>
                            <li>Precio: `+ p.PrecioUnitario+`</li>
                        </ul>
                    
                       
                    </div>
                </div>
                
                
                `)
        });
        }
           
    })
    .fail();



 
}


function resetDate(){// reiniciamos todos 
    location.reload();
}
