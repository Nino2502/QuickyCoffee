$(document).ready(function() {
    mostrarProgramas()
    $("#rangoFecha").hide()
    
    $('#customCheckThis').on('change', function() {
      
        if ($(this).is(':checked')) {

            estatusAplica = true
            console.log("El checkbox está marcado", estatusAplica);
            $("#rangoFecha").show()
        }
        else {
            estatusAplica = false
            console.log("El checkbox no está marcado" , estatusAplica);
            $("#rangoFecha").hide()
        }
    });

     
   


    $("#resetHoraInicio").click(function() {
        $("#horaInicio").val("");
      });

      // Restablecer campo de Hora de Fin
      $("#resetHoraFin").click(function() {
        $("#horaFin").val("");
      });
});
let estatusAplicaEdit;
let estatusAplica;
let idProgramaEDIT;

function registrarNuevopuntos(){
    $("#modalGestiopuntosADD").modal("show");
    restablecerPuntos()
}

function registrarPrograma(){
   //$("#registrarPrograma").attr("disabled", "disabled")
    restablecerPuntos()
  
   let  $nombrePrograma     = $("#nombrePrograma").val();
   let  $valorPunto         = $("#valorPrograma").val();
   let  $porcentajePrograma = $("#porcentajePrograma").val();

   let $dateStart          = $("#startDate").val();
   let $dateEnd            = $("#endDate").val();



   let $horaInicio         = $("#horaInicio").val()
   let $horaFin            = $("#horaFin").val()

    let bandera  = true;
    let formbody = {};

    if($nombrePrograma == ""){
        $('#errornombrePrograma').show();
        $('#errornombrePrograma').html("Debes ingresar un nombre para el programa");
        $('#nombrePrograma').focus();
        bandera = false;
    }
    if($valorPunto == "" || $valorPunto <= 0){
        $('#errorvalorPrograma').show();
        $('#errorvalorPrograma').html("Debes ingresar un valor y ser mayor 0 para el programa");
        $('#valorPrograma').focus();	
        bandera = false;
    }
    if($porcentajePrograma == "" || $porcentajePrograma <= 0){
        $('#errorporcentajePrograma').show();
        $('#errorporcentajePrograma').html("Debes ingresar un porcentaje y ser mayor 0 para el programa");
        $('#porcentajePrograma').focus();
        bandera = false;	
    }

    estatusAplica == undefined ? estatusAplica = false : estatusAplica;


    const valores = [
        $("#startDate").val(),
        $("#endDate").val(),
        $("#horaInicio").val(),
        $("#horaFin").val()
    ];

    const esValido = verificarValor(valores);
    
    if(estatusAplica == true){

        if($dateStart == ""){
            $('#errorstartDate').show();
            $('#errorstartDate').html("Debes ingresar una fecha de inicio para el programa.");
            $('#startDate').focus();
            bandera = false;
        }
        if($dateEnd == ""){
            $('#errorendDate').show();
            $('#errorendDate').html("Debes ingresar una fecha de fin para el programa.");
            $('#endDate').focus();
            bandera = false;
        }
       
    }




    if(bandera){
      
        if(estatusAplica == true &&  esValido == true){
            let fechaInicioCompleta = new Date($dateStart + " " + $horaInicio);
            let fechaFinCompleta = new Date($dateEnd + " " + $horaFin);
            
            if (fechaInicioCompleta > fechaFinCompleta) {
                bandera = false
                $("#errorFechas").show();
                $("#errorFechas").html("Error: Las fechas/horas no son correctas");
                $("#registrarPrograma").removeAttr("disabled");
        
            } else {
                bandera = true
                console.log("La fecha y hora de inicio no es mayor que la fecha y hora de fin, IT'S OK");
                $("#errorFechas").hide();

                formbody = {
                    restrinccion: 1,
                    nombrePrograma: ($nombrePrograma).trim(),
                    valorPunto: $valorPunto,
                    porcentajePrograma: $porcentajePrograma,
                    dateStart: $horaInicio == ''  ? $dateStart : $dateStart + " " + $horaInicio,
                    dateEnd:   $horaFin    == ''  ? $dateEnd   : $dateEnd + " " + $horaFin,
                }
                if(bandera){
                    addProgram(formbody)
                }else{
                    $("#registrarPrograma").removeAttr("disabled");
                }
               
            }      
        }
        else if(estatusAplica == false){
           console.log("no aplica restriccion")
            formbody = {
                nombrePrograma: $nombrePrograma,
                valorPunto: $valorPunto,
                porcentajePrograma: $porcentajePrograma,
                dateStart: null,
                dateEnd: null,
            }
            addProgram(formbody)
            
        }else{
            $("#registrarPrograma").removeAttr("disabled");
            $("#errorFechas").show();
            $("#errorFechas").html("La fecha y hora no pueden ir vacias");
        }  
       
        
   

    
  
    
        
    }else{
        $("#registrarPrograma").removeAttr("disabled"); 
    }
}

function addProgram(formbody){
    $.ajax({
        url: base_url() + "app/Aldair/ProgramaLealtad/registrarPrograma",
        dataType: "JSON",
        type: "POST",
        data: formbody
    })
    .done((data)=>{
        console.log("insertar programa" ,data);

        if(data.resultado){
            toastr["success"](data.mensaje);
            $("#modalGestiopuntosADD").modal("hide");
            location.reload();
        }else{
            toastr["error"](data.mensaje);
            $("#registrarPrograma").attr("disabled", false)
        }
    })
    .fail();

}

function restablecerPuntos(){
    $("#errornombrePrograma").hide()
    $("#errorvalorPrograma").hide()
    $("#errorporcentajePrograma").hide()
    $("#errorstartDate").hide()
    $("#errorendDate").hide()
 

    // $("#startDate").val("");
    // $("#endDate").val("");
}

function mostrarProgramas(){
    
    $.ajax({
        url: base_url() + "app/Aldair/ProgramaLealtad/getProgramas",
        dataType: "JSON",
        type: "GET",
  
    })
    .done((data) => {

     
            if (data.resultado) {
             
                $("#tablaProgramas").html(`
                <table id="tablaCoti" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th style="text-align: center">ID</th>
                            <th style="text-align: center">Programa</th>
                            <th style="text-align: center">Estatus</th>
                            <th style="text-align: center">Valor</th>
                            <th style="text-align: center">porcentaje</th>
                            <th style="text-align: center">Fecha inicio</th>
                            <th style="text-align: center">Fecha fin</th>
                            <th style="text-align: center">Editar</th>
                            <th style="text-align: center">Eliminar</th>

                           
                           
                        </tr>
                    </thead>
                    <tbody>
                
                    </tbody>
                </table>`);
                $.each(data.programas, function (i, o) {
                    
                  

					$("#tablaCoti")
						.find("tbody")
						.append(
							`
                     <tr id="tr-` + o.idControl +`">
                        <td style="text-align: center">` + o.idControl +`</td>
                        <td style="text-align: center">` + o.nombreControl + `</td>
                        <td align="center"><a href="#" onclick="cambiaEstatus('`+o.idControl+`','`+o.estatus+`')"><i id="icono-`+o.idControl+`" class="fas fa-toggle-`+(o.estatus == 1 ? 'on':'off')+` fa-2x"></i></a></td>
                        <td style="text-align: center">` + '$ '+o.valor + ' MXN'+ `</td> 
                        <td style="text-align: center">`  + o.porcentaje + ` % </td>
                        <td style="text-align: center">`  + o.fecha_inicio+ `</td> 
                        <td style="text-align: center">`  + o.fecha_fin+ `</td>
                        <td align="center"><a href="#" onclick="editarPrograma('`+o.idControl+`')"><i class="fas fa-pencil fa-2x"></i></a></td>
                        <td align="center"><a href="#" onclick="eliminarPrograma('`+o.idControl+`','`+o.nombreControl+`','`+o.Orden+`')"><i class="fas fa-trash fa-2x"></i></a></td>
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

const eliminarPrograma = async(idControl, nombreControl,Orden)=>{
    if(Orden == 1){
        toastr["error"]("No se puede eliminar el programa de puntos por defecto");
    }else{
        idProgramaEDIT = idControl
        $("#borrarModalPrograma").modal("show")
        $("#nombreProgramaBorrar").html(`¿Está seguro de eliminar el programa?: ` +  nombreControl)


        $("#btnBorrarPrograma").click((e)=>{
            e.preventDefault();
            $("#btnBorrarPrograma").attr("disabled", true);
            formbody = {
                idControl: idProgramaEDIT
            }
           
            $.ajax({
                url: base_url() + "app/Aldair/ProgramaLealtad/borrarPrograma",
                dataType: "JSON",
                type: "POST",
                data: formbody
            })
            .done((data)=>{
             
        
                if(data.resultado){
                    toastr["success"](data.mensaje);
                   
                    location.reload();
                }else{
                    toastr["error"](data.mensaje);
                    $("#btnBorrarPrograma").attr("disabled", false)
                }
            })
            .fail();
          
            
         } );
    }

    
 
}


const editarPrograma = async(idControl)=>{
    idProgramaEDIT = idControl
  

   $("#modificarPrograma").modal("show")
   formbody = {
        idPrograma: idControl
    }
  await $.ajax({
        url: base_url() + "app/Aldair/ProgramaLealtad/consultarPrograma",
        dataType: "JSON",
        type: "POST",
        data: formbody
    })
    .done((data)=>{
        console.log("soy la data de editarPrograma", data)
        
            $("#modalEditar").html(`
            
            
                            <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Nombre del programa</label>
                                <input type="text" class="form-control" id="nombreProgramaEDIT" value="${data.nombreControl}" placeholder="Ingrese el nombre del programa">
                                <small class="text-danger" id="errornombrePrograma" style="display: none;"></small>
                            </div>

                            <div class="form-group col-md-6">
                            
                                    <label for="inputPassword4">Valor</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" step="0.1" class="form-control" value="${data.valor}" id="valorProgramaEDIT">
                                        
                                    </div>
                                    <small class="text-danger" id="errorvalorPrograma" style="display: none;"></small>
                            </div>

                            <div class="form-group col-md-6">
                            
                                    <label for="inputPassword4">Porcentaje</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        <input type="text" class="form-control" value="${data.porcentaje}" id="porcentajeProgramaEDIT">
                                        
                                    </div>
                                    <small class="text-danger" id="errorporcentajePrograma" style="display: none;"></small>
                            </div>
                        </div>


                        <div class="mb-4">
                            <div class="custom-control custom-checkbox mb-4">
                                <input type="checkbox" class="custom-control-input" id="EditcustomCheckThis">
                                <label class="custom-control-label" for="EditcustomCheckThis">Aplica restricción fecha</label>
                            </div>
                        </div>
                        
                   
            
            `)

            $("#rangoFechaEditar").hide()
            
          

            if(data.restrinccion == 1){
                estatusAplicaEdit = true;
                $("#rangoFechaEditar").show();
                $("#EditcustomCheckThis").prop("checked", true);
            
                let fechaHoraInicio = data.restrinccion == 1 ? new Date(data.fecha_inicio) : null;
                let fechaInicio = fechaHoraInicio != null ? fechaHoraInicio.toISOString().substring(0, 10) : '';
                let horaInicio = fechaHoraInicio != null ? formatTime(fechaHoraInicio) : '';
            
                let fechaHoraFin = data.restrinccion == 1 ? new Date(data.fecha_fin) : null;
                let fechaFin = fechaHoraFin != null ? fechaHoraFin.toISOString().substring(0, 10) : '';
                let horaFin = fechaHoraFin != null ? formatTime(fechaHoraFin) : '';
            
                console.log("data.fecha_inicio", data.fecha_inicio);
                console.log("fechaInicio", fechaInicio);
                console.log("horaInicio", horaInicio);
                console.log("data.fecha_fin", data.fecha_fin);
                console.log("fechaFin", fechaFin);
                console.log("horaFin", horaFin);
            
                $("#startDateEDIT").val(fechaInicio);
                $("#endDateEDIT").val(fechaFin);
                $("#horaInicioEDIT").val(horaInicio);
                $("#horaFinEDIT").val(horaFin);
                

            }else{
                estatusAplicaEdit = false
                $("#startDateEDIT").val("")
                $("#endDateEDIT").val("")
                $("#horaInicioEDIT").val("")
                $("#horaFinEDIT").val("")
                
            }

            $('#EditcustomCheckThis').on('change', function() {
               
                if ($(this).is(':checked')) {
                    estatusAplicaEdit = true
                    //console.log("El checkbox está marcado", estatus);
                    $("#rangoFechaEditar").show()


                }
                else {
                    estatusAplicaEdit = false
                    //console.log("El checkbox no está marcado" , estatus);
                    $("#rangoFechaEditar").hide()
                }
            });

            $("#resetHoraInicio").click(function() {
                $("#horaInicio").val("");
            });
        
              
            $("#resetHoraFin").click(function() {
                $("#horaFin").val("");
            });    
          


     
    })
    .fail();
   
}

function formatTime(date) {
    return ('0' + date.getHours()).slice(-2) + ':' +
           ('0' + date.getMinutes()).slice(-2) + ':' +
           ('0' + date.getSeconds()).slice(-2);
}

const updatePrograma = async()=> {
        $("#updatePrograma").attr("disabled", true);

        let formbody = {};
        let idPrograma      = idProgramaEDIT
        let $nombrePrograma = $("#nombreProgramaEDIT").val()
        let $valorPunto     = $("#valorProgramaEDIT").val()
        let $porcentajePrograma = $("#porcentajeProgramaEDIT").val()
        let $dateStart      = $("#startDateEDIT").val()
        let $dateEnd        = $("#endDateEDIT").val()
        let $horaInicio     = $("#horaInicioEDIT").val()
        let $horaFin        = $("#horaFinEDIT").val()

        let bandera = false;
        $("#erroFechasEdit").hide();

        const valores = [
            $("#startDateEDIT").val(),
            $("#endDateEDIT").val(),
            $("#horaInicioEDIT").val(),
            $("#horaFinEDIT").val()
        ];

        const esValido = verificarValor(valores);


        if(estatusAplicaEdit == true &&  esValido == true){
      
            let fechaInicioCompleta = new Date($dateStart + " " + $horaInicio);
            let fechaFinCompleta = new Date($dateEnd + " " + $horaFin);
            
            if (fechaInicioCompleta > fechaFinCompleta) {
                bandera = false
                $("#erroFechasEdit").show();
                $("#erroFechasEdit").html("Error: Las fechas/horas no son correctas");

            } else {
                bandera = true
                console.log("La fecha y hora de inicio no es mayor que la fecha y hora de fin");
                $("#erroFechasEdit").hide();
            }
                formbody = {
                    idControl: idPrograma,
                    restrinccion: 1,
                    nombrePrograma: ($nombrePrograma).trim(),
                    valorPunto: $valorPunto,
                    porcentajePrograma: $porcentajePrograma,
                    dateStart: $horaInicio == ''  ? $dateStart : $dateStart + " " + $horaInicio,
                    dateEnd:   $horaFin    == ''  ? $dateEnd   : $dateEnd + " " + $horaFin,
                }
                if(bandera){
                    execUpdateprograma(formbody)
                }else{
                    $("#updatePrograma").attr("disabled", false);
                }
                
        }else if(estatusAplicaEdit == false){
               
                formbody = {
                        idControl: idPrograma,
                        restrinccion: 0,
                        nombrePrograma: ($nombrePrograma).trim(),
                        valorPunto: $valorPunto,
                        porcentajePrograma: $porcentajePrograma,
                        dateStart: null,
                        dateEnd: null,
                    }    
                
                    execUpdateprograma(formbody)
                
        }else{
            $("#erroFechasEdit").show();
            $("#erroFechasEdit").html("La fecha y hora no pueden ir vacias");
        }  
}

const execUpdateprograma = async (formbody) => {
   

    $.ajax({
        url: base_url() + "app/Aldair/ProgramaLealtad/updatePrograma",
        dataType: "JSON",
        type: "POST",
        data: formbody
    })
    .done((data)=>{
       
        if(data.resultado){ 
            toastr["success"](data.mensaje);
            $("#updatePrograma").attr("disabled", false);
            location.reload();
        }else{
            toastr["error"](data.mensaje);
            $("#updatePrograma").attr("disabled", false);
            location.reload();
        }
    })
    .fail();
}

function verificarValor(valores) {
    let respuesta = true; 
    for (let i = 0; i < valores.length; i++) {
        const valor = valores[i];
        if (typeof valor === "undefined") {
            //console.log("El valor en la posición " + i + " está indefinido");
            respuesta = false;
        } else if (valor === null) {
           // console.log("El valor en la posición " + i + " es nulo");
            respuesta = false;
        } else if (valor === "") {
            //console.log("El valor en la posición " + i + " es una cadena vacía");
            respuesta = false;
        } else {
            //console.log("El valor en la posición " + i + " tiene un valor:", valor);
        }
    }
    return respuesta;
}


function cambiaEstatus(idControl, estatus){

    if (estatus == 1) {
        toastr["success"]("Status: activo");
    }else if(estatus == 0){
        toastr["success"]("Status: inactivo");
    }else{

    }
    toastr["info"]("No se puede cambiar el estatus del programa de puntos, este proceso se realiza automaticamente");
    // console.log(idControl)
    // formbody = {
    //     idControl: idControl
    // }
    // $.ajax({
    //     url: base_url() + "app/Aldair/ProgramaLealtad/habilitarPrograma",
    //     dataType: "JSON",
    //     type: "POST",
    //     data: formbody
    // })
    // .done((data)=>{
        

    //     if(data.resultado){
    //         toastr["success"](data.mensaje);
    //         location.reload();
    //     }else{
    //         toastr["error"](data.mensaje);
    //         location.reload();
    //     }
    // })
    // .fail();
}