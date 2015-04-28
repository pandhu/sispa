<?php
class Coa_model extends CI_Model{
	
    function get_akun($id_event){
    	$query = "SELECT * FROM coa where jenis='Akun' and id_event = $id_event order by nama";
        $query=$this->db->query($query);
        return $query->result();
    }

    function get_all($id_event){
        $query = "SELECT * FROM coa where id_event = $id_event order by kode";
        $query=$this->db->query($query);
        return $query->result();
    }

    function get_akun_debit($id_event){
    	$query = "SELECT * FROM coa where jenis='Akun' and saldo_normal='Debit' and id_event= $id_event";
        $query=$this->db->query($query);
        return $query->result();
    }

    function get_akun_kredit($id_event){
    	$query = "SELECT * FROM coa where jenis='Akun' and saldo_normal='Kredit' and id_event = $id_event";
        $query=$this->db->query($query);
        return $query->result();
    }

    function get_akun_by_name($nama, $id_event){
        $query = "SELECT * FROM coa where jenis='Akun' and id_event = $id_event and nama ='$nama'";
        $query=$this->db->query($query);
        return $query->result();
    }

    function update($data, $id){
        $this->db->where('id',$id);
        $this->db->update('coa', $data); 
    }

    function input($data){
        $this->db->insert('coa',$data);
    }

    function delete($id){
        $this->db->where('id',$id);
        $this->db->delete('coa');
    }

    function get_coa_by_nama($nama, $id_event){
    	$query = "SELECT * FROM coa where id_event = $id_event and nama ='$nama'";
        $query=$this->db->query($query);
        return $query->row();
    }

    function get_akun_by_indent($indent, $id_event){
    	$query = "SELECT * FROM coa where indentasi = $indent and id_event = $id_event";
        $query=$this->db->query($query);
        return $query->result();
    }
    function get_akun_by_parent($parent, $id_event){
    	$query = "SELECT * FROM coa where parent = '$parent' and id_event = $id_event";
        $query=$this->db->query($query);
        return $query->result();
    }

    function get_akun_labarugi($id_event){
    	$query = "SELECT * FROM coa where tipe = 'Labarugi' and id_event = $id_event";
        $query=$this->db->query($query);
        return $query->result();
    }

    function get_akun_neraca($id_event){
    	$query = "SELECT * FROM coa where tipe = 'Neraca' and id_event = $id_event";
        $query=$this->db->query($query);
        return $query->result();
    }
}