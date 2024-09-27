<?php 


class Store extends CI_Controller{
	
	
	
	public function __construct(){
		parent::__construct();
	
		$this->load->model('app/Graficas_Inicio_model');
		$this->load->model('public/Detalle_model');
		$this->load ->model('app/Banners_model');
		
	
	}
	
	
	
	
	public function inicioWeb(){
	
		
			$data['_APP']['title']='Proximanete';
			$data['_APP']['tipoRegistro']='Cliente';	
			$this->load->view("publico/proximamente_view", $data);
			
	
	}
	
	
	
	
	
	public function index(){
		$data['_APP']['title'] = "Inicio";
		

			
        $data['productosM'] = $this->Graficas_Inicio_model->ver_mas_vendido();  
		
		$data['banners'] = $this->Banners_model->ver_BannersPublic(); 
		
		/*
		echo "<pre>";
		var_dump($data['banners'] );	
		die();
		*/
		
		$data['styles'][] = 'plantilla/frontcss/home_1';
		$data['styles'][] = 'plantilla/frontcss/custom';
	    $data['scripts'][] = 'plantilla/frontjs/carousel-home';	
	    $data['scripts'][] = 'publico/js/carousel_with_thumbs';	

	
		
		
		$data['_APP_FRAGMENT'] = $this->load->view('publico/fragments/inicio/inicio_view.php', $data, TRUE);

		echo json_encode($data);

		die();

		
		
		$this->load->view('publico/inicio_view', $data, FALSE);
		
		/*
		$this->load->view('publico/template/header_view', $data, FALSE);
		$this->load->view('publico/template/navbar_view', $data, FALSE);
		$this->load->view('publico/store_view', $data, FALSE);
		$this->load->view('publico/template/footer_view');
		$this->load->view('publico/scripts/home', $data, FALSE);
		*/
		
	}
	
	
	
	
	public function impresos(){
		
		
		
		$data['_APP']['title'] = "Productos impresos";
		
        $data['categoriasM'] = $this->Detalle_model-> get_categorias_impresos();  
		$data['impreso'] = 1;
		
		
		$data['tituloSeccion'] = "Categorias productos impresos"; 
		$data['fondo'] = "categorías"; 
		$data['descripcion'] = "";
		 
		
		$data['styles'][] = 'plantilla/frontcss/home_1';
		$data['styles'][] = 'plantilla/frontcss/custom';
	    $data['scripts'][] = 'plantilla/frontjs/carousel-home';	
	    $data['scripts'][] = 'publico/js/carousel_with_thumbs';	
		
		
		$data['_APP_FRAGMENT'] = $this->load->view('publico/fragments/impresos/impresosCat_view.php', $data, TRUE);

		
		
		$this->load->view('publico/inicio_view', $data, FALSE);
	}
	
	
	
	
	
	
	public function impresosPr($idCat = 0, $nombre = ""){
		
		
		
		$data['_APP']['title'] = "Productos impresos";
		
        $data['productosM'] = $this->Detalle_model->get_Servicios_impresos($idCat);  
		
		$data['tituloCategoria'] = "Impresos"; 
		$data['tituloSeccion'] = $nombre; 
		$data['fondo'] = "Impresos"; 
		$data['descripcion'] = "";
		 
		
		$data['styles'][] = 'plantilla/frontcss/home_1';
		$data['styles'][] = 'plantilla/frontcss/custom';
	    $data['scripts'][] = 'plantilla/frontjs/carousel-home';	
	    $data['scripts'][] = 'publico/js/carousel_with_thumbs';	
		
		
		$data['_APP_FRAGMENT'] = $this->load->view('publico/fragments/impresos/impresos_view.php', $data, TRUE);

		
		
		$this->load->view('publico/inicio_view', $data, FALSE);
	}
	
	
	
	public function noImpresos(){
		
		
		
		$data['_APP']['title'] = "Productos no impresos";
		
        $data['categoriasM'] = $this->Detalle_model->get_categorias_Noimpresos(); 
		$data['impreso'] = 2;
		
		$data['tituloSeccion'] = "Productos No impresos"; 
		$data['fondo'] = "categorías"; 
		$data['descripcion'] = "";
		
		$data['styles'][] = 'plantilla/frontcss/home_1';
		$data['styles'][] = 'plantilla/frontcss/custom';
	    $data['scripts'][] = 'plantilla/frontjs/carousel-home';	
	    $data['scripts'][] = 'publico/js/carousel_with_thumbs';	
		
		
		$data['_APP_FRAGMENT'] = $this->load->view('publico/fragments/noImpresos/noImpresosCat_view.php', $data, TRUE);

		
		
		$this->load->view('publico/inicio_view', $data, FALSE);
	}
	
	
	public function noImpresosPr($idCat = 0, $nombre = ""){
		
		
		
		$data['_APP']['title'] = "Productos no impresos";
		
        $data['productosM'] = $this->Detalle_model->get_Servicios_noImpresos($idCat);  
			
			
		$data['tituloCategoria'] = "No Impresos"; 
		$data['tituloSeccion'] = $nombre; 
		$data['fondo'] = "No impresos"; 
		$data['descripcion'] = "";
		
		$data['styles'][] = 'plantilla/frontcss/home_1';
		$data['styles'][] = 'plantilla/frontcss/custom';
	    $data['scripts'][] = 'plantilla/frontjs/carousel-home';	
	    $data['scripts'][] = 'publico/js/carousel_with_thumbs';	
		
		
		$data['_APP_FRAGMENT'] = $this->load->view('publico/fragments/noImpresos/noImpresos_view.php', $data, TRUE);

		
		
		$this->load->view('publico/inicio_view', $data, FALSE);
	}
	
	
	
	
	
	public function detalle($idServicio = 0, $impreso = 0){
		
		$idS = $idServicio;
		
		$idImpreso = $impreso;
		
		
		$rs = $this->Detalle_model->get_Servicio($idS);
		
		
		/*echo "<pre>";
		var_dump($rs);
		die();*/
		
		
		$data['_APP']['title'] = "Detalle Servicio";
		
		
		 $data['detalle'] = $rs;  
		
		/*
		echo "<pre>";
		var_dump($rs);
		die();
		*/
		
		$data['tituloSeccion'] = "Detalle de producto"; 
		$data['fondo'] = "productos"; 
		$data['descripcion'] = ""; 
		$data['impreso'] = $idImpreso;
		
	
		
		$data['styles'][] = 'plantilla/frontcss/product_page';
		$data['styles'][] = 'plantilla/frontcss/custom';
	   
	    $data['scripts'][] = 'publico/js/carousel_with_thumbs';	
		
		
		$data['_APP_FRAGMENT'] = $this->load->view('publico/fragments/detalle/detalle_view.php', $data, TRUE);

		
		
		$this->load->view('publico/inicio_view', $data, FALSE);
	}
	
	
	
	
	
	
	
	
	
	public function contacto(){
		
		
		
		$data['_APP']['title'] = "Inicio";
		
        $data['productosM'] = $this->Graficas_Inicio_model->ver_mas_vendido();  
		
		$data['styles'][] = 'plantilla/frontcss/contact';
		$data['styles'][] = 'plantilla/frontcss/custom';
	  
		 
        $data['scripts'][] = 'propiosScripts/contacto';
		
		
		$data['_APP_FRAGMENT'] = $this->load->view('publico/fragments/contacto/contacto_view.php', $data, TRUE);

		
		
		$this->load->view('publico/inicio_view', $data, FALSE);
	}
	
	public function nosotros(){
		
		
		
		$data['_APP']['title'] = "Inicio";
		
        $data['productosM'] = $this->Graficas_Inicio_model->ver_mas_vendido();  
		
		$data['styles'][] = 'plantilla/frontcss/about';
		$data['styles'][] = 'plantilla/frontcss/custom';
	    $data['scripts'][] = 'plantilla/frontjs/carousel-home';	
	    
		
		
		$data['_APP_FRAGMENT'] = $this->load->view('publico/fragments/nosotros/nosotros_view.php', $data, TRUE);

		
		
		$this->load->view('publico/inicio_view', $data, FALSE);
	}
	
	

	
}

?>