<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hello_world extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('hello_world_model');
    }

    public function index() {
        $data['hello_world'] = $this->hello_world_model->get_hello_world();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

}
