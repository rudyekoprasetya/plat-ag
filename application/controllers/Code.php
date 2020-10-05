<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Code extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Model_ci');
		if(!$this->session->userdata('logged_in')) {redirect('auth','refresh');}//user harus login
	}

	public function index() {
		$data['judul']="Panduan Code";
		$this->template->display('user/code',$data);
	}

	

}