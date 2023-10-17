<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agrupacion_servicios_model extends CI_Controller {


    public function ver_atributos( $idAS){
        $this->db->select('at.nombreAtr, at.idAtr');
        $this->db->from('servicios AS s');
        $this->db->join('agrupacionServicio AS a', 'a.idAgrupacionS = s.idAS');
        $this->db->join('servicioAtributo AS sa', 's.idS = sa.idS');
        $this->db->join('detalleAtributo AS d', 'sa.idDAtr = d.idDAtr');
        $this->db->join('atributos AS at', 'at.idAtr = sa.idAtr');
        $this->db->where('a.estatus', 1);
        $this->db->where('s.idAS', $idAS);
        $this->db->where('at.estatus', 1);
        $this->db->group_by('at.idAtr');
        
        $query = $this->db->get();
        return $query->result();
      }

    

}