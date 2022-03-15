<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_barang_jenis extends CI_Controller{
	private $su = ['super'];
	private $wosu = ['worker','super'];
	private $urol;
	private $vpk = [];
	private $settings;
	function __construct(){
		parent::__construct();
		$this->urol = $this->session->userdata('user_role');
		auth($this->urol, $this->su);
		$this->load->model('m_master_barang_jenis');
		$this->vpk['warning'] = $this->m_warning->checkExpired();
		$this->settings = file_get_contents("json/settings.json");
		$this->settings = json_decode($this->settings, true);
	}
	function index(){
		$this->vpk['judul'] = 'Master Barang Jenis';
		$this->vpk['part_style'] = 'admin/master_suplier/index_style';
		$this->vpk['part_view'] = 'admin/master_barang_jenis/index';
		$this->vpk['part_script'] = 'admin/master_barang_jenis/index_script';
		$this->load->view('admin', array_merge($this->vpk, $this->settings));
	}
	function ajax(){
		$search = $_POST['search']['value'];
		$limit = $_POST['length'];
		$start = $_POST['start'];
		$order_field = $_POST['order'][0]['column'];
		$order_field_data = $_POST['columns'][$order_field]['data'];
		$order_ascdesc = $_POST['order'][0]['dir'];
		$dataset = $this->m_master_barang_jenis->ajax(
			$search,
			$limit,
			$start,
			$order_field_data,
			$order_ascdesc
		);
		$callback = array(
			'draw'=>$_POST['draw'],
			'recordsTotal'=>$dataset['recordsTotal'],
			'recordsFiltered'=>$dataset['recordsFiltered'],
			'data'=>$dataset['data']
		);
		header('Content-Type: application/json');
		echo json_encode($callback);
	}
	function tambah(){
		$nama = $this->input->post('nama');
		$dataset = array(
			'id' => null,
			'nama' => $nama
		);
		$res = $this->m_master_barang_jenis->tambah($dataset);
		if($res == true){
			echo '<script>';
			echo "	alert('Berhasil menyimpan data barang jenis, akan dialihkan!');";
			echo "	window.location = '".base_url('master_barang_jenis')."';";
			echo '</script>';
			return;
		}
		echo '<script>';
		echo "	alert('Gagal menyimpan data barang jenis, akan dialihkan!');";
		echo "	window.location = '".base_url('master_barang_jenis')."';";
		echo '</script>';
	}
	function ubah(){
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$dataset = array(
			'nama' => $nama
		);
		$res = $this->m_master_barang_jenis->ubah($dataset, $id);
		if($res == true){
			echo '<script>';
			echo "	alert('Berhasil menyimpan perubahan data barang jenis, akan dialihkan!');";
			echo "	window.location = '".base_url('master_barang_jenis')."';";
			echo '</script>';
			return;
		}
		echo '<script>';
		echo "	alert('Gagal menyimpan perubahan data barang jenis, akan dialihkan!');";
		echo "	window.location = '".base_url('master_barang_jenis')."';";
		echo '</script>';
	}
	function hapus($id = null){
		$res = $this->m_master_barang_jenis->hapus($id);
		if($res == true){
			echo '<script>';
			echo "	alert('Berhasil menghapus data barang jenis, akan dialihkan!');";
			echo "	window.location = '".base_url('master_barang_jenis')."';";
			echo '</script>';
			return;
		}
		echo '<script>';
		echo "	alert('Gagal menghapus data barang jenis, akan dialihkan!');";
		echo "	window.location = '".base_url('master_barang_jenis')."';";
		echo '</script>';
	}
}