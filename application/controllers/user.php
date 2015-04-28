<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct(){
            parent::__construct();
            if (!$this->session->userdata('user_data')){
            	redirect('login');
            }
    }
	public function index()
	{
		$session = $this->session->userdata('auth');
		$this->load->model('event_model');
		$event_id = $this->session->userdata('user_data');
		$event_id = $event_id['event_id'];
		$event_data = $this->event_model->get_event_data($event_id);
		$data['user'] = $session;
		$data['event_data'] = $event_data;
		$this->template->user('user/dashboard', $data);
	}

	public function jurnal(){
		$this->load->model('jurnal_model');
		$data['jurnal'] = $this->jurnal_model->get_all_akundesc();
		$this->template->user('user/jurnal', $data);
	}

	public function send_to_jurnal($data){
		$this->load->model('jurnal_model');
		$this->jurnal_model->multi_insert($data);
		return;
	}

	public function send_to_buku($data){
		$this->load->model('buku_model');
		$this->buku_model->multi_insert($data);
		return;
	}

	public function send(){
		$this->load->model("coa_model");
		$no_voucher = $this->input->post('code-voucher').'-'.str_pad($this->input->post('number-voucher'), 3, "0", STR_PAD_LEFT);
		$date = $this->input->post('date');
		$limit = $this->input->post('count');
		$err_msg = array();
		$total_kredit = 0;
		$total_debit = 0;
		$arr_input_jurnal = array();
		$arr_input_buku = array();
		$arr_input_log = array();
		$id_event = $this->session->userdata('user_data');
		$id_event = $id_event['event_id'];
		$username = $this->session->userdata('user_data');
		$username = $username['username'];
		$catatan = $this->input->post('comment');

		if ($date == ''){
			array_push($err_msg, 'Invalid tanggal');
		}
		for($count = 1; $count <= $limit; $count++){
			$transaksi = $this->input->post('transaksi-'.$count);
			$akun_debit = htmlentities($this->input->post('akun-debit-'.$count));
			$akun_kredit = htmlentities($this->input->post('akun-kredit-'.$count));
			$debit = (int)$this->input->post('debit-'.$count);
			$kredit = (int)$this->input->post('kredit-'.$count);
			$no_jurnal = $this->input->post('no_jurnal');

			if ($transaksi==''){
				array_push($err_msg, 'Invalid Transaksi');
			}
			if ($akun_debit==''){
				array_push($err_msg, 'Invalid Akun Debit');
			}
			if ($akun_kredit==''){
				array_push($err_msg, 'Invalid Akun Kredit');
			}
			if($debit != $kredit || $debit==0 || $kredit==0){
	 			array_push($err_msg, 'Invalid Kredit dan/atau Debit');
			}
			

			$input_jurnal = array(
				'tanggal'=> $date,
				'no_voucher'=> $no_voucher,
				'transaksi'=> $transaksi,
				'debit'=> $akun_debit,
				'debit_value' => $debit,
				'kredit'=> $akun_kredit,
				'kredit_value'=> $kredit,
				'id_event' => $id_event,
				'no_jurnal' => $no_jurnal
			);
			$akun_debit_tipe = $this->coa_model->get_akun_by_name($akun_debit, $id_event);
			if ($akun_debit_tipe->saldo_normal != "Debit") $debit = $debit *-1;
			$akun_kredit_tipe = $this->coa_model->get_akun_by_name($akun_kredit, $id_event);
			if ($akun_kredit_tipe->saldo_normal != "Kredit") $kredit = $kredit *-1;
			$input_buku = array(
				'id_event' => $id_event,
				'no_voucher' => $no_voucher,
				'transaksi' => $transaksi,
				'akun' => $akun_debit,
				'value' => $debit,
				'no_jurnal' => $no_jurnal
			);
			array_push($arr_input_buku, $input_buku);
			$input_buku = array(
				'id_event' => $id_event,
				'no_voucher' => $no_voucher,
				'transaksi' => $transaksi,
				'akun' => $akun_kredit,
				'value' => $kredit,
				'no_jurnal' => $no_jurnal
			);
			array_push($arr_input_buku, $input_buku);
			array_push($arr_input_jurnal, $input_jurnal);



			$total_debit = $total_debit + $debit;
			$total_kredit = $total_kredit + $kredit;
		}
	 	if($total_kredit!=$total_debit || $total_debit==0 || $total_kredit==0){
	 		array_push($err_msg, 'Invalid Jumlah Kredit dan/atau Debit');
	 	}
	 	if (count($err_msg)>0){
		 	$this->session->set_userdata('error_messages', $err_msg);
		 	redirect(base_url().'user/error');
		} else {
			$this->send_to_jurnal($arr_input_jurnal);
			$this->send_to_buku($arr_input_buku);
			$this->session->set_userdata('success_msg','Data Berhasil Diinput');
			$this->load->model('log_model');
			$this->load->model('catatan_model');

			if($catatan != ''){
				$input_catatan = array(
					'no_jurnal' => $no_jurnal,
					'catatan' => htmlentities($catatan),
					'id_event' => $id_event
				);
				$this->catatan_model->insert($input_catatan);
			}

			$input_log = array(
				'username' => $username,
				'activity_code' => 1,
				'no_voucher' => $no_voucher,
				'id_event' => $id_event
			);
			$this->log_model->insert($input_log);
			redirect(base_url().'jurnal');
		}
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */