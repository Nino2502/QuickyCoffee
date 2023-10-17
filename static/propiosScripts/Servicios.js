$(document).ready(()=>{


    //alert("ya estamos aqui");
    $("#datatable").find("tbody").html("");

        listaServicios();
        listaCategoriasServicios();
        
       
       

       
   
       
    });
        
    function listaServicios(){
    
        axios(base_url()+"app/Servicios/verServicios")
        .then(({data})=>{

            console.log("Carga servicios");
    
            if(data.resultado){
    
                $("#despliegueTabla").html(`
                <table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>sku</th>
							<th style="text-align: center">Estatus</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Unidad</th>
                            <th>Precio</th>
                            <th>No impreso</th>
                            <th>Impreso</th>
                            <th>Costo impre</th>
							<th>Area impresión</th>
                            <th>Politca</th>
							<th>Medio Mayoreo</th>
                            <th>Precio Medio M.</th>
                            <th>Mayoreo</th>
                            <th>Precio M.</th>
                            <th>Categoría</th>
                            <th>Inv. Min</th>
                            <th>Imagen</th>
                            
                            <th style="text-align: center">Duplicar</th>
                            <th style="text-align: center">Editar</th>
                            <th style="text-align: center">Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                
                    </tbody>
                </table>`
                );
    
                $.each(data.Servicios, function(i,o){
    
                    $("#datatable").find("tbody").append(`
                        <tr id="tr-`+ o.idS+`">
                            <td>`+ o.sku+`</td>
							<td align="center"><a href="#" onclick="cambiaEstatus(`+o.idS+`)"><i id="icono-`+o.idS+`" class="fas fa-toggle-`+(o.estatus == 1 ? 'on':'off')+` fa-2x"></i></a></td>
                            <td class="text-wrap" style="width: 15rem;">`+ o.nombreS+`</td>
                            <td class="text-wrap" style="width: 15rem;">`+o.desS+`</td>
                            <td>`+o.nombreUni+`</td>
                            <td>`+o.precioS+`</td>
                            <td>`+(o.noImpreso == 1 ? "<strong>Si</strong>":"No")+`</td>
                            <td>`+(o.impresion == 1 ? "<strong>Si</strong>":"No")+`</td>
                            <td>`+o.precioImpresion+`</td>
							<td>`+(o.areaImpresion == "" ? "N/A":o.areaImpresion)+`</td>
                            <td>`+(o.idPolImpre == 0  ? "Ninguna" : o.nombrePol )+`</td>
							<td>`+o.cantidadMedioMayoreo +`</td>
                            <td>`+o.precioMedioMayoreo +`</td>
                            <td>`+o.cantidadMayoreo +`</td>
                            <td>`+o.precioMayoreo +`</td>
                            <td class="text-wrap" style="width: 12rem;">`+o.nombreCS+`</td>
                            <td>`+(o.inventarioMin >= 1 ?  o.inventarioMin : "N/A")+`</td>
                            <td><img src="`+base_url()+`static/imgServicios/`+o.image_url+`"  height="50" /></td>

						    <td align="center"><a href="#" onclick="editar('`+o.idS+`','Duplicar')"><i class="fas fa-clone fa-2x"></i></a> </td>
                            
                            <td align="center"><a href="#" onclick="editar('`+o.idS+`','Editar')"><i class="fas fa-pencil fa-2x"></i></a> </td>
                            <td align="center"><a href="#" onclick="modalBorrar('`+o.idS+`','`+o.nombreS+`')"><i class="fas fa-trash fa-2x"></i></a></td>
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
    



    //Inicia insertar servicio
    
    function insertaServicios(){

        quitaErroresCamposVacios();
    
        $("#btnEnviar, #nombreServicios, #descripcionServicios, #precioServicios, #subServicioCheck, #selectCategoriaServicios", "#selectformularioDiagnostico").attr("disabled", "disabled");
    
        let id = $("#idS").val();
        let nom = $("#nombreServicios").val();
        let des = $("#descripcionServicios").val();
        let precioS = $("#precioServicios").val();
        let categoriaServicios = $("#selectCategoriaServicios").val();
        let inventarioMinimo = $("#inventarioMinimo").val();
        let inventarioInicial = $("#inventarioInicial").val();
        let accion = $("#accion").val();
        let goValidation = true;
        let estatus = 1;
        let subServicio = 0;
        let formularioDiagnostico = null;
        var img = $("#img")[0].files[0];

        console.log(categoriaServicios);

        

        if(accion == "editar"){
            estatus = $("#estatusModal").val();
        }

        if("Selecciona" == categoriaServicios){
            $('#errorcategoriaServicios').show();
            $('#errorcategoriaServicios').html("Elige una categoría");
            $('#categoriaServicios').focus();	
            goValidation = false;
            $("#btnEnviar, #nombreServicios, #descripcionServicios, #precioServicios, #subServicioCheck, #selectCategoriaServicios", "#selectformularioDiagnostico").removeAttr("disabled"); 
        }

        if("" == precioS.trim()){
            $('#errorprecioServicios').show();
            $('#errorprecioServicios').html("Ingresa un precio");
            $('#precioServicios').focus();	
            goValidation = false;
            $("#btnEnviar, #nombreServicios, #descripcionServicios, #precioServicios, #subServicioCheck, #selectCategoriaServicios", "#selectformularioDiagnostico").removeAttr("disabled"); 
        }

        if("" == des.trim()){
            $('#errordescripcionServicios').show();
            $('#errordescripcionServicios').html("Ingresa una descripción");
            $('#descripcionServicios').focus();	
            goValidation = false;
            $("#btnEnviar, #nombreServicios, #descripcionServicios, #precioServicios, #subServicioCheck, #selectCategoriaServicios", "#selectformularioDiagnostico").removeAttr("disabled"); 
        }
    
        if("" == nom.trim()){
            $('#errornombreServicios').show();
            $('#errornombreServicios').html("Ingresa un nombre");
            $('#nombreServicios').focus();	
            goValidation = false;
            $("#btnEnviar, #nombreServicios, #descripcionServicios, #precioServicios, #subServicioCheck, #selectCategoriaServicios", "#selectformularioDiagnostico").removeAttr("disabled"); 
        }
    
        if(goValidation){


        var fd = new FormData();

        fd.append("idS", id);
        fd.append("nombreS", nom);
        fd.append("desS", des);
        fd.append("precioS", precioS);
        fd.append("idCS", categoriaServicios);
        fd.append("estatus", estatus);
        fd.append("image_url", img);
        fd.append("inventarioMin", inventarioMinimo);
        fd.append("inventario", inventarioInicial);
        fd.append("accion", accion);



        $.ajax({
            "url":base_url()+"app/Servicios/insertaServicios",
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
                $("#nombreServicios").val("");
                $("#descripcionServicios").val("");
                listaServicios();
                console.log("ya cargo los servicios");
                $("#ModalAgregar").modal('hide');
                

                $("#btnEnviar, #nombreServicios, #descripcionServicios, #precioServicios, #subServicioCheck, #selectCategoriaServicios", "#selectformularioDiagnostico").removeAttr("disabled");

                $("#addRecordForm")[0].reset();
                
            }else{

                toastr["warning"](data.mensaje);
                $("#btnEnviar, #nombreServicios, #descripcionServicios, #precioServicios, #subServicioCheck, #selectCategoriaServicios", "#selectformularioDiagnostico").removeAttr("disabled");

            }
        })
        .fail(()=>{
            (toastr["danger"]("Ha ocurrido un error vuelve a intentar"));
            $("#btnEnviar, #nombreServicios, #descripcionServicios, #precioServicios, #subServicioCheck, #selectCategoriaServicios", "#selectformularioDiagnostico").removeAttr("disabled");
        });






    /*
            axios.post(base_url()+"app/Servicios/insertaServicios", {
                idS:id,
                nombreS: nom,
                desS: des,
                precioS: precioS,
                
                idCS:categoriaServicios,
                estatus: estatus,
                
                accion:accion
            })
            .then(({data})=>{
    
                if(data.resultado){

                    console.log(data);
    
                    toastr["success"](data.mensaje);
                    $("#nombreServicios").val("");
                    $("#descripcionServicios").val("");
                    listaServicios();
                    console.log("ya cargo los servicios");
                    $("#ModalAgregar").modal('hide');
                    
    
                    $("#btnEnviar, #nombreServicios, #descripcionServicios, #precioServicios, #subServicioCheck, #selectCategoriaServicios", "#selectformularioDiagnostico").removeAttr("disabled");
                    
                }else{
    
                    toastr["warning"](data.mensaje);
                    $("#btnEnviar, #nombreServicios, #descripcionServicios, #precioServicios, #subServicioCheck, #selectCategoriaServicios", "#selectformularioDiagnostico").removeAttr("disabled");
    
                }
                
            })
            .catch(()=>{
                (toastr["danger"]("Ha ocurrido un error vuelve a intentar"));
                $("#btnEnviar, #nombreServicios, #descripcionServicios, #precioServicios, #subServicioCheck, #selectCategoriaServicios", "#selectformularioDiagnostico").removeAttr("disabled");
            });
    
        }else{
    
            console.log("Falta un dato");
            $("#btnEnviar, #nombreServicios, #descripcionServicios, #precioServicios, #subServicioCheck, #selectCategoriaServicios", "#selectformularioDiagnostico").removeAttr("disabled");
    
        }*/
        }
    
    } // termina insertar servicio



    
    function agregar(){

        
        $(location).attr("href",base_url()+"app/AgregarServicios")

        
        


        /*quitaErroresCamposVacios();
        listaCategoriasServicios();

        $("#selectDeAtributos").html("");
        $("#addRecordForm")[0].reset();
    
        $("#btnEnviar").html("Agregar");
        $('#ModalAgregar').modal('show');
        $("#nombreModal").html("Agregar Servicio");
       
        $("#accion").val("Agregar");
        $("#idS").val("0");
        $("#selectCategoriaServicios").find('option:selected').removeAttr("selected");
        $("#selectformularioDiagnostico").find('option:selected').removeAttr("selected");
        $("#formDiagnosticoCheck").prop('checked', false);*/




    } // termina modal agregar tipo de pago

   // `+o.idS+`,'`+o.sku+`','`+o.nombreS+`','`+o.desS+`','`+o.precioS+`','`+o.noImpreso+`','`+o.impresion+`','`+o.precioImpresion+`','`+o.cantidadMayoreo+`','`+o.precioMayoreo+`','`+o.inventarioMin+`','`+o.image_url+`','`+o.estatus+`


    
    function editar(idS,titulo){
        
//(idS,sku,nombreS,desS,precioS,noImpreso,impresion,precioImpresion,idPolImpre,cantidadMayoreo,precioMayoreo,inventarioMin,image_url,tags,estatus)
		
		//console.log("id: " idS, titulo)

        $(location).attr("href",base_url()+"app/ActualizaServicios/actualiza/"+idS+"/"+titulo+"/");

 //$(location).attr("href",base_url()+"app/ActualizaServicios/actualiza/"+idS+"/"+sku+"/"+nombreS+"/"+desS+"/"+precioS+"/"+noImpreso+"/"+impresion+"/"+precioImpresion+"/"+idPolImpre+"/"+cantidadMayoreo+"/"+precioMayoreo+"/"+inventarioMin+"/"+image_url+"/"+tags+"/"+estatus);



        /*quitaErroresCamposVacios();
    
        $("#btnEnviar").html("Actualizar");
        $("#accion").val("editar");
        $('#ModalAgregar').modal('show');
        $("#nombreModal").html("Editar Servicio");
        $("#nombreServicios").val(nombre);
        $("#descripcionServicios").val(des);
        $("#precioServicios").val(precio);


        if(formD == "null"){
            $("#formDiagnosticoCheck").prop('checked', false);

            

        }else{

            console.log(formD);
            $("#formDiagnosticoCheck").prop('checked', true);

            

            $("#selectformularioDiagnostico").find('option:selected').removeAttr("selected");
            $("#selectformularioDiagnostico option[value="+formD+"]").attr('selected', 'selected');

        }
        
        $("#idS").val(id);

        if($("#icono-"+id).hasClass("fa-toggle-on")){
            $("#estatusModal").val('1');
        }else{
            $("#estatusModal").val('0');
        }

       if(sub == 1){
        $("#subServicioCheck").prop('checked', true);
       }else{
        $("#subServicioCheck").prop('checked', false);
       }

        $("#selectCategoriaServicios").find('option:selected').removeAttr("selected");
        $("#selectCategoriaServicios option[value="+idCS+"]").attr('selected', 'selected');
*/



    } // temrina modal editar tipo de pago
    
    function cambiaEstatus(id){
    
        $.ajax({
            "url": base_url()+"app/Servicios/cambioEstatus",
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
        $("#cuerpoModalBorrar").html("Estas seguro que deseas borrar: <strong>" + nombre + "</strong>");
        $("#btnModalBorrar").attr("appData-Id",id);
    
    } // temrina modal editar tipo de pago
    
    
    function btnModalBorrar(){
    
        let id= $("#btnModalBorrar").attr("appData-Id");
    
        $.ajax({
            "url": base_url()+"app/Servicios/bajaLogica",
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


    


    function quitaErroresCamposVacios(){
        $("#errornombreServicios").hide();
        $("#errordescripcionServicios").hide();
        $('#errorselectformularioDiagnostico').hide();
        $('#errorcategoriaServicios').hide();
        $('#errorprecioServicios').hide();
    }


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



function  cambioCheckImpresion(){
		
	let contenidoAsesoria = document.getElementById("divPrecioImpresion");
    let checkAsesoria = document.getElementById("imprimible");
        if (checkAsesoria.checked) {
            contenidoAsesoria.style.display='block';
        }
        else {
            contenidoAsesoria.style.display='none';
        }
	
}




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


function inicioCategoriasAtributos(){

    $("#selectDeAtributos").append(`
    <label>Selecciona las categorías a la que pertenece</label>
    <select class="form-control select2-multiple" multiple="multiple" id="selectCategoriaServicios">
    </select>
    
    `);//termina append

}



function prueba(){

    console.log("Carga prueba");

    $.ajax({
        "url":base_url()+"app/Atributos/verAtributos",
        "dataType":"JSON",
        
    })
    .done((data)=>{
        console.log("Entra primer done");

        if(data.resultado){

            arraySeleccion = data.Atributos;

            $.each(data.Atributos, function(i,o){
                

                $("#selectDeAtributos").append(`<div class="col-sm-4" id="divAtr1">
                <label>`+o.nombreAtr+`</label>
                <select class="form-control select2-multiple" multiple="multiple" id="atr-`+o.idAtr+`">
                    
                </select>
                <small class="text-danger" id="errorselectCategoriaServicios" style="display: none;"></small>
            </div>`);//termina append



                // comienza detalle de atributo

                $("#divSelectCategoriasServicios").find(`select #atr-`+o.idAtr).append(`
                <option label="Elige;">Elige uno;</option>
                `
                );
                $.getScript(base_url()+"static/plantilla/js/vendor/select2.full.js", function(){
                    console.log("cargo el archivito");
                   });
            
                 
            
                   $.getScript(base_url()+"static/plantilla/js/dore-plugins/select.from.library.js", function(){
                    console.log("cargo el archivito");
                   });

                   console.log("llegue aquí");

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

                        console.log("llegue aquí22");

                        

                        $.each(data2.atributos, (ia,a)=>{

                            $("#atr-"+o.idAtr).append(`
                            
                            <option value="`+a.idDAtr+`">`+a.nombreDAtr+`</option>
                        `);

                        })
                        
                        
                    }
            
                })
                .fail();
                // termina detalle de atributo

            });
        }


    })
    .fail();


}




function muestraAtributosSC(){

    $("#selectDeAtributos").html("");

    let idCat = $("#selectCategoriaServicios").val();

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

                    $("#selectDeAtributos").append(`<div name="atributo" class="atributoList col-sm-4" id="divAtr-`+o.idAtr+`">
                    <label>`+o.nombreAtr+`</label>
                    <select class="form-control select2-multiple" multiple="multiple" id="atr-`+o.idAtr+`">
                        
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

                                $("#atr-"+o.idAtr).append(`
                                
                                <option value="`+a.idDAtr+`">`+a.nombreDAtr+`</option>
                            `);

                            })             
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

//campos de los atributos
function traeCampos(){

    const arregloFinal=new Array();
    
    $('.atributoList').each(function(i,e) {

        console.log("d1");







        /*const arregloPorFila=new Array();

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


        $(this).children("td").each(function(i,e){            });*/
    });



}
//termina campos del atributo




  /* Termina Carga de imagen  --------------------------------------------------------------------
-------------------------------
    */

    
    
    
    /* 
    
    
    $('#ModalForm').modal('show');
    // HIDE
    $('#ModalForm').modal('hide');
    
    
     axios(base_url()+"app/Servicios/verTiposDePago")
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
    
     fetch(base_url()+"app/Servicios/verTiposDePago",{
               
            })
            .then((response)=> response.json())
            .then((result)=>{
    
                console.log(result);
    
            })
            .catch((error)=>{
                console.log("Error al cargar el controlador", error);
            })
    
    
    
    
    
    */