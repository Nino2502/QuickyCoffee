<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Produc_no_imp_model extends CI_Model 
{
    public function obtenerTipoCat()
    {
        $this->db->select('DISTINCT(cs.idCS), cs.nombreCS, cs.imagen');
        $this->db->from('servicios s');
        $this->db->join('categoriasServicios cs', 's.idCS = cs.idCS');
        $this->db->where('cs.estatus', 1);
        $this->db->where('s.impresion', 0);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_ser_cat($idCat)
    {
        $this->db->select('idS, nombreS, image_url');
        $this->db->from('servicios');
        $this->db->where('idCS', $idCat);
        $this->db->where('impresion', 0);
        $this->db->where('estatus', 1);
        $query = $this->db->get();
        return $query->result();
    }

                        
}


/* End of file Registro_model.php and path /application/models/public/Registro_model.php */
