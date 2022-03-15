<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
	private $su = ['super'];
	private $wosu = ['worker','super'];
	private $urol;
	private $vpk = [];
	private $settings;
	function __construct(){
		parent::__construct();
		$this->urol = $this->session->userdata('user_role');
		auth($this->urol, $this->wosu);
		$this->vpk['warning'] = $this->m_warning->checkExpired();
		$this->settings = file_get_contents('json/settings.json');
		$this->settings = json_decode($this->settings, true);
	}
	function index(){
		$now = date('Y-m-d 00:00:00');
		$this->vpk['judul'] = 'Dash';
		$this->vpk['part_view'] = 'admin/index';
		$this->vpk['laporan_pembelian'] = $this->db->query("
			SELECT a.pendataan_masuk AS pm, a.user_id, b.*
			FROM pembelian a
			INNER JOIN pembelian_detail b
			ON a.id = b.id
			WHERE a.pendataan_masuk
			BETWEEN '$now' AND '$now' + INTERVAL 1 DAY
			")->result_array();
		$this->vpk['laporan_penjualan'] = $this->db->query("
			SELECT * FROM penjualan
			WHERE pendataan_masuk
			BETWEEN '$now' AND '$now' + INTERVAL 1 DAY
			")->result_array();
		$this->load->view('admin', array_merge($this->vpk, $this->settings));
	}
	function warning(){
		$this->vpk['listcheck'] = $this->m_warning->listCheck();
		$this->vpk['judul'] = 'Peringatan';
		$this->vpk['part_view'] = 'admin/warning';
		$this->load->view('admin', array_merge($this->vpk, $this->settings));
	}
	function settings(){
		auth($this->urol, $this->su);
		$this->vpk['judul'] = 'Pengaturan';
		$this->vpk['part_view'] = 'admin/settings';
		$this->load->view('admin', array_merge($this->vpk, $this->settings));
	}
	function settings_save(){
		auth($this->urol, $this->su);
		$nama_toko = $this->input->post('nama_toko');
		$ucapan = $this->input->post('ucapan');
		$ucapan_status = $this->input->post('ucapan_status');
		if(!empty($nama_toko)){
			$this->settings['nama_toko'] = $nama_toko;
		}
		if(!empty($ucapan)){
			$this->settings['ucapan'] = $ucapan;
		}
		if(!empty($ucapan_status)){
			$this->settings['ucapan_status'] = $ucapan_status;
		}
		file_put_contents('json/settings.json', json_encode($this->settings));
		echo '<script>';
		echo "	alert('Berhasil mengganti beberapa data, akan dialihkan!');";
		echo "	window.location = '".base_url('admin/settings')."';";
		echo '</script>';

	}
	function logout(){
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user_role');
		echo '<script>';
		echo "	alert('Berhasil keluar, akan dialihkan!');";
		echo "	window.location = '".base_url('login')."';";
		echo '</script>';
	}
}