$(document).ready(()=>{


    //alert("ya estamos aqui");
    $("#datatable").find("tbody").html("");
    listaCategoriasServicios();
	
	
	
	
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
	
	
	
	
	
	
	
	
	
    
       
    })
    
    
    function listaCategoriasServicios(){
    
    
        axios(base_url()+"app/categoriasServicios/verCategoriasServicios")
        .then(({data})=>{
    
            if(data.resultado){
    
                $("#despliegueTabla").html(`
                <table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
							<th>Imagen</th>
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
							<td>`+ o.desCS+`</td>
							<td><img src="`+base_url()+`/static/img/categoriasServ/`+o.imagen+`"  height="50" /></td>
                            
                            <td align="center"><a href="#" onclick="cambiaEstatus(`+o.idCS+`)"><i id="icono-`+o.idCS+`" class="fas fa-toggle-`+(o.estatus == 1 ? 'on':'off')+` fa-2x"></i></a></td>
                            <td align="center"><a href="#" onclick="editar(`+o.idCS+`,'`+o.nombreCS+`','`+o.desCS+`','`+o.estatus+`','`+o.imagen+`')"><i class="fas fa-pencil fa-2x"></i></a> </td>
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
    
    
    
    function insertaCategoriasServicios(){

        
        
        $("#btnEnviar, #nombrecategoriasServicios, #descripcioncategoriasServicios, #img").attr("disabled", "disabled");
    
        let idCS = $("#idCS").val();
        let nom = $("#nombrecategoriasServicios").val();
        let des = $("#descripcioncategoriasServicios").val();
        let accion = $("#accion").val();
        let goValidation = true;
        let estatus = 1;
		
		
		
		
		
		var img = $("#img")[0].files[0];
		
		console.log(img, "imagen");
		
		//console.log(accion, "Accion");
		
		
		if(accion == "Agregar"){
			
			if(undefined == img){
				$('#errorimg').show();
				$('#errorimg').html("Selecciona una imagen");
				$('#img').focus();	
				goValidation = false;
				$("#btnEnviar, #nombrecategoriasServicios, #descripcioncategoriasServicios, #img").removeAttr("disabled"); 

			}
			
		}
		
		
        if(accion == "editar"){
            estatus = $("#estatusModal").val();
        }
    
        if("" == des.trim()){
            $('#errordescripcioncategoriasServicios').show();
            $('#errordescripcioncategoriasServicios').html("Ingresa un nombre");
            $('#descripcioncategoriasServicios').focus();	
            goValidation = false;
            $("#btnEnviar, #nombrecategoriasServicios, #descripcioncategoriasServicios, #img").removeAttr("disabled");
        }
    
        if("" == nom.trim()){
            $('#errornombrecategoriasServicios').show();
            $('#errornombrecategoriasServicios').html("Ingresa una descripcion");
            $('#nombrecategoriasServicios').focus();	
            goValidation = false;
           $("#btnEnviar, #nombrecategoriasServicios, #descripcioncategoriasServicios, #img").removeAttr("disabled");
        }
    
        if(goValidation){
			
			
			var fd = new FormData();
			fd.append("idCS", idCS);
			fd.append("nombreCS", nom);
			fd.append("desCS", des);
			fd.append("estatus", estatus);
			fd.append("accion", accion);
			
			if($("#img")[0].files.length > 0){
				fd.append("imagen", img);
			}
			
			

	
			
    $.ajax({
        "url":base_url()+"app/categoriasServicios/insertaCategoriasServicios",
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
                    $("#nombrecategoriasServicios").val("");
                    $("#descripcioncategoriasServicios").val("");
                    $("#ModalAgregar").modal('hide');
                    listaCategoriasServicios();
    
                    $("#btnEnviar, #nombrecategoriasServicios, #descripcioncategoriasServicios, #img").removeAttr("disabled"); 
                    
                }else{
    
                    toastr["warning"](data.mensaje);
                    $("#btnEnviar, #nombrecategoriasServicios, #descripcioncategoriasServicios, #img").removeAttr("disabled"); 
    
                }
		
	})
	.fail();
			
			
			
			
    
           /* axios.post(base_url()+"app/categoriasServicios/insertaCategoriasServicios", {
                idCS:idCS,
                nombreCS: nom,
                desCS: des,
                estatus: estatus,
                accion:accion
            })
            .then(({data})=>{
    
                if(data.resultado){

                    console.log(data);
    
                    toastr["success"](data.mensaje);
                    $("#nombrecategoriasServicios").val("");
                    $("#descripcioncategoriasServicios").val("");
                    $("#ModalAgregar").modal('hide');
                    listaCategoriasServicios();
    
                    $("#btnEnviar, #nombrecategoriasServicios, #descripcioncategoriasServicios").removeAttr("disabled"); 
                    
                }else{
    
                    toastr["warning"](data.mensaje);
                    $("#btnEnviar, #nombrecategoriasServicios, #descripcioncategoriasServicios").removeAttr("disabled"); 
    
                }
                
            })
            .catch(error=>{
                console.log(error);
            })
			*/
    
        }else{
    
            console.log("Falta un dato");
    
        }
    
    } // termina insertar tipo de pago
    
    
    function agregar(){

        quitaErroresCamposVacios();
		
	
		
		$("#inputImagen").val('');
    
        $("#btnEnviar").html("Agregar");
        $('#ModalAgregar').modal('show');
        $("#nombreModal").html("Agregar Categoria de Servicio");
        $("#nombrecategoriasServicios").val("");
        $("#descripcioncategoriasServicios").val("");
        $("#accion").val("Agregar");
        $("#idCS").val("0");
		$(".custom-file-label").html("");
		
    
    } // termina modal agregar tipo de pago
    
    
    
    function editar(id,nombre,des,estatus,imagen){
        quitaErroresCamposVacios();
    
        $("#btnEnviar").html("Actualizar");
        $("#accion").val("editar");
        $('#ModalAgregar').modal('show');
        $("#nombreModal").html("Editar "+ nombre);
        $("#nombrecategoriasServicios").val(nombre);
        $("#descripcioncategoriasServicios").val(des);
        $("#estatusModal").val(estatus);
        $("#idCS").val(id);
		$(".custom-file-label").html("");
        if($("#icono-"+id).hasClass("fa-toggle-on")){
            $("#estatusModal").val('1');
        }else{
            $("#estatusModal").val('0');
        }
		
		$("#imagenCategoria").html('<img src="'+base_url()+'static/img/categoriasServ/'+imagen+'" height="40" />');
    
    } // temrina modal editar tipo de pago
    
    

function cambiaEstatus(id){
    
        $.ajax({
            "url": base_url()+"app/categoriasServicios/cambioEstatus",
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
            "url": base_url()+"app/categoriasServicios/bajaLogica",
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
        $("#errornombrecategoriasServicios").hide();
        $("#errordescripcioncategoriasServicios").hide();

    }







    
    
    
    
    /* 
    
    
    $('#ModalForm').modal('show');
    // HIDE
    $('#ModalForm').modal('hide');
    
    
     axios(base_url()+"app/categoriasServicios/verTiposDePago")
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
    
     fetch(base_url()+"app/categoriasServicios/verTiposDePago",{
               
            })
            .then((response)=> response.json())
            .then((result)=>{
    
                console.log(result);
    
            })
            .catch((error)=>{
                console.log("Error al cargar el controlador", error);
            })
    
    
    
    
    
    */