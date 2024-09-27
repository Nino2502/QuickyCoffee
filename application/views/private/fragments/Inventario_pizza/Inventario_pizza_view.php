<input id="idTU" type="hidden" value="<?php echo ($_SESSION['idTipoUsuario']) ?>">
<!--
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
-->
<div class="card" id="cart_grafica">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs " role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="true">
                    <h3>Graficas Inventario coffee</h3>
                </a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <!-- inicia el primer tab-->
            <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                <button type="button" class="btn btn-primary mr-3 mb-4" onclick="regresar()">
                <i class="bi bi-arrow-left-short"> Regresar</i>
                </button>
            </div>
            <figure class="highcharts-figure">
                <div id="container"></div>
                <p class="highcharts-description">
                </p>
            </figure>

            <figure class="highcharts-figure">
                <div id="container33"></div>
                <p class="highcharts-description">
                </p>
            </figure>
        </div>
    </div>
</div>
<!-- ------------------------------------------- -->
<div class="card mt-3" id="Echo_porKevinElChido">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs " role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="true">
                    <h3>Inventario Coffee</h3>
                </a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <!-- inicia el primer tab-->
            <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                <button type="button" class="btn btn-primary mr-3 mb-4" onclick="agregarColaborador()">
                <i class="bi bi-plus-lg"> Agregar</i>
                </button>
                <button type="button" class="btn btn-primary mr-3 mb-4" onclick="creaGrafic_Echo_porKevinElChido()">
                <i class="bi bi-bar-chart"> Graficas</i>
                </button>
                <div class="row mb-4">
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-body" id="despliegueTablaAtributos">

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--termina aqui, inicia segundo tab-->
            <div style="display: flex; gap: 10px;">
                <div style="display: flex; justify-content: center; align-items: center; height: 100px; width: 425px; border: 2px solid #333; border-radius: 10px;">
                    <h1 style="font-size: 20px; font-weight: bold; color: #333; text-align: center;">Total del Inventario: <span id="total_inventario_1"></span>
                        <span id="boton_inventario"></span>
                        <!--    
                                <button type="button" class="btn btn-primary mr-3 mb-4" id="boton_inventario">Ayudar</button>
                            -->

                </div>
                <div style="flex: 1;"></div> <!-- Espacio flexible para distribuir el espacio vertical -->
                <div style="display: flex; justify-content: center; align-items: center; height: 100px; width: 425px; border: 2px solid #333; border-radius: 10px;">
                    <h1 style="font-size: 20px; font-weight: bold; color: #333; text-align: center;">Total de coffess vendidas: $<span id="total_inventario_2"></span>
                        <span id="pizzas_vendidas"></span>
                </div>
                <div style="flex: 1;"></div> <!-- Espacio flexible para distribuir el espacio vertical -->
                <div style="display: flex; justify-content: center; align-items: center; height: 100px; width: 425px; border: 2px solid #333; border-radius: 10px;">
                    <h1 style="font-size: 20px; font-weight: bold; color: #333; text-align: center;">Ganancia: $<span id="total_inventario_3"></span>
                        <span id="ganancia_neto"></span>
                </div>
            </div>

        </div>
    </div>
    <!--termina cardBody-->


    
</div>

<table border="1" cellpadding="10" cellspacing="0" width="100%" style="border-collapse: collapse; margin: 20px 0;">
        <tr>
            <td align="center" style="font-size: 20px; font-weight: bold; color: #333;">Gastos de Agua</td>
            <td align="right" style="font-size: 20px; font-weight: bold; color: #333; padding-right: 30px;">12000</td>
        </tr>
    </table>
    <table border="1" cellpadding="10" cellspacing="0" width="100%" style="border-collapse: collapse; margin: 20px 0;">
        <tr>
            <td align="center" style="font-size: 20px; font-weight: bold; color: #333;">Gasto de Gas</td>
            <td align="right" style="font-size: 20px; font-weight: bold; color: #333; padding-right: 30px;">4500</td>
        </tr>
    </table>
    <table border="1" cellpadding="10" cellspacing="0" width="100%" style="border-collapse: collapse; margin: 20px 0;">
        <tr>
            <td colspan="3" align="center" style="font-size: 20px; font-weight: bold; color: #333;">Cantidad de Coffee Vendidos x Dia</td>
        </tr>
        <tr>
            <td align="left" style="padding-left: 20px;">
                <?php
                    // Obtener la fecha de hoy en el formato deseado
                    echo date('d \d\e F \d\e Y');
                ?>
            </td>
            <td align="center" style="font-size: 24px; font-weight: bold; color: #333;">45</td>
            
        </tr>
    </table>

    <div class="container">


        <h4 class="mt-5">
            <center>

                Consulta Cantidad  De Producto Vendido
            </center>

        </h4>
   

    <div class="form-group mt-5">
						<div class="row">
						<div class="col-sm-3" id="divSelectCategoriasServicios">
							<label>  Sucursal</label>
							<select  class="form-control select2-single"  id="idSucG">
								<!-- onchange="muestraAtributosSC()"-->
								<option value="Selecciona">--Selecciona--</option>
								<option value="9">Matrix</option>
								
							
												<?php if($sucursales != null): ?>
								
													<?php foreach($sucursales as $suc ): ?>

													<option value="<?= $suc->idSuc ?>" <?= ($idSuc == $suc->idSuc ? "selected": "") ?> ><?= $suc->nombreSuc ?>  </option>
													<?php endforeach; ?>
							
												<?php endif; ?>
								

							</select>
							<small class="text-danger" id="erroridSucG" style="display: none;"></small>
						</div>
						<div class="col-sm-3" id="divSelectCategoriasServicios">
							<label>  Año</label>
							<select   class="form-control select2-single" id="idAnioG">
								<!-- onchange="muestraAtributosSC()"-->
								<option value="Selecciona">--Selecciona--</option>
								
								<?php 
								
								$hoy = date("Y");
								$anioInicio = 2021;
								 for($i=$anioInicio; $i<=$hoy; $i++ ){
									 
									echo '<option value="'.$i.'" '. ($hoy == $i ? "selected": "") .'>'.$i.'</option>';  
								 }
								?>
							</select>
							<small class="text-danger" id="erroridAnioG" style="display: none;"></small>
						</div>
							
							
						<div class="col-sm-3" id="divSelectCategoriasServicios">
							<p>
							  <label>  Mes</label>
							  <select   class="form-control select2-single"  id="idMesG">
							    <!-- onchange="muestraAtributosSC()"-->
							   
							    
							    <?php 
								
									$mes = date("m");

									$meses = array();
									   $meses[0] = "--Selecciona--";
									   $meses[1] = "Enero";
									   $meses[2] = "Febrero";
									   $meses[3] = "Marzo";
									   $meses[4] = "Abril";
									   $meses[5] = "Mayo";
									   $meses[6] = "Junio";
									   $meses[7] = "Julio";
									   $meses[8] = "Agosto";
									   $meses[9] = "Septiembre";
									   $meses[10] = "Octubre";
									   $meses[11] = "Noviembre";
									   $meses[12] = "Diciembre";


									for($i=0; $i<=12; $i++){
									  if (date("m") == $i){
										 echo "<option value=\"$i\" selected>$meses[$i]</option>";
									  }
									  else {
										 echo "<option value=\"$i\">$meses[$i]</option>";
									  }
									}
								
								?>
							    
							    
						      </select>
							  <small class="text-danger" id="erroridMesG" style="display: none;"></small></p>
							<p>&nbsp;</p>
						</div>
							
							
						<div class="col-sm-3" id="botonBuscar">
							
						  <button type="button" class="btn btn-primary mr-3 mb-4 mt-4" onclick="botonGraficaMajor()">
                                + Consultar
                                
                          </button>
							
						</div>	
							
							

					</div>

                    </div>              
                    

                    <div>

                                <div id="grafica_lineal" style="width: 100%; height: 400px;"></div>

                   

                    </div>

                   
                   