<input id="cortePermitido"  type="hidden"  value="">
<div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs " role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
                                aria-controls="first" aria-selected="true"><h3>Corte caja</h3></a>
                        </li>
                       
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        
                        
                        <!-- inicia el primer tab-->
                        
                        <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                         
                           
                            <div class="row">
                                <div class="col-12 col-12 mb-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                        <div class="row">
                                            
                                            <div class="form-group mb-4 col-4">
                                            <h5 class="mb-4" id="cajaTipo">Caja actual: computadora 1</h5>
                                                <label>Fecha corte de caja</label>
                                                <input type="text" class="form-control" id="corteFecha">
                                            </div>
                                            
                                                    <div class="form-group pt-5 col-6">
                                                    <button type="button" class="btn btn-primary mr-3 mb-4" id="btnConsultarCorte" onclick="consultaCorte()" >
                                                                Consultar corte
                                                            </button>
                                                            <button type="button" class="btn btn-primary mr-3 mb-4" id="btnRestablecer"  >
                                                                restablecer
                                                            </button>
                                                    </div>
                                                    <div class="form-group pt-5 col-6">
                                                            <h5 id="totalCorte" class="mb-4">Total corte: </h5>
                                                    </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                             </div>
                            
                                <div class="row mb-4">
                                    <div class="col-12 mb-4">
                                        <div class="card">
                                            <div class="card-body" id="despliegueTabla">
                                            <table id="datatable" class="table table-striped table-centered dt-responsive nowrap table-vertical" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center">Tipo cambio</th>
                                                            <th style="text-align: center">$</th>
                                                            <th style="text-align: center">Cantidad</th>
                                                            <th style="text-align: center">Subtotal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                             <tr class="producto-1">
                                                                <td style="text-align: center">Moneda</td>
                                                                <td style="text-align: center">$0.50</td>
                                                                <td style="text-align: center"> <input type="number" value="0" min="0" class="cantidad"></td>
                                                                <td style="text-align: center" class="subtotal"></td>
                                                            </tr>
                                                            <tr class="producto-2">
                                                                <td style="text-align: center">Moneda</td>
                                                                <td style="text-align: center">$1</td>
                                                                <td style="text-align: center"><input type="number" value="0" min="0" class="cantidad"></td>
                                                                <td style="text-align: center" class="subtotal"></td>
                                                            </tr>
                                                            <tr class="producto-3">
                                                                <td style="text-align: center">Moneda</td>
                                                                <td style="text-align: center">$2</td>
                                                                <td style="text-align: center"><input type="number" value="0" min="0" class="cantidad"></td>
                                                                <td style="text-align: center" class="subtotal"></td>
                                                            </tr>
                                                            <tr class="producto-4">
                                                                <td style="text-align: center">Moneda</td>
                                                                <td style="text-align: center">$5</td>
                                                                <td style="text-align: center"><input type="number" value="0" min="0" class="cantidad"></td>
                                                                <td style="text-align: center" class="subtotal"></td>
                                                            </tr>

                                                            <tr class="producto-5">
                                                                <td style="text-align: center">Moneda</td>
                                                                <td style="text-align: center">$10</td>
                                                                <td style="text-align: center"><input type="number" value="0" min="0" class="cantidad"></td>
                                                                <td style="text-align: center" class="subtotal"></td>
                                                            </tr>

                                                            <tr class="producto-6">
                                                                <td style="text-align: center">Billete</td>
                                                                <td style="text-align: center">$20</td>
                                                                <td style="text-align: center"><input type="number" value="0" min="0" class="cantidad"></td>
                                                                <td style="text-align: center" class="subtotal"></td>
                                                            </tr>
                                                            
                                                            <tr class="producto-7">
                                                                <td style="text-align: center">Billete</td>
                                                                <td style="text-align: center">$50</td>
                                                                <td style="text-align: center"><input type="number" value="0" min="0" class="cantidad"></td>
                                                                <td style="text-align: center" class="subtotal"></td>
                                                            </tr>

                                                            <tr class="producto-8">
                                                                <td style="text-align: center">Billete</td>
                                                                <td style="text-align: center">$100</td>
                                                                <td style="text-align: center"><input type="number" value="0" min="0" class="cantidad"></td>
                                                                <td style="text-align: center" class="subtotal"></td>
                                                            </tr>

                                                            <tr class="producto-9">
                                                                <td style="text-align: center">Billete</td>
                                                                <td style="text-align: center">$200</td>
                                                                <td style="text-align: center"><input type="number" value="0" min="0" class="cantidad"></td>
                                                                <td style="text-align: center" class="subtotal"></td>
                                                            </tr>

                                                            <tr class="producto-10">
                                                                <td style="text-align: center">Billete</td>
                                                                <td style="text-align: center">$500</td>
                                                                <td style="text-align: center"><input type="number" value="0" min="0" class="cantidad"></td>
                                                                <td style="text-align: center" class="subtotal"></td>
                                                            </tr>

                                                            <tr class="producto-11">
                                                                <td style="text-align: center">Billete</td>
                                                                <td style="text-align: center">$1000</td>
                                                                <td style="text-align: center"><input type="number" value="0" min="0" class="cantidad"></td>
                                                                <td style="text-align: center" class="subtotal"></td>
                                                            </tr>

                                                            
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                    <th colspan="3">Total</th>
                                                    <td style="text-align: center" id="total">$0</td>
                                                    </tr>
                                                </tfoot>
                                                </table>
                                                            <button type="button" class="btn btn-primary mr-3 mb-4" id="btnCorteStart" onclick="corte_caja()" >
                                                                Registrar corte
                                                            </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                              

                        </div>
        
                        <!--termina aqui, inicia segundo tab-->
                        
                        
                       	
                    </div>
                </div>
                <!--termina cardBody-->
</div>