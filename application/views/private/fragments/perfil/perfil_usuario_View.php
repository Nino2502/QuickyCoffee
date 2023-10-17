

       <input id="idUsu" type="hidden"  value="<?php echo($_SESSION['idusuario']) ?>">
       <input id="idTU"  type="hidden"  value="<?php echo($_SESSION['idTipoUsuario']) ?>">

        <div class="container-fluid">
       
            <div class="row">
                <div class="col col-sm-4">
                    <div>
                        <div class="card ">
                            <div class="card-body">
                                <div class="text-center">
                                    <img alt="Profile" src="https://staticfanpage.akamaized.net/wp-content/uploads/sites/6/2021/06/georgie-boy-1024x576.jpg"
                                        style="aspect-ratio: 1; border-radius: 50%;width: 150px;">
                                         
                                             <p class="list-item-heading mb-1" id="nombreUsuperfil">Sarah Kortney</p>
                                          
                                    <p class="mb-4 text-muted text-small"><?php echo $_SESSION['idTipoUsuario'] == 4 ? 'Cliente' : 'Cliente' ?></p>
                                    <button type="button" class="btn btn-sm btn-outline-primary ">Editar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card col-sm-8">
                    <div.mylist class="card-header" id="despliegueTabla">
                       
                       
                    </div.mylist>
                    <div class="card-body ">
                        <div class="tab-content">
                            
                            
                            <!-- inicia el primer tab-->
                            
                            <div class="tab-pane fade <?php echo $_SESSION['idTipoUsuario'] == 1 || 2 || 3 ? 'show active' : ''?>"  id="first" name="empresa" role="tabpanel"
                                aria-labelledby="first-tab">

                                <div class="card mb-4 col-sm-11">
                                    <div class="card-body" >
                                    <h5 class="mb-4">Empresa</h5>
                                    <form  class="needs-validation tooltip-label-right" novalidate>
                                        <div class="form-group position-relative error-l-50">
                                            <label>Nombre de la empresa</label>
                                            <input type="text" class="form-control" required>
                                        
                                        </div>
                                        <div class="form-group position-relative error-l-50">
                                            <label>Teléfono de la empresa</label>
                                            <input type="text" class="form-control" required>
                                            
                                        </div>
                                        <div class="form-group position-relative error-l-50">
                                            <label>Correo electrónico</label>
                                            <input type="email" class="form-control" required>
                                           
                                        </div>
                                        <div class="form-group position-relative error-l-50">
                                            <label>Registro Federal de Contribuyentes (RFC)</label>
                                            <input type="text" class="form-control" required>
                                          
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary mb-0">Guardar cambios</button>
                                    </form>
                                    </div>
                                </div>
                                

                            </div>
                            
                            
                            
                            <!--termina aqui-->
                            
                            
                            <div class="tab-pane fade <?php echo $_SESSION['idTipoUsuario'] == 4 ? 'show active' : ''?>" id="second" role="tabpanel" aria-labelledby="second-tab">

                                <div class="card mb-4 col-sm-8">
                                    <div class="card-body">
                                        <h5 class="mb-4">Información Personal</h5>
                                        <form class="needs-validation tooltip-label-right" novalidate>
                                            <div class="form-group position-relative error-l-50">
                                                <label>Nombre </label>
                                                <input type="text" class="form-control" id="InputNombre" required>
                                                <small class="text-danger" id="errorNombreUsuario" style="display: none;"></small>
                                            </div>
                                            <div class="form-group position-relative error-l-50">
                                                <label>Apellidos </label>
                                                <input type="text" class="form-control" id="InputApellidos"  required>
                                                <small class="text-danger" id="errorApellidosUsuario" style="display: none;"></small>
                                            </div>
                                            <div class="form-group position-relative error-l-50">
                                                <label>Teléfono personal</label>
                                                <input type="text" class="form-control" id="InputTelefono" required>
                                                <small class="text-danger" id="errorTelusu" style="display: none;"></small>
                                            </div>
                                    
                                            <div id="btn-EP">

                                            </div>
     
                                        </form>
                                    </div>
                                </div>

                            </div>
                            
                         
                            
                            
                            <!-- termina la tercera linea aqui-->
                            
                            
                            
                            
                            <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="third-tab">
                                
                                        <h5 class="mb-4">Información Bancaria</h5>
                                        <form class="needs-validation tooltip-label-right" novalidate>
                                            <div class="form-group position-relative error-l-50">
                                                <label>Nombre del banco </label>
                                                <input type="text" class="form-control" required>
                                                <div class="invalid-tooltip">
                                                    ¡El nombre es requerido!
                                                </div>
                                            </div>
                                            <div class="form-group position-relative error-l-50">
                                                <label>Clabe </label>
                                                <input type="text" class="form-control" required>
                                                <div class="invalid-tooltip">
                                                    ¡La Clabe es requerida!
                                                </div>
                                            </div>
                                            <div class="form-group position-relative error-l-50">
                                                <label>Tarjeta</label>
                                                <input type="text" class="form-control" required>
                                                <div class="invalid-tooltip">
                                                    ¡La tarjeta es requerida!
                                                </div>
                                            </div>
                                            <div class="form-group position-relative error-l-50">
                                                <label>Cuenta</label>
                                                <input type="email" class="form-control" required>
                                                <div class="invalid-tooltip">
                                                    ¡La tarjeta es requerida!
                                                </div>
                
                                                <div class="form-group position-relative">
                                                    <label>Tipo de pago:</label>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="customRadio1" name="customRadio"
                                                            class="custom-control-input" required>
                                                        <label class="custom-control-label" for="customRadio1">
                                                            Efectivo
                                                        </label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="customRadio2" name="customRadio"
                                                            class="custom-control-input" required>
                                                        <label class="custom-control-label" for="customRadio2">
                                                            En línea
                                                        </label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="customRadio3" name="customRadio"
                                                            class="custom-control-input" required>
                                                        <label class="custom-control-label" for="customRadio3">
                                                            Oxxo
                                                        </label>
                                                    </div>
                                                    <div class="invalid-tooltip">
                                                        Radio is required!
                                                    </div>
                                                </div>
                                            </div>
                
                                            
                                            <button type="submit" class="btn btn-primary mb-0">Guardar cambios</button>
                                        </form>
                            </div>  
                                        <!-- termina el tab siguiente-->	

                            <div class="tab-pane fade" id="four" role="tabpanel" aria-labelledby="four-tab">   
                                <div class="card mb-4 col-sm-8">
                                    <div class="card-body">
                                                <h5 class="mb-4">Cambiar contraseña</h5>
                                                <form class="needs-validation tooltip-label-right" novalidate>
                                                <div class="form-group position-relative error-l-50">
                                                        <label>Contraseña actual</label>
                                                        <div class="input-group">
                                                                <input type="password" class="form-control" id="contrasenaPerfil"
                                                                    placeholder="Contraseña">
                                                                    <div class="input-group-append">
                                                                    <button id="password" class="btn btn-primary" type="button" onclick="mostrarPasswordActual()"> <span class="fa fa-eye-slash icon"></span> </button>
                                                                    </div>
                                                                  
                                                        </div>
                                                        <small class="text-danger" id="errorcontraseñaUsuario" style="display: none;"></small>
                                                </div>
                                             
                                                <div class="form-group position-relative error-l-50">
                                                        <label>Confirma contraseña</label>
                                                        <div class="input-group">
                                                                <input type="password" class="form-control" id="contrasenaPerfilV"
                                                                    placeholder="Contraseña">
                                                                    <div class="input-group-append">
                                                                    <button id="passN1" class="btn btn-primary" type="button" onclick="mostrarPasswordConfirmar()"> <span class="fa fa-eye-slash icon1"></span> </button>
                                                                    </div>
                                                                  
                                                        </div>
                                                        <small class="text-danger" id="errorcontraseñaUsuario1" style="display: none;"></small>
                                                </div>
                                                <div class="form-group position-relative error-l-50">
                                                        <label>Confirma contraseña</label>
                                                        <div class="input-group">
                                                                <input type="password" class="form-control" id="contrasenaPerfilV2"
                                                                    placeholder="Contraseña">
                                                                    <div class="input-group-append">
                                                                    <button id="passN2" class="btn btn-primary" type="button" onclick="mostrarPasswordConfirmar2()"> <span class="fa fa-eye-slash icon2"></span> </button>
                                                                    </div>
                                                                  
                                                        </div>
                                                        <small class="text-danger" id="errorcontraseñaUsuario2" style="display: none;"></small>
                                                </div>
                                                <div id="btn_guardar">
                                                </div>
                                                 
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                  <!-- inicia el primer tab-->
                                  <div class="tab-pane fade" id="five" role="tabpanel" aria-labelledby="five-tab">   
                                <div class="card mb-4 col-sm-8">
                                    <div class="card-body">
                                        <h5 class="mb-4">Especialidades</h5>
                                        <form class="needs-validation tooltip-label-right" novalidate>
                                           
     
                                        </form>
                                    </div>
                                </div> 
                                        <div class="form-group position-relative error-l-50">
                                                <label>Nombre </label>
                                                <input type="text" class="form-control" id="InputNombre" required>
                                                <small class="text-danger" id="errorNombreUsuario" style="display: none;"></small>
                                        </div>
                                            <div class="form-group position-relative error-l-50">
                                                <label>Apellidos </label>
                                                <input type="text" class="form-control" id="InputApellidos"  required>
                                                <small class="text-danger" id="errorApellidosUsuario" style="display: none;"></small>
                                            </div>
                                            <div class="form-group position-relative error-l-50">
                                                <label>Teléfono personal</label>
                                                <input type="text" class="form-control" id="InputTelefono" required>
                                                <small class="text-danger" id="errorTelusu" style="display: none;"></small>
                                            </div>
                                    
                                            <div id="btn-EP">

                                            </div>

                                </div>
                            </div>
                            
                    
                          <!-- termina el tab siguiente-->	              
                            
                        </div>
                    </div>
                    
                    <!--termina cardBody-->
                    
                    
                </div>

                


            </div>







        </div>
