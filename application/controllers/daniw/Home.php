<?php 

class Home extends CI_Controller{


    private $rol_id;
    private $idUsuario;
	private $idP;


    public function __construct(){

        parent::__construct();
        
         verifica_token();
		 $this->load->model('daniw/Perfil_model');

        $this->load ->model('daniw/Home_model');
        $this->rol_id = $this->session->userdata('idTipoUsuario');
        $this->idP = $this->session->userdata('idPerfilUsuario');
        $this->idUsuario    = $this->session->userdata('idusuario');
       
    }


/*
    public function index(){

        $data['_APP_TITLE']              = "Home";        
        $data['_APP_VIEW_NAME']          = "Inicio";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 14);// menu lateral
        //$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Compras realizadas");
        $data['scripts'][] = 'daniw/Home';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['modals'][]  = $this->load->view('daniw/Home/modalHome', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('daniw/Home/Home_view', $data, TRUE);

        $this->load->view("default",$data,FALSE);

    }

	*/
	
    public function getCompras(){
        $idUsuario = $this->idUsuario;
       
        $rs = $this->Home_model->get_Compras($idUsuario);
       
        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron compras" : "No se encontraron compras";
        $data["Compras"] = $rs;

        echo JSON_ENCODE($data);
    }

    public function getDetalle() {
        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);

        $rs = $this->Home_model->get_Detalle($data['idVenta']);
        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." producto(s)" : "No se encontraron productos";
        $data["Detalle"] = $rs;
        echo JSON_ENCODE($data); 
    }

    public function insertaSecciones(){

        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);
        $accion = $data['accion']; 
        //$data['seccion_id']= $data["seccion_id"];

        if($data['accion']== "Agregar"){

            unset($data['accion']); 
            $rs = $this->Secciones_model->inserta_Secciones($data);

        }else if($data['accion']== "editar"){

            unset($data['accion']); 
            $rs = $this->Secciones_model->update_Secciones($data, $data['seccion_id']);
        }

        if($accion== "Agregar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se inserto la sección correctamente" : "No se inserto prueba nuevamente";
        }else if($accion == "editar"){
            $data["resultado"]= $rs != false;
            $data["mensaje"] = $data["resultado"] ? "Se actualizo la sección correctamente" : "No se actualizo prueba nuevamente";
        }

        echo json_encode($data);

    }


    // Módulos para el select
    public function getModulos(){
        $rs = $this->Secciones_model->ver_Modulos();
        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." módulos" : "no se econtraron módulos";
        $data["Modulos"] = $rs;
        echo JSON_ENCODE($data); 
    }

    public function getSelect(){
        $id= $this->input->post("id");

        $rs = $this->Secciones_model->sel_Modulos($id);

        $data["resultado"] = $rs != null;
        $data["mensaje"]= $data["resultado"] ? "Se encontro el modulo ": "No se obtuvieron módulos";
        $data["selectMod"]= $rs;

        echo json_encode($data);

    }


    public function cambioEstatus(){

        $id = $this->input->post("id");
        $rs = $this->Secciones_model->estatus_Secciones($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se cambio el estatus correctamente": "No se pudo cambiar el estatus intenta de nuevo";

        echo json_encode($data);

    }


    public function bajaLogica(){

        $id = $this->input->post("id");
        $rs = $this->Secciones_model->borradoLogico($id);

        $data["resultado"] = $rs !=false;
        $data["mensaje"] = $data["resultado"] ? "Se ha borrado correctamente": "No se ha podido borrar, intente nuevamente";

        echo json_encode($data);

    }
	
	public function imprimir($idVenta){
		
		
		$id = $idVenta;
		$Usuario = $this->idUsuario;
       
        $Datosfiscales = $this->Perfil_model->get_DF($Usuario);
        $data["Fiscales"] = $Datosfiscales;
		
		
		
		$rs = $this->Home_model->get_DetalleFactura($id);
		$data["detalleVenta"] = $rs;
		
		
		
		
			
		//echo "<pre>";	
		//var_dump($datosVentaFactura);	
		//die();
		
		/*echo $rs[0]->Factura;
		
		echo "<pre>";
		echo $this->db->last_query() . "</br></br>";
		
		echo $id ;
		
		var_dump($rs);
		die();*/
		
		
			
        $data['scripts'][] = 'propiosScripts/verCompraFacturacion';
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
       
		
		
		if($rs != null){
			
			$datosVentaFactura = $this->Home_model->get_datos_factura($rs[0]->idCliente, $idVenta, $rs[0]->tokenVEnta);
			$data["datosVentaFactura"] = $datosVentaFactura;
		
			if($rs[0]->Factura == null){


				$data['_APP_TITLE']              = "Ver compra";        
				$data['_APP_VIEW_NAME']          = "Historial de compras";
				$data['_APP_MENU']               = get_role_menu($this->rol_id, 3, 7);// menu lateral
				//$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
				$data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
				$data['_APP_BREADCRUMBS']        = array("ver compra");
				$data['_APP_FRAGMENT'] = $this->load->view('private/fragments/Facturacion/Compra_view', '', TRUE);


			}else{


				$data['_APP_TITLE']              = "Ver Compra";        
				$data['_APP_VIEW_NAME']          = "Historial de compras";
				$data['_APP_MENU']               = get_role_menu($this->rol_id, 3, 7);// menu lateral
				//$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
				$data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
				$data['_APP_BREADCRUMBS']        = array("ver compra");
				$data['_APP_FRAGMENT'] = $this->load->view('private/fragments/Facturacion/Facturacion_view', '', TRUE);


			}
			
		}else{
			
			$data['_ERROR'] = true;
			$data['_APP_TITLE']              = "Ver compra";        
				$data['_APP_VIEW_NAME']          = "Historial de compras";
				$data['_APP_MENU']               = get_role_menu($this->rol_id, 3, 7);// menu lateral
				//$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
				$data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
				$data['_APP_BREADCRUMBS']        = array("ver compra");
				$data['_APP_FRAGMENT'] = $this->load->view('private/fragments/Facturacion/Compra_view', '', TRUE);
			
			
			
		}
		
		
		
	
		

        $this->load->view("default",$data,FALSE);

	/*$mpdf = new \Mpdf\Mpdf();
	$mpdf->writeHtml('<h1>Impresion</h1>');
	$mpdf->Output();*/
		
	}
	







}//termina clase


?>