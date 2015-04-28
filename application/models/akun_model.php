<?php
class Akun_model extends CI_Model{
	
    function get_all($id_event){
        $query = "SELECT * FROM user where event_id = $id_event";
        $query=$this->db->query($query);
        return $query->result();
    }

    function add($data){
        $this->db->insert('user',$data);
    }

    function isAvailable($username){
        $query = "SELECT * FROM user where username = '$username'";
        $query=$this->db->query($query);
        if (count($query->result()) == 0){
            return true;
        }
        else {  
            return false;
        }
    }

    function delete($username){
        $this->db->where('username', $username);
        $this->db->delete('user');
    }

    function get_by_username($username){
        $query = "SELECT * FROM user where username = '$username'";
        $query=$this->db->query($query);
        return $query->row();
    }

    function ganti_password($username, $data){
        $this->db->where('username', $username);
        $this->db->update('user', $data);
    }

    function get_all_master(){
        $query = "SELECT * FROM user a , event b where a.event_id = b.id_event";
        $query=$this->db->query($query);
        return $query->result();
    }
}