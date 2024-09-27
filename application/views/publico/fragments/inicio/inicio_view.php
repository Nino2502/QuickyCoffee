<div id="home" class="page">

    <!-- carousel -->
   
    <?php if(isset($banners)): ?>
        
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
            <div class="carousel-indicators">
                
                <?php $contador = 0; foreach($banners as $slides): ?>
                
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?=$contador?>" <?= $contador == 0 ? 'class="active"': ''?>
                    aria-current="true" aria-label="Slide <?=$contador?>"></button>
                
                <?php $contador ++; ?>
                <?php endforeach;?>
                
            </div>
            <div class="carousel-inner">
                
                <?php $contadorD = 0; foreach($banners as $img): ?>
                
                <div class="carousel-item <?= $contadorD == 0 ? 'active': ''?>" data-bs-interval="3000">
                    <img src="<?= base_url() ?>static/img/banners/<?= $img->imagen?>" class="d-block w-100"
                        alt="<?= $img->nombreBan?>">
                </div>
                
                <?php $contadorD ++; ?>
                <?php endforeach;?>
                
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
        <!--/carousel-->
        
    <?php endif; ?>
    <!--/carousel-->

    <!--/banners_grid -->

    <?php if($productosM != null): ?>

        <div class="container margin_60_35">
            <div class="main_title">
                <h2>Los más vendidos</h2>
                <span>Productos</span>
                <p>Estos son los más comprados por nuestros clientes</p>
            </div>
            <div class="row small-gutters">

                <?php $numero = 1; foreach($productosM as $pro ): ?>

                    <?php if($pro->idServicio != "SDI-Ven-Ven-94235"): ?>
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="grid_item">
                                <figure>
                                    <span class="ribbon off">#<?= $numero++ ?></span>
                                    <a href="<?= base_url()."store/detalle/$pro->idServicio"?>">

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

                    <?php endif; ?>   

                <?php endforeach; ?>

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->

    <?php endif; ?>

</div>
<!-- /container -->
