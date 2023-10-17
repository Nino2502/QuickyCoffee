<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function login($username)
    {
        $cmd = "SELECT * FROM usuarios WHERE (correo LIKE BINARY '$username')";

        $query = $this->db->query($cmd);
        return $query->num_rows() === 1 ? true : null;
    }

    public function session_by_id($id)
    {
        $cmd =
            "SELECT * FROM usuarios WHERE (id_usuario = '" .
            $id .
            "') AND estatus_id <> 0";

        $query = $this->db->query($cmd);
        return $query->num_rows() === 1 ? $query->row() : null;
    }

    public function get_estatus_by_user_id($id_usuario)
    {
        $this->db->select('estatus');
        $this->db->from('usuarios');
        $this->db->where('idU', $id_usuario);

        $query = $this->db->get();

        return $query->num_rows() === 1 ? $query->row()->estatus : null;
    }
	
	
	 public function get_permiso_modulo(
        $rol_id,
		$idP,
        $modulo,
        $seccion_id
    ) {	 
		 
	if($rol_id != 1){
		
		
		 $cmd = '
			 select * from menuAsociado
			 where 
			 idTU = '.$rol_id.' and 
			 modulo_id = '.$modulo.' and 
			 seccion_id = '.$seccion_id.' and
			 idP = '.($idP == "null" || $idP == "0" ? "0" : $idP ).'  
			'; 
		 
        $query = $this->db->query($cmd);

        return $query->num_rows() === 1 ? $query->row() : null;
		
	}else{
		return true;
	}	 
		 
       
    }

    public function get_role_permission_in_module_section(
        $rol_id,
        $elem_type,
        $elem_id
    ) {
        $cmd =
            "SELECT a.* FROM menuAsociado a JOIN tipoUsuario b USING(idTU) WHERE idTU = '$rol_id' AND " .
            $elem_type . "_id = $elem_id AND b.estatus_id = 1";
        $query = $this->db->query($cmd);

        return $query->num_rows() === 1 ? $query->row()->permiso_id : null;
    }

    public function get_modules_by_role($rol_id, $idP)
    {
        $cmd = "select distinct m.* from modulos m
				inner join menuAsociado ma on ma.modulo_id = m.modulo_id
				where m.estatus = 1 and ma.idTU = ".$rol_id." and idP =".$idP . " ORDER BY m.orden asc";

        $query = $this->db->query($cmd);
        return $query->num_rows() > 0 ? $query->result() : null;
    }
	
	 public function get_modules_by_roleSA()
    {
        $cmd = "SELECT * FROM modulos a   ORDER BY orden ASC";

        $query = $this->db->query($cmd);
        return $query->num_rows() > 0 ? $query->result() : null;
    }
	
	 public function get_module_sections_by_roleSA($modulo_id)
    {
        $cmd = "SELECT * FROM secciones where modulo_id = $modulo_id  AND estatus = 1 ORDER BY orden asc";

        $query = $this->db->query($cmd);
        return $query->num_rows() > 0 ? $query->result() : null;
    }
	
	

    public function get_module_sections_by_role($rol_id, $modulo_id, $idP)
    {
        $cmd = "select  distinct s.* from secciones s
inner join menuAsociado ma on ma.seccion_id = s.seccion_id
where s.modulo_id = ".$modulo_id." and ma.idTU = ".$rol_id." and ma.idP = ".$idP." and s.estatus = 1 ORDER BY s.orden asc
;";

        $query = $this->db->query($cmd);
        return $query->num_rows() > 0 ? $query->result() : null;
    }

    public function get_section_module_data($elem_type, $elem_id)
    {
        $cmd =
            'SELECT ' .
            ($elem_type == 'mod' ? 'modulo' : 'seccion') .
            '_id, ico_' .
            ($elem_type == 'mod' ? 'mod' : 'sec') .
            ', url_' .
            ($elem_type == 'mod' ? 'mod' : 'sec') .
            ', nombre_' .
            ($elem_type == 'mod' ? 'mod' : 'sec') .
            ' FROM sl_' .
            ($elem_type == 'mod' ? 'modulos' : 'secciones') .
            ' WHERE ' .
            ($elem_type == 'mod' ? 'modulo' : 'seccion') .
            "_id = '$elem_id'";

        $query = $this->db->query($cmd);

        return $query->row();
    }

    public function get_module_data_by_sec($seccion_id)
    {
        $cmd = "SELECT modulo_id, ico_mod, nombre_mod FROM sl_modulos WHERE modulo_id IN (SELECT modulo_id FROM sl_secciones WHERE seccion_id = $seccion_id)";
        $query = $this->db->query($cmd);

        return $query->row();
    }
}

/* End of file Auth_model.php */
/* Location: ./application/controllers/Auth_model.php */
