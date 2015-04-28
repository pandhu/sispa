<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Buku_besar extends CI_Controller {
	private $id_event;
	public function __construct(){
            parent::__construct();
            if (!$this->session->userdata('user_data')){
            	redirect('login');
            }
            $this->id_event = $this->session->userdata('user_data');
            $this->id_event = $this->id_event['event_id'];

    }

	public function index(){
		$this->load->model('coa_model');
		$data['akun'] = $this->coa_model->get_akun($this->id_event);
        $this->template->user('user/buku_besar', $data);
    }

    public function search(){
    	$this->load->model('buku_model');
    	$this->load->model('coa_model');

    	$search = $this->input->post('akun_selected');
		$buku_besar = $this->buku_model->get_data_by_akun($search, $this->id_event);
    	$kode_akun = $this->coa_model->get_akun_by_name($search, $this->id_event);

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
}
