	
		<!--/carousel-->

	
		<!--/banners_grid -->
		
		
		
		<?php if($productosM != null): ?>
		
		
		<div class="container margin_60_35">
		
	
			<div class="main_title">
				<h2><a href="<?= base_url()?>store/noImpresos">Regresar a categoria <?= urldecode($tituloCategoria) ?></a></h2>
				<h2><?= urldecode($tituloSeccion) ?></h2>
				<span><?= $fondo ?></span>
				<p><?= $descripcion ?></p>
			</div>
			
			
			
			<div class="row small-gutters">
			
				<?php   foreach($productosM as $pro ): ?>
			
					
				
						<div class="col-6 col-md-4 col-xl-3">
							<div class="grid_item">
								<figure>
									
									<a href="<?= base_url()."store/detalle/$pro->idS"."/2"?>">
										
										<img class="img-fluid lazy" style="height: 280px"  src="<?= base_url()."static/imgServicios/$pro->image_url"?>" data-src="<?= base_url()."static/imgServicios/$pro->image_url"?>" alt="">
										
										<img class="img-fluid lazy" style="height: 280px" src="<?= base_url()."static/imgServicios/$pro->image_url" ?>" data-src="<?= base_url()."static/imgServicios/$pro->image_url"?>" alt="">
									</a>

								</figure>

								<a href="product-detail-1.html">
									<h3><?= $pro->nombreS ?></h3>
								</a>

							</div>
							<!-- /grid_item -->
						</div>
						<!-- /col -->

					
			
				<?php endforeach; ?>
			
			</div>
			
			
			
			
			
			<!-- /row -->
		</div>
		<!-- /container -->
		
		
		
		
		
		
		
		
				
					
					
				

		<?php endif; ?>

		
		