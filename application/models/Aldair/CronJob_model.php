<?php

class CronJob_model extends CI_Model{



      function insert_event($data){
    
        $this->db->insert("test_cronjob", $data);
      }

 
  
} 
?>
