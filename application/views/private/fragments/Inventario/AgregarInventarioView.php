
           
<div class="card">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs " role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
                    aria-controls="first" aria-selected="true"><h3>Agregar Inventario</h3></a>
            </li>
            
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            
            
            <!-- inicia el primer tab-->
            
            <div class="tab-pane fade show active" id="first" role="tabpanel"
                aria-labelledby="first-tab">

                <div class="d-flex justify-content-between">

                    <button type="button" class="btn btn-primary mr-3 mb-4" onclick=" insertaServicios()" >
                        + Guardar
                        
                    </button>

                    <button type="button" class="btn btn-info mr-3 mb-4" onclick=" regresar()" >
                        Regresar
                        
                    </button>

                </div>


                                <div class="row mb-4">
                                    <div class="col-12 mb-4">
                                        <div class="card">
                                            <div class="card-body" id="despliegueTabla">



                                    <form id="addRecordForm"> 
                                                <input type="hidden" value="Agregar" id="accion">
                                                <input type="hidden" value="0" id="idS">
                                                <input type="hidden" value="1" id="estatusModal">

                                                
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="message-text"
                                                    class="col-form-label"> * Nombre de Servicio:</label>
                                                <input type="text" class="form-control" id="nombreServicios" placeholder="Escribe un nombre para el servicio">
                                                <small class="text-danger" id="errornombreServicios" style="display: none;"></small>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="message-text" class="col-form-label"> * Descripción:</label>
                                                <textarea class="form-control" rows="3" id="descripcionServicios"></textarea>
                                                <small class="text-danger" id="errordescripcionServicios" style="display: none;"></small>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                            <div class="col-sm-6" id="divSelectCategoriasServicios">
                                                    <label> * Categorías de Servicios</label>
                                                    <select onchange="muestraAtributosSC()"  class="form-control select2-single" id="selectCategoriaServicios">
                                                        <!-- onchange="muestraAtributosSC()"-->
                                                            
                                                    </select>
                                                    <small class="text-danger" id="errorselectCategoriaServicios" style="display: none;"></small>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="message-text" class="col-form-label"> * Sku:</label>
                                                    <input type="text" class="form-control" id="sku">
                                                    <small class="text-danger" id="errorsku" style="display: none;"></small>
                                                </div>
                                            </div>
                                        </div>

                                        <!--<div class="form-group">
                                            <div class="row" id="selectDeAtributos" style="display: none;">-->

                                            <?php $this->load->view('private/fragments/Servicios/Atributos_fragment_view',''); ?>

                                            
                                         
                                                    
                                            <!--  </div>termina select de atributos-->
                                        <!-- </div> termina grupo de atributos -->


                                        <div class="form-group">
                                            <div class="row">

                                                

                                                <div class="col-sm-6" id="divUnidades">
                                                    <label> * Unidad</label>
                                                    <select class="form-control select2-single" id="unidad">
                                                        <option value="Selecciona">--Selecciona--</option>
                                                        <option value="1">Pieza</option>
                                                        <option value="2">Caja</option>
                                                        <option value="3">Millar</option>
                                                        <option value="4">Metro Cuadrado</option>      
                                                    </select>

                                                    <small class="text-danger" id="errorunidad" style="display: none;"></small>


                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="message-text" class="col-form-label"> * Precio:</label>
                                                    <input type="number" value="0" class="form-control" id="precioServicios">
                                                    <small class="text-danger" id="errorprecioServicios" style="display: none;"></small>
                                                </div>
                                                
                                        </div>

                                        <div class="form-group mt-3">

                                            <div class="row">

                                                    <div class="col-sm-6">
                                                        <div class="custom-control custom-checkbox mb-4">
                                                            <input onchange="cambioCheckImpresion()" type="checkbox" class="custom-control-input" id="imprimible">
                                                            <label class="custom-control-label" for="imprimible">Es Imprimible</label>
                                                        </div>

                                                        <div>

                                                        <div id="divPrecioImpresion" style="display: none;">
                                                            <label for="message-text" class="col-form-label"> * Precio de impresión:</label>
                                                            <input   type="text" value="0" class="form-control" id="precioServiciosConImpresion">
                                                            <small class="text-danger" id="errorprecioServiciosConImpresion" style="display: none;"></small>
                                                        </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="custom-control custom-checkbox mb-4">
                                                        <input onchange="cambioCheckPoliticas()" type="checkbox" class="custom-control-input" id="politicas">
                                                        <label class="custom-control-label" for="politicas">Tiene politicas</label>
                                                    </div>

                                                        <div class="col-sm-6" id="divPoliticas" style="display: none;">
                                                            <label> * Politicas</label>
                                                            <select class="form-control select2-single" id="selectPoliticas">
                                                            <option value="Selecciona">--Selecciona--</option>
                                                            <option value="1">Impresos papelería</option>
                                                            <option value="2">Sublimaicion</option>
                                                            <option value="3">Caja</option>   
                                                            </select>
                                                        </div>
                                                        <small class="text-danger" id="errorselectPoliticas" style="display: none;"></small>
                                                    </div>
                                            </div>
                                        </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                

                                                <div class="col-sm-6">
                                                    <label for="message-text" class="col-form-label"> Cantidad mayoreo:</label>
                                                    <input type="number" value="0" class="form-control" id="cantidadMayoreo">
                                                    <small class="text-danger" id="errorcantidadMayoreo" style="display: none;"></small>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="message-text" class="col-form-label"> Precio Mayoreo:</label>
                                                    <input type="number" value="0" class="form-control" id="precioMayoreo">
                                                    <small class="text-danger" id="errorprecioMayoreo" style="display: none;"></small>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="message-text" class="col-form-label"> Inventario Min:</label>
                                                    <input type="number" value="0" class="form-control" id="inventarioMinimo">
                                                    <small class="text-danger" id="errorinventarioMinimo" style="display: none;"></small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group" id="divTags">

                                            <h5 class="mb-4">Palabras clave</h5>                                                       
                                            <input data-role="tagsinput" type="text" id="palabrasClave">
                                            <small class="text-danger" id="errorpalabrasClave" style="display: none;"></small>
                                                                                                                                                    
                                        </div>







                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Imagen</span>
                                                </div>

                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="img">
                                                    <label class="custom-file-label" for="customFile">Elegir imagen</label>
                                                </div>
                                            </div>
                                            <small class="text-danger" id="errorimg" style="display: none;"></small>

                                        </div>
                                        <!-- Comienza select de categorias
                                        <div class="form-group" id="divSelectCategoriasServicios">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label> * Categorías de Servicios</label>
                                                            <select class="form-control select2-single" id="selectCategoriaServicios">
                                                                    
                                                            </select>
                                                        </div>
                                                    </div>
                                            <small class="text-danger" id="errorcategoriaServicios" style="display: none;"></small>
                                        </div>
                                            Termina select de categorias-->

                                        </form>
                                              
                                </div>



                            </div>
                        </div>
                    </div>


                    <div class="d-flex justify-content-between">

                        <button type="button" class="btn btn-primary mr-3 mb-4" onclick=" insertaServicios()" >
                            + Guardar
                            
                        </button>

                        <button type="button" class="btn btn-info mr-3 mb-4" onclick=" regresar()" >
                            Regresar
                            
                        </button>

                    </div>

    

            </div>

            <!--termina aqui, inicia segundo tab-->
            
            
            
        </div>
    </div>
    <!--termina cardBody-->
</div>







