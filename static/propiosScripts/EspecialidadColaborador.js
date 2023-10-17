

$(document).ready(()=>{

    listaEspecialidadC()
    
    });
    
    
    
    function listaEspecialidadC (){
    
    //consumimos servicio para mostrar los tipos de contratacion
    axios(base_url()+"app/Especialidad_colaborador/verTipoEspecialidadesColaboradores")
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
         $.each(Response.tipoEspecialidadC, function(i,o){
    
             $("#datatable").find("tbody").append(`
                <tr id="tr-`+ o.idEsp+`">
                     <td>`+ o.idEsp+`</td>
                     <td>`+ o.nombreEsp+`</td>
                     <td>`+o.desEsp+`</td>
                     <td align="center"><a href="#" onclick="cambiaEstatus(`+o.idEsp+`,'`+o.estatus+`')">`+(o.estatus == 1 ? '<i class="fas fa-toggle-on fa-2x"></i>':'<i class="fas fa-toggle-off fa-2x"></i>')+`</a></td>
                     <td align="center"><a href="#" onclick="editar(`+o.idEsp+`,'`+o.nombreEsp+`','`+o.desEsp+`')"><i class="fas fa-pencil fa-2x"></i></a> </td>
                     <td align="center"><a href="#" onclick="modalBorrar(`+o.idEsp+`,'`+o.nombreEsp+`','`+o.desEsp+`')"><i class="fas fa-trash fa-2x"></i></a></td>
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
     console.log(error, "Error al cargar el controlador");
    })
    
    }
    
    function InsertarEspecialidadC(){
    
    
    /** 
    * ModalTipoContratacion 
    */
    
    $("#errorNombreESPColaborador").hide();
    $("#errordescripcionESPColaborador").hide();
    
    $("#btnEnviar, #nombreTipoDePago, #descripcionTipoDePago").attr("disabled", "disabled");
    
    
    
    let idEsp = $("#idEsp").val();
    let nom = $("#nombreESPColaborador").val();
    let des = $("#descripcionESPColaborador").val();
    let accion = $("#acccion").val();
    let goValidation = true;
    
    if("" == des.trim()){
     $('#errordescripcionESPColaborador').show();
     $('#errordescripcionESPColaborador').html("Ingresa una descripcion para Especialidad colaborador");
     $('#descripcionESPColaborador').focus();	
     goValidation = false;
     $("#btnEnviar, #nombreESPColaborador, #descripcionESPColaborador").removeAttr("disabled"); 
    }
    
    if("" == nom.trim()){
     $('#errorNombreESPColaborador').show();
     $('#errorNombreESPColaborador').html("Ingresa un nombre para Especialidad colaborador");
     $('#nombreESPColaborador').focus();	
     goValidation = false;
     $("#btnEnviar, #nombreESPColaborador, #descripcionESPColaborador").removeAttr("disabled"); 
    }
    
    if(goValidation){
    
    
    
     axios.post(base_url()+"app/Especialidad_colaborador/insertarEspecialidadColaborador", {
         idEsp:idEsp,
         nombreEsp: nom,
         desEsp: des,
         accion:accion
     })
     .then(({data})=>{
    
         if(data.resultado){
    
             toastr["success"](data.mensaje);
             $("#nombreESPColaborador").val("");
             $("#descripcionESPColaborador").val("");
             $("#agregarEsCo").modal('hide');
             listaEspecialidadC();
    
             $("#btnEnviar, #nombreESPColaborador, #descripcionESPColaborador").removeAttr("disabled"); 
         }else{
    
             toastr["warning"](data.mensaje);
             $("#btnEnviar, #nombreESPColaborador, #descripcionESPColaborador").removeAttr("disabled"); 
    
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
    function agregarEspecialidadCO(){
   
    $('#agregarEsCo').modal('show');
    $("#nombreModal").html("Agregar especialidad colaborador");
    $("#nombreESPColaborador").val("").attr("disabled",false);
    $("#descripcionESPColaborador").val("").attr("disabled",false);
    $("#acccion").val("agregar");
    $("#idEsp").val("0");
    $("#btnEnviar").html("Añadir");
    
    }
    //termina funcion agregar
    
    /**Inicia funcion editar 
    * abrimos el modal para editar un nuevo tipo de contratacion
    */
    function editar(id,nombre,des){
    
    $("#errorNombreESPColaborador").hide();
    $("#errordescripcionESPColaborador").hide();
    $('#agregarEsCo').modal('show');
    $("#nombreModal").html("Editando: " + '('+nombre+')');
    $("#nombreESPColaborador").val(nombre).attr("disabled",false);
    $("#descripcionESPColaborador").val(des).attr("disabled",false);
    $("#acccion").val("editar");
    $("#idEsp").val(id);
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
            "url": base_url()+"app/Especialidad_colaborador/bajaLogica",
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
    
         axios.post(base_url()+"app/Especialidad_colaborador/insertarEspecialidadColaborador", {
             idEsp:idContrato,
             accion:accion,
             estatus: estatusContrato
         })
         .then(({data})=>{
    
             if(data.resultado){
    
                 toastr["success"](data.mensaje);
                 listaEspecialidadC();
    
              
             }else{
    
                 toastr["warning"](data.mensaje);
                 
    
             }
             
    
         })
         .catch(error=>{
             console.log(error);
           
         })
    
    
    
    
    
    
    
    
    
    
    
    }
    