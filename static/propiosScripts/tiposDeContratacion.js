

$(document).ready(()=>{

listatipocontratacion()

});



function listatipocontratacion (){

//consumimos servicio para mostrar los tipos de contratacion
axios(base_url()+"app/TipoDeContratacion/verTipoContrataciones")
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
     $.each(Response.tiposContrataciones, function(i,o){

         $("#datatable").find("tbody").append(`
            <tr id="tr-`+ o.idTC+`">
                 <td>`+ o.idTC+`</td>
                 <td>`+ o.nombreTC+`</td>
                 <td>`+o.desTC+`</td>
                 <td align="center"><a href="#" onclick="cambiaEstatus(`+o.idTC+`,'`+o.estatus+`')">`+(o.estatus == 1 ? '<i class="fas fa-toggle-on fa-2x"></i>':'<i class="fas fa-toggle-off fa-2x"></i>')+`</a></td>
                 <td align="center"><a href="#" onclick="editar(`+o.idTC+`,'`+o.nombreTC+`','`+o.desTC+`')"><i class="fas fa-pencil fa-2x"></i></a> </td>
                 <td align="center"><a href="#" onclick="modalBorrar(`+o.idTC+`,'`+o.nombreTC+`','`+o.desTC+`')"><i class="fas fa-trash fa-2x"></i></a></td>
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
 console.log(error, "Error al cargar el controlador verTipoContrataciones");
})

}

function InsertarTipoContratacion(){


/** 
* ModalTipoContratacion 
*/

quitaErroresCamposVacios();

$("#btnEnviar, #nombreTipoDePago, #descripcionTipoDePago").attr("disabled", "disabled");



let idTC = $("#idFP").val();
let nom = $("#nombreTipoContratacion").val();
let des = $("#descripcionTipoContratacion").val();
let accion = $("#acccion").val();
let goValidation = true;

if("" == des.trim()){
 $('#errordescripcionTipoContratacion').show();
 $('#errordescripcionTipoContratacion').html("Ingresa un nombre de contratación");
 $('#descripcionTipoContratacion').focus();	
 goValidation = false;
 $("#btnEnviar, #nombreTipoContratacion, #descripcionTipoContratacion").removeAttr("disabled"); 
}

if("" == nom.trim()){
 $('#errorNombreTipoContratacion').show();
 $('#errorNombreTipoContratacion').html("Ingresa una descripcion para el tipo de contratación");
 $('#nombreTipoContratacion').focus();	
 goValidation = false;
 $("#btnEnviar, #nombreTipoContratacion, #descripcionTipoContratacion").removeAttr("disabled"); 
}

if(goValidation){



 axios.post(base_url()+"app/TipoDeContratacion/insertarTipoContratacion", {
     idTC:idTC,
     nombreTC: nom,
     desTC: des,
     accion:accion
 })
 .then(({data})=>{

     if(data.resultado){

         toastr["success"](data.mensaje);
         $("#nombreTipoContratacion").val("");
         $("#descripcionTipoContratacion").val("");
         $("#agregarContratacion").modal('hide');
         listatipocontratacion();

         $("#btnEnviar, #nombreTipoContratacion, #descripcionTipoContratacion").removeAttr("disabled"); 
     }else{

         toastr["warning"](data.mensaje);
         $("#btnEnviar, #nombreTipoContratacion, #descripcionTipoContratacion").removeAttr("disabled"); 

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
function agregarTipoContratacion(){
    quitaErroresCamposVacios();

$('#agregarContratacion').modal('show');
$("#nombreModal").html("Agregar Tipo de Contratacion");
$("#nombreTipoContratacion").val("").attr("disabled",false);
$("#descripcionTipoContratacion").val("").attr("disabled",false);
$("#acccion").val("agregar");
$("#idFP").val("0");
$("#btnEnviar").html("Añadir");

}
//termina funcion agregar

/**Inicia funcion editar 
* abrimos el modal para editar un nuevo tipo de contratacion
*/
function editar(id,nombre,des){
    quitaErroresCamposVacios();

$("#errorNombreTipoContratacion").hide();
$("#errordescripcionTipoContratacion").hide();
$('#agregarContratacion').modal('show');
$("#nombreModal").html("Editando: " + '('+nombre+')');
$("#nombreTipoContratacion").val(nombre).attr("disabled",false);
$("#descripcionTipoContratacion").val(des).attr("disabled",false);
$("#acccion").val("editar");
$("#idFP").val(id);
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
        "url": base_url()+"app/TipoDeContratacion/bajaLogica",
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

     axios.post(base_url()+"app/TipoDeContratacion/insertarTipoContratacion", {
         idTC:idContrato,
         accion:accion,
         estatus: estatusContrato
     })
     .then(({data})=>{

         if(data.resultado){

             toastr["success"](data.mensaje);
             listatipocontratacion();

          
         }else{

             toastr["warning"](data.mensaje);
             

         }
         

     })
     .catch(error=>{
         console.log(error);
       
     })


}

function quitaErroresCamposVacios(){
    $("#errorNombreTipoContratacion").hide();
    $("#errordescripcionTipoContratacion").hide();
}
