<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller{
	private $su = ['super'];
	private $wosu = ['worker','super'];
	private $urol;
	private $vpk = [];
	private $settings;
	function __construct(){
		parent::__construct();
		$this->urol = $this->session->userdata('user_role');
		auth($this->urol, $this->wosu);
		$this->load->model('m_penjualan');
		$this->vpk['warning'] = $this->m_warning->checkExpired();
		$this->settings = file_get_contents("json/settings.json");
		$this->settings = json_decode($this->settings, true);
	}
	function ajax_index(){
		$search = $_POST['search']['value'];
		$limit = $_POST['length'];
		$start = $_POST['start'];
		$order_field = $_POST['order'][0]['column'];
		$order_field_data = $_POST['columns'][$order_field]['data'];
		$order_ascdesc = $_POST['order'][0]['dir'];
		$dataset = $this->m_penjualan->ajax_index(
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
	function index(){
		$this->vpk['judul'] = 'Penjualan';
		$this->vpk['part_style'] = 'admin/master_suplier/index_style';
		$this->vpk['part_view'] = 'admin/penjualan/index';
		$this->vpk['sub_part_view'] = 'admin/penjualan/sub/katalog';
		$this->vpk['sub_part_script'] = 'admin/penjualan/sub/katalog_script';
		$this->vpk['sell'] = $this->session->userdata('checkout');
		$this->load->view('admin', array_merge($this->vpk, $this->settings));
	}
	function checkout(){
		if(empty($this->session->userdata('checkout'))){
			echo '<script>';
			echo "	alert('Keranjang penjualan masih kosong!');";
			echo "	window.location = '".base_url('penjualan')."';";
			echo '</script>';
			return;
		}
		$this->vpk['judul'] = 'Penjualan';
		$this->vpk['part_view'] = 'admin/penjualan/index';
		$this->vpk['sub_part_view'] = 'admin/penjualan/sub/checkout';
		$this->vpk['sub_part_script'] = 'admin/penjualan/sub/checkout_script';
		$this->vpk['sell'] = $this->session->userdata('checkout');
		$this->load->view('admin', array_merge($this->vpk, $this->settings));
	}
	function checkout_add(){
		$id_l = $this->input->post('id_l');
		$jenis = $this->input->post('jenis');
		$barang = $this->input->post('barang');
		$harga_jual = $this->input->post('harga_jual');
		$jumlah_beli = $this->input->post('jumlah_beli');
		$total_barang = $this->input->post('total_barang');
		if($jumlah_beli == 0){
			echo '<script>';
			echo "	alert('Jumlah beli harus lebih dari nol!');";
			echo "	window.location = '".base_url('penjualan')."';";
			echo '</script>';
			return;
		}
		if(empty($this->session->userdata('checkout'))){
			$this->session->set_userdata('checkout',[]);
		}
		$dataset = $this->session->userdata('checkout');
		if(!empty($dataset[$id_l])){
			$dataset[$id_l]['jumlah_beli'] += $jumlah_beli;
			$dataset[$id_l]['total_barang'] -= $jumlah_beli;
		}
		else{
			$dataset[$id_l] = array(
				'jenis' => $jenis,
				'barang' => $barang,
				'jumlah_beli' => $jumlah_beli,
				'total_barang' => $total_barang - $jumlah_beli,
				'harga_jual' => $harga_jual
			);
		}
		$this->session->set_userdata('checkout', $dataset);
		echo '<script>';
		echo "	alert('Barang telah dimasukan ke keranjang, Akan dialihkan!');";
		echo "	window.location = '".base_url('penjualan/checkout')."';";
		echo '</script>';
	}
	function hapus_keranjang($id_l = null){
		if($id_l == null){
			echo '<script>';
			echo "	alert('Id Inventory tidak boleh kosong!');";
			echo "	window.location = '".base_url('penjualan')."';";
			echo '</script>';
			return;
		}
		$dataset = $this->session->userdata('checkout');
		unset($dataset[$id_l]);
		$this->session->set_userdata('checkout', $dataset);
		echo '<script>';
		echo "	alert('Barang telah dihapus dari keranjang, Akan dialihkan!');";
		echo "	window.location = '".base_url('penjualan/checkout')."';";
		echo '</script>';
	}
	function kosong_keranjang(){
		$this->session->unset_userdata('checkout');
		echo '<script>';
		echo "	alert('Semua barang telah dihapus dari keranjang, Akan dialihkan!');";
		echo "	window.location = '".base_url('penjualan')."';";
		echo '</script>';
	}
	function jual_ok(){
		$pembeli = $this->input->post('pembeli');
		if(empty($pembeli)){
			$pembeli = '-';
		}
		$jumlah_bayar = $this->input->post('jumlah_bayar');
		$uang_pembayaran = $this->input->post('uang_pembayaran');
		$uang_kembalian = $this->input->post('uang_kembalian');
		$id = $this->m_penjualan->simpan_penjualan($pembeli, $jumlah_bayar, $uang_pembayaran, $uang_kembalian);
		$id = $id[0]['id'];
		$data = $this->session->userdata('checkout');
		$dataset = [];
		$i = 0;
		foreach ($data as $key => $value) {
			$dataset[$i]['id'] = $id;
			$dataset[$i]['id_l'] = $key;
			$dataset[$i]['jenis'] = $value['jenis'];
			$dataset[$i]['barang'] = $value['barang'];
			$dataset[$i]['jumlah_beli'] = $value['jumlah_beli'];
			$dataset[$i]['total_barang'] = $value['total_barang'];
			$dataset[$i]['harga_jual'] = $value['harga_jual'];
			$i++;
		}
		$res = $this->m_penjualan->simpan_penjualan_detail($dataset);
		$this->session->unset_userdata('checkout');
		if($res != count($dataset)){
			echo '<script>';
			echo "	alert('Gagal menyimpan data transaksi jual!');";
			echo "	window.location = '".base_url('penjualan')."';";
			echo '</script>';
			return;
		}
		echo '<script>';
		echo "	alert('Berhasil menyimpan data transaksi jual!');";
		echo "	window.location = '".base_url('penjualan/faktur_jual/'.$id)."';";
		echo '</script>';
	}
	function faktur_jual($id = null){
		if($id == null){
			echo '<script>';
			echo "	alert('Id faktur jual kosong!');";
			echo "	window.location = '".base_url('penjualan')."';";
			echo '</script>';
			return;
		}
		$res = $this->m_penjualan->faktur_jual($id);
		$tanggal_rekap = tanggal_indo(date('Y-m-d'));
		$waktu_rekap = date('H:i:s');
		$title = 'faktur penjualan';
		$body = '';
		if($res != false){
			$body .= '<h1 style="text-align:center;display:block;">'.$this->settings['nama_toko'].'</h1><br>';
			$body .= '<p style="text-align:center;display:block;">Faktur penjualan</p>';
			$body .= '<p>Perekap : '.$this->session->userdata('user_id').'</p><br>';
			$body .= "<p>Tanggal rekap : $tanggal_rekap, pukul : $waktu_rekap</p><br>";
			$body .= '<hr><br>';
			$tstb = 0;
			$tsth = 0;
			foreach ($res as $key => $value) {
				$value['pendataan_masuk'] = explode(' ', $value['pendataan_masuk']);
				$value['pendataan_masuk'] = tanggal_indo($value['pendataan_masuk'][0]) .', '. $value['pendataan_masuk'][1];
				$body .= 'Penjualan Id : '.$value['id'].'<br><br>';
				$body .= 'Pendataan Masuk : '.$value['pendataan_masuk'].'<br><br>';
				$body .= 'Pembeli : '.$value['pembeli'].'<br><br>';
				$body .= 'Jumlah Bayar : '.formatRupiah($value['jumlah_bayar']).'<br><br>';
				$body .= 'Uang Pembayaran : '.formatRupiah($value['uang_pembayaran']).'<br><br>';
				$body .= 'Uang Kembalian : '.formatRupiah($value['uang_kembalian']).'<br><br>';
				$body .= 'Detail : <br><br>';
				$body .= '<table>';
				$body .= '	<tr>';
				$body .= '		<th>Nomor</th>';
				$body .= '		<th>Penjualan Id</th>';
				$body .= '		<th>Id List / Inventory</th>';
				$body .= '		<th>Jenis</th>';
				$body .= '		<th>Barang</th>';
				$body .= '		<th>Jumlah Beli</th>';
				$body .= '		<th>Harga Jual</th>';
				$body .= '	</tr>';
				$n = 1;
				$stb = 0;
				$sth = 0;
				foreach ($value['detail'] as $key => $vl) {
					$body .= '<tr>';
					$body .= '	<td>';
					$body .= $n;
					$body .= '	</td>';
					$body .= '	<td>';
					$body .= $vl['id'];
					$body .= '	</td>';
					$body .= '	<td>';
					$body .= $vl['id_l'];
					$body .= '	</td>';
					$body .= '	<td>';
					$body .= $vl['jenis'];
					$body .= '	</td>';
					$body .= '	<td>';
					$body .= $vl['barang'];
					$body .= '	</td>';
					$body .= '	<td>';
					$body .= $vl['jumlah_beli'];
					$body .= '	</td>';
					$body .= '	<td>';
					$body .= formatRupiah($vl['harga_jual']);
					$body .= '	</td>';
					$body .= '</tr>';
					$stb += $vl['jumlah_beli'];
					$sth += $vl['jumlah_beli'] * $vl['harga_jual'];
					$n++;
				}
				$tstb += $stb;
				$tsth += $sth;
				$body .= '	<tr>';
				$body .= '		<td></td>';
				$body .= '		<td></td>';
				$body .= '		<td></td>';
				$body .= '		<td></td>';
				$body .= '		<td>Total</td>';
				$body .= '		<td>'.$stb.'</td>';
				$body .= '		<td>'.formatRupiah($sth).'</td>';
				$body .= '	</tr>';
				$body .= '</table>';
				$body .= '<br><br><hr><br>';
			}
			$body .= 'Total Barang Yang Dijual : '.$tstb;
			$body .= '<br><br>Total Pendapatan : '.formatRupiah($tsth);
		}
		else{
			$body = 'Tidak ada laporan saat ini!';
		}
		$html = htmlPDFBUILDER($title, $body);
		$this->load->library('mylib');
		$pdf = $this->mylib->loadDOMPDF();
		$pdf->load_html($html);
		$pdf->set_paper(array(0,0,800,1200), 'portrait');
		$pdf->render();
		$pdf->stream('Faktur-penjualan-tanggal-rekap-pada-'.str_replace(' ', '-',$tanggal_rekap), array("Attachment" => false));
	}
}