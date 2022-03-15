<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_suplier extends CI_Controller{
	private $su = ['super'];
	private $wosu = ['worker','super'];
	private $urol;
	private $vpk = [];
	private $settings;
	function __construct(){
		parent::__construct();
		$this->urol = $this->session->userdata('user_role');
		auth($this->urol, $this->su);
		$this->load->model('m_master_suplier');
		$this->vpk['warning'] = $this->m_warning->checkExpired();
		$this->settings = file_get_contents("json/settings.json");
		$this->settings = json_decode($this->settings, true);
	}
	function index(){
		$this->vpk['judul'] = 'Master Suplier';
		$this->vpk['part_style'] = 'admin/master_suplier/index_style';
		$this->vpk['part_view'] = 'admin/master_suplier/index';
		$this->vpk['part_script'] = 'admin/master_suplier/index_script';
		$this->load->view('admin', array_merge($this->vpk, $this->settings));
	}
	function ajax(){
		$search = $_POST['search']['value'];
		$limit = $_POST['length'];
		$start = $_POST['start'];
		$order_field = $_POST['order'][0]['column'];
		$order_field_data = $_POST['columns'][$order_field]['data'];
		$order_ascdesc = $_POST['order'][0]['dir'];
		$dataset = $this->m_master_suplier->ajax(
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
		$perusahaan = $this->input->post('perusahaan');
		$pemilik = $this->input->post('pemilik');
		$alamat = $this->input->post('alamat');
		$kontak = $this->input->post('kontak');
		$dataset = array(
			'id' => null,
			'perusahaan' => $perusahaan,
			'pemilik' => $pemilik,
			'alamat' => $alamat,
			'kontak' => $kontak
		);
		$res = $this->m_master_suplier->tambah($dataset);
		if($res == true){
			echo '<script>';
			echo "	alert('Berhasil menyimpan data suplier, akan dialihkan!');";
			echo "	window.location = '".base_url('master_suplier')."';";
			echo '</script>';
			return;
		}
		echo '<script>';
		echo "	alert('Gagal menyimpan data suplier, akan dialihkan!');";
		echo "	window.location = '".base_url('master_suplier')."';";
		echo '</script>';
	}
	function ubah(){
		$id = $this->input->post('id');
		$perusahaan = $this->input->post('perusahaan');
		$pemilik = $this->input->post('pemilik');
		$alamat = $this->input->post('alamat');
		$kontak = $this->input->post('kontak');
		$dataset = array(
			'perusahaan' => $perusahaan,
			'pemilik' => $pemilik,
			'alamat' => $alamat,
			'kontak' => $kontak
		);
		$res = $this->m_master_suplier->ubah($dataset, $id);
		if($res == true){
			echo '<script>';
			echo "	alert('Berhasil menyimpan perubahan data suplier, akan dialihkan!');";
			echo "	window.location = '".base_url('master_suplier')."';";
			echo '</script>';
			return;
		}
		echo '<script>';
		echo "	alert('Gagal menyimpan perubahan data suplier, akan dialihkan!');";
		echo "	window.location = '".base_url('master_suplier')."';";
		echo '</script>';
	}
	function hapus($id = null){
		$res = $this->m_master_suplier->hapus($id);
		if($res == true){
			echo '<script>';
			echo "	alert('Berhasil menghapus data suplier, akan dialihkan!');";
			echo "	window.location = '".base_url('master_suplier')."';";
			echo '</script>';
			return;
		}
		echo '<script>';
		echo "	alert('Gagal menghapus data suplier, akan dialihkan!');";
		echo "	window.location = '".base_url('master_suplier')."';";
		echo '</script>';
	}
}