<?php

class Historico_Inventario_model extends CI_Model{


    public function ver_HistoricoInventario(){

        $this->db->select("historicoInventario.*, nombreU");
		$this->db->join("usuarios", "usuarios.idU = historicoInventario.idU  ");
		$this->db->order_by('fecha', 'DESC');
        $rs = $this->db->get("historicoInventario");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    
	
	

} //termina modelo


?>