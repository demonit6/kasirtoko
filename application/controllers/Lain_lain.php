<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lain_lain extends CI_Controller{
	private $su = ['super'];
	private $wosu = ['worker','super'];
	private $urol;
	private $vpk = [];
	private $settings;
	function __construct(){
		parent::__construct();
		$this->urol = $this->session->userdata('user_role');
		auth($this->urol, $this->su);
		$this->load->model('m_stok');
		$this->vpk['warning'] = $this->m_warning->checkExpired();
		$this->settings = file_get_contents("json/settings.json");
		$this->settings = json_decode($this->settings, true);
	}
	function index(){
		$this->vpk['judul'] = 'Lain lain';
		$this->vpk['part_style'] = 'admin/master_suplier/index_style';
		$this->vpk['part_view'] = 'admin/lain_lain/index';
		$this->load->view('admin', array_merge($this->vpk, $this->settings));
	}
}