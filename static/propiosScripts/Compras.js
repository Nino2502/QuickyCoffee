$(document).ready(()=>{


    //alert("ya estamos aqui");
    //$("#datatable").find("tbody").html("");
    proveedores();
    listaCompras();
    listaServicios();
    //listanombreASsMesaFAQS();

    /*$("#editarAgr").click(()=>{

        $("#first-tab").removeClass("active");
        $("#second-tab").addClass("active");
        

    })*/


    $("#btnAgregarServicio").click((e)=>{
		
        e.preventDefault();
		
		 
        $("#btnAgregarServicio").attr("disabled", "disabled");

		
		
		
	    $("#errorselectListaServicios").hide();

		let idServicio = $("#selectListaServicios").val();
		let validACeleccionServicio = true;
		
		
		if (idServicio == "Selecciona"){
			//console.log("entro aqui");
            $('#errorselectListaServicios').show();
            $('#errorselectListaServicios').html("Elige un servicio");
            $('#selectListaServicios').focus();	
            validACeleccionServicio = false;
		}
		
		
		//console.log(idServicio);
		
		
		if(validACeleccionServicio){
			
			$.ajax({
			"url": base_url()+"app/Servicios/verServicio",
			"dataType":"JSON",
			"type":"POST",
			"data":{
				"id":idServicio
			}
			
			
		})
		.done((data)=>{
			
			if(data.resultado){
				
				let contador = 1;
				idComServicio = "";
				let bandera = 0;
				
				
				$(".filaSelecionada").each(function(i,e){
					contador ++;
					
					
					idComServicio = "tr-"+idServicio;
					let idEachServicio = $(e).attr("id");
					
					//console.log("Com: ",idComServicio);
					//console.log("each: ",idEachServicio);
					
					if(idComServicio == idEachServicio ){
						
						
						bandera ++;
						
						
					}
			
				})
				
				
				
				if(bandera >= 1 ){
					
					
					toastr["warning"]("El producto ya se encuentra en la lista");
					
					
				}else{
					
					$("#bodySeleccionados").append(`
								<tr  class="filaSelecionada" data-fila="`+contador+`" id="tr-`+data.Servicio[0].idS+`">
									<td data  scope="row" id="idSelecionado">`+data.Servicio[0].idS+`</td>
									<td data class="text-wrap" style="width: 12rem;">`+data.Servicio[0].nombreS+`</td>
									<td class="text-wrap" style="width: 15rem;">`+data.Servicio[0].desS+` </td>
									<td>`+data.Servicio[0].precioS+`</td>
									<td>`+data.Servicio[0].ultimoPrecioCompra+`</td>
									<td ><input value='0' size="3" type="number" data id="costo-`+data.Servicio[0].idS+`" onchange="subTotalServicio('`+data.Servicio[0].idS+`')"/></td>
									<td ><input value='0' size="5" type="number" data id="cantidad-`+data.Servicio[0].idS+`" onchange="subTotalServicio('`+data.Servicio[0].idS+`')" /></td>
									<td data id="Subtotal-`+data.Servicio[0].idS+`" class="subtotal">0</td>
									<td><button onclick="quitarDeLista(`+contador+`)"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
								</tr>
							`);
				
				}
				
							
				
				
				
				
				
				//console.log(contador);
				
				
				
			
				
			}
			
		})
		.fail();
			
		}
	
		$("#btnAgregarServicio").removeAttr("disabled"); 
		
		sumarTabla();

		
	

    } );



       
    });
    // termina document ready 


//----************


function quitarDeLista(id){
	
	
	
	$("tr[data-fila="+id+"]").remove();
	
	sumarTabla();
	
}

function subTotalServicio(id){
	
	
	let costo = $("#costo-"+id).val();
	let cantidad = $("#cantidad-"+id).val();
	
	let subtotal = costo * cantidad;
		
	$("#Subtotal-"+id).html(subtotal);
	
	sumarTabla();
	
}

function sumarTabla(){
	
	var sumaTotal = 0;
	
	$('.subtotal').each(function() {
     sumaTotal += Number($(this).text());
    });
	
	
	let ivaSubtotal = (sumaTotal * .16);
	let totalMasIva = (ivaSubtotal+sumaTotal)
	
	//console.log("total ", sumaTotal);
	$("#subtotalSuma").html(sumaTotal);
	$("#ivaSubtotal").html(ivaSubtotal);
	$("#totalSuma").html(totalMasIva);
}

function editarTab(){

    $("#first-tab").removeClass("active");
    $("#second-tab").addClass("active");
}



    
    function listaCompras(){
    
    
        axios(base_url()+"app/Compras/verCompras")
        .then(({data})=>{
    
            if(data.resultado){
    
                $("#despliegueTabla").html(`
                <table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Fecha</th>
                            <th>Folio</th>
                            <th>Proveedor</th>
                            <th>Descripción</th>
                            <th>Total</th>
                            <th>Sucursal</th>
                            <th>Ver</th>
                            <th style="text-align: center">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                
                    </tbody>
                </table>`
                );

             
                $.each(data.Compras, function(i,o){
    
                    $("#datatable").find("tbody").append(`
                        <tr id="tr-`+ o.idCom+`">
							<td>`+ o.idCom+`</td>
                            <td>`+ o.fecha+`</td>
                            <td>`+ o.folio+`</td>
							<td>`+ o.nombreProv+`</td>
							<td class="text-wrap" style="width: 15rem;" >`+ o.desCompra+`</td>
							<td>$`+ o.total+`</td>
							<td>`+ o.nombreSuc+`</td>
							<td><a href="#" onclick="vistaPrevia('`+o.idCom+`','`+o.fecha+`','`+o.folio+`','`+o.nombreProv+`','`+o.nombreSuc+`','`+o.nombreC+`','`+o.total+`','`+o.iva+`','`+o.sumaTotal+`','`+o.fechaCaptura+`',)"><i class="fas fa-list fa-2x"></i></a></td>
                            <td align="center"><a href="#" onclick="modalBorrar(`+o.idCom+`,'`+o.folio+`','`+o.total+`')"><i class="fas fa-trash fa-2x"></i></a></td>
                        </tr>`
                    );
    
                });
    
                $("#datatable").DataTable(),$(".dataTables_length select").addClass("form-select form-select-sm");	
    
            }else{
    
                $("#despliegueTabla").html(data.mensaje);
            }

        })
        .catch(error=>{
            console.log(error);
        })
    
    } // termina lista de Tipos de PAgo

    function vistaPrevia(idCompra,fecha,folio,nombreProv, nombreSuc,nombreUsr, costoTotal,iva,sumaTotal, fechaCaptura){


        $.ajax({
            "url":base_url()+"app/Compras/vistaPrevia",
            "dataType":"JSON",
            "type":"POST",
            "data":{
                id:idCompra
            }

        })
        .done((data)=>{

            $("#cuerpoModalVistaPrevia").html("");
            $("#tituloModaVistaPrevia").html("");
			
			$("#totalM").html("");
			
			$("#datosCaptura").html("");
			$("#datosCompra").html("");
			
			$("#tablaDetalle tbody").html(``);
			
			
			

            if(data.resultado){

                 $('#vistaPreviaModal').modal('show');
                 $("#tituloModaVistaPrevia").html("Detalle de compra: <strong> "+idCompra);
				$("#descripcionM").html("Registro: <strong> "+nombreUsr+" </strong>Sucursal: <strong> "+nombreSuc+" </strong>Fecha registro: <strong> "+fechaCaptura+" </strong></br>Fecha Compra: <strong> "+fecha+" </strong> Folio/factura: <strong> "+folio+" </strong>Proveedor: <strong> "+nombreProv+" Folio: <strong> "+folio+"</strong>");
				$("#totalM").html("subtotal: <strong> $"+costoTotal+"</strong>");
				$("#ivaM").html("iva: <strong> $"+iva+"</strong>");
				$("#totalMasIvaM").html("total: <strong> $"+sumaTotal+"</strong>");
				
				
				
				
				
				$("#datosCaptura").html(`Registró: <strong>`+nombreUsr+` </strong></br> Sucursal: <strong>`+nombreSuc+` </strong></br>Fecha de registro: <strong>`+fechaCaptura+`</strong>`);
				$("#datosCompra").html(`Fecha de compra: <strong>`+fecha+` </strong></br>folio: <strong>`+folio+`</strong></br>Proveedor: <strong>`+nombreProv+`</strong>`);
			
				
				
				

                let conteo = 0;
                 $.each(data.detalleCompra, function(i,o){
					 conteo ++;
     
                     $("#tablaDetalle tbody").append(`
						<tr>
							<td>`+conteo+`</td>
							<td>`+o.nombreProducto+`</td>
							<td>`+o.cantidad+`</td>
							<td>`+o.precio+`</td>
							<td>`+o.subtotal+`</td>
						</tr>

					`);
                 });

               

            }else{

                toastr["success"](data.mensaje);
                 console.log(data);

            }
        

        })
        .fail();

    }
    
    
    
    function insertaCompras(){

    
        quitaErroresCamposVacios();
        
        //agrega el disabled a los campos
        agregarDisabled();
		
		let id = $("#idAC").val();
		let fechaCompra = $("#fechaCompra").val();
		let folio = $("#folioFactura").val();
		let selectProveedores = $("#selectProveedores").val();
        let des = $.trim($("#descripcion").val());
        let subtotalSuma = $.trim($("#subtotalSuma").text());
		let ivaSubtotal = $.trim($("#ivaSubtotal").text());
		let totalSuma = $.trim($("#totalSuma").text());	
	
		
		
		
		let selectListaServicios = $("#selectListaServicios").val();
		let idUsuario = $("#idUsuario").val();
		let sucursal = $("#sucursal").val();
		let fechaActual = $("#fechaActual").val();
		
	
        let accion = $("#accion").val();
        let goValidACion = true;
        let estatus = 1;
    
            if(accion == "editar"){
                estatus = $("#estatusAC").val();
            }
    
          
		

        if("" == folio.trim()){
            $('#errorfolioFactura').show();
            $('#errorfolioFactura').html("Ingresa un título para la agrupación");
            $('#folioFactura').focus();	
            goValidACion = false;
            removerDisabled();
        }
		
		
	   if("Selecciona" == selectProveedores){
			$('#errorselectProveedores').show();
			$('#errorselectProveedores').html("Elige un proveedor");
			$('#selectProveedores').focus();	
			goValidACion = false;
			removerDisabled();
		}

		
		
		
		if("" == fechaCompra.trim()){
            $('#errorfechaCompra').show();
            $('#errorfechaCompra').html("Ingresa la fecha de la compra");
            $('#fechaCompra').focus();	
            goValidACion = false;
            removerDisabled();
        }
		
		
		
		let i=0;
 
        const arregloFinal = new Array();
		
		$('.filaSelecionada').each(function(i,e) {

			const arregloPorFila=new Array();

			$(e).find("[data]").each((i,e)=>{

                if($(e).is("input")){
                    
                    //console.log($(e).val());
                    arregloPorFila.push($(e).val());

                }else{
                    //console.log($(e).text());
                    arregloPorFila.push($(e).text());
                }
            });
            arregloFinal.push(arregloPorFila);


			/*$(this).children("td").each(function(i,e){            });*/
		});
    
        //console.log(arregloFinal); 

       

        if(arregloFinal.length <=0){

            $('#errorserviciosSeleccionados').show();
            $('#errorserviciosSeleccionados').html("No haz agregado ningun servicio");
            $('#selectListaServicios').focus();	
            goValidACion = false;
            removerDisabled();

        }

        if(subtotalSuma == '0'){

            $('#errortotal').show();
            $('#errortotal').html("El costo de la compra no puede ser $0 ");
           	
            goValidACion = false;
            removerDisabled();

        }
        
        console.log(subtotalSuma);




        if(goValidACion){
    
            axios.post(base_url()+"app/Compras/insertaCompras", {
                idCom:id,
                fecha: fechaCompra,
				folio: folio,
				idProv: selectProveedores,
				desCompra:des,
                total: subtotalSuma,
				iva : ivaSubtotal,
				sumaTotal : totalSuma,
				idU : idUsuario,
				idSuc : sucursal,
				fechaCaptura: fechaActual,
				estatus : estatus,
				serviciosArray: arregloFinal,
                accion:accion,
				
		     

            })
            .then(({data})=>{
    
                if(data.resultado){
    
                    toastr["success"](data.mensaje);
                    $("#nombrePreguntasMesaFAQS").val("");
                    
                    
                    listaCompras();
    
                    removerDisabled();

                    window.setTimeout( () => {

                        window.location.href = base_url() + "app/Compras"

                    }, 2000);


                    
                }else{
    
                    toastr["warning"](data.mensaje);
                    removerDisabled();
    
                }
                
            })
            .catch(error=>{
                console.log(error);
                removerDisabled();
                listaCompras();
    
            })
    
        }else{
    
            console.log("Falta un dato");
            listaCompras();
            removerDisabled();
    
        }
    
    } // termina insertar tipo de pago


    function removerDisabled(){

        $("#btnAgregar, #fechaCompra, #selectProveedores, #folioFactura, #descripcion, #selectListaServicios, #btnAgregarServicio").removeAttr("disabled"); 

    }

    function agregarDisabled(){

        $("#btnAgregar, #fechaCompra, #selectProveedores, #folioFactura, #descripcion, #selectListaServicios, #btnAgregarServicio").attr("disabled", "disabled");

    }

    function agregar(){
     
		quitaErroresCamposVacios();
        $("#btnCrear").html("Agregar");
        
        $("#tituloAccion").html("Capturar compra");
        $("#fechaCompra").val('');
        
        $("#selectProveedores").html("");
        proveedores ();
        $("#folioFactura").val('');
        $("#descripcion").val('');
        $("#selectListaServicios").html("");
		//$("#selectProveedores").find('option:selected').removeAttr("selected");
        //$("#selectListaServicios").find('option:selected').removeAttr("selected");
        listaServicios();
        $("#accion").val("Agregar");
        $("#idAC").val("0");
        $("#bodySeleccionados").html("");
        $("#totalSuma").html("0");
        $("#estatusAC").val("1");
    
    } // termina modal agregar tipo de pago

    function quitaErroresCamposVacios(){
        $("#errorfechaCompra").hide();
        $("#errorselectProveedores").hide();
        $("#errorfolioFactura").hide();
        $("#errordescripcion").hide();
        $("#errorselectListaServicios").hide();
		$("#errorserviciosSeleccionados").hide();
        $("#errortotal").hide();
	
    }



    function validarCamposVacios(){
        $("#errornombrePreguntasMesaFAQS").hide();
        $("#errordesPreguntasMesaFAQS").hide();
        $("#errorselectProveedores").hide();
    }

    // funcion editar agrupacion de servicio

    function editar(id,nombre,des,costoTotal,idProv,inicio, fin, estatus){
        editarTab();
        quitaErroresCamposVacios();

        agregar();

        
        $("#tituloAccion").html("Editar compra <strong>"+ nombre+"</strong>");
        $("#fechaInicio").val(inicio);
        $("#fechaFin").val(fin);
        $("#selectProveedores").html();
        proveedores (idProv);
        $("#folioFactura").val(nombre);
        $("#descripcion").val(des);
        $("#selectListaServicios").html("");
		//$("#selectProveedores").find('option:selected').removeAttr("selected");
        //$("#selectListaServicios").find('option:selected').removeAttr("selected");

        console.log(idProv);
        listaServicios();
        
        $("#accion").val("editar");
        $("#idAC").val(id);
        
        $("#totalSuma").html("0");
        $("#estatusAC").val(estatus);



        $("#bodySeleccionados").html("");


        $.ajax({
            "url":base_url()+"app/Compras/vistaPrevia",
            "dataType":"JSON",
            "type":"POST",
            "data":{
                id:id
            }
        })
        .done((data)=>{

            $.each(data.servicios, function(i,o){

                $("#bodySeleccionados").append(`
					<tr  class="filaSelecionada" id="tr-`+o.idS+`">
						<td data  scope="row" id="idSelecionado">`+o.idS+`</td>
						<td class="text-wrap" style="width: 12rem;">`+o.nombreS+`</td>
						<td class="text-wrap" style="width: 15rem;">`+o.desS+` </td>
						<td>`+o.precioS+`</td>
						<td ><input value='`+o.costo+`' size="3" type="number" data id="costo-`+o.idS+`" onchange="subTotalServicio(`+o.idS+`)"/></td>
						<td ><input value='`+o.cantidad+`' size="5" type="number" data id="cantidad-`+o.idS+`" onchange="subTotalServicio(`+o.idS+`)" /></td>
						<td id="Subtotal-`+o.idS+`" class="subtotal">`+(o.costo*o.cantidad)+`</td>
						<td><button onclick="quitarDeLista(`+o.idS+`)">Quitar</button></td>
					</tr>
				`);

            });

           $("#totalSuma").html("<strong> "+costoTotal+ " </strong></br>")


        })
        .fail();

       /*
        $("#btnEnviar").html("Actualizar");
        $("#accion").val("editar");
        $('#ModalAgregar').modal('show');
        $("#nombreModal").html("Editar Grupo");
        $("#nombrePreguntasMesaFAQS").val(nombre);
        $("#desPreguntasMesaFAQS").html(des);
       
        $("#estatusModal").val(estatus);
        $("#idAC").val(id);
        if($("#icono-"+id).hasClass("fa-toggle-on")){
            $("#estatusModal").val('1');
        }else{
            $("#estatusModal").val('0');
        }
*/
        //$("#selectProveedores").find('option:selected').removeAttr("selected");
        //$("#selectProveedoresoption[value="+idAC+"]").attr('selected', 'selected');


        
    
    } // temrina modal editar tipo de pago
    
    function cambiaEstatus(id){
    
        $.ajax({
            "url": base_url()+"app/Compras/cambioEstatus",
            "dataType": "JSON",
            "type":"POST",
            "data":{
                "id":id
            }
        })
        .done((data)=>{
            if(data.resultado){
    
                toastr["success"](data.mensaje);
    
                if($("#icono-"+id).hasClass("fa-toggle-on")){
                    $("#icono-"+id).removeClass("fa-toggle-on");
                    $("#icono-"+id).addClass("fa-toggle-off");
                }else{
                    $("#icono-"+id).removeClass("fa-toggle-off");
                    $("#icono-"+id).addClass("fa-toggle-on");
    
                }
    
            } else{
                toastr["warning"](data.mensaje);
            }
        })
        .fail();
    
    }
    
    
    function modalBorrar(id,folio,total){
    
        
        $('#borrarModal').modal('show');
        $("#tituloModalBorrar").html("Borrar compra: <strong>"+id+"</strong>");
        $("#cuerpoModalBorrar").html("Estas seguro que deseas borrar la compra con numero: <strong>" + id + "</strong> y folio: <strong>" + folio + "</strong></br> total de la compra: <strong>" + total+"</strong>");
        $("#btnModalBorrar").attr("appData-Id",id);
    
    } // temrina modal editar tipo de pago
    
    
    function btnModalBorrar(){
    
        let id= $("#btnModalBorrar").attr("appData-Id");
    
        $.ajax({
            "url": base_url()+"app/Compras/bajaLogica",
            "dataType": "JSON",
            "type":"POST",
            "data":{
                "id":id
            }
        })
        .done((data)=>{
            if(data.resultado){
    
                toastr["success"](data.mensaje);
                $("#tr-"+id).remove();
    
                $('#borrarModal').modal('hide');
    
            } else{
                toastr["warning"](data.mensaje);
                $('#borrarModal').modal('hide');
            }
        })
        .fail();
    
    
    
    
    }


    function proveedores (idSelect=0){

        //consumimos servicio para mostrar los tipos de contratacion
        axios(base_url()+"app/Proveedores/verProveedores")
        .then(({data:Response})=>{
         //console.log(Response)
        
         if(Response.resultado){
        
             /**
              * #despliegueTabla es el id de un div que se encuentra en la vista en TipoContratacion_view.php
              * se pintara la tabla en el id: despliegueTabla
              */
        
             $("#selectProveedores").html('<option value="Selecciona">--Selecciona --</option>');    

             $.each(Response.Proveedores, function(i,o){
        
                 $("#divListaProveedores").find("select").append(`
                 <option value=`+o.idProv+` `+ (idSelect == o.idProv ? "selected": "")+`>`+o.nombreProv+` </option>
                  `
                 );
        
             });
             $("#datatable").DataTable(),$(".dataTables_length select").addClass("form-select form-select-sm");	
         }
         else{
            $("#selectProveedores").html('<option label="&nbsp;">No hay tipos para mostrar</option>');    
         }
        
        
        })
        .catch(error=>{
         console.log(error, "Error al cargar el controlador verProveedores");
        })
        
     }

     // termina lista tipos de contratación


     function listaServicios(){
    
        axios(base_url()+"app/Servicios/verServicios")
        .then(({data})=>{

            //console.log("Carga servicios");
    
            if(data.resultado){
    
                $("#selectListaServicios").html(`<option value="Selecciona">--Selecciona--</option>`);
    
                $.each(data.Servicios, function(i,o){
					
					if(o.estatus == 1){
						$("#divListaServicios").find("select").append(`

						<option value=`+o.idS+`>`+o.nombreS+`</option>
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
    
  


    
    
    /* 
    
    
    $('#ModalForm').modal('show');
    // HIDE
    $('#ModalForm').modal('hide');
    
    
     axios(base_url()+"app/Compras/verCompras")
            .then(({data:respusta})=>{
    
                console.log(respusta);
    
            })
            .catch(error=>{
                console.log(error);
            })
           
    
    
    
    
    
    
    
    POST
    
    axios.post('{{ route('enterprise.store') }}', body)
                                .then(res => {
                                    console.log(res)
                                    if (json.response === true) {
                                        const route = '{{ route('message', '2') }}'
                                        const message = 2
                                        $.ajax({
                                            type: "post",
                                            url: route,
                                            data: {
                                                message
                                            },
                                            success: function(response) {
                                                console.log('message', response)
                                                window.location.href =
                                                    '{{ route('empresas.home') }}'
                                            },
                                            error: function(err) {
                                                message(
                                                    'Hubo un problema con la petición'
                                                )
                                            }
                                        });
                                    }
                                })
                                .catch(err => {
                                    console.error(err);
                                })
    
    
    
    
    
    GET
    
    
    axios({
                    method: 'get',
                    url: url,
                    data: {
                        id: id_resuesta
                    }
                }).then((response) => {
    
                    // SELECT ADMINISTRADOR
                    option = document.createElement('option')
                    option.value = '0'
                    option.textContent = '-- Seleccione un administrador --'
                    option.disabled = true
                    selectAdministrador.appendChild(option)
    
    
                    option = document.createElement('option')
                    option.value = response.data.id
                    option.selected = true
                    option.textContent = response.data.email
                    selectAdministrador.appendChild(option)
    
    
                    users.forEach(element => {
    
                        const option = document.createElement('option')
                        option.value = element.id
    
                        if (option.value != response.data.id) {
                            option.textContent = element.email
                            selectAdministrador.appendChild(option)
                        }
    
                    });
    
                }).catch((error) => {
                    message('Hubo un problema...')
                })
    
    
    
    FETCH
    
     fetch(base_url()+"app/Compras/verCompras",{
               
            })
            .then((response)=> response.json())
            .then((result)=>{
    
                console.log(result);
    
            })
            .catch((error)=>{
                console.log("Error al cargar el controlador", error);
            })
    
    
    
    
    
    */