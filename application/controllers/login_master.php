<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_master extends CI_Controller {

	public function index()
	{
		$this->load->helper('form');
		$data['post'] = new stdClass();
		$data['post']->post_title = 'login';
		$this->template->post('master/login', $data);
	}

	public function auth(){
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$this->load->model('Login_model');
		$this->load->model('User_model');
		$auth = $this->Login_model->get_auth_master(strip_tags($username));
		if ($password == $auth->password){
			$user_data = array(
				"username"=>$username
			);
			$this->session->set_userdata('master', $user_data);	
		
			redirect(base_url().'masteruser');
		} else {
			$this->session->set_userdata('gagal_login', 'Username atau Password salah');
			redirect(base_url().'login_master');
		}
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */