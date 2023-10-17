<?php

class Produc_no_imp extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model( 'public/Produc_no_imp_model' );
    }

    public function index() {

        $data[ '_APP' ][ 'title' ] = 'Productos no impresos';
        $this->load->view( 'publico/template/header_view', $data, FALSE );
        $this->load->view( 'publico/template/navbar_view', $data, FALSE );
        $this->load->view( 'publico/tienda_view', $data, FALSE );
        $this->load->view( 'publico/template/footer_view' );
        $this->load->view( 'publico/scripts/no_impresos', $data, FALSE );

    }

    public function obtenerTipoCat()
    {
        $tipo_cat = $this->Produc_no_imp_model->obtenerTipoCat();
        echo json_encode( $tipo_cat );
    }

    public function obtener_Servicios()
    {
        $idCat = $this->input->post("idCat");
        $servicios = $this->Produc_no_imp_model->get_ser_cat($idCat);
        echo json_encode( $servicios );
    }

}

?>