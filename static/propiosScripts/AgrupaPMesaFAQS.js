$(document).ready(()=>{


    //alert("ya estamos aqui");
    $("#datatable").find("tbody").html("");
    listaAgrupaPMesaFAQS();
    //listanombreATsMesaFAQS();

    
       
    })
    
    
    function listaAgrupaPMesaFAQS(){
    
    
        axios(base_url()+"app/AgrupaPMesaFAQS/verAgrupaPMesaFAQS")
        .then(({data})=>{
    
            if(data.resultado){
    
                $("#despliegueTabla").html(`
                <table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
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
    
                $.each(data.AgrupaPMesaFAQS, function(i,o){
    
                    $("#datatable").find("tbody").append(`
                        <tr id="tr-`+ o.idAT+`">
                            <td>`+ o.idAT+`</td>
                            <td>`+ o.nombreAT+`</td>
                            <td class="text-wrap" style="width: 15rem;" >`+ o.desAT+`</td>
                            <td><a href="#" onclick="vistaPrevia(`+o.idAT+`,'`+o.nombreAT+`')"><i class="fas fa-list fa-2x"></i></a></td>
                            <td align="center"><a href="#" onclick="cambiaEstatus(`+o.idAT+`)"><i id="icono-`+o.idAT+`" class="fas fa-toggle-`+(o.estatus == 1 ? 'on':'off')+` fa-2x"></i></a></td>
                            <td align="center"><a href="#" onclick="editar(`+o.idAT+`,'`+o.nombreAT+`','`+o.desAT+`','`+o.estatus+`')"><i class="fas fa-pencil fa-2x"></i></a> </td>
                            <td align="center"><a href="#" onclick="modalBorrar(`+o.idAT+`,'`+o.nombreAT+`','`+o.desAT+`')"><i class="fas fa-trash fa-2x"></i></a></td>
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

    function vistaPrevia(id, nombre){


        $.ajax({
            "url":base_url()+"app/AgrupaPMesaFAQS/vistaPrevia",
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
                 $.each(data.preguntas, function(i,o){
     
                     $("#cuerpoModalVistaPrevia").append("<li>"+o.pregunta+" </br> <strong>R:</strong> "+ o.respuesta+"</li>");
                 });
                

            }else{

                toastr["success"](data.mensaje);
                 console.log(data);

            }
        

        })
        .fail();

    }
    
    
    
    function insertaAgrupaPMesaFAQS(){
    
        quitaErroresCamposVacios();
        
        //agrega el disabled a los campos
        agregarDisabled();
    
        let id = $("#idAT").val();
        let nom = $("#nombrePreguntasMesaFAQS").val();
        let des = $.trim($("#desPreguntasMesaFAQS").val());
        let selectnombreATs = $("#SelectAgrupaPMesaFAQS").val();
        
        let accion = $("#accion").val();
        let goValidation = true;
        let estatus = 1;
    
            if(accion == "editar"){
                estatus = $("#estatusModal").val();
            }
    
            if(selectnombreATs.length <1){
                $('#errorSelectAgrupaPMesaFAQS').show();
                $('#errorSelectAgrupaPMesaFAQS').html("Elige alguna nombreAT");
                $('#SelectAgrupaPMesaFAQS').focus();	
                goValidation = false;
                removerDisabled();
                
            }

            if("" == des){
                $('#errordesPreguntasMesaFAQS').show();
                $('#errordesPreguntasMesaFAQS').html("Captura una descripcion ");
                $('#desPreguntasMesaFAQS').focus();	
                goValidation = false;
                removerDisabled();

            }

        if("" == nom.trim()){
            $('#errornombrePreguntasMesaFAQS').show();
            $('#errornombrePreguntasMesaFAQS').html("Ingresa un título para la agrupación");
            $('#nombrePreguntasMesaFAQS').focus();	
            goValidation = false;
            removerDisabled();
        }
    
        if(goValidation){
    
            axios.post(base_url()+"app/AgrupaPMesaFAQS/insertaAgrupaPMesaFAQS", {
                idAT:id,
                nombreAT: nom,
                desAT:des,	
                estatus: estatus,
                accion:accion,
                preguntas:selectnombreATs

            })
            .then(({data})=>{
    
                if(data.resultado){
    
                    toastr["success"](data.mensaje);
                    $("#nombrePreguntasMesaFAQS").val("");
                    
                    $("#ModalAgregar").modal('hide');
                    listaAgrupaPMesaFAQS();
    
                    removerDisabled();
                    
                }else{
    
                    toastr["warning"](data.mensaje);
                    removerDisabled();
    
                }
                
            })
            .catch(error=>{
                console.log(error);
                removerDisabled();
                listaAgrupaPMesaFAQS();
    
            })
    
        }else{
    
            console.log("Falta un dato");
            listaAgrupaPMesaFAQS();
            removerDisabled();
    
        }
    
    } // termina insertar tipo de pago


    function removerDisabled(){

        $("#btnEnviar, #nombrePreguntasMesaFAQS, #desPreguntasMesaFAQS, #SelectAgrupaPMesaFAQS").removeAttr("disabled"); 

    }

    function agregarDisabled(){

        $("#btnEnviar, #nombrePreguntasMesaFAQS, #desPreguntasMesaFAQS, #SelectAgrupaPMesaFAQS").attr("disabled", "disabled");

    }

    function agregar(){
        quitaErroresCamposVacios()
        listanombreATsMesaFAQS();

        $("#btnEnviar").html("Agregar");
        $('#ModalAgregar').modal('show');
        $("#nombreModal").html("Nuevo grupo");
        $("#nombrePreguntasMesaFAQS").val("");
        $("#desPreguntasMesaFAQS").html("");
        $("#accion").val("Agregar");
        $("#idAT").val("0");
    
    } // termina modal agregar tipo de pago

    function quitaErroresCamposVacios(){
        $("#errornombrePreguntasMesaFAQS").hide();
        $("#errordesPreguntasMesaFAQS").hide();
        $("#errorSelectAgrupaPMesaFAQS").hide();
    }
    
    
    
    function editar(id,nombre,des,estatus){
        quitaErroresCamposVacios();

        listanombreATsMesaFAQSSeleccionadas(id);

       
        $("#btnEnviar").html("Actualizar");
        $("#accion").val("editar");
        $('#ModalAgregar').modal('show');
        $("#nombreModal").html("Editar Grupo");
        $("#nombrePreguntasMesaFAQS").val(nombre);
        $("#desPreguntasMesaFAQS").html(des);
       
        $("#estatusModal").val(estatus);
        $("#idAT").val(id);
        if($("#icono-"+id).hasClass("fa-toggle-on")){
            $("#estatusModal").val('1');
        }else{
            $("#estatusModal").val('0');
        }

        //$("#SelectAgrupaPMesaFAQS").find('option:selected').removeAttr("selected");
        //$("#SelectAgrupaPMesaFAQS option[value="+idAT+"]").attr('selected', 'selected');


        
    
    } // temrina modal editar tipo de pago
    
    function cambiaEstatus(id){
    
        $.ajax({
            "url": base_url()+"app/AgrupaPMesaFAQS/cambioEstatus",
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
            "url": base_url()+"app/AgrupaPMesaFAQS/bajaLogica",
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



    function listanombreATsMesaFAQS(){

        $("#SelectAgrupaPMesaFAQS").html("");


        $.ajax({
            "url":base_url()+"app/PreguntasMesaFAQS/verPreguntasMesaFAQS",
            "dataType":"JSON"
        })
        .done((data)=>{

           

            if(data.resultado){

                $("#divSelectMultiAgrupaPMesaFAQS").find("select").html(`
                <option label="&nbsp;">&nbsp;</option>
                `
                );
                $.each(data.PreguntasMesaFAQS, function(i,o){

                    if(o.estatus == 1){
                        $("#divSelectMultiAgrupaPMesaFAQS").find("select").append(`
                    <option value="`+ o.idPRAT+`">`+ o.pregunta+`</option>
                    
                    `
                    );

                    }
                });
    
            }else{
    
                $("#divSelectMultiAgrupaPMesaFAQS").find("select").append(`
                <option value="Selecciona">--No existen nombreATs diagnosticas para mostrar--</option>
                `
                );
            }

        })
        .fail();

    }


    function listanombreATsMesaFAQSSeleccionadas(id){

        $("#SelectAgrupaPMesaFAQS").html("");

        //seleccion
        let arraySeleccion = new Array();
        $.ajax({
            "url":base_url()+"app/AgrupaPMesaFAQS/vistaPrevia",
            "dataType":"JSON",
            "type":"POST",
            "data":{
                id:id
            }
        })
        .done((data)=>{
            if(data.resultado){
                
                arraySeleccion = data.preguntas;

                
                $.ajax({
                    "url":base_url()+"app/PreguntasMesaFAQS/verPreguntasMesaFAQS",
                    "dataType":"JSON"
                })
                .done((data)=>{

                
                    if(data.resultado){

                        $("#divSelectMultiAgrupaPMesaFAQS").find("select").html(`
                        <option label="&nbsp;">&nbsp;</option>
                        `
                        );
                        $.each(data.PreguntasMesaFAQS, function(i,o){

                            if(o.estatus == 1){



                                let bandera = 0;
                    
                                $.each(arraySeleccion, function(m,n){
                                    
                                    if(o.idPRAT == n.idPRAT){
                                            $("#divSelectMultiAgrupaPMesaFAQS").find("select").append(`
                                            <option value="`+ o.idPRAT+`" Selected >`+ o.pregunta+`</option>
                                            `);
                                        bandera = 1;
                                    }
                                    
                                    
                                })
                                
                                if(bandera != 1){
                                        $("#divSelectMultiAgrupaPMesaFAQS").find("select").append(`
                                        <option value="`+ o.idPRAT+`" >`+ o.pregunta+`</option>
                                        `);
                                
                                    }
                                else{
                                    bandera  = 0
                                }
                    

                            }
                        });
            
                    }else{
            
                        $("#divSelectMultiAgrupaPMesaFAQS").find("select").append(`
                        <option value="Selecciona">--No existen nombreATs diagnosticas para mostrar--</option>
                        `
                        );
                    }

                })
                .fail();


            }else{

                toastr["success"](data.mensaje);
                 console.log(data);

            }
        
        })
        .fail();

    

    }
    
    
    
    
    /* 
    
    
    $('#ModalForm').modal('show');
    // HIDE
    $('#ModalForm').modal('hide');
    
    
     axios(base_url()+"app/AgrupaPMesaFAQS/verAgrupaPMesaFAQS")
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
    
     fetch(base_url()+"app/AgrupaPMesaFAQS/verAgrupaPMesaFAQS",{
               
            })
            .then((response)=> response.json())
            .then((result)=>{
    
                console.log(result);
    
            })
            .catch((error)=>{
                console.log("Error al cargar el controlador", error);
            })
    
    
    
    
    
    */