<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Superuser extends CI_Controller {
    private $id_event;
	public function __construct(){
            parent::__construct();
            $session  = $this->session->userdata('user_data');
            if (!$session){
            	redirect(base_url().'login');
            } else if ($session['user_level'] != 0){
                redirect(base_url().'user');
            }
            $this->id_event = $this->session->userdata('user_data');
            $this->id_event = $this->id_event['event_id'];

    }

    public function index(){
    	$this->load->model('catatan_model');
    	$this->load->model('event_model');
        $event_id = $this->session->userdata('user_data');
        $event_id = $event_id['event_id'];
        $event_data = $this->event_model->get_event_data($event_id);
        $data['event_data'] = $event_data;  
    	$this->template->user('superuser/dashboard', $data);
    }

    public function save_event_detail(){

        $input_event = array(
            'id_event'=> $this->id_event,
            'support'=> $this->input->post('support'),
            'pj'=> $this->input->post('pj'),
            'kabiro_ki'=> $this->input->post('kabiro_ki'),
            'auditor'=> $this->input->post('auditor'),
            'penyerahan'=> $this->input->post('penyerahan'),
            'penyelesaian'=> $this->input->post('penyelesaian'),
            'description'=> $this->input->post('description'),
            'pj_keuangan'=> $this->input->post('pj_keuangan')
        );
        $this->load->model('event_model');
        $this->event_model->update($input_event, $this->id_event);
        $this->session->set_userdata('success_msg','Data Berhasil Diupdate');
        redirect(base_url().'superuser');
        var_dump($input_event);
    }
}
