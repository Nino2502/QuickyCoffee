<header class="version_1">
    <div class="layer"></div><!-- Mobile menu overlay mask -->
    <div class="main_header Sticky">
        <div class="container">
            <div class="row small-gutters">
                <div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
                    <div id="logo">
                        <a onClick="location.href='<?= base_url()?>';"><img src="<?= base_url()?>static/publico/img/sdi_logo.png" alt="" height="60"></a>
                    </div>
                </div>
                <nav class="col-xl-6 col-lg-7">
                    <a class="open_close" href="javascript:void(0);">
                        <div class="hamburger hamburger--spin">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </a>
                    <!-- Mobile menu button -->
                    <div class="main-menu">
                        <div id="header_menu">
                            <a onClick="location.href='<?= base_url()?>';"><img src="static/img/logo_black.svg" alt="" width="100"
                                    height="35"></>
                            <a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
                        </div>
                        <ul>
                            <li onClick="location.href='<?= base_url()?>';">
                                <a href="#" class="show-submenu">Inicio</a>
                            </li>
                             <li onClick="location.href='<?= base_url()?>public/Quienes_somos';">
                                <a href="#" class="show-submenu">Quienes somos</a>
                            </li>
                            <li class="submenu">
                                <a href="javascript:void(0);" class="show-submenu">Tienda</a>
                                <ul>
                                    <li><a href='#' onClick="location.href='<?= base_url()?>public/Produc_imp';">Productos impresos</a></li>
                                    <li><a href='#' onClick="location.href='<?= base_url()?>public/Produc_no_imp';">Productos no impresos</a></li>
                                </ul>
                            </li>
                            <li onClick="location.href='<?= base_url()?>public/Contactanos';">
                                <a href="#" class="show-submenu">Contactanos</a>
                            </li>
                        </ul>
                    </div>
                    <!--/main-menu -->
                </nav>
                <div class="col-xl-3 col-lg-2 col-md-3">
                    <ul class="top_tools">


                        <?php
						if($this->session->userdata('idusuario') !=0  && $this->session->userdata('token') != null){
					?>

                        <!-- carrito de compras 
                        <li>
                            <div class="dropdown dropdown-cart">
                                <a href="#">
                                    <font size=5><i class="fa-solid fa-cart-shopping"></i></font>
                                </a>
                                <div class="dropdown-menu">
                                    <ul>

                                    </ul>
                                    <div class="total_drop">
                                        <div class="clearfix"><strong>Total</strong><span>$200.00</span></div>
                                        <a href="#" class="btn_1 outline">Ver carrito</a>
                                    </div>
                                </div>
                            </div>

                        </li>

                        <!-- lista de deseos 
                        <li>
                            <a href="#" onClick="location.href='<?= base_url()?>public/Favoritos';">
                                <font size=5><i class="fa-regular fa-heart"></i></font><span>Favoritos</span>
                            </a>
                        </li>

                        <!-- iniciar sesion -->
                        <li>
                            <div class="dropdown dropdown-access">
                                <a href="#">
                                    <font size=5> <i class="fa-regular fa-circle-user"></i> </font><span>Iniciar
                                        sesion</span>
                                </a>
                                <div class="dropdown-menu">


                                    <p><b>Hola: </b> <?php echo $_SESSION['nombreU']; ?> </p>
                                    <ul>
                                        <li>
                                            <a href="#" onClick="location.href='<?= base_url()?>public/Mis_pedidos';"><i class="ti-package"></i>Mis Pedidos</a>
                                        </li>
                                        <li>
                                            <a href="#" onClick="location.href='<?= base_url()?>public/Perfil';"><i class="ti-user"></i>Mi perfil</a>
                                        </li>
                                        <li>
                                            <a onClick="location.href='<?= base_url()?>logout';"><i
                                                    class="fa-solid fa-power-off"></i>Cerrar sesion</a>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                            <!-- /dropdown-access-->
                        </li>

                        <?php
                        }else{
                    ?>
                        <li>
                            <div class="dropdown dropdown-access">
                                <a href="#">
                                    <font size=5> <i class="fa-regular fa-circle-user"></i> </font><span>Iniciar
                                        sesion</span>
                                </a>
                                <div class="dropdown-menu">

                                    <a id="inniciar" onClick="location.href='<?= base_url()?>login';"
                                        class="btn_1">Iniciar sesion</a>

                                </div>
                            </div>
                            <!-- /dropdown-access-->
                        </li>
                        <?php
                                    }
                                    ?>

                    </ul>
                </div>

            </div>
            <!-- /row -->
        </div>
    </div>
    <!-- /main_header -->

</header>
<!-- /header -->