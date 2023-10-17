$(document).ready(() => {

    levantarOrden()
    listaServicios()
    verificaUsuario()
    $("#btnOrden").attr("disabled", true)
    $("#confirmarCliente").val(undefined);

    $("#contrasenaColaborador").attr("disabled", "disabled");
     $("#despliegueTabla3").hide()

     
      $(document).ready(function() {
        // Detectar el evento 'input' en el campo de origen
        $('#telefonoCliente').on('input', function() {
          // Copiar el contenido del campo de origen al campo de destino
          $('#contrasenaColaborador').val($(this).val());
          
        });
      });

    $("#estatusAccount").click((e)=>{
        e.preventDefault();
        

           
            let value = $("#confirmarCliente").val();
           
        

            if(value == "Selecciona" || value == undefined){
            $('#btnOrden').attr('disabled', true);
                toastr["warning"]("Selecciona un cliente para la venta");
            
            } else {
                

                 let idUser = parseInt(value.split(":")[1]);
                  $("#idCliente").val(idUser);
                 toastr["success"]("Cliente seleccionado");
            }
        });

    $("#btnAgregarServicio").click((e)=>{

       


        $("#validaINV").val("0");
        
        e.preventDefault();
		
		 
       
	    $("#errorClienteS").hide();
        $("#errorselectListaServicios").hide();

        let User       = $("#confirmarCliente").val()
		let idServicio = $("#selectListaServicios").val();
		let validaSeleccionServicio = true;
		
        console.log("User", User)
		
		if (idServicio == "Selecciona"){

            $('#errorselectListaServicios').show();
            $('#errorselectListaServicios').html("Elige un servicio");
            $('#selectListaServicios').focus();	
            validaSeleccionServicio = false;
		}
		
        if(User == "Selecciona"){
            $('#errorClienteS').show();
            $('#errorClienteS').html("Elige un cliente");
            $('#confirmarCliente').focus();	
            validaSeleccionServicio = false;
        }
        
        console.log("User", User);
        console.log("Servicio", idServicio)

    
		

		
		if(validaSeleccionServicio == true){
             $("#despliegueTabla3").show()
			
			$.ajax({
			"url": base_url()+"app/Aldair/LevantarOrden/verServicio",
			"dataType":"JSON",
			"type":"POST",
			"data":{
				"id":idServicio
			}
			
			
		})
		.done((data)=>{
			

            console.log("DATOOOS", datos)

            if(agregarDato()){
              subTotalServicio
                toastr["success"]("Producto agregado");
                if(data.resultado){
                    $("#bodySeleccionados").append(`
                        <tr  class="filaSelecionada" id="tr-`+data.Servicio[0].idS+`">
                        <td align="center"><a href="#" onclick="consultarSuc('`+data.Servicio[0].idS +`','`+data.Servicio[0].nombreS+`','`+data.Servicio[0].inventario +`')"><i class="simple-icon-magnifier fa-2x"></i></a> </td>
                            <td data  scope="row" id="idSelecionado">`+data.Servicio[0].idS+`</td>
                            <td class="text-wrap" style="width: 12rem;">`+data.Servicio[0].nombreS+`</td>
                            <td class="text-wrap" style="width: 15rem;">`+data.Servicio[0].desS+` </td>
                            <td >`+data.Servicio[0].inventario+`</td>
                            <td >`+data.Servicio[0].precioS+`</td>
                            
                             
                            <td >`+data.Servicio[0].cantidadMedioMayoreo+`</td>
                            <td data >`+data.Servicio[0].precioMedioMayoreo+`</td> 
                            <td >`+data.Servicio[0].cantidadMayoreo+`</td>
                            <td data >`+data.Servicio[0].precioMayoreo+`</td>
                          
                           

                            <td ><input value='0' min="0" max="`+data.Servicio[0].inventario +`" size="5" type="number" data id="cantidad-`+(data.Servicio[0].idS)+`" onchange="subTotalServicio('`+data.Servicio[0].idS +`','`+data.Servicio[0].precioS +`','`+data.Servicio[0].inventario +`','`+data.Servicio[0].cantidadMedioMayoreo +`','`+data.Servicio[0].precioMedioMayoreo +`','`+data.Servicio[0].cantidadMayoreo +`','`+data.Servicio[0].precioMayoreo +`')" /></td>
                            <td id="Subtotal-`+data.Servicio[0].idS+`" class="subtotal">0</td>
                            <td><button onclick="quitarDeLista('`+data.Servicio[0].idS+`')">Quitar</button></td>
                        </tr>
                    `);
                    subTotalServicio(data.Servicio[0].idS,data.Servicio[0].precioS ,1,data.Servicio[0].cantidadMedioMayoreo data.Servicio[0].precioMedioMayoreo ,data.Servicio[0].cantidadMayoreo ,data.Servicio[0].precioMayoreo)
                }
            }else{
                toastr["warning"]("El servicio ya se encuentra en la lista");
            }

			
			
		})
		.fail();
        $("#btnAgregarServicio").removeAttr("disabled"); 
		
		sumarTabla();

		}else{
            console.log("falta datos por llenar")
        }
	
		
		
	

    } );
});




let datos = [];
let contadorID = 0;

let totalFinal = 0;

function quitarDeLista(arr){
	
	$(`#tr-`+arr).remove();

    let BorraProducto = datos.filter(f => f.Servicio !== arr);
    datos = BorraProducto;
    toastr["success"]("Producto removido");

	sumarTabla();
    subTotalServicio()
	
}


function agregarDato() {
    // "La Mauske herramienta misteriosa" que te ayuda a encontrar el id del servicio, si esta en el array o no.
    let idServicio = $("#selectListaServicios").val();
    // Verificar si el servicio ya existe en el array
    let servicioExiste = datos.some(r => r.Servicio === idServicio);
    // Si el servicio no existe en el array, insertar el nuevo registro
    if (!servicioExiste) {
        datos.push({ id: contadorID++, Servicio: idServicio });
        console.log("Se añadio el listaod", datos)
        return true;
    }else{
        console.log("Ya esta registrado", datos)
        return false;
    }
}





function subTotalServicio(id , id2, inv){
    
	let precio = id2;
	let costo = $("#costo-"+id).val();
	let cantidad = $("#cantidad-"+id).val();
    let inventario = inv;

   

    let subtotal = 0;

    if(parseInt(cantidad) > parseInt(inventario)){
        toastr["warning"]("No hay suficientes productos en inventario: Solo hay "+inventario+" unidades");
          $("#cantidad-"+id).val(cantidad);
         
         subtotal = 0;
         if(parseInt(cantidad)<=0){
            toastr["warning"]("El minimo de venta es de 1 unidad");
             $("#cantidad-"+id).val(cantidad);
             subtotal = 0

         }
    }else{
        console.log("si hay")
         subtotal = precio * cantidad;
        

         if(parseInt(cantidad)<=0){
            
            $("#cantidad-"+id).val(cantidad);
            subtotal = 0
         }
    }



	$("#Subtotal-"+id).html(subtotal);

    if(cantidad > inventario || cantidad <= 0){
        $("#validaINV").val(0);
    }else{
        $("#validaINV").val(1);
        $("#btnOrden").removeAttr("disabled")
    }

    

	sumarTabla(inventario,cantidad);
	
}

function sumarTabla(inventario,cantidad){

    let inv = parseInt(inventario);
    let cant = parseInt(cantidad);
	
	var sumaTotal = 0;
    
	
	$('.subtotal').each(function() {

        sumaTotal += Number($(this).text());

        if($(this).text() == "0"){
        $("#validaINV").val(0);
        $("#btnOrden").attr("disabled", true);
        }
       

    });


   
   
	
	totalFinal = sumaTotal; 
	
	$("#totalSuma").html(sumaTotal);
}

function editarTab(){

    $("#first-tab").removeClass("active");
    $("#second-tab").addClass("active");
}
const levantarOrden = () => {
   
    $.ajax({
        url: base_url() + "app/LevantarOrden/ListaOrdenesLE",
        dataType: "JSON",
        type: "GET",
    })
    .done((data) => {
    
       
       

        
        if (data.resultado) {
            console.log("pintar")
            $("#OrdenesLevantadas").html(`
            <table id="TablaOrdenes" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Estatus servicio</th>
                    <th>Forma de pago</th>
                    <th>Estatus de pago</th>
                    <th>Fecha solicitud</th>
                    <th style="text-align: center">Generar reporte</th>
                    <th style="text-align: center">Detalle de la solicitud</th>
                   
                    <th style="text-align: center">Aceptar</th>
                    <th style="text-align: center">Declinar</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
            `);
            $.each(data.OrdenesLevantadas, function (i, s) {
                $("#TablaOrdenes").find("tbody").append(`
                <tr id="tr-` +s.idVenta +`">
                <td>`+s.idVenta +`</td>
                <td> <span class="badge badge-pill badge-theme-2">`+s.nombreE+`</span></td>
                <td>`+s.nombreFP +`</td>
                <td>`+s.nombreEP +`</td>
                <td>`+s.fecha +`</td>
                <td style="text-align: center">
                    <button type="button" class="btn btn-success btn-sm" onclick="GenerarPDF(` +
                    s.idVenta +
                    `,'` +
                    s.fecha +
                    `','` +
                    s.desTC +
                    `')">
                    <i class="fa-regular fa-circle-check fa-1x"></i>
                    </button>
                </td>
               
                <td style="text-align: center">
                    <button type="button" class="btn btn-primary btn-sm" onclick="detalleVenta(`+s.idVenta +`)">
                        <i class="fas fa-edit fa-1x"></i>
                    </button>
                </td>
                <td style="text-align: center">
                    <button type="button" class="btn btn-success btn-sm" onclick="AceptarOrden(` +
                    s.idVenta +
                    `,'` +
                    s.fecha +
                    `','` +
                    s.desTC +
                    `')">
                    <i class="fa-regular fa-circle-check fa-1x"></i>
                    </button>
                </td>
                <td style="text-align: center">
                    <button type="button" class="btn btn-danger btn-sm" onclick="rechazarOrden(` +
                    s.idVenta +
                    `,'` +
                    s.fecha +
                    `','` +
                    s.desTC +
                    `')">
                    <i class="fa-solid fa-xmark fa-1x"></i>
                    </button>
                </td>
            </tr>
            `)
            });
            $("#TablaOrdenes").DataTable(),$(".dataTables_length select").addClass("form-select form-select-sm");	

        } else {
            $("#OrdenesLevantadas").html(data.mensaje);
            let res = "Ocurrio un error en: ";
           
                toastr["warning"](
                         data.mensaje
                );
        }
    })
    .fail();

}
const GenerarPDF = ( ) => {
    alert("En construccion") 
}




function listaServicios(){
    
    axios(base_url()+"app/Aldair/LevantarOrden/verServicios")
    .then(({data})=>{

       

        if(data.resultado){

            $("#selectListaServicios").html(`<option value="Selecciona">--Selecciona --</option>`);

            $.each(data.Servicios, function(i,o){
                
                if(o.estatus == 1){
                    $("#divListaServicios").find("select").append(`

                    <option value=`+o.idS+`>`+"Producto: "+o.nombreS+ ". Sucursal: " +o.nombreSuc+ ". Stock: " +o.inventario+`</option>
                        `
                    );
                    
                }

                

            });


            $("#datatable").DataTable(),$(".dataTables_length select").addClass("form-select form-select-sm");	

        }else{

            $("#selectListaServicios").html(`<option label="&nbsp;">&nbsp;</option>`);

        }
        

    })
    .catch(error=>{
        console.log(error);
    })



} // termina lista servicios

function tiposPagos(){
    $("#nombreClientepago").attr("disabled", "disabled");
    $("#totapago").attr("disabled", "disabled");
    $("#selectEspecialidad").empty();



    $.ajax({
        url: base_url() + "app/Aldair/LevantarOrden/TiposPagos",
        dataType: "JSON",
        type: "GET",
    })
    .done((data)=>{
        
        if(data.resultado){

            $.each(data.TiposPagos, function (i, o) {
                            
                $("#tipoPago").find("select").append(`
                <option value="`+ o.idFP+`">`+o.nombreFP+`</option>
                
                `
                );


            
        });

       
        }else{
            toastr["warning"]("Aviso: ",data.mensaje);

        }
        
        
    })
    .fail();

}

function infoCliente(){
    
    let User =  JSON.parse($("#idCliente").val());


    $("#nombreClientepago").val("cargando...");

    $.ajax({
        url: base_url() + "app/Aldair/LevantarOrden/getUser",
        dataType: "JSON",
        type: "POST",
        data: {
            idU:  User
        },
    })
    .done((data)=>{

       

        if(data.resultado){
           let Usuario=  data.usuario
      
            $("#nombreClientepago").val(Usuario.nombreU+ " " + Usuario.apellidos);
            $("#totapago").val("$"+totalFinal);
            $("#title_venta").html("Datos de la venta");
          
           
            
        }else{
            $("#nombreClientepago").val("Cuenta suspendida o removida");
            $("#confirmarCliente").empty();
             verificaUsuario()

        }

    })
    .fail();
}


    
function insertaAgrupaServicios(){


 
    tiposPagos()
    infoCliente()
    

    $("#modalCarrito").modal("show");
    

 

        if(accion == "editar"){
            estatus = $("#estatusAS").val();
        }

    
    let i=0;

    const arregloFinal=new Array();
    
    $('.filaSelecionada').each(function(i,e) {

        const arregloPorFila=new Array();

        $(e).find("[data]").each((i,e)=>{

            if($(e).is("input")){
                
                console.log($(e).val());
                arregloPorFila.push($(e).val());

            }else{
                //console.log($(e).text());
                arregloPorFila.push($(e).text());
            }
        });
        arregloFinal.push(arregloPorFila);


     
    });


    let nuevoArreglo = arregloFinal.map(function(subarreglo) {
        return (
          [ "idServicio",subarreglo[0], "PrecioUnitario",subarreglo[1] , "Cantidad",subarreglo[2] ]
        );
      });
      
  


    $("#btnRealizarVenta").off("click").on("click", (e) => {
        e.preventDefault();

            let TP= $("#selectPago").val();
            console.log("Seleccion",TP)

            
            let idUser = $("#idCliente").val();
            $("#btnRealizarVenta").attr("disabled", "disabled");
             
            let ArrayF  = []
            ArrayF.push(nuevoArreglo)

            
          
          
             formbody =  {
                Array: JSON.stringify(ArrayF),
                total: totalFinal,
                idCliente: idUser,
                idFP: TP
            }

             $.ajax({
                url: base_url() + "app/Aldair/LevantarOrden/OrdenCompra",
                dataType: "JSON",
                type: "POST",
                data: formbody,
            })
            .done((data)=>{
                
                if(data.resultado){
                    toastr["success"](data.mensaje);
                    $("#modalCarrito").modal("hide");
                    $("#btnRealizarVenta").removeAttr("disabled");
                    location.reload(true);
                }else{
                    toastr["warning"](data.mensaje);
                    $("#btnRealizarVenta").removeAttr("disabled");
                }
               
                
                
            })
            .fail();

        });


} // termina insertar tipo de pago




const LevantarOrden = () => {
    
    var fechaHoraActual = new Date();
    // Obtener la fecha
    var fecha = fechaHoraActual.getDate() + '/' + (fechaHoraActual.getMonth() + 1) + '/' + fechaHoraActual.getFullYear();
    // Obtener la hora
    var hora = fechaHoraActual.getHours() + ':' + fechaHoraActual.getMinutes() + ':' + fechaHoraActual.getSeconds();
  
    $("#modalLevandarOrden").modal("show");
    $("#FechaLevantamientoOrden").html("Levantamiento de orden: " + fecha + " " + hora);
    $("#btnAceptarOrden").attr("data-idOrden",);
    $("#selectServicios").html("");


        $.ajax({
            "url":base_url()+"app/LevantarOrden/listaServicios",
            "dataType":"JSON"
        })
        .done((data)=>{

           

            if(data.resultado){

                $("#divServicios").find("select").html(`
                <option label="&nbsp;">&nbsp;</option>
                `
                );
                $.each(data.Servicios, function(i,o){

                    if(o.estatus == 1){
                        $("#divServicios").find("select").append(`
                    <option value="`+ o.idS+`">`+ o.nombreS+`  $:`+ o.precioS+`</option>
                    
                    `
                    );

                    }
                });
    
            }else{
    
                $("#divServicios").find("select").append(`
                <option value="Selecciona">--No existen preguntas diagnosticas para mostrar--</option>
                `
                );
            }

        })
        .fail();
    
}


function verificaUsuario(){
  $("#selectSucursal").empty();

   
        $.ajax({
            url: base_url() + "app/Aldair/LevantarOrden/VerificaUsuario",
            dataType: "JSON",
            type: "GET",
           
        })
        .done((data) => {
            console.log("data", data)
           
                if (data.resultado) {
                    let general = data.usuario
                    const IdU = general.idU
                    console.log("Usuario", IdU)
                    $("#Carrito").val(IdU);

                   
                    if (data.resultado) {
                        $("#selectCliente").find("select").append(`
                        <option value="Selecciona">--Selecciona--</option>
                        `);
                        console.log("-----", data);
                        $.each(data.usuario, function (i, o) {
                            
                                $("#selectCliente")
                                    .find("select")
                                    .append(
                                        `
                                            <option value="`+"Nombre: " +
                                            o.idU +
                                            `">` + o.nombreU + " "+o.apellidos + " Teléfono: " + o.telefono + " Correo: " + o.correo + 
                                            `</option>
                            `
                                    );
                            
                        });
                    } else {
                        $("#selectCliente").find("select").append(`
                        <option value="Selecciona">--No existen categorias para mostrar--</option>
                        `);
                    }
                
                
                } else {
                    $("#estatusAccount").html("Verificar")
                    toastr["warning"](data.mensaje);
                }
        })
        .fail();
 } 

   
    


function modalRegistro(){
    $("#modalClienteRegistro").modal("show");
    $("#nombreCliente").val("");
	$("#apellidosCliente").val("");
    $("#telefonoCliente").val("");
	$("#correoCliente").val("");
	$("#contrasenaColaborador").val("");
    $("#btnEnviar, #nombreCliente,#apellidosCliente,#telefonoCliente,#correoCliente,#contrasenaColaborador").removeAttr("disabled");
    
    quitaErroresCamposVacios()
}

function mostrarPassword(){
	var cambio = document.getElementById("contrasenaColaborador");
	if(cambio.type == "password"){
		cambio.type = "text";
		$('.icon2').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
	}else{
		cambio.type = "password";
		$('.icon2').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
	}
	
	


} 

function Restablcer(){

  
}
function quitaErroresCamposVacios() {
	$("#errornombreCliente").hide();
	$("#errordescripcionTipoContratacion").hide();
	$("#errorApellidosCliente").hide();
	$("#errorcorreoCliente").hide();
	$("#errorcontrasenaColaborador").hide()
	$("#errortelefonoCliente").hide();
	$("#errorcontrasenaNColaborador").hide()
	$("#erroPerfil").hide()
	$("#errorEspecialidad").hide()
}


function registrarUsuario(){
    
    quitaErroresCamposVacios();

	$(
		"#btnEnviar, #nombreCliente,#apellidosCliente,#telefonoCliente,#correoCliente,#contrasenaColaborador"
	).attr("disabled", "disabled");
 
	let nom 	= $("#nombreCliente").val();
	let apell   = $("#apellidosCliente").val();
	let tel 	= $("#telefonoCliente").val();
	let correo  = $("#correoCliente").val();
	let contra  = $("#contrasenaColaborador").val();

	let goValidation = true;

	const validRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	


    if (!correo.match(validRegex)) {
	
        console.log("correo no valido")
        $("#errorcorreoCliente").show();
        $("#errorcorreoCliente").html("Ingresa un correo valido");
        $("#correoCliente").focus();
        goValidation = false;
        $(
            "#btnEnviar, #nombreCliente,#apellidosCliente,#telefonoCliente,#correoCliente,#contrasenaColaborador"
        ).removeAttr("disabled");
    }
    if ("" == contra.trim() || contra.length <= 5) {
        
        console.log("== contra.trim() || contra.length <= 5")


        if("" == contra.trim()){
            console.log("contra.trime")
            $("#errorcontrasenaColaborador").show();
            $("#errorcontrasenaColaborador").html(
                ""
            );
                    $("#contrasenaColaborador").focus();
                goValidation = false;
                $(
                    "#btnEnviar, #nombreCliente,#apellidosCliente,#telefonoCliente,#correoCliente,#contrasenaColaborador"
                ).removeAttr("disabled");
        }
        if(contra.length <= 5){
            console.log("contra.length <= 5c")
            $("#errorcontrasenaColaborador").show();
            $("#errorcontrasenaColaborador").html(
                "La contraseña es demaciado corta"
            );
            $("#contrasenaColaborador").focus();
                goValidation = false;
                $(
                    "#btnEnviar, #nombreCliente,#apellidosCliente,#telefonoCliente,#correoCliente,#contrasenaColaborador"
                ).removeAttr("disabled");
        }
        
        
    }
   
    if ("" == correo.trim()) {
            console.log("correo")
        $("#errorcorreoCliente").show();
        $("#errorcorreoCliente").html("Ingresa el correo del cliente");
        $("#correoCliente").focus();
        goValidation = false;
        $(
            "#btnEnviar, #nombreCliente,#apellidosCliente,#telefonoCliente,#correoCliente,#contrasenaColaborador"
        ).removeAttr("disabled");
    }
    if (!tel.match(/^[0-9]+$/) || tel.length >10){
        console.log("tel.match")
        if(!tel.match(/^[0-9]+$/) ){
            $("#errortelefonoCliente").show();
            $("#errortelefonoCliente").html("Ingresa un telefono valido");
            $("#telefonoCliente").focus();
            goValidation = false;
            $(
                "#btnEnviar, #nombreCliente,#apellidosCliente,#telefonoCliente,#correoCliente,#contrasenaColaborador"
            ).removeAttr("disabled");
        }
        if( tel.length >10){
            $("#errortelefonoCliente").show();
            $("#errortelefonoCliente").html("Solo se permiten 10 digitos");
            $("#telefonoCliente").focus();
            goValidation = false;
            $(
                "#btnEnviar, #nombreCliente,#apellidosCliente,#telefonoCliente,#correoCliente,#contrasenaColaborador"
            ).removeAttr("disabled");
        }
        
    }
    if ("" == tel.trim() ) {
        console.log("tel")
        $("#errortelefonoCliente").show();
        $("#errortelefonoCliente").html("Ingresa el telefono del cliente");
        $("#telefonoCliente").focus();
        goValidation = false;
        $(
            "#btnEnviar, #nombreCliente,#apellidosCliente,#telefonoCliente,#correoCliente,#contrasenaColaborador"
        ).removeAttr("disabled");
    }
    if ("" == apell.trim()) {
        console.log("apell")
        $("#errorApellidosCliente").show();
        $("#errorApellidosCliente").html(
            "Ingresa los apellido del cliente"
        );
        $("#apellidosCliente").focus();
        goValidation = false;
        $(
            "#btnEnviar, #nombreCliente,#apellidosCliente,#telefonoCliente,#correoCliente,#contrasenaColaborador"
        ).removeAttr("disabled");
    }
    if ("" == nom.trim()) {
        console.log("nombre")
        $("#errornombreCliente").show();
        $("#errornombreCliente").html("Ingresa el nombre del cliente");
        $("#nombreCliente").focus();
        goValidation = false;
        $(
            "#btnEnviar, #nombreCliente,#apellidosCliente,#telefonoCliente,#correoCliente,#contrasenaColaborador"
        ).removeAttr("disabled");
    }
    
    if (goValidation) {

        formbody =  {
            nombreU: nom,
            apellidos: apell,
            correo: correo,
            contrasena: contra,
            telefono: tel,
        }
      
        
        $.ajax({
            url: base_url() + "app/Aldair/LevantarOrden/registrarNuevoCliente",
            dataType: "JSON",
            type: "POST",
            data: formbody,
        })
        .done((data)=>{
            
            if(data.resultadoRegistro){
                $("#btnEnviar").removeAttr("disabled");
                toastr["success"](data.mensajeRegistro);
                $("#modalClienteRegistro").modal("hide");
                $("#confirmarCliente").empty();
                 verificaUsuario()

            }else{
                toastr["warning"](data.mensajeUser);
                $("#btnEnviar, #nombreCliente,#apellidosCliente,#telefonoCliente,#correoCliente,#contrasenaColaborador").removeAttr("disabled");
            }
            
            
        })
        .fail();
    
            
		
		

		
	} else {
		console.log("Falta datos para completar el formulario");
	}
    
}


function consultarSuc(idServ, nombre){

    console.log("nombre", nombre);
    $("#modalStockinv").modal("show");
    $("#titleStock").html("Inventario general -" + nombre );
    $("#SucursalesInventario").html("")
    
    $.ajax({
        url: base_url() + "app/Aldair/LevantarOrden/consultarProducto",
        dataType: "JSON",
        type: "POST",
        data: {
            idS:  idServ
        },
    })
    .done((data)=>{
        
        if(data.resultado){

            $.each(data.producto, function (i, o) {
            
                $("#SucursalesInventario").append(
                    `
                    <label for="message-text" class="col-form-label col-12">Sucursal: `+o.nombreSuc+`</label>
                    <label for="message-text" class="col-form-label col-12">Stock: `+o.inventario+`</label>
                    <label for="message-text" class="col-form-label col-12"> <span class=" `+(o.inventario <= 0 ? "badge badge-warning" : "badge badge-success")  +`">` +(o.inventario >= 1 ? "Activo" : "Sin stock")  +`</span>
                   </label> 
                   <hr>
                    `
                );
            });
        }else{
            toastr["warning"]("Aviso: ",data.mensaje);

        }
        
        
    })
    .fail();

        
    


}


