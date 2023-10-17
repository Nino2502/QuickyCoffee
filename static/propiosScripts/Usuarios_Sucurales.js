$(document).ready(() => {
	
	
    let idTU= $("#idTU").val();
    
    if(idTU == 1){

		$("#SelectMajor").html(` 
	
		<label for="message-text"  id="majorSucu" class="col-form-label">Asignar Major:</label>
		 <select  id="selectEspecialidad" class="form-control select2-single"></select>
		 </div>
		 <small class="text-danger" id="errorEspecialidad"  style="display: none;"></small> 
	`)
		
     
        $("#ModalPerfil").hide()
    }
	
    else{
        
    }
});



function listaMajorsGeneral() {
	console.log("entrooaaaa")
	const IDTU= $("#idTU").val();
	$.ajax({
		url:
			base_url() +
			"app/Usuarios_Majors/verListaMajors/",
		dataType: "JSON",
	})
		.done((data) => {
			console.log("data", data)
			$("#selectEspecialidad").html("");
			let Idenficador = $("#acccion").val()

			
			if(Idenficador == "editar"){
				if (data.resultado == true) {

					$("#SelectMajor").find("select").append(`
					<option value="Seleccionar">--Seleccionar--</option>
					`);
					if(IDTU == 1){
						var ListaMG = data.ListaMajors
						
						$.each(ListaMG, function (i, o) {
							$("#SelectMajor")
								.find("select")
								.append(
									`
						<option value="` +
										o.idU +
										`">` +
										o.nombreU +". RFC:  " +(o.rfc != null ? o.rfc : " (NO REGISTRADO)")+
										`</option>
						`);
						});
					}
					
				} else {
					$("#SelectMajor").find("select").append(`
					<option value="Selecciona">--No existen categorias para mostrar--</option>
					`);
				}
			}if(Idenficador == "agregar"){
				if (data.resultado == true) {

					$("#SelectMajor").find("select").append(`
					<option value="Selecciona">--Selecciona--</option>
					`);
					if(IDTU == 1){
						var ListaMG = data.ListaMajors
						
						$.each(ListaMG, function (i, o) {
							$("#SelectMajor")
								.find("select")
								.append(
									`
						<option value="` +
										o.idU +
										`">` +
										o.nombreU +". RFC:  " +(o.rfc != null ? o.rfc : " (NO REGISTRADO)")+
										`</option>
						`);
						});
					}
					
				} else {
					$("#SelectMajor").find("select").append(`
					<option value="Selecciona">--No existen categorias para mostrar--</option>
					`);
				}
			}
		})
		.fail();
}



