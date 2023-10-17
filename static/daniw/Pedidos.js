$(document).ready(() => {

  $("#datatable").find("tbody").html("");

  listaVentas();
});

function listaVentas() {
  
  axios(base_url() + "daniw/Pedidos/getPedidos/").then(({ data: Response }) => {
      
      if (Response.resultado == true) {

          $("#despliegueTabla").html(`
          <table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <thead>
                  <tr>
                    <th style="text-align: center">Pedido</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    
                    <th style="text-align: center">Detalle venta</th>
                    <th style="text-align: center">Estado</th>
                  </tr>
              </thead>
              <tbody></tbody>
          </table>`);
          $.each(Response.Pedidos, function (i, o) {
              
              $("#datatable").find("tbody").append(
                  `<tr id="tr-` + o.idU + `">
                      <td align="center">` + o.idVenta + `</td>
                      <td>` + o.nombreU+ " " + o.apellidos + `</td>
                      <td>` + o.FechaVentaCierre + `</td>
                      
                      <td align="center">
                        <a href="#" onclick="VistaPrevia(` + o.idVenta + `,'` + o.tokenVenta + `','` + o.FechaVentaCierre + `','` + o.TotalVenta + `')">
                          <i class="fa-solid fa-eye fa-2x"></i>
                        </a>
                      </td>
                      <td align="center">
                        <a href="#" onclick="Check(` + o.idVenta + `,'` + o.tokenVenta + `','` + o.estatus + `')" title="`+o.estatus+`" title="`+o.estatus+`">
                          <i class="fas fa-check-square fa-2x" style="color: `+o.color+`;"></i>   
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

function Check(id, token, estatus) {
  listaEstatus(estatus);
  $("#btnEnviar").html("Confirmar");
  $("#ModalCheck").modal("show");
  $("#nombreModal").html("Estado del pedido: " + estatus);
  $("#idVenta").val(id);
  $("#token").val(token);
  $("#token").attr("disabled", "disabled");
}

// Input and select 
function desabilitaCampos(){ 
  $("#btnEnviar, #nombreSecciones, #des, #selectmod, #iconSecciones, #urlSecciones, #ordenSecciones").attr("disabled", "disabled");
}

// Input and select 
function habilitaCampos(){
  $("#btnEnviar, #nombreSecciones, #des, #selectmod, #iconSecciones, #urlSecciones, #ordenSecciones").removeAttr("disabled"); 
}

function conPedidos() { 
  
  //quitaErroresCamposVacios();
  desabilitaCampos();
  

  let idV = $("#idVenta").val();

  let estatus = $("#estatus").val(); 
  let token = $("#token").val();
  let goValidation = true;

  if ("" == token.trim()) {
    $("#errorToken").show();
    $("#errorToken").html("Debes ingresar token");
    $("#token").focus();
    goValidation = false;
    habilitaCampos();
  }

  if (goValidation) {
    // console.log(token);
    console.log(estatus);
    axios.post(base_url() + "daniw/Pedidos/updatePedidos", {
      tokenVenta  : token,
      estatus     : estatus
    })
    .then(({ data }) => {
      if (data.resultado) {
        toastr["success"](data.mensaje);
        $("#token").val("");
        $("#ModalCheck").modal("hide");

          notificacionStatus(estatus,idV)
        listaVentas();
        habilitaCampos();

        // Elimina la opción seleccionada del select
        // $("#divEstatus option:selected").remove();   
      } else {
        toastr["warning"](data.mensaje);
        $("#ModalCheck").modal("hide");
        habilitaCampos();
      }
    })
    .catch((error) => {
      console.log(error);
      $("#ModalCheck").modal("hide");
    });
  } else {
    console.log("Faltan datos dentro del formulario");
  }
} 
//12 may 2023
function notificacionStatus(estatus,idV){
 
  formbody =  {
    estatus: estatus,
    idVenta: idV
  }

  $.ajax({
      url: base_url() + "app/Notificacion/NotificacionExpo/enviarNotificacion",
      dataType: "JSON",
      type: "POST",
      data: formbody
  })
  .done((data) => {
          if (data.resultado) {
            toastr["success"](data.Mensaje);
            console.log("Entramos xd")
          }else{
            toastr["warning"](data.Mensaje);
            console.log("fallatamos")

          }
  })
  .fail();
}


function listaEstatus(estatus){
  //console.log(estatus);
  $.ajax({
    "url":base_url()+"daniw/Pedidos/getEstatus",
    "dataType":"JSON"
  })
  .done((data)=>{ 

    $("#estatus").html("");

    if(data.resultado){

      $("#divEstatus").find("select").append(`<option value="Selecciona">Selecciona un estatus</option>`);

      $.each(data.Estatus, function(i,o){
        
        $("#divEstatus").find("select").append(
          
          `<option value="` + o.id + `"` + (o.estatus === estatus ? "selected" : "") +`>` + o.estatus +`</option>`  
        );
          
      });

      //$("#estatus option[value='" + estatus + "']").remove();
    }else{
      $("#divEstatus").find("select").append(`<option value="Selecciona">No existen estatus</option>`);
    }
  })
  .fail();
}

function VistaPrevia(id, token, fech, total) { 
  const idVenta = id;

  $("#detalleVenta").modal("show");
  $('#titleDetalle').html("Detalle del pedido con token:<br><strong>" + token + "</strong>");
  $("#contenidoDet").html("");

  axios.post(base_url() + "daniw/Pedidos/getDetalle", {idVenta: idVenta})
	.then(({ data }) => {
		if (data.resultado) {
			
      $.each(data.Detalle, function (i, o) {
        const subTotal = o.Cantidad*o.PrecioUnitario;
        $("#contenidoDet").append(
          `<div class="card-body">
            <input id="total" value="`+total+`" hidden></input>                             
            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
              <a href="#">
                <img alt="Profile Picture" src="`+ (o.image_url ? base_url() + "static/imgServicios/" + o.image_url : base_url() + "static/publico/img/sdi_logo.png") +`"
                    class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
              </a>
              <div class="pl-3">
                  <p class="font-weight-medium mb-0" id="producto"><strong>Producto: </strong>`+ (o.nombreS ? o.nombreS : "Venta rápida") +`</p>
                  <p class="font-weight-medium mb-0 normal" id="detalle">Detalle: `+ (o.ProductoComentario ? o.ProductoComentario : "No hay detalle para mostrar")+`</p>
                  <p class="text-muted mb-0 text-small normal" id="cantidad">Cantidad: `+ o.Cantidad +`</p>
                  <p class="text-muted mb-0 text-small normal" id="subtotal">Subtotal: `+ subTotal +`</p>
                  <p class="text-muted mb-0 text-small normal" id="sucursal">Sucursal: `+ o.nombreSuc +`</p>
               
              </div>
            </div>

          </div>`
        );
        $("#buttonModal").html(`
          
          <button type="button" class="btn btn-info" onclick="pdf(` + o.idVenta + `,'` + total + `')">PDF <i class="far fa-file-alt"></i></button> 
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        `);
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

// function quitaErroresCamposVacios() {
//   $("#errornombreSecciones").hide();
//   $("#errordescripcionSecciones").hide();
// }

function listaHistorial() {
  
  axios(base_url() + "daniw/Pedidos/getHistorial")
    .then(({ data: Response }) => {
      
      if (Response.resultado == true) {

        $("#despliegueTabla2").html(`
        <div class="card">             
          <div class="card-body">
            <table id="datatable2" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                      <th style="text-align: center">Pedido</th>
                      <th>Cliente</th>
                      <th>Fecha</th>
                      <th style="text-align: center">Detalle venta</th>
                      <th style="text-align: center">Estado</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
          </div>
        </div>`);
        $.each(Response.Historial, function (i, o) {
            
          $("#datatable2").find("tbody").append(
            `<tr id="tr-` + o.idU + `">
              <td align="center">` + o.idVenta + `</td>
              <td>` + o.nombreU+ " " + o.apellidos + `</td>
              <td>` + o.FechaVentaCierre + `</td>
              
              <td align="center">
                <a href="#" onclick="VistaPrevia(` + o.idVenta + `,'` + o.tokenVenta + `','` + o.FechaVentaCierre + `','` + o.TotalVenta + `')">
                  <i class="fa-solid fa-eye fa-2x"></i>
                </a>
              </td>
              <td align="center">
                <a href="#" title="`+o.estatus+`"> 
                  <i class="fas fa-check-square fa-2x" style="color: `+o.color+`;"></i>   
                </a>
              </td> 
            </tr>`
          );
        });
          $("#datatable2").DataTable(),
          $(".dataTables_length select").addClass("form-select form-select-sm");
      } else {
          $("#despliegueTabla2").html(Response.mensaje);
      }
  })
  .catch((error) => {
      console.log(error, "Error al cargar el controlador ");
  });
  
}

function pdf(id) {
  $id = id;

  window.open(base_url() + 'daniw/Pedidos/pdf/' + $id, '_blank');
}


// function pdf(id, total) {
//   let data = {
//     id: id,
//     total: total
//   };
//   console.log(data);

//   axios.post(base_url() + "daniw/Pedidos/pdf/", data)
// }