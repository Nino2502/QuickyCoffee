$(document).ready(()=>{


//alert("ya estamos aqui");
$("#datatable").find("tbody").html("");
listaAvisoDePrivacidad()
	
	$("#first-tab").click(()=>{
		
		listaAvisoDePrivacidad();
		
		
	});
	
	
var editorTexto = new Quill('.html-editor');	
	/*
	
	axios(base_url()+"app/AvisoDePrivacidad/verAvisoDePrivacidad")
    .then(({data})=>{

        if(data.resultado){

           const datosNuevos =[];
			const datosNuevos2 =[];
			
			let num1;
			let num2;

            $.each(data.AvisoDePrivacidad, function(i,o){
				
				if(o.idADP == "3"){
				console.log("c ", typeof( JSON.parse(o.cuerpoAviso)));
				console.log("id ", typeof(o.idADP));
				console.log("e ",typeof(o.estatus));
					
					
				num1 = JSON.parse(o.cuerpoAviso);
				//num2 = JSON.parse(o.cuerpoAviso.ops);	
				datosNuevos.push(num1);
				//datosNuevos2.push(num2));
					
				
				
				
				
					
					
				}

            

            });
			console.log("datos1 ",num1);
			//console.log("datos2 ",num2);	
			


          editorTexto.setContents(num1);

        }else{
			
			
			

            $("#despliegueTabla").html(datosNuevos.ops);

        }
        

    })
    .catch(error=>{
        console.log(error);
    })

	*/
//editorTexto.setContents(texto);

	
	

	

	
editorTexto.setContents(
[
    {
        "attributes": {
            "color": "#000000",
            "bold": true
        },
        "insert": "AVISO DE PRIVACIDAD"
    },
    {
        "attributes": {
            "align": "center"
        },
        "insert": "\n"
    },
    {
        "attributes": {
            "align": "justify"
        },
        "insert": "\n"
    },
    {
        "attributes": {
            "color": "#000000"
        },
        "insert": "En cumplimiento a la LEY FEDERAL DE PROTECCIÓN DE DATOS PERSONALES EN POSESIÓN DE LOS PARTICULARES (la Ley); los datos personales solicitados, son tratados por SDI SERVICIOS DIGITALES DE IMPRESIÓNcon domicilio en Juan de la barrera #18 esq. pino suarez Col. Niños Heroes 76010, Querétaro, Querétaro, México."
    },
    {
        "attributes": {
            "align": "justify"
        },
        "insert": "\n"
    },
    {
        "attributes": {
            "color": "#000000"
        },
        "insert": "En todo momento usted podrá revocar el consentimiento que nos ha otorgado para el tratamiento de sus datos personales, a fin de que dejemos de hacer uso de estos."
    },
    {
        "attributes": {
            "align": "justify"
        },
        "insert": "\n\n"
    },
    {
        "attributes": {
            "color": "#000000",
            "bold": true
        },
        "insert": "¿CÓMO CONTACTARNOS?"
    },
    {
        "attributes": {
            "align": "justify"
        },
        "insert": "\n"
    },
    {
        "attributes": {
            "color": "#000000"
        },
        "insert": "Oficina de privacidad: PO PizzOptmize."
    },
    {
        "attributes": {
            "align": "justify"
        },
        "insert": "\n"
    },
    {
        "attributes": {
            "color": "#000000"
        },
        "insert": "Domicilio: Juan de la barrera #18 esq. pino suarez Col. Niños Heroes 76010, Querétaro, Querétaro, México."
    },
    {
        "attributes": {
            "align": "justify"
        },
        "insert": "\n"
    },
    {
        "attributes": {
            "color": "#000000"
        },
        "insert": "Correo electrónico: contacto@localhost/sdi_web"
    },
    {
        "attributes": {
            "align": "justify"
        },
        "insert": "\n"
    },
    {
        "attributes": {
            "color": "#000000"
        },
        "insert": "Teléfono: 01 (442) 242 4356"
    },
    {
        "attributes": {
            "align": "justify"
        },
        "insert": "\n"
    },
    {
        "attributes": {
            "color": "#000000"
        },
        "insert": " "
    },
    {
        "attributes": {
            "align": "justify"
        },
        "insert": "\n"
    }
]);


	
	
	
	

   
})


function listaAvisoDePrivacidad(){


    axios(base_url()+"app/AvisoDePrivacidad/verAvisoDePrivacidad")
    .then(({data})=>{

        if(data.resultado){

            $("#despliegueTabla").html(`
            <table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Texto</th>
                       
                        <th style="text-align: center">Estatus</th>
                        <th style="text-align: center">Editar</th>
                        <th style="text-align: center">Borrar</th>
                    </tr>
                </thead>
                <tbody>
            
                </tbody>
            </table>`
            );

            $.each(data.AvisoDePrivacidad, function(i,o){
				
				if(o.idADP == "3"){
				console.log("c ", typeof( JSON.parse(o.cuerpoAviso)));
				console.log("id ", typeof(o.idADP));
				console.log("e ",typeof(o.estatus));
				}

                $("#datatable").find("tbody").append(`
                    <tr id="tr-`+ o.idADP+`">
                        <td >`+ o.idADP+`</td>
                        <td class="text-wrap" style="width: 70rem">`+ o.cuerpoAviso+`</td>
                       
                        <td align="center"><a href="#" onclick="cambiaEstatus(`+o.idADP+`)"><i id="icono-`+o.idADP+`" class="fas fa-toggle-`+(o.estatus == 1 ? 'on':'off')+` fa-2x"></i></a></td>
                        <td align="center"><a href="#" onclick="editar(`+o.idADP+`,'`+o.estatus+`')"><i class="fas fa-pencil fa-2x"></i></a> </td>
                        <td align="center"><a href="#" onclick="modalBorrar(`+o.idADP+`)"><i class="fas fa-trash fa-2x"></i></a></td>
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



/* 

quill.setContents([
  { insert: 'Hello ' },
  { insert: 'World!', attributes: { bold: true } },
  { insert: '\n' }
]);

*/





function insertaAvisoDePrivacidad(){
	
	
	var editor = new Quill('.html-editor');	
	let datos = editor.getContents();
	
	
	var myEditor = document.querySelector('.html-editor')
	var html = myEditor.children[0].innerHTML
	
	
	//let datos = editor.getText();
	
	console.log(html);
	
	console.log(JSON.stringify(datos));
	
	  $.ajax({
        "url": base_url()+"app/AvisoDePrivacidad/insertaAvisoDePrivacidad",
        "dataType": "JSON",
        "type":"POST",
        "data":{
			"idADP": "0",
            "datos":JSON.stringify(datos),
			"acccion": "Agregar",
			"estatus": "1"
			
        }
    })
    .done((data)=>{
        if(data.resultado){

            toastr["success"](data.mensaje);


        } else{
            toastr["warning"](data.mensaje);
        }
    })
    .fail();
	
	
	//let pr = $("#pr1").val();
	
	
	//var delta = quill.getContents();
	
	
	
	
	
/*
    quitaErroresCamposVacios();

    $("#btnEnviar, #nombreAvisoDePrivacidad, #descripcionAvisoDePrivacidad").attr("disabled", "disabled");

    let idADP = $("#idADP").val();
    let nom = $("#nombreAvisoDePrivacidad").val();
    let des = $("#descripcionAvisoDePrivacidad").val();
    let accion = $("#accion").val();
    let goValidation = true;
    let estatus = 1;

    

        if(accion == "editar"){
            estatus = $("#estatusModal").val();
        }

    if("" == des.trim()){
        $('#errordescripcionAvisoDePrivacidad').show();
        $('#errordescripcionAvisoDePrivacidad').html("Ingresa un nombre");
        $('#descripcionAvisoDePrivacidad').focus();	
        goValidation = false;
        $("#btnEnviar, #nombreAvisoDePrivacidad, #descripcionAvisoDePrivacidad").removeAttr("disabled"); 
    }

    if("" == nom.trim()){
        $('#errornombreAvisoDePrivacidad').show();
        $('#errornombreAvisoDePrivacidad').html("Ingresa una descripcion");
        $('#nombreAvisoDePrivacidad').focus();	
        goValidation = false;
        $("#btnEnviar, #nombreAvisoDePrivacidad, #descripcionAvisoDePrivacidad").removeAttr("disabled"); 
    }

    if(goValidation){

        axios.post(base_url()+"app/AvisoDePrivacidad/insertaAvisoDePrivacidad", {
            idADP:idADP,
            nombreFP: nom,
            desFP: des,
            estatus: estatus,
            accion:accion
        })
        .then(({data})=>{

            if(data.resultado){

                toastr["success"](data.mensaje);
                $("#nombreAvisoDePrivacidad").val("");
                $("#descripcionAvisoDePrivacidad").val("");
                $("#ModalAgregar").modal('hide');
                listaAvisoDePrivacidad();

                $("#btnEnviar, #nombreAvisoDePrivacidad, #descripcionAvisoDePrivacidad").removeAttr("disabled"); 
                
            }else{

                toastr["warning"](data.mensaje);
                $("#btnEnviar, #nombreAvisoDePrivacidad, #descripcionAvisoDePrivacidad").removeAttr("disabled"); 

            }
            
        })
        .catch(error=>{
            console.log(error);
        })

    }else{

        console.log("Falta un dato");

    }*/

} // termina insertar tipo de pago



/*
function agregar(){

    quitaErroresCamposVacios();

    $("#btnEnviar").html("Agregar");
    $('#ModalAgregar').modal('show');
    $("#nombreModal").html("Agregar Tipo de Pago");
    $("#nombreAvisoDePrivacidad").val("");
    $("#descripcionAvisoDePrivacidad").val("");
    $("#accion").val("Agregar");
    $("#idADP").val("0");

} // termina modal agregar tipo de pago
*/


function editar(id,nombre,des,estatus){
    
    quitaErroresCamposVacios();

    $("#btnEnviar").html("Actualizar");
    $("#accion").val("editar");
    $('#ModalAgregar').modal('show');
    $("#nombreModal").html("Editar Tipo de Pago");
    $("#nombreAvisoDePrivacidad").val(nombre);
    $("#descripcionAvisoDePrivacidad").val(des);
    $("#estatusModal").val(estatus);
    $("#idADP").val(id);
    if($("#icono-"+id).hasClass("fa-toggle-on")){
        $("#estatusModal").val('1');
    }else{
        $("#estatusModal").val('0');
    }

} // temrina modal editar tipo de pago

function cambiaEstatus(id){

    $.ajax({
        "url": base_url()+"app/AvisoDePrivacidad/cambioEstatus",
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
        "url": base_url()+"app/AvisoDePrivacidad/bajaLogica",
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
    $("#errornombreAvisoDePrivacidad").hide();
    $("#errordescripcionAvisoDePrivacidad").hide();

}




/* 


$('#ModalForm').modal('show');
// HIDE
$('#ModalForm').modal('hide');


 axios(base_url()+"app/AvisoDePrivacidad/verAvisoDePrivacidad")
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

 fetch(base_url()+"app/AvisoDePrivacidad/verAvisoDePrivacidad",{
           
        })
        .then((response)=> response.json())
        .then((result)=>{

            console.log(result);

        })
        .catch((error)=>{
            console.log("Error al cargar el controlador", error);
        })





*/