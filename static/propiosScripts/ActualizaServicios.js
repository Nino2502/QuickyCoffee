$(document).ready(()=>{

    //listaCategoriasServicios();

    cambioCheckImpresion();
    cambioCheckPoliticas();
    listaUnidades();
    listaPoliticas();
    muestraAtributosSC();
    getAtributosDeServicios();
	cambioAgrupaServicio();
	lista_precios_bases();
	mostrarPreciosBases();
	cambioCheckAtributos();
	listaPrecios_bases();
	lista_atributos_mas();
	listaAtributos_adicionales();
	
	
	//agrupacionServicios();
	//cambioCheckCodigoBarras();




	
		
    $("#btnAgregaPreSerImp").click((e)=>{
		
        e.preventDefault();
		
		 
        $("#btnAgregaPreSerImp").attr("disabled", "disabled");

		//console.log(idServicio);
		
		

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
	
			$("#tBodyfilasPreSerImpr").append(`


												<tr class="filaSelecionada" data-fila="`+contador+`" id="trPreSerImpr-`+contador+`">
													<td class="align-middle" indeti scope="row" id="idSelecionado">`+contador+`
														<input id="inputCatPreSerImp" db="categoria" data type="hidden" value="1">
														<input id="inputIdPreSerImp" db="idS" data type="hidden" value="SDI-Equ-pla-105920">

													</td>
													<td>
														<label for="message-text" class="col-form-label"> *Descripción:</label>
														<input data entradaDatos db="desPreSer" type="text" class="form-control" value="" id="descripcionServiciosConImpresion-`+contador+`">
														<small class="text-danger" id="errordescripcionServiciosConImpresion-`+contador+`" style="display: none;"></small>
													</td>
													<td>
														<label for="message-text" class="col-form-label"> *Cantidad:</label>
														<input data entradaDatos db="cantidad" type="text" class="form-control" value="" id="cantidadServiciosConImpresion-`+contador+`">
														<small class="text-danger" id="errorcantidadServiciosConImpresion-`+contador+`" style="display: none;"></small>
													</td>
													<td>
														<label for="message-text" class="col-form-label"> * Precio:</label>
														<input data entradaDatos db="precio" type="text" class="form-control" value="" id="precioServiciosConImpresion-`+contador+`">
														<small class="text-danger" id="errorprecioServiciosConImpresion-`+contador+`" style="display: none;"></small>
													</td>
													<td><button class="btn" onclick="quitarDeLista(`+contador+`)"><i class="fas fa-trash fa-2x mt-4"></i></button></td>
												</tr>
							`);
		$("#btnAgregaPreSerImp").removeAttr("disabled"); 

    });
	
	
	
	
	// temrina agreagr precio dinamico impresion
	
	
	
	//comienza precio dinamico producto
	
	 $("#btnAgregaPreDinPro").click((e)=>{
		
        e.preventDefault();
		
		 
        $("#btnAgregaPreDinPro").attr("disabled", "disabled");

		//console.log(idServicio);
		
		

		let contador = 1;

		let identiFilaPreDinPro = 0;
				
				$(".filaSelecionadaPreDinPro").each(function(i,e){
				
					$(e).find("[indetiPreDinPro]").each((i,e)=>{

              
                    //console.log($(e).text());
                   identiFilaPreDinPro = $(e).text();
						
						identiFilaPreDinPro= (contador + parseInt(identiFilaPreDinPro));
					
					
					});
					
				});
			
			
			
			if(identiFilaPreDinPro != 0){
				contador = identiFilaPreDinPro;
			}
	
			$("#tBodyfilasPreDinPro").append(`

							<tr class="filaSelecionadaPreDinPro" data-filaPreDinPro="`+contador+`" id="tr-`+contador+`">
								<td class="align-middle"  indetiPreDinPro scope="row" id="idSelecionadoPreDinPro">`+contador+`
									<input id="inputCatPreSerImp" db="categoria" dataPreDinPro type="hidden" value="2">
									<input id="inputIdPreSerImp" db="idS" dataPreDinPro type="hidden" value="SDI-Equ-pla-105920">
								</td>
								<td>
									<label for="message-text" class="col-form-label"> *Descripción:</label>
									<input dataPreDinPro entradaDatos db="desPreSer" type="text" class="form-control" value="" id="descripcionPreDinPro-`+contador+`">
									<small class="text-danger" id="errordescripcionPreDinPro-`+contador+`" style="display: none;"></small>
								</td>
								<td>
									<label for="message-text" class="col-form-label"> * Cantidad:</label>
									<input dataPreDinPro entradaDatos db="cantidad" type="text" class="form-control" value="" id="cantidadPreDinPro-`+contador+`">
									<small class="text-danger" id="errorcantidadPreDinPro-`+contador+`" style="display: none;"></small>
								</td>
								<td>
									<label for="message-text" class="col-form-label"> * Precio:</label>
									<input dataPreDinPro entradaDatos db="precio" type="text" class="form-control" value="" id="precioPreDinPro-`+contador+`">
									<small class="text-danger" id="errorprecioPreDinPro-`+contador+`" style="display: none;"></small>
								</td>
								<td><button class="btn" onclick="quitarDeListaPreDinPro(`+contador+`)"><i class="fas fa-trash fa-2x mt-4"></i></button></td>
							</tr>

											
							`);
		$("#btnAgregaPreDinPro").removeAttr("disabled"); 

    });
	
	//termina precio dinamico producto
       
    }); // termina ready 



function muestraAnchoMaterial( idUnidad = "vacio"){
	
	console.log("unidad en funcion", idUnidad);
	
	if(idUnidad == "vacio"){
		idUnidad = $("#selectUnidades").val();
	}
	
	
	console.log('unidad ', idUnidad);
	
	if(idUnidad == '5'){
		
		
		let valorAncho = $("#idanchoMaterial").val();
		
		$("#divanchoMaterial").show();
		
		
		$("#divanchoMaterial").html(`
								<label for="message-text" class="col-form-label"> Ancho material:</label>
								<input value="`+valorAncho+`" type="number" value="0" class="form-control" id="anchoMaterial">
								<small class="text-danger" id="erroranchoMaterial" style="display: none;"></small>
		`);
		
		
	}else{
		console.log('No Entro');
		$("#divanchoMaterial").hide();
		$("#divanchoMaterial").html('');
		
		
	}
	
}





function quitarDeLista(id){
	
	$("tr[data-fila="+id+"]").remove();
	
	
	
}

function quitarDeListaPreDinPro(id){
	
	$("tr[data-filaPreDinPro="+id+"]").remove();
	
	
	
}







    function listaCategoriasServicios(){


        $.ajax({
            "url":base_url()+"app/CategoriasServicios/verCategoriasServicios",
            "dataType":"JSON"
        })
        .done((data)=>{

            $("#selectCategoriaServicios").html("");

            if(data.resultado){

                $("#divSelectCategoriasServicios").find("select").append(`
                <option value="Selecciona">--Selecciona--</option>
                `
                );

                $.each(data.categorias, function(i,o){

                    if(o.estatus == 1){
                        $("#divSelectCategoriasServicios").find("select").append(`
                    <option value="`+ o.idCS+`">`+ o.nombreCS+`</option>
                    `
                    );

                    }   
    
                });
    
            }else{
    
                $("#divSelectCategoriasServicios").find("select").append(`
                <option value="Selecciona">--No existen categorias para mostrar--</option>
                `
                );
            }

        })
        .fail();

    }



    


function muestraAtributosSC(){

    $("#selectDeAtributos").html("");

    let idCat = $("#selectCategoriaServicios").val();

    const compara = getAtributosDeServicios();

    

    if(idCat != "Selecciona"){

        $('#selectDeAtributos').show();

        $.ajax({
            "url":base_url()+"app/Atributos/vistaPreviaAtributosDeCategoria",
            "dataType":"JSON",
            "type":"POST",
            "data":{
                id:idCat
            }
        })
        .done((data)=>{

        
            if(data.resultado){

                //arraySeleccion = data.categorias;

                $.each(data.nombreAtributos, function(i,o){

                    $("#selectDeAtributos").append(`<div name="atributo" class="atributoList col-sm-4" id="`+o.idAtr+`">
                    <label>`+o.nombreAtr+`</label>
                    <select class="form-control select2-single"  data-atr="`+o.idAtr+`"  id="atr-`+o.idAtr+`">
					<option value="">--Selecciona --</option>
                        
                    </select>
                    <small class="text-danger" id="errorselectCategoriaServicios" style="display: none;"></small>
                </div>`);//termina append



                    // comienza detalle de atributo

                    $("#divSelectCategoriasServicios").find(`select #atr-`+o.idAtr).append(`
                    <option label="Elige;">Elige uno;</option>
                    `
                    );

                    $.ajax({
                        "url":base_url()+"app/Atributos/vistaPreviaAtr",
                        "dataType":"JSON",
                        "type":"POST",
                        "data":{
                            id:o.idAtr
                        }
                    })
                    .done((data2)=>{
                        if(data2.resultado){


                            

                            

                            $.each(data2.atributos, (ia,a)=>{

                                let bandera =0;

                                //compara si el sercio tiene asociados atributos para realizar el select

                                $.each(compara, (is, nid)=>{

                                    nid == a.idDAtr ? bandera = 1 : null;
                                });

                                $("#atr-"+o.idAtr).append(`
                                
                                <option id="sAtr-`+a.idDAtr+`" value="`+a.idDAtr+`" `+(bandera == 1 ? "selected" : "")+`>`+a.nombreDAtr+`</option>
                            `);
                            console.log(bandera);

                            });             
                        }           
                
                    })
                    .fail();


                    // termina detalle de atributo
    
                });
            }
    
        })
        .fail();

    }else{

        $("#selectDeAtributos").hide();

    }

}


function  cambioAgrupaServicio(){
		
	let contenidoDivServicioAgrupado = document.getElementById("divServicioAgrupado");
    let checkservicioAgrupadoCheck = document.getElementById("servicioAgrupadoCheck");
	
	
	
        if (checkservicioAgrupadoCheck.checked) {
            contenidoDivServicioAgrupado.style.display='block';
        }
        else {
            contenidoDivServicioAgrupado.style.display='none';
        }
	
}


function  cambioCheckCodigoBarras(){
		
	let contenidoCodigoBarras = document.getElementById("divCodigoBarras");
    let checkCodigoBarras = document.getElementById("codigoBarrasCheck");
	
	
	console.log("llegue al check");
	
        if (checkCodigoBarras.checked) {
            contenidoCodigoBarras.style.display='block';
        }
        else {
            contenidoCodigoBarras.style.display='none';
        }
	
}




function  cambioCheckImpresion(){
		
	let contenidoAsesoria = document.getElementById("divPrecioImpresion");
    let checkAsesoria = document.getElementById("servicioImpresoCheck");
        if (checkAsesoria.checked) {
            contenidoAsesoria.style.display='block';
        }
        else {
            contenidoAsesoria.style.display='none';
        }
	
}





/*


function  cambioCheckImpresion(){
		
	let contenidoAsesoria = document.getElementById("divPrecioImpresion");
    //let checkAsesoria = document.getElementById("imprimible");
	
	//console.log(checkAsesoria);
	
	
	
	let valor = $('input:radio[name=customRadio]:checked').val()
	
	
	console.log("valor: ", valor);
	
	
        if (valor == "impreso") {
            contenidoAsesoria.style.display='block';
        }
        else if (valor == "noImpreso") {
            contenidoAsesoria.style.display='none';
        }
	
}
*/



function  cambioCheckPoliticas(){
		
	let contenidoAsesoria = document.getElementById("divPoliticas");
    let checkAsesoria = document.getElementById("politicas");
        if (checkAsesoria.checked) {
            contenidoAsesoria.style.display='block';
        }
        else {
            contenidoAsesoria.style.display='none';
        }
	
}



function regresar(){
    $(location).attr("href",base_url()+"app/Servicios")
}


/*
function getAtributos(){
    
    const atributoArray = new Array();

     $('.atributoList').each(function(i,e) {

        let valor = $(e).find("select").val();

        $.each(valor, function(o,u){

            if(u != ""){

                atributoArray.push(u);
            }
        })
     
    });

    return atributoArray;

    
}*/


function getAtributos(){
    
    const atributoArray = new Array();
	

     $('.atributoList').each(function(i,e) {
		 
		 
		 const selectArray = new Array();
	
		 
		 

        let valor = $(e).find("select").val();
		let atr = $(e).find("select").attr("data-atr");

		 
		 
		 if(valor != ""){
			 
			 selectArray.push(atr);
			 selectArray.push(valor);
			 
			 
			atributoArray.push(selectArray); 
		 }

    });

	
	//console.log("array ", atributoArray);
    return atributoArray;
	

    
}




function dividirCadena(cadenaADividir,separador) {
    var arrayDeCadenas = cadenaADividir.split(separador);
    
 
    //for (var i=0; i < arrayDeCadenas.length; i++) {
      // document.write(arrayDeCadenas[i] + " / ");
   // }

   return arrayDeCadenas;
 }



function quitaErroresCamposVacios(){
    $("#errornombreServicios").hide();
    $("#errordescripcionServicios").hide();
    $('#errorselectCategoriaServicios').hide();
    $('#errorsku').hide();
    $('#errorunidad').hide();
    $('#errorprecioServicios').hide();
    $('#errorprecioServiciosConImpresion').hide();
    $('#errorselectPoliticas').hide();
    $('#errorinventarioInicial').hide();
    $('#errorimg').hide();
	$('#errorprecioMayoreo').hide();
	$('#errorprecioMedioMayoreo').hide();
	$('#errorImpresoNoImpreso').hide();
	$('#errorcodigoDeBarras').hide();
	$('#errorSelectAgrupaciones').hide();
	//$('#errorinventarioInicialCant').hide();

}

function desabilitaCampos(){

    $("#btnEnviar, #nombreServicios, #descripcionServicios, #selectCategoriaServicios, #sku, #unidad, #precioServicios, #imprimible, #precioServiciosConImpresion, #codigoDeBarras,  #selectPoliticas, #selectPoliticas, #inventarioInicial, #palabrasClave, #img, #precioMayoreo , #precioMedioMayoreo, #SelectAgrupaciones, #guardar1, #guardar2, #codigoBarrasCheck ").attr("disabled", "disabled");

}





function validaCamposPrecio(){
	
	goValidation = true;
	
	
	let conteoErrores = 1;
	$("[entradaDatos]").each((i,e)=>{
		
		
		console.log(e);
		
		
		
		if($(e).is("input") || $(e).is("textarea") ){
		
			let dato = $(e).val();
			
			//console.log(dato.trim());
			console.log('#error'+($(e).attr("id")));
			
		
			
			if("" == dato.trim()){
				
				console.log(conteoErrores ++);
				
				$('#error'+($(e).attr("id"))).show();
				$('#error'+($(e).attr("id"))).html("Campo Requerido ");
				$('#'+($(e).attr("id"))).focus();	
				goValidation = false;
				habilitaCampos();

			}
			
		}
		
	})
	
	
	
	return goValidation;
	
	
}


function quitarErroresCamposPrecio(){
	
	$("[entradaDatos]").each((i,e)=>{
		
		$('#error'+($(e).attr("id"))).hide();

	})
}
							 
function desabilitaCamposPrecios(){
	
	$("[entradaDatos]").each((i,d)=>{
		$(d).attr("disabled", "disabled")
	})
	
}



function habilitaCamposPrecio(){
	//$("#btnEnviar, #nombreEmpresa").removeAttr("disabled"); 
	
	$("[entradaDatos]").each( (i, e)=>{
    
		$(e).removeAttr("disabled");
		
		
		//console.log($(e));
		//console.log($(e).attr("id"));
		//console.log($(e).val());
		
	});
}








function habilitaCampos(){
    $("#btnEnviar, #nombreServicios, #descripcionServicios, #selectCategoriaServicios, #sku, #unidad, #precioServicios, #imprimible, #precioServiciosConImpresion, #codigoDeBarras,  #selectPoliticas, #selectPoliticas, #inventarioInicial, #palabrasClave, #img, #precioMayoreo , #precioMedioMayoreo, #SelectAgrupaciones, #guardar1, #guardar2, #codigoBarrasCheck" ).removeAttr("disabled"); 
}




function verificaPreDinPro(){
	
	let contadorFilas = 0;
	
	$(".filaSelecionadaPreDinPro").each(function(i,e){
				
		$(e).find("[indetiPreDinPro]").each((i,e)=>{
			
			contadorFilas ++;

		});
					
	});
	
	return contadorFilas;
}

function verificaPreSerImp(){
	
	let contadorFilas = 0;
	
	$(".filaSelecionada").each(function(i,e){
				
		$(e).find("[indeti]").each((i,e)=>{
			
			contadorFilas ++;

		});
					
	});
	
	return contadorFilas;
}







function insertaServicios(){

	quitarErroresCamposPrecio();
    quitaErroresCamposVacios();

    desabilitaCampos();
	desabilitaCamposPrecios();
	
	const noDePreciosImpresos = verificaPreSerImp();
	const noDePreciosProducto = verificaPreDinPro();

    let id = $("#idS").val();
    let sku = $("#sku").val();
    let nom = $("#nombreServicios").val();
    let des = $("#descripcionServicios").val();
    let precioS = $("#precioServicios").val();
    let categoriaServicios = $("#selectCategoriaServicios").val();
    let unidad = $('#selectUnidades').val();
    let impresion = 0;
	let noImpresion = 0;
    let inventarioMinimo = $("#inventarioMinimo").val();
	
		
	let selectPrecios = $("#selectPreciosBases").val();
	
	let selectAtributos = $("#selectAtributosAdicionales").val();
	
	/*
	let cantidadMedioMayoreo = $("#cantidadMedioMayoreo").val();
    let precioMedioMayoreo = $("#precioMedioMayoreo").val();
    let cantidadMayoreo = $("#cantidadMayoreo").val();
    let precioMayoreo = $("#precioMayoreo").val();
	*/
	
    let accion = $("#accion").val();
    let goValidation = true;
    let estatus = 1;
    let costoImpresion = 0;
    let politicaImpresion = 1;
    var img = $("#img")[0].files[0];
    let tags = $("#palabrasClave").val();
	let areaImpre = $("#areaImpresion").val();
	let idAS = null;
	
	
	if(unidad == '5'){
		
		 $('#erroranchoMaterial').hide();
		
		 $("#anchoMaterial").attr("disabled", "disabled")
		
		 let anchoMaterial = $("#anchoMaterial").val();

		console.log('unidad', unidad);
		
		if(anchoMaterial == '0' || anchoMaterial.trim() == '' ){
			
			console.log('entro en el if error');
			
			$('#erroranchoMaterial').show();
			$('#erroranchoMaterial').html("El tamaño del material no debe estar vacio o igual a 0");
			$('#erroranchoMaterial').focus();	
			
			goValidation = false;
			
			$("#anchoMaterial").removeAttr("disabled"); 
			
		}
		
		
	}
	
	
	
	if(accion == "duplicar"){
		let checkCodigoBarras = document.getElementById("codigoBarrasCheck");
		
		
		
		if(checkCodigoBarras.checked ){
			let codigoDeBarras = $("#codigoDeBarras").val();
			if("" == codigoDeBarras.trim() ){
				$('#errorcodigoDeBarras').show();
				$('#errorcodigoDeBarras').html("Captura el codigo de barras");
				$('#codigoDeBarras').focus();	
				goValidation = false;
				habilitaCampos() 
			}else{
				id =codigoDeBarras;
			}

		}else{
		
			let tiempo = new Date();
			let hora = tiempo.getHours();
			let minuto = tiempo.getMinutes();
			let segundo = tiempo.getSeconds();

			let nombreExtr = nom.trim().substring(0,3).replace(/[ñn]/g, 'n');
			let catego = $('#selectCategoriaServicios option:selected').html();

			catego = catego.substring(0,3);
			id = "SDI-" + decodeURI(catego) + "-" + decodeURI(nombreExtr.trim().replace(/[ñn]/g, 'n')) + "-" + hora + minuto + segundo;
		}
		
		
		
		
		
	}
	
	
	let checkservicioAgrupadoCheck = document.getElementById("servicioAgrupadoCheck");
	
	
	
	if(checkservicioAgrupadoCheck.checked){
		
		idAS = $("#SelectAgrupaciones").val();
		
		if(idAS == "selecciona" ){
			$('#errorSelectAgrupaciones').show();
			$('#errorSelectAgrupaciones').html("Debes seleccionar al menos una agrupación");
			$('#SelectAgrupaciones').focus();	
			goValidation = false;
			habilitaCampos() ;
			
		}
		
		
		
	}
	
	
	
	const respuestaValidaPrecios = validaCamposPrecio();
	
	
	
	const arregloPreciosImpresion = new Array();	
	
	if(noDePreciosImpresos >= 1){
		
		$('.filaSelecionada').each(function(i,e) {
			
			const precioImpresoOBJ = new Object();				

			$(e).find("[data]").each((i,e)=>{
				
				let nombreDB = $(e).attr("db");
				
				precioImpresoOBJ[nombreDB] = $(e).val();

            });
			
			arregloPreciosImpresion.push(precioImpresoOBJ);

			/*$(this).children("td").each(function(i,e){            });*/
		});
		
	} 
		
	
	
	const arregloPreciosProducto = new Array();	
	
	if(noDePreciosProducto >= 1){
		
		$('.filaSelecionadaPreDinPro').each(function(i,e) {
			
			const precioProOBJ = new Object();				

			$(e).find("[dataPreDinPro]").each((i,e)=>{
				
				let nombreDB = $(e).attr("db");
				
				precioProOBJ[nombreDB] = $(e).val();

            });
			
			arregloPreciosProducto.push(precioProOBJ);

			/*$(this).children("td").each(function(i,e){            });*/
		});	
		
	} 
	
 
	console.log("array 1 ", arregloPreciosImpresion);
	
	console.log("array 2 ", arregloPreciosProducto);
	
	

    console.log("Normal ",getAtributos());

    listaAtributos = JSON.stringify(getAtributos());
	/*
	if(cantidadMedioMayoreo == ""){
		cantidadMedioMayoreo = "0"	   
}
	
	if(cantidadMayoreo == ""){
		cantidadMayoreo = "0"
} */

    //let separador = ",";

    //let atributos = $("#listaAtributos").val();

     //const datos = dividirCadena(String(listaAtributos), separador);

    //console.log("esta es la cadena que se creo ", datos);

    

   //console.log(listaAtributos);

    if(accion == "editar"){
        estatus = $("#estatusModal").val();
    }



    //console.log(img);
	
if(accion == "duplicar"){
	if(undefined == img){
        $('#errorimg').show();
        $('#errorimg').html("Selecciona una imagen");
        $('#img').focus();	
        goValidation = false;
        habilitaCampos();
    }
	
}	



	
	
	
	/*
		
	if(cantidadMedioMayoreo.trim() >= 1 && cantidadMedioMayoreo.trim() != "" ){
		
		if(precioMedioMayoreo == 0){
			$('#errorprecioMedioMayoreo').show();
			$('#errorprecioMedioMayoreo').html("El precio debe ser mayor de 0");
			$('#precioMedioMayoreo').focus();	
			goValidation = false;
			habilitaCampos() 
    }
}
	
	if(cantidadMayoreo.trim() >= 1 && cantidadMayoreo.trim() != ""  ){
		
		if(precioMayoreo == 0){
			$('#errorprecioMayoreo').show();
			$('#errorprecioMayoreo').html("El precio debe ser mayor de 0");
			$('#precioMayoreo').focus();	
			goValidation = false;
			habilitaCampos() 
    }
}
	*/
	
	/*let conteoImpreNoImpre = 0;   
	
    let checkHayAtributoImpresoNoImpreso = document.getElementById("noImprimible");
	let checkHayAtributoNoImpreso = document.getElementById("imprimible");
	
	
	
        if (checkHayAtributoImpresoNoImpreso.checked || checkHayAtributoNoImpreso.checked  ) {
			
			conteoImpreNoImpre ++ ;
        

        }
	
	
	
	if (conteoImpreNoImpre == 0) {
           
            $('#errorImpresoNoImpreso').show();
            $('#errorImpresoNoImpreso').html("Debes seleccion al menos un atributo");
            $('#ImpresoNoImpreso').focus();	
            goValidation = false;
            habilitaCampos();
        
        }*/
	
	
	/*
	
	let valorImpresion = $('input:radio[name=customRadio]:checked').val();
	
	console.log("valor:", valorImpresion);
	
	
	
	
	if (valorImpresion == "noImpreso" ) {
           noImpresion = 1;
        }
    
    //let checkAsesoriaU = document.getElementById("imprimible");
        if (valorImpresion == "impreso") {
           costoImpresion =  $("#precioServiciosConImpresion").val();
           impresion = 1;

           if("0" == costoImpresion){
            $('#errorprecioServiciosConImpresion').show();
            $('#errorprecioServiciosConImpresion').html("El precio de la impresion no puede ser 0");
            $('#precioServiciosConImpresion').focus();	
            goValidation = false;
            habilitaCampos();
        }

        }
	
	
	*/
	
	
	
	let conteoImpreNoImpre = 0;   
	
    let checkHayAtributoImpresoNoImpreso = document.getElementById("servicioNoImpresoCheck");
	let checkHayAtributoNoImpreso = document.getElementById("servicioImpresoCheck");
	
        if (checkHayAtributoImpresoNoImpreso.checked || checkHayAtributoNoImpreso.checked  ) {
			conteoImpreNoImpre ++ ;
        }
	
	
	
	if (conteoImpreNoImpre == 0) {
           
            $('#errorImpresoNoImpreso').show();
            $('#errorImpresoNoImpreso').html("Debes seleccion al menos un atributo");
            $('#ImpresoNoImpreso').focus();	
            goValidation = false;
            habilitaCampos();
        
        }
	
	
	if (checkHayAtributoImpresoNoImpreso.checked) {
           noImpresion = 1;
        }
	
    let checkParaPrecioImpresion = document.getElementById("servicioImpresoCheck");
        if (checkParaPrecioImpresion.checked) {
           costoImpresion =  $("#precioServiciosConImpresion").val();
           impresion = 1;

           if("0" == costoImpresion || costoImpresion.trim() == "" ){
            $('#errorprecioServiciosConImpresion').show();
            $('#errorprecioServiciosConImpresion').html("El precio de la impresion no puede ser 0");
            $('#precioServiciosConImpresion').focus();	
            goValidation = false;
            habilitaCampos();
        }

     }
	
	
	
	
	
	
	
	

        let checkPoliticas = document.getElementById("politicas");
        if (checkPoliticas.checked) {
            politicaImpresion =  $("#selectPoliticas").val();

			   if ("Selecciona" == politicaImpresion) {
			   	$('#errorselectPoliticas').show();
			   	$('#errorselectPoliticas').html("Seleccion una politica de impresion");
			   	$('#selectPoliticas').focus();
			   	goValidation = false;
			   	habilitaCampos();
			   }

        }
		

    



    


    if("Selecciona" == unidad){
        $('#errorunidad').show();
        $('#errorunidad').html("Selecciona una unidad");
        $('#unidad').focus();	
        goValidation = false;
        habilitaCampos();
    }



    if("" == sku.trim()){
        $('#errorsku').show();
        $('#errorsku').html("Escribe un SKU");
        $('#sku').focus();	
        goValidation = false;
        habilitaCampos();
    }




    if("Selecciona" == categoriaServicios){
        $('#errorselectCategoriaServicios').show();
        $('#errorselectCategoriaServicios').html("Elige una categoría");
        $('#selectCategoriaServicios').focus();	
        goValidation = false;
        habilitaCampos();
    }

    if("0" == precioS.trim()){
        $('#errorprecioServicios').show();
        $('#errorprecioServicios').html("Ingresa un precio");
        $('#precioServicios').focus();	
        goValidation = false;
        habilitaCampos();
    }

    if("" == des.trim()){
        $('#errordescripcionServicios').show();
        $('#errordescripcionServicios').html("Ingresa una descripción");
        $('#descripcionServicios').focus();	
        goValidation = false;
        habilitaCampos() 
    }

    if("" == nom.trim()){
        $('#errornombreServicios').show();
        $('#errornombreServicios').html("Ingresa un nombre");
        $('#nombreServicios').focus();	
        goValidation = false;
        habilitaCampos();
    }

    if(goValidation){
		
	desabilitaCampos();	


    var fd = new FormData();
		
		
	if(unidad == '5'){
		let anchoMaterial = $("#anchoMaterial").val();		
		fd.append("anchoMaterial", anchoMaterial);
	}	

    fd.append("idS", id);
    fd.append("sku", sku);
    fd.append("nombreS", nom);
    fd.append("desS", des);
    fd.append("precioS", precioS);
    fd.append("idCS", categoriaServicios);
    fd.append("impresion", impresion);
    fd.append("precioImpresion", costoImpresion);
    fd.append("idPolImpre", politicaImpresion);
    fd.append("estatus", estatus);
    
    fd.append("inventarioMin", inventarioMinimo);
    /*
	fd.append("cantidadMayoreo", cantidadMayoreo);
    fd.append("precioMayoreo", precioMayoreo);
    */
	
	/*
	
	*/
	fd.append("idUnidad", unidad);
    fd.append("accion", accion);
    fd.append("atributos", listaAtributos);
    fd.append("tags",tags);
	fd.append("noImpreso",noImpresion);
	
	
	fd.append("preciosBases",selectPrecios);
	
	console.log("Spy precios bases",selectPrecios);
	
	fd.append("Atributos_mas",selectAtributos);
	
	console.log("Soy los atributos",selectAtributos);
	/*
	fd.append("cantidadMedioMayoreo",cantidadMedioMayoreo);
	fd.append("precioMedioMayoreo",precioMedioMayoreo);
	*/
	fd.append("areaImpresion", areaImpre);
		
		
	fd.append("preciosImpresion", JSON.stringify(arregloPreciosImpresion));
	
 	fd.append("preciosProducto",JSON.stringify(arregloPreciosProducto));	
		
	fd.append("idAS", idAS);	


    if($("#img")[0].files.length > 0){
        fd.append("image_url", img);
    }
		
		
		
		accion == "actualizar"		


			$.ajax({
				"url":base_url()+(accion == "actualizar" ? "app/ActualizaServicios/insertaServicios" : "app/AgregarServicios/insertaServicios"),
				"type":"POST",
				"dataType":"JSON",
				"data":fd,
				"processData": false,
				"contentType": false
			})
			.done((data)=>{


				if(data.resultado){

					console.log(data);


					toastr["success"](data.mensaje);

					window.setTimeout( () => {

						//window.location.href = base_url();
						$(location).attr("href",base_url()+"app/Servicios");
						
					}, 1000);




				}else{

					toastr["warning"](data.mensaje);
					habilitaCampos();
				}
			})
			.fail(function(data){
				toastr["warning"](data.mensaje);
					habilitaCampos();
			});


		

    }

} // termina insertar servicio



/*Carga de imagen  --------------------------------------------------------------------
-------------------------------
    */

    


$(".custom-file-input").on("change", function() {
    let fileName = $(this).val().split("\\").pop();
    let label = $(this).siblings(".custom-file-label");


    /* --------
    let filename2 = $("#img2").val();
    let label2 =  $(".custom-file-label2").siblings();

    console.log(filename2);
    console.log(label2);
    console.log(label2.data);
    console.log(fileName);
    console.log(label);
    */

    if (label.data("default-title") === undefined) {
        label.data("default-title", label.html());
    }

    if (fileName === "") {
        label.removeClass("selected").html(label.data("default-title"));
    } else {
        label.addClass("selected").html(fileName);
    }
});


/*Carga de imagen  --------------------------------------------------------------------
-------------------------------
    */


//traigo la unidad de input hidden en la vista

function listaUnidades(){
        
    let unidadAnterior = $("#idUnidad").val();
	
	console.log("anterior ", unidadAnterior);

    $.ajax({
        "url":base_url()+"app/Unidades/verUnidades",
        "dataType":"JSON"
    })
    .done((data)=>{

        $("#selectUnidades").html("");

        if(data.resultado){

            $("#divUnidades").find("select").append(`
            <option value="Selecciona">--Selecciona--</option>
            `
            );

            $.each(data.Unidades, function(i,o){

                if(o.estatus == 1){
                    $("#divUnidades").find("select").append(`
                <option value="`+ o.idUni+`" `+(unidadAnterior == o.idUni ? "selected": "" )+`>`+ o.nombreUni+`</option>
                `
                );

                }   

            });
			
			

        }else{

            $("#divUnidades").find("select").append(`
            <option value="Selecciona">--No existen categorias para mostrar--</option>
            `
            );
        }

    })
    .fail();

muestraAnchoMaterial(unidadAnterior);

}




function listaPoliticas(){
    


let politicaAnterior = $("#idPolitica").val();


console.log(politicaAnterior);

    $.ajax({
        "url":base_url()+"app/Politicas/verPoliticas",
        "dataType":"JSON"
    })
    .done((data)=>{

       

        $("#selectPoliticas").html("");

     
        

        if(data.resultado){


            

            $("#divPoliticas").find("select").append(`
            <option value="Selecciona">--Selecciona--</option>
            `
            );

            $.each(data.Politicas, function(i,o){

                

                if(o.estatus == 1){
                    $("#divPoliticas").find("select").append(`
                <option value="`+ o.idPol+`" `+(politicaAnterior == o.idPol ? "selected": "")+`>`+ o.nombrePol+`</option>
                `
                );

                }   

            });

        }else{

            $("#divPoliticas").find("select").append(`
            <option value="Selecciona">--No existen categorias para mostrar--</option>
            `
            );
        }

    })
    .fail();



}


function getAtributosDeServicios(){


    let id = $("#idS").val();

    const atributosDelServicio = new Array();

    $.ajax({
        "url":base_url()+"app/Atributos/getAtributosDeServicio",
        "dataType":"JSON",
        "type":"POST",
        "data":{
            "id":id
        }
    })
    .done((data)=>{

        
        if(data.resultado){

        
            $.each(data.atributosCategoria, function(i,a){

                atributosDelServicio.push(a.idDAtr);

            });

        }else{

            
 
        }

    })
    .fail();

    return atributosDelServicio;


}






function agrupacionServicios(){
	$.ajax({
        "url":base_url()+"app/AgrupacionesServicios/verAgrupacionesServicios",
		"dataType":"JSON"
		
	})
	.done((data)=>{
		
		
		if(data.resultado){
			
			$("#SelectAgrupaciones").html('<option value="selecciona" label="&nbsp;">&nbsp;</option>');
			$.each(data.AgrupacionesServicios, function(i,a){
				
				$("#SelectAgrupaciones").append('<option value="'+a.idAgrupacionS+'">'+a.nombreAgrupaS+'</option>');
				
				
			})
			
			
		}else{
			$("#SelectAgrupaciones").html('<option label="&nbsp;">&nbsp;</option><option label="&nbsp;">No hay agrupaciones</option>');
			
		}
		
		
		
	})
	.fail();
}


function insertaAgrupacionesServicios(){

    quitaErroresCamposVaciosAS();

    $("#btnEnviar, #nombreAgrupacionesServicios").attr("disabled", "disabled");

    let idAS = $("#idAgrupacionS").val();
    let nom = $("#nombreAgrupacionesServicios").val();
    
    let accion = $("#accion").val();
    let goValidation = true;
    let estatus = 1;

    

        if(accion == "editar"){
            estatus = $("#estatusModal").val();
        }

  
    if("" == nom.trim()){
        $('#errornombreAgrupacionesServicios').show();
        $('#errornombreAgrupacionesServicios').html("Ingresa un nombre");
        $('#nombreAgrupacionesServicios').focus();	
        goValidation = false;
        $("#btnEnviar, #nombreAgrupacionesServicios").removeAttr("disabled"); 
    }

    if(goValidation){

        axios.post(base_url()+"app/AgrupacionesServicios/insertaAgrupacionesServicios", {
            idAgrupacionS:idAS,
            nombreAgrupaS: nom,
            
            estatus: estatus,
            accion:accion
        })
        .then(({data})=>{

            if(data.resultado){
				
                toastr["success"](data.mensaje);
                $("#nombreAgrupacionesServicios").val("");
                $("#ModalAgregar").modal('hide');
                $("#btnEnviar, #nombreAgrupacionesServicios").removeAttr("disabled"); 
				agrupacionServicios();
                
            }else{

                toastr["warning"](data.mensaje);
                $("#btnEnviar, #nombreAgrupacionesServicios").removeAttr("disabled"); 

            }
            
        })
        .catch(error=>{
            console.log(error);
        })

    }else{

        console.log("Falta un dato");

    }

} // termina insertar agrupacion servicio




function agregaAgrupacionServicio(){
	 quitaErroresCamposVaciosAS();

    $("#btnEnviar").html("Agregar");
    $('#ModalAgregar').modal('show');
    $("#nombreModal").html("Agregar Agrupación de servicio");
    $("#nombreAgrupacionesServicios").val("");
    
    $("#accion").val("Agregar");
    $("#idAgrupacionS").val("0");
	
}

function quitaErroresCamposVaciosAS(){
    $("#errornombreAgrupacionesServicios").hide();
    
}



function mostrarPreciosBases(){

	console.log("Se le dio click en la function de chech box");
	
	let contenidoPreciosBases = document.getElementById("divPreciosBases");
	
	let checkBases = document.getElementById("preciosBasesCheck");
	
	if(checkBases.checked){
		console.log("entro en 1 en precios bases");
		contenidoPreciosBases.style.display='block';
	
	}else{
		
		console.log("entro en 2 a precios bases")
		contenidoPreciosBases.style.display='none';
		$("#selectPreciosBases").html("");
	
	
	}

}
function cambioCheckAtributos(){

	console.log("sOY CHEXBOX DE LOS ATRIBUTOS");
	
	let contenidoAtributos = document.getElementById("divSelectAtributos");
	
	let checkAtributos = document.getElementById("atributosCheck");
	
	if(checkAtributos.checked){
		contenidoAtributos.style.display='block';
	
	
	
	}else{
		contenidoAtributos.style.display='none';
		$("#selectAtributosAdicionales").html("");
		
	
	
	}


}

function lista_precios_bases(){
	 
	let servicio = $("#idServiciooo").val();
	
	
	
	console.log("Soy el id del servicio",servicio);
	
	
	$("#selectPreciosBases").html("");
	
	let arrayPreciosBases = new Array();
	
	$.ajax({
		"url" : base_url() + "app/AgregarServicios/preciosBases_select",
		"dataType" : "JSON",
		"type" 	: "POST",
		"data":{
			idS:servicio
		}
	})
	.done((data)=>{
		
		if(data.resultado){
			
			console.log("Listado de precios",data.todos_precios);
			console.table(data.todos_precios);
			
			arrayPrecios = data.Precios_seleccionados;
			
			console.log("Soy precios array ",arrayPrecios);
			
				$.ajax({
							"url" : base_url() + "app/AgregarServicios/preciosBases_select",
							"dataType" : "JSON",
							"type" 	: "POST",
							"data":{
								idS:servicio
							}

			})
			.done((data)=>{
				
				if(data.resultado){
				
					$("#divPreciosBases").find("select").html(`
                            <option label="&nbsp;">&nbsp;</option>
                
                    `);
					
					$.each(data.todos_precios, function(i,o){
						
						if(o.estatus == 1){
							let bandera = 0;
							
							
							$.each(arrayPrecios, function(m,n){
								
								if(o.idAtrD == n.idAtrD){
									$("#divPreciosBases").find("select").append(`
										<option value="`+ o.idAtrD+`" Selected >`+ o.nombreAtrD+`</option>
									
									`);
									
									bandera = 1;
								}

							})
							if(bandera != 1){

								$("#divPreciosBases").find("select").append(`
                                   <option value="`+ o.idAtrD+`">`+ o.nombreAtrD+`</option>
                                        
                                        `
                                        );

							}else{
								bandera = 0;
							
							
							}

						}

					
					})

				}

			})
			.fail();

		}else{
			toastr["sucess"](data.mensaje);

		}

	})
	.fail();

}


function lista_atributos_mas(){
    let servicio = $("#idServiciooo").val();

    $("#selectAtributosAdicionales").html("");

    let arrayAtributos = new Array();

    $.ajax({
        "url" : base_url() + "app/AgregarServicios/atributos_seleccionados",
        "dataType" : "JSON",
        "type" : "POST",
        "data" : {
            idS:servicio
        }
    })
    .done((data) => {
            if(data.resultado){

                arrayAtributos = data.atributos_seleccionados;

                console.log("Soy atributos",arrayAtributos);

                $.ajax({
                    "url" : base_url() + "app/AgregarServicios/atributos_seleccionados",
                    "dataType" : "JSON",
                    "type" : "POST",
                    "data" : {
                        idS:servicio
                    }
                })
                .done((data) =>{

                    if(data.resultado){

                        $("#divSelectAtributos").find("select").html(`
                            <option label="&nbsp;">&nbsp;</option>

                        `);
                        $.each(data.todos_atributos, function(i,o){
                                if(o.estatus == 1){
                                   
                                    
                                    let bandera = 0;

                                    $.each(arrayAtributos, function(m,n){
                                        if(o.idAtrD == n.idAtrD){
                                            $("#divSelectAtributos").find("select").append(`
                                            <option value="`+ o.idAtrD+`" Selected >`+ o.nombreAtrD+`</option>
                                        
                                        `);
                                        bandera = 1;
                                        

                                        }
                                    })
                                    if(bandera != 1){
                                        $("#divSelectAtributos").find("select").append(`
                                        <option value="`+ o.idAtrD+`">`+ o.nombreAtrD+`</option>
                                             
                                             `
                                             );

                                    }else{
                                        bandera = 0;
                                    }

                                }
                        })

                        
                    }
                })
                .fail();




            }else{
                toastr["sucess"](data.mensaje);
            }


        })
        .fail();

}
function listaAtributos_adicionales(){
	
	$("#selectAtributosAdicionales").html("");
	        $.ajax({
            "url":base_url()+"app/AgregarServicios/atributos_adicionales",
            "dataType":"JSON"
        })
        .done((data)=>{
            if(data.resultado){

                $("#divSelectAtributos").find("select").html(`
                <option label="&nbsp;">&nbsp;</option>
                `
                );
                $.each(data.Atributos_adicionales, function(i,o){

                    if(o.estatus == 1){
                        $("#divSelectAtributos").find("select").append(`
                    <option value="`+ o.idAtrD+`">`+ o.nombreAtrD+`</option>
                    
                    `
                    );

                    }
                });
    
            }else{
    
                $("#divSelectAtributos").find("select").append(`
                <option value="Selecciona">--No existen atributos para mostrar--</option>
                `
                );
            }
        })
        .fail();
}
function listaPrecios_bases(){
	$("#selectPreciosBases").html("");
	
	
		
		
		$.ajax({
            "url":base_url()+"app/AgregarServicios/precios_bases",
            "dataType":"JSON"
        })
        .done((data)=>{
            if(data.resultado){
				
				console.log("Soy data resultado de listaPrecios_bases",data.resultado);
				
				

                $("#divPreciosBases").find("select").html(`
                <option label="&nbsp;">&nbsp;</option>
                `
                );
                $.each(data.Precios_bases, function(i,o){

                    if(o.estatus == 1){
						console.log("Entro en data.Precios_bases",data.Precios_bases);
                        $("#divPreciosBases").find("select").append(`
                    <option value="`+ o.idAtrD+`">`+ o.nombreAtrD+`</option>
                    
                    `
                    );

                    }
                });
    
            }else{
    
                $("#divPreciosBases").find("select").append(`
                <option value="Selecciona">--No existen precios diagnosticas para mostrar--</option>
                `
                );
            }
        })
        .fail();
	


}


