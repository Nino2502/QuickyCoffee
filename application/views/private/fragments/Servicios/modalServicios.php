                                
                                  <!--Inicio modal tipo de pago-->

                            <!--<div class="modal fade " id="ModalAgregar"  tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">-->

                                <div class="modal fade" id="ModalAgregar" tabindex="-1" role="dialog"
                                aria-hidden="false">
                                <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
                                 <!-- <div class="modal fade" id="ModalAgregar" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="nombreModal"></h5>
                                                
                                               
                                                <input type="hidden" id="accion">
                                                <input type="hidden" id="idS">
                                                <input type="hidden" id="estatusModal">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="addRecordForm"> 

                                              
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

                                                        <div class="form-group">
                                                            <div class="row" id="selectDeAtributos" >

                                                            </div>
                                                        </div>


                                                        

                                                       


                                                        <!--
                                                                <div class="col-sm-4" id="divAtr1">
                                                                            <label>Atr1</label>
                                                                            <select class="form-control select2-multiple" multiple="multiple" id="selectCategoriaServicios">
                                                                                <option value="Selecciona">--Selecciona--</option>
                                                                                <option value="Selecciona">Atr1</option>
                                                                                <option value="Selecciona">Atr2</option>
                                                                                <option value="Selecciona">Atr1</option>
                                                                                <option value="Selecciona">Atr2</option>
                                                                                <option value="Selecciona">Atr1</option>
                                                                                <option value="Selecciona">Atr2</option>
                                                                            </select>
                                                                    <small class="text-danger" id="errorselectCategoriaServicios" style="display: none;"></small>
                                                                </div>

                                                                

                                                                <div class="col-sm-4" id="divAtr1">
                                                                            <label>Atr2</label>
                                                                            <select class="form-control select2-multiple" multiple="multiple" id="selectCategoriaServicios">
                                                                                <option value="Selecciona">--Selecciona--</option>
                                                                                <option value="Selecciona">Atr1</option>
                                                                                <option value="Selecciona">Atr2</option>
                                                                                
                                                                            </select>
                                                                    <small class="text-danger" id="errorselectCategoriaServicios" style="display: none;"></small>
                                                                </div>

                                                                <div class="col-sm-4" id="divAtr1">
                                                                            <label>Atr3</label>
                                                                            <select class="form-control select2-multiple" multiple="multiple" id="selectCategoriaServicios">
                                                                                <option value="Selecciona">--Selecciona--</option>
                                                                                <option value="Selecciona">Atr1</option>
                                                                                <option value="Selecciona">Atr2</option>
                                                                            </select>
                                                                    <small class="text-danger" id="errorselectCategoriaServicios" style="display: none;"></small>
                                                                </div>

                                                                <div class="col-sm-4" id="divAtr1">
                                                                            <label>Atr4</label>
                                                                            <select class="form-control select2-multiple" multiple="multiple" id="selectCategoriaServicios">
                                                                                <option value="Selecciona">--Selecciona--</option>
                                                                                <option value="Selecciona">Atr1</option>
                                                                                <option value="Selecciona">Atr2</option>
                                                                            </select>
                                                                    <small class="text-danger" id="errorselectCategoriaServicios" style="display: none;"></small>
                                                                </div>-->

                                                                
                                                       <!--  </div>termina select de atributos-->
                                                   <!-- </div> termina grupo de atributos -->


                                                    <div class="form-group">
                                                        <div class="row">

                                                            

                                                            <div class="col-sm-6" id="divUnidades">
                                                                <label> * Unidad</label>
                                                                <select class="form-control select2-single" id="unidad">
                                                                <option value="Selecciona">--Selecciona--</option>
                                                                <option value="Selecciona">Pieza</option>
                                                                <option value="Selecciona">Metro Cuadrado--</option>
                                                                <option value="Selecciona">Caja</option>      
                                                                </select>

                                                                <small class="text-danger" id="errorunidad" style="display: none;"></small>


                                                            </div>

                                                            <div class="col-sm-6">
                                                                <label for="message-text" class="col-form-label"> * Precio:</label>
                                                                <input type="text" class="form-control" id="precioServicios">
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
                                                                        <label for="message-text" class="col-form-label"> * Precio con impresión:</label>
                                                                        <input   type="text" class="form-control" id="precioServiciosConImpresion">
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
                                                                        <select class="form-control select2-single" id="politicas">
                                                                        <option value="Selecciona">--Selecciona--</option>
                                                                        <option value="Selecciona">Impresos papelería</option>
                                                                        <option value="Selecciona">Sublimaicion</option>
                                                                        <option value="Selecciona">Caja</option>   
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label for="message-text" class="col-form-label"> Inventario Min:</label>
                                                                <input type="number" value="0" class="form-control" id="inventarioMinimo">
                                                                <small class="text-danger" id="errorinventarioMinimo" style="display: none;"></small>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <label for="message-text" class="col-form-label"> Cantidad mayoreo:</label>
                                                                <input type="number" value="0" class="form-control" id="inventarioInicial">
                                                                <small class="text-danger" id="errorinventarioInicial" style="display: none;"></small>
                                                            </div>
                                                        </div>
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
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-success" id="btnEnviar" onclick="traeCampos()"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!--Fin modal-->



<!-- Modal borrar -->

                                <div class="modal fade" id="borrarModal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="tituloModalBorrar"></h5>
                                                
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="cuerpoModalBorrar">
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-success" id="btnModalBorrar" onclick="btnModalBorrar()">Borrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- termina Modal borrar -->
