<?php


class Alumnos_model extends CI_Model{

    public function get_alumnos(){
        $this->db->select("*");
        $this->db->from("alumnos");
        $this->db->join("escuelas","escuelas.id = alumnos.id_escuela");
        

        $rs= $this->db->get();

        return $rs->num_rows() > 0 ? $rs->result() : null;
        


    }




}


?>