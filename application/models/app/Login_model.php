<?php 

class Login_model extends CI_Model{
	
	
	public function login($username)
    {
        $cmd = "SELECT * FROM usuarios WHERE (correo LIKE BINARY '$username')";
        
		$query = $this->db->query($cmd);
        
		return $query->num_rows() === 1 ? $query->row() : null;
    }
	
	
	public function update_token($idUsuario, $token){
		
		$this->db->set("token", $token);
		$this->db->where("idU", $idUsuario);
		$this->db->update("usuarios");
		return $this->db->affected_rows() >0;
		
	}
	
	
	
	public function check_token($idU, $correo, $token){
		
		$this->db->where("idU",$idU);
		$this->db->where("correo", $correo);
		$this->db->where("token", $token);
		$rs = $this->db->get("usuarios");
		return $rs->num_rows() > 0 ;
		
	}
	
	
	
	
	
	
	
	
}




?>