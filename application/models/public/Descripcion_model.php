<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Descripcion_model extends CI_Model 
{

    public function get_informacion($idS)
    {
        $this->db->select('nombreS, image_url, desS, sku');
        $this->db->from('servicios');
        $this->db->where('idS', $idS);
        $query = $this->db->get();
        return $query->result();
    }

                        
}


/* End of file Registro_model.php and path /application/models/public/Registro_model.php */
