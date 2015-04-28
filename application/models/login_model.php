<?php
class Login_model extends CI_Model{
	
    function get_auth($username){
        $query=$this->db->query("SELECT * FROM user WHERE username='$username'");
        return $query->row();
    }   

    function get_auth_master($username){
        $query=$this->db->query("SELECT * FROM masteradmin WHERE username='$username'");
        return $query->row();
    }

}