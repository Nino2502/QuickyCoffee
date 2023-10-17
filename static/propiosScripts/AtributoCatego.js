 $(document).ready(()=>{


        $.ajax({
            "url":base_url()+"app/Atributos/vistaPreviaAtributosDeCategoria",
            "dataType":"JSON",
            "type":"POST",
            "data":{
                id:"2"
            }
        })
        .done((data)=>{

        
            if(data.resultado){

                arraySeleccion = data.categorias;

                $.each(data.nombreAtributos, function(i,o){

                    $("#selectDeAtributos").append(`<div class="col-sm-4" id="divAtr1">
                    <label>`+o.nombreAtr+`</label>
                    <select class="form-control select2-multiple" multiple="multiple" id="atr-`+o.idAtr+`">
                        
                    </select>
                    <small class="text-danger" id="errorselectCategoriaServicios" style="display: none;"></small>
                </div>`);//termina append



                    // comienza detalle de atributo

                    $("#divSelectCategoriasServicios").find(`select #atr-`+o.idAtr).append(`
                    <option label="Elige;">Elige uno;</option>
                    `
                    );
                    $.getScript(base_url()+"static/plantilla/js/vendor/select2.full.js", function(){
                        console.log("cargo el archivito");
                       });
                
                     
                
                       $.getScript(base_url()+"static/plantilla/js/dore-plugins/select.from.library.js", function(){
                        console.log("cargo el archivito");
                       });
                





                    $.ajax({
                        "url":base_url()+"app/Atributos/vistaPreviaAtr",
                        "dataType":"JSON",
                        "type":"POST",
                        "data":{
                            id:o.idAtr
                        }
                    })
                    .done((data2)=>{
                        if(data2.resultado){

                            

                            $.each(data2.atributos, (ia,a)=>{

                                $("#atr-"+o.idAtr).append(`
                                
                                <option value="`+a.idDAtr+`">`+a.nombreDAtr+`</option>
                            `);

                            })


    
                            
                            
                        }
                        
                
                    })
                    .fail();


                    // termina detalle de atributo


                    


    
                });
            }

  
          
            
    
        })
        .fail();




        



});