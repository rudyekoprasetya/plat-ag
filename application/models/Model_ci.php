<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ci extends CI_Model {

	public function __construct()	{
		parent::__construct();
	}

   	public function insert($table, $data) {
      return $this->db->insert($table, $data);
	}

	public function get_all($table) {
		return $this->db->get($table);
	}

	public function get_where($table, $where) {
		return $this->db->get_where($table,$where);
	}

	public function get_filter($table, $where, $order_by,$select='*') {
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by($order_by);		
		return $this->db->get();
	}

	public function update($table, $data, $where) {
		$this->db->set($data, null);
		$this->db->where($where);
		$this->db->update($table);
		return $this->db->affected_rows();
	}

	public function delete($table, $where) {
		$this->db->where($where);
		$this->db->delete($table);
		return $this->db->affected_rows();
	}

	public function total_rows($table) {
		return $this->db->count_all_results($table);
	}

	public function maxdata($id, $table) {
		$data = $this->db->select_max($id, 'lastid');
		$data = $this->db->get($table);
		return $data;
	}

	//fungsi untuk limit data
	public function get_limit($table,$from,$to) {
		return $data = $this->db->get($table,$from,$to);
	}

	//fungsi tampil data
	public function show_limit($channel_id,$limit=null) {
		$query="SELECT value, created_at FROM tb_data WHERE channel_id='$channel_id' ORDER BY id DESC LIMIT 0, $limit ";
		return $this->db->query($query);
	}

	public function show_time($channel_id,$start,$finish) {
		$query="SELECT value, created_at FROM tb_data WHERE channel_id='$channel_id' AND DATE_FORMAT(created_at,'%Y-%m-%d')>='$start' AND DATE_FORMAT(created_at,'%Y-%m-%d')<='$finish'";
		return $this->db->query($query);
	}

	//fungsi untuk ambil value terakhir untuk read data
	public function getread($channel_id) {
		$query="SELECT * FROM tb_data WHERE channel_id='$channel_id' ORDER BY id DESC LIMIT 0,1";
		return $this->db->query($query);
	}

	public function getAktif() {
		$query="SELECT * FROM tb_user ORDER BY id_user DESC";
		return $this->db->query($query);
	}

}