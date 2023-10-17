$(document).ready(() => {
  //alert("ya estamos aqui");
  $("#datatable").find("tbody").html("");

  $("#selectSucursal").on("change", function () {
    let idSucursal = $("#selectSucursal").val();
    console.log("idSuc", idSucursal);

    if (idSucursal != "--Selecciona--") {
      $.ajax({
        url: base_url() + "app/Reportes/listaCajasSucursal",
        dataType: "JSON",
        type: "POST",
        data: {
          idSucursal: idSucursal,
        },
      })
        .done((data) => {
          $("#selectCaja").html(`
					<option>--Selecciona--</option>
					<option value="0" selected >Todos</option>

					

				`);

          if (data.resultado) {
            /*if(idSucursal != "999"){
						
						$("#selectCaja").append('<option value="2" >Ventas en linea</option>');
						
					} */

            $.each(data.cajas, function (i, c) {
              $("#selectCaja").append(
                `

							<option value="` +
                  c.idU +
                  `" >` +
                  c.nombreU +
                  `</option>


							`
              );
            });
          }
        })
        .fail();
    }
  });

  $("#second-tab").click(() => {
    $("#despliegueTabla").html("");
    $("#totales").html("");
  });
  $("#tres-tab").click(() => {
    $("#despliegueTabla").html("");
    $("#totales2").html("");
  });
  $("#cuatro-tab").click(() => {
    $("#despliegueTabla").html("");
    $("#totales").html("");
  });
});
let arrayObj = []
function calcularVentas() {
  $("#mensaje-validar").html("");
  $("#contenidoListaCard").html("");
  $("#totales").html("");

  let selectSucursal = $("#selectSucursal").val();
  let selectCaja = $("#selectCaja").val();
  let selectTipoDePago = $("#selectTipoDePago").val();
  let selectFactura = $("#selectFactura").val();
  let selectClientes = $("#selectClientes").val();
  let fechaInicio = $("#rFechaInicio").val();
  let fechaFin = $("#rFechaFin").val();
  let c = 0;

  console.log(selectClientes);

  let goValidation = true;

  if ("--Selecciona--" == selectSucursal) {
    $("#mensaje-validar").append(" *Selecciona una sucursal");
    $("#selectSucursal").focus();
    goValidation = false;
  }

  if ("--Selecciona--" == selectCaja) {
    $("#mensaje-validar").append(" *Selecciona una caja");
    $("#selectCaja").focus();
    goValidation = false;
  }

  if ("--Selecciona--" == selectTipoDePago) {
    $("#mensaje-validar").append(" *Selecciona un tipo de pago");
    $("#selectTipoDePago").focus();
    goValidation = false;
  }

  if ("--Selecciona--" == selectClientes) {
    $("#mensaje-validar").append(" *Selecciona un cliente");
    $("#selectClientes").focus();
    goValidation = false;
  }

  if ("--Selecciona--" == selectFactura) {
    $("#mensaje-validar").append(" *Selecciona factura o sin factura");
    $("#selectFactura").focus();
    goValidation = false;
  }

  console.log("cliente ", selectClientes);

  if (goValidation) {
    $.ajax({
      url: base_url() + "app/Reportes/listaPago",
      dataType: "JSON",
      type: "POST",
      data: {
        selectSucursal: selectSucursal,
        selectCaja: selectCaja,
        selectFactura: selectFactura,
        selectClientes: selectClientes,
        fechaInicio: fechaInicio,
        fechaFin: fechaFin,
        selectTipoDePago: selectTipoDePago,
      },
    })
      .done((data) => {
        let dollarUSLocale = Intl.NumberFormat("es-MX");

        let totalPagar = 0;

        if (data.resultado) {

			arrayObj.push(data.ventas)

			//console.log('soy la data de las ventas' + JSON.stringify(arrayObj))
          $("#despliegueTabla").html(`
				
				<button id="btnExportar" onclick="exportarReporte()" class="btn btn-success mb-4">
					<i class="fas fa-file-excel"></i> Exportar datos a Excel
				</button>


				
					<table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
						<thead>
							<tr>
								<th>#</th>
								<th>Sucursal</th>
								<th>IdVenta</th>

								<th>Fecha</th>
								<th>Cliente</th>
								<th>Forma de Pago</th>
								<th>Factura</th>
								<th>Vendedor</th>
								<th>TotalVenta</th>
								<th style="text-align: center">detalle</th>

							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>`);

          $.each(data.ventas, function (i, o) {
            c++;

            $("#datatable")
              .find("tbody")
              .append(
                `
                        <tr id="tr-` +
                  o.idVenta +
                  `">
                            <td>` +
                  c +
                  `</td>
							<td class="text-wrap" style="width: 3rem;">` +
                  (o.nombreSuc == null ? " Venta En Línea" : o.nombreSuc) +
                  `</td>
							<td>` +
                  o.idVenta +
                  `</td>
                            <td>` +
                  o.FechaVentaG +
                  `</td>
 							<td>` +
                  o.NombreCliente +
                  `</td>
							<td>` +
                  o.nombreFP +
                  `</td>
                            <td>` +
                  (o.Factura == null ? "sin factura" : o.Factura) +
                  `</td>
                            <td>` +
                  o.nombreEmpleado +
                  `</td>
                            <td align='right'>$ ` +
                  dollarUSLocale.format(o.TotalVenta) +
                  `</td>
                            <td align='right'><a href="#" onclick="VistaPrevia(` +
                  o.idVenta +
                  `,'` +
                  o.tokenVenta +
                  `')">
                                <i class="fa-solid fa-eye fa-2x"></i>
                            </a></td>
						   
                        </tr>`
              );

            totalPagar += parseFloat(o.TotalVenta);
          });

          $("#datatable").DataTable(),
            $(".dataTables_length select").addClass(
              "form-select form-select-sm"
            );

          $("#totales").html(
            "<h1> Total reporte $<span>" +
              dollarUSLocale.format(totalPagar) +
              "</span> MXN.</h1>"
          );

          /* exportado */

          $("#exportaTabla").html("");

          $("#exportaTabla").html(`
				
					<table id="tabla" >
						<thead>
							<tr>
								
								<th>Sucursal</th>
								<th>IdVenta</th>

								<th>Fecha</th>
								<th>Cliente</th>
								<th>Forma de Pago</th>
								<th>Factura</th>
								<th>Vendedor</th>
								<th>TotalVenta</th>
								

							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>`);

          var hoy = new Date();
          var fecha =
            hoy.getDate() +
            "-" +
            (hoy.getMonth() + 1) +
            "-" +
            hoy.getFullYear();

          $("#tabla")
            .find("thead")
            .prepend(
              `
                        <tr>
                            
							<td colspan="2" align='right'>Total a calculado: $</td>
							<td colspan="2" align='left'><strong>` +
                totalPagar +
                `</strong></td>
							<td colspan="2"></td>
							<td colspan="2">Fecha:<strong>` +
                fecha +
                `</strong></td>
                            
                            
						   
                        </tr>`
            );

          $.each(data.ventas, function (i, o) {
            $("#tabla")
              .find("tbody")
              .append(
                `
                        <tr id="tr-` +
                  o.idVenta +
                  `">
                            
							<td >` +
                  (o.nombreSuc == null ? " Venta En Línea" : o.nombreSuc) +
                  `</td>
							<td>` +
                  o.idVenta +
                  `</td>
                            <td>` +
                  o.FechaVentaG +
                  `</td>
 							<td>` +
                  o.NombreCliente +
                  `</td>
							<td>` +
                  o.nombreFP +
                  `</td>
                            <td>` +
                  (o.Factura == null
                    ? "sin factura"
                    : "- " + o.Factura.toString() + " -") +
                  `</td>
                            <td>` +
                  o.nombreEmpleado +
                  `</td>
                            <td align='right'>` +
                  o.TotalVenta +
                  `</td>
                            
						   
                        </tr>`
              );
          });

          /* termina exportado */
        } else {
          $("#despliegueTabla").html(data.mensaje);

          $("#totales").html("");
        }
      })

      .fail();
  }
}

function VistaPrevia(id, tok) {
  const idVenta = id;
  $("#detalleVenta").modal("show");
  $("#contenidoDet").html("");
  $("#nombreModal").html("Detalle de la compra <strong>" + id + "</strong>");

  axios
    .post(base_url() + "daniw/CVentas/verDetalle", { idVenta: idVenta })
    .then(({ data }) => {
      if (data.resultado) {
        $.each(data.Detalle, function (i, o) {
          const subTotal = o.Cantidad * o.PrecioUnitario;
          $("#contenidoDet").append(
            `<div class="card-body">
                                                    
                        <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                            <a href="#">
                                <img alt="Profile Picture" src="` +
              base_url() +
              "static/imgServicios/" +
              o.image_url +
              `"
                                    class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                            </a>
                            <div class="pl-3">
                                <a href="#">
                                    <p class="font-weight-medium mb-0" id="producto"><strong>Producto: </strong>` +
              o.nombreS +
              `</p>
                                    <p class="text-muted mb-0 text-small">Cantidad: ` +
              o.Cantidad +
              `</p>
                                    <p class="text-muted mb-0 text-small">Subtotal: ` +
              subTotal +
              `</p>
                                </a>
                            </div>
                        </div>

                     </div>`
          );
        });

        //toastr["success"](data.mensaje);
      } else {
        toastr["warning"](data.mensaje);
      }
    })
    .catch((error) => {
      console.log(error);
    });
}

function calcularGastos() {
  $("#mensaje-validar2").html("");
  $("#contenidoListaCard").html("");
  $("#totales").html("");

  let selectTipoDeGasto = $("#selectTipoDeGasto2").val();
  let selectSucursal = $("#selectSucursal2").val();
  let fechaInicio2 = $("#rFechaInicio2").val();
  let fechaFin2 = $("#rFechaFin2").val();
  let c = 0;

  let goValidation = true;
  if ("--Selecciona--" == selectTipoDeGasto) {
    $("#mensaje-validar").append(" *Selecciona un tipo de gasto");
    $("#selectTipoDeGasto").focus();
    goValidation = false;
  }

  if ("--Selecciona--" == selectSucursal) {
    $("#mensaje-validar").append(" *Selecciona una sucursal");
    $("#selectSucursal").focus();
    goValidation = false;
  }

  if (goValidation) {
    $.ajax({
      url: base_url() + "app/Reportes/listaGastos",
      dataType: "JSON",
      type: "POST",
      data: {
        selectTipoDeGasto: selectTipoDeGasto,
        selectSucursal: selectSucursal,

        fechaInicio2: fechaInicio2,
        fechaFin2: fechaFin2,
      },
    })
      .done((data) => {
        let dollarUSLocale = Intl.NumberFormat("es-MX");

        let totalPagar2 = 0;

        if (data.resultado) {
          $("#despliegueTabla").html(`
				<button id="btnExportar" onclick="exportarReporte()" class="btn btn-success mb-4">
					<i class="fas fa-file-excel"></i> Exportar datos a Excel
				</button>
                <table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
							<th>Sucursal</th>
							<th>IdGasto</th>
							
                            <th>Fecha</th>
							<th>Factura</th>
							<th>Descripción</th>
							<th>Cantidad</th>
							<th>Proveedor</th>
							<th>Tipo de Gasto</th>
                            <th style="text-align: center">detalle</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                
                    </tbody>
                </table>`);

          $.each(data.gastos, function (i, o) {
            c++;

            $("#datatable")
              .find("tbody")
              .append(
                `
                        <tr id="tr-` +
                  o.idCom +
                  `">
                            <td>` +
                  c +
                  `</td>
							<td>` +
                  o.nombreSuc +
                  `</td>
							<td>` +
                  o.idCom +
                  `</td>
                            <td>` +
                  o.fecha +
                  `</td>
							<td>` +
                  "- " +
                  o.folio +
                  " -" +
                  `</td>
 							<td class="text-wrap" style="width: 15rem;">` +
                  "- " +
                  o.desCompra +
                  " -" +
                  `</td>
							<td>$ ` +
                  dollarUSLocale.format(o.total) +
                  `</td>
							
                            <td>` +
                  (o.idProv == null ? "n/a" : o.nombreProv) +
                  `</td>
                            <td>` +
                  o.nombreTG +
                  `</td>
                           
                            <td><a href="#" onclick="VistaPreviaG()">
                                <i class="fa-solid fa-eye fa-2x"></i>
                            </a></td>
						   
                        </tr>`
              );

            totalPagar2 += parseFloat(o.total);
          });

          $("#datatable").DataTable(),
            $(".dataTables_length select").addClass(
              "form-select form-select-sm"
            );

          $("#datatable").DataTable(),
            $(".dataTables_length select").addClass(
              "form-select form-select-sm"
            );

          $("#totales2").html(
            "<h1> Total reporte $<span>" +
              dollarUSLocale.format(totalPagar2) +
              "</span> MXN.</h1>"
          );

          /* exportado */

          $("#exportaTabla").html("");

          $("#exportaTabla").html(`
				
					<table id="tabla" >
						<thead>
							<tr>
								
								<th>Sucursal</th>
								<th>IdGasto</th>

								<th>Fecha</th>
								<th>Factura</th>
								<th>Descripción</th>
								<th>Cantidad</th>
								<th>Proveedor</th>
								<th>Tipo de Gasto</th>
								

							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>`);

          var hoy = new Date();
          var fecha =
            hoy.getDate() +
            "-" +
            (hoy.getMonth() + 1) +
            "-" +
            hoy.getFullYear();

          $("#tabla")
            .find("thead")
            .prepend(
              `
                        <tr>
                            
							<td colspan="2" align='right'>Total a calculado: $</td>
							<td colspan="2" align='left'><strong>` +
                totalPagar2 +
                `</strong></td>
							<td colspan="2"></td>
							<td colspan="2">Fecha:<strong>` +
                fecha +
                `</strong></td>
                            
                            
						   
                        </tr>`
            );

          $.each(data.gastos, function (i, o) {
            $("#tabla")
              .find("tbody")
              .append(
                `

 						<tr id="tr-` +
                  o.idCom +
                  `">
                            
							<td>` +
                  o.nombreSuc +
                  `</td>
							<td>` +
                  o.idCom +
                  `</td>
                            <td>` +
                  o.fecha +
                  `</td>
							<td>` +
                  "- " +
                  o.folio +
                  " -" +
                  `</td>
 							<td> ` +
                  `- ` +
                  o.desCompra +
                  ` -` +
                  `</td>
							<td>` +
                  o.total +
                  `</td>
                            <td>` +
                  (o.idProv == null ? "n/a" : o.nombreProv.toString()) +
                  `</td>
                            <td>` +
                  o.nombreTG +
                  `</td>
                        </tr>`
              );
          });

          /* termina exportado */
        } else {
          $("#despliegueTabla").html(data.mensaje);

          $("#totales2").html("");
        }
      })

      .fail();
  }
}

function ventasVSgastos() {
  $("#mensaje-validar3").html("");
  $("#contenidoListaCard").html("");
  $("#totales").html("");

  let selectSucursal = $("#selectSucursalVS").val();
  let selectFactura = $("#selectFacturaVS").val();
  let fechaInicio = $("#rFechaInicioVS").val();
  let fechaFin = $("#rFechaFinVS").val();
  let goValidation = true;

  if ("--Selecciona--" == selectSucursal) {
    $("#mensaje-validar3").append(" *Selecciona una sucursal");
    $("#selectSucursalVS").focus();
    goValidation = false;
  }

  if ("--Selecciona--" == selectFactura) {
    $("#mensaje-validar3").append(" *Selecciona factura o sin factura");
    $("#selectFacturaVS").focus();
    goValidation = false;
  }
  if (fechaInicio == "") {
    $("#mensaje-validar3").append(" *Elige una fecha de inicio");
    $("#rFechaInicioVS").focus();
    goValidation = false;
  }
  if (fechaFin == "") {
    $("#mensaje-validar3").append(" *Elige una fecha de fin");
    $("#rFechaFinVS").focus();
    goValidation = false;
  }

  if (goValidation) {
    $.ajax({
      url: base_url() + "app/Reportes/ventasVSgastos",
      dataType: "JSON",
      type: "POST",
      data: {
        selectSucursal: selectSucursal,
        selectFactura: selectFactura,
        fechaInicio: fechaInicio,
        fechaFin: fechaFin,
      },
    })
      .done((data) => {
        console.log(data);

        let dollarUSLocale = Intl.NumberFormat("es-MX");

        let totalPagar2 = 0;

        if (data.resultado) {
          $("#despliegueTabla").html(`
				<button id="btnExportar" onclick="exportarReporte()" class="btn btn-success mb-4">
					<i class="fas fa-file-excel"></i> Exportar datos a Excel
				</button>
                <table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Fecha Inicio</th>
							<th>Fecha Fin</th>
							<th>Ventas</th>
							<th>Gastos</th>
							<th>Diferiencia (ventas - gastos)</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                
                    </tbody>
                </table>`);

          let sumaventas =
            data.ventasVS[0].sumaVentas == null
              ? 0
              : parseFloat(data.ventasVS[0].sumaVentas);
          let sumagastos =
            data.gastosVS[0].sumaGastos == null
              ? 0
              : parseFloat(data.gastosVS[0].sumaGastos);

          let diferencia = sumaventas - sumagastos;

          $("#datatable")
            .find("tbody")
            .append(
              `
                        <tr>
                            <td >` +
                fechaInicio +
                `</td>
							<td>` +
                fechaFin +
                `</td>
							<td>$ ` +
                data.ventasVS[0].sumaVentas +
                `</td>
                            <td>$ ` +
                data.gastosVS[0].sumaGastos +
                `</td>
							<td>$ ` +
                diferencia +
                `</td>
						   
                        </tr>`
            );

          $("#datatable").DataTable(),
            $(".dataTables_length select").addClass(
              "form-select form-select-sm"
            );

          /* exportado */

          $("#exportaTabla").html("");

          $("#exportaTabla").html(`
				
					<table id="tabla" >
						<thead>
							<tr>
								
								<th>Fecha Inicio</th>
								<th>Fecha Fin</th>
								<th>Ventas</th>
								<th>Gastos</th>
								<th>Diferiencia (ventas - gastos)</th>
								

							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>`);

          var hoy = new Date();
          var fecha =
            hoy.getDate() +
            "-" +
            (hoy.getMonth() + 1) +
            "-" +
            hoy.getFullYear();

          $("#tabla")
            .find("thead")
            .prepend(
              `
                        <tr>
                            
							
							<td colspan="2">Fecha:<strong>` +
                fecha +
                `</strong></td>
                            
                            
						   
                        </tr>`
            );

          $("#tabla")
            .find("tbody")
            .append(
              `

 						<tr >
                            
							<td >` +
                fechaInicio +
                `</td>
							<td>` +
                fechaFin +
                `</td>
							<td>` +
                data.ventasVS[0].sumaVentas +
                `</td>
                            <td>` +
                data.gastosVS[0].sumaGastos +
                `</td>
							<td>` +
                diferencia +
                `</td>
                        </tr>`
            );

          /* termina exportado */
        } else {
          $("#despliegueTabla").html(data.mensaje);

          $("#totales2").html("");
        }
      })

      .fail();

    //comienza go valid
    /*
		$.ajax({
		"url":base_url()+"app/Reportes/ventasVSgastos",
		"dataType": "POST",
		"type":"JSON",
		"data":{
			"selectSucursal": selectSucursal,
			"selectFactura": selectFactura,
			"fechaInicio": fechaInicio,
			"fechaFin": fechaFin
			
		}
		
		})
		.done((data)=>{
			
			let dollarUSLocale = Intl.NumberFormat('es-MX');
			
			let totalPagar = 0;
			
			
			console.log(data);
			

			if(data.resultado){
				
				
				
				
				
    
                $("#despliegueTabla").html(`

				<button id="btnExportar" onclick="exportarReporte()" class="btn btn-success mb-4">
					<i class="fas fa-file-excel"></i> Exportar datos a Excel
				</button>


				
					<table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
						<thead>
							<tr>
								
								<th>Fecha Inicio</th>
								<th>Fecha Fin</th>

								<th>Ventas</th>
								<th>Gastos</th>
								<th>Diferiencia (ventas - gastos)</th>
								
								

							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>`
                );
    
				
				let diferencia = (data.ventasVS-data.gastosVS);
				
                
                    $("#datatable").find("tbody").append(`
                        <tr>
                           
							<td >`+fechaInicio+`</td>
							<td>`+ fechaFin+`</td>
							<td>`+ data.ventasVS.sumaVentas+`</td>
                            <td>`+ data.gastosVS.sumaGastos+`</td>
 							
							<td>`+diferencia+`</td>
                         
                        </tr>`
                    );
					
					
				//totalPagar += parseFloat(o.TotalVenta);
    
                
    
    
                $("#datatable").DataTable(),$(".dataTables_length select").addClass("form-select form-select-sm");
				
				
				
				
			//$("#totales3").html('<h1> Total reporte $<span>' + dollarUSLocale.format(totalPagar) + '</span> MXN.</h1>');	
				
				
			}else{
				
				$("#despliegueTabla").html(data.mensaje);
				
				
				
			}
				

		})
		.fail();
		
		*********/
  }
}

// function PDF() {
//   let selectSucursal = $("#selectSucursal").val();
//   let selectCaja = $("#selectCaja").val();
//   let selectTipoDePago = $("#selectTipoDePago").val();
//   let selectFactura = $("#selectFactura").val();
//   let selectClientes = $("#selectClientes").val();
//   let fechaInicio = $("#rFechaInicio").val();
//   let fechaFin = $("#rFechaFin").val();

//   $.ajax({
//     url: base_url() + "app/Reportes/pdf",
//     type: "POST",
//     data: {
//       sucursal: selectSucursal,
//       caja: selectCaja,
//       factura: selectFactura,
//       fechaI: fechaInicio,
//       fechaF: fechaFin,
//       clientes: selectClientes,
//       tipoP: selectTipoDePago
//     },
//     dataType: "json",
//   })
//     .done((data) => {
//       console.log("Hola ........xasolp");
//       window.open(base_url() + "app/Reportes/pdf/" + response.data, "_blank");
//     })
//     .fail((e) => {
//       console.log(e);
// 		//window.open(base_url() + "app/Reportes/pdf/", "_blank");
//     });
// }

function PDF() {
  let data = arrayObj;
  console.log(data);

  axios.post(base_url() + "app/Reportes/pdf", { data })
    .then(({ data }) => {
      if (data.resultado) {
        console.log('mpdf generado');
        toastr["success"](data.mensaje);
        openPDFWindow(base_url() + 'daniw/Pedidos/pdf/' + data.path);
      } else {
        console.log('mpdf ERROR');
        toastr["warning"](data.mensaje);
      }
    })
    .catch((error) => {
      console.log(error);
      toastr["error"]("Error al generar el PDF");
    });
}

