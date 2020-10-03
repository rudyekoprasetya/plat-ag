<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Model_ci');
		if(!$this->session->userdata('logged_in')) {redirect('auth','refresh');}//user harus login
	}

	public function index() {
		$id_user=$this->session->userdata('id_user');
		$data['judul']="Report My Projects";
		$data['project']=$this->Model_ci->get_where('tb_project',array('id_user'=>$id_user));
		$this->template->display('user/report',$data);
	}

	public function getChannel() {
		$project_id=$this->input->post('project_id',true);
		$data=$this->Model_ci->get_where('tb_channel',array('project_id'=>$project_id));
		foreach($data->result() as $row) {
		?>
		<option value="<?= $row->channel_id; ?>"><?= $row->channel_name; ?></option>
		<?php	
		}
	}

	public function getchart() {
		$channel_id=$this->input->post('channel_id',true);
		$hasil=$this->Model_ci->get_where('tb_data',array('channel_id'=>$channel_id));
		$data=[];
		foreach ($hasil->result() as $row) {
			array_push($data, (int)$row->value);
		}
		echo json_encode($data);
	}

	public function getgauge() {
		$channel_id=$this->input->post('channel_id',true);
		$query="SELECT value FROM tb_data WHERE channel_id='$channel_id' ORDER BY id DESC" ;
		$hasil=$this->db->query($query)->row();

		echo json_encode((int)$hasil->value);
	}

	public function gettabel() {
		$channel_id=$this->input->post('channel_id',true);
		$query="SELECT value, created_at FROM tb_data WHERE channel_id='$channel_id' ORDER BY id DESC" ;
		$hasil=$this->db->query($query);
		$no=0;
		foreach($hasil->result() as $row){
			?>
			<tr>
				<td><?= $no++; ?></td>
				<td><?= $row->created_at; ?></td>
				<td><?= $row->value; ?></td>
			</tr>
			<?php
		}
		
	}

	public function kirim_data() {
		$channel_id=$this->input->post('channel_id',true);
		$value=$this->input->post('value',true);
		$data=array(
			'channel_id' => $channel_id,
			'value' => $value,
			'created_at' => date('Y-m-d H:i:S')
		);
		$this->Model_ci->insert('tb_data',$data);
		echo "Success Send Data!";
	}


}