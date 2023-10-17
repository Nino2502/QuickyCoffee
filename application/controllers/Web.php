<?php 

class Web extends CI_Controller{
	
	private $id_usuario; 
    private $correo; 
    private $token;
	private $estatus;
	private $rol_id;
	private $idP;
	private $nombre;
	private $imagen;
	private $idSuc;

    public function __construct() {
        parent::__construct();
		
		verifica_token();

		$this->load->model('daniw/Perfil_model');
        $this->id_usuario = $this->session->userdata('idusuario');
		$this->correo = $this->session->userdata('correo'); 
		$this->token = $this->session->userdata('token');
		$this->estatus = $this->session->userdata('estatus');
        $this->rol_id = $this->session->userdata('idTipoUsuario');
		$this->idP = $this->session->userdata('idPerfilUsuario');
		$this->nombre = $this->session->userdata('nombreU');
		$this->imagen = $this->session->userdata('image_url');
        //update_user_estatus($this->id_usuario);
		$this->load->model('app/Sucursales_model');
		$this->idSuc  = $this->session->userdata('sucursal');
               
    } 
	
	
	
	
	/*
	
	


<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        Chart showing browser market shares. Clicking on individual columns
        brings up more detailed data. This chart makes use of the drilldown
        feature in Highcharts to easily switch between datasets.
    </p>
</figure>
	
	*/
	
	
	
	
	

	public function index () {
		
		 
		if($this->session->userdata('idusuario') !=0  && $this->session->userdata('token') != null){
		
			$data['_APP_TITLE']              = "Home";        
			$data['_APP_VIEW_NAME']          = "Inicio";
			$data['_APP_MENU']               = get_role_menu($this->rol_id, 1);// menu lateral
			//$data['_APP_NAV']                = $this->load->view('app/private/fragments/nav/main_nav', $data, TRUE);   // menu superior imagen usuario     
			$data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
			$data['_APP_BREADCRUMBS']        = array("Inicio");
			
			
			
		
			
			if( $this->rol_id == 1){
			
				$data['scripts'][] = 'plantilla/js/vendor/Chart.bundle.min';   
				$data['scripts'][] = 'plantilla/js/vendor/chartjs-plugin-datalabels';   
				$data['scripts'][] = 'plantilla/js/vendor/mousetrap.min';  
				$data['styles'][] = 'vendor/select2.min';
				$data['sucursales'] = $this->Sucursales_model->ver_Sucursales();
				$data['idSuc'] = $this->idSuc;
				
				
				$data['scriptsExternos'][] = 'https://code.highcharts.com/highcharts.js';  
				$data['scriptsExternos'][] = 'https://code.highcharts.com/modules/data.js';  
				$data['scriptsExternos'][] = 'https://code.highcharts.com/modules/drilldown.js';  
				$data['scriptsExternos'][] = 'https://code.highcharts.com/modules/exporting.js';  
				$data['scriptsExternos'][] = '"https://code.highcharts.com/modules/export-data.js';  
				$data['scriptsExternos'][] = 'https://code.highcharts.com/modules/accessibility.js';  
				
				
				$data['scripts'][] = 'propiosScripts/InicioSuperAdmin';				
				$data['_APP_FRAGMENT'] = $this->load->view('app/private/fragments/modules/principal', $data, TRUE);
			
				
			}elseif( $this->rol_id == 2){
				
				$data['scripts'][] = 'plantilla/js/vendor/Chart.bundle.min';   
				$data['scripts'][] = 'plantilla/js/vendor/chartjs-plugin-datalabels';   
				$data['scripts'][] = 'plantilla/js/vendor/mousetrap.min';  
				$data['styles'][] = 'vendor/select2.min';
				$data['sucursales'] = $this->Sucursales_model->ver_Sucursales();
				$data['idSuc'] = $this->idSuc;
				
				
				$data['scriptsExternos'][] = 'https://code.highcharts.com/highcharts.js';  
				$data['scriptsExternos'][] = 'https://code.highcharts.com/modules/data.js';  
				$data['scriptsExternos'][] = 'https://code.highcharts.com/modules/drilldown.js';  
				$data['scriptsExternos'][] = 'https://code.highcharts.com/modules/exporting.js';  
				$data['scriptsExternos'][] = '"https://code.highcharts.com/modules/export-data.js';  
				$data['scriptsExternos'][] = 'https://code.highcharts.com/modules/accessibility.js';  
				
				
				$data['scripts'][] = 'propiosScripts/InicioSuperAdmin';				
				$data['_APP_FRAGMENT'] = $this->load->view('app/private/fragments/modules/principal', $data, TRUE);
			
				
			}elseif( $this->rol_id == 3){
				$data['_APP_FRAGMENT'] = $this->load->view('app/private/fragments/modules/colaborador', $data, TRUE);
				$data['scripts'][] = 'propiosScripts/InicioColaborador';
				
			}elseif( $this->rol_id == 4){
				$data['_APP_FRAGMENT'] = $this->load->view('app/private/fragments/modules/Cliente/cliente_view', $data, TRUE);
				
				$data['modals'][]  = $this->load->view('app/private/fragments/modules/Cliente/modalCliente', $data, TRUE);
				
				$data['scripts'][] = 'propiosScripts/InicioCliente';
				
				
				$data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
				$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
				$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
				$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';

				
				
				
			}
			
			
			
			
			//$data['_APP_FRAGMENT'] = $this->load->view('app/private/fragments/modules/principal', $data, TRUE);

			 $this->load->view("default",$data,false);

		
			
		}else{

			redirect(base_url()."login");
		}

	}

}


?>