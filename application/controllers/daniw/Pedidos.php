<?php
require FCPATH.'vendor/autoload.php';

class Pedidos extends CI_Controller{
    private $rol_id;
	private $idP;
    private $idUsuario;
    private $idSuc;
    private $idTU;

	private $estatus;
	private $permiso_id;



    public function __construct(){

        parent::__construct();

		verifica_token();

		update_user_estatus($this->session->userdata('idusuario'));


        $this->load->model('daniw/Pedidos_model');
		$this->estatus = $this->session->userdata('estatus');
        $this->rol_id       = $this->session->userdata('idTipoUsuario');
		$this->idP          = $this->session->userdata('idPerfilUsuario');
        $this->idUsuario    = $this->session->userdata('idusuario');
        $this->idTU         = $this->session->userdata('idTipoUsuario');
        $this->idSuc        = $this->session->userdata('sucursal');

    }


    public function index(){


			$this->permiso_id = get_permiso_modulo_seccion(
            $this->estatus,
            $this->rol_id,
			$this->idP,
            $modulo = 7,
            $seccion_id = 56
        );


		if (!is_null($this->permiso_id)) {




        $data['_APP_TITLE']              = "Pedidos";
        $data['_APP_VIEW_NAME']          = "Pedidos";
        $data['_APP_MENU']               = get_role_menu($this->rol_id, 7, 56);// menu lateral
        $data['_APP_VIEW_MENU']          = $this->load->view('private/fragments/nav/main_menu', $data, TRUE);
        $data['_APP_BREADCRUMBS']        = array("Pedidos");
        $data['scripts'][] = 'daniw/Pedidos';
        //<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        $data['scripts'][] = 'propiosScripts/tabla/datatables.net/js/jquery.dataTables.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-bs4/js/dataTables.bootstrap4.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive/js/dataTables.responsive.min';
		$data['scripts'][] = 'propiosScripts/tabla/datatables.net-responsive-bs4/js/responsive.bootstrap4.min';
        $data['modals'][]  = $this->load->view('daniw/Pedidos/modalPedidos', $data, TRUE);
        $data['_APP_FRAGMENT'] = $this->load->view('daniw/Pedidos/Pedidos_view', $data, TRUE);
        // $data['_APP_FRAGMENT'] = $this->load->view('daniw/Pedidos/detallePdf_view', $data, TRUE);
        $this->load->view("default",$data,FALSE);



		 }else{
				redirect(base_url()."web");
		}



    }

    public function getPedidos(){
        $idUsuario = $this->idUsuario;
        $idSuc     = $this->idSuc;
        // var_dump("id: ".$idSuc);
        // die();

        $rs = $this->Pedidos_model->get_Pedidos($idSuc);

        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron pedidos" : "No se encontraron pedidos";
        $data["Pedidos"] = $rs;

        echo JSON_ENCODE($data);
    }

    public function getEstatus() {
        $rs = $this->Pedidos_model->get_Estatus();

        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Estatus encontrados" : "No se encontraron estatus";
        $data["Estatus"] = $rs;

        echo JSON_ENCODE($data);

    }

    public function updatePedidos(){
        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);

        $estatus = $data['estatus'];
        $token = $data['tokenVenta'];

        //consultamos el estatus del token
        $status = $this->Pedidos_model->getStatusToken($token,$estatus);

        if($status != null){
            $data['resultado'] = true;
            $data['mensaje'] = $data['resultado'] ? "Pedido confirmado ": "No se pudo confirmar el pedido";
        }else{
            $rs = $this->Pedidos_model->update_Pedidos($estatus, $token);

            $data['resultado'] = $rs != false;
            $data['mensaje'] = $data['resultado'] ? "Pedido confirmado ": "No se pudo confirmar el pedido";
        }


        echo json_encode($data);
    }

    public function getDetalle() {
        $json = file_get_contents('php://input');
        $data = (array)json_decode($json);

        $rs = $this->Pedidos_model->get_Detalle($data['idVenta']);
        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron ". count($rs)." producto(s)" : "No se encontraron productos";
        $data["Detalle"] = $rs;
        echo JSON_ENCODE($data);
    }

    public function getHistorial(){
        $idUsuario = $this->idUsuario;
        $idSuc     = $this->idSuc;

        $rs = $this->Pedidos_model->get_Historial($idSuc);

        $data['resultado'] = $rs != null;
        $data['mensaje'] = $data['resultado'] ? "Se encontraron pedidos" : "No se encontraron pedidos";
        $data["Historial"] = $rs;

        echo JSON_ENCODE($data);
    }

    public function pdf($id) {


        $idSuc = $this->idSuc;
        $rs = $this->Pedidos_model->get_Detalle($id);
        $rs2 = $this->Pedidos_model->get_Sucursal($idSuc);
        $rs3 = $this->Pedidos_model->get_PedidosVen2($id);
        // var_dump($rs3);
        // die();
        $data["Detalle"] = $rs;
        $data2["nombreSucursal"] = $rs2->nombreSuc;
        $data3["Venta"] = $rs3;

        $mpdf = new \Mpdf\Mpdf(
            ['format' => 'A4',]
        );
        $html = $this->load->view('daniw/Pedidos/detallePdf_view', $data + $data2 + $data3, true);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Pedido'.$id.'.pdf', 'I');
    }

    // public function pdf() {
    //     $json = file_get_contents('php://input');
    //     $data = (array)json_decode($json);
    //     $id = $data['id'];
    //     $total = $data['total'];

    //     $idSuc = $this->idSuc;
    //     $rs = $this->Pedidos_model->get_Detalle($id);
    //     $rs2 = $this->Pedidos_model->get_Sucursal($idSuc);

    //     $data1["Detalle"] = $rs;
    //     $data2["nombreSucursal"] = $rs2->nombreSuc;
    //     $data3["total"] = $total;

    //     $mpdf = new \Mpdf\Mpdf(
    //         ['format' => 'A4',]
    //     );
    //     $html = $this->load->view('daniw/Pedidos/detallePdf_view', $data1 + $data2 + $data3, true);
    //     $mpdf->WriteHTML($html);
    //     $mpdf->Output('Pedido'.$id.'.pdf', 'I');
    // }

}
?>
