$(document).ready(()=>{


    //alert("ya estamos aqui");
    //$("#datatable").find("tbody").html("");
    TiposDeGastos();
    listaCompras();
    //listanombreASsMesaFAQS();

    /*$("#editarAgr").click(()=>{

        $("#first-tab").removeClass("active");
        $("#second-tab").addClass("active");
        

    })*/
	
	let contador = 1;


    $("#btnAgregarFila").click((e)=>{
		
        e.preventDefault();
		
		 
        $("#btnAgregarFila").attr("disabled", "disabled");

		
		
		
	    $("#errorselectTiposDeGastos").hide();

		let idServicio = $("#selectTiposDeGastos").val();
		let validACeleccionServicio = true;
		
		
		if (idServicio == "Selecciona"){
			//console.log("entro aqui");
            $('#errorselectTiposDeGastos').show();
            $('#errorselectTiposDeGastos').html("Elige un tipo de gasto");
            $('#selectTiposDeGastos').focus();	
            validACeleccionServicio = false;
		}
		
		//console.log(idServicio);
		
		if(validACeleccionServicio){

				let contador = 1;
		
				let identiFila = 0;
				
				$(".filaSelecionada").each(function(i,e){
				
					$(e).find("[indeti]").each((i,e)=>{

              
                    //console.log($(e).text());
                   identiFila = $(e).text();
						
						identiFila= (contador + parseInt(identiFila));
					
					
					});
					
				});
			
			
			
			if(identiFila != 0){
				contador = identiFila;
			}
	
			$("#bodySeleccionados").append(`
								<tr  class="filaSelecionada" data-fila="`+contador+`" id="tr-`+contador+`">
									<td data indeti scope="row" id="idSelecionado">`+contador+`</td>
									
									<td   style="width: 15rem;"><textarea data  rows="1" placeholder="Descripción del gasto"  id="des-`+contador+`" ></textarea></td>
									
									<td   style="width: 5rem;"><input data value='0' size="3" type="number" id="costo-`+contador+`" onchange="subTotalServicio('`+contador+`')"/></td>
									<td   style="width: 5rem;"><input data value='1' size="5" type="number"  id="cantidad-`+contador+`" onchange="subTotalServicio('`+contador+`')" /></td>
									<td data id="Subtotal-`+contador+`" class="subtotal">0</td>
									<td><button onclick="quitarDeLista(`+contador+`)"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
								</tr>
							`);
			
			
			
		}
	
		$("#btnAgregarFila").removeAttr("disabled"); 
		
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
	
	//console.log("total ", sumaTotal);
	
	$("#totalSuma").html(sumaTotal);
}

function editarTab(){

    $("#first-tab").removeClass("active");
    $("#second-tab").addClass("active");
}



    
    function listaCompras(){
    
    
        axios(base_url()+"app/GastoVariado/verGastoVariado")
        .then(({data})=>{
    
            if(data.resultado){
    
                $("#despliegueTabla").html(`
                <table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Fecha</th>
                            <th>Folio</th>
                            <th>Tipo de Gasto</th>
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

             
                $.each(data.GastoVariado, function(i,o){
    
                    $("#datatable").find("tbody").append(`
                        <tr id="tr-`+ o.idCom+`">
							<td>`+ o.idCom+`</td>
                            <td>`+ o.fecha+`</td>
                            <td>`+ o.folio+`</td>
							<td>`+ o.nombreTG+`</td>
							<td class="text-wrap" style="width: 15rem;" >`+ o.desCompra+`</td>
							<td>$`+ o.total+`</td>
							<td>`+ o.nombreSuc+`</td>
							<td><a href="#" onclick="vistaPrevia('`+o.idCom+`','`+o.fecha+`','`+o.folio+`','`+o.nombreTG+`','`+o.nombreSuc+`','`+o.nombreC+`','`+o.total+`','`+o.fechaCaptura+`',)"><i class="fas fa-list fa-2x"></i></a></td>
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

    function vistaPrevia(idCompra,fecha,folio,nombreTG, nombreSuc,nombreUsr, costoTotal, fechaCaptura){


        $.ajax({
            "url":base_url()+"app/GastoVariado/vistaPrevia",
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
                 $("#tituloModaVistaPrevia").html("Detalle del gasto: <strong> "+idCompra);
				$("#descripcionM").html("Registro: <strong> "+nombreUsr+" </strong>Sucursal: <strong> "+nombreSuc+" </strong>Fecha registro: <strong> "+fechaCaptura+" </strong></br>Fecha del gasto: <strong> "+fecha+" </strong> Folio/factura: <strong> "+folio+" </strong>Tipo de Gasto: <strong> "+nombreTG+" Folio: <strong> "+folio+"</strong>");
				$("#totalM").html("total: <strong> $"+costoTotal+"</strong>");
				
				
				$("#datosCaptura").html(`Registró: <strong>`+nombreUsr+` </strong></br> Sucursal: <strong>`+nombreSuc+` </strong></br>Fecha de registro: <strong>`+fechaCaptura+`</strong>`);
				$("#datosCompra").html(`Fecha del gasto: <strong>`+fecha+` </strong></br>folio: <strong>`+folio+`</strong></br>tipo de gasto: <strong>`+nombreTG+`</strong>`);
			
				
				
				

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
    
    
    
    function insertaGastoVariado(){

    
        quitaErroresCamposVacios();
        
        //agrega el disabled a los campos
        agregarDisabled();
		
		let id = $("#idAC").val();
		let fechaCompra = $("#fechaCompra").val();
		let folio = $("#folioFactura").val();
		let tiposDeGastosSeleccionado = $("#selectTiposDeGastos").val();
        let des = $.trim($("#descripcion").val());
        let sumaTotal = $.trim($("#totalSuma").text());
		//let selectTiposDeGastos = $("#selectTiposDeGastos").val();
		let idUsuario = $("#idUsuario").val();
		let sucursal = $("#sucursal").val();
		let fechaActual = $("#fechaActual").val();
		//let idTipoDeGasto = $("#selectTiposDeGastos").val();
		
					
	
        let accion = $("#accion").val();
        let goValidACion = true;
        let estatus = 1;
    
            if(accion == "editar"){
                estatus = $("#estatusAC").val();
            }
    
          
		

        if("" == folio.trim()){
            $('#errorfolioFactura').show();
            $('#errorfolioFactura').html("Debes ingresar un folio que te permita identificar el gasto");
            $('#folioFactura').focus();	
            goValidACion = false;
            removerDisabled();
        }
		
		
	   if("Selecciona" == tiposDeGastosSeleccionado){
			$('#errorselectTiposDeGastos').show();
			$('#errorselectTiposDeGastos').html("Elige un tipo de gasto");
			$('#selectTiposDeGastos').focus();	
			goValidACion = false;
			removerDisabled();
		}

		
		
		
		if("" == fechaCompra.trim()){
            $('#errorfechaCompra').show();
            $('#errorfechaCompra').html("Ingresa la fecha en que fue realizado el gasto");
            goValidACion = false;
            removerDisabled();
        }
		
		
		
		let i=0;
 
        const arregloFinal = new Array();
		
		
		
		
		
		/*console.log("descripcion fila", $("#des-1").val());
		console.log("costo fila",$("#costo-1").val());
		console.log("cantidad fila",$("#cantidad-1").val());*/
		
		
		
		//console.log($('.filaSelecionada'));
		
		
		$('.filaSelecionada').each(function(i,e) {

			const arregloPorFila=new Array();

			$(e).find("[data]").each((i,e)=>{

                if($(e).is("input")){
                    
                   
                    arregloPorFila.push($(e).val());

                }else if($(e).is("textarea")){
                    
                    
                    arregloPorFila.push($(e).val());

                }else{
                    //console.log($(e).text());
                    arregloPorFila.push($(e).text());
                }
            });
            arregloFinal.push(arregloPorFila);


			/*$(this).children("td").each(function(i,e){            });*/
		});
    
       // console.log(arregloFinal); 

       

        if(arregloFinal.length <=0){

            $('#errorfilasDelGasto').show();
            $('#errorfilasDelGasto').html("No haz agregado ninguna fila de gasto");
            
            goValidACion = false;
            removerDisabled();

        }

        if(sumaTotal == '0'){

            $('#errortotal').show();
            $('#errortotal').html("El costo del gasto no puede ser $0 ");
           	
            goValidACion = false;
            removerDisabled();

        }
        
        console.log(sumaTotal);




        if(goValidACion){
    
            axios.post(base_url()+"app/GastoVariado/insertaGastoVariado", {
                idCom:id,
                fecha: fechaCompra,
				folio: folio,
				idTG: tiposDeGastosSeleccionado,
				desCompra:des,
                total:sumaTotal,
				idU: idUsuario,
				idSuc: sucursal,
				fechaCaptura: fechaActual,
				estatus : estatus,
				serviciosArray: arregloFinal,
                accion:accion,
				
	
	     

            })
            .then(({data})=>{
    
                if(data.resultado){
    
                    toastr["success"](data.mensaje);
                    $("#nombrePreguntasMesaFAQS").val("");
                    
                    



                    TiposDeGastos();
    
                    removerDisabled();

                    window.setTimeout( () => {

                        window.location.href = base_url() + "app/GastoVariado"

                    }, 2000);


                    
                }else{
    
                    toastr["warning"](data.mensaje);
                    removerDisabled();
    
                }
                
            })
            .catch(error=>{
                console.log(error);
                removerDisabled();
                TiposDeGastos();
    
            })
    
        }else{
    
            console.log("Falta un dato");
            TiposDeGastos();
            removerDisabled();
    
        }
    
    } // termina insertar tipo de pago


    function removerDisabled(){

        $("#btnAgregar, #fechaCompra, #selectTiposDeGastos, #folioFactura, #descripcion, #selectTiposDeGastos, #btnAgregarFila").removeAttr("disabled"); 

    }

    function agregarDisabled(){

        $("#btnAgregar, #fechaCompra, #selectTiposDeGastos, #folioFactura, #descripcion, #selectTiposDeGastos, #btnAgregarFila").attr("disabled", "disabled");

    }

    function agregar(){
     
		quitaErroresCamposVacios();
        $("#btnCrear").html("Agregar");
        
        $("#tituloAccion").html("Capturar Gasto");
        $("#fechaCompra").val('');
        
        $("#selectTiposDeGastos").html("");
        TiposDeGastos ();
        $("#folioFactura").val('');
        $("#descripcion").val('');
        $("#selectTiposDeGastos").html("");
		//$("#selectTiposDeGastos").find('option:selected').removeAttr("selected");
        //$("#selectTiposDeGastos").find('option:selected').removeAttr("selected");
        //listaServicios();
        $("#accion").val("Agregar");
        $("#idAC").val("0");
        $("#bodySeleccionados").html("");
        $("#totalSuma").html("0");
        $("#estatusAC").val("1");
    
    } // termina modal agregar tipo de pago

    function quitaErroresCamposVacios(){
        $("#errorfechaCompra").hide();
        $("#errorselectTiposDeGastos").hide();
        $("#errorfolioFactura").hide();
        $("#errordescripcion").hide();
        $("#errorselectTiposDeGastos").hide();
		$("#errorfilasDelGasto").hide();
        $("#errortotal").hide();
	
    }



    function validarCamposVacios(){
        $("#errornombrePreguntasMesaFAQS").hide();
        $("#errordesPreguntasMesaFAQS").hide();
        $("#errorselectTiposDeGastos").hide();
    }

    // funcion editar agrupacion de servicio

    function editar(id,nombre,des,costoTotal,idTG,inicio, fin, estatus){
        editarTab();
        quitaErroresCamposVacios();

        agregar();

        
        $("#tituloAccion").html("Editar compra <strong>"+ nombre+"</strong>");
        $("#fechaInicio").val(inicio);
        $("#fechaFin").val(fin);
        $("#selectTiposDeGastos").html();
        TiposDeGastos (idTG);
        $("#folioFactura").val(nombre);
        $("#descripcion").val(des);
        $("#selectTiposDeGastos").html("");
		//$("#selectTiposDeGastos").find('option:selected').removeAttr("selected");
        //$("#selectTiposDeGastos").find('option:selected').removeAttr("selected");

        console.log(idTG);
        listaServicios();
        
        $("#accion").val("editar");
        $("#idAC").val(id);
        
        $("#totalSuma").html("0");
        $("#estatusAC").val(estatus);



        $("#bodySeleccionados").html("");


        $.ajax({
            "url":base_url()+"app/TiposDeGastos/vistaPrevia",
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
        //$("#selectTiposDeGastos").find('option:selected').removeAttr("selected");
        //$("#selectTiposDeGastosoption[value="+idAC+"]").attr('selected', 'selected');


        
    
    } // temrina modal editar tipo de pago
    
    function cambiaEstatus(id){
    
        $.ajax({
            "url": base_url()+"app/GastoVariado/cambioEstatus",
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
            "url": base_url()+"app/GastoVariado/bajaLogica",
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


/*
            $.each(data.TiposDeGastos, function(i,o){

                $("#datatable").find("tbody").append(`
                    <tr id="tr-`+ o.idTG+`">
                        <td>`+ o.idTG+`</td>
                        <td>`+ o.nombreTG+`</td>
                        <td>`+o.desTG+`</td>
                        <td align="center"><a href="#" onclick="cambiaEstatus(`+o.idTG+`)"><i id="icono-`+o.idTG+`" class="fas fa-toggle-`+(o.estatus == 1 ? 'on':'off')+` fa-2x"></i></a></td>
                        <td align="center"><a href="#" onclick="editar(`+o.idTG+`,'`+o.nombreTG+`','`+o.desTG+`','`+o.estatus+`')"><i class="fas fa-pencil fa-2x"></i></a> </td>
                        <td align="center"><a href="#" onclick="modalBorrar(`+o.idTG+`,'`+o.nombreTG+`','`+o.desTG+`')"><i class="fas fa-trash fa-2x"></i></a></td>

*/



    function TiposDeGastos(idSelect=0){

        //consumimos servicio para mostrar los tipos de contratacion
        axios(base_url()+"app/TiposDeGastos/verTiposDeGastos")
        .then(({data:Response})=>{
         console.log(Response)
        
         if(Response.resultado){
        
             /**
              * #despliegueTabla es el id de un div que se encuentra en la vista en TipoContratacion_view.php
              * se pintara la tabla en el id: despliegueTabla
              */
        
             $("#selectTiposDeGastos").html('<option value="Selecciona">--Selecciona--</option>');    

             $.each(Response.TiposDeGastos, function(i,o){
				 
				 
				 if(o.idTG != 1){
					 
					  $("#divListaTiposDeGastos").find("select").append(`
                 <option value=`+o.idTG+` `+ (idSelect == o.idTG ? "selected": "")+`>`+o.nombreTG+` </option>
                  `
                 );
					 
				 }
        
                
        
             });
             $("#datatable").DataTable(),$(".dataTables_length select").addClass("form-select form-select-sm");	
         }
         else{
            $("#selectTiposDeGastos").html('<option label="&nbsp;">No hay tipos para mostrar</option>');    
         }
        
        
        })
        .catch(error=>{
         console.log(error, "Error al cargar el controlador verTiposDeGastos");
        })
        
     }

     // termina lista tipos de contratación


     
    
  


