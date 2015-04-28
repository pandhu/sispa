<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coa extends CI_Controller {
    private $id_event;
    private $arr_coa;
    private $arr_value;
    public function __construct(){
            parent::__construct();
            $session  = $this->session->userdata('user_data');
            if (!$session){
                redirect(base_url().'login');
            } else if ($session['user_level']!= 0){
                redirect(base_url().'user');
            }
            $this->id_event = $this->session->userdata('user_data');
            $this->id_event = $this->id_event['event_id'];
            $this->arr_coa = array();
    }

    public function index(){
        $this->load->model('coa_model');
        $coa  = $this->coa_model->get_all($this->id_event);
        $coa = $this->get_sorted();
    	$data['coa'] = $coa;
    	$this->template->user('superuser/coa', $data);
    }

    public function update(){

        $this->load->model('coa_model');
        $id = $this->input->post('id');
        $parent = $this->input->post('parent');
        $parent = $this->coa_model->get_coa_by_nama($parent, $this->id_event);
        $indentasi;
        $parent_nama;
        if(count($parent) == 0){
            $parent_nama = 'None';
            $indentasi = 0;
        } else {
            $parent_nama = $parent->nama;
            var_dump($parent->indentasi);
            $indentasi = $parent->indentasi+1;
        }
        $update_coa = array(
            'nama'=> $this->input->post('nama'),
            'kode'=> $this->input->post('kode'),
            'jenis'=> $this->input->post('jenis'),
            'tipe'=> $this->input->post('tipe'),
            'saldo_normal'=> $this->input->post('saldo-normal'),
            'indentasi'=> $indentasi,
            'parent' => $parent_nama
        );

        $this->session->set_userdata('success_msg','Data Berhasil Diupdate');
        $this->coa_model->update($update_coa, $id);
        redirect('coa');
    }

    public function input(){

        $this->load->model('coa_model');
        $id = $this->input->post('id');
        $parent = $this->input->post('parent');
        $parent = $this->coa_model->get_coa_by_nama($parent, $this->id_event);
        $indentasi;
        $parent_nama; 
        if(count($parent) == 0){
            $parent_nama = 'None';
            $indentasi = 0;
        } else {
            $parent_nama = $parent->nama;
            $indentasi = $parent->indentasi+1;
        }
        $input_coa = array(
            'nama'=> $this->input->post('nama'),
            'kode'=> $this->input->post('kode'),
            'jenis'=> $this->input->post('jenis'),
            'tipe'=> $this->input->post('tipe'),
            'saldo_normal'=> $this->input->post('saldo-normal'),
            'id_event'=> $this->id_event,
            'indentasi'=> $indentasi,
            'parent' => $parent_nama
        );

        $this->coa_model->input($input_coa);
        $this->session->set_userdata('success_msg','Data Berhasil Disimpan');
        redirect('coa');
    }

    public function delete(){
        $id = $this->input->post('id');
        $this->load->model('coa_model');
        $this->coa_model->delete($id);
        $this->session->set_userdata('success_msg','Data Berhasil Dihapus');
        redirect('coa');
    }
    public function get_sorted(){
        $arr_coa = array();
        $this->load->model('coa_model');
        $zeroIndent = $this->coa_model->get_akun_by_indent(0,$this->id_event);
        foreach ($zeroIndent as $item) {
            $this->sortDfs($item);
        }
        return $this->arr_coa;
    }

    public function sortDfs($root){
        $this->load->model('coa_model');
        array_push($this->arr_coa, $root);
        $child = $this->coa_model->get_akun_by_parent($root->nama, $this->id_event);
        if (count($child) == 0) return;
        foreach ($child as $item) {
            $this->sortDfs($item);
        }
        return;
    }

    public function printCoa(){
        $this->load->model('coa_model');
        $zeroIndent = $this->coa_model->get_akun_by_indent(0,$this->id_event);
        foreach ($zeroIndent as $item) {
            $this->printDfsCoa($item);
        }
    }

    public function printDfsCoa($root){
        $this->load->model('coa_model');
        $out = "";
        for ($i=0; $i < $root->indentasi; $i++) { 
            $out = $out.'&nbsp;&nbsp;&nbsp;';
        }
        echo $out.$root->nama;
        $child = $this->coa_model->get_akun_by_parent($root->nama, $this->id_event);
        echo "<br/>";
        if (count($child) == 0) return;
        foreach ($child as $item) {
            $this->printDfsCoa($item);
        }
        return;
    }
}
