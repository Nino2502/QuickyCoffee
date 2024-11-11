<?php


class Empleados_model extends CI_Model{


    public function get_empleados() {
        $this->db->select("employees.employee_id, employees.first_name, employees.last_name, employees.email, employees.status, employees.phone, 
                           departments.name as department_name, 
                           positions.name as position_name");
        $this->db->from("employees");
        $this->db->where_in('employees.status', [1, 2]);
        $this->db->join("departments", "departments.department_id = employees.department_id", "inner");
        $this->db->join("positions", "positions.position_id = employees.position_id", "inner");
        
        $query = $this->db->get();
        
        return $query->num_rows() > 0 ? $query->result() : null;
    }

    public function insert_empleado($data){
        return $this->db->insert('employees',$data);
        
    }
    public function eliminar_usuarios($data,$estatus){
        $this->db->where('employee_id', $data);
    
        return $this->db->update('employees', ['status' => $estatus]);

    }
    public function changeStatus($id){
        $this->db->set('status',2);
        $this->db->where('employee_id',$id);
       
        return $this->db->update('employees');

    }
    public function changeStatus1($id){
        $this->db->set('status',1);
        $this->db->where('employee_id',$id);
        return $this->db->update('employees');

    }

    public function toggleEmployeeStatus($employee_id, $status) {
        // Verificar el estado actual del empleado
        $this->db->select('status');
        $this->db->from('employees');
        $this->db->where('employee_id', $employee_id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $currentStatus = $query->row()->status;
            
            // Si el estado actual es 1, cambiarlo a 2, y viceversa
            if ($currentStatus == 1) {
                $newStatus = 2;
            } elseif ($currentStatus == 2) {
                $newStatus = 1;
            } else {
                // Si el estado no es 1 o 2, no hacer nada
                return false;
            }

            // Preparar la actualización del estado
            $data = array(
                'status' => $newStatus
            );

            // Actualizar el estado del empleado en la base de datos
            $this->db->where('employee_id', $employee_id);
            $this->db->update('employees', $data);  // Aquí 'empleados' es el nombre de tu tabla

            // Verificar si se realizó alguna actualización
            return $this->db->affected_rows() > 0;
        }

        return false;
    }

    public function editar_empleado($data) {
        // Asegúrate de que todos los campos necesarios estén en el array
        $updated_data = array(
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'department_id' => $data['department_name'],
            'position_id' => $data['position_name'],
            'status' => 1
        );
    
        // Actualizar la base de datos
        $this->db->where('employee_id', $data['employee_id']);
        return $this->db->update('employees', $updated_data);
    }
    
    



}

?>