   
           



            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs " role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="first-tab" data-toggle="tab" href="#first" role="tab"
                                aria-controls="first" aria-selected="true"><h3>Listado aviso de privacidad</h3></a>
                        </li>
						
						  <li class="nav-item">
                            <a class="nav-link active" id="second-tab" data-toggle="tab" href="#second" role="tab"
                                aria-controls="second" aria-selected="true"><h3>Agregar</h3></a>
                        </li>
                       
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        
                        
                        <!-- inicia el primer tab-->
                        
                        <div class="tab-pane fade show " id="first" role="tabpanel"
                            aria-labelledby="first-tab">
                            

                            
                                <div class="row mb-4">
                                    <div class="col-12 mb-4">
                                        <div class="card">
                                            <div class="card-body" id="despliegueTabla">
                                              
                                            </div>

                                        </div>
                                    </div>
                                </div>

                

                        </div>
        
                        <!--termina aqui, inicia segundo tab-->
						
						
						
						
						
						  <!-- inicia el segundo tab-->
                        
                        <div class="tab-pane fade show active" id="second" role="tabpanel"
                            aria-labelledby="second-tab">
                            <button type="button" class="btn btn-primary mr-3 mb-4" onclick="insertaAvisoDePrivacidad()">
                                + Agregar
                                
                            </button>

                            
                               
							<input type="hidden" value="Prueba" id="pr1">
							

								<div class="container-fluid">


									<div class="row">
										<div class="col-12">



											<div class="card mb-4">
													<div class="card-body ">
														<h5 class="mb-4">Quill Standart</h5>
														<div class="html-editor" id="quillEditor"></div>
													</div>
												</div>

												<div class="card mb-4">
													<div class="card-body ">
														<h5 class="mb-4">Quill Bubble</h5>
														<div class="html-editor-bubble" id="quillEditorBubble"></div>
													</div>
												</div>


										</div>
									</div>
								</div>


                

                        </div>
        
                        <!--termina aqui, inicia tercer tab-->
						
						
						
						
						
						
						
						<!-- editor de texto -->
					

						
					<!-- Termina editor de texto-->
						
						
						
                        
                        
                       	
                    </div>
                </div>
                <!--termina cardBody-->
            </div>
   