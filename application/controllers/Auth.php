<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$data['judul']='Login User';
		$this->load->view('login',$data);
	}

	public function admin() {
		$data['judul']='Login Administrator';
		$this->load->view('login',$data);
	}

	public function register() {
		$data['judul']='Registrasi User';
		$this->load->view('registration',$data);
	}

	public function signup() {

	}
}