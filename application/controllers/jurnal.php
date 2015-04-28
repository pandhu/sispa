<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jurnal extends CI_Controller {
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
    	$this->load->model('jurnal_model');
		$data['jurnal'] = $this->jurnal_model->get_all_akundesc($this->id_event);
		$this->template->user('user/jurnal', $data);
    }

    public function search(){	
    	$this->load->model('jurnal_model');
    	$search = $this->input->post('search');
		$jurnal = $this->jurnal_model->get_jurnal_by_transaksi($search,$this->id_event);
		$this->print_jurnal($jurnal);
    }

    public function print_jurnal($jurnal){
		$voucher ="";
		$count = 1;
		echo "<table class='table'>";
		echo "<thead><tr><th>No</th><th>Tanggal</th><th>No. Voucher</th><th>Transaksi</th><th>Debit Akun</th><th>Debit Value</th><th>Kredit Akun</th><th>Kredit Value</th></tr></thead>";
		echo "<tbody>";
		foreach ($jurnal as $j) { 
			echo "<tr><td>$count</td><td>$j->tanggal</td><td>$j->no_voucher</td><td>$j->transaksi</td><td>$j->debit</td><td>$j->debit_value</td><td>$j->kredit</td><td>$j->kredit_value</td></tr>";
			$voucher = $j->no_voucher;
			$count++;
		}//foreach
		echo "</tbody>";
    	echo "</table>";
    }
}
