<?php

class Permisos_model extends CI_Model{ 

    // Vista para el usuario desarrollador
    public function ver_tipoUsuario() {

        $this->db->distinct();
        $this->db->select("menuAsociado.idTU, tipoUsuario.nombreTU");
        $this->db->JOIN("tipoUsuario","tipoUsuario.idTU = menuAsociado.idTU");
        //$this->db->GROUP_BY("menuAsociado.modulo_id");
        $rs = $this->db->get("menuAsociado");
        return $rs->num_rows() >0 ? $rs->result() : null;
        
    }

    // Vista para el usuario administrador
    public function ver_tipoUsuarioPorId($idFiltro) {
        $this->db->distinct();
        $this->db->select("menuAsociado.idTU, tipoUsuario.nombreTU");
        $this->db->join("tipoUsuario","tipoUsuario.idTU = menuAsociado.idTU");
        $this->db->where_in("menuAsociado.idTU", $idFiltro);
        $rs = $this->db->get("menuAsociado");
        return $rs->num_rows() > 0 ? $rs->result() : null;
    }

    public function get_Permisos($idTU) { 
		$this->db->select( "m.*, modulos.nombre_mod, secciones.nombre_sec, tipoUsuario.nombreTU, tipoPerfil.nombreTP" );
		$this->db->JOIN("modulos","modulos.modulo_id = m.modulo_id", 'left');
        $this->db->JOIN("secciones","secciones.seccion_id = m.seccion_id", 'left');
        $this->db->JOIN("tipoUsuario","tipoUsuario.idTU = m.idTU", 'left');
        $this->db->JOIN("tipoPerfil", "tipoPerfil.idTP = m.idP", 'left');
		
		if ( $idTU != 0 ) {
			$this->db->where( "m.idTU", $idTU );
		}

		$rs = $this->db->get("menuAsociado AS m");
		return $rs->num_rows() == 0 ? NULL : $rs->result();
	}

    // Consulta que me trae todos los tipos de usuarios
    public function get_Usuario() {

        $this->db->select("u.*");
        $rs = $this->db->get("tipoUsuario AS u");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function get_UsuarioPorId($idFiltro) {

        $this->db->select("u.*");
        $this->db->where_in("u.idTU", $idFiltro);
        $rs = $this->db->get("tipoUsuario AS u");
        return $rs->num_rows() > 0 ? $rs->result() : null; 

    }

    // Consulta que me trae todos los tipos de perfiles para el TU colaborador
    public function get_Perfil() {

        $this->db->select("p.*");
        $rs = $this->db->get("tipoPerfil AS p");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    // Consulta que me trae todos los tipos de perfiles para el TU colaborador
    public function get_Modulos() {

        $this->db->select("m.*");
        $rs = $this->db->get("modulos AS m");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    public function get_Secciones($modulo_id) {

        $this->db->select("s.*");

        if ( $modulo_id != 0 ) {
			$this->db->where( "s.modulo_id", $modulo_id );
		}

		$rs = $this->db->get("secciones AS s");
		return $rs->num_rows() == 0 ? NULL : $rs->result();

    }

    // public function ver_Permisos(){ 
    //     $this->db->select("menuAsociado.idTU, modulos.nombre_mod, secciones.nombre_sec, tipoUsuario.nombreTU, tipoPerfil.nombreTP");
	// 	$this->db->JOIN("modulos","modulos.modulo_id = menuAsociado.modulo_id");
    //     $this->db->JOIN("secciones","secciones.seccion_id = menuAsociado.seccion_id");
    //     $this->db->JOIN("tipoUsuario","tipoUsuario.idTU = menuAsociado.idTU");
    //     $this->db->JOIN("tipoPerfil", "tipoPerfil.idTP = menuAsociado.idP");
    //     //$this->db->GROUP_BY("menuAsociado.modulo_id");
    //     $rs = $this->db->get("menuAsociado");
    //     return $rs->num_rows() >0 ? $rs->result() : null;

    // }


    // -------------------------------- Prueba --------------------------------
    public function ver_ModuloAs() {

        $this->db->select("modulos.nombre_mod, secciones.nombre_sec");
        $this->db->JOIN("modulos","modulos.modulo_id = menuAsociado.modulo_id");
        $this->db->JOIN("secciones","secciones.seccion_id = menuAsociado.seccion_id");
        $this->db->WHERE("idTU=2 AND idP=1");
        $rs = $this->db->get("menuAsociado");
        return $rs->num_rows() >0 ? $rs->result() : null;

    }

    // public function inserta_Permisos($data) { 
    //     $this->db->insert("menuAsociado", $data);
    //     return $this->db->affected_rows() > 0 ? true : false;
    // }

    public function inserta_Permisos($data) {
        try {
            $this->db->insert('menuAsociado', $data);
            return $this->db->affected_rows() > 0;
        } catch (Exception $e) {
            if ($e->getCode() == 1062) {
                return false;
            } else {
                throw $e;
            }
        }
    }

    public function update_Permisos($data, $id) {
        $this->db->where("idTU", $id);
        $this->db->update("menuAsociado", $data);
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function elimina_Permisos($idTU, $idP, $mod_id, $secc_id){

        $this->db->where('modulo_id', $mod_id);
        $this->db->where("modulo_id IS NOT NULL");  // línea para excluir valores nulos
        $this->db->where('seccion_id', $secc_id);
        $this->db->where("seccion_id IS NOT NULL"); // línea para excluir valores nulos
        $this->db->where('idTU', $idTU);
        $this->db->where("idTU IS NOT NULL");       // línea para excluir valores nulos
        $this->db->where('idP', $idP);
        $this->db->where("idP IS NOT NULL");        // línea para excluir valores nulos

        $this->db->delete('menuAsociado');
        return $this->db->affected_rows() >0;

    }

}
