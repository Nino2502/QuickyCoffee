$(document).ready(()=>{


    //alert("ya estamos aqui");
    $("#datatable").find("tbody").html("");
    
	listaHistorico();
	

	
	
	
	
	
	
	
	
    
       
    })
    
    
    function listaHistorico(){
    
    
        axios(base_url()+"app/HistoricoInventario/verHistoricoInventario")
        .then(({data})=>{
    
            if(data.resultado){
    
                $("#despliegueTabla").html(`
                <table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Descripcion</th>
 							<th>Usuario</th>
							
                            
                            
                        </tr>
                    </thead>
                    <tbody>
                
                    </tbody>
                </table>`
                );
				
					let conteo =1;
    
                $.each(data.Historico, function(i,o){
				
    
                    $("#datatable").find("tbody").append(`
                        <tr id="tr-`+ o.idHI+`">
                            <td>`+ conteo+`</td>
                            <td>`+ o.fecha+`</td>
							<td class="text-wrap" style="width: 25rem;">`+ o.descripcion+`</td>
							<td>`+ o.nombreU+`</td>
                            
                            
                        </tr>`
                    );
					
					conteo ++;
    
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
    
    
    