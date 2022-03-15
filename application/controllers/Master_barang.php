<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_barang extends CI_Controller{
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
		$this->load->model('m_master_barang');
		$this->vpk['warning'] = $this->m_warning->checkExpired();
		$this->vpk['master_barang_jenis'] = $this->m_master_barang_jenis->get_master_barang_jenis();
		$this->settings = file_get_contents("json/settings.json");
		$this->settings = json_decode($this->settings, true);
	}
	function index(){
		$this->vpk['judul'] = 'Master Barang';
		$this->vpk['part_style'] = 'admin/master_suplier/index_style';
		$this->vpk['part_view'] = 'admin/master_barang/index';
		$this->vpk['part_script'] = 'admin/master_barang/index_script';
		$this->load->view('admin', array_merge($this->vpk, $this->settings));
	}
	function ajax(){
		$search = $_POST['search']['value'];
		$limit = $_POST['length'];
		$start = $_POST['start'];
		$order_field = $_POST['order'][0]['column'];
		$order_field_data = $_POST['columns'][$order_field]['data'];
		$order_ascdesc = $_POST['order'][0]['dir'];
		$dataset = $this->m_master_barang->ajax(
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
		$jenis = $this->input->post('jenis');
		$dataset = array(
			'id' => null,
			'nama' => $nama,
			'jenis' => $jenis
		);
		$res = $this->m_master_barang->tambah($dataset);
		if($res == true){
			echo '<script>';
			echo "	alert('Berhasil menyimpan data barang, akan dialihkan!');";
			echo "	window.location = '".base_url('master_barang')."';";
			echo '</script>';
			return;
		}
		echo '<script>';
		echo "	alert('Gagal menyimpan data barang, akan dialihkan!');";
		echo "	window.location = '".base_url('master_barang')."';";
		echo '</script>';
	}
	function ubah(){
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$jenis = $this->input->post('jenis');
		$dataset = array(
			'nama' => $nama,
			'jenis' => $jenis
		);
		$res = $this->m_master_barang->ubah($dataset, $id);
		if($res == true){
			echo '<script>';
			echo "	alert('Berhasil menyimpan perubahan data barang, akan dialihkan!');";
			echo "	window.location = '".base_url('master_barang')."';";
			echo '</script>';
			return;
		}
		echo '<script>';
		echo "	alert('Gagal menyimpan perubahan data barang, akan dialihkan!');";
		echo "	window.location = '".base_url('master_barang')."';";
		echo '</script>';
	}
	function hapus($id = null){
		$res = $this->m_master_barang->hapus($id);
		if($res == true){
			echo '<script>';
			echo "	alert('Berhasil menghapus data barang, akan dialihkan!');";
			echo "	window.location = '".base_url('master_barang')."';";
			echo '</script>';
			return;
		}
		echo '<script>';
		echo "	alert('Gagal menghapus data barang, akan dialihkan!');";
		echo "	window.location = '".base_url('master_barang')."';";
		echo '</script>';
	}
}