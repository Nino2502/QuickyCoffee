<?php

class Password_model extends CI_Model{ 

    public function get_Pass($id){

        $this->db->select("*");
        $this->db->where("idEmpleado",$id);
        $rs = $this->db->get("accesoMovimiento");
        return $rs->num_rows() >= 1 ? $rs->row() : null;

    }

    public function insert_PassAcc($data){
        
        $this->db->insert('accesoMovimiento', $data);
        return $this->db->affected_rows() >0; 
    }

    public function valida_Contra($Usuario, $pass1) {

        $this->db->select("*");
        $this->db->where("ClaveAcceso", $pass1);
        $this->db->where("idEmpleado", $Usuario);
        $validaContra = $this->db->get("accesoMovimiento");
        return $validaContra->num_rows() >= 1 ? $validaContra->row() : null;

    }

    public function update_PassAcc($id, $data){
        
        $this->db->set('ClaveAcceso', $data);
        $this->db->where('idEmpleado', $id);
        $this->db->update('accesoMovimiento');
        return $this->db->affected_rows() > 0; 
    }
    

}
