<?php
     class ProgramaLealtad_model extends CI_Model{
      

        public function insertarPrograma($data){
            $this->db->insert("controlPuntos", $data);
            return $this->db->insert_id();
        }

        public function getProgramas(){
            $this->db->select("*");
            $this->db->from("controlPuntos");
            $this->db->where_in('estatus', array(1,0));
            $rs = $this->db->get();
            return $rs->num_rows() >0 ? $rs->result() : null;
        }

        public function programaActual(){
            $this->db->select("*");
            $this->db->from("controlPuntos");
            $this->db->where("estatus", 1);
            $query = $this->db->get();
            return $query->num_rows() >= 1 ? $query->row() : null;
        }

        public function programaPuntoscliente($idU) {
            $this->db->select("puntos, nombreU, idU");
            $this->db->from("usuarios");
            $this->db->where("idU", $idU);
            $this->db->where("puntos >", 0); 
            $query = $this->db->get();
            return $query->num_rows() >= 1 ? $query->row() : null;
        }
     
      

        public function actualizarPrograma($datosPrograma) {
            $this->db->where('idControl', $datosPrograma['idControl']);
            $this->db->update('controlPuntos', $datosPrograma);
        }
    
        // Método para obtener el programa principal actual
        public function obtenerProgramaPrincipal() {
            $this->db->where('estatus', 1);
            $query = $this->db->get('controlPuntos');
            return $query->row();
        }
    
        // Método para desactivar todos los programas excepto el principal
        public function desactivarProgramasNoPrincipales($programaPrincipalId) {
            $this->db->where('idControl !=', $programaPrincipalId);
            $this->db->update('controlPuntos', array('estatus' => 0));
        }
    
        // Método para desactivar todos los programas (estatus 0)
        public function desactivarTodosLosProgramas() {
            $this->db->update('controlPuntos', array('estatus' => 0));
        }

        public function getPrograma($idControl){
            $this->db->select("*");
            $this->db->from("controlPuntos");
            $this->db->where("idControl",$idControl);
            $rs = $this->db->get();
            return $rs->num_rows() > 0 ? $rs->row() : null;
        }

        public function updatePrograma($datosPrograma){

           
            $this->db->where('idControl', $datosPrograma['idControl']);
            $result = $this->db->update('controlPuntos', $datosPrograma);
            if($result){
                
                return true;
            }else{
              
                return false;
            }
        }

        public function verificaFecha($nuevaFechaInicio, $nuevaFechaFin) {
                $this->db->where("('$nuevaFechaInicio' BETWEEN fecha_inicio AND fecha_fin) OR ('$nuevaFechaFin' BETWEEN fecha_inicio AND fecha_fin)");
                $query = $this->db->get('controlPuntos');
                return $query->num_rows() > 0 ? array('estatus' => false, 'registro' => $query->row()) : array('estatus' => true);
        }

        public function obtenerProgramaProgramado() {
            $fechaActual = date('Y-m-d H:i:s'); // Obtener la fecha y hora actual en formato MySQL
            
            $this->db->select('*');
            $this->db->from('controlPuntos');
            $this->db->where('fecha_inicio <=', $fechaActual);
            $this->db->where('fecha_fin >=', $fechaActual);
            $this->db->where_in('estatus', array(0,1));
            $this->db->where_in('Orden', array(2)); // Orden 2
            
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false; // No se encontraron registros
            }
        }

        public function actualizarProgramaCron($idPrograma){
            $this->db->where('idControl', $idPrograma);
            $this->db->update('controlPuntos', array('estatus' => 1));
        }

        public function borrarPrograma($idControl){
            $data = array('estatus' => 3);
            $this->db->where('idControl', $idControl);
            $this->db->update('controlPuntos', $data);
            return $this->db->affected_rows() > 0 ? true : false;
        }

        public function desactivarTodosProgramas() {
            $this->db->where('estatus !=', 3);
            $this->db->update('controlPuntos', array('estatus' => 0));
            return $this->db->affected_rows() > 0;
        }
        
}   
?>
