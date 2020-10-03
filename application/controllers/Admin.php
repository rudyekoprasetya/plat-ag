<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in')) {redirect('auth','refresh');}//user harus login
	}

	public function _crud_output($output = null) {
		$this->template->display('utama.php',$output);
	}

	public function encrypt_password_callback($post_array, $primary_key = null) {
		  $post_array['password'] = password_hash($post_array['password'], PASSWORD_DEFAULT);
		  return $post_array;
	}

	public function administrator() {
		$crud = new grocery_CRUD();
		//pilih tabel
		$crud->set_table('tb_admin');
		$crud->set_subject('Administrator');
		$crud->set_field_upload('foto','assets/uploads/img/');
		$crud->required_fields('email','password');
		//merubah input type password
		$crud->change_field_type('password', 'password');
		//enkripsi password
		$crud->callback_before_insert(array($this,'encrypt_password_callback'));
  		$crud->callback_before_update(array($this,'encrypt_password_callback'));
		$crud->columns('email','is_aktif');
		$data['judul']='Data Administrator';
		$data['output']=$crud->render();
		$this->_crud_output($data);
	}

	public function user() {
		$crud = new grocery_CRUD();
		//pilih tabel
		$crud->set_table('tb_user');
		$crud->set_subject('User');
		$crud->set_field_upload('foto','assets/uploads/img/');
		$crud->required_fields('email','password','nama');
		//merubah input type password
		$crud->change_field_type('password', 'password');
		//enkripsi password
		$crud->callback_before_insert(array($this,'encrypt_password_callback'));
  		$crud->callback_before_update(array($this,'encrypt_password_callback'));
  		$data['judul']='Data User';
		$data['output']=$crud->render();
		$this->_crud_output($data);
	}

	public function project() {
		$crud = new grocery_CRUD();
		//pilih tabel
		$crud->set_table('tb_project');
		$crud->set_subject('Project');
		//relasi
		$crud->set_relation('id_user','tb_user','email');
		$crud->columns('project_id','id_user','mikrokontroller','is_aktif');
		$crud->display_as('project_id','Project ID');
		$crud->display_as('id_user','Email User');
		$crud->display_as('mikrokontroller','Jenis Mikrokontroller');
		$data['judul']='Data Project';
		$data['output']=$crud->render();
		$this->_crud_output($data);
	}

	public function channel() {
		$crud = new grocery_CRUD();
		//pilih tabel
		$crud->set_table('tb_channel');
		$crud->set_subject('Channel');
		//relasi
		$crud->set_relation('project_id','tb_project','project_id');
		$crud->columns('channel_id','channel_name','tipe','is_aktif');
		$crud->display_as('channel_id','Channel ID');
		$crud->display_as('channel_name','Nama Channel');
		$crud->display_as('tipe','Tipe');
		$data['judul']='Data Channel';
		$data['output']=$crud->render();
		$this->_crud_output($data);
	}
}