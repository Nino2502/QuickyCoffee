$(document).ready(()=>{


//alert("ya estamos aqui");
$("#datatable").find("tbody").html("");
listaPoliticas()

   
})






function listaPoliticas(){


    axios(base_url()+"app/Politicas/verPoliticas")
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

            $.each(data.Politicas, function(i,o){

                $("#datatable").find("tbody").append(`
                    <tr id="tr-`+ o.idPol+`">
                        <td>`+ o.idPol+`</td>
                        <td>`+ o.nombrePol+`</td>
                        <td class="text-wrap" style="width: 20rem;" id="pol-`+o.idPol+`">`+o.desPol+`</td>
                        <td align="center"><a href="#" onclick="cambiaEstatus(`+o.idPol+`)"><i id="icono-`+o.idPol+`" class="fas fa-toggle-`+(o.estatus == 1 ? 'on':'off')+` fa-2x"></i></a></td>
                        <td align="center"><a href="#" onclick='editar("`+o.idPol+`","`+o.nombrePol+`","`+o.estatus+`")'><i class="fas fa-pencil fa-2x"></i></a> </td>
                        <td align="center"><a href="#" onclick="modalBorrar(`+o.idPol+`,'`+o.nombrePol+`')"><i class="fas fa-trash fa-2x"></i></a></td>
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



} // termina lista de politicas



function insertaPoliticas(){

    quitaErroresCamposVacios();
	
	
	

    $("#btnEnviar, #nombrePoliticas, #descripcionPoliticas").attr("disabled", "disabled");

    let idPol = $("#idPol").val();
    let nom = $("#nombrePoliticas").val();
    let des = $("#descripcionPoliticas").val();
    let accion = $("#accion").val();
    let goValidation = true;
    let estatus = 1;

    

        if(accion == "editar"){
            estatus = $("#estatusModal").val();
        }

    if("" == des.trim()){
        $('#errordescripcionPoliticas').show();
        $('#errordescripcionPoliticas').html("Ingresa un nombre");
        $('#descripcionPoliticas').focus();	
        goValidation = false;
        $("#btnEnviar, #nombrePoliticas, #descripcionPoliticas").removeAttr("disabled"); 
    }

    if("" == nom.trim()){
        $('#errornombrePoliticas').show();
        $('#errornombrePoliticas').html("Ingresa una descripcion");
        $('#nombrePoliticas').focus();	
        goValidation = false;
        $("#btnEnviar, #nombrePoliticas, #descripcionPoliticas").removeAttr("disabled"); 
    }

    if(goValidation){

        axios.post(base_url()+"app/Politicas/insertaPoliticas", {
            idPol:idPol,
            nombrePol: nom,
            desPol: des,
            estatus: estatus,
            accion:accion
        })
        .then(({data})=>{

            if(data.resultado){

                toastr["success"](data.mensaje);
                $("#nombrePoliticas").val("");
                $("#descripcionPoliticas").val("");
                $("#ModalAgregar").modal('hide');
                listaPoliticas();

                $("#btnEnviar, #nombrePoliticas, #descripcionPoliticas").removeAttr("disabled"); 
                
            }else{

                toastr["warning"](data.mensaje);
                $("#btnEnviar, #nombrePoliticas, #descripcionPoliticas").removeAttr("disabled"); 

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
    $("#nombreModal").html("Agregar Política");
    $("#nombrePoliticas").val("");
    //$("#descripcionPoliticas").val("");
    $("#accion").val("Agregar");
    $("#idPol").val("0");
	
	$("#textareaDescripcion").html('<textarea class="form-control" rows="5" id="descripcionPoliticas"></textarea>');

} // termina modal agregar tipo de pago



function editar(id,nombre,estatus){
    
    quitaErroresCamposVacios();


	
	
	let desPol = $("#pol-"+id).text();
	
	
	$("#textareaDescripcion").html('<textarea class="form-control" rows="5" id="descripcionPoliticas">'+desPol+'</textarea>');

    $("#btnEnviar").html("Actualizar");
    $("#accion").val("editar");
    $('#ModalAgregar').modal('show');
    $("#nombreModal").html("Editar política");
    $("#nombrePoliticas").val(nombre);
    //$("#descripcionPoliticas").val(des);
    $("#estatusModal").val(estatus);
    $("#idPol").val(id);
    if($("#icono-"+id).hasClass("fa-toggle-on")){
        $("#estatusModal").val('1');
    }else{
        $("#estatusModal").val('0');
    }

} // temrina modal editar tipo de pago

function cambiaEstatus(id){

    $.ajax({
        "url": base_url()+"app/Politicas/cambioEstatus",
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


function modalBorrar(id,nombre){

	
	
	let desPol = $("#pol-"+id).val();
    
    $('#borrarModal').modal('show');
    $("#tituloModalBorrar").html("Borrar <strong>"+nombre+"</strong>");
    $("#cuerpoModalBorrar").html("Estas seguro que deseas borrar: <strong>" + nombre + "</strong></br> Descripcion: <strong>" + desPol+"</strong>");
    $("#btnModalBorrar").attr("appData-Id",id);

} // temrina modal editar tipo de pago


function btnModalBorrar(){

    let id= $("#btnModalBorrar").attr("appData-Id");

    $.ajax({
        "url": base_url()+"app/Politicas/bajaLogica",
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
    $("#errornombrePoliticas").hide();
    $("#errordescripcionPoliticas").hide();

}




/* 


$('#ModalForm').modal('show');
// HIDE
$('#ModalForm').modal('hide');


 axios(base_url()+"app/Politicas/verPoliticas")
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

 fetch(base_url()+"app/Politicas/verPoliticas",{
           
        })
        .then((response)=> response.json())
        .then((result)=>{

            console.log(result);

        })
        .catch((error)=>{
            console.log("Error al cargar el controlador", error);
        })





*/