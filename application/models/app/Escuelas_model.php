<?php


class Escuelas_model extends CI_Model{


    public function get_escuelas(){
        $this->db->select("*");
        

        $rs= $this->db->get("escuelas");

        return $rs->num_rows() > 0 ? $rs->result() : null;
        


    }
}



?>