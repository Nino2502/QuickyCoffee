$(document).ready(()=>{

$("#datatable").DataTable(),$(".dataTables_length select").addClass("form-select form-select-sm");	

 
})




function agregar(){

    quitaErroresCamposVacios();


    $("#btnEnviar").html("Agregar");
    $('#ModalAgregar').modal('show');
    
    $("#accion").val("AgregarAtr");
	
    $("#divAtributos").html(` <h5 class="mb-4">Atributos</h5>
                                                            
    <input data-role="tagsinput" type="text" id="listaAtributos">
    <small class="text-danger" id="errorlistaAtributos" style="display: none;"></small> `);

    


// funcion place holder

!function(a){"use strict";function b(b,c){this.itemsArray=[],this.$element=a(b),this.$element.hide(),this.isSelect="SELECT"===b.tagName,this.multiple=this.isSelect&&b.hasAttribute("multiple"),this.objectItems=c&&c.itemValue,this.placeholderText=b.hasAttribute("placeholder")?this.$element.attr("placeholder"):"",this.inputSize=Math.max(1,this.placeholderText.length),this.$container=a('<div class="bootstrap-tagsinput"></div>'),this.$input=a('<input type="text" placeholder="'+this.placeholderText+'"/>').appendTo(this.$container),this.$element.before(this.$container),this.build(c)}function c(a,b){if("function"!=typeof a[b]){var c=a[b];a[b]=function(a){return a[c]}}}function d(a,b){if("function"!=typeof a[b]){var c=a[b];a[b]=function(){return c}}}function e(a){return a?i.text(a).html():""}function f(a){var b=0;if(document.selection){a.focus();var c=document.selection.createRange();c.moveStart("character",-a.value.length),b=c.text.length}else(a.selectionStart||"0"==a.selectionStart)&&(b=a.selectionStart);return b}function g(b,c){var d=!1;return a.each(c,function(a,c){if("number"==typeof c&&b.which===c)return d=!0,!1;if(b.which===c.which){var e=!c.hasOwnProperty("altKey")||b.altKey===c.altKey,f=!c.hasOwnProperty("shiftKey")||b.shiftKey===c.shiftKey,g=!c.hasOwnProperty("ctrlKey")||b.ctrlKey===c.ctrlKey;if(e&&f&&g)return d=!0,!1}}),d}var h={tagClass:function(a){return"label label-info"},itemValue:function(a){return a?a.toString():a},itemText:function(a){return this.itemValue(a)},itemTitle:function(a){return null},freeInput:!0,addOnBlur:!0,maxTags:void 0,maxChars:void 0,confirmKeys:[13,44],delimiter:",",delimiterRegex:null,cancelConfirmKeysOnEmpty:!0,onTagExists:function(a,b){b.hide().fadeIn()},trimValue:!1,allowDuplicates:!1};b.prototype={constructor:b,add:function(b,c,d){var f=this;if(!(f.options.maxTags&&f.itemsArray.length>=f.options.maxTags)&&(b===!1||b)){if("string"==typeof b&&f.options.trimValue&&(b=a.trim(b)),"object"==typeof b&&!f.objectItems)throw"Can't add objects when itemValue option is not set";if(!b.toString().match(/^\s*$/)){if(f.isSelect&&!f.multiple&&f.itemsArray.length>0&&f.remove(f.itemsArray[0]),"string"==typeof b&&"INPUT"===this.$element[0].tagName){var g=f.options.delimiterRegex?f.options.delimiterRegex:f.options.delimiter,h=b.split(g);if(h.length>1){for(var i=0;i<h.length;i++)this.add(h[i],!0);return void(c||f.pushVal())}}var j=f.options.itemValue(b),k=f.options.itemText(b),l=f.options.tagClass(b),m=f.options.itemTitle(b),n=a.grep(f.itemsArray,function(a){return f.options.itemValue(a)===j})[0];if(!n||f.options.allowDuplicates){if(!(f.items().toString().length+b.length+1>f.options.maxInputLength)){var o=a.Event("beforeItemAdd",{item:b,cancel:!1,options:d});if(f.$element.trigger(o),!o.cancel){f.itemsArray.push(b);var p=a('<span class="tag '+e(l)+(null!==m?'" title="'+m:"")+'">'+e(k)+'<span data-role="remove"></span></span>');if(p.data("item",b),f.findInputWrapper().before(p),p.after(" "),f.isSelect&&!a('option[value="'+encodeURIComponent(j)+'"]',f.$element)[0]){var q=a("<option selected>"+e(k)+"</option>");q.data("item",b),q.attr("value",j),f.$element.append(q)}c||f.pushVal(),(f.options.maxTags===f.itemsArray.length||f.items().toString().length===f.options.maxInputLength)&&f.$container.addClass("bootstrap-tagsinput-max"),f.$element.trigger(a.Event("itemAdded",{item:b,options:d}))}}}else if(f.options.onTagExists){var r=a(".tag",f.$container).filter(function(){return a(this).data("item")===n});f.options.onTagExists(b,r)}}}},remove:function(b,c,d){var e=this;if(e.objectItems&&(b="object"==typeof b?a.grep(e.itemsArray,function(a){return e.options.itemValue(a)==e.options.itemValue(b)}):a.grep(e.itemsArray,function(a){return e.options.itemValue(a)==b}),b=b[b.length-1]),b){var f=a.Event("beforeItemRemove",{item:b,cancel:!1,options:d});if(e.$element.trigger(f),f.cancel)return;a(".tag",e.$container).filter(function(){return a(this).data("item")===b}).remove(),a("option",e.$element).filter(function(){return a(this).data("item")===b}).remove(),-1!==a.inArray(b,e.itemsArray)&&e.itemsArray.splice(a.inArray(b,e.itemsArray),1)}c||e.pushVal(),e.options.maxTags>e.itemsArray.length&&e.$container.removeClass("bootstrap-tagsinput-max"),e.$element.trigger(a.Event("itemRemoved",{item:b,options:d}))},removeAll:function(){var b=this;for(a(".tag",b.$container).remove(),a("option",b.$element).remove();b.itemsArray.length>0;)b.itemsArray.pop();b.pushVal()},refresh:function(){var b=this;a(".tag",b.$container).each(function(){var c=a(this),d=c.data("item"),f=b.options.itemValue(d),g=b.options.itemText(d),h=b.options.tagClass(d);if(c.attr("class",null),c.addClass("tag "+e(h)),c.contents().filter(function(){return 3==this.nodeType})[0].nodeValue=e(g),b.isSelect){var i=a("option",b.$element).filter(function(){return a(this).data("item")===d});i.attr("value",f)}})},items:function(){return this.itemsArray},pushVal:function(){var b=this,c=a.map(b.items(),function(a){return b.options.itemValue(a).toString()});b.$element.val(c,!0).trigger("change")},build:function(b){var e=this;if(e.options=a.extend({},h,b),e.objectItems&&(e.options.freeInput=!1),c(e.options,"itemValue"),c(e.options,"itemText"),d(e.options,"tagClass"),e.options.typeahead){var i=e.options.typeahead||{};d(i,"source"),e.$input.typeahead(a.extend({},i,{source:function(b,c){function d(a){for(var b=[],d=0;d<a.length;d++){var g=e.options.itemText(a[d]);f[g]=a[d],b.push(g)}c(b)}this.map={};var f=this.map,g=i.source(b);a.isFunction(g.success)?g.success(d):a.isFunction(g.then)?g.then(d):a.when(g).then(d)},updater:function(a){return e.add(this.map[a]),this.map[a]},matcher:function(a){return-1!==a.toLowerCase().indexOf(this.query.trim().toLowerCase())},sorter:function(a){return a.sort()},highlighter:function(a){var b=new RegExp("("+this.query+")","gi");return a.replace(b,"<strong>$1</strong>")}}))}if(e.options.typeaheadjs){var j=null,k={},l=e.options.typeaheadjs;a.isArray(l)?(j=l[0],k=l[1]):k=l,e.$input.typeahead(j,k).on("typeahead:selected",a.proxy(function(a,b){k.valueKey?e.add(b[k.valueKey]):e.add(b),e.$input.typeahead("val","")},e))}e.$container.on("click",a.proxy(function(a){e.$element.attr("disabled")||e.$input.removeAttr("disabled"),e.$input.focus()},e)),e.options.addOnBlur&&e.options.freeInput&&e.$input.on("focusout",a.proxy(function(b){0===a(".typeahead, .twitter-typeahead",e.$container).length&&(e.add(e.$input.val()),e.$input.val(""))},e)),e.$container.on("keydown","input",a.proxy(function(b){var c=a(b.target),d=e.findInputWrapper();if(e.$element.attr("disabled"))return void e.$input.attr("disabled","disabled");switch(b.which){case 8:if(0===f(c[0])){var g=d.prev();g.length&&e.remove(g.data("item"))}break;case 46:if(0===f(c[0])){var h=d.next();h.length&&e.remove(h.data("item"))}break;case 37:var i=d.prev();0===c.val().length&&i[0]&&(i.before(d),c.focus());break;case 39:var j=d.next();0===c.val().length&&j[0]&&(j.after(d),c.focus())}var k=c.val().length;Math.ceil(k/5);c.attr("size",Math.max(this.inputSize,c.val().length))},e)),e.$container.on("keypress","input",a.proxy(function(b){var c=a(b.target);if(e.$element.attr("disabled"))return void e.$input.attr("disabled","disabled");var d=c.val(),f=e.options.maxChars&&d.length>=e.options.maxChars;e.options.freeInput&&(g(b,e.options.confirmKeys)||f)&&(0!==d.length&&(e.add(f?d.substr(0,e.options.maxChars):d),c.val("")),e.options.cancelConfirmKeysOnEmpty===!1&&b.preventDefault());var h=c.val().length;Math.ceil(h/5);c.attr("size",Math.max(this.inputSize,c.val().length))},e)),e.$container.on("click","[data-role=remove]",a.proxy(function(b){e.$element.attr("disabled")||e.remove(a(b.target).closest(".tag").data("item"))},e)),e.options.itemValue===h.itemValue&&("INPUT"===e.$element[0].tagName?e.add(e.$element.val()):a("option",e.$element).each(function(){e.add(a(this).attr("value"),!0)}))},destroy:function(){var a=this;a.$container.off("keypress","input"),a.$container.off("click","[role=remove]"),a.$container.remove(),a.$element.removeData("tagsinput"),a.$element.show()},focus:function(){this.$input.focus()},input:function(){return this.$input},findInputWrapper:function(){for(var b=this.$input[0],c=this.$container[0];b&&b.parentNode!==c;)b=b.parentNode;return a(b)}},a.fn.tagsinput=function(c,d,e){var f=[];return this.each(function(){var g=a(this).data("tagsinput");if(g)if(c||d){if(void 0!==g[c]){if(3===g[c].length&&void 0!==e)var h=g[c](d,null,e);else var h=g[c](d);void 0!==h&&f.push(h)}}else f.push(g);else g=new b(this,c),a(this).data("tagsinput",g),f.push(g),"SELECT"===this.tagName&&a("option",a(this)).attr("selected","selected"),a(this).val(a(this).val())}),"string"==typeof c?f.length>1?f:f[0]:f},a.fn.tagsinput.Constructor=b;var i=a("<div />");a(function(){a("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput()})}(window.jQuery);

//

	
	

}







function dividirCadena(cadenaADividir,separador) {
    var arrayDeCadenas = cadenaADividir.split(separador);
    
 
    //for (var i=0; i < arrayDeCadenas.length; i++) {
      // document.write(arrayDeCadenas[i] + " / ");
   // }

   return arrayDeCadenas;
 }



function quitaErroresCamposVacios(){
    
    $("#errorlistaAtributos").hide();
   

}



function desabilitaCampos(){

    $("#listaAtributos").attr("disabled", "disabled");

}

function habilitaCampos(){
    $("#listaAtributos").removeAttr("disabled"); 
}



function insertaAtributos(){


    desabilitaCampos();
    let idAtr = $("#idAtr").val();
    
    let accion = $("#accion").val();
    let goValidation = true;
    let separador = ",";

    let atributos = $("#listaAtributos").val();

     const datos = dividirCadena(atributos, separador);

   

    quitaErroresCamposVacios();

    
        

          


    if(datos.length == 0 ||  datos[0] == ""){
        $('#errorlistaAtributos').show();
        $('#errorlistaAtributos').html("Captura al menos 1 atributo");
        $('#listaAtributos').focus();	
        goValidation = false;
        habilitaCampos();
        
    }



    if(goValidation){

        axios.post(base_url()+"app/Atributos/insertaAtributos", {
            idAtr:idAtr,
            nombreAtr: "",
            desAtr: "",
            listaAtributos: datos,
            listaCategorias: "",
            estatus: "",
            accion:accion
        })
        .then(({data})=>{

            if(data.resultado){

                toastr["success"](data.mensaje);
                
                $("#ModalAgregar").modal('hide');
                
				listaAtributos();
                habilitaCampos();
                
            }else{

                toastr["warning"](data.mensaje);
                habilitaCampos();

            }
            
        })
        .catch(error=>{
            console.log(error);
        })

    }else{

        console.log("Falta un dato");

    }

} // termina insertar tipo de pago



function listaAtributos(){
	
	let idAtr = $("#idAtr").val();
    
	
	

 axios.post(base_url()+"app/Atributos/recargaAtributos", {
            idAtr:idAtr
            
        })
        
    .then(({data})=>{

        if(data.resultado){

            $("#despliegaTabla").html(`
            <table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr align="center">
                        <th>id</th>
						<th>Nombre</th>
						<th align="center">Eliminar</th>
                        <th align="center">Editar</th>
                    </tr>
                </thead>
                <tbody>
            
                </tbody>
            </table>`
            );

            $.each(data.atributos, function(i,o){

                $("#datatable").find("tbody").append(`

					<tr align="center">
						<td>`+ o.idDAtr+`</td>
						<td>`+o.nombreDAtr+`</td>
						
                        <td align="center"><a href="#" onclick="modalBorrar(`+o.idDAtr+`,'`+o.nombreDAtr+`')"><i class="fas fa-trash fa-2x"></i></a></td>
						<td align="center"><a href="#" onclick="modalEditar(`+o.idDAtr+`,'`+o.nombreDAtr+`')"><i class="fas fa-pencil fa-2x"></i></a> </td>
						
						
					</tr>
					`
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







function modalBorrar(id,nombre){

	$("#borrarModal").modal("show");
    $("#tituloModalBorrar").html("Borrar " + nombre);
    $("#cuerpoModalBorrar").html("Estas seguro que deseas borrar: <strong>" + nombre + "</strong></br>");
    $("#btnModalBorrar_atributo").attr("appData-Id",id);


}

function btnModalBorrar(){
	
	
	let id= $("#btnModalBorrar_atributo").attr("appData-Id");
	
	console.log("Soy el id del servicio  ",id );
	
	
	
	$.ajax({
		"url": base_url()+"app/Atributos/borrarAtributo",
        "dataType": "JSON",
        "type":"POST",
		"data" : {
			"id":id
		
		
		}
	

	
	})
	
	.done((data)=>{
        if(data.resultado){

            toastr["success"](data.mensaje);
            $("#tr-"+id).remove();

            $('#borrarModal').modal('hide');
			
			window.location.reload();

        } else{
            toastr["warning"](data.mensaje);
            $('#borrarModal').modal('hide');
        }
    })
    .fail();
	
	listaAtributos();
	

}


function modalEditar(id,nombre){
    quitaErroresCamposVacios();
	
	console.log("Soy nombre del atributo",nombre);
	

	$("#idAtributo").val(id);
    $("#btnEnviar").html("Actualizar");
    $("#accion").val("editar");
    $('#ModalEditar').modal('show');
    $('#nombreModal').html("Editar atributo :" + nombre);
    $('#nombreAtributos').val(nombre);
   //$('#estatusModal').val(estatus);
    $('#idDAtr').val(id);
	

}

function insertarEditar(){
	
	let id = $("#idAtributo").val();
	
	console.log("Soy del id atribuitoi ",id);
	
	let idAtributito = $("#idAtr").val();
	
	console.log("Soy atributito",idAtributito);
	
	
	let nombre = $("#nombreAtributos").val();
	

	
	console.log("Soy nombre de atribuito  ",nombre);
	
	let accion = $("#accion").val();
	
	console.log("Soy accion  ",accion);
	
	let goValidation = true;
	
	console.log("Soy goValidation  ",goValidation);
	
	
		
	if("" == nombre.trim()){
		
		console.log("No debe de ir vacio");
		
		$('#errornombreAtributos').show();
        $('#errornombreAtributos').html("Ingresa una descripcion");
        $('#nombreAtributos').focus();	
		
		
		goValidation = false;
		
	
	
	
	}
	

	
	
	
	
	if(goValidation){
		axios.post(base_url() + "app/Atributos/editarAtributo",{
			idDAtr:id,
			nombreAtributo:"",
			nombreDAtr:nombre,
			idAtr:idAtributito,
			estatus:"",
			accion:accion

		
		
		
		
		})
		.then(({data})=>{
			
			if(data.resultado){
				
				 toastr["success"](data.mensaje);
				 
				 $("#ModalEditar").modal('hide');
				 
				 listaAtributos();
				 
				 window.location.reload();
				 
			
			
			
			
			
			}else{
				
				console.log("entre en 2 soy falso");
				
				
				 toastr["warning"]("No hay modificaciones");
                habilitaCampos();
			
			
			
			}
		
		
		
		
		
		
		
		})
		.catch(error =>{
			
			
			console.log(error);
		
		
		
		})
	
	
	
	
	
	
	}else{
		
		console.log("Falta un dato");
	
	
	
	
	
	}
	
	
	



}




