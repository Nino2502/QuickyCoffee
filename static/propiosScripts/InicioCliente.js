$(document).ready(() => {
    $("#datatable").find("tbody").html("");
    listaCompras();
  });
  
  function listaCompras() {
    
    axios(base_url() + "daniw/Home/getCompras")
     .then(({data})=>{

        
        if (data.resultado) {
  
          $("#despliegueTabla").html(`
          <table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <thead>
                  <tr>
                      <th>id</th>
                      <th>RFC</th>
                      <th>Token</th>
                      <th>Sucursal</th>
                      <th>Fecha</th>
                      
                      <th style="text-align: center">Ver/Facturar</th>
                      <th style="text-align: center">Estado</th>
					  <th style="text-align: center">Estatus</th>
                  </tr>
              </thead>
              <tbody></tbody>
          </table>`);
          $.each(data.Compras, function (i, o) {
              
            $("#datatable").find("tbody").append(
              `<tr id="tr-` + o.idU + `">
                <td>` + o.idVenta + `</td>
                <td>` + (o.idFiscales != null ? o.idFiscales : "n/a" ) + `</td>
                <td>` + o.tokenVenta + `</td>
                <td>` + o.nombreSuc + `</td> 
                <td>` + o.FechaVentaG + `</td>
                <td align="center">
                  <!--<a href="#" class="mr-4" onclick="VistaPrevia(`+ o.idVenta +`)" title="Ver detalle"> 
                    <i class="fa-solid fa-eye fa-2x"></i>
                  </a>-->
                  <a href="`+base_url()+`daniw/home/imprimir/`+o.idVenta+`"  title="Facturar" >
                    <i class="fas fa-file-invoice fa-2x"></i>
                  </a>
                </td>
                <td align="center">
                  <a href="#" onclick="Check(` + o.idVenta + `,'` + o.tokenVenta + `','` + o.estatus + `')" title="`+o.estatus+`">
                    <i class="fas fa-check-square fa-2x" style="color: `+o.color+`;"></i>   
                  </a>
                </td>
				<td align="center"> ` + o.estatus + `</td>
				
				</td>
              </tr>`
            );
          });
            
			
		$("#datatable").DataTable(),$(".dataTables_length select").addClass("form-select form-select-sm");	
			
        } else {
            $("#despliegueTabla").html(data.mensaje);
        }
    })
      .catch(error=>{
        console.log(error);
    })
  }


function validaFactura(venta){
	
	
	$.ajax({
		url:base_url()+'public/Facturacion/validaVenta',
		dataType:"JSON",
		type: "POST",
		data:{
			idVenta:venta
		}
	})
	.done((data)=>{
		
		if(data.resultado){
			
			
			
			//console.log(data.valor[0].factura);
			if(data.valor[0].Factura == null){
				
				
				window.open(base_url()+"public/Facturacion/", '_blank');
				
				
				
			}else{
				
				toastr["success"]("no es nulo ya hay factura");
			}
			
			
			
			
		}else{
			
			
			toastr["success"](data.mensaje);
			
		}
		
		
		
		
		
		
	})
	.fail();
	
	
	
}

//target="_blank"

  
  function VistaPrevia(id) {
    const idVenta = id;
    $("#detalleVenta").modal("show");
    $("#contenidoDet").html("");
  
    axios.post(base_url() + "daniw/Home/getDetalle", {idVenta: idVenta})
      .then(({ data }) => {
          if (data.resultado) {
              
        $.each(data.Detalle, function (i, o) {
          const subTotal = o.Cantidad*o.PrecioUnitario;
          $("#contenidoDet").append(
            `<div class="card-body">
                                            
              <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                <a href="#">
                  <img alt="Profile Picture" src="`+base_url() + "static/imgServicios/" + o.image_url+`"
                      class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                </a>
                <div class="pl-3">
                  <a href="#">
                    <p class="font-weight-medium mb-0" id="producto"><strong>Producto: </strong>`+ o.nombreS +`</p>
                    <p class="text-muted mb-0 text-small">Sucursal: `+ o.nombreSuc +`</p>
                    <p class="text-muted mb-0 text-small">Cantidad: `+ o.Cantidad +`</p>
                    <p class="text-muted mb-0 text-small">Subtotal: `+ subTotal +`</p>
                  </a>
                </div>
              </div>
  
            </div>`
          );
        });
  
        toastr["success"](data.mensaje);
          } else {
              toastr["warning"](data.mensaje);
          }
      })
      .catch((error) => {
          console.log(error);
      });
  
  }