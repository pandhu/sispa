<?php
class Event_model extends CI_Model{
	
    function get_event_data($event_id){
    	$query = "SELECT * FROM event WHERE id_event=$event_id";
        $query=$this->db->query($query);
        return $query->row();
    }

    function update($data, $id_event){
    	$this->db->where('id_event', $id_event);
    	$this->db->update('event', $data);
    }

    function get_all_event(){
        $query = "SELECT * FROM event";
        $query=$this->db->query($query);
        return $query->result();
    }

    function insert($data){
        $this->db->insert('event', $data);
    }
}