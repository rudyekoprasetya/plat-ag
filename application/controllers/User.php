<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Model_ci');
	}

	public function index() {
		$data['judul']='Profil User';
		$email=$this->session->userdata('email');
		$data['user']=$this->Model_ci->get_where('tb_user',array('email'=>$email))->result();
		$this->template->display('user/profil',$data);
	}
}