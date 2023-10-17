

$(document).ready(()=>{

    listaTipoPerfilesColaboradores()
    
    });
    
    
    
    function listaTipoPerfilesColaboradores (){
    
    //consumimos servicio para mostrar los tipos de contratacion
    axios(base_url()+"app/Perfiles_colaboradores/verTipoPerfilesColaboradores")
    .then(({data:Response})=>{
     console.log(Response)
    
     if(Response.resultado){
    
         /**
          * #despliegueTabla es el id de un div que se encuentra en la vista en TipoContratacion_view.php
          * se pintara la tabla en el id: despliegueTabla
          */
    
         $("#despliegueTabla").html(`
         <table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
             <thead>
                 <tr>
                     <th>id</th>
                     <th>Nombre</th>
                     <th>Descripción</th>
                     <th style="text-align: center">Estatus</th>
                     <th style="text-align: center">Editar</th>
                     <th style="text-align: center">Borrar</th>
                 </tr>
             </thead>
             <tbody>
         
             </tbody>
         </table>`
         );    
         $.each(Response.TipoEspecialidad, function(i,o){
    
             $("#datatable").find("tbody").append(`
                <tr id="tr-`+ o.idTP+`">
                     <td>`+ o.idTP+`</td>
                     <td>`+ o.nombreTP+`</td>
                     <td>`+o.desTP+`</td>
                     <td align="center"><a href="#" onclick="cambiaEstatus(`+o.idTP+`,'`+o.estatus+`')">`+(o.estatus == 1 ? '<i class="fas fa-toggle-on fa-2x"></i>':'<i class="fas fa-toggle-off fa-2x"></i>')+`</a></td>
                     <td align="center"><a href="#" onclick="editar(`+o.idTP+`,'`+o.nombreTP+`','`+o.desTP+`')"><i class="fas fa-pencil fa-2x"></i></a> </td>
                     <td align="center"><a href="#" onclick="modalBorrar(`+o.idTP+`,'`+o.nombreTP+`','`+o.desTP+`')"><i class="fas fa-trash fa-2x"></i></a></td>
                 </tr>`
             );
    
         });
         $("#datatable").DataTable(),$(".dataTables_length select").addClass("form-select form-select-sm");	
     }
     else{
         $("#despliegueTabla").html(Response.mensaje);
     }
    
    
    })
    .catch(error=>{
     console.log(error, "Error al cargar el controlador tipoPC");
    })
    
    }
    
    function InsertarTipoColaborador(){
    
    
    /** 
    * ModalTipoContratacion 
    */
    
    $("#errorNombrePerfilColaborador").hide();
    $("#errordescripcionPC").hide();
    
    $("#btnEnviar, #nombreTipoDePago, #descripcionTipoDePago").attr("disabled", "disabled");
    
    
    
    let idTP = $("#idTP").val();
    let nom = $("#nombrePerfilColaborador").val();
    let des = $("#descripcionPC").val();
    let accion = $("#acccion").val();
    let goValidation = true;
    
    if("" == des.trim()){
     $('#errordescripcionPC').show();
     $('#errordescripcionPC').html("Ingresa una descripcion para el perfil colaborador");
     $('#descripcionPC').focus();	
     goValidation = false;
     $("#btnEnviar, #nombrePerfilColaborador, #descripcionPC").removeAttr("disabled"); 
    }
    
    if("" == nom.trim()){
     $('#errorNombrePerfilColaborador').show();
     $('#errorNombrePerfilColaborador').html("Ingresa un nombre de perfil colaborador");
     $('#nombrePerfilColaborador').focus();	
     goValidation = false;
     $("#btnEnviar, #nombrePerfilColaborador, #descripcionPC").removeAttr("disabled"); 
    }
    
    if(goValidation){
    
    
    
     axios.post(base_url()+"app/Perfiles_colaboradores/insertarPerfilColaborador", {
         idTP:idTP,
         nombreTP: nom,
         desTP: des,
         accion:accion
     })
     .then(({data})=>{
    
         if(data.resultado){
    
             toastr["success"](data.mensaje);
             $("#nombrePerfilColaborador").val("");
             $("#descripcionPC").val("");
             $("#agregarPerfilColaborador").modal('hide');
             listaTipoPerfilesColaboradores();
    
             $("#btnEnviar, #nombrePerfilColaborador, #descripcionPC").removeAttr("disabled"); 
         }else{
    
             toastr["warning"](data.mensaje);
             $("#btnEnviar, #nombrePerfilColaborador, #descripcionPC").removeAttr("disabled"); 
    
         }
         
    
     })
     .catch(error=>{
         console.log(error);
       
     })
    
    
    
    }else{
    
     console.log("Falta datos para completar el formulario");
    
    
    }
    
    
    
    
    }
    
    /**Inicia funcion agregar 
    * abrimos el modal para agregar un nuevo tipo de contratacion
    */
    function agregarPerfilColaborador(){
   
    $('#agregarPerfilColaborador').modal('show');
    $("#nombreModal").html("Agregar perfil colaborador");
    $("#nombrePerfilColaborador").val("").attr("disabled",false);
    $("#descripcionPC").val("").attr("disabled",false);
    $("#acccion").val("agregar");
    $("#idTP").val("0");
    $("#btnEnviar").html("Añadir");
    
    }
    //termina funcion agregar
    
    /**Inicia funcion editar 
    * abrimos el modal para editar un nuevo tipo de contratacion
    */
    function editar(id,nombre,des){
    
    $("#errorNombrePerfilColaborador").hide();
    $("#errordescripcionPC").hide();
    $('#agregarPerfilColaborador').modal('show');
    $("#nombreModal").html("Editando: " + '('+nombre+')');
    $("#nombrePerfilColaborador").val(nombre).attr("disabled",false);
    $("#descripcionPC").val(des).attr("disabled",false);
    $("#acccion").val("editar");
    $("#idTP").val(id);
    $("#btnEnviar").html("Actualizar");
    
    }
    
    function modalBorrar(id,nombre,des){
    
        
        $('#borrarModal').modal('show');
        $("#tituloModalBorrar").html("Borrar <strong>"+nombre+"</strong>");
        $("#cuerpoModalBorrar").html("Estas seguro que deseas borrar: <strong>" + nombre + "</strong></br> Descripcion: <strong>" + des+"</strong>");
        $("#btnModalBorrar").attr("appData-Id",id);
    
    } 
    
    function btnModalBorrar(){
    
        let id= $("#btnModalBorrar").attr("appData-Id");
    
        $.ajax({
            "url": base_url()+"app/Perfiles_colaboradores/bajaLogica",
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
    
    function cambiaEstatus(id, estatus){
    
    console.log("ID",id )
    console.log("Estatus",estatus )
    const idContrato = id
    const estatusContrato = estatus
        
         let accion  = "CambiarEstatus";
    
         axios.post(base_url()+"app/Perfiles_colaboradores/insertarPerfilColaborador", {
             idTP:idContrato,
             accion:accion,
             estatus: estatusContrato
         })
         .then(({data})=>{
    
             if(data.resultado){
    
                 toastr["success"](data.mensaje);
                 listaTipoPerfilesColaboradores();
    
              
             }else{
    
                 toastr["warning"](data.mensaje);
                 
    
             }
             
    
         })
         .catch(error=>{
             console.log(error);
           
         })
    
    
    
    
    
    
    
    
    
    
    
    }
    