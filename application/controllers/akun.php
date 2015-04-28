<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Akun extends CI_Controller {
    private $id_event;
    public function __construct(){
            parent::__construct();
            $session  = $this->session->userdata('user_data');
            if (!$session){
                redirect('login');
            } else if ($session['user_level'] != 0){
                redirect('user');
            }
            $this->id_event = $this->session->userdata('user_data');
            $this->id_event = $this->id_event['event_id'];

    }

    public function index(){
    	$this->load->model('akun_model');
    	$data['akun'] = $this->akun_model->get_all($this->id_event);
    	$this->template->user('superuser/akun', $data);
    }

    public function add(){
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $this->load->model('akun_model');

        if ($this->akun_model->isAvailable($username)){
            $akun_input = array(
                'username'=> $username,
                'password' => $password,
                'event_id' => $this->id_event,
                'user_level' => $this->input->post('user_level')   
            );
            $this->akun_model->add($akun_input);
            $this->session->set_userdata('success_msg', "Akun berhasil ditambahkan");
            redirect(base_url().'akun');
        } else {
            $this->session->set_userdata('err_msg', "username sudah terdaftar, coba dengan yang lain");
            redirect(base_url().'akun');
        }
    }

    public function delete(){
        $this->load->model('akun_model');
        $this->akun_model->delete($this->input->post('username'));
        $this->session->set_userdata('success_msg', "Akun berhasil Dihapus");
        redirect(base_url().'akun');
    }
}
