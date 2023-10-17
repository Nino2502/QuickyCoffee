$(document).ready(()=>{


    //alert("ya estamos aqui");
    $("#datatable").find("tbody").html("");
    listaAgrupaPreguntasDiagnosticas();
    //listaPreguntasDiagnosticas();

    
       
    })
    
    
    function listaAgrupaPreguntasDiagnosticas(){
    
    
        axios(base_url()+"app/AgrupaPreguntasDiagnosticas/verAgrupaPreguntasDiagnosticas")
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
    
                $.each(data.AgrupaPreguntasDiagnosticas, function(i,o){
    
                    $("#datatable").find("tbody").append(`
                        <tr id="tr-`+ o.idFormD+`">
                            <td>`+ o.idFormD+`</td>
                            <td>`+ o.nombreFormD+`</td>
                            <td>`+ o.desFormD+`</td>
                            <td><a href="#" onclick="vistaPrevia(`+o.idFormD+`,'`+o.nombreFormD+`')"><i class="fas fa-list fa-2x"></i></a></td>
                            <td align="center"><a href="#" onclick="cambiaEstatus(`+o.idFormD+`)"><i id="icono-`+o.idFormD+`" class="fas fa-toggle-`+(o.estatus == 1 ? 'on':'off')+` fa-2x"></i></a></td>
                            <td align="center"><a href="#" onclick="editar(`+o.idFormD+`,'`+o.nombreFormD+`','`+o.desFormD+`','`+o.estatus+`')"><i class="fas fa-pencil fa-2x"></i></a> </td>
                            <td align="center"><a href="#" onclick="modalBorrar(`+o.idFormD+`,'`+o.nombreFormD+`','`+o.desFormD+`')"><i class="fas fa-trash fa-2x"></i></a></td>
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
            "url":base_url()+"app/AgrupaPreguntasDiagnosticas/vistaPrevia",
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

                 $("#cuerpoModalVistaPrevia").html("Preguntas asociadas del grupo: <strong> "+nombre+ " </strong></br>");
                 $.each(data.preguntas, function(i,o){
     
                     $("#cuerpoModalVistaPrevia").append("<li>"+o.nombrePD+"</li>");
                 });
                

            }else{

                toastr["success"](data.mensaje);
                 console.log(data);

            }
        

        })
        .fail();

    }
    
    
    
    function insertaAgrupaPreguntasDiagnosticas(){
    
        quitaErroresCamposVacios();
        
        //agrega el disabled a los campos
        agregarDisabled();
    
        let id = $("#idFormD").val();
        let nom = $("#nombreAgrupaPreguntasDiagnosticas").val();
        let des = $.trim($("#descripcionAgrupaPD").val());
        let selectPreguntas = $("#SelectAgrupaPreguntasDiagnosticas").val();
        
        let accion = $("#accion").val();
        let goValidation = true;
        let estatus = 1;
    
            if(accion == "editar"){
                estatus = $("#estatusModal").val();
            }
    
            if(selectPreguntas.length <1){
                $('#errorSelectAgrupaPreguntasDiagnosticas').show();
                $('#errorSelectAgrupaPreguntasDiagnosticas').html("Elige alguna pregunta");
                $('#SelectAgrupaPreguntasDiagnosticas').focus();	
                goValidation = false;
                removerDisabled();
                
            }

            if("" == des){
                $('#errordescripcionAgrupaPD').show();
                $('#errordescripcionAgrupaPD').html("Captura una descripcion ");
                $('#descripcionAgrupaPD').focus();	
                goValidation = false;
                removerDisabled();

            }

        if("" == nom.trim()){
            $('#errornombreAgrupaPreguntasDiagnosticas').show();
            $('#errornombreAgrupaPreguntasDiagnosticas').html("Ingresa un nombre para la agrupacion");
            $('#nombreAgrupaPreguntasDiagnosticas').focus();	
            goValidation = false;
            removerDisabled();
        }
    
        if(goValidation){
    
            axios.post(base_url()+"app/AgrupaPreguntasDiagnosticas/insertaAgrupaPreguntasDiagnosticas", {
                idFormD:id,
                nombreFormD: nom,
                desFormD:des,	
                estatus: estatus,
                accion:accion,
                preguntas:selectPreguntas

            })
            .then(({data})=>{
    
                if(data.resultado){
    
                    toastr["success"](data.mensaje);
                    $("#nombreAgrupaPreguntasDiagnosticas").val("");
                    
                    $("#ModalAgregar").modal('hide');
                    listaAgrupaPreguntasDiagnosticas();
    
                    removerDisabled();
                    
                }else{
    
                    toastr["warning"](data.mensaje);
                    removerDisabled();
    
                }
                
            })
            .catch(error=>{
                console.log(error);
                removerDisabled();
                listaAgrupaPreguntasDiagnosticas();
    
            })
    
        }else{
    
            console.log("Falta un dato");
            listaAgrupaPreguntasDiagnosticas();
            removerDisabled();
    
        }
    
    } // termina insertar tipo de pago


    function removerDisabled(){

        $("#btnEnviar, #nombreAgrupaPreguntasDiagnosticas, #descripcionAgrupaPD, #SelectAgrupaPreguntasDiagnosticas").removeAttr("disabled"); 

    }

    function agregarDisabled(){

        $("#btnEnviar, #nombreAgrupaPreguntasDiagnosticas, #descripcionAgrupaPD, #SelectAgrupaPreguntasDiagnosticas").attr("disabled", "disabled");

    }

    function agregar(){
        quitaErroresCamposVacios()
        listaPreguntasDiagnosticas();

        $("#btnEnviar").html("Agregar");
        $('#ModalAgregar').modal('show');
        $("#nombreModal").html("Nuevo grupo");
        $("#nombreAgrupaPreguntasDiagnosticas").val("");
        $("#descripcionAgrupaPD").html("");
        $("#accion").val("Agregar");
        $("#idFormD").val("0");
    
    } // termina modal agregar tipo de pago

    function quitaErroresCamposVacios(){
        $("#errornombreAgrupaPreguntasDiagnosticas").hide();
        $("#errordescripcionAgrupaPD").hide();
        $("#errorSelectAgrupaPreguntasDiagnosticas").hide();
    }
    
    
    
    function editar(id,nombre,des,estatus){
        quitaErroresCamposVacios();

        listaPreguntasDiagnosticasSeleccionadas(id);

       
        $("#btnEnviar").html("Actualizar");
        $("#accion").val("editar");
        $('#ModalAgregar').modal('show');
        $("#nombreModal").html("Editar Grupo");
        $("#nombreAgrupaPreguntasDiagnosticas").val(nombre);
        $("#descripcionAgrupaPD").html(des);
       
        $("#estatusModal").val(estatus);
        $("#idFormD").val(id);
        if($("#icono-"+id).hasClass("fa-toggle-on")){
            $("#estatusModal").val('1');
        }else{
            $("#estatusModal").val('0');
        }

        //$("#SelectAgrupaPreguntasDiagnosticas").find('option:selected').removeAttr("selected");
        //$("#SelectAgrupaPreguntasDiagnosticas option[value="+idFormD+"]").attr('selected', 'selected');


        
    
    } // temrina modal editar tipo de pago
    
    function cambiaEstatus(id){
    
        $.ajax({
            "url": base_url()+"app/AgrupaPreguntasDiagnosticas/cambioEstatus",
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
            "url": base_url()+"app/AgrupaPreguntasDiagnosticas/bajaLogica",
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



    function listaPreguntasDiagnosticas(){

        $("#SelectAgrupaPreguntasDiagnosticas").html("");


        $.ajax({
            "url":base_url()+"app/PreguntasDiagnosticas/verPreguntasDiagnosticas",
            "dataType":"JSON"
        })
        .done((data)=>{

           

            if(data.resultado){

                $("#divSelectMultiAgrupaPreguntasDiagnosticas").find("select").html(`
                <option label="&nbsp;">&nbsp;</option>
                `
                );
                $.each(data.PreguntasDiagnosticas, function(i,o){

                    if(o.estatus == 1){
                        $("#divSelectMultiAgrupaPreguntasDiagnosticas").find("select").append(`
                    <option value="`+ o.idPD+`">`+ o.nombrePD+`</option>
                    
                    `
                    );

                    }
                });
    
            }else{
    
                $("#divSelectMultiAgrupaPreguntasDiagnosticas").find("select").append(`
                <option value="Selecciona">--No existen preguntas diagnosticas para mostrar--</option>
                `
                );
            }

        })
        .fail();

    }


    function listaPreguntasDiagnosticasSeleccionadas(id){

        $("#SelectAgrupaPreguntasDiagnosticas").html("");

        //seleccion
        let arrayPreguntas = new Array();
        $.ajax({
            "url":base_url()+"app/AgrupaPreguntasDiagnosticas/vistaPrevia",
            "dataType":"JSON",
            "type":"POST",
            "data":{
                id:id
            }
        })
        .done((data)=>{

            
            if(data.resultado){
                
                arrayPreguntas = data.preguntas;

                
                $.ajax({
                    "url":base_url()+"app/PreguntasDiagnosticas/verPreguntasDiagnosticas",
                    "dataType":"JSON"
                })
                .done((data)=>{

                
                    if(data.resultado){

                        $("#divSelectMultiAgrupaPreguntasDiagnosticas").find("select").html(`
                        <option label="&nbsp;">&nbsp;</option>
                        `
                        );
                        $.each(data.PreguntasDiagnosticas, function(i,o){

                            if(o.estatus == 1){



                                let bandera = 0;
                    
                                $.each(arrayPreguntas, function(m,n){

                                   
                                    
                                    if(o.idPD == n.idPD){
                                            $("#divSelectMultiAgrupaPreguntasDiagnosticas").find("select").append(`
                                            <option value="`+ o.idPD+`" Selected >`+ o.nombrePD+`</option>
                                            `);
                                        bandera = 1;
                                    }
                                    
                                    
                                })
                                
                                if(bandera != 1){
                                        $("#divSelectMultiAgrupaPreguntasDiagnosticas").find("select").append(`
                                        <option value="`+ o.idPD+`" >`+ o.nombrePD+`</option>
                                        `);
                                
                                    }
                                else{
                                    bandera  = 0
                                }
                    

                            }
                        });
            
                    }else{
            
                        $("#divSelectMultiAgrupaPreguntasDiagnosticas").find("select").append(`
                        <option value="Selecciona">--No existen preguntas diagnosticas para mostrar--</option>
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
    
    
     axios(base_url()+"app/AgrupaPreguntasDiagnosticas/verAgrupaPreguntasDiagnosticas")
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
    
     fetch(base_url()+"app/AgrupaPreguntasDiagnosticas/verAgrupaPreguntasDiagnosticas",{
               
            })
            .then((response)=> response.json())
            .then((result)=>{
    
                console.log(result);
    
            })
            .catch((error)=>{
                console.log("Error al cargar el controlador", error);
            })
    
    
    
    
    
    */