<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Model_ci');
	}

	public function index() {
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if($this->form_validation->run() == false) {			
			$data['judul']='Login User';
			$data['url']='index';
			$this->load->view('login',$data);
		} else {
			$email=$this->input->post('email',true);
			$password=$this->input->post('password',true);
			$cekEmail=$this->Model_ci->get_where('tb_user',array('email'=>$email));
			//jika email ada
			if($cekEmail->num_rows()>0) {
				$dataUser=$cekEmail->row();
				if($dataUser->is_aktif=='yes') {
					//cek password
					if(password_verify($password, $dataUser->password)) {
						$data=array(
							'id_user'=>$dataUser->id_user,
							'akses'=> 'user',
							'logged_in'=>true
						);
						$this->session->set_userdata($data);
						redirect('dashboard/user');
					} else {
						$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Wrong Password!</div>');
						redirect('auth');
					}
				} else {
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Your account not activated</div>');
						redirect('auth');
				}									
			} else {
				//jika email tidak ada
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email not Registered</div>');
				redirect('auth');
			}
		}
	}

	public function admin() {
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if($this->form_validation->run()==false) {
			$data['judul']='Login Administrator';
			$data['url']='admin';
			$this->load->view('login',$data);
		} else {
			$email=$this->input->post('email',true);
			$password=$this->input->post('password',true);
			$cekEmail=$this->Model_ci->get_where('tb_admin',array('email'=>$email));
			//jika email ada
			if($cekEmail->num_rows()>0) {
				$dataUser=$cekEmail->row();
				if($dataUser->is_aktif=='yes') {
					//cek password
					if(password_verify($password, $dataUser->password)) {
						$data=array(
							'id_user'=>$dataUser->id_user,
							'akses'=> 'admin',
							'logged_in'=>true
						);
						$this->session->set_userdata($data);
						redirect('dashboard/admin');
					} else {
						$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Wrong Password!</div>');
						redirect('auth/admin');
					}
				} else {
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Your Admin account not activated</div>');
						redirect('auth/admin');
				}									
			} else {
				//jika email tidak ada
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email not Registered</div>');
				redirect('auth/admin');
			}

		}
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
				'password' => password_hash($this->input->post('password1',true), PASSWORD_DEFAULT),
				'nama' => $this->input->post('nama',true),
				'gender' => $this->input->post('gender',true),
				'foto' => 'default.jpg',
				'is_aktif' => 'no',
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->Model_ci->insert('tb_user',$data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Congratulation, Please activate your account</div>');
			redirect('auth');
		}		
	}

	public function logout() {
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('akses');
		$this->session->unset_userdata('logged_in');
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Success Logout</div>');
		redirect('auth');

	}

}