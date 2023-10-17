<?php if(is_null($detalle)): ?>

			<div class="main_title margin_30">
				
				<h2><a href="<?= base_url()."store/"?>">Regresar al inicio </a></h2>
				
				<h2>Este producto no se encuetra activo, vuelve a intentarlo mas tarde</h2>
				<span><?= $fondo ?></span>
				<p><?= $descripcion ?></p>
			</div>

<div style="height: 750px">
</div>


		
		
<?php else: ?>	

<div class="container margin_30">
	
	
	
			<div class="main_title">
				
				
				
				<h2><a href="<?= base_url()."store/".($detalle[0]->noImpreso == 1 ? 'noImpresosPr': 'impresosPr')."/".$detalle[0]->idCS."/".$detalle[0]->nombreCS?>">Regresar a categoria <?=$detalle[0]->nombreCS?></a></h2>
				
				<h2><?= $tituloSeccion ?></h2>
				<span><?= $fondo ?></span>
				<p><?= $descripcion ?></p>
			</div>
	
	
	
	       
	        <div class="row">
	            <div class="col-md-6">
	                <div class="all">
	                    <div class="slider">
	                        <div class="owl-carousel owl-theme main">
	                            <div style="background-image: url(<?=base_url().'static/imgServicios/'.$detalle[0]->image_url ?>);" class="item-box"></div>
	                            
	                        </div>
	                       
							
							
							
	                    </div>
	                    
	                </div>
	            </div>
	            <div class="col-md-6">
	                <div class="breadcrumbs">
	                   
	                </div>
	                <!-- /page_header -->
	                <div class="prod_info">
	                    <h1><?=$detalle[0]->nombreS?></h1>
						
						<p><small>Categoría: <?=$detalle[0]->nombreCS?></small><br>
						<small>SKU: <?=$detalle[0]->sku?></small><br>
						<small>Detalle: <?= $impreso == 1 ? "Producto impreso": "Producto no impreso"?> </small>	
						</p>
	                   
	                   
	                    <div class="row">
	                        <div class="col-lg-5 col-md-6">
	                            <div class="price_main"><span class="new_price">$<?=($impreso == 1 ? ($detalle[0]->precioS + $detalle[0]->precioImpresion) : $detalle[0]->precioS) ?></span></div>
								 <p><small>Unidad: <?=$detalle[0]->nombreUni?></small><br>
	                        </div>
	                       
	                    </div>
						
						 <h1>Compralo a través de nuestra APP</h1>
					    <p>
							<a href="https://apps.apple.com/mx/app/sdi-impresiones-digitales/id6449199802" target="_blank"><img src="<?= base_url()?>static/img/tiendas/appStore.png" height="85px"></a> 
							<a href="https://play.google.com/store/apps/details?id=store.sdiqro" target="_blank"><img src="<?= base_url()?>static/img/tiendas/playStore.png" height="85px"></a> 
							<a href="#" target="_blank"><img src="<?= base_url()?>static/img/tiendas/appGallery-es.png" height="85px"></a>
						</p>
                    </div>
					
					
	                <!-- /prod_info -->
	               
	                </div>
	                <!-- /product_actions -->
	            </div>
	        </div>
	        <!-- /row -->
	    </div>
	    <!-- /container -->
	    
	    <div class="tabs_product">
	        <div class="container">
	            <ul class="nav nav-tabs" role="tablist">
	                <li class="nav-item">
	                    <a id="tab-A" href="#pane-A" class="nav-link active" data-bs-toggle="tab" role="tab">Descripción</a>
	                </li>
	                
	            </ul>
	        </div>
	    </div>
	    <!-- /tabs_product -->
	    <div class="tab_content_wrapper">
	        <div class="container">
	            <div class="tab-content" role="tablist">
	                <div id="pane-A" class="card tab-pane fade active show" role="tabpanel" aria-labelledby="tab-A">
	                    <div class="card-header" role="tab" id="heading-A">
	                        <h5 class="mb-0">
	                            <a class="collapsed" data-bs-toggle="collapse" href="#collapse-A" aria-expanded="false" aria-controls="collapse-A">
	                                Descripción
	                            </a>
	                        </h5>
	                    </div>
	                    <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
	                        <div class="card-body">
	                            <div class="row justify-content-between">
	                                <div class="col-lg-6">
	                                    <h3>Detalles</h3>
	                                    <p><?=$detalle[0]->desS?></p>
	                                </div>
	                           
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <!-- /TAB A -->
	                
	                <!-- /tab B -->
	            </div>
	            <!-- /tab-content -->
	        </div>
	        <!-- /container -->
	    </div>
	    <!-- /tab_content_wrapper -->
	
<?php endif;?>	
		
		
	