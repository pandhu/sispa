<?php
class Jurnal_model extends CI_Model{
	   
    function get_last($id_event){
    	$query = "SELECT * FROM jurnal where id_event = $id_event ORDER BY id DESC LIMIT 1";
        $query=$this->db->query($query);
        return $query->row();
    }

    function get_all(){
    	$query = "SELECT * FROM jurnal ORDER BY no_voucher ASC";
        $query=$this->db->query($query);
        return $query->result();
    }
    function get_all_akundesc($id_event){
    	$query = "SELECT tanggal, no_voucher, transaksi, a.nama as debit, debit_value, b.nama as kredit, kredit_value, jurnal.id_event, no_jurnal FROM jurnal, coa a, coa b where debit = a.nama and kredit = b.nama and jurnal.id_event = $id_event ORDER BY no_voucher ASC";
        $query=$this->db->query($query);
        return $query->result();
    }

    function insert($data){
        $this->db->insert('jurnal', $data);
        return;
    }

    function multi_insert($data){
    	$this->db->insert_batch('jurnal',$data);
    	return;
    }

    function get_last_voucher($kode){
        $query = "SELECT * FROM jurnal where no_voucher like '$kode%'  ORDER BY id DESC LIMIT 1";
        $query=$this->db->query($query);
        return $query->row();
    }

    function get_last_voucher_1($kode, $id_event){
    	$query = "SELECT * FROM jurnal where no_voucher like '$kode%' and where id_event = $id_event ORDER BY id DESC LIMIT 1";
        $query=$this->db->query($query);
        return $query->row();
    }

    function get_jurnal_by_transaksi($search, $id_event){
    	$query = "SELECT * FROM jurnal where (no_voucher like '%$search%' or transaksi like '%$search%') and id_event = $id_event ORDER BY no_voucher";
    	$query=$this->db->query($query);
        return $query->result(); 
    }
}