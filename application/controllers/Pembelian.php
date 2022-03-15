<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends CI_Controller{
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
		$this->load->model('m_master_barang');
		$this->vpk['warning'] = $this->m_warning->checkExpired();
		$this->vpk['master_suplier'] = $this->m_master_suplier->get_master_suplier();
		$this->vpk['master_barang'] = $this->m_master_barang->get_master_barang();
		$this->settings = file_get_contents("json/settings.json");
		$this->settings = json_decode($this->settings, true);
	}
	function kosong_keranjang(){
		$this->session->unset_userdata('shop');
		echo '<script>';
		echo "	alert('Keranjang telah dikosongkan, Akan dialihkan!');";
		echo "	window.location = '".base_url('pembelian')."';";
		echo '</script>';
	}
	function index(){
		$this->vpk['judul'] = 'Pembelian';
		$this->vpk['part_style'] = 'admin/pembelian/index_style';
		$this->vpk['part_view'] = 'admin/pembelian/index';
		$this->vpk['part_script'] = 'admin/pembelian/index_script';
		$this->vpk['shop'] = $this->session->userdata('shop');
		$this->load->view('admin', array_merge($this->vpk, $this->settings));
	}
	function tambah(){
		$index = 0;
		$data = [];
		if(empty($this->session->userdata('shop'))){
			$this->session->set_userdata('shop', []);
		}
		else{
			$index = count($this->session->userdata('shop'));
			$data = $this->session->userdata('shop');
		}
		$suplier = $this->input->post('suplier');
		$barang = $this->input->post('barang');
		$total_barang = $this->input->post('total_barang');
		$total_barang = eval('return '.$total_barang.';');
		$harga_beli = $this->input->post('harga_beli');
		$total_harga_beli = $total_barang * $harga_beli;
		$exp_s = $this->input->post('exp_s');
		$exp_d = $this->input->post('exp_d');
		if(
			empty($suplier) ||
			empty($barang) ||
			empty($total_barang) ||
			empty($harga_beli) ||
			empty($total_harga_beli) ||
			empty($exp_s)
		){
			echo '<script>';
			echo "	alert('Seluruh input tidak boleh kosong!');";
			echo "	window.location = '".base_url('pembelian')."';";
			echo '</script>';
			return;
		}
		if($exp_s == 'Ya' && empty($exp_d)){
			echo '<script>';
			echo "	alert('Jika expired ya, maka tanggal tidak boleh kosong!');";
			echo "	window.location = '".base_url('pembelian')."';";
			echo '</script>';
			return;
		}
		if($exp_s != 'Ya'){
			$exp_d = '';
		}
		$barang = explode(' >|< ', $barang);
		$dataset = array(
			'suplier' => $suplier,
			'jenis' => $barang[0],
			'barang' => $barang[1],
			'total_barang' => $total_barang,
			'harga_beli' => $harga_beli,
			'total_harga_beli' => $total_harga_beli,
			'exp_s' => $exp_s,
			'exp_d' => $exp_d,
		);
		$data[$index] = $dataset;
		$this->session->set_userdata('shop', $data);
		echo '<script>';
		echo "	alert('Keranjang telah ditambahkan, Akan dialihkan!');";
		echo "	window.location = '".base_url('pembelian')."';";
		echo '</script>';
	}
	function hapus($i = null){
		$data = $this->session->userdata('shop');
		unset($data[$i]);
		$data = array_values($data);
		$this->session->set_userdata('shop', $data);
		echo '<script>';
		echo "	alert('Item telah dihapus, Akan dialihkan!');";
		echo "	window.location = '".base_url('pembelian')."';";
		echo '</script>';
	}
	function selesai(){
		if(empty($this->session->userdata('shop'))){
			echo '<script>';
			echo "	alert('Keranjang masih kosong, Akan dialihkan!');";
			echo "	window.location = '".base_url('pembelian')."';";
			echo '</script>';
			return;
		}
		$data = $this->session->userdata('shop');
		$this->session->unset_userdata('shop');
		$this->load->model('m_pembelian');
		$user_id = $this->session->userdata('user_id');
		$res = $this->m_pembelian->simpan_pembelian($user_id);
		$id = $res[0]['id'];
		for($i = 0; $i < count($data); $i++){
			$data[$i]['id'] = $id;
			$data[$i]['id_l'] = $id.'-'.$i.'-'.geneRator();
		}
		$res = $this->m_pembelian->simpan_pembelian_detail_dan_stok($data);
		if($res != count($data)){
			echo '<script>';
			echo "	alert('Gagal menyimpan data transaksi beli!');";
			echo "	window.location = '".base_url('pembelian')."';";
			echo '</script>';
			return;
		}
		echo '<script>';
		echo "	alert('Berhasil menyimpan data transaksi beli!');";
		echo "	window.location = '".base_url('pembelian')."';";
		echo '</script>';
	}
}