$(document).ready(()=>{


    //alert("ya estamos aqui");
    //$("#datatable").find("tbody").html("");
    listatipocontratacion ();
    listaAgrupaServicios();
    listaServicios();
    //listanombreASsMesaFAQS();

    $("#editarAgr").click(()=>{

        $("#first-tab").removeClass("active");
        $("#second-tab").addClass("active");
        

    })


    $("#btnAgregarServicio").click((e)=>{
        e.preventDefault();
		
		 
        $("#btnAgregarServicio").attr("disabled", "disabled");

		
		
		
	    $("#errorselectListaServicios").hide();

		let idServicio = $("#selectListaServicios").val();
		let validaSeleccionServicio = true;
		
		
		if (idServicio == "Selecciona"){
			console.log("entro aqui");
            $('#errorselectListaServicios').show();
            $('#errorselectListaServicios').html("Elige un servicio");
            $('#selectListaServicios').focus();	
            validaSeleccionServicio = false;
		}
		
		
		console.log(idServicio);
		
		
		if(validaSeleccionServicio){
			
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
				
				
				$("#bodySeleccionados").append(`
					<tr  class="filaSelecionada" id="tr-`+data.Servicio[0].idS+`">
						<td data  scope="row" id="idSelecionado">`+data.Servicio[0].idS+`</td>
						<td class="text-wrap" style="width: 12rem;">`+data.Servicio[0].nombreS+`</td>
						<td class="text-wrap" style="width: 15rem;">`+data.Servicio[0].desS+` </td>
						<td>`+data.Servicio[0].precioS+`</td>
						<td ><input value='0' size="3" type="number" data id="costo-`+data.Servicio[0].idS+`" onchange="subTotalServicio(`+data.Servicio[0].idS+`)"/></td>
						<td ><input value='0' size="5" type="number" data id="cantidad-`+data.Servicio[0].idS+`" onchange="subTotalServicio(`+data.Servicio[0].idS+`)" /></td>
						<td id="Subtotal-`+data.Servicio[0].idS+`" class="subtotal">0</td>
						<td><button onclick="quitarDeLista(`+data.Servicio[0].idS+`)">Quitar</button></td>
					</tr>
				`);
				
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
	
	$("#tr-"+id).remove();
	
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
	
	console.log("total ", sumaTotal);
	
	$("#totalSuma").html(sumaTotal);
}

function editarTab(){

    $("#first-tab").removeClass("active");
    $("#second-tab").addClass("active");
}



    
    function listaAgrupaServicios(){
    
    
        axios(base_url()+"app/AgrupaServicios/verAgrupaServicios")
        .then(({data})=>{
    
            if(data.resultado){
    
                $("#despliegueTabla").html(`
                <table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Costo</th>
                            <th>Tipo de contratación</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                            <th>Vista previa</th>
                            <th style="text-align: center">Estatus</th>
                            <th style="text-align: center">Editar</th>
                            <th style="text-align: center">Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                
                    </tbody>
                </table>`
                );

               

                 
                
    
                $.each(data.AgrupaServicios, function(i,o){
    
                    $("#datatable").find("tbody").append(`
                        <tr id="tr-`+ o.idAS+`">
                            <td>`+ o.idAS+`</td>
                            <td>`+ o.nombreAS+`</td>
                            <td class="text-wrap" style="width: 15rem;" >`+ o.desAS+`</td>
                            <td>`+ o.costoTotal+`</td>
                            <td class="text-wrap" style="width: 15rem;" >`+ o.nombreTC+`</td>
                            <td>`+(o.fechaInicio == "0000-00-00" ? "N/A": o.fechaInicio)+`</td>
                            <td>`+(o.fechaFin == "0000-00-00" ? "N/A": o.fechaFin)+`</td>
                            <td><a href="#" onclick="vistaPrevia(`+o.idAS+`,'`+o.nombreAS+`','`+o.costoTotal+`')"><i class="fas fa-list fa-2x"></i></a></td>
                            <td align="center"><a href="#" onclick="cambiaEstatus(`+o.idAS+`)"><i id="icono-`+o.idAS+`" class="fas fa-toggle-`+(o.estatus == 1 ? 'on':'off')+` fa-2x"></i></a></td>
                            <td align="center"><a  class="nav-link " id="second-tab" data-toggle="tab" href="#second" role="tab"
                            aria-controls="second" aria-selected="true"  onclick="editar(`+o.idAS+`,'`+o.nombreAS+`','`+o.desAS+`','`+o.costoTotal+`','`+o.idTC+`','`+o.fechaInicio+`','`+o.fechaFin+`','`+o.estatus+`')"><i class="fas fa-pencil fa-2x"></i></a> </td>
                            <td align="center"><a href="#" onclick="modalBorrar(`+o.idAS+`,'`+o.nombreAS+`','`+o.desAS+`')"><i class="fas fa-trash fa-2x"></i></a></td>
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

    function vistaPrevia(id, nombre, costoTotal){


        $.ajax({
            "url":base_url()+"app/AgrupaServicios/vistaPrevia",
            "dataType":"JSON",
            "type":"POST",
            "data":{
                id:id
            }

        })
        .done((data)=>{

            $("#cuerpoModalVistaPrevia").html("");
            $("#tituloModaVistaPrevia").html("");

            if(data.resultado){

                 $('#vistaPreviaModal').modal('show');
                 $("#tituloModaVistaPrevia").html("Vista previa: <strong> "+nombre+ " </strong>");

                 $("#cuerpoModalVistaPrevia").html("Nombre del grupo: <strong> "+nombre+ " </strong></br>");
                 $.each(data.servicios, function(i,o){
     
                     $("#cuerpoModalVistaPrevia").append("<li>Nombre: <strong> "+o.nombreS+"</strong> Descripción: <strong> "+o.desS+"</strong> Cantidad: <strong> "+o.cantidad+" </strong> Costo: <strong> "+o.costo+"</strong></li>");
                 });

                $("#cuerpoModalVistaPrevia").append("Total: <strong> "+costoTotal+ " </strong></br>");

            }else{

                toastr["success"](data.mensaje);
                 console.log(data);

            }
        

        })
        .fail();

    }
    
    
    
    function insertaAgrupaServicios(){

    
        quitaErroresCamposVacios();
        
        //agrega el disabled a los campos
        agregarDisabled();
    
        let id = $("#idAS").val();
        let nom = $("#nombreAgrupacion").val();
        let des = $.trim($("#descripcion").val());
        let selectTiposContratacion = $("#selectTiposContratacion").val();
		let selectListaServicios = $("#selectListaServicios").val();
		let fechaInicio = $("#fechaInicio").val();
		let fechaFin = $("#fechaFin").val();
        let sumaTotal = $.trim($("#totalSuma").text());
		
		
        
        let accion = $("#accion").val();
        let goValidASion = true;
        let estatus = 1;
    
            if(accion == "editar"){
                estatus = $("#estatusAS").val();
            }
    
             if("Selecciona" == selectTiposContratacion){
				$('#errorselectTiposContratacion').show();
				$('#errorselectTiposContratacion').html("Elige un tipo de contratación");
				$('#selectTiposContratacion').focus();	
				goValidASion = false;
				removerDisabled();
			}
            if("" == des){
                $('#errordescripcion').show();
                $('#errordescripcion').html("Captura una descripcion ");
                $('#descripcion').focus();	
                goValidASion = false;
                removerDisabled();

            }

        if("" == nom.trim()){
            $('#errornombreAgrupacion').show();
            $('#errornombreAgrupacion').html("Ingresa un título para la agrupación");
            $('#nombreAgrupacion').focus();	
            goValidASion = false;
            removerDisabled();
        }
		
		
		let i=0;

        const arregloFinal=new Array();
		
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
            goValidASion = false;
            removerDisabled();

        }

        if(sumaTotal == '0'){

            $('#errortotal').show();
            $('#errortotal').html("El costo del paquete no puede ser $0 ");
           	
            goValidASion = false;
            removerDisabled();

        }
        
        console.log(sumaTotal);




        if(goValidASion){
    
            axios.post(base_url()+"app/AgrupaServicios/insertaAgrupaServicios", {
                idAS:id,
                nombreAS: nom,
                desAS:des,
                costoTotal:sumaTotal,
                fechaInicio: fechaInicio,
                fechaFin: fechaFin,
                idTC: selectTiposContratacion,
                serviciosArray: arregloFinal,
                estatus: estatus,
                accion:accion
                

            })
            .then(({data})=>{
    
                if(data.resultado){
    
                    toastr["success"](data.mensaje);
                    $("#nombrePreguntasMesaFAQS").val("");
                    
                    



                    listaAgrupaServicios();
    
                    removerDisabled();

                    window.setTimeout( () => {

                        window.location.href = base_url() + "app/AgrupaServicios"

                    }, 2000);


                    
                }else{
    
                    toastr["warning"](data.mensaje);
                    removerDisabled();
    
                }
                
            })
            .catch(error=>{
                console.log(error);
                removerDisabled();
                listaAgrupaServicios();
    
            })
    
        }else{
    
            console.log("Falta un dato");
            listaAgrupaServicios();
            removerDisabled();
    
        }
    
    } // termina insertar tipo de pago


    function removerDisabled(){

        $("#btnAgregar, #nombreAgrupacion, #descripcion, #selectTiposContratacion, #selectListaServicios, #fechaInicio", "#fechaFin").removeAttr("disabled"); 

    }

    function agregarDisabled(){

        $("#btnAgregar, #nombreAgrupacion, #descripcion, #selectTiposContratacion, #selectListaServicios, #fechaInicio", "#fechaFin").attr("disabled", "disabled");

    }

    function agregar(){
     
		quitaErroresCamposVacios();
        $("#btnCrear").html("Agregar");
        
        $("#tituloAccion").html("Crear Agrupación");
        $("#fechaInicio").val('');
        $("#fechaFin").val('');
        $("#selectTiposContratacion").html();
        listatipocontratacion ();
        $("#nombreAgrupacion").val('');
        $("#descripcion").val('');
        $("#selectListaServicios").html("");
		//$("#selectTiposContratacion").find('option:selected').removeAttr("selected");
        //$("#selectListaServicios").find('option:selected').removeAttr("selected");
        listaServicios();
        $("#accion").val("Agregar");
        $("#idAS").val("0");
        $("#bodySeleccionados").html("");
        $("#totalSuma").html("0");
        $("#estatusAS").val("1");
    
    } // termina modal agregar tipo de pago

    function quitaErroresCamposVacios(){
        $("#errorselectTiposContratacion").hide();
        $("#errornombreAgrupacion").hide();
        
        $("#errordescripcion").hide();
        $("#errorserviciosSeleccionados").hide();
        $("#errortotal").hide();
		
    }



    function validarCamposVacios(){
        $("#errornombrePreguntasMesaFAQS").hide();
        $("#errordesPreguntasMesaFAQS").hide();
        $("#errorSelectAgrupaServicios").hide();
    }

    // funcion editar agrupacion de servicio

    function editar(id,nombre,des,costoTotal,idTC,inicio, fin, estatus){
        editarTab();
        quitaErroresCamposVacios();

        agregar();

        
        $("#tituloAccion").html("Editar Agrupación <strong>"+ nombre+"</strong>");
        $("#fechaInicio").val(inicio);
        $("#fechaFin").val(fin);
        $("#selectTiposContratacion").html();
        listatipocontratacion (idTC);
        $("#nombreAgrupacion").val(nombre);
        $("#descripcion").val(des);
        $("#selectListaServicios").html("");
		//$("#selectTiposContratacion").find('option:selected').removeAttr("selected");
        //$("#selectListaServicios").find('option:selected').removeAttr("selected");

        console.log(idTC);
        listaServicios();
        
        $("#accion").val("editar");
        $("#idAS").val(id);
        
        $("#totalSuma").html("0");
        $("#estatusAS").val(estatus);



        $("#bodySeleccionados").html("");


        $.ajax({
            "url":base_url()+"app/AgrupaServicios/vistaPrevia",
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
        $("#idAS").val(id);
        if($("#icono-"+id).hasClass("fa-toggle-on")){
            $("#estatusModal").val('1');
        }else{
            $("#estatusModal").val('0');
        }
*/
        //$("#SelectAgrupaServicios").find('option:selected').removeAttr("selected");
        //$("#SelectAgrupaServicios option[value="+idAS+"]").attr('selected', 'selected');


        
    
    } // temrina modal editar tipo de pago
    
    function cambiaEstatus(id){
    
        $.ajax({
            "url": base_url()+"app/AgrupaServicios/cambioEstatus",
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
    
    
    function modalBorrar(id,nombre,des){
    
        
        $('#borrarModal').modal('show');
        $("#tituloModalBorrar").html("Borrar <strong>"+nombre+"</strong>");
        $("#cuerpoModalBorrar").html("Estas seguro que deseas borrar: <strong>" + nombre + "</strong></br> Descripcion: <strong>" + des+"</strong>");
        $("#btnModalBorrar").attr("appData-Id",id);
    
    } // temrina modal editar tipo de pago
    
    
    function btnModalBorrar(){
    
        let id= $("#btnModalBorrar").attr("appData-Id");
    
        $.ajax({
            "url": base_url()+"app/AgrupaServicios/bajaLogica",
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


    function listatipocontratacion (idSelect=0){

        //consumimos servicio para mostrar los tipos de contratacion
        axios(base_url()+"app/TipoDeContratacion/verTipoContrataciones")
        .then(({data:Response})=>{
         console.log(Response)
        
         if(Response.resultado){
        
             /**
              * #despliegueTabla es el id de un div que se encuentra en la vista en TipoContratacion_view.php
              * se pintara la tabla en el id: despliegueTabla
              */
        
             $("#selectTiposContratacion").html('<option value="Selecciona">--Selecciona --</option>');    

             $.each(Response.tiposContrataciones, function(i,o){
        
                 $("#divListaTiposContratacion").find("select").append(`
                 <option value=`+o.idTC+` `+ (idSelect == o.idTC ? "selected": "")+`>`+o.nombreTC+` </option>
                  `
                 );
        
             });
             $("#datatable").DataTable(),$(".dataTables_length select").addClass("form-select form-select-sm");	
         }
         else{
            $("#selectTiposContratacion").html('<option label="&nbsp;">No hay tipos para mostrar</option>');    
         }
        
        
        })
        .catch(error=>{
         console.log(error, "Error al cargar el controlador verTipoContrataciones");
        })
        
     }

     // termina lista tipos de contratación


     function listaServicios(){
    
        axios(base_url()+"app/Servicios/verServicios")
        .then(({data})=>{

            console.log("Carga servicios");
    
            if(data.resultado){
    
                $("#selectListaServicios").html(`<option value="Selecciona">--Selecciona --</option>`);
    
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
    
    
     axios(base_url()+"app/AgrupaServicios/verAgrupaServicios")
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
    
     fetch(base_url()+"app/AgrupaServicios/verAgrupaServicios",{
               
            })
            .then((response)=> response.json())
            .then((result)=>{
    
                console.log(result);
    
            })
            .catch((error)=>{
                console.log("Error al cargar el controlador", error);
            })
    
    
    
    
    
    */