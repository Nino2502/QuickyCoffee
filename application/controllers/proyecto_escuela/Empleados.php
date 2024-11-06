<?php

defined('BASEPATH') OR exit('No direct script access allowed');
defined('BASEPATH') OR exit('No direct script access allowed');


class Empleados extends CI_controller{

    function __construct() {
        parent::__construct();

        header('Access-Control-Allow-Origin: *');
        
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header('Content-Type: application/json'); 
        header('Access-Control-Allow-Origin: *'); // Permitir todas las solicitudes de origen
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE"); // Métodos permitidos
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        
        header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, X-Requested-With");

        $this->load->model('app/Empleados_model');
    }



    public function index(){
        echo `<h1>Hola soy empleados</h1>`;
    }

    
    public function get_empleados(){

        $rs = $this->Empleados_model->get_empleados();




        if ($rs) {
            echo json_encode($rs);
        } else {
            echo json_encode(array('error' => 'No se encontraron empleados.'));
        }


    }
    public function agregar_empleado() {
        // Si es una solicitud OPTIONS, solo responde con los encabezados sin procesar la solicitud
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            exit(0); // Termina la ejecución para evitar procesamiento adicional
        }

        // Decodifica los datos JSON recibidos
        $data = json_decode($this->input->raw_input_stream, true);

        if ($data) {
            // Llama al modelo para insertar los datos
            $result = $this->Empleados_model->insert_empleado($data);

            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Employee saved successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to save employee']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
        }
    }
    public function eliminar_empleado(){

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            exit(0); // Termina la ejecución para evitar procesamiento adicional
        }

        $data = json_decode($this->input->raw_input_stream, true);

        if ($data && isset($data['employee_id'])) {
            $employee_id = $data['employee_id'];
            $estatus = 3;  // El valor que representa "eliminado"
    
            // Llamar al modelo para cambiar el estatus
            $result = $this->Empleados_model->eliminar_usuarios($employee_id, $estatus);
    
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Empleado eliminado correctamente']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'No se pudo eliminar el empleado']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Datos inválidos']);
        }


    }

    public function changeStatus() {
        // Recibir los datos enviados desde el frontend en formato JSON
        $input = json_decode(file_get_contents('php://input'), true);
    
        // Verificar si los datos fueron recibidos correctamente
        if (isset($input['employee_id']) && isset($input['status'])) {
            $employee_id = $input['employee_id'];
            $status = $input['status'];
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
            return;
        }
    
 
  
    
        // Llamar al modelo para cambiar el estado del empleado
        $updateStatus = $this->Empleados_model->toggleEmployeeStatus($employee_id, $status);
    
        if ($updateStatus) {
            echo json_encode(['status' => 'success', 'message' => 'Estado actualizado correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo actualizar el estado']);
        }
    }
    


}
?>