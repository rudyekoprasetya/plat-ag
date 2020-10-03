<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Channel extends CI_Controller {

	public $table='tb_channel';

	public function __construct() {
		parent::__construct();
		$this->load->model('Model_ci');
		if(!$this->session->userdata('logged_in')) {redirect('auth','refresh');}//user harus login
	}

	public function index() {
		$project_id=base64_decode($this->uri->segment(3));
		$data['judul']="Channels for ".$project_id;
		$data['channel']=$this->Model_ci->get_where($this->table,array('project_id'=>$project_id));
		$this->template->display('user/channel',$data);
	}

	public function add() {
		$dataUser=$this->Model_ci->get_where('tb_user',array('id_user'=>$this->session->userdata('id_user')))->row();
		$char=substr($dataUser->nama, 0,3);
		$channel_id="CH".strtoupper($char).date('YmdHis');
		$data=array(
			'project_id'=>$this->input->post('project_id',true),
			'channel_id'=>$channel_id,
			'channel_name'=>$this->input->post('channel_name',true),
			'tipe'=>$this->input->post('tipe',true),
			'is_aktif'=>$this->input->post('is_aktif',true)
		);
		$this->Model_ci->insert($this->table,$data);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Channel Created</div>');
		redirect('channel/index/'.base64_encode($this->input->post('project_id',true)));
	}

	public function edit() {
		$id_channel=$this->input->post('id_channel',true);
		$data=$this->Model_ci->get_where($this->table,array('id_channel'=>$id_channel))->row();
		?>
		 <form method="POST" action="<?= site_url('channel/update'); ?>">
        <input type="hidden" name="project_id" value="<?= $data->project_id; ?>">
        <input type="hidden" name="id_channel" value="<?= $data->id_channel; ?>">
        <input type="hidden" name="channel_id" value="<?= $data->channel_id; ?>">
      	<label>Nama Channel</label>
      	<input type="text" name="channel_name" class="form-control" required="required" value="<?= $data->channel_name; ?>">        
        <label>Tipe</label>
        <select class="form-control" name="tipe">
          <option value="read">Read Data</option>
          <option value="write">Write Data</option>
        </select>
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
		$project_id=$this->input->post('project_id',true);
		$data=array(
			'channel_id'=>$this->input->post('channel_id',true),
			'project_id'=>$project_id,
			'channel_name'=>$this->input->post('channel_name',true),
			'tipe'=>$this->input->post('tipe',true),
			'is_aktif'=>$this->input->post('is_aktif',true)
		);
		$this->Model_ci->update($this->table,$data,array('id_channel'=>$this->input->post('id_channel')));
		$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Channel Updated!</div>');
		redirect('channel/index/'.base64_encode($project_id));
	}

	public function delete(){
		$project_id=base64_decode($this->uri->segment(3));
		$id_channel=$this->uri->segment(4);
		$this->Model_ci->delete($this->table,array('id_channel'=>$id_channel));
		$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Channel Deleted!</div>');
		redirect('channel/index/'.base64_encode($project_id));
	}

	public function show_data() {
		$channel_id=$this->input->post('channel_id',true);
		$data=$this->Model_ci->show_limit($channel_id,50)->result();
		$dataCH=array(
			'channel_id' => $channel_id,
			'data' => $data
		);
		echo json_encode($dataCH);

	}

}