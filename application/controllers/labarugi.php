<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Labarugi extends CI_Controller {
    private $id_event;
    private $arr_coa;
    private $arr_value;

    public function __construct(){
            parent::__construct();
            $session  = $this->session->userdata('user_data');
            if (!$session){
                redirect(base_url().'login');
            } 
            $this->id_event = $this->session->userdata('user_data');
            $this->id_event = $this->id_event['event_id'];
            $this->arr_coa = array();
    }

    public function index(){
        $this->load->model('coa_model');
        $labarugi = $this->coa_model->get_akun_labarugi($this->id_event);
        $labarugi = $this->get_sorted();
        $data['labarugi'] = $labarugi;
        $data['value'] = $this->getValue($labarugi);
    
        $this->template->user('user/labarugi', $data);
    }

    public function get_sorted(){
        $this->arr_coa = array();
        $this->load->model('coa_model');
        $zeroIndent = $this->coa_model->get_akun_by_indent(0,$this->id_event);
        foreach ($zeroIndent as $item) {
            if ($item->tipe == 'Labarugi')
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

    public function getValue($arr){
        $this->load->model('labarugi_model');
        $this->arr_value = array();
        $index = 0;
        foreach ($arr as $item) {
            if($item->jenis == "Header")
                array_push($this->arr_value, "");
            else if ($item->jenis == "Akun"){
                $sum = $this->labarugi_model->get_sum($item->nama, $this->id_event)->sum;
                if (!$sum){
                    $sum = '-';
                }
                array_push($this->arr_value, $sum);
            }else {
                $sum = $this->sumValue($index);
                array_push($this->arr_value, $sum);
            }
            $index++;
        }
        return $this->arr_value;  
    }

    public function sumValue($index){
        $indent = $this->arr_coa[$index-1]->indentasi;
        $parent = $this->arr_coa[$index-1]->parent;
        $sum = $this->arr_value[$index-1];
        $index--;
        while ($newIndent = $this->arr_coa[$index-1]->indentasi) {
            if ($indent == $newIndent){
                $newparent = $this->arr_coa[$index-1]->parent;
                if ($parent == $newparent){
                    $sum = $sum + $this->arr_value[$index-1];
                    $parent = $newparent;
                }
            }
            $index--;
        }
        return $sum;

    }
}