	
		<!--/carousel-->

	
		<!--/banners_grid -->
		
		
		
		<?php if($categoriasM != null): ?>
		
		
		<div class="container margin_60_35">
		
	
			<div class="main_title">
				<h2><?= urldecode($tituloSeccion) ?></h2>
				<span><?= $fondo ?></span>
				<p><?= $descripcion ?></p>
			</div>
			
			
			
			<div class="row small-gutters">
			
				<?php $numero = 1;  foreach($categoriasM as $cat ): ?>
			
					
				
						<div class="col-6 col-md-4 col-xl-3">
							<div class="grid_item">
								<figure>
									
									<a href="<?= base_url()."store/noImpresosPr/$cat->idCS/$cat->nombreCS"?>">
										
										<img class="img-fluid lazy" style="height: 280px"  src="<?= base_url()."static/img/categoriasServ/$cat->imagen"?>" data-src="<?= base_url()."static/img/categoriasServ/$cat->imagen"?>" alt="">
										
										<img class="img-fluid lazy" style="height: 280px" src="<?= base_url()."static/img/categoriasServ/$cat->imagen" ?>" data-src="<?= base_url()."static/img/categoriasServ/$cat->imagen"?>" alt="">
									</a>

								</figure>

								<a href="product-detail-1.html">
									<h3><?= $cat->nombreCS ?></h3>
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

		
		