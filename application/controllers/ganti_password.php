<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ganti_password extends CI_Controller {
    private $id_event;
	public function __construct(){
            parent::__construct();
            $session  = $this->session->userdata('user_data');
            if (!$session){
            	redirect(base_url().'login');
            }
            $this->id_event = $this->session->userdata('user_data')['event_id'];

    }

    public function index(){
        $data['user_data'] = $this->session->userdata('user_data');
    	$this->template->user('ganti_password', $data);
    }

    public function ganti(){
        $this->load->model('akun_model');
        $username = $this->input->post('username');
        $akun = $this->akun_model->get_by_username($username);
        $old = md5($this->input->post('password-old'));
        $new = md5($this->input->post('password-new'));
        $confirm = md5($this->input->post('password-confirm'));
        if ($akun->password != $old){
            $this->session->set_userdata('gagal_ganti','Password lama salah');
            redirect(base_url().'ganti_password');
            return;
        }
        if ($new != $confirm){
            $this->session->set_userdata('gagal_ganti','Password konfirmasi salah');
            redirect(base_url().'ganti_password');
            return;
        }
        $data = array(
            'password'=>$new,
        );
        $this->akun_model->ganti_password($username, $data);

        $this->session->set_userdata('berhasil_ganti','Password berhasil diganti');
        redirect(base_url().'ganti_password');

    }

}
