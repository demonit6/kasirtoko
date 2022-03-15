<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_penjualan extends CI_Model{
		function ajax_index($search, $limit, $start, $order_field_data, $order_ascdesc){
		$dataset = [];

		$this->db->select('a.id, a.id_l, a.jenis, a.barang, a.total_barang, a.exp_s, a.exp_d, b.harga_jual');
		$this->db->from('stok a');
		$this->db->join('stok_harga b','a.jenis = b.jenis AND a.barang = b.barang','left');
		$get = $this->db->get();
		$dataset['recordsTotal'] = $get->num_rows();

		$this->db->select('a.id, a.id_l, a.jenis, a.barang, a.total_barang, a.exp_s, a.exp_d, b.harga_jual');
		$this->db->from('stok a');
		$this->db->join('stok_harga b','a.jenis = b.jenis AND a.barang = b.barang','left');
		$this->db->like('a.id_l', $search);
		$this->db->or_like('a.jenis', $search);
		$this->db->or_like('a.barang', $search);
		$get = $this->db->get();
		$dataset['recordsFiltered'] = $get->num_rows();

		$this->db->select('a.id, a.id_l, a.jenis, a.barang, a.total_barang, a.exp_s, a.exp_d, b.harga_jual');
		$this->db->from('stok a');
		$this->db->join('stok_harga b','a.jenis = b.jenis AND a.barang = b.barang','left');
		$this->db->like('a.id_l', $search);
		$this->db->or_like('a.jenis', $search);
		$this->db->or_like('a.barang', $search);
		$this->db->order_by($order_field_data, $order_ascdesc);
		$this->db->limit($limit, $start);
		$get = $this->db->get();
		$dataset['data'] = $get->result_array();

		return $dataset;
	}
	function simpan_penjualan($pembeli, $jumlah_bayar, $uang_pembayaran, $uang_kembalian){
		$now = date('Y-m-d H:i:s');
		$q = "INSERT INTO penjualan VALUES
		(null,'$now','$pembeli','$jumlah_bayar','$uang_pembayaran','$uang_kembalian')";
		$this->db->query($q);
		$q = "SELECT LAST_INSERT_ID() AS id";
		$r = $this->db->query($q);
		return $r->result_array();
	}
	function simpan_penjualan_detail($dataset){
		$up = [];
		for($i = 0; $i < count($dataset); $i++){
			$up[$i]['id_l'] = $dataset[$i]['id_l'];
			$up[$i]['total_barang'] = $dataset[$i]['total_barang'];
			unset($dataset[$i]['total_barang']);
		}
		$res = $this->db->update_batch('stok',$up,'id_l');
		$res = $this->db->insert_batch('penjualan_detail', $dataset);
		return $res;
	}
	function faktur_jual($id){
		$a = $this->db->query("
			SELECT * FROM penjualan
			WHERE id='$id'
			");
		if($a->num_rows() == 0){
			return false;
		}
		$data_one = $a->result_array();
		$b = $this->db->query("
			SELECT * FROM penjualan_detail
			WHERE id='$id'
			");
		if($b->num_rows() == 0){
			return false;
		}
		$data_two = $b->result_array();
		$dataset = [];
		for($i = 0; $i < count($data_one); $i++){
			$dataset[$i]['id'] = $data_one[$i]['id'];
			$dataset[$i]['pendataan_masuk'] = $data_one[$i]['pendataan_masuk'];
			$dataset[$i]['pembeli'] = $data_one[$i]['pembeli'];
			$dataset[$i]['jumlah_bayar'] = $data_one[$i]['jumlah_bayar'];
			$dataset[$i]['uang_pembayaran'] = $data_one[$i]['uang_pembayaran'];
			$dataset[$i]['uang_kembalian'] = $data_one[$i]['uang_kembalian'];
			for($j = 0; $j < count($data_two); $j++){
				if($data_one[$i]['id'] == $data_two[$j]['id']){
					$dataset[$i]['detail'][$j]['id'] = $data_two[$j]['id'];
					$dataset[$i]['detail'][$j]['id_l'] = $data_two[$j]['id_l'];
					$dataset[$i]['detail'][$j]['jenis'] = $data_two[$j]['jenis'];
					$dataset[$i]['detail'][$j]['barang'] = $data_two[$j]['barang'];
					$dataset[$i]['detail'][$j]['jumlah_beli'] = $data_two[$j]['jumlah_beli'];
					$dataset[$i]['detail'][$j]['harga_jual'] = $data_two[$j]['harga_jual'];
					$dataset[$i]['detail'] = array_values($dataset[$i]['detail']);
				}
			}
		}
		return $dataset;
	}
}