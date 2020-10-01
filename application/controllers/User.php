<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Model_ci');
	}

	public function profil() {
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_lenght[3]|matches[password2]');
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|min_lenght[3]|matches[password1]',[
			'matches' => 'password dont match!',
			'min_length' => 'password too short!'
		]);
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		if($this->form_validation->run()==false) {
			$data['judul']='Profil User';
			$id_user=$this->session->userdata('id_user');
			$data['user']=$this->Model_ci->get_where('tb_user',array('id_user'=>$id_user));
			$this->template->display('user/profil',$data);
		} else {

		}
		
	}
}