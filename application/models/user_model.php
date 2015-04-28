<?php
class User_model extends CI_Model{
	
    function get_data($username){
        $query=$this->db->query("SELECT * FROM user WHERE username='$username'");
        return $query->row();
    }
}