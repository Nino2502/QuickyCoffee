<?php
defined('BASEPATH') or exit('no direct script acces allowed');

class Perfil_model extends CI_Model{

    public function info_user($idU){
        $this->db->select("nombreU, apellidos, correo, telefono,idU");
        $this->db->where("idU", $idU);
        $rs = $this->db->get("usuarios");
        return $rs->num_rows() == 1 ? $rs->row(): NULL; 
      }
      
      public function update_user($idU,  $nombreU, $apellidos,  $telefono) {
        $data = array(
          'nombreU'  => $nombreU, 
          'apellidos'  => $apellidos, 
          'telefono'  => $telefono
        );
        $this->db->where('idU', $idU);
        $this->db->update('usuarios', $data);
        return $this->db->affected_rows() == 1 ? true : false;
    }


    public function update_pass($idU,  $pass, $newPass) {
      $data = array(
        'contrasenia'  => $newPass
        
      );
      $this->db->where('idU', $idU);
      $this->db->where('contrasenia', $pass);
      $this->db->update('usuarios', $data);
      return $this->db->affected_rows() == 1 ? true : false;
  }


//   public function update_token($idU,  $token) {
//     $data = array(
//       'deviceToken'  => $token
      
//     );
//     $this->db->where('idU', $idU);
//     $this->db->update('usuarios', $data);
//     return $this->db->affected_rows() == 1 ? true : false;
// }


    public function update_token($idU, $token) {
        // Obtener el registro actual de la base de datos
        $currentData = $this->db->get_where('usuarios', array('idU' => $idU))->row_array();
    
        // Verificar si los nuevos valores son diferentes a los actuales
        if ($currentData['deviceToken'] === $token) {
            // Los valores son los mismos, no se necesita actualizar
            return true;
        }
    
        // Los valores son diferentes, proceder con la actualizaci¨®n
        $data = array(
            'deviceToken' => $token
        );
        $this->db->where('idU', $idU);
        $this->db->update('usuarios', $data);
        
        return $this->db->affected_rows() == 1 ? true : false;
    }

  public function eliminar_usuario($idU) {
    $data = array(
        'estatus' => 3
    );

    $this->db->where('idU', $idU);
    $this->db->update('usuarios', $data);

    if ($this->db->affected_rows() > 0) {
        // El estatus del usuario se actualizó exitosamente
        return true;
    } else {
        // No se encontró ningún usuario con el ID especificado
        return false;
    }
}



}
