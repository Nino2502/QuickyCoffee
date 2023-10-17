<input type="hidden" value="<?=$id?>" id="id_ser" name="id_ser"></input>

<div class="container margin_30">

    <div class="row">
        <div class="col-md-6">
            <div class="all">
                <div class="slider">
                    <div class="owl-carousel owl-theme main" id="car_img" name="car_img">

                    </div>
                    <div class="left nonl"><i class="ti-angle-left"></i></div>
                    <div class="right"><i class="ti-angle-right"></i></div>
                </div>

            </div>
        </div>
        <div class="col-md-6">

            <div class="prod_info">
                <h1 id="nombre_p" name="nombre_p"></h1>
                <div class="yy"></div>
                <br>
                <p><small id="sku_p" name="sku_p">SKU</small></p>

                <p id="descripcion_p" name="descripcion_p"></p>
                <div class="prod_options" id="atributos_serv" name="atributos_serv">
                    
                    <div class="row">
                        <label class="col-xl-5 col-lg-5 col-md-6 col-6"><strong>Size</strong> - Size Guide </label>
                        <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                            <div class="custom-select-form">
                                <select class="wide">
                                    <option value="" selected>Small (S)</option>
                                    <option value="">M</option>
                                    <option value=" ">L</option>
                                    <option value=" ">XL</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
				<div class="prod_options">
				<div class="row">
                        <label class="col-xl-5 col-lg-5  col-md-6 col-6"><strong>Cantidad</strong></label>
                        <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                            <div class="numbers-row">
                                <input type="text" value="1" id="cantidad_p" class="qty2" name="cantidad_p">
                            </div>
                        </div>
                    </div>
				</div>
                <div class="row">
                    <div class="col-lg-5 col-md-6">
                        <div class="price_main"><span class="new_price">$148.00</span></div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="btn_add_to_cart"><a href="#0" class="btn_1">Agregar al carrito aqui es el cambio</a></div>
                    </div>
                </div>
            </div>

            <div class="yy"></div>
            <!-- /prod_info -->
            <div class="product_actions">
                <ul>
                    <?php
						if($this->session->userdata('idusuario') !=0  && $this->session->userdata('token') != null){
						?>
                    <li>
                        <a onClick="addFav(<?=$id?>)" style=" cursor: pointer;"><i class="fa-solid fa-heart-circle-plus"></i><span>Agregar a favoritos</span></a>
                    </li>
                    <?php
						}
						?>
                </ul>
            </div>
            <!-- /product_actions -->
        </div>
    </div>
    <!-- /row -->
</div>