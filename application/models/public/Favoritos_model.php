<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Favoritos_model extends CI_Model 
{

    public function __construct()
    {
        parent::__construct();
    }

    public function buscar($idU, $idS)
    {
        $this->db->select('idU, idS');
        $this->db->from('favoritos');
        $this->db->where('idU', $idU);
        $this->db->where('idS', $idS);
        $query = $this->db->get();
        return $query->row();
    }

    public function insertar($idU, $idS)
    {
        $data = array(
            'idU' => $idU,
            'idS' => $idS
        );
        $this->db->insert('favoritos', $data);
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function get_favoritos($idU)
    {
        $this->db->select('s.idS, s.nombreS, s.image_url');
        $this->db->from('favoritos f');
        $this->db->join('servicios s', 'f.idS = s.idS');
        $this->db->where('f.idU', $idU);
        $query = $this->db->get();
        return $query->result();
    }

                        
}


/* End of file Registro_model.php and path /application/models/public/Registro_model.php */
