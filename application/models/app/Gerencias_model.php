<?php


class Gerencias_model extends CI_Model{

    public function get_gerencias(){
        $this->db->select("*");
        

        $rs= $this->db->get("gerencias");

        return $rs->num_rows() > 0 ? $rs->result() : null;
        


    }

}

?>