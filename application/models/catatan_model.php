<?php
class Catatan_model extends CI_Model{
	
     function insert($data){
        $this->db->insert('catatan', $data);
        return;
    }

    function get_all($id_event){
    	$query = "SELECT * FROM catatan where id_event = $id_event ";
    	$query = $this->db->query($query);
    	return $query->result();
    }

    function search($keyword, $id_event){
    	$query = "SELECT * FROM catatan where id_event = $id_event and ((catatan like '%$keyword%') or (no_jurnal like '%$keyword%'))";
    	$query = $this->db->query($query);
    	return $query->result();
    }
}