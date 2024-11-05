<?php


class Departamentos_model extends CI_model{


    public function get_departamentos(){
        $this->db->select("*");

        $this->db->where("status",1);
        

        $rs= $this->db->get("departments ");

        return $rs->num_rows() > 0 ? $rs->result() : null;
        


    }


}


?>