<?php
class Buku_model extends CI_Model{
	
    function insert($data){
        $this->db->insert('jurnal', $data);
        return;
    }

    function multi_insert($data){
    	$this->db->insert_batch('buku_besar',$data);
    	return;
    }

    function get_data_by_akun($akun, $id_event){
    	$query = "SELECT * FROM buku_besar where akun = '$akun' and id_event = $id_event";
    	$query = $this->db->query($query);
    	return $query->result();
    }
}