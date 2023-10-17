$(document).ready(() => {
 
    consultarPrograma();
    //levantarOrden();
    listaServicios();
	listaServiciosNoImpresos();
    verificaUsuario();
    $("#btnOrden").attr("disabled", true);
    $("#confirmarCliente").val(undefined);
    $("#cantidadCliente").hide();

    $("#contrasenaColaborador").attr("disabled", "disabled");
     $("#despliegueTabla3").hide();
	 

	 
	 


    
     $('[data-bs-toggle="tooltip"]').tooltip(); 
     
      $(document).ready(function() {

        $('[data-bs-toggle="tooltip"]').tooltip(); 
        // Detectar el evento 'input' en el campo de origen
        $('#telefonoCliente').on('input', function() {
          // Copiar el contenido del campo de origen al campo de destino
          $('#contrasenaColaborador').val($(this).val());
          
        });


        $('#miInput').on('change', function() {
            // tu código aquí para manejar el evento onChange
            console.log('El valor de miInput ha cambiado a: ' + $(this).val());
          });

       
      });

      
  
      $('#customCheckThis').on('change', function() {
        if ($(this).is(':checked')) {
            $("#desglosePuntos ").hide();
            firmadoPuntos= true
            //console.log("El checkbox está marcado", estatus);
            $("#cantidadCliente").show()
            $("#cantidadCoinsprograma").val("")
            $("#errorCantidadExcedida").hide()

            $("#errorcantPuntos").hide()
            $("#DescuentoAplicado").show()
            $("#DescuentoAplicado").html("Descuento aplicado:")
            $("#totalFinalPrograma").show()
            $("#totalFinalPrograma").html("Total a pagar:")
            $("#nuevoSaldopuntos").html("Saldo restante:")
            $("#puntosObtenidos").html("Puntos obtenidos:")

            let User       = $("#confirmarCliente").val()

            usuario =  obtenerValorNumerico(User)
        
            obtenerPuntos(usuario)
        }
        else {
            $("#desglosePuntos").show();
            firmadoPuntos = false
            $("#errorcantPuntos").hide()
            $("#cantidadCoinsprograma").val("")
            $("#errorCantidadExcedida").hide()
            $("#errorcantPuntos").hide()
            $("#DescuentoAplicado").hide()
            $("#nuevoSaldopuntos").html("Saldo restante:")
            $("#puntosObtenidos").html("Puntos obtenidos:")
            
            $("#totalFinalPrograma").hide()
            //estatusAplica = false
            //console.log("El checkbox no está marcado" , estatus);
            $("#cantidadCliente").hide()

            let User       = $("#confirmarCliente").val()

            usuario =  obtenerValorNumerico(User)
        
            obtenerPuntos(usuario)
        }
    });
      

    $("#estatusAccount").click((e)=>{
        e.preventDefault();
        

            let value = $("#confirmarCliente").val();
            const puntos = obtenerValorNumerico(value);
           

            obtenerPuntos(puntos)
   

            if(value == "Selecciona" || value == undefined){
            $('#btnOrden').attr('disabled', true);
                toastr["warning"]("Selecciona un cliente para la venta");
            
            } else {
                

                 let idUser = parseInt(value.split(":")[1]);
                  $("#idCliente").val(idUser);
                 toastr["success"]("Cliente seleccionado");
            }
        });
	
	
	/***************** agregar servicio IMPRESO *******************/
	
	

    $("#btnAgregarServicio").click((e)=>{
    
        $("#validaINV").val("0");
        
        e.preventDefault();
		
	    $("#errorClienteS").hide();
        $("#errorselectListaServicios").hide();

        let User       = $("#confirmarCliente").val()
		let idServicio = $("#selectListaServicios").val();
		let validaSeleccionServicio = true;
		
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
				
				
				
				
				if(data.resultado){

                   
					let unidad = 1;

					let identiFila = 0;

					$(".filaSelecionada").each(function(i,e){

						$(e).find("[indeti]").each((i,e)=>{


						//console.log($(e).text());
					   identiFila = $(e).text();

							identiFila= (unidad + parseInt(identiFila));


						});

					});



					if(identiFila != 0){
						unidad = identiFila;
					}

					
                  

                    $("#bodySeleccionados").append(`
                        <tr  class="filaSelecionada" data-fila="`+unidad+`" id="tr-`+idServicio+`">
						<td data indeti scope="row" id="idSelecionado">`+unidad+`</td>
                        <td align="center"><a href="#" onclick="consultarSuc('`+data.Servicio[0].idS +`','`+data.Servicio[0].nombreS+`','`+data.Servicio[0].inventario +`')"><i class="simple-icon-magnifier fa-2x"></i></a> </td>
                            <td style="text-align: center" data  scope="row" id="idSelecionado">`+data.Servicio[0].idS+`</td>
                            <td style="text-align: center" class="text-wrap" style="width: 12rem;">`+data.Servicio[0].nombreS+` <div id:"leyendaTipo"><strong style="color:blue;">Impreso</strong></div></td>
                            <td id="unidad-`+unidad+`"style="text-align: center" class="text-wrap" style="width: 15rem;">`+data.Servicio[0].desS+` <div id="desTamanioDinamico-`+unidad+`"></div></td>
							<td id="`+data.Servicio[0].idUnidad+`"style="text-align: center" class="text-wrap" style="width: 15rem;">`+data.Servicio[0].nombreUni+` </td>

                            <td style="text-align: center" data >
							`+( 
								data.Servicio[0].idUnidad == "4" ? 
							   		`<input value="0" min="0" max="100" size="5" type="number" data id="anchoFila-`+unidad+`" onchange="changeCantidad('`+data.Servicio[0].idS+`', '1', '`+unidad+`','`+data.Servicio[0].idUnidad+`')"  />` : 
							   	(data.Servicio[0].idUnidad == "5" ? 
								 	`<input value="`+data.Servicio[0].anchoMaterial+`" min=".5" max="100" size="5" type="number" data id="anchoFila-`+unidad+`" onchange="changeCantidad('`+data.Servicio[0].idS+`', '1', '`+unidad+`','`+data.Servicio[0].idUnidad+`')"  disabled/>`:
								 'n/a') 
							  )
												   
									
							+`						

							</td>
                            <td style="text-align: center" data >
							`+
											
							   (data.Servicio[0].idUnidad == "5" || data.Servicio[0].idUnidad == "4" ? `<input value="0" min="0" max="100" size="5" type="number" data id="altoFila-`+unidad+`" onchange="changeCantidad('`+data.Servicio[0].idS+`', '1', '`+unidad+`','`+data.Servicio[0].idUnidad+`')"  />` : `n/a`)
																	   
							+`

							
							</td>

                            <td data style="text-align: center">`+data.Servicio[0].inventario+`</td>
                            <td data precioSer-`+unidad+` id="precio-${idServicio}" style="text-align: center">
								$<span id="precioSeleccionado-`+unidad+`">`+(parseFloat(data.Servicio[0].precioS) + parseFloat(data.Servicio[0].precioImpresion) )+`</span>
							<div id:"leyendaPrecio">menudeo</div>
							</td>
								<input precioBaseSer-`+unidad+` type="hidden" value="`+data.Servicio[0].precioS+`" />
								<input precioBaseImp-`+unidad+` type="hidden" value="`+data.Servicio[0].precioImpresion+`" />
                            
                            
                            <td style="text-align: center" ><input data value="0" min="0" max="100" size="6" type="number" id="cantidad-`+unidad+`"  onchange="changeCantidad('`+data.Servicio[0].idS+`', '1', '`+unidad+`','`+data.Servicio[0].idUnidad+`')"  /></td>
                            <td style="text-align: center" data id="Subtotal-`+unidad+`" class="subtotal">0</td>
                            <td style="text-align: center"><button onclick="quitarDeLista(`+unidad+`)">Quitar</button></td>
                        </tr>
                    `);
                    
				}
           

		})
		.fail();
        
		
		sumarTabla();

		}else{
            console.log("falta datos por llenar")
        }
     } );

	
	/* 
	1 Impreso
	2 no impreso
	3 servicio rapido
	*/
	
	/* *********** comienza agregar producto no impreso *********** */
	
	
	

    $("#btnAgregarServicioNoImpresos").click((e)=>{
    


        $("#validaINV").val("0");
        
        e.preventDefault();
		
		 
       
	    $("#errorClienteS").hide();
        $("#errorselectListaServiciosNoImpresos").hide();

        let User       = $("#confirmarCliente").val()
		let idServicio = $("#selectListaServiciosNoImpresos").val();
		let validaSeleccionServicio = true;
		
        //console.log("User", User)
		
		if (idServicio == "Selecciona"){

            $('#errorselectListaServiciosNoImpresos').show();
            $('#errorselectListaServiciosNoImpresos').html("Elige un servicio no impreso");
            $('#selectListaServiciosNoImpresos').focus();	
            validaSeleccionServicio = false;
		}
		
        if(User == "Selecciona"){
            $('#errorClienteS').show();
            $('#errorClienteS').html("Elige un cliente");
            $('#confirmarCliente').focus();	
            validaSeleccionServicio = false;
        }
        
        //console.log("User", User);
        //console.log("Servicio", idServicio)

    
		

		
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
				
			
				
				
				if(data.resultado){
					
					let unidad = 1;

					let identiFila = 0;

					$(".filaSelecionada").each(function(i,e){

						$(e).find("[indeti]").each((i,e)=>{


						//console.log($(e).text());
					   identiFila = $(e).text();

							identiFila= (unidad + parseInt(identiFila));


						});

					});



					if(identiFila != 0){
						unidad = identiFila;
					}


                   
                  

                    $("#bodySeleccionados").append(`
                        <tr  class="filaSelecionada" data-fila="`+unidad+`" id="tr-`+idServicio+`">
						<td data indeti scope="row" id="idSelecionado">`+unidad+`</td>

                        <td align="center"><a href="#" onclick="consultarSuc('`+data.Servicio[0].idS +`','`+data.Servicio[0].nombreS+`','`+data.Servicio[0].inventario +`')"><i class="simple-icon-magnifier fa-2x"></i></a> </td>
                            <td style="text-align: center" data  scope="row" id="idSelecionado">`+data.Servicio[0].idS+`</td>
                            <td style="text-align: center" class="text-wrap" style="width: 12rem;">`+data.Servicio[0].nombreS+` <div id:"leyendaTipo"><strong  style="color:red;">No impreso</strong></div></td>
                            <td id="unidad-`+unidad+`"style="text-align: center" class="text-wrap" style="width: 15rem;">`+data.Servicio[0].desS+` <div id="desTamanioDinamico-`+unidad+`"></div></td>
							<td id="`+data.Servicio[0].idUnidad+`"style="text-align: center" class="text-wrap" style="width: 15rem;">`+data.Servicio[0].nombreUni+` </td>

                            <td style="text-align: center" data >
							`+( 
								data.Servicio[0].idUnidad == "4" ? 
							   		`<input value="0" min="0" max="100" size="5" type="number" data id="anchoFila-`+unidad+`" onchange="changeCantidad('`+data.Servicio[0].idS+`', '2', '`+unidad+`','`+data.Servicio[0].idUnidad+`')" />` : 
							   	(data.Servicio[0].idUnidad == "5" ? 
								 	`<input value="`+data.Servicio[0].anchoMaterial+`" min=".5" max="100" size="5" type="number" data id="anchoFila-`+unidad+`" onchange="changeCantidad('`+data.Servicio[0].idS+`', '2', '`+unidad+`','`+data.Servicio[0].idUnidad+`')"  disabled/>`:
								 `n/a`) 
							  )
												   
									
							+`						

							</td>
                            <td style="text-align: center" data >
							`+
											
							   (data.Servicio[0].idUnidad == "5" || data.Servicio[0].idUnidad == "4" ? `<input value="0" min="0" max="100" size="5" type="number" data id="altoFila-`+unidad+`" onchange="changeCantidad('`+data.Servicio[0].idS+`', '2', '`+unidad+`','`+data.Servicio[0].idUnidad+`')" />` : `n/a`)
																	   
							+`

							
							</td>

                            <td data style="text-align: center">`+data.Servicio[0].inventario+`</td>
                            <td data precioSer-`+unidad+` id="precio-${idServicio}" style="text-align: center">$<span id="precioSeleccionado-`+unidad+`">`+data.Servicio[0].precioS+`</span><div id:"leyendaPrecio">menudeo</div></td>
							<input precioBaseSer-`+unidad+` type="hidden" value="`+data.Servicio[0].precioS+`" />
							<input precioBaseImp-`+unidad+` type="hidden" value="0" />
                            
                            
                            <td style="text-align: center"><input data value="0" min="0" max="100" size="6" type="number"  id="cantidad-`+unidad+`" onchange="changeCantidad('`+data.Servicio[0].idS+`', '2', '`+unidad+`','`+data.Servicio[0].idUnidad+`')" /></td>
                            <td style="text-align: center" data id="Subtotal-`+unidad+`" class="subtotal">0</td>
                            <td style="text-align: center"><button onclick="quitarDeLista(`+unidad+`)">Quitar</button></td>
                        </tr>
                    `);
                    
				}
           

		})
		.fail();
        $("#btnAgregarServicio").removeAttr("disabled"); 
		
		sumarTabla();

		}else{
            console.log("falta datos por llenar")
        }
     } );

	
	
	
	
	/* *********** Termina agregar producto no impreso *********** */
	
	
	
	
	
	
	
	


     $("#btnVentaRapida").click((e)=>{
		 

       
        
        e.preventDefault();
        
         
       
        $("#errorClienteS").hide();
       
        let User       = $("#confirmarCliente").val()
        let idServicio = 'SDI-Ven-Ven-94235';
        let validaSeleccionServicio = true;
        
  
    
        
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
                "id":'SDI-Ven-Ven-94235'
            }
            
            
        })
        .done((data)=>{
    
            
            console.log("DATOOOS", datos);
            
            if(data.resultado == true) {
             
              toastr["success"]("Producto agregado");

          

              if(data.resultado) {
                let idNuevo = "SDI-Ven-Ven-94235";
                let unidad = 1;
               
				

					let identiFila = 0;

					$(".filaSelecionada").each(function(i,e){

						$(e).find("[indeti]").each((i,e)=>{


						//console.log($(e).text());
					   identiFila = $(e).text();

							identiFila= (unidad + parseInt(identiFila));
							
							console.log("SOY identiFila",identiFila);
							


						});

					});



					if(identiFila != 0){
						unidad = identiFila;
					}
  
                
              
                idServicio = idNuevo;
              
               
                
                $("#bodySeleccionados").append(`
                  <tr class="filaSelecionada" data-fila="`+unidad+`" id="tr-${idServicio}">
							<td data indeti scope="row" id="idSelecionado">`+unidad+`</td>
                            <td style="text-align: center" colspan="2" data scope="row" id="idSelecionado">${idServicio}</td>
                            <td style="text-align: center" class="text-wrap" style="width: 12rem;">${data.Servicio[0].nombreS}</td>
                            <td data style="text-align: center" class="text-wrap" style="width: 15rem;"><textarea class="form-control" rows="3" data id="comentario-${idServicio}"></textarea></td>
                            <td style="text-align: center" data>n/a</td>
							<td style="text-align: center" data>n/a</td>
                            <td data style="text-align: center">n/a</td>
                            <td data style="text-align: center">n/a</td>
                           
                            <td data style="text-align: center"><input value='0' min="0" max="`+data.Servicio[0].inventario +`" size="5" type="number" onchange="changeCantidad('`+data.Servicio[0].idS+`', '3', '`+unidad+`','0')" data id="precioSeleccionado-`+unidad+`"/></td>
                            

                            <td style="text-align: center"><input data value="1" min="0" max="100" size="6" type="number"  id="cantidad-`+unidad+`" onchange="changeCantidad('`+data.Servicio[0].idS+`', '3', '`+unidad+`','0')" /></td>
                            <td style="text-align: center" data id="Subtotal-`+unidad+`" class="subtotal">0</td>
                            <td style="text-align: center"><button id="quite-${idServicio}" onclick="quitarDeLista(`+unidad+`)">Quitar</button></td>
                        </tr>
                    `);
                    console.log("entro en 2 subtotal")
                    agregarDato(idServicio)
                    subTotalServicio(idServicio,data.Servicio[0].precioS,unidad)
                }
            }else{
                toastr["warning"]("El servicio ya se encuentra en la lista");
            }

        })
        .fail();
       
        
        sumarTabla();

        }else{
            console.log("falta datos por llenar")
        }
     } );
    
   
});



/*****************      Termina Ready      ******************/
/*****************      Termina Ready      ******************/
/*****************      Termina Ready      ******************/


function changeCantidad(id, categoria , fila, idUnidad){
	
	//console.log("Cambio de cantidad " + id + "  Categori " + categoria );
	
	$("#desTamanioDinamico-"+fila).html("");
	
	/*****************      Impresos   ******************/
	let cantidad= $("#cantidad-"+fila).val(); 
	
	console.log("Soy cantidad",cantidad);
	
	
	
	let precioBase = $("[preciobaseser-"+fila+"]").val();
	
	console.log("Soy precio base",precioBase);
	
	
	let precioBaseImp = $("[precioBaseImp-"+fila+"]").val();
	
	
	let altoFila = 0;
	let anchoFila = 0;
	let cantidadMetros = 0;
	
	console.log("Soy idUnidad",idUnidad);
	
	console.log("Soy el idVentasrapidas",id);
	
	console.log("Soy fila",fila);
	
	console.log("Soy categoria",categoria);
	
	
	
	
	
	
	
	
	
	
	precioFinal = precioBase;
	precioFinalImpresion = precioBaseImp;
	//precioImpresion = 
	leyenda = "";
	leyendaImpresion = "";
	cantidadMayor = 0;
	
	//validadacion cantidades negativas
	
	if(cantidad <= 0){

		$("[precioSer-"+fila+"]").html(`$<span id="precioSeleccionado-`+fila+`">`+(parseFloat(precioBase)+parseFloat(precioBaseImp))+`</span><div id:"leyendaPrecio">menudeo</div>`);
		
	}else{
		
		
		
		altoFila = $("#altoFila-"+fila).val();
		anchoFila = $("#anchoFila-"+fila).val();
		
		
		if (altoFila == undefined){
			altoFila = '0';
		}
		if (anchoFila == undefined){
			anchoFila = '0';
		}
		
		
		
		console.log(anchoFila, " ", altoFila );
		
		cantidadMetros = (cantidad * (parseFloat(anchoFila) * parseFloat(altoFila)));
		
		//validadcion cantidad metros
		
		
		console.log(cantidadMetros);
		
		
		if(idUnidad != '4' || idUnidad != 5 ){
			
			cantidadMetros = 1;
			
		}
		
		if(cantidadMetros <= 0 ){
			
			$("[precioSer-"+fila+"]").html(`$<span id="precioSeleccionado-`+fila+`">`+(parseFloat(precioBase)+parseFloat(precioBaseImp))+`</span><div id:"leyendaPrecio">menudeo</div>`);
			
			
		}else{
			
			
			if(categoria == "1"){

				$.ajax({
					url: base_url()+"app/Aldair/LevantarOrden/consultaPrecios",
					dataType: "JSON",
					type: "post",
					data:{
						id: id,
						categoria: categoria
					}

				})
				.done((data)=>{

				if(data.resultado){
					
					
					
					
					if(idUnidad == '4' || idUnidad == '5'){
						
							$.each(data.precios, function(i,o){

								if(parseFloat(cantidadMetros) >= parseFloat(o.cantidad) && o.categoria == "2" ){

									let respuesta = parseFloat(cantidadMetros) >= parseFloat(o.cantidad) ? "Si": "no";

									console.log("La cantidad " + cantidad + " es mayor o = que " + o.cantidad  + " " + respuesta );

									cantidadMayor = cantidadMetros;
									precioFinal = o.precio;
									leyenda = o.desPreSer;

								}

								if(parseFloat(cantidadMetros) >= parseFloat(o.cantidad) && o.categoria == "1" ){

									let respuesta = parseFloat(cantidadMetros) >= parseFloat(o.cantidad) ? "Si": "no";

									console.log("La cantidad " + cantidadMetros + " es mayor o = que " + o.cantidad  + " " + respuesta );

									cantidadMayor = cantidadMetros;
									precioFinalImpresion = o.precio;
									leyendaImpresion = o.desPreSer;

								}


							});


							console.log("cantidad: ", cantidadMetros," cantidad mayoe: ",  cantidadMayor);


							if(cantidadMetros > cantidadMayor){

								$("[precioSer-"+fila+"]").html(`$<span id="precioSeleccionado-`+fila+`">`+(parseFloat(precioBase)+parseFloat(precioBaseImp))+`</span><div id:"leyendaPrecio">menudeo</div>`);


								$("#desTamanioDinamico-"+fila).html(cantidadMetros.toFixed(2) + " metros");
							 }else{

								let suma = (parseFloat(precioFinalImpresion)+parseFloat(precioFinal));

								console.log("base: ", precioFinal," impr: ",  precioFinalImpresion, " suma base: ",suma );

								$("[precioSer-"+fila+"]").html(`$<span id="precioSeleccionado-`+fila+`">`+(parseFloat(precioFinal)+parseFloat(precioFinalImpresion))+`</span><div id:"leyendaPrecio">`+(leyenda + (leyenda != "" ? ",": "") + " " + leyendaImpresion)+`</div>`);

								//$("[precioSer-"+fila+"]").html(`$`+precioFinal+`<div id:"leyendaPrecio">`+leyenda+`</div>`);
								$("#desTamanioDinamico-"+fila).html(cantidadMetros.toFixed(2) + " metros");
							}	
						
						//termina impresos metros cuadrados y metros lineales 

						}else{
							
							
								$.each(data.precios, function(i,o){
									
									//compara precio dinamico de producto con cantidad

									if(parseFloat(cantidad) >= parseFloat(o.cantidad) && o.categoria == "2" ){

										let respuesta = parseFloat(cantidad) >= parseFloat(o.cantidad) ? "Si": "no";

										console.log("La cantidad " + cantidad + " es mayor o = que " + o.cantidad  + " " + respuesta );

										cantidadMayor = cantidad;
										precioFinal = o.precio;
										leyenda = o.desPreSer;

									}
									
									//compara precio dinamico de la impresión  con cantidad

									if(parseFloat(cantidad) >= parseFloat(o.cantidad) && o.categoria == "1" ){

										let respuesta = parseFloat(cantidad) >= parseFloat(o.cantidad) ? "Si": "no";

										console.log("La cantidad " + cantidad + " es mayor o = que " + o.cantidad  + " " + respuesta );

										cantidadMayor = cantidad;
										precioFinalImpresion = o.precio;
										leyendaImpresion = o.desPreSer;

									}


								});


							console.log("cantidad: ", cantidad," cantidad mayoe: ",  cantidadMayor);


							if(cantidad > cantidadMayor){

								$("[precioSer-"+fila+"]").html(`$<span id="precioSeleccionado-`+fila+`">`+(parseFloat(precioBase)+parseFloat(precioBaseImp))+`</span><div id:"leyendaPrecio">menudeo</div>`);


								//$("#desTamanioDinamico-"+fila).html(cantidad + " metros");
							 }else{

								let suma = (parseFloat(precioFinalImpresion)+parseFloat(precioFinal));

								console.log("base: ", precioFinal," impr: ",  precioFinalImpresion, " suma base: ",suma );

								$("[precioSer-"+fila+"]").html(`$<span id="precioSeleccionado-`+fila+`">`+(parseFloat(precioFinal)+parseFloat(precioFinalImpresion))+`</span><div id:"leyendaPrecio">`+(leyenda + (leyenda != "" ? ",": "") + " " + leyendaImpresion)+`</div>`);

								//$("[precioSer-"+fila+"]").html(`$`+precioFinal+`<div id:"leyendaPrecio">`+leyenda+`</div>`);
								//$("#desTamanioDinamico-"+fila).html(cantidad + " metros");
							}	
						
							
							

						}//termina iimpresos que no son cuadrados o lineales

						

					}
					
					subTotalServicio(fila, idUnidad, cantidad, cantidadMetros);
					
				})//termina done


				.fail();


				/*****************      no impresos    ******************/
			}else if(categoria == "2"){


				$.ajax({
					url: base_url()+"app/Aldair/LevantarOrden/consultaPrecios",
					dataType: "JSON",
					type: "post",
					data:{
						id: id,
						categoria: categoria
					}

				})
				.done((data)=>{

					if(data.resultado){
						
						
						
						
						
						
						if(idUnidad == '4' || idUnidad == '5'){
							
							$.each(data.precios, function(i,o){

								if(parseFloat(cantidadMetros) >= parseFloat(o.cantidad) ){

									let respuesta = parseFloat(cantidadMetros) >= parseFloat(o.cantidad) ? "Si": "no";

									console.log("La cantidad " + cantidadMetros + " es mayor o = que " + o.cantidad  + " " + respuesta );

									cantidadMayor = cantidadMetros;
									precioFinal = o.precio;
									leyenda = o.desPreSer;

								}

							});


							if(cantidadMetros > cantidadMayor){

								let precioBase = $("[preciobaseser-"+fila+"]").val();

								console.log(precioBase);

								$("[precioSer-"+fila+"]").html(`$<span id="precioSeleccionado-`+fila+`">`+precioBase+`</span><div id:"leyendaPrecio">menudeo</div>`);
								$("#desTamanioDinamico-"+fila).html(cantidadMetros.toFixed(2) + " metros");

							}else{

								$("[precioSer-"+fila+"]").html(`$<span id="precioSeleccionado-`+fila+`">`+precioFinal+`</span><div id:"leyendaPrecio">`+leyenda+`</div>`);

								//$("[precioSer-"+fila+"]").html(`$`+precioFinal+`<div id:"leyendaPrecio">`+leyenda+`</div>`);
								$("#desTamanioDinamico-"+fila).html(cantidadMetros.toFixed(2) + " metros");

							}	
							
						//No impresos metros cuadrados y metros lineales 	
							
						}else{
							
							
							
							$.each(data.precios, function(i,o){

								if(parseFloat(cantidad) >= parseFloat(o.cantidad) ){

									let respuesta = parseFloat(cantidadMetros) >= parseFloat(o.cantidad) ? "Si": "no";

									console.log("La cantidad " + cantidadMetros + " es mayor o = que " + o.cantidad  + " " + respuesta );

									cantidadMayor = cantidad;
									precioFinal = o.precio;
									leyenda = o.desPreSer;

								}

							});


							if(cantidad > cantidadMayor){

								let precioBase = $("[preciobaseser-"+fila+"]").val();

								console.log("base ", precioBase);

								$("[precioSer-"+fila+"]").html(`$<span id="precioSeleccionado-`+fila+`">`+precioBase+`</span><div id:"leyendaPrecio">menudeo</div>`);
								//$("#desTamanioDinamico-"+fila).html(cantidad + " pieza");

							}else{

								$("[precioSer-"+fila+"]").html(`$<span id="precioSeleccionado-`+fila+`">`+precioFinal+`</span><div id:"leyendaPrecio">`+leyenda+`</div>`);

								//$("[precioSer-"+fila+"]").html(`$`+precioFinal+`<div id:"leyendaPrecio">`+leyenda+`</div>`);
								//$("#desTamanioDinamico-"+fila).html(cantidad + " metros");

							}
							
						}// termina calculo de precios dinamicos que no son por metro cuadrado o lineal
						

					

					}// termina resultado
					
					subTotalServicio(fila, idUnidad, cantidad, cantidadMetros);


				})//termina done
				.fail();


				/*****************     servicios rapidos     ******************/
			}else if(categoria == "3"){
				
				console.log("Soy fila",fila);
				
				
				console.log("Soy cantidad",cantidad);
				
				
				
				subTotalServicio(fila,3,cantidad);
				
				

				
				

				
				
				
				

				
				
			
			
			
			
			
			
			}else{
			
			
			
			
			}
			
			
			
		}
		
		
		// termina validadcion cantidad metros
		
		/*
			else if(categoria == "3"){

				$.ajax({
					url: base_url()+"app/Aldair/LevantarOrden/consultaPrecios",
					dataType: "JSON",
					type: "post",
					data:{
						id: id,
						categoria: categoria
					}

				})
				.done((data)=>{

					console.log("rapidos ",data);

				})
				.fail();

			}*/
		
	}
	
	
	//Termina else de comprobacion si es menor a 0 cantidad 
	
	
	
	
	
}


/********* termina cambio de revision en precio  ************/








/**************  Cambio en el subtotal    ****************/

function subTotalServicio(fila, idUnidad, cantidad, cantidadMetros){
	

	
	console.log("Soy fila",fila);
	
	console.log("SOY Idunidad",idUnidad);
	
	console.log("Soy cantidad",cantidad);
	
	
	
	
	let subTotal = 0;
	
	if(cantidad < 0){
		cantidad = cantidad * -1;
	}
	
	
	let precio = $("#precioSeleccionado-"+fila).text();
	
	console.log("precio para operar ", precio);

	
	
	//console.log("SubTotal ", fila," ", idUnidad, " ",  cantidad, " Precio: ", precio);
	
	
	// son metros LINEALES
	if(idUnidad == "5"){
		
		console.log("cant metros: ", cantidadMetros);
		
		let anchoMaterial = $("#anchoFila-"+fila).val();
	
		if(cantidadMetros <= anchoMaterial){
			
			
			cantidadMetros <= 0 ? subTotal = 0 : subTotal = (parseFloat(cantidad) * parseFloat(precio));
			
			
			
		}else{
			
			
			
			subTotal = (parseFloat(cantidad) * (parseFloat(precio)* (cantidadMetros)));
			
		}
		

		
	// 4 son metros CUADRADOS	
	}else if(idUnidad =="4"){
		
		console.log("cant metros: ", cantidadMetros);
		
		
		if(cantidadMetros <= 1){
			
			cantidadMetros <= 0 ? subTotal = 0 : subTotal = (parseFloat(cantidad) * parseFloat(precio));
			
			
			
		}else{
			
			subTotal = (parseFloat(cantidad) * (parseFloat(precio)* (cantidadMetros)));
			
		}		 
	
	}else if(idUnidad == "0"){
		
		precio = $("#precioSeleccionado-"+fila).val();
		
		
		subTotal = (parseFloat(cantidad) * parseFloat(precio));
		
		}else{
			
			subTotal = (parseFloat(cantidad) * parseFloat(precio));		
		
		}
	if(idUnidad == "3"){
			console.log("entre en la unidad en 3");
			
			
			precio = $("#precioSeleccionado-" + fila).val();
			
			console.log("Soy precio de unidad 3",precio);
			
			
			subTotal = (parseFloat(cantidad) * parseFloat(precio));
			
			
			console.log("Soy subTotal  ",subTotal);
			
			
			
	
	
	}	
	
	
	console.log(subTotal);
	
	$("#Subtotal-"+fila).html(subTotal.toFixed(2));
	
	
	
	sumarTabla();
	
	
}


/******* Termina cambio en subtotal ********/




function changeAncho(){
	
	console.log("Cambio ancho");
	
}

function changeLargo(){
	
	console.log("Cambio de cantidad");
	
}




let firmadoPuntos = false
let totalFinal = 0;



let datos = [];
let contadorID = 0;




function agregarDato(idServicios){

    console.log("idServicios", idServicios)

    if (idServicios.startsWith("SDI-Ven-Ven-")) {
        datos.push({ id: contadorID++, Servicio: idServicios });
        console.log("Se añadio el listado ventas rapidas", datos)
        return true;
    }
    // else if(idServicios.startsWith("SDI-Gra-Lon-")){
    //     datos.push({ id: contadorID++, Servicio: idServicios });
    //     console.log("Se añadio la lona", datos)
    //     return true;
    // }
    else{
        let servicioExiste = datos.some(r => r.Servicio === idServicios);

        if (!servicioExiste) {
            datos.push({ id: contadorID++, Servicio: idServicios});
            console.log("Se añadio el listaod", datos)
            return true;
        }else{
            console.log("Ya esta registrado", datos)
            
        }
    }
  }
function  getIDgeneral(idServicio){ // push data array para generar el id general de cada producto, aplica solo para Lonas y productos registrados.
    

    if(idServicio.startsWith("SDI-Gra-")){
        console.log("entro aqui bb 22222")
        datos.push({ id: contadorID++, Servicio: idServicio});
        return true;
    }
    else{
        let existeProducto = datos.some(r => r.Servicio === idServicio);
        if(!existeProducto){
            datos.push({ id: contadorID++, Servicio: idServicio});
             return true;
        }else{
            console.log("producto ya registrado")
            return false;
        }
        
        
    }
}
function validaCarrito(idServicio){

    console.log("idServiciossss", idServicio)
    console.log("datos", datos)

    let existeProducto = datos.some(r => r.Servicio === idServicio);

        if(!existeProducto){
            console.log("entro aqui bb 1")
            return true;

        }else if(idServicio.startsWith("SDI-Gra-")){
           
            return true;
        }
        
        else{
            console.log("entro aqui bb 2")
            return false;
        }

}





function quitarDeLista(id){
	
	$("tr[data-fila="+id+"]").remove();
	
	sumarTabla();
	
}


function validar(valor) {
    if (valor === undefined || valor === null || valor === '') {
      return false; // la variable está vacía
    }
    if (isNaN(valor) || parseFloat(valor) < 0) {
      return false; // la variable no es un número o es negativa
    }
    return true; // la variable es válida
}


function precioGranFormato(idServicio,cant){

    console.log("idServicio precioGranFormato", idServicio)
    console.log("cant precioGranFormato", cant)


    let precio  = $("#precio-"+idServicio).html();
    let pmm     = $("#pmm-"+idServicio).html();
    let pm      = $("#pm-"+idServicio).html();
    let cmm     = $("#cmm-"+idServicio).html()
    let cm      = $("#cm-"+idServicio).html()


    //15may23 se condiciona para proximas servicios- viniles,lonas etc.

       pmm    =  parseFloat(pmm.replace('$', ''))
       pm     =  parseFloat(pm.replace('$', ''))
       precio =  parseFloat(precio.replace('$', ''))
       cm     =  parseFloat(cm)
       cmm    =  parseFloat(cmm)

    if(idServicio.startsWith("SDI-Vin-")){
        if (cant >= parseInt(cm) && parseFloat(pm) !== 0) {
            console.log("entreo pm")
           return precio = parseFloat(pm);
        } else if (cant >= parseInt(cmm) && parseFloat(pmm) !== 0) {
            console.log("entreo pmm")
            return precio = parseFloat(pmm);
        }
        else{
            console.log("entreo precio")
            return precio = parseFloat(precio);
        }
    }
    else if(idServicio.startsWith("SDI-Gra-")){
        if (cant >= parseInt(cm) && parseFloat(pm) !== 0) {
            console.log("entreo pm")
           return precio = parseFloat(pm);
        } else if (cant >= parseInt(cmm) && parseFloat(pmm) !== 0) {
            console.log("entreo pmm")
            return precio = parseFloat(pmm);
        }
        else{
            console.log("entreo precio")
            return precio = parseFloat(precio);
        }
    }else{
        console.log("entro en el else y eso es malo")
        return precio = parseFloat(precio);
    }
        

}







function subTotalServicio2(id , id2, inv,cantidadMayoreo ,precioMayoreo,cantidadMedioMayoreo,precioMedioMayoreo,unidad){
    console.log("idServicio<<:", id)


    var precioInput = $("#precio-"+id).val();
    let precio = id2;
    console.log("precioInput", precioInput)
    console.log("precio hoy", precio)


    let altura = $("#altura-"+id).val();
    let ancho = $("#ancho-"+id).val();



   

    

	let cantidad = $("#cantidad-"+id).val();
    let inventario = inv;   
    // nota: la variable de Precio (base,entrada, etc) el digitado no aplica, para ventas rapidas debe ser -1, es un comodin para las validaciones. has console log a todas las variables para ver que es lo que se estan recibiendo
    let subtotal = 0;
    

    
    console.log("Preciiio",precio)
   
    //Operacion para lonas

    if (id == null) {
        return id = 0;
    }

    


    if(id.startsWith("SDI-Gra-") || id.startsWith("SDI-Vin-")){

        let element = $("td[id='unidad-" + unidad + "']"); // Buscar el elemento por el atributo "id" y el atributo "unidad"
        let idValue = element.attr("id");

        
        console.log("Valor del contenido:", idValue);
        var Unidad = parseInt(idValue.match(/\d+/)[0]);
        Unidad = parseInt(Unidad);

        // var precio$Lonas = $("#precio-"+id).html(); // "Preciiio valor $50.00"
        // var precioFL     = parseFloat(precio$Lonas.replace('$', ''))
        let cantidad     = $("#calcularLona-"+id).val();

        console.log("altura", altura)
        console.log("ancho", ancho)
        console.log("cantidad2", cantidad)

        validar(altura)
        validar(ancho)

        console.log("entro aqui bb 1 jeje")




        if(validar(altura) && validar(ancho)){
            //realizamos la operacion para obtener el precio del gran formato
            
           

            let op = precioGranFormato(id,cantidad); //mandamos la data para hacer la operación

            console.log("op", op)
            console.log("todo correcto")
            let operacion = (parseFloat(altura) * parseFloat(ancho)).toFixed(2);
            parseFloat(operacion)

            let multi = 0;
            //Agregamos nuevos parametros con respecto al servicio.

            if(id.startsWith("SDI-Vin-")){// para viniles de 0.5 de momento
                console.log("operacion zz "+operacion)

                if(Unidad == 5){
                    console.log("metro lineal")

                    if (parseFloat(altura) <= 0.49 && cantidad >=0) {
                        subtotal = parseFloat((op * cantidad)).toFixed(2) 
                        console.log("1, subtotal V"+ subtotal) 
                        $("#validaINV").val(1);
                        $("#btnOrden").removeAttr("disabled")
        
                    }else if (parseFloat(altura)  >= 0.50 && cantidad >=1){
                        if (cantidad >= 2) {
                            // subtotal = ((parseFloat(op) * parseFloat(operacion)).toFixed(2))/ 0.50;
                            // subtotal = parseFloat(subtotal) * parseFloat(cantidad);
                            subtotal  = ((parseFloat((op / 0.50))* altura) * parseFloat(cantidad)).toFixed(2)

                            console.log("2 -1, subtotal V"+ subtotal)
                        }else{
                            //subtotal = ((parseFloat(op) * parseFloat(operacion)).toFixed(2))/ 0.50
                            subtotal  = ((parseFloat((op / 0.50))* altura)).toFixed(2)
                            console.log("2 -2, subtotal V"+ subtotal)
                        }
                       
                        $("#validaINV").val(1);
                        $("#btnOrden").removeAttr("disabled")
                    }else{
                        console.log("ambsiedad")
                        $("#validaINV").val(0);
                        $("#btnOrden").attr("disabled", "disabled")
                    }
                }else{
                    console.log("metro 2")
                    if (operacion <= 0.99 && cantidad >=0) {
                        subtotal = parseFloat((op * cantidad)).toFixed(2) 
                        console.log("1, subtotal V"+ subtotal) 
                        $("#validaINV").val(1);
                        $("#btnOrden").removeAttr("disabled")
        
                    }else if (parseFloat(altura)  >= 1 && cantidad >=1){
                        if (cantidad >= 2) {
                            // subtotal = ((parseFloat(op) * parseFloat(operacion)).toFixed(2))/ 0.50;
                            // subtotal = parseFloat(subtotal) * parseFloat(cantidad);
                            subtotal = (parseFloat(op) * parseFloat(operacion)).toFixed(2);
                            subtotal = parseFloat(subtotal) * parseFloat(cantidad);

                            console.log("2 -1, subtotal V"+ subtotal)
                        }else{
                            //subtotal = ((parseFloat(op) * parseFloat(operacion)).toFixed(2))/ 0.50
                            subtotal = (parseFloat(op) * parseFloat(operacion)).toFixed(2);
                            console.log("2 -2, subtotal V"+ subtotal)
                        }
                       
                        $("#validaINV").val(1);
                        $("#btnOrden").removeAttr("disabled")
                    }else{
                        console.log("ambsiedad")
                        $("#validaINV").val(0);
                        $("#btnOrden").attr("disabled", "disabled")
                    }
                }
            }
            
            else if(id.startsWith("SDI-Gra-")){ // para gran formato
                if (operacion <= 0.99) {
                    subtotal = parseFloat((op * cantidad)).toFixed(2) 
                    console.log("1, subtotal G"+ subtotal) 
                    $("#validaINV").val(1);
                    $("#btnOrden").removeAttr("disabled")
                }else if (operacion >= 1){
                    if (cantidad >= 2) {
                        subtotal = (parseFloat(op) * parseFloat(operacion)).toFixed(2);
                        subtotal = parseFloat(subtotal) * parseFloat(cantidad);
                        console.log("2 -1, subtotal G"+ subtotal)
                    }else{
                        subtotal = (parseFloat(op) * parseFloat(operacion)).toFixed(2);
                        console.log("2 -2, subtotal G"+ subtotal)
                    }
                   
                    $("#validaINV").val(1);
                    $("#btnOrden").removeAttr("disabled")
                }else{
                    console.log("ambsiedad")
                    $("#validaINV").val(0);
                    $("#btnOrden").attr("disabled", "disabled")
                }
            }else{
                console.log("ambsiedad")
                $("#validaINV").val(0);
                $("#btnOrden").attr("disabled", "disabled")
            }
        }else{
            toastr["warning"]("Aviso: Verifique que los campos de altura y ancho esten completos y sean numeros positivos")
            subtotal = 0;
            $("#validaINV").val(0);
            $("#btnOrden").attr("disabled", "disabled")
        }

        $("#Subtotal-"+id).html(subtotal);
        sumarTabla(inventario,cantidad);
        return subtotal;
          
    }
    
    // if(id.startsWith("SDI-Ven-Ven-") ){
        
    //     console.log("Cantidad de venta rapidad" , cantidad)
        
    //     $("#Subtotal-"+id).html(subtotal);
    //     sumarTabla(inventario,cantidad);
    //     return subtotal;
    // }



    if (precioInput == null){
        precioInput = 0;
        
    }else{
        
        //validamos que la cantidad de venta rapida no sea negativo
        if(!parseInt("-" + cantidad) && parseInt(cantidad) < 0  ){

            subtotal = 0;
            toastr["warning"]("Aviso: No se permite cantidades negativas")
            
       
        }else if(!parseInt("-" + precioInput) && parseInt(precioInput) < 0 ){
            subtotal = 0;
            toastr["warning"]("Aviso: No se permite precios negativo")
            return false;
        }
        console.log("entro en else", precioInput)
        console.log("cantidad else", cantidad)
        
    }


   

    if(parseInt(cantidad) > parseInt(inventario)){
        toastr["warning"]("No hay suficientes productos en inventario: Solo hay "+inventario+" unidades");
          $("#cantidad-"+id).val(cantidad);
         
         subtotal = 0;
         if(parseInt(cantidad)<=0){
            toastr["warning"]("El minimo de venta es de 1 unidad");
             $("#cantidad-"+id).val(cantidad);
             subtotal = 0
         }
       
    }
    else if(parseInt(cantidadMedioMayoreo) == 0 && parseInt(id2) != -1){
        subtotal = precio * cantidad;
        $("#cantidad-"+id).val(cantidad);
        console.log("mayoreo")
    }
    else if(parseInt (cantidadMayoreo) == 0 && parseInt(id2) != -1){
        subtotal = precio * cantidad;
        $("#cantidad-"+id).val(cantidad);
        console.log("medio maoyoreo")
    }
    else{
        console.log("si hay")
        
        
         
         if (cantidad >= parseInt(cantidadMedioMayoreo) && cantidad <  parseInt (cantidadMayoreo) && parseInt(id2) != -1) {
            console.log("entro en medio mayoreo")
           subtotal = parseFloat(precioMedioMayoreo) * cantidad;
         }else if (cantidad >= parseInt(cantidadMayoreo) && parseInt(id2) != -1) {
            console.log("entro en  mayoreo")
            subtotal = parseFloat(precioMayoreo) * cantidad;
         }
         else if(precio == -1 && parseInt(cantidad) >= 1 ){
            console.log("Entrar operacion venta rapida")
            subtotal = precioInput * cantidad;
        }else if (!parseInt("-" + cantidad)){
            subtotal = 0;
        }else if (!parseInt("-" + cantidad) && parseInt(cantidad) < 0){
            
            console.log("No se permite cantidades negativas",cantidad);
            toastr["warning"]("Aviso: No se permite cantidades negativas 2")
            subtotal = 0;
        }
         else {
            subtotal = precio * cantidad;
            // console.log("entro en precio base")
            // console.log("Valor",precioInput)
            // console.log("cantidad",cantidad)
            // console.log("Precio",precio)
          
            console.log("entro en subtotal")

         }

        $("#cantidad-"+id).val(cantidad);

        


        
    }



	$("#Subtotal-"+id).html(subtotal);

    if(parseInt(cantidad) > inventario || parseInt(cantidad) <= 0){
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
	
	$("#btnOrden").removeAttr("disabled");
	
	var sumaTotal = 0;
    
	
	$('.subtotal').each(function() {

        sumaTotal += Number($(this).text());

        if($(this).text() == "0" || sumaTotal <= 0 || $(this).text() == "0.00"){
        $("#validaINV").val(0);
        $("#btnOrden").attr("disabled", true);
        }
       

    });


  
   
	
	totalFinal = sumaTotal; 
	
	
	
	
	
	$("#totalSuma").html(sumaTotal + " MXN");
}


function editarTab(){

    $("#first-tab").removeClass("active");
    $("#second-tab").addClass("active");
}


/*

const levantarOrden = () => {
   
    $.ajax({
        url: base_url() + "app/Aldair/LevantarOrden/ListaOrdenesLE",
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

*/

const GenerarPDF = ( ) => {
    alert("En construccion") 
}


function listaServiciosNoImpresos(){
    
    axios(base_url()+"app/Aldair/LevantarOrden/verServiciosNoImpresos")
    .then(({data})=>{

       

        if(data.resultado){

            $("#selectListaServiciosNoImpresos").html(`<option value="Selecciona">--Selecciona --</option>`);

            $.each(data.ServiciosNoImpresos, function(i,o){

                let servicio = "<strong>" + o.nombreS + "</strong>";

                if(o.estatus == 1){
                    $("#divListaServiciosNoImpresos").find("select").append(`

                    <option value=`+o.idS+`>`+"P/S: "+servicio+ ". Descripción: " +o.desS+ ". Stock: " +o.inventario+`</option>
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



} // termina lista servicios no impresos



function listaServicios(){
    
    axios(base_url()+"app/Aldair/LevantarOrden/verServicios")
    .then(({data})=>{

       

        if(data.resultado){

            $("#selectListaServicios").html(`<option value="Selecciona">--Selecciona --</option>`);

            $.each(data.Servicios, function(i,o){

                let servicio = "<strong>" + o.nombreS + "</strong>";

                if(o.estatus == 1){
                    $("#divListaServicios").find("select").append(`

                    <option value=`+o.idS+`>`+"P/S: "+servicio+ ". Descripción: " +o.desS+ ". Stock: " +o.inventario+`</option>
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
    
    let User =  $("#idCliente").val();
  

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


    
const insertaAgrupaServicios = async()=>{
    $("#puntos").hide()
    $("#desglosePuntos").hide()
    try {
        const programa = await consultarPrograma();
        console.log("programa", programa);
        if(programa.programa){
            $("#modalCarrito").modal("show");
        }else{
            toastr["warning"]("Hubo un error al consultar el programa de puntos");
            location.reload();
        }
       
      
    } catch (error) {
        toastr["warning"]("Hubo un error al consultar el programa de puntos");
        location.reload();
        return false;
    }


    let User       = $("#confirmarCliente").val()
    usuario =  obtenerValorNumerico(User)
    obtenerPuntos(usuario)

    if (usuario == 0) {
        $("#desglosePuntos").hide()
    }else{
        if(firmadoPuntos == 1){
            $("#desglosePuntos").hide()
           
        }else{
            $("#desglosePuntos").show()
        }
      
    }

    


    tiposPagos()
    infoCliente()
    

   
    $("#selectPago").empty("")

 

        if(accion == "editar"){
            estatus = $("#estatusAS").val();
        }

    
    let i=0;

    const arregloFinal=new Array();
    
    $('.filaSelecionada').each(function(i,e) {

        const arregloPorFila=new Array();

        $(e).find("[data]").each((i,e)=>{

            if($(e).is("input") || $(e).is("textarea")){
                
                console.log($(e).val());
                arregloPorFila.push($(e).val());

            }else{
                //console.log($(e).text());
                arregloPorFila.push($(e).text());
            }
        });
        arregloFinal.push(arregloPorFila);

   
     
    });

   

    console.log("soy arreglo final",arregloFinal);
	
	
    
    //includes nos permite buscar un valor en un array y nos devuelve true o false, en caso que este , el filter lo va guardar en BuscadorVR.
    const BuscadorVR     = arregloFinal.filter(array => array.toString().startsWith("SDI-Ven-Ven-"));  // buscamos en iterar todo el array que se crear los que tenga el valor "SDI-Ven-Ven-101153" y lo guardamos en BuscadorVR
    const BuscadorLonas  = arregloFinal.filter(array => array.toString().startsWith("SDI-Gra-"));  // buscamos en iterar todo el array que se crear los que tenga el valor "SDI-Ven-Ven-101154" y lo guardamos en BuscadorLonas
    const BuscaFomartoPq = arregloFinal.filter(array => array.toString().startsWith("SDI-Vin-"));

    const CarritoProductos  = arregloFinal.filter(array => !array.toString().startsWith("SDI-Gra-") && !array.toString().startsWith("SDI-Ven-Ven-") && !array.toString().startsWith("SDI-Vin-")); 

    console.log("soy BuscadorVR",BuscadorVR);
    // recomendacion: has consolo.log de cada uno de los Buscadores para que veas que te devuelve y asi puedas entender mejor el codigo. AMEN
   
    const FormatoPequeno = BuscaFomartoPq.map(subArray => {
        return {
          idServicio: subArray[0],
          Cantidad: parseFloat(((parseFloat(subArray[2])* parseFloat(subArray[4])* parseFloat(subArray[11]))).toFixed(2)),
          PrecioUnitario: parseFloat(subArray[12]).toFixed(2),
          ProductoComentario: `Medidas: largo: ${subArray[2]} mt, ancho: ${subArray[4]} mt, Cantidad: `+  subArray[11],
          subtotal:parseFloat(subArray[12]).toFixed(2),
          CantidadBase: subArray[11],
          PrecioBase: subArray[6].replace('$', ''),
          CantidadMedioMayoreo: subArray[7],
          PrecioMedioMayoreo: subArray[8].replace('$', ''),
          CantidadMayoreo: subArray[9],
          PrecioMayoreo: subArray[10].replace('$', ''),
          Largo: parseFloat(subArray[2]),
          Ancho: parseFloat(subArray[4])

        }
      })

      console.log("Original BuscaFomartoPq" ,BuscaFomartoPq)


    //   console.log("soy FormatoPequeno",FormatoPequeno);
    //   let FormatoPQ = [];


    //   FormatoPequeno.forEach(item => {
    //     const idServicio = item.idServicio;
    //     const cantidad = parseInt(item.CantidadBase);
    //     let precio     = parseFloat(item.PrecioBase);
    //     const subtotal = parseFloat(item.subtotal);
    //     const largo    = parseFloat(item.Largo);
        
      
    //     if (cantidad >= parseInt(item.CantidadMayoreo) && parseFloat(item.PrecioMayoreo) !== 0) {
    //       precio = parseFloat(item.PrecioMayoreo);
    //     } else if (cantidad >= parseInt(item.CantidadMedioMayoreo) && parseFloat(item.PrecioMedioMayoreo) !== 0) {
    //       precio = parseFloat(item.PrecioMedioMayoreo);
    //     }

    //     let unidad = 0;


    //     if(idServicio != undefined){
    //         console.log("entramos aqui")
    //         $.ajax({
    //             "url": base_url()+"app/Aldair/LevantarOrden/verServicio",
    //             "dataType":"JSON",
    //             "type":"POST",
    //             "data":{
    //                 "id":idServicio
    //             }
                
                
    //         }).done((data)=>{
                    
    //             console.log("soy data",data);
        
    //              unidad = parseInt(data.Servicio[0].idUnidad);
             
    //              if(unidad == 5){
    //                 console.log("entro 5")
    //                 FormatoPQ.push({ idServicio, Cantidad: parseFloat(cantidad * largo).toFixed(2), PrecioUnitario: precio.toFixed(2), subtotal: subtotal.toFixed(2), ProductoComentario: item.ProductoComentario});
           
    //                }else if (unidad == 4){
    //                 console.log("entro 4")
    //                 FormatoPQ.push({ idServicio, Cantidad: item.Cantidad, PrecioUnitario: precio.toFixed(2), subtotal: subtotal.toFixed(2), ProductoComentario: item.ProductoComentario});
    //                }
    //                else{console.log("entro else Unidad")
                    
    //                     console.log("Hay un error");
    //                     return  
    //                }
    //                console.log("soy gran FormatoPequeno 2",FormatoPQ);
                  
    //         }).fail();
    //     }
        
       
        
      
        
    //   });
      



     const VentasRapidas = BuscadorVR.map(subArray => {
		 
		 console.log("Entre a ventas Rapidas");
		 

        return {
          idServicio: subArray[0].replace(/-\d+$/, ''),
          Cantidad: parseInt(subArray[10]),
          PrecioUnitario: parseInt(subArray[9]),
          subtotal:parseFloat(subArray[11]),
          ProductoComentario: `ID venta rapida: ${subArray[0]} Descripcion venta: `+ subArray[2],
         
        }
      });

      const GranFormato = BuscadorLonas.map(subArray => {
        return {
          idServicio: subArray[0],
          Cantidad: parseFloat(((parseFloat(subArray[2])* parseFloat(subArray[4])* parseFloat(subArray[11]))).toFixed(2)),
          PrecioUnitario: parseFloat(subArray[12]).toFixed(2),
          ProductoComentario: `Medidas: largo: ${subArray[2]} mt, ancho: ${subArray[4]} mt, Cantidad: `+  subArray[11],
          subtotal:parseFloat(subArray[12]).toFixed(2),
          CantidadBase: subArray[11],
          PrecioBase: subArray[6].replace('$', ''),
          CantidadMedioMayoreo: subArray[7],
          PrecioMedioMayoreo: subArray[8].replace('$', ''),
          CantidadMayoreo: subArray[9],
          PrecioMayoreo: subArray[10].replace('$', ''),

        }
      })
      console.log("Gran formato 1",GranFormato);
      const resultGran = [];

        GranFormato.forEach(item => {
        const idServicio = item.idServicio;
        const cantidad = parseInt(item.CantidadBase);
        let precio = parseFloat(item.PrecioBase);
        const subtotal = parseFloat(item.subtotal);
        
      
        if (cantidad >= parseInt(item.CantidadMayoreo) && parseFloat(item.PrecioMayoreo) !== 0) {
          precio = parseFloat(item.PrecioMayoreo);
        } else if (cantidad >= parseInt(item.CantidadMedioMayoreo) && parseFloat(item.PrecioMedioMayoreo) !== 0) {
          precio = parseFloat(item.PrecioMedioMayoreo);
        }
      
        resultGran.push({ idServicio, Cantidad: item.Cantidad, PrecioUnitario: precio.toFixed(2), subtotal: subtotal.toFixed(2), ProductoComentario: item.ProductoComentario});
      });
      
      console.log("soy gran formato 2",resultGran);
      
        const convertedArrays = CarritoProductos.map(function(subarreglo) {
			 if (subarreglo.length === 8) {
				 
				 	console.log("El arreglo mide 9");
				return {
				  idServicio: subarreglo[1],
				  Stock: subarreglo[4],
				  PrecioBase: subarreglo[5].replace('$', ''),
				  CantidadMedioMayoreo: subarreglo[2],
				  PrecioMedioMayoreo: subarreglo[3].replace('$', ''),
				  CantidadMayoreo: subarreglo[8],
				  //PrecioMayoreo: subarreglo[8].replace('$', ''),
				  Cantidad: subarreglo[6],
				  subtotal: subarreglo[7]
				};
			  } else {
				// Si el subarreglo no mide 8

				
					console.log("Entro en la condicion de que el arreglo no mide 9 contando 0");
					
					
				
							return {
							  idServicio: subarreglo[1],
							  Cantidad: parseInt(subarreglo[10]),
							  PrecioBase: parseInt(subarreglo[9]),
							  subtotal:parseFloat(subarreglo[11]),
							  ProductoComentario: `ID venta rapida: ${subarreglo[1]} Descripcion venta : `+ subarreglo[3],

							};
			  }
          });
          

          console.log("convertedArraysssss-",convertedArrays);
		  
		  
		  

          const result = [];

          convertedArrays.forEach(item => {
            const idServicio = item.idServicio;
            const cantidad = parseInt(item.Cantidad);
            let precio = parseFloat(item.PrecioBase);
			
			let comentario = item.ProductoComentario;
            
			console.log("<<<<<ENTRE EN LINEA 2247 >>>>>>>>");
			
			
			
			console.log("Soy idServicio",idServicio);
			console.log("Soy cantidad",cantidad);
			
			console.log("Soy comentario",comentario);
			
			
			console.log("Soy precio",precio);
			
			
			
					
          
            if (cantidad >= parseInt(item.CantidadMayoreo) && parseFloat(item.PrecioMayoreo) !== 0) {
              precio = parseFloat(item.PrecioMayoreo);
            } else if (cantidad >= parseInt(item.CantidadMedioMayoreo) && parseFloat(item.PrecioMedioMayoreo) !== 0) {
              precio = parseFloat(item.PrecioMedioMayoreo);
            }
          
            result.push({ idServicio, Cantidad: cantidad, PrecioUnitario: precio.toFixed(2), ProductoComentario : comentario, subtotal: item.subtotal});
          });



          const obtenerServicio = (idServicio) => {
            
            return new Promise((resolve, reject) => {
              $.ajax({
                url: base_url() + "app/Aldair/LevantarOrden/verServicio",
                dataType: "JSON",
                type: "POST",
                data: {
                  id: idServicio
                }
              }).done(data => {
                resolve(data);
              }).fail(error => {
                reject(error);
              });
            });
          };
          
          const validarFormatoPQ = async () => {
            const FormatoPQ = [];
          
            for (const item of FormatoPequeno) {
              const idServicio = item.idServicio;
              const cantidad = parseInt(item.CantidadBase);
              let precio = parseFloat(item.PrecioBase);
              const subtotal = parseFloat(item.subtotal);
              const largo = parseFloat(item.Largo);
          
              if (cantidad >= parseInt(item.CantidadMayoreo) && parseFloat(item.PrecioMayoreo) !== 0) {
                precio = parseFloat(item.PrecioMayoreo);
              } else if (cantidad >= parseInt(item.CantidadMedioMayoreo) && parseFloat(item.PrecioMedioMayoreo) !== 0) {
                precio = parseFloat(item.PrecioMedioMayoreo);
              }
          
              let unidad = 0;
          
              if (idServicio != undefined) {
                console.log("entramos aqui");
          
                try {
                  const data = await obtenerServicio(idServicio);
                  console.log("soy data", data);
          
                  unidad = parseInt(data.Servicio[0].idUnidad);
          
                  if (unidad == 5) {
                    console.log("entro 5");
                    FormatoPQ.push({ idServicio, Cantidad: parseFloat(cantidad * largo).toFixed(2), PrecioUnitario: precio.toFixed(2), subtotal: subtotal.toFixed(2), ProductoComentario: item.ProductoComentario });
                  } else if (unidad == 4) {
                    console.log("entro 4");
                    FormatoPQ.push({ idServicio, Cantidad: item.Cantidad, PrecioUnitario: precio.toFixed(2), subtotal: subtotal.toFixed(2), ProductoComentario: item.ProductoComentario });
                  } else {
                    console.log("entro else Unidad");
                    console.log("Hay un error");
                    return;
                  }
                } catch (error) {
                  console.log("Error en la llamada AJAX: ", error);
                }
              }
          
              console.log("soy gran FormatoPequeno 2", FormatoPQ);
            }
          
            return FormatoPQ;
          };
          let array;
          
          const validarCarritos = async () => {
            const carritos = [result, VentasRapidas, resultGran, await validarFormatoPQ()];
          
            console.log("carritos>>>: ", carritos);
          
            const carritoFinal = carritos.filter(carritoGlobal);
          
             array = [].concat(...carritoFinal);
             array.forEach(item => {
                if (item["idServicio"] === "SDI-Ven-Ven-") {
                    item["idServicio"] = "SDI-Ven-Ven-94235";
                }
            });
            console.log("carro", array);
            
          };
          
          validarCarritos();


       

      
        

    $("#btnRealizarVenta").off("click").on("click", (e) => {
        e.preventDefault();
          $("#btnRealizarVenta").attr("disabled", "disabled");
            
            
          





            //$("#btnRealizarVenta").attr("disabled", "disabled");

            let TP= $("#selectPago").val();
            console.log("Seleccion",TP)

            
            let idUser = $("#idCliente").val();
           // $("#btnRealizarVenta").attr("disabled", "disabled");
        

           /*Aplicar condiciones si aplico usar puntos de programa lealtad */

           if(firmadoPuntos == true){
                totalProgramapagar 

           }else{
            
                totalProgramapagar = totalFinal
           }
            
            /*
                Operacion de datos
            */
            let programaFinal =  []
            let registroObtenidos       ={}
            let registroPuntosUsados    ={}
            
            //console.log("infoPrograma 1", infoPrograma)
       
           let puntosUsados =infoPrograma.puntosUsados

           if(idUser == 0){

                programaFinal = null
          

            }else{
                if(puntosUsados == 0){
                
                    
                        registroObtenidos ={ "programa":parseInt(infoPrograma.programa), "idCliente":parseInt(infoPrograma.idCliente),"cantidad": Math.round(infoPrograma.cantidad),"tipo": 2}
                        programaFinal.push(registroObtenidos)


                }else{
                    
                        registroObtenidos     = { "programa":parseInt(infoPrograma.programa), "idCliente":parseInt(infoPrograma.idCliente),"cantidad": Math.round(infoPrograma.cantidad), "tipo": 2}
                        registroPuntosUsados  = { "programa":parseInt(infoPrograma.programa), "idCliente":parseInt(infoPrograma.idCliente),"cantidad": Math.round(infoPrograma.puntosUsados),"tipo": 1}
                        programaFinal.push(registroPuntosUsados)
                        programaFinal.push(registroObtenidos)
                }
            }
       
           console.log("infoPrograma 2", programaFinal)
           console.log("userioooo", idUser)
        

            
          
          
           let formbody = {
            Array: JSON.stringify(array),
            total: totalFinal,
            idCliente: idUser,
            idFP: TP,
            informacionPrograma: JSON.stringify(programaFinal) // Convertir a JSON explícitamente
          };
          
            console.log("Formbody",JSON.stringify(formbody))

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


} 

function carritoGlobal(carrito) {
    if (carrito.length > 0) {
      console.log("carrito start: true", carrito);
      return true;
    } else {
      console.log("carrito start: false", carrito);
      return false;
    }
  }
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
            "url":base_url()+"app/Aldair/LevantarOrden/listaServicios",
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
           // console.log("data", data)
           
                if (data.resultado) {
                    let general = data.usuario
                    const IdU = general.idU
                    //console.log("Usuario", IdU)
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
    $("#btnEnviar, #nombreCliente,#apellidosCliente,#telefonoCliente,#correoCliente").removeAttr("disabled");
    
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
	$("#btnEnviar, #nombreCliente,#apellidosCliente,#telefonoCliente,#correoCliente,#contrasenaColaborador").attr("disabled", "disabled");
	let nom 	= $("#nombreCliente").val();
	let apell   = $("#apellidosCliente").val();
	let tel 	= $("#telefonoCliente").val();
	let correo  = $("#correoCliente").val();
	let contra  = $("#contrasenaColaborador").val();

	let goValidation = true;

	const validRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	


    if (!correo.match(validRegex)) {
	
       
        $("#errorcorreoCliente").show();
        $("#errorcorreoCliente").html("Ingresa un correo valido");
        $("#correoCliente").focus();
        goValidation = false;
        $(
            "#btnEnviar, #nombreCliente,#apellidosCliente,#telefonoCliente,#correoCliente"
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
                    "#btnEnviar, #nombreCliente,#apellidosCliente,#telefonoCliente,#correoCliente"
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
                    "#btnEnviar, #nombreCliente,#apellidosCliente,#telefonoCliente,#correoCliente"
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
            "#btnEnviar, #nombreCliente,#apellidosCliente,#telefonoCliente,#correoCliente"
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
                "#btnEnviar, #nombreCliente,#apellidosCliente,#telefonoCliente,#correoCliente"
            ).removeAttr("disabled");
        }
        if( tel.length >10){
            $("#errortelefonoCliente").show();
            $("#errortelefonoCliente").html("Solo se permiten 10 digitos");
            $("#telefonoCliente").focus();
            goValidation = false;
            $(
                "#btnEnviar, #nombreCliente,#apellidosCliente,#telefonoCliente,#correoCliente"
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
            "#btnEnviar, #nombreCliente,#apellidosCliente,#telefonoCliente,#correoCliente"
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
        $("#btnEnviar, #nombreCliente,#apellidosCliente,#telefonoCliente,#correoCliente").removeAttr("disabled");
    }
    if ("" == nom.trim()) {
        console.log("nombre")
        $("#errornombreCliente").show();
        $("#errornombreCliente").html("Ingresa el nombre del cliente");
        $("#nombreCliente").focus();
        goValidation = false;
        $(
            "#btnEnviar, #nombreCliente,#apellidosCliente,#telefonoCliente,#correoCliente"
        ).removeAttr("disabled");
    }
    
    if (goValidation) {
       

        formbody =  {
            nombreU: nom,
            apellidos: apell,
            correo: correo,
            contrasena: tel,
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
                 location.reload(true);

            }else{
                toastr["warning"](data.mensajeUser);
                $("#btnEnviar, #nombreCliente,#apellidosCliente,#telefonoCliente,#correoCliente").removeAttr("disabled");
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

function restablecerAcceso(){
    $("#OperacionMovimiento").hide(); 
    $("#btnRegistroCambio").hide(); 
    $("#ControlAcceso").show();
    $("#accesoPermitido").hide();
    $("#btnverificarAcceso").show()
    $("#errorCambio").hide(); 
    $("#errorTMovimiento").hide();
    $("#accesoAdmin").val("");
    $("#errorAcceso").hide()
}


function AgregarCambio(){

    restablecerAcceso()
   

    $("#btnverificarAcceso").off("click").on("click", (e) => {
        e.preventDefault();

        $("#btnverificarAcceso").hide()
        $("#errorAcceso").hide()        
             formbody =  {
                ClaveAcceso: $("#accesoAdmin").val(),
            }
            

             $.ajax({
                url: base_url() + "app/Aldair/LevantarOrden/Acceder",
                dataType: "JSON",
                type: "POST",
                data: formbody,
            })
            .done((data)=>{
                
               console.log("data",data);

               if(data.resultado){
                $("#btnverificarAcceso").hide()
                $("#accesoPermitido").show()

                setTimeout(movimientoCaja, 2000);

                function movimientoCaja() {
                    $("#ControlAcceso").hide();
                    $("#OperacionMovimiento").show(); 
                    $("#btnRegistroCambio").show();
                }
                //Ocultamos el verificar acceso
               


               }else{
                $("#btnverificarAcceso").show()
                $("#errorAcceso").show()
               }
               
                
                
            })
            .fail();

        });


   $("#modal-IngresoCambio").modal("show")
   $("#añadirChange").removeAttr("disabled");

   $("#seleccionarTM").html(`<option value="Selecciona">--Selecciona --</option>`);


   $.ajax({
    url: base_url() + "app/Aldair/LevantarOrden/getTM",
    dataType: "JSON",
    type: "GET"
    })
    .done((data)=>{
        
        $.each(data.getTM, function(i,o){
        
        
            $("#seleccionarTipoMovimiento").find("select").append(`

            <option value=`+o.idTM+`>`+""+o.NombreTM+ `</option>
                `
            );
            


        

    });
        
    })
    .fail();


   
    

}

function añadirCambio(){
    $("#errorCambio").hide(); 
    $("#errorTMovimiento").hide();


    $("#añadirChange").attr("disabled", true);

    let cambio = $("#intCambio").val();
    let comentario = $("#comentarioCambio").val();
    let tipoMovimiento = $("#seleccionarTM").val();
    
    let bandera = true;

    if(cambio == "" || cambio == null || cambio == undefined){
        $("#errorCambio").show();
        $("#errorCambio").html("Digita el cambio a ingresar a caja");
        $("#intCambio").focus();
        bandera = false;

        $("#añadirChange").removeAttr("disabled");
    }

    if(tipoMovimiento == "Selecciona" || tipoMovimiento == null || tipoMovimiento == undefined){
        $("#errorTMovimiento").show();
        $("#errorTMovimiento").html("Selecciona el tipo de movimiento");
        $("#errorTMovimiento").focus();
         bandera = false;

        $("#añadirChange").removeAttr("disabled");
    }
    
    


    if(bandera){
        let cambioFinal = 0;
        
        if(comentario == "" || comentario == null || comentario == undefined){
            comentario = "Sin comentario";
        }
      

        if (tipoMovimiento == 1) {
            cambioFinal = cambio;
        }
        else if (tipoMovimiento == 2) {
            cambioFinal = -cambio;
        }


        console.log("cambioFinal", cambioFinal);
            $.ajax({
                url: base_url() + "app/Aldair/LevantarOrden/CambioCaja",
                dataType: "JSON",
                type: "POST",
                data: {
                    TotalVenta:  cambioFinal,
                    Comentario: comentario,
                    TipCambio: parseInt(tipoMovimiento)
                },
            })
            .done((data)=>{
                
                if(data.resultado){
                    toastr["success"](data.mensaje);
                    $("#añadirChange").removeAttr("disabled");
                    $("#modal-IngresoCambio").modal("hide");

                
                }else{
                    toastr["warning"]("Aviso: ",data.mensaje);
                    $("#modal-IngresoCambio").modal("hide");
                    $("#añadirChange").removeAttr("disabled");
                }
                
                
            })
            .fail();
    }


}

/**
 * 2023/07/24
 * Aldair Cruz, implementar programa lealtad
 */

    let totalProgramapagar = 0
    let puntosNecesario;
    let infoPrograma = {}

const obtenerPuntos = async(cliente)=>{

      
    
    await $.ajax({
            url: base_url() + "app/Aldair/ProgramaLealtad/obtenerPuntos",
            dataType: "JSON",
            type: "POST",
            data:{
                "cliente":cliente
            }
        })
        .done((data)=>{
            
            let puntosObtenidoventa = (porcentajeADecimal(programa.programa.porcentaje) *  totalFinal)
            //console.log("puntos obtenidos sin aplicar puntos de programa", puntosObtenidoventa)
            $("#clienteSinprograma").html("puntos obtenidos: <strong>" + Math.round(puntosObtenidoventa.toFixed(2)) +"<strong>")

            infoPrograma = {"programa": programa.programa.idControl , "idCliente": cliente ,"cantidad": puntosObtenidoventa,}
            

            if (data.user == "0" || data.user == 0){
                $("#puntos").hide();
               // console.log("entro aqui 1")
           

            }else{
                $("#puntos").show();
                puntosUsar  = 0
               // console.log("entro aqui 2")
                if(data.puntosCliente != null){
                    //console.log("entro aqui 3")
                     $("#clientespuntos").html("Cliente puntos disponibles: " + data.puntosCliente.puntos)
                     $("#porcentajeCashback").html("% cashback: " + programa.programa.porcentaje)
                        let puntosCliente = data.puntosCliente.puntos
                    
                        let puntosStart = (totalFinal / programa.programa.valor)


                     if (puntosStart >= puntosCliente) {
                        puntosStart =  puntosCliente
                        //console.log("entro aqui 5")
                     }
                  

                    // console.log("puntosStart", puntosStart)
                     $("#cantidadCliente").html(
                        `
                        <img src="https://sdiqro.store/static/img/rewards/rewards.png" alt="Imagen de recompensas" width="150" height="50">
                            <label for="message-text" class="col-form-label">Cantidad:</label>
                            <input value="${puntosStart}" min="0" max="` + puntosStart + `" type="number" id="cantidadCoinsprograma">
                            <small class="text-danger" id="errortelefonoCliente" style="display: none;"></small>
                            <div id="errorCantidadExcedida" class="text-danger" style="display: none;">
                                La cantidad excede los puntos disponibles.
                            </div>
                            <label for="message-text" class="col-form-label font-weight-bold text-dark"  id="DescuentoAplicado">Descuento aplicado:</label><br>
                            <label for="message-text"  id="nuevoSaldopuntos" class="col-form-label">Saldo:</label><br>
                            <small class="text-danger" id="errorcantPuntos"  style="display: none;"></small><br>
                            <label for="message-text" class="col-form-label" id="puntosObtenidos">Puntos generados:</label><br>
                            <label for="message-text"  id="totalFinalPrograma" class="col-form-label font-weight-bold text-dark">Total a pagar:</label>
                        `
                    )

                    let usarPuntos = $("#cantidadCoinsprograma").val()
                    let nuevoSaldo = data.puntosCliente.puntos - usarPuntos
                    let puntosUsar = firmadoPuntos == true ?  usarPuntos * programa.programa.valor : 0

                    //console.log("puntosUsar 1" , puntosUsar)
                    let totalPrograma = totalFinal - puntosUsar 
                    let porce = porcentajeADecimal(programa.programa.porcentaje)
                    let puntosObtenidoventa = (porcentajeADecimal(programa.programa.porcentaje) *  totalPrograma)
                    // console.log("totalPrograma 1" , totalPrograma)
                    // console.log("porce 1" , porce)
                    // console.log("puntosObtenidoventa 1" , puntosObtenidoventa)
                    // console.log("entro aqui 6")

                    $("#nuevoSaldopuntos").html("Saldo restante: " + nuevoSaldo)
                    $("#DescuentoAplicado").html("Descuento aplicado: $" + puntosUsar +" MXN")
                    $("#totalFinalPrograma").html("Total a pagar: $" + totalPrograma +" MXN")
                    infoPrograma = {"programa": programa.programa.idControl , "idCliente": cliente ,"cantidad": puntosObtenidoventa, "puntosUsados":  firmadoPuntos ==  true  ? usarPuntos  : 0 ,"P":4}

                    /*Puntos generados*/
                   

                    /*Total a pagar*/
                    totalProgramapagar = totalPrograma;
                    $("#puntosObtenidos").html("Puntos obtenidos: <strong>" + Math.round(puntosObtenidoventa.toFixed(2)) +"<strong>")



                    $("#programaActual").html("Programa actual: " + programa.programa.nombreControl);
                    $("#valorPunto").html("Valor x punto: " + programa.programa.valor);
                    

                    $("#cantidadCoinsprograma").on("input", function() {
                        //console.log("entro aqui 7")


                        let puntosNecesarios = (totalFinal / programa.programa.valor)
                        const cantidadIngresada = parseInt($(this).val());
                        const puntosDisponibles = parseInt(data.puntosCliente.puntos);
                        let usarPuntos = $("#cantidadCoinsprograma").val()
                        let puntosUsar    = usarPuntos * programa.programa.valor
                        let totalPrograma = totalFinal - puntosUsar 
                        let puntosObtenidoventa = (porcentajeADecimal(programa.programa.porcentaje) *  totalPrograma)
                        let nuevoSaldo    = data.puntosCliente.puntos - usarPuntos

                        

                        if(usarPuntos < 0){
                            toastr["warning"]("Aviso: ","No se permiten numeros negativos");
                            totalPrograma   = 0
                            puntosUsar = 0 
                            nuevoSaldo = 0
                            puntosObtenidoventa = 0
                            $("#cantidadCoinsprograma").val(0)
                            $("#btnRealizarVenta").attr("disabled", "disabled");
                        }else{
                            $("#btnRealizarVenta").removeAttr("disabled");
                        }

                     

                        if (isNaN(cantidadIngresada) || cantidadIngresada > puntosStart) {
                            // Mostrar el mensaje de notificación si la cantidad es inválida o excede los puntos disponibles
                        
                          
                            totalPrograma   = 0
                            puntosUsar = 0 
                            nuevoSaldo = 0
                            puntosObtenidoventa = 0
           
                       
                            $("#nuevoSaldopuntos").html("Saldo restante: " + nuevoSaldo)
                            $("#errorcantPuntos").show();
                            $("#errorcantPuntos").html("Se ha superado el limite de puntos a usar 100%, puntos maximos: " +  puntosStart);
                            $("#DescuentoAplicado").html("Descuento aplicado: $" + puntosUsar +" MXN")
                            $("#totalFinalPrograma").html("Total a pagar: $" + totalPrograma +" MXN")
                            $("#puntosObtenidos").html("Puntos obtenidos: <strong>" +  Math.round(puntosObtenidoventa.toFixed(2)) +"<strong>")
                            infoPrograma = {"programa": programa.programa.idControl , "idCliente": cliente ,"cantidad": puntosObtenidoventa, "puntosUsados": usarPuntos ,"P":3}

                            if(isNaN(cantidadIngresada) || cantidadIngresada > puntosDisponibles){
                                $("#errorCantidadExcedida").show();
                                console.log("11111111111111111111111-----:")
                                $("#btnRealizarVenta").attr("disabled", "disabled");
                            }else{
                                $("#btnRealizarVenta").removeAttr("disabled");
                            }

                        } else {
                            $("#errorCantidadExcedida").hide();
                            $('#errorcantPuntos').hide();
                           
            
                            $("#nuevoSaldopuntos").html("Saldo restante: " + nuevoSaldo)
                            $("#DescuentoAplicado").html("Descuento aplicado: $" + puntosUsar +" MXN")
                            $("#totalFinalPrograma").html("Total a pagar: $" + totalPrograma +" MXN")


                        
                            totalProgramapagar = totalPrograma;
                            $("#puntosObtenidos").html("Puntos obtenidos: <strong>" +  Math.round(puntosObtenidoventa.toFixed(2)) +"<strong>")
                     
                            infoPrograma = {"programa": programa.programa.idControl , "idCliente": cliente ,"cantidad": puntosObtenidoventa, "puntosUsados": usarPuntos, "P":2 }


                            
                        }

                        // datos final
                        infoPrograma = {"programa": programa.programa.idControl , "idCliente": cliente ,"cantidad": puntosObtenidoventa, "puntosUsados": usarPuntos, "P":1 }

                      
                    });

                   // console.log("entro aqui 8")
                   
                }else{
                    $("#puntos").hide();
                   // console.log("entro aqui 4")
                }

              //  console.log("PUNTOS USADOS FINAL" , puntosUsar)
             //   console.log("entro aqui 10", infoPrograma)
            }
        
          
            
        })
        .fail();
}

let programa = {}
// const consultarPrograma = async()=>{
//     await $.ajax({
//         url: base_url() + "app/Aldair/ProgramaLealtad/programaActual",
//         dataType: "JSON",
//         type: "GET"
//         })
//         .done((data)=>{
            
//             programa = data;          
//             console.log("programa", programa)
//         })
//         .fail();
// }
const consultarPrograma = () => {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: base_url() + "app/Aldair/ProgramaLealtad/programaActual",
            dataType: "JSON",
            type: "GET"
        })
        .done((data) => {
            programa = data;  
            resolve(data); // Resuelve la promesa con los datos obtenidos
        })
        .fail((jqXHR, textStatus, errorThrown) => {
            reject(errorThrown); // Rechaza la promesa si hay un error
        });
    });
};


function obtenerValorNumerico(texto) {
    const patron = /Nombre:\s*(\d+)/; // Expresión regular para buscar el patrón "Nombre: [valor numérico]"
    const matches = texto.match(patron);
  
    if (matches && matches.length >= 2) {
      return parseInt(matches[1], 10); // Convertir el valor capturado a un entero
    } else {
      return null; // Si no se encuentra el patrón, devolver null o un valor predeterminado
    }
  }

  function porcentajeADecimal(porcentaje) {
    if (typeof porcentaje !== 'number') {
      porcentaje = parseFloat(porcentaje); // Convertir a número si es una cadena
    }
    
    if (isNaN(porcentaje)) {
      return null; // Si no es un número válido, devolver null o un valor predeterminado
    }
    
    return porcentaje / 100.0; // Dividir el porcentaje entre 100 para obtener el valor decimal
  }