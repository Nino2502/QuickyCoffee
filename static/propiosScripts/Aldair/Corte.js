$(document).ready(function() { 

        // Crear una instancia del objeto Date
      var fechaActual = new Date();

      // Obtener los componentes de la fecha actual
      var year = fechaActual.getFullYear();
      var mes = fechaActual.getMonth() + 1; // Agregar 1 al mes, ya que los meses empiezan en 0
      var dia = fechaActual.getDate();

      // Agregar ceros a la izquierda si es necesario para tener dos dígitos
      mes = mes < 10 ? "0" + mes : mes;
      dia = dia < 10 ? "0" + dia : dia;

      // Crear la cadena de texto con el formato deseado
      var fechaConsulta = year + "-" + mes + "-" + dia;


  $("#corteFecha").val(fechaConsulta).attr("disabled","disabled");

  $("#despliegueTabla").hide()
  $("#btnCorteStart").attr("disabled", "disabled");

  $.ajax({
    url: base_url() + "app/Aldair/Corte/CajaActual",
    dataType: "JSON",
    type: "GET",
  })
  .done((data)=>{

      if(data.resultado){
       
        $("#cajaTipo").html("Caja actual: "+ data.TotalCorte.nombreU);
    

      }else{
        $("#cajaTipo").html("Caja actual: NO IDENTIFICADO");
      }
  })
  .fail();
  
  $('.cantidad').change(function() { // Función que se ejecuta cuando cambia el valor de la cantidad
    
    var cantidad = $(this).val(); // Se obtiene el valor de la cantidad ingresada
    if (cantidad < 0) { 
      $(this).val(0); 
      cantidad = 0; 
    }
    var precio_unitario = $(this).closest('tr').find('td:nth-child(2)').text().replace('$', ''); // Se obtiene el precio unitario del producto de la misma fila
    var subtotal = cantidad * precio_unitario; // Se calcula el subtotal multiplicando la cantidad por el precio unitario
    if (cantidad == 0) { // Si la cantidad es 0, se establece el subtotal en 0
      $(this).closest('tr').find('.subtotal').text('$0');
    } else { // Si la cantidad es distinta de 0, se muestra el subtotal calculado
      $(this).closest('tr').find('.subtotal').text('$' + subtotal);
    }
    actualizar_total(); // Se llama a la función para actualizar el total de la tabla

    let totalIncial = $("#total").val();
    if(totalIncial >= 1){
      $("#btnCorteStart").removeAttr("disabled");
    }else{
      $("#btnCorteStart").attr("disabled", "disabled");
    }

  });

  $("#btnRestablecer").click(function() {
    $('.cantidad').val(0);
    $('.subtotal').text('$0');
    $("#btnCorteStart").attr("disabled", "disabled");
    actualizar_total();
    $("#despliegueTabla").hide()
    $("#totalCorte").html("Total corte $");
  });


  $("#datatable").DataTable(),
  $(".dataTables_length select").addClass("form-select form-select-sm");



});


function actualizar_total() {
  var total = 0;
  $('.subtotal').each(function() {
    var subtotal = $(this).text().replace('$', ''); // Eliminar el signo de dólar
    subtotal = parseFloat(subtotal); // Convertir a número decimal
    if (!isNaN(subtotal)) { // Verificar si el subtotal es un número válido
      total += subtotal;
    } else { // Si el subtotal no es un número válido, establecerlo en 0
      $(this).text('$0');
    }
  });
  $('#total').text('$' + total.toFixed(2)); // Redondear el total a 2 decimales
  $("#total").val(total.toFixed(2));
}

function consultaCorte(){
  $("#totalCorte").html("Total corte $");
  let fecha = $("#corteFecha").val();
  console.log("aaaa: ",typeof(fecha));
  $("#btnConsultarCorte").html("Consultado fecha....").attr("disabled", "disabled");


    

      console.log(fecha);
      $.ajax({
        url: base_url() + "app/Aldair/Corte/consultarCorteCaja",
        dataType: "JSON",
        type: "POST",
        data: {
          fechaConsulta:  fecha
        },
      })
      .done((data)=>{
        console.log("data", )

        
       
          if(data.resultado){
            toastr["success"](data.mensaje);
            $("#totalCorte").html("Total corte $" + data.TotalCorte.total_venta_caja +" MXN");
            $("#totalCorte").val(data.TotalCorte.total_venta_caja)  
            $("#btnConsultarCorte").html("Consultar corte").removeAttr("disabled");

            $("#despliegueTabla").show()
       
            console.log("aaaaadaweaweaw ")
          }else{
            toastr["warning"](data.mensaje);

           
         
            if(data.corteExist){
              $("#totalCorte").html("Total corte $" + data.TotalCorte.TotalCAJA);
             
            }else{
              $("#totalCorte").html("Total corte $" )
            }
          
         
            $("#btnConsultarCorte").html("Consultar corte").removeAttr("disabled");
            
            $("#despliegueTabla").hide()
            
            
          }
      })
      .fail();
}


function corte_caja(){
  $("#registrarCorte").removeAttr("disabled");
  let corteCaja = $("#total").val()
  let corteSistema = $("#totalCorte").val();

  console.log("total corte sistema"+  corteSistema);
  $("#modalCorteregistro").modal("show");
 
  $("#corteCaja").val("$" +corteCaja).attr("disabled", "disabled");
  $("#corteSistema").val("$" +corteSistema).attr("disabled", "disabled");



  const fechaActual = new Date();

  let fecha = $("#corteFecha").val();

  
  $("#FechaEmision").val(fecha).attr("disabled", "disabled");

  $("#tituloCorte").html("Registro corte caja: " +fechaActual.toLocaleString("es-ES"));

  $.ajax({
    url: base_url() + "app/Aldair/Corte/CajaActual",
    dataType: "JSON",
    type: "GET",
  })
  .done((data)=>{

      if(data.resultado){
       
        $("#CajaActiva").val(data.TotalCorte.nombreU).attr("disabled", "disabled");
    

      }else{
        $("#CajaActiva").val("CAJA NO SELECCIONADA").attr("disabled", "disabled");
      }
  })
  .fail();

  $("#registrarCorte").click((e)=>{
    e.preventDefault();
      $("#registrarCorte").attr("disabled", "disabled");
        formbody =  {
          TotalCorte: corteCaja,
          TotalCAJA: corteSistema,
          fechaCorteCons: fecha,
        }

        console.log("formbody", formbody);
        $.ajax({
          url: base_url() + "app/Aldair/Corte/registroCaja",
          dataType: "JSON",
          type: "POST",
          data: formbody,
      })
      .done((data)=>{
          
          if(data.resultado){
            toastr["success"](data.mensaje);
            $("#modalCorteregistro").modal("hide");


             setTimeout(function() {
              // Tu función a ejecutar después de 4 segundos
              location.reload(true);
              $("#registrarCorte").removeAttr("disabled");
            }, 2000); 
          }else{
            toastr["warning"](data.mensaje);
            $("#modalCorteregistro").modal("hide");

            $('.cantidad').val(0);
            $('.subtotal').text('$0');
            $("#btnCorteStart").attr("disabled", "disabled");
            actualizar_total();
            $("#despliegueTabla").hide()
          }
        
          
          
      })
      .fail();
     
       
    

        
    });



}