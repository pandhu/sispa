<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Akun_master extends CI_Controller {
    private $id_event;
    public function __construct(){
            parent::__construct();
            $session  = $this->session->userdata('master');
            if (!$session){
                redirect(base_url().'login_master');
            }

    }

    public function index(){
    	$this->load->model('akun_model');
    	$data['akun'] = $this->akun_model->get_all_master();
        $this->load->model('event_model');
        $data['event'] = $this->event_model->get_all_event();
    	$this->template->master('master/akun', $data);
    }

    public function add(){
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $this->load->model('akun_model');

        if ($this->akun_model->isAvailable($username)){
            $akun_input = array(
                'username'=> $username,
                'password' => $password,
                'event_id' => $this->input->post('event_id'),
                'user_level' => $this->input->post('user_level')   
            );
            $this->akun_model->add($akun_input);
            $this->session->set_userdata('success_msg', "Akun berhasil ditambahkan");
            redirect(base_url().'akun_master');
        } else {
            $this->session->set_userdata('err_msg', "username sudah terdaftar, coba dengan yang lain");
            redirect(base_url().'akun_master');
        }
    }

    public function delete(){
        $this->load->model('akun_model');
        $this->akun_model->delete($this->input->post('username'));
        $this->session->set_userdata('success_msg', "Akun berhasil Dihapus");
        redirect(base_url().'akun_master');
    }
}	
