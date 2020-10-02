<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Model_ci');
		//Config CORS
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: *");
		header("Access-Control-Allow-Headers: *");
		header('Content-Type: application/json');

	}

	public function is_key_valid($key)	{
		//cek apikey dalah database
		$datakey=$this->Model_ci->get_where('tb_user',array('api_key'=>$key));
		if ($datakey->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	//fungsi untuk baca data dari iot
	//format http://base_url/api/read?api_key=$key&ch=$channel&val=$val
	public function read() {
		$key=$this->is_key_valid($_GET['api_key']);
		if($key) {
			$channel_id=$_GET['ch'];
			$cekChannel=$this->Model_ci->get_where('tb_channel',array('channel_id'=>$channel_id));
			if($cekChannel->num_rows() > 0) {
				$cekRead=$cekChannel->row();
				//cek apakah tipenya read
				if($cekRead->tipe=='read') {
					$value=(float)$_GET['val'];
					//cek value
					if(is_float($value)) {
						//simpan dalam database di tb_data
						$data=array(
							'channel_id' => $channel_id,
							'value' => $value,
							'created_at' => date('Y-m-d H:i:s')
						);
						$this->Model_ci->insert('tb_data',$data);
						$response=array(
							'status' => http_response_code(200),
							'message' => 'Connected to PlatAG'
						);
					} else {
						$response=array(
							'status' => http_response_code(400),
							'message' => 'Invalid Value, only Numeric Value'
						);
					}
				} else {
					$response=array(
						'status' => http_response_code(400),
						'message' => 'Invalid tipe Request, Channel read only'
					);
				}
				
			} else {
				$response=array(
					'status' => http_response_code(400),
					'message' => 'Invalid Channel ID'
				);
			}
		} else {
			$response=array(
				'status' => http_response_code(401),
				'message' => 'Invalid API Key'
			);
		}
		$this->output->set_output(json_encode($response));
	}

	//fungsi get value dari database untuk aksi write
	public function getread() {
		$key=$this->is_key_valid($_GET['api_key']);
		if($key) {
			$channel_id=$_GET['ch'];
			$cekChannel=$this->Model_ci->get_where('tb_channel',array('channel_id'=>$channel_id));
			if($cekChannel->num_rows() > 0) {
				$cekRead=$cekChannel->row();
				//cek apakah tipenya read
				if($cekRead->tipe=='write') {
					$cekData=$this->Model_ci->getread($channel_id)->row();
					//ambil value terakhir dan kirim ke perangkat
					$response=array(
						'status' => http_response_code(200),
						'data' => (int)$cekData->value,
						'message' => 'Get Data from PlatAG'
					);
				} else {
					$response=array(
						'status' => http_response_code(400),
						'message' => 'Invalid tipe Request, Channel write only'
					);
				}				
			} else {
				$response=array(
					'status' => http_response_code(400),
					'message' => 'Invalid Channel ID'
				);
			}
		} else {
			$response=array(
				'status' => http_response_code(401),
				'message' => 'Invalid API Key'
			);
		}
		$this->output->set_output(json_encode($response));
	} 


	//fungsi untuk baca data dari iot
	//format http://base_url/api/write?api_key=$key&ch=$channel&val=$val
	public function write() {
		$key=$this->is_key_valid($_GET['api_key']);
		if($key) {
			$channel_id=$_GET['ch'];
			$cekChannel=$this->Model_ci->get_where('tb_channel',array('channel_id'=>$channel_id));
			if($cekChannel->num_rows() > 0) {
				$cekWrite=$cekChannel->row();
				if($cekWrite->tipe=='write') {
					$value=(int)$_GET['val'];
					//cek value
					if(is_int($value)) {
						//simpan dalam database di tb_data
						$data=array(
							'channel_id' => $channel_id,
							'value' => $value,
							'created_at' => date('Y-m-d H:i:s')
						);
						//masukan data dalam database
						$this->Model_ci->insert('tb_data',$data);
						//kirim ke perangkat IOT
						$response=array(
							'status' => http_response_code(200),
							'data' => $value,
							'message' => 'Saved to PlatAG'
						);					
					} else {
						$response=array(
							'status' => http_response_code(400),
							'message' => 'Invalid Value, only Interger Value'
						);
					}	
				} else {
					$response=array(
						'status' => http_response_code(400),
						'message' => 'Invalid Tipe Request, Channel Write Only'
					);
				}
			} else {
				$response=array(
					'status' => http_response_code(400),
					'message' => 'Invalid Channel ID'
				);
			}

		} else {
			$response=array(
				'status' => http_response_code(401),
				'message' => 'Invalid API Key'
			);
		}
		$this->output->set_output(json_encode($response));
	}

	public function show() {
		$key=$this->is_key_valid($_GET['api_key']);
		if($key) {
			$channel_id=$_GET['ch'];
			$cekChannel=$this->Model_ci->get_where('tb_channel',array('channel_id'=>$channel_id));
			if($cekChannel->num_rows() > 0) {
				if(isset($_GET['limit'])) {
					//jika menampilkan data dengan batas tertentu
					$data=$this->Model_ci->show_limit($channel_id,$_GET['limit'])->result();
				} else if((isset($_GET['start'])) && (isset($_GET['finish']))) {
					//menampilkan dengan rentang waktu
					$data=$this->Model_ci->show_time($channel_id,$_GET['start'],$_GET['finish'])->result();
				} else {
					//tampilkan 50 data aja
					$data=$this->Model_ci->show_limit($channel_id,50)->result();
				}
				if($data) {
					$response=array(
						'status' => http_response_code(200),
						'data' => $data
					);
				} else {
					$response=array(
						'status' => http_response_code(404),
						'message' => 'No Data'
					);
				}
				
			} else {
				$response=array(
					'status' => http_response_code(400),
					'message' => 'Invalid Channel ID'
				);
			}
		} else {
			$response=array(
				'status' => http_response_code(401),
				'message' => 'Invalid API Key'
			);
		}
		$this->output->set_output(json_encode($response));
	}

}