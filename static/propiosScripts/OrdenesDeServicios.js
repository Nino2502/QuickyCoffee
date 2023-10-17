$(document).ready(()=>{


    //alert("ya estamos aqui");
    $("#datatable").find("tbody").html("");
    listaOrdenesDeServicios()
    
       
    })
    
    
    function listaOrdenesDeServicios(){
    
    
        axios(base_url()+"app/OrdenesDeServicios/verOrdenesDeServicios")
        .then(({data})=>{
    
            if(data.resultado){
    
                $("#despliegueTabla").html(`
                <table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th style="text-align: center">Estatus</th>
                            <th style="text-align: center">Editar</th>
                            <th style="text-align: center">Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                
                    </tbody>
                </table>`
                );
    
                $.each(data.categorias, function(i,o){
    
                    $("#datatable").find("tbody").append(`
                        <tr id="tr-`+ o.idCS+`">
                            <td>`+ o.idCS+`</td>
                            <td>`+ o.nombreCS+`</td>
                            <td>`+o.desCS+`</td>
                            <td align="center"><a href="#" onclick="cambiaEstatus(`+o.idCS+`)"><i id="icono-`+o.idCS+`" class="fas fa-toggle-`+(o.estatus == 1 ? 'on':'off')+` fa-2x"></i></a></td>
                            <td align="center"><a href="#" onclick="editar(`+o.idCS+`,'`+o.nombreCS+`','`+o.desCS+`','`+o.estatus+`')"><i class="fas fa-pencil fa-2x"></i></a> </td>
                            <td align="center"><a href="#" onclick="modalBorrar(`+o.idCS+`,'`+o.nombreCS+`','`+o.desCS+`')"><i class="fas fa-trash fa-2x"></i></a></td>
                        </tr>`
                    );
    
                });
    
    
                $("#datatable").DataTable(),$(".dataTables_length select").addClass("form-select form-select-sm");	
    
            }else{
    
                $("#despliegueTabla").html(obj.mensaje);
    
            }
            
    
        })
        .catch(error=>{
            console.log(error);
        })
    
    
    
    } // termina lista de Tipos de PAgo
    
    
    
    function insertaOrdenesDeServicios(){

        quitaErroresCamposVacios();
        
        $("#btnEnviar, #nombreOrdenesDeServicios, #descripcionOrdenesDeServicios").attr("disabled", "disabled");
    
        let idTP = $("#idCS").val();
        let nom = $("#nombreOrdenesDeServicios").val();
        let des = $("#descripcionOrdenesDeServicios").val();
        let accion = $("#accion").val();
        let goValidation = true;
        let estatus = 1;

        if(accion == "editar"){
            estatus = $("#estatusModal").val();
        }
    
        if("" == des.trim()){
            $('#errordescripcionOrdenesDeServicios').show();
            $('#errordescripcionOrdenesDeServicios').html("Ingresa un nombre");
            $('#descripcionOrdenesDeServicios').focus();	
            goValidation = false;
            $("#btnEnviar, #nombreOrdenesDeServicios, #descripcionOrdenesDeServicios").removeAttr("disabled"); 
        }
    
        if("" == nom.trim()){
            $('#errornombreOrdenesDeServicios').show();
            $('#errornombreOrdenesDeServicios').html("Ingresa una descripcion");
            $('#nombreOrdenesDeServicios').focus();	
            goValidation = false;
            $("#btnEnviar, #nombreOrdenesDeServicios, #descripcionOrdenesDeServicios").removeAttr("disabled"); 
        }
    
        if(goValidation){
    
            axios.post(base_url()+"app/OrdenesDeServicios/insertaOrdenesDeServicios", {
                idCS:idTP,
                nombreCS: nom,
                desCS: des,
                estatus: estatus,
                accion:accion
            })
            .then(({data})=>{
    
                if(data.resultado){

                    console.log(data);
    
                    toastr["success"](data.mensaje);
                    $("#nombreOrdenesDeServicios").val("");
                    $("#descripcionOrdenesDeServicios").val("");
                    $("#ModalAgregar").modal('hide');
                    listaOrdenesDeServicios();
    
                    $("#btnEnviar, #nombreOrdenesDeServicios, #descripcionOrdenesDeServicios").removeAttr("disabled"); 
                    
                }else{
    
                    toastr["warning"](data.mensaje);
                    $("#btnEnviar, #nombreOrdenesDeServicios, #descripcionOrdenesDeServicios").removeAttr("disabled"); 
    
                }
                
            })
            .catch(error=>{
                console.log(error);
            })
    
        }else{
    
            console.log("Falta un dato");
    
        }
    
    } // termina insertar tipo de pago
    
    
    function agregar(){

        quitaErroresCamposVacios();
    
        $("#btnEnviar").html("Agregar");
        $('#ModalAgregar').modal('show');
        $("#nombreModal").html("Agregar Categoria de Servicio");
        $("#nombreOrdenesDeServicios").val("");
        $("#descripcionOrdenesDeServicios").val("");
        $("#accion").val("Agregar");
        $("#idCS").val("0");
    
    } // termina modal agregar tipo de pago
    
    
    
    function editar(id,nombre,des,estatus){
        quitaErroresCamposVacios();
    
        $("#btnEnviar").html("Actualizar");
        $("#accion").val("editar");
        $('#ModalAgregar').modal('show');
        $("#nombreModal").html("Editar Categoria de Servicio");
        $("#nombreOrdenesDeServicios").val(nombre);
        $("#descripcionOrdenesDeServicios").val(des);
        $("#estatusModal").val(estatus);
        $("#idCS").val(id);
        if($("#icono-"+id).hasClass("fa-toggle-on")){
            $("#estatusModal").val('1');
        }else{
            $("#estatusModal").val('0');
        }
    
    } // temrina modal editar tipo de pago
    
    function cambiaEstatus(id){
    
        $.ajax({
            "url": base_url()+"app/OrdenesDeServicios/cambioEstatus",
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
            "url": base_url()+"app/OrdenesDeServicios/bajaLogica",
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


    function quitaErroresCamposVacios(){
        $("#errornombreOrdenesDeServicios").hide();
        $("#errordescripcionOrdenesDeServicios").hide();

    }
    
    
    
    
    /* 
    
    
    $('#ModalForm').modal('show');
    // HIDE
    $('#ModalForm').modal('hide');
    
    
     axios(base_url()+"app/OrdenesDeServicios/verTiposDePago")
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
    
     fetch(base_url()+"app/OrdenesDeServicios/verTiposDePago",{
               
            })
            .then((response)=> response.json())
            .then((result)=>{
    
                console.log(result);
    
            })
            .catch((error)=>{
                console.log("Error al cargar el controlador", error);
            })
    
    
    
    
    
    */