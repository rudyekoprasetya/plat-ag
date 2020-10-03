<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Model_ci');
		if(!$this->session->userdata('logged_in')) {redirect('auth','refresh');}//user harus login
	}

	public function admin() {
		$data['judul']="Dashboard Admin";
		$data['user']=$this->Model_ci->get_all('tb_user')->num_rows();
		$data['project']=$this->Model_ci->get_all('tb_project')->num_rows();
		$data['channel']=$this->Model_ci->get_all('tb_channel')->num_rows();
		$this->template->display('admin/home',$data);
	}

	public function user() {
		$id_user=$this->session->userdata('id_user');
		$data['judul']="Dashboard User";
		$project=$this->Model_ci->get_where('tb_project',array('id_user'=>$id_user));
		$hasil=$project->row();
		$data['project']=$project->num_rows();
		$data['channel']=$this->Model_ci->get_where('tb_channel',array('project_id'=>$hasil->project_id))->num_rows();
		$this->template->display('user/home',$data);
	}
}