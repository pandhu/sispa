<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->helper('form');
		$data['post'] = new stdClass();
		$data['post']->post_title = 'login';
		$this->template->post('login', $data);
	}

	public function auth(){
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$this->load->model('Login_model');
		$this->load->model('User_model');
		$auth = $this->Login_model->get_auth(strip_tags($username));
		if ($password == $auth->password){
			$this->session->set_userdata('auth', $auth);	
			$data = $this->User_model->get_data(strip_tags($username));
			$user_data = array(
				"username"=>$username,
				"event_id"=>$data->event_id,
				"user_level"=>$data->user_level
			);
			$this->session->set_userdata('auth', $auth);	
			$this->session->set_userdata('user_data', $user_data);	
			if ($data->user_level==0){
				redirect(base_url().'superuser');
			} else
				redirect(base_url().'user');
		} else {
			$this->session->set_userdata('gagal_login', 'Username atau Password salah');
			redirect('login');
		}
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */