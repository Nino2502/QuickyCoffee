<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Registro_model extends CI_Model 
{
    public function existe_correo($email)
    {
        $cmd = "SELECT * FROM usuarios WHERE (correo LIKE BINARY '$email')";
        $query = $this->db->query($cmd);
        return $query->num_rows() === 1 ? true : null;
    }
    
    public function existe_tel($tel)
    {
        $cmd = "SELECT * FROM usuarios WHERE (telefono LIKE BINARY '$tel')";
        $query = $this->db->query($cmd);
        return $query->num_rows() === 1 ? true : null;
    }

    public function insertar($data)
    {
        $this->db->insert('usuarios', $data);
        return $this->db->insert_id();
    }

    public function traer_sucursales()
    {
        $this->db->select('idSuc, nombreSuc');
        $this->db->from('sucursales');
        $this->db->where('estatus', 1);
        $query = $this->db->get();
        return $query->result();
    }

                        
}


/* End of file Registro_model.php and path /application/models/public/Registro_model.php */
