<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Model_ci');
		if(!$this->session->userdata('logged_in')) {redirect('auth','refresh');}//user harus login
	}

	public function profil() {		
		$id_user=$this->session->userdata('id_user');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|matches[password2]');
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]',[
			'min_length' => 'password too short!'
		]);
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		if($this->form_validation->run()==false) {
			$data['judul']='Profil User';
			$data['user']=$this->Model_ci->get_where('tb_user',array('id_user'=>$id_user));
			$this->template->display('user/profil',$data);
		} else {
			$config['upload_path'] = './assets/uploads/img/profil/';
			$config['allowed_types'] = 'jpg|jpeg';
			$config['max_size'] = 5000;
			$config['overwrite'] = true;
			$config['file_name'] = $id_user.".jpg";
			$this->upload->initialize($config);
			//input dari form
			$data=array(
				'email' => $this->input->post('email',true),
				'nama' => $this->input->post('nama',true),
				'password' => password_hash($this->input->post('password1',true), PASSWORD_DEFAULT),
				'gender' => $this->input->post('gender',true),
				'tgl_lahir' => $this->input->post('tgl_lahir',true),
				'alamat' =>  $this->input->post('alamat',true),
				'foto' =>  $this->upload->file_name
			);

			if (!$this->upload->do_upload('foto')) {
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">'.$this->upload->display_errors().'</div>');
				redirect('user/profil');
			} else {
				$update=$this->Model_ci->update('tb_user',$data,array('id_user'=>$id_user));
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Profile Updated Successfully!</div>');
				redirect('user/profil');
			}

		}
		
	}
}