// JavaScript Document

$(document).ready(()=>{
	
	
	
	let nombresuc = $( "#idSucG option:selected").text();
	let nombreanio = $( "#idAnioG option:selected").text();
	let nombremes = $( "#idMesG option:selected").text();
	
	
	
	let idsuc = $( "#idSucG").val();
	let idanio = $( "#idAnioG").val();
	let idMes = $( "#idMesG").val();
	
	console.log(nombresuc, " <-sucursal ", nombreanio, " <- anio", nombremes);
	console.log( " Valor suc ", idsuc, " Valor anio", idanio, " Valor mes", idMes);

	
	generaGrafica(idsuc, idMes, idanio, nombresuc,nombremes,nombreanio);
	
//termina document ready	
	
});





function quitaErroresCamposVacios(){
    $("#erroridSucG").hide();
    $("#erroridAnioG").hide();
    $('#erroridMesG').hide();
  	
}

function botonGraficaMajor(){
	
	quitaErroresCamposVacios();
	
	let goValidation = true;
	let nombresuc = $( "#idSucG option:selected").text();
	let nombreanio = $( "#idAnioG option:selected").text();
	let nombremes = $( "#idMesG option:selected").text();
	
	
	
	let idsuc = $( "#idSucG").val();
	let idanio = $( "#idAnioG").val();
	let idMes = $( "#idMesG").val();
	
	
	console.log(nombresuc, " <-sucursal ", nombreanio, " <- anio", nombremes);
	console.log( " Valor suc ", idsuc, " Valor anio", idanio, " Valor mes", idMes);
	
	$("#container").html("");
	
	
	
    if("Selecciona" == idsuc){
        $('#erroridSucG').show();
        $('#erroridSucG').html("Elige una sucursal");
        $('#idSucG').focus();	
        goValidation = false;
        
    }
	 if("Selecciona" == idanio){
        $('#erroridAnioG').show();
        $('#erroridAnioG').html("Elige un año");
        $('#idAnioG').focus();	
        goValidation = false;
        
    }
	if("0" == idMes){
        $('#erroridMesG').show();
        $('#erroridMesG').html("Elige un mes");
        $('#idMesG').focus();	
        goValidation = false;
        
    }
	
	if(goValidation){
		generaGrafica(idsuc, idMes, idanio, nombresuc,nombremes,nombreanio);
	}
	
}

function generaGrafica(idsuc, idmes, idanio, nombresuc,nombremes,nombreanio){
	
	
	
	
	$.ajax({
        "url": base_url()+"app/GraficasInicio/GraficasInicioMajor",
        "dataType": "JSON",
        "type":"POST",
        "data":{
            idSuc: idsuc, 
			idMes: idmes, 
			idAnio: idanio
        }
    })
    .done((data)=>{
		
        if(data.resultado){
			console.log(data.final);
			
			Highcharts.chart('container', {
			chart: {
				type: 'column'
			},
			title: {
				align: 'left',
				text: 'Productos más vendidos: <span id="nombreMesGrafica">'+nombresuc+'</span> <span id="nombreMesGrafica">'+nombremes+'</span> <span id="nombreAnioGrafica">'+nombreanio+'</span>'
			},
			subtitle: {
				align: 'left',
				text: 'Top 10'
			},
			accessibility: {
				announceNewData: {
					enabled: true
				}
			},
			xAxis: {
				type: 'category'
			},
			yAxis: {
				title: {
					text: 'Cantidades de productos'
				}

			},
			legend: {
				enabled: false
			},
			plotOptions: {
				series: {
					borderWidth: 0,
					dataLabels: {
						enabled: true,
						format: '{point.y}'
					}
				}
			},

			tooltip: {
				headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
				pointFormat: '<span style="color:{point.color}">{point.name}</span><br/>'
			},

			series: [
				{
					name: 'Producto',
					colorByPoint: true,
					data: data.final
				}
			],

		});	

        } else{
			
            //toastr["warning"]();
			
			$("#container").html(data.mensaje);
			
        }
    })
    .fail();
	
	
	
	
	
	
	
	
	
	

	
}// termina genera grafica


