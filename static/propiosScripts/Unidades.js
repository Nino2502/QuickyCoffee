$(document).ready(()=>{


//alert("ya estamos aqui");
$("#datatable").find("tbody").html("");
listaUnidades()

   
})


function listaUnidades(){


    axios(base_url()+"app/Unidades/verUnidades")
    .then(({data})=>{

        if(data.resultado){

            $("#despliegueTabla").html(`
            <table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>id</th>
						<th>Calve SAT</th>
                        <th>Nombre</th>
                        
                        <th style="text-align: center">Estatus</th>
                        <th style="text-align: center">Editar</th>
                        <th style="text-align: center">Borrar</th>
                    </tr>
                </thead>
                <tbody>
            
                </tbody>
            </table>`
            );

            $.each(data.Unidades, function(i,o){

                $("#datatable").find("tbody").append(`
                    <tr id="tr-`+ o.idUni+`">
                        <td>`+ o.idUni+`</td>
						<td>`+ o.clave+`</td>
                        <td>`+ o.nombreUni+`</td>
                        
                        <td align="center"><a href="#" onclick="cambiaEstatus(`+o.idUni+`)"><i id="icono-`+o.idUni+`" class="fas fa-toggle-`+(o.estatus == 1 ? 'on':'off')+` fa-2x"></i></a></td>
                        <td align="center"><a href="#" onclick="editar(`+o.idUni+`,'`+o.clave+`','`+o.nombreUni+`','`+o.desFP+`','`+o.estatus+`')"><i class="fas fa-pencil fa-2x"></i></a> </td>
                        <td align="center"><a href="#" onclick="modalBorrar(`+o.idUni+`,'`+o.nombreUni+`','`+o.desFP+`')"><i class="fas fa-trash fa-2x"></i></a></td>
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



function insertaUnidades(){

    quitaErroresCamposVacios();

    $("#btnEnviar, #nombreUnidades, #descripcionUnidades").attr("disabled", "disabled");

    let idUni = $("#idUni").val();
    let nom = $("#nombreUnidades").val();
	 let clave = $("#claveSat").val();
    let des = $("#descripcionUnidades").val();
    let accion = $("#accion").val();
    let goValidation = true;
    let estatus = 1;

    

        if(accion == "editar"){
            estatus = $("#estatusModal").val();
        }

    

    if("" == nom.trim()){
        $('#errornombreUnidades').show();
        $('#errornombreUnidades').html("Ingresa una descripcion");
        $('#nombreUnidades').focus();	
        goValidation = false;
        $("#btnEnviar, #nombreUnidades, #descripcionUnidades, #claveSat").removeAttr("disabled"); 
    }
	
	if("" == clave.trim()){
        $('#errorclaveSat').show();
        $('#errorclaveSat').html("Ingresa una clave");
        $('#claveSat').focus();	
        goValidation = false;
        $("#btnEnviar, #nombreUnidades, #descripcionUnidades, #claveSat").removeAttr("disabled"); 
    }
	
	
	

    if(goValidation){

        axios.post(base_url()+"app/Unidades/insertaUnidades", {
            idUni:idUni,
			clave: clave,
            nombreUni: nom,
            estatus: estatus,
            accion:accion
        })
        .then(({data})=>{

            if(data.resultado){

                toastr["success"](data.mensaje);
                $("#nombreUnidades").val("");
                $("#descripcionUnidades").val("");
                $("#ModalAgregar").modal('hide');
                listaUnidades();

                $("#btnEnviar, #nombreUnidades, #descripcionUnidades").removeAttr("disabled"); 
                
            }else{

                toastr["warning"](data.mensaje);
                $("#btnEnviar, #nombreUnidades, #descripcionUnidades").removeAttr("disabled"); 

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
    $("#nombreModal").html("Agregar Tipo de Pago");
    $("#nombreUnidades").val("");
	$("#claveSat").val("");
    $("#descripcionUnidades").val("");
    $("#accion").val("Agregar");
    $("#idUni").val("0");

} // termina modal agregar tipo de pago



function editar(id,clave,nombre,des,estatus){
    
    quitaErroresCamposVacios();

    $("#btnEnviar").html("Actualizar");
    $("#accion").val("editar");
    $('#ModalAgregar').modal('show');
    $("#nombreModal").html("Editar Tipo de Pago");
	$("#claveSat").val(clave);
    $("#nombreUnidades").val(nombre);
    $("#descripcionUnidades").val(des);
    $("#estatusModal").val(estatus);
    $("#idUni").val(id);
    if($("#icono-"+id).hasClass("fa-toggle-on")){
        $("#estatusModal").val('1');
    }else{
        $("#estatusModal").val('0');
    }

} // temrina modal editar tipo de pago

function cambiaEstatus(id){

    $.ajax({
        "url": base_url()+"app/Unidades/cambioEstatus",
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
        "url": base_url()+"app/Unidades/bajaLogica",
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
    $("#errornombreUnidades").hide();
    $("#errordescripcionUnidades").hide();

}




/* 


$('#ModalForm').modal('show');
// HIDE
$('#ModalForm').modal('hide');


 axios(base_url()+"app/Unidades/verUnidades")
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

 fetch(base_url()+"app/Unidades/verUnidades",{
           
        })
        .then((response)=> response.json())
        .then((result)=>{

            console.log(result);

        })
        .catch((error)=>{
            console.log("Error al cargar el controlador", error);
        })





*/