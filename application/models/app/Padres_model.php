<?php

class Padres_model extends CI_Model{



    
    public function get_padres(){
        $this->db->select("*");
        

        $rs= $this->db->get("padres");

        return $rs->num_rows() > 0 ? $rs->result() : null;
        


    }
}

?>