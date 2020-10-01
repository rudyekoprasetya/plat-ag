<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Model_ci');
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
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_user.email]',[			
			'is_unique' => 'this email has been Registered!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]',[
			'matches' => 'password dont match!',
			'min_length' => 'password too short!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		if($this->form_validation->run() == false) {
			$data['judul']='Registrasi User';
			$this->load->view('registration',$data);
		} else {
			$data=array(
				'api_key' => md5($this->input->post('email',true)),
				'email' => $this->input->post('email',true),
				'password' => password_hash($this->input->post('password2',true), PASSWORD_DEFAULT),
				'nama' => $this->input->post('nama',true),
				'gender' => $this->input->post('gender',true),
				'foto' => 'default.jpg',
				'is_aktif' => 'no',
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->Model_ci->insert('tb_user',$data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Congratulation, Your Account is Registered, Please activate your accout</div>');
			redirect('auth');

		}
		
	}

}