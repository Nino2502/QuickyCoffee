$(document).ready(() => {
	//listaPermisos();
	get_tipoUsuario();
	get_Permisos();

	$("#despliegueTabla").find("tbody").html("");

});

function get_tipoUsuario() {

    $.ajax({
        url	: base_url() + "daniw/Permisos/verUsuario",
		dataType: "JSON",
	})
    .done(function (a) {
		var count = 0;

		$("#accordion").html("");
		$.each(a.Permisos, function(i, o) {

			var tablaId = 'tabla-' + o.idTU; // Generar un identificador único para cada tabla
			var collapseId = 'collapse-' + o.idTU; // Generar un identificador único para cada div collapse

			// Generar la clase correspondiente para cada collapse
			var collapseClass = 'collapse';
			if (count === 0) {
				collapseClass += ' show';
			}
			
			$("#accordion").append(
				`<input type="hidden" class="idTU" value="`+ o.idTU +`">

				<div class="card d-flex mb-3">
					<div class="d-flex flex-grow-1 min-width-zero" data-toggle="collapse" data-target="#` + collapseId + `" aria-expanded="true" aria-controls="` + collapseId + `">
						<button class="card-body btn btn-empty list-item-heading text-left text-one" onclick="get_Permisos(` + o.idTU + `)">Tipo de usuario: ` + o.nombreTU + `</button>
					</div>
					<div id="collapse-` + o.idTU + `" class="` + collapseClass + `" data-parent="#accordion">
						<div class="card-body accordion-content">

							<div class="row mb-4">
								<div class="col-12 mb-4">
									<div class="card">
										<div class="card-body" id="` + tablaId + `"></div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>`
			);
			// Incrementar la variable contadora
			count++;
		});

		// Llamar a get_Permisos para el primer valor de idTU
        get_Permisos($(".idTU:first-child").val());
	})
    .fail(function() {
		console.log("Faltan datos dentro del formulario");
	});
}

function get_Permisos(idTU) {
	// Generar el identificador único para la tabla correspondiente al idTU
	var tablaId = '#tabla-' + idTU;
	//console.log(tablaId);

    $.ajax({
        url	: base_url() + "daniw/Permisos/getPermisos",
        type: "post",
        data: { idTU: idTU},
        dataType: "JSON",
	})

	.done(function (a) {

		$(tablaId).html(`
				<table id="datatablePermisos" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<th>Tipo de perfil</th>
							<th>Módulos</th>
							<th>Permisos</th>
							
							<th style="text-align: center">Borrar</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>`
			);

		// Borrar la tabla anterior antes de agregar la nueva tabla
		// $(tablaId).find("table").html();
		// Actualizar el contenido de la tabla correspondiente
		// $("#datatablePermisos").find("tbody").html("");
		// $("#tablaId").find("table").html("");

		$.each(a.Permisos, function(i, o) {

			$(tablaId).find("tbody").append(
				`<tr id="tr-` + o.idTU + `">
					<td>` + (o.nombreTP ? o.nombreTP : "Sin tipo de perfil") + ` </td>
					<td>` + o.nombre_mod + ` </td>
					<td>` + (o.nombre_sec ? o.nombre_sec : "Sin sección") + ` </td>
					<td align="center">
						<a href="#" onclick="modalBorrar(` + o.idTU + `,` + o.idP + `,` + o.modulo_id + `,` + o.seccion_id +`,'` + o.nombre_sec + `')">
							<i class="fas fa-trash fa-2x"></i>
						</a>
					</td>
				</tr>`
			);
			//console.log(tablaId);
		})
	})
	.fail(function() {
		console.log("Faltan datos dentro del formulario");
	});

}

// Disable, disable
function desabilitaCampos(){
	$("#btnEnviar, #nombreColaborador,#apellidosColaborador,#telefonoColaborador,#correoColaborador,#rfcColaborador,#contrasenaColaborador,#contrasenaNColaborador").attr("disabled", "disabled");
}

// Disable
function habilitaCampos() {
	$("#btnEnviar, #nombreColaborador,#apellidosColaborador,#telefonoColaborador,#correoColaborador,#rfcColaborador,#contrasenaColaborador,#contrasenaNColaborador").remove("disabled");
}

function insertaPermisos() {

	quitaErroresCamposVacios(idTU);
	//let idTU 	= $("#idTU").val();
	let usuario = $("#selectUsuario").val();
	let perfil 	= $("#selectPerfil").val();
	let modulo 	= $("#selectModulos").val();
	let seccion	= $("#selectSeccion").val();
	let accion  = $("#accion").val();

	let goValidation = true;

	// --------------------------- Empiezan validaciones ---------------------------

	if(usuario == "Selecciona") {
		$("#errorUsuario").show();
		$("#errorUsuario").html("Seleccione un usuario");
		$("#selectUsuario").focus();
		goValidation = false;
		habilitaCampos();
	}

	if (usuario == 3){
		if(perfil == "Selecciona") {
			$("#errorPerfil").show();
			$("#errorPerfil").html("Seleccione un perfil");
			$("#selectPerfil").focus();
			goValidation = false;
			habilitaCampos();
		}
	}

	if(modulo == "Selecciona") {
		$("#errorModulo").show();
		$("#errorModulo").html("Seleccione un módulo");
		$("#selectModulos").focus();
		goValidation = false;
		habilitaCampos();
	}

	if(seccion == "null") {
		goValidation = true;
	}else if(seccion == "Selecciona") {
		$("#errorSeccion").show();
		$("#errorSeccion").html("Seleccione una sección");
		$("#selectSeccion").focus();
		goValidation = false;
		habilitaCampos();
	}

	if (accion == "editar") {
		estatus = $("#estatusModal").val();
	}

	// --------------------------- Finalizan validaciones ---------------------------

	// let formbody = {};
	// const IDUTU= $("#idTU").val();

	if (goValidation) {
		axios.post(base_url() + "daniw/Permisos/insertaPermisos", {
			idTU		: usuario,
			idP			: perfil,
			modulo_id	: modulo,
			seccion_id	: seccion,
			accion		: accion
		})
		.then(({ data }) => {
        if (data.resultado) {
          	toastr["success"](data.mensaje);
			$("#ModalAgregar").modal("hide");
			get_tipoUsuario();
			//get_Permisos(idTU);
			habilitaCampos();

        } else {
			toastr["warning"](data.mensaje);
			habilitaCampos();
		}

      })
      .catch((error) => {
		//console.log(error);
		toastr["error"]("Permiso duplicado"); 
	});
  	} else {
    	console.log("faltan datos");
  	}

}

function agregar() {
	quitaErroresCamposVacios();
	listaTipoUsuario();
	listaTipoPerfil();
	listaTipoModulos();
	listaTipoSecciones();

	$("#btnEnviar").html("Agregar");
	$("#ModalAgregar").modal("show");
	$("#nombreModal").html("Agregar permisos");
	$("#selectUsuario").val("");
	$("#selectPerfil").val("");
	$("#selectModulos").val("");
	$("#selectSeccion").val("");
	$("#accion").val("Agregar");
	$("#idTU").val("0");

	!function(a){"use strict";function b(b,c){this.itemsArray=[],this.$element=a(b),this.$element.hide(),this.isSelect="SELECT"===b.tagName,this.multiple=this.isSelect&&b.hasAttribute("multiple"),this.objectItems=c&&c.itemValue,this.placeholderText=b.hasAttribute("placeholder")?this.$element.attr("placeholder"):"",this.inputSize=Math.max(1,this.placeholderText.length),this.$container=a('<div class="bootstrap-tagsinput"></div>'),this.$input=a('<input type="text" placeholder="'+this.placeholderText+'"/>').appendTo(this.$container),this.$element.before(this.$container),this.build(c)}function c(a,b){if("function"!=typeof a[b]){var c=a[b];a[b]=function(a){return a[c]}}}function d(a,b){if("function"!=typeof a[b]){var c=a[b];a[b]=function(){return c}}}function e(a){return a?i.text(a).html():""}function f(a){var b=0;if(document.selection){a.focus();var c=document.selection.createRange();c.moveStart("character",-a.value.length),b=c.text.length}else(a.selectionStart||"0"==a.selectionStart)&&(b=a.selectionStart);return b}function g(b,c){var d=!1;return a.each(c,function(a,c){if("number"==typeof c&&b.which===c)return d=!0,!1;if(b.which===c.which){var e=!c.hasOwnProperty("altKey")||b.altKey===c.altKey,f=!c.hasOwnProperty("shiftKey")||b.shiftKey===c.shiftKey,g=!c.hasOwnProperty("ctrlKey")||b.ctrlKey===c.ctrlKey;if(e&&f&&g)return d=!0,!1}}),d}var h={tagClass:function(a){return"label label-info"},itemValue:function(a){return a?a.toString():a},itemText:function(a){return this.itemValue(a)},itemTitle:function(a){return null},freeInput:!0,addOnBlur:!0,maxTags:void 0,maxChars:void 0,confirmKeys:[13,44],delimiter:",",delimiterRegex:null,cancelConfirmKeysOnEmpty:!0,onTagExists:function(a,b){b.hide().fadeIn()},trimValue:!1,allowDuplicates:!1};b.prototype={constructor:b,add:function(b,c,d){var f=this;if(!(f.options.maxTags&&f.itemsArray.length>=f.options.maxTags)&&(b===!1||b)){if("string"==typeof b&&f.options.trimValue&&(b=a.trim(b)),"object"==typeof b&&!f.objectItems)throw"Can't add objects when itemValue option is not set";if(!b.toString().match(/^\s*$/)){if(f.isSelect&&!f.multiple&&f.itemsArray.length>0&&f.remove(f.itemsArray[0]),"string"==typeof b&&"INPUT"===this.$element[0].tagName){var g=f.options.delimiterRegex?f.options.delimiterRegex:f.options.delimiter,h=b.split(g);if(h.length>1){for(var i=0;i<h.length;i++)this.add(h[i],!0);return void(c||f.pushVal())}}var j=f.options.itemValue(b),k=f.options.itemText(b),l=f.options.tagClass(b),m=f.options.itemTitle(b),n=a.grep(f.itemsArray,function(a){return f.options.itemValue(a)===j})[0];if(!n||f.options.allowDuplicates){if(!(f.items().toString().length+b.length+1>f.options.maxInputLength)){var o=a.Event("beforeItemAdd",{item:b,cancel:!1,options:d});if(f.$element.trigger(o),!o.cancel){f.itemsArray.push(b);var p=a('<span class="tag '+e(l)+(null!==m?'" title="'+m:"")+'">'+e(k)+'<span data-role="remove"></span></span>');if(p.data("item",b),f.findInputWrapper().before(p),p.after(" "),f.isSelect&&!a('option[value="'+encodeURIComponent(j)+'"]',f.$element)[0]){var q=a("<option selected>"+e(k)+"</option>");q.data("item",b),q.attr("value",j),f.$element.append(q)}c||f.pushVal(),(f.options.maxTags===f.itemsArray.length||f.items().toString().length===f.options.maxInputLength)&&f.$container.addClass("bootstrap-tagsinput-max"),f.$element.trigger(a.Event("itemAdded",{item:b,options:d}))}}}else if(f.options.onTagExists){var r=a(".tag",f.$container).filter(function(){return a(this).data("item")===n});f.options.onTagExists(b,r)}}}},remove:function(b,c,d){var e=this;if(e.objectItems&&(b="object"==typeof b?a.grep(e.itemsArray,function(a){return e.options.itemValue(a)==e.options.itemValue(b)}):a.grep(e.itemsArray,function(a){return e.options.itemValue(a)==b}),b=b[b.length-1]),b){var f=a.Event("beforeItemRemove",{item:b,cancel:!1,options:d});if(e.$element.trigger(f),f.cancel)return;a(".tag",e.$container).filter(function(){return a(this).data("item")===b}).remove(),a("option",e.$element).filter(function(){return a(this).data("item")===b}).remove(),-1!==a.inArray(b,e.itemsArray)&&e.itemsArray.splice(a.inArray(b,e.itemsArray),1)}c||e.pushVal(),e.options.maxTags>e.itemsArray.length&&e.$container.removeClass("bootstrap-tagsinput-max"),e.$element.trigger(a.Event("itemRemoved",{item:b,options:d}))},removeAll:function(){var b=this;for(a(".tag",b.$container).remove(),a("option",b.$element).remove();b.itemsArray.length>0;)b.itemsArray.pop();b.pushVal()},refresh:function(){var b=this;a(".tag",b.$container).each(function(){var c=a(this),d=c.data("item"),f=b.options.itemValue(d),g=b.options.itemText(d),h=b.options.tagClass(d);if(c.attr("class",null),c.addClass("tag "+e(h)),c.contents().filter(function(){return 3==this.nodeType})[0].nodeValue=e(g),b.isSelect){var i=a("option",b.$element).filter(function(){return a(this).data("item")===d});i.attr("value",f)}})},items:function(){return this.itemsArray},pushVal:function(){var b=this,c=a.map(b.items(),function(a){return b.options.itemValue(a).toString()});b.$element.val(c,!0).trigger("change")},build:function(b){var e=this;if(e.options=a.extend({},h,b),e.objectItems&&(e.options.freeInput=!1),c(e.options,"itemValue"),c(e.options,"itemText"),d(e.options,"tagClass"),e.options.typeahead){var i=e.options.typeahead||{};d(i,"source"),e.$input.typeahead(a.extend({},i,{source:function(b,c){function d(a){for(var b=[],d=0;d<a.length;d++){var g=e.options.itemText(a[d]);f[g]=a[d],b.push(g)}c(b)}this.map={};var f=this.map,g=i.source(b);a.isFunction(g.success)?g.success(d):a.isFunction(g.then)?g.then(d):a.when(g).then(d)},updater:function(a){return e.add(this.map[a]),this.map[a]},matcher:function(a){return-1!==a.toLowerCase().indexOf(this.query.trim().toLowerCase())},sorter:function(a){return a.sort()},highlighter:function(a){var b=new RegExp("("+this.query+")","gi");return a.replace(b,"<strong>$1</strong>")}}))}if(e.options.typeaheadjs){var j=null,k={},l=e.options.typeaheadjs;a.isArray(l)?(j=l[0],k=l[1]):k=l,e.$input.typeahead(j,k).on("typeahead:selected",a.proxy(function(a,b){k.valueKey?e.add(b[k.valueKey]):e.add(b),e.$input.typeahead("val","")},e))}e.$container.on("click",a.proxy(function(a){e.$element.attr("disabled")||e.$input.removeAttr("disabled"),e.$input.focus()},e)),e.options.addOnBlur&&e.options.freeInput&&e.$input.on("focusout",a.proxy(function(b){0===a(".typeahead, .twitter-typeahead",e.$container).length&&(e.add(e.$input.val()),e.$input.val(""))},e)),e.$container.on("keydown","input",a.proxy(function(b){var c=a(b.target),d=e.findInputWrapper();if(e.$element.attr("disabled"))return void e.$input.attr("disabled","disabled");switch(b.which){case 8:if(0===f(c[0])){var g=d.prev();g.length&&e.remove(g.data("item"))}break;case 46:if(0===f(c[0])){var h=d.next();h.length&&e.remove(h.data("item"))}break;case 37:var i=d.prev();0===c.val().length&&i[0]&&(i.before(d),c.focus());break;case 39:var j=d.next();0===c.val().length&&j[0]&&(j.after(d),c.focus())}var k=c.val().length;Math.ceil(k/5);c.attr("size",Math.max(this.inputSize,c.val().length))},e)),e.$container.on("keypress","input",a.proxy(function(b){var c=a(b.target);if(e.$element.attr("disabled"))return void e.$input.attr("disabled","disabled");var d=c.val(),f=e.options.maxChars&&d.length>=e.options.maxChars;e.options.freeInput&&(g(b,e.options.confirmKeys)||f)&&(0!==d.length&&(e.add(f?d.substr(0,e.options.maxChars):d),c.val("")),e.options.cancelConfirmKeysOnEmpty===!1&&b.preventDefault());var h=c.val().length;Math.ceil(h/5);c.attr("size",Math.max(this.inputSize,c.val().length))},e)),e.$container.on("click","[data-role=remove]",a.proxy(function(b){e.$element.attr("disabled")||e.remove(a(b.target).closest(".tag").data("item"))},e)),e.options.itemValue===h.itemValue&&("INPUT"===e.$element[0].tagName?e.add(e.$element.val()):a("option",e.$element).each(function(){e.add(a(this).attr("value"),!0)}))},destroy:function(){var a=this;a.$container.off("keypress","input"),a.$container.off("click","[role=remove]"),a.$container.remove(),a.$element.removeData("tagsinput"),a.$element.show()},focus:function(){this.$input.focus()},input:function(){return this.$input},findInputWrapper:function(){for(var b=this.$input[0],c=this.$container[0];b&&b.parentNode!==c;)b=b.parentNode;return a(b)}},a.fn.tagsinput=function(c,d,e){var f=[];return this.each(function(){var g=a(this).data("tagsinput");if(g)if(c||d){if(void 0!==g[c]){if(3===g[c].length&&void 0!==e)var h=g[c](d,null,e);else var h=g[c](d);void 0!==h&&f.push(h)}}else f.push(g);else g=new b(this,c),a(this).data("tagsinput",g),f.push(g),"SELECT"===this.tagName&&a("option",a(this)).attr("selected","selected"),a(this).val(a(this).val())}),"string"==typeof c?f.length>1?f:f[0]:f},a.fn.tagsinput.Constructor=b;var i=a("<div />");a(function(){a("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput()})}(window.jQuery);
} // termina modal agrega seccion

function editar(id, nom, ape, correo, rfc, tel) {
	quitaErroresCamposVacios();
	listaTipoUsuario();
	listaTipoPerfil();
	listaTipoModulos();
	listaTipoSecciones();

	$("#btnEnviar").html("Actualizar");
	$("#accion").val("editar");
	$("#ModalAgregar").modal("show");
  	$("#nombreModal").html("Editar permisos: ");
	$("#nombreColaborador").val(nom);
	$("#apellidosColaborador").val(ape);
	$("#correoColaborador").val(correo);
	$("#rfcColaborador").val(rfc);
	$("#telefonoColaborador").val(tel);
	$("#idU").val(id);
	//$("#descripcionTipoContratacion").val("");

	// listatipocontratacion();EN UN FUTURO
	// habilitaCampos();

}


function listaTipoUsuario() {
	$.ajax({
		url: base_url() + "daniw/Permisos/getUsuarios",
		dataType: "JSON"
	})
	.done((data) => {
		$("#selectUsuario").html("");
		if (data.resultado) {
			$("#divSelectUsuario").find("select").append(`
				<option value="Selecciona">Selecciona Tipos de Usuarios</option>
			`);
			$.each(data.Usuarios, function (i, o) {
				$("#divSelectUsuario").find("select").append(
					`
					<option value="` + o.idTU + `">` + o.nombreTU +`</option>
					`
				);

			});
			
			// Ocultamos el select 
			$("#divSelectPerfil").hide();
		} else {
			$("#divSelectUsuario").find("select").append(
				`
				<option value="Selecciona">--No existen Tipos de Usuarios</option>
				`
			);
		}
	})
	.fail();
}

//agregar un controlador de eventos al primer select
$("#selectUsuario").change(function() {
	// validación
	if ($(this).val() == 3) {
	  //console.log('mostrando compo');
	  $("#divSelectPerfil").show();
	} else {
	  //console.log('campo oculto');
	  $("#divSelectPerfil").hide();
	}
});

function listaTipoPerfil() {
	$.ajax({
		url: base_url() + "daniw/Permisos/getPerfil",
		dataType: "JSON",
	})
	.done((data) => {
		$("#selectPerfil").html("");
		if (data.resultado) {
			$("#divSelectPerfil").find("select").append(`
				<option value="Selecciona">Selecciona un Tipo de Perfil</option>
			`);
			$.each(data.Perfil, function (i, o) {
				$("#divSelectPerfil").find("select").append(
					`
					<option value="` + o.idTP + `">` + o.nombreTP +`</option>
					`
				);

			});
		} else {
			$("#divSelectPerfil").find("select").append(
				`
				<option value="Selecciona">No existen Tipos de Perfil</option>
				`
			);
		}
	})
	.fail();
}

function listaTipoModulos() {
	$.ajax({
		url: base_url() + "daniw/Permisos/getModulos",
		dataType: "JSON",
	})
	.done((data) => {
		$("#selectModulos").html("");
		if (data.resultado) {
			$("#divSelectModulos").find("select").append(`
				<option value="Selecciona">Selecciona Módulo</option>
			`);
			$.each(data.Modulos, function (i, o) {
				$("#divSelectModulos").find("select").append(
					`
					<option value="` + o.modulo_id + `">` + o.nombre_mod +`</option>
					`
				);
			});
			// Agregar evento change al select del módulo
			$("#divSelectModulos").find("select").on("change", function() {
				var modulo_id = $(this).val();
				listaTipoSecciones(modulo_id);
			});
			
			deshabilitaSec(); 

			/* 
				if($('#selectModulos').val() != 'Selecciona') {
					$("#selectModulos").change(function() {
						habilitaSec();
						console.log('Hola');
					});  
				}else {
					console.log('Hola xdddd');
					deshabilitaSec(); 
				}
			*/

		} else {
			$("#divSelectModulos").find("select").append(
				`
				<option value="Selecciona">No existen Módulos</option>
				`
			);
		}
	})
	.fail();
}

function deshabilitaSec() {
	$("#selectSeccion").attr("disabled", "disabled");
}

function habilitaSec() {
	$("#selectSeccion").removeAttr("disabled"); 
}

//agregar un controlador de eventos al primer select
$("#selectModulos").change(function() {
	// validación
	if ($(this).val() != "Selecciona") {
	  //console.log('se activo el campo');
	  habilitaSec(); 
	} else {
	  //console.log('se desactivo el campo');
	  deshabilitaSec();
	}
});

function listaTipoSecciones(modulo_id) {

	$.ajax({
		url		 : base_url() + "daniw/Permisos/getSecciones",
		type	 : "POST",
		dataType : "JSON",
		data	 : {
			modulo_id : modulo_id
		}
	})
	.done((data) => {
		//console.log(data);
		$("#selectSeccion").html("");
		if (data.resultado) {
			$("#divSelectSeccion").find("select").append(`
				<option value="Selecciona">Selecciona Sección</option>
			`);
			var secciones = data.Secciones.filter(function (o) {
				return o.modulo_id == modulo_id;
			  });
			$.each(secciones, function (i, o) {
				$("#divSelectSeccion").find("select").append(
					`
					<option value="` + o.seccion_id + `">` + o.nombre_sec +`</option>
					`
				);

			});
		} else {
			$("#divSelectSeccion").find("select").append(
				`
				<option value="null">No existen Secciones</option>
				` 
			);
		}
	})
	.fail();
}

function modalBorrar(usuario, perfil, modulo, seccion, nombre) {
	$("#borrarModal").modal("show");
	$("#tituloModalBorrar").html("Borrar permiso: <strong>(" + nombre + ")</strong>");
	$("#cuerpoModalBorrar").html("¿Estas seguro que deseas borrar?: <strong>" + nombre + "</strong>");
	$("#btnModalBorrar").click(function() {
		btnModalBorrar(usuario, perfil, modulo, seccion);
	});
}

function btnModalBorrar(usuario, perfil, modulo, seccion) {
	axios.post(base_url() + "daniw/Permisos/eliminaPermisos", {  
	  idTU: usuario,
	  idP: perfil,
	  modulo_id: modulo,
	  seccion_id: seccion
	})
	.then(({ data }) => {
	  if (data.resultado) {
		toastr["success"](data.mensaje);
		//$("#tr-" + id).remove();
		$("#borrarModal").modal("hide");
		//get_Permisos(idTU);
		get_tipoUsuario();
		habilitaCampos();
	  } else {
		toastr["warning"](data.mensaje);
	  }
	})
	.catch((error) => {
	  console.log(error);
	});
}

// function btnModalBorrar() {
// 	let id = $("#btnModalBorrar").attr("appData-Id");
// 	console.log(id);
  
// 	$.ajax({
// 	  url: base_url() + "daniw/Admin/bajaLogica",
// 	  dataType: "JSON",
// 	  type: "POST",
// 	  data: {idU: id}
// 	})
// 	.done((data) => {
// 	  if (data.resultado) {
// 		toastr["success"](data.mensaje);
// 		$("#tr-" + id).remove();
// 		$("#borrarModal").modal("hide");
// 		//listatipocontratacion();
// 	  } else {
// 		toastr["warning"](data.mensaje);
// 		$("#borrarModal").modal("hide");
// 	  }
// 	})
// 	.fail();
//   }

function quitaErroresCamposVacios() {
	$("#errorUsuario").hide();
	$("#errorPerfil").hide();
	$("#errorModulo").hide();
	$("#errorSeccion").hide();
}
