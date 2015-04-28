<?php
class Log_model extends CI_Model{
	
     function insert($data){
        $this->db->insert('log', $data);
        return;
    }
}