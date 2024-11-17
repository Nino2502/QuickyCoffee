<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Estructura_model extends CI_Model{

    public function get_organizational_structure() {
        $this->db->select("
            organizational_structure.structure_id,
            departments.name AS department_name,
            positions.name AS position_name,
            CONCAT(employees.first_name, ' ', employees.last_name) AS employee_name,
            organizational_structure.start_date,
            organizational_structure.end_date,
            organizational_structure.status,
            organizational_structure.created_at,
            organizational_structure.updated_at
        ");
        $this->db->from("organizational_structure");
        $this->db->join("departments", "departments.department_id = organizational_structure.department_id", "inner");
        $this->db->join("positions", "positions.position_id = organizational_structure.position_id", "inner");
        $this->db->join("employees", "employees.employee_id = organizational_structure.employee_id", "inner");

        $query = $this->db->get();
        
        return $query->num_rows() > 0 ? $query->result() : null;
    }

}

?>