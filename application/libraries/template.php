<?php if(!defined('BASEPATH')) exit('No Direct script access allowed');

class Template {
	protected $_ci;

	function __construct() {
		$this->_ci = &get_instance();
	}
	
	function post($template, $data=null) {
		$data['content'] = $this->_ci->load->view($template, $data, true);
		if ($data['post']) $data['title'] = $data['post']->post_title;
		else $data['post'] = '';
		$this->_ci->load->view('template',$data);
	}

	function user($template, $data=null) {
		$this->_ci->load->model('jurnal_model');
		$this->_ci->load->model('coa_model');
		$id_event = $this->_ci->session->userdata('user_data');
		$id_event = $id_event['event_id'];
		$data['akun_kredit'] = $this->_ci->coa_model->get_akun($id_event);
		$data['akun_debit'] = $this->_ci->coa_model->get_akun($id_event);
		$data['no_jurnal'] = 1;
		$data['voucher_in'] = 1;
		$data['voucher_ot'] = 1;
		$data['voucher_ju'] = 1;			
		
		$data_jurnal = $this->_ci->jurnal_model->get_last_voucher('IN', $id_event);
		if($data_jurnal){
			$data_jurnal = explode('-',$data_jurnal->no_voucher);
			$data['voucher_in'] = (int)($data_jurnal[1])+1;
		}
		
		$data_jurnal = $this->_ci->jurnal_model->get_last_voucher('OT', $id_event);
		if($data_jurnal){
			$data_jurnal = explode('-',$data_jurnal->no_voucher);
			$data['voucher_ot'] = (int)($data_jurnal[1])+1;
		}

		$data_jurnal = $this->_ci->jurnal_model->get_last_voucher('JU', $id_event);
		if($data_jurnal){
			$data_jurnal = explode('-',$data_jurnal->no_voucher);
			$data['voucher_ju'] = (int)($data_jurnal[1])+1;
		}

		$data_jurnal = $this->_ci->jurnal_model->get_last($id_event);
		if($data_jurnal){
			$data['no_jurnal'] = $data_jurnal->id +1;
		}
		
		$data['content'] = $this->_ci->load->view($template, $data, true);
		$this->_ci->load->view('user/template',$data);
	}

	function master($template, $data=null) {
		$data['content'] = $this->_ci->load->view($template, $data, true);
		$this->_ci->load->view('master/template',$data);
	}

}
?>