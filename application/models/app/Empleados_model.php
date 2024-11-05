<?php


class Empleados_model extends CI_Model{


    public function get_empleados() {
        $this->db->select("employees.employee_id, employees.first_name, employees.last_name, employees.email, employees.status, employees.phone, 
                           departments.name as department_name, 
                           positions.name as position_name");
        $this->db->from("employees");
        $this->db->join("departments", "departments.department_id = employees.department_id", "inner");
        $this->db->join("positions", "positions.position_id = employees.position_id", "inner");
        
        $query = $this->db->get();
        
        return $query->num_rows() > 0 ? $query->result() : null;
    }
    



}

?>