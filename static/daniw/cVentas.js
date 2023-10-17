$(document).ready(() => { 	
    listaVentas();
    nombre();
    
});



function nombre() {
    var params = new URLSearchParams(window.location.search);
    var nombre = params.get('nombre');
    var apellidos = params.get('apellidos');
    
    $("#title").find('h3').html("<strong>" + nombre + " " + apellidos + "</strong>");
}

function listaVentas() {
    var params = new URLSearchParams(window.location.search);
    var id = params.get('id');
    
    axios(base_url() + "daniw/CVentas/getVentas/"+ id).then(({ data: Response }) => {
        
        if (Response.resultado == true) {

            $("#despliegueTabla").html(`
            <table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Token</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th style="text-align: center">Detalle venta</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>`);
            $.each(Response.Ventas, function (i, o) {
                
                $("#datatable").find("tbody").append(
                    `<tr id="tr-` + o.idU + `">
                        <td>` + o.idVenta + `</td>
                        <td>` + o.tokenVenta + `</td>
                        <td>` + o.FechaVentaCierre + `</td>
                        <td>` + o.TotalVenta + `</td>
                        <td align="center">
                            <a href="#" onclick="VistaPrevia(` + o.idVenta + `,'` + o.tokenVenta + `','` + o.FechaVentaCierre + `')">
                                <i class="fa-solid fa-eye fa-2x"></i>
                            </a>
                        </td>
                    </tr>`
                );
            });
            $("#datatable").DataTable(),
                $(".dataTables_length select").addClass("form-select form-select-sm");
        } else {
            $("#despliegueTabla").html(Response.mensaje);
        }
    })
    .catch((error) => {
        console.log(error, "Error al cargar el controlador ");
    });
    
}

function VistaPrevia(id, tok){
    const idVenta = id;
    $("#detalleVenta").modal("show");
    $("#contenidoDet").html("");
    $("#nombreModal").html("Detalle de la compra<strong>" +"</strong>");

    axios.post(base_url() + "daniw/CVentas/verDetalle", {idVenta: idVenta})
	.then(({ data }) => {
		if (data.resultado) {
			
            $.each(data.Detalle, function (i, o) {
                const subTotal = o.Cantidad*o.PrecioUnitario;
                $("#contenidoDet").append(
                    `<div class="card-body">
                                                    
                        <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                            <a href="#">
                                <img alt="Profile Picture" src="`+ (o.image_url ? base_url() + "static/imgServicios/" + o.image_url : base_url() + "static/publico/img/sdi_logo.png") +`" 
                                    class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                            </a>
                            <div class="pl-3">
                                <a href="#">
                                    <p class="font-weight-medium mb-0" id="producto"><strong>Producto: </strong>`+ (o.nombreS ? o.nombreS : "Venta rápida") +`</p>
                                    <p class="font-weight-medium mb-0" id="producto">Detalle: `+ (o.ProductoComentario ? o.ProductoComentario : "No hay detalle para mostrar")+`</p>
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

function Clientes() {
    $(location).attr("href",base_url()+"daniw/Clientes/") 
}


function cambiaEstatus(id) {
	const idUser = id;
	// const estatus = estatus;

	// let accion = "CambiarEstatus";

	axios.post(base_url() + "daniw/Clientes/cambiaEstatus", {idU: idUser})
	.then(({ data }) => {
		if (data.resultado) {
			toastr["success"](data.mensaje);
			if ($("#icono-" + id).hasClass("fa-toggle-on")) {
				$("#icono-" + id).removeClass("fa-toggle-on");
				$("#icono-" + id).addClass("fa-toggle-off");
			} else {
				$("#icono-" + id).removeClass("fa-toggle-off");
				$("#icono-" + id).addClass("fa-toggle-on");
			}
			listaClientes();
		} else {
			toastr["warning"](data.mensaje);
		}
	})
	.catch((error) => {
		console.log(error);
	});
}