$(document).ready(() => {

    showVentas()
});



function showVentas() {
	
	axios(base_url() + "app/Aldair/CorteHistorial/showCortecaja")
		.then(({ data: Response }) => {
		

			if (Response.resultado) {
			


                
				$("#despliegueTablaMajors").html(`
         <table id="datatableMajors" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
             <thead>
                 <tr>
                     <th style="text-align: center">id</th>
                     <th style="text-align: center">Caja</th>
                     <th style="text-align: center">Registro corte sistema</th>
                     <th style="text-align: center">Reporte de caja</th>
                     <th style="text-align: center">Saldo</th>
                     <th style="text-align: center">Corte sistema</th>
                     <th style="text-align: center">Corte caja</th>
                    
                 </tr>
             </thead>
             <tbody>
         
             </tbody>
         </table>`);
				$.each(Response.RegistrosCortes, function (i, o) {

               
                    const fecha = new Date(o.fechaCorteCons);
                    const fechaSinHora = fecha.toISOString().split('T')[0]; 

                    
                    const saldo = o.Diferencia;
                    let badge = '<span class="badge bg-success">';

                 
                    if (parseFloat(o.TotalCorte) < parseFloat(o.TotalCAJA)) {
                        badge = '<span class="badge bg-danger">';
                     
                        
                    }
                    else if ( parseFloat(o.TotalCorte) > parseFloat (o.TotalCAJA) ){
                        badge = '<span class="badge bg-warning">';
                      
                    
                    }
                    else if(saldo == 0){
                        badge = '<span class="badge bg-success">';
                       
                    }
                   
                   
                    
					$("#datatableMajors")
						.find("tbody")
						.append(
							`
                <tr id="tr-` +
								o.idRC +
								`">
                     <td style="text-align: center">` +
								o.idEmpleado +
								`</td>
                     <td style="text-align: center">` +
								o.nombreU +
								` ` +
								o.apellidos +
								`</td>
                     <td style="text-align: center">` +
                                '$ '+o.TotalCorte +
								`</td>
                     <td style="text-align: center">` +
                                '$ '+o.TotalCAJA +
								`</td> 
                    <td style="text-align: center"> ` +
                                badge + '$ ' +Math.abs(saldo) + '</span>' +
                              `</td> 
                    <td style="text-align: center">` +
                                        fechaSinHora +
								`</td> 
                    <td style="text-align: center">` +
								 o.fechaCorteReali +
								`</td> 
                   
                 </tr>`
						);
				});
				$("#datatableMajors").DataTable(),
					$(".dataTables_length select").addClass("form-select form-select-sm");
			} else {
                console.log("soy response"+ Response.mensaje)
				$("#despliegueTablaMajors").html(Response.mensaje);
			}
		})
		.catch((error) => {
			console.log(error, "Error al cargar el controlador ");
		});
}

function detelleCorte(idRC){


    $("#statusHistorialCorte").empty();
    $("#modalDetalleCorte").modal("show");
    $("#listaproductosVenta").empty();
    $("#listaCambios").empty();
    $("#registroCambios").hide();
    $("#registroProductos").show();
    console.log("entro aquii")
    $.ajax({
        url: base_url() + "app/Aldair/CorteHistorial/detalleCorte",
        dataType: "JSON",
        type: "POST",
        data: {
            
            idRC: idRC
        }
      })
      .done((data)=>{


        if(data.Cambios != null){
            $("#registroCambios").show();
            console.log("soy data.Cambios"+data.Cambios)
            $.each(data.Cambios, function (i, p) {
                $("#listaCambios").append(`
              
                <div class="row">
                
                <div class="col-md-12 pb-4">
                    <ul>
                        <li>Tipo movimiento:<strong> `+ p.NombreTM+`</strong></li>
                        <li>Cambio: $<strong> `+ p.TotalVenta+`</strong></li>
                        <li>Comentario: <strong>`+ p.Comentario+`</strong></li>
                        <li>Fecha y hora registro: <strong>`+ p.FechaVentaCierre+`</strong></li>
                        

                        
                    </ul>
                   
                   
                </div>
            </div>
            
            
            `)
            });
        }else{
            $("#registroCambios").hide();
        }

    
          if(data.resultado){
            
            
            
            $.each(data.RegistrosCortes, function (i, p) {
                $("#listaproductosVenta").append(`
                <hr>
                <div class="row">
                <div class="col-md-4 pb-4">
                    <a class="d-block position-relative" href="#">
                        <img id="` +p.idDV +`" src="` +base_url() + "static/imgServicios/" +p.image_url +`" alt="Marble Cake" class="list-thumbnail border-0" />
                    </a>
                </div>
                <div class="col-md-8 pb-4">
                    <ul>
                        <li>idVenta: `+ p.idVenta+`</li>
                        <li>Nombre producto: `+ p.nombreS+`</li>
                        <li>Forma de pago: `+ p.nombreFP+`</li>
                        <li>Cantidad : `+ p.Cantidad+`</li>
                        <li>Precio : $`+ p.PrecioUnitario+`</li>
                        <li>Venta realizada : `+ p.FechaVentaCierre+`</li>

                        
                    </ul>
                   
                    <div class="mt-3">
                        <h4><span class="badge badge-pill badge-theme-2 ">Subtotal:`+(p.Cantidad * p.PrecioUnitario)+`</span></h4>
                    </div>
                </div>
            </div>
            
            
            `)
            });

          }else{
            $("#registroProductos").hide()
          }
      })
      .fail();



}