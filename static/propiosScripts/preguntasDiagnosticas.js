$(document).ready(()=>{


    //alert("ya estamos aqui");
    $("#datatable").find("tbody").html("");
    listaPreguntasDiagnosticas();
    listaTiposDeCampos();

    
       
    })
    
    
    function listaPreguntasDiagnosticas(){
    
    
        axios(base_url()+"app/PreguntasDiagnosticas/verPreguntasDiagnosticas")
        .then(({data})=>{
    
            if(data.resultado){
    
                $("#despliegueTabla").html(`
                <table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nombre</th>
                            <th>Tipo de Campo</th>
                            <th style="text-align: center">Estatus</th>
                            <th style="text-align: center">Editar</th>
                            <th style="text-align: center">Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                
                    </tbody>
                </table>`
                );
    
                $.each(data.PreguntasDiagnosticas, function(i,o){
    
                    $("#datatable").find("tbody").append(`
                        <tr id="tr-`+ o.idPD+`">
                            <td>`+ o.idPD+`</td>
                            <td>`+ o.nombrePD+`</td>
                            <td>`+o.nombreTcampos+` </td>
                            <td align="center"><a href="#" onclick="cambiaEstatus(`+o.idPD+`)"><i id="icono-`+o.idPD+`" class="fas fa-toggle-`+(o.estatus == 1 ? 'on':'off')+` fa-2x"></i></a></td>
                            <td align="center"><a href="#" onclick="editar(`+o.idPD+`,'`+o.nombrePD+`','`+ o.idTCampos+`','`+o.estatus+`')"><i class="fas fa-pencil fa-2x"></i></a> </td>
                            <td align="center"><a href="#" onclick="modalBorrar(`+o.idPD+`,'`+o.nombrePD+`')"><i class="fas fa-trash fa-2x"></i></a></td>
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
    
    
    
    function insertaPreguntasDiagnosticas(){

        quitaErroresCamposVacios();
    
        $("#errornombrePreguntasDiagnosticas").hide();
        
    
        $("#btnEnviar, #nombrePreguntasDiagnosticas, #SelectTiposDeCampos").attr("disabled", "disabled");
    
        let id = $("#idPD").val();
        let nom = $("#nombrePreguntasDiagnosticas").val();
        let tiposDeCampo = $("#SelectTiposDeCampos").val();
        
        let accion = $("#accion").val();
        let goValidation = true;
        let estatus = 1;
    
        
    
            if(accion == "editar"){
                estatus = $("#estatusModal").val();
            }
    
            if("Selecciona" == tiposDeCampo.trim()){
                $('#errorSelectTiposDeCampos').show();
                $('#errorSelectTiposDeCampos').html("Elige una categoría");
                $('#SelectTiposDeCampos').focus();	
                goValidation = false;
                $("#btnEnviar, #nombrePreguntasDiagnosticas, #SelectTiposDeCampos").removeAttr("disabled"); 
            }

    
        if("" == nom.trim()){
            $('#errornombrePreguntasDiagnosticas').show();
            $('#errornombrePreguntasDiagnosticas').html("Ingresa una descripcion");
            $('#nombrePreguntasDiagnosticas').focus();	
            goValidation = false;
            $("#btnEnviar, #nombrePreguntasDiagnosticas, #SelectTiposDeCampos").removeAttr("disabled"); 
        }
    
        if(goValidation){
    
            axios.post(base_url()+"app/PreguntasDiagnosticas/insertaPreguntasDiagnosticas", {
                idPD:id,
                nombrePD: nom,
                estatus: estatus,
                idTcampos:tiposDeCampo,
                accion:accion
            })
            .then(({data})=>{
    
                if(data.resultado){
    
                    toastr["success"](data.mensaje);
                    $("#nombrePreguntasDiagnosticas").val("");
                    
                    $("#ModalAgregar").modal('hide');
                    listaPreguntasDiagnosticas();
    
                    $("#btnEnviar, #nombrePreguntasDiagnosticas, #SelectTiposDeCampos").removeAttr("disabled"); 
                    
                }else{
    
                    toastr["warning"](data.mensaje);
                    $("#btnEnviar, #nombrePreguntasDiagnosticas, #SelectTiposDeCampos").removeAttr("disabled"); 
    
                }
                
            })
            .catch(error=>{
                console.log(error);
                $("#btnEnviar, #nombrePreguntasDiagnosticas, #SelectTiposDeCampos").removeAttr("disabled"); 
            })
    
        }else{
    
            console.log("Falta un dato");
            $("#btnEnviar, #nombrePreguntasDiagnosticas, #SelectTiposDeCampos").removeAttr("disabled"); 
    
        }
    
    } // termina insertar tipo de pago
    
    
    function agregar(){

        quitaErroresCamposVacios();
    
        $("#SelectTiposDeCampos option").each(function() {
            $("#SelectTiposDeCampos").find('option:selected').removeAttr("selected");
           
        });


        $("#btnEnviar").html("Agregar");
        $('#ModalAgregar').modal('show');
        $("#nombreModal").html("Agregar Tipo de Pago");
        $("#nombrePreguntasDiagnosticas").val("");
        
        $("#accion").val("Agregar");
        $("#idPD").val("0");
    
    } // termina modal agregar tipo de pago
    
    
    
    function editar(id,nombre,idTCampos,estatus){

        quitaErroresCamposVacios();

        $("#SelectTiposDeCampos option").each(function() {
            $("#SelectTiposDeCampos").find('option:selected').removeAttr("selected");
           
        });
        
    
        $("#btnEnviar").html("Actualizar");
        $("#accion").val("editar");
        $('#ModalAgregar').modal('show');
        $("#nombreModal").html("Editar Tipo de Pago");
        $("#nombrePreguntasDiagnosticas").val(nombre);
       
        $("#estatusModal").val(estatus);
        $("#idPD").val(id);
        if($("#icono-"+id).hasClass("fa-toggle-on")){
            $("#estatusModal").val('1');
        }else{
            $("#estatusModal").val('0');
        }


        //$("#SelectTiposDeCampos").find('option:selected').removeAttr("selected");
        $("#SelectTiposDeCampos option[value="+idTCampos+"]").attr('selected', 'selected');

    
    } // temrina modal editar tipo de pago
    
    function cambiaEstatus(id){
    
        $.ajax({
            "url": base_url()+"app/PreguntasDiagnosticas/cambioEstatus",
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
            "url": base_url()+"app/PreguntasDiagnosticas/bajaLogica",
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



    function listaTiposDeCampos(){


        $.ajax({
            "url":base_url()+"app/TiposDeCampos/verTiposDeCampos",
            "dataType":"JSON"
        })
        .done((data)=>{

            $("#SelectTiposDeCampos").html("");

            if(data.resultado){

                $("#divSelectTiposDeCampos").find("select").append(`
                <option value="Selecciona">--Selecciona--</option>
                `
                );
                $.each(data.tiposDeCampos, function(i,o){

                    if(o.estatus == 1){
                        $("#divSelectTiposDeCampos").find("select").append(`
                    <option value="`+ o.idTCampos+`">`+ o.nombreTcampos+`</option>
                    `
                    );

                    }
                });
    
            }else{
    
                $("#divSelectTiposDeCampos").find("select").append(`
                <option value="Selecciona">--No existen categorias para mostrar--</option>
                `
                );
            }

        })
        .fail();

    }
    

    function quitaErroresCamposVacios(){
        $("#errornombrePreguntasDiagnosticas").hide();
       
    }
    
    
    
    /* 
    
    
    $('#ModalForm').modal('show');
    // HIDE
    $('#ModalForm').modal('hide');
    
    
     axios(base_url()+"app/PreguntasDiagnosticas/verPreguntasDiagnosticas")
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
    
     fetch(base_url()+"app/PreguntasDiagnosticas/verPreguntasDiagnosticas",{
               
            })
            .then((response)=> response.json())
            .then((result)=>{
    
                console.log(result);
    
            })
            .catch((error)=>{
                console.log("Error al cargar el controlador", error);
            })
    
    
    
    
    
    */