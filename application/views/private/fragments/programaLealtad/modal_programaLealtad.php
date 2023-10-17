<!-- Modal registrar nuevo puntos -->

<div class="modal fade" id="modalGestiopuntosADD" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloADDgestion">Registro de gestión de puntos</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="cuerpoModalADD">


                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputEmail4">Nombre del programa</label>
                        <input type="text" class="form-control" id="nombrePrograma" placeholder="Ingrese el nombre del programa">
                        <small class="text-danger" id="errornombrePrograma" style="display: none;"></small>
                    </div>

                    <div class="form-group col-md-6">

                        <label for="inputPassword4">Valor</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" step="0.1" class="form-control" id="valorPrograma">

                        </div>
                        <small class="text-danger" id="errorvalorPrograma" style="display: none;"></small>
                    </div>

                    <div class="form-group col-md-6">

                        <label for="inputPassword4">Porcentaje</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">%</span>
                            </div>
                            <input type="text" class="form-control" id="porcentajePrograma">

                        </div>
                        <small class="text-danger" id="errorporcentajePrograma" style="display: none;"></small>
                    </div>
                </div>


                <div class="mb-4">
                    <div class="custom-control custom-checkbox mb-4">
                        <input type="checkbox" class="custom-control-input" id="customCheckThis">
                        <label class="custom-control-label" for="customCheckThis">Aplica restricción fecha</label>
                    </div>
                </div>


                <div class="form-group mb-3" id="rangoFecha">
                    <label>Seleccione la fecha</label>
                    <div class="input-daterange input-group" id="datepicker">
                        <input type="text" class="input-sm form-control" name="start" id="startDate" placeholder="Start" />

                        <span class="input-group-addon"></span>
                        <input type="text" class="input-sm form-control" name="end" id="endDate" placeholder="End" />

                    </div>
                    <small class="text-danger" id="errorstartDate" style="display: none;"></small>
                    <small class="text-danger" id="errorendDate" style="display: none;"></small>


                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <span class="input-group-addon">Hora inicio</span>
                            <div class="input-group">
                                <input type="time" class="form-control form-control-sm" id="horaInicio" name="horaInicio">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary btn-sm mt-0" id="resetHoraInicio"><span class="simple-icon-reload"></span></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <span class="input-group-addon">Hora fin</span>
                            <div class="input-group ">
                                <input type="time" class="form-control form-control-sm" id="horaFin" name="horaFin">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary btn-sm mt-0" id="resetHoraFin"> <span class="simple-icon-reload"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3 text-center">
                        <small class="text-danger" id="errorFechas" style="display: none;"></small>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="registrarPrograma" onclick="registrarPrograma()">Registrar</button>
            </div>
        </div>
    </div>
</div>


<!-- termina Modal registrar nuevo puntos-->


<!-- Modal modificarPrograma -->

<div class="modal fade" id="modificarPrograma" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloADDgestion">Editando programa</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalEditar"></div>
            <div>
                <!-- -->

                <div class="modal-body form-group mb-3" id="rangoFechaEditar">

                    <label>Seleccione la fecha</label>
                    <div class="input-daterange input-group" id="datepicker">
                        <input type="text" class="input-sm form-control" name="start" id="startDateEDIT" placeholder="Start" />

                        <span class="input-group-addon"></span>
                        <input type="text" class="input-sm form-control" name="end" id="endDateEDIT" placeholder="End" />

                    </div>
                    <small class="text-danger" id="errorstartDate" style="display: none;"></small>
                    <small class="text-danger" id="errorendDate" style="display: none;"></small>


                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <span class="input-group-addon">Hora inicio</span>
                            <div class="input-group">
                                <input type="time" class="form-control form-control-sm" id="horaInicioEDIT" name="horaInicioEDIT">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary btn-sm mt-0" id="resetHoraInicio"><span class="simple-icon-reload"></span></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <span class="input-group-addon">Hora fin</span>
                            <div class="input-group ">
                                <input type="time" class="form-control form-control-sm" id="horaFinEDIT" name="horaFinEDIT">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary btn-sm mt-0" id="resetHoraFin"> <span class="simple-icon-reload"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3 text-center">
                        <small class="text-danger" id="erroFechasEdit" style="display: none;"></small>
                    </div>


                </div>

                <!-- -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="updatePrograma" onclick="updatePrograma()">Actualizar</button>
            </div>
        </div>
    </div>
</div>


<!-- Termina Modal modificarPrograma -->




<!-- Modal borrarPrograma -->

<div class="modal fade" id="borrarModalPrograma" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="titulomodalEliminarP">Eliminar programa</h5>
                                                
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="cuerpoModalBorrar">
                                                <h5 id="nombreProgramaBorrar">¿Está seguro de eliminar el programa?</h5>
                             
                                    
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-success" id="btnBorrarPrograma">Borrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<!-- termina Modal borrar -->
