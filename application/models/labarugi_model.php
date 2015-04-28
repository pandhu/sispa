<?php
class Labarugi_model extends CI_Model{
	
    function get_sum($akun, $id_event){
        $query = "SELECT sum(value) as sum from buku_besar where id_event=$id_event and akun = '$akun'";
        $query = $this->db->query($query);
        return $query->row();
    }
}