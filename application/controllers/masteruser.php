<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Masteruser extends CI_Controller {
	public function __construct(){
            parent::__construct();
            $session  = $this->session->userdata('master');
            if (!$session){
               redirect(base_url().'login_master');
            }
    }

    public function index(){
    	$this->load->model('event_model');
        $data['event'] = $this->event_model->get_all_event();  
    	$this->template->master('master/dashboard.php', $data);
    }

    public function tambah_acara(){
        $this->load->model('event_model');
        $data_event = array(
            'description' => $this->input->post('description')
        );
        $this->event_model->insert($data_event);
        redirect(base_url().'masteruser');
    }
    public function generatepdf($id_event){
        //Load the library
        $this->load->library('html2pdf');        
        //Set folder to save PDF to
        $this->html2pdf->folder('./assets/pdfs/');
        //Set the paper defaults
        $this->html2pdf->paper('a4', 'landscape');
        $this->load->model('jurnal_model');
        $this->load->model('catatan_model');
        $this->load->model('coa_model');
        
        $data['jurnal'] = $this->jurnal_model->get_all_akundesc($id_event);
        //$this->load->view('master/jurnal_topdf', $data);
        $filename = $id_event."_jurnal.pdf";
        $this->html2pdf->filename($filename);
        $this->html2pdf->html($this->load->view('master/jurnal_topdf', $data, true));
        $this->html2pdf->create('save');

        $filename = $id_event."_catatan.pdf";
        $this->html2pdf->filename($filename); 
        $data['catatan'] = $this->catatan_model->get_all($id_event);
        $this->html2pdf->html($this->load->view('master/catatan_topdf', $data, true));
        $this->html2pdf->create('save');
        
        $filename = $id_event."_neraca.pdf";
        $this->html2pdf->filename($filename); 
        $data['neraca'] = $this->catatan_model->get_all($id_event);
        $this->html2pdf->html($this->load->view('master/neraca_topdf', $data, true));
        $this->html2pdf->create('save');

        $filename = $id_event."_labarugi.pdf";
        $this->html2pdf->filename($filename); 
        $data['labarugi'] = $this->catatan_model->get_all($id_event);
        $this->html2pdf->html($this->load->view('master/labarugi_topdf', $data, true));
        $this->html2pdf->create('save');


         if($this->html2pdf->create('save')) {
            //PDF was successfully saved or downloaded
            echo 'PDF saved';
        }

    }
    public function detail($tipe, $id_event){
        if ($tipe == "jurnal"){
            $this->load->model('jurnal_model');
            $data['jurnal'] = $this->jurnal_model->get_all_akundesc($id_event);
            $this->template->master('master/jurnal', $data);
        } else if ($tipe == "catatan"){
            $this->load->model('catatan_model');
            $data['catatan'] = $this->catatan_model->get_all($id_event);
            $this->template->master('master/catatan', $data);
        } else if ($tipe == "buku_besar"){
            $this->load->model('coa_model');
            $data['akun'] = $this->coa_model->get_akun($id_event);
            $this->template->master('master/buku_besar', $data);
        } else if ($tipe == "neraca"){
            $this->load->model('coa_model');
            $neraca = $this->coa_model->get_akun_neraca($id_event);
            $neraca = $this->get_sorted($id_event, "Neraca");
            $data['neraca'] = $neraca;
            $data['value'] = $this->getValue($neraca, $id_event);
            $this->template->master('master/neraca', $data);
        } else if ($tipe == "labarugi"){
            $this->load->model('coa_model');
            $labarugi = $this->coa_model->get_akun_labarugi($id_event);
            $labarugi = $this->get_sorted($id_event, "Labarugi");
            $data['labarugi'] = $labarugi;
            $data['value'] = $this->getValue($labarugi, $id_event);
            $this->template->master('master/labarugi', $data);
        }
    }

    public function search_bukubesar($id_event){
        $this->load->model('buku_model');
        $this->load->model('coa_model');

        $search = $this->input->post('akun_selected');
        $buku_besar = $this->buku_model->get_data_by_akun($search, $id_event);
        $kode_akun = $this->coa_model->get_akun_by_name($search, $id_event);
        $this->print_buku($buku_besar, $kode_akun);
    }

    public function print_buku($buku_besar, $kode_akun){
        echo "<h4 id='kode-akun' style='float:left'>Kode Akun: ".$kode_akun[0]->kode."</h4>";
        if(count($buku_besar) == 0){
            echo "<span style='margin:0 auto; display:table;'><h3><i>data tidak ditemukan</i></h3></span>";
            return;
        }
        $saldo = 0;
        $count = 1;
        echo "<table class='table'>";
        echo "<thead><tr><th>No</th><th>No. Voucher</th><th>Transaksi</th><th>Value</th><th>Saldo Berjalan</th></tr></thead>";
        echo "<tbody>";
        foreach ($buku_besar as $j) { 
            $saldo = $saldo + $j->value;
            echo "<tr><td>$count</td><td>$j->no_voucher</td><td>$j->transaksi</td><td>$j->value</td><td>$saldo</td></tr>";
            $voucher = $j->no_voucher;
            $count++;
        }//foreach
        echo "</tbody>";
        echo "</table>";
        echo "<h4 id='saldo' style='float:right'>Saldo Akhir: ".number_format($saldo, 0, ',', '.')."</h4>"; 

    }

    public function get_sorted($id_event, $tipe){
        $this->arr_coa = array();
        $this->load->model('coa_model');
        $zeroIndent = $this->coa_model->get_akun_by_indent(0,$id_event);
        foreach ($zeroIndent as $item) {
            if ($item->tipe == $tipe)
                $this->sortDfs($item, $id_event);
        }
        return $this->arr_coa;
    }

    public function sortDfs($root, $id_event){
        $this->load->model('coa_model');
        array_push($this->arr_coa, $root);
        $child = $this->coa_model->get_akun_by_parent($root->nama, $id_event);
        if (count($child) == 0) return;
        foreach ($child as $item) {
            $this->sortDfs($item, $id_event);
        }
        return;
    }

    public function getValue($arr, $id_event){
        $this->load->model('neraca_model');
        $this->arr_value = array();
        $index = 0;
        foreach ($arr as $item) {
            if($item->jenis == "Header")
                array_push($this->arr_value, "");
            else if ($item->jenis == "Akun"){
                $sum = $this->neraca_model->get_sum($item->nama, $id_event)->sum;
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
