<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Controller {

	public $table='tb_project';

	public function __construct() {
		parent::__construct();
		$this->load->model('Model_ci');
		if(!$this->session->userdata('logged_in')) {redirect('auth','refresh');}//user harus login
	}

	public function index() {
		$data['judul']="My Projects";
		$data['project']=$this->Model_ci->get_where($this->table,array('id_user'=>$this->session->userdata('id_user')));
		$this->template->display('user/project',$data);
	}

	public function add() {
		$dataUser=$this->Model_ci->get_where('tb_user',array('id_user'=>$this->session->userdata('id_user')))->row();
		$char=substr($dataUser->nama, 0,3);
		$project_id=strtoupper($char)."-".date('YmdHis');
		// echo $project_id;
		$data=array(
			'project_id' =>  $project_id,
			'id_user' => $this->session->userdata('id_user'),
			'deskripsi' => $this->input->post('deskripsi',true),
			'mikrokontroller' => $this->input->post('mikrokontroller',true),
			'longitude' => $this->input->post('longitude',true),
			'latitude' => $this->input->post('latitude',true),
			'is_aktif' => $this->input->post('is_aktif',true)
		);
		$this->Model_ci->insert($this->table,$data);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Project Created</div>');
		redirect('project');
	}

	public function edit() {
		$id_project=$this->input->post('id_project',true);
		$data=$this->Model_ci->get_where($this->table,array('id_project'=>$id_project))->row();
		?>
		<form method="POST" action="<?= site_url('project/update'); ?>">
		<input type="hidden" name="id_project" value="<?= $data->id_project; ?>">		
      	<label>Jenis Mikrokontroller</label>
      	<input type="text" name="mikrokontroller" class="form-control" required="required" value="<?= $data->mikrokontroller; ?>">
      	<label>Deskripsi</label>
      	<textarea class="form-control" name="deskripsi" required="required"><?= $data->id_project; ?></textarea>
      	<label>Longitude</label>
      	<input type="text" name="longitude" class="form-control" value="<?= $data->longitude; ?>">
      	<label>Latitude</label>
      	<input type="text" name="latitude" class="form-control" value="<?= $data->latitude; ?>">
      	<label>Aktif</label>
      	<select class="form-control" name="is_aktif">
      		<option value="yes">yes</option>
      		<option value="no">no</option>
      	</select>
      </div>
      <div class='modal-footer'>
        <button type='submit' class='btn btn-primary'><i class="fa fa-save"></i> Update</button>
        <button type='button' class='btn btn-default' data-dismiss='modal'><i class="fa fa-times"></i> Cancel</button>
       </form>
		<?php
	}

	public function update() {
		$data=array(
			'id_user' => $this->session->userdata('id_user'),
			'deskripsi' => $this->input->post('deskripsi',true),
			'mikrokontroller' => $this->input->post('mikrokontroller',true),
			'longitude' => $this->input->post('longitude',true),
			'latitude' => $this->input->post('latitude',true),
			'is_aktif' => $this->input->post('is_aktif',true)
		);
		$this->Model_ci->update($this->table,$data,array('id_project'=>$this->input->post('id_project',true)));
		$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Project Updated</div>');
		redirect('project');
	}

	public function delete() {
		$id_project=$this->uri->segment(3);
		$this->Model_ci->delete($this->table,array('id_project'=>$id_project));
		$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Project Deleted</div>');
		redirect('project');
	}

}