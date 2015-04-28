<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catatan extends CI_Controller {
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
    	$this->load->model('catatan_model');
    	$data['catatan'] = $this->catatan_model->get_all($this->id_event);
    	$this->template->user('user/catatan', $data);
    }

    public function search(){	
    	$this->load->model('catatan_model');
    	$search = $this->input->post('search');
		$catatan = $this->catatan_model->search($search,$this->id_event);
		$this->print_catatan($catatan);
    }

    public function print_catatan($catatan){
		echo "<table class='table'>";
		echo "<thead><tr><th>No Jurnal</th><th>Catatan</th></tr></thead>";
		echo "<tbody>";
		foreach ($catatan as $c) { 
			echo "<tr><td>$c->no_jurnal</td><td>$c->catatan</td></tr>";
		}//foreach
		echo "</tbody>";
    	echo "</table>";
    }
}
