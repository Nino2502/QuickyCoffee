<?php
defined('BASEPATH') or exit('no direct script acces allowed');

class Favoritos_model extends CI_Model
{
    public function agregar($idAS, $idU){
        $data = array(
            'idU'  => $idU,
            'idAS' => $idAS,
        );
        $result= $this->db->insert('favoritos', $data);
        return $result;
    }

    public function borrar($idAS, $idU){
        $this->db->where('idAS', $idAS);
        $this->db->where('idU', $idU);
        $this->db->delete('favoritos');
        return $this->db->affected_rows() > 0 ? true :false;
    }

    public function ver( $idU){
        $this->db->select('f.idAS, a.nombreAgrupaS, s.precioS,
        s.precioImpresion, (s.precioS + s.precioImpresion) AS precioImpreso
        , s.noImpreso, s.impresion, s.image_url');
        $this->db->from('favoritos as f');
        $this->db->join('servicios as s', 'f.idAS = s.idAS');
        $this->db->join('agrupacionServicio as a', 'f.idAS = a.idAgrupacionS');
        $this->db->where('f.idU', $idU);
        $this->db->group_by('f.idAS');
        $query = $this->db->get();
        return $query->result();
      }

      public function check($idAS, $idU){
        $this->db->select('*');
        $this->db->from('favoritos');
        $this->db->where('idU', $idU);
        $this->db->where('idAS', $idAS);
        $query = $this->db->get();
        return $query->result() ? true : false;
      }


    public function getBanners() {
            $this->db->select('orden, imagen');
            $this->db->from('banners');
            $this->db->where('estatus', 1);
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return array(); // Retorna un arreglo vacío si no se encuentran resultados
            }
        }
}